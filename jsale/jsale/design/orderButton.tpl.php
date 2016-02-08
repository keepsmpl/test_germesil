<?= (isset($product['description'])) ? $product['description'] : '' ?>

<? if ($product['form_type'] == 'form'): ?>
	<div class="jSaleWrapper">
	<?= $orderForm; ?>
	</div>
<? else: ?>
	<span class="jSaleOrder jSaleButton"><?= $button_text ?></span>
	<div class="jSaleWindow" style="display: none;">
		<?= $orderForm; ?>
	</div>
<? endif; ?>