<?php

namespace Asd\Author\Box;

/**
 * The author box
 * handler class
 */
class AuthorBox {

    /**
     * Initializes the class
     *
     * @since 1.0.0
     */
    public function __construct() {
        add_filter( 'the_content', [ $this, 'author_box_handler' ] );
    }

    /**
     * Author box handler function
     *
     * @since 1.0.0
     *
     * @param string $content
     *
     * @return string
     */
    public function author_box_handler( $content ) {
        global $post;
        $author_id = isset( $post ) ? (int) $post->post_author : 0;

        $author_fname    = get_user_meta( $author_id, 'first_name', true );
        $author_lname    = get_user_meta( $author_id, 'last_name', true );
        $author_bio      = get_user_meta( $author_id, 'description', true );
        $author_facebook = get_user_meta( $author_id, 'facebook', true );
        $author_twitter  = get_user_meta( $author_id, 'twitter', true );
        $author_linkedin = get_user_meta( $author_id, 'linkedin', true );
        $author_name     = $author_fname . ' ' . $author_lname;

        if ( 'post' !== $post->post_type && ! is_single() ) {
            return $content;
        }

        wp_enqueue_style( 'asd-author-box-style' );

        ob_start();
        include_once ASD_AUTHOR_BOX_PATH . '/templates/author_box.php';

        $author_box = ob_get_clean();

        return $content . $author_box;
    }
}
