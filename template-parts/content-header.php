<?php
    $sticked = get_theme_mod('sticked');
    $showSocials = get_theme_mod('show_social');
?>



<header class="header <?php echo $sticked ? 'header_sticked' : '' ?>" >

    
    <div class="header__content">

        <div class="header__top desktop">
            <div class="header__row">

                <div class="header__logo">
                    <?php if (has_custom_logo()) { the_custom_logo(); ?>
                    <?php } else { ?>
                        <a class="header__logo_link" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
                    <?php } ?>

                    <?php 
                    $description = get_bloginfo('description', 'display');

                    if ($description || is_customize_preview()) { ?>
                        <span class="header__logo_desc"><?php echo esc_html($description); ?></span>
                    <?php } ?>
                </div>

                <?php
                $showAddress = get_theme_mod('show_address');
                $address = get_theme_mod('site_address');
                ?>

                <?php if ($showAddress && $address) { ?>
                    <div class="header__address">
                        <i class="sws_icon_pin"></i>
                        <p>
                            <span>Адрес:</span>
                            <span><?php echo esc_html($address); ?></span>
                        </p>
                    </div>
                <?php } ?>

                <?php 
                    if ($showSocials) {
                        get_template_part( 'template-parts/parts/part', 'soc' ); 
                    }
                ?>

                <?php 
                $showCallbackBtn = get_theme_mod('show_callback_bth');

                if ($showCallbackBtn) { ?>
                    <a 
                        href="#wpcf7-info"
                        class="btn show_modal_js"
                    >
                        <?php echo esc_html($showCallbackBtn); ?>
                    </a>
                <?php } ?>

                <?php 
                    $showPhone = get_theme_mod('show_phone');
                    $phone = get_theme_mod('site_phone');
                    $showEmail = get_theme_mod('show_email');
                    $email = get_theme_mod('site_email');
                    $showJobTime = get_theme_mod('show_job_time');
                    $jobTime = get_theme_mod('site_job_time');
                ?>


                <?php if ($showJobTime || $showPhone || $showEmail) { ?>
                    <div class="header__info">
                        <?php if ($showJobTime && $jobTime) { ?>
                            <span class="header__jobTime"><?php echo $jobTime; ?></span>
                        <?php } ?>
                        <?php if ($showPhone && $phone) { ?>
                            <a class="header__phone" href="tel:<?php echo preg_replace('/\s+/', '', $phone); ?>"><?php echo esc_html($phone); ?></a>
                        <?php } ?>
                        <?php if ($showEmail && $email) { ?>
                            <a class="header__email" href="mailto<?php echo $email; ?>"><?php echo esc_html($email); ?></a>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        </div>

        <div class="header__bottom">
            <div class="header__nav">
                <nav class="navbar">
                    <div class="header__row mobile">
                        <div class="header__logo">
                            <?php if (has_custom_logo()) { the_custom_logo(); ?>
                            <?php } else { ?>
                                <a class="header__logo_link" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
                            <?php } ?>

                            <?php 
                            $description = get_bloginfo('description', 'display');

                            if ($description || is_customize_preview()) { ?>
                                <span class="header__logo_desc"><?php echo esc_html($description); ?></span>
                            <?php } ?>
                        </div>

                        <?php if ($showJobTime || $showPhone || $showEmail) { ?>
                            <div class="header__info">
                                <?php if ($showJobTime && $jobTime) { ?>
                                    <span class="header__jobTime"><?php echo $jobTime; ?></span>
                                <?php } ?>
                                <?php if ($showPhone && $phone) { ?>
                                    <a class="header__phone" href="tel:<?php echo preg_replace('/\s+/', '', $phone); ?>"><?php echo esc_html($phone); ?></a>
                                <?php } ?>
                                <?php if ($showEmail && $email) { ?>
                                    <a class="header__email" href="mailto<?php echo $email; ?>"><?php echo esc_html($email); ?></a>
                                <?php } ?>
                            </div>
                        <?php } ?>
                        
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

