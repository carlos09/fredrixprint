<?php

add_action( 'init', 'maya_distribution_map_location' );

function maya_distribution_map_location() {

  $labels = array(

    'name' => _x('Map Locations', 'post type general name'),

    'singular_name' => _x('Map Location', 'post type singular name'),

    'add_new' => _x('Add New Map Location', 'Map Location'),

    'add_new_item' => __('Add Map Location'),

    'edit_item' => __('Edit Map Locations'),

    'new_item' => __('New Map Location'),

    'view_item' => __('View Map Locations'),

    'search_items' => __('Search Map Locations'),

    'not_found' =>  __('No Map Locations'),

    'not_found_in_trash' => __('No Map Locations Trash'),

    'parent_item_colon' => ''

  );



  $supports = array('title');

  //$taxonomies=array('category');



  register_post_type( 'map-locations',

    array(

      'labels' => $labels,

      'supports'=>$supports,

    'public' => true,

    'publicly_queryable' => true,

    'show_ui' => true,

    'query_var' => true,

    'rewrite' => true,

    'capability_type' => 'post',

    'hierarchical' => false,

    'menu_position' => null,

	 //'taxonomies'=>$taxonomies



    )

  );

}



/**********Distribution category custom taxanomy*******************/

function maya_map_location_custom_taxonomies() {



	register_taxonomy(

		'map-categories',		// internal name = machine-readable taxonomy name

		'map-locations',		// object type = post, page, link, or custom post-type

		array(

			'hierarchical' => true,

			'label' => 'Location Categories',	// the human-readable taxonomy name

			'query_var' => true,	// enable taxonomy-specific querying

			'rewrite' => array( 'slug' => 'map-categories' ),	// pretty permalinks for your taxonomy?

		)

	);

}

add_action('init', 'maya_map_location_custom_taxonomies', 0);



function wpb_initialize_maya_map_meta_boxes() {

	if ( ! class_exists( 'cmb_Meta_Box' ) )

		require_once(plugin_dir_path( __FILE__ ) . 'init.php');

}



add_action( 'init', 'wpb_initialize_maya_map_meta_boxes', 9999 );







/****************map location custom columns*********/



add_filter('manage_map-locations_posts_columns', 'MAPLOC_columns_head', 10);

add_action('manage_map-locations_posts_custom_column', 'MAPLOC_columns_content', 10, 2);



function MAPLOC_columns_head($defaults) {

 $defaults['map_location_branch_code']  = 'Branch code';

 $defaults['map_location_branch_longitude'] = 'Longitude';

  $defaults['map_location_branch_latitude'] = 'Latitude';

 return $defaults;

}



function MAPLOC_columns_content($column_name, $post_ID) {

  

 if ($column_name == 'map_location_branch_code') {

      echo  get_post_meta($post_ID,'_maya_map_branch_code',true);

	

 }

 if ($column_name == 'map_location_branch_longitude') {

 echo  get_post_meta($post_ID,'_maya_map_longitude',true); }

 

  if ($column_name == 'map_location_branch_latitude' ){

  echo  get_post_meta($post_ID,'_maya_map_latitude',true);

 }

  

}





//Add Meta Boxes



function wpb_maya_map_metaboxes( $meta_boxes ) {

	$prefix = '_maya_map_'; // Prefix for all fields



	$meta_boxes[] = array(

		'id' => 'maya-map-info',

		'title' => 'Map Info',

		'pages' => array('map-locations'), // post type

		'context' => 'normal',

		'priority' => 'high',

		'show_names' => true, // Show field names on the left

		'fields' => array(

		  

			array(

				'name' => 'Latitude',

				'desc' => 'Please put the latitude values for map location',

				'id' => $prefix . 'latitude',

				'type' => 'text'

			),

			array(

				'name' => 'Longitude',

				'desc' => 'Please put the longitude values for map location',

				'id' => $prefix . 'longitude',

				'type' => 'text'

			),

			array(

				'name' => 'Branch code',

				'desc' => 'Please input a branch code for your reference. *Optional',

				'id' => $prefix . 'branch_code',

				'type' => 'text'

			),

			array(

				'name' => 'Address',

				'desc' => 'Please put the address of the location',

				'id' => $prefix . 'address',

				'type' => 'textarea'

			),

			array(

				'name' => 'Zip code',

				'desc' => 'Please put the zip code for map location',

				'id' => $prefix . 'zip',

				'type' => 'text'

			),

			array(

				'name' => 'Location marker label',

				'desc' => 'Please put the custom label for the location marker',

				'id' => $prefix . 'location_label',

				'type' => 'text'

			),

			

			array(

				'name' => 'Custom pointer of the location ',

				'desc' => 'Upload an image as the custom marker pointer.<span class="important">If not set the uploaded marker image url after uploading, please copy the image link url and past it in the text feild.</span>',

				'id' => $prefix . 'location_marker_pointer',

				'type' => 'file',

				'save_id' => false, // save ID using true

				'allow' => array( 'url', 'attachment' ) // limit to just attachments with array( 'attachment' )

			),

			

		),

	);



	return $meta_boxes;

}

add_filter( 'cmb_meta_boxes', 'wpb_maya_map_metaboxes' );