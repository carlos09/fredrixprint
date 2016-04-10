<?php
/**
 *
 * RS Latest News
 * @since 1.0.0
 * @version 1.1.0
 *
 */
function rs_latest_news( $atts, $content = '', $id = '' ) {

  global $wp_query, $paged, $post;

  extract( shortcode_atts( array(
    'id'       => '',
    'class'    => '',
    'columns'     => 3,
    'bottom_margin' => 'no',
    'cats'     => 0,
    'orderby'  => '',
    'length'   => '',
    'btn_text' => '',
    'exclude_posts' => '',
    'limit'    => ''
  ), $atts ) );

  $id           = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class        = ( $class ) ? ' '. $class : '';

  if( is_front_page() || is_home() ) {
    $paged = ( get_query_var('paged') ) ? intval( get_query_var('paged') ) : intval( get_query_var('page') );
  } else {
    $paged = intval( get_query_var('paged') );
  }

  // Query args
  $args = array(
    'paged'           => $paged,
    'orderby'         => $orderby,
    'posts_per_page'  => $limit
  );

  if( $cats ) {
    $args['tax_query'] = array(
      array(
        'taxonomy' => 'category',
        'field'    => 'ids',
        'terms'    => explode( ',', $cats )
      )
    );
  }

  if (!empty($exclude_posts)) {
	
	$exclude_posts_arr = explode(',',$exclude_posts);
	if (is_array($exclude_posts_arr) && count($exclude_posts_arr) > 0) {
		$args['post__not_in'] = array_map('intval',$exclude_posts_arr);
	}
 }
  

  $tmp_query  = $wp_query;
  $wp_query   = new WP_Query( $args );

  ob_start();
  
  if ($columns == 4) {
	  $class = ' col-sm-6 col-md-3 col-lg-3';
  } else {
	  $class = ' col-sm-6 col-md-4 col-lg-4 mb-md-50';
  }
  
  if ($bottom_margin == 'yes') {
	  $class .= ' mb-60 mb-xs-40';
  }
  
  
  ?>
  <div class="row multi-columns-row">
  <?php while ( have_posts() ) : the_post(); ?>
    <div <?php echo $id; ?> class="<?php echo sanitize_html_classes($column_class); ?> wow fadeIn <?php echo sanitize_html_classes($class); ?>" data-wow-delay="0.1s" data-wow-duration="2s">
    <?php if(has_post_thumbnail()): ?>
      <div class="post-prev-img">
        <a href="<?php echo get_the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
      </div>
    <?php endif; ?>

    <div class="post-prev-title font-alt">
      <a href="<?php echo get_the_permalink(); ?>"><?php echo the_title(); ?></a>
    </div>

    <div class="post-prev-info font-alt"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a> | <?php the_time('d, F'); ?></div>
      <div class="post-prev-text"><?php ts_the_excerpt_theme($length); ?></div>
      <div class="post-prev-more">
        <a href="<?php echo get_the_permalink(); ?>" class="btn btn-mod btn-gray btn-round"><?php echo esc_html($btn_text); ?> <i class="fa fa-angle-right"></i></a>
      </div>
    </div>

  <?php endwhile; ?>

  </div>

  <?php

  wp_reset_query();
  wp_reset_postdata();
  $wp_query = $tmp_query;

  $output = ob_get_clean();
  return $output;
}
add_shortcode( 'rs_latest_news', 'rs_latest_news' );
