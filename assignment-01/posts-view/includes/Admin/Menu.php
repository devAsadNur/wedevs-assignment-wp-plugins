<?php

namespace PostsView\Admin;

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
        add_menu_page( __( 'Posts View', 'posts-view' ), __( 'Posts View', 'posts-view' ), 'manage_options', 'posts-view', [ $this, 'plugin_page' ], 'dashicons-media-text' );
    }

    /**
     * Render the plugin page
     * 
     * @return void
     */
    public function plugin_page() {
        echo 'Hello World from plugin admin page!';
    }
}