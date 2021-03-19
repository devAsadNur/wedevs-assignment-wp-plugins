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
    do_action( 'abrp_search_form_field_before' );

    /**
     * HTML form field
     */
    ?>
    <div>
        <input name="writter" type="text" id="writter" required>
        <input name="book-post-meta-search" type="submit" value="Search Book Review">
    </div>
    <?php

    /**
     * Action hook for adding contents
     * after input fileds
     *
     * @since 1.0.0
     */
    do_action( 'abrp_search_form_field_after' );
    ?>
</form>
<?php
