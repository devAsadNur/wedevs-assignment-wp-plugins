<?php

namespace PostsView\Frontend;

/**
 * Frontend view handler class
 */
class View {

    /**
     * Initializes the class
     */
    function __construct() {
        add_filter( 'the_content', [ $this, 'pvc_set_post_view' ] );
        add_filter( 'the_content', [ $this, 'pvc_get_post_view' ] );
    }

    public function pvc_get_post_view($content) {

        global $post;

        if( $post->post_type === 'post' && is_single() ) {
            
            $post_id = get_the_ID();
            $post_id = $post->ID;
            $key = 'post_views_count';
            $count = get_post_meta( $post_id, $key, true );
    
            $msg = '';
            
            $msg .= '<h3>Post Views: ' .'<';
    
    
            $msg .= apply_filters( 'custom_html_tag', 'b');
    
            $msg .= '>' . $count .'</';
    
            $msg .= apply_filters( 'custom_html_tag', 'b');
    
            $msg .= '>' . '</h3>';
    
            echo $msg;
        }

        return $content;
    }

    public function pvc_set_post_view($content) {
        global $post;

        if( $post->post_type === 'post' && is_single() ) {
        $post_id = get_the_ID();
        $key = 'post_views_count';

        $count = (int) get_post_meta( $post_id, $key, true );
        $count++;


        update_post_meta( $post_id, $key, $count );

        }

        return $content;

    }

}