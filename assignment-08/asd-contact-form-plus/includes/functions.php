<?php
/**
 * User IP getter function
 *
 * @since 1.0.0
 *
 * @return string
 */
function asd_sc_cf_get_user_ip() {
    if ( ! empty( $_SERVER['HTTP_CLIENT_IP'] ) ) {
        //check ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif ( ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
        //to check ip is pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } elseif ( ! empty( $_SERVER['REMOTE_ADDR'] ) ) {
        $ip = $_SERVER['REMOTE_ADDR'];
    } else {
        $ip = 'UNKNOWN';
    }

    return $ip;
}

/**
 * Enquery inserter function
 *
 * @since 1.0.0
 *
 * @param array $args
 *
 * @return int|WP_Error
 */
function asd_sc_cf_insert_enquery( $args = [] ) {
    global $wpdb;

    $defaults = [
        'first_name' => '',
        'last_name'  => '',
        'email'      => '',
        'message'    => '',
        'ip'         => asd_sc_cf_get_user_ip(),
        'created_at' => current_time( 'mysql' )
    ];

    $data = wp_parse_args( $args, $defaults );

    $inserted = $wpdb->insert(
        $wpdb->prefix . 'wedevs_contact_form_responses',
        $data,
        [
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
        ]
    );

    if ( ! $inserted ) {
        return new \WP_Error( 'failed-to-insert', __( 'Failed to insert data', 'asd-contact-plus' ) );
    }

    return $wpdb->insert_id;
}

/**
 * Enqueries fetcher function
 *
 * @since 1.0.0
 *
 * @param array $args
 *
 * @return object
 */
function asd_sc_cf_get_enqueries( $args = [] ) {
    global $wpdb;

    $defaults = [
        'number'  => 20,
        'offset'  => 0,
        'orderby' => 'id',
        'order'   => 'DESC',
    ];

    $args = wp_parse_args( $args, $defaults );

    $sql = $wpdb->prepare(
        "SELECT * FROM {$wpdb->prefix}wedevs_contact_form_responses
        ORDER BY {$args['orderby']} {$args['order']}
        LIMIT %d, %d",
        $args['offset'], $args['number']
    );

    $items = $wpdb->get_results( $sql );

    return $items;
}

/**
 * Total enquery count getter function
 *
 * @since 1.0.0
 *
 * @return int
 */
function asd_sc_cf_enquery_count() {
    global $wpdb;

    return $wpdb->get_var( "SELECT count(id) FROM {$wpdb->prefix}wedevs_contact_form_responses" );
}
