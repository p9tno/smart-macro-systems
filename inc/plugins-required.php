<?php
/**
 * Функции для управления обязательными плагинами темы
 */

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
 * Функция для массовой установки плагинов
 */
function theme_bulk_install_plugins() {
    if (!current_user_can('install_plugins') || !wp_verify_nonce($_POST['_wpnonce'], 'theme_bulk_install_plugins')) {
        wp_die('У вас нет прав для выполнения этого действия.');
    }

    $plugins_status = theme_get_plugins_status();
    $results = array();
    
    foreach ($plugins_status as $plugin) {
        if ($plugin['required'] && !$plugin['active']) {
            if (!$plugin['installed']) {
                // Установка плагина
                $result = theme_install_plugin($plugin['slug']);
                $results[$plugin['name']] = $result;
                
                // Если установка успешна, активируем плагин
                if ($result['success']) {
                    theme_activate_plugin($plugin['file']);
                }
            } elseif (!$plugin['active']) {
                // Активация уже установленного плагина
                $result = theme_activate_plugin($plugin['file']);
                $results[$plugin['name']] = $result;
            }
        }
    }
    
    return $results;
}

/**
 * Установка отдельного плагина
 */
function theme_install_plugin($plugin_slug) {
    if (!current_user_can('install_plugins')) {
        return array('success' => false, 'message' => 'Недостаточно прав');
    }
    
    include_once ABSPATH . 'wp-admin/includes/plugin-install.php';
    include_once ABSPATH . 'wp-admin/includes/file.php';
    include_once ABSPATH . 'wp-admin/includes/misc.php';
    include_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
    
    $api = plugins_api('plugin_information', array(
        'slug' => $plugin_slug,
        'fields' => array(
            'short_description' => false,
            'sections' => false,
            'requires' => false,
            'rating' => false,
            'ratings' => false,
            'downloaded' => false,
            'last_updated' => false,
            'added' => false,
            'tags' => false,
            'compatibility' => false,
            'homepage' => false,
            'donate_link' => false,
        ),
    ));
    
    if (is_wp_error($api)) {
        return array('success' => false, 'message' => $api->get_error_message());
    }
    
    $upgrader = new Plugin_Upgrader(new Automatic_Upgrader_Skin());
    $result = $upgrader->install($api->download_link);
    
    if (is_wp_error($result)) {
        return array('success' => false, 'message' => $result->get_error_message());
    }
    
    return array('success' => true, 'message' => 'Плагин успешно установлен');
}

/**
 * Активация плагина
 */
function theme_activate_plugin($plugin_file) {
    if (!current_user_can('activate_plugins')) {
        return array('success' => false, 'message' => 'Недостаточно прав для активации');
    }
    
    $result = activate_plugin($plugin_file);
    
    if (is_wp_error($result)) {
        return array('success' => false, 'message' => $result->get_error_message());
    }
    
    return array('success' => true, 'message' => 'Плагин успешно активирован');
}

/**
 * Страница установки плагинов в меню плагинов
 */
function theme_plugins_page() {
    add_plugins_page(
        'Необходимые плагины темы',
        'Требуемые плагины темы',
        'install_plugins',
        'theme-required-plugins',
        'theme_plugins_page_content'
    );
}
add_action('admin_menu', 'theme_plugins_page');

function theme_plugins_page_content() {
    $plugins_status = theme_get_plugins_status();
    $missing_required = array();
    $missing_optional = array();
    $all_missing = array();
    
    foreach ($plugins_status as $plugin) {
        if (!$plugin['active']) {
            $all_missing[] = $plugin;
            if ($plugin['required']) {
                $missing_required[] = $plugin;
            } else {
                $missing_optional[] = $plugin;
            }
        }
    }
    
    // Проверяем, был ли выполнен массовый запрос
    $bulk_results = array();
    $install_type = '';
    
    if (isset($_POST['theme_bulk_install_all']) && wp_verify_nonce($_POST['_wpnonce'], 'theme_bulk_install_plugins')) {
        $install_type = 'all';
        $bulk_results = theme_bulk_install_all_plugins();
        $plugins_status = theme_get_plugins_status();
    } elseif (isset($_POST['theme_bulk_install_required']) && wp_verify_nonce($_POST['_wpnonce'], 'theme_bulk_install_plugins')) {
        $install_type = 'required';
        $bulk_results = theme_bulk_install_plugins();
        $plugins_status = theme_get_plugins_status();
    }
    
    // Обновляем списки после установки
    $missing_required = array();
    $missing_optional = array();
    $all_missing = array();
    foreach ($plugins_status as $plugin) {
        if (!$plugin['active']) {
            $all_missing[] = $plugin;
            if ($plugin['required']) {
                $missing_required[] = $plugin;
            } else {
                $missing_optional[] = $plugin;
            }
        }
    }
    ?>
    <div class="wrap">
        <h1>Необходимые плагины для темы</h1>
        
        <?php if (!empty($bulk_results)): ?>
        <div class="notice notice-<?php echo ($install_type === 'all' && empty($all_missing)) ? 'success' : 'info'; ?> is-dismissible">
            <h3>Результаты установки (<?php echo $install_type === 'all' ? 'Все плагины' : 'Только обязательные'; ?>):</h3>
            <ul>
                <?php foreach ($bulk_results as $plugin_name => $result): ?>
                    <li>
                        <strong><?php echo esc_html($plugin_name); ?>:</strong>
                        <?php echo $result['success'] ? '✅ ' : '❌ '; ?>
                        <?php echo esc_html($result['message']); ?>
                    </li>
                <?php endforeach; ?>
            </ul>
            <?php if ($install_type === 'all' && empty($all_missing)): ?>
                <p><strong>🎉 Все плагины установлены и активированы!</strong></p>
            <?php elseif ($install_type === 'required' && empty($missing_required)): ?>
                <p><strong>✅ Все обязательные плагины установлены и активированы!</strong></p>
            <?php endif; ?>
        </div>
        <?php endif; ?>
        
        <div class="card" style="max-width: 100%;">
            <p>Следующие плагины расширяют функциональность темы:</p>
            
            <!-- Блок массовой установки -->
            <div class="bulk-action-section" style="margin: 20px 0; padding: 20px; background: #f8f9fa; border-radius: 8px; border: 1px solid #ddd;">
                <h3 style="margin-top: 0;">Массовая установка</h3>
                
                <?php if (!empty($missing_required)): ?>
                <div style="margin-bottom: 20px; padding: 15px; background: #fff3cd; border-radius: 5px; border-left: 4px solid #ffc107;">
                    <h4 style="margin-top: 0; color: #856404;">⚡ Обязательные плагины</h4>
                    <p style="margin-bottom: 15px;">Эти плагины необходимы для основной функциональности темы.</p>
                    <form method="post" style="display: inline;">
                        <?php wp_nonce_field('theme_bulk_install_plugins'); ?>
                        <input type="hidden" name="theme_bulk_install_required" value="1">
                        <button type="submit" class="button button-primary">
                            Установить все обязательные (<?php echo count($missing_required); ?>)
                        </button>
                    </form>
                    <p style="margin: 10px 0 0 0; font-size: 0.9em; color: #666;">
                        Будет установлено: <?php echo implode(', ', array_map(function($p) { return $p['name']; }, $missing_required)); ?>
                    </p>
                </div>
                <?php endif; ?>
                
                <?php if (!empty($missing_optional)): ?>
                <div style="margin-bottom: 10px; padding: 15px; background: #e7f3ff; border-radius: 5px; border-left: 4px solid #0073aa;">
                    <h4 style="margin-top: 0; color: #0066cc;">💎 Дополнительные плагины</h4>
                    <p style="margin-bottom: 15px;">Эти плагины добавляют полезные функции, но не обязательны для работы темы.</p>
                    <form method="post" style="display: inline;">
                        <?php wp_nonce_field('theme_bulk_install_plugins'); ?>
                        <input type="hidden" name="theme_bulk_install_all" value="1">
                        <button type="submit" class="button">
                            Установить все плагины (<?php echo count($all_missing); ?>)
                        </button>
                    </form>
                    <p style="margin: 10px 0 0 0; font-size: 0.9em; color: #666;">
                        Будет установлено: <?php echo implode(', ', array_map(function($p) { return $p['name']; }, $all_missing)); ?>
                    </p>
                </div>
                <?php endif; ?>
                
                <?php if (empty($all_missing)): ?>
                <div style="padding: 20px; background: #d4edda; border-radius: 5px; text-align: center; border-left: 4px solid #28a745;">
                    <p style="margin: 0; font-weight: bold; color: #155724; font-size: 16px;">🎉 Все плагины установлены и активированы!</p>
                </div>
                <?php endif; ?>
            </div>
            
            <!-- Таблица плагинов -->
            <table class="wp-list-table widefat fixed striped">
                <thead>
                    <tr>
                        <th>Плагин</th>
                        <th>Описание</th>
                        <th>Тип</th>
                        <th>Статус</th>
                        <th>Действие</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($plugins_status as $plugin): ?>
                    <tr>
                        <td>
                            <strong><?php echo esc_html($plugin['name']); ?></strong>
                        </td>
                        <td><?php echo esc_html($plugin['description']); ?></td>
                        <td>
                            <?php if ($plugin['required']): ?>
                                <span style="color: #dc3545; font-weight: bold;">🔴 Обязательный</span>
                            <?php else: ?>
                                <span style="color: #0073aa;">🔵 Дополнительный</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if ($plugin['active']): ?>
                                <span style="color: green; font-weight: bold;">✅ Активен</span>
                            <?php elseif ($plugin['installed']): ?>
                                <span style="color: orange; font-weight: bold;">⚠️ Не активен</span>
                            <?php else: ?>
                                <span style="color: red; font-weight: bold;">❌ Не установлен</span>
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
            
            <!-- Нижние кнопки -->
            <div style="margin-top: 20px; display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <a href="<?php echo esc_url(home_url()); ?>" class="button" target="_blank">Посмотреть сайт</a>
                    <a href="<?php echo esc_url(admin_url('plugins.php')); ?>" class="button">Все плагины</a>
                </div>
                <?php if (!empty($all_missing)): ?>
                <div>
                    <?php if (!empty($missing_required)): ?>
                    <form method="post" style="display: inline; margin-right: 10px;">
                        <?php wp_nonce_field('theme_bulk_install_plugins'); ?>
                        <input type="hidden" name="theme_bulk_install_required" value="1">
                        <button type="submit" class="button button-primary">
                            ⚡ Только обязательные
                        </button>
                    </form>
                    <?php endif; ?>
                    <form method="post" style="display: inline;">
                        <?php wp_nonce_field('theme_bulk_install_plugins'); ?>
                        <input type="hidden" name="theme_bulk_install_all" value="1">
                        <button type="submit" class="button">
                            💎 Все плагины
                        </button>
                    </form>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <style>
    .button-large {
        padding: 12px 24px;
        font-size: 16px;
        font-weight: bold;
    }
    .bulk-action-section {
        border: 1px solid #ddd;
    }
    </style>
    <?php
}

/**
 * Функция для массовой установки ВСЕХ плагинов (обязательных и необязательных)
 */
function theme_bulk_install_all_plugins() {
    if (!current_user_can('install_plugins') || !wp_verify_nonce($_POST['_wpnonce'], 'theme_bulk_install_plugins')) {
        wp_die('У вас нет прав для выполнения этого действия.');
    }

    $plugins_status = theme_get_plugins_status();
    $results = array();
    
    foreach ($plugins_status as $plugin) {
        if (!$plugin['active']) {
            if (!$plugin['installed']) {
                // Установка плагина
                $result = theme_install_plugin($plugin['slug']);
                $results[$plugin['name']] = $result;
                
                // Если установка успешна, активируем плагин
                if ($result['success']) {
                    theme_activate_plugin($plugin['file']);
                }
            } elseif (!$plugin['active']) {
                // Активация уже установленного плагина
                $result = theme_activate_plugin($plugin['file']);
                $results[$plugin['name']] = $result;
            }
        }
    }
    
    return $results;
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
                <a href="<?php echo esc_url(admin_url('plugins.php?page=theme-required-plugins')); ?>">Установить сейчас</a>
            </p>
        </div>
        <?php
    }
}
add_action('admin_notices', 'theme_required_plugins_admin_notice');

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