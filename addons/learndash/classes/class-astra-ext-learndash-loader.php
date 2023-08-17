<?php
/**
 * LearnDash Loader
 *
 * @package Astra Addon
 */

if ( ! class_exists( 'Astra_Ext_LearnDash_Loader' ) ) {

	/**
	 * Customizer Initialization
	 *
	 * @since 1.3.0
	 */
	// @codingStandardsIgnoreStart
	class Astra_Ext_LearnDash_Loader {
 // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedClassFound
		// @codingStandardsIgnoreEnd

		/**
		 * Member Variable
		 *
		 * @var instance
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

			add_filter( 'astra_theme_defaults', array( $this, 'theme_defaults' ) );
			add_action( 'customize_register', array( $this, 'customize_register_new' ), 2 );

			add_action( 'customize_preview_init', array( $this, 'preview_scripts' ) );
			add_action( 'astra_get_fonts', array( $this, 'add_fonts' ), 1 );

			if ( ! is_admin() ) {
				add_action( 'wp_enqueue_scripts', array( $this, 'add_inline_style' ), 11 );
			}
		}

		/**
		 * Add Font Family Callback
		 *
		 * @return void
		 */
		public function add_fonts() {

			$font_family_table_heading = astra_get_option( 'font-family-learndash-table-heading' );
			$font_weight_table_heading = astra_get_option( 'font-weight-learndash-table-heading' );
			Astra_Fonts::add_font( $font_family_table_heading, $font_weight_table_heading );

			$font_family_table_content = astra_get_option( 'font-family-learndash-table-content' );
			$font_weight_table_content = astra_get_option( 'font-weight-learndash-table-content' );
			Astra_Fonts::add_font( $font_family_table_content, $font_weight_table_content );

		}

		/**
		 * Set Options Default Values
		 *
		 * @param  array $defaults  Astra options default value array.
		 * @return array
		 */
		public function theme_defaults( $defaults ) {

			// Student View.
			$defaults['learndash-profile-link-enabled']      = false;
			$defaults['learndash-profile-link']              = '';
			$defaults['learndash-distraction-free-learning'] = false;

			$defaults['learndash-table-border-radius'] = 0;

			// Colors.
			$defaults['learndash-table-heading-color']         = '';
			$defaults['learndash-table-heading-bg-color']      = '';
			$defaults['learndash-table-title-color']           = '';
			$defaults['learndash-table-title-bg-color']        = '';
			$defaults['learndash-table-title-separator-color'] = '';
			$defaults['learndash-complete-icon-color']         = '';
			$defaults['learndash-incomplete-icon-color']       = '';

			// Table Heading.
			$defaults['font-family-learndash-table-heading']    = 'inherit';
			$defaults['font-weight-learndash-table-heading']    = 'inherit';
			$defaults['text-transform-learndash-table-heading'] = '';
			$defaults['font-size-learndash-table-heading']      = array(
				'desktop'      => '',
				'tablet'       => '',
				'mobile'       => '',
				'desktop-unit' => 'px',
				'tablet-unit'  => 'px',
				'mobile-unit'  => 'px',
			);

			// Table Content.
			$defaults['font-family-learndash-table-content']    = 'inherit';
			$defaults['font-weight-learndash-table-content']    = 'inherit';
			$defaults['text-transform-learndash-table-content'] = '';
			$defaults['font-size-learndash-table-content']      = array(
				'desktop'      => '',
				'tablet'       => '',
				'mobile'       => '',
				'desktop-unit' => 'px',
				'tablet-unit'  => 'px',
				'mobile-unit'  => 'px',
			);

			$defaults['learndash-course-link-color']           = '';
			$defaults['learndash-course-highlight-text-color'] = '';
			$defaults['learndash-course-highlight-color']      = '';
			$defaults['learndash-course-progress-color']       = '';
			$defaults['learndash-overwrite-colors']            = false;

			return $defaults;
		}

		/**
		 * Add postMessage support for site title and description for the Theme Customizer.
		 *
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 */
		public function customize_register_new( $wp_customize ) {

			$active_ld_theme = '';

			if ( is_callable( 'LearnDash_Theme_Register::get_active_theme_key' ) ) {
				$active_ld_theme = LearnDash_Theme_Register::get_active_theme_key();
			}

			if ( 'ld30' !== $active_ld_theme ) {

				require_once ASTRA_ADDON_EXT_LEARNDASH_DIR . 'classes/sections/class-astra-customizer-learndash-general-configs.php';
				require_once ASTRA_ADDON_EXT_LEARNDASH_DIR . 'classes/sections/class-astra-customizer-learndash-typo-configs.php';
			}

			require_once ASTRA_ADDON_EXT_LEARNDASH_DIR . 'classes/sections/class-astra-customizer-learndash-color-configs.php';
		}

		/**
		 * Customizer Controls
		 *
		 * @see 'astra-customizer-preview-js' panel in parent theme
		 */
		public function preview_scripts() {

			if ( SCRIPT_DEBUG ) {
				$js_path = 'assets/js/unminified/customizer-preview.js';
			} else {
				$js_path = 'assets/js/minified/customizer-preview.min.js';
			}

			wp_register_script( 'ast-learndash-customizer-preview', ASTRA_ADDON_EXT_LEARNDASH_URI . $js_path, array( 'customize-preview', 'astra-customizer-preview-js' ), ASTRA_EXT_VER, true );
			wp_enqueue_script( 'ast-learndash-customizer-preview' );
		}

		/**
		 * Append inline style to learndash style.
		 *
		 * @since 1.8.6
		 */
		public function add_inline_style() {

			$custom_style = astra_addon_ldrv3_dynamic_css();

			wp_add_inline_style( 'learndash-front', $custom_style );
		}
	}
}

/**
* Kicking this off by calling 'get_instance()' method
*/
Astra_Ext_LearnDash_Loader::get_instance();
