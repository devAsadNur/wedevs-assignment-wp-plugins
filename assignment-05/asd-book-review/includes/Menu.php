<?php

namespace Asd\BookReview;

/**
 * The menu
 * handler
 * class
 */
class Menu {

    /**
     * Initialize the class
     *
     * @since  1.0.0
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
        ob_start();
		require_once ASD_BOOK_REVIEW_PATH . "/templates/admin_menu_page.php";
        echo ob_get_clean();
    }
}
