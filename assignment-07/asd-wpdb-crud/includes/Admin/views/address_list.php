<?php
/**
 * Phonebook list view page
 *
 * @since 1.0.0
 */
?>
<div class="wrap">
    <h1 class="wp-heading-inline"><?php echo __( 'Address Book', 'asd-crud' ); ?></h1>

    <a href="<?php echo admin_url( 'admin.php?page=asd-crud&action=new' ) ?>" class="page-title-action"><?php echo __( 'Add New', 'asd-crud' ); ?></a>

    <?php if ( isset( $_GET['inserted'] ) ) { ?>
        <div class="notice notice-success">
            <p><?php echo __( 'Address has been added successfully!', 'asd-crud' ); ?></p>
        </div>
    <?php } ?>

    <?php if ( isset( $_GET['address-deleted'] ) && $_GET['address-deleted'] == 'true' ) { ?>
        <div class="notice notice-success">
            <p><?php echo __( 'Address has been deleted successfully!', 'asd-crud' ); ?></p>
        </div>
    <?php } ?>

    <form action="" method="POST">
        <?php
            $table = new Asd\CRUD\Admin\AddressList();
            $table->prepare_items();
            $table->search_box( 'search', 'search_id' );
            $table->display();
        ?>
    </form>
</div>
