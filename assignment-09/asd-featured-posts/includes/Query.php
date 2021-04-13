<?php

namespace Asd\Featured\Posts;

/**
 * Query
 * handler
 * class
 */
class Query {

    public function get_posts( $args ) {
        // Get any existing copy of our transient data
        if ( false === ( $featured_posts_query = get_transient( 'featured_posts_query' ) ) ) {
            // It wasn't there, so regenerate the data and save the transient
            $featured_posts_query = new \WP_Query( $args );
            set_transient( 'featured_posts_query', $featured_posts_query );
        }

        if ( ! $featured_posts_query->have_posts() ) {
            return __( 'No post found!', 'asd-featured-posts' );
        }

        return $featured_posts_query->posts;
    }

    // public function get_posts( $args ) {
    //     $featured_posts_query = new \WP_Query( $args );

    //     if ( ! $featured_posts_query->have_posts() ) {
    //         return __( 'No post found!', 'asd-featured-posts' );
    //     }

    //     return $featured_posts_query->posts;
    // }
}
