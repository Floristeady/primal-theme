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
	<div class="row page search">
	<?php if ( have_posts() ) : ?>

		<header class="entry-header">
			<h1 class="entry-title"><?php printf( __( 'Resultados de: %s', 'primal' ), get_search_query() ); ?></h1>
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
