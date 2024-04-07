/*---------------------------------------------------------------------
    File Name: custom.js
---------------------------------------------------------------------*/

jQuery(function ($) {

	let quantity = 1;
	$('.quantity-left-minus').click(function (e) {
		e.preventDefault();

		let productId = $(this).attr('data-product-id');
		let quantity = parseInt($('.product-'+productId).val());

		if(quantity <= 1) {
			quantity = 1;
			$('.product-'+productId).val(quantity);
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

	$(document).ready(function(){
		$(".slider").bxSlider();
	});

	$('#reviewForm').submit(function (e) {
		e.preventDefault();

		$.ajax({
			url: 'http://myshoes.com/wp-json/myshoes/v1/manageReviews',
			type: 'POST',
			dataType: 'application/json',
			data: $('form#reviewForm').serialize()
		});

		setTimeout(function() {
			window.location.reload();
		}, 1000);
	});

	$('.toggle-product-reviews').on('click', function() {
		$('.product_reviews').toggle();
		$('.toggle-product-reviews i').toggleClass('fa-plus').toggleClass('fa-minus');
	});

	$('.toggle-product-specs').on('click', function() {
		$('.product-specs').toggle();
		$('.toggle-product-specs i').toggleClass('fa-plus').toggleClass('fa-minus');
	});

	$('.remove-product').on('click', function(e) {
		e.preventDefault();

		let productId = $(this).attr('data-product-id');
		$.ajax({
			type: 'POST',
			dataType: 'json',
			url: '/wp-admin/admin-ajax.php',
			data: {action: 'product_remove',
				product_id: productId
			}, success: function(response) {

				$('a.header_cart > span > span').replaceWith(response.data.total);
				$('.product-'+productId).hide();

				$('h4.subtotal > span').replaceWith(response.data.subtotal);
				$('h4.total > span').replaceWith(response.data.total);
			}
		});
	});

});