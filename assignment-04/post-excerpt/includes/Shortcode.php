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
		add_shortcode( 'asd-post-excerpt', [ $this, 'render_custom_excerpt' ] );
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

			ob_start();
			?>
			<ol>
			<?php

			foreach( $posts as $post) {
				$post_meta_excerpt = get_post_meta( $post->ID, '_custom_exerpt_meta_key' );

				?>
				<li><?php esc_html_e( $post_meta_excerpt[0], 'post-excerpt' ); ?></li>
				<?php
			}

			?>
			</ol>
			<?php
			echo ob_get_clean();
		}
	}
}
