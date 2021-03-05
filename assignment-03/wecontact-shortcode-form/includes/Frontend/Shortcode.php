<?php

namespace WeContactForm\Frontend;

/**
 * Frontend view 
 * handler class
 */
class Shortcode {

    /**
     * Initializes the class
     */
    public function __construct() {
        add_shortcode( 'wp-sc-contact-form', [ $this, 'render_shortcode_form' ] );
        add_shortcode( 'wp-sc-contact-input', [ $this, 'render_shortcode_input' ] );
    }

    /**
     * Form shortcode 
     * renderer function
     *
     * @param [array] $atts
     * @param string $content
     * @return void
     */
    public function render_shortcode_form( $atts, $content = '' ) {
        $atts = shortcode_atts( array(
            'title'       => 'Contact Us',
            'description' => 'Feel free to contact us.',
        ), $atts );
        ?>

        <div>
            <h2><?php echo $atts['title']; ?></h2>
            <h4><?php echo $atts['description']; ?></h4>
            <form><?php echo do_shortcode( $content ) ?></form>
        </div>

        <?php
    }

    /**
     * Input field shortcode 
     * renderer function
     *
     * @param [array] $atts
     * @param string $content
     * @return void
     */
    public function render_shortcode_input( $atts, $content = '' ) {
        $atts = shortcode_atts( array(
            'name'        => 'input-' . time(),
            'type'        => '',
            'placeholder' => 'Write here',
            'value'       => '',
            'label'       => 'Field Name',
        ), $atts );

        /**
         * Variables for 
         * shortcode attributes
         */
        $input_name        = $atts['name'];
        $input_type        = $atts['type'];
        $input_placeholder = $atts['placeholder'];
        $input_value       = $atts['value'];
        $input_label       = $atts['label'];
        $input_id          = $input_name;

        /**
         * Common inputs types
         */
        $common_input_types = array(
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
         * If the input type 
         * is common
         */
        if( in_array( $input_type, $common_input_types ) ) {
            $is_common_type = true;
        }

        /**
         * If: common type input
         * Else: not common
         */
        if( $is_common_type ) {
            
            printf( '<label for="%s">%s</label><input type="%s" name="%s" id="%s" placeholder="%s" value="%s"><br>' , $input_id, $input_label, $input_type, $input_name, $input_id, $input_placeholder, $input_value );

        } else {

            switch ( $input_type ) {

                case 'radio':
                case 'checkbox':
                    printf( '<input type="%s" id="%s" name="%s" value="%s"><label for="%s">%s</label><br>', $input_type, $input_id, $input_name, $input_value, $input_id, $input_label );
                    break;

                case 'submit':
                    printf( '<input type="%s" name="%s" id="%s" value="%s"><br>' , $input_type, $input_name, $input_id, $input_value );
                    break;

                default:
                    printf( '<input type="hidden", id="%s", name ="%s" value="%s">', $input_name, $input_id, $input_value );

            }
        }
    }

}