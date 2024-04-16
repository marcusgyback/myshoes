<?php
/*
 * Template Name: Customer Registration
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
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h3>Create an account</h3>
            <div id="registration-success">
                Your account has been created
                <a class="boy_bt_1" href="<?php echo home_url(); ?>/customer-login">Log in</a>
            </div>
            <div id="registration-error">
                First name is required
            </div>
            <form id="customer_registration">
                <label for="first_name">First name</label>
                <input id="first_name" type="text" name="first_name" />
                <label for="last_name">Last name</label>
                <input id="last_name" type="text" name="last_name" />
                <label for="username">Username</label>
                <input id="username" type="text" name="username" />
                <label for="email">Email</label>
                <input id="email" type="text" name="email" />
                <label for="password">Password</label>
                <input id="password" type="password" name="password" />
                <label for="password2">Repeat password</label>
                <input id="password2" type="password" name="password2" />
                <input id="registration_btn" type="submit" class="boy_bt_1" value="Create account">
            </form>
        </div>
        <div class="col-md-4">
            <h3>Do you already have an account?</h3>
            <a href="<?php echo home_url(); ?>/customer-login" class="boy_bt_1">Log in</a>
        </div>
    </div>
</div>
<?php get_footer(); ?>