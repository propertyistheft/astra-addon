<?php
/**
 * Ubermenu Compatibility File.
 *
 * @link https://Ubermenu.me/
 * @since  1.1.7
 *
 * @package Astra
 */

/**
 * Astra Ubermenu Compatibility
 */
if ( ! class_exists( 'Astra_UberMenu_Pro' ) ) :

	/**
	 * Astra Ubermenu Compatibility
	 *
	 * @since 1.0.0
	 */
	class Astra_UberMenu_Pro {

		/**
		 * Member Variable
		 *
		 * @var object instance
		 */
		private static $instance;

		/**
		 * Initiator
		 *
		 * @since  1.1.7
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 * Constructor
		 *
		 * @since  1.1.7
		 */
		public function __construct() {

			add_action( 'after_setup_theme', array( $this, 'disable_above_below_header_toggle' ), 10 );

		}

		/**
		 * Disable the Mobile Menu toggles from Astra if Uber Menu is used.
		 *
		 * @since  1.1.7
		 */
		public function disable_above_below_header_toggle() {

			// Don't overrde anythign if ubermenu's function is not present.
			if ( ! function_exists( 'ubermenu_get_menu_instance_by_theme_location' ) ) {
				return;
			}

			if ( ! class_exists( 'Astra_Ext_Header_Sections_Markup' ) ) {
				return;
			}

			$hs_class = Astra_Ext_Header_Sections_Markup::get_instance();

			$ubermenu_above_header = ubermenu_get_menu_instance_by_theme_location( 'above_header_menu' );
			$ubermenu_below_header = ubermenu_get_menu_instance_by_theme_location( 'below_header_menu' );

			if ( '' !== $ubermenu_above_header && false != $ubermenu_above_header ) {
				remove_action( 'astra_above_header_toggle_buttons', array( $hs_class, 'above_header_toggle_button' ), 10 );
			}

			if ( '' !== $ubermenu_below_header && false != $ubermenu_below_header ) {
				remove_action( 'astra_below_header_toggle_buttons', array( $hs_class, 'below_header_toggle_button' ), 11 );
			}
		}
	}

endif;

/**
 * Kicking this off by calling 'get_instance()' method
 */
Astra_UberMenu_Pro::get_instance();
