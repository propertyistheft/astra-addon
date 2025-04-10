<?php
/**
 * Off Canvas control - Dynamic CSS
 *
 * @package Astra Addon
 * @since 3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Off Canvas Colors
 */
add_filter( 'astra_dynamic_theme_css', 'astra_addon_offcanvas_dynamic_css' );

/**
 * Dynamic CSS
 *
 * @param  string $dynamic_css          Astra Dynamic CSS.
 * @param  string $dynamic_css_filtered Astra Dynamic CSS Filters.
 * @return String Generated dynamic CSS for Heading Colors.
 *
 * @since 3.3.0
 */
function astra_addon_offcanvas_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' ) {

	$selector = '.ast-mobile-popup-drawer.active';

	$popup_width            = astra_get_option( 'off-canvas-width' );
	$popup_width_desktop    = isset( $popup_width['desktop'] ) && ! empty( $popup_width['desktop'] ) ? $popup_width['desktop'] : '';
	$popup_width_tablet     = isset( $popup_width['tablet'] ) && ! empty( $popup_width['tablet'] ) ? $popup_width['tablet'] : '';
	$popup_width_mobile     = isset( $popup_width['mobile'] ) && ! empty( $popup_width['mobile'] ) ? $popup_width['mobile'] : '';
	$off_canvas_header_type = astra_get_option( 'mobile-header-type' );

	$css_output        = array();
	$css_output_tablet = array();
	$css_output_mobile = array();

	if ( ! empty( $popup_width_desktop ) ) {
		$css_output[ '.ast-desktop ' . $selector . ' .ast-mobile-popup-inner' ]['max-width'] = $popup_width_desktop . '%';
	}

	if ( ! empty( $popup_width_tablet ) ) {
		$css_output_tablet['#ast-mobile-popup-wrapper .ast-mobile-popup-drawer .ast-mobile-popup-inner']['width'] = $off_canvas_header_type === 'off-canvas' ? $popup_width_tablet . '%' : '';
		$css_output_tablet[ $selector . ' .ast-mobile-popup-inner' ]['max-width']                                 = $popup_width_tablet . '%';
	}

	if ( ! empty( $popup_width_mobile ) ) {
		$css_output_mobile['#ast-mobile-popup-wrapper .ast-mobile-popup-drawer .ast-mobile-popup-inner']['width'] = $off_canvas_header_type === 'off-canvas' ? $popup_width_mobile . '%' : '';
		$css_output_mobile[ $selector . ' .ast-mobile-popup-inner' ]['max-width']                                 = $popup_width_mobile . '%';
	}

	$css_output  = astra_parse_css( $css_output );
	$css_output .= astra_parse_css( $css_output_tablet, '', astra_addon_get_tablet_breakpoint() );
	$css_output .= astra_parse_css( $css_output_mobile, '', astra_addon_get_mobile_breakpoint() );

	$dynamic_css .= $css_output;

	return $dynamic_css;
}
