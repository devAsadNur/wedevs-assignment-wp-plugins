<?php

namespace Asd\StudentInfo;

/**
 * The ajax
 * handler
 * class
 */
class Ajax {

    /**
     * Initialize the class
     *
     * @since  1.0.0
     */
    public function __construct() {
        add_action( 'wp_ajax_asd-student-info-form', [ $this, 'submit_student_info' ] );
        add_action( 'wp_ajax_nopriv_asd-student-info-form', [ $this, 'submit_student_info' ] );
    }

    /**
     * Submit enquery function
     *
     * @since  1.0.0
     *
     * @return void
     */
    public function submit_student_info() {
        $first_name = ( ! empty( $_REQUEST['si_fname'] ) ) ? sanitize_text_field( $_REQUEST['si_fname'] ) : '';
        $last_name  = ( ! empty( $_REQUEST['si_lname'] ) ) ? sanitize_text_field ( $_REQUEST['si_lname'] ) : '';
        $class      = ( ! empty( $_REQUEST['si_class'] ) ) ? sanitize_text_field( $_REQUEST['si_class'] ) : '';
        $roll       = ( ! empty( $_REQUEST['si_roll'] ) ) ? sanitize_text_field( $_REQUEST['si_roll'] ) : '';
        $reg        = ( ! empty( $_REQUEST['si_reg'] ) ) ? sanitize_text_field( $_REQUEST['si_reg'] ) : '';
        $mark_eng   = ( ! empty( $_REQUEST['si_mark_eng'] ) ) ? sanitize_text_field( $_REQUEST['si_mark_eng'] ) : '';
        $mark_math  = ( ! empty( $_REQUEST['si_mark_math'] ) ) ? sanitize_text_field( $_REQUEST['si_mark_math'] ) : '';
        $mark_sci   = ( ! empty( $_REQUEST['si_mark_sci'] ) ) ? sanitize_text_field( $_REQUEST['si_mark_sci'] ) : '';
        $mark_acc   = ( ! empty( $_REQUEST['si_mark_acc'] ) ) ? sanitize_text_field( $_REQUEST['si_mark_acc'] ) : '';

        if ( ! isset( $_REQUEST['_student_form_nonce'] ) ) {
            wp_send_json_error( [
                'message' => __( 'Nonce must be required', 'asd-student-info' ),
            ] );
        }

        if ( ! wp_verify_nonce( $_REQUEST['_student_form_nonce'], 'asd-sc-student-form') ) {
            wp_send_json_error( [
                'message' => __( 'Nonce verification failed', 'asd-student-info' ),
            ] );
        }

        if ( empty( $first_name ) ) {
            wp_send_json_error( [
                'message' => __( 'First name can\'t be empty', 'asd-student-info' ),
            ] );
        }

        if ( empty( $last_name ) ) {
            wp_send_json_error( [
                'message' => __( 'Last name can\'t be empty', 'asd-student-info' ),
            ] );
        }

        if ( empty( $class ) ) {
            wp_send_json_error( [
                'message' => __( 'Class can\'t be empty', 'asd-student-info' ),
            ] );
        }

        if ( empty( $roll ) ) {
            wp_send_json_error( [
                'message' => __( 'Roll No. can\'t be empty', 'asd-student-info' ),
            ] );
        }

        $args = [
            'first_name' => (string) $first_name,
            'last_name'  => (string) $last_name,
            'class'      => (int) $class,
            'roll'       => (int) $roll,
            'reg_no'     => (int) $reg,
        ];

        $meta_data = [
            'english'    => (int) $mark_eng,
            'math'       => (int) $mark_math,
            'science'    => (int) $mark_sci,
            'accounting' => (int) $mark_acc,
        ];

        // Create instance of StudentsData object
        $obj_students_data = new StudentsData();

        // Insert student profile data
        $insert_id = $obj_students_data->asd_insert_student_profile( $args );

        if ( is_wp_error( $insert_id ) ) {
            wp_send_json_error( [
                'message' => $insert_id->get_error_message(),
            ] );
        }

        // Update/insert student meta data
        $meta_success = update_student_meta( $insert_id, 'student_marks', $meta_data );

        if ( $meta_success ) {
            wp_send_json_success( [
                'message'   => __( 'Student profile added successfully!', 'asd-student-info' ),
                'rating_id' => (int) $insert_id,
            ] );
        }

        wp_send_json_error( [
            'message' => __( 'Something went wrong with the request!', 'asd-student-info' ),
        ] );
    }
}
