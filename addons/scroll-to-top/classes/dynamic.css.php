<?php
/**
 * Scroll To Top - Dynamic CSS
 *
 * @package Astra Addon
 */

add_filter( 'astra_dynamic_css', 'astra_ext_scroll_to_top_dynamic_css' );

/**
 * Dynamic CSS
 *
 * @param  string $dynamic_css          Astra Dynamic CSS.
 * @param  string $dynamic_css_filtered Astra Dynamic CSS Filters.
 * @return string
 */
function astra_ext_scroll_to_top_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' ) {

	$link_color                    = astra_get_option( 'link-color' );
	$scroll_to_top_icon_size       = astra_get_option( 'scroll-to-top-icon-size', 15 );
	$scroll_to_top_icon_radius     = astra_get_option( 'scroll-to-top-icon-radius' );
	$scroll_to_top_icon_color      = astra_get_option( 'scroll-to-top-icon-color' );
	$scroll_to_top_icon_h_color    = astra_get_option( 'scroll-to-top-icon-h-color' );
	$scroll_to_top_icon_bg_color   = astra_get_option( 'scroll-to-top-icon-bg-color', $link_color );
	$scroll_to_top_icon_h_bg_color = astra_get_option( 'scroll-to-top-icon-h-bg-color' );
	$scroll_to_top_icon_alignment  = astra_get_option( 'scroll-to-top-icon-position' );
	$scroll_to_top_padded_padding  = apply_filters( 'astra_scroll_top_padded_padding', 30 );

	// Padded Layout - Padding.
	$padded_layout_padding = astra_get_option( 'site-layout-padded-pad' );
	$site_layout_padding   = astra_get_option( 'site-layout' );

	$scroll_to_top = array(
		'#ast-scroll-top'       => array(
			'color'            => $scroll_to_top_icon_color,
			'background-color' => $scroll_to_top_icon_bg_color,
			'font-size'        => astra_get_css_value( $scroll_to_top_icon_size, 'rem' ),
			'border-radius'    => astra_get_css_value( $scroll_to_top_icon_radius, 'px' ),
		),
		'#ast-scroll-top:hover' => array(
			'color'            => $scroll_to_top_icon_h_color,
			'background-color' => $scroll_to_top_icon_h_bg_color,
		),
	);

	$scroll_css = astra_parse_css( $scroll_to_top );

	if ( false === Astra_Icons::is_svg_icons() ) {
		$scroll_to_top_icon = array(
			'.ast-scroll-top-icon::before' => array(
				'content'         => '"\e900"',
				'font-family'     => 'Astra',
				'text-decoration' => 'inherit',
			),
			'.ast-scroll-top-icon'         => array(
				'transform' => 'rotate(180deg)',
			),

		);

		$scroll_css .= astra_parse_css( $scroll_to_top_icon );
	}

	// Only if Padded layout is selected from Site Layout Addon.
	if ( Astra_Ext_Extension::is_active( 'site-layouts' ) && 'ast-padded-layout' === $site_layout_padding ) {

		if ( 'right' == $scroll_to_top_icon_alignment ) {
			$padded_spacing = array(
				/**
				 * Add spacing based on padded layout spacing
				 */
				'.ast-padded-layout .ast-scroll-to-top-right' => array(
					'right'  => astra_get_css_value( intval( $padded_layout_padding['desktop']['right'] ) + $scroll_to_top_padded_padding, $padded_layout_padding['desktop-unit'] ),
					'bottom' => astra_get_css_value( intval( $padded_layout_padding['desktop']['bottom'] ) + $scroll_to_top_padded_padding, $padded_layout_padding['desktop-unit'] ),
				),
			);

			$tablet_padded_spacing = array(
				/**
				 * Add spacing based on padded layout spacing
				 */
				'.ast-padded-layout .ast-scroll-to-top-right' => array(
					'right'  => astra_get_css_value( intval( $padded_layout_padding['tablet']['right'] ) + $scroll_to_top_padded_padding, $padded_layout_padding['tablet-unit'] ),
					'bottom' => astra_get_css_value( intval( $padded_layout_padding['tablet']['bottom'] ) + $scroll_to_top_padded_padding, $padded_layout_padding['tablet-unit'] ),
				),
			);

			$mobile_padded_spacing = array(
				/**
				 * Add spacing based on padded layout spacing
				 */
				'.ast-padded-layout .ast-scroll-to-top-right' => array(
					'right'  => astra_get_css_value( intval( $padded_layout_padding['mobile']['right'] ) + $scroll_to_top_padded_padding, $padded_layout_padding['mobile-unit'] ),
					'bottom' => astra_get_css_value( intval( $padded_layout_padding['mobile']['bottom'] ) + $scroll_to_top_padded_padding, $padded_layout_padding['mobile-unit'] ),
				),
			);
		} else {
			$padded_spacing = array(
				/**
				 * Add spacing based on padded layout spacing
				 */
				'.ast-padded-layout .ast-scroll-to-top-left' => array(
					'left'   => astra_get_css_value( intval( $padded_layout_padding['desktop']['left'] ) + $scroll_to_top_padded_padding, $padded_layout_padding['desktop-unit'] ),
					'bottom' => astra_get_css_value( intval( $padded_layout_padding['desktop']['bottom'] ) + $scroll_to_top_padded_padding, $padded_layout_padding['desktop-unit'] ),
				),
			);

			$tablet_padded_spacing = array(
				/**
				 * Add spacing based on padded layout spacing
				 */
				'.ast-padded-layout .ast-scroll-to-top-left' => array(
					'left'   => astra_get_css_value( intval( $padded_layout_padding['tablet']['left'] ) + $scroll_to_top_padded_padding, $padded_layout_padding['tablet-unit'] ),
					'bottom' => astra_get_css_value( intval( $padded_layout_padding['tablet']['bottom'] ) + $scroll_to_top_padded_padding, $padded_layout_padding['tablet-unit'] ),
				),
			);

			$mobile_padded_spacing = array(
				/**
				 * Add spacing based on padded layout spacing
				 */
				'.ast-padded-layout .ast-scroll-to-top-left' => array(
					'left'   => astra_get_css_value( intval( $padded_layout_padding['mobile']['left'] ) + $scroll_to_top_padded_padding, $padded_layout_padding['mobile-unit'] ),
					'bottom' => astra_get_css_value( intval( $padded_layout_padding['mobile']['bottom'] ) + $scroll_to_top_padded_padding, $padded_layout_padding['mobile-unit'] ),
				),
			);
		}
		/* Parse CSS from array() */
		$scroll_css .= astra_parse_css( $padded_spacing );
		$scroll_css .= astra_parse_css( $tablet_padded_spacing, '', astra_addon_get_tablet_breakpoint() );
		$scroll_css .= astra_parse_css( $mobile_padded_spacing, '', astra_addon_get_mobile_breakpoint() );
	}

	return $dynamic_css . $scroll_css;
}
