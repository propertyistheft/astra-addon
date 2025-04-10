<?php
/**
 * Astra Addon Update
 *
 * @package Astra Addon
 */

if ( ! class_exists( 'Astra_Addon_Update' ) ) {

	/**
	 * Astra_Addon_Update initial setup
	 *
	 * @since 1.0.0
	 */
	class Astra_Addon_Update {
		/**
		 * Class instance.
		 *
		 * @var Class $instance instance.
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
		 *  Constructor
		 */
		public function __construct() {

			// Theme Updates.
			add_action( 'astra_update_before', self::class . '::init' );
		}

		/**
		 * Implement addon update logic.
		 *
		 * @since 1.0.0
		 * @return void
		 */
		public static function init() {

			do_action( 'astra_addon_update_before' );

			// Get auto saved version number.
			$saved_version = self::astra_addon_stored_version();

			// If there is no saved version in the database then return.
			if ( false === $saved_version ) {
				return;
			}

			// If equals then return.
			if ( version_compare( $saved_version, ASTRA_EXT_VER, '=' ) ) {
				return;
			}
		}

		/**
		 * Return Astra Addon saved version.
		 */
		public static function astra_addon_stored_version() {

			$theme_options = get_option( 'astra-settings' );

			return isset( $theme_options['astra-addon-auto-version'] ) && '' !== $theme_options['astra-addon-auto-version'] ? $theme_options['astra-addon-auto-version'] : false;
		}
	}
}

/**
 * Kicking this off by calling 'get_instance()' method
 */
Astra_Addon_Update::get_instance();
