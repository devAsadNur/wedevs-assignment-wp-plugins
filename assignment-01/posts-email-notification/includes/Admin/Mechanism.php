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
        $this->mail_sending_mechanism();
    }

    /**
     * Email sending action mechanism function
     *
     * @return void
     */
    public function mail_sending_mechanism() {
        add_action( 'publish_post', [ $this, 'mail_handler' ], 10, 2 );
    }

    /**
     * Email handler function
     *
     * @param [int] $post_id
     * @param [object] $post_obj
     * @return void
     */
    public function mail_handler( $post_id, $post_obj ) {
        $admin_email = apply_filters( 'email_ids_to_send_mail', [get_bloginfo('admin_email')] );
        $mail_subject = 'Post Published: '. $post_obj->post_title;
        $mail_msg = $post_obj->post_content;
        wp_mail( $admin_email, $mail_subject, $mail_msg );
    }
    
}