<?php
/**
 * Sticky Header Social Dynamic CSS
 *
 * @package Astra Addon
 */

add_filter( 'astra_dynamic_css', 'astra_sticky_header_account_dynamic_css' );

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
	$menu_resp_color           = astra_get_option( 'sticky-header-account-menu-color-responsive' );
	$menu_resp_bg_color        = astra_get_option( 'sticky-header-account-menu-bg-obj-responsive' );
	$menu_resp_color_hover     = astra_get_option( 'sticky-header-account-menu-h-color-responsive' );
	$menu_resp_bg_color_hover  = astra_get_option( 'sticky-header-account-menu-h-bg-color-responsive' );
	$menu_resp_color_active    = astra_get_option( 'sticky-header-account-menu-a-color-responsive' );
	$menu_resp_bg_color_active = astra_get_option( 'sticky-header-account-menu-a-bg-color-responsive' );

	$menu_resp_color_desktop = ( isset( $menu_resp_color['desktop'] ) ) ? $menu_resp_color['desktop'] : '';
	$menu_resp_color_tablet  = ( isset( $menu_resp_color['tablet'] ) ) ? $menu_resp_color['tablet'] : '';
	$menu_resp_color_mobile  = ( isset( $menu_resp_color['mobile'] ) ) ? $menu_resp_color['mobile'] : '';

	$menu_resp_bg_color_desktop = ( isset( $menu_resp_bg_color['desktop'] ) ) ? $menu_resp_bg_color['desktop'] : '';
	$menu_resp_bg_color_tablet  = ( isset( $menu_resp_bg_color['tablet'] ) ) ? $menu_resp_bg_color['tablet'] : '';
	$menu_resp_bg_color_mobile  = ( isset( $menu_resp_bg_color['mobile'] ) ) ? $menu_resp_bg_color['mobile'] : '';

	$menu_resp_color_hover_desktop = ( isset( $menu_resp_color_hover['desktop'] ) ) ? $menu_resp_color_hover['desktop'] : '';
	$menu_resp_color_hover_tablet  = ( isset( $menu_resp_color_hover['tablet'] ) ) ? $menu_resp_color_hover['tablet'] : '';
	$menu_resp_color_hover_mobile  = ( isset( $menu_resp_color_hover['mobile'] ) ) ? $menu_resp_color_hover['mobile'] : '';

	$menu_resp_bg_color_hover_desktop = ( isset( $menu_resp_bg_color_hover['desktop'] ) ) ? $menu_resp_bg_color_hover['desktop'] : '';
	$menu_resp_bg_color_hover_tablet  = ( isset( $menu_resp_bg_color_hover['tablet'] ) ) ? $menu_resp_bg_color_hover['tablet'] : '';
	$menu_resp_bg_color_hover_mobile  = ( isset( $menu_resp_bg_color_hover['mobile'] ) ) ? $menu_resp_bg_color_hover['mobile'] : '';

	$menu_resp_color_active_desktop = ( isset( $menu_resp_color_active['desktop'] ) ) ? $menu_resp_color_active['desktop'] : '';
	$menu_resp_color_active_tablet  = ( isset( $menu_resp_color_active['tablet'] ) ) ? $menu_resp_color_active['tablet'] : '';
	$menu_resp_color_active_mobile  = ( isset( $menu_resp_color_active['mobile'] ) ) ? $menu_resp_color_active['mobile'] : '';

	$menu_resp_bg_color_active_desktop = ( isset( $menu_resp_bg_color_active['desktop'] ) ) ? $menu_resp_bg_color_active['desktop'] : '';
	$menu_resp_bg_color_active_tablet  = ( isset( $menu_resp_bg_color_active['tablet'] ) ) ? $menu_resp_bg_color_active['tablet'] : '';
	$menu_resp_bg_color_active_mobile  = ( isset( $menu_resp_bg_color_active['mobile'] ) ) ? $menu_resp_bg_color_active['mobile'] : '';

	/**
	 * Account CSS.
	 */
	$css_output_desktop = array(

		$selector . ' .ast-header-account-type-icon .ahfb-svg-iconset svg path:not(.ast-hf-account-unfill), ' . $selector . ' .ast-header-account-type-icon .ahfb-svg-iconset svg circle' => array(
			'fill' => esc_attr( astra_get_option( 'sticky-header-account-icon-color' ) ),
		),
		$selector . ' .menu-item:hover > .menu-link' => array(
			'color'      => $menu_resp_color_hover_desktop,
			'background' => $menu_resp_bg_color_hover_desktop,
		),
		$selector . ' .menu-item.current-menu-item > .menu-link' => array(
			'color'      => $menu_resp_color_active_desktop,
			'background' => $menu_resp_bg_color_active_desktop,
		),
		$selector . ' .account-main-navigation ul'   => array(
			'background' => $menu_resp_bg_color_desktop,
		),
		$selector . ' .ast-header-account-text'      => array(
			'color' => esc_attr( astra_get_option( 'sticky-header-account-type-text-color' ) ),
		),
	);

	$css_output_tablet = array(
		$selector . ' .ast-account-nav-menu .menu-item .menu-link' => array(
			'color' => $menu_resp_color_tablet,
		),
		$selector . ' .menu-item:hover > .menu-link' => array(
			'color'      => $menu_resp_color_hover_tablet,
			'background' => $menu_resp_bg_color_hover_tablet,
		),
		$selector . ' .menu-item.current-menu-item > .menu-link' => array(
			'color'      => $menu_resp_color_active_tablet,
			'background' => $menu_resp_bg_color_active_tablet,
		),
		$selector . ' .account-main-navigation ul'   => array(
			'background' => $menu_resp_bg_color_tablet,
		),
	);

	$css_output_mobile = array(
		$selector . ' .ast-account-nav-menu .menu-item .menu-link' => array(
			'color' => $menu_resp_color_mobile,
		),
		$selector . ' .menu-item:hover > .menu-link' => array(
			'color'      => $menu_resp_color_hover_mobile,
			'background' => $menu_resp_bg_color_hover_mobile,
		),
		$selector . ' .menu-item.current-menu-item > .menu-link' => array(
			'color'      => $menu_resp_color_active_mobile,
			'background' => $menu_resp_bg_color_active_mobile,
		),
		$selector . ' .account-main-navigation ul'   => array(
			'background' => $menu_resp_bg_color_mobile,
		),
	);

	/* Parse CSS from array() */
	$css_output  = astra_parse_css( $css_output_desktop );
	$css_output .= astra_parse_css( $css_output_tablet, '', astra_get_tablet_breakpoint() );
	$css_output .= astra_parse_css( $css_output_mobile, '', astra_get_mobile_breakpoint() );

	$dynamic_css .= $css_output;

	return $dynamic_css;

}
