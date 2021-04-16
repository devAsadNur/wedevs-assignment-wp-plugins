<?php
/**
 * Template: Job list viwer
 *
 * HMTL template for job list item preview
 *
 * @since 1.0.0
 */
    /**
     * Action hook for adding contents
     * before single job list item
     *
     * @since 1.0.0
     */
    do_action( 'asd_gjs_job_list_item_before' );

    /**
     * Job list item viewer template
     *
     * @since 1.0.0
     */
    ?>
    <div class="single-job-wrapper">
        <h4><a href="<?php echo esc_attr( '?job-id='. $single_job->id ); ?>"><?php echo esc_html( $single_job->title ); ?></a></h4>
        <p>
            <span style="font-weight: bold;"><?php esc_html_e( 'Job Type', 'asd-jobs-search' ); ?>: </span>
            <?php echo esc_html( $single_job->type ); ?>
        </p>
        <p>
            <span style="font-weight: bold;"><?php esc_html_e( 'Job Location', 'asd-jobs-search' ); ?>: </span>
            <?php echo esc_html( $single_job->location ); ?>
        </p>
    </div>
    <?php

    /**
     * Action hook for adding contents
     * after single job list item
     *
     * @since 1.0.0
     */
    do_action( 'asd_gjs_job_list_item_after' );
