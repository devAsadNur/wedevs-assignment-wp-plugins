<?php

/**
 * Shortcode
 * handler class
 */
class Shortcode {

    /**
     * Initialize the class
     */
    public function __construct() {
		add_shortcode( 'custom-excerpt-for-post', [ $this, 'render_custom_excerpt' ] );
	}

	/**
	 * Post excerpt renderer function
	 *
	 * @since  1.0.0
	 *
	 * @param array $atts
	 * @param string $content
	 * 
	 * @return void
	 */
	public function render_custom_excerpt( $atts, $content = '' ) {
		$atts = shortcode_atts( array(
			'id'       => '',
			'category' => '',
			'total'    => '10',
		), $atts );

		$args = array(
			'post_type'      => 'post',
			'meta_key'       => '_custom_exerpt_meta_key',
			'posts_per_page' => $atts['total'],
		);

		if ( $atts['id'] ) {
			$ids = explode( ',', $atts['id'] );
			$args['post__in'] = $ids;
		}
		elseif ( $atts['category'] ) {
			$args['category_name'] = $atts['category'];
		}

		$the_query = new WP_Query( $args );

		if ( $the_query->have_posts() ) {
			$posts = $the_query->posts;

			esc_html( '<ol>' );

			foreach( $posts as $post) {
				$post_meta_excerpt = get_post_meta( $post->ID, '_custom_exerpt_meta_key' );

				esc_html( '<li>' . $post_meta_excerpt[0] . '</li>' );
			}

			esc_html( '</ol>' );
		}

	}

}
