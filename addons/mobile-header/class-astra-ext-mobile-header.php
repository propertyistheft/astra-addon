<?php
/**
 * Mobile Header Extension
 *
 * @package Astra Addon
 */

define( 'ASTRA_EXT_MOBILE_HEADER_DIR', ASTRA_EXT_DIR . 'addons/mobile-header/' );
define( 'ASTRA_EXT_MOBILE_HEADER_URL', ASTRA_EXT_URI . 'addons/mobile-header/' );

if ( ! class_exists( 'Astra_Ext_Mobile_Header' ) ) {

	/**
	 * Mobile Header Initial Setup
	 *
	 * @since 1.4.0
	 */
	class Astra_Ext_Mobile_Header {

		/**
		 * Member Variable
		 *
		 * @var object instance
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

			require_once ASTRA_EXT_MOBILE_HEADER_DIR . 'classes/class-astra-ext-mobile-header-loader.php';
			require_once ASTRA_EXT_MOBILE_HEADER_DIR . 'classes/class-astra-ext-mobile-header-markup.php';

			// Include front end files.
			if ( ! is_admin() ) {
				require_once ASTRA_EXT_MOBILE_HEADER_DIR . 'classes/dynamic-css/dynamic.css.php';
				// Check Header Sections is activated.
				if ( Astra_Ext_Extension::is_active( 'header-sections' ) ) {
					// Dynamic css dependent on Header Sections.
					require_once ASTRA_EXT_MOBILE_HEADER_DIR . 'classes/dynamic-css/dynamic-above-header.css.php';
					require_once ASTRA_EXT_MOBILE_HEADER_DIR . 'classes/dynamic-css/dynamic-below-header.css.php';
				}
				if ( Astra_Ext_Extension::is_active( 'colors-and-background' ) ) {
					// Dynamic css dependent on Colors and Backgorund.
					require_once ASTRA_EXT_MOBILE_HEADER_DIR . 'classes/dynamic-css/dynamic-colors-background.css.php';
				}
				if ( Astra_Ext_Extension::is_active( 'spacing' ) ) {
					// Dynamic css dependent on Spacing.
					require_once ASTRA_EXT_MOBILE_HEADER_DIR . 'classes/dynamic-css/dynamic-spacing.css.php';
				}
			}

		}
	}

	/**
	 *  Kicking this off by calling 'get_instance()' method
	 */
	Astra_Ext_Mobile_Header::get_instance();

}
