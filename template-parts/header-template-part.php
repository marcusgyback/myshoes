<?php
get_template_part('/template-parts/search-modal');
?>
<div class="header_main">
    <div class="logo"><a href="<?php echo home_url(); ?>"><img src="<?php echo esc_attr(get_theme_mod('site_logo')); ?>"></a></div>
    <div class="number_text">No<br><span style="color: #fff;">01</span></div>
    <div class="search_icon"><a href="index.html"><img src="<?php echo get_theme_file_uri(); ?>/images/search-icon.png"></a></div>
    <a class="header_cart" href="<?php echo WC()->cart->get_cart_url(); ?>">
        <i class="fa fa-shopping-cart"></i> <span><?php echo WC()->cart->get_cart_total(); ?></span>
    </a>
</div>
<div class="menu_main">
    <div class="togle_main"><a class="class=" openbtn="" onclick="openNav()"><img src="<?php echo get_theme_file_uri(); ?>/images/toggle-icon.png" style="max-width: 100%;"></a></div>
    <div id="mySidebar" class="sidebar">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
        <?php

        wp_nav_menu([
            'menu' => 'site-main-menu',
            'menu_id' => '',
            'menu_class' => '',
            'container' => false
        ]);

        ?>
    </div>
</div>