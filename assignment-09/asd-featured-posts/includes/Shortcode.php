<?php

namespace Asd\Featured\Posts;

/**
 * Shortcode
 * handler class
 */
class Shortcode {

    /**
     * Initialize the class
     *
     * @since  1.0.0
     */
    public function __construct() {
        add_shortcode( 'asd-featured-posts', [ $this, 'render_featured_posts' ] );
    }

    /**
     * Featured posts
     * renderer function
     *
     * @since  1.0.0
     *
     * @param array $atts
     *
     * @return void
     */
    public function render_featured_posts( $atts ) {

        /**
         * Get featured posts settings from database
         */
        $fp_limit = get_option( 'featured_posts_limit' );
        $fp_order = get_option( 'featured_posts_order' );
        $fp_cats = implode( ',', get_option( 'featured_posts_categories' ) );

        /**
         * Shortcode attributes array
         */
        $atts = shortcode_atts( apply_filters( 'asd_fp_sc_atts', [
            'limit'      => $fp_limit,
            'order'      => $fp_order,
            'categories' => $fp_cats,
        ] ), $atts );

        /**
         * Arguments array for posts query
         */
        $args = [
            'post_type'      => 'post',
            'post_status'    => 'publish',
            'posts_per_page' => (int)$atts['limit'],
            'category_name'  => $atts['categories'],
        ];

        /**
         * Set conditional arguments
         */
        if ( 'rand' === $atts['order'] ) {
            $args['orderby'] = 'rand';

            /**
             * Removes cache in case of random posts selected
             */
            delete_transient( 'featured_posts_query' );
        } else {
            $args['order'] = $atts['order'];
        }

        /**
         * Posts query object
         */
        $objQuery = new Query();
        $posts = $objQuery->get_posts( $args );

        if ( ! is_array( $posts) ) {
            echo $posts;
        } else {
            /**
             * Action hook for adding contents
             * before featured posts wrapper
             *
             * @since 1.0.0
             */
            do_action( 'asd_sc_featured_posts_before' );

            /**
             * Featured posts wrapper
             *
             * @since 1.0.0
             */
            echo '<div class="featured-posts-wrapper">';
            foreach ($posts as $post) {
                ob_start();
                include ASD_FEATURED_POSTS_PATH . '/templates/featured_posts_shortcode.php';
                echo ob_get_clean();
            }
            echo '</div>';

            /**
             * Action hook for adding contents
             * after featured posts wrapper
             *
             * @since 1.0.0
             */
            do_action( 'asd_sc_featured_posts_after' );
        }
    }
}
