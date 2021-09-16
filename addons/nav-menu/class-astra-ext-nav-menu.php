<?php
/**
 * Navigation Menu Extension
 *
 * @package Astra Addon
 */

define( 'ASTRA_EXT_NAV_MENU_DIR', ASTRA_EXT_DIR . 'addons/nav-menu/' );
define( 'ASTRA_EXT_NAV_MENU_URL', ASTRA_EXT_URI . 'addons/nav-menu/' );

if ( ! class_exists( 'Astra_Ext_Nav_Menu' ) ) {

	/**
	 * Footer Widgets Initial Setup
	 *
	 * @since 1.0.0
	 */
	class Astra_Ext_Nav_Menu {

		/**
		 * Member Variable
		 *
		 * @var object instance
		 */
		private static $instance;

		/**
		 *  Initiator
		 *
		 * @return object
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
			require_once ASTRA_EXT_NAV_MENU_DIR . 'classes/class-astra-ext-nav-menu-loader.php';
			require_once ASTRA_EXT_NAV_MENU_DIR . 'classes/class-astra-ext-nav-menu-markup.php';
			require_once ASTRA_EXT_NAV_MENU_DIR . 'classes/class-astra-ext-nav-widget-support.php';
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_astra_target_rules_js' ), 10 );

			if ( ! is_admin() ) {
				if ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) {
					require_once ASTRA_EXT_NAV_MENU_DIR . 'classes/builder-dynamic.css.php';
				} else {
					require_once ASTRA_EXT_NAV_MENU_DIR . 'classes/dynamic.css.php';
				}
			}
		}

		/**
		 * Enqueue Astra Target Rules Fields admin styles js
		 */
		public function enqueue_astra_target_rules_js() {
			if ( 'nav-menus' === get_current_screen()->id ) {
				// Load Target Rule assets.
				Astra_Target_Rules_Fields::get_instance()->admin_styles();
			}
		}
	}

	/**
	 *  Kicking this off by calling 'get_instance()' method
	 */
	Astra_Ext_Nav_Menu::get_instance();
}
