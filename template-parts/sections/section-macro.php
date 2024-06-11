<!-- begin macro-->
<section class="macro section" id="macro">
    <div class="section__wrap br">
        <div class="container_center">
            <div class="macro__wrap">
                <div class="macro__content">
                    <div class="macro__caption">
                        <?php if (SCF::get( 'macro_label' )) { ?>
                            <div class="section__label info" data-aos="fade-left"><?php echo SCF::get( 'macro_label' ); ?></div>
                        <?php } ?>
                        
                        <?php if (SCF::get( 'macro_title' )) { ?>
                            <h2 class="section__title" data-aos="fade-up"><?php echo SCF::get( 'macro_title' ); ?></h2>
                        <?php } ?>
                    </div>

                    <?php if (SCF::get( 'macro_desc' )) { ?>
                        <div class="section__desc">
                            <p><?php echo SCF::get( 'macro_desc' ); ?></p>
                        </div>
                    <?php } ?>
                </div>
                <?php if (SCF::get( 'macro_img' )) { ?>
                    <div class="macro__img img br"><?php echo wp_get_attachment_image(SCF::get( 'macro_img' ), 'full'); ?></div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>
<!-- end macro-->