<?php

namespace EmailNotification\Admin;

/**
 * The mechanism handler class
 */
class Mechanism {

    /**
     * Initialize the class
     */
    public function __construct() {
        add_action( 'publish_post', [ $this, 'mail_handler' ], 10, 2 );
    }

    public function mail_handler( $post_id, $post_obj ) {
        $admin_email = apply_filters( 'email_ids_to_send_mail', [get_bloginfo('admin_email')] );
        $mail_subject = 'Post Published: '. $post_obj->post_title;
        $mail_msg = 'Test message... ';
        wp_mail( $admin_email, $mail_subject, $mail_msg );
    }
    
}