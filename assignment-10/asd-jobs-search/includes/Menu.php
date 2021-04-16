<?php

namespace Asd\Jobs\Search;

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
     * Register plugin admin menu
     *
     * @since  1.0.0
     *
     * @return void
     */
    public function admin_menu_handler() {
        add_menu_page( __( 'Jobs Search Documentation', 'asd-jobs-search' ), __( 'Jobs Search', 'asd-jobs-search' ), 'manage_options', 'jobs-search-menu', [ $this, 'admin_page_handler' ], 'dashicons-search' );
    }

    /**
     * Plugin menu page renderer function
     *
     * @since  1.0.0
     *
     * @return void
     */
    public function admin_page_handler() {
        /**
         * Includes admin page template
         */
        ob_start();
        require_once ASD_JOBS_SEARCH_PATH . "/templates/admin_menu_page.php";
        echo ob_get_clean();
    }
}
