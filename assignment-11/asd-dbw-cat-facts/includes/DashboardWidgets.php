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
        // Get data from fetcher function
        $cat_facts = $this->fetch_cat_facts();

        // Output the processed data
        echo '<ol class="cat-facts-list">';

        foreach ( $cat_facts as $cat_fact ) {
            ?>
            <li class="cat-facts-item"><?php esc_html_e( $cat_fact->text, 'asd-dbw-cat-facts' ); ?></li>
            <?php
        }

        echo '</ol>';
    }

    /**
     * Cat facts fetcher function
     *
     * @since 1.0.0
     *
     * @return array
     */
    public function fetch_cat_facts( $limit = 5 ) {
        // API URL and arguments
        $url  = 'https://cat-fact.herokuapp.com/facts/random?animal_type=cat&amount=' . $limit;
        $args = [
            'timeout' => 30,
        ];

        // Get response from cache
        $response = get_transient( 'cat_facts_data' );

        // Fetch data from API if not found in cache
        if ( false === $response ) {
            $response  = wp_remote_get( $url, $args );

            // Set data to cache
            set_transient( 'cat_facts_data', $response, DAY_IN_SECONDS );
        }

        // Process fetched data
        $body      = wp_remote_retrieve_body( $response );
        $cat_facts = json_decode( $body );

        return $cat_facts;
    }
}
