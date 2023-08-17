<?php
/**
 * Astra Addon Builder Controller.
 *
 * @package astra-builder
 * @since 3.0.0
 */

// No direct access, please.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Astra_Addon_Builder_Customizer.
 *
 * Customizer Configuration for Header Footer Builder.
 *
 * @since 3.0.0
 */
final class Astra_Addon_Builder_Customizer {

	/**
	 * Constructor
	 *
	 * @since 3.0.0
	 */
	public function __construct() {

		add_action( 'customize_preview_init', array( $this, 'enqueue_customizer_preview_scripts' ) );

		if ( false === astra_addon_builder_helper()->is_header_footer_builder_active ) {
			return;
		}

		add_action( 'astra_addon_get_css_files', array( $this, 'add_styles' ) );

		$this->load_base_components();

		add_action( 'customize_register', array( $this, 'header_configs' ), 5 );
		add_action( 'customize_register', array( $this, 'footer_configs' ), 5 );

		add_filter( 'astra_flags_svgs', array( $this, 'astra_addon_flag_svgs' ), 1, 10 );

	}

	/**
	 * Register Base Components for Builder.
	 */
	public function load_base_components() {

		// @codingStandardsIgnoreStart WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound

		// Base Config Files.

		require_once ASTRA_EXT_DIR . 'classes/builder/type/base/configurations/class-astra-addon-base-configs.php';

		require_once ASTRA_EXT_DIR . 'classes/builder/type/base/configurations/class-astra-divider-component-configs.php';
		require_once ASTRA_EXT_DIR . 'classes/builder/type/base/configurations/class-astra-addon-button-component-configs.php';
		require_once ASTRA_EXT_DIR . 'classes/builder/type/base/configurations/class-astra-social-component-configs.php';
		require_once ASTRA_EXT_DIR . 'classes/builder/type/base/configurations/class-astra-language-switcher-component-configs.php';

		// Base Dynamic CSS Files.
		require_once ASTRA_EXT_DIR . 'classes/builder/type/base/dynamic-css/divider/class-astra-divider-component-dynamic-css.php';
		require_once ASTRA_EXT_DIR . 'classes/builder/type/base/dynamic-css/language-switcher/class-astra-language-switcher-component-dynamic-css.php';
		require_once ASTRA_EXT_DIR . 'classes/builder/type/base/dynamic-css/social-icon/class-astra-social-icon-component-dynamic-css.php';
		require_once ASTRA_EXT_DIR . 'classes/builder/type/base/dynamic-css/button/class-astra-addon-button-component-dynamic-css.php';

		$this->load_header_components();
		$this->load_footer_components();
		// @codingStandardsIgnoreEnd WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
	}

	/**
	 * Register controls for Header Builder.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 * @since 3.0.0
	 */
	public function header_configs( $wp_customize ) {
		// @codingStandardsIgnoreStart WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
		$header_config_path = ASTRA_EXT_DIR . 'classes/builder/type/header';
		require_once $header_config_path . '/divider/class-astra-header-divider-component-configs.php';
		require_once $header_config_path . '/account/class-astra-ext-header-account-component-configs.php';
		require_once $header_config_path . '/menu/class-astra-addon-header-menu-component-configs.php';
		require_once $header_config_path . '/button/class-astra-addon-header-button-component-configs.php';
		require_once $header_config_path . '/social-icon/class-astra-header-social-component-configs.php';
		require_once $header_config_path . '/language-switcher/class-astra-header-language-switcher-configs.php';
		require_once $header_config_path . '/off-canvas/class-astra-addon-offcanvas-configs.php';
		// @codingStandardsIgnoreEnd WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
	}

	/**
	 * Register controls for Footer Builder.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 * @since 3.0.0
	 */
	public function footer_configs( $wp_customize ) {
		// @codingStandardsIgnoreStart WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
		$footer_config_path = ASTRA_EXT_DIR . 'classes/builder/type/footer';
		require_once $footer_config_path . '/divider/class-astra-footer-divider-component-configs.php';
		require_once $footer_config_path . '/button/class-astra-ext-footer-button-component-configs.php';
		require_once $footer_config_path . '/social-icon/class-astra-footer-social-component-configs.php';
		require_once $footer_config_path . '/language-switcher/class-astra-footer-language-switcher-configs.php';

		// @codingStandardsIgnoreEnd WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
	}

	/**
	 * Register Components for Header Builder.
	 *
	 * @since 3.0.0
	 */
	public function load_header_components() {
		// @codingStandardsIgnoreStart WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
		$header_components_path = ASTRA_EXT_DIR . 'classes/builder/type/header';
		if ( ! class_exists( 'Astra_Header_Divider_Component' ) ) {
			require_once $header_components_path . '/divider/class-astra-header-divider-component.php';
		}
		require_once $header_components_path . '/button/class-astra-addon-header-button-component.php';
		require_once $header_components_path . '/account/class-astra-ext-header-account-component.php';
		require_once $header_components_path . '/menu/class-astra-addon-header-menu-component.php';
		require_once $header_components_path . '/social-icon/class-astra-header-social-component.php';
		require_once $header_components_path . '/language-switcher/class-astra-header-language-switcher-component.php';
		require_once $header_components_path . '/off-canvas/class-astra-addon-offcanvas-component.php';

		// @codingStandardsIgnoreEnd WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
	}

	/**
	 * Register Components for Footer Builder.
	 *
	 * @since 3.0.0
	 */
	public function load_footer_components() {
		// @codingStandardsIgnoreStart WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
		$footer_components_path = ASTRA_EXT_DIR . 'classes/builder/type/footer';
		if ( ! class_exists( 'Astra_Footer_Divider_Component' ) ) {
			require_once $footer_components_path . '/divider/class-astra-footer-divider-component.php';
		}
		require_once $footer_components_path . '/button/class-astra-ext-footer-button-component.php';

		require_once $footer_components_path . '/social-icon/class-astra-footer-social-component.php';

		require_once $footer_components_path . '/language-switcher/class-astra-footer-language-switcher-component.php';

		// @codingStandardsIgnoreEnd WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
	}

	/**
	 * Add Customizer preview script.
	 *
	 * @since 3.0.0
	 */
	public function enqueue_customizer_preview_scripts() {

		// Base Dynamic CSS.
		wp_enqueue_script(
			'ahfb-addon-base-customizer-preview',
			ASTRA_EXT_URI . 'classes/builder/type/base/assets/js/customizer-preview.js',
			array( 'customize-preview' ),
			ASTRA_EXT_VER,
			true
		);

		// Localize variables for Astra Breakpoints JS.
		wp_localize_script(
			'ahfb-addon-base-customizer-preview',
			'astraBuilderPreview',
			array(
				'tablet_break_point' => astra_addon_get_tablet_breakpoint(),
				'mobile_break_point' => astra_addon_get_mobile_breakpoint(),
			)
		);
	}


	/**
	 * Add Styles Callback
	 *
	 * @since 3.1.0
	 */
	public function add_styles() {

		/*** Start Path Logic */

		/* Define Variables */
		$uri  = ASTRA_EXT_URI . 'classes/builder/assets/css/';
		$path = ASTRA_EXT_DIR . 'classes/builder/assets/css/';
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
	 * Load Flags SVG Icon array from the JSON file.
	 *
	 * @param Array $svg_arr Array of svg icons.
	 * @since 3.1.0
	 * @return Array addon svg icons.
	 */
	public function astra_addon_flag_svgs( $svg_arr = array() ) {

		ob_start();
		// Include SVGs Json file.
		include_once ASTRA_EXT_DIR . 'assets/flags/svgs.json';
		$svg_icon_arr  = json_decode( ob_get_clean(), true );
		$ast_flag_svgs = array_merge( $svg_arr, $svg_icon_arr );
		return $ast_flag_svgs;
	}
}

/**
 *  Prepare if class 'Astra_Addon_Builder_Customizer' exist.
 *  Kicking this off by creating new object of the class.
 */
new Astra_Addon_Builder_Customizer();
