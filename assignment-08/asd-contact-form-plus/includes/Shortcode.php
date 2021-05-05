<?php

namespace Asd\Contact\Form\Plus;

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
        add_shortcode( 'asd-sc-cf-plus', [ $this, 'render_shortcode_form' ] );
    }

    /**
     * Shortcode form renderer function
     *
     * @since  1.0.0
     *
     * @param array  $atts
     * @param string $content
     *
     * @return void
     */
    public function render_shortcode_form( $atts ) {
        $atts = shortcode_atts( apply_filters( 'asd_sc_cfp_contents', array(
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
        include_once ASD_CONTACT_FORM_PLUS_PATH . '/templates/shortcode_contact_form.php';
        return ob_get_clean();
    }
}
