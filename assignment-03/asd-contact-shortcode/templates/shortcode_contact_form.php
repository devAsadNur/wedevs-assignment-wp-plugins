<?php
/**
 * Template: shortcode contact form
 *
 * HMTL template for shortcode contact form
 *
 * @since 1.0.0
 */
?>
<div class="form-wrapper">
    <h2><?php esc_html_e( $title, 'asd-contact-shortcode' ); ?></h2>
    <h4><?php esc_html_e( $description, 'asd-contact-shortcode' ); ?></h4>
    <form>
        <?php
        /**
         * Action hook for adding contents
         * before contact form fields
         *
         * @since 1.0.0
         */
        do_action( 'asd_sc_cf_fields_before' );

        /**
         * Contact form fields
         *
         * @since 1.0.0
         */
        echo do_shortcode( $content );
        wp_nonce_field( 'asd-contact-shortcode' );

        /**
         * Action hook for adding contents
         * after contact form fields
         *
         * @since 1.0.0
         */
        do_action( 'asd_sc_cf_fields_after' );
        ?>
    </form>
</div>
<?php
