<?php

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

}

add_action('wp_enqueue_scripts', 'theme_files');

/*
Adding woocommerce support to the theme
*/

function myshoes_woocommerce_support() {
    add_theme_support('woocommerce');
}
add_action('after_theme_setup', 'myshoes_woocommerce_support');

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
 * Adding the ability to change the contact email in the footer
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