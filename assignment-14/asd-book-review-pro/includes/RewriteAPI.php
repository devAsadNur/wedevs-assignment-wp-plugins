<?php

namespace Asd\BookReviewPro;

/**
 * The rewrite API
 * handler class
 */
class RewriteAPI {

    /**
     * Initialize the class
     *
     * @since 1.0.0
     */
    public function __construct() {
        add_action( 'init', [ $this, 'rewrite_endpoint_handler' ] );
        add_filter( 'request', [ $this, 'rewrite_request_handler' ] );
        add_action( 'init', [ $this, 'rewirte_fush_handler' ] );

        // add_action( 'init', [ $this, 'rewrite_rules_handler' ] );
        // add_action( 'template_redirect', [ $this, 'template_redirect_handler' ] );
    }

    /**
     * Rewrite endpoint handler function
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function rewrite_endpoint_handler() {
        add_rewrite_endpoint( 'rating', EP_PERMALINK );
    }

    /**
     * Rewrite request handler function
     *
     * @since 1.0.0
     *
     * @param array $vars
     *
     * @return array
     */
    public function rewrite_request_handler( $vars ) {
        if ( isset( $vars['rating'] ) ) {
            $vars['rating'] = true;
        }

        return $vars;
    }

    /**
     *  Rewrite flush handler function
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function rewirte_fush_handler() {
        flush_rewrite_rules();
    }

    // public function rewrite_rules_handler() {
    //     add_rewrite_rule(
    //         'books\/([^\/]+)\/(rating)\/?\??([^\/]*)',
    //         'index.php/books/$matches[1]/$matches[3]',
    //         'top'
    //     );
    // }

    // public function template_redirect_handler() {
    //     // Code goes here
    // }
}
