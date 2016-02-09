<?php

# jSale v1.37
# http://jsale.biz

$config = array();

////////////////////////////////////////////////////////////////////////////////
// ОБЩИЕ НАСТРОЙКИ

$config['dir']								= 'jsale/jsale/'; # Папка, содержащая скрипт
$config['secretWord']               	    = 'sfsd13hasf1234'; # Секретное слово для генерации антиспама
$config['sitelink']							= 'http://glue.aks/'; # Адрес сайта (со слэшем на конце)
$config['sitename']							= 'Автогермесил'; # Название магазина
$config['resultURL']						= ''; # Страница, после оформления заказа (если не нужна, оставьте пустой)
$config['successURL']						= ''; # Страница, после оплаты заказа (если не нужна, оставьте пустой)
$config['failURL']							= 'fail.html'; # Страница, при сбое оплаты заказа (если не нужна, оставьте пустой)
$config['errors']							= false; # Выводить ошибки
$config['currency']							= 'руб.'; # Валюта
$config['currencyCode']						= 'RUB'; # Код валюты. Нужно для оплаты онлайн
$config['encoding']							= 'utf-8'; # Кодировка

////////////////////////////////////////////////////////////////////////////////
// НАСТРОЙКА EMAIL

$config['email']['receiver']				= '6402329@mail.ru'; # E-mail адрес, на который отправляется заказ
$config['email']['answer']					= 'info@himlogistik.com'; # E-mail адрес, от имени которого отправляется ответное письмо покупателю
$config['email']['from_customer']			= true; # Присылать продавцу письма от имени покупателя? true/false
$config['email']['answerName']				= 'Автогермесил';	# Имя робота
$config['email']['answerMessageTop']		= 'Спасибо за покупку на сайте <a href="' . $config['sitelink'] . '">' . $config['sitename'] . '</a><br><br>'; # Ответное письмо покупателю
$config['email']['answerMessageSignature']	= '<p>--------------<br> </p>'; # Подпись в письме
$config['email']['subjectOrder']			= 'Получен заказ на сайте «' . $config['sitename'] . '»'; # Тема письма о заказе
$config['email']['subjectStatus']			= 'Изменение статуса заказа на сайте «' . $config['sitename'] . '»'; # Тема письма об изменении статуса
$config['email']['subjectFeedback']			= 'Получено письмо на сайте «' . $config['sitename'] . '»'; # Тема письма обратной связи
$config['email']['subjectDownload']			= 'Получите ссылку для скачивания товара'; # Тема письма о ссылке на скачивание

////////////////////////////////////////////////////////////////////////////////
// НАСТРОЙКА БД
$config['database']['enabled']				= false; # Использовать БД?
$config['database']['host']					= ''; # Хост
$config['database']['user']					= ''; # Пользователь
$config['database']['pass']					= ''; # Пароль
$config['database']['name']					= ''; # Название базы

////////////////////////////////////////////////////////////////////////////////
// НАСТРОЙКА МЕТОДОВ ОПЛАТЫ

# Отправка на почту
$config['payments']['email']['enabled']				= true; # Использовать отправку на почту?
$config['payments']['email']['title']				= 'Наличные'; # Название оплаты курьеру в выборе формы оплаты
$config['payments']['email']['info']				= 'Оплата наличными в нашем офисе'; # Описание
$config['payments']['email']['details']				= ''; # Детали (будут высланы на email)

# Отправка курьеру
$config['payments']['courier']['enabled']			= true;
$config['payments']['courier']['title']				= 'Безналичный расчёт';
$config['payments']['courier']['info']				= 'Оплата безналичным расчётом. Мы пришлём счёт вам на email';
$config['payments']['courier']['details']			= '';

# Настройки RoboKassa
$config['payments']['robokassa']['enabled']			= false;    # Использовать RoboKassa?
$config['payments']['robokassa']['title']			= 'Оплата на сайте с помощью RoboKassa';    # Название онлайн платежей в выборе формы оплаты
$config['payments']['robokassa']['info']			= 'Электронные и мобильные платежи, карты, интернет-банкинг, терминалы...'; # Описание
$config['payments']['robokassa']['details']			= ''; # Детали (будут высланы на email)

$config['payments']['robokassa']['login']			= '';   # Логин в Робокассе
$config['payments']['robokassa']['pass1']			= '';   # Пароль 1 в Робокассе
$config['payments']['robokassa']['pass2']			= '';   # Пароль 2 в Робокассе
$config['payments']['robokassa']['description']		= 'Оплата покупки в магазине «' . $config['sitename'] . '»';   # Описание оплаты
$config['payments']['robokassa']['test']			= true; # Тестовый режим?

# Настройка LiqPay
$config['payments']['liqpay']['enabled']			= false;    # Использовать платежи по безналу?
$config['payments']['liqpay']['title']				= 'Оплата картой с помощью LiqPay';  # Название платежей банковской картой в выборе формы оплаты
$config['payments']['liqpay']['info']				= 'Моментальные платежи банковскими картами'; # Описание
$config['payments']['liqpay']['details']			= ''; # Детали (будут высланы на email)

$config['payments']['liqpay']['description']		= 'Оплата покупки в магазине «' . $config['sitename'] . '»';   # Описание оплаты
$config['payments']['liqpay']['id']					= '';    # ID мерчанта в LiqPay
$config['payments']['liqpay']['sign']				= '';   # Подпись

# Настройки InterKassa
$config['payments']['interkassa']['enabled']		= false;    # Использовать InterKassa?
$config['payments']['interkassa']['title']			= 'Оплата на сайте с помощью InterKassa';    # Название онлайн платежей в выборе формы оплаты
$config['payments']['interkassa']['info']			= 'Электронные деньги, банковские карты, переводы, терминалы...'; # Описание
$config['payments']['interkassa']['details']		= ''; # Детали (будут высланы на email)

$config['payments']['interkassa']['shop_id']        = '';   # Идентификатор магазина
$config['payments']['interkassa']['secret_key']     = '';   # Cекретный ключ
$config['payments']['interkassa']['description']    = 'Оплата покупки в магазине «' . $config['sitename'] . '»';   # Описание оплаты

# Настройка A1Pay
$config['payments']['a1pay']['enabled']             = false; # Использовать A1Pay
$config['payments']['a1pay']['title']               = 'Оплата на сайте с помощью A1Pay'; # Название в выборе формы оплаты
$config['payments']['a1pay']['info']                = 'Webmoney, Яндекс.Деньги, мобильные платежи, карты, SMS...'; # Описание
$config['payments']['a1pay']['details']         	= ''; # Детали (будут высланы на email)

$config['payments']['a1pay']['secret_word']			= '';   # Cекретное слово (устанавливается вами)
$config['payments']['a1pay']['secret_key']          = '';   # Cекретный ключ (взять при создании кнопки)
$config['payments']['a1pay']['description']         = 'Оплата покупки в магазине «' . $config['sitename'] . '»';   # Описание оплаты

# Настройка RBKmoney
$config['payments']['rbkmoney']['enabled']			= true; # Использовать RBKmoney
$config['payments']['rbkmoney']['title']			= 'Оплата на сайте с помощью RBKmoney'; # Название в выборе формы оплаты
$config['payments']['rbkmoney']['info']				= 'Карты Visa / MasterCard, переводы СONTACT, Почта России, интернет-банкинг, банковские платежи по квитанции, платежные терминалы...'; # Описание
$config['payments']['rbkmoney']['details']			= ''; # Детали (будут высланы на email)

$config['payments']['rbkmoney']['shop_id']			= '111'; # Идентификатор магазина в RBK
$config['payments']['rbkmoney']['secret_key']		= '222'; # Cекретный ключ
$config['payments']['rbkmoney']['description']		= 'Оплата покупки в магазине «' . $config['sitename'] . '»';   # Описание оплаты

////////////////////////////////////////////////////////////////////////////////
// НАСТРОЙКА МЕТОДОВ ДОСТАВКИ

$config['deliveries']['1']['enabled']		= true; # Использовать?
$config['deliveries']['1']['title']			= 'Доставка транспортной компанией'; # Название в выпадающем меню
$config['deliveries']['1']['info']			= 'Мы отправим вам товар любой транспортной компанией. Стоимость отправки уточняйте у менеджеров.'; # Описание
$config['deliveries']['1']['details']		= ''; # Детали (будут высланы на email)
$config['deliveries']['1']['cost']			= 0; # Стоимость (будет добавлено к стоимости заказа). Обязательно цифра.

$config['deliveries']['2']['enabled']		= false;
$config['deliveries']['2']['title']			= 'Доставка курьером';
$config['deliveries']['2']['info']			= 'Доставка курьерской службой. +200 руб. к заказу.';
$config['deliveries']['2']['details']		= '';
$config['deliveries']['2']['cost']			= 200;

////////////////////////////////////////////////////////////////////////////////
// НАСТРОЙКА СКИДОК

$config['discounts']['enabled']				= false;
$config['discounts']['table']				= array (
												2000 => 2
											);

$config['codes']['enabled']					= true;
$config['codes']['table']					= array (
												'2012' => 2,
												
											);

$config['discounts']['fixed']				= false; # Использовать не процентные скидки, а фиксированные?
////////////////////////////////////////////////////////////////////////////////
// СЛУЖЕБНЫЕ ФУНКЦИИ

# Значения по умолчанию для мини версии
if (!is_file(dirname(__FILE__) . '/modules/C_Payment.php'))
	$config['payments']['a1pay']['enabled'] = $config['payments']['robokassa']['enabled'] = $config['payments']['interkassa']['enabled'] = $config['payments']['liqpay']['enabled'] = $config['payments']['rbkmoney']['enabled'] = false;
	
if (!is_file(dirname(__FILE__) . '/modules/M_Discounts.inc.php'))
	$config['discounts']['enabled'] = $config['codes']['enabled'] = false;
	
# Удаление отключённых методов оплаты и доставки
foreach ($config['payments'] as $key => $type)
	if ($type['enabled'] == false)
		unset($config['payments'][$key]);

foreach ($config['deliveries'] as $key => $type)
	if ($type['enabled'] == false)
		unset($config['deliveries'][$key]);

////////////////////////////////////////////////////////////////////////////////
// НАСТРОЙКА ПОЛЕЙ ЗАКАЗА

$config['form']['email']['label']			= 'E-mail'; # Название поля
$config['form']['email']['enabled']			= true; # Используется
$config['form']['email']['required']		= true; # Обязательное поле

$config['form']['name']['label']			= 'Имя';
$config['form']['name']['enabled']			= true;
$config['form']['name']['required']			= true;

$config['form']['lastname']['label']		= 'Фамилия:';
$config['form']['lastname']['enabled']		= false;
$config['form']['lastname']['required']		= false;

$config['form']['fathername']['label']		= 'Отчество:';
$config['form']['fathername']['enabled']	= false;
$config['form']['fathername']['required']	= false;

$config['form']['phone']['label']			= 'Телефон';
$config['form']['phone']['enabled']			= true;
$config['form']['phone']['required']		= true;

$config['form']['zip']['label']				= 'Индекс:';
$config['form']['zip']['enabled']			= false;
$config['form']['zip']['required']			= false;

$config['form']['region']['label']			= 'Регион:';
$config['form']['region']['enabled']		= false;
$config['form']['region']['required']		= false;

$config['form']['city']['label']			= 'Город:';
$config['form']['city']['enabled']			= true;
$config['form']['city']['required']			= false;

$config['form']['address']['label']			= 'Адрес доставки';
$config['form']['address']['enabled']		= true;
$config['form']['address']['required']		= false;

$config['form']['comment']['label']			= 'Комментарий:';
$config['form']['comment']['enabled']		= false;
$config['form']['comment']['required']		= false;


////////////////////////////////////////////////////////////////////////////////
// НАСТРОЙКА ПОЛЕЙ ФОРМЫ СООБЩЕНИЯ

$config['feedback']['email']['label']		= 'Email:'; # Название поля
$config['feedback']['email']['enabled']		= true; # Используется
$config['feedback']['email']['required']	= true; # Обязательное поле

$config['feedback']['name']['label']		= 'Имя:';
$config['feedback']['name']['enabled']		= true;
$config['feedback']['name']['required']		= true;

$config['feedback']['phone']['label']		= 'Телефон:';
$config['feedback']['phone']['enabled']		= true;
$config['feedback']['phone']['required']	= true;

$config['feedback']['comment']['label']		= 'Комментарий:';
$config['feedback']['comment']['enabled']	= true;
$config['feedback']['comment']['required']	= false;

////////////////////////////////////////////////////////////////////////////////
// НАСТРОЙКА УВЕДОМЛЕНИЙ

$config['form']['sent']						= '<div class="success"><h1>Спасибо. Ваш заказ успешно принят</h1> </div>'; # Успешная отправка заказа
$config['form']['feedback_sent']			= '<div class="success"><h2>Спасибо. Ваше сообщение отправлено</h2> </div>'; # Успешная отправка фидбека
$config['form']['notSent']					= 'Извините, письмо не было отправлено. Пожалуйста, повторите отправку.'; # Неудачная отправка
$config['form']['isSpam']					= 'Не спамер ли вы часом?!'; # СПАМ!
$config['form']['emptyQty']					= 'Извините, количество нужно обязательно ввести.'; # Нет мыла!
$config['form']['emptyEmail']				= 'Извините, e-mail не введён либо его формат неверен.'; # Нет мыла!
$config['form']['emptyName']				= 'Извините, имя не введено либо его формат неверен.'; # Нет имени!
$config['form']['emptyPhone']				= 'Извините, телефон не введён либо его формат неверен.'; # Нет телефона!
$config['form']['emptyAddress']				= 'Извините, адрес не введён либо его формат неверен.'; # Нет адреса!
$config['form']['downloadSent']				= '<h3>Просто проверьте почту!</h3><h4>Письмо со ссылкой должно прийти в течении нескольких минут!</h4>'; # Ссылка отправлена
$config['form']['noUpdate']					= 'Видимо вы ещё не оплатили ваш заказ. Либо не заказывали данный товар вообще.<br> Обратитесь к администратору'; # Обновление не удалось

////////////////////////////////////////////////////////////////////////////////
// СТАТУСЫ ЗАКАЗОВ

$config['statuses']							= array (0 => 'Новый', 1 => 'Обработан', 2 => 'Отправлен', 3 => 'Доставлен', 4 => 'Оплачен', 5 => 'Возврат', 6 => 'Отменён', 7 => 'Удалён'); # Массив всех статусов заказа
$config['statuses']['delivered']			= array(3); # Успешная доставка
$config['statuses']['success']				= array(4); # Успешная покупка
$config['statuses']['refund']				= array(5); # Возврат
$config['statuses']['fail']					= array(6); # Неуспешная покупка
$config['statuses']['deleted']				= array(7); # Удалён

////////////////////////////////////////////////////////////////////////////////
// НАСТРОЙКА АДМИНКИ

$config['admin']['login']					= 'demo'; # Логин админки
$config['admin']['password']				= 'fe01ce2a7fbac8fafaed7c982a04e229'; # Пароль админки. Хранится в зашифрованом виде. Получить шифр пароля можно здесь: http://pr-cy.ru/md5
$config['admin']['ordersList']				= '20'; # Количество заказов в списке админки
$config['admin']['productsList']			= '10'; # Количество товаров в списке админки
$config['admin']['report1List']				= '20'; # Количество строк в первом отчёте
$config['admin']['report2List']				= '14'; # Количество строк во втором отчёте

////////////////////////////////////////////////////////////////////////////////
// НАСТРОЙКА ПОЛЕЙ ТОВАРА

$config['product']['code']					= 'ag70';
$config['product']['title']					= 'Автогермесил туба 70г';
$config['product']['price']					= '33';
$config['product']['discount']				= '';
$config['product']['qty']					= '1';
$config['product']['unit']					= 'шт.';
$config['product']['qty_type']				= 'text';
$config['product']['param1']				= 'Автогермесил туба 160г';
$config['product']['param2']				= '70';
$config['product']['param3']				= '';
$config['product']['description']			= '';
$config['product']['form_type']				= 'button'; # 2 варианта вывода формы: form или button

////////////////////////////////////////////////////////////////////////////////
// НАСТРОЙКА ЦИФРОВЫХ ТОВАРОВ

$config['download']['enabled']				= false; # Загрузка файлов включена?
$config['download']['uses']					= 3; # Количество скачиваний по ссылке
$config['download']['hours']				= 24; # Количество часов действия ссылки
$config['download']['dir']					= 'files'; # Папка с файлами товаров
$config['download']['type']					= 'zip'; # Расширение файлов

////////////////////////////////////////////////////////////////////////////////
// ДОПОЛНИТЕЛЬНЫЕ НАСТРОЙКИ ТОВАРОВ

$config['products']['base2pro']				= false; # Подхватывать старый код по id и выводить данные из БД
$config['button']['order']					= 'Заказать'; # Надпись кнопки заказа
$config['button']['feedback']				= 'Сообщение'; # Надпись кнопки обратной связи

////////////////////////////////////////////////////////////////////////////////
// НАСТРОЙКИ ОТСЛЕЖИВАНИЯ ПОСЫЛОК

$config['track']['enabled']					= false; # Включить отслеживание посылок?
$config['track']['provider']				= 'RussianPost'; # Почта России

////////////////////////////////////////////////////////////////////////////////
// НАСТРОЙКИ SMS УВЕДОМЛЕНИЙ

$config['sms']['enabled']					= false; # Включить SMS уведомления?
$config['sms']['provider']					= 'SMSru'; # Оператор. Варианты: AlphaSMS (укр.), SMSru (рус.)
$config['sms']['api_key']					= ''; # Ключ API (нужно взять в интерфейсе оператора)
$config['sms']['phone']						= ''; # Номер для отправки SMS в международном формате (пример: +380671234567)
$config['sms']['name']						= ''; # Имя отправителя (пример: SITE)

////////////////////////////////////////////////////////////////////////////////
// НАСТРОЙКИ ОТЧЁТОВ

$config['reports']['enabled']				= false; # Использовать отчёты

# Себестоимость товара
$config['product_price']['ag70']			= 25; # В валюте магазина

# Статистика Яндекс.Директа
$config['yandex']['login']					= ''; # Логин, под которым создана рекламная кампания
$config['yandex']['campaign_id']			= array(''); # Массив идентификаторов рекламных кампаний
$config['yandex']['application_id']			= ''; # Идентификатор приложения
$config['yandex']['token']					= ''; # Токен
$config['yandex']['currency_rate']			= 30; # Курс доллара к валюте магазина по версии Яндекса
$config['yandex']['status_change']			= false; # Автоматическая смена статуса заказа (например, при обновлённом статусе трека Возврат, статус заказа автоматически сменится на Возврат)   

////////////////////////////////////////////////////////////////////////////////
// НАСТРОЙКИ ПЕЧАТИ БЛАНКОВ

$config['print']['enabled']					= false;
$config['print']['fio']						= 'Опанасенко Алексею Сергеевичу'; # ФИО 
$config['print']['address']					= 'г. Чернигов, ул. Ленина, д. 12 кв. 23'; # Адрес
$config['print']['zip']						= '1 4 0 0 0'; # Индекс
$config['print']['code']					= '1 2 3 1 2 3 1 2 3 1 2 3'; # ИНН
$config['print']['account']					= '1 2 3 1 2 3 2 3 2 1 3 1 2 3 1 2 3 1 2 3'; # Кор/счёт
$config['print']['bank']					= 'Филиал ОАО ПриватБанк'; # Наименование банка
$config['print']['bank_account']			= '1 2 3 1 2 3 2 3 2 1 3 1 2 3 1 2 3 1 2 3'; # Рас/счёт банка
$config['print']['bik']						= '1 2 3 1 2 3 1 2 3'; # БИК