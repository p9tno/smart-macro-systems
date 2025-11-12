<!-- begin work-->
<section class="work section" id="work">
    <div class="section__wrap br">
        <div class="work__content br">
            <div class="container_center">
                <?php if (SCF::get( 'work_label' )) { ?>
                    <div class="section__label" data-aos="fade-left"><?php echo SCF::get( 'work_label' ); ?></div>
                <?php } ?>
                
                <?php if (SCF::get( 'work_title' )) { ?>
                    <h2 class="section__title" data-aos="fade-up"><?php echo SCF::get( 'work_title' ); ?></h2>
                <?php } ?>
                
                <?php if (SCF::get( 'work_desc' )) { ?>
                    <div class="section__desc">
                        <p><?php echo SCF::get( 'work_desc' ); ?></p>
                    </div>
                <?php } ?>

                <?php $row = SCF::get('work_list');
                if ($row) { ?>

                    <ul class="work__list list counter-wrap">
                        <?php foreach ($row as $col) {  ?>
                            <li class="work__item counter-item">
                                <div class="work__number" data-aos="zoom-in"><span class="counter-el"></span></div>
                                <div class="work__text">
                                    <b><?php echo $col['work_list_title']; ?></b>
                                    <span><?php echo $col['work_list_text']; ?></span>
                                </div>
                            </li>
                        <?php } ?>

                    </ul>
                <?php }; ?>
            </div>
        </div>

        <?php if (SCF::get( 'work_img' )) { ?>
            <div class="work__img img br"><?php echo wp_get_attachment_image(SCF::get( 'work_img' ),'full') ?></div>
        <?php } ?>

    </div>
</section>
<!-- end work-->