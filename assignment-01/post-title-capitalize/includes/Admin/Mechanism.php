<?php

namespace PostTitleCapitalize\Admin;

/**
 * The mechanism handler class
 */
class Mechanism {

    /**
     * Initialize the class
     */
    public function __construct() {
        add_filter( 'wp_insert_post_data', [ $this, 'post_title_handler' ] );
    }

    public function post_title_handler($content) {

        $content['post_title'] = ucwords($content['post_title']);
        
        return $content;
    }
    
}