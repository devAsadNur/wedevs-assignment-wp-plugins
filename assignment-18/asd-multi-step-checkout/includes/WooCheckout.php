<?php

namespace Asd\MultiStepCheckout;

/**
 * Multi Step
 * Checkout
 * handler class
 */
class WooCheckout {

    /**
     * Initialize the class
     *
     * @since  1.0.0
     */
    public function __construct() {
        add_filter( 'woocommerce_locate_template', [ $this, 'multi_checkout_locate_template' ], 10, 3 );
    }

    /**
     * Woocommerce checkout template locator function
     *
     * @since 1.0.0
     *
     * @param string $template
     * @param string $template_name
     * @param string $template_path
     *
     * @return string
     */
    public function multi_checkout_locate_template( $template, $template_name, $template_path ) {
        $basename = basename( $template );

        if ( $basename === 'form-checkout.php' ) {
            // Enqueue styles and scripts for custom checkout template
            wp_enqueue_script( 'asd-jquery-steps-script' );
            wp_enqueue_script( 'asd-checkout-script' );
            wp_enqueue_style( 'asd-jquery-steps-style' );
            wp_enqueue_style( 'asd-checkout-style' );

            // Include custom checkout template
            $template = ASD_MULTI_STEP_CHECKOUT_PATH . '/templates/form-checkout.php';
        }

        return $template;
    }

}
