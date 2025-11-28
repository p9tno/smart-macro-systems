<?php
/**
 * Инициализация Smart Custom Fields
 */

// Проверяем активирован ли плагин SCF
if (!class_exists('Smart_Custom_Fields')) {
    return;
}

/**
 * Подключаем кастомные поля SCF
 */
$scf_fields = [
    '/inc/scf/fields/html-example.php',
    '/inc/scf/fields/link.php',
    '/inc/scf/fields/number.php',
    '/inc/scf/fields/range.php',
    '/inc/scf/fields/media.php'
];

foreach ($scf_fields as $field) {
    $file_path = get_template_directory() . $field;
    if (file_exists($file_path)) {
        require_once $file_path;
    }
}

/**
 * Подключаем настройки полей для разных страниц
 */
$scf_settings = [
    '/inc/scf/home.php',
    '/inc/scf/settings.php',
];

foreach ($scf_settings as $setting) {
    $file_path = get_template_directory() . $setting;
    if (file_exists($file_path)) {
        require_once $file_path;
    }
}

/**
 * Добавляем страницу настроек в админку
 */
add_action('init', function () {
    SCF::add_options_page(
        'Настройки сайта', 
        'Настройки сайта', 
        'manage_options', 
        'my-theme-settings',
        'dashicons-welcome-widgets-menus', 
        150
    );
});