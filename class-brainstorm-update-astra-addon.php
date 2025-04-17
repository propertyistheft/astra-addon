<?php
/**
 * Brainstorm_Update_Astra_Addon initial setup
 *
 * @package Astra
 * @since 1.0.0
 */

// Ignore the PHPCS warning about constant declaration.
// @codingStandardsIgnoreStart
define( 'BSF_REMOVE_astra-addon_FROM_REGISTRATION_LISTING', true );
// @codingStandardsIgnoreEnd

if ( ! class_exists( 'Brainstorm_Update_Astra_Addon' ) ) {

	/**
	 * Brainstorm Update
	 */
	// @codingStandardsIgnoreStart
	class Brainstorm_Update_Astra_Addon {
		// @codingStandardsIgnoreEnd
		/**
		 * Instance
		 *
		 * @var object Class object.
		 * @access private
		 */
		private static $instance;

		/**
		 * Initiator
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 * Constructor
		 */
		public function __construct() {

			self::version_check();
			add_action( 'init', array( $this, 'load' ), 98 );
			add_filter( 'bsf_display_product_activation_notice_astra', '__return_false' );
			add_filter( 'bsf_get_license_message_astra-addon', array( $this, 'license_message_astra_addon' ), 10, 2 );
			add_filter( 'bsf_is_product_bundled', array( $this, 'remove_astra_pro_bundled_products' ), 20, 3 );
			add_filter( 'bsf_skip_braisntorm_menu', array( $this, 'skip_menu' ) );
			add_filter( 'bsf_skip_author_registration', array( $this, 'skip_menu' ) );
			add_filter( 'bsf_registration_page_url_astra-addon', array( $this, 'get_registration_page_url' ) );
			add_filter( 'bsf_extract_product_id', array( $this, 'astra_theme_add_to_products_list' ), 20, 2 );
			add_filter( 'bsf_enable_product_autoupdates_astra', array( $this, 'enable_astra_beta_updates' ) );
			add_filter( 'bsf_allow_beta_updates_astra', array( $this, 'enable_beta_updates' ) );
			add_filter( 'bsf_allow_beta_updates_astra-addon', array( $this, 'enable_beta_updates' ) );
		}

		/**
		 * Add Astra Theme to brainstorm_products list.
		 *
		 * @since 1.5.1
		 * @param String $product_id Product id.
		 * @param String $path path where product is installed.
		 * @return String Product id.
		 */
		public function astra_theme_add_to_products_list( $product_id, $path ) {

			if ( realpath( get_theme_root() . '/astra' ) === $path ) {
				$product_id = 'astra';
			}

			return $product_id;
		}

		/**
		 * Remove bundled products for Astra Pro Sites.
		 * For Astra Pro Sites the bundled products are only used for one click plugin installation when importing the Astra Site.
		 * License Validation and product updates are managed separately for all the products.
		 *
		 * @since 3.6.4
		 *
		 * @param  array  $product_parent  Array of parent product ids.
		 * @param  String $bsf_product    Product ID or  Product init or Product name based on $search_by.
		 * @param  String $search_by      Reference to search by id | init | name of the product.
		 *
		 * @return array                 Array of parent product ids.
		 */
		public function remove_astra_pro_bundled_products( $product_parent, $bsf_product, $search_by ) {

			// Bundled plugins are installed when the demo is imported on Ajax request and bundled products should be unchanged in the ajax.
			if ( ! defined( 'DOING_AJAX' ) && ! defined( 'WP_CLI' ) ) {

				$key = array_search( 'astra-pro-sites', $product_parent, true );

				if ( false !== $key ) {
					unset( $product_parent[ $key ] );
				}
			}

			return $product_parent;
		}

		/**
		 * Enable autoupdates for Astra Theme if beta updates option is selected or currently installed theme/pro versions are beta or alpha.
		 *
		 * @since 1.5.1
		 * @param bool $status True if updates are tobe enabled. False if updates are to be disabled.
		 * @return bool True if updates are tobe enabled. False if updates are to be disabled.
		 */
		public function enable_astra_beta_updates( $status ) {
			if ( BSF_Update_Manager::bsf_allow_beta_updates( 'astra' ) || $this->is_using_beta() ) {
				$status = true;
			}

			return $status;
		}

		/**
		 * Check if Astra Theme or Astra Pro are using beta/alpha versions
		 *
		 * @since 1.6.0
		 * @return bool True if Astra Theme or Pro are using beta/alpha versions. False is both theme and pro are using stable versions.
		 */
		private function is_using_beta() {
			return strpos( ASTRA_EXT_VER, 'beta' ) ||
				strpos( ASTRA_EXT_VER, 'alpha' ) ||
				strpos( ASTRA_THEME_VERSION, 'beta' ) ||
				strpos( ASTRA_THEME_VERSION, 'alpha' );
		}

		/**
		 * Enable/Disable beta updates for Astra Theme and Astra Pro.
		 *
		 * @since 1.5.1
		 * @param bool $status True - If beta updates are enabled. False - If beta updates are disabled.
		 * @return bool
		 */
		public function enable_beta_updates( $status ) {
			$allow_beta = Astra_Admin_Helper::get_admin_settings_option( '_astra_beta_updates', true, 'disable' );

			if ( 'enable' === $allow_beta ) {
				$status = true;
			} elseif ( 'disable' === $allow_beta ) {
				$status = false;
			}

			return $status;
		}

		/**
		 * Get registration page url for astra addon.
		 *
		 * @since  1.0.0
		 * @return String URL of the licnense registration page.
		 */
		public function get_registration_page_url() {
			$url = admin_url( 'themes.php?page=astra' );

			if ( method_exists( 'Astra_Menu', 'get_theme_page_slug' ) ) {
				$url = admin_url( 'admin.php?page=' . Astra_Menu::get_theme_page_slug() . '&path=settings' );
			}

			return $url;
		}

		/**
		 * Skip Menu.
		 *
		 * @param array $products products.
		 * @return array $products updated products.
		 */
		public function skip_menu( $products ) {
			$products[] = 'astra-addon';

			return $products;
		}

		/**
		 * Update brainstorm product version and product path.
		 *
		 * @return void
		 */
		public static function version_check() {

			$bsf_core_version_file = realpath( ASTRA_EXT_DIR . '/admin/bsf-core/version.yml' );

			// Is file 'version.yml' exist?
			if ( is_file( $bsf_core_version_file ) ) {
				global $bsf_core_version, $bsf_core_path;
				$bsf_core_dir = realpath( dirname( __FILE__ ) . '/admin/bsf-core/' );
				$version      = file_get_contents( $bsf_core_version_file ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents

				// Compare versions.
				if ( version_compare( $version, strval( $bsf_core_version ), '>' ) ) {
					$bsf_core_version = $version; // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
					$bsf_core_path    = $bsf_core_dir; // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
				}
			}
		}

		/**
		 * Add Message for license.
		 *
		 * @param  string $content       get the link content.
		 * @param  string $purchase_url  purchase_url.
		 * @return string                output message.
		 */
		public function license_message_astra_addon( $content, $purchase_url ) {

			$purchase_url = apply_filters( 'astra_addon_licence_url', $purchase_url );

			return "<p><a target='_blank' href='" . esc_url( $purchase_url ) . "'>" . esc_html__( 'Get the license »', 'astra-addon' ) . '</a></p>';
		}

		/**
		 * Load the brainstorm updater.
		 *
		 * @return void
		 */
		public function load() {
			global $bsf_core_version, $bsf_core_path;
			if ( is_file( realpath( $bsf_core_path . '/index.php' ) ) ) {
				include_once realpath( $bsf_core_path . '/index.php' );
			}
		}
	}

	/**
	 * Kicking this off by calling 'get_instance()' method
	 */
	Brainstorm_Update_Astra_Addon::get_instance();

}
