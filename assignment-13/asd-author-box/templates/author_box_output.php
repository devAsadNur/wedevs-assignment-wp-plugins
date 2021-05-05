<?php
/**
 * Template: Author box
 *
 * HMTL frontend template for author box output
 *
 * @since 1.0.0
 */
?>
<div class="author-box-wrapper">
    <?php echo get_avatar( $author_id ); ?>
    <h4 class="author-name"><?php esc_html_e( $author_name, 'asd-author-box' ); ?></h4>
    <div class="social-buttons">
        <a class="btn-facebook" href="<?php echo esc_url( $author_facebook ); ?>" target="_blank"><?php esc_html_e( 'Facebook', 'asd-author-box' ); ?></a>
        <a class="btn-twitter" href="<?php echo esc_url( $author_twitter ); ?>" target="_blank"><?php esc_html_e( 'Twitter', 'asd-author-box' ); ?></a>
        <a class="btn-linkedin" href="<?php echo esc_url( $author_linkedin ); ?>" target="_blank"><?php esc_html_e( 'Linkedin', 'asd-author-box' ); ?></a>
    </div>
    <p class="author-bio"><?php echo esc_html_e( $author_bio, 'asd-author-box' ); ?></p>
</div>
<?php
