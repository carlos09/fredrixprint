<?php
/**
 *
 * RS Works
 * @since 1.0.0
 * @version 1.1.0
 *
 */
function rs_latest_works( $atts, $content = '', $id = '' ) {

  global $wp_query, $paged, $post;

  extract( shortcode_atts( array(
    'class'            => '',
    'cats'             => 0,
    'filter_cats'      => 0,
    'orderby'          => '',
    'columns'          => 'work-grid-3',
    'resize_images'    => 'yes',
    'hover_type'       => 'hover-white',
    'lightbox'         => '',
    'lightbox_text'    => '',
    'show_filter'      => '',
    'limit'            => '',
    'use_external_url' => '',
    'exclude_posts'    => '',
  ), $atts ) );

  $class = ( $class ) ? ' '. $class: '';
  if ($resize_images == 'no') {
	$image_size = 'full';
  } else {
	$image_size = ( $columns == 'work-grid-3' ) ? 'ts-full-alt':'ts-full-big';
  }

  if( is_front_page() || is_home() ) {
    $paged = ( get_query_var('paged') ) ? intval( get_query_var('paged') ) : intval( get_query_var('page') );
  } else {
    $paged = intval( get_query_var('paged') );
  }

  // Query args
  $args = array(
    'paged'           => $paged,
    'orderby'         => $orderby,
    'post_type'       => 'portfolio',
    'posts_per_page'  => $limit
  );

  if( $cats ) {
    $args['tax_query'] = array(
      array(
        'taxonomy'  => 'portfolio-category',
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

  ?>

  <?php
  if($show_filter == 'yes') {

    $filter_args = array(
      'echo'     => 0,
      'title_li' => '',
      'style'    => 'none',
      'taxonomy' => 'portfolio-category',
      'walker'   => new Walker_Portfolio_List_Categories(),
    );

    if( $filter_cats ) {

      $exp_cats = explode(',',$filter_cats);
      $new_cats = array();

      foreach ( $exp_cats as $cat_value ) {
        $has_children = get_term_children( intval($cat_value), 'portfolio-category' );
        if( ! empty( $has_children ) ) {
            $new_cats[] = implode( ',', $has_children );
        } else {
            $new_cats[] = $cat_value;
        }
      }

      $filter_args['include'] = implode( ',', $new_cats );

    }

    $filter_args = wp_parse_args( $args, $filter_args );

    ?>

    <div class="works-filter font-alt align-center">
      <a href="#" class="filter active" data-filter="*"><?php _e('All works', 'rhythm-addons'); ?></a>
      <?php echo wp_list_categories( $filter_args ); ?>
    </div>

  <?php } ?>

  <ul class="works-grid <?php echo sanitize_html_classes($columns); ?> work-grid-gut clearfix font-alt <?php echo sanitize_html_classes($hover_type); ?> hide-titles <?php echo sanitize_html_classes($class); ?>" id="work-grid">

  <?php

  while ( have_posts() ) : the_post();

  ?>
    <?php if(has_post_thumbnail()):

		$terms = wp_get_post_terms(get_the_ID(), 'portfolio-category', $args);
		$term_slugs = array();
		$term_names = array();
		if (count($terms) > 0):
			foreach ($terms as $term):
				$term_slugs[] = $term->slug;
				$term_names[] = $term->name;
			endforeach;
		endif;

		$url = null;
		if ($use_external_url == 'yes'):
			$url = ts_get_opt('portfolio-external-url');
			if (!esc_url($url)) {
				$url = null;
			} else {
				$target = '_blank';
			}
		endif;

		if (!$url):
			$url = get_permalink();
			$target = '_self';
		endif;

    $class = '';
    if($lightbox == 'yes' && $use_external_url == 'no'):
      $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'full');
      $target = '_self';
      $light_class = 'work-lightbox-link mfp-image';
      wp_enqueue_script('jquery-magnific-popup');
    endif;
	?>
    <li class="work-item mix <?php echo implode(' ', $term_slugs);?>">
		<a href="<?php echo esc_url($url); ?>" target="<?php echo esc_attr($target); ?>" class="work-ext-link <?php echo sanitize_html_classes($light_class); ?>">
          <div class="work-img">
              <?php the_post_thumbnail($image_size); ?>
          </div>
          <div class="work-intro">
              <h3 class="work-title"><?php the_title(); ?></h3>
              <div class="work-descr">
                  <?php
                  if($lightbox == 'yes' && !empty($lightbox_text)) {
                      echo esc_html($lightbox_text);
                    } else {
                      echo implode(', ', $term_names);
                  }
                  ;?>
              </div>
          </div>
      </a>
    </li>
    <?php endif; ?>

    <?php endwhile; ?>

  </ul>

  <?php

  wp_reset_query();
  wp_reset_postdata();
  $wp_query = $tmp_query;

  $output = ob_get_clean();

  wp_enqueue_script( 'isotope-pkgd' );
  wp_enqueue_script( 'imagesloaded-pkgd' );

  return $output;
}
add_shortcode( 'rs_latest_works', 'rs_latest_works' );
