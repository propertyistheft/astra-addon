<?php
/**
 * Site Layouts Manager Markup
 *
 * @package Astra Addon
 */

if ( ! class_exists( 'Astra_Ext_Site_Layouts_Markup' ) ) {

	/**
	 * Sidebar Manager Markup Initial Setup
	 *
	 * @since 1.0.0
	 */
	// @codingStandardsIgnoreStart
	class Astra_Ext_Site_Layouts_Markup {
 // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedClassFound
		// @codingStandardsIgnoreEnd

		/**
		 * Member Variable
		 *
		 * @var object instance
		 */
		private static $instance;

		/**
		 * Initiator
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

			add_filter( 'body_class', array( $this, 'body_classes' ), 10, 1 );
			add_action( 'astra_addon_get_css_files', array( $this, 'add_styles' ) );
		}

		/**
		 * Add Body Class
		 *
		 * @param array $classes Body Classes.
		 * @return array
		 */
		public function body_classes( $classes ) {

			// Apply layout class to the body.
			$classes[] = esc_attr( astra_get_option( 'site-layout', 'ast-full-width-layout' ) );

			return $classes;
		}

		/**
		 * Add Styles
		 */
		public function add_styles() {

			/* Start Path Logic */

			/* Define Variables */
			$uri  = ASTRA_ADDON_EXT_SITE_LAYOUTS_URL . 'assets/css/';
			$path = ASTRA_ADDON_EXT_SITE_LAYOUTS_DIR . 'assets/css/';
			$rtl  = '';

			if ( is_rtl() ) {
				$rtl = '-rtl';
			}

			/* Directory and Extension */
			$file_prefix = $rtl . '.min';
			$dir_name    = 'minified';

			if ( SCRIPT_DEBUG ) {
				$file_prefix = $rtl;
				$dir_name    = 'unminified';
			}

			$css_uri = $uri . $dir_name . '/';
			$css_dir = $path . $dir_name . '/';

			if ( defined( 'ASTRA_THEME_HTTP2' ) && ASTRA_THEME_HTTP2 ) {
				$gen_path = $css_uri;
			} else {
				$gen_path = $css_dir;
			}

			/* End Path Logic */

			/* Add style.css */
			Astra_Minify::add_css( $gen_path . 'style' . $file_prefix . '.css' );
		}
	}
}

/**
 * Kicking this off by calling 'get_instance()' method
 */
Astra_Ext_Site_Layouts_Markup::get_instance();
