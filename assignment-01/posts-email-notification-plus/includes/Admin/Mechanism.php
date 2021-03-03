<?php

namespace EmailNotificationPlus\Admin;

/**
 * The mechanism handler class
 */
class Mechanism {

    /**
     * Initialize the class
     */
    public function __construct() {
        $this->email_ids_adding_mechanism();
    }

    /**
     * Email ids adding filter function
     *
     * @return void
     */
    public function email_ids_adding_mechanism() {
        add_filter( 'email_ids_to_send_mail', [ $this, 'add_email_ids_for_mailing' ] );
    }

    /**
     * Adding email ids function
     *
     * @param [array] $content
     * @return void
     */
    public function add_email_ids_for_mailing($content) {
        $email_id_2 = 'someone@mail.com';
        $email_id_3 = 'someoneelse@mail.com';
        $email_id_4 = 'anotherone@mail.com';

        array_push( $content, $email_id_2, $email_id_3, $email_id_4 );

        return $content;
    }
    
}