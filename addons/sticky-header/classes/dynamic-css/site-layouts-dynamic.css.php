<?php
/**
 * Sticky Header for Site Layouts Dynamic CSS
 *
 * @package Astra Addon
 */

add_filter( 'astra_addon_dynamic_css', 'astra_ext_sticky_header_with_site_layouts_dynamic_css' );

/**
 * Dynamic CSS
 *
 * @param  string $dynamic_css          Astra Dynamic CSS.
 * @param  string $dynamic_css_filtered Astra Dynamic CSS Filters.
 * @return string
 */
function astra_ext_sticky_header_with_site_layouts_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' ) {

	$stick_header            = astra_get_option_meta( 'stick-header-meta' );
	$stick_header_main_meta  = astra_get_option_meta( 'header-main-stick-meta' );
	$stick_header_above_meta = astra_get_option_meta( 'header-above-stick-meta' );
	$stick_header_below_meta = astra_get_option_meta( 'header-below-stick-meta' );

	$stick_header_main  = astra_get_option( 'header-main-stick' );
	$stick_header_above = astra_get_option( 'header-above-stick' );
	$stick_header_below = astra_get_option( 'header-below-stick' );

	$site_layout = astra_get_option( 'site-layout' );

	if ( ! $stick_header_main && ! $stick_header_above && ! $stick_header_below && ( 'disabled' !== $stick_header && empty( $stick_header ) && ( empty( $stick_header_above_meta ) || empty( $stick_header_below_meta ) || empty( $stick_header_main_meta ) ) ) ) {
		return $dynamic_css;
	}

	$parse_css = '';
	$css       = '';

	/**
	 * Sticky Header with Site Layouts
	 */

	$page_width = '100%';
	if ( 'ast-box-layout' == $site_layout ) {
		$page_width = astra_get_option( 'site-layout-box-width' ) . 'px';
	}
	if ( 'ast-padded-layout' == $site_layout ) {

		$padded_layout_padding = astra_get_option( 'site-layout-padded-pad' );

		/**
		 * Padded layout Desktop Spacing
		 */
		$padded_layout_spacing = array(
			'#ast-fixed-header' => array(
				'top'    => astra_responsive_spacing( $padded_layout_padding, 'top', 'desktop' ),
				'left'   => astra_responsive_spacing( $padded_layout_padding, 'left', 'desktop' ),
				'margin' => esc_attr( 0 ),
			),
		);
		/**
		 * Padded layout Tablet Spacing
		 */
		$tablet_padded_layout_spacing = array(
			'#ast-fixed-header' => array(
				'top'    => astra_responsive_spacing( $padded_layout_padding, 'top', 'tablet' ),
				'left'   => astra_responsive_spacing( $padded_layout_padding, 'left', 'tablet' ),
				'margin' => esc_attr( 0 ),
			),
		);

		/**
		 * Padded layout Mobile Spacing
		 */
		$mobile_padded_layout_spacing = array(
			'#ast-fixed-header' => array(
				'top'    => astra_responsive_spacing( $padded_layout_padding, 'top', 'mobile' ),
				'left'   => astra_responsive_spacing( $padded_layout_padding, 'left', 'mobile' ),
				'margin' => esc_attr( 0 ),
			),
		);

		$parse_css .= astra_parse_css( $padded_layout_spacing );
		$parse_css .= astra_parse_css( $tablet_padded_layout_spacing, '', astra_addon_get_tablet_breakpoint() );
		$parse_css .= astra_parse_css( $mobile_padded_layout_spacing, '', astra_addon_get_mobile_breakpoint() );
	}
	$css       .= '.ast-above-header, .main-header-bar, .ast-below-header {';
	$css       .= '-webkit-transition: all 0.2s linear;';
	$css       .= 'transition: all 0.2s linear;';
	$css       .= '}';
	$css       .= '.ast-above-header, .main-header-bar, .ast-below-header {';
	$css       .= 'max-width:' . esc_attr( $page_width ) . ';';
	$css       .= '}';
	$parse_css .= $css;

	return $dynamic_css . $parse_css;
}
