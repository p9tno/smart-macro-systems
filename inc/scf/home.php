<?php
if (!defined('HOME_ID')) {
	$homeId = get_option('page_on_front');
	define('HOME_ID', $homeId);
}

function home_page_fields($settings, $type, $id, $meta_type, $types)
{
	if (HOME_ID == $id && $type === 'page') {

		$Section = SCF::add_setting('asf_firstscreen', 'First screen');

		$Section->add_group(
			'firstscreen-section',
			false,
			array(
                array(
                    'type'        => 'text', // Тип поля. Обязательный.
                    'name'        => 'firstscreen_title', // Ключ поля. Обязательный.
                    'label'       => 'Title', // Заголовок поля.
                    'default'     => '', // Значение по умолчанию.
                    'instruction' => 'To highlight text with a different color, wrap the text in a span tag', // Текст над полем.
                    'notes'       => 'Text <span>text in a different color</span>', // Текст под полем.
                ),
                array(
                    'type'        => 'wysiwyg', // Тип поля. Обязательный.
                    'name'        => 'firstscreen_text', // Ключ поля. Обязательный.
                    'label'       => 'Text desktop', // Заголовок поля.
                    'default'     => '', // Значение по умолчанию.
                    'instruction' => '', // Текст над полем.
                    'notes'       => '', // Текст под полем.
                ),
                array(
                    'type'        => 'wysiwyg', // Тип поля. Обязательный.
                    'name'        => 'firstscreen_text_m', // Ключ поля. Обязательный.
                    'label'       => 'Text mobile', // Заголовок поля.
                    'default'     => '', // Значение по умолчанию.
                    'instruction' => '', // Текст над полем.
                    'notes'       => '', // Текст под полем.
                ),
                array(
                    'type'        => 'image', // Тип поля. Обязательный.
                    'name'        => 'firstscreen_img', // Ключ поля. Обязательный.
                    'label'       => 'Image', // Заголовок поля.
                    'size'        => 'medium', // Размер изображения в метабоксе. thumbnail medium large
                    'instruction' => '', // Текст над полем.
                    'notes'       => '', // Текст под полем.
                ),
			)
		);

        // $Section->add_group(
		// 	'preview_sliders',
		// 	true,
		// 	array(
        //         array(
        //             'type'        => 'image', // Тип поля. Обязательный.
        //             'name'        => 'preview__lg', // Ключ поля. Обязательный.
        //             'label'       => 'Large image', // Заголовок поля.
        //             'size'        => 'medium', // Размер изображения в метабоксе.
        //             'instruction' => '', // Текст над полем.
        //             'notes'       => '', // Текст под полем.
        //         ),
        //         array(
        //             'type'        => 'image', // Тип поля. Обязательный.
        //             'name'        => 'preview__sm', // Ключ поля. Обязательный.
        //             'label'       => 'Small image', // Заголовок поля.
        //             'size'        => 'medium', // Размер изображения в метабоксе.
        //             'instruction' => '', // Текст над полем.
        //             'notes'       => '', // Текст под полем.
        //         ),
        //         array(
		// 			'name'        => 'preview__label',
		// 			'label'       => 'Label',
		// 			'type'        => 'text',
		// 		),
        //         array(
		// 			'name'        => 'preview__title',
		// 			'label'       => 'Title',
		// 			'type'        => 'text',
		// 		),
        //         array(
		// 			'name'        => 'preview__text',
		// 			'label'       => 'Text',
		// 			'type'        => 'textarea',
        //             'rows'        => 2,
		// 		),
  
		// 	)
		// );

		$settings[] = $Section;
	}



	return $settings;
}
add_filter('smart-cf-register-fields', 'home_page_fields', 1, 5);
