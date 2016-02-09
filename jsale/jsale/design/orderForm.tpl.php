<form action="<?= $config['sitelink'] . $config['dir'] ?>relay.php" method="post" class="jSaleForm" id="jsale_form_<?= $id_form ?>">
	<? if (isset($message)): ?>
	<h6 class="jSaleMessage">
		<?= $message; ?>
	</h6>
	<? else: ?>
	<h6>
		Оформление заказа: <?= $product['title']; ?>
	</h6>
	<? endif; ?>
	<? if ($config['form']['lastname']['enabled'] == true): ?>
	<p class="float">
		<label><?= $config['form']['lastname']['label'];?><? if ($config['form']['lastname']['required'] == true): ?><span class="attention" title="Поле, обязательное к заполнению">*</span><? endif;?></label><br>
		<input type="text" name="order_lastname" value="<?= (isset($lastname)) ? $lastname : '';?>">
	</p>
	<? endif; ?>
	<? if ($config['form']['name']['enabled'] == true): ?>
	<p class="float">
		<label><?= $config['form']['name']['label'];?><? if ($config['form']['name']['required'] == true): ?><span class="attention" title="Поле, обязательное к заполнению">*</span><? endif;?></label><br>
		<input type="text" name="order_name" value="<?= (isset($name)) ? $name : '';?>">
	</p>
	<? endif; ?>
	<? if ($config['form']['fathername']['enabled'] == true): ?>
	<p class="float">
		<label><?= $config['form']['fathername']['label'];?><? if ($config['form']['fathername']['required'] == true): ?><span class="attention" title="Поле, обязательное к заполнению">*</span><? endif;?></label><br>
		<input type="text" name="order_fathername" value="<?= (isset($fathername)) ? $fathername : '';?>">
	</p>
	<? endif; ?>
	<? if ($config['form']['email']['enabled'] == true): ?>
	<p class="float">
		<label><?= $config['form']['email']['label'];?><? if ($config['form']['email']['required'] == true): ?><span class="attention" title="Поле, обязательное к заполнению">*</span><? endif;?></label><br>
		<input type="text" name="order_email" value="<?= (isset($email)) ? $email : '';?>">
	</p>
	<? endif; ?>
	<? if ($config['form']['phone']['enabled'] == true): ?>
	<p class="float">
		<label><?= $config['form']['phone']['label'];?><? if ($config['form']['phone']['required'] == true): ?><span class="attention" title="Поле, обязательное к заполнению">*</span><? endif;?></label><br>
		<input type="text" name="order_phone" value="<?= (isset($phone)) ? $phone : '';?>">
	</p>
	<? endif; ?>
	<? if ($config['form']['zip']['enabled'] == true): ?>
	<div class="clear"></div>
	<p class="float">
		<label><?= $config['form']['zip']['label'];?><? if ($config['form']['zip']['required'] == true): ?><span class="attention" title="Поле, обязательное к заполнению">*</span><? endif;?></label><br>
		<input type="text" name="order_zip" value="<?= (isset($zip)) ? $zip : '';?>">
	</p>
	<? endif; ?>
	<? if ($config['form']['region']['enabled'] == true): ?>
	<p class="float">
		<label><?= $config['form']['region']['label'];?><? if ($config['form']['region']['required'] == true): ?><span class="attention" title="Поле, обязательное к заполнению">*</span><? endif;?></label><br>
		<input type="text" name="order_region" value="<?= (isset($region)) ? $region : '';?>">
	</p>
	<? endif; ?>
	<? if ($config['form']['city']['enabled'] == true): ?>
	<p class="float">
		<label><?= $config['form']['city']['label'];?><? if ($config['form']['city']['required'] == true): ?><span class="attention" title="Поле, обязательное к заполнению">*</span><? endif;?></label><br>
		<input type="text" name="order_city" value="<?= (isset($city)) ? $city : '';?>">
	</p>
	<? endif; ?>
	<? if ($config['form']['address']['enabled'] == true): ?>
	<p>
		<label><?= $config['form']['address']['label'];?><? if ($config['form']['address']['required'] == true): ?><span class="attention" title="Поле, обязательное к заполнению">*</span><? endif;?></label><br>
		<textarea name="order_address"><?= (isset($address)) ? $address : '';?></textarea>
	</p>
	<? endif; ?>
	<? if ($config['form']['comment']['enabled'] == true): ?>
	<p>
		<label><?= $config['form']['comment']['label'];?><? if ($config['form']['comment']['required'] == true): ?><span class="attention" title="Поле, обязательное к заполнению">*</span><? endif;?></label><br>
		<textarea name="order_comment"><?= (isset($comment)) ? $comment : '';?></textarea>
	</p>
	<? endif; ?>
	<? if (count($config['payments']) > 1 || $config['deliveries_view'] == true): ?>
		<p>
		<label>Выбор метода оплаты:</label>
        <select name="order_payment" onchange="show_payment_info(this);">
            <? foreach ($config['payments'] as $type => $payment): ?>
            <? if ($payment['enabled'] == true): ?>
            <option value="<?= $type ?>"<? if (isset($payment_type) && $type == $payment_type): ?> selected="selected"<? endif; ?>><?= $payment['title'] ?></option>
            <? endif; ?>
            <? endforeach; ?>
        </select>
		</p>

        <div id="payment_info">
        <? foreach ($config['payments'] as $type => $payment): ?>
            <? if ($payment['enabled'] == true): ?>
            <p class="<?= $type ?>"><?= $payment['info'] ?></p>
            <? endif; ?>
        <? endforeach; ?>
        </div>
	<? else: ?>
	<input type="hidden" name="order_payment" value="<? reset($config['payments']); echo key($config['payments']);?>">
	<? endif; ?>
	<? if (count($config['deliveries']) > 1 || $config['deliveries_view'] == true): ?>
		<p>
		<label>Выбор способа доставки:</label>
        <select name="order_delivery" onchange="show_delivery_info_<?= $id_form ?>(this);">
            <? foreach ($config['deliveries'] as $type => $delivery): ?>
            <? if ($delivery['enabled'] == true): ?>
            <option value="<?= $type ?>"<? if (isset($delivery_type) && $type == $delivery_type): ?> selected="selected"<? endif; ?>><?= $delivery['title'] ?></option>
            <? endif; ?>
            <? endforeach; ?>
        </select>
		</p>

        <div id="delivery_info">
        <? foreach ($config['deliveries'] as $type => $delivery): ?>
            <? if ($delivery['enabled'] == true): ?>
            <p class="<?= $type ?>"><?= $delivery['info'] ?></p>
            <? endif; ?>
        <? endforeach; ?>
        </div>
	<? else: ?>
	<input type="hidden" name="order_delivery" value="<? reset($config['deliveries']); echo key($config['deliveries']);?>">
	<? endif; ?>

	<p>
	<? if ($config['codes']['enabled'] === true): ?>
		<label>Промо-код:</label>
		<input type="text" name="order_code" value="<?= (isset($_COOKIE['jsale_ref']) && !isset($code)) ? $_COOKIE['jsale_ref'] : $code ?>" class="jSaleCode">
	<? else: ?>
		<input type="hidden" name="order_code" value="<?= (isset($_COOKIE['jsale_ref']) && !isset($code)) ? $_COOKIE['jsale_ref'] : $code ?>" class="jSaleCode">
	<? endif; ?>
	<? if (isset($discount) && $discount != 0): ?>
		<span class="attention ">
			Ваша скидка: <?= $discount;?> <?if ($config['discounts']['fixed'] === true):?><?= $config['currency'] ?><? else: ?>%<? endif; ?> Ваша цена: <span id="subtotal"><?= number_format($order_sum, 2, '.', '');?></span> <?= $config['currency'];?>
		</span>
	<? else: ?>
		Стоимость заказа: <span id="subtotal"><?= $order_sum ?></span> <?= $config['currency'];?>
	<? endif; ?>
	</p>
	
	<p class="submit">
		<? if ($product['qty_type'] == 'text'): ?>
		<label>Введите количество:</label>
		<input type="text" size="7" name="product_qty" value="<?= $product['qty']; ?>" class="jSaleQty"> <?= $product['unit']; ?>
		<? else: ?>
		<input type="hidden" name="product_qty" value="<?= $product['qty']; ?>">
		<? endif; ?>

		<input type="submit" name="order_submit" value="Отправить заказ" class="jSaleSubmit jSaleButton jSaleLarge">

		<input type="hidden" name="order_spam" value="<?= $antispam ?>">
		<input type="hidden" name="order_nospam" value="">
		<input type="hidden" name="hash" value="<?= $product['hash']; ?>">

		<input type="hidden" name="product_id" value="<?= (isset($product['id'])) ? $product['id'] : '' ?>">
		<input type="hidden" name="product_code" value="<?= $product['code']; ?>">
		<input type="hidden" name="product_title" value="<?= $product['title']; ?>">
		<input type="hidden" name="product_price" value="<?= $product['price']; ?>">
		<input type="hidden" name="product_discount" value="<?= $product['discount']; ?>">
		<input type="hidden" name="product_unit" value="<?= $product['unit']; ?>">
		<input type="hidden" name="product_param1" value="<?= (isset($product['param1'])) ? $product['param1'] : ''; ?>">
		<input type="hidden" name="product_param2" value="<?= (isset($product['param2'])) ? $product['param2'] : ''; ?>">
		<input type="hidden" name="product_param3" value="<?= (isset($product['param3'])) ? $product['param3'] : ''; ?>">
		<input type="hidden" name="template" value="<? preg_match('/orderForm\_(.*).tpl.php/', __FILE__, $file); if (isset($file[1])) echo $file[1]; ?>">
		<input type="hidden" name="form_type" value="<?= $product['form_type'] ?>">

		<input type="hidden" name="delivery_cost" value="<?= (isset($delivery_type) && $config['deliveries'][$delivery_type]['cost'] != '') ? $config['deliveries'][$delivery_type]['cost'] : 0 ?>">
		<input type="hidden" name="id_form" value="<?= $id_form ?>">

		<input type="hidden" name="product_qty_type" value="<?= $product['qty_type']; ?>">
		
		
	</p>
</form>
<script type="text/javascript">
function show_payment_info(select)
{
	var payments = eval(<?= json_encode($config['payments']) ?>);
	var orderPayment = (select == '<?= $payment_type;?>') ? '<?= $payment_type;?>' : select.value;
	
	for (var key in payments)
	{
		jQuery('.jSaleForm #payment_info .' + key).css('display', 'none');

		if (key === orderPayment)
			jQuery('.jSaleForm #payment_info .' + key).css('display', 'block');
	}
}

function show_delivery_info_<?= $id_form ?>(select)
{
	var deliveries = eval(<?= json_encode($config['deliveries']) ?>);
	var orderDelivery = (select == '<?= $delivery_type;?>') ? '<?= $delivery_type;?>' : select.value;

	var cost = parseFloat(deliveries[orderDelivery]['cost']);
	var prev_cost = jQuery('#jsale_form_<?= $id_form ?>').find('[name="delivery_cost"]').val();

	if (cost != prev_cost)
		jQuery('#jsale_form_<?= $id_form ?>').find('.jSaleQty').trigger('keyup');

	for (var key in deliveries)
	{
		jQuery('.jSaleForm #delivery_info .' + key).css('display', 'none');

		if (key === orderDelivery)
			jQuery('.jSaleForm #delivery_info .' + key).css('display', 'block');
	}
}

show_payment_info('<?= $payment_type;?>');
show_delivery_info_<?= $id_form ?>('<?= $delivery_type;?>');
</script>