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
        add_action( 'wp_ajax_nopriv_asd-book-rating', [ $this, 'book_rating_frontend_handler' ] );
    }

    /**
     * Book rating AJAX hanler function for logged in user
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function book_rating_request_handler() {
        if ( ! wp_verify_nonce( $_REQUEST['_ajax_nonce'], 'book-review-nonce' ) ) {
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
            'post_id' => $_REQUEST['post_id'],
            'rating'  => $_REQUEST['rating'],
        ];

        if ( '' !== $_REQUEST['rating_id'] ) {
            $args['id'] = $_REQUEST['rating_id'];

            asd_br_update_rating( $args );
            wp_send_json_success( [
                'message' => __( 'Rating updated successfully!', 'asd-book-review-pro' ),
            ] );
        } else {
            $insert_id = asd_br_insert_rating( $args );

            wp_send_json_success( [
                'message' => __( 'Rating added successfully!', 'asd-book-review-pro' ),
                'rating_id' => $insert_id,
            ] );
        }

        wp_send_json_error( [
            'message' => __(  'Request failed!', 'asd-book-review-pro' ),
        ] );
    }

    /**
     * Book rating AJAX hanler function for non-logged in user
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function book_rating_frontend_handler() {
        wp_send_json_error( [
            'message' => __( 'Please login in first in order to give rating!', 'asd-book-review-pro' ),
        ] );
    }
}
