<?php
/**
 * Template: shortcode student pro
 *
 * HMTL template for shortcode student form
 *
 * @since 1.0.0
 */
?>
<div class="students-info-wrapper">
    <?php
    /**
     * Action hook for adding contents
     * before students info table
     *
     * @since 1.0.0
     */
    do_action( 'asd_students_info_table_before' );
    ?>
    <table class="students-info-table">
        <tr>
            <th class="tbl-row-sl"><?php esc_html_e( 'Sl No.', 'asd-student-info' ); ?></th>
            <th class="tbl-row-name"><?php esc_html_e( 'Name', 'asd-student-info' ); ?></th>
            <th class="tbl-row-class"><?php esc_html_e( 'Class', 'asd-student-info' ); ?></th>
            <th class="tbl-row-roll"><?php esc_html_e( 'Roll No.', 'asd-student-info' ); ?></th>
            <th class="tbl-row-reg"><?php esc_html_e( 'Reg No.', 'asd-student-info' ); ?></th>
            <th class="tbl-row-marks"><?php esc_html_e( 'Marks', 'asd-student-info' ); ?></th>
        </tr>
        <?php
        // Looping through each of the student profiles
        foreach ( $student_profiles as $key => $profile ) {
            $serial = ++$offset . '.';
            $full_name = $profile->first_name . ' ' . $profile->last_name;
            ?>
            <tr>
                <td class="tbl-row-sl"><?php echo esc_html( $serial ); ?></td>
                <td class="tbl-row-fname"><?php echo esc_html( $full_name ); ?></td>
                <td class="tbl-row-class"><?php echo esc_html( $profile->class ); ?></td>
                <td class="tbl-row-roll"><?php echo esc_html( $profile->roll ); ?></td>
                <td class="tbl-row-reg"><?php echo esc_html( $profile->reg_no ); ?></td>
                <td class="tbl-row-marks">
                    <table class="students-info-marks-table">
                    <?php
                    // Get student meta data using student id
                    $marks = ! empty( get_student_meta( $profile->id, 'student_marks', true ) ) ? get_student_meta( $profile->id, 'student_marks', true ) : '';

                    if ( is_array( $marks ) ) {
                    // Looping through each of the meta data
                        foreach ( $marks as $subject => $mark ) {
                            ?>
                            <tr>
                                <th><?php echo esc_html( ucwords( $subject ) );?>:</th>
                                <td><?php echo esc_html( $mark );?></td>
                            </tr>
                            <?php
                        }
                    } else {
                        esc_html_e( 'No marks to show', 'asd-student-info' );
                    }
                    ?>
                    </table>
                </td>
            </tr>
            <?php
        }

        /**
         * Action hook for adding contents
         * after students info table
         *
         * @since 1.0.0
         */
        do_action( 'asd_students_info_table_after' );
        ?>
    </table>
    <div class="profile-pagination">
        <a class="pagination-link" href="<?php echo esc_attr( '?page_num=1' ) ?>">&laquo;</a>
        <a class="pagination-link" href="<?php echo esc_attr( '?page_num=' . $prev_page ); ?>">&#60;</a>
        <?php
        for ( $i = 1; $i <= $total_page; $i++ ) {
            $is_active = ( $i === $current_page ) ? 'active' : '';
            ?>
            <a class="pagination-link <?php echo esc_attr( $is_active ); ?>" href="<?php echo esc_attr( '?page_num=' . $i ); ?>"><?php echo esc_html( $i ); ?></a>
            <?php
        }
        ?>
        <a class="pagination-link" href="<?php echo esc_attr( '?page_num=' . $next_page ); ?>">&#62;</a>
        <a class="pagination-link" href="<?php echo esc_attr( '?page_num=' . $total_page ); ?>">&raquo;</a>
    </div>
</div>
<?php
