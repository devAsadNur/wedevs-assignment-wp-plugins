<?php

namespace Asd\CRUD\Admin;

/**
 * Include file if not included
 */
if ( ! class_exists( 'WP_List_Table' ) ) {
    require_once ABSPATH . 'wp-admin/includes/class-wp-links-list-table.php';
}

/**
 * AdderssList class extends from
 * WP_List_Table
 */
class AddressList extends \WP_List_Table {

    /**
     * Initialize the class
     *
     * @since 1.0.0
     */
    function __construct() {
        parent::__construct( [
            'singular' => 'contact',
            'plural'  => 'contacts',
        ] );
    }

    /**
     * No items handler function
     *
     * @since 1.0.0
     *
     * @return void
     */
    function no_items() {
        echo __( 'No address found', 'asd-crud' );
    }

    /**
     * Column getter funciton
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function get_columns() {
        return [
            'cb'         => '<input type="checkbox" />',
            'name'       => __( 'Name', 'asd-crud' ),
            'address'    => __( 'Address', 'asd-crud' ),
            'phone'      => __( 'Phone', 'asd-crud' ),
            'created_at' => __( 'Date', 'asd-crud' ),
        ];
    }

    /**
     * Bulk action function
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function get_bulk_actions() {
        $actions = [
            'trash' => __( 'Move to Trash', 'asd-crud' ),
        ];

        return $actions;
    }

    /**
     * Column default funciton
     *
     * @since  1.0.0
     *
     * @param  object $item
     * @param  string $column_name
     *
     * @return void
     */
    protected function column_default( $item, $column_name ) {
        switch ( $column_name ) {

            case 'created_at':
                return wp_date( get_option( 'date_format' ), strtotime( $item->created_at ) );
                break;

            default:
                return isset( $item->$column_name ) ? $item->$column_name : '';
                break;
        }
    }

    /**
     * Column name hanlder funciton
     *
     * @since  1.0.0
     *
     * @param  object $item
     *
     * @return void
     */
    public function column_name( $item ) {
        $actions = [];

        $actions['edit']   = sprintf( '<a href="%s" title="%s">%s</a>', admin_url( 'admin.php?page=asd-crud&action=edit&id=' . $item->id ), $item->id, __( 'Edit', 'asd-crud' ), __( 'Edit', 'asd-crud' ) );
        $actions['delete'] = sprintf( '<a href="%s" class="submitdelete" onclick="return confirm(\'Are you sure?\');" title="%s">%s</a>', wp_nonce_url( admin_url( 'admin-post.php?action=asd-ac-delete-address&id=' . $item->id ), 'asd-ac-delete-address' ), $item->id, __( 'Delete', 'asd-crud' ), __( 'Delete', 'asd-crud' ) );

        return sprintf(
            '<a href="%1$s"><strong>%2$s</strong></a> %3$s', admin_url( 'admin.php?page=asd-crud&action=view&id' . $item->id ), $item->name, $this->row_actions( $actions )
        );
    }

    /**
     * Column checkbox handler funciton
     *
     * @since  1.0.0
     *
     * @param  object $item
     *
     * @return void
     */
    protected function column_cb( $item ) {
        return sprintf(
            '<input type="checkbox" name="address_id[]" value="%d" />', $item->id
        );
    }

    /**
     * Result fetcher funciton
     *
     * @since  1.0.0
     *
     * @return void
     */
    public function prepare_items() {
        $column   = $this->get_columns();
        $hidden   = [];
        $sortable = $this->get_sortable_columns();

        $this->_column_headers = [ $column, $hidden, $sortable ];

        $per_page     = 5;
        $current_page = $this->get_pagenum();
        $offset       = ( $current_page - 1 ) * $per_page;

        $args = [
            'number' => $per_page,
            'offset' => $offset,
        ];

        if ( isset( $_REQUEST['orderby'] ) && isset( $_REQUEST['order'] ) ) {
            $args['orderby'] = $_REQUEST['orderby'];
            $args['order']   = $_REQUEST['order'];
        }

        $this->items = asd_ac_get_addresses( $args );

        $this->set_pagination_args( [
            'total_items' => asd_ac_address_count(),
            'per_page'    => $per_page
        ] );
    }
}
