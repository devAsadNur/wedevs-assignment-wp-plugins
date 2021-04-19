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

get_header();

global $post;

$single_post_writter     = get_post_meta( $post->ID, 'book_meta_key_writter', true );
$single_post_isbn        = get_post_meta( $post->ID, 'book_meta_key_isbn', true );
$single_post_year        = get_post_meta( $post->ID, 'book_meta_key_year', true );
$single_post_price       = get_post_meta( $post->ID, 'book_meta_key_price', true );
$single_post_description = get_post_meta( $post->ID, 'book_meta_key_description', true );

?>
<h2><?php esc_html_e( $post->post_title ); ?></h2>
<ul>
    <li>Writter: <?php esc_html_e( $single_post_writter, 'asd-book-review-plus' ); ?></li>
    <li>ISBN: <?php echo esc_html( $single_post_isbn ); ?></li>
    <li>Year: <?php esc_html_e( $single_post_year, 'asd-book-review-plus' ); ?></li>
    <li>Price: $<?php esc_html_e( $single_post_price, 'asd-book-review-plus' ); ?></li>
    <li>Description: <?php echo esc_textarea( $single_post_description, 'asd-book-review-plus' ); ?></li>
</ul>
<?php


get_footer();
