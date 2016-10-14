<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width">
		<title><?php wp_title( '|', true, 'right' ); ?></title>
			
	    <meta name="description" content="<?php echo '' . get_bloginfo ( 'description' );  ?>">
	    <meta name="robots" content="index,follow">
		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

		<!-- ICONS ADD BY FRANCISCO -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css">


		<!--[if lte IE 9]>
		  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
<?php
		/* pages with no-js for commmets */
		if ( is_singular() && get_option( 'thread_comments' ) )
			wp_enqueue_script( 'comment-reply' );

		/* no delete*/
		wp_head();
?>
	</head>

<?php

/**
 * Template Name: Modal Suscripción
 * @package WordPress
 * @subpackage primal
 * @since primal 1.0
 */

?>
<body style="padding-top: 0px !important;"><!--  overflow: hidden !important; -->
	<div id="content" class="modal-content">
	<?php
		while ( have_posts() ) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>">
			<?php the_post_thumbnail(); ?>
			<h1><?php the_title( ); ?></h1>
					
			<div class="entry-content">
				<?php the_content(); ?>
			</div><!-- .entry-content -->
		</article>
	<?php endwhile; ?>
	</div><!-- #content -->
</body>