<?php

namespace Asd\CustomerTotalPurchase;

/**
 * Customer Purchase
 * details class
 */
class CustomerPurchase {

    /**
     * Initialize the class
     *
     * @since  1.0.0
     */
    public function __construct() {
        add_action( 'dokan_order_detail_after_order_general_details', [ $this, 'add_total_purchase_section' ] );
    }

    /**
     * Customer's total purchase section output function
     *
     * @since 1.0.0
     *
     * @param object $order
     *
     * @return void
     */
    public function add_total_purchase_section( $order ) {
        $args = array(
            'email'  => $order->get_billing_email(),
            'status' => 'wc-completed',
        );
        
        $total_purchase = $this->get_customer_total_purchase( $args );
        $customer_label = $this->get_customer_label( $total_purchase );

        // Include customer purchase details template
        ob_start();
        include_once ASD_CUSTOMER_TOTAL_PURCHASE_PATH . '/templates/customers_purchase_section.php';
        echo ob_get_clean();
    }

    /**
     * Customer's total purchase getter function
     *
     * @since 1.0.0
     *
     * @param array $args
     *
     * @return int|float
     */
    public function get_customer_total_purchase( $args ) {
        $defaults = [
            'email'  => '',
            'status' => 'wc-completed',
        ];

        $args   = wp_parse_args( $args, $defaults );
        $orders = wc_get_orders( $args );

        $total_purchase = 0;
        if ( count( $orders ) > 0 ) {
            foreach ( $orders as $order ) {
                $total_purchase += $order->get_total();
            }
        }

        return $total_purchase;
    }

    /**
     * Customer label getter function
     *
     * @since 1.0.0
     *
     * @param int $total_purchase
     *
     * @return string
     */
    public function get_customer_label( $total_purchase = 0 ) {
        if ( $total_purchase > 10000 ) {
            $customer_label = __( 'Diamond', 'asd-customer-total-purchase' );
        } else if ( $total_purchase >= 5000 && $total_purchase <= 10000 ) {
            $customer_label = __( 'Gold', 'asd-customer-total-purchase' );
        } else if ( $total_purchase >= 1000 && $total_purchase < 5000 ) {
            $customer_label = __( 'Silver', 'asd-customer-total-purchase' );
        } else {
            $customer_label = __( 'No labels yet', 'asd-customer-total-purchase' );
        }

        return $customer_label;
    }
}
