<!-- begin preview-->
<section class="preview section" id="homes">
    <div class="section__wrap br bt">
        <div class="container_center">
            <div class="preview__grid">
                <div class="preview__item caption">
                    <?php if (SCF::get( 'made_label' )) { ?>
                        <div class="section__label" data-aos="fade-right"><?php echo SCF::get( 'made_label' ); ?></div>
                    <?php } ?>

                    <?php if (SCF::get( 'made_title' )) { ?>
                        <h2 class="section__title" data-aos="fade-up"><?php echo SCF::get( 'made_title' ); ?></h2>
                    <?php } ?>

                    <?php if (SCF::get( 'made_desc' )) { ?>
                        <div class="section__desc">
                            <p><?php echo SCF::get( 'made_desc' ); ?></p>
                        </div>
                    <?php } ?>
                </div>

                <?php $row = SCF::get('made_list');
                if ($row) { ?>
                    <?php foreach ($row as $col) {  ?>
                        <div class="preview__item">
                            <div class="preview__left">
                                <div class="preview__icon">
                                    <div class="preview__img img"><?php echo wp_get_attachment_image($col['made_list_img'], 'full') ?></div>
                                </div>
                                <b class="mobile"><?php echo $col['made_list_title']; ?></b>
                            </div>
                            <div class="preview__text">
                                <b><?php echo $col['made_list_title']; ?></b>
                                <span><?php echo $col['made_list_text']; ?></span>
                            </div>
                        </div>
                    <?php } ?>
                <?php }; ?>

            </div>
        </div>
    </div>
</section>
<!-- end preview-->