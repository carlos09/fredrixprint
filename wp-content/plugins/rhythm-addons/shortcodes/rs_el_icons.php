<?php
/**
 *
 * RS Space
 * @since 1.0.0
 * @version 1.0.0
 *
 */
function rs_el_icon( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'          => '',
    'class'       => '',
    'icon'        => '',
    'result_text' => ''
  ), $atts ) );

  $id       = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class    = ( $class ) ? ' '. sanitize_html_classes($class) : '';
  $et_icons = rs_el_icons();

  $output  =  '<div '.$id.' class="col-md-8 col-md-offset-2 mb-30'.$class.'">';
  $output .=  '<div class="section-text align-center">';
  $output .=  '<p>'.do_shortcode(wp_kses_data($content)).'</p>';
  $output .=  '<div class="row">';
  $output .=  '<div class="col-md-8 col-md-offset-2">';
  $output .=  '<div class="highlight">';
  $output .=  '<pre><code class="html">&lt;span class=&quot;'.esc_html($icon).'&quot;&gt;&lt;/span&gt; icon-heart</code></pre>';
  $output .=  '</div>';
  $output .=  '<p><strong class="small">'.esc_html($result_text).'</strong>&nbsp;<span class="'.esc_attr($icon).'"></span> '.esc_html($icon).'</p>';
  $output .=  '</div></div></div></div>';

  $output .=  '<div class="et-examples">';
  foreach( $et_icons as $icon ) {
    $output .= '<span class="box1"><span aria-hidden="true" class="'.esc_attr($icon).'"></span>&nbsp;'.esc_html($icon).'</span>';
  }
  $output .=  '</div>';


  return $output;
}

add_shortcode('rs_el_icon', 'rs_el_icon');
