<?php

/**
 * MailChimp lists fetcher function from
 *
 * @since 1.0.0
 *
 * @param string $api_key
 *
 * @return void
 */
function asd_mc_api_fetch_lists( $api_key ) {
    $dc = substr( $api_key, strpos( $api_key, '-' ) +1 );
    $url = 'https://' . $dc . '.api.mailchimp.com/3.0/lists';
    $args = [
        'headers' => [
            'Authorization' => 'Basic ' . base64_encode( 'user:'. $api_key )
        ],
        'timeout' => 30,
    ];

    $response = wp_remote_get( $url, $args );
    $body = wp_remote_retrieve_body( $response );
    $data = json_decode( $body );

    $lists = [];

    foreach ( $data->lists as $list ) {
        $lists[ $list->id ] = $list->name;
    }

    $lists = ( ! empty( $lists ) ) ? $lists : [ 'No list available' ];

    return $lists;
}

/**
 * MailChimp subscription request handler function
 *
 * @since 1.0.0
 *
 * @param string $api_key
 * @param string $list_id
 * @param string $email
 * @param string $status
 *
 * @return void
 */
function asd_mc_api_post_email_subs( $api_key, $list_id, $email, $status = 'subscribed' ) {
    $dc = substr( $api_key, strpos( $api_key, '-' ) +1 );
    $url = 'https://' . $dc . '.api.mailchimp.com/3.0/lists/' . $list_id . '/members';

    $args = [
        'method'  => 'POST',
        'timeout' => 30,
        'headers' => [
            'Authorization' => 'Basic ' . base64_encode( 'user:'. $api_key ),
        ],
        'body'    => json_encode( [
            'email_address' => $email,
            'status'        => $status,
        ] ),
    ];

    $response = wp_remote_post( $url, $args );
    $body = wp_remote_retrieve_body( $response );
    $data = json_decode( $body );
    $data_status = $data->status;

    return $data_status;
}
