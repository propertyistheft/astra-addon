<?php
/**
 * Typography Extension
 *
 * @package Astra Addon
 */

define( 'ASTRA_EXT_EDD_DIR', ASTRA_EXT_DIR . 'addons/edd/' );
define( 'ASTRA_EXT_EDD_URI', ASTRA_EXT_URI . 'addons/edd/' );

if ( ! class_exists( 'Astra_Ext_Edd' ) ) {

	/**
	 * Typography Initial Setup
	 *
	 * @since 1.6.10
	 */
	class Astra_Ext_Edd {

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

			// If plugin - 'WooCommerce' not exist then return.
			if ( class_exists( 'Easy_Digital_Downloads' ) ) {

				require_once ASTRA_EXT_EDD_DIR . 'classes/common-functions.php';
				require_once ASTRA_EXT_EDD_DIR . 'classes/class-astra-ext-edd-markup.php';
				require_once ASTRA_EXT_EDD_DIR . 'classes/class-astra-ext-edd-loader.php';

				// Include front end files.
				if ( ! is_admin() ) {
					require_once ASTRA_EXT_EDD_DIR . 'classes/dynamic.css.php';
				}
			}

		}
	}


}


if ( apply_filters( 'astra_enable_edd_integration', true ) ) {
	/**
	 *  Kicking this off by calling 'get_instance()' method
	 */
	Astra_Ext_Edd::get_instance();
}
