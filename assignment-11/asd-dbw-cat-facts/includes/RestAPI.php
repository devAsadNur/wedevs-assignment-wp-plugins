<?php

namespace Asd\Dbw\Cat\Facts;

/**
 * The Rest API
 * handler class
 */
class RestAPI {

    /**
     * URL for fetching data
     *
     * @since 1.0.0
     *
     * @var string
     */
    public $url;

    /**
     * Arguruments for fetching data
     *
     * @since 1.0.0
     *
     * @var string
     */
    public $args;

    /**
     * Cat facts fetcher function
     *
     * @since 1.0.0
     *
     * @return array
     */
    public function fetch_cat_facts() {
        // Assign value to the properties
        $this->url  = 'https://cat-fact.herokuapp.com/facts';
        $this->args = [
            'timeout' => 30,
        ];

        // Get response from cache
        $response = get_transient( 'cat_facts_data' );

        // Fetch data from API if not found in cache
        if ( false === $response ) {
            $response  = wp_remote_get( $this->url, $this->args );

            // Set data to cache
            set_transient( 'cat_facts_data', $response, DAY_IN_SECONDS );
        }

        // Process fetched data
        $body      = wp_remote_retrieve_body( $response );
        $cat_facts = json_decode( $body );

        return $cat_facts;
    }
}
