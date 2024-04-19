<?php
/**
 * WooCommerce - Customizer Partials.
 *
 * @package Astra Addon
 * @since 1.1.0
 */

// No direct access, please.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Astra_Customizer_Ext_WooCommerce_Partials' ) ) {

	/**
	 * Astra_Customizer_Ext_WooCommerce_Partials initial setup
	 *
	 * @since 1.1.0
	 */
	// @codingStandardsIgnoreStart
	class Astra_Customizer_Ext_WooCommerce_Partials {
 // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedClassFound
		// @codingStandardsIgnoreEnd

		/**
		 * Member Variable
		 *
		 * @var instance
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
		 * Constructor
		 */
		public function __construct() { }

		/**
		 * Render the Below Header Section 1 for the selective refresh partial.
		 *
		 * @since 1.1.0
		 */
		public static function _render_shop_load_more() { // phpcs:ignore PSR2.Methods.MethodDeclaration.Underscore
			return astra_get_option( 'shop-load-more-text' );
		}
	}
}
