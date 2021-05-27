<?php

namespace Asd\FeaturedPosts;

/**
 * Settings fields
 * callback
 * handler class
 */
class SettingsFields {

    /**
     * Featured posts settings limit field callback function
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function fp_limit_field_cb() {
        $current_limit = get_option( 'featured_posts_limit' );
        ?>
        <input id="featured_posts_limit" type="text" name="featured_posts_limit" class="regular-text" placeholder="<?php esc_attr_e( 'Number of Posts', 'asd-featured-posts' ); ?>" value="<?php echo esc_attr( $current_limit ); ?>">
        <?php
    }

    /**
     * Featured posts settings order field callback function
    *
    * @since 1.0.0
    *
    * @return void
    */
    public function fp_order_field_cb() {
        $current_order = get_option( 'featured_posts_order' );
        ?>
        <select id="featured_posts_order" name="featured_posts_order">
            <option value="<?php echo esc_attr( 'rand' ); ?>" <?php selected( $current_order, 'rand' ); ?>><?php esc_html_e( 'Random', 'asd-featured-posts' ); ?></option>
            <option value="<?php echo esc_attr( 'ASC' ); ?>" <?php selected( $current_order, 'ASC' ); ?>><?php esc_html_e( 'ASC', 'asd-featured-posts' ); ?></option>
            <option value="<?php echo esc_attr( 'DESC' ); ?>" <?php selected( $current_order, 'DESC' ); ?>><?php esc_html_e( 'DESC', 'asd-featured-posts' ); ?></option>
        </select>
        <?php
    }

    /**
     * Featured posts settings categories field callback function
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function fp_categoires_field_cb() {
        $current_cats = get_option( 'featured_posts_categories' );

        $args = apply_filters( 'asd_fp_categories_args', [
        'orderby' => 'name',
        'order'   => 'ASC',
        ] );

        $categories = get_categories( $args );

        foreach ( $categories as $category ) {
            $cat_name = (string) $category->name;
            $cat_slug = (string) $category->slug;

            $current_checked = in_array( $cat_slug, $current_cats ) ? 'checked' : '';

            ?>
            <input type="checkbox" id="<?php echo esc_attr( 'post_cat_' . $cat_slug ); ?>" name="<?php echo esc_attr( 'featured_posts_categories[' . $cat_slug . ']' ); ?>" value="<?php echo esc_attr( $cat_slug ); ?>" <?php echo esc_html( $current_checked ); ?>>
            <label for="<?php echo esc_attr( 'post_cat_' . $cat_slug ); ?>"> <?php echo esc_html( $cat_name ); ?></label><br>
            <?php
        }
    }
}
