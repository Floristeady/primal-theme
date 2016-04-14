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
	
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php
					the_title( '<header class="entry-header"><h1 class="entry-title">', '</h1></header><!-- .entry-header -->' );
				?>
			
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
			</article>
	
		<?php endwhile; ?>

</div><!-- #content -->

<?php get_footer(); ?>