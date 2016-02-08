<?php

# jSale v1.37
# http://jsale.biz

# Подключение настроек
include_once dirname(__FILE__) . '/config.inc.php';

# Проверка домена
if (strpos($_SERVER['HTTP_REFERER'], $config['sitelink']) === false)
	die;

# Заголовок javascript
header('Content-Type: text/javascript; charset=' . $config['encoding']);
header('Access-Control-Allow-Origin: *');

# Запрет кэширования
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Cache-Control: no-cache, must-revalidate');
header('Pragma: no-cache');
header('Last-Modified: '.gmdate('D, d M Y H:i:s').'GMT');

# Проверка подключения jQuery
echo <<<EOF
if (window.jQuery == undefined) { 
document.write(unescape("%3Cscript src='http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js' type='text/javascript'%3E%3C/script%3E")); 
}

EOF;

# Путь до папки со скриптом
$jsale_dir = $config['sitelink'] . $config['dir'];

# Проверка подключения JSale
echo <<<EOF

if (window.jSale == undefined) { 
	document.write(unescape("%3Cscript src='{$jsale_dir}js/jquery.simplemodal.1.4.4.min.js' type='text/javascript'%3E%3C/script%3E"));
	document.write(unescape("%3Cscript src='{$jsale_dir}js/jsale.js' type='text/javascript'%3E%3C/script%3E"));
	document.write(unescape("%3Cscript src='{$jsale_dir}js/custom.js' type='text/javascript'%3E%3C/script%3E"));
	document.write(unescape("%3Clink href='{$jsale_dir}css/jsale.css' media='screen, projection' rel='stylesheet' type='text/css' \%3E"));
	var jSale = 1;
}
else {
	jSale++;
}

EOF;

$product = array();

# Подхват данных товара
if (isset($_GET['product']))
{
	# Подключение модуля
	include_once dirname(__FILE__) . '/modules/M_DB.inc.php';
	$mDB = M_DB::Instance();

	# Выборка товара
	$product = $mDB->GetItemByCode('product', $_GET['product']);
	$feedback = 'false';
}
elseif ($config['products']['base2pro'] === true && isset($_GET['id']) || $config['products']['base2pro'] === true && isset($_GET['code']))
{
	$product['code'] = (isset($_GET['id'])) ? $_GET['id'] : $_GET['code'];

	# Подключение модуля
	include_once dirname(__FILE__) . '/modules/M_DB.inc.php';
	$mDB = M_DB::Instance();

	# Выборка товара
	$product = $mDB->GetItemByCode('product', $product['code']);
	$feedback = 'false';
}

# Если данные не заданы, берём их из GET запроса
if (empty($product))
{
	if (isset($_GET['code']))
		$product['code'] = $_GET['code'];
	elseif (isset($_GET['id']))
		$product['code'] = $_GET['id'];
	else
		$product['code'] = $config['product']['code'];

	$product['title'] = (isset($_GET['title'])) ? $_GET['title'] : $config['product']['title'];
	$product['price'] = (isset($_GET['price'])) ? $_GET['price'] : $config['product']['price'];
	$product['discount'] = (isset($_GET['discount'])) ? $_GET['discount'] : $config['product']['discount'];
	$product['qty'] = (isset($_GET['qty'])) ? $_GET['qty'] : $config['product']['qty'];
	$product['qty_type'] = (isset($_GET['qty_type'])) ? $_GET['qty_type'] : $config['product']['qty_type'];
	$product['unit'] = (isset($_GET['unit'])) ? $_GET['unit'] : $config['product']['unit'];
	$product['param1'] = (isset($_GET['param1'])) ? $_GET['param1'] : $config['product']['param1'];
	$product['param2'] = (isset($_GET['param2'])) ? $_GET['param2'] : $config['product']['param2'];
	$product['param3'] = (isset($_GET['param3'])) ? $_GET['param3'] : $config['product']['param3'];
	$product['description'] = (isset($_GET['description'])) ? $_GET['description'] : $config['product']['description'];
}

$form_type = (isset($_GET['form_type'])) ? $_GET['form_type'] : $config['product']['form_type'];
$template = (isset($_GET['template'])) ? $_GET['template'] : '';
$feedback = (isset($_GET['feedback'])) ? 'true' : 'false';

# Подсчёт стоимости
$product['subtotal'] = $product['price'] * $product['qty'];

# Надпись на кнопке заказа
$product['button_text'] = (isset($_GET['button_text'])) ? $_GET['button_text'] : '';

echo <<<EOF

var product = {};
product['code'] = '{$product['code']}';
product['title'] = '{$product['title']}';
product['price'] = '{$product['price']}';
product['discount'] = '{$product['discount']}';
product['qty'] = '{$product['qty']}';
product['qty_type'] = '{$product['qty_type']}';
product['unit'] = '{$product['unit']}';
product['param1'] = '{$product['param1']}';
product['param2'] = '{$product['param2']}';
product['param3'] = '{$product['param3']}';
product['subtotal'] = '{$product['subtotal']}';
product['description'] = '{$product['description']}';
product['button_text'] = '{$product['button_text']}';
product['template'] = '{$template}';
product['form_type'] = '{$form_type}';
var feedback = {$feedback};

if (window.products == undefined) {
	var products = [];
}

if (!feedback)
	products[jSale] = product;
else
	jSale--;

if (!sitelink) {
	var sitelink = '{$config['sitelink']}';
}

if (!dir) {
	var dir = '{$config['dir']}';
}

EOF;

# Редирект после отправки заказа
if (isset($config['resultURL']) && $config['resultURL'] != '')
{
	echo <<<EOF

	if (!redirect) {
		var redirect = '{$config['sitelink']}{$config['resultURL']}';
	}
EOF;
}

# Вставка формы. Инициализацию выводим только 1 раз
echo <<<EOF

if (jSale <= 1) {
	document.write(unescape("%3Cscript src='{$jsale_dir}js/jsale_init.js' type='text/javascript'%3E%3C/script%3E"));
}
if (!feedback) {
	document.write('<div class="jSale"></div>');
} else {
	document.write('<div class="jSaleFeedback"></div>');
}

EOF;
