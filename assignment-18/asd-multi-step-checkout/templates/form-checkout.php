<?php
/**
 * Custom Checkout Form
 *
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
    echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'asd-multi-step-checkout' ) ) );
    return;
}
?>

<!-- Checkout Form Start -->
<form name="checkout" method="post" id="regForm" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

<!-- One "tab" for each step in the form: -->
    <?php if ( $checkout->get_checkout_fields() ) : ?>
    <div class="tab">
        <section>
            <?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>
            <div id="customer_details">
                <div>
                    <?php do_action( 'woocommerce_checkout_billing' ); ?>
                </div>
            </div>
            <?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>
        </section>
    </div>

    <div class="tab">
        <section>
            <?php do_action( 'woocommerce_checkout_shipping' ); ?>
        </section>
    </div>
    <?php endif; ?>

    <div class="tab">
        <section class="clearfix" style="overflow: hidden;">
            <?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>
            <h3 id="order_review_heading"><?php esc_html_e( 'Your order', 'asd-multi-step-checkout' ); ?></h3>
            <?php do_action( 'woocommerce_checkout_before_order_review' ); ?>
            <div id="order_review" class="woocommerce-checkout-review-order">
                <?php do_action( 'woocommerce_checkout_order_review' ); ?>
            </div>
            <?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
        </section>
    </div>

    <!-- Navigate the steps of the form: -->
    <div class="multi-checkout-nav">
        <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
        <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
    </div>

    <!-- Circles which indicates the steps of the form: -->
    <div style="text-align:center; margin-top:40px;">
        <span class="step"></span>
        <span class="step"></span>
        <span class="step"></span>
    </div>
</form>
<!-- Checkout Form End -->

<?php
do_action( 'woocommerce_after_checkout_form', $checkout );
