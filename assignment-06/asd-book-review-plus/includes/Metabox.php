<?php

namespace Asd\BookReviewPlus;

/**
 * Metabox
 * handler class
 */
class Metabox {

    /**
     * Book meta input fields
     *
     * @since 1.0.0
     *
     * @var array
     */
    public $book_meta_fields;

    /**
     * Book meta input values
     *
     * @since 1.0.0
     *
     * @var array
     */
    public $book_meta_values;

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
        $this->book_meta_values = get_post_meta( $post->ID, '_custom_book_meta_key', true );

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
        $this->book_meta_fields = apply_filters( 'metabox_book_input_data', array(
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
            $this->book_meta_fields['writter'] = sanitize_text_field($_POST['writter']);
        }
        if( isset( $_POST['isbn'] ) ) {
            $this->book_meta_fields['isbn'] = sanitize_text_field($_POST['isbn']);
        }
        if( isset( $_POST['year'] ) ) {
            $this->book_meta_fields['year'] = sanitize_text_field($_POST['year']);
        }
        if( isset( $_POST['price'] ) ) {
            $this->book_meta_fields['price'] = sanitize_text_field($_POST['price']);
        }
        if( isset( $_POST['description'] ) ) {
            $this->book_meta_fields['description'] = sanitize_textarea_field($_POST['description']);
        }

        /**
         * Update post meta
         */
        if ( ! empty( $this->book_meta_fields ) ) {
            update_post_meta(
                $post_id,
                '_custom_book_meta_key',
                $this->book_meta_fields
            );
        }
    }
}
