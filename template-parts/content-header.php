<?php
    $sticked = get_theme_mod('sticked');
?>



<header class="header <?php echo $sticked ? 'header_sticked' : '' ?>" >

    
    <div class="header__content">

        <div class="header__top desktop">
            <div class="header__row">
                <?php get_template_part( 'template-parts/parts/part', 'logo' ); ?>
                <?php get_template_part( 'template-parts/parts/part', 'address' ); ?>
                <?php get_template_part( 'template-parts/parts/part', 'soc' ); ?>
                <?php get_template_part( 'template-parts/parts/part', 'header-btn' ); ?>
                <?php get_template_part( 'template-parts/parts/part', 'header-info' ); ?>
            </div>
        </div>

        <div class="header__bottom">
            <div class="header__nav">
                <nav class="navbar">
                    <div class="header__row mobile">
                        <?php get_template_part( 'template-parts/parts/part', 'logo' ); ?>
                        <?php get_template_part( 'template-parts/parts/part', 'header-info' ); ?>
                    </div>
                    <?php 
                        wp_nav_menu(array(
                            'theme_location' => 'header',
                            'container' =>'ul',
                        ));
                    ?>
                    <?php get_template_part( 'template-parts/parts/part', 'header-btn' ); ?>

    
                </nav>
            </div>
        </div>


        <div class="header__toggle" id="toggle"><span></span></div>
    </div>
</header>

<?php 

    // get_pr(SCF::get_option_meta('my-theme-settings', 'button_primary'));
    // get_pr(SCF::get_option_meta('my-theme-settings', 'range'));
    // get_pr(SCF::get_option_meta('my-theme-settings', 'media'));
    // get_pr(SCF::get_option_meta('my-theme-settings', 'number'));

    // get_pr(get_theme_mods());


?>

