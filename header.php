<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>
<!-- start body -->
<body <?php body_class(); ?>>
	<?php if (class_exists('SCF') && SCF::get_option_meta('my-theme-settings', 'boolean_preloader')) { ?>
		<?php get_template_part( 'template-parts/parts/part', 'preloader' ); ?>
	<?php } ?>
	<?php wp_body_open(); ?>

	<?php 
	// Проверяем все необходимые плагины
	$required_plugins = theme_get_required_plugins();
	if (theme_check_required_plugins($required_plugins)) { ?>
	<!-- start wrapper-->
	<div class="wrapper" id="wrapper">
		<?php get_template_part( 'template-parts/content', 'header' ); ?>
		<?php get_template_part( 'template-parts/parts/part', 'breadcrumbs' ); ?>
		<!-- start main -->
		<main class="main_content">
	<?php } ?>


