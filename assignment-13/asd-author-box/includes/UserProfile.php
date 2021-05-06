<?php

namespace Asd\Author\Box;

/**
 * The user profile
 * handler class
 */
class UserProfile {

    /**
     * Initializes the class
     *
     * @since 1.0.0
     */
    public function __construct() {
        add_filter( 'user_contactmethods', [ $this, 'contact_methods_handler' ] );
    }

    /**
     * User contact methods handler function
     *
     * @since 1.0.0
     *
     * @param array $methods
     *
     * @return array
     */
    public function contact_methods_handler( $methods ) {
        $methods['facebook'] = __( 'Facebook', 'asd-author-box' );
        $methods['twitter']  = __( 'Twitter', 'asd-author-box' );
        $methods['linkedin'] = __( 'LinkedIn', 'asd-author-box' );

        return $methods;
    }
}
