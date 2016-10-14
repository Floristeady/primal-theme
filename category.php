<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @package WordPress
 * @subpackage primal
 * @since primal 1.0
 */

get_header(); ?>

<div id="content" class="site-content archive">

	<?php if ( have_posts() ) : ?>

	<div class="row">
	<header class="entry-header">
		<h1 class="entry-title"><?php printf( __( '%s', 'primal' ), single_cat_title( '', false ) ); ?></h1>

		<?php
			// Show an optional term description.
			$term_description = term_description();
			if ( ! empty( $term_description ) ) :
				printf( '<div class="taxonomy-description">%s</div>', $term_description );
			endif;
		?>
	</header>

	<ul id="blog-items" class="small-up-1 medium-up-2 large-up-3">

		<?php 

			while ( have_posts() ) : the_post();

			get_template_part( 'content', get_post_format() );

			endwhile;

			primal_paging_nav();

		else :
		
			get_template_part( 'content', 'none' );

		endif;
	?>
	
	</ul>
	</div>
	
</div><!-- #content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>