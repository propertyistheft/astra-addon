<?php
/**
 * Mobile Header - Dynamic CSS
 *
 * @package Astra Addon
 */

/**
 * Mobile Header options.
 */
add_filter( 'astra_addon_dynamic_css', 'astra_addon_mobile_below_header_dynamic_css' );

/**
 * Dynamic CSS
 *
 * @param  string $dynamic_css          Astra Dynamic CSS.
 * @param  string $dynamic_css_filtered Astra Dynamic CSS Filters.
 * @return string
 */
function astra_addon_mobile_below_header_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' ) {

	// set page width depending on site layout.
	$below_header_layout = astra_get_option( 'below-header-layout' );

	if ( 'disabled' == $below_header_layout ) {
		return $dynamic_css;
	}

	$theme_color               = astra_get_option( 'theme-color' );
	$link_color                = astra_get_option( 'link-color' );
	$btn_bg_color              = astra_get_option( 'button-bg-color', $theme_color );
	$below_header_menu_spacing = astra_get_option( 'below-header-menu-spacing' );

	$right_left_text_color = astra_get_option( 'below-header-text-color-responsive' );

	$desktop_right_left_link_color = astra_get_prop( astra_get_option( 'below-header-link-color-responsive' ), 'desktop', '#d6d6d6' );
	$tablet_right_left_link_color  = astra_get_prop( astra_get_option( 'below-header-link-color-responsive' ), 'tablet' );
	$mobile_right_left_link_color  = astra_get_prop( astra_get_option( 'below-header-link-color-responsive' ), 'mobile' );

	$desktop_right_left_link_hover_color = astra_get_prop( astra_get_option( 'below-header-link-hover-color-responsive' ), 'desktop', '#ffffff' );
	$tablet_right_left_link_hover_color  = astra_get_prop( astra_get_option( 'below-header-link-hover-color-responsive' ), 'tablet' );
	$mobile_right_left_link_hover_color  = astra_get_prop( astra_get_option( 'below-header-link-hover-color-responsive' ), 'mobile' );

	// Mobile Submenu when Below Header is merged with the primary menu.
	$below_menu_style            = astra_get_option( 'mobile-below-header-menu-style' );
	$below_flayout_sidebar_width = apply_filters( 'astra_below_flayout_sidebar_width', 325 );

	$mobile_header_close_desktop_color = astra_get_prop( astra_get_option( 'below-header-menu-text-color-responsive' ), 'desktop', $link_color );
	$mobile_header_close_tablet_color  = astra_get_prop( astra_get_option( 'below-header-menu-text-color-responsive' ), 'tablet' );
	$mobile_header_close_mobile_color  = astra_get_prop( astra_get_option( 'below-header-menu-text-color-responsive' ), 'mobile' );

	// Header Sections options.
	$below_header_merge = astra_get_option( 'below-header-merge-menu' );

	$mobile_below_header_toggle_btn_style_color   = astra_get_option( 'mobile-below-header-toggle-btn-style-color', $btn_bg_color );
	$mobile_below_header_toggle_btn_border_radius = astra_get_option( 'mobile-below-header-toggle-btn-border-radius' );
	$mobile_below_header_toggle_btn_style         = astra_get_option( 'mobile-below-header-toggle-btn-style' );

	$below_header_obj = astra_get_option( 'below-header-bg-obj-responsive' );

	$below_header_menu_bg_obj = astra_get_option( 'below-header-menu-bg-obj-responsive' );

	$below_header_border_color          = astra_get_option( 'below-header-bottom-border-color' );
	$below_header_menu_text             = astra_get_option( 'below-header-menu-text-color-responsive' );
	$below_header_menu_hover_color      = astra_get_option( 'below-header-menu-text-hover-color-responsive' );
	$below_header_menu_hover_bg_color   = astra_get_option( 'below-header-menu-bg-hover-color-responsive' );
	$below_header_menu_current_color    = astra_get_option( 'below-header-current-menu-text-color-responsive' );
	$below_header_menu_current_bg_color = astra_get_option( 'below-header-current-menu-bg-color-responsive' );

	$below_header_submenu_text_color      = astra_get_option( 'below-header-submenu-text-color-responsive' );
	$below_header_submenu_bg_color        = astra_get_option( 'below-header-submenu-bg-color-responsive' );
	$below_header_submenu_hover_color     = astra_get_option( 'below-header-submenu-hover-color-responsive' );
	$below_header_submenu_bg_hover_color  = astra_get_option( 'below-header-submenu-bg-hover-color-responsive' );
	$below_header_submenu_active_color    = astra_get_option( 'below-header-submenu-active-color-responsive' );
	$below_header_submenu_active_bg_color = astra_get_option( 'below-header-submenu-active-bg-color-responsive' );

	$mobile_below_header_menu_all_border = astra_get_option( 'mobile-below-header-menu-all-border' );
	$mobile_below_header_menu_b_color    = astra_get_option( 'mobile-below-header-menu-b-color', '#dadada' );

	// Header Break Point.
	$header_break_point = astra_header_break_point();

	$css_output = '';

	/**
	 * Responsive Colors options
	 * [1]. Below Header Menu Responsive Colors general
	 * [2]. Below Header Menu Responsive Colors only for Full Screen menu style
	 * [3]. Below Header Menu Responsive Colors only for Flyout menu style
	 */

	/**
	 * Responsive Colors options
	 * [1]. Below Header Menu Responsive Colors general
	 */
	$desktop_colors = array(
		// Menu Toggle button Outline.
		'.ast-header-break-point .ast-below-mobile-menu-buttons-outline.menu-toggle' => array(
			'background' => 'transparent',
			'border'     => '1px solid ' . $mobile_below_header_toggle_btn_style_color,
			'color'      => esc_attr( $mobile_below_header_toggle_btn_style_color ),
		),
		// Menu Toggle button Minimal.
		'.ast-header-break-point .ast-below-mobile-menu-buttons-minimal.menu-toggle' => array(
			'background' => 'transparent',
			'color'      => esc_attr( $mobile_below_header_toggle_btn_style_color ),
		),
		// Menu Toggle button Fill.
		'.ast-header-break-point .ast-below-mobile-menu-buttons-fill.menu-toggle' => array(
			'border'     => '1px solid ' . $mobile_below_header_toggle_btn_style_color,
			'background' => esc_attr( $mobile_below_header_toggle_btn_style_color ),
			'color'      => astra_get_foreground_color( $mobile_below_header_toggle_btn_style_color ),
		),
		// Menu Toggle button Border Radius.
		'.ast-header-break-point .ast-below-header .ast-button-wrap .menu-toggle' => array(
			'border-radius' => esc_attr( $mobile_below_header_toggle_btn_border_radius ) . 'px',
		),
		// Mobile below header Background Image.
		'.ast-header-break-point .ast-below-header' => astra_get_responsive_background_obj( $below_header_obj, 'desktop' ),
		// Mobile below header text color.
		'.ast-header-break-point .below-header-user-select,.ast-header-break-point .below-header-user-select .widget' => array(
			'color' => esc_attr( $right_left_text_color['desktop'] ),
		),
		'.ast-header-break-point .ast-below-header-section-separated .ast-below-header-actual-nav' => astra_get_background_obj( $below_header_menu_bg_obj['desktop'] ),
		// Mobile below header link color.
		'.ast-header-break-point .below-header-user-select a, .ast-header-break-point .below-header-user-select .widget a' => array(
			'color' => esc_attr( $desktop_right_left_link_color ),
		),
		// Mobile below header link hover color.
		'.ast-header-break-point .below-header-user-select a:hover, .ast-header-break-point .below-header-user-select .widget a:hover' => array(
			'color' => esc_attr( $desktop_right_left_link_hover_color ),
		),
		// Mobile below header link border color to search field.
		'.ast-header-break-point .below-header-user-select .search-field:focus' => array(
			'border-color' => esc_attr( $desktop_right_left_link_color ),
		),
		// Mobile below header active link color.
		'.ast-header-break-point .ast-below-header-navigation .menu-item.current-menu-item > .ast-menu-toggle, .ast-header-break-point .ast-below-header-navigation .menu-item.current-menu-item > .menu-link' => array(
			'color' => esc_attr( $below_header_menu_current_color['desktop'] ),
		),
		// Mobile below header active link bg color.
		'.ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-menu .menu-item.current-menu-item > .ast-menu-toggle, .ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-menu .menu-item.current-menu-ancestor > .ast-menu-toggle, .ast-header-break-point .ast-below-header-navigation .menu-item.current-menu-item > .menu-link, .ast-header-break-point .ast-below-header-navigation .menu-item.current-menu-ancestor > .menu-link' => array(
			'background-color' => esc_attr( $below_header_menu_current_bg_color['desktop'] ),
		),
		// Mobile Below Header menu color.
		'.ast-header-break-point .ast-below-header-menu .current-menu-ancestor:hover > .ast-menu-toggle, .ast-header-break-point .ast-below-header-menu .current-menu-ancestor > .ast-menu-toggle, .ast-header-break-point .ast-below-header-menu, .ast-header-break-point .ast-below-header-menu .menu-link, .ast-header-break-point .ast-below-header-menu .menu-item:hover > .ast-menu-toggle, .ast-header-break-point .ast-below-header-menu .menu-item.focus > .ast-menu-toggle, .ast-header-break-point .ast-below-header-menu  .current-menu-item > .ast-menu-toggle, .ast-header-break-point .ast-below-header-menu .current-menu-ancestor > .ast-menu-toggle' => array(
			'color' => esc_attr( $below_header_menu_text['desktop'] ),
		),
		// Mobile Below Header menu hover color.
		'.ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-menu .menu-item:hover > .ast-menu-toggle, .ast-header-break-point .ast-below-header-menu .menu-link:hover, .ast-header-break-point .ast-below-header-menu .menu-item:hover > .menu-link, .ast-header-break-point .ast-below-header-menu .menu-item.focus > .menu-link' => array(
			'color' => esc_attr( $below_header_menu_hover_color['desktop'] ),
		),
		'.ast-header-break-point .ast-below-header-menu .menu-item:hover > .ast-menu-toggle, .ast-header-break-point .ast-below-header-menu .menu-item.focus > .ast-menu-toggle' => array(
			'color' => esc_attr( $below_header_menu_hover_color['desktop'] ),
		),
		// Mobile Below Header menu hover bg color.
		'.ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-menu .menu-item:hover > .ast-menu-toggle, .ast-header-break-point .ast-below-header-menu .menu-link:hover, .ast-header-break-point .ast-below-header-menu .menu-item:hover > .menu-link, .ast-header-break-point .ast-below-header-menu .menu-item.focus > .menu-link' => array(
			'background-color' => esc_attr( $below_header_menu_hover_bg_color['desktop'] ),
		),
		// Submenu.
		'.ast-header-break-point .ast-below-header-navigation .sub-menu, .ast-header-break-point .ast-below-header-navigation .sub-menu .menu-link' => array(
			'color' => esc_attr( $below_header_submenu_text_color['desktop'] ),
		),
		// Submenu bg color.
		'.ast-header-break-point .ast-below-header-menu .sub-menu' => array(
			'background-color' => esc_attr( $below_header_submenu_bg_color['desktop'] ),
		),
		// Submenu hover color.
		'.ast-header-break-point .ast-below-header-menu .sub-menu .menu-item:hover > .menu-link, .ast-header-break-point .ast-below-header-menu .sub-menu .menu-item:focus > .menu-link, .ast-header-break-point .ast-below-header-menu .sub-menu .menu-item:hover > .ast-menu-toggle, .ast-header-break-point .ast-below-header-menu .sub-menu .menu-item:focus > .ast-menu-toggle' => array(
			'color' => esc_attr( $below_header_submenu_hover_color['desktop'] ),
		),
		// Submenu hover bg color.
		'.ast-header-break-point .ast-below-header-menu .sub-menu .menu-link:hover, .ast-header-break-point .ast-below-header-menu .sub-menu .menu-item:hover > .menu-link' => array(
			'background-color' => esc_attr( $below_header_submenu_bg_hover_color['desktop'] ),
		),
		// Submenu active color.
		'.ast-header-break-point .ast-below-header-menu .sub-menu .menu-item.current-menu-item > .menu-link, .ast-header-break-point .ast-below-header-menu .sub-menu .menu-item.current-menu-ancestor > .menu-link' => array(
			'color' => esc_attr( $below_header_submenu_active_color['desktop'] ),
		),
		// Submenu active bg color.
		'.ast-header-break-point .ast-below-header-menu .sub-menu .menu-item.current-menu-item > .menu-link, .ast-header-break-point .ast-below-header-menu .sub-menu .menu-item.current-menu-ancestor > .menu-link' => array(
			'background-color' => esc_attr( $below_header_submenu_active_bg_color['desktop'] ),
		),
	);
	$tablet_colors = array(
		// Mobile below header Background Image.
		'.ast-header-break-point .ast-below-header' => astra_get_responsive_background_obj( $below_header_obj, 'tablet' ),
		// Mobile below header text color.
		'.ast-header-break-point .below-header-user-select,.ast-header-break-point .below-header-user-select .widget' => array(
			'color' => esc_attr( $right_left_text_color['tablet'] ),
		),
		// Mobile below header link color.
		'.ast-header-break-point .below-header-user-select a, .ast-header-break-point .below-header-user-select .widget a' => array(
			'color' => esc_attr( $tablet_right_left_link_color ),
		),
		// Mobile below header Menu Background color.
		'.ast-header-break-point .ast-below-header-section-separated .ast-below-header-actual-nav' => astra_get_background_obj( $below_header_menu_bg_obj['tablet'] ),
		// Mobile below header link hover color.
		'.ast-header-break-point .below-header-user-select a:hover, .ast-header-break-point .below-header-user-select .widget a:hover' => array(
			'color' => esc_attr( $tablet_right_left_link_hover_color ),
		),
		// Mobile below header link border color to search field.
		'.ast-header-break-point .below-header-user-select .search-field:focus' => array(
			'border-color' => esc_attr( $tablet_right_left_link_color ),
		),
		// Mobile below header active link color.
		'.ast-header-break-point .ast-below-header-navigation .menu-item.current-menu-item > .ast-menu-toggle, .ast-header-break-point .ast-below-header-navigation .menu-item.current-menu-item > .menu-link' => array(
			'color' => esc_attr( $below_header_menu_current_color['tablet'] ),
		),
		// Mobile below header active link bg color.
		'.ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-menu .menu-item.current-menu-item > .ast-menu-toggle, .ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-menu .menu-item.current-menu-ancestor > .ast-menu-toggle, .ast-header-break-point .ast-below-header-navigation .menu-item.current-menu-item > .menu-link, .ast-header-break-point .ast-below-header-navigation .menu-item.current-menu-ancestor > .menu-link' => array(
			'background-color' => esc_attr( $below_header_menu_current_bg_color['tablet'] ),
		),
		// Mobile Below Header menu color.
		'.ast-header-break-point .ast-below-header-menu .current-menu-ancestor:hover > .ast-menu-toggle, .ast-header-break-point .ast-below-header-menu .current-menu-ancestor > .ast-menu-toggle, .ast-header-break-point .ast-below-header-menu, .ast-header-break-point .ast-below-header-menu .menu-link, .ast-header-break-point .ast-below-header-menu .menu-item:hover > .ast-menu-toggle, .ast-header-break-point .ast-below-header-menu .menu-item.focus > .ast-menu-toggle, .ast-header-break-point .ast-below-header-menu  .current-menu-item > .ast-menu-toggle, .ast-header-break-point .ast-below-header-menu .current-menu-ancestor > .ast-menu-toggle' => array(
			'color' => esc_attr( $below_header_menu_text['tablet'] ),
		),
		// Mobile Below Header menu hover color.
		'.ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-menu .menu-item:hover > .ast-menu-toggle, .ast-header-break-point .ast-below-header-menu .menu-link:hover, .ast-header-break-point .ast-below-header-menu .menu-item:hover > .menu-link, .ast-header-break-point .ast-below-header-menu .menu-item.focus > .menu-link' => array(
			'color' => esc_attr( $below_header_menu_hover_color['tablet'] ),
		),
		'.ast-header-break-point .ast-below-header-menu .menu-item:hover > .ast-menu-toggle, .ast-header-break-point .ast-below-header-menu .menu-item.focus > .ast-menu-toggle' => array(
			'color' => esc_attr( $below_header_menu_hover_color['tablet'] ),
		),
		// Mobile Below Header menu hover bg color.
		'.ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-menu .menu-item:hover > .ast-menu-toggle, .ast-header-break-point .ast-below-header-menu .menu-link:hover, .ast-header-break-point .ast-below-header-menu .menu-item:hover > .menu-link, .ast-header-break-point .ast-below-header-menu .menu-item.focus > .menu-link' => array(
			'background-color' => esc_attr( $below_header_menu_hover_bg_color['tablet'] ),
		),
		// Submenu.
		'.ast-header-break-point .ast-below-header-navigation .sub-menu, .ast-header-break-point .ast-below-header-navigation .sub-menu .menu-link' => array(
			'color' => esc_attr( $below_header_submenu_text_color['tablet'] ),
		),
		// Submenu bg color.
		'.ast-header-break-point .ast-below-header-menu .sub-menu, .ast-header-break-point .ast-below-header-menu .sub-menu' => array(
			'background-color' => esc_attr( $below_header_submenu_bg_color['tablet'] ),
		),
		// Submenu hover color.
		'.ast-header-break-point .ast-below-header-menu .sub-menu .menu-item:hover > .menu-link, .ast-header-break-point .ast-below-header-menu .sub-menu .menu-item:focus > .menu-link, .ast-header-break-point .ast-below-header-menu .sub-menu .menu-item:hover > .ast-menu-toggle, .ast-header-break-point .ast-below-header-menu .sub-menu .menu-item:focus > .ast-menu-toggle' => array(
			'color' => esc_attr( $below_header_submenu_hover_color['tablet'] ),
		),
		// Submenu hover bg color.
		'.ast-header-break-point .ast-below-header-menu .sub-menu .menu-link:hover, .ast-header-break-point .ast-below-header-menu .sub-menu .menu-item:hover > .menu-link, .ast-header-break-point .ast-below-header-menu .sub-menu .menu-item.focus > .menu-link' => array(
			'background-color' => esc_attr( $below_header_submenu_bg_hover_color['tablet'] ),
		),
		// Submenu active color.
		'.ast-header-break-point .ast-below-header-menu .sub-menu .menu-item.current-menu-item > .menu-link, .ast-header-break-point .ast-below-header-menu .sub-menu .menu-item.current-menu-ancestor > .menu-link' => array(
			'color' => esc_attr( $below_header_submenu_active_color['tablet'] ),
		),
		// Submenu active bg color.
		'.ast-header-break-point .ast-below-header-menu .sub-menu .menu-item.current-menu-item > .menu-link, .ast-header-break-point .ast-below-header-menu .sub-menu .menu-item.current-menu-ancestor > .menu-link' => array(
			'background-color' => esc_attr( $below_header_submenu_active_bg_color['tablet'] ),
		),
	);
	$mobile_colors = array(
		// Mobile below header Background Image.
		'.ast-header-break-point .ast-below-header' => astra_get_responsive_background_obj( $below_header_obj, 'mobile' ),
		// Mobile below header text color.
		'.ast-header-break-point .below-header-user-select,.ast-header-break-point .below-header-user-select .widget' => array(
			'color' => esc_attr( $right_left_text_color['mobile'] ),
		),
		// Mobile below header link color.
		'.ast-header-break-point .below-header-user-select a, .ast-header-break-point .below-header-user-select .widget a' => array(
			'color' => esc_attr( $mobile_right_left_link_color ),
		),
		// Mobile below header Menu Background color.
		'.ast-header-break-point .ast-below-header-section-separated .ast-below-header-actual-nav' => astra_get_background_obj( $below_header_menu_bg_obj['mobile'] ),
		// Mobile below header link hover color.
		'.ast-header-break-point .below-header-user-select a:hover, .ast-header-break-point .below-header-user-select .widget a:hover' => array(
			'color' => esc_attr( $mobile_right_left_link_hover_color ),
		),
		// Mobile below header link border color to search field.
		'.ast-header-break-point .below-header-user-select .search-field:focus' => array(
			'border-color' => esc_attr( $mobile_right_left_link_color ),
		),
		// Mobile below header active link color.
		'.ast-header-break-point .ast-below-header-navigation .menu-item.current-menu-item > .ast-menu-toggle, .ast-header-break-point .ast-below-header-navigation .menu-item.current-menu-item > .menu-link' => array(
			'color' => esc_attr( $below_header_menu_current_color['mobile'] ),
		),
		// Mobile below header active link bg color.
		'.ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-menu .menu-item.current-menu-item > .ast-menu-toggle, .ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-menu .menu-item.current-menu-ancestor > .ast-menu-toggle, .ast-header-break-point .ast-below-header-navigation .menu-item.current-menu-item > .menu-link, .ast-header-break-point .ast-below-header-navigation .menu-item.current-menu-ancestor > .menu-link' => array(
			'background-color' => esc_attr( $below_header_menu_current_bg_color['mobile'] ),
		),
		// Mobile Below Header menu color.
		'.ast-header-break-point .ast-below-header-menu .current-menu-ancestor:hover > .ast-menu-toggle, .ast-header-break-point .ast-below-header-menu .current-menu-ancestor > .ast-menu-toggle, .ast-header-break-point .ast-below-header-menu, .ast-header-break-point .ast-below-header-menu .menu-link, .ast-header-break-point .ast-below-header-menu .menu-item:hover > .ast-menu-toggle, .ast-header-break-point .ast-below-header-menu .menu-item.focus > .ast-menu-toggle, .ast-header-break-point .ast-below-header-menu  .current-menu-item > .ast-menu-toggle, .ast-header-break-point .ast-below-header-menu .current-menu-ancestor > .ast-menu-toggle' => array(
			'color' => esc_attr( $below_header_menu_text['mobile'] ),
		),
		// Mobile Below Header menu hover color.
		'.ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-menu .menu-item:hover > .ast-menu-toggle, .ast-header-break-point .ast-below-header-menu .menu-link:hover, .ast-header-break-point .ast-below-header-menu .menu-item:hover > .menu-link, .ast-header-break-point .ast-below-header-menu .menu-item.focus > .menu-link' => array(
			'color' => esc_attr( $below_header_menu_hover_color['mobile'] ),
		),
		'.ast-header-break-point .ast-below-header-menu .menu-item:hover > .ast-menu-toggle, .ast-header-break-point .ast-below-header-menu .menu-item.focus > .ast-menu-toggle' => array(
			'color' => esc_attr( $below_header_menu_hover_color['mobile'] ),
		),
		// Mobile Below Header menu hover bg color.
		'.ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-menu .menu-item:hover > .ast-menu-toggle, .ast-header-break-point .ast-below-header-menu .menu-link:hover, .ast-header-break-point .ast-below-header-menu .menu-item:hover > .menu-link, .ast-header-break-point .ast-below-header-menu .menu-item.focus > .menu-link' => array(
			'background-color' => esc_attr( $below_header_menu_hover_bg_color['mobile'] ),
		),
		// Submenu.
		'.ast-header-break-point .ast-below-header-navigation .sub-menu, .ast-header-break-point .ast-below-header-navigation .sub-menu .menu-link' => array(
			'color' => esc_attr( $below_header_submenu_text_color['mobile'] ),
		),
		// Submenu bg color.
		'.ast-header-break-point .ast-below-header-menu .sub-menu' => array(
			'background-color' => esc_attr( $below_header_submenu_bg_color['mobile'] ),
		),
		// Submenu hover color.
		'.ast-header-break-point .ast-below-header-menu .sub-menu .menu-item:hover > .menu-link, .ast-header-break-point .ast-below-header-menu .sub-menu .menu-item:focus > .menu-link, .ast-header-break-point .ast-below-header-menu .sub-menu .menu-item:hover > .ast-menu-toggle, .ast-header-break-point .ast-below-header-menu .sub-menu .menu-item:focus > .ast-menu-toggle' => array(
			'color' => esc_attr( $below_header_submenu_hover_color['mobile'] ),
		),
		// Submenu hover bg color.
		'.ast-header-break-point .ast-below-header-menu .sub-menu .menu-link:hover, .ast-header-break-point .ast-below-header-menu .sub-menu .menu-item:hover > .menu-link, .ast-header-break-point .ast-below-header-menu .sub-menu .menu-item.focus > .menu-link' => array(
			'background-color' => esc_attr( $below_header_submenu_bg_hover_color['mobile'] ),
		),
		// Submenu active color.
		'.ast-header-break-point .ast-below-header-menu .sub-menu .menu-item.current-menu-item > .menu-link, .ast-header-break-point .ast-below-header-menu .sub-menu .menu-item.current-menu-ancestor > .menu-link' => array(
			'color' => esc_attr( $below_header_submenu_active_color['mobile'] ),
		),
		// Submenu active bg color.
		'.ast-header-break-point .ast-below-header-menu .sub-menu .menu-item.current-menu-item > .menu-link, .ast-header-break-point .ast-below-header-menu .sub-menu .menu-item.current-menu-ancestor > .menu-link' => array(
			'background-color' => esc_attr( $below_header_submenu_active_bg_color['mobile'] ),
		),
	);
	/* Parse CSS from array() */
	$css_output .= astra_parse_css( $desktop_colors );
	$css_output .= astra_parse_css( $tablet_colors, '', astra_addon_get_tablet_breakpoint() );
	$css_output .= astra_parse_css( $mobile_colors, '', astra_addon_get_mobile_breakpoint() );

	/**
	 * Responsive Colors options
	 * [2]. Below Header Menu Responsive Colors only for Full Screen menu style
	 */
	if ( 'fullscreen' == $below_menu_style ) {
			$desktop_colors = array(
				'.ast-fullscreen-below-menu-enable.ast-header-break-point .ast-below-header-navigation-wrap .close' => array(
					'color' => esc_attr( $mobile_header_close_desktop_color ),
				),
				// Mobile below header active link bg color.
				'.ast-fullscreen-below-menu-enable.ast-header-break-point .ast-below-header-navigation .menu-item.current-menu-item > .menu-link, .ast-fullscreen-below-menu-enable.ast-header-break-point .ast-below-header-navigation .menu-item.current-menu-ancestor > .menu-link' => array(
					'background-color' => 'transparent',
				),
				'.ast-fullscreen-below-menu-enable.ast-header-break-point .ast-below-header-navigation .menu-item.current-menu-item, .ast-fullscreen-below-menu-enable.ast-header-break-point .ast-below-header-navigation .menu-item.current-menu-ancestor' => array(
					'background-color' => esc_attr( $below_header_menu_current_bg_color['desktop'] ),
				),
				// Mobile Below Header menu hover bg color.
				'.ast-fullscreen-below-menu-enable.ast-header-break-point .ast-below-header-menu .menu-item:hover > .menu-link, .ast-fullscreen-below-menu-enable.ast-header-break-point .ast-below-header-menu .menu-item.focus > .menu-link' => array(
					'background-color' => 'transparent',
				),
				'.ast-fullscreen-below-menu-enable.ast-header-break-point .ast-below-header-menu .menu-item:hover, .ast-fullscreen-below-menu-enable.ast-header-break-point .ast-below-header-menu .menu-item.focus' => array(
					'background-color' => esc_attr( $below_header_menu_hover_bg_color['desktop'] ),
				),
				// Submenu bg color.
				'.ast-fullscreen-below-menu-enable.ast-header-break-point .ast-below-header-menu .menu-link, .ast-fullscreen-below-menu-enable.ast-header-break-point .ast-below-header-menu .menu-item > .menu-link, .ast-fullscreen-below-menu-enable.ast-header-break-point .ast-below-header-menu .menu-item.focus > .menu-link' => array(
					'background-color' => 'transparent',
				),
				// Submenu hover bg color.
				'.ast-fullscreen-below-menu-enable.ast-header-break-point .ast-below-header-menu .sub-menu .menu-item:hover' => array(
					'background-color' => esc_attr( $below_header_submenu_bg_hover_color['desktop'] ),
				),
				'.ast-fullscreen-below-menu-enable.ast-header-break-point .ast-below-header-menu .sub-menu .menu-link:hover, .ast-fullscreen-below-menu-enable.ast-header-break-point .ast-below-header-menu .sub-menu .menu-link:focus' => array(
					'background-color' => 'transparent',
				),
				// Submenu active bg color.
				'.ast-fullscreen-below-menu-enable.ast-header-break-point .ast-below-header-menu .sub-menu .menu-item.current-menu-item > .menu-link, .ast-fullscreen-below-menu-enable.ast-header-break-point .ast-below-header-menu .sub-menu .menu-item.current-menu-ancestor > .menu-link' => array(
					'background-color' => 'transparent',
				),
				'.ast-fullscreen-below-menu-enable.ast-header-break-point .ast-below-header-menu .sub-menu .menu-item.current-menu-item, .ast-fullscreen-below-menu-enable.ast-header-break-point .ast-below-header-menu .sub-menu .menu-item.current-menu-ancestor' => array(
					'background-color' => esc_attr( $below_header_submenu_active_bg_color['desktop'] ),
				),
			);

			// Fullscreen background color if Below Header Background color is set.
			$desktop_colors['.ast-fullscreen-below-menu-enable.ast-header-break-point .ast-below-header-navigation-wrap'] = astra_get_responsive_background_obj( $below_header_obj, 'desktop' );
			// Fullscreen background color if Below Header Menu Background color is set.
			if ( '' !== $below_header_menu_bg_obj['desktop']['background-color'] || '' !== $below_header_menu_bg_obj['desktop']['background-image'] ) {
				$desktop_colors['.ast-fullscreen-below-menu-enable.ast-header-break-point .ast-below-header-navigation-wrap'] = astra_get_background_obj( $below_header_menu_bg_obj['desktop'] );
			}

			$tablet_colors = array(
				'.ast-fullscreen-below-menu-enable.ast-header-break-point .ast-below-header-navigation-wrap .close' => array(
					'color' => esc_attr( $mobile_header_close_tablet_color ),
				),
				'.ast-fullscreen-below-menu-enable.ast-header-break-point .ast-below-header-navigation .menu-item.current-menu-item, .ast-fullscreen-below-menu-enable.ast-header-break-point .ast-below-header-navigation .menu-item.current-menu-ancestor' => array(
					'background-color' => esc_attr( $below_header_menu_current_bg_color['tablet'] ),
				),
				// Mobile Below Header menu hover bg color.
				'.ast-fullscreen-below-menu-enable.ast-header-break-point .ast-below-header-menu .menu-item:hover > .menu-link, .ast-fullscreen-below-menu-enable.ast-header-break-point .ast-below-header-menu .menu-item.focus > .menu-link' => array(
					'background-color' => 'transparent',
				),
				'.ast-fullscreen-below-menu-enable.ast-header-break-point .ast-below-header-menu .menu-item:hover, .ast-fullscreen-below-menu-enable.ast-header-break-point .ast-below-header-menu .menu-item.focus' => array(
					'background-color' => esc_attr( $below_header_menu_hover_bg_color['tablet'] ),
				),
				// Submenu bg color.
				'.ast-fullscreen-below-menu-enable.ast-header-break-point .ast-below-header-menu .menu-link, .ast-fullscreen-below-menu-enable.ast-header-break-point .ast-below-header-menu .menu-item > .menu-link, .ast-fullscreen-below-menu-enable.ast-header-break-point .ast-below-header-menu .menu-item.focus > .menu-link' => array(
					'background-color' => 'transparent',
				),
				// Submenu hover bg color.
				'.ast-fullscreen-below-menu-enable.ast-header-break-point .ast-below-header-menu .sub-menu .menu-item:hover' => array(
					'background-color' => esc_attr( $below_header_submenu_bg_hover_color['tablet'] ),
				),
				'.ast-fullscreen-below-menu-enable.ast-header-break-point .ast-below-header-menu .sub-menu .menu-link:hover, .ast-fullscreen-below-menu-enable.ast-header-break-point .ast-below-header-menu .sub-menu .menu-link:focus' => array(
					'background-color' => 'transparent',
				),
				// Submenu active bg color.
				'.ast-fullscreen-below-menu-enable.ast-header-break-point .ast-below-header-menu .sub-menu .menu-item.current-menu-item > .menu-link, .ast-fullscreen-below-menu-enable.ast-header-break-point .ast-below-header-menu .sub-menu .menu-item.current-menu-ancestor > .menu-link' => array(
					'background-color' => 'transparent',
				),
				'.ast-fullscreen-below-menu-enable.ast-header-break-point .ast-below-header-menu .sub-menu .menu-item.current-menu-item, .ast-fullscreen-below-menu-enable.ast-header-break-point .ast-below-header-menu .sub-menu .menu-item.current-menu-ancestor' => array(
					'background-color' => esc_attr( $below_header_submenu_active_bg_color['tablet'] ),
				),
			);
			// Fullscreen background color if Below Header Background color is set.
			$tablet_colors['.ast-fullscreen-below-menu-enable.ast-header-break-point .ast-below-header-navigation-wrap'] = astra_get_responsive_background_obj( $below_header_obj, 'tablet' );
			// Fullscreen background color if Below Header Menu Background color is set.
			if ( '' !== $below_header_menu_bg_obj['tablet']['background-color'] || '' !== $below_header_menu_bg_obj['tablet']['background-image'] ) {
				$tablet_colors['.ast-fullscreen-below-menu-enable.ast-header-break-point .ast-below-header-navigation-wrap'] = astra_get_background_obj( $below_header_menu_bg_obj['tablet'] );
			}

			$mobile_colors = array(
				'.ast-fullscreen-below-menu-enable.ast-header-break-point .ast-below-header-navigation-wrap .close' => array(
					'color' => esc_attr( $mobile_header_close_mobile_color ),
				),
				'.ast-fullscreen-below-menu-enable.ast-header-break-point .ast-below-header-navigation .menu-item.current-menu-item, .ast-fullscreen-below-menu-enable.ast-header-break-point .ast-below-header-navigation .menu-item.current-menu-ancestor' => array(
					'background-color' => esc_attr( $below_header_menu_current_bg_color['mobile'] ),
				),
				// Mobile Below Header menu hover bg color.
				'.ast-fullscreen-below-menu-enable.ast-header-break-point .ast-below-header-menu .menu-item:hover > .menu-link, .ast-fullscreen-below-menu-enable.ast-header-break-point .ast-below-header-menu .menu-item.focus > .menu-link' => array(
					'background-color' => 'transparent',
				),
				'.ast-fullscreen-below-menu-enable.ast-header-break-point .ast-below-header-menu .menu-item:hover, .ast-fullscreen-below-menu-enable.ast-header-break-point .ast-below-header-menu .menu-item.focus' => array(
					'background-color' => esc_attr( $below_header_menu_hover_bg_color['mobile'] ),
				),
				// Submenu bg color.
				'.ast-fullscreen-below-menu-enable.ast-header-break-point .ast-below-header-menu .menu-link, .ast-fullscreen-below-menu-enable.ast-header-break-point .ast-below-header-menu .menu-item > .menu-link, .ast-fullscreen-below-menu-enable.ast-header-break-point .ast-below-header-menu .menu-item.focus > .menu-link' => array(
					'background-color' => 'transparent',
				),
				// Submenu hover bg color.
				'.ast-fullscreen-below-menu-enable.ast-header-break-point .ast-below-header-menu .sub-menu .menu-item:hover' => array(
					'background-color' => esc_attr( $below_header_submenu_bg_hover_color['mobile'] ),
				),
				'.ast-fullscreen-below-menu-enable.ast-header-break-point .ast-below-header-menu .sub-menu .menu-link:hover, .ast-fullscreen-below-menu-enable.ast-header-break-point .ast-below-header-menu .sub-menu .menu-link:focus' => array(
					'background-color' => 'transparent',
				),
				// Submenu active bg color.
				'.ast-fullscreen-below-menu-enable.ast-header-break-point .ast-below-header-menu .sub-menu .menu-item.current-menu-item > .menu-link, .ast-fullscreen-below-menu-enable.ast-header-break-point .ast-below-header-menu .sub-menu .menu-item.current-menu-ancestor > .menu-link' => array(
					'background-color' => 'transparent',
				),
				'.ast-fullscreen-below-menu-enable.ast-header-break-point .ast-below-header-menu .sub-menu .menu-item.current-menu-item, .ast-fullscreen-below-menu-enable.ast-header-break-point .ast-below-header-menu .sub-menu .menu-item.current-menu-ancestor' => array(
					'background-color' => esc_attr( $below_header_submenu_active_bg_color['mobile'] ),
				),
			);
			// Fullscreen background color if Below Header Background color is set.
			$mobile_colors['.ast-fullscreen-below-menu-enable.ast-header-break-point .ast-below-header-navigation-wrap'] = astra_get_responsive_background_obj( $below_header_obj, 'mobile' );
			// Fullscreen background color if Below Header Menu Background color is set.
			if ( '' !== $below_header_menu_bg_obj['mobile']['background-color'] || '' !== $below_header_menu_bg_obj['mobile']['background-image'] ) {
				$mobile_colors['.ast-fullscreen-below-menu-enable.ast-header-break-point .ast-below-header-navigation-wrap'] = astra_get_background_obj( $below_header_menu_bg_obj['mobile'] );
			}

			/* Parse CSS from array() */
			$css_output .= astra_parse_css( $desktop_colors );
			$css_output .= astra_parse_css( $tablet_colors, '', astra_addon_get_tablet_breakpoint() );
			$css_output .= astra_parse_css( $mobile_colors, '', astra_addon_get_mobile_breakpoint() );

			/**
			 * Border only for Responsive Devices
			 */
			if ( '' !== $mobile_below_header_menu_all_border['top'] || '' !== $mobile_below_header_menu_all_border['right'] || '' !== $mobile_below_header_menu_all_border['bottom'] || '' !== $mobile_below_header_menu_all_border['left'] ) {
				$mobile_below_header_border = array(
					'.ast-fullscreen-below-menu-enable.ast-header-break-point .ast-below-header .ast-below-header-navigation .ast-below-header-menu > .menu-item' => array(
						'border-right-width' => astra_get_css_value( $mobile_below_header_menu_all_border['right'], 'px' ),
						'border-left-width'  => astra_get_css_value( $mobile_below_header_menu_all_border['left'], 'px' ),
						'border-style'       => 'solid',
						'border-color'       => esc_attr( $mobile_below_header_menu_b_color ),
					),
					'.ast-fullscreen-below-menu-enable.ast-header-break-point .ast-below-header .ast-below-header-navigation .ast-below-header-menu > .menu-item:not(:first-child):not(:last-child)' => array(
						'border-top-width'    => ( ! empty( $mobile_below_header_menu_all_border['top'] ) && ! empty( $mobile_below_header_menu_all_border['bottom'] ) ) ? astra_calc_spacing( $mobile_below_header_menu_all_border['top'] . 'px', '/', '2' ) : astra_get_css_value( $mobile_below_header_menu_all_border['top'], 'px' ),
						'border-bottom-width' => ( ! empty( $mobile_below_header_menu_all_border['bottom'] ) && ! empty( $mobile_below_header_menu_all_border['bottom'] ) ) ? astra_calc_spacing( $mobile_below_header_menu_all_border['bottom'] . 'px', '/', '2' ) : astra_get_css_value( $mobile_below_header_menu_all_border['bottom'], 'px' ),
						'border-style'        => 'solid',
						'border-color'        => esc_attr( $mobile_below_header_menu_b_color ),
					),
					'.ast-fullscreen-below-menu-enable.ast-header-break-point .ast-below-header .ast-below-header-navigation .ast-below-header-menu .menu-item:first-child' => array(
						'border-top-width'    => astra_get_css_value( $mobile_below_header_menu_all_border['top'], 'px' ),
						'border-bottom-width' => ( ! empty( $mobile_below_header_menu_all_border['bottom'] ) && ! empty( $mobile_below_header_menu_all_border['bottom'] ) ) ? astra_calc_spacing( $mobile_below_header_menu_all_border['bottom'] . 'px', '/', '2' ) : astra_get_css_value( $mobile_below_header_menu_all_border['bottom'], 'px' ),
						'border-style'        => 'solid',
						'border-color'        => esc_attr( $mobile_below_header_menu_b_color ),
					),
					'.ast-fullscreen-below-menu-enable.ast-header-break-point .ast-below-header .ast-below-header-navigation .ast-below-header-menu .menu-item:last-child' => array(
						'border-top-width'    => ( ! empty( $mobile_below_header_menu_all_border['top'] ) && ! empty( $mobile_below_header_menu_all_border['bottom'] ) ) ? astra_calc_spacing( $mobile_below_header_menu_all_border['top'] . 'px', '/', '2' ) : astra_get_css_value( $mobile_below_header_menu_all_border['top'], 'px' ),
						'border-bottom-width' => astra_get_css_value( $mobile_below_header_menu_all_border['bottom'], 'px' ),
						'border-style'        => 'solid',
						'border-color'        => esc_attr( $mobile_below_header_menu_b_color ),
					),
					'.ast-fullscreen-below-menu-enable.ast-header-break-point .ast-below-header .ast-below-header-navigation .ast-below-header-menu .menu-item.ast-submenu-expanded .sub-menu .menu-item' => array(
						'border-top-width'    => astra_get_css_value( $mobile_below_header_menu_all_border['top'], 'px' ),
						'border-bottom-width' => 0,
						'border-style'        => 'solid',
						'border-color'        => esc_attr( $mobile_below_header_menu_b_color ),
					),
					'.ast-fullscreen-below-menu-enable.ast-header-break-point .ast-below-header .ast-below-header-navigation .ast-below-header-menu .ast-masthead-custom-menu-items' => array(
						'border-top-width'    => ( ! empty( $mobile_below_header_menu_all_border['top'] ) && ! empty( $mobile_below_header_menu_all_border['bottom'] ) ) ? astra_calc_spacing( $mobile_below_header_menu_all_border['top'] . 'px', '/', '2' ) : astra_get_css_value( $mobile_below_header_menu_all_border['top'], 'px' ),
						'border-bottom-width' => astra_get_css_value( $mobile_below_header_menu_all_border['bottom'], 'px' ),
						'border-right-width'  => astra_get_css_value( $mobile_below_header_menu_all_border['right'], 'px' ),
						'border-left-width'   => astra_get_css_value( $mobile_below_header_menu_all_border['left'], 'px' ),
						'border-style'        => 'solid',
						'border-color'        => esc_attr( $mobile_below_header_menu_b_color ),
					),
				);
				$css_output                .= astra_parse_css( $mobile_below_header_border );
			}
	} elseif ( 'no-toggle' == $below_menu_style ) {
		// Border only for responsive devices.
		if ( '' !== $mobile_below_header_menu_all_border['top'] || '' !== $mobile_below_header_menu_all_border['right'] || '' !== $mobile_below_header_menu_all_border['bottom'] || '' !== $mobile_below_header_menu_all_border['left'] ) {
			$mobile_header_border = array(
				'.ast-header-break-point.ast-no-toggle-below-menu-enable .ast-below-header-menu .menu-item' => array(
					'border-top-width'    => astra_get_css_value( $mobile_below_header_menu_all_border['top'], 'px' ),
					'border-bottom-width' => astra_get_css_value( $mobile_below_header_menu_all_border['bottom'], 'px' ),
					'border-left-width'   => astra_get_css_value( $mobile_below_header_menu_all_border['left'], 'px' ),
					'border-right-width'  => astra_get_css_value( $mobile_below_header_menu_all_border['right'], 'px' ),
					'border-color'        => esc_attr( $mobile_below_header_menu_b_color ),
				),
				'.ast-header-break-point.ast-no-toggle-below-menu-enable .ast-below-header-actual-nav ul > li:first-child, .ast-header-break-point.ast-no-toggle-below-menu-enable .ast-below-header-menu-items .sub-menu > .menu-item:first-child' => array(
					'border-top-width' => astra_get_css_value( $mobile_below_header_menu_all_border['top'], 'px' ),
					'border-color'     => esc_attr( $mobile_below_header_menu_b_color ),
				),
				'.ast-header-break-point.ast-no-toggle-below-menu-enable .ast-below-header .ast-below-header-menu > .menu-item:last-child' => array(
					'border-right-width' => astra_get_css_value( $mobile_below_header_menu_all_border['right'], 'px' ),
					'border-color'       => esc_attr( $mobile_below_header_menu_b_color ),
				),
				'.ast-header-break-point.ast-no-toggle-below-menu-enable .ast-below-header-actual-nav .sub-menu .menu-item:last-child,.ast-header-break-point.ast-no-toggle-below-menu-enable .ast-below-header-actual-nav ul ul li:last-child' => array(
					'border-bottom-width' => astra_get_css_value( $mobile_below_header_menu_all_border['bottom'], 'px' ),
					'border-color'        => esc_attr( $mobile_below_header_menu_b_color ),
				),
				'.ast-header-break-point.ast-no-toggle-below-menu-enable .ast-below-header-menu > .menu-item > .sub-menu .menu-item:last-child' => array(
					'border-bottom-width' => astra_get_css_value( $mobile_below_header_menu_all_border['bottom'], 'px' ),
					'border-color'        => esc_attr( $mobile_below_header_menu_b_color ),
				),

				'.ast-header-break-point.ast-no-toggle-below-menu-enable .ast-below-header-menu > .menu-item' => array(
					'margin-right' => '-' . astra_get_css_value( $mobile_below_header_menu_all_border['right'], 'px' ),
				),
				'.ast-header-break-point.ast-no-toggle-below-menu-enable .ast-below-header-menu > .menu-item > .sub-menu' => array(
					'margin-left' => '-' . astra_get_css_value( $mobile_below_header_menu_all_border['left'], 'px' ),
				),
			);
			$css_output .= astra_parse_css( $mobile_header_border );
		}
	} else {
		/**
		 * Border only for Responsive Devices
		 */
		if ( '' !== $mobile_below_header_menu_all_border['top'] || '' !== $mobile_below_header_menu_all_border['right'] || '' !== $mobile_below_header_menu_all_border['bottom'] || '' !== $mobile_below_header_menu_all_border['left'] ) {
				$mobile_below_header_border = array(
					'.ast-header-break-point .ast-below-header-section-separated .ast-below-header-menu' => array(
						'border-top-width'   => astra_get_css_value( $mobile_below_header_menu_all_border['top'], 'px' ),
						'border-left-width'  => astra_get_css_value( $mobile_below_header_menu_all_border['left'], 'px' ),
						'border-right-width' => astra_get_css_value( $mobile_below_header_menu_all_border['right'], 'px' ),
						'border-color'       => esc_attr( $mobile_below_header_menu_b_color ),
					),
					'.ast-header-break-point .ast-below-header-actual-nav ul li a, .ast-header-break-point .ast-below-header-menu-items .sub-menu .menu-item .menu-link' => array(
						'border-bottom-width' => astra_get_css_value( $mobile_below_header_menu_all_border['bottom'], 'px' ),
						'border-color'        => esc_attr( $mobile_below_header_menu_b_color ),
					),
				);
				$css_output                .= astra_parse_css( $mobile_below_header_border );
		}
	}

	/**
	 * Responsive Colors options
	 * [3]. Below Header Menu Responsive Colors only for Flyout menu style
	 */
	if ( 'flyout' == $below_menu_style ) {
		$desktop_colors = array(
			'.ast-flyout-below-menu-enable.ast-header-break-point .ast-below-header-actual-nav' => array(
				'width' => astra_get_css_value( $below_flayout_sidebar_width, 'px' ),
			),
			'.ast-flyout-below-menu-enable.ast-header-break-point .ast-below-header-navigation-wrap .close' => array(
				'color' => esc_attr( $mobile_header_close_desktop_color ),
			),
		);

		// Flyout background color if Header Background color is set.
		$desktop_colors['.ast-flyout-below-menu-enable.ast-header-break-point .ast-below-header-navigation-wrap .ast-below-header-actual-nav'] = astra_get_responsive_background_obj( $below_header_obj, 'desktop' );
		// Flyout background color if Primary Menu Background color is set.
		if ( '' !== $below_header_menu_bg_obj['desktop']['background-color'] || '' !== $below_header_menu_bg_obj['desktop']['background-image'] ) {
			$desktop_colors['.ast-flyout-below-menu-enable.ast-header-break-point .ast-below-header-navigation-wrap .ast-below-header-actual-nav'] = astra_get_background_obj( $below_header_menu_bg_obj['desktop'] );
		}

		$tablet_colors = array(
			'.ast-flyout-below-menu-enable.ast-header-break-point .ast-below-header-navigation-wrap .close' => array(
				'color' => esc_attr( $mobile_header_close_mobile_color ),
			),
		);

		// Flyout background color if Header Background color is set.
		$tablet_colors['.ast-flyout-below-menu-enable.ast-header-break-point .ast-below-header-navigation-wrap .ast-below-header-actual-nav'] = astra_get_responsive_background_obj( $below_header_obj, 'tablet' );
		// Flyout background color if Primary Menu Background color is set.
		if ( '' !== $below_header_menu_bg_obj['tablet']['background-color'] || '' !== $below_header_menu_bg_obj['tablet']['background-image'] ) {
			$tablet_colors['.ast-flyout-below-menu-enable.ast-header-break-point .ast-below-header-navigation-wrap .ast-below-header-actual-nav'] = astra_get_background_obj( $below_header_menu_bg_obj['tablet'] );
		}

		$mobile_colors = array(
			'.ast-flyout-below-menu-enable.ast-header-break-point .ast-below-header-navigation-wrap .close' => array(
				'color' => esc_attr( $mobile_header_close_mobile_color ),
			),
		);

		// Flyout background color if Header Background color is set.
		$mobile_colors['.ast-flyout-below-menu-enable.ast-header-break-point .ast-below-header-navigation-wrap .ast-below-header-actual-nav'] = astra_get_responsive_background_obj( $below_header_obj, 'mobile' );

		// Flyout background color if Primary Menu Background color is set.
		if ( '' !== $below_header_menu_bg_obj['mobile']['background-color'] || '' !== $below_header_menu_bg_obj['mobile']['background-image'] ) {
			$mobile_colors['.ast-flyout-below-menu-enable.ast-header-break-point .ast-below-header-navigation-wrap .ast-below-header-actual-nav'] = astra_get_background_obj( $below_header_menu_bg_obj['mobile'] );
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
	if ( 'no-toggle' == $below_menu_style ) {
		/**
		 * Responsive Colors options
		 * [4]. Below Header Menu Responsive Colors general
		 */
		$desktop_colors = array(
			'.ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-menu .menu-item:hover > .menu-link, .ast-header-break-point .ast-below-header-menu .menu-item:hover > .ast-menu-toggle' => array(
				'background-color' => esc_attr( $below_header_menu_hover_bg_color['desktop'] ),
			),
			'.ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-menu .menu-item:hover > .menu-link, .ast-header-break-point .ast-below-header-menu .menu-item:hover > .ast-menu-toggle' => array(
				'color' => esc_attr( $below_header_menu_hover_color['desktop'] ),
			),
			'.ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-navigation .menu-item.current-menu-item > .menu-link, .ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-navigation .menu-item.current-menu-item:hover > .menu-link, .ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-navigation .menu-item.current-menu-item > .ast-menu-toggle, .ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-navigation .menu-item.current-menu-item:hover > .ast-menu-toggle, .ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-navigation .menu-item.current-menu-ancestor > .menu-link, .ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-navigation .menu-item.current-menu-ancestor:hover > .menu-link, .ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-navigation .menu-item.current-menu-ancestor > .ast-menu-toggle, .ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-navigation .menu-item.current-menu-ancestor:hover > .ast-menu-toggle' => array(
				'background-color' => esc_attr( $below_header_menu_current_bg_color['desktop'] ),
			),
			'.ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-navigation .menu-item.current-menu-item > .menu-link, .ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-navigation .menu-item.current-menu-item:hover > .menu-link, .ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-navigation .menu-item.current-menu-item > .ast-menu-toggle, .ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-navigation .menu-item.current-menu-item:hover > .ast-menu-toggle, .ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-navigation .menu-item.current-menu-ancestor > .menu-link, .ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-navigation .menu-item.current-menu-ancestor:hover > .menu-link, .ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-navigation .menu-item.current-menu-ancestor > .ast-menu-toggle, .ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-navigation .menu-item.current-menu-ancestor:hover > .ast-menu-toggle' => array(
				'color' => esc_attr( $below_header_menu_current_color['desktop'] ),
			),
			'.ast-below-header-menu .menu-item.current-menu-ancestor > .ast-menu-toggle, .ast-below-header-menu .menu-item.current-menu-item > .ast-menu-toggle, .ast-below-header-menu .sub-menu .menu-item.current-menu-ancestor:hover > .ast-menu-toggle, .ast-below-header-menu .sub-menu .menu-item.current-menu-ancestor:focus > .ast-menu-toggle, .ast-below-header-menu .sub-menu .menu-item.current-menu-ancestor.focus > .ast-menu-toggle, .ast-below-header-menu .sub-menu .menu-item.current-menu-item:hover > .ast-menu-toggle, .ast-below-header-menu .sub-menu .menu-item.current-menu-item:focus > .ast-menu-toggle, .ast-below-header-menu .sub-menu .menu-item.current-menu-item.focus > .ast-menu-toggle' => array(
				'background-color' => esc_attr( $below_header_menu_current_bg_color['desktop'] ),
			),
			// Subemnu > Hover.
			'.ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-menu .sub-menu .menu-item:hover > .menu-link, .ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-menu .sub-menu .menu-item:hover > .ast-menu-toggle' => array(
				'color' => esc_attr( $below_header_submenu_hover_color['desktop'] ),
			),
			'.ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-navigation .sub-menu .menu-item.current-menu-item > .menu-link,.ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-navigation .sub-menu .menu-item.current-menu-item:hover > .menu-link,.ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-menu .sub-menu .menu-item.current-menu-ancestor > .ast-menu-toggle,.ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-menu .sub-menu .menu-item.current-menu-item > .ast-menu-toggle,.ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-menu .sub-menu .menu-item.current-menu-ancestor:hover > .ast-menu-toggle,.ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-menu .sub-menu .menu-item.current-menu-ancestor:focus > .ast-menu-toggle,.ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-menu .sub-menu .menu-item.current-menu-ancestor.focus > .ast-menu-toggle,.ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-menu .sub-menu .menu-item.current-menu-item:hover > .ast-menu-toggle,.ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-menu .sub-menu .menu-item.current-menu-item:focus > .ast-menu-toggle,.ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-menu .sub-menu .menu-item.current-menu-item.focus > .ast-menu-toggle' => array(
				'color' => esc_attr( $below_header_submenu_active_color['desktop'] ),
			),
		);
		$tablet_colors = array(
			'.ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-menu .menu-item:hover > .menu-link, .ast-header-break-point .ast-below-header-menu .menu-item:hover > .ast-menu-toggle' => array(
				'background-color' => esc_attr( $below_header_menu_hover_bg_color['tablet'] ),
			),
			'.ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-menu .menu-item:hover > .menu-link, .ast-header-break-point .ast-below-header-menu .menu-item:hover > .ast-menu-toggle' => array(
				'color' => esc_attr( $below_header_menu_hover_color['tablet'] ),
			),
			'.ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-navigation .menu-item.current-menu-item > .menu-link, .ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-navigation .menu-item.current-menu-item:hover > .menu-link, .ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-navigation .menu-item.current-menu-item > .ast-menu-toggle, .ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-navigation .menu-item.current-menu-item:hover > .ast-menu-toggle, .ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-navigation .menu-item.current-menu-ancestor > .menu-link, .ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-navigation .menu-item.current-menu-ancestor:hover > .menu-link, .ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-navigation .menu-item.current-menu-ancestor > .ast-menu-toggle, .ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-navigation .menu-item.current-menu-ancestor:hover > .ast-menu-toggle' => array(
				'background-color' => esc_attr( $below_header_menu_current_bg_color['tablet'] ),
			),
			'.ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-navigation .menu-item.current-menu-item > .menu-link, .ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-navigation .menu-item.current-menu-item:hover > .menu-link, .ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-navigation .menu-item.current-menu-item > .ast-menu-toggle, .ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-navigation .menu-item.current-menu-item:hover > .ast-menu-toggle, .ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-navigation .menu-item.current-menu-ancestor > .menu-link, .ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-navigation .menu-item.current-menu-ancestor:hover > .menu-link, .ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-navigation .menu-item.current-menu-ancestor > .ast-menu-toggle, .ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-navigation .menu-item.current-menu-ancestor:hover > .ast-menu-toggle' => array(
				'color' => esc_attr( $below_header_menu_current_color['tablet'] ),
			),
			'.ast-below-header-menu .menu-item.current-menu-ancestor > .ast-menu-toggle, .ast-below-header-menu .menu-item.current-menu-item > .ast-menu-toggle, .ast-below-header-menu .sub-menu .menu-item.current-menu-ancestor:hover > .ast-menu-toggle, .ast-below-header-menu .sub-menu .menu-item.current-menu-ancestor:focus > .ast-menu-toggle, .ast-below-header-menu .sub-menu .menu-item.current-menu-ancestor.focus > .ast-menu-toggle, .ast-below-header-menu .sub-menu .menu-item.current-menu-item:hover > .ast-menu-toggle, .ast-below-header-menu .sub-menu .menu-item.current-menu-item:focus > .ast-menu-toggle, .ast-below-header-menu .sub-menu .menu-item.current-menu-item.focus > .ast-menu-toggle' => array(
				'background-color' => esc_attr( $below_header_menu_current_bg_color['tablet'] ),
			),
			// Subemnu > Hover.
			'.ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-menu .sub-menu .menu-item:hover > .menu-link, .ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-menu .sub-menu .menu-item:hover > .ast-menu-toggle' => array(
				'color' => esc_attr( $below_header_submenu_hover_color['tablet'] ),
			),
			'.ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-navigation .sub-menu .menu-item.current-menu-item > .menu-link,.ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-navigation .sub-menu .menu-item.current-menu-item:hover > .menu-link,.ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-menu .sub-menu .menu-item.current-menu-ancestor > .ast-menu-toggle,.ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-menu .sub-menu .menu-item.current-menu-item > .ast-menu-toggle,.ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-menu .sub-menu .menu-item.current-menu-ancestor:hover > .ast-menu-toggle,.ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-menu .sub-menu .menu-item.current-menu-ancestor:focus > .ast-menu-toggle,.ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-menu .sub-menu .menu-item.current-menu-ancestor.focus > .ast-menu-toggle,.ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-menu .sub-menu .menu-item.current-menu-item:hover > .ast-menu-toggle,.ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-menu .sub-menu .menu-item.current-menu-item:focus > .ast-menu-toggle,.ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-menu .sub-menu .menu-item.current-menu-item.focus > .ast-menu-toggle' => array(
				'color' => esc_attr( $below_header_submenu_active_color['mobile'] ),
			),
		);
		$mobile_colors = array(
			'.ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-menu .menu-item:hover > .menu-link, .ast-header-break-point .ast-below-header-menu .menu-item:hover > .ast-menu-toggle' => array(
				'background-color' => esc_attr( $below_header_menu_hover_bg_color['mobile'] ),
			),
			'.ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-menu .menu-item:hover > .menu-link, .ast-header-break-point .ast-below-header-menu .menu-item:hover > .ast-menu-toggle' => array(
				'color' => esc_attr( $below_header_menu_hover_color['mobile'] ),
			),
			'.ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-navigation .menu-item.current-menu-item > .menu-link, .ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-navigation .menu-item.current-menu-item:hover > .menu-link, .ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-navigation .menu-item.current-menu-item > .ast-menu-toggle, .ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-navigation .menu-item.current-menu-item:hover > .ast-menu-toggle, .ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-navigation .menu-item.current-menu-ancestor > .menu-link, .ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-navigation .menu-item.current-menu-ancestor:hover > .menu-link, .ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-navigation .menu-item.current-menu-ancestor > .ast-menu-toggle, .ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-navigation .menu-item.current-menu-ancestor:hover > .ast-menu-toggle' => array(
				'background-color' => esc_attr( $below_header_menu_current_bg_color['mobile'] ),
			),
			'.ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-navigation .menu-item.current-menu-item > .menu-link, .ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-navigation .menu-item.current-menu-item:hover > .menu-link, .ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-navigation .menu-item.current-menu-item > .ast-menu-toggle, .ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-navigation .menu-item.current-menu-item:hover > .ast-menu-toggle, .ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-navigation .menu-item.current-menu-ancestor > .menu-link, .ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-navigation .menu-item.current-menu-ancestor:hover > .menu-link, .ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-navigation .menu-item.current-menu-ancestor > .ast-menu-toggle, .ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-navigation .menu-item.current-menu-ancestor:hover > .ast-menu-toggle' => array(
				'color' => esc_attr( $below_header_menu_current_color['mobile'] ),
			),
			'.ast-below-header-menu .menu-item.current-menu-ancestor > .ast-menu-toggle, .ast-below-header-menu .menu-item.current-menu-item > .ast-menu-toggle, .ast-below-header-menu .sub-menu .menu-item.current-menu-ancestor:hover > .ast-menu-toggle, .ast-below-header-menu .sub-menu .menu-item.current-menu-ancestor:focus > .ast-menu-toggle, .ast-below-header-menu .sub-menu .menu-item.current-menu-ancestor.focus > .ast-menu-toggle, .ast-below-header-menu .sub-menu .menu-item.current-menu-item:hover > .ast-menu-toggle, .ast-below-header-menu .sub-menu .menu-item.current-menu-item:focus > .ast-menu-toggle, .ast-below-header-menu .sub-menu .menu-item.current-menu-item.focus > .ast-menu-toggle' => array(
				'background-color' => esc_attr( $below_header_menu_current_bg_color['mobile'] ),
			),
			// Subemnu > Hover.
			'.ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-menu .sub-menu .menu-item:hover > .menu-link, .ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-menu .sub-menu .menu-item:hover > .ast-menu-toggle' => array(
				'color' => esc_attr( $below_header_submenu_hover_color['mobile'] ),
			),

			'.ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-navigation .sub-menu .menu-item.current-menu-item > .menu-link,.ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-navigation .sub-menu .menu-item.current-menu-item:hover > .menu-link,.ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-menu .sub-menu .menu-item.current-menu-ancestor > .ast-menu-toggle,.ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-menu .sub-menu .menu-item.current-menu-item > .ast-menu-toggle,.ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-menu .sub-menu .menu-item.current-menu-ancestor:hover > .ast-menu-toggle,.ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-menu .sub-menu .menu-item.current-menu-ancestor:focus > .ast-menu-toggle,.ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-menu .sub-menu .menu-item.current-menu-ancestor.focus > .ast-menu-toggle,.ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-menu .sub-menu .menu-item.current-menu-item:hover > .ast-menu-toggle,.ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-menu .sub-menu .menu-item.current-menu-item:focus > .ast-menu-toggle,.ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-menu .sub-menu .menu-item.current-menu-item.focus > .ast-menu-toggle' => array(
				'color' => esc_attr( $below_header_submenu_active_color['mobile'] ),
			),
		);
		/* Parse CSS from array() */
		$css_output .= astra_parse_css( $desktop_colors );
		$css_output .= astra_parse_css( $tablet_colors, '', astra_addon_get_tablet_breakpoint() );
		$css_output .= astra_parse_css( $mobile_colors, '', astra_addon_get_mobile_breakpoint() );

		if ( $below_header_menu_spacing ) {
			$desktop_spacing = array(
				'.ast-no-toggle-below-menu-enable .ast-below-header-navigation .ast-below-header-menu > .menu-item-has-children > .ast-menu-toggle, .ast-no-toggle-below-menu-enable .ast-below-header-menu-items .ast-below-header-menu > .menu-item-has-children > .ast-menu-toggle,.ast-header-break-point.ast-no-toggle-below-menu-enable .ast-below-header-menu > .menu-item-has-children > .menu-link' => array(
					'padding-left'  => astra_responsive_spacing( $below_header_menu_spacing, 'left', 'desktop' ),
					'padding-right' => astra_responsive_spacing( $below_header_menu_spacing, 'right', 'desktop' ),
				),
			);
			$tablet_spacing  = array(
				'.ast-no-toggle-below-menu-enable .ast-below-header-navigation .ast-below-header-menu > .menu-item-has-children > .ast-menu-toggle, .ast-no-toggle-below-menu-enable .ast-below-header-menu-items .ast-below-header-menu > .menu-item-has-children > .ast-menu-toggle,.ast-header-break-point.ast-no-toggle-below-menu-enable .ast-below-header-menu > .menu-item-has-children > .menu-link' => array(
					'padding-left'  => astra_responsive_spacing( $below_header_menu_spacing, 'left', 'tablet' ),
					'padding-right' => astra_responsive_spacing( $below_header_menu_spacing, 'right', 'tablet' ),
				),
			);
			$mobile_spacing  = array(
				'.ast-no-toggle-below-menu-enable .ast-below-header-navigation .ast-below-header-menu > .menu-item-has-children > .ast-menu-toggle, .ast-no-toggle-below-menu-enable .ast-below-header-menu-items .ast-above-header-menu > .menu-item-has-children > .ast-menu-toggle,.ast-header-break-point.ast-no-toggle-below-menu-enable .ast-below-header-menu > .menu-item-has-children > .menu-link' => array(
					'padding-left'  => astra_responsive_spacing( $below_header_menu_spacing, 'left', 'mobile' ),
					'padding-right' => astra_responsive_spacing( $below_header_menu_spacing, 'right', 'mobile' ),
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
	if ( 'no-toggle' !== $below_menu_style ) {
		$astra_navigation = array(
			'.ast-below-header-navigation-wrap' => array(
				'display' => esc_attr( 'none' ),
			),
		);
		$css_output      .= astra_parse_css( $astra_navigation, '', $header_break_point );
	}

	return $dynamic_css . $css_output;
}
