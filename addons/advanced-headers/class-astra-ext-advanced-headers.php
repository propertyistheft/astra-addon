<?php
/**
 * Advanced Headers Bar Extension
 *
 * @package Astra Addon
 */

define( 'ASTRA_EXT_ADVANCED_HEADERS_DIR', ASTRA_EXT_DIR . 'addons/advanced-headers/' );
define( 'ASTRA_EXT_ADVANCED_HEADERS_URL', ASTRA_EXT_URI . 'addons/advanced-headers/' );

if ( ! class_exists( 'Astra_Ext_Advanced_Headers' ) ) {

	/**
	 * Advanced Headers Initial Setup
	 *
	 * @since 1.0.0
	 */
	class Astra_Ext_Advanced_Headers {


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
			require_once ASTRA_EXT_ADVANCED_HEADERS_DIR . 'classes/class-astra-ext-advanced-headers-loader.php';
			require_once ASTRA_EXT_ADVANCED_HEADERS_DIR . 'classes/class-astra-ext-advanced-headers-markup.php';
			require_once ASTRA_EXT_ADVANCED_HEADERS_DIR . 'classes/class-astra-ext-advanced-headers-meta.php';
			require_once ASTRA_EXT_ADVANCED_HEADERS_DIR . 'compatibility/class-astra-advanced-headers-subtitles.php';
			require_once ASTRA_EXT_ADVANCED_HEADERS_DIR . 'classes/class-astra-ext-header-sections-markup-compatibility.php';

			// Include front end files.
			if ( ! is_admin() ) {
				require_once ASTRA_EXT_ADVANCED_HEADERS_DIR . 'classes/dynamic.css.php';
			}

		}
	}

	/**
	 *  Kicking this off by calling 'get_instance()' method
	 */
	Astra_Ext_Advanced_Headers::get_instance();

}
