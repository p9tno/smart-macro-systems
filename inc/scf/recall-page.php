<?php

if ( ! defined( 'PAGE_TEMPL_TESTIMONIALS' ) ) {
	define( 'PAGE_TEMPL_TESTIMONIALS', 'template-testimonials.php' );
}

function template_testimonials_fields($settings, $type, $id, $meta_type, $types)
{
    if ( $type === 'page' ) {
		if ( get_page_template_slug( $id ) == PAGE_TEMPL_TESTIMONIALS ) {

			$Setting = SCF::add_setting( 'asf_template_testimonials', 'Testimonials main settings' );
			$Setting->add_group(
				'testimonials_settings',
				false,
				array (
                    array(
                        'type'        => 'text', // Тип поля. Обязательный.
                        'name'        => 'testimonials__title', // Ключ поля. Обязательный.
                        'label'       => 'Page title', // Заголовок поля.
                        'default'     => '', // Значение по умолчанию.
                        'instruction' => '', // Текст над полем.
                        'notes'       => '', // Текст под полем.
                    ),
					// array(
					// 	'type'        => 'relation', // Тип поля. Обязательный.
					// 	'name'        => 'testimonials__relation', // Ключ поля. Обязательный.
					// 	'label'       => 'Field with a selection of related records', // Заголовок поля.
					// 	'post-type'   => array('testimonials'), // Типы записей.
					// 	'limit'       => -1, // Максимальное количество выбираемых элементов.
					// 	'instruction' => '', // Текст над полем.
					// 	'notes'       => '', // Текст под полем.
					// ),
				) 
			);

			$settings[] = $Setting;
		}
	}

	return $settings;
}
add_filter('smart-cf-register-fields', 'template_testimonials_fields', 10, 5);
