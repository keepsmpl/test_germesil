// jSale 1.37
// http://jsale.biz

//jQuery.noConflict()
jQuery(document).ready(function($) {

	$('body').on('click', '.jSaleOrder', function(e) {
		$(this).parent().children('.jSaleWindow').modal({onOpen: modalOpen, onClose: simplemodal_close, autoResize: true});
	});
			
	$('body').on('keyup', '.jSaleQty', function(e) {

		var newQty = $(this).val();
		var form = $(this).parents('.jSaleForm');
		var form_type = form.find('[name="form_type"]').val();
		
		if (newQty) {
			var updateTimer = window.setTimeout(function() {
				var antispam = form.find('[name="order_spam"]').val();
				form.find('[name="order_nospam"]').val(antispam);
				$.ajax({
					url: form.attr('action'),
					data: form.serialize() + '&action=discount',
					type: 'POST',
					success: function(response) {
						if (form_type == 'button')
							$('.simplemodal-wrap').html(response);
						else
							form.parents('.jSaleWrapper').html(response);
					},
					error: function() {
						alert('Ошибка отправки запроса!');
					}
				});
			}, 100);
		}
		
		$(this).keydown(function(e) {
			if (e.which !== 9) {
				window.clearTimeout(updateTimer);
			}
		});
	});
	
	$('body').on('keyup', '.jSaleCode', function(e) {

		var newCode = $(this).val();
		var form = $(this).parents('.jSaleForm');
		var form_type = form.find('[name="form_type"]').val();
		
		if (newCode) {
			var updateTimer = window.setTimeout(function() {
				var antispam = form.find('[name="order_spam"]').val();
				form.find('[name="order_nospam"]').val(antispam);
				$.ajax({
					url: form.attr('action'),
					data: form.serialize() + '&action=discount',
					type: 'POST',
					success: function(response) {
						if (form_type == 'button')
							$('.simplemodal-wrap').html(response);
						else
							form.parents('.jSaleWrapper').html(response);
					},
					error: function() {
						alert('Ошибка отправки запроса!');
					}
				});
			}, 1000);
		}
		
		$(this).keydown(function(e) {
			if (e.which !== 9) {
				window.clearTimeout(updateTimer);
			}
		});
	});
	
	$('body').on('click', '.jSaleSubmit', function (e) {
		e.preventDefault();
		var form = $(this).parents('.jSaleForm');
		var antispam = form.find('[name="order_spam"]').val();
		var feedback = form.find('[name="feedback"]').val();
		var form_type = form.find('[name="form_type"]').val();
		form.find('[name="order_nospam"]').val(antispam);
		
		$(this).attr('disabled', 'disabled');

		$.ajax({
			url: form.attr('action'),
			data: form.serialize() + '&action=send',
			type: 'POST',
			success: function(response) {
				if (form_type == 'button')
					$('.simplemodal-wrap').html(response);
				else
					form.parents('.jSaleWrapper').html(response);
				
				if (response.indexOf('<!--order_send-->') + 1)
				{
					setTimeout(function() { $.modal.close() }, 2000);
					if (redirect && !feedback)
						setTimeout(function() { window.location.replace(redirect) }, 3000);
				}
			},
			error: function() {
				alert('Ошибка отправки запроса!');
			}
		});
	});
});