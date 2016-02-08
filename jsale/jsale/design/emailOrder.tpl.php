<? if (!$admin): ?>
<?= $config['email']['answerMessageTop'] ?>
<? endif; ?>
<p><strong>Заказ №:</strong> <?= $id_order ?></p>

<h3>Данные заказчика:</h3>
<? if ($lastName || $name || $fatherName): ?>
<p><strong>ФИО:</strong> <?= $lastName ?> <?= $name ?> <?= $fatherName ?></p>
<? endif; ?>
<? if ($email): ?>
<p><strong>E-mail:</strong> <?= $email ?></p>
<? endif; ?>
<? if ($phone): ?>
<p><strong>Телефон:</strong> <?= $phone ?></p>
<? endif; ?>
<? if ($zip || $region || $city || $address): ?>
<p><strong>Адрес:</strong><br>
<? if ($zip): ?><?= $zip ?><? endif; ?>
<? if ($region): ?> <?= $region ?><? endif; ?>
<? if ($city): ?> <?= $city ?><? endif; ?>
<? if ($address): ?> <?= $address ?><? endif; ?></p>
<? endif; ?>
<? if ($comment): ?>
<p><strong>Комментарий:</strong><br><?= $comment ?></p>
<? endif; ?>
<h3>Данные заказа:</h3>

<p>Наименование:
<? if (isset($order_item['url'])): ?>
	<a href="<?= $order_item['url'] ?>"><?= $order_item['title'] ?></a>
<? else: ?>
	<?= $order_item['title'] ?>
<? endif; ?>
<? if ($order_item['param1'] || $order_item['param2'] || $order_item['param3']): ?> (
	<? if ($order_item['param1']): ?> <?= $order_item['param1'] ?> <? endif; ?>
	<? if ($order_item['param2']): ?> <?= $order_item['param2'] ?> <? endif; ?>
	<? if ($order_item['param3']): ?> <?= $order_item['param3'] ?><? endif; ?>
)<? endif; ?>
<br>
Код товара: <?= $order_item['code'] ?><br>
Цена: <?= $order_item['price'] ?> <?= $config['currency'] ?><br>
Количество: <?= $order_item['qty'] ?> <?= $order_item['unit'] ?><br>
<? if (isset($order_item['discount']) && $order_item['discount'] != 0): ?>Ваша скидка: <?= $order_item['discount'] ?> <? if ($config['discounts']['fixed'] === true): ?><?= $config['currency'] ?><? else: ?>%<? endif; ?><br><? endif;?>
Всего:</strong> <?= $order_item['subtotal'] ?> <?= $config['currency'] ?></p>

<p><strong>Сумма заказа:</strong> <?= number_format($order_sum - $delivery['cost'], 2, '.', '') ?> <?= $config['currency'] ?></p>
<p><strong>Форма оплаты:</strong> <?= $payment['title'] ?> – <?= $payment['info'] ?></p>
<? if (isset($payment['link'])): ?>
<p><strong>Оплатить заказ:</strong> <a href="<?= $payment['link'] ?>" title="Оплатить онлайн" target="_blank">к оплате</a></p>
<? endif; ?>
<? if (!empty($payment['details'])): ?>
<p><strong>Реквизиты для оплаты:</strong> <?= $payment['details'] ?></p>
<? endif; ?>
<? if (isset($delivery)): ?>
<p><strong>Cпособ доставки:</strong> <?= $delivery['title'] ?> – <?= $delivery['info'] ?></p>
	<? if (!empty($delivery['cost']) && $delivery['cost'] != 0): ?>
	<p><strong>Стоимость доставки:</strong> <?= $delivery['cost'] ?> <?= $config['currency'] ?></p>
	<p><strong>Итого:</strong> <?= $order_sum ?> <?= $config['currency'] ?></p>
	<? endif; ?>
<? endif; ?>

<p><strong>Данные отправки:</strong><br>
<?= date("d.m.Y") ?><br>
<?= $_SERVER['REMOTE_ADDR'] ?></p>
<? if (!$admin): ?>
<?= $config['email']['answerMessageSignature'] ?>
<? else: ?>
<hr><p><a href="<?= $config['sitelink'] ?>jsale/admin/orders.php?order=<?= $id_order ?>">Редактировать заказ</a></p>
<? endif; ?>