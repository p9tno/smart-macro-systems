<div class="header__logo">
    <?php if (has_custom_logo()) { the_custom_logo(); ?>
    <?php } else { ?>
        <a class="header__logo_link" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
    <?php } ?>
</div>