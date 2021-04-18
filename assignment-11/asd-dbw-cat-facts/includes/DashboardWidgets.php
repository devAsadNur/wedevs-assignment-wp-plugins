<?php

namespace Asd\Dbw\Cat\Facts;

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
     * Dashboard widgets handler function
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function dashboard_widgets_handler() {
        wp_add_dashboard_widget( 'cat_facts_db_widget', 'Amazing Cat Facts', [ $this, 'render_cat_facts_widget' ] );
    }

    /**
     * Cat facts widger renderer function
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function render_cat_facts_widget() {
        // Create instance and get data from RestAPI class
        $obj_rest_api = new RestAPI();
        $cat_facts = $obj_rest_api->fetch_cat_facts();

        // Output the processed data
        echo '<ol class="cat-facts-list">';
        foreach ( $cat_facts as $cat_fact ) {
            ?>
            <li class="cat-facts-item"><?php esc_html_e( $cat_fact->text, 'asd-dbw-cat-facts' ); ?></li>
            <?php
        }
        echo '</ol>';
    }
}
