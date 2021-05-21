<?php

namespace Asd\RestApiCrud;

/**
 * Installation
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
     * Adds plugin version info
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function add_version_info() {
        $installed = get_option( 'asd_rest_api_crud_installed' );

        if ( ! $installed ) {
            update_option( 'asd_rest_api_crud_installed', time() );
        }

        update_option( 'asd_rest_api_crud_version', ASD_REST_API_CRUD_VERSION );
    }

    /**
     * Creates database table
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function create_tables() {
        global $wpdb;

        $charset_collate = $wpdb->get_charset_collate();

        $schema = "CREATE TABLE IF NOT EXISTS `{$wpdb->prefix}wedevs_rest_api_products` (
            `id` int unsigned NOT NULL AUTO_INCREMENT,
            `product_name` varchar(100) NOT NULL DEFAULT '',
            `product_description` varchar(255) NOT NULL DEFAULT '',
            `product_price` float NOT NULL,
            `author_id` int NOT NULL,
            `created_at` datetime NOT NULL,
            `updated_at` datetime DEFAULT NULL,
            PRIMARY KEY (`id`)
          ) $charset_collate;";

        if ( ! function_exists( 'dbDelta' ) ) {
            require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        }

        dbDelta( $schema );
    }
}
