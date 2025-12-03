<?php
$showAddress = get_theme_mod('show_address');
$address = get_theme_mod('site_address');
?>

<?php if ($showAddress && $address) { ?>
    <div class="header__address">
        <i class="sws_icon_pin"></i>
        <p>
            <span>Адрес:</span>
            <span><?php echo esc_html($address); ?></span>
        </p>
    </div>
<?php } ?>