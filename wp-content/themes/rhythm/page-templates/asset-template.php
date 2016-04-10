<?php
/*
Template Name: Asset Page
*/

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one
 * of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query,
 * e.g., it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

	 get_header() ?>






		<div class="container assets">

		<?php if (!is_user_logged_in() ) { ?>

				<div class="entry">



		<?php } ?> 

		<?php 
				$homepages = get_posts('numberposts=-1&orderby=menu_order&order=ASC&post_type=assets');
		?>

		<?php $vx .= '<h2>Make your store look fabulous! Download Fredrix Marketing Collateral</h2>'; ?>

		<?php
		
		$taxonomy = 'asset_type';
		$tax_terms = get_terms($taxonomy);
		
		$vx .= '<ul class="terms-filter">';
		foreach ($tax_terms as $tax_term) {
		$vx .= '<li data-slug="'. $tax_term->slug.'">'. $tax_term->name.'</li>';
		}
		
		$vx .= '<li data-slug="all" class="current">All</li></ul>';
		?>
		<?php $vx .= '<ul class="home-bar">'; ?>
			<?php foreach($homepages as $post) : setup_postdata($post); ?>
			<? 
			$term_list = wp_get_post_terms($post->ID, $taxonomy, array("fields" => "all"));

			
			?>
 
            <?php $vx .= '<li class="'.$term_list[0]->slug.'">'; ?>
            	<?php $vx .= '<a href="'.get_post_meta($post->ID, '_fc_asset_download_link', true).'" target="_blank">'; ?>
           				<?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );?>
						<?php $vx .= '<img src="'.get_post_meta($post->ID, '_fc_asset_image', true).'">'; ?>
						<?php $vx .= '<h4>'.get_post_meta($post->ID, '_fc_asset_text', true).'</h4>'; ?>
						
            	<?php $vx .= '</a>'; ?>
            <?php $vx .= '</li>'; ?>
         <?php endforeach; ?>
			<?php $vx .= '</ul>'; ?>



		<?php if (!is_front_page()){
			$title = get_the_title();
			$page = get_page_by_title($title);
			$content = apply_filters('the_content', $page->post_content); 
			echo $content;

		}?>


		
		
			
		

		<?php
		
		echo do_shortcode('[upme_private]'.$vx.'[/upme_private]');
	?>

			<?php if (!is_user_logged_in() ) { ?>

				</div>



		<?php } ?> 


	</div>

	<script>
		$(function(){
			$('.terms-filter').on('click', 'li', function(){

				$('.terms-filter li.current').removeClass('current');
				$(this).addClass('current');

				var filtername = $(this).data('slug');

				if(filtername == 'all'){
					$('.home-bar li').fadeIn(300);

				}

				else{
					$('.home-bar li.'+filtername).fadeIn(300);
					$('.home-bar li').not('.'+filtername).fadeOut(300);
				}


			})
		})
	</script>


		<!-- / container -->
	<?php get_footer() ?>
