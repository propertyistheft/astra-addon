<?php
/**
 * Spacing - Customizer.
 *
 * @package Astra
 * @since 1.2.0
 */

if ( ! class_exists( 'Astra_Ext_Spacing_Loader' ) ) {

	/**
	 * Customizer Initialization
	 *
	 * @since 1.2.0
	 */
	// @codingStandardsIgnoreStart
	class Astra_Ext_Spacing_Loader {
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

			add_action( 'body_class', array( $this, 'add_body_class' ) );

		}

		/**
		 * Set Options Default Values
		 *
		 * @param  array $defaults  Astra options default value array.
		 * @return array
		 */
		public function theme_defaults( $defaults ) {

			$defaults['header-account-menu-spacing']  = array(
				'desktop'      => array(
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
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
			$defaults['container-outside-spacing']    = array(
				'desktop'      => array(
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
				),
				'tablet'       => array(
					'top'    => '1.5',
					'right'  => '0',
					'bottom' => '1.5',
					'left'   => '0',
				),
				'mobile'       => array(
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
				),
				'desktop-unit' => 'px',
				'tablet-unit'  => 'em',
				'mobile-unit'  => 'px',
			);
			$defaults['container-inside-spacing']     = array(
				'desktop'      => array(
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
				),
				'tablet'       => array(
					'top'    => '1.5',
					'right'  => '2.14',
					'bottom' => '1.5',
					'left'   => '2.14',
				),
				'mobile'       => array(
					'top'    => '1.5',
					'right'  => '1',
					'bottom' => '1.5',
					'left'   => '1',
				),
				'desktop-unit' => 'px',
				'tablet-unit'  => 'em',
				'mobile-unit'  => 'em',
			);
			$defaults['sidebar-outside-spacing']      = array(
				'desktop'      => array(
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
				),
				'tablet'       => array(
					'top'    => '1.5',
					'right'  => '1',
					'bottom' => '1.5',
					'left'   => '1',
				),
				'mobile'       => array(
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
				),
				'desktop-unit' => 'px',
				'tablet-unit'  => 'em',
				'mobile-unit'  => 'px',
			);
			$defaults['sidebar-inside-spacing']       = array(
				'desktop'      => array(
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
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
			$defaults['blog-post-outside-spacing']    = array(
				'desktop'      => array(
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
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
			$defaults['blog-post-inside-spacing']     = array(
				'desktop'      => array(
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
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
			$defaults['blog-post-pagination-spacing'] = array(
				'desktop'      => array(
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
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
			$defaults['header-spacing']               = array(
				'desktop'      => array(
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
				),
				'tablet'       => array(
					'top'    => '1.5',
					'right'  => '',
					'bottom' => '1.5',
					'left'   => '',
				),
				'mobile'       => array(
					'top'    => '1',
					'right'  => '',
					'bottom' => '1',
					'left'   => '',
				),
				'desktop-unit' => 'px',
				'tablet-unit'  => 'em',
				'mobile-unit'  => 'em',
			);

			$defaults['sticky-header-spacing'] = array(
				'desktop'      => array(
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
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

			$defaults['footer-sml-spacing']      = array(
				'desktop'      => array(
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
				),
				'tablet'       => array(
					'top'    => '2',
					'right'  => '',
					'bottom' => '2',
					'left'   => '',
				),
				'mobile'       => array(
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
				),
				'desktop-unit' => 'px',
				'tablet-unit'  => 'em',
				'mobile-unit'  => 'px',
			);
			$defaults['primary-menu-spacing']    = array(
				'desktop'      => array(
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
				),
				'tablet'       => array(
					'top'    => '0',
					'right'  => '20',
					'bottom' => '0',
					'left'   => '20',
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
			$defaults['primary-submenu-spacing'] = array(
				'desktop'      => array(
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
				),
				'tablet'       => array(
					'top'    => '0',
					'right'  => '20',
					'bottom' => '0',
					'left'   => '30',
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

			$defaults['above-header-spacing']         = array(
				'desktop'      => array(
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
				),
				'tablet'       => array(
					'top'    => '0',
					'right'  => '',
					'bottom' => '0',
					'left'   => '',
				),
				'mobile'       => array(
					'top'    => '0.5',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
				),
				'desktop-unit' => 'px',
				'tablet-unit'  => 'px',
				'mobile-unit'  => 'em',
			);
			$defaults['above-header-menu-spacing']    = array(
				'desktop'      => array(
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
				),
				'tablet'       => array(
					'top'    => '0',
					'right'  => '20',
					'bottom' => '0',
					'left'   => '20',
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
			$defaults['above-header-submenu-spacing'] = array(
				'desktop'      => array(
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
				),
				'tablet'       => array(
					'top'    => '0',
					'right'  => '20',
					'bottom' => '0',
					'left'   => '20',
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

			$defaults['below-header-spacing']         = array(
				'desktop'      => array(
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
				),
				'tablet'       => array(
					'top'    => '1',
					'right'  => '',
					'bottom' => '1',
					'left'   => '',
				),
				'mobile'       => array(
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
				),
				'desktop-unit' => 'px',
				'tablet-unit'  => 'em',
				'mobile-unit'  => 'px',
			);
			$defaults['below-header-menu-spacing']    = array(
				'desktop'      => array(
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
				),
				'tablet'       => array(
					'top'    => '0',
					'right'  => '20',
					'bottom' => '0',
					'left'   => '20',
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
			$defaults['below-header-submenu-spacing'] = array(
				'desktop'      => array(
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
				),
				'tablet'       => array(
					'top'    => '0',
					'right'  => '20',
					'bottom' => '0',
					'left'   => '20',
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
			$defaults['footer-menu-spacing']          = array(
				'desktop'      => array(
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
				),
				'tablet'       => array(
					'top'    => '0',
					'right'  => '.5',
					'bottom' => '0',
					'left'   => '.5',
				),
				'mobile'       => array(
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
				),
				'desktop-unit' => 'px',
				'tablet-unit'  => 'em',
				'mobile-unit'  => 'px',
			);
			$defaults['single-post-inside-spacing']   = array(
				'desktop'      => array(
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
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

			$defaults['section-hb-language-switcher-item-spacing'] = array(
				'desktop'      => array(
					'top'    => '10',
					'right'  => '10',
					'bottom' => '10',
					'left'   => '10',
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

			$defaults['section-fb-language-switcher-item-spacing'] = array(
				'desktop'      => array(
					'top'    => '10',
					'right'  => '10',
					'bottom' => '10',
					'left'   => '10',
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

			return $defaults;
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
			require_once ASTRA_ADDON_EXT_SPACING_DIR . 'classes/sections/class-astra-customizer-container-layout-spacing-configs.php';
			if ( astra_addon_existing_header_footer_configs() ) {
				require_once ASTRA_ADDON_EXT_SPACING_DIR . 'classes/sections/class-astra-customizer-header-spacing-configs.php';
				require_once ASTRA_ADDON_EXT_SPACING_DIR . 'classes/sections/class-astra-customizer-above-header-spacing-configs.php';
				require_once ASTRA_ADDON_EXT_SPACING_DIR . 'classes/sections/class-astra-customizer-below-header-spacing-configs.php';
				require_once ASTRA_ADDON_EXT_SPACING_DIR . 'classes/sections/class-astra-customizer-footer-small-spacing-configs.php';
				require_once ASTRA_ADDON_EXT_SPACING_DIR . 'classes/sections/class-astra-customizer-site-identity-spacing-configs.php';
			} else {
				require_once ASTRA_ADDON_EXT_SPACING_DIR . 'classes/sections/class-astra-customizer-header-builder-menu-configs.php';
			}
			require_once ASTRA_ADDON_EXT_SPACING_DIR . 'classes/sections/class-astra-customizer-sidebar-spacing-configs.php';
			require_once ASTRA_ADDON_EXT_SPACING_DIR . 'classes/sections/class-astra-customizer-blog-spacing-configs.php';
			require_once ASTRA_ADDON_EXT_SPACING_DIR . 'classes/sections/class-astra-customizer-single-post-spacing-configs.php';
		}

		/**
		 * Customizer Preview
		 */
		public function preview_scripts() {

			if ( SCRIPT_DEBUG ) {
				wp_enqueue_script( 'astra-ext-spacing-customize-preview-js', ASTRA_ADDON_EXT_SPACING_URL . 'assets/js/unminified/customizer-preview.js', array( 'customize-preview', 'astra-customizer-preview-js' ), ASTRA_EXT_VER, true );
			} else {
				wp_enqueue_script( 'astra-ext-spacing-customize-preview-js', ASTRA_ADDON_EXT_SPACING_URL . 'assets/js/minified/customizer-preview.min.js', array( 'customize-preview', 'astra-customizer-preview-js' ), ASTRA_EXT_VER, true );
			}

			$localize_array = array(
				'blog_pro_enabled'   => Astra_Ext_Extension::is_active( 'blog-pro' ),
				'tablet_break_point' => astra_addon_get_tablet_breakpoint(),
				'mobile_break_point' => astra_addon_get_mobile_breakpoint(),
				'component_limit'    => astra_addon_builder_helper()->component_limit,
				'astra_not_updated'  => version_compare( ASTRA_THEME_VERSION, '3.2.0', '<' ),
			);
			wp_localize_script( 'astra-ext-spacing-customize-preview-js', 'ast_preview', $localize_array );

		}

		/**
		 * Add Body Classes
		 *
		 * @param array $classes Body Class Array.
		 * @return array
		 */
		public function add_body_class( $classes ) {

			/**
			 * Add class for header width
			 */
			$header_content_layout = astra_get_option( 'header-main-layout-width' );

			if ( 'full' == $header_content_layout ) {
				$classes[] = 'ast-full-width-header';
			}

			return $classes;
		}

	}
}

/**
*  Kicking this off by calling 'get_instance()' method
*/
Astra_Ext_Spacing_Loader::get_instance();
