<?php
/**
 * User IP getter function
 *
 * @since 1.0.0
 *
 * @return string
 */
function asd_br_get_the_user_ip() {
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
 * Rating inserter function
 *
 * @since 1.0.0
 *
 * @param array $args
 *
 * @return int|WP_Error
 */
function asd_br_insert_rating( $args = [] ) {
    global $wpdb;

    if ( empty( $args['rating'] ) ) {
        return new \WP_Error( 'no-rating', __( 'You must provide a rating', 'asd-book-review-pro' ) );
    }

    $defaults = [
        'post_id'    => '',
        'user_id'    => get_current_user_id(),
        'ip'         => asd_br_get_the_user_ip(),
        'rating'     => '',
        'created_at' => current_time( 'mysql' ),
    ];

    $data = wp_parse_args( $args, $defaults );

    $inserted = $wpdb->insert(
        $wpdb->prefix . 'wedevs_book_review_rating',
        $data,
        [
            '%d',
            '%d',
            '%s',
            '%f',
            '%s',
        ]
    );

    if ( ! $inserted ) {
        return new \WP_Error( 'failed-to-insert', __( 'Failed to insert data', 'asd-book-review-pro' ) );
    }

    return $wpdb->insert_id;
}


/**
 * Rating updater function
 *
 * @since 1.0.0
 *
 * @param array $args
 *
 * @return int|WP_Error
 */
function asd_br_update_rating( $args = [] ) {
    global $wpdb;

    $id = $args['id'];

    if ( '' === $id ) {
        return new \WP_Error( 'no-rating-id', __( 'Rating ID must not be empty', 'asd-book-review-pro' ) );
    }

    if ( empty( $args['rating'] ) ) {
        return new \WP_Error( 'no-rating', __( 'You must provide a rating', 'asd-book-review-pro' ) );
    }

    $defaults = [
        'ip'         => asd_br_get_the_user_ip(),
        'rating'     => '',
        'updated_at' => current_time( 'mysql' ),
    ];

    unset( $args['id'] );
    unset( $args['post_id'] );

    $data = wp_parse_args( $args, $defaults );

    $updated = $wpdb->update(
        $wpdb->prefix . 'wedevs_book_review_rating',
        $data,
        [ 'id' => $id ],
        [
            '%s',
            '%f',
            '%s',
        ],
        [ '%d' ]
    );

    if ( ! $updated ) {
        return new \WP_Error( 'failed-to-update', __( 'Failed to update data', 'asd-book-review-pro' ) );
    }
}

/**
 * Rating getter function
 *
 * @since 1.0.0
 *
 * @param array $args
 *
 * @return object
 */
function asd_br_get_rating( $args = [] ) {
    global $wpdb;

    $defaults = [
        'post_id' => '',
        'user_id' => get_current_user_id(),
    ];

    $args = wp_parse_args( $args, $defaults );

    return $wpdb->get_row(
        $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}wedevs_book_review_rating WHERE post_id = %d AND user_id = %d", $args['post_id'], $args['user_id'] )
    );
}

/**
 * Ratings getter function by post id
 *
 * @since 1.0.0
 *
 * @param array $args
 *
 * @return array
 */
function asd_br_get_ratings( $args = [] ) {
    global $wpdb;

    $defaults = [
        'post_id' => '',
        'number'  => 10,
        'offset'  => 0,
        'orderby' => 'id',
        'order'   => 'ASC',
    ];

    $args = wp_parse_args( $args, $defaults );

    $sql = $wpdb->prepare(
        "SELECT * FROM {$wpdb->prefix}wedevs_book_review_rating
        WHERE post_id = %d
        ORDER BY {$args['orderby']} {$args['order']}
        LIMIT %d, %d",
        $args['post_id'], $args['offset'], $args['number']
    );

    $items = $wpdb->get_results( $sql );

    return $items;
}
