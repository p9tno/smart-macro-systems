<?php

if ( ! defined( 'PAGE_TEMPL_SERVICES' ) ) {
	define( 'PAGE_TEMPL_SERVICES', 'template-services.php' );
}

function template_services_fields($settings, $type, $id, $meta_type, $types)
{
    if ( $type === 'page' ) {
		if ( get_page_template_slug( $id ) == PAGE_TEMPL_SERVICES ) {

			$Setting = SCF::add_setting( 'asf_template_services', 'Services main img' );
			$Setting->add_group(
				'services_main_img_settings',
				false,
				array (
                    array(
                        'type'        => 'image', // Тип поля. Обязательный.
                        'name'        => 'services_main_img', // Ключ поля. Обязательный.
                        'label'       => 'Main img', // Заголовок поля.
                        'size'        => 'medium', // Размер изображения в метабоксе.
                        'instruction' => '', // Текст над полем.
                        'notes'       => '', // Текст под полем.
                    ),
				) 
			);

			$settings[] = $Setting;
		}
	}

    if ( $type === 'page' ) {
		if ( get_page_template_slug( $id ) == PAGE_TEMPL_SERVICES ) {

			$Setting = SCF::add_setting( 'asf_template_services_list', 'Service list' );
			$Setting->add_group(
				'service_list_settings',
				true,
				array (
                    array(
                        'type'        => 'text', // Тип поля. Обязательный.
                        'name'        => 'collapse__title', // Ключ поля. Обязательный.
                        'label'       => 'Title', // Заголовок поля.
                        'default'     => '', // Значение по умолчанию.
                        'instruction' => '', // Текст над полем.
                        'notes'       => '', // Текст под полем.
                    ),
                    array(
                        'type'        => 'wysiwyg', // Тип поля. Обязательный.
                        'name'        => 'collapse__body', // Ключ поля. Обязательный.
                        'label'       => 'Content', // Заголовок поля.
                        'default'     => '', // Значение по умолчанию.
                        'instruction' => '', // Текст над полем.
                        'notes'       => '', // Текст под полем.
                    ),
                    array(
                        'type'        => 'relation', // Тип поля. Обязательный.
                        'name'        => 'collapse__link', // Ключ поля. Обязательный.
                        'label'       => 'Link', // Заголовок поля.
                        'post-type'   => array('page'), // Типы записей.
                        'limit'       => 1, // Максимальное количество выбираемых элементов.
                        'instruction' => '', // Текст над полем.
                        'notes'       => '', // Текст под полем.
                    ),
                    array(
                        'type'        => 'image', // Тип поля. Обязательный.
                        'name'        => 'collapse__img', // Ключ поля. Обязательный.
                        'label'       => 'Img', // Заголовок поля.
                        'size'        => 'thumbnail', // Размер изображения в метабоксе.
                        'instruction' => '', // Текст над полем.
                        'notes'       => '', // Текст под полем.
                    ),
				) 
			);

			$settings[] = $Setting;
		}
	}

	return $settings;
}
add_filter('smart-cf-register-fields', 'template_services_fields', 10, 5);
