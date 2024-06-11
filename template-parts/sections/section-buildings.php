<!-- begin buildings-->
<section class="buildings section" id="buildings">
    <div class="section__wrap br bb">
        <div class="container_center">
            <div class="buildings__content">

                <div class="buildings__row">
                    <div class="buildings__top">
                        <?php if (SCF::get( 'buildings_label' )) { ?>
                            <div class="section__label info" data-aos="fade-right"><?php echo SCF::get( 'buildings_label' ); ?></div>
                        <?php } ?>
                        <?php if (SCF::get( 'buildings_title' )) { ?>
                            <h2 class="section__title" data-aos="fade-up"><?php echo SCF::get( 'buildings_title' ); ?></h2>
                        <?php } ?>
                        <?php if (SCF::get( 'buildings_desc' )) { ?>
                            <div class="section__desc">
                                <p><?php echo SCF::get( 'buildings_desc' ); ?></p>
                            </div>
                        <?php } ?>
                        <?php if (SCF::get( 'buildings_img' )) { ?>
                            <div class="buildings__img img br desktop"><?php echo wp_get_attachment_image(SCF::get( 'buildings_img' ), 'full'); ?></div>
                        <?php } ?>
                    </div>

                    <?php $row = SCF::get('buildings_list');
                    if ($row) { ?>
                        <div class="buildings__list">
                            <ul class="imagesList">
                                <?php foreach ($row as $col) {  ?>
                                    <li class="imagesList__item">
                                        <div class="imagesList__img_wrap">
                                            <div class="imagesList__img_inner">
                                                <div class="imagesList__img img"><?php echo wp_get_attachment_image($col['buildings_list_img'], 'full'); ?></div>
                                            </div>
                                            <b class="mobile"><?php echo $col['buildings_list_title']; ?></b>
                                        </div>
                                        <div class="imagesList__text">
                                            <b><?php echo $col['buildings_list_title']; ?></b>
                                            <span><?php echo $col['buildings_list_text']; ?></span>
                                        </div>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    <?php }; ?>

                </div>

                <div class="buildings__row">
                    <div class="buildings__bottom">
                        <?php if (SCF::get( 'buildingsExamples_label' )) { ?>
                            <div class="section__label info" data-aos="fade-right"><?php echo SCF::get( 'buildingsExamples_label' ); ?></div>
                        <?php } ?>
                        <?php if (SCF::get( 'buildingsExamples_title' )) { ?>
                            <h2 class="section__title" data-aos="fade-up"><?php echo SCF::get( 'buildingsExamples_title' ); ?></h2>
                        <?php } ?>
                        <?php if (SCF::get( 'buildingsExamples_desc' )) { ?>
                            <div class="section__desc">
                                <p><?php echo SCF::get( 'buildingsExamples_desc' ); ?></p>
                            </div>
                        <?php } ?>
                    </div>
                    <?php if (SCF::get( 'buildingsExamples_img' )) { ?>
                        <div class="buildings__img img br"><?php echo wp_get_attachment_image(SCF::get( 'buildingsExamples_img' ), 'full'); ?></div>
                    <?php } ?>
                </div>

            </div>
        </div>
    </div>
</section>
<!-- end buildings-->