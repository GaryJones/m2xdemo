<?php
/**
 * ======================================================================================
 * Includes
 * ======================================================================================
 */

/**
 * Include Vafpress Framework
 */
require_once 'vafpress-framework/bootstrap.php';
require_once 'admin/data-sources.php';

/**
 * Abstract Function to access theme_options values
 */
if ( ! function_exists( 'willow_option' ) ) {

	function willow_option( $key, $default = null ) {
		return vp_option( WILLOW_OPTION_KEY . '.' . $key, $default );
	}

}
/**
 * Abstract Function to access page_options metabox values
 */
if ( ! function_exists( 'willow_page_option' ) ) {

	function willow_page_option( $key, $default = null, $post_id = null ) {
		return vp_metabox( '_page_options' . '.' . $key, $default, $post_id );
	}

}
/**
 * Abstract Function to access post_options metabox values
 */
if ( ! function_exists( 'willow_post_option' ) ) {

	function willow_post_option( $key, $default = null, $post_id = null ) {
		return vp_metabox( '_post_options' . '.' . $key, $default, $post_id );
	}

}
/**
 * Abstract Function to access portfolio_options metabox values
 */
if ( ! function_exists( 'willow_portfolio_option' ) ) {

	function willow_portfolio_option( $key, $default = null, $post_id = null ) {
		return vp_metabox( '_portfolio_options' . '.' . $key, $default, $post_id );
	}

}
/**
 * Abstract Function to access hero_slide_options metabox values
 */
if ( ! function_exists( 'willow_hero_slide_option' ) ) {

	function willow_hero_slide_option( $key, $default = null, $post_id = null ) {
		return vp_metabox( '_hero_slide_options' . '.' . $key, $default, $post_id );
	}

}

/**
 * Initialize Theme Options
 */
$willow_theme_option_scheme = WILLOW_ADMIN_DIR . 'option/option.php';
global $willow_theme_options;
$willow_theme_options = new VP_Option( array(
	'is_dev_mode'           => false,
	'option_key'            => WILLOW_OPTION_KEY,
	'page_slug'             => WILLOW_OPTION_KEY,
	'template'              => $willow_theme_option_scheme,
	'menu_page'             => 'themes.php',
	'use_auto_group_naming' => true,
	'use_exim_menu'         => true,
	'minimum_role'          => 'edit_theme_options',
	'layout'                => 'fixed',
	'page_title'            => __( 'Theme Options', 'willow' ),
	'menu_label'            => __( 'Theme Options', 'willow' ),
) );

/**
 * Initialize Metaboxes
 */
$willow_metabox_schemes = array_merge(
	array(
		WILLOW_ADMIN_DIR . 'metabox/metabox_page_options.php',
		WILLOW_ADMIN_DIR . 'metabox/metabox_hero_slide_options.php',
		WILLOW_ADMIN_DIR . 'metabox/metabox_post_options.php',
	),
	class_exists( 'VP_Portfolio' ) ? array( WILLOW_ADMIN_DIR . 'metabox/metabox_portfolio_options.php' ) : array()
);
foreach ( $willow_metabox_schemes as $willow_metabox_scheme ) {
	new VP_Metabox( $willow_metabox_scheme );
}

/**
 * Custom CSS for Theme Options
 */
function willow_theme_options_custom_styles() {
	?>
	<style type="text/css">
		#pages_with_title_section .field label {
			display: block;
		}
	</style>
	<?php
}
add_action( 'admin_print_styles-appearance_page_willow_option', 'willow_theme_options_custom_styles' );