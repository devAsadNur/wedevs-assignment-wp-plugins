<?php

namespace PostsViewPlus\Admin;

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
        add_menu_page( __( 'Posts View Plus', 'posts-view-plus' ), __( 'Posts View Plus', 'posts-view-plus' ), 'manage_options', 'posts-view-plus', [ $this, 'plugin_page' ], 'dashicons-code-standards' );
    }

    /**
     * Render the plugin page
     * 
     * @return void
     */
    public function plugin_page() {
        echo 'Hello World from plugin admin page!';
    }
    // error_log('asdfsadfasdf');
}