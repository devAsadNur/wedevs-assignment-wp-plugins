<?php

namespace Asd\MultiStepCheckout;

/**
 * Assets
 * handler
 * class
 */
class Assets {

    /**
     * Initialize the class
     *
     * @since  1.0.0
     */
    public function __construct() {
        add_action( 'wp_enqueue_scripts', [ $this, 'register_assets' ] );
    }

    /**
     * Scripts getter function
     *
     * @since 1.0.0
     *
     * @return array
     */
    public function get_scripts() {
        $scripts = apply_filters( 'asd_multi_step_checkout_scripts', [
            'asd-jquery-steps-script' => [
                'src'       => ASD_MULTI_STEP_CHECKOUT_ASSETS . '/js/jquery.steps.min.js',
                'version'   => filemtime( ASD_MULTI_STEP_CHECKOUT_PATH . '/assets/js/jquery.steps.min.js' ),
                'deps'      => [ 'jquery' ],
                'in_footer' => false,
            ],
            'asd-checkout-script' => [
                'src'       => ASD_MULTI_STEP_CHECKOUT_ASSETS . '/js/multi-step-checkout.js',
                'version'   => filemtime( ASD_MULTI_STEP_CHECKOUT_PATH . '/assets/js/multi-step-checkout.js' ),
                'deps'      => [ 'jquery' ],
                'in_footer' => false,
            ],
        ] );

        return $scripts;
    }

    /**
     * Styles getter function
     *
     * @since 1.0.0
     *
     * @return array
     */
    public function get_styles() {
        $styles = apply_filters( 'asd_multi_step_checkout_styles', [
            'asd-jquery-steps-style' => [
                'src'     => ASD_MULTI_STEP_CHECKOUT_ASSETS . '/css/jquery.steps.css',
                'version' => filemtime( ASD_MULTI_STEP_CHECKOUT_PATH . '/assets/css/jquery.steps.css' ),
            ],
            'asd-checkout-style' => [
                'src'     => ASD_MULTI_STEP_CHECKOUT_ASSETS . '/css/multi-step-checkout.css',
                'version' => filemtime( ASD_MULTI_STEP_CHECKOUT_PATH . '/assets/css/multi-step-checkout.css' ),
            ],
        ] );

        return $styles;
    }

    /**
     * Assets register function
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function register_assets() {
        $scripts = $this->get_scripts();
        $styles  = $this->get_styles();

        foreach ( $scripts as $handle => $script ) {
            $deps      = isset( $script['deps'] ) ? $script['deps'] : [];
            $version   = isset( $script['version'] ) ? $script['version'] : false;
            $in_footer = isset( $script['in_footer'] ) ? $script['in_footer'] : false;

            // Register each of the scripts
            wp_register_script( $handle, $script['src'], $deps, $version, $in_footer);
        }

        foreach ($styles as $handle => $style) {
            $deps    = isset( $style['deps'] ) ? $style['deps'] : [];
            $version = isset( $style['version'] ) ? $style['version'] : false;
            $media   = isset( $style['media'] ) ? $style['media'] : 'all';

            // Register each of the styles
            wp_register_style( $handle, $style['src'], $deps, $version, $media );
        }
    }
}
