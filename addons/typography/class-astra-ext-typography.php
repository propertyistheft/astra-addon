<?php
/**
 * Typography Extension
 *
 * @package Astra Addon
 */

define( 'ASTRA_ADDON_EXT_TYPOGRAPHY_DIR', ASTRA_EXT_DIR . 'addons/typography/' );
define( 'ASTRA_ADDON_EXT_TYPOGRAPHY_URI', ASTRA_EXT_URI . 'addons/typography/' );

if ( ! class_exists( 'Astra_Ext_Typography' ) ) {

	/**
	 * Typography Initial Setup
	 *
	 * @since 1.0.0
	 */
	// @codingStandardsIgnoreStart
	class Astra_Ext_Typography {
 // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedClassFound
		// @codingStandardsIgnoreEnd

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

			require_once ASTRA_ADDON_EXT_TYPOGRAPHY_DIR . 'classes/class-astra-ext-typography-loader.php';

			// Include front end files.
			if ( ! is_admin() ) {
				require_once ASTRA_ADDON_EXT_TYPOGRAPHY_DIR . 'classes/dynamic.css.php';
			}

		}
	}

	/**
	 *  Kicking this off by calling 'get_instance()' method
	 */
	Astra_Ext_Typography::get_instance();

}

