<?php

namespace Asd\BookReviewPlus;

/**
 * Metabox
 * handler class
 */
class Metabox {

    /**
     * Initialize the class
     *
     * @since  1.0.0
     */
    public function __construct() {
        add_action( 'add_meta_boxes', [ $this, 'books_custom_metabox_handler' ] );
        add_action( 'save_post', [ $this, 'books_metabox_update_metadata' ] );
    }

    /**
     * Metabox handler function
     *
     * @since  1.0.0
     *
     * @return void
     */
    public function books_custom_metabox_handler() {
        add_meta_box(
            'books_custom_meta_box',
            'Book Details',
            [ $this, 'books_metabox_content_handler' ],
            'book',
        );
    }

    /**
     * Custom post metadata getter function
     *
     * @since  1.0.0
     *
     * @param  object $post
     *
     * @return void
     */
    public function books_metabox_content_handler( $post ) {
		/**
		 * Fetched post meta
		 */
        $book_values = get_post_meta( $post->ID, '_custom_book_meta_key', true );

		/**
		 * Include book metabox form template
		 */
        ob_start();
		require_once ASD_BOOK_REVIEW_PLUS_PATH . "/templates/metabox_book_form.php";
        echo ob_get_clean();
    }

    /**
     * Custom post metadata setter function
     *
     * @since  1.0.0
     *
     * @param int $post_id
     *
     * @return void
     */
    public function books_metabox_update_metadata( $post_id ) {
		/**
		 * Assign empty value to the input array keys
		 */
        $meta_inputs = apply_filters( 'metabox_book_input_data', array(
            'writter'        => '',
            'isbn'           => '',
            'year'           => '',
            'price'          => '',
            'description'    => '',
		) );

		/**
		 * Assign input values to the meta input array
		 */
        if( isset( $_POST['writter'] ) ) {
            $meta_inputs['writter'] = sanitize_text_field($_POST['writter']);
        }
        if( isset( $_POST['isbn'] ) ) {
            $meta_inputs['isbn'] = sanitize_text_field($_POST['isbn']);
        }
        if( isset( $_POST['year'] ) ) {
            $meta_inputs['year'] = sanitize_text_field($_POST['year']);
        }
        if( isset( $_POST['price'] ) ) {
            $meta_inputs['price'] = sanitize_text_field($_POST['price']);
        }
        if( isset( $_POST['description'] ) ) {
            $meta_inputs['description'] = sanitize_textarea_field($_POST['description']);
        }

		/**
		 * Update post meta
		 */
        if ( ! empty($meta_inputs) ) {
            update_post_meta(
                $post_id,
                '_custom_book_meta_key',
                $meta_inputs
            );
        }
    }
}
