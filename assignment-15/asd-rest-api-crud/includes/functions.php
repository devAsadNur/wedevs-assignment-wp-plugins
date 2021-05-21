<?php
/**
 * Product inserter function
 *
 * @since  1.0.0
 *
 * @param  array $args
 *
 * @return int|WP_Error
 */
function asd_rest_insert_product( $args = [] ) {
    global $wpdb;

    if ( empty( $args['product_name'] ) ) {
        return new \WP_Error( 'no-product-name', __( 'You must provide a product name', 'asd-rest-api-crud' ) );
    }

    if ( empty( $args['product_description'] ) ) {
        return new \WP_Error( 'no-product-description', __( 'You must provide product description', 'asd-rest-api-crud' ) );
    }

    if ( empty( $args['product_price'] ) ) {
        return new \WP_Error( 'no-product-price', __( 'You must provide product price', 'asd-rest-api-crud' ) );
    }

    $defaults = [
        'product_name'        => '',
        'product_description' => '',
        'product_price'       => '',
        'author_id'           => (int) get_current_user_id(),
        'created_at'          => current_time( 'mysql' ),
    ];

    $data = wp_parse_args( $args, $defaults );

    $inserted = $wpdb->insert(
        $wpdb->prefix . "wedevs_rest_api_products",
        $data,
        [
            '%s',
            '%s',
            '%f',
            '%d',
            '%s',
        ]
    );

    if ( ! $inserted ) {
        return new \WP_Error( 'failed-to-insert', __( 'Failed to insert data', 'asd-rest-api-crud' ) );
    }

    return $wpdb->insert_id;
}

/**
 * Product updater function
 *
 * @since  1.0.0
 *
 * @param  array $args
 *
 * @return int|WP_Error
 */
function asd_rest_update_product( $args = [] ) {
    global $wpdb;

    $product_id = $args['id'];

    if ( empty( $product_id ) ) {
        return new \WP_Error( 'no-product-id', __( 'Product ID must not be empty', 'asd-rest-api-crud' ) );
    }

    if ( empty( $args['product_name'] ) ) {
        return new \WP_Error( 'no-product-name', __( 'You must provide a product name', 'asd-rest-api-crud' ) );
    }

    if ( empty( $args['product_description'] ) ) {
        return new \WP_Error( 'no-product-description', __( 'You must provide product description', 'asd-rest-api-crud' ) );
    }

    if ( empty( $args['product_price'] ) ) {
        return new \WP_Error( 'no-product-price', __( 'You must provide product price', 'asd-rest-api-crud' ) );
    }

    $defaults = [
        'product_name'        => '',
        'product_description' => '',
        'product_price'       => '',
        'author_id'           => get_current_user_id(),
        'updated_at'          => current_time( 'mysql' ),
    ];

    unset( $args['id'] );

    $data = wp_parse_args( $args, $defaults );

    $updated = $wpdb->update(
        $wpdb->prefix . 'wedevs_rest_api_products',
        $data,
        [ 'id' => $product_id ],
        [
            '%s',
            '%s',
            '%f',
            '%d',
            '%s',
        ],
        [ '%d' ]
    );

    if ( ! $updated ) {
        return new \WP_Error( 'failed-to-update', __( 'Failed to update data', 'asd-rest-api-crud' ) );
    }

    return $updated;
}

/**
 * Products getter function
 *
 * @since  1.0.0
 *
 * @param  array $args
 *
 * @return array
 */
function asd_rest_get_products( $args = [] ) {
    global $wpdb;

    $defaults = [
        'number' => 10,
        'offset' => 0,
        'orderby' => 'id',
        'order' => 'DESC',
    ];

    $args = wp_parse_args( $args, $defaults );

    $sql = $wpdb->prepare(
        "SELECT * FROM {$wpdb->prefix}wedevs_rest_api_products
        ORDER BY {$args['orderby']} {$args['order']}
        LIMIT %d, %d",
        $args['offset'], $args['number']
    );

    $items = $wpdb->get_results( $sql );

    return $items;
}

/**
 * Product getter function by ID
 *
 * @since  1.0.0
 *
 * @param  int $id
 *
 * @return object
 */
function asd_rest_get_product( $id ) {
    global $wpdb;

    return $wpdb->get_row(
        $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}wedevs_rest_api_products WHERE id = %d", $id )
    );
}

/**
 * Total products counter function
 *
 * @since  1.0.0
 *
 * @return int
 */
function asd_rest_products_count() {
    global $wpdb;

    return (int) $wpdb->get_var( "SELECT count(id) FROM {$wpdb->prefix}wedevs_rest_api_products" );
}

/**
 * Product deleter function by ID
 *
 * @since  1.0.0
 *
 * @param  int $id
 *
 * @return int|boolean
 */
function asd_rest_delete_product( $id ) {
    global $wpdb;

    return $wpdb->delete(
        $wpdb->prefix . 'wedevs_rest_api_products',
        [ 'id' => $id ],
        [ '%d' ]
    );
}
