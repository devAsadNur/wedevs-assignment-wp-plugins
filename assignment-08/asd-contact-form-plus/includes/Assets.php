<?php

namespace Asd\ContactFormPlus;

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
    }

    /**
     * Scripts getter function
     *
     * @since 1.0.0
     *
     * @return array
     */
    public function get_scripts() {
        $scripts = apply_filters( 'asd_contact_form_scripts', [
            'asd-contact-form-script' => [
                'src'       => ASD_CONTACT_FORM_PLUS_ASSETS . '/js/contact.js',
                'version'   => filemtime( ASD_CONTACT_FORM_PLUS_PATH . '/assets/js/contact.js' ),
                'deps'      => [ 'jquery' ],
                'in_footer' => true
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
        $styles = apply_filters( 'asd_contact_form_styles', [
            'asd-contact-form-style' => [
                'src'     => ASD_CONTACT_FORM_PLUS_ASSETS . '/css/contact.css',
                'version' => filemtime( ASD_CONTACT_FORM_PLUS_PATH . '/assets/css/contact.css' ),
            ],
        ] );

        return $styles;
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
            $deps      = isset( $script['deps'] ) ? $script['deps'] : [];
            $version   = isset( $script['version'] ) ? $script['version'] : false;
            $in_footer = isset( $script['in_footer'] ) ? $script['in_footer'] : false;

            /**
             * Register each of the scripts
             */
            wp_register_script( $handle, $script['src'], $deps, $version, $in_footer);
        }

        foreach ($styles as $handle => $style) {
            $deps    = isset( $style['deps'] ) ? $style['deps'] : [];
            $version = isset( $style['version'] ) ? $style['version'] : false;
            $media   = isset( $style['media'] ) ? $style['media'] : 'all';

            /**
             * Register each of the styles
             */
            wp_register_style( $handle, $style['src'], $deps, $version, $media );
        }

        /**
         * Contact enquery localized script
         */
        wp_localize_script( 'asd-contact-form-script', 'objContactEnquery', [
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
            'error'   => __( 'Something went wrong!', 'asd-contact-plus' ),
        ] );
    }
}
