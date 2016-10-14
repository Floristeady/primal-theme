<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage primal
 * @since primal 1.0
 */

get_header(); ?>

<div id="content" class="site-content" role="main">
	<div class="row">
	<?php
		
		while ( have_posts() ) : the_post();

			get_template_part( 'content');

			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}
		endwhile;
	?>
	</div>
</div><!-- #content -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
