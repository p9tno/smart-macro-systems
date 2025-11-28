<?php
if (! defined('SETTINGS_NAME')) {
	define('SETTINGS_NAME', 'site-settings');
}

function contacts_part_fields($settings, $type, $id, $meta_type, $types)
{
	if ($type == SETTINGS_NAME) {

		$Section = SCF::add_setting('contacts_part', 'Контакты');

		$Section->add_group(
			'contacts_part_field',
			false,
			array(
				array(
					'name'        => 'get_a_free_button_text',
					'label'       => 'Текст кнопки "Получить бесплатно"',
					'type'        => 'text',
					'notes'       => ''
				),
				array(
					'name'        => 'get_a_free_button_link',
					'label'		  => 'Ссылка кнопки "Получить бесплатно"',
					'type'        => 'text',
					'notes'       => ''
				),
				array(
					'name'        => 'book_a_demo_button_text',
					'label'       => 'Текст кнопки "Смотреть демо"',
					'type'        => 'text',
					'notes'       => ''
				),
				array(
					'name'		=> 'book_a_demo_button_link',
					'label'		  => 'Ссылка кнопки "Смотреть демо"',
					'type'		=> 'text',
					'notes'	   => ''
				),
			)
		);

		$settings[] = $Section;
	}
	return $settings;
}
add_filter('smart-cf-register-fields', 'contacts_part_fields', 10, 5);
