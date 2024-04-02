<?php
defined('ABSPATH') || exit;
get_header();
?>
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
<div class="container">
    <div class="row">
        <?php
            global $wp;
            $current_url = $wp->request;
            $post_slug = substr($current_url, strpos($current_url, '/') + 1);
            $category = get_term_by('slug', $post_slug, 'product_cat');
            $cat_id = $category->term_id;

            $products = new WP_Query([
               'post_type'      => 'product',
               'post_status'    => 'publish',
               'ignore_sticky_posts' => true,
               'posts_per_page'      => 15,
               'tax_query' => [
                    [
                        'taxonomy'   => 'product_cat',
                        'field'      => 'term_id',
                        'terms'      => $cat_id,
                        'operator'   => 'IN'
                    ]
               ]
            ]);

            while($products->have_posts()) {
                $products->the_post();
                $product = new WC_Product(get_the_ID());
                ?>
                <div class="col-md-3 mt-5 mb-5">
                    <img src="<?php echo wp_get_attachment_url($product->get_image_id()); ?>"/>
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
                </div>
                <?php
            }
        ?>
    </div>
    </div>
</div>

<?php
get_footer();