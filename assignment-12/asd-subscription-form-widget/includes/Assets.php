<?php

namespace Asd\Subscription\Form\Widget;

/**
 * Assets
 * handler class
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
     * Assets register function
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function register_assets() {
        $script = [
            'handle'    => 'mc-subscription-js',
            'src'       => ASD_SUBSCRIPTION_FORM_WIDGET_ASSETS . '/js/subscription.js',
            'deps'      => [ 'jquery' ],
            'version'   => filemtime( ASD_SUBSCRIPTION_FORM_WIDGET_PATH . '/assets/js/subscription.js' ),
            'in_footer' => true,
        ];

        $style = [
            'handle'  => 'mc-subscription-js',
            'src'     => ASD_SUBSCRIPTION_FORM_WIDGET_ASSETS . '/css/subscription.css',
            'deps'    => [],
            'version' => filemtime( ASD_SUBSCRIPTION_FORM_WIDGET_PATH . '/assets/css/subscription.css' ),
        ];

        // Register script file
        wp_register_script( $script['handle'], $script['src'], $script['deps'], $script['version'], $script['in_footer'] );

        // Register style file
        wp_register_style( $style['handle'], $style['src'], $style['deps'], $style['version'] );

        // Localize script file
        wp_localize_script( $script['handle'], 'objMcSubs', [
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
            'error'   => __( 'Something went wrong!', 'asd-subs-form-widget' ),
        ]);
    }
}
