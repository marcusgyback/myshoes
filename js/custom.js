/*---------------------------------------------------------------------
    File Name: custom.js
---------------------------------------------------------------------*/

jQuery(function ($) {

	let quantity = 1;
	$('.quantity-left-minus').click(function (e) {
		e.preventDefault();

		let productId = $(this).attr('data-product-id');
		let quantity = parseInt($('.product-'+productId).val());

		if(quantity < 1) {
			quantity = 1;
		} else {
			$('.product-'+productId).val(quantity -1);
		}
	});

	$('.quantity-right-plus').click(function (e) {
		e.preventDefault();

		let productId = $(this).attr('data-product-id');
		let quantity = parseInt($('.product-'+productId).val());

		if(quantity > 99) {
			quantity = 99;
		} else {
			$('.product-'+productId).val(quantity +1);
		}
	});

});