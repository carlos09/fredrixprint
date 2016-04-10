 <?php

// If uninstall not called from WordPress exit

if( !defined( 'WP_UNINSTALL_PLUGIN' ) )exit ();

// Delete option from options table

delete_option('maya_map_admin_options');



//remove taxanomy categories

 $terms = get_terms( 'map-categories' );



    foreach( $terms as $term ){

        wp_delete_term($term->term_id,'map-categories');

    }

//remove all locaitons

$locaitonPOSTS = get_pages( array( 'post_type' => 'map-locations'));
   foreach( $locaitonPOSTS as $loc ) {
     // Delete's each post.
     wp_delete_post( $loc->ID, true);

   }