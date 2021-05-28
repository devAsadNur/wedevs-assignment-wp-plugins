<?php
/**
 * Featured posts trasient remover function
 *
 * @since 1.0.0
 *
 * @return boolean
 */
function asd_fp_delete_transient() {
    delete_transient( 'featured_posts_query' );
}
