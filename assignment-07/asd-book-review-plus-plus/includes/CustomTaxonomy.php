<?php

namespace Asd\Book\Review\PP;

/**
 * Custom texonomy
 * handler class
 */
class CustomTaxonomy {

    /**
     * Initialize the class
     *
     * @since  1.0.0
     */
    public function __construct() {
        add_action( 'init', [ $this, 'custom_taxonomy_genre' ] );
    }

    /**
     * Custom taxonomy: Genre, creator function
     *
     * @since  1.0.0
     *
     * @return void
     */
    public function custom_taxonomy_genre() {
        /**
         * Labels array for custom taxonomy: Genre
         */
        $labels = apply_filters( 'abr_taxonomy_genre_labels', array(
            'name'              => _x( 'Genres', 'taxonomy general name', 'asd-book-review-pp' ),
            'singular_name'     => _x( 'Genre', 'taxonomy singular name', 'asd-book-review-pp' ),
            'search_items'      => __( 'Search Genres', 'asd-book-review-pp' ),
            'all_items'         => __( 'All Genres', 'asd-book-review-pp' ),
            'parent_item'       => __( 'Parent Genre', 'asd-book-review-pp' ),
            'parent_item_colon' => __( 'Parent Genre:', 'asd-book-review-pp' ),
            'edit_item'         => __( 'Edit Genre', 'asd-book-review-pp' ),
            'update_item'       => __( 'Update Genre', 'asd-book-review-pp' ),
            'add_new_item'      => __( 'Add New Genre', 'asd-book-review-pp' ),
            'new_item_name'     => __( 'New Genre Name', 'asd-book-review-pp' ),
            'menu_name'         => __( 'Genre', 'asd-book-review-pp' ),
        ) );

        /**
         * Arguments array for custom taxonomy: Genre
         */
        $args = apply_filters( 'abr_taxonomy_genre_args', array(
            'labels'            => $labels,
            'hierarchical'      => true,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'genre' ),
        ) );

        /**
         * Register custom taxonomy: Genre
         */
        register_taxonomy( 'genre', array( 'book' ), $args );
    }
}
