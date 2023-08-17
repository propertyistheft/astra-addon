<?php
/**
 * Sticky Header Social Dynamic CSS
 *
 * @package Astra Addon
 */

add_filter( 'astra_addon_dynamic_css', 'astra_sticky_header_account_dynamic_css' );

/**
 * Dynamic CSS
 *
 * @param  string $dynamic_css          Astra Dynamic CSS.
 * @param  string $dynamic_css_filtered Astra Dynamic CSS Filters.
 * @return string
 */
function astra_sticky_header_account_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' ) {

	if ( ! Astra_Addon_Builder_Helper::is_component_loaded( 'account', 'header' ) ) {
		return $dynamic_css;
	}

	$selector = '.ast-header-sticked .ast-header-account-wrap';

	// Menu colors.
	$menu_color           = astra_get_option( 'sticky-header-account-menu-color' );
	$menu_bg_color        = astra_get_option( 'sticky-header-account-menu-bg-obj' );
	$menu_color_hover     = astra_get_option( 'sticky-header-account-menu-h-color' );
	$menu_bg_color_hover  = astra_get_option( 'sticky-header-account-menu-h-bg-color' );
	$menu_color_active    = astra_get_option( 'sticky-header-account-menu-a-color' );
	$menu_bg_color_active = astra_get_option( 'sticky-header-account-menu-a-bg-color' );

	/**
	 * Account CSS.
	 */
	$account_el_css_output = array(

		$selector . ' .ast-header-account-type-icon .ahfb-svg-iconset svg path:not(.ast-hf-account-unfill), ' . $selector . ' .ast-header-account-type-icon .ahfb-svg-iconset svg circle' => array(
			'fill' => esc_attr( astra_get_option( 'sticky-header-account-icon-color' ) ),
		),
		$selector . ' .account-main-navigation ul .menu-item:hover > .menu-link, ' . $selector . ' .account-main-navigation ul .menu-item.current-menu-item:hover > .menu-link' => array(
			'color'      => $menu_color_hover,
			'background' => $menu_bg_color_hover,
		),
		$selector . ' .account-main-navigation ul .menu-item.current-menu-item > .menu-link' => array(
			'color'      => $menu_color_active,
			'background' => $menu_bg_color_active,
		),
		$selector . ' .account-main-navigation ul' => array(
			'background' => $menu_bg_color,
		),
		$selector . ' .account-main-navigation ul .menu-item .menu-link' => array(
			'color' => $menu_color,
		),
		$selector . ' .ast-header-account-text'    => array(
			'color' => esc_attr( astra_get_option( 'sticky-header-account-type-text-color' ) ),
		),
	);

	/* Parse CSS from array() */
	$css_output = astra_parse_css( $account_el_css_output );

	$dynamic_css .= $css_output;

	return $dynamic_css;

}
