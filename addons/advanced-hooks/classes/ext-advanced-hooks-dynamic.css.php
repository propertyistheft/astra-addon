<?php
/**
 * Advanced Hooks - Dynamic CSS
 *
 * @package Astra Addon
 */

add_filter( 'astra_dynamic_css', 'astra_ext_advanced_hooks_dynamic_css' );

/**
 * Dynamic CSS
 *
 * @param  string $dynamic_css          Astra Dynamic CSS.
 * @param  string $dynamic_css_filtered Astra Dynamic CSS Filters.
 * @return string
 */
function astra_ext_advanced_hooks_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' ) {

	$css = '';

	$common_desktop_css_output = array(
		'.ast-hide-display-device-desktop' => array(
			'display' => 'none',
		),
	);
	$common_tablet_css_output  = array(
		'.ast-hide-display-device-tablet' => array(
			'display' => 'none',
		),
	);
	$common_mobile_css_output  = array(
		'.ast-hide-display-device-mobile' => array(
			'display' => 'none',
		),
	);

	// Common options of Above Header.
	$css .= astra_parse_css( $common_desktop_css_output, astra_addon_get_tablet_breakpoint( '', 1 ) );
	$css .= astra_parse_css( $common_tablet_css_output, astra_addon_get_mobile_breakpoint( '', 1 ), astra_addon_get_tablet_breakpoint() );
	$css .= astra_parse_css( $common_mobile_css_output, '', astra_addon_get_mobile_breakpoint() );

	return $dynamic_css . $css;
}
