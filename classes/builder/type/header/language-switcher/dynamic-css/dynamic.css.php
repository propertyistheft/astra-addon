<?php
/**
 * Language_Switcher control - Dynamic CSS
 *
 * @package Astra Builder
 * @since 3.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Language Switcher Colors
 */
add_filter( 'astra_dynamic_theme_css', 'astra_hb_lang_switcher_dynamic_css' );

/**
 * Dynamic CSS
 *
 * @param  string $dynamic_css          Astra Dynamic CSS.
 * @param  string $dynamic_css_filtered Astra Dynamic CSS Filters.
 * @return String Generated dynamic CSS for Heading Colors.
 *
 * @since 3.1.0
 */
function astra_hb_lang_switcher_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' ) {

	if ( Astra_Addon_Builder_Helper::is_component_loaded( 'language-switcher', 'header' ) ) {
		$dynamic_css .= Astra_Language_Switcher_Component_Dynamic_CSS::astra_language_switcher_dynamic_css( 'header' );
	}

	return $dynamic_css;
}
