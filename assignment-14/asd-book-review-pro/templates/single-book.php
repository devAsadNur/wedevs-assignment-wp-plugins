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

/**
 * Enqueue styles and scripts
 */
wp_enqueue_style( 'asd-book-review-style' );
wp_enqueue_script( 'asd-rating-plugin-script' );
wp_enqueue_script( 'asd-rating-handler-script' );

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

$args = [
    'post_id' => $post_id,
];

/**
 * Single book template
 */
?>
<div id="book-review-wrapper" class="container wrapper">
    <h2 class="book-title"><?php echo esc_html( $post->post_title ); ?></h2>
    <div class="book-review-content clearfix">
        <div class="book-review-thumb float-left">
            <img src="<?php esc_url( the_post_thumbnail_url() ); ?>" alt="<?php echo esc_attr( $post->post_title ); ?>" />
        </div>
        <div class="book-review-details float-left">
        <?php
        $query_var_rating = get_query_var( 'rating' );

        if ( true !== $query_var_rating ) {
            // Fetching single rating data of current post
            $book_rating_result = asd_br_get_rating( $args );
            $book_rating        = isset( $book_rating_result->rating ) ? (float) $book_rating_result->rating : 0;
            $book_rating_id     = isset( $book_rating_result->id ) ? (int) $book_rating_result->id: '';
            ?>
            <ul class="book-review-details-list">
                <li>
                    <span><?php esc_html_e( 'Writter', 'asd-book-review-pro' ); ?>: </span>
                    <?php echo esc_html( $single_post_writter ); ?>
                </li>
                <li>
                    <span><?php esc_html_e( 'ISBN', 'asd-book-review-pro' ); ?>: </span>
                    <?php echo esc_html( $single_post_isbn ); ?></li>
                </li>
                <li>
                    <span><?php esc_html_e( 'Year', 'asd-book-review-pro' ); ?>: </span>
                    <?php echo esc_html( $single_post_year ); ?></li>
                </li>
                <li>
                    <span><?php esc_html_e( 'Price', 'asd-book-review-pro' ); ?>: </span>
                    $<?php echo esc_html( $single_post_price ); ?></li>
                </li>
                <li>
                    <span><?php esc_html_e( 'Description', 'asd-book-review-pro' ); ?>: </span>
                    <?php echo esc_textarea( $single_post_description ); ?>
                </li>
            </ul>
            <div class="rating book-rating" data-rate-value="<?php echo esc_attr( $book_rating ); ?>" data-post-id="<?php echo esc_attr( $post_id ); ?>" data-rating-id="<?php echo esc_attr( $book_rating_id ); ?>"></div>
            <p class="rating-status "></p>
            <a href="<?php echo get_the_permalink() . '/rating'; ?>"><?php esc_html_e( 'View all ratings for this book', 'asd-book-review-pro' ); ?></a>
            <?php
        } else {
            // Variables for fetching current page ratings
            $page_num = ( ! empty( $_REQUEST['rating_page'] ) ) ? (int) $_REQUEST['rating_page'] : 1;
            $per_page = 5;
            $offset   = ( $page_num - 1 ) * $per_page;

            // Variables for pagination
            $post_ratings  = asd_br_get_ratings( $args );
            $total_ratings = count( $post_ratings );
            $total_page    = ceil( $total_ratings / $per_page );
            $current_page  = ( $page_num > 1 ) ? $page_num : 1;
            $prev_page     = ( $current_page > 1 ) ? ( $current_page - 1 ) : 1;
            $next_page     = ( $total_page > $current_page ) ? ( $current_page + 1 ) : $total_page;

            // Updated arguments for fetching current page ratings
            $args['number'] = $per_page;
            $args['offset'] = $offset;

            // Fetching all ratings data to display on current page
            $book_rating_results = asd_br_get_ratings( $args );

            ?>
            <table class="rating-table">
                <tr>
                    <th class="tbl-row-sl"><?php esc_html_e( 'Sl No.', 'asd-book-review-pro' ); ?></th>
                    <th class="tbl-row-name"><?php esc_html_e( 'User Name', 'asd-book-review-pro' ); ?></th>
                    <th class="tbl-row-rating"><?php esc_html_e( 'Ratings', 'asd-book-review-pro' ); ?></th>
                </tr>
            <?php
            foreach ($book_rating_results as $key => $single_rating ) {
                $serial    = ++$offset;
                $user      = get_user_by( 'id', $single_rating->user_id );
                $user_name = ucwords( $user->user_login );
                $rating    = $single_rating->rating;
                ?>
                <tr>
                    <td class="tbl-row-sl"><?php echo esc_html( $serial ); ?></td>
                    <td class="tbl-row-name"><?php echo esc_html( $user_name ); ?></td>
                    <td class="tbl-row-rating"><div class="rating rating-bulk" data-rate-value="<?php echo esc_attr( $rating ); ?>"></div></td>
                </tr>
                <?php
            }
            ?>
            </table>
            <div class="rating-pagination">
                <a class="pagination-link" href="<?php echo esc_attr( '?rating_page=1' ) ?>">&laquo;</a>
                <a class="pagination-link" href="<?php echo esc_attr( '?rating_page=' . $prev_page ); ?>">&#60;</a>
                <?php
                for ( $i = 1; $i <= $total_page; $i++ ) {
                    $is_active = ( $i === $current_page ) ? 'active' : '';
                    ?>
                    <a class="pagination-link <?php echo esc_attr( $is_active ); ?>" href="<?php echo esc_attr( '?rating_page=' . $i ); ?>"><?php echo esc_html( $i ); ?></a>
                    <?php
                }
                ?>
                <a class="pagination-link" href="<?php echo esc_attr( '?rating_page=' . $next_page ); ?>">&#62;</a>
                <a class="pagination-link" href="<?php echo esc_attr( '?rating_page=' . $total_page ); ?>">&raquo;</a>
            </div>
            <div class="book-review-back">
                <a href="<?php echo get_the_permalink(); ?>"><?php esc_html_e( 'Go back to this book review', 'asd-book-review-pro' ); ?></a>
            </div>
            <?php
        }
        ?>
        </div>
    </div>
</div>
<?php

/**
 * Get the themme footer
 */
get_footer();
