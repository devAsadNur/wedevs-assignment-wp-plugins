<?php

/**
 * The menu
 * handler
 * class
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
     * @since  1.0.0
     *
     * @return void
     */
    public function admin_menu_handler() {
        add_menu_page( __( 'Post Excerpt', 'post-excerpt' ), __( 'Post Excerpt', 'post-excerpt' ), 'manage_options', 'post-excerpt', [ $this, 'plugin_page' ], 'dashicons-ellipsis' );
    }

    /**
     * Render the plugin page
     *
     * @since  1.0.0
     *
     * @return void
     */
    public function plugin_page() {
        // Code goes here
    }
}
