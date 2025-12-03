<div class="header__logo">
    <?php if (has_custom_logo()) { the_custom_logo(); ?>
    <?php } else { ?>
        <a class="header__logo_link" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
    <?php } ?>

    <?php 
    $description = get_bloginfo('description', 'display');

    if ($description || is_customize_preview()) { ?>
        <span class="header__logo_desc"><?php echo esc_html($description); ?></span>
    <?php } ?>

</div>