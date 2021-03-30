<?php

namespace Asd\BookReviewPlus;

/**
 * Shortcode
 * handler class
 */
class Shortcode {

    /**
     * Book post meta search keyword
     *
     * @since 1.0.0
     *
     * @var string
     */
    public $search_keyword;

    /**
     * Book post meta query arguments
     *
     * @since 1.0.0
     *
     * @var array
     */
    public $book_meta_query_args;

    /**
     * Book post meta query result
     *
     * @since 1.0.0
     *
     * @var object
     */
    public $book_meta_query;

    /**
     * Initialize the class
     *
     * @since  1.0.0
     */
    public function __construct() {
        add_shortcode( 'asd-book-post-meta-search', [ $this, 'render_shortcode_form' ] );
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
        require_once ASD_BOOK_REVIEW_PLUS_PATH . "/templates/shortcode_search_form.php";
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
     * @since  1.0.0
     *
     * @return void
     */
    public function post_meta_search_handler() {
        if ( ! isset( $_REQUEST['book-post-meta-search'] ) ) {
            return;
        }

        if ( ! wp_verify_nonce( $_REQUEST['_wpnonce'], 'book-post-meta-search' ) ) {
            wp_die( 'Are you cheating?' );
        }

        if ( ! isset( $_REQUEST['keyword'] ) ) {
            return;
        }

        /**
         * Search input from user
         */
        $this->search_keyword = $_GET['keyword'];

        /**
         * Book meta query arguments
         */
        $this->book_meta_query_args = apply_filters( 'abrp_book_meta_query_args', array(
            'post_type'   => 'book',
            'post_status' => 'publish',
            'meta_query'  => array(
                array(
                    'key'     => '_custom_book_meta_key',
                    'value'   => $this->search_keyword,
                    'compare' => 'LIKE',
                ),
            ),
        ) );

        /**
         * The book meta query
         */
        $this->book_meta_query = new \WP_Query( $this->book_meta_query_args );

        /**
         * Show output if found
         */
        if ( $this->book_meta_query->have_posts() ) {
            /**
             * Fetched all posts
             */
            $posts = $this->book_meta_query->posts;

            /**
             * Single post
             */
            foreach( $posts as $post ) {
                /**
                 * Include search result viewer
                 */
                ob_start();
                include ASD_BOOK_REVIEW_PLUS_PATH . "/templates/shortcode_search_result_viewer.php";
                echo ob_get_clean();
            }
        } else {
            echo __( 'No post matched with your query!', 'asd-book-review-plus' );
        }
    }
}
