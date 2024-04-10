<?php
/* Template Name: Cart */
get_header();
?>
<!--header section start -->
<div class="header_section mb-5" style="background-image: url('<?php echo get_theme_file_uri(); ?>/images/running_track.jpg')">
    <div class="container-fluid">
        <?php echo get_template_part('/template-parts/header-template-part'); ?>
    </div>
    <div class="banner_section">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="container">
                        <h1 class="banner_taital"><?php echo get_field('acf_start_page_banner_heading'); ?></h1>
                        <p class="lorem_text"><?php echo get_field('acf_start_page_banner_text'); ?></p>
                        <?php if(get_field('acf_show_call_to_action_button') == true) { ?>
                            <div class="buy_bt"><a href="<?php echo get_field('acf_call_to_action_button_link')['guid']; ?>">
                                    <?php echo get_field('acf_call_to_action_button_text'); ?>
                                </a></div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--header section end -->
<!--cart section start -->
<section class="cart_section mb-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Your cart</h2>
                <hr/>
            </div>
        </div>
        <div class="row">
            <?php if(!empty(WC()->cart->get_cart_contents())) { ?>
            <div class="col-md-8">
                <?php

                $items = WC()->cart->get_cart_contents();
                foreach($items as $item) {
                    $product = wc_get_product($item['product_id']);
                    ?>
                    <div class="card mb-2 product-<?php echo $product->get_id(); ?>">
                        <div class="row no-gutters">
                            <div class="col-auto">
                                <img src="<?php echo wp_get_attachment_url($product->get_image_id()); ?>" class="cart-image">
                            </div>
                            <div class="col" style="align-content: center; margin-top: 1.5rem;">
                                <div class="card-block px-2">
                                    <h4 class="card-title">
                                        <?php echo $product->get_name(); ?>
                                    </h4>
                                </div>
                            </div>
                            <div class="col" style="align-content: center; margin-top: 1.5rem;">
                                <div class="card-block px-2">
                                    <?php if(!empty($product->get_sale_price()) && $product->get_sale_price() < $product->get_regular_price()) { ?>
                                        <h4 class="card-title">
                                            $<?php echo $item['quantity'] * $product->get_sale_price(); ?><br/>
                                            <s>$<?php echo $item['quantity'] * $product->get_regular_price(); ?></s>
                                        </h4>
                                    <?php } else { ?>
                                        <h4 class="card-title">
                                            $<?php echo $item['quantity'] * $product->get_regular_price(); ?>
                                        </h4>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="col" style="align-content: center;">
                                <form method="get">
                                    <div class="row">
                                        <div class="add-to-cart-quantity">
                                            <div class="input-group">
                                        <span>
                                            <button type="button" class="cart-quantity-left-minus btn btn-transparent btn-number" data-product-id="<?php echo $product->get_id(); ?>" data-product-key="<?php echo $item['key']; ?>">
                                                <span class="fa fa-minus"></span>
                                            </button>
                                            <input type="hidden" name="add-to-cart" value="<?php echo $product->get_id(); ?>" />
                                            <input id="quantity" type="text" name="quantity" class="form-control input-number cart-product-<?php echo $product->get_id(); ?>" value="<?php echo $item['quantity']; ?>" min="1" max="100"/>
                                            <button type="button" class="cart-quantity-right-plus btn btn-transparent btn-number" data-product-id="<?php echo $product->get_id(); ?>" data-product-key="<?php echo $item['key']; ?>">
                                                <span class="fa fa-plus"></span>
                                            </button>
                                        </span>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col" style="align-content: center; margin-top: 0.5rem; margin-left: 3rem;">
                                <div class="card-block px-2">
                                    <h2><i class="fa fa-trash-o remove-product" data-product-id="<?php echo $product->get_id(); ?>"></i></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }

                ?>
            </div>
            <div class="col-md-4">
                <?php if(empty(WC()->cart->get_applied_coupons())) { ?>
                <h3>Cupon code</h3>
                <form id="couponcode">
                    <input type="text" name="coupon_code" id="coupon_code"/>
                    <button type="submit" class="boy_bt_1">Apply coupon code</button>
                </form>
                <hr style="margin-top: 4rem;"/>
                <?php } ?>
                <h3>Summary</h3>
                <?php

                $appliedCoupons = WC()->cart->get_applied_coupons();
                foreach($appliedCoupons as $couponCode) {
                    $coupon = new WC_Coupon($couponCode);
                    ?>
                    <hr/>
                    <h4>Applied Coupons: <?php echo $coupon->amount.' '.$coupon->discount_type; ?></h4>
                    <?php
                }

                ?>
                <hr/>
                <h4 class="subtotal">Sub total: <?php echo WC()->cart->get_total_ex_tax(); ?></h4>
                <hr/>
                <h4 class="total">Total amount: <?php echo WC()->cart->get_cart_total(); ?></h4>
                <a href="<?php echo WC()->cart->get_checkout_url(); ?>" class="boy_bt_1">Go to checkout</a>
            </div>
            <?php } else { ?>
            <div class="col-md-12">
                <h3>Ops, it looks like your cart is empty.</h3>
            </div>
            <?php } ?>
        </div>
        <div class="row">
            <div class="col-md-12">
                <hr/>
                <h3>On Sale!</h3>
            </div>
            <?php

            $campaignProducts = new WP_Query(array(
                'post_type' => 'product',
                'post_status' => 'publish',
                'posts_per_page' => 4,
                'meta_query' => array (
                    array(
                        'key' => 'acf_campaign_product',
                        'value' => '1',
                        'compare' => '='
                    )
                )
            ));

            while($campaignProducts->have_posts()) {
                $campaignProducts->the_post();
                $campaignProduct = new WC_Product(get_the_ID());
                ?>
                <?php if(!empty($campaignProduct->get_sale_price()) && $campaignProduct->get_sale_price() < $campaignProduct->get_regular_price()) { ?>
                <div class="col-md-3">
                    <a href="<?php echo get_the_permalink($campaignProduct->get_id()); ?>">
                        <img src="<?php echo wp_get_attachment_url($campaignProduct->get_image_id()); ?>"/>
                    </a>
                    <form method="get">
                        <div class="row">
                            <div class="col-md-6 pr-0">
                                <div class="add-to-cart-quantity">
                                    <div class="input-group">
                                            <span>
                                                <button type="button" class="quantity-left-minus btn btn-transparent btn-number" data-product-id="<?php echo $campaignProduct->get_id(); ?>">
                                                    <span class="fa fa-minus"></span>
                                                </button>
                                                <input type="hidden" name="add-to-cart" value="<?php echo $campaignProduct->get_id(); ?>" />
                                                <input id="quantity" type="text" name="quanity" class="form-control input-number product-<?php echo $campaignProduct->get_id(); ?>" value="1" min="1" max="100"/>
                                                <button type="button" class="quantity-right-plus btn btn-transparent btn-number" data-product-id="<?php echo $campaignProduct->get_id(); ?>">
                                                    <span class="fa fa-plus"></span>
                                                </button>
                                            </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 pl-0">
                                <div class="buy-button-box">
                                    <button type="submit" class="boy_bt_1">Buy Now</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <?php } ?>
                <?php
            }
            wp_reset_postdata();
            ?>
        </div>
    </div>
</section>
<!--cart section end -->
<?php get_footer(); ?>