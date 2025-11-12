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
                        'firstscreen' => 'Секция 1',
                        'preview' => 'Секция 2',
                        'work' => 'Секция 3',
                        'homeExamples' => 'Секция 4',
                        'buildings' => 'Секция 5',
                        'benefits' => 'Секция 6'
                    ),
                    'instruction' => 'Выберите секцию. Перетащите - чтобы изменить порядок.',
                ),
                array(
                    'type'        => 'text',
                    'name'        => 'menu_title',
                    'label'       => 'Название в меню',
                    'instruction' => 'Введите название для пункта меню. Если оставить пустым, пункт не добавится в меню',
                    'default'     => '',
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

		$Section = SCF::add_setting('asf_firstscreen', 'Секция 1');
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
		$Section = SCF::add_setting('asf_preview', 'Секция 2');
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
		$Section = SCF::add_setting('asf_work', 'Секция 3');
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
                    'type'        => 'wysiwyg',
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
		$Section = SCF::add_setting('asf_homeExamples', 'Секция 4');
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
                    'type'        => 'wysiwyg',
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
		$Section = SCF::add_setting('asf_buildings', 'Секция 5');
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
                    'type'        => 'wysiwyg',
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
		$Section = SCF::add_setting('asf_securityBenefits', 'Секция 6');
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
                    'type'        => 'wysiwyg',
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