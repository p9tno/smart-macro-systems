<?php

if ( ! defined( 'PAGE_TEMPL_CONTACTS' ) ) {
	define( 'PAGE_TEMPL_CONTACTS', 'template-contacts.php' );
}

function template_contacts_fields($settings, $type, $id, $meta_type, $types)
{
    if ( $type === 'page' ) {
		if ( get_page_template_slug( $id ) == PAGE_TEMPL_CONTACTS ) {

			$Setting = SCF::add_setting( 'asf_template_contacts', 'Contacts settings' );
			$Setting->add_group(
				'contacts_settings',
				false,
				array (
                    array(
                        'type'        => 'textarea', // Тип поля. Обязательный.
                        'name'        => 'contacts__text', // Ключ поля. Обязательный.
                        'label'       => 'Text', // Заголовок поля.
                        'rows'        => 5, // Количество строк. По умолчанию 5.
                        'default'     => '', // Значение по умолчанию.
                        'instruction' => '', // Текст над полем.
                        'notes'       => '', // Текст под полем.
                    ),
                    array(
                        'type'        => 'image', // Тип поля. Обязательный.
                        'name'        => 'contacts__img', // Ключ поля. Обязательный.
                        'label'       => 'Img', // Заголовок поля.
                        'size'        => 'medium', // Размер изображения в метабоксе.
                        'instruction' => '', // Текст над полем.
                        'notes'       => '', // Текст под полем.
                    ),
                    array(
                        'type'        => 'text', // Тип поля. Обязательный.
                        'name'        => 'contacts__form', // Ключ поля. Обязательный.
                        'label'       => 'Contact Form', // Заголовок поля.
                        'default'     => '', // Значение по умолчанию.
                        'instruction' => '', // Текст над полем.
                        'notes'       => '[contact-form-7 id="1b2c808" title="Contact form 1"]', // Текст под полем.
                    ),
             
				) 
			);

			$settings[] = $Setting;
		}
	}

	return $settings;
}
add_filter('smart-cf-register-fields', 'template_contacts_fields', 10, 5);
