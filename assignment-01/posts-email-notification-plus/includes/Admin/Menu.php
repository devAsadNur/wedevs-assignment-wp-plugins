<?php

namespace EmailNotificationPlus\Admin;

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
        add_menu_page( __( 'Posts Email Notification Plus', 'posts-email-notification-plus' ), __( 'Posts Email Notification Plus', 'posts-email-notification-plus' ), 'manage_options', 'posts-email-notification-plus', [ $this, 'plugin_page' ], 'dashicons-email-alt2' );
    }

    /**
     * Render the plugin page
     * 
     * @return void
     */
    public function plugin_page() {
        echo 'Hello World from plugin 4: admin page!';
    }
}