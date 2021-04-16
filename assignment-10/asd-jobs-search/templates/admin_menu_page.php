<?php
/**
 * Template: Admin menu page
 *
 * HMTL template for dashboard admin menu page
 *
 * @since 1.0.0
 */
?>
<div class="menu-page-content">
    <h1><?php esc_html_e( 'Jobs Search: Shortcode Documentation', 'asd-jobs-search' ); ?></h1><br>
    <h2><?php esc_html_e( 'Job searcing shortcode use guide', 'asd-jobs-search' ); ?>:</h2>
    <h4><?php esc_html_e( 'Shortcode format', 'asd-jobs-search' ); ?>:</h4>
    <h5><?php esc_html_e( 'Without attributes', 'asd-jobs-search' ); ?>:</h5>
    <p><?php echo esc_html('[asd-jobs-search]' ); ?></p>
    <h5><?php esc_html_e( 'With attributes', 'asd-jobs-search' ); ?>*:</h5>
    <p><?php echo esc_html('[asd-jobs-search keyword="job keyword" location="location name"  fulltime="on"]' ); ?></p>
    <p>* <?php esc_html_e( 'User search inputs will overwrite the shortcode attributes.', 'asd-jobs-search' ); ?></p>
</div>
<?php
