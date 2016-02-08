<?php

# jSale v1.37
# http://jsale.biz

# Подключение настроек
include_once dirname(__FILE__) . '/config.inc.php';

# Кодировка
header('Content-type: text/html; charset=' . $config['encoding']);
header('Access-Control-Allow-Origin: *');

# Подключение модуля отправки почты
include_once dirname(__FILE__) . '/modules/M_Email.inc.php';
$mEmail = M_Email::Instance();

# Данные ввода
if (isset($_POST['product']))
	$product = $_POST['product'];

# Идентификатор формы
if (isset($_POST['id']))
	$id_form = $_POST['id'];

# Перекодировка данных в случае старой кодировки
if ($config['encoding'] == 'windows-1251')
	foreach ($product as $i => $var)
		$product[$i] = iconv('utf-8', 'windows-1251', $var);

# Вычисляем накопительную скидку, если задана
if (is_file(dirname(__FILE__) . '/modules/M_Discounts.inc.php') && $config['discounts']['enabled'] === true)
{
	include_once dirname(__FILE__) . '/modules/M_Discounts.inc.php';
	$mDiscounts = M_Discounts::Instance();

	$user = $mDiscounts->CountDiscount($product['subtotal'], $config['discounts']['table']);
}
else
	$user['discount'] = 0;

# Вычисляем максимальную скидку
$product['discount'] = $discount = max($user['discount'], $product['discount'], 0);

# Генерация хэша
$product['hash'] = md5($config['secretWord'].'_'.$product['price'].'_'.$product['discount'].'_'.$product['title']);

# Вычисляем сумму заказа
$order_sum = $product['subtotal'] = number_format($product['subtotal'] * (1 - $product['discount'] / 100), 2, '.', '');

# Генерация антиспама
$antispam = $mEmail->GenerateAntispam($config['secretWord']);

# Настройки для электронных товаров
if (isset($config['download']['dir']) && is_file(dirname(__FILE__) . '/' . $config['download']['dir'] . '/' . $product['code'] . '.' . $config['download']['type']))
	include_once dirname(__FILE__) . '/config2.inc.php';

# Метод оплаты по умолчанию
foreach ($config['payments'] as $key => $payment)
{
	if ($payment['enabled'] == true)
	{
		$payment_type = $key;
		break;
	}
}

# Способ доставки по умолчанию
foreach ($config['deliveries'] as $key => $delivery)
{
	if ($delivery['enabled'] == true)
	{
		$delivery_type = $key;
		break;
	}
}
	
# Текст кнопки заказа
$button_text = (empty($product['button_text'])) ? (!isset($feedback)) ? $config['button']['order'] : $config['button']['feedback'] : $product['button_text'];

# Выбор шаблона
$orderForm = (!empty($product['template'])) ? 'orderForm_' . $product['template'] : 'orderForm';

# Обёртка шаблона формы
$code = (isset($code)) ? $code : '';
ob_start();
include_once dirname(__FILE__) . '/design/' . $orderForm . '.tpl.php';
$orderForm = ob_get_clean();

# Обёртка шаблона всплывающего окна
ob_start();
include_once dirname(__FILE__) . '/design/orderButton.tpl.php';
echo ob_get_clean();