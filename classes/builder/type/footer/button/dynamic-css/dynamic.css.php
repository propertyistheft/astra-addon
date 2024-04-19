<?php
/**
 * Footer Button - Dynamic CSS
 *
 * @package Astra Builder
 * @since 3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Footer Buttons
 */
add_filter( 'astra_dynamic_theme_css', 'astra_addon_footer_button_dynamic_css' );

/**
 * Dynamic CSS
 *
 * @param  string $dynamic_css          Astra Dynamic CSS.
 * @param  string $dynamic_css_filtered Astra Dynamic CSS Filters.
 * @return String Generated dynamic CSS for Footer Buttons.
 *
 * @since 3.3.0
 */
function astra_addon_footer_button_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' ) {

	$dynamic_css .= Astra_Addon_Button_Component_Dynamic_CSS::astra_ext_button_dynamic_css( 'footer' );

	return $dynamic_css;
}
