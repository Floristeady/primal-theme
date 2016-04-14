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
	
	if ( have_posts() ) : ?>
	
	<div class="row">
	
		<?php $posts_page = get_option( 'page_for_posts' );
			$content = get_post( $posts_page )->post_excerpt; 
			$title   = get_post( $posts_page )->post_title; ?>
		<h1 class="entry-title"><?php echo $title; ?></h1>
	
		<ul id="blog-items" class="small-up-1 medium-up-2 large-up-3">

		<?php while ( have_posts() ) : the_post(); ?>
			
			<?php get_template_part( 'content'); ?>

		<?php endwhile; ?>
		
		</ul>
		
		<?php primal_paging_nav();  ?>

	</div>
	
	<?php else :
		get_template_part( 'content', 'none' ); 
		
	endif; ?>

</div>

<?php get_footer(); ?>