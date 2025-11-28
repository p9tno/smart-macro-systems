<?php
/**
 * Функции для управления обязательными плагинами темы
 */

// Защита от прямого доступа
defined('ABSPATH') || exit;

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
            'description' => 'Необходим для управления кастомными полями.',
            'source' => 'repo'
        ),

        'contact-form-7' => array(
            'name' => 'Contact Form 7',
            'slug' => 'contact-form-7',
            'file' => 'contact-form-7/wp-contact-form-7.php',
            'required' => true,
            'description' => 'Необходим для работы контактных форм на сайте.',
            'source' => 'repo'
        ),

        'classic-editor' => array(
            'name' => 'Classic Editor', 
            'slug' => 'classic-editor',
            'file' => 'classic-editor/classic-editor.php',
            'required' => false,
            'description' => 'Возвращает классический редактор WordPress.',
            'source' => 'repo'
        ),

        'cyr2lat' => array(
            'name' => 'Cyr to Lat',
            'slug' => 'cyr2lat',
            'file' => 'cyr2lat/cyr-to-lat.php',
            'required' => false, 
            'description' => 'Транслитерирует кириллические URL в латинские.',
            'source' => 'repo'
        ),

        'svg-support' => array(
            'name' => 'SVG Support',
            'slug' => 'svg-support',
            'file' => 'svg-support/svg-support.php',
            'required' => false,
            'description' => 'Комплексное решение SVG для WordPress.',
            'source' => 'repo'
        )
    ));
}

/**
 * Проверяет, установлены ли все необходимые плагины
 */
function theme_check_required_plugins() {
    $plugins = theme_get_required_plugins();
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
            'description' => $plugin['description'],
            'source' => $plugin['source'] ?? 'repo'
        );
    }
    
    return $status;
}

/**
 * AJAX обработчик для установки плагинов
 */
function theme_ajax_install_plugin() {
    // Проверка прав и nonce
    if (!current_user_can('install_plugins')) {
        wp_send_json_error('Недостаточно прав');
    }

    if (!check_ajax_referer('theme_plugins_nonce', 'nonce', false)) {
        wp_send_json_error('Неверный nonce');
    }
    
    $plugin_slug = sanitize_text_field($_POST['plugin_slug'] ?? '');
    $plugins = theme_get_required_plugins();
    
    if (!isset($plugins[$plugin_slug])) {
        wp_send_json_error('Плагин не найден в списке');
    }
    
    $plugin = $plugins[$plugin_slug];
    
    // Установка
    if (!is_plugin_installed($plugin['file'])) {
        $result = theme_install_plugin($plugin);
        if (!$result['success']) {
            wp_send_json_error('Ошибка установки: ' . $result['message']);
        }
    }
    
    // Активация
    if (!is_plugin_active($plugin['file'])) {
        $activation_result = theme_activate_plugin($plugin['file']);
        if (!$activation_result['success']) {
            wp_send_json_error('Ошибка активации: ' . $activation_result['message']);
        }
    }
    
    wp_send_json_success('Плагин успешно установлен и активирован');
}
add_action('wp_ajax_theme_install_plugin', 'theme_ajax_install_plugin');

/**
 * Улучшенная функция установки плагина
 */
function theme_install_plugin($plugin) {
    if (!current_user_can('install_plugins')) {
        return array('success' => false, 'message' => 'Недостаточно прав');
    }
    
    include_once ABSPATH . 'wp-admin/includes/plugin-install.php';
    include_once ABSPATH . 'wp-admin/includes/file.php';
    include_once ABSPATH . 'wp-admin/includes/misc.php';
    include_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
    
    // Создаем экран для upgrader
    $upgrader_skin = new Automatic_Upgrader_Skin();
    $upgrader = new Plugin_Upgrader($upgrader_skin);
    
    try {
        // Для плагинов из репозитория
        if ($plugin['source'] === 'repo') {
            $api = plugins_api('plugin_information', array(
                'slug' => $plugin['slug'],
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
            
            $result = $upgrader->install($api->download_link);
        }
        
        if (is_wp_error($result)) {
            return array('success' => false, 'message' => $result->get_error_message());
        }
        
        if (!$result) {
            return array('success' => false, 'message' => 'Неизвестная ошибка при установке');
        }
        
        return array('success' => true, 'message' => 'Плагин успешно установлен');
        
    } catch (Exception $e) {
        return array('success' => false, 'message' => $e->getMessage());
    }
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
 * Массовая установка плагинов
 */
function theme_bulk_install_plugins($type = 'required') {
    if (!current_user_can('install_plugins')) {
        return array('success' => false, 'message' => 'Недостаточно прав');
    }

    $plugins_status = theme_get_plugins_status();
    $results = array();
    $installed_plugins = array();
    
    foreach ($plugins_status as $plugin_slug => $plugin) {
        // Фильтр по типу
        if ($type === 'required' && !$plugin['required']) {
            continue;
        }
        
        if (!$plugin['active']) {
            if (!$plugin['installed']) {
                // Установка
                $result = theme_install_plugin($plugin);
                $results[$plugin_slug] = $result;
                
                // Активация после установки
                if ($result['success']) {
                    $activation_result = theme_activate_plugin($plugin['file']);
                    $results[$plugin_slug . '_activation'] = $activation_result;
                    
                    if ($activation_result['success']) {
                        $installed_plugins[] = array(
                            'slug' => $plugin_slug,
                            'name' => $plugin['name'],
                            'required' => $plugin['required']
                        );
                    }
                }
            } else {
                // Только активация
                $result = theme_activate_plugin($plugin['file']);
                $results[$plugin_slug] = $result;
                
                if ($result['success']) {
                    $installed_plugins[] = array(
                        'slug' => $plugin_slug,
                        'name' => $plugin['name'],
                        'required' => $plugin['required']
                    );
                }
            }
        }
    }
    
    return array(
        'results' => $results,
        'installed_plugins' => $installed_plugins
    );
}

/**
 * AJAX для массовой установки
 */
function theme_ajax_bulk_install() {
    if (!current_user_can('install_plugins')) {
        wp_send_json_error('Недостаточно прав');
    }

    if (!check_ajax_referer('theme_plugins_nonce', 'nonce', false)) {
        wp_send_json_error('Неверный nonce');
    }
    
    $type = sanitize_text_field($_POST['type'] ?? 'required');
    $bulk_result = theme_bulk_install_plugins($type);
    
    // Проверяем, есть ли ошибки
    $has_errors = false;
    foreach ($bulk_result['results'] as $result) {
        if (isset($result['success']) && !$result['success']) {
            $has_errors = true;
            break;
        }
    }
    
    if ($has_errors) {
        wp_send_json_error(array(
            'results' => $bulk_result['results'],
            'message' => 'В процессе установки возникли ошибки'
        ));
    } else {
        wp_send_json_success(array(
            'results' => $bulk_result['results'],
            'installed_plugins' => $bulk_result['installed_plugins'],
            'message' => 'Массовая установка завершена успешно'
        ));
    }
}
add_action('wp_ajax_theme_bulk_install', 'theme_ajax_bulk_install');

/**
 * Страница установки плагинов
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

/**
 * Регистрация скриптов и стилей
 */
function theme_plugins_admin_scripts($hook) {
    if ($hook !== 'plugins_page_theme-required-plugins') {
        return;
    }
    
    wp_enqueue_script('jquery');
    
    // Добавляем inline скрипт с локализацией
    add_action('admin_footer', 'theme_plugins_admin_footer_script');
}
add_action('admin_enqueue_scripts', 'theme_plugins_admin_scripts');

/**
 * Inline скрипт с локализацией
 */
function theme_plugins_admin_footer_script() {
    ?>
    <script type="text/javascript">
    var themePlugins = {
        ajaxurl: '<?php echo admin_url('admin-ajax.php'); ?>',
        nonce: '<?php echo wp_create_nonce('theme_plugins_nonce'); ?>'
    };
    </script>
    <?php
}

/**
 * Контент страницы плагинов
 */
function theme_plugins_page_content() {
    $plugins_status = theme_get_plugins_status();
    $missing_required = array_filter($plugins_status, function($p) { 
        return $p['required'] && !$p['active']; 
    });
    $missing_optional = array_filter($plugins_status, function($p) { 
        return !$p['required'] && !$p['active']; 
    });
    ?>
    <div class="wrap">
        <h1>Необходимые плагины для темы</h1>
        
        <div class="card" style="min-width:100%;">
            <div class="bulk-actions-section">
                <h3>Массовая установка</h3>
                
                <?php if (!empty($missing_required)): ?>
                <div class="bulk-action-card required" id="required-plugins-card">
                    <h4>⚡ Обязательные плагины</h4>
                    <p>Эти плагины необходимы для основной функциональности темы.</p>
                    <button type="button" class="button button-primary bulk-install-btn" data-type="required">
                        Установить все обязательные (<span class="required-count"><?php echo count($missing_required); ?></span>)
                    </button>
                    <div class="plugin-list">
                        <?php foreach ($missing_required as $plugin): ?>
                            <span class="plugin-tag" data-plugin="<?php echo esc_attr($plugin['slug']); ?>"><?php echo esc_html($plugin['name']); ?></span>
                        <?php endforeach; ?>
                    </div>
                    <div class="bulk-status" style="display: none; margin-top: 10px; padding: 10px; background: #f8f9fa; border-radius: 4px; text-align: center;">
                        <span class="status-text" style="font-weight: bold;"></span>
                    </div>
                </div>
                <?php endif; ?>
                
                <?php if (!empty($missing_optional)): ?>
                <div class="bulk-action-card optional" id="optional-plugins-card">
                    <h4>💎 Дополнительные плагины</h4>
                    <p>Эти плагины добавляют полезные функции, но не обязательны.</p>
                    <button type="button" class="button bulk-install-btn" data-type="all">
                        Установить все плагины (<span class="all-count"><?php echo count($missing_required) + count($missing_optional); ?></span>)
                    </button>
                    <div class="plugin-list">
                        <?php foreach ($plugins_status as $plugin): ?>
                            <?php if (!$plugin['active']): ?>
                                <span class="plugin-tag" data-plugin="<?php echo esc_attr($plugin['slug']); ?>"><?php echo esc_html($plugin['name']); ?></span>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                    <div class="bulk-status" style="display: none; margin-top: 10px; padding: 10px; background: #f8f9fa; border-radius: 4px; text-align: center;">
                        <span class="status-text" style="font-weight: bold;"></span>
                    </div>
                </div>
                <?php endif; ?>
                
                <?php if (empty($missing_required) && empty($missing_optional)): ?>
                <div class="bulk-action-card success">
                    <p>🎉 Все плагины установлены и активированы!</p>
                </div>
                <?php endif; ?>
            </div>
            
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
                    <?php foreach ($plugins_status as $slug => $plugin): ?>
                    <tr data-plugin="<?php echo esc_attr($slug); ?>">
                        <td><strong><?php echo esc_html($plugin['name']); ?></strong></td>
                        <td><?php echo esc_html($plugin['description']); ?></td>
                        <td>
                            <?php if ($plugin['required']): ?>
                                <span class="plugin-type required">🔴 Обязательный</span>
                            <?php else: ?>
                                <span class="plugin-type optional">🔵 Дополнительный</span>
                            <?php endif; ?>
                        </td>
                        <td class="plugin-status">
                            <?php if ($plugin['active']): ?>
                                <span class="status-active">✅ Активен</span>
                            <?php elseif ($plugin['installed']): ?>
                                <span class="status-inactive">⚠️ Не активен</span>
                            <?php else: ?>
                                <span class="status-not-installed">❌ Не установлен</span>
                            <?php endif; ?>
                        </td>
                        <td style="min-width: 150px;">
                            <?php if ($plugin['active']): ?>
                                <span class="button disabled">Активен</span>
                            <?php else: ?>
                                <button type="button" class="button button-primary install-single-btn" 
                                        data-plugin="<?php echo esc_attr($slug); ?>">
                                    <?php echo $plugin['installed'] ? 'Активировать' : 'Установить'; ?>
                                </button>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <style>
    .bulk-action-card {
        padding: 20px;
        margin: 15px 0;
        border-radius: 8px;
        border-left: 4px solid;
    }
    .bulk-action-card.required {
        background: #fff3cd;
        border-left-color: #ffc107;
    }
    .bulk-action-card.optional {
        background: #e7f3ff;
        border-left-color: #0073aa;
    }
    .bulk-action-card.success {
        background: #d4edda;
        border-left-color: #28a745;
        text-align: center;
    }
    .plugin-list {
        margin-top: 10px;
    }
    .plugin-tag {
        display: inline-block;
        background: rgba(0,0,0,0.1);
        padding: 2px 8px;
        margin: 2px;
        border-radius: 3px;
        font-size: 0.9em;
    }
    .plugin-tag.installed {
        background: #d4edda;
        color: #155724;
        text-decoration: line-through;
        opacity: 0.7;
    }
    .status-installing {
        color: #0073aa;
        font-weight: bold;
    }
    .status-active {
        color: green;
        font-weight: bold;
    }
    .status-error {
        color: red;
        font-weight: bold;
    }
    </style>
    
    <script type="text/javascript">
    jQuery(document).ready(function($) {

        // Функция для обновления счетчиков
        function updateCounters() {
            var requiredCount = 0;
            var optionalCount = 0;
            
            // Перебираем все строки таблицы
            $('tr[data-plugin]').each(function() {
                var $row = $(this);
                var pluginSlug = $row.data('plugin');
                var isRequired = $row.find('.plugin-type.required').length > 0;
                var isActive = $row.find('.status-active').length > 0;
                
                if (!isActive) {
                    if (isRequired) {
                        requiredCount++;
                    } else {
                        optionalCount++;
                    }
                }
            });
            
            var allCount = requiredCount + optionalCount;
            
            $('.required-count').text(requiredCount);
            $('.all-count').text(allCount);
            
            // Удаляем динамически добавленную карточку успеха
            $('.bulk-action-card.success.dynamic').remove();
            
            // Скрываем карточки если все плагины установлены
            if (requiredCount === 0) {
                $('#required-plugins-card').hide();
            } else {
                $('#required-plugins-card').show();
            }
            
            if (allCount === 0) {
                $('#optional-plugins-card').hide();
                
                // Добавляем карточку успеха только если её ещё нет
                if ($('.bulk-action-card.success').length === 0) {
                    $('.bulk-actions-section').append(
                        '<div class="bulk-action-card success dynamic">' +
                        '<p>🎉 Все плагины установлены и активированы!</p>' +
                        '</div>'
                    );
                }
            } else {
                $('#optional-plugins-card').show();
            }
        }
        
        // Функция для обновления статуса плагина в таблице
        function updatePluginStatus(pluginSlug) {
            var $row = $('tr[data-plugin="' + pluginSlug + '"]');
            $row.find('.plugin-status').html('<span class="status-active">✅ Активен</span>');
            $row.find('.install-single-btn').remove();
            $row.find('td:last').append('<span class="button disabled">Активен</span>');
            
            // Помечаем плагин как установленный в списке
            $('.plugin-tag[data-plugin="' + pluginSlug + '"]').addClass('installed');
            
            // Обновляем счетчики
            updateCounters();
        }
        
        // Обработка одиночной установки
        $('.install-single-btn').on('click', function() {
            var $btn = $(this);
            var plugin = $btn.data('plugin');
            var $row = $btn.closest('tr');
            var $status = $row.find('.plugin-status');
            
            // Меняем кнопку на статус
            $btn.hide();
            $status.html('<span class="status-installing">⏳ Установка...</span>');
            
            // Отправляем запрос
            $.post(themePlugins.ajaxurl, {
                action: 'theme_install_plugin',
                plugin_slug: plugin,
                nonce: themePlugins.nonce
            }, function(response) {
                if (response.success) {
                    $status.html('<span class="status-active">✅ Активен</span>');
                    updatePluginStatus(plugin);
                } else {
                    $status.html('<span class="status-error">❌ Ошибка</span>');
                    $btn.show().text('Повторить').prop('disabled', false);
                    alert('Ошибка: ' + response.data);
                }
            }).fail(function(xhr, status, error) {
                $status.html('<span class="status-error">❌ Ошибка сети</span>');
                $btn.show().text('Повторить').prop('disabled', false);
                alert('Ошибка сети: ' + error);
            });
        });
        
        // Обработка массовой установки
        $('.bulk-install-btn').on('click', function() {
            var $btn = $(this);
            var type = $btn.data('type');
            var $card = $btn.closest('.bulk-action-card');
            var $status = $card.find('.bulk-status');
            var $statusText = $status.find('.status-text');
            
            $btn.prop('disabled', true).text('Установка...');
            $status.show();
            $statusText.text('⏳ Начало установки...');
            
            // Отправляем запрос
            $.post(themePlugins.ajaxurl, {
                action: 'theme_bulk_install',
                type: type,
                nonce: themePlugins.nonce
            }, function(response) {
                if (response.success) {
                    $statusText.text('✅ ' + response.data.message);
                    $btn.text('✅ Завершено!');
                    
                    // Обновляем статусы установленных плагинов
                    if (response.data.installed_plugins) {
                        response.data.installed_plugins.forEach(function(plugin) {
                            updatePluginStatus(plugin.slug);
                        });
                    }
                    
                    setTimeout(function() {
                        $btn.hide();
                        $status.hide();
                    }, 2000);
                } else {
                    $statusText.text('❌ ' + response.data.message);
                    $btn.text('❌ Ошибка').prop('disabled', false);
                }
            }).fail(function(xhr, status, error) {
                $statusText.text('❌ Ошибка соединения');
                $btn.text('❌ Ошибка').prop('disabled', false);
                alert('Ошибка сети: ' + error);
            });
        });
        
        // Инициализация счетчиков при загрузке
        updateCounters();
    });
    </script>
    <?php
}

/**
 * Уведомление в админ-панели
 */
function theme_required_plugins_admin_notice() {
    $screen = get_current_screen();
    if ($screen && $screen->id === 'plugins_page_theme-required-plugins') {
        return;
    }
    
    $plugins_status = theme_get_plugins_status();
    $missing_required = array_filter($plugins_status, function($p) { 
        return $p['required'] && !$p['active']; 
    });
    
    if (!empty($missing_required) && current_user_can('install_plugins')) {
        ?>
        <div class="notice notice-error is-dismissible">
            <p>
                <strong>Требуются плагины темы:</strong> 
                Необходимо установить <?php echo count($missing_required); ?> обязательных плагинов.
                <a href="<?php echo esc_url(admin_url('plugins.php?page=theme-required-plugins')); ?>" class="button button-primary" style="margin-left: 10px;">
                    Установить сейчас
                </a>
            </p>
        </div>
        <?php
    }
}
add_action('admin_notices', 'theme_required_plugins_admin_notice');

/**
 * Добавление пункта в административное меню для быстрого доступа
 */
function theme_add_plugins_menu_item() {
    $plugins_status = theme_get_plugins_status();
    $missing_required = array_filter($plugins_status, function($p) { 
        return $p['required'] && !$p['active']; 
    });
    
    $count = count($missing_required);
    $menu_title = $count > 0 ? 
        sprintf('Требуемые плагины <span class="awaiting-mod">%d</span>', $count) : 
        'Требуемые плагины';
    
    add_theme_page(
        'Требуемые плагины',
        $menu_title,
        'install_plugins',
        'theme-required-plugins',
        'theme_plugins_page_content'
    );
}
add_action('admin_menu', 'theme_add_plugins_menu_item');

/**
 * Хук для добавления своих плагинов в список необходимых
 */
add_filter('theme_required_plugins', function($plugins) {
    // Пример добавления плагина из внешнего источника
    /*
    $plugins['advanced-custom-fields'] = array(
        'name' => 'Advanced Custom Fields',
        'slug' => 'advanced-custom-fields',
        'file' => 'advanced-custom-fields/acf.php',
        'required' => true,
        'description' => 'Расширенное управление кастомными полями.',
        'source' => 'repo'
    );
    */
    
    return $plugins;
});