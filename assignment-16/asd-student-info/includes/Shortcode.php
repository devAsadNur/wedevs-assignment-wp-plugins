<?php

namespace Asd\StudentInfo;

/**
 * Shortcode
 * handler class
 */
class Shortcode {

    /**
     * Initialize the class
     *
     * @since  1.0.0
     */
    public function __construct() {
        add_shortcode( 'asd-student-form', [ $this, 'render_shortcode__student_form' ] );
        add_shortcode( 'asd-student-information', [ $this, 'render_shortcode_student_profiles' ] );
    }

    /**
     * Student form renderer function
     *
     * @since  1.0.0
     *
     * @param array  $atts
     *
     * @return void
     */
    public function render_shortcode__student_form( $atts = [] ) {
        $atts = shortcode_atts( apply_filters( 'asd_student_info_output_contents', [
            'title'       => __( 'Students Information', 'asd-student-info' ),
            'description' => __( 'Students detailed information.', 'asd-student-info' ),
        ] ), $atts );

        // Enqueue form script and style
        wp_enqueue_script( 'asd-student-form-script' );
        wp_enqueue_style( 'asd-student-form-style' );

        // Include student information form template
        ob_start();
        include_once ASD_STUDENT_INFO_PATH . '/templates/shortcode_student_form.php';
        return ob_get_clean();
    }

    /**
     * Student info output render function
     *
     * @since  1.0.0
     *
     * @param array  $atts
     *
     * @return void
     */
    public function render_shortcode_student_profiles( $atts = [] ) {
        $args = shortcode_atts( apply_filters( 'asd_student_form_contents', [
            'number' => 5,
            'offset' => 0,
            'orderby' => 'id',
            'order' => 'ASC',
        ] ), $atts );

        $page_num = 1;
        if ( ! empty( $_REQUEST['page_num'] ) && is_numeric( $_REQUEST['page_num'] ) ) {
            $page_num = sanitize_text_field( $_REQUEST['page_num'] );
        }

        $per_page = (int) $args['number'];
        $offset   = ( $page_num - 1 ) * $per_page;

        // Create instance of StudentsData object
        $obj_students_data = new StudentsData();

        // Variables for pagination
        $total_profiles = $obj_students_data->asd_student_profiles_count();
        $total_page     = ceil( $total_profiles / $per_page );
        $current_page   = ( $page_num > 1 ) ? $page_num : 1;
        $prev_page      = ( $current_page > 1 ) ? ( $current_page - 1 ) : 1;
        $next_page      = ( $total_page > $current_page ) ? ( $current_page + 1 ) : $total_page;

        // Updated arguments for fetching current page data
        $args['offset'] = $offset;

        // Fetching data based on arguments to display on current page
        $student_profiles = $obj_students_data->asd_get_student_profiles( $args );

        // Enqueue student info output style
        wp_enqueue_style( 'asd-student-output-style' );

        // Include student info output template
        ob_start();
        include_once ASD_STUDENT_INFO_PATH . '/templates/shortcode_students_info.php';
        return ob_get_clean();
    }
}
