<?php
if (!defined('MY_THEME_SETTINGS')) {
	define('MY_THEME_SETTINGS', 'my-theme-settings');
}

function global_theme_settings($settings, $type, $id, $meta_type, $types)
{
	if ($type == MY_THEME_SETTINGS) {

		$Section = SCF::add_setting('asf_theme_settings', 'Theme settings');

		$Section->add_group(
			'theme_settings_field',
			false,
			array(
				array(
					'type'        => 'image', // Тип поля. Обязательный.
					'name'        => 'option_header_img', // Ключ поля. Обязательный.
					'label'       => 'Logo header', // Заголовок поля.
					'size'        => 'thumbnail', // Размер изображения в метабоксе.
				),
				array(
					'type'        => 'image', // Тип поля. Обязательный.
					'name'        => 'option_footer_img', // Ключ поля. Обязательный.
					'label'       => 'Logo footer', // Заголовок поля.
					'size'        => 'thumbnail', // Размер изображения в метабоксе.
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
					'type'        => 'boolean', // Тип поля. Обязательный.
					'name'        => 'boolean_preloader', // Ключ поля. Обязательный.
					'label'       => 'Show preloader?', // Заголовок поля.
					'default'     => '', // Значение по умолчанию.
					'instruction' => '', // Текст над полем.
					'notes'       => '', // Текст под полем.
					'true_label'  => 'Yes', // Текст радио-кнопки (true)
					'false_label' => 'No', // Текст радио-кнопки (false)
				),
				array(
					'type'        => 'text', // Тип поля. Обязательный.
					'name'        => 'contacts_form', // Ключ поля. Обязательный.
					'label'       => 'Contact Form', // Заголовок поля.
					'default'     => '', // Значение по умолчанию.
					'instruction' => '', // Текст над полем.
					'notes'       => '[contact-form-7 id="1b2c808" title="Contact form 1"]', // Текст под полем.
				),
			)
		);

		$settings[] = $Section;
	}

	return $settings;
}
add_filter('smart-cf-register-fields', 'global_theme_settings', 10, 5);