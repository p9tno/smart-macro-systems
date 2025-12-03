<?php 
$showCallbackBtn = get_theme_mod('show_callback_bth');

if ($showCallbackBtn) { ?>
    <a 
        href="#wpcf7-info"
        class="btn show_modal_js"
    >
        <?php echo esc_html($showCallbackBtn); ?>
    </a>
<?php }

?>

