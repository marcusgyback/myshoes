<?php
/*
 * Template Name: Customer orders
 */

if(!is_user_logged_in()) {
    wp_redirect('/customer-login');
    exit();
}

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
<?php
$current_user = wp_get_current_user();
?>
<div class="container">
    <div class="row mb-5 profile">
        <div class="col-md-3">
            <?php echo get_template_part('/template-parts/profile-menu'); ?>
        </div>
        <div class="col-md-9">
            <h3>Your orders</h3>
            <?php

            $args = [
              'customer_id' => $current_user->ID,
              'limit' => -1
            ];

            $orders = wc_get_orders($args);

            foreach ($orders as $order) {
                ?>
                <div class="order-header">
                    <div class="col">#<?php echo $order->get_id(); ?></div>
                    <div class="col"><?php echo date("Y-m-d", strtotime($order->get_date_created())); ?></div>
                    <div class="col"><?php echo $order->get_total(); ?> <?php echo get_woocommerce_currency(); ?></div>
                    <div class="col"><?php echo $order->get_status(); ?></div>
                    <div class="col"><i data-id="<?php echo $order->get_id(); ?>" class="fa fa-arrow-circle-down"></i></div>
                </div>
                <div class="order-body order-<?php echo $order->get_id(); ?>">
                    <?php

                    foreach($order->get_items() as $item_id => $item) {
                        $product = new WC_Product($item['product_id']);
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
                            </div>
                        </div>
                        <?php
                    }

                    ?>
                </div>
                <?php
            }

            ?>
        </div>
    </div>
</div>
<?php
get_footer();