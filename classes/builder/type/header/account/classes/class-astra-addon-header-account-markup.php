<?php
/**
 * Header Account Markup
 *
 * @package Astra Addon
 */

if ( ! class_exists( 'Astra_Addon_Header_Account_Markup' ) ) {

	/**
	 * Header Account Markup Initial Setup
	 *
	 * @since 4.3.1
	 */
	class Astra_Addon_Header_Account_Markup {

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
		 * Constructor
		 */
		public function __construct() {
			add_filter( 'astra_addon_js_localize', array( $this, 'localize_variables' ) );  
		}

		/**
		 * Add Localize variables
		 *
		 * @since 4.3.1
		 * @param  array $localize_vars Localize variables array.
		 * @return array
		 */
		public function localize_variables( $localize_vars ) {

			$localize_vars['hf_account_show_menu_on'] = astra_get_option( 'header-account-action-menu-display-on' );
			$localize_vars['hf_account_action_type']  = astra_get_option( 'header-account-action-type' );

			return $localize_vars;
		}
	}
}

/**
 *  Kicking this off by calling 'get_instance()' method
 */
Astra_Addon_Header_Account_Markup::get_instance();
