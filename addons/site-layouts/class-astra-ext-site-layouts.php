<?php
/**
 * Site Layouts Extension
 *
 * @package Astra Addon
 */

define( 'ASTRA_ADDON_EXT_SITE_LAYOUTS_DIR', ASTRA_EXT_DIR . 'addons/site-layouts/' );
define( 'ASTRA_ADDON_EXT_SITE_LAYOUTS_URL', ASTRA_EXT_URI . 'addons/site-layouts/' );

if ( ! class_exists( 'Astra_Ext_Site_Layouts' ) ) {

	/**
	 * Above Header Initial Setup
	 *
	 * @since 1.0.0
	 */
	// @codingStandardsIgnoreStart
	class Astra_Ext_Site_Layouts {
 // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedClassFound
		// @codingStandardsIgnoreEnd

		/**
		 * Member Variable
		 *
		 * @var object instance
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
		 * Constructor function that initializes required actions and hooks
		 */
		public function __construct() {

			require_once ASTRA_ADDON_EXT_SITE_LAYOUTS_DIR . 'classes/class-astra-ext-site-layouts-loader.php';
			require_once ASTRA_ADDON_EXT_SITE_LAYOUTS_DIR . 'classes/class-astra-ext-site-layouts-markup.php';

			// Include front end files.
			if ( ! is_admin() ) {
				require_once ASTRA_ADDON_EXT_SITE_LAYOUTS_DIR . 'classes/dynamic.css.php';
			}
		}
	}

	/**
	 * Kicking this off by calling 'get_instance()' method
	 */
	Astra_Ext_Site_Layouts::get_instance();

}
