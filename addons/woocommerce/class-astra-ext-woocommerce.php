<?php
/**
 * Typography Extension
 *
 * @package Astra Addon
 */

define( 'ASTRA_ADDON_EXT_WOOCOMMERCE_DIR', ASTRA_EXT_DIR . 'addons/woocommerce/' );
define( 'ASTRA_ADDON_EXT_WOOCOMMERCE_URI', ASTRA_EXT_URI . 'addons/woocommerce/' );

if ( ! class_exists( 'Astra_Ext_WooCommerce' ) ) {

	/**
	 * Typography Initial Setup
	 *
	 * @since 1.0.0
	 */
	// @codingStandardsIgnoreStart
	class Astra_Ext_WooCommerce {
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

			// If plugin - 'WooCommerce' not exist then return.
			if ( class_exists( 'WooCommerce' ) ) {

				require_once ASTRA_ADDON_EXT_WOOCOMMERCE_DIR . 'classes/common-functions.php';
				require_once ASTRA_ADDON_EXT_WOOCOMMERCE_DIR . 'classes/class-astra-ext-woocommerce-markup.php';
				require_once ASTRA_ADDON_EXT_WOOCOMMERCE_DIR . 'classes/class-astra-ext-woocommerce-loader.php';

				// Include front end files.
				if ( ! is_admin() ) {
					require_once ASTRA_ADDON_EXT_WOOCOMMERCE_DIR . 'classes/dynamic.css.php';
				}
			}
		}

		/**
		 * Check if modern WooCOmmerce setup is being activated for new users.
		 * Update defaults once user activates Astra Addon.
		 *
		 * @return bool true|false
		 * @since 3.9.0
		 */
		public static function astra_addon_enable_modern_ecommerce_setup() {
			$theme_options = get_option( 'astra-settings', array() );
			return apply_filters( 'astra_get_option_modern-ecommerce-setup', isset( $theme_options['modern-ecommerce-setup'] ) ? false : true ); // phpcs:ignore WordPress.NamingConventions.ValidHookName.UseUnderscores
		}
	}

	/**
	 *  Kicking this off by calling 'get_instance()' method
	 */
	Astra_Ext_WooCommerce::get_instance();

}

