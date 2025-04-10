<?php
/**
 * Header Account - Dynamic CSS
 *
 * @package Astra
 * @since 4.3.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Header Account
 */
add_filter( 'astra_dynamic_theme_css', 'astra_addon_hb_account_dynamic_css' );

/**
 * Dynamic CSS
 *
 * @param  string $dynamic_css          Astra Dynamic CSS.
 * @param  string $dynamic_css_filtered Astra Dynamic CSS Filters.
 * @return String Generated dynamic CSS for Account.
 *
 * @since 4.3.1
 */
function astra_addon_hb_account_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' ) {
	$css_output_desktop = array();

	if ( ! Astra_Addon_Builder_Helper::is_component_loaded( 'account', 'header' ) ) {
		return $dynamic_css;
	}

	// Helps with RTL compatibility.
	$is_site_rtl = is_rtl();
	$ltr_left    = $is_site_rtl ? 'right' : 'left';
	$ltr_right   = $is_site_rtl ? 'left' : 'right';

	// Header Account block options.
	$show_menu_on = astra_get_option( 'header-account-action-menu-display-on' );
	$action_type  = astra_get_option( 'header-account-action-type' );

	if ( $action_type && 'menu' === $action_type && $show_menu_on && 'hover' === $show_menu_on ) {
		$css_output_desktop['.ast-desktop .ast-header-account-wrap:hover .ast-account-nav-menu, .ast-desktop .ast-header-account-wrap:focus .ast-account-nav-menu'] = array(
			$ltr_right => esc_attr( '-100%' ),
			$ltr_left  => esc_attr( 'auto' ),
		);
	}

	if ( $action_type && 'menu' === $action_type && $show_menu_on && 'click' === $show_menu_on ) {
		$css_output_desktop['.ast-header-account-wrap'] = array(
			'cursor' => esc_attr( 'pointer' ),
		);
	}

	/* Parse CSS from array() */
	$css_output = astra_parse_css( $css_output_desktop );

	$dynamic_css .= $css_output;

	return $dynamic_css;
}
