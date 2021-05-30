<?php
/**
 * Action hook for adding contents
 * before cat facts
 *
 * @since 1.0.0
 */
do_action( 'dbw_cat_facts_content_before' );

/**
 * Template: Cat facts widget output template
 *
 * HMTL template for cat facts dashboard widget outputs
 *
 * @since 1.0.0
 */
?>
<ol class="cat-facts-list">
    <?php
    /**
     * Action hook for adding contents
     * before single cat fact
     *
     * @since 1.0.0
     */
    do_action( 'dbw_cat_facts_single_content_before' );

    /**
     * Single cat fact HTML markup
     */
    foreach ( $cat_facts as $cat_fact ) {
        ?>
        <li class="cat-facts-item"><?php echo esc_html( $cat_fact->text ); ?></li>
        <?php
    }

    /**
     * Action hook for adding contents
     * after single cat fact
     *
     * @since 1.0.0
     */
    do_action( 'dbw_cat_facts_single_content_after' );

    ?>
</ol>
<?php

/**
 * Action hook for adding contents
 * after cat facts
 *
 * @since 1.0.0
 */
do_action( 'dbw_cat_facts_content_after' );
