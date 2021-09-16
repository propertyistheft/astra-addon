<?php
/**
 * Typography Extension
 *
 * @package Astra Addon
 */

define( 'ASTRA_EXT_WOOCOMMERCE_DIR', ASTRA_EXT_DIR . 'addons/woocommerce/' );
define( 'ASTRA_EXT_WOOCOMMERCE_URI', ASTRA_EXT_URI . 'addons/woocommerce/' );

if ( ! class_exists( 'Astra_Ext_WooCommerce' ) ) {

	/**
	 * Typography Initial Setup
	 *
	 * @since 1.0.0
	 */
	class Astra_Ext_WooCommerce {

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
			if ( class_exists( 'WooCommerce' ) ) {

				require_once ASTRA_EXT_WOOCOMMERCE_DIR . 'classes/common-functions.php';
				require_once ASTRA_EXT_WOOCOMMERCE_DIR . 'classes/class-astra-ext-woocommerce-markup.php';
				require_once ASTRA_EXT_WOOCOMMERCE_DIR . 'classes/class-astra-ext-woocommerce-loader.php';

				// Include front end files.
				if ( ! is_admin() ) {
					require_once ASTRA_EXT_WOOCOMMERCE_DIR . 'classes/dynamic.css.php';
				}
			}

		}
	}

	/**
	 *  Kicking this off by calling 'get_instance()' method
	 */
	Astra_Ext_WooCommerce::get_instance();

}

