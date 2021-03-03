<?php

namespace PostsViewPlus\Frontend;

/**
 * Frontend view handler class
 */
class View {

    /**
     * Initializes the class
     */
    public function __construct() {
        $this-> pvcp_counter_mechanism();
    }

    /**
     * Mechanism filter applying function
     *
     * @return void
     */
    public function pvcp_counter_mechanism() {
        add_filter( 'custom_html_tag', [ $this, 'pvcp_tag_modifier' ] );
    }

    /**
     * HTML Tag modifier
     *
     * @param [string] $content
     * @return void
     */
    public function pvcp_tag_modifier($content) {
        $content = 'em';
        return $content;
    }

}