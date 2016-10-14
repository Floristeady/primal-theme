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

<section id="id-faq" class="id-blog home-section">
	
	<div class="column medium-11 small-centered">
		
		<div class="title">
			
			<?php $posts_page = get_option( 'page_for_posts' );
			$content = get_post( $posts_page )->post_excerpt; 
			$title   = get_post( $posts_page )->post_title; ?>
			<h1>¿TIENES DUDAS SOBRE NUESTROS PRODUCTOS?</h1>
			<a href="<?php echo get_permalink( get_page_by_path( 'faq' ) ) ?>" class="button"><?php _e('REVISA NUESTRA SECCIÓN DE PREGUNTAS','primal') ?></a>
			
		</div>
	</div>
	
</section>
<? endif; ?>
		