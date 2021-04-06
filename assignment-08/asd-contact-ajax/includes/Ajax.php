<?php

namespace Asd\WeContact\Ajax;

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
        if ( ! wp_verify_nonce( $_REQUEST['_wpnonce'], 'asd-contact-ajax') ) {
            wp_send_json_error( [
                'message' => __( 'Nonce verification failed!', 'asd-contact-ajax' ),
            ] );
        }

        wp_send_json_success( [
            'message'   => __( 'Enquiry has been sent successfully!', 'asd-contact-ajax' ),
            'form_data' => $_REQUEST,
        ] );

        wp_send_json_error( [
            'message' => __( 'Something wrong with the request!', 'asd-contact-ajax' ),
        ] );
    }
}
