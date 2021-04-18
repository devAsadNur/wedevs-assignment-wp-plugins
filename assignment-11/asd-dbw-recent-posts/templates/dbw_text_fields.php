<?php
/**
 * Template: Recent posts config fields template
 *
 * HMTL template for recent posts dashboard widget config fields
 *
 * @since 1.0.0
 */
?>
<div class="input-text-wrap">
    <input type="text" name="recent_posts_limit" id="recent_posts_limit" placeholder="Number of Posts" value="<?php echo esc_attr( $current_limit ); ?>"><br><br>
</div>

<div class="input-text-wrap">
    <select name="recent_posts_order" id="recent_posts_order" class="widefat">
        <option value="rand" <?php selected( $current_order, 'rand' ); ?>>Random</option>
        <option value="ASC" <?php selected( $current_order, 'ASC' ); ?>>ASC</option>
        <option value="DESC" <?php selected( $current_order, 'DESC' ); ?>>DESC</option>
    </select><br><br>
</div>
<?php
