<?php
/**
 * Astra Addon Builder Loader.
 *
 * @package astra-builder
 */

// No direct access, please.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Astra_Addon_Builder_Loader' ) ) {

	/**
	 * Class Astra_Addon_Builder_Loader.
	 */
	final class Astra_Addon_Builder_Loader {

		/**
		 * Member Variable
		 *
		 * @var instance
		 */
		private static $instance = null;

		/**
		 *  Initiator
		 */
		public static function get_instance() {

			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
				do_action( 'astra_addon_builder_loaded' );
			}

			return self::$instance;
		}

		/**
		 * Constructor
		 */
		public function __construct() {

			// @codingStandardsIgnoreStart WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound

			require_once ASTRA_EXT_DIR . 'classes/class-astra-addon-builder-loader.php';

			/**
			 * Builder - Header & Footer Markup.
			 */
			require_once ASTRA_EXT_DIR . 'classes/builder/markup/class-astra-addon-builder-header.php';

			if ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) {

				require_once ASTRA_EXT_DIR . 'classes/builder/markup/class-astra-addon-builder-footer.php';

			}

			/**
			 * Builder Controllers.
			 */
			require_once ASTRA_EXT_DIR . 'classes/builder/type/base/controllers/class-astra-addon-builder-ui-controller.php';
			/**
			 * Customizer - Configs.
			 */
			require_once ASTRA_EXT_DIR . 'classes/builder/class-astra-addon-builder-customizer.php';
			require_once ASTRA_EXT_DIR . 'classes/builder/type/base/dynamic-css/class-astra-addon-base-dynamic-css.php';
		}
	}

	/**
	 *  Prepare if class 'Astra_Addon_Builder_Loader' exist.
	 *  Kicking this off by calling 'get_instance()' method
	 */
	Astra_Addon_Builder_Loader::get_instance();
}
