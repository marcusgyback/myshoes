<?php

require get_theme_file_path('/inc/product-review-routes.php');
require get_theme_file_path('/inc/search-routes.php');
require get_theme_file_path('/inc/customer-routes.php');

function theme_files() {
    /* CSS-files */
    wp_enqueue_style('bootstrap', get_theme_file_uri('/css/bootstrap.css'), NULL, microtime(), false);
    wp_enqueue_style('responsive', get_theme_file_uri('/css/responsive.css'), NULL, microtime(), false);
    wp_enqueue_style('scrollbar', get_theme_file_uri('/css/jquery.mCustomScrollbar.min.css'), NULL, microtime(), false);
    wp_enqueue_style('font-awesome', '//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css', NULL, microtime(), false);
    wp_enqueue_style('theme-default', get_theme_file_uri('/css/owl.theme.default.min.css'), NULL, microtime(), false);
    wp_enqueue_style('bxslidercss', '//cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css', NULL, microtime(), false);

    /* JS-files */
    wp_enqueue_script('shiv', '//oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js', NULL, microtime(), false);
    wp_enqueue_script('respond', '//oss.maxcdn.com/respond/1.4.2/respond.min.js', NULL, microtime(), false);
    wp_enqueue_script('jquery', get_theme_file_uri('/js/jquery.min.js'), NULL, microtime(), true);
    wp_enqueue_script('popper', get_theme_file_uri('/js/popper.min.js'), NULL, microtime(), true);
    wp_enqueue_script('bootstrapbundle', get_theme_file_uri('/js/bootstrap.bundle.min.js'), NULL, microtime(), true);
    wp_enqueue_script('jquery3', get_theme_file_uri('/js/jquery-3.0.0.min.js'), NULL, microtime(), true);
    wp_enqueue_script('customScrollBar', get_theme_file_uri('/js/jquery.mCustomScrollbar.concat.min.js'), NULL, microtime(), true);
    wp_enqueue_script('customJs', get_theme_file_uri('/js/custom.js'), NULL, microtime(), true);
    wp_enqueue_script('bxsliderjs', '//cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js', 'jquery3', microtime(), true);
    wp_localize_script('customJs', 'themeData', array(
        'root_url' => get_site_url(),
        'nonce' => wp_create_nonce('site-nonce')
    ));

}

add_action('wp_enqueue_scripts', 'theme_files');

/*
Adding woocommerce support to the theme
*/

function myshoes_woocommerce_support() {
    add_theme_support('woocommerce');
}
add_action('after_setup_theme', 'myshoes_woocommerce_support');

/*
 * Adding the ability to change logo using the customizer
 */
function site_logo( $wp_customize ) {
    // Adding setting
    $wp_customize->add_setting('site_logo');

    // Add control
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'site_logo',
            array(
                'label' => 'Upload your logo',
                'section' => 'title_tagline',
                'settings' => 'site_logo'
            )
        )
    );
}
add_action('customize_register', 'site_logo');

/*
 * Adding the ability to change the about us section in the footer
 */
function footer_about_us( $wp_customize ) {
    // Adding setting
    $wp_customize->add_setting('footer_about_us');

    // Add control
    $wp_customize->add_control('footer_about_us', array(
        'type' => 'textarea',
        'section' => 'title_tagline',
        'label' => __('About us')
    ));
}
add_action('customize_register', 'footer_about_us');

/*
 * Adding the ability to change the contact email in the footer
 */
function footer_contact_email( $wp_customize ) {
    // Adding setting
    $wp_customize->add_setting('footer_contact_email');

    // Add control
    $wp_customize->add_control('footer_contact_email', array(
        'type' => 'text',
        'section' => 'title_tagline',
        'label' => __('Contact email')
    ));
}
add_action('customize_register', 'footer_contact_email');

/*
 * Adding the ability to change the contact phone in the footer
 */
function footer_contact_phone( $wp_customize ) {
    // Adding setting
    $wp_customize->add_setting('footer_contact_phone'); 

    // Add control
    $wp_customize->add_control('footer_contact_phone', array(
        'type' => 'text',
        'section' => 'title_tagline',
        'label' => __('Contact phone')
    ));
}
add_action('customize_register', 'footer_contact_phone');

/*
 * Function to remove products from cart
 */
add_action('wp_ajax_product_remove', 'remove_product');
add_action('wp_ajax_nopriv_product_remove', 'remove_product');
function remove_product() {
    global $woocommerce;
    $cart = $woocommerce->cart;

    foreach($woocommerce->cart->get_cart() as $cart_item_key => $cart_item) {
        if($cart_item['product_id'] == $_POST['product_id']) {
            $cart->remove_cart_item($cart_item_key);
        }
    }

    $data = [
        'subtotal' => WC()->cart->get_total_ex_tax(),
        'total' => WC()->cart->get_cart_total(),
    ];

    return wp_send_json_success($data);
}
/*
 * Function to change the quantity of the products in our cart
 */
add_action('wp_ajax_change_cart_item_quantity', 'change_cart_item_quantity');
add_action('wp_ajax_nopriv_change_cart_item_quantity', 'change_cart_item_quantity');
function change_cart_item_quantity() {

    global $woocommerce;
    $item_key = $_REQUEST['productKey'];
    $quantity = $_REQUEST['quantity'];

    $woocommerce->cart->set_quantity($item_key, $quantity);

    $data = [
        'subtotal' => WC()->cart->get_total_ex_tax(),
        'total' => WC()->cart->get_cart_total(),
    ];

    return wp_send_json_success($data);
}

/*
 * Function to apply coupons
 */
add_action('wp_ajax_apply_coupons', 'apply_coupons');
add_action('wp_ajax_nopriv_apply_coupons', 'apply_coupons');
function apply_coupons() {
    WC()->cart->remove_coupons();

    $couponCode = $_POST['couponCode'];
    $res = WC()->cart->add_discount($couponCode);
    $data = [
        'message' => $res
    ];

    return wp_send_json_success($data);
}