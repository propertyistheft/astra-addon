<?php
/**
 * Advanced Header Extension
 *
 * @package Astra Addon
 */

define( 'ASTRA_EXT_HEADER_SECTIONS_DIR', ASTRA_EXT_DIR . 'addons/header-sections/' );
define( 'ASTRA_EXT_HEADER_SECTIONS_URL', ASTRA_EXT_URI . 'addons/header-sections/' );

if ( ! class_exists( 'Astra_Ext_Header_Sections' ) ) {

	/**
	 * Advanced Header Initial Setup
	 *
	 * @since 1.0.0
	 */
	class Astra_Ext_Header_Sections {

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
		 * Constructor function that initializes required actions and hooks
		 */
		public function __construct() {

			if ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) {
				return;
			}

			require_once ASTRA_EXT_HEADER_SECTIONS_DIR . 'classes/class-astra-ext-header-sections-loader.php';
			require_once ASTRA_EXT_HEADER_SECTIONS_DIR . 'classes/class-astra-ext-header-sections-markup.php';

			// Include front end files.
			if ( ! is_admin() ) {
				require_once ASTRA_EXT_HEADER_SECTIONS_DIR . 'classes/above-header-dynamic.css.php';
				require_once ASTRA_EXT_HEADER_SECTIONS_DIR . 'classes/below-header-dynamic.css.php';
			}
		}
	}

	/**
	 *  Kicking this off by calling 'get_instance()' method
	 */
	Astra_Ext_Header_Sections::get_instance();
}
