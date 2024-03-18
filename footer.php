<!--footer section start -->
<div class="footer_section layout_padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-sm-6">
                <h4 class="link_text">About us</h4>
                <p class="footer_text"><?php echo esc_attr(get_theme_mod('footer_about_us')); ?></p>
            </div>
            <div class="col-lg-4 col-sm-6">
                <h4 class="link_text">Useful link</h4>
                <?php

                wp_nav_menu([
                    'menu' => 'footer_links',
                    'menu_id' => '',
                    'menu_class' => '',
                    'container' => false
                ]);

                ?>
            </div>
            <div class="col-lg-4 col-sm-6">
                <h4 class="link_text">Contact Us</h4>
                <p class="footer_text">
                    Email: <?php echo esc_attr(get_theme_mod('footer_contact_email')); ?><br/>
                    Phone: <?php echo esc_attr(get_theme_mod('footer_contact_phone')); ?>
                </p>
            </div>
        </div>
    </div>
</div>
<!--footer section end -->
<!--copyright section start -->
<div class="copyright_section">
    <div class="container">
        <p class="copyright_text">Copyright <?php echo date('Y') ?> All Right Reserved By MyShoes</p>
    </div>
</div>
<!--copyright section end -->
<!-- Javascript files-->
<!-- sidebar -->
<!-- javascript -->
<script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
<script>
    $(document).ready(function(){
        $(".fancybox").fancybox({
            openEffect: "none",
            closeEffect: "none"
        });
        $('#myCarousel').carousel({
            interval: false
        });
</script>
<script>
    function openNav() {
        document.getElementById("mySidebar").style.width = "250px";
        document.getElementById("main").style.marginLeft = "250px";
    }

    function closeNav() {
        document.getElementById("mySidebar").style.width = "0";
        document.getElementById("main").style.marginLeft= "0";
    }
</script>
<?php
wp_footer();
?>
</body>
</html>