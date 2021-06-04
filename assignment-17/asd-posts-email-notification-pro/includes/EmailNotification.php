<?php

namespace Asd\PostsEmailPro;

/**
 * Email notification
 * handler class
 */
class EmailNotification {

    /**
     * Initialize the class
     *
     * @since  1.0.0
     */
    public function __construct() {
        add_action( 'init', [ $this, 'email_notification_cron_activation' ] );
        add_action( 'asd_email_notification_cron_hook', [ $this, 'email_notification_sender' ] );
    }

    /**
     * Cron activation function
     *
     * @since 1.0.0
     *
     * @return boolean|WP_Error
     */
    public function email_notification_cron_activation() {
        if ( ! wp_next_scheduled ( 'asd_email_notification_cron_hook' ) ) {
            wp_schedule_event( time(), 'daily', 'asd_email_notification_cron_hook' );
        }
    }

    /**
     * Email notification sender function
     *
     * @since 1.0.0
     *
     * @return boolean
     */
    public function email_notification_sender() {
        $posts  = $this->get_todays_posts();
        $count  = $posts->post_count;
        $titles = [];

        if ( $posts->have_posts() ) {
            while ( $posts->have_posts() ) {
                $posts->the_post();

                $titles[] = get_the_title();
            }
        } else {
            $titles = [ __( 'No post published today', 'asd-posts-email-pro' ) ];
        }

        // Restore original Post Data
        wp_reset_postdata();

        $message = __( 'Today\'s post count: ', 'asd-posts-email-pro' ) . $count . __( '. Post titles: ', 'asd-posts-email-pro' );

        foreach ( $titles as $title ) {
            $message .= $title . ', ';
        }

        $admin_email   = get_bloginfo( 'admin_email' );
        $email_subject = __( 'Today\'s Published Posts', 'asd-posts-email-pro' );
        $email_body    = $message;

        // Send email
        wp_mail( $admin_email, $email_subject, $email_body );
    }

    /**
     * Todays posts getter function
     *
     * @since 1.0.0
     *
     * @return object
     */
    public function get_todays_posts() {
        $today = getdate();
        $args  = array(
            'date_query' => array(
                array(
                    'year'  => $today['year'],
                    'month' => $today['mon'],
                    'day'   => $today['mday'],
                ),
            ),
        );

        return new \WP_Query( $args );
    }
}
