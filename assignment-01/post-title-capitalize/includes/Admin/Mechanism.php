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
        $this->post_title_capitalize_mechanism();
    }

    /**
     * Post title capitalize filter function
     *
     * @return void
     */
    public function post_title_capitalize_mechanism() {
        add_filter( 'wp_insert_post_data', [ $this, 'post_title_handler' ] );
    }

    /**
     * Post title handler function
     *
     * @param [array] $content
     * @return void
     */
    public function post_title_handler($content) {
        $content['post_title'] = ucwords($content['post_title']);
        
        return $content;
    }
    
}