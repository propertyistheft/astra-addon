<?php
/**
 * Footer Widgets Extension
 *
 * @package Astra Addon
 */

define( 'ASTRA_EXT_ADVANCED_FOOTER_DIR', ASTRA_EXT_DIR . 'addons/advanced-footer/' );
define( 'ASTRA_EXT_ADVANCED_FOOTER_URL', ASTRA_EXT_URI . 'addons/advanced-footer/' );

if ( ! class_exists( 'Astra_Ext_Advanced_Footer' ) ) {

	/**
	 * Footer Widgets Initial Setup
	 *
	 * @since 1.0.0
	 */
	class Astra_Ext_Advanced_Footer {

		/**
		 * Member Variable
		 *
		 * @var object instance
		 */
		private static $instance;

		/**
		 *  Initiator
		 *
		 * @return object
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

			require_once ASTRA_EXT_ADVANCED_FOOTER_DIR . 'classes/class-astra-ext-adv-footer-loader.php';
			require_once ASTRA_EXT_ADVANCED_FOOTER_DIR . 'classes/class-astra-ext-adv-footer-markup.php';

			// Include front end files.
			if ( ! is_admin() ) {
				require_once ASTRA_EXT_ADVANCED_FOOTER_DIR . 'classes/dynamic.css.php';
			}

		}
	}

	/**
	 *  Kicking this off by calling 'get_instance()' method
	 */
	Astra_Ext_Advanced_Footer::get_instance();
}
