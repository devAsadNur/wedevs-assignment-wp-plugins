<?php
/**
 * Template: plugin page
 *
 * HMTL template for dashboard menu plugin page
 *
 * @since 1.0.0
 */
?>
<div class="wrap">
    <h1 class="wp-heading-inline"><?php apply_filters( 'asd_cf_plugin_page_title', esc_html_e( 'Contact Form Responses', 'asd-contact-plus' ) ); ?></h1>
    <form action="" method="post">
        <?php
        $table = new Asd\ContactFormPlus\ContactList();
        $table->prepare_items();
        $table->display();
        ?>
    </form>
</div>
<?php
