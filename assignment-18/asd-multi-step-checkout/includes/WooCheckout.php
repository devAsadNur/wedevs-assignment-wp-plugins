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
        add_filter( 'woocommerce_locate_template', [ $this, 'multi_step_checkout_locate_template' ], 10, 3 );
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
    public function multi_step_checkout_locate_template( $template, $template_name, $template_path ) {
        $basename = basename( $template );

        if ( $basename === 'form-checkout.php' ) {
            wp_enqueue_script( 'asd-multi-checkout-script' );
            wp_enqueue_style( 'asd-multi-checkout-style' );

            // Include custom checkout template
            $template = ASD_MULTI_STEP_CHECKOUT_PATH . '/templates/form-checkout.php';
        }

        return $template;
    }

}
