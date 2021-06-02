<?php

namespace Asd\StudentInfo;

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
        $installed = get_option( 'asd_student_info_installed' );

        if ( ! $installed ) {
            update_option( 'asd_student_info_installed', time() );
        }

        update_option( 'asd_student_info_version', ASD_STUDENT_INFO_VERSION );
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

        // Students table schema
        $schema_students = "CREATE TABLE IF NOT EXISTS `{$wpdb->prefix}students` (
            `id` int unsigned NOT NULL AUTO_INCREMENT,
            `first_name` varchar(50) NOT NULL DEFAULT '',
            `last_name` varchar(50) NOT NULL DEFAULT '',
            `class` int NOT NULL,
            `roll` bigint NOT NULL,
            `reg_no` bigint DEFAULT NULL,
            `created_at` datetime NOT NULL,
            `updated_at` datetime DEFAULT NULL,
            PRIMARY KEY (`id`)
        ) $charset_collate;";

        // Student meta table schema
        $schema_studentmeta = "CREATE TABLE IF NOT EXISTS `{$wpdb->prefix}studentmeta` (
            `meta_id` bigint unsigned NOT NULL AUTO_INCREMENT,
            `student_id` bigint NOT NULL DEFAULT '0',
            `meta_key` varchar(255) DEFAULT '',
            `meta_value` longtext,
            PRIMARY KEY (`meta_id`),
            KEY student_id (student_id),
            KEY meta_key (meta_key)
        ) $charset_collate;";

        if ( ! function_exists( 'dbDelta' ) ) {
            require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        }

        dbDelta( $schema_students );
        dbDelta( $schema_studentmeta );
    }
}
