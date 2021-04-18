<?php

namespace Asd\Dbw\Recent\Posts;

/**
 * The dashboard widgets
 * handler class
 */
class DashboardWidgets {

    /**
     * Initialize the class
     *
     * @since  1.0.0
     */
    public function __construct() {
        add_action( 'wp_dashboard_setup', [ $this, 'dashboard_widgets_handler' ] );
    }

    /**
     * Dashboard widget handler function
     *
     * @since  1.0.0
     *
     * @return void
     */
    public function dashboard_widgets_handler() {
        wp_add_dashboard_widget( 'recent_posts_db_widget', 'Recent Posts List', [ $this, 'render_posts_list_cb' ], [ $this, 'configure_posts_list_cb' ] );
    }

    /**
     * Recent posts widget renderer function
     *
     * @since  1.0.0
     *
     * @return void
     */
    public function render_posts_list_cb() {
        // Get recent post config from option table and assign defult configs
        $rp_limit    = ! empty( get_option( 'recent_posts_limit' ) ) ? get_option( 'recent_posts_limit' ) : 5;
        $rp_order    = ! empty( get_option( 'recent_posts_order' ) ) ? get_option( 'recent_posts_order' ) : 'DESC';
        $rp_cats_arr = ! empty( get_option( 'recent_posts_cats' ) ) ? get_option( 'recent_posts_cats' ) : [];
        $rp_cats     = implode( ',', $rp_cats_arr );

        // Arguments for post fetching
        $rp_args = [
            'numberposts'   => $rp_limit,
            'category_name' => $rp_cats,
        ];

        // Add conditional arguments
        if ( 'rand' === $rp_order ) {
            $rp_args['orderby'] = 'rand';
        } else {
            $rp_args['order'] = $rp_order;
        }

        // Get recent posts
        $recent_posts = wp_get_recent_posts( $rp_args );

        // Looping through each of the posts and show output
        foreach ( $recent_posts as $recent_post ) {
            ?>
            <h3><a href="<?php echo esc_url( $recent_post['guid'] ); ?>"><?php esc_html_e( $recent_post['post_title'], 'asd-dbw-recent-posts' ); ?></a></h3>
            <?php
        }
    }

    /**
     * Recent posts widget configure function
     *
     * @since  1.0.0
     *
     * @return void
     */
    public function configure_posts_list_cb() {
        // Get recent post config from option table
        $current_limit    = ! empty( get_option( 'recent_posts_limit' ) ) ? get_option( 'recent_posts_limit' ) : '';
        $current_order    = ! empty( get_option( 'recent_posts_order' ) ) ? get_option( 'recent_posts_order' ) : '';
        $current_cats_arr = ! empty( get_option( 'recent_posts_cats' ) ) ? get_option( 'recent_posts_cats' ) : [];
        $all_cats_arr     = get_categories();

        // Include text input fields template file
        ob_start();
        include_once ASD_DBW_RECENT_POSTS_PATH . '/templates/dbw_text_fields.php';
        echo ob_get_clean();

        // Looping through each categoires
        foreach ( $all_cats_arr as $cat ) {
            $cat_name    = isset( $cat->name ) ? $cat->name : '';
            $cat_slug    = isset( $cat->slug ) ? $cat->slug : '';
            $current_cat = isset( $current_cats_arr[$cat_slug] ) ? $cat_name : '';

            // Include checkbox input fields template file
            ob_start();
            include ASD_DBW_RECENT_POSTS_PATH . '/templates/dbw_checkbox_fields.php';
            echo ob_get_clean();
        }

        // Update user defined post configs to the option table
        $this->option_update_handler( 'recent_posts_limit' );
        $this->option_update_handler( 'recent_posts_order' );
        $this->option_update_handler( 'recent_posts_cats' );
    }

    /**
     * Option field updater function
     *
     * @since  1.0.0
     *
     * @param string $key
     *
     * @return boolean
     */
    public function option_update_handler( $key ) {
        if ( isset( $_POST[$key] ) ) {
            update_option( $key, $_POST[$key] );
        }
    }
}
