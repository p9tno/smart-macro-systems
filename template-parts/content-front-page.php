<?php


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
}