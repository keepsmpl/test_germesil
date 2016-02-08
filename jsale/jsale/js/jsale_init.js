// jSale 1.37
// http://jsale.biz

jQuery(document).ready(function($) {

	var key = 0;
	$('.jSale').each(function() {
		key++;
		
		$(this).load(sitelink + dir + 'jsale.php', { product : products[key], id: key });
		
	});

	$('.jSaleFeedback').load(sitelink + dir + 'feedback/feedback.php');
});