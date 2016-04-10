<?php
/**
 *
 * RS Team
 * @since 1.0.0
 * @version 1.0.0
 *
 *
 */
function rs_team( $atts, $content = '', $id = '' ) {

  global $wp_query, $post;

  extract( shortcode_atts( array(
    'id'                 => '',
    'class'              => '',
    'person_id'          => '',
    'animation'          => '',
    'animation_delay'    => '',
    'animation_duration' => '',

  ), $atts ) );

  $id                 = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class              = ( $class ) ? ' '. $class : '';

  $animation          = ( $animation ) ? ' wow '. sanitize_html_classes($animation) : '';
  $animation_duration = ( $animation_duration ) ? ' data-wow-duration="'.esc_attr($animation_duration).'s"':'';
  $animation_delay    = ( $animation_delay ) ? ' data-wow-delay="'.esc_attr($animation_delay).'s"':'';

  $args = array(
    'post_type'      => 'team',
    'posts_per_page' => 1,
    'post__in'       => explode(',', $person_id),
  );

  $tmp_query  = $wp_query;
  $wp_query   = new WP_Query( $args );

  ob_start();

  while( have_posts() ) : the_post();

  // get the meta values
  $team_position  = ts_get_post_opt('team-position');
  $team_header    = ts_get_post_opt('team-header');
  $team_facebook  = ts_get_post_opt('team-facebook');
  $team_twitter   = ts_get_post_opt('team-twitter');
  $team_pinterest = ts_get_post_opt('team-pinterest');


  ?>

<div <?php echo $id; ?> class="team-item <?php echo sanitize_html_classes($animation); ?><?php echo sanitize_html_classes($class); ?>"<?php echo $animation_duration; ?><?php echo $animation_delay; ?>>
    <?php if(has_post_thumbnail()): ?>
    <div class="team-item-image">
      <?php the_post_thumbnail('ts-vertical'); ?>
        <div class="team-item-detail">

            <h4 class="font-alt normal"><?php echo esc_html($team_header); ?></h4>

            <?php the_content(); ?>

            <div class="team-social-links">
                <a href="<?php echo esc_url($team_facebook); ?>" target="_blank"><i class="fa fa-facebook"></i></a>
                <a href="<?php echo esc_url($team_twitter); ?>" target="_blank"><i class="fa fa-twitter"></i></a>
                <a href="<?php echo esc_url($team_pinterest); ?>" target="_blank"><i class="fa fa-pinterest"></i></a>
            </div>

        </div>
    </div>
    <?php endif; ?>

    <div class="team-item-descr font-alt">

        <div class="team-item-name">
            <?php the_title(); ?>
        </div>

        <div class="team-item-role">
            <?php echo esc_html($team_position); ?>
        </div>

    </div>
  </div>


  <?php

  endwhile;
  wp_reset_query();
  wp_reset_postdata();
  $wp_query = $tmp_query;

  $output = ob_get_clean();

  return $output;

}
add_shortcode('rs_team', 'rs_team');
