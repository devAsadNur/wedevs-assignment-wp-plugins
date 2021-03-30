<?php

namespace Asd\BookReviewPlus;

/**
 * Post Type: Book
 * handler class
 */
class CustomTaxonomyGenre {

    /**
     * Custom taxonomy args
     *
     * @since 1.0.0
     *
     * @var array
     */
    public $args;

    /**
    * Custom taxonomy labels
    *
    * @since 1.0.0
    *
    * @var array
    */
    public $labels;

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
        $this->labels = apply_filters( 'abrp_taxonomy_genre_labels', array(
            'name'              => _x( 'Genres', 'taxonomy general name', 'asd-book-review-plus' ),
            'singular_name'     => _x( 'Genre', 'taxonomy singular name', 'asd-book-review-plus' ),
            'search_items'      => __( 'Search Genres', 'asd-book-review-plus' ),
            'all_items'         => __( 'All Genres', 'asd-book-review-plus' ),
            'parent_item'       => __( 'Parent Genre', 'asd-book-review-plus' ),
            'parent_item_colon' => __( 'Parent Genre:', 'asd-book-review-plus' ),
            'edit_item'         => __( 'Edit Genre', 'asd-book-review-plus' ),
            'update_item'       => __( 'Update Genre', 'asd-book-review-plus' ),
            'add_new_item'      => __( 'Add New Genre', 'asd-book-review-plus' ),
            'new_item_name'     => __( 'New Genre Name', 'asd-book-review-plus' ),
            'menu_name'         => __( 'Genre', 'asd-book-review-plus' ),
        ) );

        /**
         * Arguments array for custom taxonomy: Genre
         */
        $this->args = apply_filters( 'abrp_taxonomy_genre_args', array(
            'labels'            => $this->labels,
            'hierarchical'      => true,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'genre' ),
        ) );

        /**
         * Register custom taxonomy: Genre
         */
        register_taxonomy( 'genre', array( 'book' ), $this->args );
    }
}
