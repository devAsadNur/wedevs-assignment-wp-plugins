<?php
/**
 * Template: shortcode search form
 *
 * HMTL form template for search form
 *
 * @since 1.0.0
 */
?>
<h3>Search for Book Review</h3>
<form action="" method="GET">
    <?php
    /**
     * Action hook for adding contents
     * before input fileds
     *
     * @since 1.0.0
     */
    do_action( 'abrp_search_field_before' );

    /**
     * HTML form field
     */
    ?>
    <div>
        <input name="keyword" type="text" id="keyword" required>
        <?php wp_nonce_field( 'book-post-meta-search' ); ?>
        <input name="book-post-meta-search" type="submit" value="<?php esc_html_e( 'Search Book Review', 'asd-book-review-plus' ); ?>">
    </div>
    <?php

    /**
     * Action hook for adding contents
     * after input fileds
     *
     * @since 1.0.0
     */
    do_action( 'abrp_search_field_after' );
    ?>
</form>
<?php
