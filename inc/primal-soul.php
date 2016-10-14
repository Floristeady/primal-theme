<section id="id-primal-soul" class="home-section">
<?php
	query_posts('pagename=primal-soul');
	while ( have_posts() ) : the_post(); ?>
	
		<div class="title">
			<h1>&nbsp;PRIMAL<br><span class="yellow-text">SOUL</span></h1>
		</div>
			<div class="large-12 column small-centered">	
				<div class="medium-12 column">
					<div class="column">
						<div class="bg-yellow">
							<div class="medium-6 columns">
							  	<h2 id="post-<?php the_ID(); ?>">
							  		PRIMAL<br>
							  		<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
							  			<?php the_title(); ?>
							  		</a>
							  	</h2>

							  	<?php the_excerpt(); ?>
							</div>

							<div class="medium-6 columns p0right p0left img-box">
								<a href="<?php echo get_permalink( get_page_by_path( 'primal-soul' ) ) ?>" class="button"><?php _e('Ver Info','primal') ?></a>
								<?php the_post_thumbnail(); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
				
<?php endwhile; ?>
<?php wp_reset_query(); ?>
</section>