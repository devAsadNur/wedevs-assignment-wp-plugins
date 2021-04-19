<?php

namespace Asd\BookReview;

/**
 * Metabox
 * handler class
 */
class Metabox {

    /**
     * Initialize the class
     *
     * @since 1.0.0
     */
    public function __construct() {
        add_action( 'add_meta_boxes', [ $this, 'books_custom_metabox_handler' ] );
        add_action( 'save_post', [ $this, 'books_metabox_update_metadata' ] );
    }

    /**
     * Metabox handler function
     *
     * @since 1.0.0
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
     * @since 1.0.0
     *
     * @param object $post
     *
     * @return void
     */
    public function books_metabox_content_handler( $post ) {
        /**
         * Fetched post meta
         */
        $book_meta_value_writter = get_post_meta( $post->ID, 'book_meta_key_writter', true );
        $book_meta_value_isbn    = get_post_meta( $post->ID, 'book_meta_key_isbn', true );
        $book_meta_value_year    = get_post_meta( $post->ID, 'book_meta_key_year', true );
        $book_meta_value_price   = get_post_meta( $post->ID, 'book_meta_key_price', true );
        $book_meta_value_desc    = get_post_meta( $post->ID, 'book_meta_key_description', true );

        /**
         * Include book metabox form template
         */
        ob_start();
        require_once ASD_BOOK_REVIEW_PATH . "/templates/metabox_book_form.php";
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
        $book_meta_fields = apply_filters( 'metabox_book_input_fields', array(
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
            $book_meta_fields['writter'] = sanitize_text_field($_POST['writter']);
        }
        if( isset( $_POST['isbn'] ) ) {
            $book_meta_fields['isbn'] = sanitize_text_field($_POST['isbn']);
        }
        if( isset( $_POST['year'] ) ) {
            $book_meta_fields['year'] = sanitize_text_field($_POST['year']);
        }
        if( isset( $_POST['price'] ) ) {
            $book_meta_fields['price'] = sanitize_text_field($_POST['price']);
        }
        if( isset( $_POST['description'] ) ) {
            $book_meta_fields['description'] = sanitize_textarea_field($_POST['description']);
        }

        /**
         * Update post meta
         */
        foreach ( $book_meta_fields as $field_key => $field_value ) {
            update_post_meta(
                $post_id,
                'book_meta_key_' . $field_key,
                $field_value,
            );
        }
    }
}
