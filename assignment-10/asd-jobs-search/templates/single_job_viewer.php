<?php
/**
 * Template: Single job viwer
 *
 * HMTL template for single job preview
 *
 * @since 1.0.0
 */
    /**
     * Action hook for adding contents
     * before single job viewer
     *
     * @since 1.0.0
     */
    do_action( 'asd_gjs_single_job_before' );

    /**
     * Single job viewer template
     *
     * @since 1.0.0
     */
    ?>
    <div class="single-job-wrapper">
        <h2><?php echo esc_html( $search_result->title ); ?></h2>
        <p>
            <span style="font-weight: bold;"><?php esc_html_e( 'Job Type', 'asd-jobs-search' ); ?>: </span>
            <?php echo esc_html( $search_result->type ); ?>
        </p>
        <p>
            <span style="font-weight: bold;"><?php esc_html_e( 'Job Location', 'asd-jobs-search' ); ?>: </span>
            <?php echo esc_html( $search_result->location ); ?>
        </p>
        <div class="job-description">
            <?php echo wp_kses_post( $search_result->description ); ?>
        </div>
    </div>
    <?php

    /**
     * Action hook for adding contents
     * after single job viewer
     *
     * @since 1.0.0
     */
    do_action( 'asd_gjs_single_job_after' );
