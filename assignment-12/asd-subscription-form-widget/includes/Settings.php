<?php

namespace Asd\SubscriptionFormWidget;

/**
 * The settings
 * handler class
 */
class Settings {

    /**
     * Initialize the class
     *
     * @since  1.0.0
     */
    public function __construct() {
        add_action( 'admin_init', [ $this, 'mc_api_settings_handler' ] );
    }

    /**
     * MailChimp API settings handler function
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function mc_api_settings_handler() {
        $register = [
            'option_group' => 'general',
            'option_name'  => 'asd_mailchimp_api_key',
        ];

        $section  = [
            'id'       => 'mailchimp_subscription_section',
            'title'    => __( 'MailChimp API Settings', 'asd-subs-form-widget' ),
            'callback' => [ $this, 'mailchimp_settings_section_cb' ],
            'page'     => 'general',
        ];

        $field    = [
            'id'       => 'mailchimp_api_key_field',
            'title'    => __( 'MailChimp API Key', 'asd-subs-form-widget' ),
            'callback' => [ $this, 'mailchimp_api_key_field_cb' ],
            'page'     => 'general',
            'section'  => 'mailchimp_subscription_section',
        ];

        register_setting( $register['option_group'], $register['option_name'] );
        add_settings_section( $section['id'], $section['title'], $section['callback'], $section['page'] );
        add_settings_field( $field['id'], $field['title'], $field['callback'], $field['page'], $field['section'] );
    }

    /**
     * MailChimp API settings section callback function
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function mailchimp_settings_section_cb() {
        return;
    }

    /**
     * MailChimp API key settings field callback function
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function mailchimp_api_key_field_cb() {
        $existing_value = ( ! empty( get_option( 'asd_mailchimp_api_key' ) ) ) ? get_option( 'asd_mailchimp_api_key' ) : '';
        ?>
        <input type="text" name="asd_mailchimp_api_key" id="input-mailchimp-api-key" class="regular-text" placeholder="<?php esc_html_e( 'Enter your NameChimp API key', 'asd-subs-form-widget' ); ?>" value="<?php echo esc_attr( $existing_value ); ?>">
        <?php
    }
}
