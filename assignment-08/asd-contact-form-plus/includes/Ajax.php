<?php

namespace Asd\ContactFormPlus;

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

        if ( ! isset( $_REQUEST['_contact_nonce'] ) || ! wp_verify_nonce( $_REQUEST['_contact_nonce'], 'asd-sc-cfp') ) {
            wp_send_json_error( [
                'message' => __( 'Nonce verification failed', 'asd-contact-plus' ),
            ] );
        }

        if ( empty( $first_name ) ) {
            wp_send_json_error( [
                'message' => __( 'First name can\'t be empty', 'asd-contact-plus' ),
            ] );
        }

        if ( empty( $last_name ) ) {
            wp_send_json_error( [
                'message' => __( 'Last name can\'t be empty', 'asd-contact-plus' ),
            ] );
        }

        if ( empty( $email ) ) {
            wp_send_json_error( [
                'message' => __( 'Email address can\'t be empty', 'asd-contact-plus' ),
            ] );
        }

        $args = [
            'first_name' => $first_name,
            'last_name'  => $last_name,
            'email'      => $email,
            'message'    => $message,
        ];

        // Create instance of Contact Response Object
        $contact_response = new ContactResponse();
        $insert_id = $contact_response->insert_response( $args );

        if ( is_wp_error( $insert_id ) ) {
            wp_send_json_error( [
                'message' => $insert_id->get_error_message(),
            ] );
        }

        wp_send_json_success( [
            'message'   => __( 'Enquiry has been sent successfully', 'asd-contact-plus' ),
        ] );
    }
}
