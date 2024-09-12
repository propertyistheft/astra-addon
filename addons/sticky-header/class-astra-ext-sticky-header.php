<?php
/**
 * Sticky Header Extension
 *
 * @package Astra Addon
 */

define( 'ASTRA_ADDON_EXT_STICKY_HEADER_DIR', ASTRA_EXT_DIR . 'addons/sticky-header/' );
define( 'ASTRA_ADDON_EXT_STICKY_HEADER_URI', ASTRA_EXT_URI . 'addons/sticky-header/' );

if ( ! class_exists( 'Astra_Ext_Sticky_Header' ) ) {

	/**
	 * Sticky Header Initial Setup
	 *
	 * @since 1.0.0
	 */
	// @codingStandardsIgnoreStart
	class Astra_Ext_Sticky_Header {
 // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedClassFound
		// @codingStandardsIgnoreEnd

		/**
		 * Member Variable
		 *
		 * @var instance
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

			require_once ASTRA_ADDON_EXT_STICKY_HEADER_DIR . 'classes/class-astra-ext-sticky-header-loader.php';
			require_once ASTRA_ADDON_EXT_STICKY_HEADER_DIR . 'classes/class-astra-ext-sticky-header-markup.php';

			// Include front end files.
			if ( ! is_admin() ) {
				require_once ASTRA_ADDON_EXT_STICKY_HEADER_DIR . 'classes/dynamic-css/dynamic.css.php';
				// Check Header Sections is activated.
				require_once ASTRA_ADDON_EXT_STICKY_HEADER_DIR . 'classes/dynamic-css/header-sections-dynamic.css.php';

				// Check Site Layouts is activated.
				if ( Astra_Ext_Extension::is_active( 'site-layouts' ) ) {
					require_once ASTRA_ADDON_EXT_STICKY_HEADER_DIR . 'classes/dynamic-css/site-layouts-dynamic.css.php';
				}

				if ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) {

					// Sticky Header Button CSS.
					require_once ASTRA_ADDON_EXT_STICKY_HEADER_DIR . 'classes/dynamic-css/button-dynamic.css.php';

					// Sticky Header Social CSS.
					require_once ASTRA_ADDON_EXT_STICKY_HEADER_DIR . 'classes/dynamic-css/social-dynamic.css.php';

					// Sticky Header Search CSS.
					require_once ASTRA_ADDON_EXT_STICKY_HEADER_DIR . 'classes/dynamic-css/search-dynamic.css.php';

					// Sticky Header HTML CSS.
					require_once ASTRA_ADDON_EXT_STICKY_HEADER_DIR . 'classes/dynamic-css/html-dynamic.css.php';

					// Sticky Header Widget CSS.
					require_once ASTRA_ADDON_EXT_STICKY_HEADER_DIR . 'classes/dynamic-css/widget-dynamic.css.php';

					// Sticky Header divider CSS.
					require_once ASTRA_ADDON_EXT_STICKY_HEADER_DIR . 'classes/dynamic-css/divider-dynamic.css.php';

					// Sticky Header language-switcher CSS.
					require_once ASTRA_ADDON_EXT_STICKY_HEADER_DIR . 'classes/dynamic-css/language-switcher-dynamic.css.php';

					// Sticky Account divider CSS.
					require_once ASTRA_ADDON_EXT_STICKY_HEADER_DIR . 'classes/dynamic-css/account-dynamic.css.php';

					// Sticky Menu Toggle CSS.
					require_once ASTRA_ADDON_EXT_STICKY_HEADER_DIR . 'classes/dynamic-css/toggle-dynamic.css.php';
				}
			}
		}
	}

	/**
	 *  Kicking this off by calling 'get_instance()' method
	 */
	Astra_Ext_Sticky_Header::get_instance();

}
