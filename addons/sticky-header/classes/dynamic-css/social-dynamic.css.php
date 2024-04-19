<?php
/**
 * Sticky Header Social Dynamic CSS
 *
 * @package Astra Addon
 */

add_filter( 'astra_addon_dynamic_css', 'astra_sticky_header_social_dynamic_css' );

/**
 * Dynamic CSS
 *
 * @param  string $dynamic_css          Astra Dynamic CSS.
 * @param  string $dynamic_css_filtered Astra Dynamic CSS Filters.
 * @return string
 */
function astra_sticky_header_social_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' ) {

	$num_of_header_social_icons = astra_addon_builder_helper()->num_of_header_social_icons;
	for ( $index = 1; $index <= $num_of_header_social_icons; $index++ ) {

		if ( ! Astra_Addon_Builder_Helper::is_component_loaded( 'social-icons-' . $index, 'header' ) ) {
			continue;
		}

		$selector = '.ast-header-sticked .ast-header-social-' . $index . '-wrap';
		$_section = 'section-hb-social-icons-' . $index;

		// Normal Responsive Colors.
		$color_type                 = astra_get_option( 'header-social-' . $index . '-color-type' );
		$social_icons_color_desktop = astra_get_prop( astra_get_option( 'sticky-header-social-' . $index . '-color' ), 'desktop' );
		$social_icons_color_tablet  = astra_get_prop( astra_get_option( 'sticky-header-social-' . $index . '-color' ), 'tablet' );
		$social_icons_color_mobile  = astra_get_prop( astra_get_option( 'sticky-header-social-' . $index . '-color' ), 'mobile' );

		// Hover Responsive Colors.
		$social_icons_h_color_desktop = astra_get_prop( astra_get_option( 'sticky-header-social-' . $index . '-h-color' ), 'desktop' );
		$social_icons_h_color_tablet  = astra_get_prop( astra_get_option( 'sticky-header-social-' . $index . '-h-color' ), 'tablet' );
		$social_icons_h_color_mobile  = astra_get_prop( astra_get_option( 'sticky-header-social-' . $index . '-h-color' ), 'mobile' );

		// Normal Responsive Bg Colors.
		$social_icons_bg_color_desktop = astra_get_prop( astra_get_option( 'sticky-header-social-' . $index . '-bg-color' ), 'desktop' );
		$social_icons_bg_color_tablet  = astra_get_prop( astra_get_option( 'sticky-header-social-' . $index . '-bg-color' ), 'tablet' );
		$social_icons_bg_color_mobile  = astra_get_prop( astra_get_option( 'sticky-header-social-' . $index . '-bg-color' ), 'mobile' );

		// Hover Responsive Bg Colors.
		$social_icons_h_bg_color_desktop = astra_get_prop( astra_get_option( 'sticky-header-social-' . $index . '-bg-h-color' ), 'desktop' );
		$social_icons_h_bg_color_tablet  = astra_get_prop( astra_get_option( 'sticky-header-social-' . $index . '-bg-h-color' ), 'tablet' );
		$social_icons_h_bg_color_mobile  = astra_get_prop( astra_get_option( 'sticky-header-social-' . $index . '-bg-h-color' ), 'mobile' );

		/**
		 * Social Icon CSS.
		 */
		$css_output_desktop = array();

		if ( 'custom' === $color_type ) {

			$css_output_desktop[ $selector . ' .ast-social-color-type-custom .ast-builder-social-element' ]['color']                          = $social_icons_color_desktop;
			$css_output_desktop[ $selector . ' .ast-social-color-type-custom .ast-builder-social-element .social-item-label' ]['color']       = $social_icons_color_desktop;
			$css_output_desktop[ $selector . ' .ast-social-color-type-custom .ast-builder-social-element:hover .social-item-label' ]['color'] = $social_icons_h_color_desktop;
			$css_output_desktop[ $selector . ' .ast-social-color-type-custom .ast-builder-social-element svg' ]['fill']                       = $social_icons_color_desktop;
			$css_output_desktop[ $selector . ' .ast-social-color-type-custom .ast-builder-social-element' ]['background']                     = $social_icons_bg_color_desktop;

			$css_output_desktop[ $selector . ' .ast-social-color-type-custom .ast-builder-social-element:hover' ]     = array(
				// Hover.
				'color'      => $social_icons_h_color_desktop,
				'background' => $social_icons_h_bg_color_desktop,
			);
			$css_output_desktop[ $selector . ' .ast-social-color-type-custom .ast-builder-social-element:hover svg' ] = array(
				'fill' => $social_icons_h_color_desktop,
			);
		}

		/**
		 * Social_icons CSS.
		 */
		$css_output_tablet = array();

		if ( 'custom' === $color_type ) {
			$css_output_tablet[ $selector . ' .ast-social-color-type-custom .ast-builder-social-element' ]['color']                          = $social_icons_color_tablet;
			$css_output_tablet[ $selector . ' .ast-social-color-type-custom .ast-builder-social-element svg' ]['fill']                       = $social_icons_color_tablet;
			$css_output_tablet[ $selector . ' .ast-social-color-type-custom .ast-builder-social-element .social-item-label' ]['color']       = $social_icons_color_tablet;
			$css_output_tablet[ $selector . ' .ast-social-color-type-custom .ast-builder-social-element:hover .social-item-label' ]['color'] = $social_icons_h_color_tablet;
			$css_output_tablet[ $selector . ' .ast-social-color-type-custom .ast-builder-social-element' ]['background']                     = $social_icons_bg_color_tablet;

			$css_output_tablet[ $selector . ' .ast-social-color-type-custom .ast-builder-social-element:hover' ]     = array(
				// Hover.
				'color'      => $social_icons_h_color_tablet,
				'background' => $social_icons_h_bg_color_tablet,
			);
			$css_output_tablet[ $selector . ' .ast-social-color-type-custom .ast-builder-social-element:hover svg' ] = array(
				'fill' => $social_icons_h_color_tablet,
			);
		}

		/**
		 * Social_icons CSS.
		 */
		$css_output_mobile = array();

		if ( 'custom' === $color_type ) {
			$css_output_mobile[ $selector . ' .ast-social-color-type-custom .ast-builder-social-element' ]['color']                          = $social_icons_color_mobile;
			$css_output_mobile[ $selector . ' .ast-social-color-type-custom .ast-builder-social-element svg' ]['fill']                       = $social_icons_color_mobile;
			$css_output_mobile[ $selector . ' .ast-social-color-type-custom .ast-builder-social-element .social-item-label' ]['color']       = $social_icons_color_mobile;
			$css_output_mobile[ $selector . ' .ast-social-color-type-custom .ast-builder-social-element:hover .social-item-label' ]['color'] = $social_icons_h_color_mobile;
			$css_output_mobile[ $selector . ' .ast-social-color-type-custom .ast-builder-social-element' ]['background']                     = $social_icons_bg_color_mobile;

			$css_output_mobile[ $selector . ' .ast-social-color-type-custom .ast-builder-social-element:hover' ]     = array(
				// Hover.
				'color'      => $social_icons_h_color_mobile,
				'background' => $social_icons_h_bg_color_mobile,
			);
			$css_output_mobile[ $selector . ' .ast-social-color-type-custom .ast-builder-social-element:hover svg' ] = array(
				'fill' => $social_icons_h_color_mobile,
			);
		}

		/* Parse CSS from array() */
		$css_output  = astra_parse_css( $css_output_desktop );
		$css_output .= astra_parse_css( $css_output_tablet, '', astra_addon_get_tablet_breakpoint() );
		$css_output .= astra_parse_css( $css_output_mobile, '', astra_addon_get_mobile_breakpoint() );

		$dynamic_css .= $css_output;
	}

	return $dynamic_css;

}
