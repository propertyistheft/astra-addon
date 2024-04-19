<?php
/**
 * Header Button Element - Dynamic CSS
 *
 * @package Astra Builder
 * @since 3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Header Button Dynamic CSS
 */
add_filter( 'astra_dynamic_theme_css', 'astra_addon_header_button_dynamic_css' );

/**
 * Dynamic CSS
 *
 * @param  string $dynamic_css          Astra Dynamic CSS.
 * @param  string $dynamic_css_filtered Astra Dynamic CSS Filters.
 * @return string Generated dynamic CSS
 *
 * @since 3.3.0
 */
function astra_addon_header_button_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' ) {

	$dynamic_css .= Astra_Addon_Button_Component_Dynamic_CSS::astra_ext_button_dynamic_css( 'header' );

	return $dynamic_css;
}
