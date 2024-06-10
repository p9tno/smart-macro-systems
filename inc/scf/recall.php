<?php
function recall_fields($settings, $type, $id, $meta_type, $types)
{
    if ($type === 'testimonials' && get_page_template_slug($id) == '') {

		$Section = SCF::add_setting('acf_testimonials_settings', '<span>Testimonials main settings. <span style="color:#517DC0;">Only 1 and every 9 elements can display content and video in one element.</span></span>');

		$Section->add_group(
			'testimonials-settings',
			false,
			array(
                array(
                    'type'        => 'text', // Тип поля. Обязательный.
                    'name'        => 'person__title', // Ключ поля. Обязательный.
                    'label'       => 'Title', // Заголовок поля.
                    'default'     => '', // Значение по умолчанию.
                    'instruction' => '', // Текст над полем.
                    'notes'       => '', // Текст под полем.
                ),
                array(
                    'type'        => 'text', // Тип поля. Обязательный.
                    'name'        => 'person__desc', // Ключ поля. Обязательный.
                    'label'       => 'Desc', // Заголовок поля.
                    'default'     => '', // Значение по умолчанию.
                    'instruction' => '', // Текст над полем.
                    'notes'       => '', // Текст под полем.
                ),
                array(
                    'type'        => 'image', // Тип поля. Обязательный.
                    'name'        => 'person__img', // Ключ поля. Обязательный.
                    'label'       => 'Img', // Заголовок поля.
                    'size'        => 'thumbnail', // Размер изображения в метабоксе.
                    'instruction' => '', // Текст над полем.
                    'notes'       => '', // Текст под полем.
                ),
  
			)
		);

		$settings[] = $Section;
	}
    if ($type === 'testimonials' && get_page_template_slug($id) == '') {

		$Section = SCF::add_setting('acf_testimonials_youtube', '<span>Testimonials video.');

		$Section->add_group(
			'testimonials-video',
			false,
			array(
                array(
                    'type'        => 'image', // Тип поля. Обязательный.
                    'name'        => 'bg_youtube_video', // Ключ поля. Обязательный.
                    'label'       => 'Background video', // Заголовок поля.
                    'size'        => 'thumbnail', // Размер изображения в метабоксе.
                    'instruction' => '', // Текст над полем.
                    'notes'       => '', // Текст под полем.
                ),
                array(
                    'type'            => 'radio', // Тип поля. Обязательный.
                    'name'            => 'radio_video', // Ключ поля. Обязательный.
                    'label'           => 'Select video source', // Заголовок поля.
                    'choices'         => array( // Массив с вариантами выбора.
                        'no_video' => 'no video',
                        'video_youtube' => 'youtube',
                        'src_player' => 'player',
                    ),
                    'radio_direction' => 'horizontal', // или vertical. Вариант отображения пунктов.
                    'default'         => 'no_video', // Значение по умолчанию.
                    'instruction'     => 'If you fill out this field, all other data will not be displayed. Only 1 and every 9 elements оn the testimonials page.', // Текст над полем.
                    'notes'           => '', // Текст под полем.
                ),
                array(
                    'type'        => 'text', // Тип поля. Обязательный.
                    'name'        => 'id_youtube_video', // Ключ поля. Обязательный.
                    'label'       => 'ID video', // Заголовок поля.
                    'default'     => '', // Значение по умолчанию.
                    'instruction' => 'ID is the set of characters after "watch?v=" in the browser line. As an example from the line https://www.youtube.com/watch?v=yCChjRhpV64 , id= yCChjRhpV64', // Текст над полем.
                    'notes'       => 'yCChjRhpV64', // Текст под полем.
                ),
                array(
                    'type'        => 'file', // Тип поля. Обязательный.
                    'name'        => 'src_player_video', // Ключ поля. Обязательный.
                    'label'       => 'Form link to video', // Заголовок поля.
                ),
  
			)
		);

		$settings[] = $Section;
	}
	if ($type === 'testimonials' && get_page_template_slug($id) == '') {

		$Section = SCF::add_setting('acf_testimonials_gallery', '<span>Testimonials gallery.</span> ');

        $Section->add_group(
			'recall__slider',
			true,
			array(
                array(
                    'type'        => 'image', // Тип поля. Обязательный.
                    'name'        => 'recall_img', // Ключ поля. Обязательный.
                    'label'       => 'Item', // Заголовок поля.
                    'size'        => 'thumbnail', // Размер изображения в метабоксе.
                    'instruction' => '', // Текст над полем.
                    'notes'       => '', // Текст под полем.
                ),  
			)
		);

		$settings[] = $Section;
	}
	return $settings;
}
add_filter('smart-cf-register-fields', 'recall_fields', 10, 5);