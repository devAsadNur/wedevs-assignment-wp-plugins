<?php

namespace PostTitleCapitalize\Admin;

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
        add_menu_page( __( 'Post Title Capitalize', 'post-title-capitalize' ), __( 'Post Title Capitalize', 'post-title-capitalize' ), 'manage_options', 'post-title-capitalize', [ $this, 'plugin_page' ], 'dashicons-editor-spellcheck' );
    }

    /**
     * Render the plugin page
     * 
     * @return void
     */
    public function plugin_page() {
        echo 'Hello World from plugin 5: admin page!';
    }
}