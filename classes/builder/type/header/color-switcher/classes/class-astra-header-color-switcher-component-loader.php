<?php
/**
 * Color Switcher Styling Loader for Astra.
 *
 * @package     Astra Builder
 * @link        https://www.brainstormforce.com
 * @since       Astra 4.10.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Customizer Initialization.
 *
 * @since 4.10.0
 */
class Astra_Header_Color_Switcher_Component_Loader {

	/**
	 * Constructor.
	 *
	 * @since 4.10.0
	 */
	public function __construct() {
		add_filter( 'astra_theme_defaults', array( $this, 'theme_defaults' ) );
		add_filter( 'astra_global_current_palette', array( $this, 'current_switcher_palette' ) );
		add_filter( 'astra_addon_js_localize', array( $this, 'localize_frontend_pro_variables' ) );
		add_action( 'customize_preview_init', array( $this, 'preview_scripts' ), 110 );
	}

	/**
	 * Default customizer options for the Color Switcher widget.
	 *
	 * @param array $defaults Astra options default value array.
	 *
	 * @since 4.10.0
	 */
	public function theme_defaults( $defaults ) {
		// General options.
		$defaults['color-switcher-palette']       = 'palette_4'; // Dark Palette.
		$defaults['color-switcher-force-reload']  = false;
		$defaults['color-switcher-icon']          = array(
			'type'  => 'adjust', // Could be icon name, `icon-library` or `custom`.
			'value' => 'adjust', // Could be icon name for `icon-library` or svg code for `custom` type.
		);
		$defaults['color-switcher-icon-switched'] = array(
			'type'  => 'adjust', // Could be icon name, `icon-library` or `custom`.
			'value' => 'adjust', // Could be icon name for `icon-library` or svg code for `custom` type.
		);
		$defaults['color-switcher-text']          = '';
		$defaults['color-switcher-text-switched'] = '';
		$defaults['color-switcher-icon-size']     = Astra_Addon_Customizer::responsive_values( 18, 18, 18 );
		$defaults['color-switcher-visibility']    = Astra_Addon_Customizer::responsive_values( 1, 1, 1 );
		$defaults['color-switcher-default-mode']  = 'system';

		// Design options.
		$defaults['color-switcher-icon-color']       = Astra_Addon_Customizer::responsive_values();
		$defaults['color-switcher-background']       = Astra_Addon_Customizer::responsive_values();
		$defaults['color-switcher-background-hover'] = Astra_Addon_Customizer::responsive_values();
		$defaults['color-switcher-radius']           = astra_addon_builder_helper()->default_responsive_spacing;
		$defaults['color-switcher-margin']           = astra_addon_builder_helper()->default_responsive_spacing;
		$defaults['color-switcher-padding']          = astra_addon_builder_helper()->default_responsive_spacing;

		// Transparent header options.
		$defaults['transparent-color-switcher-icon-color']       = Astra_Addon_Customizer::responsive_values();
		$defaults['transparent-color-switcher-background']       = Astra_Addon_Customizer::responsive_values();
		$defaults['transparent-color-switcher-background-hover'] = Astra_Addon_Customizer::responsive_values();

		return $defaults;
	}

	/**
	 * Adjusts the current palette data based on the color switcher state.
	 *
	 * @param array $palettes_data The current palette data.
	 * @return array The adjusted palette data.
	 *
	 * @since 4.10.0
	 */
	public function current_switcher_palette( $global_palette ) {
		// Bail early if it is the customizer preview or color-switcher component is not loaded for the header.
		if ( is_customize_preview() || ! Astra_Addon_Builder_Helper::is_component_loaded( 'color-switcher', 'header' ) ) {
			return $global_palette; // Return the global palette if the component is not loaded.
		}

		$is_switched = self::is_switched();

		// If the switcher is not switched and the global palette is not an array or does not have a 'palette' key, return the default global palette.
		if ( ! $is_switched && ! is_array( $global_palette ) && ! isset( $global_palette['palette'] ) ) {
			return $global_palette;
		}

		$palettes_data    = astra_get_palette_colors();
		$palettes_colors  = isset( $palettes_data['palettes'] ) ? $palettes_data['palettes'] : array();
		$switcher_palette = astra_get_option( 'color-switcher-palette' );

		// If the switcher is in the switched state, update the global palette with the switcher palette.
		if ( $is_switched && isset( $palettes_colors[ $switcher_palette ] ) ) {
			$global_palette['palette'] = $palettes_colors[ $switcher_palette ];
			// Add filter to set the active global palette key to the switcher palette.
			add_filter( 'astra_get_active_global_palette_key', fn() => $switcher_palette );
		}

		return $global_palette;
	}

	/**
	 * Checks if the color switcher is currently in the switched state.
	 * 
	 * @return bool Returns true if the color switcher is switched, false otherwise.
	 * @since 4.10.0
	 */
	public static function is_switched() {
		// Bail early if it the customizer preview.
		if ( is_customize_preview() ) {
			return false;
		}
		$switcher_default_mode = astra_get_option( 'color-switcher-default-mode' );

		// Check if the cookie indicating the color switcher state is set.
		if ( isset( $_COOKIE['astraColorSwitcherState'] ) ) {
			return $_COOKIE['astraColorSwitcherState'] === 'true';
		}

		// If the cookie is not set, return true if the default mode is 'dark', indicating the switcher is on by default.
		return $switcher_default_mode === 'dark';
	}

	/**
	 * Localize frontend pro variables.
	 *
	 * @param  array $localize_vars Localize variables array.
	 * @return array Localized variables array.
	 *
	 * @since 4.10.0
	 */
	public function localize_frontend_pro_variables( $localize_vars ) {
		// Bail early if it is the customizer preview or color-switcher component is not loaded for the header.
		if ( is_customize_preview() || ! Astra_Addon_Builder_Helper::is_component_loaded( 'color-switcher', 'header' ) ) {
			return;
		}

		// Get the palette colors data.
		$palettes_data   = astra_get_palette_colors();
		$palettes_colors = isset( $palettes_data['palettes'] ) ? $palettes_data['palettes'] : array();

		$is_switched           = self::is_switched();
		$default_palette       = isset( $palettes_data['currentPalette'] ) ? $palettes_data['currentPalette'] : 'palette_1';
		$switcher_palette      = astra_get_option( 'color-switcher-palette' );
		$switcher_default_mode = astra_get_option( 'color-switcher-default-mode' );
		$is_dark_palette       = astra_addon_is_dark_palette( $switcher_palette );
		$force_reload          = $is_dark_palette ? astra_get_option( 'color-switcher-force-reload' ) : false;

		// Set the color switcher variables for localization.
		$localize_vars['colorSwitcher'] = array(
			'isInit'        => true,
			'forceReload'   => $force_reload,
			'isSwitched'    => $is_switched,
			'isDarkPalette' => $is_dark_palette,
			'palette'       => $switcher_palette,
			'defaultMode'   => $switcher_default_mode,
			'palettes'      => array(
				'default'  => isset( $palettes_colors[ $default_palette ] ) ? $palettes_colors[ $default_palette ] : array(),
				'switched' => isset( $palettes_colors[ $switcher_palette ] ) ? $palettes_colors[ $switcher_palette ] : array(),
			),
		);

		// Check if dark compatibility CSS should be loaded.
		$load_dark_compatibility_css = $is_dark_palette && ! $force_reload && ! $is_switched;
		if ( $load_dark_compatibility_css && function_exists( 'astra_dark_palette_css' ) ) {
			wp_add_inline_style( 'astra-addon-css', astra_dark_palette_css( '', true ) );
		}

		return $localize_vars;
	}

	/**
	 * Enqueue customizer preview scripts.
	 *
	 * @since 4.10.0
	 */
	public function preview_scripts() {
		$folder = SCRIPT_DEBUG ? 'unminified' : 'minified';
		$prefix = SCRIPT_DEBUG ? '.js' : '.min.js';

		wp_enqueue_script(
			'astra-addon-header-color-switcher-customizer-preview-js',
			ASTRA_ADDON_HEADER_COLOR_SWITCHER_URI . '/assets/js/' . $folder . '/customizer-preview' . $prefix,
			array( 'customize-preview', 'ahfb-addon-base-customizer-preview', 'astra-addon-customizer-preview-helper' ),
			ASTRA_EXT_VER,
			true
		);
	}
}

/**
 *  Kicking this off by creating the object of the class.
 */
new Astra_Header_Color_Switcher_Component_Loader();
