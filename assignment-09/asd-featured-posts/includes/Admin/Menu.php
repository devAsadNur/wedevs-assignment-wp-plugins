<?php

namespace Asd\FeaturedPosts\Admin;

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
        $settings_page    = isset( $_REQUEST['page'] ) ? sanitize_key( $_REQUEST['page'] ): '';
        $settings_updated = isset( $_REQUEST['settings-updated'] ) ? rest_sanitize_boolean( $_REQUEST['settings-updated'] ) : false;

        // Removes transient on featured posts settings update
        if ( ( 'featured-posts' === $settings_page ) && $settings_updated ) {
            asd_fp_delete_transient();
        }

        // Includes admin page template
        ob_start();
        require_once ASD_FEATURED_POSTS_PATH . "/templates/admin/featured_posts_settings_page.php";
        echo ob_get_clean();
    }
}
