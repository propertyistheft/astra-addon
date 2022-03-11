<?php
/**
 * Mobile Header - Dynamic CSS
 *
 * @package Astra Addon
 */

/**
 * Mobile Header options.
 */
add_filter( 'astra_addon_dynamic_css', 'astra_addon_mobile_above_header_dynamic_css' );

/**
 * Dynamic CSS
 *
 * @param  string $dynamic_css          Astra Dynamic CSS.
 * @param  string $dynamic_css_filtered Astra Dynamic CSS Filters.
 * @return string                      Inline updated CSS.
 */
function astra_addon_mobile_above_header_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' ) {

	$above_header_layout = astra_get_option( 'above-header-layout' );

	if ( 'disabled' == $above_header_layout ) {
		return $dynamic_css;
	}

	$above_header_menu_spacing = astra_get_option( 'above-header-menu-spacing' );
	$theme_color               = astra_get_option( 'theme-color' );
	$theme_link_color          = astra_get_option( 'link-color' );
	$theme_link_hover_color    = astra_get_option( 'link-h-color' );
	$btn_bg_color              = astra_get_option( 'button-bg-color', $theme_color );

	$mobile_above_header_toggle_btn_style_color   = astra_get_option( 'mobile-above-header-toggle-btn-style-color', $btn_bg_color );
	$mobile_above_header_toggle_btn_border_radius = astra_get_option( 'mobile-above-header-toggle-btn-border-radius' );
	$mobile_above_header_toggle_btn_style         = astra_get_option( 'mobile-above-header-toggle-btn-style' );

	// Mobile Above Header Section options.
	$above_menu_style            = astra_get_option( 'mobile-above-header-menu-style' );
	$above_flayout_sidebar_width = apply_filters( 'astra_above_flayout_sidebar_width', 325 );

	$above_header_text_color = astra_get_option( 'above-header-text-color-responsive' );

	$desktop_above_header_link_color = astra_get_prop( astra_get_option( 'above-header-link-color-responsive' ), 'desktop', $theme_link_color );
	$tablet_above_header_link_color  = astra_get_prop( astra_get_option( 'above-header-link-color-responsive' ), 'tablet' );
	$mobile_above_header_link_color  = astra_get_prop( astra_get_option( 'above-header-link-color-responsive' ), 'mobile' );

	$desktop_above_header_link_h_color = astra_get_prop( astra_get_option( 'above-header-link-h-color-responsive' ), 'desktop', $theme_link_hover_color );
	$tablet_above_header_link_h_color  = astra_get_prop( astra_get_option( 'above-header-link-h-color-responsive' ), 'tablet' );
	$mobile_above_header_link_h_color  = astra_get_prop( astra_get_option( 'above-header-link-h-color-responsive' ), 'mobile' );

	$above_header_menu_bg_obj = astra_get_option( 'above-header-menu-bg-obj-responsive' );

	// Mobile Above Header menu color.
	$above_header_menu_color           = astra_get_option( 'above-header-menu-color-responsive' );
	$above_header_menu_h_color         = astra_get_option( 'above-header-menu-h-color-responsive' );
	$above_header_menu_h_bg_color      = astra_get_option( 'above-header-menu-h-bg-color-responsive' );
	$above_header_menu_active_color    = astra_get_option( 'above-header-menu-active-color-responsive' );
	$above_header_menu_active_bg_color = astra_get_option( 'above-header-menu-active-bg-color-responsive' );

	$above_header_submenu_text_color      = astra_get_option( 'above-header-submenu-text-color-responsive' );
	$above_header_submenu_bg_color        = astra_get_option( 'above-header-submenu-bg-color-responsive' );
	$above_header_submenu_hover_color     = astra_get_option( 'above-header-submenu-hover-color-responsive' );
	$above_header_submenu_bg_hover_color  = astra_get_option( 'above-header-submenu-bg-hover-color-responsive' );
	$above_header_submenu_active_color    = astra_get_option( 'above-header-submenu-active-color-responsive' );
	$above_header_submenu_active_bg_color = astra_get_option( 'above-header-submenu-active-bg-color-responsive' );

	$above_header_bg_obj = astra_get_option( 'above-header-bg-obj-responsive' );
	$desktop_background  = isset( $above_header_bg_obj['desktop']['background-color'] ) ? $above_header_bg_obj['desktop']['background-color'] : '';
	$tablet_background   = isset( $above_header_bg_obj['desktop']['background-color'] ) ? $above_header_bg_obj['desktop']['background-color'] : '';
	$mobile_background   = isset( $above_header_bg_obj['desktop']['background-color'] ) ? $above_header_bg_obj['desktop']['background-color'] : '';

	$mobile_header_close_desktop_color = astra_get_prop( astra_get_option( 'above-header-menu-color-responsive' ), 'desktop', $theme_link_color );
	$mobile_header_close_tablet_color  = astra_get_prop( astra_get_option( 'above-header-menu-color-responsive' ), 'tablet' );
	$mobile_header_close_mobile_color  = astra_get_prop( astra_get_option( 'above-header-menu-color-responsive' ), 'mobile' );

	$mobile_above_header_menu_all_border = astra_get_option( 'mobile-above-header-menu-all-border' );
	$mobile_above_header_menu_b_color    = astra_get_option( 'mobile-above-header-menu-b-color', '#dadada' );

	$above_header_merge = astra_get_option( 'above-header-merge-menu' );

	$header_break_point = astra_header_break_point(); // Header Break Point.

	$css_output = '';

	/**
	 * Responsive Colors options
	 * [1]. Above Header Menu Responsive Colors general
	 * [2]. Above Header Menu Responsive Colors only for Full Screen menu style
	 * [3]. Above Header Menu Responsive Colors only for Flyout menu style
	 */

	/**
	 * Responsive Colors options
	 * [1]. Above Header Menu Responsive Colors general
	 */
	$desktop_colors = array(
		// Menu Toggle Outline.
		'.ast-header-break-point .ast-above-mobile-menu-buttons-outline.menu-toggle' => array(
			'background' => 'transparent',
			'border'     => '1px solid ' . $mobile_above_header_toggle_btn_style_color,
			'color'      => esc_attr( $mobile_above_header_toggle_btn_style_color ),
		),

		// Menu Toggle Minimal.
		'.ast-header-break-point .ast-above-mobile-menu-buttons-minimal.menu-toggle' => array(
			'background' => 'transparent',
			'color'      => esc_attr( $mobile_above_header_toggle_btn_style_color ),
		),

		// Menu Toggle Fill.
		'.ast-header-break-point .ast-above-mobile-menu-buttons-fill.menu-toggle' => array(
			'border'     => '1px solid ' . $mobile_above_header_toggle_btn_style_color,
			'background' => esc_attr( $mobile_above_header_toggle_btn_style_color ),
			'color'      => astra_get_foreground_color( $mobile_above_header_toggle_btn_style_color ),
		),

		// Menu Toggle Border Radius.
		'.ast-header-break-point .ast-above-header .ast-button-wrap .menu-toggle' => array(
			'border-radius' => esc_attr( $mobile_above_header_toggle_btn_border_radius ) . 'px',
		),

		// Above header Background.
		'.ast-header-break-point .ast-above-header'      => astra_get_responsive_background_obj( $above_header_bg_obj, 'desktop' ),
		'.ast-header-break-point .ast-above-header-section-separated .ast-above-header-navigation .ast-above-header-menu' => array(
			'background-color' => esc_attr( $desktop_background ),
		),

		// Mobile above header text color.
		'.ast-header-break-point .ast-above-header-section .user-select,.ast-header-break-point .ast-above-header-section .widget, .ast-header-break-point .ast-above-header-section .widget-title' => array(
			'color' => esc_attr( $above_header_text_color['desktop'] ),
		),
		'.ast-header-break-point .ast-above-header-section .search-field:focus' => array(
			'border-color' => esc_attr( $above_header_text_color['desktop'] ),
		),
		// Mobile above header link color.
		'.ast-header-break-point .ast-above-header-section .user-select a, .ast-header-break-point .ast-above-header-section .widget a' => array(
			'color' => esc_attr( $desktop_above_header_link_color ),
		),
		// Mobile above header link hover color.
		'.ast-header-break-point .ast-above-header-section .user-select a:hover, .ast-header-break-point .ast-above-header-section .widget a:hover' => array(
			'color' => esc_attr( $desktop_above_header_link_h_color ),
		),
		// Mobile above header menu active color.
		'.ast-header-break-point .ast-above-header-navigation .menu-item.current-menu-ancestor > .ast-menu-toggle, .ast-header-break-point .ast-above-header-navigation .menu-item.current-menu-ancestor:hover > .ast-menu-toggle.ast-header-break-point .ast-above-header-navigation .menu-item.current-menu-item > .ast-menu-toggle, .ast-header-break-point .ast-above-header-navigation .menu-item.current-menu-item > .menu-link, .ast-header-break-point .ast-above-header-navigation .menu-item.current-menu-ancestor > .ast-menu-toggle, .ast-header-break-point .ast-above-header-navigation .menu-item.current-menu-ancestor > .menu-link,.ast-header-break-point .ast-above-header-navigation .menu-item.current-menu-item > .menu-link' => array(
			'color' => esc_attr( $above_header_menu_active_color['desktop'] ),
		),
		// Mobile above header menu active bg color.
		'.ast-header-break-point .ast-above-header-navigation .menu-item.current-menu-item > .menu-link, .ast-header-break-point .ast-above-header-navigation .menu-item.current-menu-ancestor > .menu-link' => array(
			'background-color' => esc_attr( $above_header_menu_active_bg_color['desktop'] ),
		),
		'.ast-header-break-point .ast-above-header-menu' => astra_get_responsive_background_obj( $above_header_menu_bg_obj, 'desktop' ),
		// Mobile above header menu active bg color.
		'.ast-header-break-point .ast-above-header-menu, .ast-header-break-point .ast-above-header-navigation a, .ast-header-break-point .ast-above-header-navigation .menu-item:hover > .ast-menu-toggle, .ast-header-break-point .ast-above-header-navigation .menu-item.focus > .ast-menu-toggle, .ast-header-break-point .ast-above-header-navigation  .current-menu-item > .ast-menu-toggle, .ast-header-break-point .ast-above-header-navigation .current-menu-ancestor > .ast-menu-toggle' => array(
			'color' => esc_attr( $above_header_menu_color['desktop'] ),
		),
		// Mobile above header menu active bg color.
		'.ast-header-break-point .ast-above-header-navigation a:hover, .ast-header-break-point .ast-above-header-navigation .menu-item:hover > .menu-link, .ast-header-break-point .ast-above-header-navigation .menu-item.focus > .menu-link' => array(
			'color' => esc_attr( $above_header_menu_h_color['desktop'] ),
		),
		'.ast-header-break-point .ast-above-header-navigation .menu-item:hover > .ast-menu-toggle, .ast-header-break-point .ast-above-header-navigation .menu-item.focus > .ast-menu-toggle' => array(
			'color' => esc_attr( $above_header_menu_h_color['desktop'] ),
		),

		// Mobile above header menu hover bg color.
		'.ast-header-break-point .ast-above-header-navigation a:hover, .ast-header-break-point .ast-above-header-navigation .menu-item:hover > .menu-link, .ast-header-break-point .ast-above-header-navigation .menu-item.focus > .menu-link' => array(
			'background-color' => esc_attr( $above_header_menu_h_bg_color['desktop'] ),
		),
		// Submenu.
		'.ast-header-break-point .ast-above-header-navigation .sub-menu, .ast-header-break-point .ast-above-header-navigation .sub-menu .menu-link' => array(
			'color' => esc_attr( $above_header_submenu_text_color['desktop'] ),
		),
		// Submenu bg color.
		'.ast-header-break-point .ast-above-header-section-separated .ast-above-header-navigation .sub-menu, .ast-header-break-point .ast-above-header-menu .sub-menu .menu-item' => array(
			'background-color' => esc_attr( $above_header_submenu_bg_color['desktop'] ),
		),
		// Submenu hover color.
		'.ast-header-break-point .ast-above-header-menu .sub-menu .menu-item:hover > .menu-link, .ast-header-break-point .ast-above-header-menu .sub-menu .menu-item:hover > .ast-menu-toggle, .ast-header-break-point .ast-above-header-menu .sub-menu .menu-item:focus > .menu-link' => array(
			'color' => esc_attr( $above_header_submenu_hover_color['desktop'] ),
		),
		// Submenu bg hover color.
		'.ast-header-break-point .ast-above-header-menu .sub-menu .menu-link:hover, .ast-header-break-point .ast-above-header-menu .sub-menu .menu-item:hover > .menu-link, .ast-header-break-point .ast-above-header-menu .sub-menu .menu-item.focus > .menu-link' => array(
			'background-color' => esc_attr( $above_header_submenu_bg_hover_color['desktop'] ),
		),
		// Submenu active color.
		'.ast-header-break-point .ast-above-header-menu .sub-menu .menu-item.current-menu-item > .menu-link, .ast-header-break-point .ast-above-header-menu .sub-menu .menu-item.current-menu-ancestor > .menu-link' => array(
			'color' => esc_attr( $above_header_submenu_active_color['desktop'] ),
		),
		// Submenu active BG color.
		'.ast-header-break-point .ast-above-header-menu .sub-menu .menu-item.current-menu-item > .menu-link, .ast-header-break-point .ast-above-header-menu .sub-menu .menu-item.current-menu-ancestor > .menu-link' => array(
			'background-color' => esc_attr( $above_header_submenu_active_bg_color['desktop'] ),
		),
	);
	$tablet_colors = array(

		// Above header Background.
		'.ast-header-break-point .ast-above-header'      => astra_get_responsive_background_obj( $above_header_bg_obj, 'tablet' ),
		'.ast-header-break-point .ast-above-header-section-separated .ast-above-header-navigation .ast-above-header-menu' => array(
			'background-color' => esc_attr( $tablet_background ),
		),

		// Mobile above header text color.
		'.ast-header-break-point .ast-above-header-section .user-select,.ast-header-break-point .ast-above-header-section .widget, .ast-header-break-point .ast-above-header-section .widget-title' => array(
			'color' => esc_attr( $above_header_text_color['tablet'] ),
		),
		'.ast-header-break-point .ast-above-header-section .search-field:focus' => array(
			'border-color' => esc_attr( $above_header_text_color['tablet'] ),
		),
		// Mobile above header link color.
		'.ast-header-break-point .ast-above-header-section .user-select a, .ast-header-break-point .ast-above-header-section .widget a' => array(
			'color' => esc_attr( $tablet_above_header_link_color ),
		),
		// Mobile above header link hover color.
		'.ast-header-break-point .ast-above-header-section .user-select a:hover, .ast-header-break-point .ast-above-header-section .widget a:hover' => array(
			'color' => esc_attr( $tablet_above_header_link_h_color ),
		),
		'.ast-header-break-point .ast-above-header-menu' => astra_get_responsive_background_obj( $above_header_menu_bg_obj, 'tablet' ),
		// Mobile above header menu active color.
		'.ast-header-break-point .ast-above-header-navigation .menu-item.current-menu-ancestor > .ast-menu-toggle, .ast-header-break-point .ast-above-header-navigation .menu-item.current-menu-ancestor:hover > .ast-menu-toggle.ast-header-break-point .ast-above-header-navigation .menu-item.current-menu-item > .ast-menu-toggle, .ast-header-break-point .ast-above-header-navigation .menu-item.current-menu-item > .menu-link, .ast-header-break-point .ast-above-header-navigation .menu-item.current-menu-ancestor > .ast-menu-toggle, .ast-header-break-point .ast-above-header-navigation .menu-item.current-menu-ancestor > .menu-link,.ast-header-break-point .ast-above-header-navigation .menu-item.current-menu-item > .menu-link' => array(
			'color' => esc_attr( $above_header_menu_active_color['tablet'] ),
		),
		// Mobile above header menu active bg color.
		'.ast-header-break-point .ast-above-header-navigation .menu-item.current-menu-item > .menu-link, .ast-header-break-point .ast-above-header-navigation .menu-item.current-menu-ancestor > .menu-link' => array(
			'background-color' => esc_attr( $above_header_menu_active_bg_color['tablet'] ),
		),
		// Mobile above header menu active bg color.
		'.ast-header-break-point .ast-above-header-menu, .ast-header-break-point .ast-above-header-navigation a, .ast-header-break-point .ast-above-header-navigation .menu-item:hover > .ast-menu-toggle, .ast-header-break-point .ast-above-header-navigation .menu-item.focus > .ast-menu-toggle, .ast-header-break-point .ast-above-header-navigation  .current-menu-item > .ast-menu-toggle, .ast-header-break-point .ast-above-header-navigation .current-menu-ancestor > .ast-menu-toggle' => array(
			'color' => esc_attr( $above_header_menu_color['tablet'] ),
		),
		// Mobile above header menu active bg color.
		'.ast-header-break-point .ast-above-header-navigation a:hover, .ast-header-break-point .ast-above-header-navigation .menu-item:hover > .menu-link, .ast-header-break-point .ast-above-header-navigation .menu-item.focus > .menu-link' => array(
			'color' => esc_attr( $above_header_menu_h_color['tablet'] ),
		),
		'.ast-header-break-point .ast-above-header-navigation .menu-item:hover > .ast-menu-toggle, .ast-header-break-point .ast-above-header-navigation .menu-item.focus > .ast-menu-toggle' => array(
			'color' => esc_attr( $above_header_menu_h_color['tablet'] ),
		),

		// Mobile above header menu hover bg color.
		'.ast-header-break-point .ast-above-header-navigation a:hover, .ast-header-break-point .ast-above-header-navigation .menu-item:hover > .menu-link, .ast-header-break-point .ast-above-header-navigation .menu-item.focus > .menu-link' => array(
			'background-color' => esc_attr( $above_header_menu_h_bg_color['tablet'] ),
		),
		// Submenu.
		'.ast-header-break-point .ast-above-header-navigation .sub-menu, .ast-header-break-point .ast-above-header-navigation .sub-menu .menu-link' => array(
			'color' => esc_attr( $above_header_submenu_text_color['tablet'] ),
		),
		// Submenu bg color.
		'.ast-header-break-point .ast-above-header-section-separated .ast-above-header-navigation .sub-menu, .ast-header-break-point .ast-above-header-menu .sub-menu .menu-item' => array(
			'background-color' => esc_attr( $above_header_submenu_bg_color['tablet'] ),
		),
		// Submenu hover color.
		'.ast-header-break-point .ast-above-header-menu .sub-menu .menu-item:hover > .menu-link, .ast-header-break-point .ast-above-header-menu .sub-menu .menu-item:hover > .ast-menu-toggle, .ast-header-break-point .ast-above-header-menu .sub-menu .menu-item:focus > .menu-link' => array(
			'color' => esc_attr( $above_header_submenu_hover_color['tablet'] ),
		),
		// Submenu bg hover color.
		'.ast-header-break-point .ast-above-header-menu .sub-menu .menu-link:hover, .ast-header-break-point .ast-above-header-menu .sub-menu .menu-item:hover > .menu-link, .ast-header-break-point .ast-above-header-menu .sub-menu .menu-item.focus > .menu-link' => array(
			'background-color' => esc_attr( $above_header_submenu_bg_hover_color['tablet'] ),
		),
		// Submenu active color.
		'.ast-header-break-point .ast-above-header-menu .sub-menu .menu-item.current-menu-item > .menu-link, .ast-header-break-point .ast-above-header-menu .sub-menu .menu-item.current-menu-ancestor > .menu-link' => array(
			'color' => esc_attr( $above_header_submenu_active_color['tablet'] ),
		),
		// Submenu active BG color.
		'.ast-header-break-point .ast-above-header-menu .sub-menu .menu-item.current-menu-item > .menu-link, .ast-header-break-point .ast-above-header-menu .sub-menu .menu-item.current-menu-ancestor > .menu-link' => array(
			'background-color' => esc_attr( $above_header_submenu_active_bg_color['tablet'] ),
		),
	);
	$mobile_colors = array(

		// Above header Background.
		'.ast-header-break-point .ast-above-header'      => astra_get_responsive_background_obj( $above_header_bg_obj, 'mobile' ),
		'.ast-header-break-point .ast-above-header-section-separated .ast-above-header-navigation .ast-above-header-menu' => array(
			'background-color' => esc_attr( $mobile_background ),
		),
		// Mobile above header text color.
		'.ast-header-break-point .ast-above-header-section .user-select,.ast-header-break-point .ast-above-header-section .widget, .ast-header-break-point .ast-above-header-section .widget-title' => array(
			'color' => esc_attr( $above_header_text_color['mobile'] ),
		),
		'.ast-header-break-point .ast-above-header-section .search-field:focus' => array(
			'border-color' => esc_attr( $above_header_text_color['mobile'] ),
		),
		// Mobile above header link color.
		'.ast-header-break-point .ast-above-header-section .user-select a, .ast-header-break-point .ast-above-header-section .widget a' => array(
			'color' => esc_attr( $mobile_above_header_link_color ),
		),
		// Mobile above header link hover color.
		'.ast-header-break-point .ast-above-header-section .user-select a:hover, .ast-header-break-point .ast-above-header-section .widget a:hover' => array(
			'color' => esc_attr( $mobile_above_header_link_h_color ),
		),
		'.ast-header-break-point .ast-above-header-menu' => astra_get_responsive_background_obj( $above_header_menu_bg_obj, 'mobile' ),
		// Mobile above header menu active color.
		'.ast-header-break-point .ast-above-header-navigation .menu-item.current-menu-ancestor > .ast-menu-toggle, .ast-header-break-point .ast-above-header-navigation .menu-item.current-menu-ancestor:hover > .ast-menu-toggle.ast-header-break-point .ast-above-header-navigation .menu-item.current-menu-item > .ast-menu-toggle, .ast-header-break-point .ast-above-header-navigation .menu-item.current-menu-item > .menu-link, .ast-header-break-point .ast-above-header-navigation .menu-item.current-menu-ancestor > .ast-menu-toggle, .ast-header-break-point .ast-above-header-navigation .menu-item.current-menu-ancestor > .menu-link,.ast-header-break-point .ast-above-header-navigation .menu-item.current-menu-item > .menu-link' => array(
			'color' => esc_attr( $above_header_menu_active_color['mobile'] ),
		),
		// Mobile above header menu active bg color.
		'.ast-header-break-point .ast-above-header-navigation .menu-item.current-menu-item > .menu-link, .ast-header-break-point .ast-above-header-navigation .menu-item.current-menu-ancestor > .menu-link' => array(
			'background-color' => esc_attr( $above_header_menu_active_bg_color['mobile'] ),
		),
		// Mobile above header menu active bg color.
		'.ast-header-break-point .ast-above-header-menu, .ast-header-break-point .ast-above-header-navigation a, .ast-header-break-point .ast-above-header-navigation .menu-item:hover > .ast-menu-toggle, .ast-header-break-point .ast-above-header-navigation .menu-item.focus > .ast-menu-toggle, .ast-header-break-point .ast-above-header-navigation  .current-menu-item > .ast-menu-toggle, .ast-header-break-point .ast-above-header-navigation .current-menu-ancestor > .ast-menu-toggle' => array(
			'color' => esc_attr( $above_header_menu_color['mobile'] ),
		),
		// Mobile above header menu active bg color.
		'.ast-header-break-point .ast-above-header-navigation a:hover, .ast-header-break-point .ast-above-header-navigation .menu-item:hover > .menu-link, .ast-header-break-point .ast-above-header-navigation .menu-item.focus > .menu-link' => array(
			'color' => esc_attr( $above_header_menu_h_color['mobile'] ),
		),
		'.ast-header-break-point .ast-above-header-navigation .menu-item:hover > .ast-menu-toggle, .ast-header-break-point .ast-above-header-navigation .menu-item.focus > .ast-menu-toggle' => array(
			'color' => esc_attr( $above_header_menu_h_color['mobile'] ),
		),

		// Mobile above header menu hover bg color.
		'.ast-header-break-point .ast-above-header-navigation a:hover, .ast-header-break-point .ast-above-header-navigation .menu-item:hover > .menu-link, .ast-header-break-point .ast-above-header-navigation .menu-item.focus > .menu-link' => array(
			'background-color' => esc_attr( $above_header_menu_h_bg_color['mobile'] ),
		),
		// Submenu.
		'.ast-header-break-point .ast-above-header-navigation .sub-menu, .ast-header-break-point .ast-above-header-navigation .sub-menu .menu-link' => array(
			'color' => esc_attr( $above_header_submenu_text_color['mobile'] ),
		),
		// Submenu bg color.
		'.ast-header-break-point .ast-above-header-section-separated .ast-above-header-navigation .sub-menu, .ast-header-break-point .ast-above-header-menu .sub-menu .menu-item' => array(
			'background-color' => esc_attr( $above_header_submenu_bg_color['mobile'] ),
		),
		// Submenu hover color.
		'.ast-header-break-point .ast-above-header-menu .sub-menu .menu-item:hover > .menu-link, .ast-header-break-point .ast-above-header-menu .sub-menu .menu-item:hover > .ast-menu-toggle, .ast-header-break-point .ast-above-header-menu .sub-menu .menu-item:focus > .menu-link' => array(
			'color' => esc_attr( $above_header_submenu_hover_color['mobile'] ),
		),
		// Submenu bg hover color.
		'.ast-header-break-point .ast-above-header-menu .sub-menu .menu-link:hover, .ast-header-break-point .ast-above-header-menu .sub-menu .menu-item:hover > .menu-link, .ast-header-break-point .ast-above-header-menu .sub-menu .menu-item.focus > .menu-link' => array(
			'background-color' => esc_attr( $above_header_submenu_bg_hover_color['mobile'] ),
		),
		// Submenu active color.
		'.ast-header-break-point .ast-above-header-menu .sub-menu .menu-item.current-menu-item > .menu-link, .ast-header-break-point .ast-above-header-menu .sub-menu .menu-item.current-menu-ancestor > .menu-link' => array(
			'color' => esc_attr( $above_header_submenu_active_color['mobile'] ),
		),
		// Submenu active BG color.
		'.ast-header-break-point .ast-above-header-menu .sub-menu .menu-item.current-menu-item > .menu-link, .ast-header-break-point .ast-above-header-menu .sub-menu .menu-item.current-menu-ancestor > .menu-link' => array(
			'background-color' => esc_attr( $above_header_submenu_active_bg_color['mobile'] ),
		),
	);
	/* Parse CSS from array() */
	$css_output .= astra_parse_css( $desktop_colors );
	$css_output .= astra_parse_css( $tablet_colors, '', astra_addon_get_tablet_breakpoint() );
	$css_output .= astra_parse_css( $mobile_colors, '', astra_addon_get_mobile_breakpoint() );

	/**
	 * Responsive Colors options
	 * [2]. Above Header Menu Responsive Colors only for Full Screen menu style
	 */
	if ( 'fullscreen' == $above_menu_style ) {
			$desktop_colors = array(
				'.ast-fullscreen-above-menu-enable.ast-header-break-point .ast-above-header-navigation .menu-item.current-menu-item > .menu-link, .ast-fullscreen-above-menu-enable.ast-header-break-point .ast-above-header-navigation .menu-item.current-menu-ancestor > .menu-link' => array(
					'background-color' => 'transparent',
				),
				'.ast-fullscreen-above-menu-enable.ast-header-break-point .ast-above-header-navigation .menu-item.current-menu-item, .ast-fullscreen-above-menu-enable.ast-header-break-point .ast-above-header-navigation .menu-item.current-menu-ancestor' => array(
					'background-color' => esc_attr( $above_header_menu_active_bg_color['desktop'] ),
				),

				'.ast-fullscreen-above-menu-enable.ast-header-break-point .ast-above-header-navigation li:hover a:hover, .ast-fullscreen-above-menu-enable.ast-header-break-point .ast-above-header-navigation .menu-item:hover > .menu-link, .ast-fullscreen-above-menu-enable.ast-header-break-point .ast-above-header-navigation .menu-item.focus > .menu-link' => array(
					'background-color' => 'transparent',
				),
				'.ast-fullscreen-above-menu-enable.ast-header-break-point .ast-above-header-navigation li:hover, .ast-fullscreen-above-menu-enable.ast-header-break-point .ast-above-header-navigation li.focus' => array(
					'background-color' => esc_attr( $above_header_menu_h_bg_color['desktop'] ),
				),
				// Fullscreen submenu background color.
				'.ast-fullscreen-above-menu-enable.ast-header-break-point .ast-above-header-menu .menu-link, .ast-fullscreen-above-menu-enable.ast-header-break-point .ast-above-header-menu .menu-item > .menu-link, .ast-fullscreen-above-menu-enable.ast-header-break-point .ast-above-header-menu .menu-item.focus > .menu-link' => array(
					'background-color' => 'transparent',
				),
				// Fullscreen submenu active background color.
				'.ast-fullscreen-above-menu-enable.ast-header-break-point .ast-above-header-menu .sub-menu .menu-item.current-menu-item > .menu-link, .ast-fullscreen-above-menu-enable.ast-header-break-point .ast-above-header-menu .sub-menu .menu-item.current-menu-ancestor > .menu-link' => array(
					'background-color' => 'transparent',
				),
				'.ast-fullscreen-above-menu-enable.ast-header-break-point .ast-above-header-menu .sub-menu .menu-item.current-menu-item, .ast-fullscreen-above-menu-enable.ast-header-break-point .ast-above-header-menu .sub-menu .menu-item.current-menu-ancestor' => array(
					'background-color' => esc_attr( $above_header_submenu_active_bg_color['desktop'] ),
				),

				// Fullscreen submenu background color.
				'.ast-fullscreen-above-menu-enable.ast-header-break-point .ast-above-header-menu .menu-item > .menu-link:hover' => array(
					'background-color' => esc_attr( $above_header_submenu_bg_hover_color['desktop'] ),
				),
				'.ast-fullscreen-above-menu-enable.ast-header-break-point .ast-above-header-menu .sub-menu .menu-link:hover, .ast-fullscreen-above-menu-enable.ast-header-break-point .ast-above-header-menu .sub-menu .menu-link:focus' => array(
					'background-color' => 'transparent',
				),
				'.ast-fullscreen-above-menu-enable.ast-header-break-point .ast-above-header-navigation-wrap .close' => array(
					'color' => esc_attr( $mobile_header_close_desktop_color ),
				),
			);

			// Fullscreen background color if Below Header Background color is set.
			$desktop_colors['.ast-fullscreen-above-menu-enable.ast-header-break-point .ast-above-header-navigation-wrap'] = astra_get_responsive_background_obj( $above_header_bg_obj, 'desktop' );
			// Fullscreen background color if Below Header Menu Background color is set.
			if ( '' !== $above_header_menu_bg_obj['desktop']['background-color'] || '' !== $above_header_menu_bg_obj['desktop']['background-image'] ) {
				$desktop_colors['.ast-fullscreen-above-menu-enable.ast-header-break-point .ast-above-header-navigation-wrap'] = astra_get_responsive_background_obj( $above_header_menu_bg_obj, 'desktop' );
			}

			$tablet_colors = array(
				'.ast-fullscreen-above-menu-enable.ast-header-break-point .ast-above-header-navigation .menu-item.current-menu-item > .menu-link, .ast-fullscreen-above-menu-enable.ast-header-break-point .ast-above-header-navigation .menu-item.current-menu-ancestor > .menu-link' => array(
					'background-color' => 'transparent',
				),
				'.ast-fullscreen-above-menu-enable.ast-header-break-point .ast-above-header-navigation .menu-item.current-menu-item, .ast-fullscreen-above-menu-enable.ast-header-break-point .ast-above-header-navigation .menu-item.current-menu-ancestor' => array(
					'background-color' => esc_attr( $above_header_menu_active_bg_color['tablet'] ),
				),

				'.ast-fullscreen-above-menu-enable.ast-header-break-point .ast-above-header-navigation li:hover a:hover, .ast-fullscreen-above-menu-enable.ast-header-break-point .ast-above-header-navigation .menu-item:hover > .menu-link, .ast-fullscreen-above-menu-enable.ast-header-break-point .ast-above-header-navigation .menu-item.focus > .menu-link' => array(
					'background-color' => 'transparent',
				),
				'.ast-fullscreen-above-menu-enable.ast-header-break-point .ast-above-header-navigation li:hover, .ast-fullscreen-above-menu-enable.ast-header-break-point .ast-above-header-navigation li.focus' => array(
					'background-color' => esc_attr( $above_header_menu_h_bg_color['tablet'] ),
				),
				// Fullscreen submenu background color.
				'.ast-fullscreen-above-menu-enable.ast-header-break-point .ast-above-header-menu .menu-link, .ast-fullscreen-above-menu-enable.ast-header-break-point .ast-above-header-menu .menu-item > .menu-link, .ast-fullscreen-above-menu-enable.ast-header-break-point .ast-above-header-menu .menu-item.focus > .menu-link' => array(
					'background-color' => 'transparent',
				),
				// Fullscreen submenu active background color.
				'.ast-fullscreen-above-menu-enable.ast-header-break-point .ast-above-header-menu .sub-menu .menu-item.current-menu-item > .menu-link, .ast-fullscreen-above-menu-enable.ast-header-break-point .ast-above-header-menu .sub-menu .menu-item.current-menu-ancestor > .menu-link' => array(
					'background-color' => 'transparent',
				),
				'.ast-fullscreen-above-menu-enable.ast-header-break-point .ast-above-header-menu .sub-menu .menu-item.current-menu-item, .ast-fullscreen-above-menu-enable.ast-header-break-point .ast-above-header-menu .sub-menu .menu-item.current-menu-ancestor' => array(
					'background-color' => esc_attr( $above_header_submenu_active_bg_color['tablet'] ),
				),

				// Fullscreen submenu background color.
				'.ast-fullscreen-above-menu-enable.ast-header-break-point .ast-above-header-menu .sub-menu .menu-item:hover' => array(
					'background-color' => esc_attr( $above_header_submenu_bg_hover_color['tablet'] ),
				),
				'.ast-fullscreen-above-menu-enable.ast-header-break-point .ast-above-header-menu .sub-menu .menu-link:hover, .ast-fullscreen-above-menu-enable.ast-header-break-point .ast-above-header-menu .sub-menu .menu-link:focus' => array(
					'background-color' => 'transparent',
				),
				'.ast-fullscreen-above-menu-enable.ast-header-break-point .ast-above-header-navigation-wrap .close' => array(
					'color' => esc_attr( $mobile_header_close_tablet_color ),
				),
			);
			// Fullscreen background color if Below Header Background color is set.
			$tablet_colors['.ast-fullscreen-above-menu-enable.ast-header-break-point .ast-above-header-navigation-wrap'] = astra_get_responsive_background_obj( $above_header_bg_obj, 'tablet' );
			// Fullscreen background color if Below Header Menu Background color is set.
			if ( '' !== $above_header_menu_bg_obj['tablet']['background-color'] || '' !== $above_header_menu_bg_obj['tablet']['background-image'] ) {
				$tablet_colors['.ast-fullscreen-above-menu-enable.ast-header-break-point .ast-above-header-navigation-wrap'] = astra_get_responsive_background_obj( $above_header_menu_bg_obj, 'tablet' );
			}

			$mobile_colors = array(
				'.ast-fullscreen-above-menu-enable.ast-header-break-point .ast-above-header-navigation .menu-item.current-menu-item > .menu-link, .ast-fullscreen-above-menu-enable.ast-header-break-point .ast-above-header-navigation .menu-item.current-menu-ancestor > .menu-link' => array(
					'background-color' => 'transparent',
				),
				'.ast-fullscreen-above-menu-enable.ast-header-break-point .ast-above-header-navigation .menu-item.current-menu-item, .ast-fullscreen-above-menu-enable.ast-header-break-point .ast-above-header-navigation .menu-item.current-menu-ancestor' => array(
					'background-color' => esc_attr( $above_header_menu_active_bg_color['mobile'] ),
				),

				'.ast-fullscreen-above-menu-enable.ast-header-break-point .ast-above-header-navigation li:hover a:hover, .ast-fullscreen-above-menu-enable.ast-header-break-point .ast-above-header-navigation .menu-item:hover > .menu-link, .ast-fullscreen-above-menu-enable.ast-header-break-point .ast-above-header-navigation .menu-item.focus > .menu-link' => array(
					'background-color' => 'transparent',
				),
				'.ast-fullscreen-above-menu-enable.ast-header-break-point .ast-above-header-navigation li:hover, .ast-fullscreen-above-menu-enable.ast-header-break-point .ast-above-header-navigation li.focus' => array(
					'background-color' => esc_attr( $above_header_menu_h_bg_color['mobile'] ),
				),
				// Fullscreen submenu background color.
				'.ast-fullscreen-above-menu-enable.ast-header-break-point .ast-above-header-menu .menu-link, .ast-fullscreen-above-menu-enable.ast-header-break-point .ast-above-header-menu .menu-item > .menu-link, .ast-fullscreen-above-menu-enable.ast-header-break-point .ast-above-header-menu .menu-item.focus > .menu-link' => array(
					'background-color' => 'transparent',
				),
				// Fullscreen submenu active background color.
				'.ast-fullscreen-above-menu-enable.ast-header-break-point .ast-above-header-menu .sub-menu .menu-item.current-menu-item > .menu-link, .ast-fullscreen-above-menu-enable.ast-header-break-point .ast-above-header-menu .sub-menu .menu-item.current-menu-ancestor > .menu-link' => array(
					'background-color' => 'transparent',
				),
				'.ast-fullscreen-above-menu-enable.ast-header-break-point .ast-above-header-menu .sub-menu .menu-item.current-menu-item, .ast-fullscreen-above-menu-enable.ast-header-break-point .ast-above-header-menu .sub-menu .menu-item.current-menu-ancestor' => array(
					'background-color' => esc_attr( $above_header_submenu_active_bg_color['mobile'] ),
				),
				// Fullscreen submenu background color.
				'.ast-fullscreen-above-menu-enable.ast-header-break-point .ast-above-header-menu .sub-menu .menu-item:hover' => array(
					'background-color' => esc_attr( $above_header_submenu_bg_hover_color['mobile'] ),
				),
				'.ast-fullscreen-above-menu-enable.ast-header-break-point .ast-above-header-menu .sub-menu .menu-link:hover, .ast-fullscreen-above-menu-enable.ast-header-break-point .ast-above-header-menu .sub-menu .menu-link:focus' => array(
					'background-color' => 'transparent',
				),
				'.ast-fullscreen-above-menu-enable.ast-header-break-point .ast-above-header-navigation-wrap .close' => array(
					'color' => esc_attr( $mobile_header_close_mobile_color ),
				),
			);

			// Fullscreen background color if Below Header Background color is set.
			$mobile_colors['.ast-fullscreen-above-menu-enable.ast-header-break-point .ast-above-header-navigation-wrap'] = astra_get_responsive_background_obj( $above_header_bg_obj, 'mobile' );
			// Fullscreen background color if Below Header Menu Background color is set.
			if ( '' !== $above_header_menu_bg_obj['mobile']['background-color'] || '' !== $above_header_menu_bg_obj['mobile']['background-image'] ) {
				$mobile_colors['.ast-fullscreen-above-menu-enable.ast-header-break-point .ast-above-header-navigation-wrap'] = astra_get_responsive_background_obj( $above_header_menu_bg_obj, 'mobile' );
			}

			/* Parse CSS from array() */
			$css_output .= astra_parse_css( $desktop_colors );
			$css_output .= astra_parse_css( $tablet_colors, '', astra_addon_get_tablet_breakpoint() );
			$css_output .= astra_parse_css( $mobile_colors, '', astra_addon_get_mobile_breakpoint() );

			/**
			 * Border only for Responsive Devices
			 */
			if ( '' !== $mobile_above_header_menu_all_border['top'] || '' !== $mobile_above_header_menu_all_border['right'] || '' !== $mobile_above_header_menu_all_border['bottom'] || '' !== $mobile_above_header_menu_all_border['left'] ) {
				$mobile_above_header_border = array(
					'.ast-fullscreen-above-menu-enable.ast-header-break-point .ast-above-header .ast-above-header-navigation .ast-above-header-menu > .menu-item' => array(
						'border-right-width' => astra_get_css_value( $mobile_above_header_menu_all_border['right'], 'px' ),
						'border-left-width'  => astra_get_css_value( $mobile_above_header_menu_all_border['left'], 'px' ),
						'border-style'       => 'solid',
						'border-color'       => esc_attr( $mobile_above_header_menu_b_color ),
					),
					'.ast-fullscreen-above-menu-enable.ast-header-break-point .ast-above-header .ast-above-header-navigation .ast-above-header-menu > .menu-item:not(:first-child):not(:last-child)' => array(
						'border-top-width'    => ( ! empty( $mobile_above_header_menu_all_border['top'] ) && ! empty( $mobile_above_header_menu_all_border['bottom'] ) ) ? astra_calc_spacing( $mobile_above_header_menu_all_border['top'] . 'px', '/', '2' ) : astra_get_css_value( $mobile_above_header_menu_all_border['top'], 'px' ),
						'border-bottom-width' => ( ! empty( $mobile_above_header_menu_all_border['bottom'] ) && ! empty( $mobile_above_header_menu_all_border['top'] ) ) ? astra_calc_spacing( $mobile_above_header_menu_all_border['bottom'] . 'px', '/', '2' ) : astra_get_css_value( $mobile_above_header_menu_all_border['bottom'], 'px' ),
						'border-style'        => 'solid',
						'border-color'        => esc_attr( $mobile_above_header_menu_b_color ),
					),
					'.ast-fullscreen-above-menu-enable.ast-header-break-point .ast-above-header .ast-above-header-navigation .ast-above-header-menu .menu-item:first-child' => array(
						'border-top-width'    => astra_get_css_value( $mobile_above_header_menu_all_border['top'], 'px' ),
						'border-bottom-width' => ( ! empty( $mobile_above_header_menu_all_border['bottom'] ) && ! empty( $mobile_above_header_menu_all_border['top'] ) ) ? astra_calc_spacing( $mobile_above_header_menu_all_border['bottom'] . 'px', '/', '2' ) : astra_get_css_value( $mobile_above_header_menu_all_border['bottom'], 'px' ),
						'border-style'        => 'solid',
						'border-color'        => esc_attr( $mobile_above_header_menu_b_color ),
					),
					'.ast-fullscreen-above-menu-enable.ast-header-break-point .ast-above-header .ast-above-header-navigation .ast-above-header-menu .menu-item:last-child' => array(
						'border-top-width'    => ( ! empty( $mobile_above_header_menu_all_border['top'] ) && ! empty( $mobile_above_header_menu_all_border['bottom'] ) ) ? astra_calc_spacing( $mobile_above_header_menu_all_border['top'] . 'px', '/', '2' ) : astra_get_css_value( $mobile_above_header_menu_all_border['top'], 'px' ),
						'border-bottom-width' => astra_get_css_value( $mobile_above_header_menu_all_border['bottom'], 'px' ),
						'border-style'        => 'solid',
						'border-color'        => esc_attr( $mobile_above_header_menu_b_color ),
					),
					'.ast-fullscreen-above-menu-enable.ast-header-break-point .ast-above-header .ast-above-header-navigation .ast-above-header-menu .menu-item.ast-submenu-expanded .sub-menu .menu-item' => array(
						'border-top-width'    => astra_get_css_value( $mobile_above_header_menu_all_border['top'], 'px' ),
						'border-bottom-width' => 0,
						'border-style'        => 'solid',
						'border-color'        => esc_attr( $mobile_above_header_menu_b_color ),
					),
					'.ast-fullscreen-above-menu-enable.ast-header-break-point .ast-above-header .ast-above-header-navigation .ast-above-header-menu .ast-masthead-custom-menu-items' => array(
						'border-top-width'    => ( ! empty( $mobile_above_header_menu_all_border['top'] ) && ! empty( $mobile_above_header_menu_all_border['bottom'] ) ) ? astra_calc_spacing( $mobile_above_header_menu_all_border['top'] . 'px', '/', '2' ) : astra_get_css_value( $mobile_above_header_menu_all_border['top'], 'px' ),
						'border-bottom-width' => astra_get_css_value( $mobile_above_header_menu_all_border['bottom'], 'px' ),
						'border-right-width'  => astra_get_css_value( $mobile_above_header_menu_all_border['right'], 'px' ),
						'border-left-width'   => astra_get_css_value( $mobile_above_header_menu_all_border['left'], 'px' ),
						'border-style'        => 'solid',
						'border-color'        => esc_attr( $mobile_above_header_menu_b_color ),
					),
				);
				$css_output                .= astra_parse_css( $mobile_above_header_border );
			}
	} elseif ( 'no-toggle' == $above_menu_style ) {
		// Border only for responsive devices.
		if ( '' !== $mobile_above_header_menu_all_border['top'] || '' !== $mobile_above_header_menu_all_border['right'] || '' !== $mobile_above_header_menu_all_border['bottom'] || '' !== $mobile_above_header_menu_all_border['left'] ) {
			$mobile_header_border = array(
				'.ast-header-break-point.ast-no-toggle-above-menu-enable .ast-above-header-navigation ul li' => array(
					'border-top-width'   => astra_get_css_value( $mobile_above_header_menu_all_border['top'], 'px' ),
					'border-left-width'  => astra_get_css_value( $mobile_above_header_menu_all_border['left'], 'px' ),
					'border-right-width' => astra_get_css_value( $mobile_above_header_menu_all_border['right'], 'px' ),
					'border-color'       => esc_attr( $mobile_above_header_menu_b_color ),
				),
				'.ast-header-break-point.ast-no-toggle-above-menu-enable .ast-above-header-navigation > ul > li, .ast-header-break-point.ast-no-toggle-above-menu-enable .ast-above-header-navigation .sub-menu .menu-item:last-child' => array(
					'border-bottom-width' => astra_get_css_value( $mobile_above_header_menu_all_border['bottom'], 'px' ),
				),
				'.ast-header-break-point.ast-no-toggle-above-menu-enable .ast-above-header-navigation > .ast-above-header-menu > .menu-item:last-child, .ast-header-break-point.ast-no-toggle-above-menu-enable .ast-above-header-navigation > ul > li:last-child' => array(
					'border-right-width' => astra_get_css_value( $mobile_above_header_menu_all_border['right'], 'px' ),
					'border-color'       => esc_attr( $mobile_above_header_menu_b_color ),
					'border-style'       => 'solid',
				),
				'.ast-header-break-point.ast-no-toggle-above-menu-enable .ast-above-header-navigation ul > li:first-child, .ast-header-break-point.ast-no-toggle-above-menu-enable .ast-above-header-menu-items .sub-menu > .menu-item:first-child' => array(
					'border-top-width' => astra_get_css_value( $mobile_above_header_menu_all_border['top'], 'px' ),
					'border-color'     => esc_attr( $mobile_above_header_menu_b_color ),
				),
				'.ast-header-break-point.ast-no-toggle-above-menu-enable .ast-above-header-navigation > ul > li:first-child, .ast-header-break-point.ast-no-toggle-above-menu-enable .ast-above-header-navigation > ul > li' => array(
					'border-right-width' => astra_get_css_value( $mobile_above_header_menu_all_border['right'], 'px' ),
					'border-color'       => esc_attr( $mobile_above_header_menu_b_color ),
				),
				'.ast-header-break-point.ast-no-toggle-above-menu-enable .ast-above-header-navigation > ul > li' => array(
					'margin-right' => '-' . astra_get_css_value( $mobile_above_header_menu_all_border['right'], 'px' ),
				),
				'.ast-header-break-point.ast-no-toggle-above-menu-enable .ast-above-header-navigation > ul > li > .sub-menu' => array(
					'margin-left' => '-' . astra_get_css_value( $mobile_above_header_menu_all_border['left'], 'px' ),
				),
			);

			$css_output .= astra_parse_css( $mobile_header_border );
		}
	} else {
		/**
		 * Border only for Responsive Devices
		 */
		if ( '' !== $mobile_above_header_menu_all_border['top'] || '' !== $mobile_above_header_menu_all_border['right'] || '' !== $mobile_above_header_menu_all_border['bottom'] || '' !== $mobile_above_header_menu_all_border['left'] ) {
			$mobile_above_header = array(
				'.ast-header-break-point .ast-above-header-section-separated .ast-above-header-menu' => array(
					'border-top-width'   => astra_get_css_value( $mobile_above_header_menu_all_border['top'], 'px' ),
					'border-left-width'  => astra_get_css_value( $mobile_above_header_menu_all_border['left'], 'px' ),
					'border-right-width' => astra_get_css_value( $mobile_above_header_menu_all_border['right'], 'px' ),
					'border-color'       => esc_attr( $mobile_above_header_menu_b_color ),
				),
				'.ast-header-break-point .ast-above-header-navigation ul li a, .above-header-nav-padding-support.ast-header-break-point .ast-above-header-menu .menu-item .menu-link, .above-header-nav-padding-support.ast-header-break-point .ast-above-header-menu .menu-item:first-child .menu-link, .above-header-nav-padding-support.ast-header-break-point .ast-above-header-menu .menu-item:last-child .menu-link' => array(
					'border-bottom-width' => astra_get_css_value( $mobile_above_header_menu_all_border['bottom'], 'px' ),
					'border-color'        => esc_attr( $mobile_above_header_menu_b_color ),
				),
			);
				$css_output     .= astra_parse_css( $mobile_above_header );

			if ( 'no-toggle' == $above_menu_style ) {
				$mobile_above_header = array(
					'.ast-header-break-point .ast-above-header-section-separated .ast-above-header-menu' => array(
						'border-bottom-width' => astra_get_css_value( $mobile_above_header_menu_all_border['bottom'], 'px' ),
					),
				);
				$css_output         .= astra_parse_css( $mobile_above_header );
			}
		}
	}

	/**
	 * Responsive Colors options
	 * [3]. Above Header Menu Responsive Colors only for Flyout menu style
	 */
	if ( 'flyout' == $above_menu_style ) {
		$desktop_colors = array(
			'.ast-flyout-above-menu-enable.ast-header-break-point .ast-above-header-navigation' => array(
				'width' => astra_get_css_value( $above_flayout_sidebar_width, 'px' ),
			),
			'.ast-flyout-above-menu-enable.ast-header-break-point .ast-above-header-navigation-wrap .close' => array(
				'color' => esc_attr( $mobile_header_close_desktop_color ),
			),
		);
		// Flyout background color if Above Header Background color is set.
		$desktop_colors['.ast-flyout-above-menu-enable.ast-header-break-point .ast-above-header-navigation-wrap .ast-above-header-navigation'] = astra_get_responsive_background_obj( $above_header_bg_obj, 'desktop' );
		// Flyout background color if Above Header Menu Background color is set.
		if ( '' !== $above_header_menu_bg_obj['desktop']['background-color'] || '' !== $above_header_menu_bg_obj['desktop']['background-image'] ) {
			$desktop_colors['.ast-flyout-above-menu-enable.ast-header-break-point .ast-above-header-navigation-wrap .ast-above-header-navigation'] = astra_get_responsive_background_obj( $above_header_menu_bg_obj, 'desktop' );
		}

		$tablet_colors = array(
			'.ast-flyout-above-menu-enable.ast-header-break-point .ast-above-header-navigation-wrap .close' => array(
				'color' => esc_attr( $mobile_header_close_tablet_color ),
			),
		);
		// Flyout background color if Above Header Background color is set.
		$tablet_colors['.ast-flyout-above-menu-enable.ast-header-break-point .ast-above-header-navigation-wrap .ast-above-header-navigation'] = astra_get_responsive_background_obj( $above_header_bg_obj, 'tablet' );
		// Flyout background color if Above Header Menu Background color is set.
		if ( '' !== $above_header_menu_bg_obj['tablet']['background-color'] || '' !== $above_header_menu_bg_obj['tablet']['background-image'] ) {
			$tablet_colors['.ast-flyout-above-menu-enable.ast-header-break-point .ast-above-header-navigation-wrap .ast-above-header-navigation'] = astra_get_responsive_background_obj( $above_header_menu_bg_obj, 'tablet' );
		}

		$mobile_colors = array(
			'.ast-flyout-above-menu-enable.ast-header-break-point .ast-above-header-navigation-wrap .close' => array(
				'color' => esc_attr( $mobile_header_close_mobile_color ),
			),
		);
		// Flyout background color if Above Header Background color is set.
		$mobile_colors['.ast-flyout-above-menu-enable.ast-header-break-point .ast-above-header-navigation-wrap .ast-above-header-navigation'] = astra_get_responsive_background_obj( $above_header_bg_obj, 'mobile' );
		// Flyout background color if Above Header Menu Background color is set.
		if ( '' !== $above_header_menu_bg_obj['mobile']['background-color'] || '' !== $above_header_menu_bg_obj['mobile']['background-image'] ) {
			$mobile_colors['.ast-flyout-above-menu-enable.ast-header-break-point .ast-above-header-navigation-wrap .ast-above-header-navigation'] = astra_get_responsive_background_obj( $above_header_menu_bg_obj, 'mobile' );
		}

		/* Parse CSS from array() */
		$css_output .= astra_parse_css( $desktop_colors );
		$css_output .= astra_parse_css( $tablet_colors, '', astra_addon_get_tablet_breakpoint() );
		$css_output .= astra_parse_css( $mobile_colors, '', astra_addon_get_mobile_breakpoint() );
	}

	/**
	 * Responsive Colors options
	 * [4]. Below Header Menu Responsive Colors only for No Toggle menu style
	 */
	if ( 'no-toggle' == $above_menu_style ) {

		$desktop_colors = array(
			'.ast-no-toggle-above-menu-enable.ast-header-break-point .ast-above-header-navigation li:hover .ast-menu-toggle' => array(
				'background-color' => esc_attr( $above_header_menu_h_bg_color['desktop'] ),
			),
			'.ast-no-toggle-above-menu-enable.ast-header-break-point .ast-above-header-navigation .menu-item.current-menu-item:hover > .menu-link, .ast-no-toggle-above-menu-enable.ast-header-break-point .ast-above-header-navigation .menu-item.current-menu-item > .menu-link, .ast-no-toggle-above-menu-enable.ast-header-break-point .ast-above-header-navigation .menu-item.current-menu-ancestor:hover > .menu-link, .ast-no-toggle-above-menu-enable.ast-header-break-point .ast-above-header-navigation .menu-item.current-menu-ancestor > .ast-menu-toggle, .ast-no-toggle-above-menu-enable.ast-header-break-point .ast-above-header-navigation .menu-item.current-menu-ancestor > .menu-link, .ast-no-toggle-above-menu-enable.ast-header-break-point .ast-above-header-navigation .menu-item.current-menu-ancestor:hover > .ast-menu-toggle' => array(
				'background-color' => esc_attr( $above_header_menu_active_bg_color['desktop'] ),
			),
		);
		$tablet_colors  = array(
			'.ast-no-toggle-above-menu-enable.ast-header-break-point .ast-above-header-navigation .menu-item:hover > .ast-menu-toggle' => array(
				'background-color' => esc_attr( $above_header_menu_h_bg_color['tablet'] ),
			),
			'.ast-no-toggle-above-menu-enable.ast-header-break-point .ast-above-header-navigation .menu-item.current-menu-item:hover > .menu-link, .ast-no-toggle-above-menu-enable.ast-header-break-point .ast-above-header-navigation .menu-item.current-menu-item > .menu-link, .ast-no-toggle-above-menu-enable.ast-header-break-point .ast-above-header-navigation .menu-item.current-menu-ancestor:hover > .menu-link, .ast-no-toggle-above-menu-enable.ast-header-break-point .ast-above-header-navigation .menu-item.current-menu-ancestor > .ast-menu-toggle, .ast-no-toggle-above-menu-enable.ast-header-break-point .ast-above-header-navigation .menu-item.current-menu-ancestor > .menu-link, .ast-no-toggle-above-menu-enable.ast-header-break-point .ast-above-header-navigation .menu-item.current-menu-ancestor:hover > .ast-menu-toggle' => array(
				'background-color' => esc_attr( $above_header_menu_active_bg_color['tablet'] ),
			),
		);
		$mobile_colors  = array(
			'.ast-header-break-point.ast-no-toggle-above-menu-enable .ast-above-header-navigation .menu-item:hover > .ast-menu-toggle' => array(
				'background-color' => esc_attr( $above_header_menu_h_bg_color['mobile'] ),
			),
			'.ast-no-toggle-above-menu-enable.ast-header-break-point .ast-above-header-navigation .menu-item.current-menu-item:hover > .menu-link, .ast-no-toggle-above-menu-enable.ast-header-break-point .ast-above-header-navigation .menu-item.current-menu-item > .menu-link, .ast-no-toggle-above-menu-enable.ast-header-break-point .ast-above-header-navigation .menu-item.current-menu-ancestor:hover > .menu-link, .ast-no-toggle-above-menu-enable.ast-header-break-point .ast-above-header-navigation .menu-item.current-menu-ancestor > .ast-menu-toggle, .ast-no-toggle-above-menu-enable.ast-header-break-point .ast-above-header-navigation .menu-item.current-menu-ancestor > .menu-link, .ast-no-toggle-above-menu-enable.ast-header-break-point .ast-above-header-navigation .menu-item.current-menu-ancestor:hover > .ast-menu-toggle' => array(
				'background-color' => esc_attr( $above_header_menu_active_bg_color['mobile'] ),
			),
		);

		/* Parse CSS from array() */
		$css_output .= astra_parse_css( $desktop_colors );
		$css_output .= astra_parse_css( $tablet_colors, '', astra_addon_get_tablet_breakpoint() );
		$css_output .= astra_parse_css( $mobile_colors, '', astra_addon_get_mobile_breakpoint() );

		if ( $above_header_menu_spacing ) {
			$desktop_spacing = array(
				'.ast-no-toggle-below-menu-enable .ast-above-header-navigation .ast-above-header-menu > .menu-item-has-children > .ast-menu-toggle, .ast-no-toggle-below-menu-enable .ast-above-header-menu-items .ast-above-header-menu > .menu-item-has-children > .ast-menu-toggle' => array(
					'padding-left'  => astra_responsive_spacing( $above_header_menu_spacing, 'left', 'desktop' ),
					'padding-right' => astra_responsive_spacing( $above_header_menu_spacing, 'right', 'desktop' ),
				),
			);
			$tablet_spacing  = array(
				'.ast-no-toggle-below-menu-enable .ast-above-header-navigation .ast-above-header-menu > .menu-item-has-children > .ast-menu-toggle, .ast-no-toggle-below-menu-enable .ast-above-header-menu-items .ast-above-header-menu > .menu-item-has-children > .ast-menu-toggle' => array(
					'padding-left'  => astra_responsive_spacing( $above_header_menu_spacing, 'left', 'tablet' ),
					'padding-right' => astra_responsive_spacing( $above_header_menu_spacing, 'right', 'tablet' ),
				),
			);
			$mobile_spacing  = array(
				'.ast-no-toggle-below-menu-enable .ast-above-header-navigation .ast-above-header-menu > .menu-item-has-children > .ast-menu-toggle, .ast-no-toggle-below-menu-enable .ast-above-header-menu-items .ast-above-header-menu > .menu-item-has-children > .ast-menu-toggle' => array(
					'padding-left'  => astra_responsive_spacing( $above_header_menu_spacing, 'left', 'mobile' ),
					'padding-right' => astra_responsive_spacing( $above_header_menu_spacing, 'right', 'mobile' ),
				),
			);
			$css_output     .= astra_parse_css( $desktop_spacing );
			$css_output     .= astra_parse_css( $tablet_spacing, '', astra_addon_get_tablet_breakpoint() );
			$css_output     .= astra_parse_css( $mobile_spacing, '', astra_addon_get_mobile_breakpoint() );
		}
	}

	/**
	 * Hide the default naviagtion markup for responsive devices.
	 * Once class .ast-header-break-point is added to the body below CSS will be override by the
	 * .ast-header-break-point class
	 */
	if ( 'no-toggle' !== $above_menu_style ) {
		$astra_navigation = array(
			'.ast-above-header-navigation-wrap' => array(
				'display' => esc_attr( 'none' ),
			),
		);
		$css_output      .= astra_parse_css( $astra_navigation, '', $header_break_point );
	}

	return $dynamic_css . $css_output;
}
