<?php
/**
 * VP_PF_Install class.
 *
 * @class           VP_PF_Install
 * @since           0.1
 * @category        Class
 * @author          Vafpress
 */

if( ! defined( 'ABSPATH' ) ) exit; // exit on direct access

if( ! class_exists( 'VP_PF_Install' ) ) :

class VP_PF_Install {

	public function __construct() {
		register_activation_hook( VP_PF_FILE, array( $this, 'install' ) );
		add_action( 'admin_init', array( $this, 'process_actions' ) );
		add_action( 'admin_init', array( $this, 'check_version' ) );
		add_action( 'admin_print_styles', array( $this, 'notices' ) );
	}

	public function install() {
		// current profile
		$current_version    = get_option( 'vp_pf_version', null );
		$current_db_version = get_option( 'vp_pf_db_version', null );

		// check version
		if( $current_db_version !== null && version_compare( $current_db_version, VP_PF()->version, '<') ) {
			// enable update button
			update_option( '_vp_pf_needs_update', 1 );
		} else {
			// update the db version
			update_option( 'vp_pf_db_version', VP_PF()->version );
		}

		// update version
		update_option( '_vp_pf_version', VP_PF()->version );
	}

	public function update() {
		// get previously installed plugin
		$current_db_version = get_option( 'vp_pf_db_version', null );

		// if it's lower than 0.2 then run 0.2 update
		if( version_compare( $current_db_version, '0.2', '<') ) {
			// run the update
			include( 'updates/vp-portfolio-update-0.2.php' );
			// update the current db version
			update_option( 'vp_pf_db_version', 0.2 );
		}
		update_option( 'vp_pf_db_version', VP_PF()->version );
	}

	public function notices() {
		if( get_option( '_vp_pf_needs_update' ) == 1 ) {
			add_action( 'admin_notices', array( $this, 'update_notice' ) );
		}
	}

	public function update_notice() {
		$msg = sprintf( __('<em>%s</em> database needs to be updated, please run update.', 'vp_portfolio' ), 'Vafpress Portfolio' );
		?>
		<div class="updated">
			<p>
				<strong><?php echo $msg; ?></strong>
			</p>
			<p>
				<strong><a href="<?php echo add_query_arg( array('do_update_vp_pf' => '1') ); ?>" class="vp_pf-update-now button-primary"><?php _e( 'Update', 'vp_portfolio' ); ?></a></strong>
			</p>
		</div>
		<script type="text/javascript">
			jQuery('.vp_pf-update-now').click('click', function(){
				var answer = confirm( '<?php _e( 'It is strongly recommended that you backup your database before proceeding. Are you sure you wish to run the updater now?', 'vp_portfolio' ); ?>' );
				return answer;
			});
		</script>
		<?php
	}

	public function check_version() {
		if ( ! defined( 'IFRAME_REQUEST' ) && ( get_option( 'vp_pf_version' ) != VP_PF()->version || get_option( 'vp_pf_db_version' ) != VP_PF()->version ) ) {
			$this->install();
		}
	}

	public function process_actions() {
		if( ! empty( $_GET['do_update_vp_pf'] ) ) {
			$this->update();
			delete_option( '_vp_pf_needs_update' );
		}
	}

}

endif;

return new VP_PF_Install();

/**
 * EOF
 */