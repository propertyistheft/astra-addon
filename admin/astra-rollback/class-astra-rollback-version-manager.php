<?php
/**
 * Theme Rollback Version manager class file.
 *
 * @package astra-addon
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Astra Rollback Version manager.
 */
class Astra_Rollback_Version_Manager {

	/**
	 * This is set for lage reload cache.
	 *
	 * @var $reload_page_cache
	 */
	public static $reload_page_cache = 1;

	/**
	 * This is set for theme white lable name.
	 *
	 * @var $theme_name
	 */
	public $theme_name;

	/**
	 * Constructor function that initializes required sections.
	 */
	public function __construct() {
		$this->theme_name = Astra_Rollback_version::astra_get_white_lable_name();

		add_action( 'admin_notices', array( $this, 'download_rollback_version' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'load_scripts' ) );
	}

	/**
	 * Display Theme Rollback to privious versions form.
	 *
	 * @since 3.6.1
	 */
	public function render_rollback_version_form() {
		add_action( 'admin_footer', array( $this, 'rollback_version_popup' ) );

		// Enqueue scripts only when this function is called.
		wp_enqueue_script( 'astra-version-rollback' );
		wp_enqueue_style( 'astra-version-rollback-css' );

		$theme_versions = Astra_Rollback_version::get_theme_all_versions();
		if ( empty( $theme_versions ) ) {
			echo esc_html__( 'No Versions Found! ', 'astra-addon' );
			return;
		}

		?>
		<select class="ast-rollback-version-select">
		<?php
		foreach ( $theme_versions as $version ) {
			?>
				<option value="<?php echo esc_attr( $version ); ?>"><?php echo esc_html( $version ); ?> </option>
			<?php
		}
		?>
		</select>
			<a data-placeholder-text=" <?php echo esc_html__( 'Rollback', 'astra-addon' ); ?>" href="<?php echo esc_url( add_query_arg( 'version_no', $theme_versions[0], wp_nonce_url( admin_url( 'index.php?action=astra-rollback' ), 'astra_rollback' ) ) ); ?>"
			data-placeholder-url="<?php echo esc_url( wp_nonce_url( admin_url( 'index.php?action=astra-rollback&version_no=VERSION' ), 'astra_rollback' ) ); ?>" class="button ast-rollback-button"><?php echo esc_html__( 'Rollback', 'astra-addon' ); ?> </a>
		</select>
		<?php
	}

	/**
	 * Download Astra Theme Version here.
	 */
	public function download_rollback_version() {

		if ( ! current_user_can( 'update_themes' ) ) {
			return false;
		}
		if ( empty( $_GET['version_no'] ) || empty( $_GET['action'] ) || 'astra-rollback' !== $_GET['action'] ) {
			return false;
		}
		check_admin_referer( 'astra_rollback' );

		$version_no = sanitize_text_field( $_GET['version_no'] );
		$theme_slug = 'astra';
		$theme_name = 'Astra';
		$rollback   = new Astra_Rollback_Version(
			array(
				'version'    => $version_no,
				'theme_name' => $theme_name,
				'theme_slug' => $theme_slug,
			)
		);
		$rollback->run();
		wp_die();

	}

	/**
	 * Version rollback Confirmation popup.
	 *
	 * @since 3.6.1
	 */
	public function rollback_version_popup() {
		// This is set to fix the duplicate markup on page load.
		if ( 1 !== self::$reload_page_cache ) {
			return;

		}

		self::$reload_page_cache = 0;

		?>
		<div class="ast-confirm-rollback-popup" style="display:none;">
			<div class="bsf-core-rollback-overlay"></div>
			<div class="bsf-confirm-rollback-popup-content">
				<h3 class="bsf-rollback-heading"><?php /* translators: %s: whitelable name */ echo esc_html( sprintf( __( 'Rollback %s Version', 'astra-addon' ), $this->theme_name ) ); ?></h3>
				<p class="ast-confirm-text" data-text="<?php /* translators: %s: whitelable name */ echo esc_html( sprintf( __( 'Are you sure you want to rollback %s to version #VERSION#?', 'astra-addon' ), $this->theme_name ) ); ?>" ></p>
				<div class="bsf-confirm-rollback-popup-buttons-wrapper">
					<button class="button bsf-product-license button-default ast-confirm-cancel"><?php esc_html_e( 'Cancel', 'astra-addon' ); ?></button>
					<button class="button button-primary ast-confirm-ok"><?php esc_html_e( 'Continue', 'astra-addon' ); ?></button>
				</div>
			</div>
		</div>
		<?php
	}

	/**
	 * Load Scripts
	 *
	 * @since 3.6.1
	 *
	 * @param  string $hook Current Hook.
	 * @return void
	 */
	public function load_scripts( $hook = '' ) {
		wp_register_script( 'astra-version-rollback', ASTRA_EXT_URI . 'admin/astra-rollback/assets/js/astra-rollback.js', array( 'jquery' ), ASTRA_EXT_VER, true );
		wp_register_style( 'astra-version-rollback-css', ASTRA_EXT_URI . 'admin/astra-rollback/assets/css/astra-rollback.css', array(), ASTRA_EXT_VER );
	}

}

new Astra_Rollback_Version_Manager();

/**
 * Render Rollback versoin form.
 */
function render_theme_rollback_form() {
	$instance = new Astra_Rollback_Version_Manager();
	$instance->render_rollback_version_form();
}
