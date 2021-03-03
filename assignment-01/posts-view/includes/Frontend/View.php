<?php

namespace PostsView\Frontend;

/**
 * Frontend view handler class
 */
class View {

    /**
     * Initializes the class
     */
    public function __construct() {
        $this->pvc_counter_mechanism();
    }

    /**
     * Post view counter mechanism
     *
     * @return void
     */
    public function pvc_counter_mechanism() {
        add_filter( 'the_content', [ $this, 'pvc_set_post_view' ] );
        add_filter( 'the_content', [ $this, 'pvc_get_post_view' ] );
    }

    /**
     * Getting post view counter
     *
     * @param [string] $content
     * @return $content
     */
    public function pvc_get_post_view($content) {
        global $post;

        if( $post->post_type === 'post' && is_single() ) {
            
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

    /**
     * Setting post view counter
     *
     * @param [string] $content
     * @return $content
     */
    public function pvc_set_post_view($content) {
        global $post;

        if( $post->post_type === 'post' && is_single() ) {
            
            $post_id = $post->ID;
            $key = 'post_views_count';

            $count = (int) get_post_meta( $post_id, $key, true );
            $count++;

            update_post_meta( $post_id, $key, $count );

        }

        return $content;
    }

}