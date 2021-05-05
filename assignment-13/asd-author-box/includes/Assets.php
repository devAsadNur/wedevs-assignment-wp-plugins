<?php

namespace Asd\Author\Box;

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
     * Assets register function
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function register_assets() {
        $style = [
            'handle'  => 'asd-author-box-style',
            'src'     => ASD_AUTHOR_BOX_ASSETS . '/css/author-box.css',
            'version' => filemtime( ASD_AUTHOR_BOX_PATH . '/assets/css/author-box.css' ),
            'deps'    => []
        ];

        wp_register_style( $style['handle'], $style['src'], $style['version'], $style['deps'] );
    }
}
