<?php
/**
 * Footer Widgets - Customizer.
 *
 * @package Astra Addon
 * @since 1.0.0
 */

if ( ! class_exists( 'Astra_Ext_Adv_Footer_Loader' ) ) {

	/**
	 * Customizer Initialization
	 *
	 * @since 1.0.0
	 */
	// @codingStandardsIgnoreStart
	class Astra_Ext_Adv_Footer_Loader {
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

			$defaults['footer-adv']                            = 'disabled';
			$defaults['footer-adv-area-padding']               = array(
				'desktop' => array(
					'top'    => '70',
					'right'  => '',
					'bottom' => '70',
					'left'   => '',
				),
				'tablet'  => array(
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
				),
				'mobile'  => array(
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
				),
			);
			$defaults['footer-adv-layout-width']               = 'content';
			$defaults['footer-adv-text-color']                 = '';
			$defaults['footer-adv-link-color']                 = '';
			$defaults['footer-adv-link-h-color']               = '';
			$defaults['footer-adv-wgt-title-color']            = '';
			$defaults['footer-adv-wgt-title-font-family']      = 'inherit';
			$defaults['footer-adv-wgt-title-font-weight']      = 'inherit';
			$defaults['footer-adv-wgt-title-text-transform']   = '';
			$defaults['footer-adv-wgt-title-line-height']      = '';
			$defaults['footer-adv-wgt-title-font-size']        = array(
				'desktop'      => '',
				'tablet'       => '',
				'mobile'       => '',
				'desktop-unit' => 'px',
				'tablet-unit'  => 'px',
				'mobile-unit'  => 'px',
			);
			$defaults['footer-adv-wgt-content-font-family']    = 'inherit';
			$defaults['footer-adv-wgt-content-font-weight']    = 'inherit';
			$defaults['footer-adv-wgt-content-text-transform'] = '';
			$defaults['footer-adv-wgt-content-line-height']    = '';
			$defaults['footer-adv-wgt-content-font-size']      = array(
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
		 * Add postMessage support for site title and description for the Theme Customizer.
		 *
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 */
		public function new_customize_register( $wp_customize ) {
			/**
			 * Register Sections & Panels
			 */
			require_once ASTRA_ADDON_EXT_ADVANCED_FOOTER_DIR . 'classes/class-astra-advanced-footer-panels-configs.php';

			/**
			 * Sections
			 */
			if ( astra_addon_existing_header_footer_configs() ) {
				require_once ASTRA_ADDON_EXT_ADVANCED_FOOTER_DIR . 'classes/sections/class-astra-advanced-footer-configs.php';
				require_once ASTRA_ADDON_EXT_ADVANCED_FOOTER_DIR . 'classes/sections/class-astra-advanced-footer-typo-configs.php';
			}
		}

		/**
		 * Customizer Preview
		 */
		public function preview_scripts() {

			if ( SCRIPT_DEBUG ) {
				wp_enqueue_script( 'astra-ext-footer-adv-customize-preview-js', ASTRA_ADDON_EXT_ADVANCED_FOOTER_URL . 'assets/js/unminified/customizer-preview.js', array( 'customize-preview', 'astra-customizer-preview-js' ), ASTRA_EXT_VER, true );
			} else {
				wp_enqueue_script( 'astra-ext-footer-adv-customize-preview-js', ASTRA_ADDON_EXT_ADVANCED_FOOTER_URL . 'assets/js/minified/customizer-preview.min.js', array( 'customize-preview', 'astra-customizer-preview-js' ), ASTRA_EXT_VER, true );
			}
		}
	}
}

/**
*  Kicking this off by calling 'get_instance()' method
*/
Astra_Ext_Adv_Footer_Loader::get_instance();
