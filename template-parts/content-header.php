<header class="header">

        <div class="header__content">
            <?php if (class_exists('SCF') && SCF::get_option_meta('my-theme-settings', 'option_header_img')) { ?>
                <a class="header__logo" href="<?php echo esc_url(home_url("/")); ?>">
                    <?php echo wp_get_attachment_image(SCF::get_option_meta( 'my-theme-settings', 'option_header_img' ), 'full') ?>
                </a>
            <?php } ?>

            <div class="header__nav">
                <nav class="navbar">
                    <?php 
                        wp_nav_menu(array(
                            'theme_location' => 'header',
                            'container' =>'ul',
                        ));
                    ?>

                </nav>
            </div>
            <div class="header__toggle" id="toggle"><span></span></div>
        </div>
 
</header>

<?php
// echo "<h1>";
// echo get_post_type(); 
// echo "</h1>"

?>

</h1>
