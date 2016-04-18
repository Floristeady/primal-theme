<?php 
$args = array(
'post_type'	=> 'post',
'post_status' => 'publish',
'posts_per_page' => 3,
'orderby' => 'date',
'order' => 'DESC',
'offset' => 0
 );
 $last_post = new WP_Query( $args );
?>

<?php if ( $last_post ->have_posts() ) : ?>

<section id="id-blog" class="id-blog home-section">
	
	<div class="column medium-11 small-centered">
		
		<div class="title">
			
			<?php $posts_page = get_option( 'page_for_posts' );
			$content = get_post( $posts_page )->post_excerpt; 
			$title   = get_post( $posts_page )->post_title; ?>
			<h1><?php echo $title; ?></h1>
			<a href="<?php echo get_permalink( get_page_by_path( 'nuestro-blog' ) ) ?>" class="button"><?php _e('Ver Todo','primal') ?></a>
			
		</div>
		
		<ul id="blog-items" class="small-up-1 medium-up-2 large-up-3">
	
		<?php while ( $last_post ->have_posts() ) : $last_post ->the_post(); 
			
			get_template_part( 'content');
			
		 endwhile; wp_reset_postdata(); ?>
		 <?php wp_reset_query(); ?>
		</ul>
	</div>
	
</section>
<? endif; ?>
		