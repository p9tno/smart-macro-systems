<?php
$required_plugins = $args['required_plugins'] ?? array();
$plugins_status = theme_get_plugins_status();
$missing_required = array();

foreach ($plugins_status as $plugin) {
    if ($plugin['required'] && !$plugin['active']) {
        $missing_required[] = $plugin;
    }
}
?>

<div class="plugin-required-notice">
    <div class="container">
        <?php if (current_user_can('install_plugins')): ?>
            <div class="admin-notice">
                <h3>⚠️ Требуется установка плагинов</h3>
                <p>Для правильной работы темы необходимо установить и активировать следующие плагины:</p>
                
                <ul class="plugins-list">
                    <?php foreach ($missing_required as $plugin): ?>
                    <li class="plugin-item">
                        <strong><?php echo esc_html($plugin['name']); ?></strong>
                        <span class="plugin-description">- <?php echo esc_html($plugin['description']); ?></span>
                        
                        <div class="plugin-actions">
                            <?php if (!$plugin['installed']): ?>
                                <a href="<?php echo esc_url(wp_nonce_url(self_admin_url('update.php?action=install-plugin&plugin=' . $plugin['slug']), 'install-plugin_' . $plugin['slug'])); ?>" 
                                   class="button button-primary">
                                    Установить
                                </a>
                            <?php elseif (!$plugin['active']): ?>
                                <a href="<?php echo esc_url(wp_nonce_url(admin_url('plugins.php?action=activate&plugin=' . urlencode($plugin['file'])), 'activate-plugin_' . $plugin['file'])); ?>" 
                                   class="button button-primary">
                                    Активировать
                                </a>
                            <?php endif; ?>
                        </div>
                    </li>
                    <?php endforeach; ?>
                </ul>
                
                <div class="notice-actions">
                    <a href="<?php echo esc_url(admin_url('themes.php?page=theme-plugins')); ?>" class="button">
                        Управление плагинами
                    </a>
                    <a href="<?php echo esc_url(home_url()); ?>" class="button button-secondary" onclick="location.reload()">
                        Обновить страницу
                    </a>
                </div>
                
                <p class="notice-info">
                    <small>После установки и активации всех плагинов обновите страницу</small>
                </p>
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
    max-width: 700px;
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

.plugins-list {
    list-style: none;
    padding: 0;
    margin: 25px 0;
}

.plugin-item {
    padding: 15px;
    margin: 10px 0;
    background: #f8f9fa;
    border-radius: 5px;
    border-left: 4px solid #dc3545;
}

.plugin-description {
    color: #666;
    font-size: 0.9em;
}

.plugin-actions {
    margin-top: 10px;
}

.notice-actions {
    margin-top: 25px;
    padding-top: 20px;
    border-top: 1px solid #eee;
}

.notice-info {
    margin-top: 20px;
    padding: 10px;
    background: #e7f3ff;
    border-radius: 4px;
    color: #0066cc;
}

.plugin-required-notice h3 {
    color: #dc3545;
    margin-bottom: 15px;
}

.plugin-required-notice .button {
    margin: 5px;
    color: #0066cc;
    text-decoration: none;
}
</style>