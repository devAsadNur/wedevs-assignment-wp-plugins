<?php

namespace PostsVeiwExtend;

/**
 * Shortcome
 * handler class
 */
class Shortcode {

    /**
     * Initialize the class
     */
    public function __construct() {
        add_shortcode( 'asd-post-view-count-list', [ $this, 'render_post_view_list' ] );
    }
    
    /**
	 * Post list renderer function
     *
     * @since  1.0.0
     *
     * @param array $atts
     * @param string $content
     *
     * @return void
     */
    public function render_post_view_list( $atts, $content = '' ) {
        $atts = shortcode_atts( array(
            'id'       => '',
            'category' => '',
            'total'    => '10',
            'order'    => 'DESC',
        ), $atts );
        
        $args = array(
            'post_type'      => 'post',
            'meta_key'       => 'post_views_count',
            'posts_per_page' => $atts['total'],
            'order'          => $atts['order'],
            'orderby'        => 'meta_value_num'
        );
        
        if ( $atts['id'] ) {
            $ids = explode( ',', $atts['id'] );
            $args['post__in'] = $ids;
        }
        elseif ( $atts['category'] ) {
            $args['category_name'] = $atts['category'];
        }
        
        $the_query = new \WP_Query( $args );
        
        if ( $the_query->have_posts() ) {
            $posts = $the_query->posts;
            
            ob_start();
            ?>
            <ol>
            <?php
            
            foreach( $posts as $post) {
                $post_view_counter_meta = get_post_meta( $post->ID, 'post_views_count' );
                
                ?>
                <li><?php esc_html_e( $post->post_title . ' : ' . $post_view_counter_meta[0] . ' Views' , 'post-excerpt' ); ?></li>
                <?php
            }
                
            ?>
            </ol>
            <?php
            echo ob_get_clean();
        }
    }
}