<!-- begin firstscreen-->
<section class="firstscreen section" id="firstscreen">
    <div class="section__wrap">
        <div class="firstscreen__content br">
            <?php if (SCF::get( 'firstscreen_title' )) { ?>
                <h1 class="section__title"><span><?php echo SCF::get( 'firstscreen_title' ); ?></h1>
            <?php } ?>
            <?php if (SCF::get( 'firstscreen_text' )) { ?>
                <div class="firstscreen__text desktop"><?php echo SCF::get( 'firstscreen_text' ); ?></div>
            <?php } ?>
            <?php if (SCF::get( 'firstscreen_text_m' )) { ?>
                <div class="firstscreen__text mobile"><?php echo SCF::get( 'firstscreen_text_m' ); ?></div>
            <?php } ?>
        </div>
        <?php if (SCF::get( 'firstscreen_img' )) { ?>
            <div class="firstscreen__img img br"><?php echo wp_get_attachment_image(SCF::get( 'firstscreen_img' ), 'full') ?></div>
        <?php } ?>
    </div>
</section>
<!-- end firstscreen-->