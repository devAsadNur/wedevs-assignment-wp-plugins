<?php

namespace Asd\Jobs\Search;

/**
 * Shortcode
 * handler class
 */
class Shortcode {

    /**
     * Initialize the class
     *
     * @since  1.0.0
     */
    public function __construct() {
        add_shortcode( 'asd-jobs-search', [ $this, 'render_search_form' ] );
    }

    /**
     * Jobs searching form renderer function
     *
     * @since  1.0.0
     *
     * @param array $atts
     *
     * @return void
     */
    public function render_search_form( $atts ) {
        $atts = shortcode_atts( apply_filters( 'asd-jobs-search-fields', [
            'keyword'  => '',
            'location' => '',
            'fulltime' => '',
        ] ), $atts );

        /**
         * Includes search form template
         */
        ob_start();
        include_once ASD_JOBS_SEARCH_PATH . '/templates/search_page_form.php';
        echo ob_get_clean();

        /**
         * Handover attributs to the search handler method
         */
        $this->jobs_search_handler( $atts );
    }

    /**
     * Jobs search handler function
     *
     * @since  1.0.0
     *
     * @param array $atts
     *
     * @return void
     */
    public function jobs_search_handler( $atts ) {
        /**
         * Form inputs from the user
         */
        $search_keyword  = isset( $_REQUEST['job-keyword'] ) ? sanitize_text_field( $_REQUEST['job-keyword'] ) : $atts['keyword'];
        $search_location = isset( $_REQUEST['job-location'] ) ? sanitize_text_field( $_REQUEST['job-location'] ) :  $atts['location'];
        $search_fulltime = isset( $_REQUEST['job-fulltime'] ) ? sanitize_text_field( $_REQUEST['job-fulltime'] ) : $atts['fulltime'];

        /**
         * Setting URL and arguments for fething data
         */
        $search_url  = 'https://jobs.github.com/positions.json?';
        $search_args = [
            'timeout' => 20,
        ];

        if ( '' !== $search_keyword ) {
            $search_url .= '&description=' . $search_keyword;
        }

        if ( '' !== $search_location ) {
            $search_url .= '&location=' . $search_location;
        }

        if ( '' !== $search_fulltime ) {
            $search_url .= '&full_time=' . $search_fulltime;
        }

        /**
         * URL for single job post fetching
         */
        if ( isset( $_REQUEST['job-id'] ) ) {
            $search_url = 'https://jobs.github.com/positions/' . $_REQUEST['job-id'] . '.json';
        }

        /**
         * Getting API response data
         */
        $search_result = $this->fetch_api_data( $search_url, $search_args );

        /**
         * Output message if no data found
         */
        if ( empty( $search_result ) ) {
            echo __( 'No jobs matched with your search!', 'asd-jobs-search' );
        }

        /**
         * Process output if the fetched data is multiple job postings
         */
        if ( is_array( $search_result ) ) {
            foreach ( $search_result as $single_job ) {
                include ASD_JOBS_SEARCH_PATH . '/templates/job_list_viewer.php';
            }
        }

        /**
         * Process output if the fetched data is a single job post
         */
        if ( is_object( $search_result ) ) {
            include_once ASD_JOBS_SEARCH_PATH . '/templates/single_job_viewer.php';
        }
    }

    /**
     * API data fetcher function
     *
     * @since 1.0.0
     *
     * @return array
     */
    public function fetch_api_data( $url, $args = [] ) {
        $response = wp_remote_get( $url , $args );
        $body     = wp_remote_retrieve_body( $response );
        $result   = json_decode( $body );

        return $result;
    }
}
