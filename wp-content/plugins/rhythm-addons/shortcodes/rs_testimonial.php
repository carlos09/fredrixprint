<?php
/**
 *
 * VC Column Text
 * @since 1.0.0
 * @version 1.0.0
 *
 */
function rs_testimonial( $atts, $content = '', $id = '' ) {

  global $wp_query, $post;

  extract( shortcode_atts( array(
    'id'             => '',
    'class'          => '',
    'cats'           => 0,
    'bgcolor'        => '',
    'background'     => '',
    'attachment'     => '',
    'background_style'  => '',
    'overlay_style'     => '',

    //color
    'icon_color'     => '',
    'title_color'    => '',
    'content_color'  => '',
    'author_color'   => '',

    //size
    'icon_size'      => '',
    'title_size'     => '',
    'content_size'   => '',
    'author_size'    => '',
  ), $atts ) );

  $id               = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class            = ( $class ) ? ' '. $class : '';

  //color
  $icon_color       = ( $icon_color ) ? 'color:'.$icon_color.';':'';
  $title_color      = ( $title_color ) ? 'color:'.$title_color.';':'';
  $content_color    = ( $content_color ) ? 'color:'.$content_color.';':'';
  $author_color     = ( $author_color ) ? 'color:'.$author_color.';':'';

  //size
  $icon_size        = ( $icon_size ) ? 'font-size:'.$icon_size.';':'';
  $title_size       = ( $title_size ) ? 'font-size:'.$title_size.';':'';
  $content_size     = ( $content_size ) ? 'font-size:'.$content_size.';':'';
  $author_size      = ( $author_size ) ? 'font-size:'.$author_size.';':'';

  //elstyle
  $el_icon_style    =  ( $icon_size || $icon_color ) ? ' style="'.esc_attr($icon_color.$icon_size).'"':'';
  $el_title_style   =  ( $title_size || $title_color ) ? ' style="'.esc_attr($title_color.$title_size).'"':'';
  $el_content_style =  ( $content_size || $content_color ) ? ' style="'.esc_attr($content_color.$content_size).'"':'';
  $el_author_style  =  ( $author_size || $author_color ) ? ' style="'.esc_attr($author_color.$author_size).'"':'';

  $args = array(
    'post_type' => 'testimonial',
  );

  if( $cats ) {
    $args['tax_query'] = array(
      array(
        'taxonomy' => 'testimonial-category',
        'field'    => 'ids',
        'terms'    => explode( ',', $cats )
      )
    );
  }


  $tmp_query  = $wp_query;
  $wp_query   = new WP_Query( $args );
  
  ob_start();

  //page-section bg-dark bg-dark-alfa-90 fullwidth-slider
  
  //page-section bg-gray fullwidth-slider bg-scroll
  
  ?>
	


<section class="page-section <?php echo sanitize_html_classes($background_style.' '.$overlay_style.' '.$attachment)?> fullwidth-slider testimonial-slider" data-background="<?php echo esc_url(wp_get_attachment_url( $background )); ?>">

  <?php

  while( have_posts() ) : the_post();
  $author = ts_get_post_opt('testimonial-author');

  ?>

  <div>
    <div class="container relative">
      <div class="row">
        <div class="col-md-8 col-md-offset-2 align-center">
          <div <?php echo $id; ?> class="section-icon <?php echo sanitize_html_classes($class); ?>"<?php echo $el_icon_style; ?>>
            <span class="icon-quote"></span>
          </div>
          <h3 class="small-title font-alt"<?php echo $el_title_style; ?>><?php the_title(); ?></h3>
          <blockquote class="testimonial"<?php echo $el_content_style; ?>>
            <?php the_content(); ?>
            <footer class="testimonial-author"<?php echo $el_author_style; ?>><?php echo esc_html($author); ?></footer>
          </blockquote>
        </div>
      </div>
    </div>
  </div>

  <?php endwhile; ?>

  </section>

  <?php

  wp_reset_query();
  wp_reset_postdata();
  $wp_query = $tmp_query;

  $output = ob_get_clean();

  wp_enqueue_script( 'owl-carousel' );
  
  return $output;
}
add_shortcode( 'rs_testimonial', 'rs_testimonial');
