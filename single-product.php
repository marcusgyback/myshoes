<?php
get_header();

$product = new WC_Product(get_the_ID());
$productImages = $product->get_gallery_image_ids();
?>
<body>
<!--header section start -->
<div class="header_section" style="background-image: url('<?php echo get_theme_file_uri(); ?>/images/running_track.jpg')">
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
<!--product section start -->
<section class="single-product-section">
    <div class="container">
        <div class="row pt-5">
            <div class="col-md-7">
                <img src="<?php echo wp_get_attachment_url($product->get_image_id()); ?>" />
            </div>
            <div class="col-md-5">
                <h2><?php echo $product->get_name(); ?></h2>
                <hr/>
                <b>Price: <?php echo $product->get_regular_price(); ?> <?php echo get_woocommerce_currency(); ?></b>
                <hr/>
                <form method="get">
                    <div class="row">
                        <div class="col-md-6 pr-0">
                            <div class="add-to-cart-quantity">
                                <div class="input-group">
                                            <span>
                                                <button type="button" class="quantity-left-minus btn btn-transparent btn-number" data-product-id="<?php echo $product->get_id(); ?>">
                                                    <span class="fa fa-minus"></span>
                                                </button>
                                                <input type="hidden" name="add-to-cart" value="<?php echo $product->get_id(); ?>" />
                                                <input id="quantity" type="text" name="quanity" class="form-control input-number product-<?php echo $product->get_id(); ?>" value="1" min="1" max="100"/>
                                                <button type="button" class="quantity-right-plus btn btn-transparent btn-number" data-product-id="<?php echo $product->get_id(); ?>">
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
                <hr />
                <b>Description:</b><br/>
                <?php

                if(get_post_meta(get_the_ID(), 'acf_product_description', true)) {
                    echo nl2br(get_post_meta(get_the_ID(), 'acf_product_description', true));
                } else {
                    echo "We don't have a description for this product yet";
                }

                ?>
                <?php

                $review = new WP_Query(array(
                    'post_type' => 'reviews',
                    'post_status' => 'publish',
                    'post_parent' => get_the_ID(),
                    'posts_per_page' => 5
                ));

                ?>
                <div class="product-info-btn">
                    <b>Specifications</b>
                    <i class="fa fa-plus"></i>
                </div>
                <hr/>
                <div class="add-review pt-3">
                    <h3>Add a product review</h3>
                    <?php if(is_user_logged_in()) { ?>
                    <form id="reviewForm" class="reviewForm">
                        <label for="name">Name:</label>
                        <input class="reviewinput" type="text" name="name" />
                        <label for="reivew">Review:</label>
                        <textarea class="reviewinput" name="review"></textarea>
                        <input type="hidden" name="userId" value="<?php echo get_current_user_id(); ?>" />
                        <input type="hidden" name="productId" value="<?php echo get_the_ID(); ?>" />
                        <input type="hidden" name="destination" value="<?php echo $_SERVER['REQUEST_URI']; ?>" />
                        <input type="submit" value="Send" />
                    </form>
                    <?php } else { ?>
                    Please login to add a review for this product
                    <?php } ?>
                </div>
                <div class="product-info-btn toggle-product-reviews">
                    <b>Reviews ( <?php echo $review->found_posts; ?> )</b>
                    <i class="fa fa-plus"></i>
                </div>
                <div class="product_reviews">
                    <?php

                    while($review->have_posts()) {
                        $review->the_post();
                        ?>
                        <b>Review from <?php echo get_the_title(); ?></b><br/>
                        <?php echo get_the_content(); ?>
                        <?php if($review->found_posts > 1) {
                            ?>
                            <hr/>
                            <?php
                        }?>
                        <?php
                    }
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-md-12">
                <h2>Recommended products</h2>
                <hr/>
            </div>
            <?php

            $productRecommendations = get_post_meta(get_the_ID(), 'acf_product_recommendations');
            foreach($productRecommendations as $productRecommendation) {
                foreach($productRecommendation as $product_r) {

                    $product_r = new WC_Product($product_r);

                    ?>
                    <div class="col-md-3">
                        <img src="<?php echo wp_get_attachment_url($product_r->get_image_id()); ?>"/>
                        <form method="get">
                            <div class="row">
                                <div class="col-md-6 pr-0">
                                    <div class="add-to-cart-quantity">
                                        <div class="input-group">
                                            <span>
                                                <button type="button" class="quantity-left-minus btn btn-transparent btn-number" data-product-id="<?php echo $product_r->get_id(); ?>">
                                                    <span class="fa fa-minus"></span>
                                                </button>
                                                <input type="hidden" name="add-to-cart" value="<?php echo $product_r->get_id(); ?>" />
                                                <input id="quantity" type="text" name="quanity" class="form-control input-number product-<?php echo $product_r->get_id(); ?>" value="1" min="1" max="100"/>
                                                <button type="button" class="quantity-right-plus btn btn-transparent btn-number" data-product-id="<?php echo $product_r->get_id(); ?>">
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
                    <?php
                }
            }

            ?>
        </div>
    </div>
</section>
<!--header section end -->
<?php get_footer(); ?>
