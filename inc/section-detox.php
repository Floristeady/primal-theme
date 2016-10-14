<?php if (get_field('titulo_detox') or get_field('imagen-detox')) { ?>
<section id="seccion-detox" class="home-section">
	<div class="large-12 column small-centered text-center">
		<div class="medium-12 column">
			<div class="column">
				<div class="bg-detox">
				<?php if (get_field('titulo_detox')) { ?>
					<h1>
						<?php the_field('titulo_detox');?><br><br><br>
						<a href="http://primal.bootic.net/collections/principiante" class="button"><?php _e('Básico','primal') ?></a>
						<a href="http://primal.bootic.net/collections/intermedio" class="button disabled" title="Proximamente!"><?php _e('Intermedio','primal') ?></a>
						<a href="http://primal.bootic.net/collections/experto" class="button disabled" title="Proximamente!"><?php _e('Avanzado','primal') ?></a>
					</h1>
				<?php } ?>
						
				<?php 
				$image = get_field('imagen-detox');
				if( !empty($image) ): ?>
					<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
				<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</section>
<?php } ?>