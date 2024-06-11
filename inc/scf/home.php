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
                    'instruction' => 'To highlight text with a different color, wrap the text in a span tag', // Текст над полем.
                    'notes'       => 'Text <span>text in a different color</span>', // Текст под полем.
                ),
                array(
                    'type'        => 'wysiwyg', // Тип поля. Обязательный.
                    'name'        => 'firstscreen_text', // Ключ поля. Обязательный.
                    'label'       => 'Text desktop', // Заголовок поля.
                ),
                array(
                    'type'        => 'wysiwyg', // Тип поля. Обязательный.
                    'name'        => 'firstscreen_text_m', // Ключ поля. Обязательный.
                    'label'       => 'Text mobile', // Заголовок поля.
                ),
                array(
                    'type'        => 'image', // Тип поля. Обязательный.
                    'name'        => 'firstscreen_img', // Ключ поля. Обязательный.
                    'label'       => 'Image', // Заголовок поля.
                    'size'        => 'medium', // Размер изображения в метабоксе. thumbnail medium large
                ),
			)
		);

		$settings[] = $Section;
	}
    
	if (HOME_ID == $id && $type === 'page') {
		$Section = SCF::add_setting('asf_preview', 'Smart homes (Made)');
		$Section->add_group(
			'made-section',
			false,
			array(
                array(
                    'type'        => 'text', // Тип поля. Обязательный.
                    'name'        => 'made_label', // Ключ поля. Обязательный.
                    'label'       => 'Label', // Заголовок поля.
                ),
                array(
                    'type'        => 'text', // Тип поля. Обязательный.
                    'name'        => 'made_title', // Ключ поля. Обязательный.
                    'label'       => 'Title', // Заголовок поля.
                    'instruction' => 'To highlight text with a different color, wrap the text in a span tag', // Текст над полем.
                    'notes'       => 'Text <span>text in a different color</span>', // Текст под полем.
                ),
                array(
                    'type'        => 'textarea', // Тип поля. Обязательный.
                    'name'        => 'made_desc', // Ключ поля. Обязательный.
                    'label'       => 'Description', // Заголовок поля.
                    'rows'        => 3, // Количество строк. По умолчанию 5.
                ),
			)
		);

        $Section->add_group(
			'made_list',
			true,
			array(
                array(
                    'type'        => 'image', // Тип поля. Обязательный.
                    'name'        => 'made_list_img', // Ключ поля. Обязательный.
                    'label'       => 'Image', // Заголовок поля.
                    'size'        => 'thumbnail', // Размер изображения в метабоксе. thumbnail medium large
                ),
                array(
					'name'        => 'made_list_title',
					'label'       => 'Title',
					'type'        => 'text',
				),
                array(
					'name'        => 'made_list_text',
					'label'       => 'Text',
					'type'        => 'textarea',
                    'rows'        => 2,
				),
			)
		);

		$settings[] = $Section;
	}

	if (HOME_ID == $id && $type === 'page') {
		$Section = SCF::add_setting('asf_work', 'Smart homes (Work)');
		$Section->add_group(
			'work-section',
			false,
			array(
                array(
                    'type'        => 'text', // Тип поля. Обязательный.
                    'name'        => 'work_label', // Ключ поля. Обязательный.
                    'label'       => 'Label', // Заголовок поля.
                ),
                array(
                    'type'        => 'text', // Тип поля. Обязательный.
                    'name'        => 'work_title', // Ключ поля. Обязательный.
                    'label'       => 'Title', // Заголовок поля.
                    'instruction' => 'To highlight text with a different color, wrap the text in a span tag', // Текст над полем.
                    'notes'       => 'Text <span>text in a different color</span>', // Текст под полем.
                ),
                array(
                    'type'        => 'textarea', // Тип поля. Обязательный.
                    'name'        => 'work_desc', // Ключ поля. Обязательный.
                    'label'       => 'Description', // Заголовок поля.
                    'rows'        => 3, // Количество строк. По умолчанию 5.
                ),
                array(
                    'type'        => 'image', // Тип поля. Обязательный.
                    'name'        => 'work_img', // Ключ поля. Обязательный.
                    'label'       => 'Image', // Заголовок поля.
                    'size'        => 'medium', // Размер изображения в метабоксе. thumbnail medium large
                ),
			)
		);

        $Section->add_group(
			'work_list',
			true,
			array(
                array(
					'name'        => 'work_list_title',
					'label'       => 'Title',
					'type'        => 'text',
				),
                array(
					'name'        => 'work_list_text',
					'label'       => 'Text',
					'type'        => 'textarea',
                    'rows'        => 2,
				),
			)
		);

		$settings[] = $Section;
	}

	if (HOME_ID == $id && $type === 'page') {
		$Section = SCF::add_setting('asf_homeExamples', 'Smart homes (Examples)');
		$Section->add_group(
			'homeExamples-section',
			false,
			array(
                array(
                    'type'        => 'text', // Тип поля. Обязательный.
                    'name'        => 'homeExamples_label', // Ключ поля. Обязательный.
                    'label'       => 'Label', // Заголовок поля.
                ),
                array(
                    'type'        => 'text', // Тип поля. Обязательный.
                    'name'        => 'homeExamples_title', // Ключ поля. Обязательный.
                    'label'       => 'Title', // Заголовок поля.
                    'instruction' => 'To highlight text with a different color, wrap the text in a span tag', // Текст над полем.
                    'notes'       => 'Text <span>text in a different color</span>', // Текст под полем.
                ),
			)
		);

        $Section->add_group(
			'homeExamples_list',
			true,
			array(
                array(
                    'type'        => 'image', // Тип поля. Обязательный.
                    'name'        => 'homeExamples_list_img', // Ключ поля. Обязательный.
                    'label'       => 'Image', // Заголовок поля.
                    'size'        => 'thumbnail', // Размер изображения в метабоксе. thumbnail medium large
                ),
                array(
					'name'        => 'homeExamples_list_title',
					'label'       => 'Title',
					'type'        => 'text',
				),
                array(
					'name'        => 'homeExamples_list_text',
					'label'       => 'Text',
					'type'        => 'textarea',
                    'rows'        => 2,
				),
			)
		);

		$settings[] = $Section;
	}

	if (HOME_ID == $id && $type === 'page') {
		$Section = SCF::add_setting('asf_ofices', 'Smart ofices');
		$Section->add_group(
			'ofices-section',
			false,
			array(
                array(
                    'type'        => 'text', // Тип поля. Обязательный.
                    'name'        => 'ofices_label', // Ключ поля. Обязательный.
                    'label'       => 'Label', // Заголовок поля.
                ),
                array(
                    'type'        => 'text', // Тип поля. Обязательный.
                    'name'        => 'ofices_title', // Ключ поля. Обязательный.
                    'label'       => 'Title', // Заголовок поля.
                    'instruction' => 'To highlight text with a different color, wrap the text in a span tag', // Текст над полем.
                    'notes'       => 'Text <span>text in a different color</span>', // Текст под полем.
                ),
                array(
                    'type'        => 'textarea', // Тип поля. Обязательный.
                    'name'        => 'ofices_desc', // Ключ поля. Обязательный.
                    'label'       => 'Description', // Заголовок поля.
                    'rows'        => 3, // Количество строк. По умолчанию 5.
                ),
			)
		);

        $Section->add_group(
			'ofices_list',
			true,
			array(
                array(
                    'type'        => 'image', // Тип поля. Обязательный.
                    'name'        => 'ofices_list_img', // Ключ поля. Обязательный.
                    'label'       => 'Image', // Заголовок поля.
                    'size'        => 'thumbnail', // Размер изображения в метабоксе. thumbnail medium large
                ),
                array(
					'name'        => 'ofices_list_title',
					'label'       => 'Title',
					'type'        => 'text',
				),
                array(
					'name'        => 'ofices_list_text',
					'label'       => 'Text',
					'type'        => 'textarea',
                    'rows'        => 2,
				),
			)
		);

		$settings[] = $Section;
	}

	if (HOME_ID == $id && $type === 'page') {
		$Section = SCF::add_setting('asf_oficesExamples', 'Smart ofices (Examples)');
		$Section->add_group(
			'oficesExamples-section',
			false,
			array(
                array(
                    'type'        => 'text', // Тип поля. Обязательный.
                    'name'        => 'oficesExamples_label', // Ключ поля. Обязательный.
                    'label'       => 'Label', // Заголовок поля.
                ),
                array(
                    'type'        => 'text', // Тип поля. Обязательный.
                    'name'        => 'oficesExamples_title', // Ключ поля. Обязательный.
                    'label'       => 'Title', // Заголовок поля.
                    'instruction' => 'To highlight text with a different color, wrap the text in a span tag', // Текст над полем.
                    'notes'       => 'Text <span>text in a different color</span>', // Текст под полем.
                ),
                array(
                    'type'        => 'wysiwyg', // Тип поля. Обязательный.
                    'name'        => 'oficesExamples_text', // Ключ поля. Обязательный.
                    'label'       => 'Text', // Заголовок поля.
                ),
                array(
                    'type'        => 'image', // Тип поля. Обязательный.
                    'name'        => 'oficesExamples_img', // Ключ поля. Обязательный.
                    'label'       => 'Image', // Заголовок поля.
                    'size'        => 'medium', // Размер изображения в метабоксе. thumbnail medium large
                ),
      
			)
		);

		$settings[] = $Section;
	}

	if (HOME_ID == $id && $type === 'page') {
		$Section = SCF::add_setting('asf_buildings', 'Smart buildings');
		$Section->add_group(
			'buildings-section',
			false,
			array(
                array(
                    'type'        => 'text', // Тип поля. Обязательный.
                    'name'        => 'buildings_label', // Ключ поля. Обязательный.
                    'label'       => 'Label', // Заголовок поля.
                ),
                array(
                    'type'        => 'text', // Тип поля. Обязательный.
                    'name'        => 'buildings_title', // Ключ поля. Обязательный.
                    'label'       => 'Title', // Заголовок поля.
                    'instruction' => 'To highlight text with a different color, wrap the text in a span tag', // Текст над полем.
                    'notes'       => 'Text <span>text in a different color</span>', // Текст под полем.
                ),
                array(
                    'type'        => 'textarea', // Тип поля. Обязательный.
                    'name'        => 'buildings_desc', // Ключ поля. Обязательный.
                    'label'       => 'Description', // Заголовок поля.
                    'rows'        => 3, // Количество строк. По умолчанию 5.
                ),
                array(
                    'type'        => 'image', // Тип поля. Обязательный.
                    'name'        => 'buildings_img', // Ключ поля. Обязательный.
                    'label'       => 'Image', // Заголовок поля.
                    'size'        => 'medium', // Размер изображения в метабоксе. thumbnail medium large
                ),
      
			)
		);

        $Section->add_group(
			'buildings_list',
			true,
			array(
                array(
                    'type'        => 'image', // Тип поля. Обязательный.
                    'name'        => 'buildings_list_img', // Ключ поля. Обязательный.
                    'label'       => 'Image', // Заголовок поля.
                    'size'        => 'thumbnail', // Размер изображения в метабоксе. thumbnail medium large
                ),
                array(
					'name'        => 'buildings_list_title',
					'label'       => 'Title',
					'type'        => 'text',
				),
                array(
					'name'        => 'buildings_list_text',
					'label'       => 'Text',
					'type'        => 'textarea',
                    'rows'        => 2,
				),
			)
		);

		$settings[] = $Section;
	}

	if (HOME_ID == $id && $type === 'page') {
		$Section = SCF::add_setting('asf_buildingsExamples', 'Smart buildings (Examples)');
		$Section->add_group(
			'buildingsExamples-section',
			false,
			array(
                array(
                    'type'        => 'text', // Тип поля. Обязательный.
                    'name'        => 'buildingsExamples_label', // Ключ поля. Обязательный.
                    'label'       => 'Label', // Заголовок поля.
                ),
                array(
                    'type'        => 'text', // Тип поля. Обязательный.
                    'name'        => 'buildingsExamples_title', // Ключ поля. Обязательный.
                    'label'       => 'Title', // Заголовок поля.
                    'instruction' => 'To highlight text with a different color, wrap the text in a span tag', // Текст над полем.
                    'notes'       => 'Text <span>text in a different color</span>', // Текст под полем.
                ),
                array(
                    'type'        => 'textarea', // Тип поля. Обязательный.
                    'name'        => 'buildingsExamples_desc', // Ключ поля. Обязательный.
                    'label'       => 'Description', // Заголовок поля.
                    'rows'        => 3, // Количество строк. По умолчанию 5.
                ),
                array(
                    'type'        => 'image', // Тип поля. Обязательный.
                    'name'        => 'buildingsExamples_img', // Ключ поля. Обязательный.
                    'label'       => 'Image', // Заголовок поля.
                    'size'        => 'medium', // Размер изображения в метабоксе. thumbnail medium large
                ),
			)
		);

		$settings[] = $Section;
	}

	if (HOME_ID == $id && $type === 'page') {
		$Section = SCF::add_setting('asf_macro', 'Smart macro');
		$Section->add_group(
			'macro-section',
			false,
			array(
                array(
                    'type'        => 'text', // Тип поля. Обязательный.
                    'name'        => 'macro_label', // Ключ поля. Обязательный.
                    'label'       => 'Label', // Заголовок поля.
                ),
                array(
                    'type'        => 'text', // Тип поля. Обязательный.
                    'name'        => 'macro_title', // Ключ поля. Обязательный.
                    'label'       => 'Title', // Заголовок поля.
                    'instruction' => 'To highlight text with a different color, wrap the text in a span tag', // Текст над полем.
                    'notes'       => 'Text <span>text in a different color</span>', // Текст под полем.
                ),
                array(
                    'type'        => 'textarea', // Тип поля. Обязательный.
                    'name'        => 'macro_desc', // Ключ поля. Обязательный.
                    'label'       => 'Description', // Заголовок поля.
                    'rows'        => 3, // Количество строк. По умолчанию 5.
                ),
                array(
                    'type'        => 'image', // Тип поля. Обязательный.
                    'name'        => 'macro_img', // Ключ поля. Обязательный.
                    'label'       => 'Image', // Заголовок поля.
                    'size'        => 'medium', // Размер изображения в метабоксе. thumbnail medium large
                ),
			)
		);

		$settings[] = $Section;
	}

	if (HOME_ID == $id && $type === 'page') {
		$Section = SCF::add_setting('asf_macroFunctions', 'Smart macro (Functions)');
		$Section->add_group(
			'macroFunctions-section',
			false,
			array(
                array(
                    'type'        => 'text', // Тип поля. Обязательный.
                    'name'        => 'macroFunctions_label', // Ключ поля. Обязательный.
                    'label'       => 'Label', // Заголовок поля.
                ),
                array(
                    'type'        => 'text', // Тип поля. Обязательный.
                    'name'        => 'macroFunctions_title', // Ключ поля. Обязательный.
                    'label'       => 'Title', // Заголовок поля.
                    'instruction' => 'To highlight text with a different color, wrap the text in a span tag', // Текст над полем.
                    'notes'       => 'Text <span>text in a different color</span>', // Текст под полем.
                ),
                array(
                    'type'        => 'textarea', // Тип поля. Обязательный.
                    'name'        => 'macroFunctions_desc', // Ключ поля. Обязательный.
                    'label'       => 'Description', // Заголовок поля.
                    'rows'        => 3, // Количество строк. По умолчанию 5.
                ),
                array(
                    'type'        => 'image', // Тип поля. Обязательный.
                    'name'        => 'macroFunctions_img', // Ключ поля. Обязательный.
                    'label'       => 'Image', // Заголовок поля.
                    'size'        => 'medium', // Размер изображения в метабоксе. thumbnail medium large
                ),
			)
		);

        $Section->add_group(
			'macroFunctions_list',
			true,
			array(
                array(
                    'type'        => 'image', // Тип поля. Обязательный.
                    'name'        => 'macroFunctions_list_img', // Ключ поля. Обязательный.
                    'label'       => 'Image', // Заголовок поля.
                    'size'        => 'thumbnail', // Размер изображения в метабоксе. thumbnail medium large
                ),
                array(
					'name'        => 'macroFunctions_list_title',
					'label'       => 'Title',
					'type'        => 'text',
				),
                array(
					'name'        => 'macroFunctions_list_text',
					'label'       => 'Text',
					'type'        => 'textarea',
                    'rows'        => 2,
				),
			)
		);

		$settings[] = $Section;
	}

	if (HOME_ID == $id && $type === 'page') {
		$Section = SCF::add_setting('asf_security', 'Security');
		$Section->add_group(
			'security-section',
			false,
			array(
                array(
                    'type'        => 'text', // Тип поля. Обязательный.
                    'name'        => 'security_label', // Ключ поля. Обязательный.
                    'label'       => 'Label', // Заголовок поля.
                ),
                array(
                    'type'        => 'text', // Тип поля. Обязательный.
                    'name'        => 'security_title', // Ключ поля. Обязательный.
                    'label'       => 'Title', // Заголовок поля.
                    'instruction' => 'To highlight text with a different color, wrap the text in a span tag', // Текст над полем.
                    'notes'       => 'Text <span>text in a different color</span>', // Текст под полем.
                ),
                array(
                    'type'        => 'textarea', // Тип поля. Обязательный.
                    'name'        => 'security_desc', // Ключ поля. Обязательный.
                    'label'       => 'Description', // Заголовок поля.
                    'rows'        => 3, // Количество строк. По умолчанию 5.
                ),
                array(
                    'type'        => 'image', // Тип поля. Обязательный.
                    'name'        => 'security_img', // Ключ поля. Обязательный.
                    'label'       => 'Image', // Заголовок поля.
                    'size'        => 'medium', // Размер изображения в метабоксе. thumbnail medium large
                ),
			)
		);

		$settings[] = $Section;
	}

	if (HOME_ID == $id && $type === 'page') {
		$Section = SCF::add_setting('asf_securityAdvanced', 'Security (Advanced)');
		$Section->add_group(
			'securityAdvanced-section',
			false,
			array(
                array(
                    'type'        => 'text', // Тип поля. Обязательный.
                    'name'        => 'securityAdvanced_label', // Ключ поля. Обязательный.
                    'label'       => 'Label', // Заголовок поля.
                ),
                array(
                    'type'        => 'text', // Тип поля. Обязательный.
                    'name'        => 'securityAdvanced_title', // Ключ поля. Обязательный.
                    'label'       => 'Title', // Заголовок поля.
                    'instruction' => 'To highlight text with a different color, wrap the text in a span tag', // Текст над полем.
                    'notes'       => 'Text <span>text in a different color</span>', // Текст под полем.
                ),
                array(
                    'type'        => 'textarea', // Тип поля. Обязательный.
                    'name'        => 'securityAdvanced_desc', // Ключ поля. Обязательный.
                    'label'       => 'Description', // Заголовок поля.
                    'rows'        => 3, // Количество строк. По умолчанию 5.
                ),
                array(
                    'type'        => 'image', // Тип поля. Обязательный.
                    'name'        => 'securityAdvanced_img_top', // Ключ поля. Обязательный.
                    'label'       => 'Image, top', // Заголовок поля.
                    'size'        => 'medium', // Размер изображения в метабоксе. thumbnail medium large
                ),
                array(
                    'type'        => 'image', // Тип поля. Обязательный.
                    'name'        => 'securityAdvanced_img_bottom', // Ключ поля. Обязательный.
                    'label'       => 'Image, bottom', // Заголовок поля.
                    'size'        => 'medium', // Размер изображения в метабоксе. thumbnail medium large
                ),
			)
		);
        $Section->add_group(
			'securityAdvanced_list',
			true,
			array(
                array(
					'name'        => 'securityAdvanced_list_title',
					'label'       => 'Title',
					'type'        => 'text',
				),
                array(
					'name'        => 'securityAdvanced_list_text',
					'label'       => 'Text',
					'type'        => 'textarea',
                    'rows'        => 2,
				),
			)
		);

		$settings[] = $Section;
	}

	if (HOME_ID == $id && $type === 'page') {
		$Section = SCF::add_setting('asf_securityExample', 'Security (Example)');
		$Section->add_group(
			'securityExample-section',
			false,
			array(
                array(
                    'type'        => 'text', // Тип поля. Обязательный.
                    'name'        => 'securityExample_label', // Ключ поля. Обязательный.
                    'label'       => 'Label', // Заголовок поля.
                ),
                array(
                    'type'        => 'text', // Тип поля. Обязательный.
                    'name'        => 'securityExample_title', // Ключ поля. Обязательный.
                    'label'       => 'Title', // Заголовок поля.
                    'instruction' => 'To highlight text with a different color, wrap the text in a span tag', // Текст над полем.
                    'notes'       => 'Text <span>text in a different color</span>', // Текст под полем.
                ),
                array(
                    'type'        => 'textarea', // Тип поля. Обязательный.
                    'name'        => 'securityExample_desc', // Ключ поля. Обязательный.
                    'label'       => 'Description', // Заголовок поля.
                    'rows'        => 3, // Количество строк. По умолчанию 5.
                ),
                array(
                    'type'        => 'image', // Тип поля. Обязательный.
                    'name'        => 'securityExample_img_d', // Ключ поля. Обязательный.
                    'label'       => 'Image, desktop', // Заголовок поля.
                    'size'        => 'medium', // Размер изображения в метабоксе. thumbnail medium large
                ),
                array(
                    'type'        => 'image', // Тип поля. Обязательный.
                    'name'        => 'securityExample_img_m', // Ключ поля. Обязательный.
                    'label'       => 'Image, mobile', // Заголовок поля.
                    'size'        => 'medium', // Размер изображения в метабоксе. thumbnail medium large
                ),
			)
		);
 
		$settings[] = $Section;
	}

	if (HOME_ID == $id && $type === 'page') {
		$Section = SCF::add_setting('asf_securityBenefits', 'Security (Benefits)');
		$Section->add_group(
			'securityBenefits-section',
			false,
			array(
                array(
                    'type'        => 'text', // Тип поля. Обязательный.
                    'name'        => 'securityBenefits_label', // Ключ поля. Обязательный.
                    'label'       => 'Label', // Заголовок поля.
                ),
                array(
                    'type'        => 'text', // Тип поля. Обязательный.
                    'name'        => 'securityBenefits_title', // Ключ поля. Обязательный.
                    'label'       => 'Title', // Заголовок поля.
                    'instruction' => 'To highlight text with a different color, wrap the text in a span tag', // Текст над полем.
                    'notes'       => 'Text <span>text in a different color</span>', // Текст под полем.
                ),
                array(
                    'type'        => 'textarea', // Тип поля. Обязательный.
                    'name'        => 'securityBenefits_desc', // Ключ поля. Обязательный.
                    'label'       => 'Description', // Заголовок поля.
                    'rows'        => 3, // Количество строк. По умолчанию 5.
                ),
                array(
                    'type'        => 'image', // Тип поля. Обязательный.
                    'name'        => 'securityBenefits_img', // Ключ поля. Обязательный.
                    'label'       => 'Image', // Заголовок поля.
                    'size'        => 'medium', // Размер изображения в метабоксе. thumbnail medium large
                ),
			)
		);

        $Section->add_group(
			'securityBenefits_list',
			true,
			array(
                array(
					'name'        => 'securityBenefits_list_title',
					'label'       => 'Title',
					'type'        => 'text',
				),
                array(
					'name'        => 'securityBenefits_list_text',
					'label'       => 'Text',
					'type'        => 'textarea',
                    'rows'        => 2,
				),
			)
		);
 
		$settings[] = $Section;
	}



	return $settings;
}
add_filter('smart-cf-register-fields', 'home_page_fields', 1, 5);
