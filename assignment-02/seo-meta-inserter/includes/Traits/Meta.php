<?php

namespace SeoMetaInserter\Traits;

/**
 * Assets handler class
 */
class Meta {

    /**
     * Initializes the class
     */
    public function __construct() {
        add_action( 'wp_head', [ $this, 'seo_meta_handler' ] );
    }

    /**
     * Meta handler function
     *
     * @return void
     */
    public function seo_meta_handler() {
        $meta_text = '<meta name="website:custom-info" content="Some custom description text" />';
        echo $meta_text;
    }

}