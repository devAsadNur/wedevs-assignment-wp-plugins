<?php
/**
 * Action hook for adding contents
 * before input fields
 *
 * @since 1.0.0
 */
do_action( 'br_book_metabox_form_fields_before', $post->ID );

/**
 * Template: metabox book input fields
 *
 * HMTL input fields for book metabox
 *
 * @since 1.0.0
 */
?>
<div>
    <label for="writter"><?php esc_html_e( 'Writter', 'asd-book-review-pro' ); ?>: </label>
    <input type="text" name="writter" id="writter" class="widefat" value="<?php echo esc_attr( $book_meta_value_writter ); ?>"><br><br>
</div>
<div>
    <label for="isbn"><?php esc_html_e( 'ISBN', 'asd-book-review-pro' ); ?>: </label>
    <input type="text" name="isbn" id="isbn" class="widefat" value="<?php echo esc_attr( $book_meta_value_isbn ); ?>"><br><br>
</div>
<div>
    <label for="year"><?php esc_html_e( 'Publishing Year', 'asd-book-review-pro' ); ?>: </label>
    <input type="date" name="year" id="year" class="widefat" value="<?php echo esc_attr( $book_meta_value_year ); ?>"><br><br>
</div>
<div>
    <label for="price"><?php esc_html_e( 'Price', 'asd-book-review-pro' ); ?>: </label>
    <input type: name="price" id="price" class="widefat" value="<?php echo esc_attr( $book_meta_value_price ); ?>"><br><br>
</div>
<div>
    <label for="description"><?php esc_html_e( 'Short Description', 'asd-book-review-pro' ); ?>: </label>
    <textarea name="description" id="description" class="widefat"><?php echo esc_textarea( $book_meta_value_desc ); ?></textarea><br><br>
</div>
<?php

/**
 * Action hook for adding contents
 * after input fields
 *
 * @since 1.0.0
 */
do_action( 'br_book_metabox_form_fields_after', $post->ID );
