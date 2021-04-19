<?php
/**
 * Action hook for adding contents
 * before input fields
 *
 * @since 1.0.0
 */
do_action( 'abrp_metabox_book_form_field_before' );

/**
 * Template: metabox book input fields
 *
 * HMTL input fields for book metabox
 *
 * @since 1.0.0
 */
?>
<div>
    <label for="writter"><?php esc_html_e( 'Writter', 'asd-book-review-plus' ); ?>: </label>
    <input type="text" name="writter" id="writter" class="widefat" value="<?php esc_attr_e( $book_meta_value_writter, 'asd-book-review-plus' ); ?>"><br><br>
</div>
<div>
    <label for="isbn"><?php esc_html_e( 'ISBN', 'asd-book-review-plus' ); ?>: </label>
    <input type="text" name="isbn" id="isbn" class="widefat" value="<?php echo esc_attr( $book_meta_value_isbn, 'asd-book-review-plus' ); ?>"><br><br>
</div>
<div>
    <label for="year"><?php esc_html_e( 'Publishing Year', 'asd-book-review-plus' ); ?>: </label>
    <input type="date" name="year" id="year" class="widefat" value="<?php echo esc_attr( $book_meta_value_year, 'asd-book-review-plus' ); ?>"><br><br>
</div>
<div>
    <label for="price"><?php esc_html_e( 'Price', 'asd-book-review-plus' ); ?>: </label>
    <input type: name="price" id="price" class="widefat" value="<?php echo esc_attr( $book_meta_value_price, 'asd-book-review-plus' ); ?>"><br><br>
</div>
<div>
    <label for="description"><?php esc_html_e( 'Short Description', 'asd-book-review-plus' ); ?>: </label>
    <textarea name="description" id="description" class="widefat"><?php echo esc_textarea( $book_meta_value_desc, 'asd-book-review-plus' ); ?></textarea><br><br>
</div>
<?php

/**
 * Action hook for adding contents
 * after input fields
 *
 * @since 1.0.0
 */
do_action( 'abrp_metabox_book_form_field_after' );
