<?php
/**
 * VP_PF_Admin class.
 *
 * @class           VP_PF_Admin
 * @since           0.1
 * @category        Class
 * @author          Vafpress
 */

if( ! defined( 'ABSPATH' ) ) exit; // exit on direct access

if( ! class_exists( 'VP_PF_Admin' ) ) :

class VP_PF_Admin {

	public function __construct() {
		// Define constants
		$this->_define_constants();

		// Includes
		$this->_includes();

		// Init actions
		add_action( 'after_setup_theme', array( $this, 'init' ) );
	}

	private function _define_constants() {
		define( 'VP_PF_ADMIN_DIR' , VP_PF_DIR . 'includes/admin' );
		define( 'VP_PF_ADMIN_URI' , VP_PF_URL . 'includes/admin' );
	}

	private function _includes() {
		include_once VP_PF_ADMIN_DIR . '/data-sources.php';
	}

	public function init() {
		if( !class_exists( 'VP_Option' ) ) return;

		// Vafpress Framework Extension
		$this->extension();

		// Init Options Panel
		$this->init_options();

		// Init Metaboxes
		$this->init_metaboxes();

		// Init Shortcode Generators
		$this->init_shortcode_generators();

		// Datasource Whitelisting
		$this->whitelist_functions();
	}

	public function extension() {
		// Register Views Directory
		$vpfs = VP_FileSystem::instance();
		$vpfs->add_directories('views', VP_PF_ADMIN_DIR . '/views');

		// Register Classes to Vafpress Framework's Autoloader
		VP_AutoLoader::add_directories(VP_PF_ADMIN_DIR . '/classes', 'VP_');

		// Filter Vafpress Framework Dependencies		
		add_filter( 'vp_dependencies_array'             , array( $this, 'extension_dependencies' ), null, 1 );
		add_action( 'wp_ajax_vp_pf_process_portfolio'   , array( $this, 'ajax_process_portfolio' ) );
		add_action( 'vp_after_dependencies_loader_build', array( $this, 'extension_localize_script' ) );
	}

	public function extension_localize_script() {
		wp_localize_script( 'vp_pf_js', 'vp_pf', array(
			'ids' => VP_PF_Portfolio::instance()->get_all_ids()
		) );
	}

	public function extension_dependencies( $dependencies ) {
		$dependencies['scripts']['paths']['jquery-ui-progressbar'] = array(
			'path'     => VP_PF_ADMIN_URI . '/public/jquery.ui.progressbar.min.js',
			'deps'     => array('jquery', 'jquery-ui-core', 'jquery-ui-widget', 'jquery-ui-mouse'),
			'ver'      => '1.9.2',
		);
		$dependencies['scripts']['paths']['vp_pf_js'] = array(
			'path'     => VP_PF_ADMIN_URI . '/public/admin.js',
			'deps'     => array('jquery-ui-progressbar'),
			'ver'      => '1',
			'override' => false,
		);
		$dependencies['rules']['portfoliogenerate'] = array(
			'js'  => array( 'vp_pf_js' ),
			'css' => array( 'jqui' ),
		);
		return $dependencies;
	}

	public function init_options() {
		$options_scheme = include(VP_PF_ADMIN_DIR . '/scheme-options.php');
		$options_scheme = apply_filters( 'vp_pf_options_array' , $options_scheme );
		$options        = new VP_Option(array(
			'is_dev_mode'           => false,
			'option_key'            => VP_PF_OPTION_KEY,
			'page_slug'             => 'vp_pf_option',
			'template'              => $options_scheme,
			'menu_page'             => 'edit.php?post_type=portfolio',
			'use_auto_group_naming' => true,
			'use_exim_menu'         => true,
			'minimum_role'          => 'edit_theme_options',
			'layout'                => 'fixed',
			'page_title'            => __( 'Vafpress Portfolio', 'vp_portfolio' ),
			'menu_label'            => __( 'Settings', 'vp_portfolio' ),
		));
	}

	public function init_metaboxes() {
		new VP_Metabox(array(
			'id'          => VP_PF_MB_INFO_ID,
			'types'       => array('portfolio'),
			'title'       => __('Portfolio Data', 'vp_portfolio'),
			'priority'    => 'high',
			'template'    => VP_PF_ADMIN_DIR . '/scheme-metabox-info.php'
		));

		new VP_Metabox(array(
			'id'          => VP_PF_MB_MEDIAS_ID,
			'types'       => array('portfolio'),
			'title'       => __('Portfolio Medias', 'vp_portfolio'),
			'priority'    => 'high',
			'template'    => VP_PF_ADMIN_DIR . '/scheme-metabox-medias.php'
		));
	}

	public function init_shortcode_generators() {
		$shortcode_generator_params = apply_filters( 'vp_pf_shortcode_generator_params', array(
			'name'           => 'vp_pf_shortcodegenerator',
			'template'       => VP_PF_ADMIN_DIR . '/scheme-shortcodegenerator.php',
			'modal_title'    => __( 'Vafpress Portfolio Shortcode', 'vp_portfolio'),
			'button_title'   => __( 'Vafpress Portfolio Shortcode', 'vp_portfolio'),
			'types'          => array( "*" ),
			'main_image'     => VP_PF_ADMIN_URI . '/public/vp_pf_sc_icon.png',
			'sprite_image'   => VP_PF_ADMIN_URI . '/public/vp_pf_sc_icon_sprite.png',
		) );
		if( !empty( $shortcode_generator_params ) )
			new VP_ShortcodeGenerator($shortcode_generator_params);
	}

	public function whitelist_functions() {
		VP_Security::instance()->whitelist_function('vp_pf_dep_portfolio_images_mode_image');
		VP_Security::instance()->whitelist_function('vp_pf_dep_portfolio_images_mode_video');
		VP_Security::instance()->whitelist_function('vp_pf_dep_portfolio_images_mode_video_external');
		VP_Security::instance()->whitelist_function('vp_pf_dep_portfolio_images_mode_video_internal');
	}

	public function ajax_process_portfolio() {
		$id = $_POST['id'];

		try {
			VP_PF_Portfolio::instance()->normalize($id);
			$result['data']    = $id;
			$result['status']  = true;
			$result['message'] = __("Success", 'vp_textdomain');
		} catch (Exception $e) {
			$result['data']    = '';
			$result['status']  = false;
			$result['message'] = $e->getMessage();
		}

		if (ob_get_length()) ob_clean();
		header('Content-type: application/json');
		echo json_encode($result);
		die();
	}

}

endif;

return new VP_PF_Admin();

/**
 * EOF
 */