<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after.  Calls sidebar-footer.php for bottom widgets.
 *
 * @package WordPress
 * @subpackage primal
 * @since primal 1.0
 */
?>
	
	<footer id="footer" class="site-footer" role="contentinfo">
		<div class="footer-content">
			<div class="medium-12 column">
			<div class="column">
			<?php get_sidebar( 'footer' ); ?>
			</div>
			</div>
		</div>
	</footer><!-- footer -->
	
	</section><!-- #main -->
	
	<?php wp_footer(); ?>
	<script src="https://du8eo9nh88b2j.cloudfront.net/libs/0.0.2/search_widget.min.js" type="text/javascript"></script>
	</body>
</html>