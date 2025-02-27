<?php
/**
 * Mobile Header - Dynamic CSS
 *
 * @package Astra Addon
 */

/**
 * Mobile Header options.
 */
add_filter( 'astra_addon_dynamic_css', 'astra_addon_mobile_header_spacing_dynamic_css' );

/**
 * Dynamic CSS
 *
 * @param  string $dynamic_css          Astra Dynamic CSS.
 * @param  string $dynamic_css_filtered Astra Dynamic CSS Filters.
 * @return string
 */
function astra_addon_mobile_header_spacing_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' ) {

	$menu_style           = astra_get_option( 'mobile-menu-style' );
	$primary_menu_spacing = astra_get_option( 'primary-menu-spacing' );

	$header_spacing = astra_get_option( 'header-spacing' );

	$css_output = '';

	/**
	 * Responsive Colors options
	 * [4]. Below Header Menu Responsive Colors only for No Toggle menu style
	 */
	if ( 'no-toggle' === $menu_style ) {
		if ( $primary_menu_spacing ) {
			$desktop_spacing = array(
				'.ast-no-toggle-menu-enable.ast-header-break-point .main-header-bar .main-header-menu > .menu-item-has-children > .ast-menu-toggle' => array(
					'padding-left'  => astra_responsive_spacing( $primary_menu_spacing, 'left', 'desktop' ),
					'padding-right' => astra_responsive_spacing( $primary_menu_spacing, 'right', 'desktop' ),
				),
			);
			$tablet_spacing  = array(
				'.ast-no-toggle-menu-enable.ast-header-break-point .main-header-bar .main-header-menu > .menu-item-has-children > .ast-menu-toggle' => array(
					'padding-left'  => astra_responsive_spacing( $primary_menu_spacing, 'left', 'tablet' ),
					'padding-right' => astra_responsive_spacing( $primary_menu_spacing, 'right', 'tablet' ),
				),
			);
			$mobile_spacing  = array(
				'.ast-no-toggle-menu-enable.ast-header-break-point .main-header-bar .main-header-menu > .menu-item-has-children > .ast-menu-toggle' => array(
					'padding-left'  => astra_responsive_spacing( $primary_menu_spacing, 'left', 'mobile' ),
					'padding-right' => astra_responsive_spacing( $primary_menu_spacing, 'right', 'mobile' ),
				),
			);
			$css_output     .= astra_parse_css( $desktop_spacing );
			$css_output     .= astra_parse_css( $tablet_spacing, '', astra_addon_get_tablet_breakpoint() );
			$css_output     .= astra_parse_css( $mobile_spacing, '', astra_addon_get_mobile_breakpoint() );
		}
	}

	/**
	 * Spacing for .main-header-bar. when click on the toggle menu button
	 */

	$desktop_spacing = array(
		// Header Spacing Top / Bottom Padding.
		'.ast-flyout-menu-enable.ast-main-header-nav-open .main-header-bar,.ast-fullscreen-menu-enable.ast-main-header-nav-open .main-header-bar' => array(
			'padding-bottom' => astra_responsive_spacing( $header_spacing, 'bottom', 'desktop' ),
		),
	);
	$tablet_spacing  = array(
		// Header Spacing Top / Bottom Padding.
		'.ast-flyout-menu-enable.ast-main-header-nav-open .main-header-bar,.ast-fullscreen-menu-enable.ast-main-header-nav-open .main-header-bar' => array(
			'padding-bottom' => astra_responsive_spacing( $header_spacing, 'bottom', 'tablet' ),
		),
	);
	$mobile_spacing  = array(
		// Header Spacing Top / Bottom Padding.
		'.ast-flyout-menu-enable.ast-main-header-nav-open .main-header-bar,.ast-fullscreen-menu-enable.ast-main-header-nav-open .main-header-bar' => array(
			'padding-bottom' => astra_responsive_spacing( $header_spacing, 'bottom', 'mobile' ),
		),
	);
	/* Parse CSS from array() */
	$css_output .= astra_parse_css( $desktop_spacing );
	$css_output .= astra_parse_css( $tablet_spacing, '', astra_addon_get_tablet_breakpoint() );
	$css_output .= astra_parse_css( $mobile_spacing, '', astra_addon_get_mobile_breakpoint() );

	return $dynamic_css . $css_output;
}
