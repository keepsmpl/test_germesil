<?php

# jSale v1.37
# http://jsale.biz

# Подключение настроек
include_once dirname(__FILE__) . '/config.inc.php';

# Кодировка
header('Content-type: text/html; charset=' . $config['encoding']);
header('Access-Control-Allow-Origin: *');

# Вывод ошибок
if ($config['errors'] === true)
{
	error_reporting(E_ALL); # Уровень вывода ошибок
	ini_set('display_errors', 'on'); # Вывод ошибок включён
	ini_set("log_errors", 'on'); # Логирование включено
	ini_set("error_log", dirname(__FILE__) . '/error_log.txt'); # Путь файла с логами
}

# Подключение модуля отправки почты
include_once dirname(__FILE__) . '/modules/M_Email.inc.php';
$mEmail = M_Email::Instance();

# Подключение модуля скидок
if ($config['discounts']['enabled'] === true || $config['codes']['enabled'] === true)
{
	include_once dirname(__FILE__) . '/modules/M_Discounts.inc.php';
	$mDiscounts = M_Discounts::Instance();
}

# Обработка POST запроса
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !isset($sent))
{
	# Проверка на спам
	$spam = $mEmail->CheckSpam($_POST['order_nospam'], $config['secretWord']);

	# Перекодировка данных в случае старой кодировки
	if ($config['encoding'] == 'windows-1251')
		foreach ($_POST as $i => $var)
			$_POST[$i] = iconv('utf-8', 'windows-1251', $var);

	# Обработка и сохранение данных в переменные
    $email = (isset($_POST['order_email'])) ? $mEmail->ProcessText($_POST['order_email']) : '';
    $name = (isset($_POST['order_name'])) ? $mEmail->ProcessText($_POST['order_name']) : '';
    $lastname = (isset($_POST['order_lastname'])) ? $mEmail->ProcessText($_POST['order_lastname']) : '';
    $fathername = (isset($_POST['order_fathername'])) ? $mEmail->ProcessText($_POST['order_fathername']) : '';
    $phone = (isset($_POST['order_phone'])) ? $mEmail->ProcessText($_POST['order_phone']) : '';
    $region = (isset($_POST['order_region'])) ? $mEmail->ProcessText($_POST['order_region']) : '';
    $zip = (isset($_POST['order_zip'])) ? $mEmail->ProcessText($_POST['order_zip']) : '';
    $city = (isset($_POST['order_city'])) ? $mEmail->ProcessText($_POST['order_city']) : '';
    $address = (isset($_POST['order_address'])) ? $mEmail->ProcessText($_POST['order_address']) : '';
    $comment = (isset($_POST['order_comment'])) ? $mEmail->ProcessText($_POST['order_comment']) : '';
    $payment = (isset($_POST['order_payment'])) ? $mEmail->ProcessText($_POST['order_payment']) : '1';
    $delivery = (isset($_POST['order_delivery'])) ? $mEmail->ProcessText($_POST['order_delivery']) : '1';

	$code = (isset($_POST['order_code'])) ? $_POST['order_code'] : '';
	
	$id_form = $_POST['id_form'];

	$product['code'] = $_POST['product_code'];
	$product['title'] = $_POST['product_title'];
	$product['price'] = $_POST['product_price'];
	$product['qty'] = $_POST['product_qty'];
	$product['qty_type'] = $_POST['product_qty_type'];
	$product['unit'] = $_POST['product_unit'];
	$product['param1'] = (isset($_POST['product_param1'])) ? $_POST['product_param1'] : '';
	$product['param2'] = (isset($_POST['product_param2'])) ? $_POST['product_param2'] : '';
	$product['param3'] = (isset($_POST['product_param3'])) ? $_POST['product_param3'] : '';
	$product['hash'] = $_POST['hash'];

	$product['discount'] = (isset($_POST['product_discount'])) ? $_POST['product_discount'] : 0;
	
	$template = (isset($_POST['template'])) ? $_POST['template'] : '';
	$product['form_type'] = (isset($_POST['form_type'])) ? $_POST['form_type'] : $config['product']['form_type'];
	
	# Проверка хэша
	if (md5($config['secretWord'].'_'.$product['price'].'_'.$product['discount'].'_'.$product['title']) != $product['hash'])
		die;
	
	# Подсчитываем сумму
	$product['subtotal'] = $product['price'] * $product['qty'];

	# Подсчёт накопительной скидки
	$user['discount'] = 0;

	# Подсчёт скидки по промо-коду
	$code_discount = 0;
	
	# Определяем партнёра и скидку
	$ref_discount = 0;

	# Выбор максимальной скидки
	$discount = max($user['discount'], $code_discount, $ref_discount, $product['discount'], 0);

	# Определение названия формы оплаты
    $payment_type = $payment;
    $payment = $config['payments'][$payment_type];
    $payment['type'] = $payment_type;

	# Определение названия способа доставки
    $delivery_type = $delivery;
    $delivery = $config['deliveries'][$delivery_type];
    $delivery['type'] = $delivery_type;

	# Учёт скидки
	if ($config['discounts']['fixed'] === true)
		$product['subtotal'] = number_format($product['subtotal'] - $discount, 2, '.', '');
	else
		$product['subtotal'] = number_format($product['subtotal'] * (1 - $discount / 100), 2, '.', '');
	
	# Прибавление стоимости доставки	
	$order_sum = number_format($product['subtotal'] + $delivery['cost'], 2, '.', '');

	if ($_POST['action'] == 'send')
	{
		# Валидация данных
		$validate = $mEmail->ValidateForm($email, $name, $lastname, $fathername, $phone, $zip, $region, $city, $address, $product['qty'], $config);

		if (!$spam)
		{
			$message = $config['form']['isSpam'];
		}
		elseif ($validate)
		{
			$message = $validate;
		}
		# Обработка успешного заказа
		else
		{
			# Маркер, сигнализирующий создание нового заказа
			$new_order = 1;
			
			# Подстановка скидки в массив product
			$product['discount'] = number_format($discount, 2, '.', '');

			# Генерация идентификатора заказа, если его ещё не существует.
			if (empty($id_order))
				$id_order = mktime();

			# Подготовка сообщения к отправке.
			$adminContent = $mEmail->PrepareOrder($id_order, $email, $lastname, $name, $fathername, $phone, $zip, $region, $city, $address, $comment, $product, $order_sum, $payment, $delivery, $config, 'true');
			$customerContent = $mEmail->PrepareOrder($id_order, $email, $lastname, $name, $fathername, $phone, $zip, $region, $city, $address, $comment, $product, $order_sum, $payment, $delivery, $config);
			
			$email_from = (!empty($email) && $config['email']['from_customer'] === true) ? $email : $config['email']['answer'];

			# Отправка письма.
			if ( !$mEmail->SendEmail($config['email']['receiver'], $email_from, $config['email']['subjectOrder'], $adminContent, $name, $config['encoding']) )
			{
				$message = $config['form']['notSent'];
			}
			# Подтверждение отправки.
			else
			{
				if (!empty($email))
					$mEmail->SendEmail($email, $config['email']['answer'], $config['email']['subjectOrder'], $customerContent, $config['email']['answerName'], $config['encoding']);
				$sent = 1;
			}
		}
	}
}

# Если письмо отправлено, выводим сообщение об этом.
if (isset($sent))
{
	$echo = $config['form']['sent'];

	if (isset($payment['form']))
		$echo .= <<<EOF
		<div id="jsale-payment" style="text-align:center; padding-bottom: 30px;">Оплатить заказ можно прямо сейчас: {$payment['form']}
		<br>
		Сейчас вы будете перенаправлены на платёжный шлюз. Если этого не произошло, нажмите кнопку "Оплатить".
		<script type="text/javascript">
			setTimeout(function(){
				jQuery('#jsale-payment form').attr('target', '_self');
				jQuery('#jsale-payment form').submit();
			}
			, 3000);
			
		</script>
		</div>
EOF;
	else
		$echo .= '<!--order_send-->';

	if (isset($payment['link']))
		$echo .= '<script type="text/javascript">var redirect="'.$payment['link'].'";</script>';
}
else
{
	# Генерируем антиспам.
	$antispam = $mEmail->GenerateAntispam($config['secretWord']);
	
	# Устанавливаем шаблон
	$template = (!empty($template)) ? '_' .$template : '';
	
	ob_start();
	include_once dirname(__FILE__) . "/design/orderForm$template.tpl.php";
	$echo = ob_get_clean();
}

# Вывод на экран
echo $echo;