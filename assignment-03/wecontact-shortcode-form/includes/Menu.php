<?php

namespace Asd\WeContact\Shortcode;

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
        add_menu_page( __( 'weContact Form', 'wecontact-shortcode-form' ), __( 'weContact Form', 'wecontact-shortcode-form' ), 'manage_options', 'wecontact-shortcode-form', [ $this, 'plugin_page' ], 'dashicons-shortcode' );
    }

    /**
     * Render the plugin page
     *
     * @since  1.0.0
     *
     * @return void
     */
    public function plugin_page() {
        /**
         * Include menu page template
         */
        ob_start();
        require_once WC_SC_FORM_PATH . "/templates/admin_menu_page.php";
        echo ob_get_clean();
    }
}
