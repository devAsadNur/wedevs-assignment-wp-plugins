<?php

namespace EmailNotification\Admin;

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
        add_menu_page( __( 'Posts Email Notification', 'posts-email-notification' ), __( 'Posts Email Notification', 'posts-email-notification' ), 'manage_options', 'posts-email-notification', [ $this, 'plugin_page' ], 'dashicons-email' );
    }

    /**
     * Render the plugin page
     * 
     * @return void
     */
    public function plugin_page() {
        echo 'Hello World from plugin 3: admin page!';
    }
}