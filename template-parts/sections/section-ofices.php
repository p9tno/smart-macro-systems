    <!-- begin ofices-->
    <section class="ofices section" id="ofices">
        <div class="section__wrap br bt">
            <div class="container_center">
                <?php if (SCF::get( 'ofices_label' )) { ?>
                    <div class="section__label info" data-aos="fade-right"><?php echo SCF::get( 'ofices_label' ); ?></div>
                <?php } ?>

                <div class="ofices__caption">
                    <?php if (SCF::get( 'ofices_title' )) { ?>
                        <h2 class="section__title" data-aos="fade-up"><?php echo SCF::get( 'ofices_title' ); ?></h2>
                    <?php } ?>
    
                    <?php if (SCF::get( 'ofices_desc' )) { ?>
                        <div class="section__desc">
                            <p><?php echo SCF::get( 'ofices_desc' ); ?></p>
                        </div>
                    <?php } ?>
                </div>

                <?php $row = SCF::get('ofices_list');
                if ($row) { ?>
                    <div class="ofices__grid">
                        <?php foreach ($row as $col) {  ?>
                            <div class="ofices__item">
                                <div class="ofices__img img br"><?php echo wp_get_attachment_image($col['ofices_list_img'], 'full'); ?></div>
                                <div class="ofices__title"><?php echo $col['ofices_list_title']; ?></div>
                                <div class="ofices__text"><?php echo $col['ofices_list_text']; ?></div>
                            </div>
                        <?php } ?>
                    </div>
                <?php }; ?>

            </div>
        </div>
    </section>
    <!-- end ofices-->