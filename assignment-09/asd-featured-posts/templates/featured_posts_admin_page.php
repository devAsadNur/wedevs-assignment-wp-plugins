<?php
/**
 * Template: featured posts admin page
 *
 * HMTL template for featured posts setting page
 *
 * @since 1.0.0
 */
?>
<div class="featured-posts-admin-wrapper">
    <form action="options.php" method="post">
    <?php
    settings_fields( 'featured-posts' );
    do_settings_sections( 'featured-posts' );
    submit_button( __( 'Save Changes', 'asd-featured-posts' ), 'primary', 'featured-posts-setting' );
    ?>
    </form>
</div>
<?php
