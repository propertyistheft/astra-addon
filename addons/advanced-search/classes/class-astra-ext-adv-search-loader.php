<?php
/**
 * Advanced Search - Customizer.
 *
 * @package Astra Addon
 * @since 1.4.8
 */

if ( ! class_exists( 'Astra_Ext_Adv_Search_Loader' ) ) {

	/**
	 * Customizer Initialization
	 *
	 * @since 1.4.8
	 */
	// @codingStandardsIgnoreStart
	class Astra_Ext_Adv_Search_Loader {
		// @codingStandardsIgnoreEnd

		/**
		 * Member Variable
		 *
		 * @since 1.4.8
		 * @var instance
		 */
		private static $instance;

		/**
		 * Initiator
		 *
		 * @since 1.4.8
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 * Constructor
		 *
		 * @since 1.4.8
		 */
		public function __construct() {
			add_filter( 'astra_theme_defaults', array( $this, 'theme_defaults' ) );
			add_action( 'customize_register', array( $this, 'new_customize_register' ), 2 );
		}

		/**
		 * Set Options Default Values
		 *
		 * @since 1.4.8
		 * @param  array $defaults  Astra options default value array.
		 * @return array
		 */
		public function theme_defaults( $defaults ) {

			/**
			 * Header Builder > Search style.
			 */
			$defaults['header-search-box-type']        = 'slide-search';
			$defaults['header-search-icon']            = array(
				'type'  => 'search', // Could be icon name, `icon-library` or `custom`.
				'value' => 'search', // Could be icon name for `icon-library` or svg code for `custom` type.
			);
			$defaults['fullsearch-modal-color-mode']   = 'dark';
			$defaults['full-screen-modal-heading']     = true;
			$defaults['fullscreen-modal-heading-text'] = astra_default_strings( 'string-full-width-search-message', false );
			$defaults['header-search-box-placeholder'] = __( 'Search...', 'astra-addon' );

			/**
			 * Astra default header > Search style.
			 */
			$defaults['header-main-rt-section-search-box-type'] = 'slide-search';
			$defaults['below-header-section-2-search-box-type'] = 'slide-search';
			$defaults['below-header-section-1-search-box-type'] = 'slide-search';
			$defaults['above-header-section-1-search-box-type'] = 'slide-search';
			$defaults['above-header-section-2-search-box-type'] = 'slide-search';

			return $defaults;
		}

		/**
		 * Add postMessage support for site title and description for the Theme Customizer.
		 *
		 * @since 1.4.8
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 */
		public function new_customize_register( $wp_customize ) {
			if ( astra_addon_existing_header_footer_configs() ) {
				// Sections.
				require_once ASTRA_ADDON_EXT_ADVANCED_SEARCH_DIR . 'classes/sections/class-astra-customizer-adv-search-header.php';
				require_once ASTRA_ADDON_EXT_ADVANCED_SEARCH_DIR . 'classes/sections/class-astra-customizer-adv-search-above-header.php';
				require_once ASTRA_ADDON_EXT_ADVANCED_SEARCH_DIR . 'classes/sections/class-astra-customizer-adv-search-below-header.php';
			} else {
				require_once ASTRA_ADDON_EXT_ADVANCED_SEARCH_DIR . 'classes/sections/class-astra-customizer-adv-search-configs.php';
			}
		}
	}
}

/**
 *  Kicking this off by calling 'get_instance()' method
 */
Astra_Ext_Adv_Search_Loader::get_instance();
