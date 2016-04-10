<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Rhythm
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="text">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'rhythm' ),
				'after'  => '</div>',
			) );
		?>
		<?php
		  $args = array( 'post_type' => 'Product Set', 'posts_per_page' => 3 );
		  $loop = new WP_Query( $args );
			$pagetitle = isset( $post->post_title ) ? $post->post_title : '';

		  while ( $loop->have_posts() ) : $loop->the_post();
			$title = get_field('product_set_title');
			echo "The title is: ".$title."<br />";

			echo "And page title is: ".$pagetitle."<br />";

			while ( $pagetitle == $title) :
		  ?>
			<?php
			echo "2. The title is: ".$title."<br />";

			echo "2. And page title is: ".$pagetitle."<br />";
			?>
		<?php if( have_rows('product_set') ):
		  $c = 0;
		  ?>
		<div class="row">
			<div class="col-sm-4">
				<h1 class="product-series"><?php echo get_field('product_set_title'); ?></h1>
				<ul class="nav nav-tabs fredrix-products" role="tablist">
				  <?php while( have_rows('product_set') ): the_row();
				    // vars
				    $c++;
				    $image = get_sub_field('image');
				    $description = get_sub_field('description');
				    $title = get_sub_field('title');
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
			<?php endif; ?>
			<?php if( have_rows('product_set') ):
			  $c = 0;
			  ?>
			<!-- Tab panes -->
			<div class="col-sm-8">
				<div class="tab-content fredrix-products">
				  <?php while( have_rows('product_set') ): the_row();
				    // vars
				    $c++;
				    $prodImage = get_sub_field('image');
				    $description = get_sub_field('description');
				    $title = get_sub_field('title');
				    $ws_title = preg_replace("/[^A-Za-z0-9\-]/", "", $title);

				    if ( $c == 1 ){ $class = ' in active';}
				    else{ $class='';}
				    ?>
				  <div role="tabpanel" class="tab-pane fade <?php echo $class ?>" id="<?php echo $ws_title ?>">
				    <div div class="row">
				      <div class="col-sm-4">
				        <img class="img-responsive" src="<?php echo $prodImage['url'] ?>">
				      </div>
				      <div class="col-sm-8">
								<h3 class="title"><?php echo $title ?></h3>
				        <p class="description"><?php echo $description ?></p>
				      </div>
				    </div>
						<?php if( have_rows('product_options') ): ?>
				    <div class="row">
				      <div class="col-sm-12">
				        <table class="table table-striped">
				          <thead>
				            <tr>
				              <th>Part #</th>
				              <th>Name</th>
				              <th>Package QTY</th>
				            </tr>
				          </thead>
				          <tbody>
				            <?php while( have_rows('product_options') ): the_row();
				              $partNum = get_sub_field('part_number');
				              $prodName = get_sub_field('part_name');
				              $quantity = get_sub_field('pkg_quantity');
				              ?>
				            <tr>
				              <td><?php echo $partNum ?></td>
				              <td><?php echo $prodName ?></td>
				              <td><?php echo $quantity ?></td>
				            </tr>
				            <?php endwhile ?>
				          </tbody>
				        </table>
				      </div>
				    </div>
					<?php endif ?>
				  </div>
				  <?php endwhile; ?>
				</div>
			</div>
		</div>
		<?php endif; ?>
		<?php endwhile; ?>
		<?php endwhile; ?>

			<div class="row st-btn-margin">
				<div class="col-sm-8 col-sm-offset-2 text-center">
					<a href="/store-locator" class="store-locator-btn">where to buy</a>
				</div>
			</div>
	</div>
</article><!-- #post-## -->
