<?php

namespace Asd\RestApiCrud;

/**
 * The API
 * handler
 * class
 */
class API {

    /**
     * Initialize the class
     *
     * @since 1.0.0
     */
    public function __construct() {
        add_action( 'rest_api_init', [ $this, 'register_api' ] );
    }

    /**
     * Register REST API
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function register_api() {
        $products = new API\Products();
        $products->register_routes();
    }
}
