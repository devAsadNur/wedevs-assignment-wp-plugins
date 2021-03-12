<?php

namespace AsdBookReview;

/**
 * Metabox
 * handler class
 */
class Metabox {

    /**
     * Initialize the class
     */
    public function __construct() {
		add_action( 'add_meta_boxes', [ $this, 'books_custom_metabox_handler' ] );
		add_action( 'save_post', [ $this, 'books_metabox_update_metadata' ] );
	}

	/**
	 * Metabox handler function
	 *
	 * @return void
	 */
	public function books_custom_metabox_handler() {
		add_meta_box(
            'books_custom_meta_box',
            'Book Details',
            [ $this, 'books_metabox_content_handler' ],
            'book',
		);
	}

	/**
	 * Custom post metadata getter function
	 *
	 * @param  object $post
	 *
	 * @return void
	 */
	public function books_metabox_content_handler( $post ) {
		$book_values = get_post_meta( $post->ID, '_custom_book_meta_key', true );

		ob_start();
		?>
		<form>
			<div>
				<label for="writter">Writter: </label>
				<input type="text" name="writter" id="writter" class="widefat" value="<?php echo esc_html( $book_values['writter'] ); ?>"><br><br>
			</div>
			<div>
				<label for="isbn">ISBN: </label>
				<input type="text" name="isbn" id="isbn" class="widefat" value="<?php echo esc_html( $book_values['isbn'] ); ?>"><br><br>
			</div>
			<div>
				<label for="year">Publishing Date: </label>
				<input type="date" name="year" id="year" class="widefat" value="<?php echo esc_html( $book_values['year'] ); ?>"><br><br>
			</div>
			<div>
				<label for="price">Price: </label>
				<input type: name="price" id="price" class="widefat" value="<?php echo esc_html( $book_values['price'] ); ?>"><br><br>
			</div>
			<div>
				<label for="description">Short Description: </label>
				<textarea name="<?php echo esc_attr( 'description' ); ?>" id="description" class="widefat"><?php echo esc_textarea( $book_values['description'] ); ?></textarea><br><br>
			</div>
		</form>
		<?php
		echo ob_get_clean();
	}

	/**
	 * Custom post metadata setter function
	 *
	 * @param int $post_id
	 *
	 * @return void
	 */
	public function books_metabox_update_metadata( $post_id ) {
		$meta_inputs = array(
			'writter'        => '',
			'isbn'           => '',
			'year'           => '',
			'price'          => '',
			'description'    => '',
		);

		// Assign input values to the input array
		if( isset( $_POST['writter'] ) ) {
			$meta_inputs['writter'] = $_POST['writter'];
		}
		if( isset( $_POST['isbn'] ) ) {
			$meta_inputs['isbn'] = $_POST['isbn'];
		}
		if( isset( $_POST['year'] ) ) {
			$meta_inputs['year'] = $_POST['year'];
		}
		if( isset( $_POST['price'] ) ) {
			$meta_inputs['price'] = $_POST['price'];
		}
		if( isset( $_POST['description'] ) ) {
			$meta_inputs['description'] = $_POST['description'];
		}

		// Update post meta
		if ( $meta_inputs  ) {
			update_post_meta(
                $post_id,
                '_custom_book_meta_key',
				$meta_inputs
			);
		}
	}
}
