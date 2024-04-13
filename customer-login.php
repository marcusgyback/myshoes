<?php
/*
 * Template Name: Customer Login
 */
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
<?php
    $args = [
        'redirect' => admin_url(),
        'form_id' => 'customer_login',
        'label_username' => __('Username'),
        'label_password' => __('Password'),
        'remember' => false,
    ];
?>
<?php if(!is_user_logged_in()) { ?>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h3>Login</h3>
            <?php wp_login_form($args); ?>
        </div>
        <div class="col-md-4">
            <h3>Don't have an account?</h3>
            <a href="#" class="boy_bt_1">Create an account</a>
        </div>
    </div>
</div>
<?php }
get_footer();
?>