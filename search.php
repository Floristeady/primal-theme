<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage primal
 * @since primal 1.0
 */

get_header(); ?>

<div id="content" class="site-content" role="main">

	<?php if ( have_posts() ) : ?>

	<header class="page-header">
		<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'primal' ), get_search_query() ); ?></h1>
	</header>

		<?php
			while ( have_posts() ) : the_post();
			
				get_template_part( 'content', get_post_format() );

			endwhile;

			primal_paging_nav();

		else :

			get_template_part( 'content', 'none' );

		endif;
	?>

</div><!-- #content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
