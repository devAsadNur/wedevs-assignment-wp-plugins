<?php

namespace Asd\Subscription\Form\Widget;

/**
 * Ajax
 * handler class
 */
class Ajax {

    /**
     * Initialize the class
     *
     * @since  1.0.0
     */
    public function __construct() {
        add_action( 'wp_ajax_asd-mc-subscription', [ $this, 'mc_subs_request_handler' ] );
        add_action( 'wp_ajax_nopriv_asd-mc-subscription', [ $this, 'mc_subs_request_handler' ] );
    }

    /**
     * Email scubscription ajax request handler function
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function mc_subs_request_handler() {
        // Form input data from user
        $email    = isset( $_POST['mc-email'] ) ? sanitize_email( $_POST['mc-email'] ) : '';
        $list_id  = isset( $_POST['mc-list'] ) ? sanitize_key( $_POST['mc-list'] ) : '';

        // API key and status
        $api_key = '' !== get_option( 'asd_mailchimp_api_key' ) ? get_option( 'asd_mailchimp_api_key' ) : '';
        $status = 'subscribed';

        // Nonce verification
        if ( ! wp_verify_nonce( $_POST['_wpnonce'], 'mc-sbuscription-form' ) ) {
            wp_send_json_error( [
                'message' => __( 'Nonce verification failed', 'asd-subs-form-widget' ),
            ] );
        }

        // Email id verification
        if ( '' === $email ) {
            wp_send_json( [
                'message' => __( 'Invalid email address.', 'asd-subs-form-widget' ),
            ] );
        }

        // MailChimp list id verification
        if ( '' === $list_id ) {
            wp_send_json_error( [
                'message' => __( 'Mailchimp list integration error. Please contact with admin.', 'asd-subs-form-widget' ),
            ] );
        }

        // Email subscription POST request to MailChimp via helper function
        $mc_subs_stat = asd_mc_api_post_email_subs( $api_key, $list_id, $email, $status );

        // Send status for successful subscription
        if ( 'subscribed' === $mc_subs_stat ) {
            wp_send_json_success( [
                'message' => __( 'Email subscribed successfully.', 'asd-subs-form-widget' ),
            ] );
        }

        // Send status in case of existed email
        if ( 400 === $mc_subs_stat ) {
            wp_send_json_error( [
                'message' => __( 'Email already exitst. Thanks for being with us.', 'asd-subs-form-widget' ),
            ] );
        }

        // Send status in case of other type failure
        wp_send_json_error( [
            'message' => __( 'Request failed', 'asd-subs-form-widget' ),
        ] );
    }
}
