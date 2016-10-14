<section id="seccion-tienda" class="home-section">
<div class="row">	
	<div class="medium-12 text-center">
		<?php if (get_field('titulo_mapa') or get_field('mapa') or get_field('imagen_mapa')) { ?>
			<?php 
			$image = get_field('imagen_mapa');
			if( !empty($image) ): ?>
			<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
			<?php endif; ?>

			<?php if (get_field('titulo_mapa')) { ?>
			<h1>
				<?php the_field('titulo_mapa');?><br>
			</h1>
			<?php } ?>
		
			<div class="map-container">
				<?php if (get_field('mapa')) { ?>
					<?php the_field('mapa');?>
				<?php } ?>
			</div>
		
		<?php } ?>
	</div>
</div>

<div class="row">
	<div class="medium-12">
		<br>
		<div class="text-center">
			<a href="http://primal.bootic.net/products" class="button"><?php _e('Ir a tienda online','primal') ?></a>	
		</div>
	</div>
</div>
</section>
<script type="text/javascript">
	jQuery(document).ready(function($){
	  $('.map-container')
	      .click(function(){
	              $(this).find('iframe').addClass('clicked')})
	      .mouseleave(function(){
	              $(this).find('iframe').removeClass('clicked')});
	});
</script>