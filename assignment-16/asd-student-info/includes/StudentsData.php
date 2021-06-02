<?php

namespace Asd\StudentInfo;

/**
 * Students data
 * handler class
 */
class StudentsData {

    /**
     * Student profile inserter function
     *
     * @since  1.0.0
     *
     * @param  array $args
     *
     * @return int|WP_Error
     */
    function asd_insert_student_profile( $args = [] ) {
        global $wpdb;

        if ( empty( $args['first_name'] ) ) {
            return new \WP_Error( 'no-student-first-name', __( 'You must provide student\'s first name', 'asd-student-info' ) );
        }

        if ( empty( $args['last_name'] ) ) {
            return new \WP_Error( 'no-student-last-name', __( 'You must provide student\'s last name', 'asd-student-info' ) );
        }

        if ( empty( $args['class'] ) ) {
            return new \WP_Error( 'no-student-class', __( 'You must provide student\'s class', 'asd-student-info' ) );
        }

        if ( empty( $args['roll'] ) ) {
            return new \WP_Error( 'no-student-roll', __( 'You must provide student\'s roll', 'asd-student-info' ) );
        }

        $defaults = [
            'first_name' => '',
            'last_name'  => '',
            'class'      => '',
            'roll'       => '',
            'reg_no'     => '',
            'created_at' => current_time( 'mysql' ),
        ];

        $data = wp_parse_args( $args, $defaults );

        $inserted = $wpdb->insert(
            $wpdb->prefix . "students",
            $data,
            [
                '%s',
                '%s',
                '%d',
                '%d',
                '%d',
                '%s',
            ]
        );

        if ( ! $inserted ) {
            return new \WP_Error( 'failed-to-insert', __( 'Failed to insert student data', 'asd-student-info' ) );
        }

        return $wpdb->insert_id;
    }

    /**
     * Student profile updater function
     *
     * @since  1.0.0
     *
     * @param  array $args
     *
     * @return int|WP_Error
     */
    function asd_update_student_profile( $args = [] ) {
        global $wpdb;

        $student_id = $args['id'];

        if ( empty( $student_id ) ) {
            return new \WP_Error( 'no-student-id', __( 'Student ID must not be empty', 'asd-student-info' ) );
        }

        if ( empty( $args['first_name'] ) ) {
            return new \WP_Error( 'no-student-first-name', __( 'You must provide student\'s first name', 'asd-student-info' ) );
        }

        if ( empty( $args['last_name'] ) ) {
            return new \WP_Error( 'no-student-last-name', __( 'You must provide student\'s last name', 'asd-student-info' ) );
        }

        if ( empty( $args['class'] ) ) {
            return new \WP_Error( 'no-student-class', __( 'You must provide student\'s class', 'asd-student-info' ) );
        }

        if ( empty( $args['roll'] ) ) {
            return new \WP_Error( 'no-student-roll', __( 'You must provide student\'s roll', 'asd-student-info' ) );
        }

        $defaults = [
            'first_name' => '',
            'last_name'  => '',
            'class'      => '',
            'roll'       => '',
            'reg_no'     => '',
            'updated_at' => current_time( 'mysql' ),
        ];

        unset( $args['id'] );

        $data = wp_parse_args( $args, $defaults );

        $updated = $wpdb->update(
            $wpdb->prefix . 'students',
            $data,
            [ 'id' => $student_id ],
            [
                '%s',
                '%s',
                '%d',
                '%d',
                '%d',
                '%s',
            ],
            [ '%d' ]
        );

        if ( ! $updated ) {
            return new \WP_Error( 'failed-to-update', __( 'Failed to update student data', 'asd-student-info' ) );
        }

        return $updated;
    }

    /**
     * Products getter function
     *
     * @since  1.0.0
     *
     * @param  array $args
     *
     * @return array
     */
    function asd_get_student_profiles( $args = [] ) {
        global $wpdb;

        $defaults = [
            'number' => 10,
            'offset' => 0,
            'orderby' => 'id',
            'order' => 'ASC',
        ];

        $args = wp_parse_args( $args, $defaults );

        $sql = $wpdb->prepare(
            "SELECT * FROM {$wpdb->prefix}students
            ORDER BY {$args['orderby']} {$args['order']}
            LIMIT %d, %d",
            $args['offset'], $args['number']
        );

        $profiles = $wpdb->get_results( $sql );

        return $profiles;
    }

    /**
     * Student profile getter function by ID
     *
     * @since  1.0.0
     *
     * @param  int $id
     *
     * @return object
     */
    function asd_get_student_profile( $id ) {
        global $wpdb;

        return $wpdb->get_row(
            $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}students WHERE id = %d", $id )
        );
    }

    /**
     * Total student profiles counter function
     *
     * @since  1.0.0
     *
     * @return int
     */
    function asd_student_profiles_count() {
        global $wpdb;

        return (int) $wpdb->get_var( "SELECT count(id) FROM {$wpdb->prefix}students" );
    }

    /**
     * Student profiles deleter function by ID
     *
     * @since  1.0.0
     *
     * @param  int $id
     *
     * @return int|boolean
     */
    function asd_delete_student_profile( $id ) {
        global $wpdb;

        return $wpdb->delete(
            $wpdb->prefix . 'students',
            [ 'id' => $id ],
            [ '%d' ]
        );
    }
}
