<?php
/**
 * Template Name: Plantilla inicio
 * @package WordPress
 * @subpackage primal
 * @since primal 1.0
 */

get_header(); ?>

<div id="content" class="site-content">
	
	<?php
		while ( have_posts() ) : the_post(); ?>

	    <?php // Gallery home
		$rows = get_field('gallery_home');  ?>
		<?php if($rows) { ?>
		<section id="home-gallery" class="flexslider">
				<ul class="slides">
					<?php foreach($rows as $row) { ?>
					<li>	
						<?php if ($row['gallery_image']) { ?>
						    <?php if ($row['gallery_link']) { ?>
						 		<a class="img" href="<?php echo $row['gallery_link'] ?>">
						 		<?php $attachment_id = $row['gallery_image'];
							 	echo wp_get_attachment_image( $attachment_id, 'homeslide'); ?>
						 		</a>
						 	<?php } else { ?>
							 	<span class="img">
							 	<?php $attachment_id = $row['gallery_image'];
								 echo wp_get_attachment_image( $attachment_id, 'homeslide'); ?>
							 	</span>
						 	<?php } ?>	
						 <?php } ?>		
						
						<?php if ($row['gallery_text_up'] or $row['gallery_text_down']) { ?>
						<div class="text">
							<div class="row">
								<div class="inner">
									<h1><?php echo $row['gallery_text_up'] ?></h1>
									<h2><?php echo $row['gallery_text_down'] ?></h2>
								</div>
							</div>
						</div>
						<?php } ?>	
							 
					</li>				
					<?php } ?>
				</ul>
				<div class="scroll show-for-large">
					<span class="icon-scroll"></span>
					<small>SCROLL DOWN</small>
				</div>
		</section>
		<?php } ?>

		<?php include('inc/featured-products.php'); ?>

		<?php include('inc/section-tienda.php'); ?> <!-- Add by Francisco -->

		<?php include('inc/section-super.php'); ?> <!-- Add by Francisco -->

		<?php include('inc/section-services.php'); ?> <!-- Add by Francisco -->

		<?php include('inc/section-detox.php'); ?> <!-- Add by Francisco -->
		
		<section id="primary" class="home-section line-yellow">
			<div class="entry-content row">
				<?php the_content(); ?>
			</div>

			<div class="entry-content row text-center">
				<a href="<?php echo get_permalink( get_page_by_path( 'acerca-de-primal' ) ) ?>" class="button">
					<?php _e('Ver Más','primal') ?>
				</a>
			</div>
		</section>

		<?php include('inc/club-primal.php'); ?>

		<?php include('inc/primal-soul.php'); ?>

		<?php include('inc/section-social.php'); ?>
		
		<?php include('inc/featured-blog.php'); ?>				
	<?php endwhile; ?>

</div><!-- #content -->

<?php get_footer(); ?>