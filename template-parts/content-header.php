<header class="header">
    <div class="container_center">
        <div class="header__content">
            <?php if (class_exists('SCF') && SCF::get_option_meta('my-theme-settings', 'option_header_img')) { ?>
                <a class="header__logo" href="<?php echo esc_url(home_url("/")); ?>">
                    <?php echo wp_get_attachment_image(SCF::get_option_meta( 'my-theme-settings', 'option_header_img' ), 'full') ?>
                </a>
            <?php } ?>

            <div class="header__nav">
                <nav class="navbar">
                    <?php 
                        // wp_nav_menu(array(
                        //     'theme_location' => 'header',
                        //     'container' =>'ul',
                        // )); 
                        if (class_exists('SCF')) {
                            $home_id = get_option('page_on_front');
                            $sections_manager = SCF::get('sections_order_manager', $home_id);

                        }

                        // get_pr($sections_manager);

                        if (class_exists('SCF') && !empty($sections_manager) && is_array($sections_manager)) {
                            echo '<ul class="menu">';
                            foreach ($sections_manager as $section) {
                                $is_active = false;
                                
                                // Ваша существующая логика проверки активности
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
                                    $section_name = $section['section_name'];
                                    
                                    // Используем кастомное название меню если оно задано
                                    if (!empty($section['menu_title'])) {
                                        $menu_label = $section['menu_title'];
                                    } else {
                                        // Если menu_title не задано, пропускаем этот пункт
                                        continue;
                                    }
                                    
                                    echo '<li class="menu-item">';
                                    echo '<a href="#' . esc_attr($section_name) . '">' . esc_html($menu_label) . '</a>';
                                    echo '</li>';
                                }
                            }
                            echo '</ul>';
                        }
                    ?>

                </nav>
            </div>
            <div class="header__toggle" id="toggle"><span></span></div>
        </div>
    </div>
</header>

<!-- 
<ul id="menu-header" class="menu">
    <li id="menu-item-11" class="menu-item">
        <a href="https://theme.sms.workpreview.ru/" aria-current="page">home page</a>
    </li>
    <li id="menu-item-12" class="menu-item"><a href="#benefits">test</a></li>
</ul> -->