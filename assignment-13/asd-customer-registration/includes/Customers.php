<?php

namespace Asd\CustomerRegistration;

/**
 * The user roles
 * handler class
 */
class Customers {

    /**
     * Initialize the class
     *
     * @since 1.0.0
     */
    public function __construct() {
        add_action( 'init', [ $this, 'add_customer_user_role' ] );
    }

    /**
     * Adds customer user role
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function add_customer_user_role() {
        add_role(
            'customer',
            'Customer',
            [
                'read' => true,
            ]
        );
    }

    /**
     * Register new customer
     *
     * @since 1.0.0
     *
     * @param array $args
     *
     * @return int|object
     */
    public function register_customer( $args ) {
        $defaults = [
            'display_name' => '',
            'user_email'   => '',
            'role' => 'customer',
        ];

        $user_data = wp_parse_args( $args, $defaults );

        $user_id   = wp_insert_user( $user_data );

        return $user_id;
    }

    /**
     * Adds extra capabilities to customer
     *
     * @since 1.0.0
     *
     * @param int $user_id
     * @param string $type
     *
     * @return void
     */
    public function add_extra_caps_to_customer( $user_id, $type = 'regular' ) {
        $user = new \WP_User( $user_id );

        switch ( $type ) {
            case 'pro':
                $capabilities = [
                    'read',
                    'edit_theme_options',
                    'customize',
                    'edit_posts',
                    'delete_posts',
                    'list_users',
                    'edit_users',
                ];
                break;

            case 'premium':
                $capabilities = [
                    'read',
                    'edit_theme_options',
                    'customize',
                    'edit_posts',
                    'delete_posts',
                ];
                break;

            default:
            $capabilities = [
                    'read',
                ];
        }

        foreach ( $capabilities as $capability ) {
            $user->add_cap( $capability );
        }

        return;
    }
}
