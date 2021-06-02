<?php
/**
 * Template: shortcode student form
 *
 * HMTL template for shortcode student form
 *
 * @since 1.0.0
 */
?>
<div class="student-form-wrapper">
    <h2 class="sf-title"><?php echo esc_html( $atts['title'] ); ?></h2>
    <h4 class="sf-desc"><?php echo esc_html( $atts['description'] ); ?></h4>
    <form id="asd-student-form" action="#" method="POST">
        <?php
        /**
         * Action hook for adding contents
         * before student form fields
         *
         * @since 1.0.0
         */
        do_action( 'asd_student_form_fields_before' );

        /**
         * Student form fields
         *
         * @since 1.0.0
         */
        ?>
        <h3><?php esc_html_e( 'Student Profile', 'asd-student-info' ); ?></h3>
        <div class="input-field-single">
            <label for="si-fname"><?php esc_html_e( 'First Name', 'asd-student-info' ); ?>* :</label>
            <input type="text" name="si_fname" id="si-fname" placeholder="<?php esc_attr_e( 'Student First Name', 'asd-student-info' ); ?>">
        </div>
        <div class="input-field-single">
            <label for="si-lname"><?php esc_html_e( 'Last Name', 'asd-student-info' ); ?>* :</label>
            <input type="text" name="si_lname" id="si-lname" placeholder="<?php esc_attr_e( 'Student Last Name', 'asd-student-info' ); ?>">
        </div>
        <div class="input-field-single">
            <label for="si-class"><?php esc_html_e( 'Class', 'asd-student-info' ); ?>* :</label>
            <input type="text" name="si_class" id="si-class" placeholder="<?php esc_attr_e( 'Student Class', 'asd-student-info' ); ?>">
        </div>
        <div class="input-field-single">
            <label for="si-roll"><?php esc_html_e( 'Roll No.', 'asd-student-info' ); ?>* :</label>
            <input type="text" name="si_roll" id="si-roll" placeholder="<?php esc_attr_e( 'Student Roll Number', 'asd-student-info' ); ?>">
        </div>
        <div class="input-field-single">
            <label for="si-reg"><?php esc_html_e( 'Reg. No.', 'asd-student-info' ); ?>* :</label>
            <input type="text" name="si_reg" id="si-reg" placeholder="<?php esc_attr_e( 'Student Reg. No.', 'asd-student-info' ); ?>">
        </div>
        <h3><?php esc_html_e( 'Student Marks', 'asd-student-info' ); ?></h3>
        <div class="input-field-single">
            <label for="si-mark-eng"><?php esc_html_e( 'English', 'asd-student-info' ); ?>* :</label>
            <input type="text" name="si_mark_eng" id="si-mark-eng" placeholder="<?php esc_attr_e( 'English Mark', 'asd-student-info' ); ?>">
        </div>
        <div class="input-field-single">
            <label for="si-mark-math"><?php esc_html_e( 'Math', 'asd-student-info' ); ?>* :</label>
            <input type="text" name="si_mark_math" id="si-mark-math" placeholder="<?php esc_attr_e( 'Math Mark', 'asd-student-info' ); ?>">
        </div>
        <div class="input-field-single">
            <label for="si-mark-sci"><?php esc_html_e( 'Science', 'asd-student-info' ); ?>* :</label>
            <input type="text" name="si_mark_sci" id="si-mark-sci" placeholder="<?php esc_attr_e( 'Science Mark', 'asd-student-info' ); ?>">
        </div>
        <div class="input-field-single">
            <label for="si-mark-acc"><?php esc_html_e( 'Accounting', 'asd-student-info' ); ?>* :</label>
            <input type="text" name="si_mark_acc" id="si-mark-acc" placeholder="<?php esc_attr_e( 'Accounting Mark', 'asd-student-info' ); ?>">
        </div>
        <input type="hidden" name="action" value="<?php echo esc_attr( 'asd-student-info-form' ); ?>">

        <?php wp_nonce_field( 'asd-sc-student-form', '_student_form_nonce' ); ?>

        <input type="submit" id="si-submit" value="<?php apply_filters( 'asd_student_form_submit', esc_html_e( 'Submit Student Info', 'asd-student-info' ) ); ?>">
        <?php

        /**
         * Action hook for adding contents
         * after student form fields
         *
         * @since 1.0.0
         */
        do_action( 'asd_student_form_fields_after' );
        ?>
    </form>
</div>
<?php
