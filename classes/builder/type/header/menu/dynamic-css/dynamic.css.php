<?php
/**
 * Menu Element - Dynamic CSS
 *
 * @package Astra Addon
 * @since 3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Menu Box - Dynamic CSS
 */
add_filter( 'astra_dynamic_theme_css', 'astra_addon_header_menu_dynamic_css' );

/**
 * Dynamic CSS
 *
 * @param  string $dynamic_css          Astra Dynamic CSS.
 * @param  string $dynamic_css_filtered Astra Dynamic CSS Filters.
 * @return String Generated dynamic CSS for Heading Colors.
 *
 * @since 3.3.0
 */
function astra_addon_header_menu_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' ) {

	$component_limit = astra_addon_builder_helper()->component_limit;
	for ( $index = 1; $index <= $component_limit; $index++ ) {

		if ( ! Astra_Addon_Builder_Helper::is_component_loaded( 'menu-' . $index, 'header' ) ) {
			continue;
		}

		$_prefix = 'menu' . $index;

		$selector = '.ast-desktop .ast-mega-menu-enabled .ast-builder-menu-' . $index . ' div:not( .astra-full-megamenu-wrapper) .sub-menu, .ast-builder-menu-' . $index . ' .inline-on-mobile .sub-menu, .ast-desktop .ast-builder-menu-' . $index . ' .astra-full-megamenu-wrapper, .ast-desktop .ast-builder-menu-' . $index . ' .menu-item .sub-menu';

		$dynamic_css .= Astra_Addon_Base_Dynamic_CSS::prepare_box_shadow_dynamic_css( 'header-' . $_prefix, $selector );

	}

	return $dynamic_css;
}
