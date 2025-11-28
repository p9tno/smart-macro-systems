<?php
/**
 * Custom Field: HTML Example for Smart Custom Fields
 */

class Smart_Custom_Fields_Field_Html_Example extends Smart_Custom_Fields_Field_Base {

    /**
     * Set the required items
     *
     * @return array
     */
    protected function init() {
        return array(
            'type'         => 'html_example',
            'display-name' => 'HTML Example',
            'optgroup'     => 'other-fields',
        );
    }

    /**
     * Set the required items
     *
     * @return array
     */
    protected function options() {
        return array(
            'default'      => '',
            'html_content' => '',
            'instruction'  => '',
            'notes'        => '',
        );
    }

    /**
     * Getting the field
     *
     * @param int $index
     * @param string $value
     * @return string html
     */
    public function get_field( $index, $value ) {
        $name     = $this->get_field_name_in_editor( $index );
        $disabled = $this->get_disable_attribute( $index );
        
        // Получаем HTML контент из настроек поля
        $html_content = $this->get( 'html_content' );
        
        // Если HTML контент пустой, используем значение по умолчанию
        if ( empty( $html_content ) ) {
            $html_content = $this->get_default_html_example();
        }

        return sprintf(
            '<div class="scf-html-example-field">
                <div style="background:#f6f6f6; padding:15px; border:1px solid #ddd; margin:10px 0; border-radius:4px;">
                    <strong style="display:block; margin-bottom:10px;">Пример HTML кода:</strong>
                    <pre style="background:#1d2327; color:#f0f0f1; padding:15px; border-radius:4px; overflow:auto; font-size:12px; margin:0; white-space: pre-wrap; font-family: Consolas, Monaco, monospace;">%s</pre>
                </div>
                <input type="hidden" name="%s" value="%s" %s />
            </div>',
            esc_html( $html_content ),
            esc_attr( $name ),
            esc_attr( $value ),
            disabled( true, $disabled, false )
        );
    }

    /**
     * Default HTML example
     *
     * @return string
     */
    protected function get_default_html_example() {
        return '<h1>default html example</h1>';
    }

    /**
     * Displaying the option fields
     *
     * @param int $group_key
     * @param int $field_key
     */
    public function display_field_options( $group_key, $field_key ) {
        ?>
        <tr>
            <th><?php esc_html_e( 'Default', 'smart-custom-fields' ); ?></th>
            <td>
                <input type="text"
                    name="<?php echo esc_attr( $this->get_field_name_in_setting( $group_key, $field_key, 'default' ) ); ?>"
                    class="widefat"
                    value="<?php echo esc_attr( $this->get( 'default' ) ); ?>" />
            </td>
        </tr>
        <tr>
            <th><?php esc_html_e( 'HTML Content', 'smart-custom-fields' ); ?></th>
            <td>
                <textarea name="<?php echo esc_attr( $this->get_field_name_in_setting( $group_key, $field_key, 'html_content' ) ); ?>"
                    class="widefat" rows="10" placeholder="Введите HTML код для отображения в примере"><?php echo esc_textarea( $this->get( 'html_content' ) ); ?></textarea>
                <p class="description"><?php esc_html_e( 'HTML код, который будет показан как пример. Если оставить пустым, будет использован пример по умолчанию.', 'smart-custom-fields' ); ?></p>
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

    /**
     * Sanitize field value
     *
     * @param mixed $value
     * @return string
     */
    public function sanitize( $value ) {
        // Для HTML example поля всегда возвращаем пустую строку, 
        // так как это поле только для демонстрации
        return '';
    }
}

/**
 * Register HTML Example field
 */
function scf_add_html_example_field() {
    if ( class_exists( 'Smart_Custom_Fields_Field_Base' ) ) {
        new Smart_Custom_Fields_Field_Html_Example();
    }
}
add_action( 'init', 'scf_add_html_example_field' );

/**
 * Add admin styles for HTML Example field
 */
function scf_html_example_admin_styles() {
    echo '
    <style>
        .scf-html-example-field {
            margin: 15px 0;
        }
        .scf-html-example-field pre {
            line-height: 1.4;
            tab-size: 4;
        }
        .scf-html-example-field input[type="hidden"] {
            display: none;
        }
    </style>
    ';
}
add_action( 'admin_head', 'scf_html_example_admin_styles' );