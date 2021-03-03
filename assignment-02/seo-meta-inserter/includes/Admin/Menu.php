<?php

namespace SeoMetaInserter\Admin;

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
        add_menu_page( __( 'SEO Meta Inserter', 'seo-meta-inserter' ), __( 'SEO Meta Inserter', 'seo-meta-inserter' ), 'manage_options', 'seo-meta-inserter', [ $this, 'plugin_page' ], 'dashicons-embed-post' );
    }

    /**
     * Render the plugin page
     * 
     * @return void
     */
    public function plugin_page() {
        echo 'Hello World from Assignment 02 - Plugin 02 : admin page!';
    }
    
}