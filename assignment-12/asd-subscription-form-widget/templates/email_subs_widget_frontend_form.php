<?php
/**
 * Template: Email subscription widget frontend form
 *
 * Subscription form template to collect user email
 *
 * @since 1.0.0
 */
?>
<div class="mc-form-wrapper">
    <?php
    /**
     * Action hook for adding contents
     * before frontend form fields
     *
     * @since 1.0.0
     */
    do_action( 'asd_mc_subs_frontend_form_before' );
    ?>
    <form id="mc-subscription-form" action="#" method="post">
        <label for="mc-email"></label>
        <input type="email" name="mc-email" id="mc-email" placeholder="<?php esc_attr_e( 'Enter your email here', 'asd-subs-form-widget' ); ?>" required>
        <input type="hidden" name="mc-list" value="<?php echo esc_attr( $list ); ?>">
        <input type="hidden" name="action" value="<?php echo esc_attr( 'asd-mc-subscription' ); ?>">

        <?php wp_nonce_field( 'mc-sbuscription-form', '_mc_email_subs_nonce' ); ?>

        <input type="submit" value="<?php esc_attr_e( 'Subscribe', 'asd-subs-form-widget' ) ?>">
    </form>
    <p class ="subscription-message"></p>
    <?php
        /**
         * Action hook for adding contents
         * after frontend form
         *
         * @since 1.0.0
         */
        do_action( 'asd_mc_subs_frontend_form_after' );
        ?>
</div>
<?php
