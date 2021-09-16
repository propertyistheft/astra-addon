<?php
/**
 * Scroll To Top Extension
 *
 * @package Astra Addon
 */

define( 'ASTRA_EXT_SCROLL_TO_TOP_DIR', ASTRA_EXT_DIR . 'addons/scroll-to-top/' );
define( 'ASTRA_EXT_SCROLL_TO_TOP_URL', ASTRA_EXT_URI . 'addons/scroll-to-top/' );

if ( ! class_exists( 'Astra_Ext_Scroll_To_Top' ) ) {

	/**
	 * Scroll To Top Initial Setup
	 *
	 * @since 1.0.0
	 */
	class Astra_Ext_Scroll_To_Top {

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

			require_once ASTRA_EXT_SCROLL_TO_TOP_DIR . 'classes/class-astra-ext-scroll-to-top-loader.php';
			require_once ASTRA_EXT_SCROLL_TO_TOP_DIR . 'classes/class-astra-ext-scroll-to-top-markup.php';

			// Include front end files.
			if ( ! is_admin() ) {
				require_once ASTRA_EXT_SCROLL_TO_TOP_DIR . 'classes/dynamic.css.php';
			}

		}
	}

	/**
	 *  Kicking this off by calling 'get_instance()' method
	 */
	Astra_Ext_Scroll_To_Top::get_instance();

}
