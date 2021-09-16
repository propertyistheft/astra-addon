<?php
/**
 * Divider control - Dynamic CSS
 *
 * @package Astra Builder
 * @since 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Heading Colors
 */
add_filter( 'astra_dynamic_theme_css', 'astra_fb_divider_dynamic_css' );

/**
 * Dynamic CSS
 *
 * @param  string $dynamic_css          Astra Dynamic CSS.
 * @param  string $dynamic_css_filtered Astra Dynamic CSS Filters.
 * @return String Generated dynamic CSS for Heading Colors.
 *
 * @since 3.0.0
 */
function astra_fb_divider_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' ) {

	$dynamic_css .= Astra_Divider_Component_Dynamic_CSS::astra_divider_dynamic_css( 'footer' );

	$component_limit = astra_addon_builder_helper()->component_limit;
	for ( $index = 1; $index <= $component_limit; $index++ ) {

		if ( ! Astra_Addon_Builder_Helper::is_component_loaded( 'divider-' . $index, 'footer' ) ) {
			continue;
		}

		$_section = 'section-fb-divider-' . $index;
		$selector = '.footer-widget-area[data-section="section-fb-divider-' . $index . '"]';

		$alignment = astra_get_option( 'footer-divider-' . $index . '-alignment' );

		$desktop_alignment = ( isset( $alignment['desktop'] ) ) ? $alignment['desktop'] : 'center';
		$tablet_alignment  = ( isset( $alignment['tablet'] ) ) ? $alignment['tablet'] : '';
		$mobile_alignment  = ( isset( $alignment['mobile'] ) ) ? $alignment['mobile'] : '';

		$margin = astra_get_option( $_section . '-margin' );

		/**
		 * Copyright CSS.
		 */
		$css_output_desktop = array(
			$selector => array(
				'justify-content' => $desktop_alignment,
				'margin-top'      => astra_responsive_spacing( $margin, 'top', 'desktop' ),
				'margin-bottom'   => astra_responsive_spacing( $margin, 'bottom', 'desktop' ),
				'margin-left'     => astra_responsive_spacing( $margin, 'left', 'desktop' ),
				'margin-right'    => astra_responsive_spacing( $margin, 'right', 'desktop' ),
			),
		);

		$css_output_tablet = array(
			$selector => array(
				'justify-content' => $tablet_alignment,
				// Margin CSS.
				'margin-top'      => astra_responsive_spacing( $margin, 'top', 'tablet' ),
				'margin-bottom'   => astra_responsive_spacing( $margin, 'bottom', 'tablet' ),
				'margin-left'     => astra_responsive_spacing( $margin, 'left', 'tablet' ),
				'margin-right'    => astra_responsive_spacing( $margin, 'right', 'tablet' ),
			),
		);

		$css_output_mobile = array(
			$selector => array(
				'justify-content' => $mobile_alignment,
				// Margin CSS.
				'margin-top'      => astra_responsive_spacing( $margin, 'top', 'mobile' ),
				'margin-bottom'   => astra_responsive_spacing( $margin, 'bottom', 'mobile' ),
				'margin-left'     => astra_responsive_spacing( $margin, 'left', 'mobile' ),
				'margin-right'    => astra_responsive_spacing( $margin, 'right', 'mobile' ),
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
