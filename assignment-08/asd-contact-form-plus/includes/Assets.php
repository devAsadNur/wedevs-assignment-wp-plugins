<?php

namespace Asd\Contact\Form\Plus;

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
     * Assets register function
     *
     * @since  1.0.0
     *
     * @return void
     */
    public function register_assets() {
        $script = [
            'handle'    => 'asd-contact-form-script',
            'src'       => ASD_CONTACT_FORM_PLUS_ASSETS . '/js/contact.js',
            'version'   => filemtime( ASD_CONTACT_FORM_PLUS_PATH . '/assets/js/contact.js' ),
            'deps'      => [ 'jquery' ],
            'in_footer' => true
        ];

        $style  = [
            'handle'  => 'asd-contact-form-style',
            'src'     => ASD_CONTACT_FORM_PLUS_ASSETS . '/css/contact.css',
            'version' => filemtime( ASD_CONTACT_FORM_PLUS_PATH . '/assets/css/contact.css' ),
            'deps'    => []
        ];

        wp_register_script( $script['handle'], $script['src'], $script['deps'], $script['version'], $script['in_footer'] );

        wp_register_style( $style['handle'], $style['src'], $style['deps'], $script['version'] );

        wp_localize_script( 'asd-contact-form-script', 'objContactEnquery', [
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
            'error'   => __( 'Something went wrong!', 'asd-contact-plus' ),
        ] );
    }
}
