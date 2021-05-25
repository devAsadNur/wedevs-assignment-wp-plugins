<?php

namespace Asd\BookReviewPP;

/**
 * The admin
 * class
 */
class Admin {

    /**
     * Initialize the class
     *
     * @since 1.0.0
     */
    public function __construct() {
        new Admin\Menu();
        new Admin\Metabox();
    }
}
