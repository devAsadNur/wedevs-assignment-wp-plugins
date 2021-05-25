<?php
/**
 * Template: shortcode search result viewer
 *
 * HMTL template for preview search results
 *
 * @since 1.0.0
 */
?>
<div class="single-post">
<?php
    /**
     * Action hook for adding contents
     * before search result contents
     *
     * @since 1.0.0
     */
    do_action( 'br_search_result_before' );

    /**
     * HTML search result contents
     */
    ?>
    <div id="search-results-wrapper" class="container wrapper default-max-width clearfix"">
        <h2>
            <a href="<?php esc_url( the_permalink() ); ?>">
                <?php esc_html( the_title() ); ?>
            </a>
        </h2>
        <a href="<?php esc_url( the_permalink() ); ?>">
            <?php esc_html( the_post_thumbnail( 'thumbnail' ) ); ?>
        </a>
        <p>
            <?php esc_html( the_excerpt() ); ?>
            <a href="<?php esc_url( the_permalink() ); ?>">
                <?php esc_html_e( 'Read More', 'asd-book-review-plus' ); ?>
            </a>
        </p>
    </div>
    <?php

    /**
     * Action hook for adding contents
     * after search result contents
     *
     * @since 1.0.0
     */
    do_action( 'br_search_result_after' );
    ?>
</div>
<?php
