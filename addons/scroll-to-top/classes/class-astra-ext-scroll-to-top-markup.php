<?php
/**
 * Scroll To Top Markup
 *
 * @package Astra Addon
 */

if ( ! class_exists( 'Astra_Ext_Scroll_To_Top_Markup' ) ) {

	/**
	 * Scroll To Top Markup Initial Setup
	 *
	 * @since 1.0.0
	 */
	class Astra_Ext_Scroll_To_Top_Markup {

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
		 *  Constructor
		 */
		public function __construct() {

			add_action( 'wp_footer', array( $this, 'html_markup_loader' ) );
			add_action( 'astra_get_css_files', array( $this, 'add_styles' ) );
			add_action( 'astra_get_js_files', array( $this, 'add_scripts' ) );

		}

		/**
		 * Page Loader markup loader
		 *
		 * Loads appropriate template file based on the style option selected in options panel.
		 *
		 * @since 1.0.0
		 */
		public function html_markup_loader() {

			astra_get_template( 'scroll-to-top/template/scroll-to-top.php' );
		}


		/**
		 * Page Loader styles
		 *
		 * @since 1.0.0
		 */
		public function add_styles() {

			/*** Start Path Logic */

			/* Define Variables */
			$uri  = ASTRA_EXT_SCROLL_TO_TOP_URL . 'assets/css/';
			$path = ASTRA_EXT_SCROLL_TO_TOP_DIR . 'assets/css/';
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

			/*** End Path Logic */

			/* Add style.css */
			Astra_Minify::add_css( $gen_path . 'style' . $file_prefix . '.css' );
		}


		/**
		 * Page Loader scripts
		 *
		 * @since 1.0.0
		 */
		public function add_scripts() {

			/*** Start Path Logic */

			/* Define Variables */
			$uri  = ASTRA_EXT_SCROLL_TO_TOP_URL . 'assets/js/';
			$path = ASTRA_EXT_SCROLL_TO_TOP_DIR . 'assets/js/';

			/* Directory and Extension */
			$file_prefix = '.min';
			$dir_name    = 'minified';

			if ( SCRIPT_DEBUG ) {
				$file_prefix = '';
				$dir_name    = 'unminified';
			}

			$js_uri = $uri . $dir_name . '/';
			$js_dir = $path . $dir_name . '/';

			if ( defined( 'ASTRA_THEME_HTTP2' ) && ASTRA_THEME_HTTP2 ) {
				$gen_path = $js_uri;
			} else {
				$gen_path = $js_dir;
			}

			/*** End Path Logic */
			Astra_Minify::add_js( $gen_path . 'scroll-to-top' . $file_prefix . '.js' );
		}
	}
}

/**
*  Kicking this off by calling 'get_instance()' method
*/
Astra_Ext_Scroll_To_Top_Markup::get_instance();
