<?php

namespace Asd\SubscriptionFormWidget;

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
        $scripts = apply_filters( 'mc_subscription_form_scripts', [
            'mc-subscription-js' => [
                'src'       => ASD_SUBSCRIPTION_FORM_WIDGET_ASSETS . '/js/subscription.js',
                'deps'      => [ 'jquery' ],
                'version'   => filemtime( ASD_SUBSCRIPTION_FORM_WIDGET_PATH . '/assets/js/subscription.js' ),
                'in_footer' => true,
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
        $styles = apply_filters( 'mc_subscription_form_styles', [
            'mc-subscription-css' => [
                'src'     => ASD_SUBSCRIPTION_FORM_WIDGET_ASSETS . '/css/subscription.css',
                'version' => filemtime( ASD_SUBSCRIPTION_FORM_WIDGET_PATH . '/assets/css/subscription.css' ),
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

        // Mailchimp subscription localized script
        wp_localize_script( 'mc-subscription-js', 'objMcSubs', [
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
            'error'   => __( 'Something went wrong!', 'asd-subs-form-widget' ),
        ] );
    }
}
