<?php

namespace Asd\FeaturedPosts\Admin;

/**
 * Settings
 * handler class
 */
class Settings {

    /**
     * Class constructor
     *
     * @since  1.0.0
     */
    public function __construct() {
        add_action( 'admin_init', [ $this, 'custom_settings_handler' ] );
    }

    /**
     * Settings registers getter function
     *
     * @since  1.0.0
     *
     * @return array
     */
    public function get_registers() {
        $registers = apply_filters( 'asd_fp_settings_registers', [
            [
                'option_group' => 'featured-posts',
                'option_name'  => 'featured_posts_limit',
            ],
            [
                'option_group' => 'featured-posts',
                'option_name'  => 'featured_posts_order',
            ],
            [
                'option_group' => 'featured-posts',
                'option_name'  => 'featured_posts_categories',
            ],
        ] );

        return $registers;
    }

    /**
     * Settings sections getter function
     *
     * @since  1.0.0
     *
     * @return array
     */
    public function get_sections() {
        $sections = apply_filters( 'asd_fp_settings_sections',  [
            'featured_posts_section' => [
                'title'    => __( 'Featured Posts Selector', 'asd-featured-posts' ),
                'callback' => [ $this, 'fp_sttings_section_cb' ],
                'page'     => 'featured-posts',
            ],
        ] );

        return $sections;
    }

    /**
     * Settings fields getter function
     *
     * @since  1.0.0
     *
     * @return array
     */
    public function get_fields() {
        // Creates instance of SettingsFields Object
        $obj_settings_fields = new SettingsFields();

        $fields = apply_filters( 'asd_fp_settings_fields', [
            'featured_posts_field_limit'    => [
                'title'    => __( 'Number of Posts', 'asd-featured-posts' ),
                'callback' => [ $obj_settings_fields, 'fp_limit_field_cb' ],
                'page'     => 'featured-posts',
                'section'  => 'featured_posts_section',
            ],
            'featured_posts_field_order'     => [
                'title'    => __( 'Post Order', 'asd-featured-posts' ),
                'callback' => [ $obj_settings_fields, 'fp_order_field_cb' ],
                'page'     => 'featured-posts',
                'section'  => 'featured_posts_section',
            ],
            'featured_posts_field_categories' => [
                'title'    => __( 'Post Categories', 'asd-featured-posts' ),
                'callback' => [ $obj_settings_fields, 'fp_categoires_field_cb' ],
                'page'     => 'featured-posts',
                'section'  => 'featured_posts_section',
            ],
        ] );

        return $fields;
    }


    /**
     * Custom settings handler function
     *
     * @since  1.0.0
     *
     * @return void
     */
    public function custom_settings_handler() {
        $registers = $this->get_registers();
        $sections  = $this->get_sections();
        $fields    = $this->get_fields();

        // Looping through settings registers
        foreach ( $registers as $register ) {
            $args = isset( $register['args'] ) ? $register['args'] : '';

            // Register each custom settings
            register_setting( $register['option_group'], $register['option_name'], $args );
        }

        // Looping through settings sections
        foreach ( $sections as $id => $section ) {
            // Adds each settings section
            add_settings_section( $id, $section['title'], $section['callback'], $section['page'] );
        }

        // Looping through settings fields
        foreach ( $fields as $id => $field ) {
            $section = isset( $field['section'] ) ? $field['section'] : '';
            $args    = isset( $field['args'] ) ? $field['args'] : '';

            // Adds each settings field
            add_settings_field( $id, $field['title'], $field['callback'], $field['page'], $section, $args );
        }
    }

    /**
     * Featured posts settings section callback function
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function fp_sttings_section_cb() {
        ?>
        <p><?php apply_filters( 'asd_fp_settings_section_title', esc_html_e( 'Choose featured posts to show', 'asd-featured-posts' ) ); ?></p>
        <?php
    }
}
