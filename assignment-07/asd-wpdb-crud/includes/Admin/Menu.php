<?php

namespace Asd\CRUD\Admin;

/**
 * Admin
 * menu
 * handler
 * class
 */
class Menu {

    public $addressbook;

    /**
     * Initialize the class
     *
     * @param object $addressbook
     * @since 1.0.0
     */
    public function __construct( $addressbook ) {
        $this->addressbook = $addressbook;

        add_action( 'admin_menu', [ $this, 'admin_menu_handler' ] );
    }

    /**
     * Register admin menu & sub-menu
     *
     * @since  1.0.0
     *
     * @return void
     */
    public function admin_menu_handler() {
        $parent_slug = 'asd-crud';
        $capability  = 'manage_options';

        add_menu_page( __( 'CRUD Operations', 'asd-crud' ), __( 'CRUD Operations', 'asd-crud' ), $capability, $parent_slug, [ $this, 'render_addressbook_page' ], 'dashicons-database-view' );
        add_submenu_page( $parent_slug, __( 'Address Book', 'asd-crud' ), __( 'Address Book', 'asd-crud' ), $capability, $parent_slug, [ $this, 'render_addressbook_page' ] );
        add_submenu_page( $parent_slug, __( 'Settings', 'asd-crud' ), __( 'Settings', 'asd-crud' ), $capability, 'asd-crud-settings', [ $this, 'render_settings_page' ] );

    }

    /**
     * Render the addressbook page
     *
     * @since  1.0.0
     *
     * @return void
     */
    public function render_addressbook_page() {
        $this->addressbook->plugin_page();
    }

    /**
     * Render the settings page
     *
     * @since  1.0.0
     *
     * @return void
     */
    public function render_settings_page() {
        /**
         * Include sub-menu page template
         */
        ob_start();
        require_once ASD_CRUD_PATH . "/templates/admin_menu_settings_page.php";
        echo ob_get_clean();
    }

}
