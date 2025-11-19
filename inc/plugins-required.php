<?php

/**
 * Получает список необходимых плагинов
 */
function theme_get_required_plugins() {
    return apply_filters('theme_required_plugins', array(

        'smart-custom-fields' => array(
            'name' => 'Smart Custom Fields',
            'slug' => 'smart-custom-fields',
            'file' => 'smart-custom-fields/smart-custom-fields.php',
            'required' => true,
            'description' => 'Необходим для управления кастомными полями.'
        ),

        'contact-form-7' => array(
            'name' => 'Contact Form 7',
            'slug' => 'contact-form-7',
            'file' => 'contact-form-7/wp-contact-form-7.php',
            'required' => true,
            'description' => 'Необходим для работы контактных форм на сайте.'
        ),

        'classic-editor' => array(
            'name' => 'Classic Editor',
            'slug' => 'classic-editor',
            'file' => 'classic-editor/classic-editor.php',
            'required' => false,
            'description' => 'Возвращает классический редактор WordPress.'
        ),

        'cyr2lat' => array(
            'name' => 'Cyr to Lat',
            'slug' => 'cyr2lat',
            'file' => 'cyr2lat/cyr-to-lat.php',
            'required' => false,
            'description' => 'Транслитерирует кириллические URL в латинские.'
        ),

        'svg-support' => array(
            'name' => 'SVG Support',
            'slug' => 'svg-support',
            'file' => 'svg-support/svg-support.php',
            'required' => false,
            'description' => 'Комплексное решение SVG для WordPress.'
        )

    ));
}

/**
 * Проверяет, установлены ли все необходимые плагины
 */
function theme_check_required_plugins($plugins) {
    foreach ($plugins as $plugin) {
        if ($plugin['required'] && !is_plugin_active($plugin['file'])) {
            return false;
        }
    }
    return true;
}

/**
 * Проверяет, установлен ли плагин
 */
function is_plugin_installed($plugin_file) {
    if (!function_exists('get_plugins')) {
        require_once ABSPATH . 'wp-admin/includes/plugin.php';
    }
    
    $all_plugins = get_plugins();
    return isset($all_plugins[$plugin_file]);
}

/**
 * Получает статусы всех необходимых плагинов
 */
function theme_get_plugins_status() {
    $plugins = theme_get_required_plugins();
    $status = array();
    
    foreach ($plugins as $key => $plugin) {
        $status[$key] = array(
            'name' => $plugin['name'],
            'installed' => is_plugin_installed($plugin['file']),
            'active' => is_plugin_active($plugin['file']),
            'required' => $plugin['required'],
            'file' => $plugin['file'],
            'slug' => $plugin['slug'],
            'description' => $plugin['description']
        );
    }
    
    return $status;
}

/**
 * Уведомление в админ-панели
 */
function theme_required_plugins_admin_notice() {
    $plugins_status = theme_get_plugins_status();
    $missing_plugins = array();
    
    foreach ($plugins_status as $plugin) {
        if ($plugin['required'] && !$plugin['active']) {
            $missing_plugins[] = $plugin['name'];
        }
    }
    
    if (!empty($missing_plugins) && current_user_can('install_plugins')) {
        ?>
        <div class="notice notice-error is-dismissible">
            <p>
                <strong>Тема требует установки плагинов:</strong> 
                Для правильной работы темы необходимо установить и активировать 
                <strong><?php echo implode(', ', $missing_plugins); ?></strong>.
                <a href="<?php echo esc_url(admin_url('themes.php?page=theme-plugins')); ?>">Установить сейчас</a>
            </p>
        </div>
        <?php
    }
}
add_action('admin_notices', 'theme_required_plugins_admin_notice');

/**
 * Страница установки плагинов в настройках темы
 */
function theme_plugins_page() {
    add_theme_page(
        'Необходимые плагины',
        'Требуемые плагины',
        'install_plugins',
        'theme-plugins',
        'theme_plugins_page_content'
    );
}
add_action('admin_menu', 'theme_plugins_page');

function theme_plugins_page_content() {
    $plugins_status = theme_get_plugins_status();
    ?>
    <div class="wrap">
        <h1>Необходимые плагины для темы</h1>
        
        <div class="card" style="max-width: 100%;">
            <p>Следующие плагины необходимы для полной функциональности темы:</p>
            
            <table class="wp-list-table widefat fixed striped">
                <thead>
                    <tr>
                        <th>Плагин</th>
                        <th>Описание</th>
                        <th>Статус</th>
                        <th>Действие</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($plugins_status as $plugin): ?>
                    <tr>
                        <td>
                            <strong><?php echo esc_html($plugin['name']); ?></strong>
                            <?php if ($plugin['required']): ?>
                                <span style="color: red;">*</span>
                            <?php endif; ?>
                        </td>
                        <td><?php echo esc_html($plugin['description']); ?></td>
                        <td>
                            <?php if ($plugin['active']): ?>
                                <span style="color: green;">✅ Активен</span>
                            <?php elseif ($plugin['installed']): ?>
                                <span style="color: orange;">⚠️ Не активен</span>
                            <?php else: ?>
                                <span style="color: red;">❌ Не установлен</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if ($plugin['active']): ?>
                                <span class="button disabled">Активен</span>
                            <?php elseif ($plugin['installed']): ?>
                                <a href="<?php echo esc_url(wp_nonce_url(admin_url('plugins.php?action=activate&plugin=' . urlencode($plugin['file'])), 'activate-plugin_' . $plugin['file'])); ?>" 
                                   class="button button-primary">
                                    Активировать
                                </a>
                            <?php else: ?>
                                <a href="<?php echo esc_url(wp_nonce_url(self_admin_url('update.php?action=install-plugin&plugin=' . $plugin['slug']), 'install-plugin_' . $plugin['slug'])); ?>" 
                                   class="button button-primary">
                                    Установить
                                </a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            
            <p><small><span style="color: red;">*</span> - обязательные плагины</small></p>
            
            <div style="margin-top: 20px;">
                <a href="<?php echo esc_url(home_url()); ?>" class="button" target="_blank">Посмотреть сайт</a>
                <a href="<?php echo esc_url(admin_url('plugins.php')); ?>" class="button">Все плагины</a>
            </div>
        </div>
    </div>
    <?php
}

/**
 * Хук для добавления своих плагинов в список необходимых
 */
add_filter('theme_required_plugins', function($plugins) {
    // Пример добавления дополнительного плагина
    // $plugins['my-custom-plugin'] = array(
    //     'name' => 'My Custom Plugin',
    //     'slug' => 'my-custom-plugin',
    //     'file' => 'my-custom-plugin/my-custom-plugin.php',
    //     'required' => false,
    //     'description' => 'Дополнительный функционал для темы.'
    // );
    
    return $plugins;
});