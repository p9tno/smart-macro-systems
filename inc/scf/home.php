<?php
if (!defined('HOME_ID')) {
	$homeId = get_option('page_on_front');
	define('HOME_ID', $homeId);
}

function home_page_fields($settings, $type, $id, $meta_type, $types)
{
	if (HOME_ID == $id && $type === 'page') {

        $SectionOrder = SCF::add_setting('asf_sections_order', 'Управление секциями');
        $SectionOrder->add_group(
            'sections_order_manager',
            true,
            array(
                array(
                    'type'        => 'select',
                    'name'        => 'section_name',
                    'label'       => 'Секция',
                    'choices'     => array(
                        '' => '— Выберите секцию —',
                        'firstscreen' => 'Первый экран',
                        'preview' => 'Жилые решения (Услуги)',
                        'work' => 'Жилые решения (Процесс)',
                        'homeExamples' => 'Жилые решения (Примеры)',
                        'ofices' => 'Коммерческие помещения',
                        'oficesExamples' => 'Коммерческие помещения (Примеры)',
                        'buildings' => 'Строительство зданий',
                        'buildingsExamples' => 'Строительство зданий (Примеры)',
                        'macro' => 'Гарантия качества',
                        'macroFunctions' => 'Контроль качества (Системы)',
                        'smartHome' => 'Контроль качества (Пример)',
                        'securityExample' => 'Управление качеством (Пример)',
                        'benefits' => 'Преимущества'
                    ),
                    'instruction' => 'Выберите секцию. Перетащите - чтобы изменить порядок.',
                ),
                array(
                    'type'        => 'checkbox',
                    'name'        => 'section_active',
                    'label'       => 'Активна',
                    'choices'     => array('yes' => 'Показывать эту секцию'),
                    'default'     => array('yes'),
                )
            )
        );
        $settings[] = $SectionOrder;

		$Section = SCF::add_setting('asf_firstscreen', 'Первый экран');
		$Section->add_group(
			'firstscreen-section',
			false,
			array(
                array(
                    'type'        => 'wysiwyg',
                    'name'        => 'firstscreen_title',
                    'label'       => 'Заголовок',
                    'instruction' => 'Чтобы выделить текст другим цветом, оберните текст в тег strong',
                    'notes'       => 'Текст <strong>текст другого цвета</strong>',
                ),
                array(
                    'type'        => 'wysiwyg',
                    'name'        => 'firstscreen_text',
                    'label'       => 'Текст для десктопа',
                ),
                array(
                    'type'        => 'image',
                    'name'        => 'firstscreen_img',
                    'label'       => 'Изображение',
                    'size'        => 'medium',
                ),
			)
		);
		$settings[] = $Section;
	}
    
	if (HOME_ID == $id && $type === 'page') {
		$Section = SCF::add_setting('asf_preview', 'Жилые решения (Услуги)');
		$Section->add_group(
			'made-section',
			false,
			array(
                array(
                    'type'        => 'text',
                    'name'        => 'made_label',
                    'label'       => 'Метка',
                ),
                array(
                    'type'        => 'wysiwyg',
                    'name'        => 'made_title',
                    'label'       => 'Заголовок',
                    'instruction' => 'Чтобы выделить текст другим цветом, оберните текст в тег strong',
                    'notes'       => 'Текст <strong>текст другого цвета</strong>',
                ),
                array(
                    'type'        => 'wysiwyg',
                    'name'        => 'made_desc',
                    'label'       => 'Описание',
                    'rows'        => 3,
                ),
			)
		);
        $Section->add_group(
			'made_list',
			true,
			array(
                array(
                    'type'        => 'image',
                    'name'        => 'made_list_img',
                    'label'       => 'Изображение',
                    'size'        => 'thumbnail',
                ),
                array(
					'name'        => 'made_list_title',
					'label'       => 'Заголовок',
					'type'        => 'text',
				),
                array(
					'name'        => 'made_list_text',
					'label'       => 'Текст',
					'type'        => 'textarea',
                    'rows'        => 2,
				),
			)
		);
		$settings[] = $Section;
	}

	if (HOME_ID == $id && $type === 'page') {
		$Section = SCF::add_setting('asf_work', 'Жилые решения (Процесс)');
		$Section->add_group(
			'work-section',
			false,
			array(
                array(
                    'type'        => 'text',
                    'name'        => 'work_label',
                    'label'       => 'Метка',
                ),
                array(
                    'type'        => 'text',
                    'name'        => 'work_title',
                    'label'       => 'Заголовок',
                    'instruction' => 'Чтобы выделить текст другим цветом, оберните текст в тег strong',
                    'notes'       => 'Текст <strong>текст другого цвета</strong>',
                ),
                array(
                    'type'        => 'textarea',
                    'name'        => 'work_desc',
                    'label'       => 'Описание',
                    'rows'        => 3,
                ),
                array(
                    'type'        => 'image',
                    'name'        => 'work_img',
                    'label'       => 'Изображение',
                    'size'        => 'medium',
                ),
			)
		);
        $Section->add_group(
			'work_list',
			true,
			array(
                array(
					'name'        => 'work_list_title',
					'label'       => 'Заголовок',
					'type'        => 'text',
				),
                array(
					'name'        => 'work_list_text',
					'label'       => 'Текст',
					'type'        => 'textarea',
                    'rows'        => 2,
				),
			)
		);
		$settings[] = $Section;
	}

	if (HOME_ID == $id && $type === 'page') {
		$Section = SCF::add_setting('asf_homeExamples', 'Умные дома (Примеры)');
		$Section->add_group(
			'homeExamples-section',
			false,
			array(
                array(
                    'type'        => 'text',
                    'name'        => 'homeExamples_label',
                    'label'       => 'Метка',
                ),
                array(
                    'type'        => 'text',
                    'name'        => 'homeExamples_title',
                    'label'       => 'Заголовок',
                    'instruction' => 'Чтобы выделить текст другим цветом, оберните текст в тег strong',
                    'notes'       => 'Текст <strong>текст другого цвета</strong>',
                ),
			)
		);
        $Section->add_group(
			'homeExamples_list',
			true,
			array(
                array(
                    'type'        => 'image',
                    'name'        => 'homeExamples_list_img',
                    'label'       => 'Изображение',
                    'size'        => 'thumbnail',
                ),
                array(
					'name'        => 'homeExamples_list_title',
					'label'       => 'Заголовок',
					'type'        => 'text',
				),
                array(
					'name'        => 'homeExamples_list_text',
					'label'       => 'Текст',
					'type'        => 'textarea',
                    'rows'        => 2,
				),
			)
		);
		$settings[] = $Section;
	}

	if (HOME_ID == $id && $type === 'page') {
		$Section = SCF::add_setting('asf_ofices', 'Умные офисы');
		$Section->add_group(
			'ofices-section',
			false,
			array(
                array(
                    'type'        => 'text',
                    'name'        => 'ofices_label',
                    'label'       => 'Метка',
                ),
                array(
                    'type'        => 'text',
                    'name'        => 'ofices_title',
                    'label'       => 'Заголовок',
                    'instruction' => 'Чтобы выделить текст другим цветом, оберните текст в тег strong',
                    'notes'       => 'Текст <strong>текст другого цвета</strong>',
                ),
                array(
                    'type'        => 'textarea',
                    'name'        => 'ofices_desc',
                    'label'       => 'Описание',
                    'rows'        => 3,
                ),
			)
		);
        $Section->add_group(
			'ofices_list',
			true,
			array(
                array(
                    'type'        => 'image',
                    'name'        => 'ofices_list_img',
                    'label'       => 'Изображение',
                    'size'        => 'thumbnail',
                ),
                array(
					'name'        => 'ofices_list_title',
					'label'       => 'Заголовок',
					'type'        => 'text',
				),
                array(
					'name'        => 'ofices_list_text',
					'label'       => 'Текст',
					'type'        => 'textarea',
                    'rows'        => 2,
				),
			)
		);
		$settings[] = $Section;
	}

	if (HOME_ID == $id && $type === 'page') {
		$Section = SCF::add_setting('asf_oficesExamples', 'Умные офисы (Примеры)');
		$Section->add_group(
			'oficesExamples-section',
			false,
			array(
                array(
                    'type'        => 'text',
                    'name'        => 'oficesExamples_label',
                    'label'       => 'Метка',
                ),
                array(
                    'type'        => 'text',
                    'name'        => 'oficesExamples_title',
                    'label'       => 'Заголовок',
                    'instruction' => 'Чтобы выделить текст другим цветом, оберните текст в тег strong',
                    'notes'       => 'Текст <strong>текст другого цвета</strong>',
                ),
                array(
                    'type'        => 'wysiwyg',
                    'name'        => 'oficesExamples_text',
                    'label'       => 'Текст',
                ),
                array(
                    'type'        => 'image',
                    'name'        => 'oficesExamples_img',
                    'label'       => 'Изображение',
                    'size'        => 'medium',
                ),
			)
		);
		$settings[] = $Section;
	}

	if (HOME_ID == $id && $type === 'page') {
		$Section = SCF::add_setting('asf_buildings', 'Умные здания');
		$Section->add_group(
			'buildings-section',
			false,
			array(
                array(
                    'type'        => 'text',
                    'name'        => 'buildings_label',
                    'label'       => 'Метка',
                ),
                array(
                    'type'        => 'text',
                    'name'        => 'buildings_title',
                    'label'       => 'Заголовок',
                    'instruction' => 'Чтобы выделить текст другим цветом, оберните текст в тег strong',
                    'notes'       => 'Текст <strong>текст другого цвета</strong>',
                ),
                array(
                    'type'        => 'textarea',
                    'name'        => 'buildings_desc',
                    'label'       => 'Описание',
                    'rows'        => 3,
                ),
                array(
                    'type'        => 'image',
                    'name'        => 'buildings_img',
                    'label'       => 'Изображение',
                    'size'        => 'medium',
                ),
			)
		);
        $Section->add_group(
			'buildings_list',
			true,
			array(
                array(
                    'type'        => 'image',
                    'name'        => 'buildings_list_img',
                    'label'       => 'Изображение',
                    'size'        => 'thumbnail',
                ),
                array(
					'name'        => 'buildings_list_title',
					'label'       => 'Заголовок',
					'type'        => 'text',
				),
                array(
					'name'        => 'buildings_list_text',
					'label'       => 'Текст',
					'type'        => 'textarea',
                    'rows'        => 2,
				),
			)
		);
		$settings[] = $Section;
	}

	if (HOME_ID == $id && $type === 'page') {
		$Section = SCF::add_setting('asf_buildingsExamples', 'Умные здания (Примеры)');
		$Section->add_group(
			'buildingsExamples-section',
			false,
			array(
                array(
                    'type'        => 'text',
                    'name'        => 'buildingsExamples_label',
                    'label'       => 'Метка',
                ),
                array(
                    'type'        => 'text',
                    'name'        => 'buildingsExamples_title',
                    'label'       => 'Заголовок',
                    'instruction' => 'Чтобы выделить текст другим цветом, оберните текст в тег strong',
                    'notes'       => 'Текст <strong>текст другого цвета</strong>',
                ),
                array(
                    'type'        => 'textarea',
                    'name'        => 'buildingsExamples_desc',
                    'label'       => 'Описание',
                    'rows'        => 3,
                ),
                array(
                    'type'        => 'image',
                    'name'        => 'buildingsExamples_img',
                    'label'       => 'Изображение',
                    'size'        => 'medium',
                ),
			)
		);
		$settings[] = $Section;
	}

	if (HOME_ID == $id && $type === 'page') {
		$Section = SCF::add_setting('asf_macro', 'Умные макросы');
		$Section->add_group(
			'macro-section',
			false,
			array(
                array(
                    'type'        => 'text',
                    'name'        => 'macro_label',
                    'label'       => 'Метка',
                ),
                array(
                    'type'        => 'text',
                    'name'        => 'macro_title',
                    'label'       => 'Заголовок',
                    'instruction' => 'Чтобы выделить текст другим цветом, оберните текст в тег strong',
                    'notes'       => 'Текст <strong>текст другого цвета</strong>',
                ),
                array(
                    'type'        => 'textarea',
                    'name'        => 'macro_desc',
                    'label'       => 'Описание',
                    'rows'        => 3,
                ),
                array(
                    'type'        => 'image',
                    'name'        => 'macro_img',
                    'label'       => 'Изображение',
                    'size'        => 'medium',
                ),
			)
		);
		$settings[] = $Section;
	}

	if (HOME_ID == $id && $type === 'page') {
		$Section = SCF::add_setting('asf_macroFunctions', 'Умные макросы (Функции)');
		$Section->add_group(
			'macroFunctions-section',
			false,
			array(
                array(
                    'type'        => 'text',
                    'name'        => 'macroFunctions_label',
                    'label'       => 'Метка',
                ),
                array(
                    'type'        => 'text',
                    'name'        => 'macroFunctions_title',
                    'label'       => 'Заголовок',
                    'instruction' => 'Чтобы выделить текст другим цветом, оберните текст в тег strong',
                    'notes'       => 'Текст <strong>текст другого цвета</strong>',
                ),
                array(
                    'type'        => 'textarea',
                    'name'        => 'macroFunctions_desc',
                    'label'       => 'Описание',
                    'rows'        => 3,
                ),
                array(
                    'type'        => 'image',
                    'name'        => 'macroFunctions_img',
                    'label'       => 'Изображение',
                    'size'        => 'medium',
                ),
			)
		);
        $Section->add_group(
			'macroFunctions_list',
			true,
			array(
                array(
                    'type'        => 'image',
                    'name'        => 'macroFunctions_list_img',
                    'label'       => 'Изображение',
                    'size'        => 'thumbnail',
                ),
                array(
					'name'        => 'macroFunctions_list_title',
					'label'       => 'Заголовок',
					'type'        => 'text',
				),
                array(
					'name'        => 'macroFunctions_list_text',
					'label'       => 'Текст',
					'type'        => 'textarea',
                    'rows'        => 2,
				),
			)
		);
		$settings[] = $Section;
	}

	if (HOME_ID == $id && $type === 'page') {
		$Section = SCF::add_setting('asf_security', 'Безопасность');
		$Section->add_group(
			'security-section',
			false,
			array(
                array(
                    'type'        => 'text',
                    'name'        => 'security_label',
                    'label'       => 'Метка',
                ),
                array(
                    'type'        => 'text',
                    'name'        => 'security_title',
                    'label'       => 'Заголовок',
                    'instruction' => 'Чтобы выделить текст другим цветом, оберните текст в тег strong',
                    'notes'       => 'Текст <strong>текст другого цвета</strong>',
                ),
                array(
                    'type'        => 'textarea',
                    'name'        => 'security_desc',
                    'label'       => 'Описание',
                    'rows'        => 3,
                ),
                array(
                    'type'        => 'image',
                    'name'        => 'security_img',
                    'label'       => 'Изображение',
                    'size'        => 'medium',
                ),
			)
		);
		$settings[] = $Section;
	}

	if (HOME_ID == $id && $type === 'page') {
		$Section = SCF::add_setting('asf_securityAdvanced', 'Безопасность (Расширенная)');
		$Section->add_group(
			'securityAdvanced-section',
			false,
			array(
                array(
                    'type'        => 'text',
                    'name'        => 'securityAdvanced_label',
                    'label'       => 'Метка',
                ),
                array(
                    'type'        => 'text',
                    'name'        => 'securityAdvanced_title',
                    'label'       => 'Заголовок',
                    'instruction' => 'Чтобы выделить текст другим цветом, оберните текст в тег strong',
                    'notes'       => 'Текст <strong>текст другого цвета</strong>',
                ),
                array(
                    'type'        => 'textarea',
                    'name'        => 'securityAdvanced_desc',
                    'label'       => 'Описание',
                    'rows'        => 3,
                ),
                array(
                    'type'        => 'image',
                    'name'        => 'securityAdvanced_img_top',
                    'label'       => 'Изображение, сверху',
                    'size'        => 'medium',
                ),
                array(
                    'type'        => 'image',
                    'name'        => 'securityAdvanced_img_bottom',
                    'label'       => 'Изображение, снизу',
                    'size'        => 'medium',
                ),
			)
		);
        $Section->add_group(
			'securityAdvanced_list',
			true,
			array(
                array(
					'name'        => 'securityAdvanced_list_title',
					'label'       => 'Заголовок',
					'type'        => 'text',
				),
                array(
					'name'        => 'securityAdvanced_list_text',
					'label'       => 'Текст',
					'type'        => 'textarea',
                    'rows'        => 2,
				),
			)
		);
		$settings[] = $Section;
	}

	if (HOME_ID == $id && $type === 'page') {
		$Section = SCF::add_setting('asf_securityExample', 'Безопасность (Пример)');
		$Section->add_group(
			'securityExample-section',
			false,
			array(
                array(
                    'type'        => 'text',
                    'name'        => 'securityExample_label',
                    'label'       => 'Метка',
                ),
                array(
                    'type'        => 'text',
                    'name'        => 'securityExample_title',
                    'label'       => 'Заголовок',
                    'instruction' => 'Чтобы выделить текст другим цветом, оберните текст в тег strong',
                    'notes'       => 'Текст <strong>текст другого цвета</strong>',
                ),
                array(
                    'type'        => 'textarea',
                    'name'        => 'securityExample_desc',
                    'label'       => 'Описание',
                    'rows'        => 3,
                ),
                array(
                    'type'        => 'image',
                    'name'        => 'securityExample_img_d',
                    'label'       => 'Изображение, десктоп',
                    'size'        => 'medium',
                ),
                array(
                    'type'        => 'image',
                    'name'        => 'securityExample_img_m',
                    'label'       => 'Изображение, мобильные',
                    'size'        => 'medium',
                ),
			)
		);
		$settings[] = $Section;
	}

	if (HOME_ID == $id && $type === 'page') {
		$Section = SCF::add_setting('asf_securityBenefits', 'Безопасность (Преимущества)');
		$Section->add_group(
			'securityBenefits-section',
			false,
			array(
                array(
                    'type'        => 'text',
                    'name'        => 'securityBenefits_label',
                    'label'       => 'Метка',
                ),
                array(
                    'type'        => 'text',
                    'name'        => 'securityBenefits_title',
                    'label'       => 'Заголовок',
                    'instruction' => 'Чтобы выделить текст другим цветом, оберните текст в тег strong',
                    'notes'       => 'Текст <strong>текст другого цвета</strong>',
                ),
                array(
                    'type'        => 'textarea',
                    'name'        => 'securityBenefits_desc',
                    'label'       => 'Описание',
                    'rows'        => 3,
                ),
                array(
                    'type'        => 'image',
                    'name'        => 'securityBenefits_img',
                    'label'       => 'Изображение',
                    'size'        => 'medium',
                ),
			)
		);
        $Section->add_group(
			'securityBenefits_list',
			true,
			array(
                array(
					'name'        => 'securityBenefits_list_title',
					'label'       => 'Заголовок',
					'type'        => 'text',
				),
                array(
					'name'        => 'securityBenefits_list_text',
					'label'       => 'Текст',
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