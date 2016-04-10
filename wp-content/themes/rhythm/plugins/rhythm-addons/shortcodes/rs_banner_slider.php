<?php
/**
 *
 * RS Banner Rotator
 * @since 1.0.0
 * @version 1.0.0
 *
 *
 */
function rs_banner_slider( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'          => '',
    'class'       => '',
    'slide_speed' => ''
  ), $atts ) );

  $id           = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class        = ( $class ) ? ' '. sanitize_html_classes($class) : '';
  $slide_speed  = ( $slide_speed ) ? $slide_speed:'';

  $output = '<div '.$id.' class="home-section fullwidth-slider-fade bg-dark'.sanitize_html_classes($class).'" data-speed="'.esc_attr($slide_speed).'" id="home">';
  $output .=  do_shortcode(wp_kses_data($content));
  $output .= '</div>';

  wp_enqueue_script( 'owl-carousel' );

  return $output;
}

add_shortcode('rs_banner_slider', 'rs_banner_slider');

function rs_banner_slide($atts, $content = '') {
    extract( shortcode_atts( array(
    'background'    => '',
    'small_heading' => '',
    'no_buttons'    => '',
    'big_heading'   => '',
    'btn_one_link'  => '',
    'btn_two_link'  => '',
    'btn_one_text'  => '',
    'btn_two_text'  => '',
    'btn_one_lightbox'  => '',
    'btn_two_lightbox'  => '',

    'big_heading_color'       => '',
    'small_heading_color'     => '',
    'small_heading_font_size' => '',
    'big_heading_font_size'   => ''

  ), $atts ) );

  $big_heading_color       = ( $big_heading ) ? 'color:'.$big_heading_color.';':'';
  $small_heading_color     = ( $small_heading_color ) ? 'color:'.$small_heading_color.';':'';
  $small_heading_font_size = ( $small_heading_font_size ) ? 'font-size:'.$small_heading_font_size.';':'';
  $big_heading_font_size   = ( $big_heading_font_size ) ? 'font-size:'.$big_heading_font_size.';':'';

  $el_small_heading = ( $small_heading_font_size || $small_heading_color ) ? ' style="'.esc_attr($small_heading_font_size.$small_heading_color).'"':'';
  $el_big_heading   = ( $big_heading_font_size || $big_heading_color ) ? ' style="'.esc_attr($big_heading_font_size.$big_heading_color).'"':'';

  $data_background = '';
  if ( is_numeric( $background ) && !empty($background) ) {
    $image_src  = wp_get_attachment_image_src( $background, 'full' );
    if(isset($image_src[0])) {
      $data_background = ' data-background='.esc_url($image_src[0]).'';
    }

  }
  $lightbox = $lightbox_2 = '';
  if ( function_exists( 'vc_parse_multi_attribute' ) ) {
    $parse_args = vc_parse_multi_attribute( $btn_one_link );
    $href       = ( isset( $parse_args['url'] ) ) ? $parse_args['url'] : '#';
    $title      = ( isset( $parse_args['title'] ) ) ? $parse_args['title'] : 'button';
    $target     = ( isset( $parse_args['target'] ) ) ? trim( $parse_args['target'] ) : '_self';
	$lightbox = ( $btn_one_lightbox == 1 ) ? 'lightbox mfp-iframe' : '';
  }

  if ( function_exists( 'vc_parse_multi_attribute' ) ) {
    $parse_args = vc_parse_multi_attribute( $btn_two_link );
    $href_2     = ( isset( $parse_args['url'] ) ) ? $parse_args['url'] : '#';
    $title_2    = ( isset( $parse_args['title'] ) ) ? $parse_args['title'] : 'button';
    $target_2   = ( isset( $parse_args['target'] ) ) ? trim( $parse_args['target'] ) : '_self';
	$lightbox_2 = ( $btn_two_lightbox == 1 ) ? 'lightbox mfp-iframe' : '';
  }
  
  if (!empty($lightbox) || !empty($lightbox_2)) {
	  wp_enqueue_script('jquery-magnific-popup');
  }

  $output  = '<section class="home-section bg-scroll bg-dark-alfa-50" '.$data_background.'>';
  $output .=  '<div class="js-height-full container">';
  $output .=  '<div class="home-content">';
  $output .=  '<div class="home-text">';
  $output .=  '<h1 class="hs-line-8 no-transp font-alt mb-50 mb-xs-30"'.$el_small_heading.'>'.esc_html($small_heading).'</h1>';
  $output .=  '<h2 class="hs-line-14 font-alt mb-50 mb-xs-30"'.$el_big_heading.'>'.esc_html($big_heading).'</h2>';
  $output .=  '<div class="local-scroll">';
  if($no_buttons == 'one') {
    $output .=  '<a href="'.esc_url($href).'" title="'.esc_attr($title).'" target="'.esc_attr($target).'" class="btn btn-mod btn-border-w btn-medium btn-round hidden-xs '.sanitize_html_classes($lightbox).'">'.esc_html($btn_one_text).'</a> ';
  } else {
    $output .=  '<a href="'.esc_url($href).'" title="'.esc_attr($title).'" target="'.esc_attr($target).'" class="btn btn-mod btn-border-w btn-medium btn-round hidden-xs '.sanitize_html_classes($lightbox_2).'">'.esc_html($btn_one_text).'</a> ';
    $output .=  '<span class="hidden-xs">&nbsp;&nbsp;</span>';
    $output .=  '<a href="'.esc_url($href_2).'" title="'.esc_attr($title_2).'" target="'.esc_attr($target_2).'" class="btn btn-mod btn-border-w btn-medium btn-round '.sanitize_html_classes($lightbox).'">'.esc_html($btn_two_text).'</a>';
  }

  $output .=  '</div>';
  $output .=  '</div>';
  $output .=  '</div>';
  $output .=  '</div>';
  $output .=  '</section>';

  wp_enqueue_script( 'jquery-magnific-popup' );

  return $output;
}

add_shortcode('rs_banner_slide', 'rs_banner_slide');
