<?php
/**
 * Mega Menu - Dynamic CSS
 *
 * @package Astra Addon
 */

add_filter( 'astra_dynamic_css', 'astra_ext_mega_menu_dynamic_css' );

/**
 * Dynamic CSS
 *
 * @param  string $dynamic_css          Astra Dynamic CSS.
 * @param  string $dynamic_css_filtered Astra Dynamic CSS Filters.
 * @return string
 */
function astra_ext_mega_menu_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' ) {

	$css = '';

	$common_css_output = array(
		'.ast-desktop .ast-mm-widget-content .ast-mm-widget-item' => array(
			'padding' => 0,
		),
	);

	// Common options of Above Header.
	$css .= astra_parse_css( $common_css_output );

	if ( false === Astra_Icons::is_svg_icons() ) {
		$astra_font = array(
			'.ast-desktop .ast-mega-menu-enabled.main-header-menu > .menu-item-has-children > .menu-link .sub-arrow:after, .ast-desktop .ast-mega-menu-enabled.ast-below-header-menu > .menu-item-has-children > .menu-link .sub-arrow:after, .ast-desktop .ast-mega-menu-enabled.ast-above-header-menu > .menu-item-has-children > .menu-link .sub-arrow:after' => array(
				'content'                 => '"\e900"',
				'display'                 => 'inline-block',
				'font-family'             => 'Astra',
				'font-size'               => '9px',
				'font-size'               => '.6rem',
				'font-weight'             => 'bold',
				'text-rendering'          => 'auto',
				'-webkit-font-smoothing'  => 'antialiased',
				'-moz-osx-font-smoothing' => 'grayscale',
				'margin-left'             => '10px',
				'line-height'             => 'normal',
			),
		);
	} else {
		$astra_font = array(
			'.ast-header-break-point .menu-text + .icon-arrow, .ast-desktop .menu-link > .icon-arrow:first-child, .ast-header-break-point .main-header-menu > .menu-item > .menu-link .icon-arrow, .ast-header-break-point .astra-mm-highlight-label + .icon-arrow' => array(
				'display' => 'none',
			),
		);
	}

	/* Parse CSS from array() */
	$css .= astra_parse_css( $astra_font );

	return $dynamic_css . $css;
}
