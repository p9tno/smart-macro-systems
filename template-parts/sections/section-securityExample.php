<!-- begin securityExample-->
<section class="securityExample section" id="securityExample">
    <div class="section__wrap">
        <div class="securityExample__wrap">
            <div class="securityExample__content br">
                <?php if (SCF::get( 'securityExample_label' )) { ?>
                    <div class="section__label info" data-aos="fade-right"><?php echo SCF::get( 'securityExample_label' ); ?></div>
                <?php } ?>
                <?php if (SCF::get( 'securityExample_title' )) { ?>
                    <h2 class="section__title" data-aos="fade-up"><?php echo SCF::get( 'securityExample_title' ); ?></h2>
                <?php } ?>
                <?php if (SCF::get( 'securityExample_desc' )) { ?>
                    <div class="section__desc">
                        <p><?php echo SCF::get( 'securityExample_desc' ); ?></p>
                    </div>
                <?php } ?>
            </div>
            
            <?php if (SCF::get( 'securityExample_img_d' ) || SCF::get( 'test' )) { ?>
                <div class="securityExample__img img br">
                    <?php echo wp_get_attachment_image(SCF::get( 'securityExample_img_d' ), 'full', false,[ 'class' => 'desktop' ]); ?>
                    <?php echo wp_get_attachment_image(SCF::get( 'securityExample_img_m' ), 'full', false,[ 'class' => 'mobile' ]); ?>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
<!-- end securityExample-->