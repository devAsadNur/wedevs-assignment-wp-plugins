<?php

namespace VerticalButton\Admin;

/**
 * The menu handler class
 */
class Menu {

    /**
     * Initialize the class
     */
    public function __construct() {
        add_action( 'admin_menu', [ $this, 'admin_menu_handler' ] );
    }

    /**
     * Register admin menu
     * 
     * @return void
     */
    public function admin_menu_handler() {
        add_menu_page( __( 'Vertical Button', 'vertical-button' ), __( 'Vertical Button', 'vertical-button' ), 'manage_options', 'vertical-button', [ $this, 'plugin_page' ], 'dashicons-embed-generic' );
    }

    /**
     * Render the plugin page
     * 
     * @return void
     */
    public function plugin_page() {
        echo 'Hello World from Assignment 02 - Plugin 01 : admin page!';
    }
    
}