<?php

namespace VerticalButton\Traits;

/**
 * Assets handler class
 */
class Assets {

    /**
     * Initializes the class
     */
    public function __construct() {
        add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_files' ] );   
    }

    public function enqueue_files() {
        wp_enqueue_style( 'coupon-style', VERTICAL_BUTTON_ASSETS . '/css/vertical-button.css', false, VERTICAL_BUTTON_VERSION, false );
        wp_enqueue_script( 'coupon-script', VERTICAL_BUTTON_ASSETS . '/js/vertical-button.js', false, VERTICAL_BUTTON_VERSION, true );
    }

}