<?php
/**
 * The main template file.
 *
 * @package WordPress
 * @subpackage primal
 * @since primal 1.0
 */

get_header(); ?>


<div id="content" class="site-content" role="main">
<?php
	
	if ( have_posts() ) :

		while ( have_posts() ) : the_post();

			get_template_part( 'content');

		endwhile;
		primal_paging_nav();

	else :
		get_template_part( 'content', 'none' );

	endif;
?>

</div>

<?php get_footer(); ?>