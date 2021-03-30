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

$single_post = get_post_meta( $post->ID, '_custom_book_meta_key', true );

?>
<h2><?php esc_html_e( $post->post_title ); ?></h2>
<ul>
    <li>Writter: <?php esc_html_e( $single_post['writter'], 'asd-book-review-plus' ); ?></li>
    <li>ISBN: <?php esc_html_e( $single_post['isbn'], 'asd-book-review-plus' ); ?></li>
    <li>Year: <?php esc_html_e( $single_post['year'], 'asd-book-review-plus' ); ?></li>
    <li>Price: $<?php esc_html_e( $single_post['price'], 'asd-book-review-plus' ); ?></li>
    <li>Description: <?php echo esc_textarea( $single_post['description'], 'asd-book-review-plus' ); ?></li>
</ul>
<?php


get_footer();
