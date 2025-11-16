<?php if (class_exists('SCF')) { ?>

    <footer class="footer">
        <div class="section__wrap br bb">
            <div class="container_center">
                <div class="footer__content">
    
                    <?php if (SCF::get_option_meta('my-theme-settings', 'option_footer_img')) { ?>
                        <a class="footer__logo img" href="<?php echo esc_url(home_url("/")); ?>">
                            <?php echo wp_get_attachment_image(SCF::get_option_meta( 'my-theme-settings', 'option_footer_img' ), 'full') ?>
                        </a>
                    <?php } ?>
    
                    <ul class="footer__list">
                        <?php if (SCF::get_option_meta('my-theme-settings', 'option_address')) { ?>
                            <li class="footer__item">
                                <div class="footer__label">Адрес:</div>
                                <span><?php echo SCF::get_option_meta('my-theme-settings', 'option_address'); ?></span>
                            </li>
                        <?php } ?>
    
                        <?php if (SCF::get_option_meta('my-theme-settings', 'option_phone')) { ?>
                            <li class="footer__item">
                                <div class="footer__label">Телефон:</div>
                                <a href="tel:<?php echo preg_replace('/\s+/', '', SCF::get_option_meta('my-theme-settings', 'option_phone')); ?>"><?php echo SCF::get_option_meta('my-theme-settings', 'option_phone'); ?></a>
                            </li>
                        <?php } ?>
    
                        <?php if (SCF::get_option_meta('my-theme-settings', 'option_email')) { ?>
                            <li class="footer__item">
                                <div class="footer__label">Почта:</div>
                                <a href="mailto:<?php echo SCF::get_option_meta('my-theme-settings', 'option_email'); ?>"><?php echo SCF::get_option_meta('my-theme-settings', 'option_email'); ?></a>
                            </li>
                        <?php } ?>
                    </ul>

                <?php if (SCF::get_option_meta('my-theme-settings', 'contacts_form')) { ?>
             
                    <div class="footer__form">
                        <div class="footer__label">Application form:</div>
                        <?php echo do_shortcode(  SCF::get_option_meta('my-theme-settings', 'contacts_form') ); ?>
                        <!-- <form class="form" action="send.php">
                            <div class="form__row">
                                <input type="text" placeholder="First Name" /><i class="icon_s_person"></i>
                            </div>
                            <div class="form__row">
                                <input type="text" placeholder="Last Name" /><i class="icon_s_person"></i>
                            </div>
                            <div class="form__row">
                                <input type="text" placeholder="Phone Number" /><i class="icon_s_phone"></i>
                            </div>
                            <div class="form__row">
                                <input type="email" placeholder="Email" /><i class="icon_s_email"></i>
                            </div>
                            <div class="form__row">
                                <input type="text" placeholder="What Are You Interested In" /><i class="icon_s_person"></i>
                            </div>
                            <div class="form__row">
                                <button class="btn" type="submit">Submit</button>
                            </div>
                        </form> -->
                    </div>
                <?php } ?>
    
                </div>
            </div>
        </div>
    </footer>
<?php }
