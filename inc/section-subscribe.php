<?php if (get_field('section_title') or get_field('section_text') or get_field('section_content')) { ?>
<section id="id-suscribe" class="home-section">
			
	<div class="row">
		<div class="column medium-12 small-centered">
			<?php if (get_field('section_title')) { ?>
			<h1><?php the_field('section_title');?></h1>
			<?php } ?>
			
			<?php if (get_field('section_text')) { ?>
			<p><?php the_field('section_text');?>
</p>
			<?php } ?>
			
			<?php if (get_field('section_content')) { ?>
				<?php the_field('section_content');?>
			<?php } ?>
		</div>
	</div>
			
</section>
<?php } ?>