<?php

namespace Asd\BookReviewPlus;

/**
 * Shortcode
 * handler class
 */
class Shortcode {

    /**
     * Initialize the class
     *
     * @since  1.0.0
     */
    public function __construct() {
		add_shortcode( 'asd-book-post-meta-search', [ $this, 'render_shortcode_form' ] );
	}

	/**
	 * Shortcode renderer function
     *
     * @since  1.0.0
	 *
	 * @return void
	 */
	public function render_shortcode_form() {
		/**
		 * Include search form template
		 */
        ob_start();
		require_once ASD_BOOK_REVIEW_PLUS_PATH . "/templates/shortcode_search_form.php";
		echo ob_get_clean();

		/**
		 * Call post meta search
		 * handler method
		 */
		$this->post_meta_search_handler();
	}

	/**
	 * Post meta search handler function
     *
     * @since  1.0.0
	 *
	 * @return void
	 */
	public function post_meta_search_handler() {
		if ( isset( $_GET['book-post-meta-search'] ) && ! empty( $_GET['writter'] ) ) {

			/**
			 * Search input from user
			 */
			$book_writter = $_GET['writter'];

			/**
			 * Book meta query arguments
			 */
			$book_meta_query_args = array(
				'post_type'   => 'book',
				'post_status' => 'publish',
				'meta_query'  => array(
					array(
						'key'     => '_custom_book_meta_key',
						'value'   => $book_writter,
						'compare' => 'LIKE',
					),
				),
			);

			/**
			 * The book meta query
			 */
			$book_meta_query = new \WP_Query( $book_meta_query_args );

			/**
			 * Show output if found
			 */
			if ( $book_meta_query->have_posts() ) {
				$posts = $book_meta_query->posts;

				/**
				 * Single post
				 */
				foreach( $posts as $post ) {
					/**
					 * Include search result viewer
					 */
					ob_start();
					include ASD_BOOK_REVIEW_PLUS_PATH . "/templates/shortcode_search_result_viewer.php";
					echo ob_get_clean();
				}
			} else {
				echo 'No post matched with your query!';
			}
		}
	}
}
