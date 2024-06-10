<?php
if (!defined('HOME_ID')) {
	$homeId = get_option('page_on_front');
	define('HOME_ID', $homeId);
}

function home_page_fields($settings, $type, $id, $meta_type, $types)
{
	if (HOME_ID == $id && $type === 'page') {

		$Section = SCF::add_setting('asf_homepage_preview', 'Preview section');

		$Section->add_group(
			'preview-section',
			false,
			array(
                array(
                    'type'        => 'text', // Тип поля. Обязательный.
                    'name'        => 'preview_title', // Ключ поля. Обязательный.
                    'label'       => 'Title', // Заголовок поля.
                    'default'     => '', // Значение по умолчанию.
                    'instruction' => '', // Текст над полем.
                    'notes'       => '', // Текст под полем.
                ),
                array(
                    'type'        => 'textarea', // Тип поля. Обязательный.
                    'name'        => 'preview_desc', // Ключ поля. Обязательный.
                    'label'       => 'Description', // Заголовок поля.
                    'rows'        => 2, // Количество строк. По умолчанию 5.
                    'default'     => '', // Значение по умолчанию.
                    'instruction' => '', // Текст над полем.
                    'notes'       => '', // Текст под полем.
                ),

			)
		);

        $Section->add_group(
			'preview_sliders',
			true,
			array(
                array(
                    'type'        => 'image', // Тип поля. Обязательный.
                    'name'        => 'preview__lg', // Ключ поля. Обязательный.
                    'label'       => 'Large image', // Заголовок поля.
                    'size'        => 'medium', // Размер изображения в метабоксе.
                    'instruction' => '', // Текст над полем.
                    'notes'       => '', // Текст под полем.
                ),
                array(
                    'type'        => 'image', // Тип поля. Обязательный.
                    'name'        => 'preview__sm', // Ключ поля. Обязательный.
                    'label'       => 'Small image', // Заголовок поля.
                    'size'        => 'medium', // Размер изображения в метабоксе.
                    'instruction' => '', // Текст над полем.
                    'notes'       => '', // Текст под полем.
                ),
                array(
					'name'        => 'preview__label',
					'label'       => 'Label',
					'type'        => 'text',
				),
                array(
					'name'        => 'preview__title',
					'label'       => 'Title',
					'type'        => 'text',
				),
                array(
					'name'        => 'preview__text',
					'label'       => 'Text',
					'type'        => 'textarea',
                    'rows'        => 2,
				),
  
			)
		);

		$settings[] = $Section;
	}

    if (HOME_ID == $id && $type === 'page') {

		$Section = SCF::add_setting('asf_homepage_map', 'Map section');

		$Section->add_group(
			'map-section',
			false,
			array(
                array(
                    'type'        => 'text', // Тип поля. Обязательный.
                    'name'        => 'map__title', // Ключ поля. Обязательный.
                    'label'       => 'Title', // Заголовок поля.
                    'default'     => '', // Значение по умолчанию.
                    'instruction' => 'Add a span tag for a line', // Текст над полем.
                    'notes'       => 'text <span></span>text', // Текст под полем.
                ),
                // array(
                //     'type'        => 'relation', // Тип поля. Обязательный.
                //     'name'        => 'map__relation', // Ключ поля. Обязательный.
                //     'label'       => 'Select projects', // Заголовок поля.
                //     'post-type'   => array('project'), // Типы записей.
                //     'limit'       => 0, // Максимальное количество выбираемых элементов.
                //     'instruction' => '', // Текст над полем.
                //     'notes'       => '', // Текст под полем.
                // ),
        
			)
		);


		$settings[] = $Section;
	}

	return $settings;
}
add_filter('smart-cf-register-fields', 'home_page_fields', 1, 5);
