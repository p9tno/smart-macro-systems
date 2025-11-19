<?php
if (!defined('MY_THEME_SETTINGS')) {
    define('MY_THEME_SETTINGS', 'my-theme-settings');
}

function global_theme_settings($settings, $type, $id, $meta_type, $types) {
    if ($type == MY_THEME_SETTINGS) {

        $Section = SCF::add_setting('asf_theme_settings', 'Theme settings');

        $Section->add_group(
            'theme_settings_field',
            false,
            array(
                array(
                    'type'        => 'image',
                    'name'        => 'option_header_img',
                    'label'       => 'Logo header',
                    'size'        => 'thumbnail',
                ),
                array(
                    'type'        => 'image',
                    'name'        => 'option_footer_img',
                    'label'       => 'Logo footer',
                    'size'        => 'thumbnail',
                ),
                array(
                    'name'        => 'option_phone',
                    'label'       => 'Phone',
                    'type'        => 'text',
                ),
                array(
                    'name'        => 'option_address',
                    'label'       => 'Address',
                    'type'        => 'text',
                ),
                array(
                    'name'        => 'option_email',
                    'label'       => 'Email',
                    'type'        => 'text',
                ),
                array(
                    'type'        => 'boolean',
                    'name'        => 'boolean_preloader',
                    'label'       => 'Show preloader?',
                    'default'     => '',
                    'instruction' => '',
                    'notes'       => '',
                    'true_label'  => 'Yes',
                    'false_label' => 'No',
                ),
                array(
                    'type'        => 'text',
                    'name'        => 'contacts_form',
                    'label'       => 'Contact Form Shortcode',
                    'default'     => '[contact-form-7 id="1b2c808" title="Contact form 1"]',
                    'instruction' => 'Введите шорткод формы Contact Form 7:',
                    'notes'       => 'Для вывода используйте: <code>&lt;?php echo do_shortcode(get_option("contacts_form")); ?&gt;</code>',
                ),
                // Добавляем наше новое поле с HTML примером
                array(
                    'type'        => 'html_example',
                    'name'        => 'form_html_example',
                    'label'       => 'HTML Form Structure',
                    'default'     => '',
                    'html_content' => '
<div class="form">
    <div class="form__row">
        [text name placeholder "Имя"]<i class="icon_s_person"></i>
    </div>
    <div class="form__row">
        [text family placeholder "Фамилия"]<i class="icon_s_person"></i>
    </div>
    <div class="form__row">
        [tel* phone placeholder "Номер телефона"]<i class="icon_s_phone"></i>
    </div>
    <div class="form__row">
        [email* email placeholder "Электронная почта"]<i class="icon_s_email"></i>
    </div>
    <div class="form__row">
        <button class="btn" type="submit">Отправить</button>
    </div>
</div>
                    ',
                    'instruction' => 'Пример HTML кода формы для справки:',
                    'notes'       => 'Этот код не сохраняется и служит только примером',
                ),
				// array(
				// 	'type'        => 'link',
				// 	'name'        => 'button_primary',
				// 	'label'       => 'Primary Button',
				// 	'return_format' => 'array',
				// 	'instruction' => 'Configure the primary button link',
				// 	'notes'       => 'All fields are optional',
				// ),
            )
        );

        $settings[] = $Section;
    }

    return $settings;
}
add_filter('smart-cf-register-fields', 'global_theme_settings', 10, 5);