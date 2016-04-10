<?php
/**
 * Template Name: Customer Hub Products
 *
 * @package Rhythm
 */

get_header();
ts_get_title_wrapper_template_part();
?>

<!-- Page Section -->
<section class="main-section page-section <?php echo sanitize_html_classes(ts_get_post_opt('page-margin-local'));?>">
	<div class="container relative">
		<?php get_template_part('templates/global/page-before-content'); ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'templates/content/content','hub-products' ); ?>

		<?php endwhile; // end of the loop ?>
		<?php get_template_part('templates/global/page-after-content'); ?>
	</div>
</section>
<!-- End Page Section -->
<?php get_footer();
