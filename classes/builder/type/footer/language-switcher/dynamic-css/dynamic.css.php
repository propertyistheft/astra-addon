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
add_filter( 'astra_dynamic_theme_css', 'astra_addon_footer_lang_switcher_dynamic_css' );

/**
 * Dynamic CSS
 *
 * @param  string $dynamic_css          Astra Dynamic CSS.
 * @param  string $dynamic_css_filtered Astra Dynamic CSS Filters.
 * @return String Generated dynamic CSS for Heading Colors.
 *
 * @since 3.1.0
 */
function astra_addon_footer_lang_switcher_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' ) {

	if ( Astra_Addon_Builder_Helper::is_component_loaded( 'language-switcher', 'footer' ) ) {

		$dynamic_css .= Astra_Language_Switcher_Component_Dynamic_CSS::astra_language_switcher_dynamic_css( 'footer' );

		$selector = '.ast-footer-language-switcher-element[data-section="section-fb-language-switcher"], .ast-footer-language-switcher .ast-builder-language-switcher-layout-horizontal .ast-builder-language-switcher-menu';

		$alignment = astra_get_option( 'footer-language-switcher-alignment' );

		$desktop_alignment = ( isset( $alignment['desktop'] ) ) ? $alignment['desktop'] : '';
		$tablet_alignment  = ( isset( $alignment['tablet'] ) ) ? $alignment['tablet'] : '';
		$mobile_alignment  = ( isset( $alignment['mobile'] ) ) ? $alignment['mobile'] : '';

		/**
		 * Copyright CSS.
		 */
		$css_output_desktop = array(
			$selector => array(
				'justify-content' => $desktop_alignment,
			),
		);

		$css_output_tablet = array(
			$selector => array(
				'justify-content' => $tablet_alignment,
			),
		);

		$css_output_mobile = array(
			$selector => array(
				'justify-content' => $mobile_alignment,
			),
		);

		/* Parse CSS from array() */
		$css_output  = astra_parse_css( $css_output_desktop );
		$css_output .= astra_parse_css( $css_output_tablet, '', astra_addon_get_tablet_breakpoint() );
		$css_output .= astra_parse_css( $css_output_mobile, '', astra_addon_get_mobile_breakpoint() );

		$dynamic_css .= $css_output;
	}

	return $dynamic_css;
}
