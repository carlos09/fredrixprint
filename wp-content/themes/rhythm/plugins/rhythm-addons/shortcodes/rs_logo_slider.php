<?php
/**
 *
 * RS Logo Slider
 * @since 1.0.0
 * @version 1.0.0
 *
 *
 */
function rs_logo_slider( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'     => '',
    'class'  => '',
    'images' => '',

  ), $atts ) );

  $id    = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class = ( $class ) ? ' '. sanitize_html_classes($class) : '';

  $output  = '<div '.$id.' class="small-item-carousel black owl-carousel mb-0 animate-init" data-anim-type="fade-in-right-large'.$class.'" data-anim-delay="100">';

  $images = explode(',', $images);
  if(!empty( $images)) {
    foreach($images as $image) {
      $image_src = wp_get_attachment_image_src( $image, 'full' );
      if(isset($image_src[0])) {
        $output .=  '<div class="logo-item">';
        $output .=  '<img src="'.esc_url($image_src[0]).'" width="67" height="67" alt="" />';
        $output .=  '</div>';
      }

    }
  }

  $output .=  '</div>';
  
  wp_enqueue_script( 'owl-carousel' );

  return $output;
}
add_shortcode('rs_logo_slider', 'rs_logo_slider');

