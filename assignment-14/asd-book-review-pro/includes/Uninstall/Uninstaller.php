<?php

namespace Asd\BookReviewPro\Uninstall;

/**
 * Uninstall
 * handler class
 */
class Uninstaller {

    /**
     * Uninstaller runner function
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function run() {
        $this->flush_rewrites();
    }

    /**
     * Flush rewrites
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function flush_rewrites() {
        flush_rewrite_rules();
    }
}
