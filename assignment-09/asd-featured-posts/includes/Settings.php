<?php

namespace Asd\Featured\Posts;

/**
 * Settings
 * handler class
 */
class Settings {

    /**
     * Setting registers variable
     *
     * @since  1.0.0
     *
     * @var array
     */
    public $registers;

    /**
     * Setting registers variable
     *
     * @since  1.0.0
     *
     * @var array
     */
    public $sections;

    /**
     * Setting registers variable
     *
     * @since  1.0.0
     *
     * @var array
     */
    public $fields;

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
        return [
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
        ];
    }

    /**
     * Settings sections getter function
     *
     * @since  1.0.0
     *
     * @return array
     */
    public function get_sections() {
        return [
            [
                'id'       => 'featured_posts_section',
                'title'    => 'Featured Posts Selector',
                'callback' => 'asd_fp_section_cb',
                'page'     => 'featured-posts',
            ],
        ];
    }

    /**
     * Settings fields getter function
     *
     * @since  1.0.0
     *
     * @return array
     */
    public function get_fields() {
        return [
            [
                'id'       => 'featured_posts_field_limit',
                'title'    => 'Number of Posts',
                'callback' => 'asd_fp_limit_field_cb',
                'page'     => 'featured-posts',
                'section'  => 'featured_posts_section',
            ],
            [
                'id'       => 'featured_posts_field_order',
                'title'    => 'Post Order',
                'callback' => 'asd_fp_order_field_cb',
                'page'     => 'featured-posts',
                'section'  => 'featured_posts_section',
            ],
            [
                'id'       => 'featured_posts_field_categories',
                'title'    => 'Post Categories',
                'callback' => 'asd_fp_categoires_field_cb',
                'page'     => 'featured-posts',
                'section'  => 'featured_posts_section',
            ],
        ];
    }


    /**
     * Custom settings handler function
     *
     * @since  1.0.0
     *
     * @return void
     */
    public function custom_settings_handler() {
        $this->registers = $this->get_registers();
        $this->sections  = $this->get_sections();
        $this->fields    = $this->get_fields();

        foreach ( $this->registers as $register ) {
            $args = isset( $register['args'] ) ? $register['args'] : '';

            /**
             * Register each custom settings
             */
            register_setting( $register['option_group'], $register['option_name'], $args );
        }

        foreach ($this->sections as $section) {
            /**
             * Adds each settings section
             */
            add_settings_section( $section['id'], $section['title'], $section['callback'], $section['page'] );
        }

        foreach ($this->fields as $field) {
            $section = isset( $field['section'] ) ? $field['section'] : '';
            $args    = isset( $field['args'] ) ? $field['args'] : '';

            /**
             * Adds each settings field
             */
            add_settings_field($field['id'], $field['title'], $field['callback'], $field['page'], $section, $args);
        }
    }
}
