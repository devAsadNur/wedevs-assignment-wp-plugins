<?php

namespace Asd\Subscription\Form\Widget;

/**
 * Subscription form widget
 * handler class
 */
class Widgets extends \WP_Widget {

    /**
     * Passing widget frontend markup using arguments array
     *
     * @since 1.0.0
     *
     * @var array
     */
    public $args = [
        'before_title'  => '<h4 class="widget-title>',
        'after_title'   => '</h4>',
        'before_widget' => '<div class="widget-wrap">',
        'after_widget'  => '</div>',
    ];

    /**
     * Initialize the widget class
     *
     * @since 1.0.0
     */
    public function __construct() {
        parent::__construct(
            'asd-subs-form-widget',
            __( 'Subscription Form ', 'asd-subs-form-widget' )
        );

        add_action( 'widgets_init', [ $this, 'register_subscription_form_widget' ] );
    }

    /**
     * Widget register function
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function register_subscription_form_widget() {
        register_widget( 'Asd\Subscription\Form\Widget\Widgets' );
    }

    /**
     * Widget frontend output handler function
     *
     * @since 1.0.0
     *
     * @param array $args
     * @param array $instance
     *
     * @return void
     */
    public function widget( $args, $instance ) {
        $title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';
        $list  = ( ! empty( $instance['list'] ) ) ? $instance['list'] : '';

        echo $args['before_widget'];

        if ( '' !== $title ) {
            echo $args['before_title'] . $title . $args['after_title'];
        }

        // Enqueue script and style for widget output
        wp_enqueue_script( 'mc-subscription-js' );
        wp_enqueue_style( 'mc-subscription-js' );

        // Include widget output form template
        ob_start();
        include_once ASD_SUBSCRIPTION_FORM_WIDGET_PATH . '/templates/email_subs_widget_frontend_form.php';
        echo ob_get_clean();

        echo $args['after_widget'];
    }

    /**
     * Widget dashboard options form handler function
     *
     * @since 1.0.0
     *
     * @param array $instance
     *
     * @return void
     */
    public function form( $instance ) {
        $title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';
        $list  = ( ! empty( $instance['list'] ) ) ? $instance['list'] : '';

        // Get MailChimp API key from Options table
        $mc_api_key = '' !== get_option( 'asd_mailchimp_api_key' ) ? get_option( 'asd_mailchimp_api_key' ) : '';

        // Fetch lists array from MailChimp API using helper function
        $mc_lists = asd_mc_api_fetch_lists( $mc_api_key );

        // Include widget input form template
        ob_start();
        include ASD_SUBSCRIPTION_FORM_WIDGET_PATH . '/templates/email_subs_widget_backend_form.php';
        echo ob_get_clean();
    }

    /**
     * Widget options data save handler function
     *
     * @since 1.0.0
     *
     * @param array $new_instance The new options
     * @param array $old_instance The previous options
     *
     * @return array
     */
    public function update( $new_instance, $old_instance ) {
        $instance = [];

        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['list'] = ( ! empty( $new_instance['list'] ) ) ? $new_instance['list'] : '';

        return $instance;
    }
}
