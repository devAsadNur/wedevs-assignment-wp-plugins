<?php

namespace Asd\RestApiCrud\API;

use WP_REST_Controller;
use WP_REST_Server;
use WP_Error;

/**
 * Products API handler class
 */
class Products extends WP_REST_Controller {

    /**
     * Initialize the class
     *
     * @since 1.0.0
     */
    public function __construct() {
        $this->namespace = 'asd/v1';
        $this->rest_base = 'products';
    }

    /**
     * Registers the routes for the objects of the controller.
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function register_routes() {
        register_rest_route(
            $this->namespace,
            '/' . $this->rest_base,
            [
                [
                    'methods'             => WP_REST_Server::READABLE,
                    'callback'            => [ $this, 'get_items' ],
                    'permission_callback' => [ $this, 'get_items_permissions_check' ],
                    'args'                => $this->get_collection_params(),
                ],
                [
                    'methods'             => WP_REST_Server::CREATABLE,
                    'callback'            => [ $this, 'create_item' ],
                    'permission_callback' => [ $this, 'create_item_permissions_check' ],

                ],
                'schema' => [ $this, 'get_item_schema' ],
            ]
        );

        register_rest_route(
            $this->namespace,
            '/' . $this->rest_base . '/(?P<id>[\d]+)',
            [
                'args' => [
                    'id' => [
                        'description' => __( 'Unique identifier for the object.' ),
                        'type'        => 'integer',
                    ],
                ],
                [
                    'methods'             => WP_REST_Server::READABLE,
                    'callback'            => [ $this, 'get_item' ],
                    'permission_callback' => [ $this, 'get_item_permissions_check' ],
                    'args'                => [
                        'context' => $this->get_context_param( [ 'default' => 'view' ] ),
                    ],
                ],
                [
                    'methods'             => WP_REST_Server::EDITABLE,
                    'callback'            => [ $this, 'update_item' ],
                    'permission_callback' => [ $this, 'update_item_permissions_check' ],
                    'args'                => $this->get_endpoint_args_for_item_schema( WP_REST_Server::EDITABLE ),
                ],
                [
                    'methods'             => WP_REST_Server::DELETABLE,
                    'callback'            => [ $this, 'delete_item' ],
                    'permission_callback' => [ $this, 'delete_item_permissions_check' ],
                ],
                'schema' => [ $this, 'get_item_schema' ],
            ]
        );
    }

    /**
     * Checks if a given request has access to read contacts.
     *
     * @since 1.0.0
     *
     * @param \WP_REST_Request $request
     *
     * @return boolean
     */
    public function get_items_permissions_check( $request ) {
        if ( current_user_can( 'manage_options' ) ) {
            return true;
        }

        return false;
    }

    /**
     * Retrieves a list of address items.
     *
     * @since 1.0.0
     *
     * @param \WP_Rest_Request $request
     *
     * @return \WP_Rest_Response|WP_Error
     */
    public function get_items( $request ) {
        $args   = [];
        $params = $this->get_collection_params();

        foreach ( $params as $key => $value ) {
            if ( isset( $request[$key] ) ) {
                $args[$key] = $request[$key];
            }
        }

        // change `per_page` to `number`
        $args['number'] = $args['per_page'];
        $args['offset'] = ( $args['page'] - 1 ) * $args['number'];

        // unset others
        unset( $args['per_page'] );
        unset( $args['page'] );

        $data     = [];
        $products = asd_rest_get_products( $args );

        foreach ( $products as $product ) {
            $response = $this->prepare_item_for_response( $product, $request );
            $data[]   = $this->prepare_response_for_collection( $response );
        }

        $total     = asd_rest_products_count();
        $max_pages = ceil( $total / (int) $args['number'] );

        $response = rest_ensure_response( $data );

        $response->header( 'X-WP-Total', (int) $total );
        $response->header( 'X-WP-TotalPages', (int) $max_pages );

        return $response;
    }

    /**
     * Get the product, if the ID is valid.
     *
     * @since 1.0.0
     *
     * @param int $id Supplied ID.
     *
     * @return Object|\WP_Error
     */
    protected function get_product( $id ) {
        $product = asd_rest_get_product( $id );

        if ( ! $product ) {
            return new WP_Error(
                'rest_product_invalid_id',
                __( 'Invalid product ID.' ),
                [ 'status' => 404 ]
            );
        }

        return $product;
    }

    /**
     * Checks if a given request has access to get a specific item.
     *
     * @since 1.0.0
     *
     * @param \WP_REST_Request $request
     *
     * @return \WP_Error|bool
     */
    public function get_item_permissions_check( $request ) {
        if ( ! current_user_can( 'manage_options' ) ) {
            return false;
        }

        $product = $this->get_product( $request['id'] );

        if ( is_wp_error( $product ) ) {
            return $product;
        }

        return true;
    }

    /**
     * Retrieves one item from the collection.
     *
     * @since 1.0.0
     *
     * @param \WP_REST_Request $request
     *
     * @return \WP_Error|\WP_REST_Response
     */
    public function get_item( $request ) {
        $product = $this->get_product( $request['id'] );

        $response = $this->prepare_item_for_response( $product, $request );
        $response = rest_ensure_response( $response );

        return $response;
    }

    /**
     * Checks if a given request has access to create items.
     *
     * @since 1.0.0
     *
     * @param WP_REST_Request $request
     *
     * @return WP_Error|bool
     */
    public function create_item_permissions_check( $request ) {
        return $this->get_items_permissions_check( $request );
    }

    /**
     * Creates one item from the collection.
     *
     * @since 1.0.0
     *
     * @param \WP_REST_Request $request
     *
     * @return \WP_Error|WP_REST_Response
     */
    public function create_item( $request ) {
        $product = $this->prepare_item_for_database( $request );

        if ( is_wp_error( $product ) ) {
            return $product;
        }

        $product_id = asd_rest_insert_product( $product );

        if ( is_wp_error( $product_id ) ) {
            $product_id->add_data( [ 'status' => 400 ] );
        }

        $product = $this->get_product( $product_id );
        $response = $this->prepare_item_for_response( $product, $request );

        $response->set_status( 201 );
        $response->header( 'Location', rest_url( sprintf( '%s/%s/%d', $this->namespace, $this->rest_base, $product_id ) ) );

        return rest_ensure_response( $response );
    }

    /**
     * Checks if a given request has access to update a specific item.
     *
     * @since 1.0.0
     *
     * @param \WP_REST_Request $request Full data about the request.
     *
     * @return \WP_Error|bool
     */
    public function update_item_permissions_check( $request ) {
        return $this->get_item_permissions_check( $request );
    }

    /**
     * Updates one item from the collection.
     *
     * @since 1.0.0
     *
     * @param \WP_REST_Request $request
     *
     * @return \WP_Error|\WP_REST_Response
     */
    public function update_item( $request ) {
        $product  = $this->get_product( $request['id'] );
        $prepared = $this->prepare_item_for_database( $request );

        $prepared = array_merge( (array) $product, $prepared );

        $updated = asd_rest_update_product( $prepared );

        if ( ! $updated ) {
            return new WP_Error(
                'rest_not_updated',
                __( 'Sorry, the address could not be updated.' ),
                [ 'status' => 400 ]
            );
        }

        $product  = $this->get_product( $request['id'] );
        $response = $this->prepare_item_for_response( $product, $request );

        return rest_ensure_response( $response );
    }

    /**
     * Checks if a given request has access to delete a specific item.
     *
     * @since 1.0.0
     *
     * @param \WP_REST_Request $request
     *
     * @return \WP_Error|bool
     */
    public function delete_item_permissions_check( $request ) {
        return $this->get_item_permissions_check( $request );
    }

    /**
     * Deletes one item from the collection.
     *
     * @since 1.0.0
     *
     * @param \WP_REST_Request $request
     *
     * @return \WP_Error|WP_REST_Response
     */
    public function delete_item( $request ) {
        $product = $this->get_product( $request['id'] );
        $previous = $this->prepare_item_for_response( $product, $request );

        $deleted = asd_rest_delete_product( $request['id'] );

        if ( ! $deleted ) {
            return new WP_Error(
                'rest_not_deleted',
                __( 'Sorry, the product could not be deleted.' ),
                [ 'status' => 400 ]
            );
        }

        $data = [
            'deleted'  => true,
            'previous' => $previous->get_data(),
        ];

        $response = rest_ensure_response( $data );

        return $response;
    }

    /**
     * Prepares one item for create or update operation.
     *
     * @since 1.0.0
     *
     * @param \WP_REST_Request $request
     *
     * @return \WP_Error|object
     */
    protected function prepare_item_for_database( $request ) {
        $prepared = [];

        if ( isset( $request['product_name'] ) ) {
            $prepared['product_name'] = $request['product_name'];
        }

        if ( isset( $request['product_description'] ) ) {
            $prepared['product_description'] = $request['product_description'];
        }

        if ( isset( $request['product_price'] ) ) {
            $prepared['product_price'] = $request['product_price'];
        }

        return $prepared;
    }

    /**
     * Prepares the item for the REST response.
     *
     * @param mixed           $item    WordPress representation of the item.
     * @param \WP_REST_Request $request Request object.
     *
     * @return \WP_Error|object
     */
    public function prepare_item_for_response( $item, $request ) {
        $data   = [];
        $fields = $this->get_fields_for_response( $request );

        if ( in_array( 'id', $fields, true ) ) {
            $data['id'] = (int) $item->id;
        }

        if ( in_array( 'product_name', $fields, true ) ) {
            $data['product_name'] = (string) $item->product_name;
        }

        if ( in_array( 'product_description', $fields, true ) ) {
            $data['product_description'] = (string) $item->product_description;
        }

        if ( in_array( 'product_price', $fields, true ) ) {
            $data['product_price'] = (float) $item->product_price;
        }

        if ( in_array( 'author_id', $fields, true ) ) {
            $data['author_id'] = (int) $item->author_id;
        }

        if ( in_array( 'date_created', $fields, true ) ) {
            $data['date_created'] = mysql_to_rfc3339( $item->created_at );
        }

        if ( in_array( 'date_updated', $fields, true ) ) {
            $data['date_updated'] = mysql_to_rfc3339( $item->updated_at );
        }

        $context = ! empty( $request['context'] ) ? $request['context'] : 'view';
        $data    = $this->filter_response_by_context( $data, $context );

        $response = rest_ensure_response( $data );
        $response->add_links( $this->prepare_links( $item ) );

        return $response;
    }

    /**
     * Prepares links for the request.
     *
     * @since 1.0.0
     *
     * @param \WP_Post $post Post object.
     *
     * @return array Links for the given post.
     */
    protected function prepare_links( $item ) {
        $base = sprintf( '%s/%s', $this->namespace, $this->rest_base );

        $links = [
            'self' => [
                'href' => rest_url( trailingslashit( $base ) . $item->id ),
            ],
            'collection' => [
                'href' => rest_url( $base ),
            ],
        ];

        return $links;
    }

    /**
     * Retrieves the contact schema, conforming to JSON Schema.
     *
     * @since 1.0.0
     *
     * @return array
     */
    public function get_item_schema() {
        if ( $this->schema ) {
            return $this->add_additional_fields_schema( $this->schema );
        }

        $schema = [
            '$schema'    => 'http://json-schema.org/draft-04/schema#',
            'title'      => 'product',
            'type'       => 'object',
            'properties' => [
                'id' => [
                    'description' => __( 'Unique identifier for the object.' ),
                    'type'        => 'integer',
                    'context'     => [ 'view', 'edit' ],
                    'readonly'    => true,
                ],
                'product_name' => [
                    'description' => __( 'Name of the product.' ),
                    'type'        => 'string',
                    'context'     => [ 'view', 'edit' ],
                    'required'    => true,
                    'arg_options' => [
                        'sanitize_callback' => 'sanitize_text_field',
                    ],
                ],
                'product_description' => [
                    'description' => __( 'Details of the product.' ),
                    'type'        => 'string',
                    'context'     => [ 'view', 'edit' ],
                    'required'    => true,
                    'arg_options' => [
                        'sanitize_callback' => 'sanitize_textarea_field',
                    ],
                ],
                'product_price' => [
                    'description' => __( 'Price of the product.' ),
                    'type'        => 'float',
                    'context'     => [ 'view', 'edit' ],
                    'arg_options' => [
                        'sanitize_callback' => 'sanitize_text_field',
                    ],
                ],
                'author_id' => [
                    'description' => __( 'Author of the product.' ),
                    'type'        => 'integer',
                    'context'     => [ 'view', 'edit' ],
                    'required'    => true,
                    'arg_options' => [
                        'sanitize_callback' => 'sanitize_key',
                    ],
                ],
                'date_created' => [
                    'description' => __( "The date the object was published, in the site's timezone." ),
                    'type'        => 'string',
                    'format'      => 'date-time',
                    'context'     => [ 'view' ],
                    'readonly'    => true,
                ],
                'date_updated' => [
                    'description' => __( "The date the object was updated, in the site's timezone." ),
                    'type'        => 'string',
                    'format'      => 'date-time',
                    'context'     => [ 'view' ],
                    'readonly'    => true,
                ],
            ],
        ];

        $this->schema = $schema;

        return $this->add_additional_fields_schema( $this->schema );
    }

    /**
     * Retrieves the query params for collections.
     *
     * @since 1.0.0
     *
     * @return array
     */
    public function get_collection_params() {
        $params = parent::get_collection_params();

        unset( $params['search'] );

        return $params;
    }
}
