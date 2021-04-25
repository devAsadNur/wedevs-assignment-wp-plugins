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
    do_action( 'abr_search_result_before' );

    /**
     * HTML search result contents
     */
    ?>
    <div id="search-results-wrapper" class="container wrapper default-max-width clearfix"">
        <h2>
            <a href="<?php echo esc_url( $post->guid ); ?>">
                <?php esc_html_e( $post->post_title, 'asd-book-review-pp' ); ?>
            </a>
        </h2>

        <a href="<?php echo esc_url( $post->guid ); ?>">
            <img src="<?php esc_url( the_post_thumbnail() ); ?>" alt="<?php esc_attr_e( $post->post_title, 'asd-book-review-pp' ); ?>" />
        </a>

        <p>
            <?php esc_html_e( $post->post_excerpt, 'asd-book-review-pp' ); ?>
            <a href="<?php echo esc_url( $post->guid ) ?>">
                <?php esc_html_e( 'Read More', 'asd-book-review-pp' ); ?>
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
    do_action( 'abr_search_result_after' );
    ?>
</div>
<?php
