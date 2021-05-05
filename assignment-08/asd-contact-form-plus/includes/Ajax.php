<?php

namespace Asd\Contact\Form\Plus;

/**
 * The ajax
 * handler
 * class
 */
class Ajax {

    /**
     * Initialize the class
     *
     * @since  1.0.0
     */
    public function __construct() {
        add_action( 'wp_ajax_asd-sc-contact-form', [ $this, 'submit_enquery' ] );
        add_action( 'wp_ajax_nopriv_asd-sc-contact-form', [ $this, 'submit_enquery' ] );
    }

    /**
     * Submit enquery function
     *
     * @since  1.0.0
     *
     * @return void
     */
    public function submit_enquery() {
        $first_name = ( ! empty( $_REQUEST['fname'] ) ) ? sanitize_text_field( $_REQUEST['fname'] ) : '';
        $last_name  = ( ! empty( $_REQUEST['lname'] ) ) ? sanitize_text_field ( $_REQUEST['lname'] ) : '';
        $email      = ( ! empty( $_REQUEST['email'] ) ) ? sanitize_email( $_REQUEST['email'] ) : '';
        $message    = ( ! empty( $_REQUEST['message'] ) ) ? sanitize_textarea_field( $_REQUEST['message'] ) : '';

        if ( ! wp_verify_nonce( $_REQUEST['_wpnonce'], 'asd-sc-cfp') ) {
            wp_send_json_error( [
                'message' => __( 'Nonce verification failed!', 'asd-contact-plus' ),
            ] );
        }

        if ( '' === $first_name ) {
            wp_send_json_error( [
                'message' => __( 'First name can\'t be empty!', 'asd-contact-plus' ),
            ] );
        }

        if ( '' === $last_name ) {
            wp_send_json_error( [
                'message' => __( 'Last name can\'t be empty!', 'asd-contact-plus' ),
            ] );
        }

        if ( '' === $email ) {
            wp_send_json_error( [
                'message' => __( 'Email address can\'t be empty!', 'asd-contact-plus' ),
            ] );
        }

        $args = [
            'first_name' => $first_name,
            'last_name'  => $last_name,
            'email'      => $email,
            'message'    => $message,
        ];

        $insert_id = asd_sc_cf_insert_enquery( $args );

        if ( is_int( $insert_id ) ) {
            wp_send_json_success( [
                'message'   => __( 'Enquiry has been sent successfully!', 'asd-contact-plus' ),
            ] );
        }

        wp_send_json_error( [
            'message' => __( 'Something wrong with the request!', 'asd-contact-plus' ),
        ] );
    }
}
