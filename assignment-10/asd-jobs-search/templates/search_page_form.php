<?php
/**
 * Template: Jobs search form shortcode
 *
 * HMTL template for job searcing form
 *
 * @since 1.0.0
 */
?>
<div class="job-search-form-wrapper">
    <form action="" method="get" id="job-search-form">
        <?php
        /**
         * Action hook for adding contents
         * before job search form fields
         *
         * @since 1.0.0
         */
        do_action( 'asd_gjs_form_fields_before' );

        /**
         * Search form fields
         *
         * @since 1.0.0
         */
        ?>
        <input type="text" name="job-keyword" id="job-keyword" placeholder="<?php esc_attr_e( 'Job Keyword', 'asd-jobs-search' ); ?>">
        <input type="text" name="job-location" id="job-location" placeholder="<?php esc_attr_e( 'Job Location', 'asd-jobs-search' ); ?>">

        <?php $job_fulltime = isset( $_GET['job-fulltime'] ) ? sanitize_text_field( $_GET['job-fulltime'] ) : ''; ?>

        <input type="checkbox" name="job-fulltime" id="job-fulltime" value="<?php echo esc_attr( 'on' ); ?>" <?php checked( $job_fulltime, 'on' ); ?>>
        <label for="job-fulltime"><?php esc_html_e( 'Full time only', 'asd-jobs-search' ); ?></label>
        <input type="submit" name="job-search-submit" value="<?php apply_filters( 'job_search_submit_button_label', esc_attr_e( 'Search Jobs', 'asd-jobs-search' ) ); ?>">

        <?php
        /**
         * Action hook for adding contents
         * after job search form fields
         *
         * @since 1.0.0
         */
        do_action( 'asd_gjs_form_fields_after' );
        ?>
    </form>
</div>
<?php
