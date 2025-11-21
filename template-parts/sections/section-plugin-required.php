<?php
$required_plugins = $args['required_plugins'] ?? array();
$plugins_status = theme_get_plugins_status();
$missing_required = array();
$missing_optional = array();

foreach ($plugins_status as $plugin) {
    if (!$plugin['active']) {
        if ($plugin['required']) {
            $missing_required[] = $plugin;
        } else {
            $missing_optional[] = $plugin;
        }
    }
}
?>

<div class="plugin-required-notice">
    <div class="container">
        <?php if (current_user_can('install_plugins')): ?>
            <div class="admin-notice">
                <h3>⚠️ Требуется установка плагинов</h3>
                <p>Для правильной работы темы необходимо установить и активировать следующие плагины:</p>
                
                <?php if (!empty($missing_required)): ?>
                <div class="plugins-section">
                    <h4>🔴 Обязательные плагины</h4>
                    <ul class="plugins-list">
                        <?php foreach ($missing_required as $plugin): ?>
                        <li class="plugin-item required">
                            <strong><?php echo esc_html($plugin['name']); ?></strong>
                            <span class="plugin-description">- <?php echo esc_html($plugin['description']); ?></span>
                            <div class="plugin-status">
                                <?php if (!$plugin['installed']): ?>
                                    <span class="status-badge not-installed">Не установлен</span>
                                <?php else: ?>
                                    <span class="status-badge not-active">Не активен</span>
                                <?php endif; ?>
                            </div>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>
                
                <?php if (!empty($missing_optional)): ?>
                <div class="plugins-section">
                    <h4>🔵 Рекомендуемые плагины</h4>
                    <ul class="plugins-list">
                        <?php foreach ($missing_optional as $plugin): ?>
                        <li class="plugin-item optional">
                            <strong><?php echo esc_html($plugin['name']); ?></strong>
                            <span class="plugin-description">- <?php echo esc_html($plugin['description']); ?></span>
                            <div class="plugin-status">
                                <?php if (!$plugin['installed']): ?>
                                    <span class="status-badge not-installed">Не установлен</span>
                                <?php else: ?>
                                    <span class="status-badge not-active">Не активен</span>
                                <?php endif; ?>
                            </div>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>
                
                <?php if (empty($missing_required) && empty($missing_optional)): ?>
                    <div class="all-plugins-installed">
                        <p>✅ Все плагины установлены и активированы!</p>
                        <a href="<?php echo esc_url(home_url()); ?>" class="button button-primary">
                            Перейти на сайт
                        </a>
                    </div>
                <?php else: ?>
                    <div class="redirect-actions">
                        <p>Для установки плагинов перейдите в панель управления:</p>
                        <a href="<?php echo esc_url(admin_url('plugins.php?page=theme-required-plugins')); ?>" class="button button-primary button-large">
                            ⚡ Установить плагины
                        </a>
                    </div>
                <?php endif; ?>
                
                <div class="notice-actions">
                    <a href="<?php echo esc_url(home_url()); ?>" class="button button-secondary">
                        Обновить Страницу
                    </a>
                </div>
            </div>
        <?php else: ?>
            <div class="user-notice">
                <h3>🔧 Сайт на техническом обслуживании</h3>
                <p>В настоящее время проводятся работы по улучшению сайта. Пожалуйста, зайдите позже.</p>
                <p><small>Если вы администратор сайта, войдите в систему для установки необходимых компонентов.</small></p>
            </div>
        <?php endif; ?>
    </div>
</div>

<style>
.plugin-required-notice {
    padding: 60px 20px;
    text-align: center;
    background: #f8f9fa;
    color: #000000;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.admin-notice {
    background: white;
    padding: 40px;
    border-radius: 8px;
    box-shadow: 0 2px 20px rgba(0,0,0,0.1);
    max-width: 800px;
    margin: 0 auto;
    text-align: left;
}

.user-notice {
    background: white;
    padding: 40px;
    border-radius: 8px;
    box-shadow: 0 2px 20px rgba(0,0,0,0.1);
    max-width: 500px;
    margin: 0 auto;
}

.plugins-section {
    margin: 25px 0;
}

.plugins-section h4 {
    margin-bottom: 15px;
    padding-bottom: 10px;
    border-bottom: 2px solid #eee;
}

.plugins-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.plugin-item {
    padding: 15px;
    margin: 10px 0;
    background: #f8f9fa;
    border-radius: 5px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
}

.plugin-item.required {
    border-left: 4px solid #dc3545;
    background: #fff5f5;
}

.plugin-item.optional {
    border-left: 4px solid #0073aa;
    background: #f0f8ff;
}

.plugin-description {
    color: #666;
    font-size: 0.9em;
    margin: 0 10px;
    flex: 1;
}

.plugin-status {
    margin: 0 10px;
}

.status-badge {
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 0.8em;
    font-weight: bold;
}

.status-badge.not-installed {
    background: #ffcccc;
    color: #dc3545;
}

.status-badge.not-active {
    background: #fff3cd;
    color: #856404;
}

.status-badge.active {
    background: #d4edda;
    color: #155724;
}

.redirect-actions {
    margin: 30px 0;
    padding: 30px;
    background: #e7f3ff;
    border-radius: 8px;
    text-align: center;
    border-left: 4px solid #0073aa;
}

.redirect-actions .button-large {
    padding: 12px 24px;
    font-size: 16px;
    font-weight: bold;
    margin: 10px 0;
}

.redirect-description {
    margin-top: 15px;
    color: #666;
}

.all-plugins-installed {
    margin: 30px 0;
    padding: 30px;
    background: #d4edda;
    border-radius: 8px;
    text-align: center;
    border: 2px solid #28a745;
}

.notice-actions {
    margin-top: 25px;
    padding-top: 20px;
    border-top: 1px solid #eee;
    text-align: center;
}

.plugin-required-notice .button {
    margin: 5px;
    text-decoration: none;
}

.button-small {
    padding: 6px 12px;
    font-size: 0.9em;
}
</style>