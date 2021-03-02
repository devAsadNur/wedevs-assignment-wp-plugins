<?php

namespace PostsViewPlus\Frontend;

/**
 * Frontend view handler class
 */
class View {

    /**
     * Initializes the class
     */
    function __construct() {
        add_filter( 'custom_html_tag', [ $this, 'tag_modifier' ] );
    }

    function tag_modifier($content) {
        $content = 'em';
        return $content;
    }

}