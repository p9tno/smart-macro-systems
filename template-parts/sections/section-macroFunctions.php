<!-- begin macroFunctions-->
<section class="macroFunctions section" id="macroFunctions">
    <div class="section__wrap">
        <div class="macroFunctions__wrap">
            <div class="macroFunctions__content br">
                <?php if (SCF::get( 'macroFunctions_label' )) { ?>
                    <div class="section__label info" data-aos="fade-right"><?php echo SCF::get( 'macroFunctions_label' ); ?></div>
                <?php } ?>  
                <div class="macroFunctions__caption">
                    <?php if (SCF::get( 'macroFunctions_title' )) { ?>
                        <h2 class="section__title" data-aos="fade-up"><?php echo SCF::get( 'macroFunctions_title' ); ?></h2>
                    <?php } ?>

                    <?php if (SCF::get( 'macroFunctions_desc' )) { ?>
                        <div class="section__desc">
                            <p><?php echo SCF::get( 'macroFunctions_desc' ); ?></p>
                        </div>
                    <?php } ?>
                </div>

                <?php $row = SCF::get('macroFunctions_list');
                if ($row) { ?>
                    <div class="macroFunctions__list">
                        <ul class="imagesList grid">
                            <?php foreach ($row as $col) {  ?>
                                <li class="imagesList__item">
                                    <div class="imagesList__img_wrap">
                                        <div class="imagesList__img_inner">
                                            <div class="imagesList__img img"><?php echo wp_get_attachment_image($col['macroFunctions_list_img'], 'full'); ?></div>
                                        </div>
                                        <b class="mobile"><?php echo $col['macroFunctions_list_title']; ?></b>
                                    </div>
                                    <div class="imagesList__text">
                                        <b class="desktop"><?php echo $col['macroFunctions_list_title']; ?></b>
                                        <span><?php echo $col['macroFunctions_list_text']; ?></span>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php }; ?>
            </div>

            <?php if (SCF::get( 'macroFunctions_img' )) { ?>
                <div class="macroFunctions__img img br"><?php echo wp_get_attachment_image(SCF::get( 'macroFunctions_img' ), 'full'); ?></div>
            <?php } ?>
        </div>
    </div>
</section>
<!-- end macroFunctions-->