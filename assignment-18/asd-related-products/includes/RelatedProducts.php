<?php

namespace Asd\RelatedProducts;

/**
 * Related products
 * handler class
 */
class RelatedProducts {

    /**
     * Initialize the class
     *
     * @since  1.0.0
     */
    public function __construct() {
        add_filter( 'woocommerce_product_tabs', [ $this, 'add_related_products_tab' ] );
        add_action( 'woocommerce_shop_loop_item_title', [ $this, 'display_product_description' ], 5 );
        add_action( 'single_template', [ $this, 'add_product_to_cart_on_visit' ] );
    }

    /**
     * Adds related products tab
     *
     * @since 1.0.0
     *
     * @param array $tabs
     *
     * @return array
     */
    public function add_related_products_tab( $tabs ) {
        $tabs['related_products'] = array(
            'title' => __( 'Related Products', 'asd-related-products' ),
            'priority' => 20,
            'callback' => [ $this, 'related_products_tab_content_cb' ],
        );

        return $tabs;
    }

    /**
     * Related products tab content callback
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function related_products_tab_content_cb() {
        $args = array(
            'posts_per_page' => 5,
            'orderby'        => 'rand',
        );

        wc_set_loop_prop( 'related', 'on' );

        $related_products = woocommerce_related_products( $args );

        wc_set_loop_prop( 'related', '' );

        return $related_products;
    }

    /**
     * Displays product description
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function display_product_description() {
        global $product;

        if ( 'on' === wc_get_loop_prop( 'related' ) ) {
            $product_description = $product->get_description();

            echo $product_description;
        }
    }

    /**
     * Adds product to cart on visit
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function add_product_to_cart_on_visit() {
        if ( ! is_admin() && is_singular( 'product' ) ) {
            $product_id = get_the_ID();
            $cart       = WC()->cart->get_cart();
            $found      = false;

            if ( sizeof( $cart ) > 0 ) {
                // Looping through each of the existing cart items
                foreach ( $cart as $cart_item_key => $cart_item_value ) {
                    if ( $product_id === $cart_item_value['product_id'] ) {
                        $found = true;
                    }
                }

                if ( ! $found ) {
                    WC()->cart->add_to_cart( $product_id );
                }
            } else {
                WC()->cart->add_to_cart( $product_id );
            }
        }
    }
}
