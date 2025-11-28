<?php
// Сохраняем порядок метабоксов в post_meta при сохранении страницы
add_action('save_post', 'save_meta_box_order_on_save');
function save_meta_box_order_on_save($post_id)
{
	// Проверки
	if (wp_is_post_revision($post_id)) return;
	if (!current_user_can('edit_post', $post_id)) return;
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

	$post_type = get_post_type($post_id);

	// Получаем порядок метабоксов для текущего пользователя и типа записи
	$user_id = get_current_user_id();
	$meta_box_order = get_user_meta($user_id, 'meta-box-order_' . $post_type, true);

	if (!$meta_box_order || !is_array($meta_box_order)) return;

	// Сохраняем в метаполя записи
	foreach ($meta_box_order as $context => $ids) {
		if (!empty($ids)) {
			update_post_meta($post_id, '_meta_box_order_' . $context, $ids);
		} else {
			delete_post_meta($post_id, '_meta_box_order_' . $context); // Чистим, если пусто
		}
	}
}

// Получаем порядок метабоксов для текущей страницы
function get_frontend_meta_box_order($post_id = null, $context = 'normal')
{
	if (!$post_id) $post_id = get_the_ID();

	$order = get_post_meta($post_id, '_meta_box_order_' . $context, true);
	$ordered_ids = $order ? array_filter(explode(',', $order)) : array();

	// Фильтруем элементы, оставляя только те, что начинаются с префикса
	$filtered_ids = array_filter($ordered_ids, function ($id) {
		return strpos($id, 'smart-cf-custom-field-') === 0;
	});

	return $filtered_ids;
}


/**
 * Возвращает ассоциативный массив: id секции => [ключи полей]
 * в порядке, заданном meta-box-order
 *
 * @param array $ordered_ids      — ['smart-cf-custom-field-home-1', ...]
 * @param array $all_settings     — все Smart_Custom_Fields_Setting
 * @return array                  — ['home-1' => ['home__title', ...], ...]
 */
function get_scf_fields_by_sections($post, $templates = array())
{
	if (!$post || !class_exists('SCF')) return array();
	$all_settings  = SCF::get_settings($post);
	$ordered_ids = get_frontend_meta_box_order($post->ID);
	$result = array();

	// Шаг 1: Создаём карту всех настроек по id
	$settings_map = array();
	foreach ($all_settings as $setting) {
		$ref_setting = new ReflectionObject($setting);
		$prop_id = $ref_setting->getProperty('id');

		if (version_compare(PHP_VERSION, '8.1.0', '<') && !$prop_id->isPublic()) {
			$prop_id->setAccessible(true);
		}
		$setting_id = $prop_id->getValue($setting); // например: 'home-1'

		$settings_map[$setting_id] = $setting;
	}

	// Шаг 2: Обходим ordered_ids и собираем результат в нужном порядке
	foreach ($ordered_ids as $field_id) {
		$matches = array();
		if (!preg_match('/smart-cf-custom-field-(.+)$/', $field_id, $matches)) {
			continue;
		}
		$setting_key = $matches[1]; // 'home-1', 'test-1234-4' и т.п.

		// Пропускаем, если такой секции нет
		if (!isset($settings_map[$setting_key])) {
			continue;
		}

		$setting = $settings_map[$setting_key];
		$ref_setting = new ReflectionObject($setting);
		$prop_groups = $ref_setting->getProperty('groups');

		if (version_compare(PHP_VERSION, '8.1.0', '<') && !$prop_groups->isPublic()) {
			$prop_groups->setAccessible(true);
		}
		$groups = $prop_groups->getValue($setting);

		$field_keys = array();

		if (is_array($groups)) {
			foreach ($groups as $group) {
				$ref_group = new ReflectionObject($group);
				$prop_fields = $ref_group->getProperty('fields');

				if (version_compare(PHP_VERSION, '8.1.0', '<') && !$prop_fields->isPublic()) {
					$prop_fields->setAccessible(true);
				}
				$fields = $prop_fields->getValue($group);

				if (is_array($fields)) {
					// Добавляем только КЛЮЧИ (например: 'home__title')
					foreach ($fields as $field_key => $field_object) {
						$field_keys[] = $field_key;
					}
				}
			}
		}

		// Добавляем в результат: id секции => [ключи полей]
		$result[$setting_key] = $field_keys;

		// Если для этой секции задан шаблон, добавляем его в результат
		if (isset($templates[$setting_key])) {
			$result[$setting_key]['template'] = $templates[$setting_key];
		}
	}

	return $result;
}

/**
 * Возвращает готовую разметку секций
 *
 * @param object $post           — объект записи
 * @param array $templates       — массив шаблонов секций
 * 
 * Пример $templates:
 * $templates = array(
 *     'home-1' => function() {
 *         ?>
 *         <section class="home-section-1">
 *             <h2><?php echo SCF::get('home_title_1'); ?></h2>
 *             <p><?php echo SCF::get('home_text_1'); ?></p>
 *         </section>
 *         <?php
 *     },
 *     'home-2' => function() {
 *         ?>
 *         <section class="home-section-2">
 *             <h2><?php echo SCF::get('home_title_2'); ?></h2>
 *             <p><?php echo SCF::get('home_text_2'); ?></p>
 *         </section>
 *         <?php
 *     }
 * );
 * 
 * @return string                — готовая разметка секций
 */
function get_scf_sections_markup($post, $templates = array())
{
	$sections = get_scf_fields_by_sections($post, $templates);
	$output = '';

	foreach ($sections as $id => $section) {
		// Проверяем, нужно ли показывать секцию
		$show_section = SCF::get($id . '-show');
		if ($show_section === true || $show_section === NULL) {
			// Проверяем, есть ли у секции шаблон
			if (isset($section['template']) && is_callable($section['template'])) {
				// Запускаем буферизацию вывода
				ob_start();
				// Вызываем шаблон
				call_user_func($section['template']);
				// Получаем содержимое буфера и очищаем его
				$output .= ob_get_clean();
			}
		}
	}

	echo $output;
}
