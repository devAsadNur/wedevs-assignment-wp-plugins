<?php
/**
 * Template: shortcode featured post viewer
 *
 * HMTL template for preview featured post
 *
 * @since 1.0.0
 */
?>
<div class="single-post">
<?php
    /**
     * Action hook for adding contents
     * before single featured post
     *
     * @since 1.0.0
     */
    do_action( 'asd_sc_single_featured_post_before' );

    /**
     * Single post markup
     */
    ?>
    <div class="container wrapper single-post-wrapper default-max-width clearfix"">
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
                <?php esc_html_e( 'Read More', 'asd-book-review-pro' ); ?>
            </a>
        </p>
    </div>
    <?php

    /**
     * Action hook for adding contents
     * after single featured post
     *
     * @since 1.0.0
     */
    do_action( 'asd_sc_single_featured_post_after' );
    ?>
</div>
<?php
