<?php

namespace Asd\CRUD\Admin;

/**
 * The installer
 * handler class
 */
class Installer {

    /**
     * Runs installer methods
     *
     * @since  1.0.0
     *
     * @return void
     */
    public function run() {
        $this->add_version();
        $this->create_tables();
    }

    /**
     * Adds first time installing time and version info
     *
     * @since  1.0.0
     *
     * @return void
     */
    public function add_version() {
        $installed = get_option( 'asd_crud_installed' );

        if( ! $installed ) {
            update_option( 'asd_crud_installed', time() );
        }

        update_option( 'asd_crud_version', ASD_CRUD_VERSION );
    }

    /**
     * Creates database table
     *
     * @since  1.0.0
     *
     * @return void
     */
    public function create_tables() {
        global $wpdb;
        $table_name = $wpdb->prefix . 'ac_addresses';
        $charset_collate = $wpdb->get_charset_collate();

        /**
         * Database table SQL schema
         */
        $schema = "CREATE TABLE IF NOT EXISTS $table_name (
            `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
            `name` varchar(100) NOT NULL DEFAULT '',
            `address` varchar(255) DEFAULT NULL,
            `phone` varchar(30) DEFAULT NULL,
            `created_by` bigint(20) unsigned NOT NULL,
            `created_at` datetime NOT NULL,
            PRIMARY KEY (`id`)
          ) $charset_collate";

        /**
         * Includes 'wp-admin/includes/upgrade.php' if not included
         */
        if ( ! function_exists( 'dbDelta' ) ) {
            require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        }

        /**
         * Create the database table
         */
        dbDelta( $schema );
    }
}
