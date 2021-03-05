<?php

namespace WeContactForm\Admin;

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
        add_menu_page( __( 'weContact Form', 'wecontact-shortcode-form' ), __( 'weContact Form', 'wecontact-shortcode-form' ), 'manage_options', 'wecontact-shortcode-form', [ $this, 'plugin_page' ], 'dashicons-shortcode' );
    }

    /**
     * Render the plugin page
     * 
     * @return void
     */
    public function plugin_page() {
        ?>

        <h1>weDevs Shortcode Form</h1><br>
        <h2>Form with title use guide:</h2>
        <h4>Shortcode format:</h4>
        <p>[wp-sc-contact-form title="Title text" description="Description text"] [/wp-sc-contact-form]</p>
        <br>
        <h2>Individual input use guide:</h2>
        <h4>Shortcode format:</h4>
        <p>[wp-sc-contact-input type="field type" name="field name" label="Field label text" placehoder="Placeholder Text" value="Default value"]</p>
        <br>

        <?php
    }
}