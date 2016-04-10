<?php
/**
 *
 * RS Newsletter
 * @since 1.0.0
 * @version 1.0.0
 *
 *
 */
function rs_newsletter( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'          => '',
    'class'       => '',
    'title'       => '',
    'note'        => '',
    'title_color' => '',
    'note_color'  => '',
    'btn_color'   => ''
  ), $atts ) );


  $id             = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class          = ( $class ) ? ' '. sanitize_html_classes($class) : '';
  $el_title_color = ( $title_color ) ? ' style="color:'.esc_attr($title_color).';"':'';
  $el_note_color  = ( $note_color ) ? ' style="color:'.esc_attr($note_color).';"':'';

  $output  =  '<div '.$id.' class="newsletter-wrapper'.$class.' '.sanitize_html_classes($btn_color).'">';
  $output .=  '<div class="newsletter-label font-alt"'.$el_title_color.'>'.esc_html($title).'</div>';
  $output .=  '<div class="mb-20">';
  $output .=  do_shortcode(wp_kses_data($content));
  $output .=  '</div>';
  $output .=  '<div class="form-tip"'.$el_note_color.'>';
  $output .=  '<i class="fa fa-info-circle"></i> '.esc_html($note);
  $output .=  '</div>';
  $output .=  '</div>';


  return $output;
}
add_shortcode('rs_newsletter', 'rs_newsletter');
