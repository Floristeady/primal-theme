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
		</section>
		<?php } ?>
		
		<section id="primary" class="home-section">
			<div class="entry-content row">
				<?php the_content(); ?>
			</div>
		</section>
		
		<section id="featured-products" class="home-section hide">
			<div class="row">
				<div class="column medium-12 small-centered">
					<h1>NUESTROS PRODUCTOS</h1>
				</div>
			</div>
			
		</section>
		
		<section id="suscribe" class="home-section">
			
			<div class="row">
				<div class="column medium-12 small-centered">
					<h1>Suscríbete</h1>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque pretium ante at convallis mattis. Proin a mauris scelerisque, malesuada nisl sed.
</p>
					<form>
						<input type="email">
						<input type="submit" value="GO">
					</form>
				</div>
			</div>
			
		</section>
		
		<?php 
	    $args = array(
		'post_type'	=> 'post',
		'post_status' => 'publish',
		'posts_per_page' => 3,
		'orderby' => 'date',
		'order' => 'DESC',
		'offset' => 0
		 );
		 $last_post = new WP_Query( $args );
		?>

		<?php if ( $last_post ->have_posts() ) : ?>
		
		<section id="featured-blog" class="home-section">
			
			<div class="column medium-11 small-centered">
				
				<div class="title">
					
					<?php $posts_page = get_option( 'page_for_posts' );
					$content = get_post( $posts_page )->post_excerpt; 
					$title   = get_post( $posts_page )->post_title; ?>
					<h1><?php echo $title; ?></h1>
					<a href="<?php echo get_permalink( get_page_by_path( 'nuestro-blog' ) ) ?>" class="button"><?php _e('Ver Todo','primal') ?></a>
					
				</div>
				
				<ul id="blog-items" class="small-up-1 medium-up-2 large-up-3">
			
				<?php while ( $last_post ->have_posts() ) : $last_post ->the_post(); 
					
					get_template_part( 'content');
					
				 endwhile; wp_reset_postdata(); ?>
				 <?php wp_reset_query(); ?>
				</ul>
			</div>
			
		</section>
		<? endif; ?>
		
		
			
	<?php endwhile; ?>

</div><!-- #content -->

<?php get_footer(); ?>