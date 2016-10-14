<section id="servicios" class="home-section">
<?php
	query_posts('pagename=eventos');
	while ( have_posts() ) : the_post(); ?>
		
	<div class="large-12 column small-centered text-center">
		<div class="medium-12 column">
			<div class="column">	
				<h1 id="post-<?php the_ID(); ?>">
					PRIMAL<br>
					<span class="yellow-text"><?php the_title(); ?></span>
				</h1>

				<?php the_excerpt(); ?>
						
				<a href="<?php echo get_permalink( get_page_by_path( 'eventos' ) ) ?>" class="button"><?php _e('Ver Servicio','primal') ?></a>

				<?php 
				$image = get_field('imagen-banner-eventos');
				if( !empty($image) ): ?>
					<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" class="hide-for-small-only" />
				<?php endif; ?>
			</div>
		</div>
	</div>

	
					
<?php endwhile; ?>

<?php wp_reset_query(); ?>
	

</section>