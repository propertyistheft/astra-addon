<?php
/**
 * Sticky Header - Customizer.
 *
 * @package Astra Addon
 * @since 1.0.0
 */

if ( ! class_exists( 'Astra_Ext_Sticky_Header_Loader' ) ) {

	/**
	 * Customizer Initialization
	 *
	 * @since 1.0.0
	 */
	// @codingStandardsIgnoreStart
	class Astra_Ext_Sticky_Header_Loader {
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
			add_action( 'customize_preview_init', array( $this, 'preview_scripts' ) );
			add_action( 'customize_register', array( $this, 'new_customize_register' ), 2 );
		}

		/**
		 * Set Options Default Values
		 *
		 * @param  array $defaults  Astra options default value array.
		 * @return array
		 */
		public function theme_defaults( $defaults ) {

			$astra_options                            = astra_get_options();
			$defaults['header-main-shrink']           = 1;
			$defaults['different-sticky-logo']        = 0;
			$defaults['different-sticky-retina-logo'] = 0;
			$defaults['header-main-stick']            = 0;
			$defaults['header-above-stick']           = 0;
			$defaults['header-below-stick']           = 0;
			$defaults['sticky-header-bg-opc']         = 1;
			$defaults['sticky-hide-on-scroll']        = 0;
			$defaults['sticky-header-on-devices']     = 'desktop';
			$defaults['sticky-header-style']          = 'none';
			$defaults['sticky-header-logo']           = '';
			$defaults['sticky-header-retina-logo']    = '';

			$defaults['sticky-header-logo-width'] = array(
				'desktop' => '',
				'tablet'  => '',
				'mobile'  => '',
			);

			/**
			 * Sticky Header
			 */
			$defaults['sticky-header-bg-color-responsive'] = array(
				'desktop' => '',
				'tablet'  => '',
				'mobile'  => '',
			);

			$defaults['sticky-header-bg-blur']           = false;
			$defaults['sticky-header-bg-blur-intensity'] = 10;

			$defaults['sticky-header-color-site-title-responsive'] = array(
				'desktop' => '',
				'tablet'  => '',
				'mobile'  => '',
			);

			$defaults['sticky-header-builder-site-title-color']   = '';
			$defaults['sticky-header-builder-site-title-h-color'] = '';
			$defaults['sticky-header-builder-site-tagline-color'] = '';
			$defaults['sticky-header-builder-logo-color']         = '';

			$component_limit = astra_addon_builder_helper()->component_limit;
			for ( $index = 1; $index <= $component_limit; $index++ ) {

				$sticky_header_button_border_radius = ! isset( $astra_options[ 'sticky-header-button' . $index . '-border-radius-fields' ] ) && isset( $astra_options[ 'sticky-header-button' . $index . '-border-radius' ] ) ? $astra_options[ 'sticky-header-button' . $index . '-border-radius' ] : '';
				/**
				 * Sticky Header > Menu color configs.
				 */
				$defaults[ 'sticky-header-menu' . $index . '-color-responsive' ]                = array(
					'desktop' => '',
					'tablet'  => '',
					'mobile'  => '',
				);
				$defaults[ 'sticky-header-menu' . $index . '-bg-obj-responsive' ]               = array(
					'desktop' => '',
					'tablet'  => '',
					'mobile'  => '',
				);
				$defaults[ 'sticky-header-menu' . $index . '-h-color-responsive' ]              = array(
					'desktop' => '',
					'tablet'  => '',
					'mobile'  => '',
				);
				$defaults[ 'sticky-header-menu' . $index . '-h-bg-color-responsive' ]           = array(
					'desktop' => '',
					'tablet'  => '',
					'mobile'  => '',
				);
				$defaults[ 'sticky-header-menu' . $index . '-a-color-responsive' ]              = array(
					'desktop' => '',
					'tablet'  => '',
					'mobile'  => '',
				);
				$defaults[ 'sticky-header-menu' . $index . '-a-bg-color-responsive' ]           = array(
					'desktop' => '',
					'tablet'  => '',
					'mobile'  => '',
				);
				$defaults[ 'sticky-header-menu' . $index . '-submenu-color-responsive' ]        = array(
					'desktop' => '',
					'tablet'  => '',
					'mobile'  => '',
				);
				$defaults[ 'sticky-header-menu' . $index . '-submenu-bg-color-responsive' ]     = array(
					'desktop' => '',
					'tablet'  => '',
					'mobile'  => '',
				);
				$defaults[ 'sticky-header-menu' . $index . '-submenu-h-color-responsive' ]      = array(
					'desktop' => '',
					'tablet'  => '',
					'mobile'  => '',
				);
				$defaults[ 'sticky-header-menu' . $index . '-submenu-h-bg-color-responsive' ]   = array(
					'desktop' => '',
					'tablet'  => '',
					'mobile'  => '',
				);
				$defaults[ 'sticky-header-menu' . $index . '-submenu-a-color-responsive' ]      = array(
					'desktop' => '',
					'tablet'  => '',
					'mobile'  => '',
				);
				$defaults[ 'sticky-header-menu' . $index . '-submenu-a-bg-color-responsive' ]   = array(
					'desktop' => '',
					'tablet'  => '',
					'mobile'  => '',
				);
				$defaults[ 'sticky-header-menu' . $index . '-header-megamenu-heading-color' ]   = '';
				$defaults[ 'sticky-header-menu' . $index . '-header-megamenu-heading-h-color' ] = '';
				$defaults[ 'sticky-header-button' . $index . '-border-radius-fields' ]          = array(
					'desktop'      => array(
						'top'    => $sticky_header_button_border_radius,
						'right'  => $sticky_header_button_border_radius,
						'bottom' => $sticky_header_button_border_radius,
						'left'   => $sticky_header_button_border_radius,
					),
					'tablet'       => array(
						'top'    => '',
						'right'  => '',
						'bottom' => '',
						'left'   => '',
					),
					'mobile'       => array(
						'top'    => '',
						'right'  => '',
						'bottom' => '',
						'left'   => '',
					),
					'desktop-unit' => 'px',
					'tablet-unit'  => 'px',
					'mobile-unit'  => 'px',
				);
			}

			$defaults['sticky-header-color-site-tagline-responsive'] = array(
				'desktop' => '',
				'tablet'  => '',
				'mobile'  => '',
			);
			$defaults['sticky-header-color-h-site-title-responsive'] = array(
				'desktop' => '',
				'tablet'  => '',
				'mobile'  => '',
			);
			// Primary Menu.
			$defaults['sticky-header-menu-bg-color-responsive']     = array(
				'desktop' => '',
				'tablet'  => '',
				'mobile'  => '',
			);
			$defaults['sticky-header-menu-color-responsive']        = array(
				'desktop' => '',
				'tablet'  => '',
				'mobile'  => '',
			);
			$defaults['sticky-header-menu-h-color-responsive']      = array(
				'desktop' => '',
				'tablet'  => '',
				'mobile'  => '',
			);
			$defaults['sticky-header-menu-h-a-bg-color-responsive'] = array(
				'desktop' => '',
				'tablet'  => '',
				'mobile'  => '',
			);
			// Primary Submenu.
			$defaults['sticky-header-submenu-bg-color-responsive']     = array(
				'desktop' => '',
				'tablet'  => '',
				'mobile'  => '',
			);
			$defaults['sticky-header-submenu-color-responsive']        = array(
				'desktop' => '',
				'tablet'  => '',
				'mobile'  => '',
			);
			$defaults['sticky-header-submenu-h-color-responsive']      = array(
				'desktop' => '',
				'tablet'  => '',
				'mobile'  => '',
			);
			$defaults['sticky-header-submenu-h-a-bg-color-responsive'] = array(
				'desktop' => '',
				'tablet'  => '',
				'mobile'  => '',
			);

			// Outside menu item.
			$defaults['sticky-header-content-section-text-color-responsive']   = array(
				'desktop' => '',
				'tablet'  => '',
				'mobile'  => '',
			);
			$defaults['sticky-header-content-section-link-color-responsive']   = array(
				'desktop' => '',
				'tablet'  => '',
				'mobile'  => '',
			);
			$defaults['sticky-header-content-section-link-h-color-responsive'] = array(
				'desktop' => '',
				'tablet'  => '',
				'mobile'  => '',
			);

			/**
			 * Sticky Above Header
			 */
			$defaults['sticky-above-header-bg-color-responsive'] = array(
				'desktop' => '',
				'tablet'  => '',
				'mobile'  => '',
			);

			$defaults['sticky-above-header-bg-blur']           = false;
			$defaults['sticky-above-header-bg-blur-intensity'] = 10;

			// Above Header Menu.
			$defaults['sticky-above-header-menu-bg-color-responsive']     = array(
				'desktop' => '',
				'tablet'  => '',
				'mobile'  => '',
			);
			$defaults['sticky-above-header-menu-color-responsive']        = array(
				'desktop' => '',
				'tablet'  => '',
				'mobile'  => '',
			);
			$defaults['sticky-above-header-menu-h-color-responsive']      = array(
				'desktop' => '',
				'tablet'  => '',
				'mobile'  => '',
			);
			$defaults['sticky-above-header-menu-h-a-bg-color-responsive'] = array(
				'desktop' => '',
				'tablet'  => '',
				'mobile'  => '',
			);
			// Abvoe Header Submenu.
			$defaults['sticky-above-header-submenu-bg-color-responsive']     = array(
				'desktop' => '',
				'tablet'  => '',
				'mobile'  => '',
			);
			$defaults['sticky-above-header-submenu-color-responsive']        = array(
				'desktop' => '',
				'tablet'  => '',
				'mobile'  => '',
			);
			$defaults['sticky-above-header-submenu-h-color-responsive']      = array(
				'desktop' => '',
				'tablet'  => '',
				'mobile'  => '',
			);
			$defaults['sticky-above-header-submenu-h-a-bg-color-responsive'] = array(
				'desktop' => '',
				'tablet'  => '',
				'mobile'  => '',
			);
			// Sticky Above Header Content Section.
			$defaults['sticky-above-header-content-section-text-color-responsive']   = array(
				'desktop' => '',
				'tablet'  => '',
				'mobile'  => '',
			);
			$defaults['sticky-above-header-content-section-link-color-responsive']   = array(
				'desktop' => '',
				'tablet'  => '',
				'mobile'  => '',
			);
			$defaults['sticky-above-header-content-section-link-h-color-responsive'] = array(
				'desktop' => '',
				'tablet'  => '',
				'mobile'  => '',
			);

			/**
			 * Sticky below Header
			 */
			$defaults['sticky-below-header-bg-color-responsive'] = array(
				'desktop' => '',
				'tablet'  => '',
				'mobile'  => '',
			);

			$defaults['sticky-below-header-bg-blur']           = false;
			$defaults['sticky-below-header-bg-blur-intensity'] = 10;

			// below Header Menu.
			$defaults['sticky-below-header-menu-bg-color-responsive']     = array(
				'desktop' => '',
				'tablet'  => '',
				'mobile'  => '',
			);
			$defaults['sticky-below-header-menu-color-responsive']        = array(
				'desktop' => '',
				'tablet'  => '',
				'mobile'  => '',
			);
			$defaults['sticky-below-header-menu-h-color-responsive']      = array(
				'desktop' => '',
				'tablet'  => '',
				'mobile'  => '',
			);
			$defaults['sticky-below-header-menu-h-a-bg-color-responsive'] = array(
				'desktop' => '',
				'tablet'  => '',
				'mobile'  => '',
			);
			// Abvoe Header Submenu.
			$defaults['sticky-below-header-submenu-bg-color-responsive']     = array(
				'desktop' => '',
				'tablet'  => '',
				'mobile'  => '',
			);
			$defaults['sticky-below-header-submenu-color-responsive']        = array(
				'desktop' => '',
				'tablet'  => '',
				'mobile'  => '',
			);
			$defaults['sticky-below-header-submenu-h-color-responsive']      = array(
				'desktop' => '',
				'tablet'  => '',
				'mobile'  => '',
			);
			$defaults['sticky-below-header-submenu-h-a-bg-color-responsive'] = array(
				'desktop' => '',
				'tablet'  => '',
				'mobile'  => '',
			);

			// Sticky Below Header Content Section.
			$defaults['sticky-below-header-content-section-text-color-responsive']   = array(
				'desktop' => '',
				'tablet'  => '',
				'mobile'  => '',
			);
			$defaults['sticky-below-header-content-section-link-color-responsive']   = array(
				'desktop' => '',
				'tablet'  => '',
				'mobile'  => '',
			);
			$defaults['sticky-below-header-content-section-link-h-color-responsive'] = array(
				'desktop' => '',
				'tablet'  => '',
				'mobile'  => '',
			);

			$defaults['sticky-header-language-switcher-color'] = '';

			/**
			 * Woo cart colors on sticky headers.
			 *
			 * @since 4.6.0
			 */
			$defaults['sticky-header-woo-cart-color']       = '';
			$defaults['sticky-header-woo-cart-hover-color'] = '';

			return $defaults;
		}

		/**
		 * Add postMessage support for site title and description for the Theme Customizer.
		 *
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 */
		public function new_customize_register( $wp_customize ) {

			/**
			 * Register Panel & Sections
			 */
			require_once ASTRA_ADDON_EXT_STICKY_HEADER_DIR . 'classes/class-astra-sticky-header-panels-configs.php';

			/**
			 * Sections
			 */
			require_once ASTRA_ADDON_EXT_STICKY_HEADER_DIR . 'classes/sections/class-astra-sticky-header-configs.php';

			require_once ASTRA_ADDON_EXT_STICKY_HEADER_DIR . 'classes/sections/class-astra-sticky-header-colors-bg-configs.php';

			// Header Sections.
			require_once ASTRA_ADDON_EXT_STICKY_HEADER_DIR . 'classes/sections/class-astra-sticky-header-sections-configs.php';

			// Check Header Sections is activated.
			require_once ASTRA_ADDON_EXT_STICKY_HEADER_DIR . 'classes/sections/class-astra-sticky-above-header-colors-bg-configs.php';
			require_once ASTRA_ADDON_EXT_STICKY_HEADER_DIR . 'classes/sections/class-astra-sticky-below-header-colors-bg-configs.php';

			if ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) {

				// Button Sticky Configs.
				require_once ASTRA_ADDON_EXT_STICKY_HEADER_DIR . 'classes/sections/class-astra-sticky-header-button-configs.php';

				// Social Sticky Configs.
				require_once ASTRA_ADDON_EXT_STICKY_HEADER_DIR . 'classes/sections/class-astra-sticky-header-social-configs.php';

				// Search Sticky Configs.
				require_once ASTRA_ADDON_EXT_STICKY_HEADER_DIR . 'classes/sections/class-astra-sticky-header-search-configs.php';

				// HTML Sticky Configs.
				require_once ASTRA_ADDON_EXT_STICKY_HEADER_DIR . 'classes/sections/class-astra-sticky-header-html-configs.php';

				// Widget Sticky Configs.git
				require_once ASTRA_ADDON_EXT_STICKY_HEADER_DIR . 'classes/sections/class-astra-sticky-header-widget-configs.php';

				// Divider Sticky Configs.
				require_once ASTRA_ADDON_EXT_STICKY_HEADER_DIR . 'classes/sections/class-astra-sticky-header-divider-configs.php';

				// Language-switcher Sticky Configs.
				require_once ASTRA_ADDON_EXT_STICKY_HEADER_DIR . 'classes/sections/class-astra-sticky-header-language-switcher-configs.php';

				// Account Sticky Configs.
				require_once ASTRA_ADDON_EXT_STICKY_HEADER_DIR . 'classes/sections/class-astra-sticky-header-account-configs.php';

				// Menu Toggle Sticky Configs.
				require_once ASTRA_ADDON_EXT_STICKY_HEADER_DIR . 'classes/sections/class-astra-sticky-header-toggle-configs.php';

				// Color Switcher Sticky Configs.
				require_once ASTRA_ADDON_EXT_STICKY_HEADER_DIR . 'classes/sections/class-astra-sticky-header-color-switcher-configs.php';
			}
		}

		/**
		 * Customizer Preview
		 */
		public function preview_scripts() {
			wp_register_script( 'astra-sticky-header-customizer-preview-js', ASTRA_ADDON_EXT_STICKY_HEADER_URI . 'assets/js/unminified/customizer-preview.js', array( 'customize-preview', 'astra-customizer-preview-js' ), ASTRA_EXT_VER, true );

			$sticky_header_style   = astra_get_option( 'sticky-header-style' );
			$sticky_hide_on_scroll = astra_get_option( 'sticky-hide-on-scroll' );

			$localize_array = array(
				'stickyHeaderStyle'     => $sticky_header_style,
				'stickyHideOnScroll'    => $sticky_hide_on_scroll,
				'component_limit'       => astra_addon_builder_helper()->component_limit,
				'is_flex_based_css'     => Astra_Addon_Builder_Helper::apply_flex_based_css(),
				'header_builder_active' => astra_addon_builder_helper()->is_header_footer_builder_active,
				'sticky_header_style'   => astra_get_option_meta( 'sticky-header-style' ),
				'sticky_hide_on_scroll' => astra_get_option_meta( 'sticky-hide-on-scroll' ),

			);

			wp_localize_script( 'astra-sticky-header-customizer-preview-js', 'astSticky', $localize_array );
			wp_enqueue_script( 'astra-sticky-header-customizer-preview-js' );
		}
	}
}

/**
 *  Kicking this off by calling 'get_instance()' method
 */
Astra_Ext_Sticky_Header_Loader::get_instance();
