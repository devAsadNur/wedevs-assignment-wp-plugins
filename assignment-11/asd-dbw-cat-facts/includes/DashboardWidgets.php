<?php

namespace Asd\DbwCatFacts;

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
        wp_add_dashboard_widget(
            'cat_facts_db_widget',
            __( 'Amazing Cat Facts', 'asd-dbw-recent-posts' ),
            [ $this, 'render_cat_facts_widget_cb' ]
        );
    }

    /**
     * Cat facts widger renderer function
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function render_cat_facts_widget_cb() {
        // Get API data from fetcher function
        $cat_facts = $this->fetch_cat_facts();

        // Output the fetched data
        if ( is_array( $cat_facts ) ) {
            // Include cat facts output template
            ob_start();
            include_once ASD_CAT_FACTS_PATH . '/templates/dbw_cat_facts_output.php';
            echo ob_get_clean();
        } else {
            echo __( 'No contents found', 'asd-dbw-cat-facts' );
        }
    }

    /**
     * Cat facts fetcher function
     *
     * @since 1.0.0
     *
     * @return array|object
     */
    public function fetch_cat_facts( $limit = 5 ) {
        // API URL and arguments
        $url  = 'https://cat-fact.herokuapp.com/facts/random?animal_type=cat&amount=' . (int) $limit;
        $args = [
            'timeout' => 30,
        ];

        // Get response from cache
        $response = get_transient( 'cat_facts_data' );

        // Fetch data from API if not found in cache
        if ( empty( $response ) ) {
            $response  = wp_remote_get( $url, $args );

            // Set fetched data to cache
            set_transient( 'cat_facts_data', $response, DAY_IN_SECONDS );
        }

        // Process fetched data
        $body      = wp_remote_retrieve_body( $response );
        $cat_facts = json_decode( $body );

        return $cat_facts;
    }
}
