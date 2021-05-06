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
    <h4 class="author-name"><?php echo esc_html( $author_name ); ?></h4>
    <div class="social-buttons">
        <?php
        if ( ! empty( $author_facebook ) ) {
            ?>
            <a class="btn-facebook" href="<?php echo esc_url( $author_facebook ); ?>" target="_blank"><?php esc_html_e( 'Facebook', 'asd-author-box' ); ?></a>
            <?php
        }
        if ( ! empty( $author_twitter ) ) {
            ?>
            <a class="btn-twitter" href="<?php echo esc_url( $author_twitter ); ?>" target="_blank"><?php esc_html_e( 'Twitter', 'asd-author-box' ); ?></a>
            <?php
        }
        if ( ! empty( $author_linkedin ) ) {
            ?>
            <a class="btn-linkedin" href="<?php echo esc_url( $author_linkedin ); ?>" target="_blank"><?php esc_html_e( 'Linkedin', 'asd-author-box' ); ?></a>
            <?php
        }
        ?>
    </div>
    <?php
    if ( ! empty( $author_bio ) ) {
        ?>
            <p class="author-bio"><?php echo esc_html( $author_bio ); ?></p>
        <?php
    }
    ?>
</div>
<?php
