<?php
/**
 *
 * RS Media
 * @since 1.0.0
 * @version 1.0.0
 *
 *
 */
function rs_media( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'                  => '',
    'class'               => '',
    'media_type'          => '',
    'v_id'                => '',
    'y_url'               => '',
    's_id'                => '',
    'width'               => '',
    'height'              => ''
  ), $atts ) );

  $id          = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class       = ( $class ) ? ' '. sanitize_html_classes($class) : '';

  $width      = ( $width ) ? esc_attr($width) : '100%';
  $height      = ( $height ) ? esc_attr($height) : '100%';


  $output = '';
  switch ($media_type) {
    case 'vimeo':
      $output .=  '<div class="mb-xs-40">';
      $output .=  '<div '.$id.' class="video'.$class.'">';
      $output .=  '<iframe src="http://player.vimeo.com/video/'.esc_html($v_id).'?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="1170" height="658" allowfullscreen></iframe>';
      $output .=  '</div>';
      $output .=  '</div>';
      break;

    case 'youtube':
      $output .=  '<div class="mb-xs-40">';
      $output .=  '<div'.$id.' class="video'.$class.'">';
      $output .=  '<iframe width="'.$width.'" height="'.$height.'" src="'.esc_url($y_url).'" allowfullscreen></iframe>';
      $output .=  '</div>';
      $output .=  '</div>';
      break;

    default:
      $output .=  '<iframe width="'.$width.'" height="'.$height.'" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/'.esc_html($s_id).'&amp;color=111111&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false"></iframe>';
      break;
  }
  wp_enqueue_script( 'jquery-fitvids' );
  return $output;
}

add_shortcode('rs_media', 'rs_media');
