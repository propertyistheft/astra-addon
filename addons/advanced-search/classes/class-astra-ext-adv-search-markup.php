<?php
/**
 * Advanced Search Markup
 *
 * @package Astra Addon
 */

if ( ! class_exists( 'Astra_Ext_Adv_Search_Markup' ) ) {

	/**
	 * Advanced Search Markup Initial Setup
	 *
	 * @since 1.4.8
	 */
	// @codingStandardsIgnoreStart
	class Astra_Ext_Adv_Search_Markup {
		// @codingStandardsIgnoreEnd

		/**
		 * Member Variable
		 *
		 * @var object instance
		 */
		private static $instance;

		/**
		 * Initiator
		 *
		 * @since 1.4.8
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
		 * @since 1.4.8
		 */
		public function __construct() {
			add_action( 'astra_addon_get_css_files', array( $this, 'add_styles' ) );
			add_action( 'astra_addon_get_js_files', array( $this, 'add_scripts' ) );

			add_filter( 'astra_addon_js_localize', array( $this, 'localize_variables' ) );

			add_action( 'astra_footer_after', array( $this, 'full_screen_search_markup' ) );
			add_filter( 'astra_get_search', array( $this, 'get_search_markup' ), 10, 3 );

			/**
			 * Compatibility with Default Astra & Astra Header Builder > Search.
			 */
			if ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) {
				add_action( 'astra_main_header_bar_top', array( $this, 'header_builder_cover_search' ) );
				add_action( 'astra_mobile_header_bar_top', array( $this, 'header_builder_cover_search' ) );

				add_filter( 'astra_default_strings', array( $this, 'header_builder_default_strings' ), 10 );
				add_filter( 'astra_search_field_placeholder', array( $this, 'header_builder_default_search_string' ), 10 );

			} else {
				add_action( 'astra_main_header_bar_top', array( $this, 'main_header_cover_search' ) );
				add_action( 'astra_above_header_top', array( $this, 'top_header_cover_search' ) );
				add_action( 'astra_below_header_top', array( $this, 'below_header_cover_search' ) );
			}

			// Filter to modify the search icon for slide search from theme.
			add_filter( 'astra_get_search_icon', array( $this, 'search_icon' ) );
		}

		/**
		 * Add default strings
		 *
		 * @param array $strings Default strings array.
		 * @since 3.1.0
		 */
		public function header_builder_default_strings( $strings ) {

			$search_string = $this->header_builder_default_search_string( '' );

			$strings['string-header-cover-search-placeholder'] = esc_attr( $search_string );
			$strings['string-search-input-placeholder']        = esc_attr( $search_string );
			$strings['string-full-width-search-placeholder']   = esc_attr( $search_string );

			return $strings;
		}

		/**
		 * Add default search filter callback
		 *
		 * @param string $search_string Default string.
		 * @since 3.1.0
		 */
		public function header_builder_default_search_string( $search_string ) {

			return esc_attr( astra_get_i18n_option( 'header-search-box-placeholder', _x( '%astra%', 'Search: Placeholder Text', 'astra-addon' ) ) );
		}

		/**
		 * Main Header Cover Search
		 *
		 * @since 1.4.8
		 * @return void
		 */
		public function main_header_cover_search() {

			$search_box       = astra_get_option( 'header-main-rt-section' );
			$search_box_style = astra_get_option( 'header-main-rt-section-search-box-type' );

			if ( 'search' == $search_box && 'header-cover' == $search_box_style ) {
				$this->get_search_form_shortcode( 'header-cover', true );
			}
		}

		/**
		 * Header Cover Search
		 *
		 * @since 3.0.0
		 * @return void
		 */
		public function header_builder_cover_search() {
			// Bail early if the search widget is not loaded in the header.
			if ( ! Astra_Builder_Helper::is_component_loaded( 'search', 'header' ) ) {
				return;
			}

			if ( 'header-cover' === astra_get_option( 'header-search-box-type' ) ) {
				$this->get_search_form_shortcode( 'header-cover', true );
			}
		}

		/**
		 * Add Localize variables
		 *
		 * @since 3.0.0
		 * @param  array $localize_vars Localize variables array.
		 * @return array
		 */
		public function localize_variables( $localize_vars ) {

			$localize_vars['is_header_builder_active'] = astra_addon_builder_helper()->is_header_footer_builder_active;

			return $localize_vars;
		}

		/**
		 * Below Header Cover Search
		 *
		 * @since 1.4.8
		 * @return void
		 */
		public function below_header_cover_search() {

			$header_cover = false;
			$layout       = astra_get_option( 'below-header-layout' );

			$section_1_search_box       = astra_get_option( 'below-header-section-1' );
			$section_1_search_box_style = astra_get_option( 'below-header-section-1-search-box-type' );

			if ( 'below-header-layout-1' == $layout ) {
				$section_2_search_box       = astra_get_option( 'below-header-section-2' );
				$section_2_search_box_style = astra_get_option( 'below-header-section-2-search-box-type' );

				if ( ! $header_cover && 'search' == $section_2_search_box ) {
					if ( 'header-cover' == $section_2_search_box_style ) {
						$header_cover = true;
					}
				}
			}

			if ( 'search' == $section_1_search_box ) {
				if ( 'header-cover' == $section_1_search_box_style ) {
					$header_cover = true;
				}
			}

			if ( $header_cover ) {
				$this->get_search_form_shortcode( 'header-cover', true );
			}
		}

		/**
		 * Top Header Cover Search
		 *
		 * @since 1.4.8
		 * @return void
		 */
		public function top_header_cover_search() {

			$header_cover = false;
			$top_layout   = astra_get_option( 'above-header-layout' );

			$left_search_box       = astra_get_option( 'above-header-section-1' );
			$left_search_box_style = astra_get_option( 'above-header-section-1-search-box-type' );

			if ( 'search' == $left_search_box && 'header-cover' == $left_search_box_style ) {
				$header_cover = true;
			}

			if ( 'above-header-layout-1' == $top_layout ) {

				$right_search_box       = astra_get_option( 'above-header-section-2' );
				$right_search_box_style = astra_get_option( 'above-header-section-2-search-box-type' );

				if ( 'search' == $right_search_box && 'header-cover' == $right_search_box_style ) {
					$header_cover = true;
				}
			}

			if ( $header_cover ) {
				$this->get_search_form_shortcode( 'header-cover', true );
			}
		}

		/**
		 * Fullscreen Search
		 *
		 * @since 1.4.8
		 */
		public function full_screen_search_markup() {
			if (
				'full-screen' === astra_get_option( 'above-header-section-1-search-box-type' ) ||
				'full-screen' === astra_get_option( 'above-header-section-2-search-box-type' ) ||
				'full-screen' === astra_get_option( 'header-main-rt-section-search-box-type' ) ||
				'full-screen' === astra_get_option( 'below-header-section-1-search-box-type' ) ||
				'full-screen' === astra_get_option( 'below-header-section-2-search-box-type' ) ||
				(
					true === astra_addon_builder_helper()->is_header_footer_builder_active &&
					Astra_Builder_Helper::is_component_loaded( 'search', 'header' ) &&
					'full-screen' === astra_get_option( 'header-search-box-type' )
				)
			) {
				$this->get_search_form_shortcode( 'full-screen', true );
			}
		}

		/**
		 * Adding Wrapper for Search Form.
		 *
		 * @since 1.4.8
		 *
		 * @param string $search_markup   Search Form Content.
		 * @param string $option    Search Form Options.
		 * @param string $device Device in which used.
		 * @return Search HTML structure created.
		 */
		public function get_search_markup( $search_markup, $option = '', $device = '' ) {

			if ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) {

				$search_box_style = astra_get_option( 'header-search-box-type', 'slide-search' );
				$search_box_style = apply_filters( 'astra_search_style_hs', $search_box_style );
				$elements         = astra_get_option( 'header-mobile-items' );
				$search_in_popup  = false;

				if ( is_array( $elements ) && is_array( $elements['popup']['popup_content'] ) && in_array( 'search', $elements['popup']['popup_content'], true ) ) {
					$search_in_popup = true;
				}

				if ( 'search-box' == $search_box_style || ( $search_in_popup && 'mobile' === $device ) ) {

					$search_markup = $this->get_search_form_shortcode( 'search-box' );
				} elseif ( ( 'header-cover' == $search_box_style || 'full-screen' == $search_box_style ) && ! ( $search_in_popup && 'mobile' === $device ) ) {

					$search_markup  = $this->get_search_icon( $search_box_style );
					$search_markup .= '<div class="ast-search-menu-icon ' . $search_box_style . '">';
					$search_markup .= '</div>';
				}
			} else {

				$search_box_style = astra_get_option( $option . '-search-box-type', 'slide-search' );
				$option_slug      = str_replace( '-', '_', $option );
				$search_box_style = apply_filters( 'astra_search_style_' . $option_slug, $search_box_style );

				if ( 'search-box' == $search_box_style ) {
					$search_markup = $this->get_search_form_shortcode( 'search-box' );
				} elseif ( 'header-cover' == $search_box_style || 'full-screen' == $search_box_style ) {

					$search_markup = $this->get_search_icon( $search_box_style );
					if ( false == astra_get_option( 'header-display-outside-menu' ) && 'header-main-rt-section' === $option ) {
						$search_markup .= '<div class="ast-search-menu-icon ' . $search_box_style . '">';
						$search_markup .= '</div>';
					}
				}
			}

			return $search_markup;
		}

		/**
		 * Search icon markup
		 *
		 * @param  string $style Search style.
		 *
		 * @return void|string Returns or echo search icon HTML markup.
		 *
		 * @since 4.8.13
		 */
		public static function search_icon( $echo = false ) {
			// Bail early if SVG icons are not enabled.
			if ( ! Astra_Icons::is_svg_icons() ) {
				return $echo ? null : '';
			}

			$svg     = '';
			$classes = array(
				'ast-icon',
				'icon-search',
			);
			$icon    = astra_get_option( 'header-search-icon' );

			if ( isset( $icon['type'], $icon['value'] ) ) {
				$type  = $icon['type'];
				$value = $icon['value'];

				if ( $type === 'custom' ) {
					$svg       = do_shortcode( $value );
					$classes[] = 'icon-' . $type;
				} elseif ( is_callable( 'Astra_Builder_UI_Controller::fetch_svg_icon' ) ) {
					$svg       = Astra_Builder_UI_Controller::fetch_svg_icon( $value );
					$classes[] = 'icon-' . $value;
				}
			}

			$svg = $svg ?: Astra_Icons::get_icons( 'search' );
			$svg = sprintf(
				'<span class="%1$s">%2$s</span>',
				implode( ' ', $classes ),
				$svg
			);

			$allowed_svg_args = array(
				'span'  => array( 'class' => array() ),
				'svg'   => array(
					'xmlns:xlink'       => array(),
					'version'           => array(),
					'id'                => array(),
					'x'                 => array(),
					'y'                 => array(),
					'enable-background' => array(),
					'xml:space'         => array(),
					'class'             => array(),
					'aria-hidden'       => array(),
					'aria-labelledby'   => array(),
					'role'              => array(),
					'xmlns'             => array(),
					'width'             => array(),
					'height'            => array(),
					'viewbox'           => array(),
				),
				'g'     => array( 'fill' => array() ),
				'title' => array( 'title' => array() ),
				'path'  => array(
					'd'    => array(),
					'fill' => array(),
				),
			);

			if ( $echo !== true ) {
				return wp_kses( $svg, $allowed_svg_args );
			}
			
			echo wp_kses( $svg, $allowed_svg_args );
		}

		/**
		 * Search icon markup
		 *
		 * @since 1.4.8
		 * @param  string $style Search style.
		 * @return mixed        HTML Markup.
		 */
		public function get_search_icon( $style ) {
			return '<div class="ast-search-icon"><a class="' . esc_attr( $style ) . ' astra-search-icon" aria-label="Search icon link" href="#">' . self::search_icon() . '</a></div>';
		}

		/**
		 * Search Form
		 *
		 * @since 1.4.8
		 * @param string $style Search Form Style.
		 * @param bool   $echo Print or return.
		 * @return mixed
		 */
		public function get_search_form( $style = 'slide-search', $echo = false ) {
			if ( Astra_Addon_Builder_Helper::is_component_loaded( 'search', 'header' ) ) {
				ob_start();
					astra_addon_get_template( 'advanced-search/template/' . esc_attr( $style ) . '.php' );
				$search_html = ob_get_clean();

				if ( $echo ) {
					echo wp_kses( $search_html, Astra_Addon_Kses::astra_addon_form_with_post_kses_protocols() );
				} else {
					return $search_html;
				}
			}
		}

		/**
		 * Search Form Shortcode
		 *
		 * @since 3.6.8
		 * @param string $style Search Form Style.
		 * @param bool   $echo Print or return.
		 * @return mixed
		 */
		public function get_search_form_shortcode( $style = 'slide-search', $echo = false ) {
			$search_html = '';
			ob_start();
				astra_addon_get_template( 'advanced-search/template/' . esc_attr( $style ) . '.php' );
			$search_html = ob_get_clean();

			if ( $echo ) {
				echo do_shortcode( $search_html );
			} else {
				return $search_html;
			}
		}

		/**
		 * Add Styles Callback
		 *
		 * @since 1.4.8
		 */
		public function add_styles() {

			/* Start Path Logic */

			/* Define Variables */
			$uri  = ASTRA_ADDON_EXT_ADVANCED_SEARCH_URL . 'assets/css/';
			$path = ASTRA_ADDON_EXT_ADVANCED_SEARCH_DIR . 'assets/css/';
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

		/**
		 * Add Scripts Callback
		 *
		 * @since 1.4.8
		 */
		public function add_scripts() {

			/* Start Path Logic */

			/* Define Variables */
			$uri  = ASTRA_ADDON_EXT_ADVANCED_SEARCH_URL . 'assets/js/';
			$path = ASTRA_ADDON_EXT_ADVANCED_SEARCH_DIR . 'assets/js/';

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
			Astra_Minify::add_js( $gen_path . 'advanced-search' . $file_prefix . '.js' );
		}
	}
}

/**
 *  Kicking this off by calling 'get_instance()' method
 */
Astra_Ext_Adv_Search_Markup::get_instance();
