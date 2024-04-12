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

	$('.cart-quantity-right-plus').on('click', function(e) {
		e.preventDefault();

		let productId = $(this).attr('data-product-id');
		let productKey = $(this).attr('data-product-key');

		let quantity = parseInt($('.cart-product-'+productId).val());

		if(quantity > 99) {
			quantity = 99;
		} else {
			$.ajax({
				type: 'POST',
				dataType: 'json',
				url: '/wp-admin/admin-ajax.php',
				data: {
					action: 'change_cart_item_quantity',
					productKey: productKey,
					quantity: quantity + 1
				}, success: function(response) {
					$('a.header_cart > span > span').replaceWith(response.data.total);
					$('h4.subtotal > span').replaceWith(response.data.subtotal);
					$('h4.total > span').replaceWith(response.data.total);
					$('.cart-product-'+productId).val(quantity + 1);
				}
			});
		}

	});

	$('.cart-quantity-left-minus').on('click', function(e) {
		e.preventDefault();

		let productId = $(this).attr('data-product-id');
		let productKey = $(this).attr('data-product-key');

		let quantity = parseInt($('.cart-product-'+productId).val());

		if(quantity < 1) {
			quantity = 1;
		} else {
			$.ajax({
				type: 'POST',
				dataType: 'json',
				url: '/wp-admin/admin-ajax.php',
				data: {
					action: 'change_cart_item_quantity',
					productKey: productKey,
					quantity: quantity - 1
				}, success: function(response) {
					$('a.header_cart > span > span').replaceWith(response.data.total);
					$('h4.subtotal > span').replaceWith(response.data.subtotal);
					$('h4.total > span').replaceWith(response.data.total);
					$('.cart-product-'+productId).val(quantity - 1);
				}
			});
		}
	});

	$('form#couponcode').submit(function(e) {
		e.preventDefault();
		let coupon = $('#coupon_code').val();

		$.ajax({
			type: 'POST',
			dataType: 'json',
			url: '/wp-admin/admin-ajax.php',
			data: {
				action: 'apply_coupons',
				couponCode: coupon
			}, success: function(response) {
				$('#coupon_code').val('');
				location.reload();
			}
		});
	});

	$('.search_icon > a').on('click', function(e) {
		e.preventDefault();
		$('.modal').show();
		$('body').css('overflow-y', 'hidden');
	});

	$('.modal-content > span.close').on('click', function(e) {
		e.preventDefault();
		$('.modal').hide();
		$('body').attr('style', '');
	})

	$('.site-search').keyup(function() {
		let searchValue = $('.site-search').val();
		let searchLength = searchValue.length;
		let previousValue = "";

		if(searchLength >= 3) {
			$.getJSON(themeData.root_url + '/wp-json/myshoes/v1/search/?query=' + searchValue,
				(results) => {
				if(searchValue !== previousValue) {
					$('.search-results').html(`
					<hr/>
					${results.product ? results.product.map((item) => `
					<a href="${item.product_link}">
						<div class="card mb-2 product-<?php echo $product->get_id(); ?>">
							<div class="row no-gutters">
								<div class="col-auto">
									<img src="${item.product_image}" class="cart-image">
								</div>
								<div class="col" style="align-content: center; margin-top: 1.5rem;">
									<div class="card-block px-2">
										<h4 class="card-title">
											${item.product_name}
										</h4>
									</div>
								</div>
								<div class="col" style="align-content: center; margin-top: 1.5rem;">
										<h4 class="card-title">
											${item.product_price} ${item.shop_currency}
										</h4>
								</div>
								<div class="col" style="align-content: center; margin-top: 1.5rem;">
										<h4 class="card-title">
											Left in stock ${item.product_stock}
										</h4>
								</div>
							</div>
						</div>
                    </a>
					`).join("")
					: '<p>The product you were looking for could not be found.</p>'
					}
					`)
				}
			});
		}
	});
});