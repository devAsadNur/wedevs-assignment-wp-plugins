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
    <form id="mc-subscription-form" action="#" method="post">
        <label for="mc-email"></label>
        <input type="email" name="mc-email" id="mc-email" placeholder="<?php esc_attr_e( 'Enter your email here', 'asd-subs-form-widget' ); ?>" required>
        <input type="hidden" name="mc-list" value="<?php echo esc_attr( $list ); ?>">
        <input type="hidden" name="action" value="<?php echo esc_attr( 'asd-mc-subscription' ); ?>">
        <?php wp_nonce_field( 'mc-sbuscription-form' ); ?>
        <input type="submit" value="<?php esc_attr_e( 'Subscribe', 'asd-subs-form-widget' ) ?>">
    </form>
    <p class ="subscription-message"></p>
</div>
<?php
