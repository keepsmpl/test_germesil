<?php
# Модуль обработки заказа и отправки заказа на почту

class M_Email
{
	private static $instance; 	# Ссылка на экземпляр класса

	# Получение единственного экземпляра класса
	public static function Instance()
	{
		if (self::$instance == null)
			self::$instance = new M_Email();

		return self::$instance;
	}

	# Генерация антиспама
	public function GenerateAntispam($secret)
	{
		return md5('s' . date("Y-m-d") . 'p' . date("d-m-Y") . 'a' . $secret . 'm');
	}

    # Проверка антиспама
    public function CheckSpam($antispam, $secret)
    {
        return (md5('s' . date("Y-m-d") . 'p' . date("d-m-Y") . 'a' . $secret . 'm') == $antispam);
    }

    # Валидация формы (обязательные поля)
    public function ValidateForm($email, $name, $lastName, $fatherName, $phone, $zip, $region, $city, $address, $qty, $config)
    {
        $name = filter_var($name, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_STRIP_LOW);
        $lastName = filter_var($lastName, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_STRIP_LOW);
        $fatherName = filter_var($fatherName, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_STRIP_LOW);
        $phone = filter_var($phone, FILTER_SANITIZE_NUMBER_INT);
        $zip = filter_var($zip, FILTER_SANITIZE_NUMBER_INT);
		$region = filter_var($region, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_STRIP_LOW);
        $city = filter_var($city, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_STRIP_LOW);
        $address = filter_var($address, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_STRIP_LOW);
		
        if (empty($name) && $config['form']['name']['required'] === true || empty($lastName) && $config['form']['lastname']['required'] === true || empty($fatherName) && $config['form']['fathername']['required'] === true)
            return $config['form']['emptyName'];
        elseif (filter_var($email, FILTER_VALIDATE_EMAIL) === false && $config['form']['email']['required'] === true)
            return $config['form']['emptyEmail'];
		elseif ($qty == 0)
			return $config['form']['emptyQty'];
        elseif (empty($phone) && $config['form']['phone']['required'] === true)
            return $config['form']['emptyPhone'];
        elseif (empty($zip) && $config['form']['zip']['required'] === true || empty($region) && $config['form']['region']['required'] === true || empty($city) && $config['form']['city']['required'] === true || empty($address) && $config['form']['address']['required'] === true)
            return $config['form']['emptyAddress'];
        else
            return false;
    }

    # Подготовка письма о составлении заказа
    public function PrepareOrder($id_order, $email, $lastName, $name, $fatherName, $phone = null, $zip, $region, $city, $address, $comment, $order_item, $order_sum, $payment, $delivery, $config, $admin = null)
    {
		ob_start();
		include dirname(__FILE__) . '/../design/emailOrder.tpl.php';
		return ob_get_clean();
    }

    # Отправка письма (без аттача)
    public function SendEmail($toEmail, $fromEmail, $subject, $content, $from = null, $encoding = 'utf-8')
    {
		# Если от кого не указано, подставляем робота :)
        if ($from == null)
            $from = 'Robo';

        # Обработка темы.
        $subject = "=?$encoding?b?" . base64_encode($subject) . "?=";
        # Формирование заголовков.
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=$encoding\r\n";
        $headers .= "From: =?$encoding?b?" . base64_encode($from) . "?= <" . $fromEmail . ">";

        return (mail($toEmail, $subject, $content, $headers));
    }

	# Обработка текста для сохранения в базу данных или отправки по почте.
	public function ProcessText($text)
	{
		$text = trim($text); # Удаляем пробелы по бокам.
		$text = stripslashes($text); # Удаляем слэши, лишние пробелы и переводим html символы.
		$text = htmlspecialchars($text); # Переводим HTML в текст.
		$text = preg_replace("/ +/"," ", $text); # Множественные пробелы заменяем на одинарные.
		$text = preg_replace("/(\r\n){3,}/","\r\n\r\n", $text); # Убираем лишние пробелы (больше 1 строки).
		$text = str_replace("\r\n","<br>", $text); # Заменяем переводы строк на тег.

		return $text; # Возвращаем переменную.
	}
}