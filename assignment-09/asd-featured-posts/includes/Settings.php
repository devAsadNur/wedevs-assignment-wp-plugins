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
                'callback' => [ $this, 'fearured_posts_section_cb' ],
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
                'callback' => [ $this, 'limit_field_cb' ],
                'page'     => 'featured-posts',
                'section'  => 'featured_posts_section',
            ],
            [
                'id'       => 'featured_posts_field_order',
                'title'    => 'Post Order',
                'callback' => [ $this, 'order_field_cb' ],
                'page'     => 'featured-posts',
                'section'  => 'featured_posts_section',
            ],
            [
                'id'       => 'featured_posts_field_categories',
                'title'    => 'Post Categories',
                'callback' => [ $this, 'categoires_field_cb' ],
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

    /**
     * Featured posts section callback function
     *
     * @return void
     */
    public function fearured_posts_section_cb() {
        ?>
        <p><?php esc_html_e('Choose featured posts to show'); ?></p>
        <?php
    }

    /**
     * Featured posts limit callback function
     *
     * @return void
     */
    public function limit_field_cb() {
        $current_limit = get_option( 'featured_posts_limit' );
        ?>
        <input id="featured_posts_limit" type="text" name="featured_posts_limit" class="regular-text" placeholder="Number of Posts" value="<?php echo $current_limit; ?>">
        <?php
    }

    /**
      * Featured posts order callback function
     *
     * @return void
     */
    public function order_field_cb() {
        $current_order = get_option( 'featured_posts_order' );
        ?>
        <select id="featured_posts_order" name="featured_posts_order">
            <option value="rand" <?php selected( $current_order, 'rand' ); ?>>Random</option>
            <option value="ASC" <?php selected( $current_order, 'ASC' ); ?>>ASC</option>
            <option value="DESC" <?php selected( $current_order, 'DESC' ); ?>>DESC</option>
        </select>
        <?php
    }

   /**
      * Featured posts categories callback function
    *
    * @return void
    */
    public function categoires_field_cb() {
        $current_cats = get_option( 'featured_posts_categories' );

        $args = [
          'orderby' => 'name',
          'order'   => 'ASC',
        ];

        $categories = get_categories( $args );

        foreach ($categories as $category) {
            $cat_name = $category->name;
            $cat_slug = $category->slug;

            $current_checked = in_array( $cat_slug, $current_cats ) ? 'checked' : '';

            ?>
            <input type="checkbox" id="post_cat_<?php echo $cat_slug; ?>" name="featured_posts_categories[<?php echo $cat_slug; ?>]" value="<?php echo $cat_slug; ?>" <?php echo $current_checked; ?>>
            <label for="post_cat_<?php echo $cat_slug; ?>"> <?php echo $cat_name; ?></label><br>
            <?php
        }
    }
}
