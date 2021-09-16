<?php
/**
 * Typography Extension
 *
 * @package Astra Addon
 */

define( 'ASTRA_EXT_LEARNDASH_DIR', ASTRA_EXT_DIR . 'addons/learndash/' );
define( 'ASTRA_EXT_LEARNDASH_URI', ASTRA_EXT_URI . 'addons/learndash/' );

if ( ! class_exists( 'Astra_Ext_LearnDash' ) ) {

	/**
	 * Typography Initial Setup
	 *
	 * @since 1.3.0
	 */
	class Astra_Ext_LearnDash {

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

			// If plugin - 'LearnDash' not exist then return.
			if ( class_exists( 'SFWD_LMS' ) ) {

				require_once ASTRA_EXT_LEARNDASH_DIR . 'classes/class-astra-ext-learndash-markup.php';
				require_once ASTRA_EXT_LEARNDASH_DIR . 'classes/class-astra-ext-learndash-loader.php';

				// Include front end files.
				if ( ! is_admin() ) {
					require_once ASTRA_EXT_LEARNDASH_DIR . 'classes/dynamic.css.php';
				}
			}

		}
	}

}


if ( apply_filters( 'astra_enable_learndash_integration', true ) ) {

	/**
	 * Kicking this off by calling 'get_instance()' method
	 */
	Astra_Ext_LearnDash::get_instance();
}
