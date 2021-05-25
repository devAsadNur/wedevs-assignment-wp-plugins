<?php

namespace Asd\BookReviewPro;

/**
 * Assets
 * handler class
 */
class Assets {

    /**
     * Initialize the class
     *
     * @since  1.0.0
     */
    public function __construct() {
        add_action( 'wp_enqueue_scripts', [ $this, 'register_assets' ] );
    }

    /**
     * Scripts getter function
     *
     * @since 1.0.0
     *
     * @return array
     */
    public function get_scripts() {
        $scripts = apply_filters( 'asd_brp_scripts', [
            'asd-rating-plugin-script' => [
                'src'       => ASD_BOOK_REVIEW_PRO_ASSETS . '/js/rater.min.js',
                'version'   => filemtime( ASD_BOOK_REVIEW_PRO_PATH . '/assets/js/rater.min.js' ),
                'deps'      => [ 'jquery' ],
                'in_footer' => true,
            ],
            'asd-rating-handler-script' => [
                'src'       => ASD_BOOK_REVIEW_PRO_ASSETS . '/js/rating-handler.js',
                'version'   => filemtime( ASD_BOOK_REVIEW_PRO_PATH . '/assets/js/rating-handler.js' ),
                'deps'      => [ 'jquery' ],
                'in_footer' => true,
            ],
        ] );

        return $scripts;
    }

    /**
     * Styles getter function
     *
     * @since 1.0.0
     *
     * @return array
     */
    public function get_styles() {
        $styles = apply_filters( 'asd_brp_styles', [
            'asd-book-review-style' => [
                'src'     => ASD_BOOK_REVIEW_PRO_ASSETS . '/css/book-review.css',
                'version' => filemtime( ASD_BOOK_REVIEW_PRO_PATH . '/assets/css/book-review.css' ),
            ],
        ] );

        return $styles;
    }

    /**
     * Assets register function
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function register_assets() {
        $scripts = $this->get_scripts();
        $styles  = $this->get_styles();

        foreach ( $scripts as $handle => $script ) {
            $deps      = isset( $script['deps'] ) ? $script['deps'] : [];
            $version   = isset( $script['version'] ) ? $script['version'] : false;
            $in_footer = isset( $script['in_footer'] ) ? $script['in_footer'] : false;

            /**
             * Register each of the scripts
             */
            wp_register_script( $handle, $script['src'], $deps, $version, $in_footer);
        }

        foreach ($styles as $handle => $style) {
            $deps    = isset( $style['deps'] ) ? $style['deps'] : [];
            $version = isset( $style['version'] ) ? $style['version'] : false;
            $media   = isset( $style['media'] ) ? $style['media'] : 'all';

            /**
             * Register each of the styles
             */
            wp_register_style( $handle, $style['src'], $deps, $version, $media );
        }

        /**
         * Book rating localized script
         */
        wp_localize_script( 'asd-rating-handler-script', 'objRating', [
            'ajaxurl'      => admin_url( 'admin-ajax.php' ),
            'rating_nonce' => wp_create_nonce( 'book-review-nonce' ),
            'error'        => __( 'Something went wrong!', 'asd-book-review-pro' ),
        ] );
    }
}
