<?php

/**
 * Define constants
 */
define( 'WILLOW_CSS_DIR', trailingslashit(get_template_directory() . '/css' ) );
define( 'WILLOW_JS_DIR', trailingslashit(get_template_directory() . '/js' ) );
define( 'WILLOW_IMAGES_DIR', trailingslashit(get_template_directory() . '/images' ) );
define( 'WILLOW_ADMIN_DIR', trailingslashit(get_template_directory() . '/admin' ) );
define( 'WILLOW_INCLUDES_DIR', trailingslashit(get_template_directory() . '/includes' ) );
define( 'WILLOW_PLUGINS_DIR', trailingslashit(get_template_directory() . '/plugins' ) );

define( 'WILLOW_CSS', trailingslashit(get_template_directory_uri() . '/css' ) );
define( 'WILLOW_JS', trailingslashit(get_template_directory_uri() . '/js' ) );
define( 'WILLOW_IMAGES', trailingslashit(get_template_directory_uri() . '/images' ) );
define( 'WILLOW_ADMIN', trailingslashit(get_template_directory_uri() . '/admin' ) );
define( 'WILLOW_INCLUDES', trailingslashit(get_template_directory_uri() . '/includes' ) );

define( 'WILLOW_OPTION_KEY', 'willow_option' );

/**
 * Global variables
 */
global $willow_data;
$willow_data = array(
	'typography_types' => array(
		'heading'    => __( 'Heading Typography', 'willow' ),
		'body'       => __( 'Body Typography', 'willow' ),
	),
	'default_value' => array(
		'heading_font_face'    => 'Raleway',
		'body_font_face'       => 'Open Sans',
		'accent_color'         => '#0faf97',
	),
	'unique_counter' => 0,
);

/**
 * Generate Random ID with specified prefix string
 */
function willow_generate_id( $prefix = '' ) {
	global $willow_data;
	return $prefix . ++$willow_data['unique_counter'];
}

/**
 * Content Width
 */
if ( ! isset( $content_width ) ) $content_width = 760;

/**
 * Include all files in /includes directory
 */
$includes_files = array_filter( glob( WILLOW_INCLUDES_DIR . '*' ), 'is_file' );
foreach ( $includes_files as $file ) {
	require_once( $file );
}

/**
 * Include Willow Custom Menu Walker
 */
require_once( WILLOW_ADMIN_DIR . 'menu/willow_custom_menu.php' );

/**
 * Include Vafpress Framework functions
 */
require_once( 'functions-vafpress-framework.php' );

/**
 * Include Visual Composer functions
 */
if ( class_exists( 'WPBakeryVisualComposerAbstract' ) ) {
	require_once( 'functions-visual-composer.php' );
}

/**
 * Load Languages
 */
add_action( 'after_setup_theme', 'willow_languages' );
function willow_languages() {
    load_theme_textdomain( 'willow', get_template_directory() . '/lang' );
}

/**
 * TGM Plugin Activation
 */
function willow_tgmpa() {

	$plugins = array(
		array(
			'name'     => 'Visual Composer',
			'slug'     => 'js_composer',
			'source'   => WILLOW_PLUGINS_DIR . 'js_composer.zip',
			'required' => true,
		),
		array(
			'name'     => 'Vafpress Portfolio',
			'slug'     => 'vafpress-portfolio',
			'source'   => WILLOW_PLUGINS_DIR . 'vafpress-portfolio.zip',
			'required' => true,
		),
		array(
			'name'     => 'Contact Form 7',
			'slug'     => 'contact-form-7',
			'required' => false,
		),
	);

	$config = array(
		'domain'		   => 'willow',
		'parent_menu_slug' => 'plugins.php',
		'parent_url_slug'  => 'plugins.php',
		'strings'		   => array(
			'menu_title'   => __( 'Required Plugins', 'qualia_td' ),
		),
	);

	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'willow_tgmpa' );

/**
 * Abstract Function to Call Aqua Resizer
 */
function willow_aq_resize( $attachment_id, $width = null, $height = null, $crop = true, $single = true ) {

	if ( is_null( $attachment_id ) ) return null;

	$image = wp_get_attachment_image_src( $attachment_id, 'full' );

	$return = aq_resize( $image[0], $width, $height, $crop, $single );

	if ( $return ) {
		return $return;
	}
	else {
		return $image[0];
	}
}

/**
 * Abstract Function to build Background Repeat inline style
 */
function willow_build_background_repeat_style( $background_repeat ) {
	$background_repeat_style = '';

	switch ( $background_repeat ) {
		case 'cover':
			$background_repeat_style .= 'background-size: cover; background-repeat: no-repeat;';
			break;
		case 'contain':
			$background_repeat_style .= 'background-size: contain; background-repeat: no-repeat;';
			break;
		case 'no-repeat':
			$background_repeat_style .= 'background-repeat: no-repeat;';
			break;
	}
	return $background_repeat_style;
}

/**
 * Enqueue styles and scripts
 */
function willow_action_enqueue_scripts() {
	$theme_data = wp_get_theme();

	/**
	 * CSS
	 */

	// GoogleFonts
	
	$font_weights = array( 100, 200, 300, 400, 500, 600, 700, 800, 900 );
	$font_styles  = array( 'normal', 'italic' );

	global $willow_data;
	foreach ( $willow_data['typography_types'] as $type => $label ) {
		if ( ! in_array( willow_option( $type . '_font_face' ), willow_get_regular_font_faces() ) ) {
			VP_Site_GoogleWebFont::instance()->add( willow_option( $type . '_font_face' ), $font_weights, $font_styles );
		}
	}
	VP_Site_GoogleWebFont::instance()->register();
	foreach ( VP_Site_GoogleWebFont::instance()->get_names() as $name ) {
		wp_enqueue_style( $name );
	}

	// Other CSS
	wp_register_style( 'willow-bootstrap', WILLOW_CSS . 'bootstrap.willow.min.css', array(), '3.1.1' );
	wp_register_style( 'fontawesome', WILLOW_CSS . 'font-awesome.min.css', array(), '4.0.3' );
	wp_register_style( 'linecons', WILLOW_CSS . 'linecons.css', array(), '1.0.0' );
	wp_register_style( 'animate', WILLOW_CSS . 'animate.css', array(), '3.1.0-dev' );
	wp_register_style( 'mediaelement', WILLOW_CSS . 'mediaelementplayer.min.css', array(), '2.14.2' );
	wp_register_style( 'willow-jquery-magnific-popup', WILLOW_CSS . 'magnific-popup.willow.css', array(), '0.9.9' );
	wp_register_style( 'willow-style', WILLOW_CSS . 'style.css', array(
		'willow-bootstrap',
		'fontawesome',
		'linecons',
		'animate',
		'mediaelement',
		'willow-jquery-magnific-popup',
	), $theme_data->get( 'Version' ) );
	wp_enqueue_style( 'willow-style' );

	// Dynamic sStyle
	ob_start(); include( WILLOW_CSS_DIR . '/style-dynamic.php' ); $dynamic_style = ob_get_clean();
	wp_add_inline_style( 'willow-style', $dynamic_style );
	wp_add_inline_style( 'willow-style', willow_option( 'custom_css' ) );

	// Theme stylesheet
	wp_enqueue_style( 'style', get_stylesheet_uri() ); // WP default stylesheet


	/**
	 * JS
	 */

	// Less than IE9 polyfills
	global $wp_scripts;
	wp_register_script( 'html5shiv', WILLOW_JS . 'html5shiv.js', array(), '3.7.0' );
	$wp_scripts->add_data( 'html5shiv', 'conditional', 'lt IE 9' );
	wp_enqueue_script( 'html5shiv' );

	wp_register_script( 'respond', WILLOW_JS . 'respond.min.js', array(), '1.4.2' );
	$wp_scripts->add_data( 'respond', 'conditional', 'lt IE 9' );
	wp_enqueue_script( 'respond' );

	wp_register_script( 'bootstrap', WILLOW_JS . 'bootstrap.min.js', array( 'jquery' ), '3.1.1' );
	wp_register_script( 'smoothscroll', WILLOW_JS . 'smoothscroll.min.js', array( 'jquery' ), '1.2.1' );
	wp_register_script( 'jquery-sharrre', WILLOW_JS . 'jquery.sharrre.min.js', array( 'jquery' ), '1.3.5' );
	wp_register_script( 'jquery-touchswipe', WILLOW_JS . 'jquery.touchswipe.min.js', array( 'jquery' ), '1.3.3' );
	wp_register_script( 'jquery-caroufredsel', WILLOW_JS . 'jquery.caroufredsel-packed.js', array( 'jquery', 'imagesloaded', 'jquery-touchswipe' ), '6.2.1' );
	wp_register_script( 'jquery-waypoints', WILLOW_JS . 'waypoints.min.js', array(), '2.0.4' );
	wp_register_script( 'jquery-magnific-popup', WILLOW_JS . 'jquery.magnific-popup.min.js', array( 'jquery' ), '0.9.9' );
	wp_register_script( 'jquery-parallax', WILLOW_JS . 'jquery.parallax.min.js', array( 'jquery' ), '1.1.3' );
	wp_register_script( 'jquery-jpreloader', WILLOW_JS . 'jpreloader.min.js', array( 'jquery' ), '2.1' );
	wp_register_script( 'jquery-hoverintent', WILLOW_JS . 'hoverintent.js', array( 'jquery' ), '1.7.4' );
	wp_register_script( 'jquery-superfish', WILLOW_JS . 'superfish.js', array( 'jquery', 'jquery-hoverintent' ), '1.7.4' );
	wp_register_script( 'jquery-fittext', WILLOW_JS . 'jquery.fittext.js', array( 'jquery' ), '1.2' );
	wp_register_script( 'gmap-api', 'http://maps.google.com/maps/api/js?sensor=false' );
	wp_register_script( 'jquery-gmap3', WILLOW_JS . 'gmap3.min.js', array( 'jquery', 'gmap-api' ), '6.0.0' );
	wp_register_script( 'imagesloaded', WILLOW_JS . 'imagesloaded.pkgd.min.js', array(), '3.1.4' );
	if( !wp_script_is( 'isotope', 'registered' ) ) {
		wp_deregister_script( 'isotope' );
		wp_register_script( 'isotope', WILLOW_JS . 'isotope.pkgd.min.js', array( 'imagesloaded' ), '2.0.0' );
	} else {
		willow_append_dependency( 'isotope', 'imagesloaded' );
	}
		
	wp_register_script( 'mediaelement', WILLOW_JS . 'mediaelement-and-player.min.js', array( 'jquery' ), '2.14.2' );
	wp_register_script( 'countup', WILLOW_JS . 'countup.min.js', array(), '1.1.0' );
	wp_register_script( 'willow-modernizr', WILLOW_JS . 'modernizr.willow.min.js', array(), '2.8.1' );
	wp_register_script( 'willow-script', WILLOW_JS . 'script.js', array(
		// 'willow-modernizr',
		'jquery',
		'jquery-waypoints',
		'jquery-superfish',
		'bootstrap',
		'smoothscroll',
		'mediaelement',
		'jquery-fittext',
	), $theme_data->get( 'Version' ) );
	wp_enqueue_script( 'willow-script' );

	if ( willow_option( 'enable_preloader', 1 ) ) {
		wp_enqueue_script( 'jquery-jpreloader' );
	}

	$willow_data['localize']['gmap_style_json'] = trim( willow_option( 'gmap_style_json', '' ) );
	$willow_data['localize']['is_mobile_or_tablet'] = Mobile_Detect::is_mobile_or_tablet() ? 'true' : 'false';
	wp_localize_script( 'willow-script', 'willow', $willow_data['localize'] );
}
add_action( 'wp_enqueue_scripts', 'willow_action_enqueue_scripts' );

/**
 * Change WP Title format for better SEO
 */
function willow_filter_wp_title( $title ) {
	global $page, $paged;

	if ( is_feed() ) return $title;

	$site_description = get_bloginfo( 'description' );

	$filtered_title = $title . get_bloginfo( 'name' );
	$filtered_title .= ( ! empty( $site_description ) && ( is_home() || is_front_page() ) ) ? ' | ' . $site_description: '';
	$filtered_title .= ( 2 <= $paged || 2 <= $page ) ? ' | ' . sprintf( __( 'Page %s', 'willow' ), max( $paged, $page ) ) : '';

	return $filtered_title;
}
add_filter( 'wp_title', 'willow_filter_wp_title' );

/**
 * Register navigation location
 */
function willow_action_register_menus() {
	register_nav_menus( array(
		'header-navigation' => __( 'Header Navigation', 'willow' ),
	) );
}
add_action( 'init', 'willow_action_register_menus' );

/**
 * Register sidebars
 */
function willow_register_sidebars() {
	register_sidebar( array(
		'name'          => __( 'Content Sidebar', 'willow' ),
		'id'            => 'content-sidebar',
		'description'   => '',
		'class'         => '',
		'before_widget' => '<div id="%1s" class="widget %2s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>'
	) );

	$cols = willow_option( 'footer_number_of_columns' );
	
	for ( $i = 1; $i <= $cols; $i++ ) {
		register_sidebar( array(
			'name'          => sprintf( __( 'Footer Column %s', 'willow' ), $i ),
			'id'            => sprintf( 'footer-sidebar-%s', $i ),
			'description'   => '',
			'class'         => '',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
	}
}
add_action( 'widgets_init', 'willow_register_sidebars' );

/**
 * Widget Text do_shortcode
 */
add_filter( 'widget_text', 'do_shortcode' );

/**
 * Add theme supports
 */
function willow_action_add_theme_supports() {
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
}
add_action( 'after_setup_theme', 'willow_action_add_theme_supports' );

/**
 * Add Twitter Contact Info
 */
function willow_add_user_contactmethods( $contactmethods ) {
	$contactmethods['facebook'] = __( 'Facebook Username', 'willow' );
	$contactmethods['twitter'] = __( 'Twitter Username (without @)', 'willow' );
	$contactmethods['googleplus'] = __( 'Google Plus ID', 'willow' );
	return $contactmethods;
}
add_filter( 'user_contactmethods', 'willow_add_user_contactmethods' );

/**
 * Change Widget Search
 */
function willow_change_search_widget( $html ) {
	ob_start(); ?>
	<form role="search" method="get" action="<?php echo esc_url( home_url() ); ?>" class="search-form">
		<input type="text" value="<?php echo get_search_query(); ?>" name="s" placeholder="<?php _e( 'Search on this site', 'willow' ); ?>" class="form-control" />
		<span class="icon fa fa-search"></span>
		<button class="btn invisible" style="position: absolute;" type="submit"><?php _e( 'Search', 'willow' ); ?></button>
	</form>
	<?php return ob_get_clean();
}
add_filter( 'get_search_form', 'willow_change_search_widget' );

/**
 * Add all dropdown widget class with "form-control"
 */
function willow_widget_categories_dropdown_args( $args ) {
	if ( array_key_exists( 'class', $args ) ) {
		$args['class'] .= ' form-control';
	} else {
		$args['class'] = 'form-control';
	}
	return $args;
}
add_filter( 'widget_categories_dropdown_args', 'willow_widget_categories_dropdown_args' );

/**
 * Callback comment item html
 */
function willow_wp_list_comments_callback( $comment, $args, $depth ) {
	include( locate_template( 'comment.php' ) );
}

/**
 * Create another Respond Submit button
 */
function willow_comment_respond_button() {
	?>
	<button class="btn btn-primary" type="submit"><?php _e( 'Post Comment', 'willow' ); ?></button>
	<?php
}
add_action( 'comment_form', 'willow_comment_respond_button' );

/**
 * Hero Slides
 */
function willow_register_post_type_hero_slide() {
	$labels = array(
		'name'               => _x( 'Hero Slides', 'post type general name', 'willow' ),
		'singular_name'      => _x( 'Hero Slide', 'post type singular name', 'willow' ),
		'menu_name'          => _x( 'Hero Slides', 'admin menu', 'willow' ),
		'name_admin_bar'     => _x( 'Hero Slide', 'add new on admin bar', 'willow' ),
		'add_new'            => _x( 'Add New', 'hero slide', 'willow' ),
		'add_new_item'       => __( 'Add New Hero Slide', 'willow' ),
		'new_item'           => __( 'New Hero Slide', 'willow' ),
		'edit_item'          => __( 'Edit Hero Slide', 'willow' ),
		'view_item'          => __( 'View Hero Slide', 'willow' ),
		'all_items'          => __( 'All Hero Slides', 'willow' ),
		'search_items'       => __( 'Search Hero Slides', 'willow' ),
		'parent_item_colon'  => __( 'Parent Hero Slides:', 'willow' ),
		'not_found'          => __( 'No hero slides found.', 'willow' ),
		'not_found_in_trash' => __( 'No hero slides found in Trash.', 'willow' ),
	);

	$args = array(
		'labels'              => $labels,
		'description'         => __( 'Slides used in Page\'s Hero section. Goto Page Editor and assign some hero slides to your hero section.' , 'willow' ),
		'public'              => true,
		'exclude_from_search' => true,
		'publicly_queryable'  => false,
		'show_in_nav_menus'   => false,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'capability_type'     => 'page',
		'hierarchical'        => false,
		'supports'            => array( 'title' ),
		'query_var'           => true,
		'can_export'          => true,
	);

	register_post_type( 'willow-hero-slide', $args );
}
add_action( 'init', 'willow_register_post_type_hero_slide' );

/**
 * Excerpt ellipsis
 */
function willow_excerpt_more( $excerpt ) {
	return '&hellip;';
}
add_filter( 'excerpt_more', 'willow_excerpt_more' );

/**
 * Willow Remove Vafpress Portfolio Shortcodes Generator
 */
function willow_vp_pf_remove_sc_generator( $params ) {
	return null;
}
add_filter( 'vp_pf_shortcode_generator_params', 'willow_vp_pf_remove_sc_generator', 1 );

/**
 * Willow Helper Functions
 */
function willow_data_printer( $datas ) {
	$data_str = '';
	foreach ( $datas as $key => $value ) {
		if ( ! empty( $value ) ) {
			$data_str .= " data-{$key}=\"{$value}\"";
		}
	}
	return $data_str;
}
function willow_extract_css( $css ) {

    $results = array();

    preg_match_all( '/(.+?)\s?\{\s?(.+?)\s?\}/', $css, $matches );
    foreach($matches[0] as $i=>$original)
        foreach( explode( ';', $matches[2][$i] ) as $attr )
            if ( strlen( trim( $attr ) ) > 0 ) {
            	// for missing semicolon on last element, which is legal
                list($name, $value) = explode(':', $attr);
                $results[$matches[1][$i]][trim($name)] = trim($value);
            }
    return $results;
}
// credit to http://frankiejarrett.com/get-an-attachment-id-by-url-in-wordpress/
function willow_get_attachment_id_by_url( $url ) {

	// Split the $url into two parts with the wp-content directory as the separator.
	$parse_url  = explode( parse_url( WP_CONTENT_URL, PHP_URL_PATH ), $url );

	// Get the host of the current site and the host of the $url, ignoring www.
	$this_host = str_ireplace( 'www.', '', parse_url( home_url(), PHP_URL_HOST ) );
	$file_host = str_ireplace( 'www.', '', parse_url( $url, PHP_URL_HOST ) );

	// Return nothing if there aren't any $url parts or if the current host and $url host do not match.
	if ( ! isset( $parse_url[1] ) || empty( $parse_url[1] ) || ( $this_host != $file_host ) ) {
		return;
	}

	// Now we're going to quickly search the DB for any attachment GUID with a partial path match.
	// Example: /uploads/2013/05/test-image.jpg
	global $wpdb;

	$attachment = $wpdb->get_col( $wpdb->prepare( "SELECT ID FROM {$wpdb->prefix}posts WHERE guid RLIKE %s;", $parse_url[1] ) );

	// Returns null if no attachment is found.
	return $attachment[0];
}

/**
 * Get current post / page thumbnail for sharing purpose (pinterest must use image)
 */
function willow_get_share_thumbnail( $post_id = null ) {
	return wp_get_attachment_url( get_post_thumbnail_id( $post_id ) );
}

/**
 * Append dependency to registered script
 */
function willow_append_dependency( $handle, $dep ){
    global $wp_scripts;

    $script = $wp_scripts->query( $handle, 'registered' );
    if( !$script )
        return false;

    if( !in_array( $dep, $script->deps ) ){
        $script->deps[] = $dep;
    }

    return true;
}

/**
 * KSES
 */
function willow_kses( $html ) {
	$allow = array_merge( wp_kses_allowed_html( 'post' ), array(
		'link' => array(
			'href'    => true,
			'rel'     => true,
			'type'    => true,
		),
		'script' => array(
			'src' => true,
			'charset' => true,
			'type'    => true,
		)
	) );
	return wp_kses( $html, $allow );
}

/**
 * Meta Content Filter
 */
add_filter('meta_content', 'wptexturize');
add_filter('meta_content', 'convert_smilies');
add_filter('meta_content', 'convert_chars');
add_filter('meta_content', 'wpautop');
add_filter('meta_content', 'shortcode_unautop');
add_filter('meta_content', 'prepend_attachment');
add_filter('meta_content', 'do_shortcode', 11);

/**
 * Plugin Compatibility
 */

// WordPress SEO Yoast
if ( defined('WPSEO_VERSION') ) {
	add_filter( 'wpseo_pre_analysis_post_content', 'willow_portfolio_seo_content' );
	function willow_portfolio_seo_content( $content ) {
		global $post;
		if( get_post_type( $post->ID ) === 'portfolio' ) {
			$metas = '';
			foreach ( vp_metabox( '_vp_portfolio_info.info' ) as $info ) {
				$metas .= ' ' . apply_filters( 'meta_content', $info['content'] );
			}
			return $content . ' ' . $metas;
		}
		return $content;
	}
}