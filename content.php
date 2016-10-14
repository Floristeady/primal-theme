<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage primal
 * @since primal 1.0
 */
?>

<?php if ( is_single() ) : ?>
<div class="navigation">
	<div class="alignleft"><?php previous_post_link(); ?></div>
	<div class="alignright"><?php next_post_link(); ?></div>
</div>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<div class="entry-info">
				
			<?php  if ( !is_category() ) :  
			 	 the_category(); 
			 endif; ?>
			
		</div>
		
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>		
	</header>
	

	<?php primal_post_thumbnail(); ?>
	<p class="caption"><?php echo get_post(get_post_thumbnail_id())->post_excerpt; ?></p>

	<?php if ( is_search() ) : ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content">
		<?php
			the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'primal' ) );
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'primal' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			) );
		?>

	</div><!-- .entry-content -->
	<?php endif; ?>

	<?php the_tags( '<footer class="entry-meta"><span class="tag-links">', '', '</span></footer>' ); ?>
</article><!-- #post-## -->

<?php else : ?>

<li id="post-<?php the_ID(); ?>" class="column small-4">

	<div class="inner">
		<a class="post-thumbnail" href="<?php the_permalink(); ?>">			
			<?php 
			if ( is_front_page() ) :
				the_post_thumbnail('blog-thumb');  
			else : 
			 	the_post_thumbnail('blog-thumb');  
			endif; 
			?>
		</a>
		
		<div class="entry-header">
			<?php
	            the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			?>
		</div>
		
		<a class="button-simple" href="<?php the_permalink(); ?>"><?php _e('Leer más', 'spincommerce')?></a>
		
	</div>

</li>

<?php endif; ?>
