<?php

namespace Asd\CRUD;

/**
 * The admin class
 */
class Admin {

    /**
     * Initialize the class
     *
     * @since 1.0.0
     */
    public function __construct() {
        $addressbook = new Admin\Addressbook();

        new Admin\Menu($addressbook);

        $this->dispatch_actions($addressbook);
    }

    /**
     * Dispatch admin actions
     *
     * @since  1.0.0
     *
     * @param  object $addressbook
     * @return void
     */
    public function dispatch_actions($addressbook) {
        add_action( 'admin_init', [ $addressbook, 'form_handler' ] );
        add_action( 'admin_post_asd-ac-delete-address', [ $addressbook, 'delete_address' ] );
    }
}
