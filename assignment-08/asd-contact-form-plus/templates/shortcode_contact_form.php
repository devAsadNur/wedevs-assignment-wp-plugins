<?php
/**
 * Template: shortcode contact form
 *
 * HMTL template for shortcode contact form
 *
 * @since 1.0.0
 */
?>
<div class="contact-form-wrapper">
    <h2 class="cf-title"><?php esc_html_e( $title, 'asd-contact-plus' ); ?></h2>
    <h4 class="cf-desc"><?php esc_html_e( $description, 'asd-contact-plus' ); ?></h4>
    <form id="asd-contact-form" action="#" method="POST">
        <?php
        /**
         * Action hook for adding contents
         * before contact form fields
         *
         * @since 1.0.0
         */
        do_action( 'asd_sc_cfs_fields_before' );

        /**
         * Contact form fields
         *
         * @since 1.0.0
         */
        ?>
        <div class="input-field-single">
            <label for="fname"><?php esc_html_e( 'First Name', 'asd-contact-plus' ); ?>* :</label>
            <input type="text" name="fname" id="cf-fname" placeholder="<?php esc_attr_e( 'Your First Name Here', 'asd-contact-plus' ); ?>">
        </div>

        <div class="input-field-single">
            <label for="lname"><?php esc_html_e( 'Last Name', 'asd-contact-plus' ); ?>* :</label>
            <input type="text" name="lname" id="cf-lname" placeholder="<?php esc_attr_e( 'Your Last Name Here', 'asd-contact-plus' ); ?>">
        </div>

        <div class="input-field-single">
            <label for="email"><?php esc_html_e( 'Email', 'asd-contact-plus' ); ?>* :</label>
            <input type="email" name="email" id="cf-email" placeholder="<?php esc_attr_e( 'Your Email Here', 'asd-contact-plus' ); ?>">
        </div>

        <div class="input-field-single">
            <label for="message"><?php esc_html_e( 'Message', 'asd-contact-plus' ); ?>:</label>
            <textarea name="message" id="cf-message" cols="30" rows="3" placeholder="<?php esc_attr_e( 'Your Message Here', 'asd-contact-plus' ); ?>"></textarea>
        </div>

        <input type="hidden" name="action" value="asd-sc-contact-form">
        <?php wp_nonce_field( 'asd-sc-cfp' ); ?>

        <input type="submit" id="cf-submit" value="<?php apply_filters( 'asd_sc_cf_submit', esc_html_e( 'Send Enquery', 'asd-contact-plus' ) ); ?>">
        <?php
        /**
         * Action hook for adding contents
         * after contact form fields
         *
         * @since 1.0.0
         */
        do_action( 'asd_sc_cfs_fields_after' );
        ?>
    </form>
</div>
<?php
