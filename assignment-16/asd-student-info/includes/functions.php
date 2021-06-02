<?php
/**
 * Get student meta
 *
 * @since 1.0.0
 *
 * @param int     $student_id
 * @param string  $meta_key
 * @param boolean $single
 *
 * @return boolean|array
 */
function get_student_meta( $student_id, $meta_key = '', $single = false ) {
    return get_metadata( 'student', $student_id, $meta_key, $single );
}

/**
 * Add student meta
 *
 * @since 1.0.0
 *
 * @param int     $student_id
 * @param string  $meta_key
 * @param mixed   $meta_value
 * @param boolean $unique
 *
 * @return boolean
 */
function add_student_meta( $student_id, $meta_key, $meta_value, $unique = false ) {
    return add_metadata( 'student', $student_id, $meta_key, $meta_value, $unique );
}

/**
 * Update student meta
 *
 * @since 1.0.0
 *
 * @param int     $student_id
 * @param string  $meta_key
 * @param mixed   $meta_value
 * @param string  $prev_value
 *
 * @return boolean
 */
function update_student_meta( $student_id, $meta_key, $meta_value, $prev_value = '' ) {
    return update_metadata( 'student', $student_id, $meta_key, $meta_value, $prev_value );
}

/**
 * Delete student meta
 *
 * @since 1.0.0
 *
 * @param int     $student_id
 * @param string  $meta_key
 * @param mixed   $meta_value
 * @param boolean $delete_all
 *
 * @return boolean
 */
function delete_student_meta( $student_id, $meta_key, $meta_value = '', $delete_all = false ) {
    return delete_metadata( 'student', $student_id, $meta_key, $meta_value, $delete_all );
}
