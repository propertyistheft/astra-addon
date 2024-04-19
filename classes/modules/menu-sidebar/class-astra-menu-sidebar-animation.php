<?php
/**
 * Astra Common Modules Like Off Canvas Sidebar / Flyout Menu
 *
 * @package Astra Addon
 */

define( 'ASTRA_ADDON_EXT_MENU_SIDEBAR_DIR', ASTRA_EXT_DIR . 'classes/modules/menu-sidebar/' );
define( 'ASTRA_ADDON_EXT_MENU_SIDEBAR_URI', ASTRA_EXT_URI . 'classes/modules/menu-sidebar/' );

if ( ! class_exists( 'Astra_Menu_Sidebar_Animation' ) ) {

	/**
	 * Astra_Menu_Sidebar_Animation initial setup
	 *
	 * @since 1.4.0
	 */
	// @codingStandardsIgnoreStart
	class Astra_Menu_Sidebar_Animation {
 // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedClassFound
		// @codingStandardsIgnoreEnd

		/**
		 * Member Variable
		 *
		 * @var instance
		 */
		private static $instance;

		/**
		 * Member Variable
		 *
		 * @var options
		 */
		public static $options;

		/**
		 *  Initiator
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
			add_action( 'astra_addon_get_js_files', array( $this, 'add_scripts' ) );
			add_filter( 'astra_addon_js_localize', array( $this, 'localize_variables' ) );
		}

		/**
		 * Add common js scripts for Flyout, Canvas Sidebar, Fullscreen menu.
		 *
		 * @since 1.4.0
		 * @return void
		 */
		public function add_scripts() {

			/*** Start Path Logic */

			/* Define Variables */
			$uri  = ASTRA_ADDON_EXT_MENU_SIDEBAR_URI . 'assets/js/';
			$path = ASTRA_ADDON_EXT_MENU_SIDEBAR_DIR . 'assets/js/';

			/* Directory and Extension */
			$file_prefix = '.min';
			$dir_name    = 'minified';

			if ( SCRIPT_DEBUG ) {
				$file_prefix = '';
				$dir_name    = 'unminified';
			}

			$js_uri = $uri . $dir_name . '/';
			$js_dir = $path . $dir_name . '/';

			if ( defined( 'ASTRA_THEME_HTTP2' ) && ASTRA_THEME_HTTP2 ) {
				$gen_path = $js_uri;
			} else {
				$gen_path = $js_dir;
			}

			/*** End Path Logic */

			$canvas_trigger_type     = astra_get_option( 'shop-off-canvas-trigger-type' );
			$mobile_menu_style       = astra_get_option( 'mobile-menu-style' );
			$mobile_above_menu_style = astra_get_option( 'mobile-above-header-menu-style' );
			$mobile_below_menu_style = astra_get_option( 'mobile-below-header-menu-style' );

			if ( in_array( 'filters', astra_get_option( 'shop-toolbar-structure', array() ) ) ||
				'flyout' == $mobile_menu_style || 'fullscreen' == $mobile_menu_style ||
				'flyout' == $mobile_above_menu_style ||
				'fullscreen' == $mobile_above_menu_style ||
				'flyout' == $mobile_below_menu_style ||
				'fullscreen' == $mobile_below_menu_style
			) {
				Astra_Minify::add_dependent_js( 'jquery' );
				Astra_Minify::add_js( $gen_path . 'common-sidebar-and-menu' . $file_prefix . '.js' );
			}
		}

		/**
		 * Add Localize variables
		 *
		 * @since 1.4.0
		 * @param  array $localize_vars Localize variables array.
		 * @return array
		 */
		public function localize_variables( $localize_vars ) {

			$mobile_menu_style  = astra_get_option( 'mobile-menu-style' );
			$mobile_menu_flyout = astra_get_option( 'flyout-mobile-menu-alignment' );

			$above_mobile_menu_style  = astra_get_option( 'mobile-above-header-menu-style' );
			$above_mobile_menu_flyout = astra_get_option( 'flyout-mobile-above-header-menu-alignment' );

			$below_mobile_menu_style  = astra_get_option( 'mobile-below-header-menu-style' );
			$below_mobile_menu_flyout = astra_get_option( 'flyout-mobile-below-header-menu-alignment' );

			// If plugin - 'WooCommerce' not exist then return.
			if ( class_exists( 'WooCommerce' ) ) {
				$canvas_trigger_type  = astra_get_option( 'shop-off-canvas-trigger-type' );
				$canvas_enable        = false;
				$canvas_trigger_class = 'astra-shop-filter-button';

				if ( 'shop-filter-flyout' === astra_get_option( 'shop-filter-position' ) && ( is_shop() || is_product_taxonomy() ) ) {
					$canvas_enable = true;
				}
				if ( 'custom-class' == $canvas_trigger_type && '' != $canvas_trigger_class ) {
					$canvas_trigger_class = astra_get_option( 'shop-filter-trigger-custom-class' );
				}
				if ( in_array( 'filters', astra_get_option( 'shop-toolbar-structure', array() ) ) ) {
					$localize_vars['off_canvas_trigger_class'] = $canvas_trigger_class;
					$localize_vars['off_canvas_enable']        = $canvas_enable;
				}
				if ( 'flyout' == $mobile_menu_style ) {
					$localize_vars['main_menu_flyout_alignment'] = $mobile_menu_flyout;
				}
				if ( 'flyout' == $above_mobile_menu_style ) {
					$localize_vars['above_menu_flyout_alignment'] = $above_mobile_menu_flyout;
				}
				if ( 'flyout' == $below_mobile_menu_style ) {
					$localize_vars['below_menu_flyout_alignment'] = $below_mobile_menu_flyout;
				}
			}

			$above_header = astra_get_option( 'header-above-stick' );
			$main_header  = astra_get_option( 'header-main-stick' );
			$below_header = astra_get_option( 'header-below-stick' );

			if ( $above_header || $main_header || $below_header ) {
				$localize_vars['sticky_active'] = true;
			} else {
				$localize_vars['sticky_active'] = false;
			}

			$localize_vars['svgIconClose'] = Astra_Icons::get_icons( 'close' );

			return $localize_vars;
		}
	}
}

/**
 *  Prepare if class 'Astra_Customizer_Loader' exist.
 *  Kicking this off by calling 'get_instance()' method
 */
Astra_Menu_Sidebar_Animation::get_instance();
