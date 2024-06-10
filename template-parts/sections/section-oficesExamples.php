<!-- begin oficesExamples-->
<section class="oficesExamples section" id="oficesExamples">
    <div class="section__wrap br">
        <div class="container_center">
            <div class="oficesExamples__wrap">
                <div class="oficesExamples__content">
                    <?php if (SCF::get( 'oficesExamples_label' )) { ?>
                        <div class="section__label infoBlack" data-aos="fade-left"><?php echo SCF::get( 'oficesExamples_label' ); ?></div>
                    <?php } ?>
                    <?php if (SCF::get( 'oficesExamples_title' )) { ?>
                        <h2 class="section__title" data-aos="fade-up"><?php echo SCF::get( 'oficesExamples_title' ); ?></h2>
                    <?php } ?>
                    <?php if (SCF::get( 'oficesExamples_text' )) { ?>
                        <div class="section__desc"><?php echo SCF::get( 'oficesExamples_text' ); ?></div>
                    <?php } ?>
                </div>
                <?php if (SCF::get( 'oficesExamples_img' )) { ?>
                    <div class="oficesExamples__img img br"><?php echo wp_get_attachment_image(SCF::get( 'oficesExamples_img' ), 'full'); ?></div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>
<!-- end oficesExamples-->