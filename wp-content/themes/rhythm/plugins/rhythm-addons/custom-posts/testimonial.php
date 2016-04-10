<?php
/**
 * Testimonial custom posty type
 */

$labels = array(
	'name' => __( 'Testimonials', 'marine' ),
	'singular_name' => __( 'Testimonial', 'marine' ),
	'add_new' => __( 'Add New', 'marine' ),
	'add_new_item' => __( 'Add New Testimonials', 'marine' ),
	'edit_item' => __( 'Edit Testimonials', 'marine' ),
	'new_item' => __( 'New Testimonials', 'marine' ),
	'all_items' => __( 'All Testimonials', 'marine' ),
	'view_item' => __( 'View Testimonials', 'marine' ),
	'search_items' => __( 'Search Testimonials', 'marine' ),
	'not_found' => __( 'No Testimonials found', 'marine' ),
	'not_found_in_trash' => __( 'No Testimonials found in Trash', 'marine' ),
	'parent_item_colon' => '',
	'menu_name' => __( 'Testimonials', 'marine' )
);

 $args = array(
	'labels'        => $labels,
	'public'        => false,
	'show_ui'       => true,
	'menu_position' => 30,
	'supports'      => array( 'title', 'thumbnail', 'editor' ),
	'has_archive'   => true,
	 'rewrite' => array(
		'slug' => 'cpt-testimonial'
	)
);

register_post_type ( 'testimonial', $args);

/**
 * Testimonial category
 */

$labels = array(
	'name'              => _x( 'Categories', 'taxonomy general name', 'rhythm-addons' ),
	'singular_name'     => _x( 'Category', 'taxonomy singular name', 'rhythm-addons' ),
	'search_items'      => __( 'Search categories', 'rhythm-addons' ),
	'all_items'         => __( 'All Categories', 'rhythm-addons' ),
	'parent_item'       => __( 'Parent Category', 'rhythm-addons' ),
	'parent_item_colon' => __( 'Parent Category:', 'rhythm-addons' ),
	'edit_item'         => __( 'Edit Category', 'rhythm-addons' ),
	'update_item'       => __( 'Update Category', 'rhythm-addons' ),
	'add_new_item'      => __( 'Add New Category', 'rhythm-addons' ),
	'new_item_name'     => __( 'New Category Name', 'rhythm-addons' ),
	'menu_name'         => __( 'Categories' ),
);
$args = array(
	'labels' => $labels,
	'hierarchical' => true,
);
register_taxonomy( 'testimonial-category', 'testimonial', $args );