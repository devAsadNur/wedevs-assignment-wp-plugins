<?php

namespace Asd\WeContact\Ajax;

/**
 * The assets
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
        // add_action( 'admin_enqueue_scripts', [ $this, 'register_assets' ] );
    }

    /**
     * Scripts getter function
     *
     * @since  1.0.0
     *
     * @return array
     */
    public function get_scripts() {
        return [
            'asd-contact-form-script' => [
                'src'     => ASD_AJAX_CONTACT_FORM_ASSETS . '/js/contact.js',
                'version' => filemtime( ASD_AJAX_CONTACT_FORM_PATH . '/assets/js/contact.js' ),
                'deps'    => [ 'jquery' ],
            ],
        ];
    }

    /**
     * Styles getter function
     *
     * @since  1.0.0
     *
     * @return array
     */
    public function get_styles() {
        return [
            'asd-contact-form-style' => [
                'src'     => ASD_AJAX_CONTACT_FORM_ASSETS . '/css/contact.css',
                'version' => filemtime( ASD_AJAX_CONTACT_FORM_PATH . '/assets/css/contact.css' ),
            ],
        ];
    }

    /**
     * Assets register function
     *
     * @since  1.0.0
     *
     * @return void
     */
    public function register_assets() {
        $scripts = $this->get_scripts();
        $styles  = $this->get_styles();

        foreach ( $scripts as $handle => $script ) {
            $deps = isset( $script['deps'] ) ? $script['deps'] : false;

            wp_register_script( $handle, $script['src'], $deps, $script['version'] );
        }

        foreach ( $styles as $handle => $style ) {
            $deps = isset( $style['deps'] ) ? $style['deps'] : false;

            wp_register_style( $handle, $style['src'], $deps, true );
        }

        wp_localize_script( 'asd-contact-form-script', 'objContactEnquery', [
            'ajax_url' => admin_url( 'admin-ajax.php' ),
            'error'    => __( 'Something went wrong!', 'asd-contact-ajax' ),
        ] );

    }
}
