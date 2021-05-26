<?php

namespace Asd\BookReviewPro;

/**
 * Rating
 * handler
 * class
 */
class Rating {

    /**
     * Rating inserter function
     *
     * @since 1.0.0
     *
     * @param array $args
     *
     * @return int|WP_Error
     */
    public function insert_rating( $args = [] ) {
        global $wpdb;

        if ( empty( $args['rating'] ) ) {
            return new \WP_Error( 'no-rating', __( 'You must provide a rating', 'asd-book-review-pro' ) );
        }

        $defaults = [
            'post_id'    => '',
            'user_id'    => get_current_user_id(),
            'ip'         => asd_brp_get_the_user_ip(),
            'rating'     => 0.0,
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
    public function update_rating( $args = [] ) {
        global $wpdb;

        $id = (int) $args['id'];

        if ( empty( $id ) ) {
            return new \WP_Error( 'no-rating-id', __( 'Rating ID must not be empty', 'asd-book-review-pro' ) );
        }

        if ( empty( $args['rating'] ) ) {
            return new \WP_Error( 'no-rating', __( 'You must provide a rating', 'asd-book-review-pro' ) );
        }

        $defaults = [
            'ip'         => asd_brp_get_the_user_ip(),
            'rating'     => 0.0,
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

        return $updated;
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
    public function get_rating( $args = [] ) {
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
    public function get_ratings( $args = [] ) {
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
}
