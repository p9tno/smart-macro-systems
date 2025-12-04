<?php 
    $showPopup = get_theme_mod('show_footer_accept_popup');
    $policyText = get_theme_mod('footer_accept_popup_text');

?>

<?php if ($showPopup && $policyText) { ?>
    <div class="privacyBox">
        <span><?php echo $policyText; ?></span>
        <div class="privacyBox__close btn">Принять</div>
    </div>
<?php } ?>