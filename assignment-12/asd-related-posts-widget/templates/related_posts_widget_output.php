<?php
/**
 * Template: related posts widget output
 *
 * HMTL preview template for releted posts widget output
 *
 * @since 1.0.0
 */
?>
<div class="single-post">
    <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
    <?php
    if ( '' !== $thumbnail ) {
        the_post_thumbnail( [ 120, 120 ] );
    }

    if ( '' !== $excerpt ) {
        the_excerpt();
    }
    ?>
</div>
<?php
