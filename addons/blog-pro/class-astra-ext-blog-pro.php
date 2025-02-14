<?php
/**
 * Blog Pro Extension
 *
 * @package Astra Addon
 */

define( 'ASTRA_ADDON_EXT_BLOG_PRO_DIR', ASTRA_EXT_DIR . 'addons/blog-pro/' );
define( 'ASTRA_ADDON_EXT_BLOG_PRO_URI', ASTRA_EXT_URI . 'addons/blog-pro/' );

if ( ! class_exists( 'Astra_Ext_Blog_Pro' ) ) {

	/**
	 * Blog Pro Initial Setup
	 *
	 * @since 1.0.0
	 */
	// @codingStandardsIgnoreStart
	class Astra_Ext_Blog_Pro {
		// @codingStandardsIgnoreEnd

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

			require_once ASTRA_ADDON_EXT_BLOG_PRO_DIR . 'classes/class-astra-ext-blog-pro-images-resizer.php';
			require_once ASTRA_ADDON_EXT_BLOG_PRO_DIR . 'classes/class-astra-ext-blog-pro-loader.php';
			require_once ASTRA_ADDON_EXT_BLOG_PRO_DIR . 'classes/class-astra-ext-blog-pro-markup.php';

			// Include front end files.
			if ( ! is_admin() ) {
				require_once ASTRA_ADDON_EXT_BLOG_PRO_DIR . 'classes/dynamic.php';
			}
		}
	}

	/**
	 *  Kicking this off by calling 'get_instance()' method
	 */
	Astra_Ext_Blog_Pro::get_instance();

}
