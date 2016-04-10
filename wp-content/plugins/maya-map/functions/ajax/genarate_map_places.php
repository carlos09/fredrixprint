<?php
define('WP_USE_THEMES', false);  
require_once('../../../../../wp-load.php');

$category_name=sanitize_text_field($_POST['category_name']);
 $args=array(
	    'post_type'=>'map-locations',
	   'posts_per_page' => -1,   
 );
 if($category_name) $args['map-categories']=$category_name;
 
 
$map_array=array();
  $locations= new WP_Query($args);
    if ( $locations->have_posts() ) {
        while( $locations->have_posts() ) { 
			$locations->the_post();
                        
                    $title=get_the_title();
                    $latitude=get_post_meta($locations->post->ID,'_maya_map_latitude',true);
                    $longitude=get_post_meta($locations->post->ID,'_maya_map_longitude',true);
                    $address=get_post_meta($locations->post->ID,'_maya_map_address',true);
		    $zip=get_post_meta($locations->post->ID,'_maya_map_zip',true);
		    $marker_label=get_post_meta($locations->post->ID,'_maya_map_location_label',true);
		     $marker_label=get_post_meta($locations->post->ID,'_maya_map_location_label',true);
		     $marker_pointer_img=get_post_meta($locations->post->ID,'_maya_map_location_marker_pointer',true);
		    
                    array_push($map_array,array($title,$address,$title,'',$zip,$latitude,$longitude,$marker_label,$marker_pointer_img));
        }
        
        print_r( json_encode($map_array));
        
    }else{
        echo 'no-location';
   }
       wp_reset_query();
    
  