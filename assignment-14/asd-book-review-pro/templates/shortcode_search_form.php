<?php
/**
 * Template: shortcode search form
 *
 * HMTL form template for search form
 *
 * @since 1.0.0
 */
?>
<h3><?php esc_html_e( 'Search for Book Review', 'asd-book-review-pro' ); ?></h3>

<form id="book-review-search-form" action="" method="GET">
    <?php
    /**
     * Action hook for adding contents
     * before input fileds
     *
     * @since 1.0.0
     */
    do_action( 'abr_search_field_before' );

    /**
     * HTML form field
     */
    ?>
    <div>
        <input name="keyword" type="text" id="keyword" <?php esc_attr_e( 'Input text here', 'asd-book-review-pro' ); ?>" required>
        <?php wp_nonce_field( 'book-review-search' ); ?>
        <input name="book-post-meta-search" type="submit" value="<?php esc_attr_e( 'Search Book Review', 'asd-book-review-pro' ); ?>">
    </div>
    <?php

    /**
     * Action hook for adding contents
     * after input fileds
     *
     * @since 1.0.0
     */
    do_action( 'abr_search_field_after' );
    ?>
</form>
<?php
