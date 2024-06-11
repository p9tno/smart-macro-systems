<!-- begin home-->
<section class="smartHome section" id="smartHome">
    <div class="section__wrap br">
        <div class="container_center">
            <div class="smartHome__row">
                <div class="smartHome__top">
                    <div class="smartHome__caption">
                        <?php if (SCF::get( 'security_label' )) { ?>
                            <div class="section__label info" data-aos="fade-right"><?php echo SCF::get( 'security_label' ); ?></div>
                        <?php } ?>
                        <?php if (SCF::get( 'security_title' )) { ?>
                            <h2 class="section__title" data-aos="fade-up"><?php echo SCF::get( 'security_title' ); ?></h2>
                        <?php } ?>
                    </div>
                    <?php if (SCF::get( 'security_desc' )) { ?>
                        <div class="section__desc">
                            <p><?php echo SCF::get( 'security_desc' ); ?></p>
                        </div>
                    <?php } ?>
                </div>
                <?php if (SCF::get( 'security_img' )) { ?>
                    <div class="smartHome__img img br"><?php echo wp_get_attachment_image(SCF::get( 'security_img' ), 'full'); ?></div>
                <?php } ?>
            </div>

            <div class="smartHome__row">
                <div class="smartHome__bottom">
                    <?php if (SCF::get( 'securityAdvanced_label' )) { ?>
                        <div class="section__label info" data-aos="fade-left"><?php echo SCF::get( 'securityAdvanced_label' ); ?></div>
                    <?php } ?>
                    <?php if (SCF::get( 'securityAdvanced_title' )) { ?>
                        <h2 class="section__title" data-aos="fade-up"><?php echo SCF::get( 'securityAdvanced_title' ); ?></h2>
                    <?php } ?>
                    <?php if (SCF::get( 'securityAdvanced_desc' )) { ?>
                        <div class="section__desc">
                            <p><?php echo SCF::get( 'securityAdvanced_desc' ); ?></p>
                        </div>
                    <?php } ?>

                    <?php $row = SCF::get('securityAdvanced_list');
                    if ($row) { ?>
                        <ul class="smartHome__list counter-wrap">
                            <?php foreach ($row as $col) {  ?>
                                <li class="smartHome__list_item counter-item">
                                    <div class="smartHome__list_left">
                                        <div class="smartHome__list_number" data-aos="zoom-in"><span class="counter-el"></span></div>
                                        <div class="smartHome__list_title mobile"><?php echo $col['securityAdvanced_list_title']; ?></div>
                                    </div>
                                    <div class="smartHome__list_right">
                                        <div class="smartHome__list_title desktop"><?php echo $col['securityAdvanced_list_title']; ?></div>
                                        <div class="smartHome__list_text"><?php echo $col['securityAdvanced_list_text']; ?></div>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                    <?php }; ?>
                  
                </div>
                <div class="smartHome__gallery">
                    <?php if (SCF::get( 'securityAdvanced_img_top' )) { ?>
                        <div class="smartHome__img img br"><?php echo wp_get_attachment_image(SCF::get( 'securityAdvanced_img_top' ), 'full'); ?></div>
                    <?php } ?>
                    <?php if (SCF::get( 'securityAdvanced_img_bottom' )) { ?>
                        <div class="smartHome__img img br"><?php echo wp_get_attachment_image(SCF::get( 'securityAdvanced_img_bottom' ), 'full'); ?></div>
                    <?php } ?>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- end home-->