<?php
/* Template Name: Start page */

get_header();
?>
<body>
<!--header section start -->
<div class="header_section" style="background-image: url('<?php echo get_field('acf_startpage_banner_image')['url']; ?>'">
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
<!--about section start -->
<div class="about_section layout_padding">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1 class="about_taital"><?php echo get_field('acf_start_page_about_us_title'); ?></h1>
                <p class="about_text"><?php echo get_field('acf_start_page_about_us_text'); ?></p>
                <div class="read_bt">
                    <a href="<?php echo get_field('acf_start_page_about_us_button_url')['guid']; ?>">
                        <?php echo get_field('acf_start_page_about_us_button_text'); ?>
                    </a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="image_1"><img src="<?php echo get_theme_file_uri(); ?>/images/img-1.png"></div>
            </div>
        </div>
    </div>
</div>
<!--about section end -->
<!--gallery section start -->
<div class="gallery_section layout_padding">
    <div class="container">
        <h1 class="gallery_taital">Best Quality</h1>
        <p class="gallery_text">It is a long established fact that a reader will be distracted by the readable content</p>
        <div class="gallery_section_2 layout_padding">
            <div class="row">
                <?php

                $products = new WP_Query([
                    'post_type' => 'product',
                    'post_status' => 'publish',
                    'posts_per_page' => 4
                ]);

                ?>
                <?php
                while ($products->have_posts()) {
                    $products->the_post();
                    $product = new WC_Product(get_the_ID());
                ?>
                <div class="col-sm-3">
                    <div class="image_1"><?php echo $product->get_image(); ?></div>
                    <div class="price_text">$<span style="color: #f9ca16;"><?php echo $product->get_regular_price(); ?></span></div>
                    <h1 class="shoes_text"><?php echo $product->get_name(); ?></h1>
                    <div class="add-to-cart-box">
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
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<!--gallery section end -->

<!--news section start -->
<div class="news_section layout_padding">
    <div class="container">
        <h1 class="news_taital"><?php echo get_field('acf_start_page_news_heading'); ?></h1>
        <p class="news_text"><?php echo get_field('acf_start_page_news_text'); ?></p>
        <div class="news_section_2 layout_padding">
            <div class="row">
                <?php

                $newsItems = new WP_Query([
                    'post_type' => 'news',
                    'post_status' => 'publish',
                    'posts_per_page' => 3
                ]);

                ?>
                <?php while($newsItems->have_posts()) {
                $newsItems->the_post();
                ?>
                <div class="col-lg-4 col-sm-12">
                    <div><img src="<?php echo get_the_guid(get_post_meta(get_the_id(), 'acf_start_page_news_item_image', true)); ?>"class="image_6"></div>
                    <h1 class="shoes_taital_1"><?php echo get_post_meta(get_the_id(), 'acf_start_page_news_item_heading', true); ?></h1>
                    <p class="ipsum_text"><?php echo get_post_meta(get_the_id(), 'acf_start_page_news_items_text', true); ?></p>
                    <div class="read_bt"><a href="<?php echo get_post_meta(get_the_id(), 'acf_start_page_news_items_button_link', true); ?>"><?php echo get_post_meta(get_the_id(), 'acf_start_page_news_items_button_text', true); ?></a></div>
                </div>
                <?php
                }
                wp_reset_postdata();
                ?>
            </div>
        </div>
    </div>
</div>
<!--news section end -->

<!--contact section start -->
<div class="contact_section layout_padding">
    <div class="container">
        <h1 class="touch_taital">Get In Touch</h1>
        <div class="contact_section_2">
            <div class="row">
                <div class="col-md-6">
                    <div class="email_text">
                        <div class="form-group">
                            <input type="text" class="email-bt" placeholder="Name" name="Email">
                        </div>
                        <div class="form-group">
                            <input type="text" class="email-bt" placeholder="Email" name="Email">
                        </div>
                        <div class="form-group">
                            <input type="text" class="email-bt" placeholder="Phone Numbar" name="Email">
                        </div>
                        <div class="form-group">
                            <textarea class="massage-bt" placeholder="Massage" rows="5" id="comment" name="Massage"></textarea>
                        </div>
                        <div class="send_btn"><a href="#">SEND</a></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="map_main">
                        <div class="map-responsive">
                            <iframe src="https://www.google.com/maps/embed/v1/place?key=AIzaSyA0s1a7phLN0iaD6-UE7m4qP-z21pH0eSc&amp;q=Eiffel+Tower+Paris+France" width="600" height="370" frameborder="0" style="border:0; width: 100%;" allowfullscreen=""></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--contact section end -->
<!--newsletter section start -->
<div class="newsletter_section">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h1 class="newsletter_text">Follow us</h1>
            </div>
            <div class="col-md-4">
                <div class="social_icon">
                    <ul>
                        <?php if(get_field('acf_follow_us_facebook') !== "") { ?>
                        <li><a href="<?php echo get_field('acf_follow_us_facebook'); ?>"><img src="<?php echo get_theme_file_uri(); ?>/images/fb-icon.png"></a></li>
                        <?php } ?>
                        <?php if(get_field('acf_follow_us_twitter') !== "") { ?>
                        <li><a href="<?php echo get_field('acf_follow_us_twitter'); ?>"><img src="<?php echo get_theme_file_uri(); ?>/images/twitter-icon.png"></a></li>
                        <?php } ?>
                        <?php if(get_field('acf_follow_us_linkedin') !== "") { ?>
                        <li><a href="<?php echo get_field('acf_follow_us_linkedin'); ?>"><img src="<?php echo get_theme_file_uri(); ?>/images/linkedin-icon.png"></a></li>
                        <?php } ?>
                        <?php if(get_field('acf_follow_us_instagram') !== "") { ?>
                        <li><a href="<?php echo get_field('acf_follow_us_instagram'); ?>"><img src="<?php echo get_theme_file_uri(); ?>/images/instagram-icon.png"></a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--newsletter section end -->
<?php get_footer(); ?>

