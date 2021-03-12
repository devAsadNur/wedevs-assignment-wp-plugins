<?php

namespace AsdBookReview;

/**
 * Post Type
 * handler class
 */
class Posttype {

    /**
     * Initialize the class
     */
    public function __construct() {
        add_action( 'init', [ $this, 'custom_post_type_book' ] );
	}

	/**
	 * Custom post type creator function
	 *
	 * @return void
	 */
	public function custom_post_type_book() {
        $labels = array(
            'name'               => _x( 'Books', 'post type general name', 'asd-book-review' ),
            'singular_name'      => _x( 'Book', 'post type singular name' ),
            'add_new'            => _x( 'Add New', 'book', 'asd-book-review' ),
            'add_new_item'       => __( 'Add New Book', 'asd-book-review' ),
            'edit_item'          => __( 'Edit Book', 'asd-book-review' ),
            'new_item'           => __( 'New Book', 'asd-book-review' ),
            'all_items'          => __( 'All Books', 'asd-book-review' ),
            'view_item'          => __( 'View Book', 'asd-book-review' ),
            'search_items'       => __( 'Search Books', 'asd-book-review' ),
            'not_found'          => __( 'No books found', 'asd-book-review' ),
            'not_found_in_trash' => __( 'No books found in the Trash', 'asd-book-review' ),
            'parent_item_colon'  => '’',
            'menu_name'          => 'Books',
        );

        $args = array(
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
        );
        
        register_post_type( 'book', $args );
    }
}
