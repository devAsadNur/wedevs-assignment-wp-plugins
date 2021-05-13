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
    <h2 class="book-title"><?php esc_html_e( $post->post_title ); ?></h2>

    <div class="book-review-content clearfix">
        <div class="book-review-thumb float-left">
            <img src="<?php esc_url( the_post_thumbnail_url() ); ?>" alt="<?php esc_attr_e( $post->post_title, 'asd-book-review-pro' ); ?>" />
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
                    <?php esc_html_e( $single_post_writter, 'asd-book-review-pro' ); ?>
                </li>
                <li>
                    <span><?php esc_html_e( 'ISBN', 'asd-book-review-pro' ); ?>: </span>
                    <?php echo esc_html( $single_post_isbn ); ?></li>
                <li>
                    <span><?php esc_html_e( 'Year', 'asd-book-review-pro' ); ?>: </span>
                    <?php esc_html_e( $single_post_year, 'asd-book-review-pro' ); ?></li>
                <li>
                    <span><?php esc_html_e( 'Price', 'asd-book-review-pro' ); ?>: </span>
                    $<?php esc_html_e( $single_post_price, 'asd-book-review-pro' ); ?></li>
                <li>
                    <span><?php esc_html_e( 'Description', 'asd-book-review-pro' ); ?>: </span>
                    <?php echo esc_textarea( $single_post_description, 'asd-book-review-pro' ); ?>
                </li>
            </ul>
            <div class="rating book-rating" data-rate-value="<?php echo esc_attr( $book_rating ); ?>" data-post-id="<?php echo esc_attr( $post_id ); ?>" data-rating-id="<?php echo esc_attr( $book_rating_id ); ?>"></div>
            <p class="rating-status "></p>
            <a href="<?php echo get_the_permalink() . '/rating'; ?>">View all ratings for this book</a>
            <?php
        } else {
            // Variables for fetching current page ratings
            $page_num = ( ! empty( $_REQUEST['rating_page'] ) ) ? (int) $_REQUEST['rating_page'] : 1;
            $per_page = 3;
            $offset   = ( $page_num - 1 ) * $per_page;

            // Variables for pagination
            $current_post_ratings = asd_br_get_ratings( $args );
            $total_ratings = count( $current_post_ratings );
            $total_page = ceil( $total_ratings / $per_page );

            // Updated arguments for fetching current page ratings
            $args['number'] = $per_page;
            $args['offset'] = $offset;

            // Fetching all ratings data to display on current page
            $book_rating_results = asd_br_get_ratings( $args );

            ?>
            <table class="rating-table">
                <tr>
                    <th>Sl No.</th>
                    <th>User Name</th>
                    <th>Ratings</th>
                </tr>
            <?php

            foreach ($book_rating_results as $key => $single_rating ) {
                $serial    = ++$offset;
                $user      = get_user_by( 'id', $single_rating->user_id );
                $user_name = ucwords( $user->user_login );
                $rating    = $single_rating->rating;
                ?>
                <tr>
                    <td><?php echo esc_html( $serial ); ?></td>
                    <td><?php echo esc_html( $user_name ); ?></td>
                    <td><div class="rating rating-bulk" data-rate-value="<?php echo esc_attr( $rating ); ?>"></div></td>
                </tr>
                <?php
            }
            ?>
            </table>

            <div class="rating-pagination">
                <a class="pagination-link" href="?rating_page=1">&laquo;</a>
                <a class="pagination-link" href="?rating_page=<?php echo esc_attr( $page_num - 1 ); ?>">&#60;</a>
                <?php
                for ($i=1; $i <= $total_page ; $i++) {
                    $is_active = ( $i === $page_num ) ? 'active' : '';
                    ?>
                    <a class="pagination-link <?php echo esc_attr( $is_active ); ?>" href="?rating_page=<?php echo esc_attr( $i ); ?>"><?php echo esc_html( $i ); ?></a>
                    <?php
                }
                ?>
                <a class="pagination-link" href="?rating_page=<?php echo esc_attr( $page_num + 1 ); ?>">&#62;</a>
                <a class="pagination-link" href="?rating_page=<?php echo esc_attr( $total_page ); ?>">&raquo;</a>
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
