<?php
if ( ! defined( '_S_VERSION' ) ) {
	define( '_S_VERSION', '1.0.1' );
}

function sms_scripts() {
	wp_enqueue_style( 'sms-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_enqueue_style('sms-aos', get_template_directory_uri() . '/assets/css/aos.css', array(), _S_VERSION, 'all');
	wp_enqueue_style('sms-main-style', get_template_directory_uri() . '/assets/css/style.css', array(), _S_VERSION, 'all');

	wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', get_template_directory_uri() . '/assets/js/jquery.js', array(), false, true);
    wp_enqueue_script( 'jquery' );

	wp_enqueue_script( 'sms-aos', get_template_directory_uri() . '/assets/js/aos.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'sms-modal', get_template_directory_uri() . '/assets/js/modal.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'sms-menu', get_template_directory_uri() . '/assets/js/menu.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'sms-function', get_template_directory_uri() . '/assets/js/function.js', array(), _S_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'sms_scripts' );

function admin_styles_scripts() {
	wp_enqueue_style("sms-admin-css", get_template_directory_uri() . '/assets/css/wp-admin.css', array(), _S_VERSION, 'all');
	wp_enqueue_script("sms-sections-order-admin", get_template_directory_uri() . '/assets/js/sections-order-admin.js');
}
add_action('admin_enqueue_scripts', 'admin_styles_scripts');

function sms_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	register_nav_menus(
		array(
			'header' => esc_html__( 'header', 'sms' ),
		)
	);

	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);

	// Set up the WordPress core custom background feature.
	// add_theme_support(
	// 	'custom-background',
	// 	apply_filters(
	// 		'sms_custom_background_args',
	// 		array(
	// 			'default-color' => 'ffffff',
	// 			'default-image' => '',
	// 		)
	// 	)
	// );

	// Добавляем поддержку customizer
	add_theme_support('settings_site_options');
}
add_action( 'after_setup_theme', 'sms_setup' );

/**
 * Customizer additions.
 */
require get_template_directory() . '/customizer/customizer.php';


function sms_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'sms_content_width', 640 );
}
add_action( 'after_setup_theme', 'sms_content_width', 0 );

function webp_upload_mimes( $existing_mimes ) {
    $existing_mimes['webp'] = 'image/webp';
    return $existing_mimes;
}
add_filter( 'mime_types', 'webp_upload_mimes' );

function remove_menus() {
    // remove_menu_page('index.php');                # Консоль 
    // remove_menu_page('edit.php');                 # Записи 
    remove_menu_page('edit-comments.php');        # Комментарии 
    // remove_menu_page('edit.php?post_type=page');  # Страницы 
    // remove_menu_page('upload.php');               # Медиафайлы 
    // remove_menu_page('themes.php');               # Внешний вид 
    // remove_menu_page('plugins.php');              # Плагины 
    // remove_menu_page('users.php');                # Пользователи 
    // remove_menu_page('tools.php');                # Инструменты 
    // remove_menu_page('options-general.php');      # Параметры 
    remove_menu_page('edit.php?post_type=smart-custom-fields');
}
add_action('admin_menu', 'remove_menus');

// Отключаем принудительную проверку новых версий WP, плагинов и темы в админке,
require get_template_directory() . '/inc/disable-verification.php';

/**
 * Подключаем список необходимых плагинов
 */
require_once get_template_directory() . '/inc/plugins-required.php';

/**
 * Подключаем настройки Smart Custom Fields
 */
require get_template_directory() . '/inc/scf/scf-init.php';
// require get_template_directory() . '/scf/index.php';

/**
 * Подключаем утилиты темы
 */
require get_template_directory() . '/inc/utilities.php';

/**
 * Подключаем хлебные крошки
 */
require get_template_directory() . '/inc/breadcrumb.php';

