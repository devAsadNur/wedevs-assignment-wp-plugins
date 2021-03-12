<?php

namespace AsdBookReview;

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
        add_menu_page( __( 'Book Review', 'asd-book-review' ), __( 'Book Review', 'asd-book-review' ), 'manage_options', 'asd-book-review', [ $this, 'plugin_page' ], 'dashicons-book' );
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
