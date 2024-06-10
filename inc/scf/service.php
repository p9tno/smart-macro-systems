<?php

if ( ! defined( 'PAGE_TEMPL_SERVICE' ) ) {
	define( 'PAGE_TEMPL_SERVICE', 'template-service.php' );
}

function template_service_fields($settings, $type, $id, $meta_type, $types)
{
    if ( $type === 'page' ) {
		if ( get_page_template_slug( $id ) == PAGE_TEMPL_SERVICE ) {

			$Setting = SCF::add_setting( 'asf_service_gallery', 'Service gallery, add 6 images.' );
			$Setting->add_group(
				'service_gallery_list',
				true,
				array (
                    array(
                        'type'        => 'image', // Тип поля. Обязательный.
                        'name'        => 'service_gallery_item', // Ключ поля. Обязательный.
                        'label'       => 'Img', // Заголовок поля.
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
		if ( get_page_template_slug( $id ) == PAGE_TEMPL_SERVICE ) {

			$Setting = SCF::add_setting( 'asf_service_done', 'Content only (left: title; right: content)' );
			$Setting->add_group(
				'service_done',
				false,
				array (
                    array(
                        'type'        => 'boolean', // Тип поля. Обязательный.
                        'name'        => 'boolean_done', // Ключ поля. Обязательный.
                        'label'       => 'Display block?', // Заголовок поля.
                        'default'     => '1', // Значение по умолчанию.
                        'true_label'  => 'Yes', // Текст радио-кнопки (true)
                        'false_label' => 'No', // Текст радио-кнопки (false)
                    ),
                    array(
                        'type'        => 'text', // Тип поля. Обязательный.
                        'name'        => 'done__title', // Ключ поля. Обязательный.
                        'label'       => 'Title', // Заголовок поля.
                        'default'     => '', // Значение по умолчанию.
                        'instruction' => '', // Текст над полем.
                        'notes'       => '', // Текст под полем.
                    ),
                    array(
                        'type'        => 'wysiwyg', // Тип поля. Обязательный.
                        'name'        => 'done__text', // Ключ поля. Обязательный.
                        'label'       => 'Content', // Заголовок поля.
                        'default'     => '', // Значение по умолчанию.
                        'instruction' => '', // Текст над полем.
                        'notes'       => '', // Текст под полем.
                    ),
                   
				) 
			);

			$settings[] = $Setting;
		}
	}

    if ( $type === 'page' ) {
		if ( get_page_template_slug( $id ) == PAGE_TEMPL_SERVICE ) {

			$Setting = SCF::add_setting( 'asf_service_hasvideo', 'Big img, video, content (left: big image; center: video; right: title, img, content;)' );
			$Setting->add_group(
				'service_hasvideo',
				false,
				array (
                    array(
                        'type'        => 'boolean', // Тип поля. Обязательный.
                        'name'        => 'boolean_hasvideo', // Ключ поля. Обязательный.
                        'label'       => 'Display block?', // Заголовок поля.
                        'default'     => '1', // Значение по умолчанию.
                        'true_label'  => 'Yes', // Текст радио-кнопки (true)
                        'false_label' => 'No', // Текст радио-кнопки (false)
                    ),
                    array(
                        'type'        => 'image', // Тип поля. Обязательный.
                        'name'        => 'hasvideo__big__image', // Ключ поля. Обязательный.
                        'label'       => 'big image', // Заголовок поля.
                        'size'        => 'medium', // Размер изображения в метабоксе.
                        'instruction' => '', // Текст над полем.
                        'notes'       => '', // Текст под полем.
                    ),
                    array(
                        'type'            => 'radio', // Тип поля. Обязательный.
                        'name'            => 'radio_hasvideo', // Ключ поля. Обязательный.
                        'label'           => 'Select video source', // Заголовок поля.
                        'choices'         => array( // Массив с вариантами выбора.
                            'no_video' => 'no video',
                            'video_youtube' => 'youtube',
                            'src_player' => 'player',
                        ),
                        'radio_direction' => 'horizontal', // или vertical. Вариант отображения пунктов.
                        'default'         => 'no_video', // Значение по умолчанию.
                        'notes'           => '', // Текст под полем.
                    ),
                    array(
                        'type'        => 'image', // Тип поля. Обязательный.
                        'name'        => 'bg_youtube_hasvideo', // Ключ поля. Обязательный.
                        'label'       => 'Background video', // Заголовок поля.
                        'size'        => 'thumbnail', // Размер изображения в метабоксе.
                        'instruction' => '', // Текст над полем.
                        'notes'       => '', // Текст под полем.
                    ),
                    array(
                        'type'        => 'text', // Тип поля. Обязательный.
                        'name'        => 'id_youtube_hasvideo', // Ключ поля. Обязательный.
                        'label'       => 'ID video', // Заголовок поля.
                        'default'     => '', // Значение по умолчанию.
                        'instruction' => 'ID is the set of characters after "watch?v=" in the browser line. As an example from the line https://www.youtube.com/watch?v=yCChjRhpV64 , id= yCChjRhpV64', // Текст над полем.
                        'notes'       => 'yCChjRhpV64', // Текст под полем.
                    ),
                    array(
                        'type'        => 'file', // Тип поля. Обязательный.
                        'name'        => 'src_player_hasvideo', // Ключ поля. Обязательный.
                        'label'       => 'Form link to video', // Заголовок поля.
                    ),
                    array(
                        'type'        => 'text', // Тип поля. Обязательный.
                        'name'        => 'hasvideo__title', // Ключ поля. Обязательный.
                        'label'       => 'Title', // Заголовок поля.
                        'default'     => '', // Значение по умолчанию.
                        'instruction' => '', // Текст над полем.
                        'notes'       => '', // Текст под полем.
                    ),
                    array(
                        'type'        => 'image', // Тип поля. Обязательный.
                        'name'        => 'hasvideo__img', // Ключ поля. Обязательный.
                        'label'       => 'image', // Заголовок поля.
                        'size'        => 'thumbnail', // Размер изображения в метабоксе.
                        'instruction' => '', // Текст над полем.
                        'notes'       => '', // Текст под полем.
                    ),
                    array(
                        'type'        => 'wysiwyg', // Тип поля. Обязательный.
                        'name'        => 'hasvideo__text', // Ключ поля. Обязательный.
                        'label'       => 'Content', // Заголовок поля.
                        'default'     => '', // Значение по умолчанию.
                        'instruction' => '', // Текст над полем.
                        'notes'       => '', // Текст под полем.
                    ),
                   
				) 
			);

			$settings[] = $Setting;
		}
	}

    if ( $type === 'page' ) {
		if ( get_page_template_slug( $id ) == PAGE_TEMPL_SERVICE ) {

			$Setting = SCF::add_setting( 'asf_service_hasimage', 'Content and img (left: title, content; right: img;)' );
			$Setting->add_group(
				'service_hasimage',
				false,
				array (
                    array(
                        'type'        => 'boolean', // Тип поля. Обязательный.
                        'name'        => 'boolean_hasimage', // Ключ поля. Обязательный.
                        'label'       => 'Display block?', // Заголовок поля.
                        'default'     => '', // Значение по умолчанию.
                        'true_label'  => 'Yes', // Текст радио-кнопки (true)
                        'false_label' => 'No', // Текст радио-кнопки (false)
                    ),
                    array(
                        'type'        => 'text', // Тип поля. Обязательный.
                        'name'        => 'hasimage__title', // Ключ поля. Обязательный.
                        'label'       => 'Title', // Заголовок поля.
                        'default'     => '', // Значение по умолчанию.
                        'instruction' => '', // Текст над полем.
                        'notes'       => '', // Текст под полем.
                    ),
                    array(
                        'type'        => 'wysiwyg', // Тип поля. Обязательный.
                        'name'        => 'hasimage__text', // Ключ поля. Обязательный.
                        'label'       => 'Content', // Заголовок поля.
                        'default'     => '', // Значение по умолчанию.
                        'instruction' => '', // Текст над полем.
                        'notes'       => '', // Текст под полем.
                    ),
                    array(
                        'type'        => 'image', // Тип поля. Обязательный.
                        'name'        => 'hasimage__img', // Ключ поля. Обязательный.
                        'label'       => 'image', // Заголовок поля.
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
		if ( get_page_template_slug( $id ) == PAGE_TEMPL_SERVICE ) {

			$Setting = SCF::add_setting( 'asf_service_stages', 'Setting up stages' );
			$Setting->add_group(
				'stages_settings',
				false,
				array (
                    array(
                        'type'        => 'boolean', // Тип поля. Обязательный.
                        'name'        => 'boolean_stages', // Ключ поля. Обязательный.
                        'label'       => 'Display block?', // Заголовок поля.
                        'default'     => '', // Значение по умолчанию.
                        'true_label'  => 'Yes', // Текст радио-кнопки (true)
                        'false_label' => 'No', // Текст радио-кнопки (false)
                    ),
                    array(
                        'type'        => 'text', // Тип поля. Обязательный.
                        'name'        => 'stages_section_title', // Ключ поля. Обязательный.
                        'label'       => 'Title', // Заголовок поля.
                        'default'     => '', // Значение по умолчанию.
                        'instruction' => '', // Текст над полем.
                        'notes'       => '', // Текст под полем.
                    ),
				) 
			);

			$settings[] = $Setting;
		}
	}

    if ( $type === 'page' ) {
		if ( get_page_template_slug( $id ) == PAGE_TEMPL_SERVICE ) {

			$Setting = SCF::add_setting( 'asf_service_stages_list', 'List of stages' );
			$Setting->add_group(
				'stages_list',
				true,
				array (
                    array(
                        'type'        => 'text', // Тип поля. Обязательный.
                        'name'        => 'stages__title', // Ключ поля. Обязательный.
                        'label'       => 'Title', // Заголовок поля.
                        'default'     => '', // Значение по умолчанию.
                        'instruction' => '', // Текст над полем.
                        'notes'       => '', // Текст под полем.
                    ),
                    array(
                        'type'        => 'textarea', // Тип поля. Обязательный.
                        'name'        => 'stages__text', // Ключ поля. Обязательный.
                        'label'       => 'Text', // Заголовок поля.
                        'rows'        => 2, // Количество строк. По умолчанию 5.
                    ),
				) 
			);

			$settings[] = $Setting;
		}
	}

    if ( $type === 'page' ) {
		if ( get_page_template_slug( $id ) == PAGE_TEMPL_SERVICE ) {

			$Setting = SCF::add_setting( 'asf_service_reverse', 'Content and img, dark background. (left: title, content; right: img;)' );
			$Setting->add_group(
				'service_reverse',
				false,
                array (
                    array(
                        'type'        => 'boolean', // Тип поля. Обязательный.
                        'name'        => 'boolean_reverse', // Ключ поля. Обязательный.
                        'label'       => 'Display block?', // Заголовок поля.
                        'default'     => '', // Значение по умолчанию.
                        'true_label'  => 'Yes', // Текст радио-кнопки (true)
                        'false_label' => 'No', // Текст радио-кнопки (false)
                    ),
                    array(
                        'type'        => 'text', // Тип поля. Обязательный.
                        'name'        => 'reverse__title', // Ключ поля. Обязательный.
                        'label'       => 'Title', // Заголовок поля.
                        'default'     => '', // Значение по умолчанию.
                        'instruction' => '', // Текст над полем.
                        'notes'       => '', // Текст под полем.
                    ),
                    array(
                        'type'        => 'wysiwyg', // Тип поля. Обязательный.
                        'name'        => 'reverse__text', // Ключ поля. Обязательный.
                        'label'       => 'Content', // Заголовок поля.
                        'default'     => '', // Значение по умолчанию.
                        'instruction' => '', // Текст над полем.
                        'notes'       => '', // Текст под полем.
                    ),
                    array(
                        'type'        => 'image', // Тип поля. Обязательный.
                        'name'        => 'reverse__img', // Ключ поля. Обязательный.
                        'label'       => 'image', // Заголовок поля.
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
		if ( get_page_template_slug( $id ) == PAGE_TEMPL_SERVICE ) {

			$Setting = SCF::add_setting( 'asf_service_awards', 'Awards' );
			$Setting->add_group(
				'service_awards',
				false,
                array (
                    array(
                        'type'        => 'boolean', // Тип поля. Обязательный.
                        'name'        => 'boolean_awards', // Ключ поля. Обязательный.
                        'label'       => 'Display block?', // Заголовок поля.
                        'default'     => 'false', // Значение по умолчанию.
                        'true_label'  => 'Yes', // Текст радио-кнопки (true)
                        'false_label' => 'No', // Текст радио-кнопки (false)
                    ),
                    array(
                        'type'        => 'text', // Тип поля. Обязательный.
                        'name'        => 'awards__title', // Ключ поля. Обязательный.
                        'label'       => 'Title', // Заголовок поля.
                        'default'     => '', // Значение по умолчанию.
                        'instruction' => '', // Текст над полем.
                        'notes'       => '', // Текст под полем.
                    ),                   
				) 
			);
			$settings[] = $Setting;
		}
	}

    if ( $type === 'page' ) {
		if ( get_page_template_slug( $id ) == PAGE_TEMPL_SERVICE ) {

            $Setting = SCF::add_setting( 'asf_service_awards_list', 'Awards images' );
			$Setting->add_group(
				'awards_images_settings',
				true,
				array (
                    array(
                        'type'        => 'image', // Тип поля. Обязательный.
                        'name'        => 'awards__img', // Ключ поля. Обязательный.
                        'label'       => 'Logo', // Заголовок поля.
                        'size'        => 'full', // Размер изображения в метабоксе.
                        'instruction' => '', // Текст над полем.
                        'notes'       => '', // Текст под полем.
                    ),
                    array(
                        'type'        => 'image', // Тип поля. Обязательный.
                        'name'        => 'awards__foto', // Ключ поля. Обязательный.
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

    if ( $type === 'page' ) {
		if ( get_page_template_slug( $id ) == PAGE_TEMPL_SERVICE ) {

			$Setting = SCF::add_setting( 'asf_service_testimonials', 'Client reviews' );
			$Setting->add_group(
				'service_testimonials',
				false,
                array (
                    array(
                        'type'        => 'boolean', // Тип поля. Обязательный.
                        'name'        => 'boolean_service_testimonials', // Ключ поля. Обязательный.
                        'label'       => 'Display block?', // Заголовок поля.
                        'default'     => '', // Значение по умолчанию.
                        'true_label'  => 'Yes', // Текст радио-кнопки (true)
                        'false_label' => 'No', // Текст радио-кнопки (false)
                    ),
                    array(
                        'type'        => 'text', // Тип поля. Обязательный.
                        'name'        => 'service_testimonials__title', // Ключ поля. Обязательный.
                        'label'       => 'Title', // Заголовок поля.
                        'default'     => '', // Значение по умолчанию.
                        'instruction' => '', // Текст над полем.
                        'notes'       => 'Client reviews', // Текст под полем.
                    ),
                    array(
                        'type'        => 'relation', // Тип поля. Обязательный.
                        'name'        => 'relation_service_testimonials', // Ключ поля. Обязательный.
                        'label'       => 'Select testimonials', // Заголовок поля.
                        'post-type'   => array('testimonials'), // Типы записей.
                        'limit'       => -1, // Максимальное количество выбираемых элементов.
                        'instruction' => '', // Текст над полем.
                        'notes'       => '', // Текст под полем.
                    ),
    
				) 
			
			);

			$settings[] = $Setting;
		}
	}

    if ( $type === 'page' ) {
		if ( get_page_template_slug( $id ) == PAGE_TEMPL_SERVICE ) {

			$Setting = SCF::add_setting( 'asf_service_consult', 'Consult' );
			$Setting->add_group(
				'service_consult',
				false,
                array (
                    array(
                        'type'        => 'boolean', // Тип поля. Обязательный.
                        'name'        => 'boolean_consult', // Ключ поля. Обязательный.
                        'label'       => 'Display block?', // Заголовок поля.
                        'default'     => '', // Значение по умолчанию.
                        'true_label'  => 'Yes', // Текст радио-кнопки (true)
                        'false_label' => 'No', // Текст радио-кнопки (false)
                    ),
                    array(
                        'type'        => 'text', // Тип поля. Обязательный.
                        'name'        => 'consult__title', // Ключ поля. Обязательный.
                        'label'       => 'Title', // Заголовок поля.
                        'default'     => '', // Значение по умолчанию.
                        'instruction' => '', // Текст над полем.
                        'notes'       => 'Consult with a designer today', // Текст под полем.
                    ),
                    array(
                        'type'        => 'text', // Тип поля. Обязательный.
                        'name'        => 'consult__link', // Ключ поля. Обязательный.
                        'label'       => 'Link', // Заголовок поля.
                        'default'     => '', // Значение по умолчанию.
                        'instruction' => '', // Текст над полем.
                        'notes'       => 'contact-us', // Текст под полем.
                    ),
        
				) 
			
			);

			$settings[] = $Setting;
		}
	}

	return $settings;
}
add_filter('smart-cf-register-fields', 'template_service_fields', 10, 5);
