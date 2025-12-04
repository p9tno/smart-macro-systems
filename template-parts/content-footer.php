<?php
    $showLogo = get_theme_mod('show_footer_logo');
    $showAddress = get_theme_mod('show_footer_address');
    $jobTime = get_theme_mod('site_job_time');
    $address = get_theme_mod('site_address');
    $phone = get_theme_mod('site_phone');
    $email = get_theme_mod('site_email');
    $showSocials = get_theme_mod('show_footer_social');
    $showFooterMenu = get_theme_mod('show_footer_menu');
    $showCopy = get_theme_mod('show_footer_copyright');
    $copyText = get_theme_mod('footer_copyright_text');
    $showPolicy = get_theme_mod('show_footer_policy');
    $showPopup = get_theme_mod('show_footer_accept_popup');
    $policyText = get_theme_mod('footer_accept_popup_text');
    $show_sitemap = get_theme_mod('show_sitemap');
    $sitemap_link = get_theme_mod('sitemap_link');
    $sitemap_text = get_theme_mod('sitemap_text');

    // get_pr( get_theme_mod('show_footer_copyright'));



    // $contact_title = get_theme_mod('footer_contact_title', 'Контакты');
    // $address_title = get_theme_mod('footer_address_title', 'Ждм в гости');

    // get_pr(get_theme_mods());
?>



<footer class="footer">
    <div class="section__wrap br bb">
        <div class="footer__top">
            <div class="container_center">
                <div class="footer__content">
                    
                    <?php if ($showLogo || $address || $showAddress) { ?>

                        <div class="footer__col">
                            <?php if ($showLogo) { ?>
                                <div class="footer__logo">
                                    <?php if (has_custom_logo()) { the_custom_logo(); ?>
                                    <?php } else { ?>
                                        <a class="footer__logo_link" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
                                    <?php } ?>
            
                                    <?php 
                                    $description = get_bloginfo('description', 'display');
            
                                    if ($description || is_customize_preview()) { ?>
                                        <span class="footer__logo_desc"><?php echo esc_html($description); ?></span>
                                    <?php } ?>
                                </div>
                            <?php } ?>

                            <?php if ($address && $showAddress) { ?>
                                <div class="footer__address">
                                    <i class="sws_icon_pin"></i>
                                    <p>
                                        <span>Адрес:</span>
                                        <span><?php echo esc_html($address); ?></span>
                                    </p>
                                </div>
                            <?php } ?>
    
                        </div>
    
                    <?php } ?>
        
                    <?php 
                    if (has_nav_menu('footer-1')) : ?>
                        <nav class="footer__col desktop">
                            <?php wp_nav_menu(array(
                                'theme_location' => 'footer-1',
                                'container' => 'ul',
                                'menu_class' => 'footer__menu',
                                'depth' => 1,
                            )); ?>
                        </nav>
                    <?php endif; ?>
                    <?php 
                    if (has_nav_menu('footer-2')) : ?>
                        <nav class="footer__col desktop">
                            <?php wp_nav_menu(array(
                                'theme_location' => 'footer-2',
                                'container' => 'ul',
                                'menu_class' => 'footer__menu',
                                'depth' => 1,
                            )); ?>
                        </nav>
                    <?php endif; ?>

                    <?php if ($jobTime || $phone || $email || $showSocials) { ?>
                        <div class="footer__col">
                            <div class="footer__info">
                                <?php if ($jobTime) { ?>
                                    <span class="footer__jobTime"><?php echo $jobTime; ?></span>
                                <?php } ?>
                                <?php if ($phone) { ?>
                                    <a class="footer__phone" href="tel:<?php echo preg_replace('/\s+/', '', $phone); ?>"><?php echo esc_html($phone); ?></a>
                                <?php } ?>
                                <?php if ($email) { ?>
                                    <a class="footer__email" href="mailto<?php echo $email; ?>"><?php echo esc_html($email); ?></a>
                                <?php } ?>
                            </div>
    
                            <?php if ($showSocials) { get_template_part( 'template-parts/parts/part', 'soc' ); } ?>
                        </div>
                    <?php } ?>
        
                </div>
            </div>
        </div>


        <div class="footer__bottom">
            <div class="container_center">
                <div class="footer__content">
                    <a href="https://start-website.ru" class="dev" target="_blank" rel="nofollow">
                        <span class="dev__logo">
                            <img src="<?php echo get_template_directory_uri() . '/assets/img/logo.png' ?>" alt="Start Website">
                        </span>
                        <span class="dev__text">Разработка сайта <br />В наших руках!</span>
                    </a>
                    <div class="footer__seo">
                        <?php if ($showPolicy && get_the_privacy_policy_link()) {
                            echo get_the_privacy_policy_link();
                        } ?>
                        <?php if ($show_sitemap && $sitemap_link && $sitemap_text) { ?>
                            <a href="<?php echo $sitemap_link; ?>"><?php echo $sitemap_text; ?></a>
                        <?php } ?>
                    </div>
                    <?php if (function_exists('display_payment_methods')) { ?>
                        <?php display_payment_methods(); ?>
                    <?php } ?>
                  
                    <?php if ($showCopy || $copyText) { ?>
                        <div class="footer__copy"><?php echo $copyText; ?> © <?php echo date('Y') ?></div>
                    <?php } ?>
                 
                </div>
            </div>
        </div>

    </div>

</footer>
