<?php

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
	 * @since  1.0.0
     *
     * @return void
     */
    public function admin_menu_handler() {
        add_menu_page( __( 'Posts View Extend', 'post-view-extend' ), __( 'Posts View Extend', 'post-view-extend' ), 'manage_options', 'post-view-extend', [ $this, 'plugin_page' ], 'dashicons-media-text' );
    }

    /**
     * Render the plugin page
     *
	 * @since  1.0.0
     *
     * @return void
     */
    public function plugin_page() {
        // Code goes here...
    }
}
