<?php
/**
 * Template: Customer's purchase details section
 *
 * HMTL template for preview customer's purchase details
 *
 * @since 1.0.0
 */
?>
<div class="" style="width:100%">
    <div class="dokan-panel dokan-panel-default">
        <div class="dokan-panel-heading"><strong><?php esc_html_e( 'Customer\'s Purchase Details', 'asd-customer-total-purchase' ); ?></strong></div>
        <div class="dokan-panel-body general-details">
            <ul class="list-unstyled order-status">
                <?php

                /**
                 * Action hook for adding contents
                 * before customer's purchase fields
                 *
                 * @since 1.0.0
                 */
                do_action( 'asd_dokan_customer_purchase_filds_before' );
                ?>
                <li><span><?php esc_html_e( 'Total Purchase:', 'asd-customer-total-purchase' ); ?> </span><?php echo esc_html( $total_purchase ); ?></li>
                <li><span><?php esc_html_e( 'Customer\'s Label:', 'asd-customer-total-purchase' ); ?> </span><span class="dokan-label dokan-label-primary"><?php echo esc_html( $customer_label ); ?></span></li>
                <?php

                /**
                 * Action hook for adding contents
                 * after customer's purchase fields
                 *
                 * @since 1.0.0
                 */
                do_action( 'asd_dokan_customer_purchase_filds_after' );
                ?>
            </ul>
        </div>
    </div>
</div>
<?php
