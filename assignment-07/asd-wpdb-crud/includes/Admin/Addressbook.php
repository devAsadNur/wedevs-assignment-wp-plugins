<?php

namespace Asd\CRUD\Admin;

use Asd\CRUD\Traits\FormError;

/**
 * The Addressbook
 * handler class
 */
class Addressbook {

    use FormError;

    /**
     * Plugin action navigator function
     *
     * @since  1.0.0
     *
     * @return void
     */
    public function plugin_page() {
        $action = isset( $_GET['action'] ) ? $_GET['action'] : 'list';
        $id     = isset( $_GET['id'] ) ? intval( $_GET['id'] ) : 0;

        switch ( $action ) {
            case 'new':
                $template = __DIR__ . '/views/address_new.php';
                break;

            case 'edit':
                $address  = asd_ac_get_address( $id );
                $template = __DIR__ . '/views/address_edit.php';
                break;

            case 'view':
                $template = __DIR__ . '/views/address_view.php';
                break;

            default:
                $template = __DIR__ . '/views/address_list.php';
                break;
        }

        if ( file_exists( $template ) ) {
            include $template;
        }
    }

    /**
     * Phonebook form handler function
     *
     * @since  1.0.0
     *
     * @return void
     */
    public function form_handler() {
        if ( ! isset( $_POST['submit_address'] ) ) {
            return;
        }

        if ( ! wp_verify_nonce( $_POST['_wpnonce'], 'new-address' ) ) {
            wp_die( 'Are you cheating?' );
        }

        if ( ! current_user_can( 'manage_options' ) ) {
            wp_die( 'Are you cheating?' );
        }

        $id      = isset( $_POST['id'] ) ? intval( $_POST['id'] ) : 0;
        $name    = isset( $_POST['name'] ) ? sanitize_text_field( $_POST['name'] ) : '';
        $address = isset( $_POST['address'] ) ? sanitize_textarea_field( $_POST['address'] ) : '';
        $phone   = isset( $_POST['phone'] ) ? sanitize_text_field( $_POST['phone'] ) : '';

        if ( empty( $name ) ) {
            $this->errors['name'] = __( 'Please provide a name', 'asd-crud' );
        }

        if ( empty( $phone ) ) {
            $this->errors['phone'] = __( 'Please provide a phone number', 'asd-crud' );
        }

        if ( ! empty( $this->errors ) ) {
            return;
        }

        $args = [
            'name'    => $name,
            'address' => $address,
            'phone'   => $phone
        ];

        if ( $id ) {
            $args['id'] = $id;
        }

        $insert_id = asd_ac_insert_address( $args );

        if ( is_wp_error( $insert_id ) ) {
            wp_die( $insert_id->get_error_message() );
        }

        if ( $id ) {
            $redirect_to = admin_url( 'admin.php?page=asd-crud&action=edit&address-updated=true&id=' . $id );
        } else {
            $redirect_to = admin_url( 'admin.php?page=asd-crud&inserted=true' );
        }

        wp_safe_redirect( $redirect_to );
        exit;
    }

    /**
     * Phonebook delete function
     *
     * @since  1.0.0
     *
     * @return void
     */
    public function delete_address() {
        if ( ! wp_verify_nonce( $_REQUEST['_wpnonce'], 'asd-ac-delete-address' ) ) {
            wp_die( 'Are you cheating?' );
        }

        if ( ! current_user_can( 'manage_options' ) ) {
            wp_die( 'Are you cheating?' );
        }

        $id = isset( $_REQUEST['id'] ) ? intval( $_REQUEST['id'] ) : 0;

        if ( asd_ac_delete_address( $id ) ) {
            $redirected_to = admin_url( 'admin.php?page=asd-crud&address-deleted=true' );
        } else {
            $redirected_to = admin_url( 'admin.php?page=asd-crud&address-deleted=false' );
        }

        wp_redirect( $redirected_to );
        exit;
    }

}
