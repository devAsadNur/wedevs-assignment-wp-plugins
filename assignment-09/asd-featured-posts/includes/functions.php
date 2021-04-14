<?php

/**
 * Featured posts getter query and cache function
 *
 * @since 1.0.0
 *
 * @param array $args
 *
 * @return array|string
 */
function asd_fp_get_posts( $args = [] ) {
    // Get any existing copy of our transient data
    $featured_posts_query = get_transient( 'featured_posts_query' );
    if ( false === $featured_posts_query ) {
        // It wasn't there, so regenerate the data and save the transient
        $featured_posts_query = new WP_Query( $args );
        set_transient( 'featured_posts_query', $featured_posts_query );
    }

    if ( ! $featured_posts_query->have_posts() ) {
        return __( 'No post found!', 'asd-featured-posts' );
    }

    return $featured_posts_query->posts;
}

/**
 * Featured posts settings section callback function
 *
 * @since 1.0.0
 *
 * @return void
 */
function asd_fp_section_cb() {
    ?>
    <p><?php esc_html_e('Choose featured posts to show'); ?></p>
    <?php
}

/**
 * Featured posts settings limit field callback function
 *
 * @since 1.0.0
 *
 * @return void
 */
function asd_fp_limit_field_cb() {
    $current_limit = get_option( 'featured_posts_limit' );
    ?>
    <input id="featured_posts_limit" type="text" name="featured_posts_limit" class="regular-text" placeholder="Number of Posts" value="<?php echo $current_limit; ?>">
    <?php
}

/**
  * Featured posts settings order field callback function
 *
 * @since 1.0.0
 *
 * @return void
 */
function asd_fp_order_field_cb() {
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
 * Featured posts settings categories field callback function
 *
 * @since 1.0.0
 *
 * @return void
 */
function asd_fp_categoires_field_cb() {
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
