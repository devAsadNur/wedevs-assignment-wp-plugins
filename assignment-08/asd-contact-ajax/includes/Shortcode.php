<?php

namespace Asd\WeContact\Ajax;

/**
 * Shortcode
 * handler class
 */
class Shortcode {

    /**
     * Initialize the class
     *
     * @since  1.0.0
     */
    public function __construct() {
        add_shortcode( 'asd-sc-contact-form', [ $this, 'render_shortcode_form' ] );
        add_shortcode( 'asd-sc-contact-field', [ $this, 'render_shortcode_field' ] );
    }

    /**
     * Form shortcode
     * renderer function
     *
     * @since  1.0.0
     *
     * @param array $atts
     * @param string $content
     *
     * @return void
     */
    public function render_shortcode_form( $atts, $content = '' ) {
        $atts = shortcode_atts( apply_filters( 'asd_sc_cf_contents', array(
            'title'       => 'Contact Us',
            'description' => 'Feel free to contact us.',
        ) ), $atts );

        /**
         * Turn array keys into variables
         */
        extract( $atts );

        /**
         * Enqueue form script and style
         */
        wp_enqueue_script( 'asd-contact-form-script' );
        wp_enqueue_style( 'asd-contact-form-style' );

        /**
         * Include contact form template
         */
        ob_start();
        include_once ASD_AJAX_CONTACT_FORM_PATH . '/templates/shortcode_contact_form.php';
        return ob_get_clean();
    }

    /**
     * Input field shortcode
     * renderer function
     *
     * @since  1.0.0
     *
     * @param array $atts
     *
     * @return void
     */
    public function render_shortcode_field( $atts ) {
        $atts = shortcode_atts( apply_filters( 'asd_sc_cf_field_attributes', array(
            'name'        => 'field-name-' . rand(),
            'type'        => 'hidden',
            'id'          => 'feild-id-' . rand(),
            'placeholder' => 'Write here',
            'value'       => '',
            'label'       => '',
            'options'     => '',
        ) ), $atts );

        /**
         * Turn array keys into variables
         */
        extract( $atts );

        /**
         * Turn options from string to array
         */
        $options = explode(',', $options);

        /**
         * Common inputs types
         */
        $common_types = array(
            'text',
            'email',
            'password',
            'number',
            'tel',
            'url',
            'file',
            'button',
        );

        /**
         * If the input type is common
         */
        $is_common_type = false;
        if( in_array( $type, $common_types ) ) {
            $is_common_type = true;
        }

        /**
         * If: common type input
         * Else: not common
         */
        if( $is_common_type ) {
            printf( '<label for="%s">%s </label><input type="%s" name="%s" id="%s" placeholder="%s" value="%s"><br>' , $id, $label, $type, $name, $id, $placeholder, $value );

        } else {
            switch ( $type ) {

                case 'radio':
                case 'checkbox':
                    printf( '<input type="%s" id="%s" name="%s" value="%s"><label for="%s">%s </label><br>', $type, $id, $name, $value, $id, $label );
                    break;

                case 'select':
                    printf('<label for="%s">%s</label> <select name="%s" id="%s">', $id, $label, $name, $id);

                    foreach($options as $option) {
                        printf( '<option value="%s">%s</option>', $option, ucwords($option) );
                    }

                    echo '</select><br>';
                    break;

                case 'submit':
                    printf( '<input type="%s" name="%s" id="%s" value="%s"><br>' , $type, $name, $id, $value );
                    break;

                default:
                    printf( '<input type="hidden", id="%s", name ="%s" value="%s">', $name, $id, $value );
            }
        }
    }
}
