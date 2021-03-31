<?php

/**
 * Inserts new entry to database table
 *
 * @since  1.0.0
 *
 * @param  array $args
 * @return int|WP_Error
 */
function asd_ac_insert_address( $args = [] ) {
    global $wpdb;
    $table_ac = $wpdb->prefix . 'ac_addresses';

    if ( empty( $args['name'] ) ) {
        return new \WP_Error( 'no-name', __( 'You must provide a name.', 'asd-crud' ) );
    }
    $defaults = [
        'name'       => '',
        'address'    => '',
        'phone'      => '',
        'created_by' => get_current_user_id(),
        'created_at' => current_time( 'mysql' ),
    ];

    $data = wp_parse_args( $args, $defaults );

    if ( isset( $data['id'] ) ) {
        $id = $data['id'];
        unset( $data['id'] );

        $updated = $wpdb->update(
            $table_ac,
            $data,
            [ 'id' => $id ],
            [
                '%s',
                '%s',
                '%s',
                '%d',
                '%s'
            ],
            [ '%d' ]
        );

        return $updated;

    } else {
        $inserted = $wpdb->insert(
            $table_ac,
            $data,
            [
                '%s',
                '%s',
                '%s',
                '%d',
                '%s'
            ]
        );

        if ( ! $inserted ) {
            return new \WP_Error( 'failed-to-insert', __( 'Failed to insert data', 'asd-crud' ) );
        }

        return $wpdb->insert_id;
    }
}

/**
 * Fetch all results from database table
 *
 * @since  1.0.0
 *
 * @param  array $args
 * @return array $items
 */
function asd_ac_get_addresses( $args = [] ) {
    global $wpdb;
    $table_ac = $wpdb->prefix . 'ac_addresses';

    $defaults = [
        'number'  => 20,
        'offset'  => 0,
        'orderby' => 'id',
        'order'   => 'ASC'
    ];

    $args = wp_parse_args( $args, $defaults );

    $sql = $wpdb->prepare(
        "SELECT * FROM {$table_ac}
        ORDER BY {$args['orderby']} {$args['order']}
        LIMIT %d, %d",
        $args['offset'], $args['number']
    );

    $items = $wpdb->get_results( $sql );

    return $items;
}

/**
 * Fetch row count from database table
 *
 * @since  1.0.0
 *
 * @return int
 */
function asd_ac_address_count() {
    global $wpdb;
    $table_ac = $wpdb->prefix . 'ac_addresses';

    return (int) $wpdb->get_var( "SELECT count(id) FROM {$table_ac}" );
}

/**
 * Fetch single row form database table
 *
 * @since  1.0.0
 *
 * @param  int $id
 * @return array
 */
function asd_ac_get_address( $id ) {
    global $wpdb;
    $table_ac = $wpdb->prefix . 'ac_addresses';

    return $wpdb->get_row(
        $wpdb->prepare( "SELECT * FROM {$table_ac} WHERE id = %d", $id )
    );
}

/**
 * Delete single row form database table
 *
 * @since  1.0.0
 *
 * @param  int $id
 * @return boolean
 */
function asd_ac_delete_address( $id ) {
    global $wpdb;
    $table_ac = $wpdb->prefix . 'ac_addresses';

    return $wpdb->delete(
        $table_ac,
        [ 'id' => $id ],
        [ '%d' ]
    );
}
