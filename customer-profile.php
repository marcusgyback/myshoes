<?php
/*
 * Template Name: Customer profile
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
<!--header section end -->
<div class="container">
    <div class="row mb-5 profile">
        <div class="col-md-3">
            <?php echo get_template_part('/template-parts/profile-menu'); ?>
        </div>
        <div class="col-md-9">
            <h3>Edit your profile information</h3>
            <div id="profile-success">
                Your profile has been updated
            </div>
            <div id="profile-error">

            </div>
            <form id="editProfile" method="post">
                <label for="first_name">First Name</label>
                <input type="text" name="first_name" value="<?php echo $current_user->shipping_first_name; ?>" />
                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" value="<?php echo $current_user->shipping_last_name; ?>" />
                <label for="email">Email</label>
                <input type="text" name="email" value="<?php echo $current_user->billing_email; ?>" />
                <label for="phone">Phone</label>
                <input type="text" name="phone" value="<?php echo $current_user->shipping_phone; ?>" />
                <label for="address">Address</label>
                <input type="text" name="address" value="<?php echo $current_user->shipping_address_1; ?>" />
                <label for="postcode">Postcode</label>
                <input type="text" name="postcode" value="<?php echo $current_user->shipping_postcode; ?>" />
                <label for="city">City</label>
                <input type="text" name="city" value="<?php echo $current_user->shipping_city; ?>" />
                <input hidden name="id" value="<?php echo $current_user->ID; ?>">
                <input type="submit" class="boy_bt_1 mt-3" value="Update">
            </form>
        </div>
    </div>
</div>

<?php
get_footer();
