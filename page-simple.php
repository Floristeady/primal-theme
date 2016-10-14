<?php
/**
 * Template Name: Plantilla simple
 *
 * @package WordPress
 * @subpackage primal
 * @since primal 1.0
 */

get_header(); ?>

<div id="content" class="site-content">

		<?php
			while ( have_posts() ) : the_post(); ?>
	
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php
					the_title( '<header class="entry-header"><h1 class="entry-title">', '</h1></header><!-- .entry-header -->' );
				?>
				
				<div class="row">
					
					<div class="medium-12 columns">
						<div class="entry-content">
							<?php
								the_content();
								wp_link_pages( array(
									'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'primal' ) . '</span>',
									'after'       => '</div>',
									'link_before' => '<span>',
									'link_after'  => '</span>',
								) );
						
								edit_post_link( __( 'Edit', 'primal' ), '<span class="edit-link">', '</span>' );
							?>
						</div><!-- .entry-content -->
					</div>
				</div>
			</article>

			<!-- Add by Francisco -->
			<?php if (get_field('formservicios') or get_field('formulario_servicios')) { ?>
			<section id="form-page" class="home-section">	
				<div class="row">
					<div class="medium-10 medium-offset-1 columns">
						<?php if (get_field('formulario_servicios')) { ?>
						<?php the_field('formulario_servicios');?>
						<?php } ?>
					</div>
				</div>		
			</section>
			<?php } ?>

			<!-- Add by Francisco -->
			<?php if (get_field('paginas') or get_field('imagen') or get_field('texto_imagen')) { ?>
			<section id="imagen-page" class="home-section">		
				<?php if (get_field('texto_imagen')) { ?>
				<h1><?php the_field('texto_imagen');?></h1>
				<?php } ?>
						
				<?php 
				$image = get_field('imagen');

				if( !empty($image) ): ?>
				<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
				<?php endif; ?>		
			</section>
			<?php } ?>
	
		<?php endwhile;
		?>

</div><!-- #content -->

<?php get_footer(); ?>