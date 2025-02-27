<?php
/**
 * Mobile Header - Dynamic CSS
 *
 * @package Astra Addon
 */

/**
 * Mobile Header options.
 */
add_filter( 'astra_addon_dynamic_css', 'astra_addon_mobile_header_colors_background_dynamic_css' );

/**
 * Dynamic CSS
 *
 * @param  string $dynamic_css          Astra Dynamic CSS.
 * @param  string $dynamic_css_filtered Astra Dynamic CSS Filters.
 * @return string
 */
function astra_addon_mobile_header_colors_background_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' ) {

	$menu_style = astra_get_option( 'mobile-menu-style' );

	$theme_color = astra_get_option( 'theme-color' );
	$link_color  = astra_get_option( 'link-color', $theme_color );
	$text_color  = astra_get_option( 'text-color' );

	$primary_menu_bg_image = astra_get_option( 'primary-menu-bg-obj-responsive' );

	$primary_menu_color      = astra_get_option( 'primary-menu-color-responsive' );
	$primary_menu_h_bg_color = astra_get_option( 'primary-menu-h-bg-color-responsive' );
	$primary_menu_h_color    = astra_get_option( 'primary-menu-h-color-responsive' );
	$primary_menu_a_bg_color = astra_get_option( 'primary-menu-a-bg-color-responsive' );
	$primary_menu_a_color    = astra_get_option( 'primary-menu-a-color-responsive' );

	$primary_submenu_bg_color   = astra_get_option( 'primary-submenu-bg-color-responsive' );
	$primary_submenu_color      = astra_get_option( 'primary-submenu-color-responsive' );
	$primary_submenu_h_bg_color = astra_get_option( 'primary-submenu-h-bg-color-responsive' );
	$primary_submenu_h_color    = astra_get_option( 'primary-submenu-h-color-responsive' );
	$primary_submenu_a_bg_color = astra_get_option( 'primary-submenu-a-bg-color-responsive' );
	$primary_submenu_a_color    = astra_get_option( 'primary-submenu-a-color-responsive' );

	$header_bg_obj = astra_get_option( 'header-bg-obj-responsive' );

	$mobile_header_close_desktop_color = astra_get_prop( astra_get_option( 'primary-menu-color-responsive' ), 'desktop', $text_color );
	$mobile_header_close_tablet_color  = astra_get_prop( astra_get_option( 'primary-menu-color-responsive' ), 'tablet' );
	$mobile_header_close_mobile_color  = astra_get_prop( astra_get_option( 'primary-menu-color-responsive' ), 'mobile' );

	$css_output = '';

	/**
	 * Responsive Colors options
	 * [1]. Primary Menu Responsive Colors general
	 * [2]. Primary Menu Responsive Colors only for Full Screen menu style
	 * [3]. Primary Menu Responsive Colors only for Flyout menu style
	 */

	/**
	 * Responsive Colors options
	 * [1]. Primary Menu Responsive Colors general
	 */
	$desktop_colors = array(

		// Header Background Image.
		'.ast-header-break-point .main-header-bar' => astra_get_responsive_background_obj( $header_bg_obj, 'desktop' ),
		'.ast-header-break-point .main-header-menu, .ast-header-break-point .ast-header-custom-item, .ast-header-break-point .ast-header-sections-navigation' => astra_get_responsive_background_obj( $primary_menu_bg_image, 'desktop' ),
		'.ast-header-break-point .ast-primary-menu-disabled .ast-above-header-menu-items, .ast-header-break-point .ast-primary-menu-disabled .ast-below-header-menu-items' => astra_get_responsive_background_obj( $primary_menu_bg_image, 'desktop' ),
		'.ast-header-break-point .ast-primary-menu-disabled .ast-below-header-menu-items' => astra_get_responsive_background_obj( $primary_menu_bg_image, 'desktop' ),
		// Primary Header Menu color.
		'.ast-header-break-point .main-header-menu, .ast-header-break-point .main-header-menu .menu-link, .ast-header-break-point .main-header-menu .menu-item.focus > .ast-menu-toggle, .ast-header-break-point .main-header-menu .current-menu-item > .ast-menu-toggle, .ast-header-break-point .main-header-menu .current-menu-ancestor > .ast-menu-toggle, .ast-header-break-point .ast-header-custom-item, .ast-header-break-point .ast-header-custom-item a, .ast-header-break-point .ast-masthead-custom-menu-items, .ast-header-break-point .ast-masthead-custom-menu-items a, .ast-header-break-point .ast-masthead-custom-menu-items .ast-inline-search form .ast-header-break-point .ast-below-header-merged-responsive .below-header-user-select,.ast-header-break-point .ast-above-header-menu-items, .ast-header-break-point .ast-above-header-menu-items .menu-link, .ast-header-break-point .ast-below-header-menu-items, .ast-header-break-point .ast-below-header-menu-items .menu-link, .ast-header-break-point .ast-below-header-merged-responsive .below-header-user-select .widget, .ast-header-break-point .ast-below-header-merged-responsive .below-header-user-select .widget-title' => array(
			'color' => esc_attr( $primary_menu_color['desktop'] ),
		),
		'.ast-header-break-point .ast-masthead-custom-menu-items .ast-inline-search form' => array(
			'border-color' => esc_attr( $primary_menu_color['desktop'] ),
		),
		// Primary Menu Hover colors.
		'.ast-header-break-point .main-header-menu .menu-link:hover, .ast-header-break-point .ast-header-custom-item a:hover, .ast-header-break-point .main-header-menu .menu-item:hover > .menu-link, .ast-header-break-point .main-header-menu .menu-item.focus > .menu-link' => array(
			'color' => esc_attr( $primary_menu_h_color['desktop'] ),
		),
		'.ast-header-break-point .main-header-menu .ast-masthead-custom-menu-items a:hover, .ast-header-break-point .main-header-menu .menu-item:hover > .ast-menu-toggle, .ast-header-break-point .main-header-menu .menu-item.focus > .ast-menu-toggle' => array(
			'color' => esc_attr( $primary_menu_h_color['desktop'] ),
		),
		// Primary Menu Hover Bg color.
		'.ast-header-break-point .main-header-menu .menu-link:hover, .ast-header-break-point .ast-header-custom-item a:hover, .ast-header-break-point .main-header-menu .menu-item:hover > .menu-link, .ast-header-break-point .main-header-menu .menu-item.focus > .menu-link' => array(
			'background-color' => esc_attr( $primary_menu_h_bg_color['desktop'] ),
		),
		// Primary Menu Active color.
		'.ast-header-break-point .main-header-menu .menu-item.current-menu-item > .ast-menu-toggle, .ast-header-break-point .main-header-menu .menu-item.current-menu-ancestor > .ast-menu-toggle, .ast-header-break-point .main-header-menu .menu-item.current-menu-item > .menu-link, .ast-header-break-point .main-header-menu .menu-item.current-menu-ancestor > .menu-link' => array(
			'color' => esc_attr( $primary_menu_a_color['desktop'] ),
		),
		// Primary menu Active Bg color.
		'.ast-header-break-point .main-header-menu .menu-item.current-menu-item > .menu-link, .ast-header-break-point .main-header-menu .menu-item.current-menu-ancestor > .menu-link' => array(
			'background-color' => esc_attr( $primary_menu_a_bg_color['desktop'] ),
		),

		// Submenu link color.
		'.ast-header-break-point .main-header-menu .sub-menu, .ast-header-break-point .main-header-menu .sub-menu .menu-link, .ast-header-break-point .ast-header-sections-navigation .sub-menu .menu-link, .ast-header-break-point .ast-above-header-menu-items .sub-menu .menu-link, .ast-header-break-point .ast-below-header-menu-items .sub-menu .menu-link' => array(
			'color' => esc_attr( $primary_submenu_color['desktop'] ),
		),
		'.ast-header-break-point .main-header-menu .sub-menu .menu-link' => array(
			'color' => esc_attr( $primary_submenu_color['desktop'] ),
		),
		// Submenu Background color.
		'.ast-header-break-point .main-header-menu .sub-menu, .ast-header-break-point .ast-header-sections-navigation .sub-menu, .ast-header-break-point .ast-above-header-menu-items .sub-menu, .ast-header-break-point .ast-below-header-menu-items .sub-menu, .ast-flyout-menu-enable.ast-header-break-point .main-header-bar-navigation .main-header-menu .sub-menu' => array(
			'background-color' => esc_attr( $primary_submenu_bg_color['desktop'] ),
		),
		// Submenu hover color.
		'.ast-header-break-point .main-header-menu .sub-menu .menu-link:hover, .ast-header-break-point .main-header-menu .sub-menu .menu-link:focus' => array(
			'color' => esc_attr( $primary_submenu_h_color['desktop'] ),
		),
		// Submenu hover bg color.
		'.ast-header-break-point .main-header-menu .sub-menu .menu-link:hover, .ast-header-break-point .main-header-menu .sub-menu .menu-item:hover > .menu-link, .ast-header-break-point .main-header-menu .sub-menu .menu-item.focus > .menu-link' => array(
			'background-color' => esc_attr( $primary_submenu_h_bg_color['desktop'] ),
		),
		// Submenu active color.
		'.ast-header-break-point .main-header-menu .sub-menu .menu-item.current-menu-item > .menu-link, .ast-header-break-point .main-header-menu .sub-menu .menu-item.current-menu-ancestor > .menu-link, .ast-header-break-point .ast-header-sections-navigation .sub-menu .menu-item.current-menu-item > .menu-link, .ast-header-break-point .ast-above-header-menu-items .sub-menu .menu-item.current-menu-item > .menu-link, .ast-header-break-point .ast-below-header-menu-items .sub-menu .menu-item.current-menu-item > .menu-link' => array(
			'color' => esc_attr( $primary_submenu_a_color['desktop'] ),
		),
		// Submenu active bg color.
		'.ast-header-break-point .main-header-menu .sub-menu .menu-item.current-menu-item > .menu-link, .ast-header-break-point .main-header-menu .sub-menu .menu-item.current-menu-ancestor > .menu-link, .ast-header-break-point .ast-header-sections-navigation .sub-menu .menu-item.current-menu-item > .menu-link, .ast-header-break-point .ast-above-header-menu-items .sub-menu .menu-item.current-menu-item > .menu-link, .ast-header-break-point .ast-below-header-menu-items .sub-menu .menu-item.current-menu-item > .menu-link' => array(
			'background-color' => esc_attr( $primary_submenu_a_bg_color['desktop'] ),
		),

		// Primary Menu Bg color when Above & Below Header is merged and Primary menu is disabled.
		'.ast-header-break-point .ast-primary-menu-disabled .ast-merge-header-navigation-wrap .ast-above-header-menu-items, .ast-header-break-point .ast-primary-menu-disabled .ast-merge-header-navigation-wrap .ast-below-header-menu-items' => astra_get_responsive_background_obj( $primary_menu_bg_image, 'desktop' ),

	);
	$tablet_colors = array(
		// Header Background Image.
		'.ast-header-break-point .main-header-bar' => astra_get_responsive_background_obj( $header_bg_obj, 'tablet' ),

		'.ast-header-break-point .main-header-menu, .ast-header-break-point .ast-header-custom-item, .ast-header-break-point .ast-header-sections-navigation' => astra_get_responsive_background_obj( $primary_menu_bg_image, 'tablet' ),
		'.ast-header-break-point .ast-primary-menu-disabled .ast-above-header-menu-items, .ast-header-break-point .ast-primary-menu-disabled .ast-below-header-menu-items' => astra_get_responsive_background_obj( $primary_menu_bg_image, 'tablet' ),
		'.ast-header-break-point .ast-primary-menu-disabled .ast-below-header-menu-items' => astra_get_responsive_background_obj( $primary_menu_bg_image, 'tablet' ),
		// Primary Header Menu color.
		'.ast-header-break-point .main-header-menu, .ast-header-break-point .main-header-menu .menu-link, .ast-header-break-point .main-header-menu .menu-item.focus > .ast-menu-toggle, .ast-header-break-point .main-header-menu .current-menu-item > .ast-menu-toggle, .ast-header-break-point .main-header-menu .current-menu-ancestor > .ast-menu-toggle, .ast-header-break-point .ast-header-custom-item, .ast-header-break-point .ast-header-custom-item a, .ast-header-break-point .ast-masthead-custom-menu-items, .ast-header-break-point .ast-masthead-custom-menu-items a, .ast-header-break-point .ast-masthead-custom-menu-items .ast-inline-search form .ast-header-break-point .ast-below-header-merged-responsive .below-header-user-select,.ast-header-break-point .ast-above-header-menu-items, .ast-header-break-point .ast-above-header-menu-items .menu-link, .ast-header-break-point .ast-below-header-menu-items, .ast-header-break-point .ast-below-header-menu-items .menu-link, .ast-header-break-point .ast-below-header-merged-responsive .below-header-user-select .widget, .ast-header-break-point .ast-below-header-merged-responsive .below-header-user-select .widget-title' => array(
			'color' => esc_attr( $primary_menu_color['tablet'] ),
		),
		'.ast-header-break-point .ast-masthead-custom-menu-items .ast-inline-search form' => array(
			'border-color' => esc_attr( $primary_menu_color['tablet'] ),
		),
		// Primary Menu Hover colors.
		'.ast-header-break-point .main-header-menu .menu-link:hover, .ast-header-break-point .ast-header-custom-item a:hover, .ast-header-break-point .main-header-menu .menu-item:hover > .menu-link, .ast-header-break-point .main-header-menu .menu-item.focus > .menu-link' => array(
			'color' => esc_attr( $primary_menu_h_color['tablet'] ),
		),
		'.ast-header-break-point .main-header-menu .ast-masthead-custom-menu-items a:hover, .ast-header-break-point .main-header-menu .menu-item:hover > .ast-menu-toggle, .ast-header-break-point .main-header-menu .menu-item.focus > .ast-menu-toggle' => array(
			'color' => esc_attr( $primary_menu_h_color['tablet'] ),
		),
		// Primary Menu Hover Bg color.
		'.ast-header-break-point .main-header-menu .menu-link:hover, .ast-header-break-point .ast-header-custom-item a:hover, .ast-header-break-point .main-header-menu .menu-item:hover > .menu-link, .ast-header-break-point .main-header-menu .menu-item.focus > .menu-link' => array(
			'background-color' => esc_attr( $primary_menu_h_bg_color['tablet'] ),
		),
		// Primary Menu Active color.
		'.ast-header-break-point .main-header-menu .menu-item.current-menu-item > .ast-menu-toggle, .ast-header-break-point .main-header-menu .menu-item.current-menu-ancestor > .ast-menu-toggle, .ast-header-break-point .main-header-menu .menu-item.current-menu-item > .menu-link, .ast-header-break-point .main-header-menu .menu-item.current-menu-ancestor > .menu-link' => array(
			'color' => esc_attr( $primary_menu_a_color['tablet'] ),
		),
		// Primary menu Active Bg color.
		'.ast-header-break-point .main-header-menu .menu-item.current-menu-item > .menu-link, .ast-header-break-point .main-header-menu .menu-item.current-menu-ancestor > .menu-link' => array(
			'background-color' => esc_attr( $primary_menu_a_bg_color['tablet'] ),
		),

		// Submenu link color.
		'.ast-header-break-point .main-header-menu .sub-menu, .ast-header-break-point .main-header-menu .sub-menu .menu-link, .ast-header-break-point .ast-header-sections-navigation .sub-menu .menu-link, .ast-header-break-point .ast-above-header-menu-items .sub-menu .menu-link, .ast-header-break-point .ast-below-header-menu-items .sub-menu .menu-link' => array(
			'color' => esc_attr( $primary_submenu_color['tablet'] ),
		),
		'.ast-header-break-point .main-header-menu .sub-menu .menu-link' => array(
			'color' => esc_attr( $primary_submenu_color['tablet'] ),
		),
		// Submenu Background color.
		'.ast-header-break-point .main-header-menu .sub-menu, .ast-header-break-point .ast-header-sections-navigation .sub-menu, .ast-header-break-point .ast-above-header-menu-items .sub-menu, .ast-header-break-point .ast-below-header-menu-items .sub-menu, .ast-flyout-menu-enable.ast-header-break-point .main-header-bar-navigation .main-header-menu .sub-menu' => array(
			'background-color' => esc_attr( $primary_submenu_bg_color['tablet'] ),
		),
		// Submenu hover color.
		'.ast-header-break-point .main-header-menu .sub-menu .menu-link:hover, .ast-header-break-point .main-header-menu .sub-menu .menu-link:focus' => array(
			'color' => esc_attr( $primary_submenu_h_color['tablet'] ),
		),
		// Submenu hover bg color.
		'.ast-header-break-point .main-header-menu .sub-menu .menu-link:hover, .ast-header-break-point .main-header-menu .sub-menu .menu-item:hover > .menu-link, .ast-header-break-point .main-header-menu .sub-menu .menu-item.focus > .menu-link' => array(
			'background-color' => esc_attr( $primary_submenu_h_bg_color['tablet'] ),
		),
		// Submenu active color.
		'.ast-header-break-point .main-header-menu .sub-menu .menu-item.current-menu-item > .menu-link, .ast-header-break-point .main-header-menu .sub-menu .menu-item.current-menu-ancestor > .menu-link, .ast-header-break-point .ast-header-sections-navigation .sub-menu .menu-item.current-menu-item > .menu-link, .ast-header-break-point .ast-above-header-menu-items .sub-menu .menu-item.current-menu-item > .menu-link, .ast-header-break-point .ast-below-header-menu-items .sub-menu .menu-item.current-menu-item > .menu-link' => array(
			'color' => esc_attr( $primary_submenu_a_color['tablet'] ),
		),
		// Submenu active bg color.
		'.ast-header-break-point .main-header-menu .sub-menu .menu-item.current-menu-item > .menu-link, .ast-header-break-point .main-header-menu .sub-menu .menu-item.current-menu-ancestor > .menu-link, .ast-header-break-point .ast-header-sections-navigation .sub-menu .menu-item.current-menu-item > .menu-link, .ast-header-break-point .ast-above-header-menu-items .sub-menu .menu-item.current-menu-item > .menu-link, .ast-header-break-point .ast-below-header-menu-items .sub-menu .menu-item.current-menu-item > .menu-link' => array(
			'background-color' => esc_attr( $primary_submenu_a_bg_color['tablet'] ),
		),

		// Primary Menu Bg color when Above & Below Header is merged and Primary menu is disabled.
		'.ast-header-break-point .ast-primary-menu-disabled .ast-merge-header-navigation-wrap .ast-above-header-menu-items, .ast-header-break-point .ast-primary-menu-disabled .ast-merge-header-navigation-wrap .ast-below-header-menu-items' => astra_get_responsive_background_obj( $primary_menu_bg_image, 'tablet' ),
	);
	$mobile_colors = array(
		// Header Background Image.
		'.ast-header-break-point .main-header-bar' => astra_get_responsive_background_obj( $header_bg_obj, 'mobile' ),
		'.ast-header-break-point .main-header-menu, .ast-header-break-point .ast-header-custom-item, .ast-header-break-point .ast-header-sections-navigation' => astra_get_responsive_background_obj( $primary_menu_bg_image, 'mobile' ),
		'.ast-header-break-point .ast-primary-menu-disabled .ast-above-header-menu-items, .ast-header-break-point .ast-primary-menu-disabled .ast-below-header-menu-items' => astra_get_responsive_background_obj( $primary_menu_bg_image, 'mobile' ),
		'.ast-header-break-point .ast-primary-menu-disabled .ast-below-header-menu-items' => astra_get_responsive_background_obj( $primary_menu_bg_image, 'mobile' ),
		// Primary Header Menu color.
		'.ast-header-break-point .main-header-menu, .ast-header-break-point .main-header-menu .menu-link, .ast-header-break-point .main-header-menu .menu-item.focus > .ast-menu-toggle, .ast-header-break-point .main-header-menu .current-menu-item > .ast-menu-toggle, .ast-header-break-point .main-header-menu .current-menu-ancestor > .ast-menu-toggle, .ast-header-break-point .ast-header-custom-item, .ast-header-break-point .ast-header-custom-item a, .ast-header-break-point .ast-masthead-custom-menu-items, .ast-header-break-point .ast-masthead-custom-menu-items a, .ast-header-break-point .ast-masthead-custom-menu-items .ast-inline-search form .ast-header-break-point .ast-below-header-merged-responsive .below-header-user-select,.ast-header-break-point .ast-above-header-menu-items, .ast-header-break-point .ast-above-header-menu-items .menu-link, .ast-header-break-point .ast-below-header-menu-items, .ast-header-break-point .ast-below-header-menu-items .menu-link, .ast-header-break-point .ast-below-header-merged-responsive .below-header-user-select .widget, .ast-header-break-point .ast-below-header-merged-responsive .below-header-user-select .widget-title' => array(
			'color' => esc_attr( $primary_menu_color['mobile'] ),
		),
		'.ast-header-break-point .ast-masthead-custom-menu-items .ast-inline-search form' => array(
			'border-color' => esc_attr( $primary_menu_color['mobile'] ),
		),
		// Primary Menu Hover colors.
		'.ast-header-break-point .main-header-menu .menu-link:hover, .ast-header-break-point .ast-header-custom-item a:hover, .ast-header-break-point .main-header-menu .menu-item:hover > .menu-link, .ast-header-break-point .main-header-menu .menu-item.focus > .menu-link' => array(
			'color' => esc_attr( $primary_menu_h_color['mobile'] ),
		),
		'.ast-header-break-point .main-header-menu .ast-masthead-custom-menu-items a:hover, .ast-header-break-point .main-header-menu .menu-item:hover > .ast-menu-toggle, .ast-header-break-point .main-header-menu .menu-item.focus > .ast-menu-toggle' => array(
			'color' => esc_attr( $primary_menu_h_color['mobile'] ),
		),
		// Primary Menu Hover Bg color.
		'.ast-header-break-point .main-header-menu .menu-link:hover, .ast-header-break-point .ast-header-custom-item a:hover, .ast-header-break-point .main-header-menu .menu-item:hover > .menu-link, .ast-header-break-point .main-header-menu .menu-item.focus > .menu-link' => array(
			'background-color' => esc_attr( $primary_menu_h_bg_color['mobile'] ),
		),
		// Primary Menu Active color.
		'.ast-header-break-point .main-header-menu .menu-item.current-menu-item > .ast-menu-toggle, .ast-header-break-point .main-header-menu .menu-item.current-menu-ancestor > .ast-menu-toggle, .ast-header-break-point .main-header-menu .menu-item.current-menu-item > .menu-link, .ast-header-break-point .main-header-menu .menu-item.current-menu-ancestor > .menu-link' => array(
			'color' => esc_attr( $primary_menu_a_color['mobile'] ),
		),
		// Primary menu Active Bg color.
		'.ast-header-break-point .main-header-menu .menu-item.current-menu-item > .menu-link, .ast-header-break-point .main-header-menu .menu-item.current-menu-ancestor > .menu-link' => array(
			'background-color' => esc_attr( $primary_menu_a_bg_color['mobile'] ),
		),

		// Submenu link color.
		'.ast-header-break-point .main-header-menu .sub-menu, .ast-header-break-point .main-header-menu .sub-menu .menu-link, .ast-header-break-point .ast-header-sections-navigation .sub-menu .menu-link, .ast-header-break-point .ast-above-header-menu-items .sub-menu .menu-link, .ast-header-break-point .ast-below-header-menu-items .sub-menu .menu-link' => array(
			'color' => esc_attr( $primary_submenu_color['mobile'] ),
		),
		'.ast-header-break-point .main-header-menu .sub-menu .menu-link' => array(
			'color' => esc_attr( $primary_submenu_color['mobile'] ),
		),
		// Submenu Background color.
		'.ast-header-break-point .main-header-menu .sub-menu, .ast-header-break-point .ast-header-sections-navigation .sub-menu, .ast-header-break-point .ast-above-header-menu-items .sub-menu, .ast-header-break-point .ast-below-header-menu-items .sub-menu, .ast-flyout-menu-enable.ast-header-break-point .main-header-bar-navigation .main-header-menu .sub-menu' => array(
			'background-color' => esc_attr( $primary_submenu_bg_color['mobile'] ),
		),
		// Submenu hover color.
		'.ast-header-break-point .main-header-menu .sub-menu .menu-link:hover, .ast-header-break-point .main-header-menu .sub-menu .menu-link:focus' => array(
			'color' => esc_attr( $primary_submenu_h_color['mobile'] ),
		),
		// Submenu hover bg color.
		'.ast-header-break-point .main-header-menu .sub-menu .menu-link:hover, .ast-header-break-point .main-header-menu .sub-menu .menu-item:hover > .menu-link, .ast-header-break-point .main-header-menu .sub-menu .menu-item.focus > .menu-link' => array(
			'background-color' => esc_attr( $primary_submenu_h_bg_color['mobile'] ),
		),
		// Submenu active color.
		'.ast-header-break-point .main-header-menu .sub-menu .menu-item.current-menu-item > .menu-link, .ast-header-break-point .main-header-menu .sub-menu .menu-item.current-menu-ancestor > .menu-link, .ast-header-break-point .ast-header-sections-navigation .sub-menu .menu-item.current-menu-item > .menu-link, .ast-header-break-point .ast-above-header-menu-items .sub-menu .menu-item.current-menu-item > .menu-link, .ast-header-break-point .ast-below-header-menu-items .sub-menu .menu-item.current-menu-item > .menu-link' => array(
			'color' => esc_attr( $primary_submenu_a_color['mobile'] ),
		),
		// Submenu active bg color.
		'.ast-header-break-point .main-header-menu .sub-menu .menu-item.current-menu-item > .menu-link, .ast-header-break-point .main-header-menu .sub-menu .menu-item.current-menu-ancestor > .menu-link, .ast-header-break-point .ast-header-sections-navigation .sub-menu .menu-item.current-menu-item > .menu-link, .ast-header-break-point .ast-above-header-menu-items .sub-menu .menu-item.current-menu-item > .menu-link, .ast-header-break-point .ast-below-header-menu-items .sub-menu .menu-item.current-menu-item > .menu-link' => array(
			'background-color' => esc_attr( $primary_submenu_a_bg_color['mobile'] ),
		),

		// Primary Menu Bg color when Above & Below Header is merged and Primary menu is disabled.
		'.ast-header-break-point .ast-primary-menu-disabled .ast-merge-header-navigation-wrap .ast-above-header-menu-items, .ast-header-break-point .ast-primary-menu-disabled .ast-merge-header-navigation-wrap .ast-below-header-menu-items' => astra_get_responsive_background_obj( $primary_menu_bg_image, 'mobile' ),
	);
	/* Parse CSS from array() */
	$css_output .= astra_parse_css( $desktop_colors );
	$css_output .= astra_parse_css( $tablet_colors, '', astra_addon_get_tablet_breakpoint() );
	$css_output .= astra_parse_css( $mobile_colors, '', astra_addon_get_mobile_breakpoint() );

	/**
	 * Responsive Colors options
	 * [2]. Primary Menu Responsive Colors only for Full Screen menu style
	 */
	if ( 'fullscreen' === $menu_style ) {
			$desktop_colors = array(
				'.ast-fullscreen-menu-overlay .main-header-menu .menu-item.current-menu-item > .menu-link, .ast-fullscreen-menu-overlay .main-header-menu .menu-item.current-menu-ancestor > .menu-link' => array(
					'background-color' => 'transparent',
				),
				'.ast-fullscreen-menu-overlay .main-header-menu .menu-item.current-menu-item:hover, .ast-fullscreen-menu-overlay .main-header-menu .menu-item.current-menu-item, .ast-fullscreen-menu-overlay .main-header-menu .menu-item.current-menu-ancestor' => array(
					'background-color' => esc_attr( $primary_menu_a_bg_color['desktop'] ),
				),
				'.ast-fullscreen-menu-overlay .main-header-menu .menu-item:hover, .ast-fullscreen-menu-overlay .ast-header-custom-item li:hover, .ast-fullscreen-menu-overlay .main-header-menu .menu-item:hover, .ast-fullscreen-menu-overlay .main-header-menu .menu-item.focus, .ast-fullscreen-menu-overlay .ast-header-break-point .ast-header-sections-navigation li:hover, .ast-fullscreen-menu-overlay .ast-header-break-point .ast-header-sections-navigation li:focus' => array(
					'background-color' => esc_attr( $primary_menu_h_bg_color['desktop'] ),
				),
				'.ast-fullscreen-menu-overlay .main-header-menu .menu-link:hover,.ast-fullscreen-menu-overlay .ast-header-custom-item a:hover,.ast-fullscreen-menu-overlay .main-header-menu .menu-item:hover > .menu-link,.ast-fullscreen-menu-overlay .main-header-menu .menu-item.focus > .menu-link,.ast-fullscreen-menu-overlay .ast-header-break-point .ast-header-sections-navigation a:hover,.ast-fullscreen-menu-overlay .ast-header-break-point .ast-header-sections-navigation a:focus' => array(
					'background-color' => 'transparent',
					'color'            => esc_attr( $primary_menu_h_color['desktop'] ),
				),
				'.ast-fullscreen-menu-overlay .main-header-menu .sub-menu .menu-link:hover, .ast-fullscreen-menu-overlay .main-header-menu .sub-menu .menu-item:hover > .menu-link, .ast-fullscreen-menu-overlay .main-header-menu .sub-menu .menu-item.focus > .menu-link, .ast-fullscreen-menu-overlay .ast-header-sections-navigation .sub-menu .menu-link:hover, .ast-fullscreen-menu-overlay .ast-above-header-menu-items .sub-menu .menu-link:hover, .ast-fullscreen-menu-overlay .ast-below-header-menu-items .sub-menu .menu-link:hover' => array(
					'background-color' => 'transparent',
				),
				'.ast-fullscreen-menu-overlay .main-header-menu .sub-menu .menu-link:hover, .ast-fullscreen-menu-overlay .main-header-menu .sub-menu .menu-item:hover > .menu-link, .ast-fullscreen-menu-overlay .main-header-menu .sub-menu .menu-item.focus > .menu-link, .ast-fullscreen-menu-overlay .ast-header-sections-navigation .sub-menu .menu-link:hover, .ast-fullscreen-menu-overlay .ast-above-header-menu-items .sub-menu .menu-link:hover, .ast-fullscreen-menu-overlay .ast-below-header-menu-items .sub-menu .menu-link:hover' => array(
					'background-color' => 'transparent',
					'color'            => esc_attr( $primary_submenu_h_color['desktop'] ),
				),
				'.ast-fullscreen-menu-overlay .main-header-menu .sub-menu .menu-item:hover, .ast-fullscreen-menu-overlay .main-header-menu .sub-menu .menu-item.focus, .ast-fullscreen-menu-overlay .ast-header-sections-navigation .sub-menu .menu-item:hover, .ast-fullscreen-menu-overlay .ast-header-sections-navigation .sub-menu .menu-item.focus, .ast-fullscreen-menu-overlay .ast-above-header-menu-items .sub-menu .menu-item:hover, .ast-fullscreen-menu-overlay .ast-below-header-menu-items .sub-menu .menu-item.focus' => array(
					'background-color' => esc_attr( $primary_submenu_h_bg_color['desktop'] ),
				),

				'.ast-fullscreen-menu-overlay .main-header-menu .sub-menu .menu-item.current-menu-item > .menu-link, .ast-fullscreen-menu-overlay .main-header-menu .sub-menu .menu-item.current-menu-ancestor > .menu-link, .ast-fullscreen-menu-overlay .ast-header-sections-navigation .sub-menu .menu-item.current-menu-item > .menu-link, .ast-fullscreen-menu-overlay .ast-above-header-menu-items .sub-menu .menu-item.current-menu-item > .menu-link, .ast-fullscreen-menu-overlay .ast-below-header-menu-items .sub-menu .menu-item.current-menu-item > .menu-link' => array(
					'background-color' => 'transparent',
					'color'            => esc_attr( $primary_submenu_a_color['desktop'] ),
				),
				'.ast-fullscreen-menu-overlay .main-header-menu .sub-menu .menu-item.current-menu-item, .ast-fullscreen-menu-overlay .main-header-menu .sub-menu .menu-item.current-menu-ancestor, .ast-fullscreen-menu-overlay .ast-header-sections-navigation .sub-menu .menu-item.current-menu-item, .ast-fullscreen-menu-overlay .ast-above-header-menu-items .sub-menu .menu-item.current-menu-item, .ast-fullscreen-menu-overlay .ast-below-header-menu-items .sub-menu .menu-item.current-menu-item' => array(
					'background-color' => esc_attr( $primary_submenu_a_bg_color['desktop'] ),
				),
				// Primary Menu Hover Bg color.
				'.ast-fullscreen-menu-overlay .ast-header-break-point .main-header-menu .menu-link:hover, .ast-fullscreen-menu-overlay .ast-header-break-point .ast-header-custom-item a:hover, .ast-fullscreen-menu-overlay .ast-header-break-point .main-header-menu .menu-item:hover > .menu-link, .ast-fullscreen-menu-overlay .ast-header-break-point .main-header-menu .menu-item.focus > .menu-link' => array(
					'background-color' => 'transparent',
				),
				'.ast-fullscreen-menu-overlay .ast-header-break-point .main-header-menu .menu-item:hover, .ast-fullscreen-menu-overlay .ast-header-break-point .ast-header-custom-item a:hover, .ast-fullscreen-menu-overlay .ast-header-break-point .main-header-menu .menu-item:hover, .ast-fullscreen-menu-overlay .ast-header-break-point .main-header-menu .menu-item.focus' => array(
					'background-color' => esc_attr( $primary_menu_h_bg_color['desktop'] ),
				),
				// Primary menu Active Bg color.
				'.ast-fullscreen-menu-overlay .ast-header-break-point .main-header-menu .menu-item.current-menu-item > .menu-link, .ast-fullscreen-menu-overlay .ast-header-break-point .main-header-menu .menu-item.current-menu-ancestor > .menu-link' => array(
					'background-color' => 'transparent',
				),
				// Submenu Background color.
				'.ast-fullscreen-menu-overlay .ast-header-break-point .main-header-menu .menu-link, .ast-fullscreen-menu-overlay .ast-header-break-point .ast-header-custom-item a, .ast-fullscreen-menu-overlay .ast-header-break-point .main-header-menu .menu-item > .menu-link, .ast-fullscreen-menu-overlay .ast-header-break-point .main-header-menu .menu-item.focus > .menu-link' => array(
					'background-color' => 'transparent',
				),
				// Submenu hover bg color.
				'.ast-fullscreen-menu-overlay .ast-header-break-point .main-header-menu .sub-menu li:hover' => array(
					'background-color' => esc_attr( $primary_submenu_h_bg_color['desktop'] ),
				),
				'.ast-fullscreen-menu-overlay .ast-header-break-point .main-header-menu .sub-menu .menu-link:hover, .ast-fullscreen-menu-overlay .ast-header-break-point .main-header-menu .sub-menu .menu-link:focus' => array(
					'background-color' => 'transparent',
				),
				// Submenu active bg color.
				'.ast-fullscreen-menu-overlay .ast-header-break-point .main-header-menu .sub-menu .menu-item.current-menu-item > .menu-link, .ast-fullscreen-menu-overlay .ast-header-break-point .main-header-menu .sub-menu .menu-item.current-menu-ancestor > .menu-link, .ast-fullscreen-menu-overlay .ast-header-break-point .ast-header-sections-navigation .sub-menu .menu-item.current-menu-item > .menu-link, .ast-fullscreen-menu-overlay .ast-header-break-point .ast-above-header-menu-items .sub-menu .menu-item.current-menu-item > .menu-link, .ast-fullscreen-menu-overlay .ast-header-break-point .ast-below-header-menu-items .sub-menu .menu-item.current-menu-item > .menu-link' => array(
					'background-color' => 'transparent',
				),
				'.ast-fullscreen-menu-overlay .ast-header-break-point .main-header-menu .sub-menu .menu-item.current-menu-item, .ast-fullscreen-menu-overlay .ast-header-break-point .main-header-menu .sub-menu .menu-item.current-menu-ancestor, .ast-fullscreen-menu-overlay .ast-header-break-point .ast-header-sections-navigation .sub-menu .menu-item.current-menu-item, .ast-fullscreen-menu-overlay .ast-header-break-point .ast-above-header-menu-items .sub-menu .menu-item.current-menu-item, .ast-fullscreen-menu-overlay .ast-header-break-point .ast-below-header-menu-items .sub-menu .menu-item.current-menu-item' => array(
					'background-color' => esc_attr( $primary_submenu_a_bg_color['desktop'] ),
				),
				'.ast-fullscreen-menu-enable.ast-header-break-point .main-header-bar-navigation .close' => array(
					'color' => esc_attr( $mobile_header_close_desktop_color ),
				),
			);
			// Fullscreen background color if Header Background color is set.
			$desktop_colors['.ast-fullscreen-menu-enable.ast-header-break-point .main-header-bar-navigation .site-navigation,.ast-fullscreen-menu-enable.ast-header-break-point.admin-bar.ast-admin-bar-visible .ast-primary-menu-disabled .ast-header-custom-item .ast-merge-header-navigation-wrap'] = astra_get_responsive_background_obj( $header_bg_obj, 'desktop' );
			// Fullscreen background color if Primary Menu Background color is set.
			if ( '' !== $primary_menu_bg_image['desktop']['background-image'] || '' !== $primary_menu_bg_image['desktop']['background-color'] ) {
				$desktop_colors['.ast-fullscreen-menu-enable.ast-header-break-point .main-header-bar-navigation .site-navigation,.ast-fullscreen-menu-enable.ast-header-break-point.admin-bar.ast-admin-bar-visible .ast-primary-menu-disabled .ast-header-custom-item .ast-merge-header-navigation-wrap'] = astra_get_responsive_background_obj( $primary_menu_bg_image, 'desktop' );
			}

			$tablet_colors = array(
				'.ast-fullscreen-menu-overlay .main-header-menu .menu-item.current-menu-item > .menu-link, .ast-fullscreen-menu-overlay .main-header-menu .menu-item.current-menu-ancestor > .menu-link' => array(
					'background-color' => 'transparent',
				),
				'.ast-fullscreen-menu-overlay .main-header-menu .menu-item.current-menu-item:hover, .ast-fullscreen-menu-overlay .main-header-menu .menu-item.current-menu-item' => array(
					'background-color' => esc_attr( $primary_menu_a_bg_color['tablet'] ),
				),
				'.ast-fullscreen-menu-overlay .main-header-menu .menu-item:hover, .ast-fullscreen-menu-overlay .ast-header-custom-item li:hover, .ast-fullscreen-menu-overlay .main-header-menu .menu-item:hover, .ast-fullscreen-menu-overlay .main-header-menu .menu-item.focus, .ast-fullscreen-menu-overlay .ast-header-break-point .ast-header-sections-navigation li:hover, .ast-fullscreen-menu-overlay .ast-header-break-point .ast-header-sections-navigation li:focus' => array(
					'background-color' => esc_attr( $primary_menu_h_bg_color['tablet'] ),
				),
				'.ast-fullscreen-menu-overlay .main-header-menu .menu-link:hover,.ast-fullscreen-menu-overlay .ast-header-custom-item a:hover,.ast-fullscreen-menu-overlay .main-header-menu .menu-item:hover > .menu-link,.ast-fullscreen-menu-overlay .main-header-menu .menu-item.focus > .menu-link,.ast-fullscreen-menu-overlay .ast-header-break-point .ast-header-sections-navigation a:hover,.ast-fullscreen-menu-overlay .ast-header-break-point .ast-header-sections-navigation a:focus' => array(
					'background-color' => 'transparent',
					'color'            => esc_attr( $primary_menu_h_color['tablet'] ),
				),
				'.ast-fullscreen-menu-overlay .main-header-menu .sub-menu .menu-link:hover, .ast-fullscreen-menu-overlay .main-header-menu .sub-menu .menu-item:hover > .menu-link, .ast-fullscreen-menu-overlay .main-header-menu .sub-menu .menu-item.focus > .menu-link, .ast-fullscreen-menu-overlay .ast-header-sections-navigation .sub-menu .menu-link:hover, .ast-fullscreen-menu-overlay .ast-above-header-menu-items .sub-menu .menu-link:hover, .ast-fullscreen-menu-overlay .ast-below-header-menu-items .sub-menu .menu-link:hover' => array(
					'background-color' => 'transparent',
				),
				'.ast-fullscreen-menu-overlay .main-header-menu .sub-menu .menu-link:hover, .ast-fullscreen-menu-overlay .main-header-menu .sub-menu .menu-item:hover > .menu-link, .ast-fullscreen-menu-overlay .main-header-menu .sub-menu .menu-item.focus > .menu-link, .ast-fullscreen-menu-overlay .ast-header-sections-navigation .sub-menu .menu-link:hover, .ast-fullscreen-menu-overlay .ast-above-header-menu-items .sub-menu .menu-link:hover, .ast-fullscreen-menu-overlay .ast-below-header-menu-items .sub-menu .menu-link:hover' => array(
					'background-color' => 'transparent',
					'color'            => esc_attr( $primary_submenu_h_color['tablet'] ),
				),
				'.ast-fullscreen-menu-overlay .main-header-menu .sub-menu .menu-item:hover, .ast-fullscreen-menu-overlay .main-header-menu .sub-menu .menu-item.focus, .ast-fullscreen-menu-overlay .ast-header-sections-navigation .sub-menu .menu-item:hover, .ast-fullscreen-menu-overlay .ast-header-sections-navigation .sub-menu .menu-item.focus, .ast-fullscreen-menu-overlay .ast-above-header-menu-items .sub-menu .menu-item:hover, .ast-fullscreen-menu-overlay .ast-below-header-menu-items .sub-menu .menu-item.focus' => array(
					'background-color' => esc_attr( $primary_submenu_h_bg_color['tablet'] ),
				),

				'.ast-fullscreen-menu-overlay .main-header-menu .sub-menu .menu-item.current-menu-item > .menu-link, .ast-fullscreen-menu-overlay .main-header-menu .sub-menu .menu-item.current-menu-ancestor > .menu-link, .ast-fullscreen-menu-overlay .ast-header-sections-navigation .sub-menu .menu-item.current-menu-item > .menu-link, .ast-fullscreen-menu-overlay .ast-above-header-menu-items .sub-menu .menu-item.current-menu-item > .menu-link, .ast-fullscreen-menu-overlay .ast-below-header-menu-items .sub-menu .menu-item.current-menu-item > .menu-link' => array(
					'background-color' => 'transparent',
					'color'            => esc_attr( $primary_submenu_a_color['tablet'] ),
				),
				'.ast-fullscreen-menu-overlay .main-header-menu .sub-menu .menu-item.current-menu-item, .ast-fullscreen-menu-overlay .main-header-menu .sub-menu .menu-item.current-menu-ancestor, .ast-fullscreen-menu-overlay .ast-header-sections-navigation .sub-menu .menu-item.current-menu-item, .ast-fullscreen-menu-overlay .ast-above-header-menu-items .sub-menu .menu-item.current-menu-item, .ast-fullscreen-menu-overlay .ast-below-header-menu-items .sub-menu .menu-item.current-menu-item' => array(
					'background-color' => esc_attr( $primary_submenu_a_bg_color['tablet'] ),
				),
				// Primary Menu Hover Bg color.
				'.ast-fullscreen-menu-overlay .ast-header-break-point .main-header-menu .menu-link:hover, .ast-fullscreen-menu-overlay .ast-header-break-point .ast-header-custom-item a:hover, .ast-fullscreen-menu-overlay .ast-header-break-point .main-header-menu .menu-item:hover > .menu-link, .ast-fullscreen-menu-overlay .ast-header-break-point .main-header-menu .menu-item.focus > .menu-link' => array(
					'background-color' => 'transparent',
				),
				'.ast-fullscreen-menu-overlay .ast-header-break-point .main-header-menu .menu-item:hover, .ast-fullscreen-menu-overlay .ast-header-break-point .ast-header-custom-item a:hover, .ast-fullscreen-menu-overlay .ast-header-break-point .main-header-menu .menu-item:hover, .ast-fullscreen-menu-overlay .ast-header-break-point .main-header-menu .menu-item.focus' => array(
					'background-color' => esc_attr( $primary_menu_h_bg_color['tablet'] ),
				),
				// Primary menu Active Bg color.
				'.ast-fullscreen-menu-overlay .ast-header-break-point .main-header-menu .menu-item.current-menu-item > .menu-link, .ast-fullscreen-menu-overlay .ast-header-break-point .main-header-menu .menu-item.current-menu-ancestor > .menu-link' => array(
					'background-color' => 'transparent',
				),
				// Submenu Background color.
				'.ast-fullscreen-menu-overlay .ast-header-break-point .main-header-menu .menu-link, .ast-fullscreen-menu-overlay .ast-header-break-point .ast-header-custom-item a, .ast-fullscreen-menu-overlay .ast-header-break-point .main-header-menu .menu-item > .menu-link, .ast-fullscreen-menu-overlay .ast-header-break-point .main-header-menu .menu-item.focus > .menu-link' => array(
					'background-color' => 'transparent',
				),
				// Submenu hover bg color.
				'.ast-fullscreen-menu-overlay .ast-header-break-point .main-header-menu .sub-menu .menu-item:hover' => array(
					'background-color' => esc_attr( $primary_submenu_h_bg_color['tablet'] ),
				),
				'.ast-fullscreen-menu-overlay .ast-header-break-point .main-header-menu .sub-menu .menu-link:hover, .ast-fullscreen-menu-overlay .ast-header-break-point .main-header-menu .sub-menu .menu-link:focus' => array(
					'background-color' => 'transparent',
				),
				// Submenu active bg color.
				'.ast-fullscreen-menu-overlay .ast-header-break-point .main-header-menu .sub-menu .menu-item.current-menu-item > .menu-link, .ast-fullscreen-menu-overlay .ast-header-break-point .main-header-menu .sub-menu .menu-item.current-menu-ancestor > .menu-link, .ast-fullscreen-menu-overlay .ast-header-break-point .ast-header-sections-navigation .sub-menu .menu-item.current-menu-item > .menu-link, .ast-fullscreen-menu-overlay .ast-header-break-point .ast-above-header-menu-items .sub-menu .menu-item.current-menu-item > .menu-link, .ast-fullscreen-menu-overlay .ast-header-break-point .ast-below-header-menu-items .sub-menu .menu-item.current-menu-item > .menu-link' => array(
					'background-color' => 'transparent',
				),
				'.ast-fullscreen-menu-overlay .ast-header-break-point .main-header-menu .sub-menu .menu-item.current-menu-item, .ast-fullscreen-menu-overlay .ast-header-break-point .main-header-menu .sub-menu .menu-item.current-menu-ancestor, .ast-fullscreen-menu-overlay .ast-header-break-point .ast-header-sections-navigation .sub-menu .menu-item.current-menu-item, .ast-fullscreen-menu-overlay .ast-header-break-point .ast-above-header-menu-items .sub-menu .menu-item.current-menu-item, .ast-fullscreen-menu-overlay .ast-header-break-point .ast-below-header-menu-items .sub-menu .menu-item.current-menu-item' => array(
					'background-color' => esc_attr( $primary_submenu_a_bg_color['tablet'] ),
				),
				'.ast-fullscreen-menu-enable.ast-header-break-point .main-header-bar-navigation .close' => array(
					'color' => esc_attr( $mobile_header_close_tablet_color ),
				),
			);

			// Fullscreen background color if Header Background color is set.
			$tablet_colors['.ast-fullscreen-menu-enable.ast-header-break-point .main-header-bar-navigation .site-navigation,.ast-fullscreen-menu-enable.ast-header-break-point.admin-bar.ast-admin-bar-visible .ast-primary-menu-disabled .ast-header-custom-item .ast-merge-header-navigation-wrap'] = astra_get_responsive_background_obj( $header_bg_obj, 'tablet' );
			// Fullscreen background color if Primary Menu Background color is set.
			if ( '' !== $primary_menu_bg_image['tablet']['background-image'] || '' !== $primary_menu_bg_image['tablet']['background-color'] ) {
				$tablet_colors['.ast-fullscreen-menu-enable.ast-header-break-point .main-header-bar-navigation .site-navigation,.ast-fullscreen-menu-enable.ast-header-break-point.admin-bar.ast-admin-bar-visible .ast-primary-menu-disabled .ast-header-custom-item .ast-merge-header-navigation-wrap'] = astra_get_responsive_background_obj( $primary_menu_bg_image, 'tablet' );
			}

			$mobile_colors = array(
				'.ast-fullscreen-menu-overlay .main-header-menu .menu-item.current-menu-item > .menu-link, .ast-fullscreen-menu-overlay .main-header-menu .menu-item.current-menu-ancestor > .menu-link' => array(
					'background-color' => 'transparent',
				),
				'.ast-fullscreen-menu-overlay .main-header-menu .menu-item.current-menu-item:hover, .ast-fullscreen-menu-overlay .main-header-menu .menu-item.current-menu-item' => array(
					'background-color' => esc_attr( $primary_menu_a_bg_color['mobile'] ),
				),
				'.ast-fullscreen-menu-overlay .main-header-menu .menu-item:hover, .ast-fullscreen-menu-overlay .ast-header-custom-item li:hover, .ast-fullscreen-menu-overlay .main-header-menu .menu-item:hover, .ast-fullscreen-menu-overlay .main-header-menu .menu-item.focus, .ast-fullscreen-menu-overlay .ast-header-break-point .ast-header-sections-navigation li:hover, .ast-fullscreen-menu-overlay .ast-header-break-point .ast-header-sections-navigation li:focus' => array(
					'background-color' => esc_attr( $primary_menu_h_bg_color['mobile'] ),
				),
				'.ast-fullscreen-menu-overlay .main-header-menu .menu-link:hover,.ast-fullscreen-menu-overlay .ast-header-custom-item a:hover,.ast-fullscreen-menu-overlay .main-header-menu .menu-item:hover > .menu-link,.ast-fullscreen-menu-overlay .main-header-menu .menu-item.focus > .menu-link,.ast-fullscreen-menu-overlay .ast-header-break-point .ast-header-sections-navigation a:hover,.ast-fullscreen-menu-overlay .ast-header-break-point .ast-header-sections-navigation a:focus' => array(
					'background-color' => 'transparent',
					'color'            => esc_attr( $primary_menu_h_color['mobile'] ),
				),
				'.ast-fullscreen-menu-overlay .main-header-menu .sub-menu .menu-link:hover, .ast-fullscreen-menu-overlay .main-header-menu .sub-menu .menu-item:hover > .menu-link, .ast-fullscreen-menu-overlay .main-header-menu .sub-menu .menu-item.focus > .menu-link, .ast-fullscreen-menu-overlay .ast-header-sections-navigation .sub-menu .menu-link:hover, .ast-fullscreen-menu-overlay .ast-above-header-menu-items .sub-menu .menu-link:hover, .ast-fullscreen-menu-overlay .ast-below-header-menu-items .sub-menu .menu-link:hover' => array(
					'background-color' => 'transparent',
				),
				'.ast-fullscreen-menu-overlay .main-header-menu .sub-menu .menu-link:hover, .ast-fullscreen-menu-overlay .main-header-menu .sub-menu .menu-item:hover > .menu-link, .ast-fullscreen-menu-overlay .main-header-menu .sub-menu .menu-item.focus > .menu-link, .ast-fullscreen-menu-overlay .ast-header-sections-navigation .sub-menu .menu-link:hover, .ast-fullscreen-menu-overlay .ast-above-header-menu-items .sub-menu .menu-link:hover, .ast-fullscreen-menu-overlay .ast-below-header-menu-items .sub-menu .menu-link:hover' => array(
					'background-color' => 'transparent',
					'color'            => esc_attr( $primary_submenu_h_color['mobile'] ),
				),
				'.ast-fullscreen-menu-overlay .main-header-menu .sub-menu .menu-item:hover, .ast-fullscreen-menu-overlay .main-header-menu .sub-menu .menu-item.focus, .ast-fullscreen-menu-overlay .ast-header-sections-navigation .sub-menu .menu-item:hover, .ast-fullscreen-menu-overlay .ast-header-sections-navigation .sub-menu .menu-item.focus, .ast-fullscreen-menu-overlay .ast-above-header-menu-items .sub-menu .menu-item:hover, .ast-fullscreen-menu-overlay .ast-below-header-menu-items .sub-menu .menu-item.focus' => array(
					'background-color' => esc_attr( $primary_submenu_h_bg_color['mobile'] ),
				),

				'.ast-fullscreen-menu-overlay .main-header-menu .sub-menu .menu-item.current-menu-item > .menu-link, .ast-fullscreen-menu-overlay .main-header-menu .sub-menu .menu-item.current-menu-ancestor > .menu-link, .ast-fullscreen-menu-overlay .ast-header-sections-navigation .sub-menu .menu-item.current-menu-item > .menu-link, .ast-fullscreen-menu-overlay .ast-above-header-menu-items .sub-menu .menu-item.current-menu-item > .menu-link, .ast-fullscreen-menu-overlay .ast-below-header-menu-items .sub-menu .menu-item.current-menu-item > .menu-link' => array(
					'background-color' => 'transparent',
					'color'            => esc_attr( $primary_submenu_a_color['mobile'] ),
				),
				'.ast-fullscreen-menu-overlay .main-header-menu .sub-menu .menu-item.current-menu-item, .ast-fullscreen-menu-overlay .main-header-menu .sub-menu .menu-item.current-menu-ancestor, .ast-fullscreen-menu-overlay .ast-header-sections-navigation .sub-menu .menu-item.current-menu-item, .ast-fullscreen-menu-overlay .ast-above-header-menu-items .sub-menu .menu-item.current-menu-item, .ast-fullscreen-menu-overlay .ast-below-header-menu-items .sub-menu .menu-item.current-menu-item' => array(
					'background-color' => esc_attr( $primary_submenu_a_bg_color['mobile'] ),
				),
				// Primary Menu Hover Bg color.
				'.ast-fullscreen-menu-overlay .ast-header-break-point .main-header-menu .menu-link:hover, .ast-fullscreen-menu-overlay .ast-header-break-point .ast-header-custom-item a:hover, .ast-fullscreen-menu-overlay .ast-header-break-point .main-header-menu .menu-item:hover > .menu-link, .ast-fullscreen-menu-overlay .ast-header-break-point .main-header-menu .menu-item.focus > .menu-link' => array(
					'background-color' => 'transparent',
				),
				'.ast-fullscreen-menu-overlay .ast-header-break-point .main-header-menu .menu-item:hover, .ast-fullscreen-menu-overlay .ast-header-break-point .ast-header-custom-item a:hover, .ast-fullscreen-menu-overlay .ast-header-break-point .main-header-menu .menu-item:hover, .ast-fullscreen-menu-overlay .ast-header-break-point .main-header-menu .menu-item.focus' => array(
					'background-color' => esc_attr( $primary_menu_h_bg_color['mobile'] ),
				),
				// Primary menu Active Bg color.
				'.ast-fullscreen-menu-overlay .ast-header-break-point .main-header-menu .menu-item.current-menu-item > .menu-link, .ast-fullscreen-menu-overlay .ast-header-break-point .main-header-menu .menu-item.current-menu-ancestor > .menu-link' => array(
					'background-color' => 'transparent',
				),
				// Submenu Background color.
				'.ast-fullscreen-menu-overlay .ast-header-break-point .main-header-menu .menu-link, .ast-fullscreen-menu-overlay .ast-header-break-point .ast-header-custom-item a, .ast-fullscreen-menu-overlay .ast-header-break-point .main-header-menu .menu-item > .menu-link, .ast-fullscreen-menu-overlay .ast-header-break-point .main-header-menu .menu-item.focus > .menu-link' => array(
					'background-color' => 'transparent',
				),
				// Submenu hover bg color.
				'.ast-fullscreen-menu-overlay .ast-header-break-point .main-header-menu .sub-menu li:hover' => array(
					'background-color' => esc_attr( $primary_submenu_h_bg_color['mobile'] ),
				),
				'.ast-fullscreen-menu-overlay .ast-header-break-point .main-header-menu .sub-menu .menu-link:hover, .ast-fullscreen-menu-overlay .ast-header-break-point .main-header-menu .sub-menu .menu-link:focus' => array(
					'background-color' => 'transparent',
				),
				// Submenu active bg color.
				'.ast-fullscreen-menu-overlay .ast-header-break-point .main-header-menu .sub-menu .menu-item.current-menu-item > .menu-link, .ast-fullscreen-menu-overlay .ast-header-break-point .main-header-menu .sub-menu .menu-item.current-menu-ancestor > .menu-link, .ast-fullscreen-menu-overlay .ast-header-break-point .ast-header-sections-navigation .sub-menu .menu-item.current-menu-item > .menu-link, .ast-fullscreen-menu-overlay .ast-header-break-point .ast-above-header-menu-items .sub-menu .menu-item.current-menu-item > .menu-link, .ast-fullscreen-menu-overlay .ast-header-break-point .ast-below-header-menu-items .sub-menu .menu-item.current-menu-item > .menu-link' => array(
					'background-color' => 'transparent',
				),
				'.ast-fullscreen-menu-overlay .ast-header-break-point .main-header-menu .sub-menu .menu-item.current-menu-item, .ast-fullscreen-menu-overlay .ast-header-break-point .main-header-menu .sub-menu .menu-item.current-menu-ancestor, .ast-fullscreen-menu-overlay .ast-header-break-point .ast-header-sections-navigation .sub-menu .menu-item.current-menu-item, .ast-fullscreen-menu-overlay .ast-header-break-point .ast-above-header-menu-items .sub-menu .menu-item.current-menu-item, .ast-fullscreen-menu-overlay .ast-header-break-point .ast-below-header-menu-items .sub-menu .menu-item.current-menu-item' => array(
					'background-color' => esc_attr( $primary_submenu_a_bg_color['mobile'] ),
				),
				'.ast-fullscreen-menu-enable.ast-header-break-point .main-header-bar-navigation .close' => array(
					'color' => esc_attr( $mobile_header_close_mobile_color ),
				),
			);
			// Fullscreen background color if Header Background color is set.
			$mobile_colors['.ast-fullscreen-menu-enable.ast-header-break-point .main-header-bar-navigation .site-navigation,.ast-fullscreen-menu-enable.ast-header-break-point.admin-bar.ast-admin-bar-visible .ast-primary-menu-disabled .ast-header-custom-item .ast-merge-header-navigation-wrap'] = astra_get_responsive_background_obj( $header_bg_obj, 'mobile' );
			// Fullscreen background color if Primary Menu Background color is set.
			if ( '' !== $primary_menu_bg_image['mobile']['background-image'] || '' !== $primary_menu_bg_image['mobile']['background-color'] ) {
				$mobile_colors['.ast-fullscreen-menu-enable.ast-header-break-point .main-header-bar-navigation .site-navigation,.ast-fullscreen-menu-enable.ast-header-break-point.admin-bar.ast-admin-bar-visible .ast-primary-menu-disabled .ast-header-custom-item .ast-merge-header-navigation-wrap'] = astra_get_responsive_background_obj( $primary_menu_bg_image, 'mobile' );
			}

			/* Parse CSS from array() */
			$css_output .= astra_parse_css( $desktop_colors );
			$css_output .= astra_parse_css( $tablet_colors, '', astra_addon_get_tablet_breakpoint() );
			$css_output .= astra_parse_css( $mobile_colors, '', astra_addon_get_mobile_breakpoint() );

	} elseif ( 'no-toggle' === $menu_style ) {

		/**
		 * Responsive Colors options
		 * [1]. Primary Menu Responsive Colors general
		 */
		$desktop_colors = array(
			// Primary Menu Hover colors.
			'.ast-header-break-point.ast-no-toggle-menu-enable .main-header-menu .menu-item:hover > .menu-link, .ast-header-break-point.ast-no-toggle-menu-enable .main-header-menu .menu-item:hover > .ast-menu-toggle, .ast-header-break-point.ast-no-toggle-menu-enable .main-header-menu .menu-item.focus > .menu-link' => array(
				'color' => esc_attr( $primary_menu_h_color['desktop'] ),
			),
			// Primary Menu Hover Bg color.
			'.ast-header-break-point.ast-no-toggle-menu-enable .main-header-menu .menu-item:not(.ast-masthead-custom-menu-items):hover, .ast-header-break-point.ast-no-toggle-menu-enable .main-header-menu .sub-menu .menu-item:hover' => array(
				'background-color' => esc_attr( $primary_menu_h_bg_color['desktop'] ),
			),
			// Submenu hover bg color.
			'.ast-header-break-point.ast-no-toggle-menu-enable .main-header-menu .sub-menu .menu-item:hover' => array(
				'background-color' => esc_attr( $primary_submenu_h_bg_color['desktop'] ),
			),
			// Submenu hover color.
			'.ast-header-break-point.ast-no-toggle-menu-enable .main-header-menu .sub-menu .menu-item:hover > .ast-menu-toggle,.ast-header-break-point.ast-no-toggle-menu-enable .main-header-menu .sub-menu .menu-item:hover > .menu-link' => array(
				'color' => esc_attr( $primary_submenu_h_color['desktop'] ),
			),
			// Primary Menu Active colors.
			'.ast-header-break-point.ast-no-toggle-menu-enable .main-header-menu .menu-item.current-menu-item > .menu-link, .ast-header-break-point.ast-no-toggle-menu-enable .main-header-menu .menu-item.current-menu-item > .ast-menu-toggle, .ast-header-break-point.ast-no-toggle-menu-enable .main-header-menu .menu-item.current-menu-item:hover > .menu-link, .ast-header-break-point.ast-no-toggle-menu-enable .main-header-menu .menu-item.current-menu-item:hover > .ast-menu-toggle' => array(
				'color' => esc_attr( $primary_menu_a_color['desktop'] ),
			),
			// Primary Menu Active Bg color.
			'.ast-header-break-point.ast-no-toggle-menu-enable .main-header-menu .menu-item.current-menu-item, .ast-header-break-point.ast-no-toggle-menu-enable .main-header-menu .menu-item.current-menu-item:hover' => array(
				'background-color' => esc_attr( $primary_menu_a_bg_color['desktop'] ),
			),
			// Primary Submenu Active colors.
			'.ast-header-break-point.ast-no-toggle-menu-enable .main-header-menu .menu-item.current-menu-item:hover > .ast-menu-toggle, .ast-header-break-point.ast-no-toggle-menu-enable .main-header-menu .menu-item.current-menu-item > .ast-menu-toggle,.ast-header-break-point.ast-no-toggle-menu-enable .main-header-menu .sub-menu .menu-item.current-menu-item > .menu-link' => array(
				'color' => esc_attr( $primary_submenu_a_color['desktop'] ),
			),
			// Primary Submenu Active Bg color.
			'.ast-header-break-point.ast-no-toggle-menu-enable .main-header-menu .sub-menu .menu-item.current-menu-item' => array(
				'background-color' => esc_attr( $primary_submenu_a_bg_color['desktop'] ),
			),
		);
		$tablet_colors = array(
			// Primary Menu Hover colors.
			'.ast-header-break-point.ast-no-toggle-menu-enable .main-header-menu .menu-item:hover > .menu-link, .ast-header-break-point.ast-no-toggle-menu-enable .main-header-menu .menu-item:hover > .ast-menu-toggle, .ast-header-break-point.ast-no-toggle-menu-enable .main-header-menu .menu-item.focus > .menu-link' => array(
				'color' => esc_attr( $primary_menu_h_color['tablet'] ),
			),
			// Primary Menu Hover Bg color.
			'.ast-header-break-point.ast-no-toggle-menu-enable .main-header-menu .menu-item:not(.ast-masthead-custom-menu-items):hover, .ast-header-break-point.ast-no-toggle-menu-enable .main-header-menu .sub-menu .menu-item:hover' => array(
				'background-color' => esc_attr( $primary_menu_h_bg_color['tablet'] ),
			),
			// Submenu hover bg color.
			'.ast-header-break-point.ast-no-toggle-menu-enable .main-header-menu .sub-menu .menu-item:hover' => array(
				'background-color' => esc_attr( $primary_submenu_h_bg_color['tablet'] ),
			),
			// Submenu hover color.
			'.ast-header-break-point.ast-no-toggle-menu-enable .main-header-menu .sub-menu .menu-item:hover > .ast-menu-toggle,.ast-header-break-point.ast-no-toggle-menu-enable .main-header-menu .sub-menu .menu-item:hover > .menu-link' => array(
				'color' => esc_attr( $primary_submenu_h_color['tablet'] ),
			),
			// Primary Menu Active colors.
			'.ast-header-break-point.ast-no-toggle-menu-enable .main-header-menu .menu-item.current-menu-item > .menu-link, .ast-header-break-point.ast-no-toggle-menu-enable .main-header-menu .menu-item.current-menu-item > .ast-menu-toggle, .ast-header-break-point.ast-no-toggle-menu-enable .main-header-menu .menu-item.current-menu-item:hover > .menu-link, .ast-header-break-point.ast-no-toggle-menu-enable .main-header-menu .menu-item.current-menu-item:hover > .ast-menu-toggle' => array(
				'color' => esc_attr( $primary_menu_a_color['tablet'] ),
			),
			// Primary Menu Active Bg color.
			'.ast-header-break-point.ast-no-toggle-menu-enable .main-header-menu .menu-item.current-menu-item, .ast-header-break-point.ast-no-toggle-menu-enable .main-header-menu .menu-item.current-menu-item:hover' => array(
				'background-color' => esc_attr( $primary_menu_a_bg_color['tablet'] ),
			),
			// Primary Submenu Active colors.
			'.ast-header-break-point.ast-no-toggle-menu-enable .main-header-menu .menu-item.current-menu-item:hover > .ast-menu-toggle, .ast-header-break-point.ast-no-toggle-menu-enable .main-header-menu .menu-item.current-menu-item > .ast-menu-toggle,.ast-header-break-point.ast-no-toggle-menu-enable .main-header-menu .sub-menu .menu-item.current-menu-item > .menu-link' => array(
				'color' => esc_attr( $primary_submenu_a_color['tablet'] ),
			),
			// Primary Submenu Active Bg color.
			'.ast-header-break-point.ast-no-toggle-menu-enable .main-header-menu .sub-menu .menu-item.current-menu-item' => array(
				'background-color' => esc_attr( $primary_submenu_a_bg_color['tablet'] ),
			),
		);
		$mobile_colors = array(
			// Primary Menu Hover colors.
			'.ast-header-break-point.ast-no-toggle-menu-enable .main-header-menu .menu-item:hover > .menu-link, .ast-header-break-point.ast-no-toggle-menu-enable .main-header-menu .menu-item:hover > .ast-menu-toggle, .ast-header-break-point.ast-no-toggle-menu-enable .main-header-menu .menu-item.focus > .menu-link' => array(
				'color' => esc_attr( $primary_menu_h_color['mobile'] ),
			),
			// Primary Menu Hover Bg color.
			'.ast-header-break-point.ast-no-toggle-menu-enable .main-header-menu .menu-item:not(.ast-masthead-custom-menu-items):hover, .ast-header-break-point.ast-no-toggle-menu-enable .main-header-menu .sub-menu .menu-item:hover' => array(
				'background-color' => esc_attr( $primary_menu_h_bg_color['mobile'] ),
			),
			// Submenu hover bg color.
			'.ast-header-break-point.ast-no-toggle-menu-enable .main-header-menu .sub-menu .menu-item:hover' => array(
				'background-color' => esc_attr( $primary_submenu_h_bg_color['mobile'] ),
			),
			// Submenu hover color.
			'.ast-header-break-point.ast-no-toggle-menu-enable .main-header-menu .sub-menu .menu-item:hover > .ast-menu-toggle,.ast-header-break-point.ast-no-toggle-menu-enable .main-header-menu .sub-menu .menu-item:hover > .menu-link' => array(
				'color' => esc_attr( $primary_submenu_h_color['mobile'] ),
			),
			// Primary Menu Active colors.
			'.ast-header-break-point.ast-no-toggle-menu-enable .main-header-menu .menu-item.current-menu-item > .menu-link, .ast-header-break-point.ast-no-toggle-menu-enable .main-header-menu .menu-item.current-menu-item > .ast-menu-toggle, .ast-header-break-point.ast-no-toggle-menu-enable .main-header-menu .menu-item.current-menu-item:hover > .menu-link, .ast-header-break-point.ast-no-toggle-menu-enable .main-header-menu .menu-item.current-menu-item:hover > .ast-menu-toggle' => array(
				'color' => esc_attr( $primary_menu_a_color['mobile'] ),
			),
			// Primary Menu Active Bg color.
			'.ast-header-break-point.ast-no-toggle-menu-enable .main-header-menu .menu-item.current-menu-item, .ast-header-break-point.ast-no-toggle-menu-enable .main-header-menu .menu-item.current-menu-item:hover' => array(
				'background-color' => esc_attr( $primary_menu_a_bg_color['mobile'] ),
			),
			// Primary Submenu Active colors.
			'.ast-header-break-point.ast-no-toggle-menu-enable .main-header-menu .menu-item.current-menu-item:hover > .ast-menu-toggle, .ast-header-break-point.ast-no-toggle-menu-enable .main-header-menu .menu-item.current-menu-item > .ast-menu-toggle,.ast-header-break-point.ast-no-toggle-menu-enable .main-header-menu .sub-menu .menu-item.current-menu-item > .menu-link' => array(
				'color' => esc_attr( $primary_submenu_a_color['mobile'] ),
			),
			// Primary Submenu Active Bg color.
			'.ast-header-break-point.ast-no-toggle-menu-enable .main-header-menu .sub-menu .menu-item.current-menu-item' => array(
				'background-color' => esc_attr( $primary_submenu_a_bg_color['mobile'] ),
			),
		);
		/* Parse CSS from array() */
		$css_output .= astra_parse_css( $desktop_colors );
		$css_output .= astra_parse_css( $tablet_colors, '', astra_addon_get_tablet_breakpoint() );
		$css_output .= astra_parse_css( $mobile_colors, '', astra_addon_get_mobile_breakpoint() );
	}

	/**
	 * Responsive Colors options
	 * [3]. Primary Menu Responsive Colors only for Flyout menu style
	 */
	if ( 'flyout' === $menu_style ) {
		$desktop_colors = array(
			'.ast-flyout-menu-enable.ast-header-break-point .main-header-bar-navigation .close' => array(
				'color' => esc_attr( $mobile_header_close_desktop_color ),
			),
		);
		// Flyout background color if Header Background color is set.
		$desktop_colors['.ast-flyout-menu-enable.ast-header-break-point .main-header-bar-navigation .site-navigation, .ast-flyout-menu-enable.ast-header-break-point .ast-primary-menu-disabled .ast-merge-header-navigation-wrap'] = astra_get_responsive_background_obj( $header_bg_obj, 'desktop' );
		// Flyout background color if Primary Menu Background color is set.
		if ( '' !== $primary_menu_bg_image['desktop']['background-image'] || '' !== $primary_menu_bg_image['desktop']['background-color'] ) {
			$desktop_colors['.ast-flyout-menu-enable.ast-header-break-point .main-header-bar-navigation .site-navigation, .ast-flyout-menu-enable.ast-header-break-point .ast-primary-menu-disabled .ast-merge-header-navigation-wrap'] = astra_get_responsive_background_obj( $primary_menu_bg_image, 'desktop' );
		}

		$tablet_colors = array(
			'.ast-flyout-menu-enable.ast-header-break-point .main-header-bar-navigation .close' => array(
				'color' => esc_attr( $mobile_header_close_tablet_color ),
			),
		);
		// Flyout background color if Header Background color is set.
		$tablet_colors['.ast-flyout-menu-enable.ast-header-break-point .main-header-bar-navigation .site-navigation, .ast-flyout-menu-enable.ast-header-break-point .ast-primary-menu-disabled .ast-merge-header-navigation-wrap'] = astra_get_responsive_background_obj( $header_bg_obj, 'tablet' );
		// Flyout background color if Primary Menu Background color is set.
		if ( '' !== $primary_menu_bg_image['tablet']['background-image'] || '' !== $primary_menu_bg_image['tablet']['background-color'] ) {
			$tablet_colors['.ast-flyout-menu-enable.ast-header-break-point .main-header-bar-navigation .site-navigation, .ast-flyout-menu-enable.ast-header-break-point .ast-primary-menu-disabled .ast-merge-header-navigation-wrap'] = astra_get_responsive_background_obj( $primary_menu_bg_image, 'tablet' );
		}

		$mobile_colors = array(
			'.ast-flyout-menu-enable.ast-header-break-point .main-header-bar-navigation .close' => array(
				'color' => esc_attr( $mobile_header_close_mobile_color ),
			),
		);
		// Flyout background color if Header Background color is set.
		$mobile_colors['.ast-flyout-menu-enable.ast-header-break-point .main-header-bar-navigation .site-navigation, .ast-flyout-menu-enable.ast-header-break-point .ast-primary-menu-disabled .ast-merge-header-navigation-wrap'] = astra_get_responsive_background_obj( $header_bg_obj, 'mobile' );
		// Flyout background color if Primary Menu Background color is set.
		if ( '' !== $primary_menu_bg_image['mobile']['background-image'] || '' !== $primary_menu_bg_image['mobile']['background-color'] ) {
			$mobile_colors['.ast-flyout-menu-enable.ast-header-break-point .main-header-bar-navigation .site-navigation, .ast-flyout-menu-enable.ast-header-break-point .ast-primary-menu-disabled .ast-merge-header-navigation-wrap'] = astra_get_responsive_background_obj( $primary_menu_bg_image, 'mobile' );
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
	if ( 'no-toggle' === $menu_style ) {

		$link_colors = array(
			'.ast-no-toggle-menu-enable.ast-header-break-point .main-header-menu .menu-item:hover' => array(
				'color' => esc_attr( $link_color ),
			),
		);
		$css_output .= astra_parse_css( $link_colors );

		/**
		 * Responsive Colors options
		 * [4]. Below Header Menu Responsive Colors general
		 */
		$desktop_colors = array(
			// Mobile Below Header menu hover bg color.
			'.ast-no-toggle-menu-enable.ast-header-break-point .main-header-menu .menu-item:hover > .ast-menu-toggle' => array(
				'background-color' => esc_attr( $primary_menu_h_bg_color['desktop'] ),
			),
			'.ast-no-toggle-menu-enable.ast-header-break-point .main-header-menu, .ast-no-toggle-menu-enable.ast-header-break-point .ast-header-custom-item, .ast-no-toggle-menu-enable.ast-header-break-point .ast-header-sections-navigation' => array(
				'background-color' => esc_attr( $primary_menu_bg_image['desktop']['background-color'] ),
			),
			'.ast-no-toggle-menu-enable.ast-header-break-point .ast-primary-menu-disabled .ast-above-header-menu-items' => array(
				'background-color' => esc_attr( $primary_menu_bg_image['desktop']['background-color'] ),
			),
			'.ast-no-toggle-menu-enable.ast-header-break-point .ast-primary-menu-disabled .ast-below-header-menu-items' => array(
				'background-color' => esc_attr( $primary_menu_bg_image['desktop']['background-color'] ),
			),
		);

		$desktop_colors['.ast-header-break-point .main-header-menu'] =
				array(
					'background-color' => esc_attr( '#FFFFFF' ),
				);

		$tablet_colors = array(
			// Mobile Below Header menu hover bg color.
			'.ast-no-toggle-menu-enable.ast-header-break-point .main-header-menu .menu-item:hover > .ast-menu-toggle' => array(
				'background-color' => esc_attr( $primary_menu_h_bg_color['tablet'] ),
			),
			'.ast-no-toggle-menu-enable.ast-header-break-point .main-header-menu, .ast-no-toggle-menu-enable.ast-header-break-point .ast-header-custom-item, .ast-no-toggle-menu-enable.ast-header-break-point .ast-header-sections-navigation' => array(
				'background-color' => esc_attr( $primary_menu_bg_image['tablet']['background-color'] ),
			),
			'.ast-no-toggle-menu-enable.ast-header-break-point .ast-primary-menu-disabled .ast-above-header-menu-items' => array(
				'background-color' => esc_attr( $primary_menu_bg_image['tablet']['background-color'] ),
			),
			'.ast-no-toggle-menu-enable.ast-header-break-point .ast-primary-menu-disabled .ast-below-header-menu-items' => array(
				'background-color' => esc_attr( $primary_menu_bg_image['tablet']['background-color'] ),
			),
		);
		$mobile_colors = array(
			// Mobile Below Header menu hover bg color.
			'.ast-no-toggle-menu-enable.ast-header-break-point .main-header-menu .menu-item:hover > .ast-menu-toggle' => array(
				'background-color' => esc_attr( $primary_menu_h_bg_color['mobile'] ),
			),
			'.ast-no-toggle-menu-enable.ast-header-break-point .main-header-menu, .ast-no-toggle-menu-enable.ast-header-break-point .ast-header-custom-item, .ast-no-toggle-menu-enable.ast-header-break-point .ast-header-sections-navigation' => array(
				'background-color' => esc_attr( $primary_menu_bg_image['mobile']['background-color'] ),
			),
			'.ast-no-toggle-menu-enable.ast-header-break-point .ast-primary-menu-disabled .ast-above-header-menu-items' => array(
				'background-color' => esc_attr( $primary_menu_bg_image['mobile']['background-color'] ),
			),
			'.ast-no-toggle-menu-enable.ast-header-break-point .ast-primary-menu-disabled .ast-below-header-menu-items' => array(
				'background-color' => esc_attr( $primary_menu_bg_image['mobile']['background-color'] ),
			),
		);

		/* Parse CSS from array() */
		$css_output .= astra_parse_css( $desktop_colors );
		$css_output .= astra_parse_css( $tablet_colors, '', astra_addon_get_tablet_breakpoint() );
		$css_output .= astra_parse_css( $mobile_colors, '', astra_addon_get_mobile_breakpoint() );
	}
	return $dynamic_css . $css_output;
}
