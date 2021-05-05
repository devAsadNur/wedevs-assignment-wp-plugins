<?php

namespace Asd\Contact\Form\Plus;

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
        add_menu_page( __( 'Contact Form Responses', 'asd-contact-plus' ), __( 'Contact Form Responses', 'asd-contact-plus' ), 'manage_options', 'contact-response', [ $this, 'plugin_page' ], 'dashicons-buddicons-pm' );
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
         * Include plugin page template
         */
        ob_start();
        include_once ASD_CONTACT_FORM_PLUS_PATH . "/templates/plugin_page.php";
        echo ob_get_clean();
    }
}
