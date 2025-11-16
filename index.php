<?php get_header(); ?>

<?php
// Проверяем все необходимые плагины
$required_plugins = theme_get_required_plugins();

if (theme_check_required_plugins($required_plugins)) {
    // Все плагины активны, загружаем контент
    if (class_exists('SCF')) {
        $home_id = get_option('page_on_front');
        $sections_manager = SCF::get('sections_order_manager', $home_id);
        
        if (!empty($sections_manager) && is_array($sections_manager)) {
            foreach ($sections_manager as $section) {
                $is_active = false;
                
                if (isset($section['section_active']['yes']) && $section['section_active']['yes'] === 'yes') {
                    $is_active = true;
                }
                elseif (isset($section['section_active']) && $section['section_active'] === 'yes') {
                    $is_active = true;
                }
                elseif (!isset($section['section_active'])) {
                    $is_active = true;
                }
                
                if ($is_active && !empty($section['section_name'])) {
                    get_template_part('template-parts/sections/section', $section['section_name']);
                }
            }
        } else {
            // Если секции не настроены, показываем сообщение для администратора
            if (current_user_can('manage_options')) {
                get_template_part('template-parts/sections/section', 'setup-guide');
            }
        }
    }
} else {
    // Показываем сообщение о необходимости плагинов
    get_template_part('template-parts/sections/section', 'plugin-required', array(
        'required_plugins' => $required_plugins
    ));
}
?>

<?php get_footer(); ?>