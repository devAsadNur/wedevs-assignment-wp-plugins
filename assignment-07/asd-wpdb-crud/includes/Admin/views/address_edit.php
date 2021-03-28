<?php
/**
 * Phonebook entry editing form
 *
 * @since 1.0.0
 */
?>
<div class="wrap">
    <h1><?php echo __( 'Edit Address', 'asd-crud' ); ?></h1>

    <?php if ( isset( $_GET['address-updated'] ) ) { ?>
        <div class="notice notice-success">
            <p><?php echo __( 'Address has been updated successfully!', 'asd-crud' ); ?></p>
        </div>
    <?php } ?>

    <form action="" method="post">
        <table class="form-table">
            <tbody>
                <tr class="row<?php echo $this->has_error( 'name' ) ? ' form-invalid' : '' ;?>">
                    <th scope="row">
                        <label for="name"><?php echo __( 'Name', 'asd-crud' ); ?></label>
                    </th>
                    <td>
                        <input type="text" name="name" id="name" class="regular-text" value="<?php echo esc_attr( $address->name ); ?>">

                        <?php if ( $this->has_error( 'name' ) ) { ?>
                            <p class="description error"><?php echo $this->get_error( 'name' ); ?></p>
                        <?php } ?>
                    </td>
                </tr>
                <tr class="row">
                    <th scope="row">
                        <label for="address"><?php echo __( 'Address', 'asd-crud' ); ?></label>
                    </th>
                    <td>
                        <textarea class="regular-text" name="address" id="address"><?php echo esc_textarea( $address->address ); ?></textarea>
                    </td>
                </tr>
                <tr class="row<?php echo $this->has_error( 'name' ) ? ' form-invalid' : '' ;?>">
                    <th scope="row">
                        <label for="phone"><?php echo __( 'Phone', 'asd-crud' ); ?></label>
                    </th>
                    <td>
                        <input type="text" name="phone" id="phone" class="regular-text" value="<?php echo esc_attr( $address->phone ); ?>">

                        <?php if ( $this->has_error( 'phone' ) ) { ?>
                            <p class="description error"><?php echo $this->get_error( 'phone' ); ?></p>
                        <?php } ?>
                    </td>
                </tr>
            </tbody>
        </table>

        <input type="hidden" name="id" value="<?php echo esc_attr( $address->id ); ?>">
        <?php wp_nonce_field( 'new-address' ); ?>
        <?php submit_button( __( 'Update Address', 'asd-crud' ), 'primary', 'submit_address' ); ?>
    </form>
</div>
