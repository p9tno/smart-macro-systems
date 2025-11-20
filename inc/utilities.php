<?php
/**
 * Вспомогательные функции темы
 * 
 * @package MyTheme
 */

if (!defined('ABSPATH')) {
    exit;
}

if (!function_exists('get_pr')) {
    /**
     * Debug функция для красивого вывода переменных через print_r
     * 
     * Удобный инструмент для отладки, который форматирует вывод переменных
     * в читаемом виде с тегами <pre> для браузера
     */
    function get_pr($var, $die = false) {
        // Открываем pre-тег для форматированного вывода
        echo '<pre style="
            background: #f4f4f4;
            border: 1px solid #ddd;
            padding: 15px;
            margin: 10px 0;
            border-radius: 5px;
            font-size: 14px;
            line-height: 1.4;
            color: #333;
            overflow: auto;
            max-height: 100vh;
        ">';
        
        // Выводим содержимое переменной
        print_r($var);
        
        echo '</pre>';
        
        // Останавливаем выполнение если требуется
        if ($die) {
            die('<div style="color: #d00; padding: 10px; background: #fee; border: 1px solid #d00; margin: 10px 0;">Script terminated by get_pr()</div>');
        }
    }
}

/**
 * Удаляем тег p в Contact Form 7
 */
add_filter('wpcf7_autop_or_not', '__return_false');

/**
 * Убираем префиксы у архивных заголовков
 */
add_filter('get_the_archive_title', 'my_theme_archive_title_filter');
function my_theme_archive_title_filter($title) {
    if (is_category()) {
        $title = single_cat_title('', false);
    } elseif (is_tag()) {
        $title = single_tag_title('', false);
    } elseif (is_author()) {
        $title = '<span class="vcard">' . get_the_author() . '</span>';
    } elseif (is_tax()) {
        $title = single_term_title('', false);
    } elseif (is_post_type_archive()) {
        $title = post_type_archive_title('', false);
    }
    return $title;
}

/**
 * Обрезает excerpt до определенного количества символов
 * 
 * @param int $charlength Максимальное количество символов
 */
function the_excerpt_max_charlength($charlength) {
    $excerpt = get_the_excerpt();
    $charlength++;

    if (mb_strlen($excerpt) > $charlength) {
        $subex = mb_substr($excerpt, 0, $charlength - 5);
        $exwords = explode(' ', $subex);
        $excut = -(mb_strlen($exwords[count($exwords) - 1]));
        if ($excut < 0) {
            echo mb_substr($subex, 0, $excut);
        } else {
            echo $subex;
        }
        echo '...';
    } else {
        echo $excerpt;
    }
}

/**
 * Выводит пагинацию
 * 
 * @param WP_Query|null $query Объект WP_Query (по умолчанию глобальный $wp_query)
 */
function the_paginate($query = null) {
    // Если запрос не передан, используем глобальный
    if (!$query) {
        global $wp_query;
        $query = $wp_query;
    }
    
    if ($query->max_num_pages <= 1) {
        return;
    }
    
    $paged = get_query_var('paged') ? intval(get_query_var('paged')) : 1;
    
    echo '<nav class="pagination">';
    echo paginate_links(array(
        'base'      => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
        'format'    => '?paged=%#%',
        'current'   => max(1, $paged),
        'total'     => $query->max_num_pages,
        'prev_text' => '←',
        'next_text' => '→',
        'mid_size'  => 1,
        'end_size'  => 1
    ));
    echo '</nav>';
}

/**
 * Простая функция для вывода ссылки - только для текущего поста
 */
function display_simple_cta_link( $field_name = 'cta_button', $default_title = 'Click Here', $class = 'cta-button' ) {
    if ( ! function_exists( 'SCF::get' ) ) {
        return;
    }
    
    $link = SCF::get( $field_name );
    
    if ( empty( $link['url'] ) ) {
        return;
    }
    
    $title = ! empty( $link['title'] ) ? $link['title'] : $default_title;
    
    echo '<a href="' . esc_url( $link['url'] ) . '" 
              target="' . esc_attr( $link['target'] ?? '_self' ) . '" 
              class="' . esc_attr( $class ) . '">' 
              . esc_html( $title ) . 
          '</a>';
}

// Просто вставляем там где нужно
// display_simple_cta_link( 'cta_button', 'Get Started', 'main-cta' );