<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Rhythm
 */
?>

<?php
$member_level = SwpmMemberUtils::get_logged_in_members_level();
 ?>
<article id="post-<?php the_ID(); ?>" <?php post_class('login'); ?>>
	<div class="text">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'rhythm' ),
				'after'  => '</div>',
			) );
		?>
		<?php
		if ($member_level == "2"){

		  $args = array( 'post_type' => 'Customer Hub Products', 'posts_per_page' => 3 );
		  $loop = new WP_Query( $args );
			$pagetitle = isset( $post->post_title ) ? $post->post_title : '';

		  while ( $loop->have_posts() ) : $loop->the_post();
			$title = get_field('product_set_title');

		  ?>
		<?php if( have_rows('hub_products') ):
		  $c = 0;
		  ?>
		<div class="row">
			<div class="col-sm-12">
				<ul class="nav nav-tabs hub-filters" role="tablist">
				  <?php while( have_rows('hub_products') ): the_row();
				    // vars
				    $c++;
				    $image = get_sub_field('image');
				    $description = get_sub_field('description');
				    $title = get_sub_field('category_title');
				    $ws_title = preg_replace("/[^A-Za-z0-9\-]/", "", $title);

				    if ( $c == 1 ){ $class = ' active';}
				    else{ $class='';}
				    ?>
				  <li role="presentation" class="<?php echo $class ?>">
				    <a href="#<?php echo $ws_title ?>" aria-controls="<?php echo $ws_title ?>" role="tab" data-toggle="tab"><?php echo $title ?></a>
				  </li>
				  <?php endwhile; ?>
				</ul>
			</div>
		</div>
			<?php endif; ?>
			<?php if( have_rows('hub_products') ):
			  $c = 0;
			  ?>
			<!-- Tab panes -->
		<div class="row">
			<div class="col-sm-12">
				<div class="tab-content customer-hub-products">
				  <?php while( have_rows('hub_products') ): the_row();
				    // vars
				    $c++;
				    $prodImage = get_sub_field('image');
				    $description = get_sub_field('description');
				    $title = get_sub_field('category_title');
				    $ws_title = preg_replace("/[^A-Za-z0-9\-]/", "", $title);

				    if ( $c == 1 ){ $class = ' in active';}
				    else{ $class='';}
				    ?>
				  <div role="tabpanel" class="tab-pane fade <?php echo $class ?>" id="<?php echo $ws_title ?>">
				    <div div class="row">
				      <div class="col-sm-12 text-center">
								<h3 class="title">Now displaying: <?php echo $title ?></h3>
				      </div>
				    </div>
				    <div class="row hub-items">
		            <?php while( have_rows('hub_product') ): the_row();
		              $title = get_sub_field('product_title');
		              $image = get_sub_field('product_image');
		              $link = get_sub_field('zip_link');

									$image = $image['url'];
		              ?>
									<div class="col-sm-3">
										<div class="well text-center">
											<img class="img-responsive" src="<?php echo $image ?>" />
											<p class="title"><?php echo $title ?></p>

											<a class="dl-link" href="<?php echo $link ?>">Download Now</a>
										</div>
									</div>

		            <?php endwhile ?>

				    </div>
				  </div>
				  <?php endwhile; ?>
				</div>
			</div>
		</div>
		<?php endif; ?>
		<?php endwhile;

	}else {
		?>
		<div class="row">
			<div class="col-sm-12 text-center">
				<div class="login-error">
					<h2>You must login to view this content. </h2>
					<h2> Click <a href="http://fredrixartistcanvas.com/customer-hub">here</a> to log in.</h2>
				</div>
			</div>
		</div>
		<?php
	}
		?>

	</div>
</article><!-- #post-## -->
