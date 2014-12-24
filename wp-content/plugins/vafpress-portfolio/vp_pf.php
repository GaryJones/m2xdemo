<?php
/**
 * Plugin Name: Vafpress Portfolio
 * Plugin URI: http://vafpress.com
 * Description: Portfolio Post Type Management.
 * Version: 0.3
 * Author: Vafpress
 * Author URI: http://vafpress.com
 * Requires at least: 3.5
 * Tested up to: 3.8
 *
 * Text Domain: vp_portfolio
 * Domain Path: lang
 */

if( ! defined( 'ABSPATH' ) ) exit; // exit on direct access

if( ! class_exists( 'VP_Portfolio' ) ) :

final class VP_Portfolio {

	/**
	 * @var string
	 */
	public $version = '0.3';

	/**
	 * @var   VP_Portfolio Singleton instance
	 * @since 0.2
	 */
	protected static $_instance = null;

	public static function instance()
	{
		if(is_null(self::$_instance)) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public function __construct() {
		// Define constants
		$this->_define_constants();

		// Includes
		$this->_includes();

		do_action( 'vp_pf_loaded' );
	}

	private function _define_constants() {
		defined( 'VP_PF_VERSION' )      or define( 'VP_PF_VERSION'     , $this->version );
		defined( 'VP_PF_URL' )          or define( 'VP_PF_URL'         , plugin_dir_url( __FILE__ ) );
		defined( 'VP_PF_DIR' )          or define( 'VP_PF_DIR'         , plugin_dir_path( __FILE__ ) );
		defined( 'VP_PF_FILE' )         or define( 'VP_PF_FILE'        , __FILE__ );
		defined( 'VP_PF_MB_INFO_ID' )   or define( 'VP_PF_MB_INFO_ID'  , '_vp_portfolio_info' );
		defined( 'VP_PF_MB_MEDIAS_ID' ) or define( 'VP_PF_MB_MEDIAS_ID', '_vp_portfolio_medias' );
		defined( 'VP_PF_OPTION_KEY' )   or define( 'VP_PF_OPTION_KEY'  , 'vp_pf_option' );
	}

	private function _includes() {
		// Include core files
		$this->_core_includes();

		// Includes admin files
		$this->_admin_includes();
		// Includes front end files
		if( ! is_admin() || defined( 'DOING_AJAX' ) ) {
			$this->_frontend_includes();
		}

	}

	private function _core_includes() {
		include_once VP_PF_DIR . '/includes/helpers.php';
		include_once VP_PF_DIR . '/includes/install.php';
		include_once VP_PF_DIR . '/includes/tgm-init.php';
		include_once VP_PF_DIR . '/includes/portfolio.php';
	}

	private function _admin_includes() {
		include_once VP_PF_DIR . '/includes/admin/admin.php';
	}

	private function _frontend_includes() {
		include_once VP_PF_DIR . 'includes/shortcodes.php';
	}

}

endif;

if( ! function_exists( 'VP_PF' ) ) {
	function VP_PF() {
		return VP_Portfolio::instance();
	}
}

VP_PF();

/**
 * EOF
 */