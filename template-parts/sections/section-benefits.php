<!-- begin benefits-->
<section class="benefits section" id="benefits">
    <div class="section__wrap br">
        <div class="container_center">
            <div class="benefits__wrap">
                <div class="benefits__content">
                    <?php if (SCF::get( 'securityBenefits_label' )) { ?>
                        <div class="section__label infoBlack" data-aos="fade-right"><?php echo SCF::get( 'securityBenefits_label' ); ?></div>
                    <?php } ?>
                    <?php if (SCF::get( 'securityBenefits_title' )) { ?>
                        <h2 class="section__title" data-aos="fade-up"><?php echo SCF::get( 'securityBenefits_title' ); ?></h2>
                    <?php } ?>
                    <?php if (SCF::get( 'securityBenefits_desc' )) { ?>
                        <div class="section__desc">
                            <p><?php echo SCF::get( 'securityBenefits_desc' ); ?></p>
                        </div>
                    <?php } ?>
                    <?php if (SCF::get( 'securityBenefits_img' )) { ?>
                        <div class="benefits__img img br"><?php echo wp_get_attachment_image(SCF::get( 'securityBenefits_img' ), 'full'); ?></div>
                    <?php } ?>
                    
                </div>

                <?php $row = SCF::get('securityBenefits_list');
                if ($row) { ?>
                    <ul class="benefits__list">
                        <?php foreach ($row as $col) {  ?>
                            <li class="benefits__list_item">
                                <div class="benefits__list_icon" data-aos="zoom-in"><i class="icon_s_plus"></i></div>
                                <div class="benefits__list_content">
                                    <div class="benefits__list_title"><?php echo $col['securityBenefits_list_title']; ?></div>
                                    <div class="benefits__list_text"><?php echo $col['securityBenefits_list_text']; ?></div>
                                </div>
                            </li>
                        <?php } ?>
                    </ul>
                <?php }; ?>

            </div>
        </div>
    </div>
</section>
<!-- end benefits-->