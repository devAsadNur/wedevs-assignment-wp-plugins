<?php
/**
 * Template: featured posts shortcode
 *
 * HMTL template for featured posts
 *
 * @since 1.0.0
 */
?>
<div class="single-featured-post">
    <h2><a href="<?php echo esc_url( $post->guid ); ?>"><?php esc_html_e( $post->post_title, 'asd-featured-posts' ); ?></a></h2>
    <p><?php echo esc_html( $post->post_date ); ?></p>
    <p>
        <?php esc_html_e( $post->post_excerpt, 'asd-featured-posts' ); ?>
        <a href="<?php echo esc_url( $post->guid ); ?>"><?php esc_html_e( 'Read More', 'asd-featured-posts' ); ?></a>
    </p>
</div>
<?php
