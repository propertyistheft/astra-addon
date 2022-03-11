<?php
/**
 * Sticky Header language-switcher Dynamic CSS
 *
 * @package Astra Addon
 */

add_filter( 'astra_addon_dynamic_css', 'astra_sticky_header_language_switcher_dynamic_css' );

/**
 * Dynamic CSS
 *
 * @param  string $dynamic_css          Astra Dynamic CSS.
 * @param  string $dynamic_css_filtered Astra Dynamic CSS Filters.
 * @return string
 */
function astra_sticky_header_language_switcher_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' ) {

	if ( ! Astra_Addon_Builder_Helper::is_component_loaded( 'language-switcher', 'header' ) ) {
		return $dynamic_css;
	}

	$css_output = array(

		'.ast-header-sticked .ast-lswitcher-item-header' => array(
			'color' => esc_attr( astra_get_option( 'sticky-header-language-switcher-color' ) ),
		),
	);

	/* Parse CSS from array() */
	$css_output = astra_parse_css( $css_output );

	$dynamic_css .= $css_output;

	return $dynamic_css;
}
