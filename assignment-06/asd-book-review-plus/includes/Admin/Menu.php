<?php

namespace Asd\BookReviewPlus\Admin;

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
        add_menu_page( __( 'Book Review Plus', 'asd-book-review-plus' ), __( 'Book Review+', 'asd-book-review-plus' ), 'manage_options', 'book-review-plus', [ $this, 'plugin_page_handler' ], 'dashicons-book' );
    }

    /**
     * Render the plugin page
     *
     * @since  1.0.0
     *
     * @return void
     */
    public function plugin_page_handler() {
        /**
         * Include menu page template
         */
        ob_start();
        require_once ASD_BOOK_REVIEW_PLUS_PATH . "/templates/admin/menu_page.php";
        echo ob_get_clean();
    }
}
