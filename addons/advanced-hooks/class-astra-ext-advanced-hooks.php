<?php
/**
 * Advanced Hooks Bar Extension
 *
 * @package Astra Addon
 */

define( 'ASTRA_EXT_ADVANCED_HOOKS_DIR', ASTRA_EXT_DIR . 'addons/advanced-hooks/' );
define( 'ASTRA_EXT_ADVANCED_HOOKS_URL', ASTRA_EXT_URI . 'addons/advanced-hooks/' );
define( 'ASTRA_ADVANCED_HOOKS_POST_TYPE', 'astra-advanced-hook' );

if ( ! class_exists( 'Astra_Ext_Advanced_Hooks' ) ) {

	/**
	 * Advanced Hooks Initial Setup
	 *
	 * @since 1.0.0
	 */
	class Astra_Ext_Advanced_Hooks {


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
			require_once ASTRA_EXT_ADVANCED_HOOKS_DIR . 'classes/class-astra-wp-block-parser.php';
			require_once ASTRA_EXT_ADVANCED_HOOKS_DIR . 'classes/class-astra-ext-advanced-hooks-loader.php';
			require_once ASTRA_EXT_ADVANCED_HOOKS_DIR . 'classes/class-astra-ext-advanced-hooks-markup.php';
			require_once ASTRA_EXT_ADVANCED_HOOKS_DIR . 'classes/class-astra-ext-advanced-hooks-meta.php';
			require_once ASTRA_EXT_ADVANCED_HOOKS_DIR . 'classes/ext-advanced-hooks-dynamic.css.php';
		}
	}

	/**
	 *  Kicking this off by calling 'get_instance()' method
	 */
	Astra_Ext_Advanced_Hooks::get_instance();

}
