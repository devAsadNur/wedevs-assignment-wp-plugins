<?php

namespace Asd\CustomerRegistration;

/**
 * The AJAX
 * handler
 * class
 */
class Ajax {

    /**
     * Initialize the class
     *
     * @since 1.0.0
     */
    public function __construct() {
        add_action( 'wp_ajax_asd-customer-reg', [ $this, 'customer_reg_handler' ] );
    }

    /**
     * Customer registration handler function
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function customer_reg_handler() {
        $name      = ( ! empty( $_REQUEST['name'] ) ) ? sanitize_text_field( $_REQUEST['name'] ) : '';
        $username  = ( ! empty( $_REQUEST['username'] ) ) ? sanitize_user( $_REQUEST['username'] ) : '';
        $email     = ( ! empty( $_REQUEST['email'] ) ) ? sanitize_email( $_REQUEST['email'] ) : '';
        $pass      = ( ! empty( $_REQUEST['pass'] ) ) ? $_REQUEST['pass'] : '';
        $pass_conf = ( ! empty( $_REQUEST['pass-confirm'] ) ) ? $_REQUEST['pass-confirm'] : '';
        $type      = ( ! empty( $_REQUEST['crf-type'] ) ) ? sanitize_text_field( $_REQUEST['crf-type'] ) : 'regular';

        if ( ! wp_verify_nonce( $_REQUEST['_wpnonce'], 'asd-crf-form' ) ) {
            wp_send_json_error( [
                'message' => __( 'Nonce verification failed', 'asd-customer-reg' ),
            ] );
        }

        if ( empty( $name ) ) {
            wp_send_json_error( [
                'message' => __( 'Name is required', 'asd-customer-reg' ),
            ] );
        }

        if ( empty( $username ) ) {
            wp_send_json_error( [
                'message' => __( 'Username is required', 'asd-customer-reg' ),
            ] );
        }

        if ( empty( $email ) ) {
            wp_send_json_error( [
                'message' => __( 'Eamil is required', 'asd-customer-reg' ),
            ] );
        }

        if ( empty( $pass ) ) {
            wp_send_json_error( [
                'message' => __( 'Password is required', 'asd-customer-reg' ),
            ] );
        }

        if ( $pass !== $pass_conf ) {
            wp_send_json_error( [
                'message' => __( 'Password match failed', 'asd-customer-reg' ),
            ] );
        }

        if ( empty( $type ) ) {
            wp_send_json_error( [
                'message' => __( 'type is required', 'asd-customer-reg' ),
            ] );
        }

        $user_data = [
            'user_login'   => $username,
            'user_pass'    => $pass,
            'display_name' => $name,
            'user_email'   => $email,
        ];

        $obj_customers = new Customers();
        $reg_customer  = $obj_customers->register_customer( $user_data );

        if ( ! is_wp_error( $reg_customer ) ) {
            $obj_customers->add_extra_caps_to_customer( $reg_customer, $type );

            wp_send_json_success( [
                'message' => __( 'Registration successful', 'asd-customer-reg' ),
            ] );
        } else {
            wp_send_json_error( [
                'message' => $reg_customer->get_error_message(),
            ] );
        }
    }
}
