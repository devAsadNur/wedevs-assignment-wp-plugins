<?php

namespace Asd\ContactFormPlus\Install;

/**
 * Installer
 * handler class
 */
class Installer {

    /**
     * Installer runner function
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function run() {
        $this->add_version_info();
        $this->create_tables();
    }

    /**
     * Plugin version adder function
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function add_version_info() {
        $installed = get_option( 'asd_contact_form_plus_installed' );

        if ( ! $installed ) {
            update_option( 'asd_contact_form_plus_installed', time() );
        }

        update_option( 'asd_contact_form_plus_version', ASD_CONTACT_FORM_PLUS_VERSION );
    }

    /**
     * Database table creator function
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function create_tables() {
        global $wpdb;

        $charset_collate = $wpdb->get_charset_collate();

        $schema = "CREATE TABLE IF NOT EXISTS `{$wpdb->prefix}wedevs_contact_form_responses` (
            `id` int unsigned NOT NULL AUTO_INCREMENT,
            `first_name` varchar(50) NOT NULL DEFAULT '',
            `last_name` varchar(50) NOT NULL DEFAULT '',
            `email` varchar(100) NOT NULL DEFAULT '',
            `message` varchar(255) DEFAULT '',
            `ip` varchar(30) NOT NULL DEFAULT '',
            `created_at` datetime NOT NULL,
            PRIMARY KEY (`id`)
        ) {$charset_collate};";

        if ( ! function_exists( 'dbDelta' ) ) {
            require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        }

        dbDelta( $schema );
    }
}
