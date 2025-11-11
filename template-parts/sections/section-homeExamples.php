<!-- begin homeExamples-->
<section class="homeExamples section" id="homeExamples">
    <div class="section__wrap br">
        <div class="container_center">
            <?php if (SCF::get( 'homeExamples_label' )) { ?>
                <div class="section__label" data-aos="fade-right"><?php echo SCF::get( 'homeExamples_label' ); ?></div>
            <?php } ?>

            <?php if (SCF::get( 'homeExamples_title' )) { ?>
                <h2 class="section__title" data-aos="fade-up"><?php echo SCF::get( 'homeExamples_title' ); ?></h2>
            <?php } ?>

            <?php $row = SCF::get('homeExamples_list');
            if ($row) { ?>
                <div class="homeExamples__grid">
                    <?php foreach ($row as $col) {  ?>
                        <div class="homeExamples__item">
                            <div class="homeExamples__img img br"><?php echo wp_get_attachment_image($col['homeExamples_list_img'], 'full') ?></div>
                            <div class="homeExamples__content">
                                <div class="homeExamples__title"><?php echo $col['homeExamples_list_title']; ?></div>
                                <div class="homeExamples__text"><?php echo $col['homeExamples_list_text']; ?></div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php }; ?>
        </div>
    </div>
</section>
<!-- end homeExamples-->