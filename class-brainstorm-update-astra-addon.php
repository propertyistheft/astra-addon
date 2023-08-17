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

if ( ! class_exists( 'Brainstorm_Update_Astra_Addon' ) ) :

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
			add_action( 'init', array( $this, 'load' ), 999 );
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

			/*
			* BSF Analytics.
			*/
			if ( ! class_exists( 'BSF_Analytics_Loader' ) ) {
				require_once ASTRA_EXT_DIR . 'admin/bsf-analytics/class-bsf-analytics-loader.php';
			}

			$astra_addon_bsf_analytics = BSF_Analytics_Loader::get_instance();

			$astra_addon_bsf_analytics->set_entity(
				array(
					'bsf' => array(
						'product_name'    => 'Astra Pro',
						'path'            => ASTRA_EXT_DIR . 'admin/bsf-analytics',
						'author'          => 'Brainstorm Force',
						'time_to_display' => '+24 hours',
					),
				)
			);

			add_filter( 'bsf_core_stats', array( $this, 'astra_addon_get_specific_stats' ) );
			add_action( 'astra_addon_get_addon_usage', array( $this, 'astra_addon_get_addon_usage' ) );
			add_filter( 'init', array( $this, 'astra_addon_run_scheduled_analytic_job' ) );
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
		 * @param boolean $status True if updates are tobe enabled. False if updates are to be disabled.
		 * @return boolean True if updates are tobe enabled. False if updates are to be disabled.
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
		 * @return boolean True if Astra Theme or Pro are using beta/alpha versions. False is both theme and pro are using stable versions.
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
		 * @param boolean $status True - If beta updates are enabled. False - If beta updates are disabled.
		 * @return boolean
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

			$message = "<p><a target='_blank' href='" . esc_url( $purchase_url ) . "'>" . esc_html__( 'Get the license »', 'astra-addon' ) . '</a></p>';
			return $message;
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

		/**
		 * Pass addon specific stats to BSF analytics.
		 *
		 * @since 2.6.4
		 * @param array $default_stats Default stats array.
		 * @return array $default_stats Default stats with addon specific stats array.
		 */
		public function astra_addon_get_specific_stats( $default_stats ) {
			$astra_settings                  = get_option( 'astra-settings', array() );
			$default_stats['astra_settings'] = array(
				'astra-addon-version' => ASTRA_EXT_VER,
				'astra-theme-version' => ASTRA_THEME_VERSION,
				'breadcrumb-position' => isset( $astra_settings['breadcrumb-position'] ) ? $astra_settings['breadcrumb-position'] : 'none',
				'mega-menu-details'   => get_option( 'ast_extension_data', array() ),
			);
			return $default_stats;
		}

		/**
		 * Prepare Astra's megamenu data to pass BSF-Analytics.
		 *
		 * @since 3.9.3
		 *
		 * @return void
		 */
		public function astra_addon_get_addon_usage() {

			$all_menus               = wp_get_nav_menus();
			$megamenu_analytics_data = array();

			if ( ! is_array( $all_menus ) && empty( $all_menus ) ) {
				return;
			}

			foreach ( $all_menus as $key => $menu_term ) {
				$menu_items = wp_get_nav_menu_items( $menu_term->term_id );
				foreach ( $menu_items as $menu_item ) {
					// Enable Megamenu.
					$is_enable = isset( $menu_item->megamenu ) ? $menu_item->megamenu : '';
					if ( 'megamenu' === $is_enable ) {
						$megamenu_analytics_data['megamenu-is-enabled'][] = 'yes';
					}

					// Width type.
					$width_type = isset( $menu_item->megamenu_width ) ? $menu_item->megamenu_width : '';
					if ( '' !== $width_type ) {
						$megamenu_analytics_data['menu-container-types'][] = $width_type;
					}

					// Content source.
					$content_source = isset( $menu_item->megamenu_content_src ) ? $menu_item->megamenu_content_src : '';
					if ( '' !== $content_source ) {
						$megamenu_analytics_data['sub-menus-content-source'][] = $content_source;
					}

					// Enabled heading.
					$enabled_heading = isset( $menu_item->megamenu_enable_heading ) ? $menu_item->megamenu_enable_heading : '';
					if ( '' !== $enabled_heading ) {
						$megamenu_analytics_data['sub-menus-heading-enabled'][] = $enabled_heading;
					}
				}
			}

			update_option( 'ast_extension_data', $megamenu_analytics_data );
		}

		/**
		 * Run scheduled job for BSF-Analytics.
		 *
		 * @since 3.9.3
		 * @return void
		 */
		public function astra_addon_run_scheduled_analytic_job() {
			if ( ! wp_next_scheduled( 'astra_addon_get_addon_usage' ) && ! wp_installing() ) {
				wp_schedule_event( time(), 'daily', 'astra_addon_get_addon_usage' );
			}
		}
	}

	/**
	 * Kicking this off by calling 'get_instance()' method
	 */
	Brainstorm_Update_Astra_Addon::get_instance();

endif;
