<?php
/**
 * The template for displaying all single posts
 *
 * @link       https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package    WordPress
 * @subpackage Twenty_Twenty_One
 * @since      Twenty Twenty-One 1.0
 */

/**
 * Get the themme header
 */
get_header();

global $post;
$post_id = isset( $post->ID ) ? (int) $post->ID : 0;

/**
 * Single post meta data
 */
$single_post_writter     = get_post_meta( $post_id, 'book_meta_key_writter', true );
$single_post_isbn        = get_post_meta( $post_id, 'book_meta_key_isbn', true );
$single_post_year        = get_post_meta( $post_id, 'book_meta_key_year', true );
$single_post_price       = get_post_meta( $post_id, 'book_meta_key_price', true );
$single_post_description = get_post_meta( $post_id, 'book_meta_key_description', true );

/**
 * Single book template
 */
?>
<div id="book-review-wrapper" class="container wrapper">
    <h2 class="book-title"><?php esc_html_e( $post->post_title ); ?></h2>
    <div class="book-review-content clearfix">
        <div class="book-review-thumb float-left">
            <img src="<?php esc_url( the_post_thumbnail_url() ); ?>" alt="<?php esc_attr_e( $post->post_title, 'asd-book-review-plus' ); ?>" />
        </div>
        <div class="book-review-details float-left">
            <ul class="book-review-details-list">
                <li>
                    <span><?php esc_html_e( 'Writter', 'asd-book-review-plus' ); ?>: </span>
                    <?php echo esc_html( $single_post_writter ); ?>
                </li>
                <li>
                    <span><?php esc_html_e( 'ISBN', 'asd-book-review-plus' ); ?>: </span>
                    <?php echo esc_html( $single_post_isbn ); ?></li>
                </li>
                <li>
                    <span><?php esc_html_e( 'Year', 'asd-book-review-plus' ); ?>: </span>
                    <?php echo esc_html( $single_post_year ); ?></li>
                </li>
                <li>
                    <span><?php esc_html_e( 'Price', 'asd-book-review-plus' ); ?>: </span>
                    $<?php echo esc_html( $single_post_price ); ?></li>
                </li>
                <li>
                    <span><?php esc_html_e( 'Description', 'asd-book-review-plus' ); ?>: </span>
                    <?php echo esc_textarea( $single_post_description ); ?>
                </li>
            </ul>
        </div>
    </div>
</div>
<?php

get_footer();
