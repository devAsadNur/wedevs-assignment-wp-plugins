<?php
/**
 * Template: Email subscription widget backend form
 *
 * HMTL form template for widget dashboard input
 *
 * @since 1.0.0
 */
?>
<p>
    <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ) ?>"><?php esc_html_e( 'Widget Title:', 'asd-subs-form-widget' ) ?></label>
    <input type="text" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ) ?>" class="widefat" value="<?php esc_html_e( $title, 'asd-subs-form-widget' ); ?>">
</p>
<p>
    <label for="<?php echo esc_attr( $this->get_field_id( 'list' ) ); ?>"><?php esc_html_e( 'Select a MailChimp List:', 'asd-subs-form-widget' ); ?></label>

    <select name="<?php echo esc_attr( $this->get_field_name( 'list' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'list' ) ); ?>" class="widefat">
        <?php
        foreach ( $mc_lists as $list_id => $list_name ) {
            ?>
            <option value="<?php echo esc_attr( $list_id ); ?>" <?php selected( $list, $list_id ); ?>><?php echo esc_html( $list_name ); ?></option>
            <?php
        }
        ?>
    </select>
</p>
<?php
