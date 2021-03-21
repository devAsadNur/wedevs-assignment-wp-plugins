<?php

namespace Asd\BookReviewPlus;

/**
 * Post Type: Book
 * handler class
 */
class CustomPostBook {

    /**
     * Initialize the class
     *
     * @since  1.0.0
     */
    public function __construct() {
        add_action( 'init', [ $this, 'custom_post_type_book' ] );
    }

    /**
     * Custom post type: Book, creator function
     *
     * @since  1.0.0
     *
     * @return void
     */
    public function custom_post_type_book() {
        /**
         * Labels array for custom post type: Book
         */
        $labels = apply_filters( 'abrp_post_type_book_labels', array(
            'name'               => _x( 'Books', 'post type general name', 'asd-book-review-plus' ),
            'singular_name'      => _x( 'Book', 'post type singular name', 'asd-book-review-plus' ),
            'add_new'            => _x( 'Add New', 'book', 'asd-book-review-plus' ),
            'add_new_item'       => __( 'Add New Book', 'asd-book-review-plus' ),
            'edit_item'          => __( 'Edit Book', 'asd-book-review-plus' ),
            'new_item'           => __( 'New Book', 'asd-book-review-plus' ),
            'all_items'          => __( 'All Books', 'asd-book-review-plus' ),
            'view_item'          => __( 'View Book', 'asd-book-review-plus' ),
            'search_items'       => __( 'Search Books', 'asd-book-review-plus' ),
            'not_found'          => __( 'No books found', 'asd-book-review-plus' ),
            'not_found_in_trash' => __( 'No books found in the Trash', 'asd-book-review-plus' ),
            'parent_item_colon'  => '’',
            'menu_name'          => 'Books',
        ) );

        /**
         * Arguments array for custom post type: Book
         */
        $args = apply_filters( 'abrp_post_type_book_args', array(
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => array( 'slug' => 'book' ),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => null,
            'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
            'taxonomies'         => array( 'category' ),
            'show_in_rest'       => true,
            'menu_icon'          => 'dashicons-book',
        ) );

        /**
         * Register custom post type: Book
         */
        register_post_type( 'book', $args );
    }
}
