<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

/**
 * Get the themme header
 */
get_header();

/**
 * Enqueue styles and scripts
 */
wp_enqueue_style( 'asd-rating-plugin-style' );
wp_enqueue_style( 'asd-book-review-style' );
wp_enqueue_script( 'asd-rating-plugin-script' );
wp_enqueue_script( 'asd-rating-handler-script' );

global $post;

/**
 * Single post meta data
 */
$single_post_writter     = get_post_meta( $post->ID, 'book_meta_key_writter', true );
$single_post_isbn        = get_post_meta( $post->ID, 'book_meta_key_isbn', true );
$single_post_year        = get_post_meta( $post->ID, 'book_meta_key_year', true );
$single_post_price       = get_post_meta( $post->ID, 'book_meta_key_price', true );
$single_post_description = get_post_meta( $post->ID, 'book_meta_key_description', true );

/**
 * Fetching the rating data
 */
$post_id      = ! empty( get_the_ID() ) ? (int) get_the_ID(): 0;
$args         = [
    'post_id' => $post_id,
];

$book_rating_result = asd_br_get_rating( $args );
$book_rating        = isset( $book_rating_result->rating ) ? (float) $book_rating_result->rating : 0;
$book_rating_id     = isset( $book_rating_result->id ) ? (int) $book_rating_result->id: '';

/**
 * Single book template
 */
?>
<div id="book-review-wrapper" class="container wrapper">
    <h2 class="book-title"><?php esc_html_e( $post->post_title ); ?></h2>

    <div class="book-review-content clearfix">
        <div class="book-review-thumb float-left">
            <img src="<?php esc_url( the_post_thumbnail_url() ); ?>" alt="<?php esc_attr_e( $post->post_title, 'asd-book-review-pp' ); ?>" />
        </div>

        <div class="book-review-details float-left">
            <ul class="book-review-details-list">
                <li>
                    <span><?php esc_html_e( 'Writter', 'asd-book-review-pp' ); ?>: </span>
                    <?php esc_html_e( $single_post_writter, 'asd-book-review-pp' ); ?>
                </li>
                <li>
                    <span><?php esc_html_e( 'ISBN', 'asd-book-review-pp' ); ?>: </span>
                    <?php echo esc_html( $single_post_isbn ); ?></li>
                <li>
                    <span><?php esc_html_e( 'Year', 'asd-book-review-pp' ); ?>: </span>
                    <?php esc_html_e( $single_post_year, 'asd-book-review-pp' ); ?></li>
                <li>
                    <span><?php esc_html_e( 'Price', 'asd-book-review-pp' ); ?>: </span>
                    $<?php esc_html_e( $single_post_price, 'asd-book-review-pp' ); ?></li>
                <li>
                    <span><?php esc_html_e( 'Description', 'asd-book-review-pp' ); ?>: </span>
                    <?php echo esc_textarea( $single_post_description, 'asd-book-review-pp' ); ?></li>
            </ul>

            <div class="rating book-rating" data-rate-value="<?php echo esc_attr( $book_rating ); ?>" data-post-id="<?php echo esc_attr( $post_id ); ?>" data-rating-id="<?php echo esc_attr( $book_rating_id ); ?>"></div>
            <p class="rating-status "></p>
        </div>
    </div>
</div>
<?php

/**
 * Get the themme footer
 */
get_footer();
