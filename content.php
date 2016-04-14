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
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		
		<div class="entry-info">
				
			<?php  if ( !is_category() ) :  
			 	 the_category(); 
			 endif; ?>
			
		</div>
		
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta">
			<?php
				if ( 'post' == get_post_type() )
					primal_posted_on();

				if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) :
			?>
			
				   <?php if ( 'post' == get_post_type() ) : ?>
					<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'primal' ), __( '1 Comment', 'primal' ), __( '% Comments', 'primal' ) ); ?></span>
					<?php endif; ?>
			<?php
		    endif;

				edit_post_link( __( 'Edit', 'primal' ), '<span class="edit-link">', '</span>' );
			?>
		</div><!-- .entry-meta -->
		
		<div class="entry-excerpt">
		<?php the_excerpt();  ?>
		</div>
		
	</header>
	
	<?php primal_post_thumbnail(); ?>

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

<li id="post-<?php the_ID(); ?>" class="column">

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
