<?php
/**
 * The template for displaying a "No posts found" message
 *
 * @package WordPress
 * @subpackage primal
 * @since primal 1.0
 */
?>

<div class="site-content">
	<div class="row page" style="text-align:center;">
		<div class="columns small-12 m30top">
			<h1 class="page-title m30top"><?php _e( 'Nothing Found', 'primal' ); ?></h1>

			<div class="page-content">
				<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

				<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'primal' ), admin_url( 'post-new.php' ) ); ?></p>

				<?php elseif ( is_search() ) : ?>

				<p class="m30top"><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'primal' ); ?></p>
				<div class="m30top">
				<?php get_search_form(); ?>
				</div>

				<?php else : ?>

				<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'primal' ); ?></p>
				<?php get_search_form(); ?>

				<?php endif; ?>
			</div>
		</div>
	</div>
</div>