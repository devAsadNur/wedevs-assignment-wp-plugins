<?php
/**
 * Template: Customer registration form
 *
 * HMTL template for shortcode customer registration form
 *
 * @since 1.0.0
 */
?>
<div class="asd-crf-wrapper">
    <h2 class="crf-title"><?php echo esc_html( $atts['title'] ); ?></h2>
    <p class="crf-description"><?php echo esc_html( $atts['description'] ); ?></p>
    <hr>
    <form id="asd-cr-form" action="" method="post">
        <?php
        /**
         * Action hook for adding contents before form fields
         *
         * @since 1.0.0
         */
        do_action( 'asd_crf_fields_before' );

        /**
         * Customer registration form fields
         *
         * @since 1.0.0
         */
        ?>
        <div class="asd-crf-single-field">
            <label for="crf-name"><?php esc_html_e( 'Name', 'asd-customer-reg' ); ?>*</label>
            <input type="text" name="name" id="crf-name" placeholder="<?php esc_attr_e( 'Enter your full name', 'asd-customer-reg' ); ?>">
        </div>
        <div class="asd-crf-single-field">
            <label for="crf-username"><?php esc_html_e( 'Username', 'asd-customer-reg' ); ?>*</label>
            <input type="text" name="username" id="crf-username" placeholder="<?php esc_attr_e( 'Enter a new username', 'asd-customer-reg' ); ?>">
        </div>
        <div class="asd-crf-single-field">
            <label for="crf-email"><?php esc_html_e( 'Email', 'asd-customer-reg' ); ?>*</label>
            <input type="text" name="email" id="crf-email" placeholder="<?php esc_attr_e( 'Enter your email', 'asd-customer-reg' ); ?>">
        </div>
        <div class="asd-crf-single-field">
            <label for="crf-psw"><?php esc_html_e( 'Password', 'asd-customer-reg' ); ?>*</label>
            <input type="password" name="pass" id="crf-psw" placeholder="<?php esc_attr_e( 'Enter a new password', 'asd-customer-reg' ); ?>">
        </div>
        <div class="asd-crf-single-field">
            <label for="crf-psw-confirm"><?php esc_html_e( 'Confirm password', 'asd-customer-reg' ); ?>*</label>
            <input type="password" name="pass-confirm" id="crf-psw-confirm" placeholder="<?php esc_attr_e( 'Confirm Password', 'asd-customer-reg' ); ?>">
        </div>
        <div class="asd-crf-single-field">
            <label for="crf-type"><?php esc_html_e( 'Customer Type', 'asd-customer-reg' ); ?>*</label>
            <select id="crf-type" name="crf-type">
                <option value="<?php echo esc_attr( '' ); ?>" selected><?php esc_html_e( 'Select One', 'asd-customer-reg' ); ?></option>
                <option value="<?php echo esc_attr( 'regular' ); ?>"><?php esc_html_e( 'Regular', 'asd-customer-reg' ); ?></option>
                <option value="<?php echo esc_attr( 'premium' ); ?>"><?php esc_html_e( 'Premium', 'asd-customer-reg' ); ?></option>
                <option value="<?php echo esc_attr( 'pro' ); ?>"><?php esc_html_e( 'Pro', 'asd-customer-reg' ); ?></option>
            </select>
        </div>
        <?php
        /**
         * Action hook for adding contents after form fields
         *
         * @since 1.0.0
         */
        do_action( 'asd_crf_fields_after' );
        ?>
        <?php wp_nonce_field( 'asd-crf-form' ) ?>
        <input type="hidden" name="action" value="asd-customer-reg">
        <p class="crf-terms-text"><?php esc_html_e( 'By creating an account you agree to our', 'asd-customer-reg' ); ?> <a href="<?php echo esc_url( '#' ); ?>"><?php esc_html_e( 'Terms & Privacy', 'asd-customer-reg' ); ?></a>.</p>
        <input type="submit" name="crf-register" id="crf-submit" class="crf-submit" value="<?php esc_attr_e( 'Register', 'asd-customer-reg' ); ?>">
    </form>
    <div class="asd-crf-signin container">
        <p><?php esc_html_e( 'Already have an account?', 'asd-customer-reg' ); ?> <a href="<?php echo esc_url( admin_url( 'index.php' ) ); ?>"><?php esc_html_e( 'Sign in', 'asd-customer-reg' ); ?></a>.</p>
    </div>
</div>
<?php
