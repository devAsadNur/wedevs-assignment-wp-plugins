<?php

namespace Asd\StudentInfo;

/**
 * The metadata
 * handler class
 */
class Metadata {

    /**
     * Initialize the class
     *
     * @since  1.0.0
     */
    public function __construct() {
        add_action( 'init', [ $this, 'integrate_wpdb' ], 0 );
    }

    /**
     * WPDB integrater function
     *
     * @since  1.0.0
     *
     * @return void
     */
    public function integrate_wpdb() {
        global $wpdb;

        $wpdb->studentmeta = $wpdb->prefix . 'studentmeta';
    }
}
