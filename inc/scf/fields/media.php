<?php

class Smart_Custom_Fields_Field_Media extends Smart_Custom_Fields_Field_Base
{
	/**
	 * Set the required items.
	 *
	 * @return array
	 */
	protected function init()
	{
		return array(
			'type'         => 'media',
			'display-name' => __('Изображение или видео', 'smart-custom-fields'),
			'optgroup'     => 'content-fields',
		);
	}

	/**
	 * Set the non required items.
	 *
	 * @return array
	 */
	protected function options()
	{
		return array(
			'instruction' => '',
			'notes'       => '',
			'size'        => 'full',
		);
	}

	public function get_field($index, $value)
	{
		$name     = $this->get_field_name_in_editor($index);
		$disabled = $this->get_disable_attribute($index);

		$btn_remove = sprintf(
			'<span class="btn-remove-file hide">%s</span>',
			esc_html__('Delete', 'smart-custom-fields')
		);

		$hide_class = 'hide';
		$media      = $btn_remove;
		$media_src  = null;
		$media_alt  = '';
		$isVideo  =  false;
		$attachment_id = false;

		if ($value) {
			if (preg_match('/^\d+$/', $value)) {
				$attachment_id = (int) $value;
				$media_alt     = get_the_title($attachment_id);

				// Определяем тип вложения
				$mime_type = get_post_mime_type($attachment_id);
				$isVideo   = strpos($mime_type, 'video') !== false;

				if ($isVideo) {
					$media_src = wp_get_attachment_url($attachment_id);
				} else {
					$image_src = wp_get_attachment_image_src($attachment_id, $this->get('size'));
					if (is_array($image_src) && isset($image_src[0])) {
						$media_src = $image_src[0];
					}
				}
			}

			if ($media_src) {
				if ($isVideo) {
					$media = sprintf(
						'<video src="%s" controls></video>%s',
						esc_url($media_src),
						$btn_remove
					);
				} else {
					$media = sprintf(
						'<a href="%s" target="_blank"><img src="%s" alt="%s" /></a>%s',
						esc_url(wp_get_attachment_url($attachment_id) ?: $media_src),
						esc_url($media_src),
						esc_attr($media_alt),
						$btn_remove
					);
				}
				$hide_class = '';
			}
		}

		$field_id = 'scf-media-' . $index;

		$html = sprintf(
			'<div class="scf-media-wrapper" id="%s">
            <span class="button btn-add-media" style="margin-bottom: 10px">%s</span><br />
            <span class="%s %s">%s</span>
            <input type="hidden" name="%s" value="%s" %s  />
        </div>',
			esc_attr($field_id),
			esc_html__('File Select', 'smart-custom-fields'),
			esc_attr(SCF_Config::PREFIX . 'upload-file'),
			esc_attr($hide_class),
			wp_kses_post($media),
			esc_attr($name),
			esc_attr($value),
			disabled(true, $disabled, false),
		);

		// Добавляем JS для медиавыбора и превью
		$html .= "<script>
		jQuery(document).ready(function($) {
			var wrapper = $('#$field_id');
			var button = wrapper.find('.btn-add-media');
			var remove = wrapper.find('.btn-remove-file');
			var input  = wrapper.find('input[type=hidden]');
			var media  = wrapper.find('.smart-cf-upload-file');
			var frame;

			// Клик по кнопке выбора
			button.on('click', function(e) {
				e.preventDefault();

				// if (frame) frame.open();
				frame = wp.media({
					title: 'Выберите медиа',
					library: { type: 'image,video' },
					multiple: false,
					button: { text: 'Использовать' }
				});

				frame.on('select', function() {
					var attachment = frame.state().get('selection').first().toJSON();
					var src = attachment.url;
					var type = attachment.type;
					
					input.val(attachment.id); // Сохраняем ID
					
					if (type === 'image') {
						media.html('<img src=\"' + src + '\" alt=\"\" /><span class=\"btn-remove-file\">Удалить</span>');
					} else if (type === 'video') {
						media.html('<video src=\"' + src + '\" controls></video><span class=\"btn-remove-file\">Удалить</span>');
					} else {
						media.html('<a href=\"' + src + '\" target=\"_blank\">Просмотреть файл</a><span class=\"btn-remove-file\">Удалить</span>');
					}
					media.removeClass('hide');
					remove = media.find('.btn-remove-file');
					bindRemove();
					frame.close();
					
				});
					
				frame.open();
			});

			// Удаление
			function bindRemove() {
				remove.on('click', function() {
					input.val('');
					media.addClass('hide').html('<span class=\"btn-remove-file hide\">Удалить</span>');
				});
			}
			bindRemove();
		});
		</script>
		";

		return $html;
	}

	/**
	 * Displaying the option fields in custom field settings page.
	 *
	 * @param int $group_key Group key.
	 * @param int $field_key Field key.
	 */
	public function display_field_options($group_key, $field_key)
	{
		$this->display_label_option($group_key, $field_key);
		$this->display_name_option($group_key, $field_key);
?>
		<tr>
			<th><?php esc_html_e('Instruction', 'smart-custom-fields'); ?></th>
			<td>
				<textarea name="<?php echo esc_attr($this->get_field_name_in_setting($group_key, $field_key, 'instruction')); ?>"
					class="widefat" rows="5"><?php echo esc_attr($this->get('instruction')); ?></textarea>
			</td>
		</tr>
		<tr>
			<th><?php esc_html_e('Notes', 'smart-custom-fields'); ?></th>
			<td>
				<input type="text"
					name="<?php echo esc_attr($this->get_field_name_in_setting($group_key, $field_key, 'notes')); ?>"
					class="widefat"
					value="<?php echo esc_attr($this->get('notes')); ?>" />
			</td>
		</tr>
<?php
	}
}

function getSCFMedia($id)
{
	if (empty($id)) return;
	$url = wp_get_attachment_url($id);
	$mime = get_post_mime_type($id);
	$isVideo   = strpos($mime, 'video') !== false;

	if ($isVideo) {
		echo '<video src="' . $url . '" controls></video>';
	} else {
		echo '<img src="' . $url . '" alt="">';
	}
}

function scf_add_media_field()
{
	new Smart_Custom_Fields_Field_Media();
}

add_action('init', 'scf_add_media_field');
