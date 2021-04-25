<?php

namespace Asd\Book\Review\PP;

/**
 * Install
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
        $this->add_version();
        $this->create_tables();
    }

    /**
     * Plugin version adder function
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function add_version() {
        $installed = get_option( 'asd_book_review_pp_installed' );

        if( ! $installed ) {
            update_option( 'asd_book_review_pp_installed', time() );
        }

        update_option( 'asd_book_review_pp_version', ASD_BOOK_REVIEW_PP_VERSION );
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

        $schema = "CREATE TABLE IF NOT EXISTS `{$wpdb->prefix}wedevs_book_review_rating` (
            `id` int unsigned NOT NULL AUTO_INCREMENT,
            `post_id` bigint unsigned NOT NULL,
            `user_id` bigint unsigned NOT NULL,
            `ip` varchar(30) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
            `rating` float unsigned NOT NULL DEFAULT '0',
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
