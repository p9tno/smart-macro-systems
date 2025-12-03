<?php 
	$showPhone = get_theme_mod('show_phone');
	$phone = get_theme_mod('site_phone');
	$showEmail = get_theme_mod('show_email');
	$email = get_theme_mod('site_email');
	$showJobTime = get_theme_mod('show_job_time');
	$jobTime = get_theme_mod('site_job_time');
?>


<?php if ($showJobTime || $showPhone || $showEmail) { ?>
    <div class="header__info">
        <?php if ($showJobTime && $jobTime) { ?>
            <span class="header__jobTime"><?php echo $jobTime; ?></span>
        <?php } ?>
        <?php if ($showPhone && $phone) { ?>
            <a class="header__phone" href="tel:<?php echo preg_replace('/\s+/', '', $phone); ?>"><?php echo esc_html($phone); ?></a>
        <?php } ?>
        <?php if ($showEmail && $email) { ?>
            <a class="header__email" href="mailto<?php echo $email; ?>"><?php echo esc_html($email); ?></a>
        <?php } ?>
    </div>
<?php } ?>