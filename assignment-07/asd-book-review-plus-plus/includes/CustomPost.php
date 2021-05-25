<?php

namespace Asd\BookReviewPP;

/**
 * Custom post
 * handler class
 */
class CustomPost {

    /**
     * Initialize the class
     *
     * @since  1.0.0
     */
    public function __construct() {
        add_action( 'init', [ $this, 'custom_post_books' ] );
    }

    /**
     * Custom post type: Books, creator function
     *
     * @since  1.0.0
     *
     * @return void
     */
    public function custom_post_books() {
        /**
         * Labels array for custom post type: Books
         */
        $labels = apply_filters( 'br_post_type_books_labels', [
            'name'               => _x( 'Books', 'post type general name', 'asd-book-review-pp' ),
            'singular_name'      => _x( 'Book', 'post type singular name', 'asd-book-review-pp' ),
            'add_new'            => __( 'Add New', 'book', 'asd-book-review-pp' ),
            'add_new_item'       => __( 'Add New Book', 'asd-book-review-pp' ),
            'edit_item'          => __( 'Edit Book', 'asd-book-review-pp' ),
            'new_item'           => __( 'New Book', 'asd-book-review-pp' ),
            'all_items'          => __( 'All Books', 'asd-book-review-pp' ),
            'view_item'          => __( 'View Book', 'asd-book-review-pp' ),
            'search_items'       => __( 'Search Books', 'asd-book-review-pp' ),
            'not_found'          => __( 'No books found', 'asd-book-review-pp' ),
            'not_found_in_trash' => __( 'No books found in the Trash', 'asd-book-review-pp' ),
            'menu_name'          => __( 'Books', 'asd-book-review-pp' ),
        ] );

        /**
         * Arguments array for custom post type: Books
         */
        $args = apply_filters( 'br_post_type_books_args', [
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => array( 'slug' => 'books' ),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => null,
            'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
            'taxonomies'         => array( 'category' ),
            'show_in_rest'       => true,
            'menu_icon'          => 'dashicons-book',
        ] );

        /**
         * Register custom post type: Books
         */
        register_post_type( 'books', $args );
    }
}
