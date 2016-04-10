<?php

		/*

		Plugin Name:Location Map for Wordpress

		Plugin URI: http://www.mclanka.com

		Description: Allows you to mark your store locations, distribution points, branches or any other list of places on Google maps.

		Author: Maya Creations

		Version: 1.2

		*/


/*************************************************************************************************************************************************************/

/******************Plugin Constants*****************************************************************************************/

/************************************************************************************************************************************************************/

define('PLUGIN_BASE',plugin_dir_url(__FILE__));

define('PLUGIN_FUNC',PLUGIN_BASE.'functions');

define('PLUGIN_FUNC_AJAX',PLUGIN_FUNC.'/ajax');

define('PLUGIN_CSS',PLUGIN_BASE.'css');

define('PLUGIN_JS',PLUGIN_BASE.'js');

define('PLUGIN_IMAGES',PLUGIN_BASE.'images');



/*************************************************************************************************************************************************************/

/***************register hook************************************************************************************************/

/*************************************************************************************************************************************************************/

register_activation_hook(__FILE__,'maya_map_register_init');

function maya_map_register_init(){

  $maya_map_options = array(

      'global_lat' =>  7.873054,

      'global_long'=> 80.771797,

      'map_zoom'=>7,

      'map_custom_marker'=>'',

      'map_width'=>'700',

      'map_height'=>'400'

    );

    update_option( 'maya_map_admin_options', $maya_map_options );

    

}

/*************************************************************************************************************************************************************/

/*************** map categpory-post type************************************************************************************************/

/*************************************************************************************************************************************************************/

require_once('functions/admin/maya_map_category_post_type.php');



/*************************************************************************************************************************************************************/

/*************** map backend plugin options************************************************************************************************/

/*************************************************************************************************************************************************************/

require_once('functions/admin/plugin_options.php');





/************************************************************************************************************************************************************/

/*************************************required scripts and styles******************************************/

/************************************************************************************************************************************************************/





//front styles

function maya_front_map_styles() {

 wp_enqueue_style('maya-map-style', PLUGIN_CSS.'/front/maya_map_places.css',array() , '1.0.0', 'screen');

}

add_action('wp_print_styles', 'maya_front_map_styles');



//admin styles

function maya_map_admin_styles() {

 wp_enqueue_style('maya-map-admin-style', PLUGIN_CSS.'/admin/maya_map_admin.css',array() , '1.0.0', 'screen');

}

add_action('admin_print_styles', 'maya_map_admin_styles');





//front scripts

function maya_front_map_scripts(){

    wp_enqueue_script( 'jquery');

    wp_enqueue_script('gmap_api','http://maps.googleapis.com/maps/api/js?v=3&amp;sensor=false',array(),'1.0', true);

      wp_enqueue_script('maya-map-marker', PLUGIN_JS.'/front/markerwithlabel.js',array('jquery'),'1.0', true);

     wp_enqueue_script('maya-map-creater', PLUGIN_JS.'/front/maya_map_creater.js',array('jquery','maya-map-marker'),'1.0', true);

         wp_localize_script( 'maya-map-creater', 'maya_maps_plugin_vars', localize_maya_maps_plugin_vars());

}

add_action('wp_print_scripts', 'maya_front_map_scripts');



function localize_maya_maps_plugin_vars(){

  $map_admin_option=get_option('maya_map_admin_options');

  $map_zoom=($map_admin_option['map_zoom'])? $map_admin_option['map_zoom'] :7;

  $map_global_center_lat=($map_admin_option['global_lat'])? $map_admin_option['global_lat'] :7.873054;

  $map_global_center_long=($map_admin_option['global_long'])? $map_admin_option['global_long'] :80.771797;

  $map_marker_image=($map_admin_option['map_custom_marker'])? $map_admin_option['map_custom_marker'] :'';

  

	return array(

           'map_creater_url'=>PLUGIN_FUNC_AJAX.'/genarate_map_places.php',

	   'map_set_zoom'=>$map_zoom,

	   'map_glob_center_lat'=>$map_global_center_lat,

	   'map_glob_center_long'=>$map_global_center_long,

	   'map_marker_image'=>$map_marker_image

		);

}



//admin scripts

function maya_admin_map_scripts() {

 wp_enqueue_script( 'jquery');

 wp_enqueue_script('maya-map-cmb', PLUGIN_JS.'/admin/cmb.js',array('jquery'),'1.0', true);

 wp_enqueue_script('maya-map-admin-script', PLUGIN_JS.'/admin/maya-map-admin.js',array('jquery'),'1.0', true);

 wp_enqueue_script('media-upload');

wp_enqueue_script('thickbox');



}

add_action('admin_print_scripts', 'maya_admin_map_scripts');





function maya_distribution_map(){

    ?>

    <div id="maya_map_wrapper">

      <?php

       $taxonomy_dis= 'map-categories';

      $tax_terms_dis = get_terms($taxonomy_dis,array('hide_empty'=>true,'order'=>'asc','orderby'=>'id'));

      $full_width_class=(count($tax_terms_dis)===0) ?'full-width-map-canvas' : '';

      ?>

     <div id="maya_map_canvas" class="<?php echo $full_width_class;?>"></div>

     

     <?php if(count($tax_terms_dis)){ ?>

     <div id="maya_map_categories">

        <?php

          foreach($tax_terms_dis as $dis){ ?>

            <div rel="<?php echo $dis->slug;?>" class="maya_map_category"><?php echo ucfirst($dis->name);?></div>

        <?php  } ?>

     </div>

     <?php } ?>

     <div class="clear"></div>

    </div>

   

    <?php

}



function maya_distribution_map_shortcode(){

    

    $admin_option=get_option('maya_map_admin_options');

    $width_unit=($admin_option['map_width_unit']==='percentage') ? '%' : 'px';

     $height_unit=($admin_option['map_height_unit']==='percentage') ? '%' : 'px';

    $width=($admin_option['map_width']) ? $admin_option['map_width'].$width_unit : '';

    $height=($admin_option['map_height']) ? $admin_option['map_height'].$height_unit : '';

  

 $shortcode.='<div id="maya_map_wrapper" style="width:'.$width.'; height:'.$height.'">';

 

  $taxonomy_dis= 'map-categories';

  $tax_terms_dis = get_terms($taxonomy_dis,array('hide_empty'=>true,'order'=>'asc','orderby'=>'id'));

  

  $full_width_class=(count($tax_terms_dis)===0) ?'full-width-map-canvas' : '';

 $shortcode.='<div id="maya_map_canvas" class="'.$full_width_class.'"></div>';

 



 if(count($tax_terms_dis)){

   $shortcode.='<div id="maya_map_categories">';

  

         

          

          foreach($tax_terms_dis as $dis){

           $shortcode.='<div rel="'.$dis->slug.'" class="maya_map_category">'.ucfirst($dis->name).'</div>';

         } 

      $shortcode.='</div>';

 }

  

      $shortcode.='<div class="clear"></div></div>';

 

 

 return $shortcode;

}

add_shortcode( 'maya-map-shortcode', 'maya_distribution_map_shortcode' );





/************************************************************************************************************************************************************/

/*************************************Export Location class******************************************/

/************************************************************************************************************************************************************/



class CSVExport

{

	/**

	 * Constructor

	 */

	public function __construct()

	{

		if(isset($_GET['download_report']))

		{

			$csv = $this->generate_csv();



			header("Pragma: public");

			header("Expires: 0");

			header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

			header("Cache-Control: private", false);

			header("Content-Type: application/octet-stream");

			header("Content-Disposition: attachment; filename=\"report.csv\";" );

			header("Content-Transfer-Encoding: binary");



			echo $csv;

			exit;

		}



		// Add extra menu items for admins

		//add_action('admin_menu', array($this, 'admin_menu'));



		// Create end-points

		add_filter('query_vars', array($this, 'query_vars'));

		add_action('parse_request', array($this, 'parse_request'));

	}



	/**

	 * Add extra menu items for admins

	 */

	public function admin_menu()

	{

		add_submenu_page('options-general.php', 'Import and Export', 'Import and Export', 'administrator','maya_map_admin_exportimport',array($this, 'download_report'));

	}



	/**

	 * Allow for custom query variables

	 */

	public function query_vars($query_vars)

	{

		$query_vars[] = 'download_report';

		return $query_vars;

	}



	/**

	 * Parse the request

	 */

	public function parse_request(&$wp)

	{

		if(array_key_exists('download_report', $wp->query_vars))

		{

			$this->download_report();

			exit;

		}

	}





	public function generate_csv(){

               global $wpdb;

		$csv_output = '';

                $csv_output.='Title,Longitute,Latitude,Branch code,Address,Zip code';

		$csv_output .= "\n";





                              $fivesdrafts = $wpdb->get_results( 

                              "

                              SELECT *

                              FROM $wpdb->posts

			      WHERE $wpdb->posts.post_status = 'publish' 

			      AND $wpdb->posts.post_type = 'map-locations'

			      "

                      );

                      

                      foreach ( $fivesdrafts as $fivesdraft )  {

                     

			  $csv_row=array();

			 // array_push($csv_row,$fivesdraft->post_title);

			 $csv_output.=$fivesdraft->post_title.',';

			

                             $meta_fields=$wpdb->get_results( 

                              "

                              SELECT meta_key,meta_value

                              FROM $wpdb->postmeta 

                              WHERE $wpdb->postmeta.post_id  = $fivesdraft->ID

			      "

			    

                      );

			   

			     $csv_output.=get_post_meta($fivesdraft->ID,'_maya_map_latitude',true).',';

			     $csv_output.=get_post_meta($fivesdraft->ID,'_maya_map_longitude',true).',';

			       $csv_output.=get_post_meta($fivesdraft->ID,'_maya_map_branch_code',true).',';

			         $csv_output.=get_post_meta($fivesdraft->ID,'_maya_map_address',true).',';

				   $csv_output.=get_post_meta($fivesdraft->ID,'_maya_map_zip',true).',';

				      $csv_output .= "\n";

				   

                      }

                       

		return $csv_output;

	}

}



// Instantiate a singleton of this plugin

$csvExport = new CSVExport();

