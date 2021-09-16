<?php
/**
 * Advanced Search Extension
 *
 * @package Astra Addon
 */

define( 'ASTRA_EXT_ADVANCED_SEARCH_DIR', ASTRA_EXT_DIR . 'addons/advanced-search/' );
define( 'ASTRA_EXT_ADVANCED_SEARCH_URL', ASTRA_EXT_URI . 'addons/advanced-search/' );

if ( ! class_exists( 'Astra_Ext_Advanced_Search' ) ) {

	/**
	 * Advanced Search Initial Setup
	 *
	 * @since 1.4.8
	 */
	class Astra_Ext_Advanced_Search {

		/**
		 * Member Variable
		 *
		 * @var object instance
		 * @since 1.4.8
		 */
		private static $instance;

		/**
		 * Initiator
		 *
		 * @since 1.4.8
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 * Constructor function that initializes required actions and hooks
		 *
		 * @since 1.4.8
		 */
		public function __construct() {
			require_once ASTRA_EXT_ADVANCED_SEARCH_DIR . 'classes/class-astra-ext-adv-search-loader.php';
			require_once ASTRA_EXT_ADVANCED_SEARCH_DIR . 'classes/class-astra-ext-adv-search-markup.php';
			require_once ASTRA_EXT_ADVANCED_SEARCH_DIR . 'classes/class-astra-ext-adv-search-shortcodes.php';
			if ( false === Astra_Icons::is_svg_icons() ) {
				require_once ASTRA_EXT_ADVANCED_SEARCH_DIR . 'classes/dynamic.css.php';
			}
			if ( version_compare( ASTRA_THEME_VERSION, '3.2.0', '<' ) ) {
				require_once ASTRA_EXT_ADVANCED_SEARCH_DIR . 'dynamic.css.php';
			}
		}
	}

	/**
	 * Kicking this off by calling 'get_instance()' method
	 */
	Astra_Ext_Advanced_Search::get_instance();
}
