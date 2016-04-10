<?php
/**
 *
 * RS Image Block
 * @since 1.0.0
 * @version 1.0.0
 *
 *
 */
function rs_image_block( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'                 => '',
    'class'              => '',
    'image'              => '',
    'link'               => '',
    'align'              => '',
    'width'              => '',
    'height'             => '',
    'lightbox'           => '',
    'image_link'         => '',
    'margin_top'         => '',
    'margin_bottom'      => '',
    'animation'          => '',
    'animation_delay'    => '',
    'animation_duration' => '',
  ), $atts ) );

  $id                 = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class              = ( $class ) ? ' '. sanitize_html_classes($class) : '';
  $lightbox_class     = ( $lightbox == 'yes' && $image_link == 'no') ? ' class="lightbox-gallery-2 mfp-image"':'';

  $top                = ( $margin_top ) ? 'margin-top:'.$margin_top.';':'';
  $bottom             = ( $margin_bottom ) ? 'margin-bottom:'.$margin_bottom.';':'';
  $width              = ( $width ) ? ' width="'.esc_attr($width).'"':'';
  $height             = ( $height ) ? ' height="'.esc_attr($height).'"':'';

  $animation          = ( $animation ) ? ' wow '. $animation : '';
  $animation_duration = ( $animation_duration ) ? ' data-wow-duration="'.esc_attr($animation_duration).'s"':'';
  $animation_delay    = ( $animation_delay ) ? ' data-wow-delay="'.esc_attr($animation_delay).'s"':'';

  $style = '';
  if (!empty($top) || !empty($bottom)) {
	  $style = 'style="'.$top.$bottom.'"';
  }

  $href = $title = $target = '';
  if ( function_exists( 'vc_parse_multi_attribute' ) && $image_link == 'yes' ) {
    $parse_args = vc_parse_multi_attribute( $link );
    $href       = ( isset( $parse_args['url'] ) ) ? $parse_args['url'] : '#';
    $title      = ( isset( $parse_args['title'] ) ) ? ' title="'.esc_attr($parse_args['title']).'"' : '';
    $target     = ( isset( $parse_args['target'] ) ) ? ' target="'.esc_attr(trim( $parse_args['target'] )).'"' : '';
  }

  $output = '';
  if ( is_numeric( $image ) && !empty( $image ) ) {
    $image_src = wp_get_attachment_image_src( $image, 'full' );
    if(isset($image_src[0])) {
      $href = ( $lightbox == 'yes' && $image_link == 'no') ? $image_src[0]:$href;
      $output .=  '<div '.$id.' class="full-block'.$class.$animation.' '.sanitize_html_classes($align).'"'.$animation_delay.$animation_duration.' '.$style.'>';
      $output .=  ( $image_link == 'yes' && !empty($image_link) || $lightbox == 'yes' ) ? '<a href="'.esc_url($href).'"'.$title.$target.$lightbox_class.'>':'';
      $output .= '<img src="'.esc_url($image_src[0]).'" '.$width.$height.' alt="" title="" />';
      $output .=  ( $image_link == 'yes' && !empty($image_link) || $lightbox == 'yes' ) ? '</a>':'';
      $output .=  '</div>';
    }
  }
  wp_enqueue_script('jquery-magnific-popup');
  return $output;
}

add_shortcode('rs_image_block', 'rs_image_block');
