<header class="header eee">
    <div class="header__content">

        <?php get_template_part( 'template-parts/parts/part', 'logo' ); ?>

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
    get_pr(SCF::get_option_meta('my-theme-settings', 'button_primary'));
    get_pr(SCF::get_option_meta('my-theme-settings', 'range'));
    get_pr(SCF::get_option_meta('my-theme-settings', 'media'));
    get_pr(SCF::get_option_meta('my-theme-settings', 'number'));
?>

