<?php

namespace EmailNotification;

/**
 * Frontend handler class
 */
class Frontend {

    /**
     * Initialize the class
     */
    public function __construct() {
        new Frontend\View();
    }
}