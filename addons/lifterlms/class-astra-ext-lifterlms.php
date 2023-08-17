<?php
/**
 * Typography Extension
 *
 * @package Astra Addon
 */

define( 'ASTRA_ADDON_EXT_LIFTERLMS_DIR', ASTRA_EXT_DIR . 'addons/lifterlms/' );
define( 'ASTRA_ADDON_EXT_LIFTERLMS_URI', ASTRA_EXT_URI . 'addons/lifterlms/' );

if ( ! class_exists( 'Astra_Ext_LifterLMS' ) ) {

	/**
	 * Typography Initial Setup
	 *
	 * @since 1.0.0
	 */
	// @codingStandardsIgnoreStart
	class Astra_Ext_LifterLMS {
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

			// If plugin - 'LifterLMS' not exist then return.
			if ( class_exists( 'LifterLMS' ) ) {

				require_once ASTRA_ADDON_EXT_LIFTERLMS_DIR . 'classes/class-astra-ext-lifterlms-markup.php';
				require_once ASTRA_ADDON_EXT_LIFTERLMS_DIR . 'classes/class-astra-ext-lifterlms-loader.php';

				// Include front end files.
				if ( ! is_admin() ) {
					require_once ASTRA_ADDON_EXT_LIFTERLMS_DIR . 'classes/dynamic.css.php';
				}
			}

		}
	}

	/**
	 *  Kicking this off by calling 'get_instance()' method
	 */
	Astra_Ext_LifterLMS::get_instance();

}

