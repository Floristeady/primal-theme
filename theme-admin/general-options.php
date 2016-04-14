<?php

/*
	Begin Admin panel.
*/

/*	Define theme URI */
	define('BP_THEME_URL', get_template_directory_uri());

/*
	There are essentially 5 sections to this:
	1)	Add "Admin" link to left-nav Admin Menu & callback function for clicking that menu link
	2)	Add Admin Page CSS if on the Admin Page
	3)	Add "Admin" Page options
	4)	Create functions to add above elements to pages
	5)	Add Admin options to page as requested
*/

/*	1)	Add "theme Admin" link to left-nav Admin Menu & callback function for clicking that menu link */

	//	Add option if in Admin Page
	if ( ! function_exists( 'create_theme_admin_page' ) ):
		function create_theme_admin_page() {
			add_theme_page( __('General Options', 'primal'), __( 'General Options', 'primal'), 'administrator', 'theme-admin', 'build_theme_admin_page');
		}
		add_action('admin_menu', 'create_theme_admin_page');
	endif; // create_theme_admin_page

	//	You get this if you click the left-column "theme Admin" (added above)
	if ( ! function_exists( 'build_theme_admin_page' ) ):
		function build_theme_admin_page() {
		?>
			<div id="theme-options-wrap">
				<div class="icon32" id="icon-tools"><br /></div>
				<h2><?php _e( 'General options for', 'primal' ); ?> <?php echo wp_get_theme() . __( '', 'primal' );?> </h2>
				<p><?php _e( 'This is the web site manager. Select the options you want to include on the website.', 'primal' ); ?></p>

				<form method="post" action="options.php" enctype="multipart/form-data">
					<?php settings_fields('plugin_options'); /* very last function on this page... */ ?>
					<?php do_settings_sections('theme-admin'); /* let's get started! */?>
					<p class="submit"><input name="Submit" type="submit" class="button-primary" value="<?php esc_attr_e('Save Changes'); ?>"></p>
				</form>
			</div>
		<?php
		}
	endif; // build_theme_admin_page

/*	2)	Add Admin Page CSS if on the Admin Page */
	if ( ! function_exists( 'admin_register_head' ) ):
		function admin_register_head() {
			echo '<link rel="stylesheet" href="' .BP_THEME_URL. '/theme-admin/general-options.css">'.PHP_EOL;
		}
		add_action('admin_head', 'admin_register_head');
	endif; // admin_register_head

/*	3)	Add "theme Admin" Page options */
	//	Register form elements
	if ( ! function_exists( 'register_and_build_fields' ) ):
		function register_and_build_fields() {
			register_setting('plugin_options', 'plugin_options', 'validate_setting');
			add_settings_section('main_section', '', 'section_cb', 'theme-admin');
			//logo
			add_settings_field('logo_theme', __('Add Logotype:', 'primal'), 'logotype_setting', 'theme-admin', 'main_section');
			add_settings_field('google_verification', 'Google Analytics ID:', 'google_verification_setting', 'theme-admin', 'main_section');
			
			
			add_settings_field('meta_tags', 'Meta Keywords tags?:', 'meta_tags_setting', 'theme-admin', 'main_section');
	

			add_settings_field('modernizr_js', 'Modernizr JS?:', 'modernizr_js_setting', 'theme-admin', 'main_section');
			add_settings_field('jquery_js', 'jQuery JS?:', 'jquery_js_setting', 'theme-admin', 'main_section');
			add_settings_field('plugins_js', 'jQuery plug-ins JS:', 'plugins_js_setting', 'theme-admin', 'main_section');
			add_settings_field('site_js', 'Site-specific JS?:', 'site_js_setting', 'theme-admin', 'main_section');
			add_settings_field('cache_buster', 'Cache-Buster?:', 'cache_buster_setting', 'theme-admin', 'main_section');
			
		}
		add_action('admin_init', 'register_and_build_fields');
	endif; // register_and_build_fields

	//	Add Admin Page validation
	if ( ! function_exists( 'validate_setting' ) ):
		function validate_setting($plugin_options) {
			$keys = array_keys($_FILES);
			$i = 0;
			foreach ( $_FILES as $image ) {
				// if a files was upload
				if ($image['size']) {
					// if it is an image
					if ( preg_match('/(jpg|jpeg|png|gif)$/', $image['type']) ) {
						$override = array('test_form' => false);
						// save the file, and store an array, containing its location in $file
						$file = wp_handle_upload( $image, $override );
						$plugin_options[$keys[$i]] = $file['url'];
					} else {
						// Not an image.
						$options = get_option('plugin_options');
						$plugin_options[$keys[$i]] = $options[$logo];
						// Die and let the user know that they made a mistake.
						wp_die('No image was uploaded.');
					}
				} else { // else, the user didn't upload a file, retain the image that's already on file.
					$options = get_option('plugin_options');
					$plugin_options[$keys[$i]] = $options[$keys[$i]];
				}
				$i++;
			}
			return $plugin_options;
		}
	endif; // validate_setting

	//	Add Admin Page options

	//	in case you need it...
	if ( ! function_exists( 'section_cb' ) ):
		function section_cb() {}
	endif; // section_cb
	
	//	logotype
	if ( ! function_exists( 'logotype_setting' ) ):
		function logotype_setting() {
			$options = get_option('plugin_options');
			$home = home_url();
			$checked = (isset($options['logo_theme']) && $options['logo_theme'] && $options['logo_theme_url'] && $options['logo_theme_url'] !== '') ? 'checked="checked" ' : '';
			$logo = (isset($options['logo_theme_url']) && $options['logo_theme_url']) ? $options['logo_theme_url'] : '';
			
			echo '<input class="check-field" type="checkbox" name="plugin_options[logo_theme]" value="true" ' .$checked. '/>';
			
			echo '<p><a href="'. $home .'/wp-admin/media-new.php" target="_blank"><em>'; _e( 'Upload your own logo image</em></a> using the WordPress Media Library and insert the URL here:</p>', 'primal' );
			echo '<input type="text" size="80" name="plugin_options[logo_theme_url]" value="'.$logo.'" onfocus="javascript:if(this.value===\'\'){this.select();}">';
			echo '<img width="200" style="margin-top: 10px;" src="'. (($logo!=='') ? $logo :  get_template_directory_uri() .'/images/logo.png').'">';
		}
	endif; // logotype

	//	callback fn for google_verification
	if ( ! function_exists( 'google_verification_setting' ) ):
		function google_verification_setting() {
			$options = get_option('plugin_options');
			$checked = (isset($options['google_verification']) && $options['google_verification'] && $options['google_verification_account'] && $options['google_verification_account'] !== 'XXXXXXXXX...') ? 'checked="checked" ' : '';
			$account = (isset($options['google_verification_account']) && $options['google_verification_account']) ? $options['google_verification_account'] : 'XXXXXXXXX...';

			$msg = ($account === 'XXXXXXXXX...') ? ', where </code>XXXXXXXXX...</code> will be replaced with the code you insert above' : '';
			echo '<input class="check-field" type="checkbox" name="plugin_options[google_verification]" value="true" ' .$checked. '/>';
			echo _e( '<p>Add <a href="https://support.google.com/webmasters/answer/35179">Google Verification</a> code and <a href="https://www.google.com/analytics">Google Universal Analytics </a> code to the <code>&lt;head&gt;</code> of all your pages.</p>', 'primal' );
			echo _e( '<p>To include Google Analytics and Google Verification code, select this option and add your Verification number here and the site domain. Google Analytics ID:</p>', 'primal' );
			echo '<input type="text" size="20" name="plugin_options[google_verification_account]" value="'.$account.'" onfocus="javascript:if(this.value===\'XXXXXXXXX...\'){this.select();}"></p>';
			
			echo _e( '<p>This will add the following code to the <code>&lt;head&gt;</code> of your pages, where <code>XXXXXXXXX?</code> will be replaced with the code you insert above.</p><br/>', 'primal' );
			
			echo '<code>&lt;meta name="google-site-verification" content="'.$account.'"&gt;</code>';
			echo _e( '<p>And will add the latest version of Universal Analytics tracking code, to track website visitors with Google Analytics.</p>', 'primal' );
		}
	endif; // google_verification_setting

	//	callback fn for google_verification
	if ( ! function_exists( 'meta_tags_setting' ) ):
		function meta_tags_setting() {
			$options = get_option('plugin_options');
			$checked = (isset($options['meta_tags']) && $options['meta_tags'] && $options['meta_tags_keys'] && $options['meta_tags_keys'] !== 'tags...') ? 'checked="checked" ' : '';
			$tags = (isset($options['meta_tags_keys']) && $options['meta_tags_keys']) ? $options['meta_tags_keys'] : 'tags...';
			$msg = ($tags === 'tags...') ? ', where </code>tags...</code> will be replaced with the code you insert above.' : '';
			echo '<input class="check-field" type="checkbox" name="plugin_options[meta_tags]" value="true" ' .$checked. '/>';
			echo _e( '<p>Add meta keywords tags for SEO, write your keywords separated by a comma, but not a space.</p>', 'primal' );
			echo '<input type="text" size="80" name="plugin_options[meta_tags_keys]" value="'.$tags.'" onfocus="javascript:if(this.value===\'tags...\'){this.select();}"></p>';
			echo _e('<p>Selecting this option will add the following code to the <code>&lt;head&gt;</code> of your pages, where </code>tags...</code> will be replaced with the code you insert above</p>', 'primal' );
			echo '<code>&lt;meta name="keywords" content="'.$tags.'"&gt;</code>';
		}
	endif; // google_verification_setting

		//	callback fn for modernizr_js
	if ( ! function_exists( 'modernizr_js_setting' ) ):
		function modernizr_js_setting() {
			$options = get_option('plugin_options');
			$checked = (isset($options['modernizr_js']) && $options['modernizr_js']) ? 'checked="checked" ' : '';
			echo '<input class="check-field" type="checkbox" name="plugin_options[modernizr_js]" value="true" ' .$checked. '/>';
			echo _e('<p><a href="http://modernizr.com">Modernizr</a> is a JS library that appends classes to the <code>&lt;html&gt;</code> that indicate whether the user\'s browser is capable of handling advanced CSS, like "cssreflections" or "no-cssreflections".  It\'s a really handy way to apply varying CSS techniques, depending on the user\'s browser\'s abilities, without resorting to CSS hacks.</p>', 'primal' );
			echo _e('<p>Selecting this option will add the following code to the <code>&lt;head&gt;</code> of your pages (note the lack of a version, when you\'re ready to upgrade, simply copy and paste the new version into the file below, and your site is ready to go!):</p>', 'primal' );
			echo '<code>&lt;script src="' .BP_THEME_URL. '/js/modernizr.js"&gt;&lt;/script&gt;</code>';
		
		}
	endif; // modernizr_js_setting

	//	callback fn for jquery_js
	if ( ! function_exists( 'jquery_js_setting' ) ):
		function jquery_js_setting() {
			$options = get_option('plugin_options');
			$checked = (isset($options['jquery_js']) && $options['jquery_js']) ? 'checked="checked" ' : '';
			$version = (isset($options['jquery_version']) && $options['jquery_version'] && $options['jquery_version'] !== '') ? $options['jquery_version'] : '1.12.2';
			$inhead = (isset($options['jquery_head']) && $options['jquery_head']) ? 'checked="checked" ' : '';
			echo '<input class="check-field" type="checkbox" name="plugin_options[jquery_js]" value="true" ' .$checked. '/>';
			echo _e('<p><a href="http://jquery.com/">jQuery</a> is a JS library that aids greatly in developing high-quality JavaScript quickly and efficiently.</p>', 'primal' );
			echo  _e( '<p>Selecting this option will add the following code to your pages just before the: <code>&lt;/body&gt;</code></p>', 'primal' );
			echo '<code>&lt;script src="//ajax.googleapis.com/ajax/libs/jquery/'.$version.'/jquery.min.js">&lt;/script&gt;</code>';
			echo '<code>&lt;script&gt;window.jQuery || document.write("&lt;script src="js/jquery-1.12.2.min.js"&lt;/script&gt;")</code>';
			echo '<p><input class="check-field" type="checkbox" name="plugin_options[jquery_head]" value="true" ' .$inhead. '/>';
			echo _e('<p><strong>Note: <a href="http://developer.yahoo.com/blogs/ydn/posts/2007/07/high_performanc_5/">Best-practices</a> recommend that you load JS as close to the <code>&lt;/body&gt;</code> as possible.  If for some reason you would prefer jQuery and jQuery plug-ins to be in the <code>&lt;head&gt;</code>, please select this option.</strong></p>', 'primal' );
			echo _e('<p>The above code first tries to download jQuery from Google\'s CDN (which might be available via the user\'s browser cache).  If this is not successful, it uses the theme\'s version.</p>', 'primal' );
			echo _e('<p><strong>Note: This plug-in tries to keep current with the most recent version of jQuery.  If for some reason you would prefer to use another version, please indicate that version:</strong></p><br/>', 'primal' );
			echo '<input type="text" size="6" name="plugin_options[jquery_version]" value="'.$version.'"> (<a href="http://code.google.com/apis/libraries/devguide.html#jquery">see all versions available via Google\'s CDN</a>)</p>';
		}
	endif; // jquery_js_setting

	//	callback fn for plugins_js
	if ( ! function_exists( 'plugins_js_setting' ) ):
		function plugins_js_setting() {
			$options = get_option('plugin_options');
			$checked = (isset($options['plugins_js']) && $options['plugins_js']) ? 'checked="checked" ' : '';
			echo '<input class="check-field" type="checkbox" name="plugin_options[plugins_js]" value="true" ' .$checked. '/>';
			echo _e('<p>If you choose to use any <a href="http://plugins.jquery.com/">jQuery plug-ins</a>, I recommend downloading and concatenating them together in a single JS file, as below.  This will <a href="http://developer.yahoo.com/performance/rules.html">reduce your site\'s HTTP Requests</a>, making your site a better experience.</p>', 'primal' );
			echo  _e( '<p>Selecting this option will add the following code to your pages just before the: <code>&lt;/body&gt;</code></p>', 'primal' );
			echo '<code>&lt;script type=\'text/javascript\' src=\'' .BP_THEME_URL. '/js/plug-in.js?ver=x\'&gt;&lt;/script&gt;</code>';
			echo _e('<p><strong>Note: If you do <em>not</em> include jQuery, this file will <em>not</em> be added to the page.</strong></p>', 'primal' );
		}
	endif; // plugins_js_setting

	//	callback fn for site_js
	if ( ! function_exists( 'site_js_setting' ) ):
		function site_js_setting() {
			$options = get_option('plugin_options');
			$checked = (isset($options['site_js']) && $options['site_js']) ? 'checked="checked" ' : '';
			echo '<input class="check-field" type="checkbox" name="plugin_options[site_js]" value="true" ' .$checked. '/>';
			echo _e( '<p>If you would like to add your own site JavaScript file, we provides a starter file located in:</p>', 'primal' );
			echo '<code>' .BP_THEME_URL. '/js/script-starter.js</code>';
			echo _e( '<p>Add what you want to that file and select this option.</p>', 'primal' );
			echo  _e( '<p>Selecting this option will add the following code to your pages just before the: <code>&lt;/body&gt;</code></p>', 'primal' );
			echo '<code>&lt;script type=\'text/javascript\' src=\'' .BP_THEME_URL. '/js/script-starter.js?ver=x\'&gt;&lt;/script&gt;</code>';
		}
	endif; // site_js_setting

	//	callback fn for cache_buster
	if ( ! function_exists( 'cache_buster_setting' ) ):
		function cache_buster_setting() {
			$options = get_option('plugin_options');
			$checked = (isset($options['cache_buster']) && $options['cache_buster']) ? 'checked="checked" ' : '';
			$version = (isset($options['cache_buster_version']) && $options['cache_buster_version']) ? $options['cache_buster_version'] : '1';
			echo '<input class="check-field" type="checkbox" name="plugin_options[cache_buster]" value="true" ' .$checked. '/>';
			echo _e( '<p>To force browsers to fetch a new version of a file, versus one it might already have cached, you can add a "cache buster" to the end of your CSS and JS files.</p>', 'primal' );
			echo _e( '<p>To increment the cache buster version number, type something here:</p><br />', 'primal' );
			echo '<input type="text" size="4" name="plugin_options[cache_buster_version]" value="'.$version.'"></p>';
			echo _e( '<p>Selecting this option will add the following code to the end of all of your CSS and JS file names on all of your pages:</p>', 'primal' );
			echo '<code>?ver='.$version.'</code>';
		}
	endif; // cache_buster_setting
	


/*	4)	Create functions to add above elements to pages */

    //logo
	if ( ! function_exists( 'add_logo' ) ):
		function add_logo() {
			global $logo, $options;
			$options = get_option('plugin_options');
			$logo = $options['logo_theme_url'];
		}
    endif; // logo

	//	$options['google_verification']
	if ( ! function_exists( 'add_google_verification' ) ):
		function add_google_verification() {
			$options = get_option('plugin_options');
			$account = $options['google_verification_account'];
			echo '<meta name="google-site-verification" content="'.$account.'">'.PHP_EOL;
				  
			echo '<script>
			(function(i,s,o,g,r,a,m){i["GoogleAnalyticsObject"]=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,"script","//www.google-analytics.com/analytics.js","ga");
			ga("create", "'.$account.'", "auto");
			ga("require", "displayfeatures");
			ga("send", "pageview");
			</script>'.PHP_EOL;
		}
	endif; // add_google_verification
	
	//	$options['add_meta_tags']
	if ( ! function_exists( 'add_meta_tags' ) ):
		function add_meta_tags() {
			$options = get_option('plugin_options');
			$tags = $options['meta_tags_keys'];
			echo '<meta name="keywords" content="'.$tags.'">'.PHP_EOL;
		}
    endif; // cache_buster

	//	$options['modernizr_js']
	if ( ! function_exists( 'add_modernizr_script' ) ):
		function add_modernizr_script() {
			$cache = cache_buster();
			wp_deregister_script( 'ieshiv' ); // get rid of IEShiv if it somehow got called too (IEShiv is included in Modernizr)
			wp_deregister_script( 'modernizr' ); // get rid of any native Modernizr
			echo '<script src="' .BP_THEME_URL. '/js/modernizr.js'.$cache.'"></script>'.PHP_EOL;
		}
	endif; // add_modernizr_script

	//	$options['jquery_js']
	if ( ! function_exists( 'add_jquery_script' ) ):
		function add_jquery_script() {
			$cache = cache_buster();
			$options = get_option('plugin_options');
			$version = ($options['jquery_version']) ? $options['jquery_version'] : '1.12.2';
			wp_deregister_script( 'jquery' ); // get rid of WP's jQuery
			echo '<script src="//ajax.googleapis.com/ajax/libs/jquery/'.$version.'/jquery.min.js"></script>'.PHP_EOL; // try getting from CDN
			echo '<script>window.jQuery || document.write(unescape(\'%3Cscript src="' .BP_THEME_URL. '/js/jquery.js'.$cache.'"%3E%3C/script%3E\'))</script>'.PHP_EOL; // fallback to local if CDN fails
		}
	endif; // add_jquery_script

	//	$options['plugins_js']
	if ( ! function_exists( 'add_plugin_script' ) ):
		function add_plugin_script() {
			$cache = cache_buster();
			echo '<script src="' .BP_THEME_URL. '/js/plugins.js'.$cache.'"></script>'.PHP_EOL;
		}
	endif; // add_plugin_script

	//	$options['site_js']
	if ( ! function_exists( 'add_site_script' ) ):
		function add_site_script() {
			$cache = cache_buster();
			echo '<script src="' .BP_THEME_URL. '/js/script-starter.js'.$cache.'"></script>'.PHP_EOL;
		}
	endif; // add_site_script

	//	$options['cache_buster']
	if ( ! function_exists( 'cache_buster' ) ):
		function cache_buster() {
			$options = get_option('plugin_options');
			return (isset($options['cache_buster']) && $options['cache_buster']) ? '?ver='.$options['cache_buster_version'] : '';
		}
	endif; // cache_buster
	
	    
   


/*	5)	Add theme options to page as requested */
		if (!is_admin() ) {

			// get the options
			$options = get_option('plugin_options');
			// check if each option is set (meaning it exists) and check if it is true 
			
			if (isset($options['google_verification']) && $options['google_verification'] && $options['google_verification_account'] && $options['google_verification_account'] !== 'XXXXXXXXX...') {
				add_action('wp_print_styles', 'add_google_verification');
			}
			
			if (isset($options['meta_tags']) && $options['meta_tags'] && $options['meta_tags_keys'] && $options['meta_tags_keys'] !== 'tags...') {
				add_action('wp_print_styles', 'add_meta_tags');
			}

			if (isset($options['modernizr_js']) && $options['modernizr_js']) {
				add_action('wp_print_styles', 'add_modernizr_script');
			} 

			if (isset($options['jquery_js']) && $options['jquery_js'] && isset($options['jquery_version']) && $options['jquery_version'] && $options['jquery_version'] !== '') {
				// check if should be loaded in <head> or at end of <body>
				$hook = (isset($options['jquery_head']) && $options['jquery_head']) ? 'wp_print_styles' : 'wp_footer';
				add_action($hook, 'add_jquery_script');
			}
			// for jQuery plug-ins, make sure jQuery was also set
			if (isset($options['plugins_js']) && $options['plugins_js']) {
				// check if should be loaded in <head> or at end of <body>
				$hook = (isset($options['jquery_head']) && $options['jquery_head']) ? 'wp_print_styles' : 'wp_footer';
				add_action($hook, 'add_plugin_script');
			}

			if (isset($options['site_js']) && $options['site_js']) {
				add_action('wp_footer', 'add_site_script');
			}
			
			
			
		} // if (!is_admin() )

?>