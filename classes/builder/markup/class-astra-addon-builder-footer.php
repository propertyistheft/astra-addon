<?php
/**
 * Astra Builder Loader.
 *
 * @package astra-builder
 */

// No direct access, please.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Astra_Addon_Builder_Footer' ) ) {

	/**
	 * Class Astra_Addon_Builder_Footer.
	 */
	final class Astra_Addon_Builder_Footer {

		/**
		 * Member Variable
		 *
		 * @var instance
		 */
		private static $instance = null;

		/**
		 * Dynamic Methods.
		 *
		 * @var dynamic methods
		 */
		private static $methods = array();

		/**
		 *  Initiator
		 */
		public static function get_instance() {

			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		/**
		 * Constructor
		 */
		public function __construct() {

			$component_limit = astra_addon_builder_helper()->component_limit;
			for ( $index = 1; $index <= $component_limit; $index++ ) {
				add_action( 'astra_footer_divider_' . $index, array( $this, 'footer_divider_' . $index ) );
				self::$methods[] = 'footer_divider_' . $index;
			}

			add_action( 'astra_footer_language_switcher', array( $this, 'footer_language_switcher' ) );
		}

		/**
		 * Callback when method not exists.
		 *
		 * @param  string $func function name.
		 * @param array  $params function parameters.
		 */
		public function __call( $func, $params ) {

			if ( in_array( $func, self::$methods, true ) ) {

				if ( 0 === strpos( $func, 'footer_divider_' ) ) {

					$index = (int) substr( $func, strrpos( $func, '_' ) + 1 );

					if ( $index ) {
						Astra_Addon_Builder_UI_Controller::render_divider_markup( str_replace( '_', '-', $func ) );
					}
				}
			}
		}

		/**
		 * Render language switcher.
		 */
		public function footer_language_switcher() {
			Astra_Addon_Builder_UI_Controller::render_language_switcher_markup( 'footer-language-switcher', 'footer' );
		}
	}

	/**
	 *  Prepare if class 'Astra_Addon_Builder_Footer' exist.
	 *  Kicking this off by calling 'get_instance()' method
	 */
	Astra_Addon_Builder_Footer::get_instance();
}
