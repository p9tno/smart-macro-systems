<?php
class Smart_Custom_Fields_Field_Link extends Smart_Custom_Fields_Field_Base {
    
    protected function init() {
        return array(
            'type'         => 'link',
            'display-name' => 'Link',
            'optgroup'     => 'basic-fields',
        );
    }

    protected function options() {
        return array(
            'default'     => '',
            'instruction' => '',
            'notes'       => '',
        );
    }

    public function get_field( $index, $value ) {
        $name = $this->get_field_name_in_editor( $index );
        $disabled = $this->get_disable_attribute( $index );
        
        // Парсим значение
        $data = $this->parse_value( $value );
        
        return sprintf(
            '<div class="scf-link-field" style="display:flex;align-items: flex-end;gap: 16px;">
                <div style="margin-bottom:10px;flex-grow:1;">
                    <label style="display:block; margin-bottom:5px; font-weight:bold;">Title</label>
                    <input type="text" 
                        class="scf-link-title widefat" 
                        value="%s" 
                        placeholder="Link text" %s />
                </div>
                <div style="margin-bottom:10px;flex-grow:1">
                    <label style="display:block; margin-bottom:5px; font-weight:bold;">URL</label>
                    <input type="text" 
                        class="scf-link-url widefat" 
                        value="%s" 
                        placeholder="https://" %s />
                </div>
                <div style="margin-bottom:10px;">
                    <label style="display:inline-flex; align-items:center; gap:5px;margin-bottom: 5px;">
                        <input type="checkbox" 
                            class="scf-link-target" 
                            value="_blank" %s %s />
                        Open in new tab
                    </label>
                </div>
                <input type="hidden" 
                    name="%s" 
                    value="%s" 
                    class="scf-link-value" %s />
            </div>
            <script>
            jQuery(document).ready(function($) {
                var $container = $(".scf-link-field").last();
                var updateHiddenField = function() {
                    var data = {
                        title: $container.find(".scf-link-title").val(),
                        url: $container.find(".scf-link-url").val(),
                        target: $container.find(".scf-link-target").is(":checked") ? "_blank" : ""
                    };
                    $container.find(".scf-link-value").val(JSON.stringify(data));
                };
                $container.find(".scf-link-title, .scf-link-url").on("input", updateHiddenField);
                $container.find(".scf-link-target").on("change", updateHiddenField);
                updateHiddenField();
            });
            </script>',
            esc_attr( $data['title'] ),
            disabled( true, $disabled, false ),
            esc_attr( $data['url'] ),
            disabled( true, $disabled, false ),
            checked( $data['target'], '_blank', false ),
            disabled( true, $disabled, false ),
            esc_attr( $name ),
            esc_attr( $value ),
            disabled( true, $disabled, false )
        );
    }

    protected function parse_value( $value ) {
        // Если значение уже массив - возвращаем как есть
        if ( is_array( $value ) ) {
            return wp_parse_args( $value, array(
                'title'  => '',
                'url'    => '',
                'target' => '',
            ) );
        }
        
        // Если JSON строка - декодируем
        if ( is_string( $value ) && $value ) {
            $decoded = json_decode( $value, true );
            if ( json_last_error() === JSON_ERROR_NONE && is_array( $decoded ) ) {
                return wp_parse_args( $decoded, array(
                    'title'  => '',
                    'url'    => '',
                    'target' => '',
                ) );
            }
        }
        
        // По умолчанию пустой массив
        return array(
            'title'  => '',
            'url'    => '',
            'target' => '',
        );
    }

    public function display_field_options( $group_key, $field_key ) {
        ?>
        <tr>
            <th><?php esc_html_e( 'Default', 'smart-custom-fields' ); ?></th>
            <td>
                <input type="text"
                    name="<?php echo esc_attr( $this->get_field_name_in_setting( $group_key, $field_key, 'default' ) ); ?>"
                    class="widefat"
                    value="<?php echo esc_attr( $this->get( 'default' ) ); ?>"
                    placeholder='{"title":"Button","url":"https://example.com","target":"_blank"}' />
                <p class="description"><?php esc_html_e( 'JSON format', 'smart-custom-fields' ); ?></p>
            </td>
        </tr>
        <tr>
            <th><?php esc_html_e( 'Instruction', 'smart-custom-fields' ); ?></th>
            <td>
                <textarea name="<?php echo esc_attr( $this->get_field_name_in_setting( $group_key, $field_key, 'instruction' ) ); ?>"
                    class="widefat" rows="3"><?php echo esc_attr( $this->get( 'instruction' ) ); ?></textarea>
            </td>
        </tr>
        <tr>
            <th><?php esc_html_e( 'Notes', 'smart-custom-fields' ); ?></th>
            <td>
                <input type="text"
                    name="<?php echo esc_attr( $this->get_field_name_in_setting( $group_key, $field_key, 'notes' ) ); ?>"
                    class="widefat"
                    value="<?php echo esc_attr( $this->get( 'notes' ) ); ?>" />
            </td>
        </tr>
        <?php
    }

    public function sanitize( $value ) {
        if ( empty( $value ) ) {
            return '';
        }
        
        // Если пришла JSON строка, проверяем и санитизируем
        if ( is_string( $value ) ) {
            $decoded = json_decode( $value, true );
            if ( json_last_error() === JSON_ERROR_NONE && is_array( $decoded ) ) {
                $sanitized = array(
                    'title'  => isset( $decoded['title'] ) ? sanitize_text_field( $decoded['title'] ) : '',
                    'url'    => isset( $decoded['url'] ) ? esc_url_raw( $decoded['url'] ) : '',
                    'target' => ( isset( $decoded['target'] ) && $decoded['target'] === '_blank' ) ? '_blank' : '',
                );
                return wp_json_encode( $sanitized );
            }
        }
        
        return '';
    }
}

function scf_add_link_field() {
    if ( class_exists( 'Smart_Custom_Fields_Field_Base' ) ) {
        new Smart_Custom_Fields_Field_Link();
    }
}
add_action( 'init', 'scf_add_link_field' );

/**
 * ВАЖНО: Преобразуем JSON строку в массив при получении значения
 */
function scf_link_format_value( $value, $field ) {
    // Проверяем тип поля
    if ( is_object( $field ) && method_exists( $field, 'get_attribute' ) ) {
        $field_type = $field->get_attribute( 'type' );
    } else {
        return $value;
    }
    
    if ( $field_type === 'link' ) {
        // Если значение уже массив - возвращаем как есть
        if ( is_array( $value ) ) {
            return wp_parse_args( $value, array(
                'title'  => '',
                'url'    => '',
                'target' => '',
            ) );
        }
        
        // Если JSON строка - декодируем в массив
        if ( is_string( $value ) && ! empty( $value ) ) {
            $decoded = json_decode( $value, true );
            if ( json_last_error() === JSON_ERROR_NONE && is_array( $decoded ) ) {
                return wp_parse_args( $decoded, array(
                    'title'  => '',
                    'url'    => '',
                    'target' => '',
                ) );
            }
        }
        
        // Если ничего не подошло - возвращаем пустой массив
        return array(
            'title'  => '',
            'url'    => '',
            'target' => '',
        );
    }
    
    return $value;
}
add_filter( 'smart-cf-get-value', 'scf_link_format_value', 10, 2 );