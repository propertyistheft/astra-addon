<?php
/**
 * Advanced Header - Customizer.
 *
 * @package Astra Addon
 * @since 1.0.0
 */

if ( ! class_exists( 'Astra_Ext_Header_Sections_Loader' ) ) {

	/**
	 * Customizer Initialization
	 *
	 * @since 1.0.0
	 */
	class Astra_Ext_Header_Sections_Loader {

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
			// Below Header.
			$defaults['below-header-on-mobile'] = true;

			$defaults['below-header-layout']                      = 'disabled';
			$defaults['below-header-section-1']                   = 'menu';
			$defaults['below-header-section-1-html']              = __( '1-800-000-000 — hello@example.com', 'astra-addon' );
			$defaults['below-header-section-2']                   = 'none';
			$defaults['below-header-section-2-html']              = __( '1-800-000-000 — hello@example.com', 'astra-addon' );
			$defaults['below-header-separator']                   = 0;
			$defaults['below-header-height']                      = 60;
			$defaults['below-header-submenu-border']              = array(
				'top'    => '2',
				'right'  => '0',
				'bottom' => '0',
				'left'   => '0',
			);
			$defaults['below-header-submenu-item-border']         = false;
			$defaults['below-header-submenu-item-b-color']        = '';
			$defaults['below-header-submenu-border-color']        = '#ffffff';
			$defaults['below-header-menu-label']                  = '';
			$defaults['below-header-menu-align']                  = 'stack';
			$defaults['below-header-submenu-container-animation'] = 'fade';

			$defaults['below-header-merge-menu']          = false;
			$defaults['below-header-bottom-border-color'] = '';

			// Normal Below Header Background Image & Colors.
			$defaults['below-header-text-color']              = '#ffffff';
			$defaults['below-header-link-hover-color']        = '#d6d6d6';
			$defaults['below-header-link-hover-color']        = '#ffffff';
			$defaults['below-header-bg-obj']                  = array(
				'background-color'      => '#414042',
				'background-image'      => '',
				'background-repeat'     => 'repeat',
				'background-position'   => 'center center',
				'background-size'       => 'auto',
				'background-attachment' => 'scroll',
			);
			$defaults['below-header-menu-text-color']         = '#ffffff';
			$defaults['below-header-menu-text-hover-color']   = '#ffffff';
			$defaults['below-header-menu-bg-hover-color']     = '#575757';
			$defaults['below-header-current-menu-text-color'] = '#ffffff';
			$defaults['below-header-current-menu-bg-color']   = '#575757';

			$defaults['below-header-submenu-text-color']      = '';
			$defaults['below-header-submenu-bg-color']        = '';
			$defaults['below-header-submenu-hover-color']     = '';
			$defaults['below-header-submenu-bg-hover-color']  = '';
			$defaults['below-header-submenu-active-color']    = '';
			$defaults['below-header-submenu-active-bg-color'] = '';
			$defaults['below-header-menu-bg-obj-responsive']  = array(
				'desktop' => array(
					'background-color'      => '',
					'background-image'      => '',
					'background-repeat'     => 'repeat',
					'background-position'   => 'center center',
					'background-size'       => 'auto',
					'background-attachment' => 'scroll',
					'background-type'       => '',
					'background-media'      => '',
				),
				'tablet'  => array(
					'background-color'      => '',
					'background-image'      => '',
					'background-repeat'     => 'repeat',
					'background-position'   => 'center center',
					'background-size'       => 'auto',
					'background-attachment' => 'scroll',
					'background-type'       => '',
					'background-media'      => '',
				),
				'mobile'  => array(
					'background-color'      => '',
					'background-image'      => '',
					'background-repeat'     => 'repeat',
					'background-position'   => 'center center',
					'background-size'       => 'auto',
					'background-attachment' => 'scroll',
					'background-type'       => '',
					'background-media'      => '',
				),
			);
			// Responsive Below Header Background Image & Colors.
			$defaults['below-header-text-color-responsive'] = array(
				'desktop' => '#ffffff',
				'tablet'  => '',
				'mobile'  => '',
			);

			$defaults['below-header-link-hover-color-responsive'] = array(
				'desktop' => '#ffffff',
				'tablet'  => '',
				'mobile'  => '',
			);

			$defaults['below-header-link-color-responsive'] = array(
				'desktop' => '#ffffff',
				'tablet'  => '',
				'mobile'  => '',
			);

			$defaults['below-header-bg-obj-responsive'] = array(
				'desktop' => array(
					'background-color'      => '#414042',
					'background-image'      => '',
					'background-repeat'     => 'repeat',
					'background-position'   => 'center center',
					'background-size'       => 'auto',
					'background-attachment' => 'scroll',
					'background-type'       => '',
					'background-media'      => '',
				),
				'tablet'  => array(
					'background-color'      => '',
					'background-image'      => '',
					'background-repeat'     => 'repeat',
					'background-position'   => 'center center',
					'background-size'       => 'auto',
					'background-attachment' => 'scroll',
					'background-type'       => '',
					'background-media'      => '',
				),
				'mobile'  => array(
					'background-color'      => '',
					'background-image'      => '',
					'background-repeat'     => 'repeat',
					'background-position'   => 'center center',
					'background-size'       => 'auto',
					'background-attachment' => 'scroll',
					'background-type'       => '',
					'background-media'      => '',
				),
			);

			$defaults['below-header-menu-text-color-responsive'] = array(
				'desktop' => '#ffffff',
				'tablet'  => '',
				'mobile'  => '',
			);

			$defaults['below-header-menu-text-hover-color-responsive'] = array(
				'desktop' => '#ffffff',
				'tablet'  => '',
				'mobile'  => '',
			);

			$defaults['below-header-menu-bg-hover-color-responsive'] = array(
				'desktop' => '#575757',
				'tablet'  => '',
				'mobile'  => '',
			);

			$defaults['below-header-current-menu-text-color-responsive'] = array(
				'desktop' => '#ffffff',
				'tablet'  => '',
				'mobile'  => '',
			);

			$defaults['below-header-current-menu-bg-color-responsive'] = array(
				'desktop' => '#575757',
				'tablet'  => '',
				'mobile'  => '',
			);

			$defaults['below-header-submenu-text-color-responsive'] = array(
				'desktop' => '',
				'tablet'  => '',
				'mobile'  => '',
			);

			$defaults['below-header-submenu-bg-color-responsive'] = array(
				'desktop' => '',
				'tablet'  => '',
				'mobile'  => '',
			);

			$defaults['below-header-submenu-hover-color-responsive'] = array(
				'desktop' => '',
				'tablet'  => '',
				'mobile'  => '',
			);

			$defaults['below-header-submenu-bg-hover-color-responsive'] = array(
				'desktop' => '',
				'tablet'  => '',
				'mobile'  => '',
			);

			$defaults['below-header-submenu-active-color-responsive'] = array(
				'desktop' => '',
				'tablet'  => '',
				'mobile'  => '',
			);

			$defaults['below-header-submenu-active-bg-color-responsive'] = array(
				'desktop' => '',
				'tablet'  => '',
				'mobile'  => '',
			);

			$defaults['font-family-below-header-content']    = 'inherit';
			$defaults['font-weight-below-header-content']    = 'inherit';
			$defaults['font-size-below-header-content']      = array(
				'desktop'      => '',
				'tablet'       => '',
				'mobile'       => '',
				'desktop-unit' => 'px',
				'tablet-unit'  => 'px',
				'mobile-unit'  => 'px',
			);
			$defaults['text-transform-below-header-content'] = '';

			$defaults['font-family-below-header-primary-menu']    = 'inherit';
			$defaults['font-weight-below-header-primary-menu']    = 'inherit';
			$defaults['font-size-below-header-primary-menu']      = array(
				'desktop'      => '',
				'tablet'       => '',
				'mobile'       => '',
				'desktop-unit' => 'px',
				'tablet-unit'  => 'px',
				'mobile-unit'  => 'px',
			);
			$defaults['text-transform-below-header-primary-menu'] = '';

			$defaults['font-family-below-header-dropdown-menu']    = 'inherit';
			$defaults['font-weight-below-header-dropdown-menu']    = 'inherit';
			$defaults['font-size-below-header-dropdown-menu']      = array(
				'desktop'      => '',
				'tablet'       => '',
				'mobile'       => '',
				'desktop-unit' => 'px',
				'tablet-unit'  => 'px',
				'mobile-unit'  => 'px',
			);
			$defaults['text-transform-below-header-dropdown-menu'] = '';

			$defaults['font-family-above-header-dropdown-menu']    = 'inherit';
			$defaults['font-weight-above-header-dropdown-menu']    = 'inherit';
			$defaults['font-size-above-header-dropdown-menu']      = array(
				'desktop'      => '',
				'tablet'       => '',
				'mobile'       => '',
				'desktop-unit' => 'px',
				'tablet-unit'  => 'px',
				'mobile-unit'  => 'px',
			);
			$defaults['text-transform-above-header-dropdown-menu'] = '';

			// Above Header.
			$defaults['above-header-on-mobile'] = true;

			$defaults['above-header-layout']                      = 'disabled';
			$defaults['above-header-section-1']                   = 'text-html';
			$defaults['above-header-section-1-html']              = __( '1-800-000-000 — hello@example.com', 'astra-addon' );
			$defaults['above-header-section-2']                   = 'search';
			$defaults['above-header-section-2-html']              = __( '1-800-000-000 — hello@example.com', 'astra-addon' );
			$defaults['above-header-merge-menu']                  = false;
			$defaults['above-header-divider']                     = 1;
			$defaults['above-header-divider-color']               = '';
			$defaults['above-header-height']                      = 40;
			$defaults['above-header-menu-label']                  = '';
			$defaults['above-header-menu-align']                  = 'stack';
			$defaults['above-header-submenu-container-animation'] = 'fade';

			$defaults['above-header-submenu-border']       = array(
				'top'    => '2',
				'right'  => '0',
				'bottom' => '0',
				'left'   => '0',
			);
			$defaults['above-header-submenu-item-border']  = false;
			$defaults['above-header-submenu-item-b-color'] = '';

			$defaults['above-header-submenu-border-color'] = '';

			// Normal Above Header Background Image & Colors.
			$defaults['above-header-bg-obj']               = array(
				'background-color'      => '',
				'background-image'      => '',
				'background-repeat'     => 'repeat',
				'background-position'   => 'center center',
				'background-size'       => 'auto',
				'background-attachment' => 'scroll',
			);
			$defaults['above-header-text-color']           = '';
			$defaults['above-header-link-color']           = '';
			$defaults['above-header-link-h-color']         = '';
			$defaults['above-header-menu-color']           = '';
			$defaults['above-header-menu-h-color']         = '';
			$defaults['above-header-menu-h-bg-color']      = '';
			$defaults['above-header-menu-active-color']    = '';
			$defaults['above-header-menu-active-bg-color'] = '';

			$defaults['above-header-submenu-text-color']      = '';
			$defaults['above-header-submenu-bg-color']        = '';
			$defaults['above-header-submenu-hover-color']     = '';
			$defaults['above-header-submenu-bg-hover-color']  = '';
			$defaults['above-header-submenu-active-color']    = '';
			$defaults['above-header-submenu-active-bg-color'] = '';

			// Responsive Above Header Background Image & Colors.
			$defaults['above-header-bg-obj-responsive'] = array(
				'desktop' => array(
					'background-color'      => '',
					'background-image'      => '',
					'background-repeat'     => 'repeat',
					'background-position'   => 'center center',
					'background-size'       => 'auto',
					'background-attachment' => 'scroll',
					'background-type'       => '',
					'background-media'      => '',
				),
				'tablet'  => array(
					'background-color'      => '',
					'background-image'      => '',
					'background-repeat'     => 'repeat',
					'background-position'   => 'center center',
					'background-size'       => 'auto',
					'background-attachment' => 'scroll',
					'background-type'       => '',
					'background-media'      => '',
				),
				'mobile'  => array(
					'background-color'      => '',
					'background-image'      => '',
					'background-repeat'     => 'repeat',
					'background-position'   => 'center center',
					'background-size'       => 'auto',
					'background-attachment' => 'scroll',
					'background-type'       => '',
					'background-media'      => '',
				),
			);

			$defaults['above-header-menu-bg-obj-responsive'] = array(
				'desktop' => array(
					'background-color'      => '',
					'background-image'      => '',
					'background-repeat'     => 'repeat',
					'background-position'   => 'center center',
					'background-size'       => 'auto',
					'background-attachment' => 'scroll',
					'background-type'       => '',
					'background-media'      => '',
				),
				'tablet'  => array(
					'background-color'      => '',
					'background-image'      => '',
					'background-repeat'     => 'repeat',
					'background-position'   => 'center center',
					'background-size'       => 'auto',
					'background-attachment' => 'scroll',
					'background-type'       => '',
					'background-media'      => '',
				),
				'mobile'  => array(
					'background-color'      => '',
					'background-image'      => '',
					'background-repeat'     => 'repeat',
					'background-position'   => 'center center',
					'background-size'       => 'auto',
					'background-attachment' => 'scroll',
					'background-type'       => '',
					'background-media'      => '',
				),
			);

			$defaults['above-header-text-color-responsive']           = array(
				'desktop' => '',
				'tablet'  => '',
				'mobile'  => '',
			);
			$defaults['above-header-link-color-responsive']           = array(
				'desktop' => '',
				'tablet'  => '',
				'mobile'  => '',
			);
			$defaults['above-header-link-h-color-responsive']         = array(
				'desktop' => '',
				'tablet'  => '',
				'mobile'  => '',
			);
			$defaults['above-header-menu-color-responsive']           = array(
				'desktop' => '',
				'tablet'  => '',
				'mobile'  => '',
			);
			$defaults['above-header-menu-h-color-responsive']         = array(
				'desktop' => '',
				'tablet'  => '',
				'mobile'  => '',
			);
			$defaults['above-header-menu-h-bg-color-responsive']      = array(
				'desktop' => '',
				'tablet'  => '',
				'mobile'  => '',
			);
			$defaults['above-header-menu-active-color-responsive']    = array(
				'desktop' => '',
				'tablet'  => '',
				'mobile'  => '',
			);
			$defaults['above-header-menu-active-bg-color-responsive'] = array(
				'desktop' => '',
				'tablet'  => '',
				'mobile'  => '',
			);

			$defaults['above-header-submenu-text-color-responsive'] = array(
				'desktop' => '',
				'tablet'  => '',
				'mobile'  => '',
			);

			$defaults['above-header-submenu-bg-color-responsive']        = array(
				'desktop' => '',
				'tablet'  => '',
				'mobile'  => '',
			);
			$defaults['above-header-submenu-hover-color-responsive']     = array(
				'desktop' => '',
				'tablet'  => '',
				'mobile'  => '',
			);
			$defaults['above-header-submenu-bg-hover-color-responsive']  = array(
				'desktop' => '',
				'tablet'  => '',
				'mobile'  => '',
			);
			$defaults['above-header-submenu-active-color-responsive']    = array(
				'desktop' => '',
				'tablet'  => '',
				'mobile'  => '',
			);
			$defaults['above-header-submenu-active-bg-color-responsive'] = array(
				'desktop' => '',
				'tablet'  => '',
				'mobile'  => '',
			);

			$defaults['above-header-font-family']    = 'inherit';
			$defaults['above-header-font-weight']    = 'inherit';
			$defaults['above-header-font-size']      = array(
				'desktop'      => '',
				'tablet'       => '',
				'mobile'       => '',
				'desktop-unit' => 'px',
				'tablet-unit'  => 'px',
				'mobile-unit'  => 'px',
			);
			$defaults['above-header-text-transform'] = '';

			return $defaults;
		}

		/**
		 * Add postMessage support for site title and description for the Theme Customizer.
		 *
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 */
		public function new_customize_register( $wp_customize ) {

			/**
			 * Register Sections & Panels
			 */
			require_once ASTRA_EXT_HEADER_SECTIONS_DIR . 'classes/class-astra-header-section-panels-configs.php';
			/**
			 * Register Partials
			 */
			require_once ASTRA_EXT_HEADER_SECTIONS_DIR . 'classes/class-astra-customizer-header-sections-partials.php';

			if ( astra_addon_existing_header_footer_configs() ) {
				require_once ASTRA_EXT_HEADER_SECTIONS_DIR . 'classes/sections/class-astra-above-header-colors-bg-configs.php';
				require_once ASTRA_EXT_HEADER_SECTIONS_DIR . 'classes/sections/class-astra-above-header-configs.php';
				require_once ASTRA_EXT_HEADER_SECTIONS_DIR . 'classes/sections/class-astra-above-header-typo-configs.php';
				require_once ASTRA_EXT_HEADER_SECTIONS_DIR . 'classes/sections/class-astra-below-header-colors-bg-configs.php';
				require_once ASTRA_EXT_HEADER_SECTIONS_DIR . 'classes/sections/class-astra-below-header-configs.php';
				require_once ASTRA_EXT_HEADER_SECTIONS_DIR . 'classes/sections/class-astra-below-header-typo-configs.php';
			}

		}

		/**
		 * Customizer Preview
		 */
		public function preview_scripts() {

			if ( SCRIPT_DEBUG ) {
				wp_enqueue_script( 'astra-below-header-customize-preview-js', ASTRA_EXT_HEADER_SECTIONS_URL . 'assets/js/unminified/customizer-preview.js', array( 'customize-preview', 'astra-customizer-preview-js' ), ASTRA_EXT_VER, true );
			} else {
				wp_enqueue_script( 'astra-below-header-customize-preview-js', ASTRA_EXT_HEADER_SECTIONS_URL . 'assets/js/minified/customizer-preview.min.js', array( 'customize-preview', 'astra-customizer-preview-js' ), ASTRA_EXT_VER, true );
			}

		}

	}
}

/**
*  Kicking this off by calling 'get_instance()' method
*/
Astra_Ext_Header_Sections_Loader::get_instance();
