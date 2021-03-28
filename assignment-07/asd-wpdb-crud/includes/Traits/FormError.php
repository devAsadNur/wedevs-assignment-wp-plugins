<?php

namespace Asd\CRUD\Traits;

/**
 * The FormError Trait
 */
trait FormError {
    public $errors = [];

    /**
     * Error checker function
     *
     * @since  1.0.0
     *
     * @param  string $key
     * @return boolean
     */
    public function has_error( $key ) {
        return isset( $this->errors[$key] ) ? true : false;
    }

    /**
     * Error getter function
     *
     * @since  1.0.0
     *
     * @param  string $key
     * @return boolean
     */
    public function get_error( $key ) {
        if ( isset( $this->errors[$key] ) ) {
            return $this->errors[$key];
        }

        return false;
    }
}
