<?php

namespace Asd\BookReviewPP;

/**
 * Shortcode
 * handler class
 */
class Shortcode {

    /**
     * Initialize the class
     *
     * @since 1.0.0
     */
    public function __construct() {
        add_shortcode( 'asd-book-review-search', [ $this, 'render_shortcode_form' ] );
    }

    /**
     * Shortcode renderer function
     *
     * @since  1.0.0
     *
     * @return void
     */
    public function render_shortcode_form() {

        /**
         * Include search form template
         */
        ob_start();
        require_once ASD_BOOK_REVIEW_PP_PATH . "/templates/shortcode_search_form.php";
        echo ob_get_clean();

        /**
         * Call post meta search
         * handler method
         */
        $this->post_meta_search_handler();
    }

    /**
     * Post meta search handler function
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function post_meta_search_handler() {
        /**
         * Search input from user
         */
        $search_keyword = isset( $_REQUEST['keyword'] ) ? sanitize_text_field( $_REQUEST['keyword'] ) : '';

        /**
         * Conditional checkings
         */
        if ( ! isset( $_REQUEST['br-meta-search-submit'] ) ) {
            return;
        }

        if ( ! isset( $_REQUEST['_wpnonce_br_search'] ) || ! wp_verify_nonce( $_REQUEST['_wpnonce_br_search'], 'book-review-search' ) ) {
            wp_die( 'Nonce verification failed!' );
        }

        if ( empty( $search_keyword ) ) {
            return;
        }

        /**
         * Book meta query arguments
         */
        $book_meta_query_args = apply_filters( 'abr_book_meta_query_args', array(
            'post_type'   => 'books',
            'post_status' => 'publish',
            'meta_query'  => array(
                'relation' => 'OR',
                array(
                    'key'     => 'book_meta_key_writter',
                    'value'   => $search_keyword,
                    'compare' => 'LIKE',
                ),
                array(
                    'key'     => 'book_meta_key_isbn',
                    'value'   => $search_keyword,
                    'compare' => 'LIKE',
                ),
                array(
                    'key'     => 'book_meta_key_year',
                    'value'   => $search_keyword,
                    'compare' => 'LIKE',
                ),
                array(
                    'key'     => 'book_meta_key_price',
                    'value'   => $search_keyword,
                    'compare' => 'LIKE',
                ),
                array(
                    'key'     => 'book_meta_key_description',
                    'value'   => $search_keyword,
                    'compare' => 'LIKE',
                ),
            ),
        ) );

        /**
         * Call post meta qeury
         * handler method
         */
        $this->post_meta_query_handler( $book_meta_query_args );
    }

    /**
     * Post meta query handler function
     *
     * @since 1.0.0
     *
     * @param array $query_args
     *
     * @return void
     */
    public function post_meta_query_handler( $query_args) {
        /**
         * The book meta query
         */
        $book_meta_query = new \WP_Query( $query_args );

        /**
         * Show output if found
         */
        if ( $book_meta_query->have_posts() ) {
            while ( $book_meta_query->have_posts() ) {
                $book_meta_query->the_post();

                /**
                 * Include search result viewer template
                 */
                ob_start();
                include ASD_BOOK_REVIEW_PP_PATH . "/templates/shortcode_search_result_viewer.php";
                echo ob_get_clean();
            }
        } else {
            echo __( 'No book review matched with your query!', 'asd-book-review-pp' );
        }

        /**
         * Restore original Post Data
         */
        wp_reset_postdata();
    }
}
