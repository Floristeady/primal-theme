<?php if (get_field('superalimentos_primal') or get_field('imagen') or get_field('mensaje')) { ?>
<section id="superalimentos_primal" class="home-section hide-for-small-only">
		<div class="large-12 column small-centered text-center">
			<div class="medium-12 column">
				<div class="column">
				<?php if (get_field('mensaje')) { ?>
					<h1>
						<?php the_field('mensaje');?><br>
						<a href="http://primal.bootic.net/collections/superalimentos" class="button"><?php _e('Ver Productos','primal') ?></a>
					</h1>
				<?php } ?>
				
				<?php 

				$image = get_field('imagen');

				if( !empty($image) ): ?>

					<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />

				<?php endif; ?>
				</div>
			</div>
		</div>

</section>
<?php } ?>