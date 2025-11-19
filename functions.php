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
}
add_action( 'after_setup_theme', 'sms_setup' );

function sms_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'sms_content_width', 640 );
}
add_action( 'after_setup_theme', 'sms_content_width', 0 );

function webp_upload_mimes( $existing_mimes ) {
    $existing_mimes['webp'] = 'image/webp';
    return $existing_mimes;
}
add_filter( 'mime_types', 'webp_upload_mimes' );

add_action('admin_menu', 'remove_menus');
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
    // remove_menu_page('edit.php?post_type=smart-custom-fields');
}

// Отключаем принудительную проверку новых версий WP, плагинов и темы в админке,
require get_template_directory() . '/inc/disable-verification.php';
require get_template_directory() . '/inc/helpers.php';

require_once get_template_directory() . '/inc/plugins-required.php';


// Проверяем существует ли класс Smart_Custom_Fields
if (class_exists('Smart_Custom_Fields')) {
	/**
	 * SCF
	 */
	require get_template_directory() . '/inc/scf/fields/html-example.php';
	require get_template_directory() . '/inc/scf/fields/link.php';

	require get_template_directory() . '/inc/scf/home.php';

	/**
	 * SCF settings. my-theme-settings
	*/
	add_action('init', function () {
		SCF::add_options_page( 'Настройки сайта', 'Настройки сайта', 'manage_options', 'my-theme-settings','dashicons-welcome-widgets-menus', 150 );
	});
	require get_template_directory() . '/inc/scf/settings.php';
}


// удалить тег p в contact form 7
add_filter( 'wpcf7_autop_or_not', '__return_false');

// Убираем префиксы у архивных заголовков
add_filter( 'get_the_archive_title', function( $title ) {
    if ( is_category() ) {
        $title = single_cat_title( '', false );
    } elseif ( is_tag() ) {
        $title = single_tag_title( '', false );
    } elseif ( is_author() ) {
        $title = '<span class="vcard">' . get_the_author() . '</span>';
    } elseif ( is_tax() ) { // для произвольных таксономий
        $title = single_term_title( '', false );
    } elseif ( is_post_type_archive() ) {
        $title = post_type_archive_title( '', false );
    }
    return $title;
});


function the_excerpt_max_charlength( $charlength ){
	$excerpt = get_the_excerpt();
	$charlength++;

	if ( mb_strlen( $excerpt ) > $charlength ) {
		$subex = mb_substr( $excerpt, 0, $charlength - 5 );
		$exwords = explode( ' ', $subex );
		$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
		if ( $excut < 0 ) {
			echo mb_substr( $subex, 0, $excut );
		} else {
			echo $subex;
		}
		echo '...';
	} else {
		echo $excerpt;
	}
}

function the_paginate( $query = null ) {
    // Если запрос не передан, используем глобальный
    if ( ! $query ) {
        global $wp_query;
        $query = $wp_query;
    }
    
    if ( $query->max_num_pages <= 1 ) {
        return;
    }
    
    $paged = get_query_var('paged') ? intval(get_query_var('paged')) : 1;
    
    echo '<nav class="pagination">';
    echo paginate_links( array(
        'base'      => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
        'format'    => '?paged=%#%',
        'current'   => max( 1, $paged ),
        'total'     => $query->max_num_pages,
        'prev_text' => '←',
        'next_text' => '→',
        'mid_size'  => 1,
        'end_size'  => 1
    ) );
    echo '</nav>';
}
