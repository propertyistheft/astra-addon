<?php
/**
 * Mobile Header Markup
 *
 * @package Astra Addon
 */

if ( ! class_exists( 'Astra_Ext_Mobile_Header_Markup' ) ) {

	/**
	 * Astra_Ext_Mobile_Header_Markup initial setup
	 *
	 * @since 1.4.0
	 */
	// @codingStandardsIgnoreStart
	class Astra_Ext_Mobile_Header_Markup {
 // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedClassFound
		// @codingStandardsIgnoreEnd

		/**
		 * Member Variable
		 *
		 * @var instance
		 */
		private static $instance;

		/**
		 * Member Variable
		 *
		 * @var options
		 */
		public static $options;

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
			add_filter( 'body_class', array( $this, 'body_class' ) );
			add_action( 'astra_addon_get_css_files', array( $this, 'add_styles' ) );
			add_action( 'astra_addon_get_js_files', array( $this, 'add_scripts' ) );
			add_filter( 'astra_above_header_menu_toggle_classes', array( $this, 'above_header_menu_toggle_classes' ) );
			add_filter( 'astra_below_header_menu_toggle_classes', array( $this, 'below_header_menu_toggle_classes' ) );

			add_action( 'astra_above_header_before_menu', array( $this, 'above_header_before_menu' ) );
			add_action( 'astra_above_header_after_menu', array( $this, 'above_header_after_menu' ) );

			add_filter( 'astra_merge_header_custom_menu_item_wrap', array( $this, 'merge_header_custom_menu_item_wrap' ) );
			add_filter( 'astra_merge_header_before_custom_menu_item', array( $this, 'merge_header_before_custom_menu_item' ) );

			add_action( 'astra_merge_header_before_menu', array( $this, 'merge_header_before_menu' ) );
			add_action( 'astra_merge_header_after_menu', array( $this, 'merge_header_after_menu' ) );

			add_action( 'astra_main_header_custom_menu_item_before', array( $this, 'merge_header_before_menu' ) );
			add_action( 'astra_main_header_custom_menu_item_after', array( $this, 'merge_header_after_menu' ) );

			add_action( 'astra_below_header_before_menu', array( $this, 'below_header_before_menu' ) );
			add_action( 'astra_below_header_after_menu', array( $this, 'below_header_after_menu' ) );
			add_action( 'wp_head', array( $this, 'wp_head' ) );
		}

		/**
		 * WP Head
		 *
		 * @return void
		 */
		public function wp_head() {

			if ( 'no-toggle' === astra_get_option( 'mobile-above-header-menu-style' ) ) {
				add_filter( 'astra_enable_above_header_mobile_menu_button', '__return_false' );
			}

			if ( 'no-toggle' === astra_get_option( 'mobile-below-header-menu-style' ) ) {
				add_filter( 'astra_enable_below_header_mobile_menu_button', '__return_false' );
			}

			if ( 'no-toggle' === astra_get_option( 'mobile-menu-style' ) ) {
				add_filter( 'astra_enable_mobile_menu_buttons', '__return_false', 15 );
			}
		}

		/**
		 * Below Header add open div wrapper
		 *
		 * @since 1.4.0
		 * @return void.
		 */
		public function below_header_before_menu() {
			$mobile_below_menu_style = astra_get_option( 'mobile-below-header-menu-style' );
			if ( 'default' !== $mobile_below_menu_style ) {
				?>
				<div class="ast-below-header-navigation-wrap">
				<?php
			}
		}

		/**
		 * Below Header add close div wrapper
		 *
		 * @since 1.4.0
		 * @return void.
		 */
		public function below_header_after_menu() {
			$mobile_below_menu_style = astra_get_option( 'mobile-below-header-menu-style' );
			if ( 'default' !== $mobile_below_menu_style ) {
				?>
				</div><!-- .ast-below-header-navigation-wrap -->
				<?php
			}
		}

		/**
		 * Above Header add open div wrapper
		 *
		 * @since 1.4.0
		 * @return void.
		 */
		public function above_header_before_menu() {
			$mobile_above_menu_style = astra_get_option( 'mobile-above-header-menu-style' );
			if ( 'default' !== $mobile_above_menu_style ) {
				?>
				<div class="ast-above-header-navigation-wrap">
				<?php
			}
		}

		/**
		 * Above Header add close div wrapper
		 *
		 * @since 1.4.0
		 * @return void.
		 */
		public function above_header_after_menu() {
			$mobile_above_menu_style = astra_get_option( 'mobile-above-header-menu-style' );
			if ( 'default' !== $mobile_above_menu_style ) {
				?>
				</div><!-- .ast-above-header-navigation-wrap -->
				<?php
			}
		}

		/**
		 * Merge Header with Custom menu item add open div wrapper
		 *
		 * @since 1.4.0
		 * @param string $markup Custom menu item markup.
		 * @return string $markup updated Custom menu item markup.
		 */
		public function merge_header_custom_menu_item_wrap( $markup ) {
			$mobile_above_menu_style = astra_get_option( 'mobile-menu-style' );
			if ( 'default' !== $mobile_above_menu_style ) {
				$markup .= '<div class="ast-merge-header-navigation-wrap"><div class="ast-merge-header-sections-menu">';
			}
			return $markup;
		}

		/**
		 * Above Header add close div wrapper
		 *
		 * @since 1.4.0
		 * @param string $markup Custom menu item markup.
		 * @return string $markup updated Custom menu item markup.
		 */
		public function merge_header_before_custom_menu_item( $markup ) {
			$mobile_above_menu_style = astra_get_option( 'mobile-menu-style' );
			if ( 'default' !== $mobile_above_menu_style ) {
				$markup = '</div></div>' . $markup;
			}
			return $markup;
		}

		/**
		 * Merge Header add open div wrapper
		 *
		 * @since 1.4.0
		 * @return void.
		 */
		public function merge_header_before_menu() {
			$mobile_menu_style = astra_get_option( 'mobile-menu-style' );
			if ( 'default' !== $mobile_menu_style ) {
				?>
				<div class="ast-merge-header-navigation-wrap">
				<?php
			}
		}

		/**
		 * Merge Header add close div wrapper
		 *
		 * @since 1.4.0
		 * @return void.
		 */
		public function merge_header_after_menu() {
			$mobile_menu_style = astra_get_option( 'mobile-menu-style' );
			if ( 'default' !== $mobile_menu_style ) {
				?>
				</div><!-- .ast-merge-header-navigation-wrap -->
				<?php
			}
		}

		/**
		 * Above Header Cart Icon Class
		 *
		 * @param array $classes Default argument array.
		 *
		 * @since 1.4.0
		 * @return array;
		 */
		public function above_header_menu_toggle_classes( $classes ) {
			$classes[] = 'ast-above-mobile-menu-buttons-' . astra_get_option( 'mobile-above-header-toggle-btn-style' );
			return $classes;
		}

		/**
		 * Below Header Cart Icon Class
		 *
		 * @param array $classes Default argument array.
		 *
		 * @since 1.4.0
		 * @return array;
		 */
		public function below_header_menu_toggle_classes( $classes ) {
			$classes[] = 'ast-below-mobile-menu-buttons-' . astra_get_option( 'mobile-below-header-toggle-btn-style' );
			return $classes;
		}

		/**
		 * Body Class
		 *
		 * @param array $classes Default argument array.
		 *
		 * @since 1.4.0
		 * @return array;
		 */
		public function body_class( $classes ) {
			$below_header_merged     = astra_get_option( 'below-header-merge-menu' );
			$above_header_merged     = astra_get_option( 'above-header-merge-menu' );
			$above_header_menu_align = astra_get_option( 'above-header-menu-align' );
			$mobile_above_menu_style = astra_get_option( 'mobile-above-header-menu-style' );
			$mobile_below_menu_style = astra_get_option( 'mobile-below-header-menu-style' );
			$mobile_menu_style       = astra_get_option( 'mobile-menu-style' );
			$flyout_alignment        = astra_get_option( 'flyout-mobile-menu-alignment' );
			$above_flyout_alignment  = astra_get_option( 'flyout-mobile-above-header-menu-alignment' );
			$below_flyout_alignment  = astra_get_option( 'flyout-mobile-below-header-menu-alignment' );

			if ( $above_header_menu_align ) {
				$classes[] = 'ast-above-mobile-menu-align-' . $above_header_menu_align;
			}
			if ( $mobile_menu_style ) {
				$classes[] = 'ast-' . $mobile_menu_style . '-menu-enable';
			}
			if ( $mobile_above_menu_style && ! $above_header_merged ) {
				$classes[] = 'ast-' . $mobile_above_menu_style . '-above-menu-enable';
			}

			if ( 'flyout' === $mobile_menu_style ) {
				$classes[] = 'ast-flyout-' . $flyout_alignment . '-side';
			}

			if ( 'flyout' === $mobile_above_menu_style ) {
				$classes[] = 'ast-flyout-above-' . $above_flyout_alignment . '-side';
			}

			if ( $mobile_below_menu_style && ! $below_header_merged ) {
				$classes[] = 'ast-' . $mobile_below_menu_style . '-below-menu-enable';
			}

			if ( 'flyout' === $mobile_below_menu_style ) {
				$classes[] = 'ast-flyout-below-' . $below_flyout_alignment . '-side';
			}

			if ( 'flyout' === $mobile_below_menu_style ) {
				$classes[] = 'ast-flyout-below-' . $below_flyout_alignment . '-side';
			}

			return $classes;
		}

		/**
		 * Add Styles
		 *
		 * @since 1.4.0
		 * @return void
		 */
		public function add_styles() {

			/* Start Path Logic */

			/* Define Variables */
			$uri  = ASTRA_ADDON_EXT_MOBILE_HEADER_URL . 'assets/css/';
			$path = ASTRA_ADDON_EXT_MOBILE_HEADER_DIR . 'assets/css/';
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
			$above_header_merged = astra_get_option( 'above-header-merge-menu' );
			$below_header_merged = astra_get_option( 'below-header-merge-menu' );

			$mobile_menu_style              = astra_get_option( 'mobile-menu-style' );
			$mobile_above_header_menu_style = astra_get_option( 'mobile-above-header-menu-style' );
			$mobile_below_header_menu_style = astra_get_option( 'mobile-below-header-menu-style' );

			if ( 'flyout' === $mobile_menu_style ) {
				Astra_Minify::add_css( $gen_path . 'primary-menu-flyout' . $file_prefix . '.css' );
			}
			if ( 'no-toggle' === $mobile_menu_style ) {
				Astra_Minify::add_css( $gen_path . 'primary-menu-no-toggle' . $file_prefix . '.css' );
			}
			if ( 'fullscreen' === $mobile_menu_style ) {
				Astra_Minify::add_css( $gen_path . 'fullscreen-menu-common' . $file_prefix . '.css' );
				Astra_Minify::add_css( $gen_path . 'primary-menu-fullscreen' . $file_prefix . '.css' );
			}
			if ( 'flyout' === $mobile_above_header_menu_style ) {
				Astra_Minify::add_css( $gen_path . 'above-menu-flyout' . $file_prefix . '.css' );
			}
			if ( ! $above_header_merged && 'no-toggle' === $mobile_above_header_menu_style ) {
				Astra_Minify::add_css( $gen_path . 'above-menu-no-toggle' . $file_prefix . '.css' );
			}
			if ( 'fullscreen' === $mobile_above_header_menu_style ) {
				Astra_Minify::add_css( $gen_path . 'fullscreen-menu-common' . $file_prefix . '.css' );
				Astra_Minify::add_css( $gen_path . 'above-menu-fullscreen' . $file_prefix . '.css' );
			}
			if ( 'flyout' === $mobile_below_header_menu_style ) {
				Astra_Minify::add_css( $gen_path . 'below-menu-flyout' . $file_prefix . '.css' );
			}
			if ( ! $below_header_merged && 'no-toggle' === $mobile_below_header_menu_style ) {
				Astra_Minify::add_css( $gen_path . 'below-menu-no-toggle' . $file_prefix . '.css' );
			}
			if ( 'fullscreen' === $mobile_below_header_menu_style ) {
				Astra_Minify::add_css( $gen_path . 'fullscreen-menu-common' . $file_prefix . '.css' );
				Astra_Minify::add_css( $gen_path . 'below-menu-fullscreen' . $file_prefix . '.css' );
			}
		}

		/**
		 * Add Scripts Callback
		 */
		public function add_scripts() {
			/* Start Path Logic */
			$below_header_merged = astra_get_option( 'below-header-merge-menu' );
			$above_section_1     = astra_get_option( 'above-header-section-1' );
			$above_section_2     = astra_get_option( 'above-header-section-2' );
			$above_header_merged = astra_get_option( 'above-header-merge-menu' );

			$disable_primary_nav = astra_get_option( 'disable-primary-nav' );
			$mobile_menu_style   = astra_get_option( 'mobile-menu-style' );
			$above_header_style  = astra_get_option( 'mobile-above-header-menu-style' );
			$below_header_style  = astra_get_option( 'mobile-below-header-menu-style' );

			/* Define Variables */
			$uri  = ASTRA_ADDON_EXT_MOBILE_HEADER_URL . 'assets/js/';
			$path = ASTRA_ADDON_EXT_MOBILE_HEADER_DIR . 'assets/js/';

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
			Astra_Minify::add_dependent_js( 'jquery' );

			if ( ! $above_header_merged && 'no-toggle' === $above_header_style && ( 'menu' === $above_section_1 || 'menu' === $above_section_2 ) ) {
				Astra_Minify::add_js( $gen_path . 'above-menu-no-toggle' . $file_prefix . '.js' );
			}

			if ( ! $below_header_merged && 'no-toggle' === $below_header_style && ( 'menu' === $above_section_1 || 'menu' === $above_section_2 ) ) {
				Astra_Minify::add_js( $gen_path . 'below-menu-no-toggle' . $file_prefix . '.js' );
			}

			if ( 'no-toggle' === $mobile_menu_style && '1' != $disable_primary_nav ) {
				Astra_Minify::add_js( $gen_path . 'primary-menu-no-toggle' . $file_prefix . '.js' );
			}
		}
	}
}

/**
 *  Prepare if class 'Astra_Customizer_Loader' exist.
 *  Kicking this off by calling 'get_instance()' method
 */
Astra_Ext_Mobile_Header_Markup::get_instance();
