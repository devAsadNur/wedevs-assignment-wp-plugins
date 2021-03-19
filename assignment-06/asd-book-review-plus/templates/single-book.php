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
<h2><?php echo $post->post_title; ?></h2>
<ul>
    <li><?php echo 'Writter: ' . $single_post['writter']; ?></li>
    <li><?php echo 'ISBN: ' . $single_post['isbn']; ?></li>
    <li><?php echo 'Year: ' . $single_post['year']; ?></li>
    <li><?php echo 'Price: $' . $single_post['price']; ?></li>
    <li><?php echo 'Description: ' . $single_post['description']; ?></li>
</ul>
<?php


get_footer();
