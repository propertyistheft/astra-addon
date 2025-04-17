<?php
/**
 * Color Switcher Widget - Dynamic CSS.
 *
 * @package Astra Builder
 * @since 4.10.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Color Switcher dynamic CSS.
 */
add_filter( 'astra_dynamic_theme_css', 'astra_addon_header_color_switcher_dynamic_css' );

/**
 * Dynamic CSS.
 *
 * @param  string $dynamic_css          Astra Dynamic CSS.
 * @param  string $dynamic_css_filtered Astra Dynamic CSS Filters.
 * @return String Generated dynamic CSS for Heading Colors.
 *
 * @since 4.10.0
 */
function astra_addon_header_color_switcher_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' ) {
	if ( Astra_Addon_Builder_Helper::is_component_loaded( 'color-switcher', 'header' ) ) {
		$dynamic_css .= Astra_Color_Switcher_Component_Dynamic_CSS::astra_color_switcher_dynamic_css( 'header' );
	}

	return $dynamic_css;
}
