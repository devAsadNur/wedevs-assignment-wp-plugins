<?php

namespace Asd\Featured\Posts;

/**
 * The menu
 * handler
 * class
 */
class Menu {

    /**
     * Initialize the class
     *
     * @since  1.0.0
     */
    public function __construct() {
        add_action( 'admin_menu', [ $this, 'admin_menu_handler' ] );
    }

    /**
     * Register admin menu
     *
     * @since  1.0.0
     *
     * @return void
     */
    public function admin_menu_handler() {
        add_options_page( __( 'Set Featured Posts', 'asd-featured-posts' ), __( 'Featured Posts', 'asd-featured-posts' ), 'manage_options', 'featured-posts', [ $this, 'featured_posts_admin_page_handler' ] );
    }

    /**
     * Render the plugin page
     *
     * @since  1.0.0
     *
     * @return void
     */
    public function featured_posts_admin_page_handler() {
        /**
         * Removes transient in case of form update
         */
        if ( isset( $_POST['featured-posts-setting'] ) ) {
            delete_transient( 'featured_posts_query' );
        }

        /**
         * Removes transient in case of post update
         */
        add_action( 'publish_post', delete_transient( 'featured_posts_query' ) );

        /**
         * Includes admin page template
         */
        ob_start();
        require_once ASD_FEATURED_POSTS_PATH . "/templates/featured_posts_admin_page.php";
        echo ob_get_clean();
    }
}
