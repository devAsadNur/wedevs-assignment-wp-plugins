<?php

namespace Asd\StudentInfo;

/**
 * The assets
 * handler
 * class
 */
class Assets {

    /**
     * Initialize the class
     *
     * @since  1.0.0
     */
    public function __construct() {
        add_action( 'wp_enqueue_scripts', [ $this, 'register_assets' ] );
    }

    /**
     * Scripts getter function
     *
     * @since 1.0.0
     *
     * @return array
     */
    public function get_scripts() {
        $scripts = apply_filters( 'asd_student_form_scripts', [
            'asd-student-form-script' => [
                'src'       => ASD_STUDENT_INFO_ASSETS . '/js/student-form.js',
                'version'   => filemtime( ASD_STUDENT_INFO_PATH . '/assets/js/student-form.js' ),
                'deps'      => [ 'jquery' ],
                'in_footer' => true
            ],
        ] );

        return $scripts;
    }

    /**
     * Styles getter function
     *
     * @since 1.0.0
     *
     * @return array
     */
    public function get_styles() {
        $styles = apply_filters( 'asd_student_form_styles', [
            'asd-student-form-style' => [
                'src'     => ASD_STUDENT_INFO_ASSETS . '/css/student-form.css',
                'version' => filemtime( ASD_STUDENT_INFO_PATH . '/assets/css/student-form.css' ),
            ],
            'asd-student-output-style' => [
                'src'     => ASD_STUDENT_INFO_ASSETS . '/css/student-output.css',
                'version' => filemtime( ASD_STUDENT_INFO_PATH . '/assets/css/student-output.css' ),
            ],
        ] );

        return $styles;
    }

    /**
     * Assets register function
     *
     * @since  1.0.0
     *
     * @return void
     */
    public function register_assets() {
        $scripts = $this->get_scripts();
        $styles  = $this->get_styles();

        foreach ( $scripts as $handle => $script ) {
            $deps      = isset( $script['deps'] ) ? $script['deps'] : [];
            $version   = isset( $script['version'] ) ? $script['version'] : false;
            $in_footer = isset( $script['in_footer'] ) ? $script['in_footer'] : false;

            // Register each of the scripts
            wp_register_script( $handle, $script['src'], $deps, $version, $in_footer);
        }

        foreach ($styles as $handle => $style) {
            $deps    = isset( $style['deps'] ) ? $style['deps'] : [];
            $version = isset( $style['version'] ) ? $style['version'] : false;
            $media   = isset( $style['media'] ) ? $style['media'] : 'all';

            // Register each of the styles
            wp_register_style( $handle, $style['src'], $deps, $version, $media );
        }

        // Student info localized script
        wp_localize_script( 'asd-student-form-script', 'objStudentInfo', [
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
            'error'   => __( 'Something went wrong!', 'asd-student-info' ),
        ] );
    }
}
