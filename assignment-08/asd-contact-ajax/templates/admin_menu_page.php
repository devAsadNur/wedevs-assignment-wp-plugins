<?php
/**
 * Template: admin menu page
 *
 * HMTL template for dashboard menu page
 *
 * @since 1.0.0
 */
?>
<div class="menu-page-content">
    <h1><?php esc_html_e( 'WeContact AJAX Form: Shortcode Documentation', 'asd-contact-ajax' ); ?></h1><br>
    <h2><?php esc_html_e( 'Form with title use guide', 'asd-contact-ajax' ); ?>:</h2>
    <h4><?php esc_html_e( 'Shortcode format', 'asd-contact-ajax' ); ?>:</h4>
    <p><?php echo esc_html('[asd-sc-contact-form title="Title text" description="Description text"] [/asd-sc-contact-form]' ); ?></p>
    <br>
    <h2><?php esc_html_e( 'Individual input field use guide', 'asd-contact-ajax' ); ?>:</h2>
    <h4><?php esc_html_e( 'Shortcode format', 'asd-contact-ajax' ); ?>:</h4>
    <p><?php echo esc_html('[asd-sc-contact-field type="field type" name="field name" label="Field label text" placehoder="Placeholder Text" value="Default value"]' ); ?></p>
</div>
<?php
