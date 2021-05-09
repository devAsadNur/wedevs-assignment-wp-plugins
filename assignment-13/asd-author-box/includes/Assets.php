<?php

namespace Asd\AuthorBox;

/**
 * The assets
 * handler
 * class
 */
class Assets {

    /**
     * Initializes the class
     *
     * @since 1.0.0
     */
    public function __construct() {
        add_action( 'wp_enqueue_scripts', [ $this, 'register_assets' ] );
    }

    /**
     * Styles getter function
     *
     * @since 1.0.0
     *
     * @return array
     */
    public function get_styles() {
        $styles = apply_filters( 'asd_author_box_styles', [
            'asd-author-box-style' => [
                'src'     => ASD_AUTHOR_BOX_ASSETS . '/css/author-box.css',
                'version' => filemtime( ASD_AUTHOR_BOX_PATH . '/assets/css/author-box.css' ),
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
        $styles = $this->get_styles();

        foreach ( $styles as $handle => $style ) {
            $deps    = isset( $style['deps'] ) ? $style['deps'] : [];
            $version = isset( $style['version'] ) ? $style['version']: false;
            $media   = isset( $style['media'] ) ? $style['media'] : 'all';

            // Register each of the styles
            wp_register_style( $handle, $style['src'], $deps, $version, $media );
        }
    }
}
