<?php
/**
 * Minify Loader Class
 *
 * @package     Astra
 * @link        https://www.brainstormforce.com
 * @since       Astra 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Astra_Minify' ) ) {

	/**
	 * Astra_Minify
	 */
	// @codingStandardsIgnoreStart
	class Astra_Minify {
		// @codingStandardsIgnoreEnd

		/**
		 * WordPress Filesystem
		 *
		 * @since 1.0
		 * @var bool $astra_addon_filesystem
		 */
		private static $astra_addon_filesystem = null;

		/**
		 * Directory Info
		 *
		 * @since 1.0
		 * @var bool $_dir_info
		 */
		private static $_dir_info = null; // phpcs:ignore PSR2.Classes.PropertyDeclaration.Underscore

		/**
		 * A flag for whether or not we're in a Customizer
		 * preview or not.
		 *
		 * @since 1.0
		 * @var bool $_in_customizer_preview
		 */
		private static $_in_customizer_preview = false; // phpcs:ignore PSR2.Classes.PropertyDeclaration.Underscore

		/**
		 * The prefix for the option that is stored in the
		 * database for the cached CSS file key.
		 *
		 * @since 1.0
		 * @var string $_css_key
		 */
		private static $_css_key = 'astra_theme_css_key'; // phpcs:ignore PSR2.Classes.PropertyDeclaration.Underscore

		/**
		 * The prefix for the option that is stored in the
		 * database for the cached JS file key.
		 *
		 * @since 1.0
		 * @var string $_js_key
		 */
		private static $_js_key = 'astra_theme_js_key'; // phpcs:ignore PSR2.Classes.PropertyDeclaration.Underscore

		/**
		 * Additional CSS to enqueue.
		 *
		 * @since 1.0
		 * @var array $css
		 */
		private static $css_files = array();

		/**
		 * Additional JS to enqueue.
		 *
		 * @since 1.0
		 * @var array $js
		 */
		private static $js_files = array();

		/**
		 * Additional dependent JS to enqueue.
		 *
		 * @since 1.0
		 * @var array $js
		 */
		private static $dependent_js_files = array();

		/**
		 * Instance
		 *
		 * @since 1.6.0
		 *
		 * @var object Class object.
		 */
		private static $instance;

		/**
		 * Initiator
		 *
		 * @since 1.6.0
		 *
		 * @return object initialized object of class.
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		/**
		 * Construct
		 */
		public function __construct() {

			add_action( 'customize_preview_init', self::class . '::preview_init', 11 );
			add_action( 'customize_save_after', self::class . '::refresh_assets', 11 );
			add_action( 'astra_addon_activated', self::class . '::refresh_assets', 11 );
			add_action( 'astra_addon_deactivated', self::class . '::refresh_assets', 11 );
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

			// remove the cached css files when the site language gets changed.
			add_action( 'update_option_WPLANG', array( self::class, 'remove_cached_css_files' ) );

			if ( version_compare( ASTRA_THEME_VERSION, '3.6.8', '>' ) ) {
				add_action( 'astra_addon_get_js_files', array( $this, 'add_fronted_pro_script' ) );
			}
		}

		/**
		 * Enqueue Scripts
		 */
		public function enqueue_scripts() {

			/**
			 * Filters to disable all the styles and scripts added from addon.
			 *
			 * @since 1.5.0
			 *
			 * @param bool true | false enable/disable all styels,scripts of astra addon.
			 */
			if ( apply_filters( 'astra_addon_enqueue_assets', true ) ) {

				$uri = ASTRA_EXT_URI . 'assets/js/';

				$css_url     = self::get_css_url();
				$js_url      = self::get_js_url();
				$file_prefix = '.min';
				$dir_name    = 'minified';

				if ( SCRIPT_DEBUG ) {
					$file_prefix = '';
					$dir_name    = 'unminified';
				}

				$js_uri  = $uri . $dir_name . '/';
				$dep_uri = $uri . 'minified/';

				$gen_path     = $js_uri;
				$dep_gen_path = $dep_uri;

				if ( false != $css_url ) {
					wp_enqueue_style( 'astra-addon-css', $css_url, array(), ASTRA_EXT_VER, 'all' );
				}

				// Scripts - Register & Enqueue.
				if ( false != $js_url ) {
					wp_enqueue_script( 'astra-addon-js', $js_url, self::get_dependent_js(), ASTRA_EXT_VER, true );
				}

				if ( ! function_exists( 'astra_addon_filesystem' ) ) {
					wp_add_inline_style( 'astra-addon-css', apply_filters( 'astra_addon_dynamic_css', '' ) );
				}

				// DOMPurify script for DOM sanitization.
				wp_enqueue_script( 'astra-dom-purify', $dep_gen_path . 'purify.min.js', array(), ASTRA_EXT_VER, true );

				if ( is_archive() || is_home() || is_search() ) {
					if ( astra_addon_check_reveal_effect_condition() ) {
						wp_enqueue_script( 'reveal-effect-js', $dep_gen_path . 'reveal-effect.min.js', array(), ASTRA_EXT_VER, true );
						wp_enqueue_script( 'blog-reveal-js', $gen_path . 'blog-reveal' . $file_prefix . '.js', array(), ASTRA_EXT_VER, true );
					}
				}

				wp_localize_script( 'astra-addon-js', 'astraAddon', apply_filters( 'astra_addon_js_localize', array() ) );
			}
		}

		/**
		 * Load WordPress filesystem
		 *
		 * @since 1.0
		 * @return void
		 */
		public static function load_filesystem() {

			if ( null === self::$astra_addon_filesystem ) {

				global $wp_filesystem;
				if ( empty( $wp_filesystem ) ) {
					require_once ABSPATH . '/wp-admin/includes/file.php';
					WP_Filesystem();
				}

				self::$astra_addon_filesystem = $wp_filesystem;
			}
		}

		/**
		 * Used to add enqueue frontend styles.
		 *
		 * @since 1.0
		 * @param string $src    Source URL.
		 * @param bool   $handle Script handle.
		 * @return void
		 */
		public static function add_css( $src = null, $handle = false ) {
			if ( false != $handle ) {
				self::$css_files[ $handle ] = $src;
			} else {
				self::$css_files[] = $src;
			}
		}

		/**
		 * Used to enqueue frontend scripts.
		 *
		 * @since 1.0
		 * @param string $src    Source URL.
		 * @param bool   $handle Script handle.
		 * @return void
		 */
		public static function add_js( $src = null, $handle = false ) {

			if ( false != $handle ) {
				self::$js_files[ $handle ] = $src;
			} else {
				self::$js_files[] = $src;
			}
		}

		/**
		 * Used to enqueue dependent js frontend scripts.
		 *
		 * @since 1.0
		 * @param bool   $handle Script handle.
		 * @param string $src    Source URL.
		 * @return void
		 */
		public static function add_dependent_js( $handle, $src = null ) {
			self::$dependent_js_files[ $handle ] = $src;
		}

		/**
		 * Get css files to HTTP/2.
		 *
		 * @since 1.0
		 * @return array()
		 */
		public static function get_http2_css_files() {

			// Get the css key.
			$css_slug  = self::_asset_slug();
			$css_files = get_option( self::$_css_key . '-files-' . $css_slug, array() );

			// No css files, recompile the files.
			if ( ! $css_files ) {
				self::render_http2_css();
				return self::get_http2_css_files();
			}

			// Return the url.
			return $css_files;
		}

		/**
		 * Get css files to generate.
		 *
		 * @since 1.0
		 * @return array()
		 */
		public static function get_css_files() {

			if ( 1 > count( self::$css_files ) ) {
				do_action( 'astra_addon_get_css_files' );
			}

			return apply_filters( 'astra_addon_add_css_file', self::$css_files );
		}

		/**
		 * Get CSS files to HTTP/2.
		 *
		 * @since 1.0
		 * @return array()
		 */
		public static function get_http2_js_files() {

			// Get the js key.
			$js_slug  = self::_asset_slug();
			$js_files = get_option( self::$_js_key . '-files-' . $js_slug, array() );

			self::$dependent_js_files = get_option( self::$_js_key . '-dep-' . $js_slug );

			// No js files, recompile the js files.
			if ( ! $js_files ) {
				self::render_http2_js();
				return self::get_http2_js_files();
			}

			// Return the files array().
			return $js_files;
		}

		/**
		 * Get JS files to generate.
		 *
		 * @since 1.0
		 * @return array()
		 */
		public static function get_js_files() {

			if ( 1 > count( self::$js_files ) ) {
				do_action( 'astra_addon_get_js_files' );
			}

			return apply_filters( 'astra_addon_add_js_file', self::$js_files );
		}

		/**
		 * Get dependent JS files to generate.
		 *
		 * @since 1.0
		 * @return array()
		 */
		public static function get_dependent_js_files() {
			return apply_filters( 'astra_addon_add_dependent_js_file', self::$dependent_js_files );
		}

		/**
		 * Checks to see if the current site is being accessed over SSL.
		 *
		 * @since 1.0
		 * @return bool
		 */
		public static function astra_is_ssl() {
			if ( is_ssl() ) {
				return true;
			}

			if ( 0 === stripos( get_option( 'siteurl' ), 'https://' ) ) {
				return true;
			}

			if ( isset( $_SERVER['HTTP_X_FORWARDED_PROTO'] ) && 'https' === $_SERVER['HTTP_X_FORWARDED_PROTO'] ) {
				return true;
			}

			return false;
		}

		/**
		 * Returns an array with the path and URL for the cache directory.
		 *
		 * @since 1.0
		 * @return array
		 */
		public static function get_cache_dir() {

			if ( null != self::$_dir_info ) {
				return self::$_dir_info;
			}

			$dir_name = 'astra-addon';
			$wp_info  = wp_upload_dir();

			// SSL workaround.
			if ( self::astra_is_ssl() ) {
				$wp_info['baseurl'] = str_ireplace( 'http://', 'https://', $wp_info['baseurl'] );
			}

			// Build the paths.
			$dir_info = array(
				'path' => $wp_info['basedir'] . '/' . $dir_name . '/',
				'url'  => $wp_info['baseurl'] . '/' . $dir_name . '/',
			);

			// Create the cache dir if it doesn't exist.
			if ( ! file_exists( $dir_info['path'] ) ) {
				wp_mkdir_p( $dir_info['path'] );
			}

			self::$_dir_info = $dir_info;

			return self::$_dir_info;
		}

		/**
		 * Checks to see if this is a Customizer preview or not.
		 *
		 * @since 1.0
		 * @return bool
		 */
		public static function is_customizer_preview() {
			return self::$_in_customizer_preview;
		}

		/**
		 * Returns the prefix slug for the CSS cache file.
		 *
		 * @since 1.0
		 * @return string
		 */
		private static function _asset_slug() { // phpcs:ignore PSR2.Methods.MethodDeclaration.Underscore
			if ( self::is_customizer_preview() ) {
				$slug = 'ast-customizer';
			} else {
				$slug = 'astra-addon';
			}

			return $slug;
		}

		/**
		 * Clears and rebuilds the cached CSS file.
		 *
		 * @since 1.0
		 * @return void
		 */
		public static function refresh_assets() {
			self::clear_assets_cache();
			self::render_assets();
			do_action( 'astra_addon_assets_refreshed' );
		}

		/**
		 * Deletes cached CSS files based on the current
		 * context (live, preview or customizer) or all if
		 * $all is set to true.
		 *
		 * @since 1.0
		 * @return bool Returns True if files were successfull deleted,  False If files could not be deleted.
		 */
		public static function clear_assets_cache() {

			// Make sure the filesystem is loaded.
			self::load_filesystem();

			$dir_name   = 'astra-addon';
			$cache_dir  = self::get_cache_dir();
			$asset_slug = self::_asset_slug();

			/* Delete CSS Keys */
			delete_option( self::$_css_key . '-' . $asset_slug );
			delete_option( self::$_css_key . '-files-' . $asset_slug );

			/* Delete JS Keys */
			delete_option( self::$_js_key . '-' . $asset_slug );
			delete_option( self::$_js_key . '-files-' . $asset_slug );
			delete_option( self::$_js_key . '-dep-' . $asset_slug );

			if ( ! empty( $cache_dir['path'] ) && stristr( $cache_dir['path'], $dir_name ) ) {
				$directory     = trailingslashit( $cache_dir['path'] );
				$filelist      = (array) self::$astra_addon_filesystem->dirlist( $directory, true );
				$delete_status = true;

				foreach ( $filelist as $file ) {

					// don't delete dynamic css files.
					// @TODO: use Astra_Cache to generate and manage CSS files.
					if ( false !== strpos( $file['name'], 'dynamic-css' ) ) {
						continue;
					}

					// Skip astra-addon css/js files if customizer preview. Whenever customizer was refreshed, astra-addon used to regenerate. If HTML cache is enabled on the frontend then just visiting the customizer regenerates the astra-addon assets and gives 404 not found error for astra-addon assets on frontend.
					if ( self::is_customizer_preview() && ( false !== strpos( $file['name'], 'astra-addon-' ) ) ) {
						continue;
					}

					$file = $directory . $file['name'];

					if ( is_file( $file ) && file_exists( $file ) ) {
						$delete_status = self::$astra_addon_filesystem->delete( $file );
					}
				}

				// If the file was not correctly deleted.
				if ( false == $delete_status ) {
					// Set status CSS status True. This will load the CSS as inline.
					update_option( 'ast-theme-css-status', true );
					update_option( 'astra-addon-js-status', true );

					return false;
				}
			}

			return true;
		}

		/**
		 * Renders the CSS and JS assets.
		 *
		 * @since 1.0
		 * @return void
		 */
		public static function render_assets() {
			if ( defined( 'ASTRA_THEME_HTTP2' ) && ASTRA_THEME_HTTP2 ) {
				self::render_http2_css();
				self::render_http2_js();
			} else {
				self::render_css();
				self::render_js();
			}
		}

		/**
		 * Returns a URL for the cached CSS file.
		 *
		 * @since 1.0
		 * @return string
		 */
		public static function get_css_url() {

			if ( defined( 'ASTRA_THEME_HTTP2' ) && ASTRA_THEME_HTTP2 ) {

				self::enqueue_http2_css();
				return false;
			}
			if ( ! get_option( 'ast-theme-css-status' ) ) {

				// Get the cache dir and css key.
				$cache_dir = self::get_cache_dir();
				$css_slug  = self::_asset_slug();
				$css_key   = get_option( self::$_css_key . '-' . $css_slug );
				$css_path  = $cache_dir['path'] . $css_slug . '-' . $css_key . '.css';
				$css_url   = $cache_dir['url'] . $css_slug . '-' . $css_key . '.css';

				if ( ! $css_key ) {
					self::render_css();
					return self::get_css_url();
				}

				// Check to see if the file exists.
				if ( ! file_exists( $css_path ) ) {
					self::render_fallback_css();
					return false;
				}

				// Return the url.
				return $css_url;
			}

			self::render_fallback_css();
			return false;
		}

		/**
		 * Returns a HTTP/2 Dynamic CSS data.
		 *
		 * @since 1.0
		 * @return string
		 */
		public static function get_http2_dynamic_css() {

			// Get the css key.
			$css_slug = self::_asset_slug();

			// No css data, recompile the css.
			if ( ! $css_data ) {
				self::render_http2_css();
				return self::get_http2_dynamic_css();
			}

			// Return the url.
			return $css_data;
		}

		/**
		 * Returns a Dynamic CSS data.
		 *
		 * @since 1.0
		 * @return string
		 */
		public static function get_dynamic_css() {

			// Get the cache dir and css key.
			$cache_dir = self::get_cache_dir();
			$css_slug  = self::_asset_slug();

			// No css data, recompile the css.
			if ( ! $css_data ) {
				self::render_css();
				return self::get_dynamic_css();
			}

			// Return the url.
			return $css_data;
		}

		/**
		 * Returns a URL for the cached JS file.
		 *
		 * @since 1.0
		 * @return string
		 */
		public static function get_js_url() {
			if ( defined( 'ASTRA_THEME_HTTP2' ) && ASTRA_THEME_HTTP2 ) {

				self::enqueue_http2_js();
				return false;
			}
			if ( ! get_option( 'astra-addon-js-status' ) ) {

				// Get the cache dir and js key.
				$cache_dir = self::get_cache_dir();
				$js_slug   = self::_asset_slug();

				$js_key  = get_option( self::$_js_key . '-' . $js_slug );
				$js_path = $cache_dir['path'] . $js_slug . '-' . $js_key . '.js';
				$js_url  = $cache_dir['url'] . $js_slug . '-' . $js_key . '.js';

				if ( ! $js_key ) {
					self::render_js();
					return self::get_js_url();
				}

				// Get dependent js added from addon modules.
				self::$dependent_js_files = get_option( self::$_js_key . '-dep-' . $js_slug );

				// Check to see if the file exists.
				if ( ! file_exists( $js_path ) ) {
					self::render_fallback_js();
					return false;
				}

				// Return the url.
				return $js_url;
			}

			self::render_fallback_js();
			return false;
		}

		/**
		 * Enqueue dependent JS
		 *
		 * @since 1.0
		 * @return void
		 */
		public static function enqueue_dependent_js() {

			$dependent_js_files = self::get_dependent_js_files();

			if ( is_array( $dependent_js_files ) && ! empty( $dependent_js_files ) && ( count( $dependent_js_files ) > 0 ) ) {

				foreach ( $dependent_js_files as $handle => $src ) {

					if ( '' != $src ) {
						wp_enqueue_script( $handle, $src, array(), ASTRA_EXT_VER, true );
					} else {
						wp_enqueue_script( $handle );
					}
				}
			}
		}

		/**
		 * Get dependent JS
		 *
		 * @since 1.0
		 * @return array()
		 */
		public static function get_dependent_js() {

			$dependent_js_files = self::get_dependent_js_files();

			$js_files_arr = array();
			if ( is_array( $dependent_js_files ) && count( $dependent_js_files ) > 0 ) {

				foreach ( $dependent_js_files as $handle => $src ) {

					if ( '' != $src ) {
						wp_register_script( $handle, $src, array(), ASTRA_EXT_VER, true );
						$js_files_arr[] = $handle;
					} else {
						$js_files_arr[] = $handle;
					}
				}
			}

			return $js_files_arr;
		}

		/**
		 * Compiles the cached CSS file.
		 *
		 * @since 1.0
		 * @return void
		 */
		private static function render_http2_css() {

			$css_slug  = self::_asset_slug();
			$css_files = self::get_css_files();

			/* Update Dynamic css in DB */
			update_option( self::$_css_key . '-files-' . $css_slug, $css_files );
		}

		/**
		 * Removes the cached CSS files.
		 *
		 * @since 4.8.1
		 * @return void
		 */
		public static function remove_cached_css_files() {

			$css_slug = self::_asset_slug();

			/* Delete dynamic css files from DB */
			delete_option( self::$_css_key . '-files-' . $css_slug );
		}

		/**
		 * Compiles the cached CSS file.
		 *
		 * @since 1.0
		 * @return void|false Checks early if cache directory was emptied before generating the new files
		 */
		private static function render_css() {

			self::load_filesystem();

			if ( ! defined( 'FS_CHMOD_FILE' ) ) {
				define( 'FS_CHMOD_FILE', ( fileperms( ABSPATH . 'index.php' ) & 0777 | 0644 ) ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedConstantFound
			}

			if ( get_option( 'ast-theme-css-status' ) ) {
				$assets_status = self::clear_assets_cache();

				if ( false == $assets_status ) {
					return false;
				}
			}

			$cache_dir   = self::get_cache_dir();
			$new_css_key = str_replace( '.', '-', uniqid( '', true ) );
			$css_slug    = self::_asset_slug();
			$css_files   = self::get_css_files();
			$css         = '';
			$filepath    = $cache_dir['path'] . $css_slug . '-' . $new_css_key . '.css';

			if ( count( $css_files ) > 0 ) {

				foreach ( $css_files as $file ) {

					if ( ! empty( $file ) && file_exists( $file ) ) {
						$css .= self::$astra_addon_filesystem->get_contents(
							$file,
							FS_CHMOD_FILE
						);
					}
				}
			}

			$css = apply_filters( 'astra_addon_render_css', $css );

			$status = self::$astra_addon_filesystem->put_contents(
				$filepath,
				$css,
				FS_CHMOD_FILE
			);

			$status = ! $status;

			// Save the new css key.
			update_option( 'ast-theme-css-status', $status );
			update_option( self::$_css_key . '-' . $css_slug, $new_css_key );
		}

		/**
		 * Render HTTP/2 CSS : enqueue individual CSS file.
		 *
		 * @since 1.0
		 * @return void
		 */
		private static function enqueue_http2_css() {

			$css_files   = self::get_http2_css_files();
			$files_count = count( $css_files );

			if ( $files_count > 0 ) {

				foreach ( $css_files as $k => $file ) {

					if ( $files_count == $k + 1 ) {
						$handle = 'astra-addon-css';
					} else {
						$handle = 'astra-addon-css-' . $k;
					}

					wp_enqueue_style(
						$handle,
						$file,
						array(),
						ASTRA_EXT_VER,
						'all'
					);
				}
			}
		}

		/**
		 * Fallback to enqueue individual CSS file.
		 *
		 * @since 1.0
		 * @return void
		 */
		private static function render_fallback_css() {

			$css_files   = self::get_css_files();
			$files_count = count( $css_files );

			if ( $files_count > 0 ) {

				foreach ( $css_files as $index => $file_path ) {

					if ( ! file_exists( $file_path ) ) {
						continue;
					}

					$new_file = plugins_url( str_replace( plugin_dir_path( ASTRA_EXT_FILE ), '', $file_path ), ASTRA_EXT_FILE );

					if ( $files_count == $index + 1 ) {

						$handle = 'astra-addon-css';
					} else {
						$handle = 'astra-addon-css-' . $index;
					}

					wp_enqueue_style(
						$handle,
						$new_file,
						array(),
						ASTRA_EXT_VER,
						'all'
					);

				}
			}
		}

		/**
		 * Renders HTTP/2 js.
		 *
		 * @since 1.0
		 * @return void
		 */
		public static function render_http2_js() {

			$js_slug      = self::_asset_slug();
			$js_files     = self::get_js_files();
			$dep_js_files = self::$dependent_js_files;

			update_option( self::$_js_key . '-files-' . $js_slug, $js_files );
			update_option( self::$_js_key . '-dep-' . $js_slug, $dep_js_files );
		}

		/**
		 * Renders and caches the JavaScript
		 *
		 * @since 1.0
		 * @return void|false Checks early if cache directory was emptied before generating the new files
		 */
		public static function render_js() {

			self::load_filesystem();

			if ( ! defined( 'FS_CHMOD_FILE' ) ) {
				define( 'FS_CHMOD_FILE', ( fileperms( ABSPATH . 'index.php' ) & 0777 | 0644 ) ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedConstantFound
			}

			if ( get_option( 'astra-addon-js-status' ) ) {
				$assets_status = self::clear_assets_cache();

				if ( false == $assets_status ) {
					return false;
				}
			}

			$cache_dir    = self::get_cache_dir();
			$new_js_key   = str_replace( '.', '-', uniqid( '', true ) );
			$js_slug      = self::_asset_slug();
			$js_files     = self::get_js_files();
			$dep_js_files = self::$dependent_js_files;
			$js           = '';
			$filepath     = $cache_dir['path'] . $js_slug . '-' . $new_js_key . '.js';

			if ( count( $js_files ) > 0 ) {

				foreach ( $js_files as $file ) {

					if ( ! empty( $file ) && file_exists( $file ) ) {
						$js .= self::$astra_addon_filesystem->get_contents(
							$file,
							FS_CHMOD_FILE
						);
					}
				}
			}

			$js = apply_filters( 'astra_addon_render_js', $js );

			$status = self::$astra_addon_filesystem->put_contents(
				$filepath,
				$js,
				FS_CHMOD_FILE
			);

			$status = ! $status;

			// Save the new css key.
			update_option( 'astra-addon-js-status', $status );
			update_option( self::$_js_key . '-dep-' . $js_slug, $dep_js_files );
			update_option( self::$_js_key . '-' . $js_slug, $new_js_key );

			do_action( 'astra_addon_after_render_js' );
		}

		/**
		 * HTTP/2 individual JS file.
		 *
		 * @since 1.0
		 * @return void
		 */
		public static function enqueue_http2_js() {
			$js_files    = self::get_http2_js_files();
			$files_count = count( $js_files );

			if ( 0 < $files_count ) {

				$dep_files = self::get_dependent_js();

				if ( ! is_array( $dep_files ) ) {
					$dep_files = array();
				}

				foreach ( $js_files as $k => $file ) {

					if ( 0 == $k ) {
						$handle = 'astra-addon-js';
					} else {
						$handle = 'astra-addon-js-' . $k;
					}

					wp_enqueue_script(
						$handle,
						$file,
						$dep_files,
						ASTRA_EXT_VER,
						true
					);
				}
			}
		}

		/**
		 * Render Fallback JS
		 *
		 * @since 1.0
		 * @return void
		 */
		public static function render_fallback_js() {

			$js_files    = self::get_js_files();
			$files_count = count( $js_files );

			if ( 0 < $files_count ) {

				self::enqueue_dependent_js();

				foreach ( $js_files as $index => $file_path ) {

					if ( ! file_exists( $file_path ) ) {
						continue;
					}

					$new_file = plugins_url( str_replace( plugin_dir_path( ASTRA_EXT_FILE ), '', $file_path ), ASTRA_EXT_FILE );

					if ( 0 == $index ) {
						$handle = 'astra-addon-js';
					} else {
						$handle = 'astra-addon-js-' . $index;
					}

					wp_enqueue_script(
						$handle,
						$new_file,
						array(),
						ASTRA_EXT_VER,
						true
					);
				}
			}
		}

		/**
		 * Called by the customize_preview_init action to initialize
		 * a Customizer preview.
		 *
		 * @since 1.0
		 * @return void
		 */
		public static function preview_init() {
			self::$_in_customizer_preview = true;
			self::refresh_assets();
		}

		/**
		 * Trim CSS
		 *
		 * @since 1.0
		 * @param string $css CSS content to trim.
		 * @return string
		 */
		public static function trim_css( $css = '' ) {

			// Trim white space for faster page loading.
			if ( ! empty( $css ) ) {
				$css = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css );
				$css = str_replace( array( "\r\n", "\r", "\n", "\t", '  ', '    ', '    ' ), '', $css );
				$css = str_replace( ', ', ',', $css );
			}

			return $css;
		}

		/**
		 * Load Addon ddependent JS related to toggle navigation menu.
		 *
		 * @since 3.5.9
		 */
		public static function add_fronted_pro_script() {
			/* Define Variables */
			$uri  = ASTRA_EXT_URI . 'assets/js/';
			$path = ASTRA_EXT_DIR . 'assets/js/';

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

			/* End Path Logic */
			self::add_js( $gen_path . 'frontend-pro' . $file_prefix . '.js' );
		}
	}

	Astra_Minify::get_instance();
}
