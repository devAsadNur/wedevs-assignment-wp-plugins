<?php

namespace Asd\BookReviewPro;

/**
 * Assets
 * handler class
 */
class Ajax {

    /**
     * Initialize the class
     *
     * @since  1.0.0
     */
    public function __construct() {
        add_action( 'wp_ajax_asd-book-rating', [ $this, 'book_rating_request_handler' ] );
        add_action( 'wp_ajax_nopriv_asd-book-rating', [ $this, 'book_rating_request_handler' ] );
    }

    /**
     * Book rating AJAX hanler function for logged in user
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function book_rating_request_handler() {
        if ( ! is_user_logged_in() ) {
            wp_send_json_error( [
                'message' => __( 'Please login first to give rating!', 'asd-book-review-pro' ),
            ] );
        }

        if ( ! isset( $_REQUEST['_ajax_nonce'] ) || ! wp_verify_nonce( $_REQUEST['_ajax_nonce'], 'book-review-nonce' ) ) {
            wp_send_json_error( [
                'message' => __( 'Nonce verification failed!', 'asd-book-review-pro' ),
            ] );
        }

        if ( ! isset( $_REQUEST['rating'] ) ) {
            wp_send_json_error( [
                'message' => __( 'Rating can\'t be empty!', 'asd-book-review-pro' ),
            ] );
        }

        if ( ! isset( $_REQUEST['post_id'] ) ) {
            wp_send_json_error( [
                'message' => __( 'Post ID can\'t be empty!', 'asd-book-review-pro' ),
            ] );
        }

        $args = [
            'post_id' => (int) $_REQUEST['post_id'],
            'rating'  => (float) $_REQUEST['rating'],
        ];

        if ( ! empty( $_REQUEST['rating_id'] ) ) {
            $args['id'] = (int) $_REQUEST['rating_id'];

            $rating_updated = asd_br_update_rating( $args );

            if ( is_wp_error( $rating_updated ) ) {
                wp_send_json_error( [
                    'message' => $rating_updated->get_error_message(),
                ] );
            }

            wp_send_json_success( [
                'message' => __( 'Rating updated successfully!', 'asd-book-review-pro' ),
            ] );
        } else {
            $insert_id = asd_br_insert_rating( $args );

            if ( is_wp_error( $insert_id ) ) {
                wp_send_json_error( [
                    'message' => $insert_id->get_error_message(),
                ] );
            }

            wp_send_json_success( [
                'message' => __( 'Rating added successfully!', 'asd-book-review-pro' ),
                'rating_id' => (int) $insert_id,
            ] );
        }
    }
}
