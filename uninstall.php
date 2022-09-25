<?php

/*
File running when plugin is deactivated and deleted
*/

// security check to prevent direct access 

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    die; // KILL the operation if accessed directly
}

// clear Taxes CPT data using a loop

$taxes = get_posts( array( 'post_type' => 'txy_taxes', 'numberposts' => -1 ) );

foreach( $taxes as $tax ) {
    wp_delete_post( $book->ID, true );
}

// SQL? I'd rather not yet. Might end up deleting the internet!