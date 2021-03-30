<?php
/**
 * Action hook for adding contents
 * before input fields
 *
 * @since 1.0.0
 */
do_action( 'abr_metabox_book_form_field_before' );

/**
 * Template: metabox book input fields
 *
 * HMTL input fields for book metabox
 *
 * @since 1.0.0
 */
?>
<div>
    <label for="writter"><?php esc_html_e( 'Writter', 'asd-book-review' ); ?>: </label>
    <input type="text" name="writter" id="writter" class="widefat" value="<?php esc_html_e( $this->book_meta_values['writter'], 'asd-book-review' ); ?>"><br><br>
</div>
<div>
    <label for="isbn"><?php esc_html_e( 'ISBN', 'asd-book-review' ); ?>: </label>
    <input type="text" name="isbn" id="isbn" class="widefat" value="<?php esc_html_e( $this->book_meta_values['isbn'], 'asd-book-review' ); ?>"><br><br>
</div>
<div>
    <label for="year"><?php esc_html_e( 'Publishing Year', 'asd-book-review' ); ?>: </label>
    <input type="date" name="year" id="year" class="widefat" value="<?php esc_html_e( $this->book_meta_values['year'], 'asd-book-review' ); ?>"><br><br>
</div>
<div>
    <label for="price"><?php esc_html_e( 'Price', 'asd-book-review' ); ?>: </label>
    <input type: name="price" id="price" class="widefat" value="<?php esc_html_e( $this->book_meta_values['price'], 'asd-book-review' ); ?>"><br><br>
</div>
<div>
    <label for="description"><?php esc_html_e( 'Short Description', 'asd-book-review' ); ?>: </label>
    <textarea name="description" id="description" class="widefat"><?php echo esc_textarea( $this->book_meta_values['description'], 'asd-book-review' ); ?></textarea><br><br>
</div>
<?php

/**
 * Action hook for adding contents
 * after input fields
 *
 * @since 1.0.0
 */
do_action( 'abr_metabox_book_form_field_after' );
