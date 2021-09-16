<?php
/**
 * Mobile Trigger - Dynamic CSS
 *
 * @package astra-builder
 * @since 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Mobile Trigger.
 */
add_filter( 'astra_dynamic_css', 'astra_sticky_mobile_trigger_design_css' );

/**
 * Mobile Trigger - Dynamic CSS
 *
 * @param  string $dynamic_css          Astra Dynamic CSS.
 * @param  string $dynamic_css_filtered Astra Dynamic CSS Filters.
 * @return String Generated dynamic CSS for Heading Colors.
 *
 * @since 3.0.0
 */
function astra_sticky_mobile_trigger_design_css( $dynamic_css, $dynamic_css_filtered = '' ) {

	if ( ! Astra_Addon_Builder_Helper::is_component_loaded( 'mobile-trigger', 'header', 'mobile' ) ) {
		return $dynamic_css;
	}

	$selector = '[CLASS*="-sticky-header-active"] .ast-header-sticked [data-section="section-header-mobile-trigger"]';

	$theme_color          = astra_get_option( 'theme-color' );
	$trigger_bg           = astra_get_option( 'sticky-header-toggle-btn-bg-color', $theme_color );
	$trigger_border_color = astra_get_option( 'sticky-header-toggle-border-color', $trigger_bg );
	$style                = astra_get_option( 'mobile-header-toggle-btn-style' );
	$default              = '#ffffff';

	if ( 'fill' !== $style ) {
		$default = $theme_color;
	}

	$icon_color = astra_get_option( 'sticky-header-toggle-btn-color', $default );

	/**
	 * Off-Canvas CSS.
	 */
	$css_output = array(
		$selector . ' .ast-button-wrap .mobile-menu-toggle-icon .ast-mobile-svg' => array(
			'fill' => $icon_color,
		),
		$selector . ' .ast-button-wrap .mobile-menu-wrap .mobile-menu' => array(
			// Color.
			'color' => $icon_color,
		),
	);

	if ( 'fill' === $style ) {
		$css_output[ $selector . ' .ast-button-wrap .ast-mobile-menu-trigger-fill' ] = array(
			'background' => esc_attr( $trigger_bg ),
		);
		$css_output[ $selector . ' .ast-button-wrap .ast-mobile-menu-trigger-fill, ' . $selector . ' .ast-button-wrap .ast-mobile-menu-trigger-minimal' ] = array(
			// Color & Border.
			'color'  => esc_attr( $icon_color ),
			'border' => 'none',
		);
	} elseif ( 'outline' === $style ) {
		$css_output[ $selector . ' .ast-button-wrap .ast-mobile-menu-trigger-outline' ] = array(
			// Background.
			'background'   => 'transparent',
			'color'        => esc_attr( $icon_color ),
			'border-color' => $trigger_border_color,
		);
	} else {
		$css_output[ $selector . ' .ast-button-wrap .ast-mobile-menu-trigger-minimal' ] = array(
			'background' => 'transparent',
		);
	}

	/* Parse CSS from array() */
	$css_output = astra_parse_css( $css_output );

	$dynamic_css .= $css_output;

	return $dynamic_css;
}
