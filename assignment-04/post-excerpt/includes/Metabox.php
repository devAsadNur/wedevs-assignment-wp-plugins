<?php

/**
 * Metabox
 * handler class
 */
class Metabox {

    /**
     * Initialize the class
     */
    public function __construct() {
		add_action( 'add_meta_boxes', [ $this, 'custom_excerpt_meta_box_handler' ] );
		add_action( 'save_post', [ $this, 'post_excerpt_metabox_save_postdata' ] );
	}

	/**
	 * Meta box handler function
	 *
	 * @since  1.0.0
	 *
	 * @return void
	 */
	public function custom_excerpt_meta_box_handler() {
		add_meta_box(
			'post_excerpt_custom_meta_box',
			'Custom Post Excerpt',
			[ $this, 'post_excerpt_metabox_html_handler' ],
			'post'
		);

	}

	/**
	 * Metabox data fetcher function
	 *
	 * @since  1.0.0
	 *
	 * @param object $post
	 *
	 * @return void
	 */
	public function post_excerpt_metabox_html_handler( $post ) {
		$value = get_post_meta( $post->ID, '_custom_exerpt_meta_key', true );
		?>
		<textarea name="custom_exerpt_field" class="widefat"><?php esc_html_e( $value ); ?></textarea>
		<?php
	}

	/**
	 * Metabox data updater function
	 *
	 * @since  1.0.0
	 *
	 * @param int $post_id
	 *
	 * @return void
	 */
	public function post_excerpt_metabox_save_postdata( $post_id ) {
		if ( array_key_exists( 'custom_exerpt_field', $_POST ) ) {
			update_post_meta(
				$post_id,
				'_custom_exerpt_meta_key',
				$_POST['custom_exerpt_field']
			);
		}
	}

}
