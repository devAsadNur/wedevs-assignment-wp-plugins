<?php

namespace Asd\CustomerRegistration;

/**
 * The Shortcode
 * handler class
 */
class Shortcode {

    /**
     * Initialize the class
     *
     * @since 1.0.0
     */
    public function __construct() {
        add_shortcode( 'asd_customer_reg_form', [ $this, 'render_customer_reg_form' ] );
    }

    /**
     * Shortcode form renderer function
     *
     * @since 1.0.0
     *
     * @param array $atts
     *
     * @return void
     */
    public function render_customer_reg_form( $atts ) {
        $atts = shortcode_atts( apply_filters( 'asd_crf_contents', [
            'title'       => __( 'Customer Registration', 'asd-customer-reg' ),
            'description' => __( 'Please fill in this form to create an account.', 'asd-customer-reg' ),
        ] ), $atts );

        // Enqueue scripts and styles
        wp_enqueue_script( 'asd_customer_reg_form_script' );
        wp_enqueue_style( 'asd_customer_reg_form_style' );

        // include customer reg form template
        ob_start();
        include_once ASD_CUSTOMER_REG_PATH . '/templates/customer_reg_form.php';

        $form_template = ob_get_clean();

        return $form_template;
    }
}
