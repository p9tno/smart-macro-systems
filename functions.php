<?php
if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.1' );
}

function sms_scripts() {
	wp_enqueue_style( 'sms-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_enqueue_style('sms-aos', get_template_directory_uri() . '/assets/css/aos.css', array(), _S_VERSION, 'all');
	wp_enqueue_style('sms-main-style', get_template_directory_uri() . '/assets/css/style.css', array(), _S_VERSION, 'all');

	wp_deregister_script( 'jquery' ); //разрегистирируем скрипт jquery
    wp_register_script( 'jquery', get_template_directory_uri() . '/assets/js/jquery.js', array(), false, true);
    wp_enqueue_script( 'jquery' );

	wp_enqueue_script( 'sms-aos', get_template_directory_uri() . '/assets/js/aos.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'sms-function', get_template_directory_uri() . '/assets/js/function.js', array(), _S_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'sms_scripts' );

function admin_styles_scripts() {
	wp_enqueue_style("sms-admin-css", get_template_directory_uri() . '/assets/css/wp-admin.css', array(), _S_VERSION, 'all');
	// wp_enqueue_script("sms-admin-js", get_template_directory_uri() . '/assets/js/wp-admin.js');
}
add_action('admin_enqueue_scripts', 'admin_styles_scripts');

function sms_setup() {
	add_theme_support( 'title-tag' );

	add_theme_support( 'post-thumbnails' );
	// add_image_size( 'custom-lg', 900, 600, true);

	// This theme uses wp_nav_menu() in one location.
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
}
add_action( 'after_setup_theme', 'sms_setup' );

function sms_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'sms_content_width', 640 );
}
add_action( 'after_setup_theme', 'sms_content_width', 0 );

function webp_upload_mimes( $existing_mimes ) {
    // add webp to the list of mime types
    $existing_mimes['webp'] = 'image/webp';

    // return the array back to the function with our added mime type
    return $existing_mimes;
}
add_filter( 'mime_types', 'webp_upload_mimes' );

add_action('admin_menu', 'remove_menus');
function remove_menus() {
    //remove_menu_page('index.php');                # Консоль 
    remove_menu_page('edit.php');                 # Записи 
    remove_menu_page('edit-comments.php');        # Комментарии 
    //remove_menu_page('edit.php?post_type=page');  # Страницы 
    //remove_menu_page('upload.php');               # Медиафайлы 
    //remove_menu_page('themes.php');               # Внешний вид 
    //remove_menu_page('plugins.php');              # Плагины 
    // remove_menu_page('users.php');                # Пользователи 
    // remove_menu_page('tools.php');                # Инструменты 
    //remove_menu_page('options-general.php');      # Параметры 
    remove_menu_page('edit.php?post_type=smart-custom-fields');
}



// Отключаем принудительную проверку новых версий WP, плагинов и темы в админке,
require get_template_directory() . '/inc/disable-verification.php';
require get_template_directory() . '/inc/helpers.php';


/**
 * SCF
 */
require get_template_directory() . '/inc/scf/home.php';

/**
 * SCF settings. my-theme-settings
 */
add_action('init', function () {
	SCF::add_options_page( 'Site management', 'Site management', 'manage_options', 'my-theme-settings','dashicons-welcome-widgets-menus', 150 );
});
require get_template_directory() . '/inc/scf/settings.php';

// Notice: ob_end_flush(): Failed to send buffer of zlib output compression (0) in /home/deesseucp/public_html/newbeginnings.deessemedia.com/wp-includes/functions.php on line 5373
remove_action('shutdown', 'wp_ob_end_flush_all', 1);

