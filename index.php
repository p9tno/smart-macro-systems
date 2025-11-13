<?php get_header(); ?>

<?php
if (class_exists('SCF')) {
    $home_id = get_option('page_on_front');
    $sections_manager = SCF::get('sections_order_manager', $home_id);
    // get_pr($sections_manager);

}

if (class_exists('SCF') && !empty($sections_manager) && is_array($sections_manager)) {
    foreach ($sections_manager as $section) {
        // Проверяем, активна ли секция
        $is_active = false;
        
        if (isset($section['section_active']['yes']) && $section['section_active']['yes'] === 'yes') {
            $is_active = true;
        }
        elseif (isset($section['section_active']) && $section['section_active'] === 'yes') {
            $is_active = true;
        }
        elseif (!isset($section['section_active'])) {
            $is_active = true; // считаем активной по умолчанию
        }
        
        if ($is_active && !empty($section['section_name'])) {
            get_template_part('template-parts/sections/section', $section['section_name']);
        }
    }
} else {
   ?> <h1 style="color: #000000;">Активируйте плагины</h1> <?php
}

?>

<?php get_footer(); ?>