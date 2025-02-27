<?php
/**
 * Mobile Header - Customizer.
 *
 * @package Astra Addon
 * @since 1.4.0
 */

if ( ! class_exists( 'Astra_Ext_Mobile_Header_Loader' ) ) {

	/**
	 * Customizer Initialization
	 *
	 * @since 1.0.0
	 */
	// @codingStandardsIgnoreStart
	class Astra_Ext_Mobile_Header_Loader {
 // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedClassFound
		// @codingStandardsIgnoreEnd

		/**
		 * Member Variable
		 *
		 * @var instance
		 */
		private static $instance;

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
		 *  Constructor
		 */
		public function __construct() {

			add_filter( 'astra_theme_defaults', array( $this, 'theme_defaults' ) );
			add_action( 'customize_register', array( $this, 'new_customize_register' ), 2 );
			add_action( 'customize_preview_init', array( $this, 'preview_scripts' ) );

			add_action( 'astra_get_fonts', array( $this, 'add_fonts' ), 1 );
		}

		/**
		 * Set Options Default Values
		 *
		 * @param  array $defaults  Astra options default value array.
		 * @return array
		 */
		public function theme_defaults( $defaults ) {

			$defaults['mobile-menu-style']            = 'default';
			$defaults['flyout-mobile-menu-alignment'] = 'left';

			$defaults['mobile-above-header-menu-style']            = 'default';
			$defaults['flyout-mobile-above-header-menu-alignment'] = 'left';

			$defaults['mobile-below-header-menu-style']            = 'default';
			$defaults['flyout-mobile-below-header-menu-alignment'] = 'left';

			// Mobile Header - Above Header.
			$defaults['mobile-above-header-toggle-btn-style']         = 'minimal';
			$defaults['mobile-above-header-toggle-btn-style-color']   = '';
			$defaults['mobile-above-header-toggle-btn-border-radius'] = 2;

			// Mobile Header - Below Header.
			$defaults['mobile-below-header-toggle-btn-style']         = 'minimal';
			$defaults['mobile-below-header-toggle-btn-style-color']   = '';
			$defaults['mobile-below-header-toggle-btn-border-radius'] = 2;

			/**
			 * Mobile Header Colors
			 */
			// Mobile Menu.
			$defaults['mobile-header-color']   = '';
			$defaults['mobile-header-h-color'] = '';
			$defaults['mobile-header-bg-obj']  = array(
				'background-color'      => '',
				'background-image'      => '',
				'background-repeat'     => 'repeat',
				'background-position'   => 'center center',
				'background-size'       => 'auto',
				'background-attachment' => 'scroll',
			);

			// Mobile Above Header.
			$defaults['mobile-above-header-t-l-color']       = '';
			$defaults['mobile-above-header-t-l-hover-color'] = '';
			$defaults['mobile-above-header-bg-obj']          = array(
				'background-color'      => '',
				'background-image'      => '',
				'background-repeat'     => 'repeat',
				'background-position'   => 'center center',
				'background-size'       => 'auto',
				'background-attachment' => 'scroll',
			);

			// Mobile Below Header.
			$defaults['mobile-below-header-t-l-color']       = '';
			$defaults['mobile-below-header-t-l-hover-color'] = '';
			$defaults['mobile-below-header-bg-obj']          = array(
				'background-color'      => '',
				'background-image'      => '',
				'background-repeat'     => 'repeat',
				'background-position'   => 'center center',
				'background-size'       => 'auto',
				'background-attachment' => 'scroll',
			);

			$defaults['mobile-header-menu-a-bg-color'] = '';
			$defaults['mobile-header-menu-a-color']    = '';
			$defaults['mobile-header-menu-h-bg-color'] = '';
			$defaults['mobile-header-menu-h-color']    = '';
			$defaults['mobile-header-menu-color']      = '';
			$defaults['mobile-header-menu-bg-color']   = '';

			// Mobile Above Header Menu.
			$defaults['mobile-above-header-menu-a-bg-color'] = '';
			$defaults['mobile-above-header-menu-a-color']    = '';
			$defaults['mobile-above-header-menu-h-bg-color'] = '';
			$defaults['mobile-above-header-menu-h-color']    = '';
			$defaults['mobile-above-header-menu-color']      = '';
			$defaults['mobile-above-header-menu-bg-color']   = '';

			// Mobile Below Header Menu.
			$defaults['mobile-below-header-menu-a-bg-color'] = '';
			$defaults['mobile-below-header-menu-a-color']    = '';
			$defaults['mobile-below-header-menu-h-bg-color'] = '';
			$defaults['mobile-below-header-menu-h-color']    = '';
			$defaults['mobile-below-header-menu-color']      = '';
			$defaults['mobile-below-header-menu-bg-color']   = '#414042';

			// Mobile Submenu.
			$defaults['mobile-header-submenu-color']      = '';
			$defaults['mobile-header-submenu-bg-color']   = '';
			$defaults['mobile-header-submenu-h-color']    = '';
			$defaults['mobile-header-submenu-h-bg-color'] = '';
			$defaults['mobile-header-submenu-a-color']    = '';
			$defaults['mobile-header-submenu-a-bg-color'] = '';

			$defaults['mobile-header-menu-all-border'] = array(
				'top'    => '',
				'right'  => '',
				'bottom' => '',
				'left'   => '',
			);
			$defaults['mobile-header-menu-b-color']    = '#dadada';

			// Mobile Above Header Menu.
			$defaults['mobile-above-header-submenu-color']      = '';
			$defaults['mobile-above-header-submenu-bg-color']   = '';
			$defaults['mobile-above-header-submenu-h-color']    = '';
			$defaults['mobile-above-header-submenu-h-bg-color'] = '';
			$defaults['mobile-above-header-submenu-a-color']    = '';
			$defaults['mobile-above-header-submenu-a-bg-color'] = '';

			$defaults['mobile-above-header-menu-all-border'] = array(
				'top'    => '',
				'right'  => '',
				'bottom' => '',
				'left'   => '',
			);
			$defaults['mobile-above-header-menu-b-color']    = '#dadada';

			// Mobile Below Header Menu.
			$defaults['mobile-below-header-submenu-color']      = '';
			$defaults['mobile-below-header-submenu-bg-color']   = '';
			$defaults['mobile-below-header-submenu-h-color']    = '';
			$defaults['mobile-below-header-submenu-h-bg-color'] = '';
			$defaults['mobile-below-header-submenu-a-color']    = '';
			$defaults['mobile-below-header-submenu-a-bg-color'] = '';

			$defaults['mobile-below-header-menu-all-border'] = array(
				'top'    => '',
				'right'  => '',
				'bottom' => '',
				'left'   => '',
			);
			$defaults['mobile-below-header-menu-b-color']    = '#dadada';

			// Mobile Flyout sidebar.
			$defaults['mobile-header-fullscreen-bg-obj'] = array(
				'background-color'      => '#ffffff',
				'background-image'      => '',
				'background-repeat'     => 'repeat',
				'background-position'   => 'center center',
				'background-size'       => 'auto',
				'background-attachment' => 'scroll',
			);

			// Mobile Above Header Flyout sidebar.
			$defaults['mobile-above-header-fullscreen-bg-obj'] = array(
				'background-color'      => '#ffffff',
				'background-image'      => '',
				'background-repeat'     => 'repeat',
				'background-position'   => 'center center',
				'background-size'       => 'auto',
				'background-attachment' => 'scroll',
			);

			// Mobile Below Header Flyout sidebar.
			$defaults['mobile-below-header-fullscreen-bg-obj'] = array(
				'background-color'      => '#414042',
				'background-image'      => '',
				'background-repeat'     => 'repeat',
				'background-position'   => 'center center',
				'background-size'       => 'auto',
				'background-attachment' => 'scroll',
			);

			// Mobile Typography.
			$defaults['font-family-mobile-menu']    = 'inherit';
			$defaults['font-weight-mobile-menu']    = 'inherit';
			$defaults['text-transform-mobile-menu'] = '';
			$defaults['line-height-mobile-menu']    = '';
			$defaults['font-size-mobile-menu']      = array(
				'desktop'      => '',
				'tablet'       => '',
				'mobile'       => '',
				'desktop-unit' => 'px',
				'tablet-unit'  => 'px',
				'mobile-unit'  => 'px',
			);

			$defaults['font-family-mobile-submenu']    = 'inherit';
			$defaults['font-weight-mobile-submenu']    = 'inherit';
			$defaults['text-transform-mobile-submenu'] = '';
			$defaults['line-height-mobile-submenu']    = '';
			$defaults['font-size-mobile-submenu']      = array(
				'desktop'      => '',
				'tablet'       => '',
				'mobile'       => '',
				'desktop-unit' => 'px',
				'tablet-unit'  => 'px',
				'mobile-unit'  => 'px',
			);

			// Mobile Above Header Typography.
			$defaults['font-family-mobile-above-header-menu']    = 'inherit';
			$defaults['font-weight-mobile-above-header-menu']    = 'inherit';
			$defaults['text-transform-mobile-above-header-menu'] = '';
			$defaults['font-size-mobile-above-header-menu']      = array(
				'desktop'      => '',
				'tablet'       => '',
				'mobile'       => '',
				'desktop-unit' => 'px',
				'tablet-unit'  => 'px',
				'mobile-unit'  => 'px',
			);

			// Mobile Below Header Typography.
			$defaults['font-family-mobile-below-header-menu']    = 'inherit';
			$defaults['font-weight-mobile-below-header-menu']    = 'inherit';
			$defaults['text-transform-mobile-below-header-menu'] = '';
			$defaults['line-height-mobile-below-header-menu']    = '';
			$defaults['font-size-mobile-below-header-menu']      = array(
				'desktop'      => '',
				'tablet'       => '',
				'mobile'       => '',
				'desktop-unit' => 'px',
				'tablet-unit'  => 'px',
				'mobile-unit'  => 'px',
			);

			$defaults['font-family-mobile-below-header-submenu']    = 'inherit';
			$defaults['font-weight-mobile-below-header-submenu']    = 'inherit';
			$defaults['text-transform-mobile-below-header-submenu'] = '';
			$defaults['line-height-mobile-below-header-submenu']    = '';
			$defaults['font-size-mobile-below-header-submenu']      = array(
				'desktop'      => '',
				'tablet'       => '',
				'mobile'       => '',
				'desktop-unit' => 'px',
				'tablet-unit'  => 'px',
				'mobile-unit'  => 'px',
			);

			return $defaults;
		}

		/**
		 * Add Font Family Callback
		 *
		 * @return void
		 */
		public function add_fonts() {

			$font_family_widget_title = astra_get_option( 'font-family-mobile-menu' );
			$font_weight_widget_title = astra_get_option( 'font-weight-mobile-menu' );
			Astra_Fonts::add_font( $font_family_widget_title, $font_weight_widget_title );

			$font_family_widget_title = astra_get_option( 'font-family-mobile-submenu' );
			$font_weight_widget_title = astra_get_option( 'font-weight-mobile-submenu' );
			Astra_Fonts::add_font( $font_family_widget_title, $font_weight_widget_title );

			// Mobile Above Header.
			$font_family_above_header_menu = astra_get_option( 'font-family-mobile-above-header-menu' );
			$font_weight_above_header_menu = astra_get_option( 'font-weight-mobile-above-header-menu' );
			Astra_Fonts::add_font( $font_family_above_header_menu, $font_weight_above_header_menu );

			// Mobile Below Header.
			$font_family_below_header_menu = astra_get_option( 'font-family-mobile-below-header-menu' );
			$font_weight_below_header_menu = astra_get_option( 'font-weight-mobile-below-header-menu' );
			Astra_Fonts::add_font( $font_family_below_header_menu, $font_weight_below_header_menu );

			$font_family_below_header_submenu = astra_get_option( 'font-family-mobile-below-header-submenu' );
			$font_weight_below_header_submenu = astra_get_option( 'font-weight-mobile-below-header-submenu' );
			Astra_Fonts::add_font( $font_family_below_header_submenu, $font_weight_below_header_submenu );
		}

		/**
		 * Add postMessage support for site title and description for the Theme Customizer.
		 *
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 */
		public function new_customize_register( $wp_customize ) {

			/**
			 * Sections
			 */
			if ( astra_addon_existing_header_footer_configs() ) {
				require_once ASTRA_ADDON_EXT_MOBILE_HEADER_DIR . 'classes/sections/class-astra-customizer-mobile-header-configs.php';
				require_once ASTRA_ADDON_EXT_MOBILE_HEADER_DIR . 'classes/sections/class-astra-customizer-mobile-above-header-configs.php';
				if ( Astra_Ext_Extension::is_active( 'header-sections' ) ) {
					require_once ASTRA_ADDON_EXT_MOBILE_HEADER_DIR . 'classes/sections/class-astra-customizer-mobile-below-header-configs.php';
				}
			}
		}

		/**
		 * Customizer Preview
		 */
		public function preview_scripts() {

			if ( SCRIPT_DEBUG ) {
				wp_enqueue_script( 'astra-ext-mobile-header-customize-preview-js', ASTRA_ADDON_EXT_MOBILE_HEADER_URL . 'assets/js/unminified/customizer-preview.js', array( 'customize-preview', 'astra-customizer-preview-js' ), ASTRA_EXT_VER, true );
			} else {
				wp_enqueue_script( 'astra-ext-mobile-header-customize-preview-js', ASTRA_ADDON_EXT_MOBILE_HEADER_URL . 'assets/js/minified/customizer-preview.min.js', array( 'customize-preview', 'astra-customizer-preview-js' ), ASTRA_EXT_VER, true );
			}
		}

	}
}

/**
 *  Kicking this off by calling 'get_instance()' method
 */
Astra_Ext_Mobile_Header_Loader::get_instance();
