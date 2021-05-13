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
        return [
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
        ];
    }

    /**
     * Styles getter function
     *
     * @since 1.0.0
     *
     * @return array
     */
    public function get_styles() {
        return [
            'asd-book-review-style' => [
                'src'       => ASD_BOOK_REVIEW_PRO_ASSETS . '/css/book-review.css',
                'version'   => filemtime( ASD_BOOK_REVIEW_PRO_PATH . '/assets/css/book-review.css' ),
            ],
        ];
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
            $in_footer = isset( $script['in_footer'] ) ? $script['in_footer'] : false;

            /**
             * Register each of the scripts
             */
            wp_register_script( $handle, $script['src'], $deps, $script['version'], $in_footer);
        }

        foreach ($styles as $handle => $style) {
            $deps  = isset( $style['deps'] ) ? $style['deps'] : [];
            $media = isset( $style['media'] ) ? $style['media'] : 'all';

            /**
             * Register each of the styles
             */
            wp_register_style( $handle, $style['src'], $deps, $style['version'], $media );
        }

        /**
         * Book rating localized script
         */
        wp_localize_script( 'asd-rating-handler-script', 'objRating', [
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
            'nonce'   => wp_create_nonce( 'book-review-nonce' ),
            'action'  => 'asd-book-rating',
            'error'   => __( 'Something went wrong!', 'asd-book-review-pro' ),
        ] );
    }
}
