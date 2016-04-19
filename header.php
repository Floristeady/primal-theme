<?php
/**
 * The Header for our theme.
 * 
 * @package WordPress
 * @subpackage primal
 * @since primal 1.0
 */
?><!DOCTYPE html>
<!--[if IE 8 ]><html <?php language_attributes(); ?> class="no-js ie ie8"><![endif]-->
<!--[if IE 9 ]><html <?php language_attributes(); ?> class="no-js ie ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html <?php language_attributes(); ?> ><!--<![endif]-->
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width">
		<title><?php wp_title( '|', true, 'right' ); ?></title>
			
	    <meta name="description" content="<?php echo '' . get_bloginfo ( 'description' );  ?>">
	    <meta name="robots" content="index,follow">
		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
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
	<body <?php body_class(); ?>>
				
		<header id="header">
			
			<div id="inner-wrap">
		       <nav id="mobile-access" role="navigation" class="">
		          <?php wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'mobile' ) ); ?>
		          <a href="javascript:void(0)" id="nav-close-btn"></a>
		       </nav>      
		       <div class="drawer-close drawer-back"></div>
		    </div> 
		
			<div class="header-top">
				
				<a href="javascript:void(0)" id="button-mobile" class="icon-menu">
	               <span class="bars">
	                 <div class="top-bar-button"></div>
	                 <div class="middle-bar"></div>
	                 <div class="bottom-bar"></div>
	               </span>
	            </a>
				
				<?php if ( is_active_sidebar( 'header-widget-area' ) ) : ?>
					<div class="widget-header">
						<?php dynamic_sidebar( 'header-widget-area' ); ?>
					</div>		
				<?php endif; ?>
				
				<div id="search-container" class="search-box-wrapper">
					<?php get_search_form(); ?>
				</div>

			</div>

			<div class="header-main">
				
				<nav id="access" role="navigation" class="row">
					
					<div class="column medium-5">
					<?php wp_nav_menu( array( 'container_class' => 'menu-main', 'theme_location' => 'primary' ) ); ?>
					</div>
				
					<?php global $logo, $options, $logo_settings;
					$logo_settings = get_option('plugin_options', $options ); 
					error_reporting(E_ALL ^ E_NOTICE);
					?>
					
					<div class="small-centered">
						<div id="logo-container">
							
							<?php if( $logo_settings['logo_theme_url'] ) : ?>
							<a class="logo" href="<?php echo bloginfo('url'); ?>">
								<img width="133" src="<?php echo $logo_settings['logo_theme_url']; ?>" alt="<?php bloginfo('name'); ?>" /></a>
						<?php  else : ?>
							<h1><a href="<?php echo bloginfo('url'); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
							<?php endif; ?>
						</div>
						
					</div>
					
					<div class="column medium-5">
					<?php wp_nav_menu( array( 'container_class' => 'menu-main', 'theme_location' => 'secondary' ) ); ?>
					</div>
					
				</nav>
				
				<?php if ( is_active_sidebar( 'header-main-widget-area' ) ) : ?>
					<div class="widget-header">
						<?php dynamic_sidebar( 'header-main-widget-area' ); ?>
					</div>		
				<?php endif; ?>
				
			</div>

		</header>

		<section id="main" role="main">
			