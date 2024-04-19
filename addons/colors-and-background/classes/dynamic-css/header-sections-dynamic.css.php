<?php
/**
 * Colors & Background - Dynamic CSS
 *
 * @package Astra Addon
 */

add_filter( 'astra_addon_dynamic_css', 'astra_addon_header_sections_colors_dynamic_css', 99 );

/**
 * Dynamic CSS
 *
 * @param  string $dynamic_css          Astra Dynamic CSS.
 * @param  string $dynamic_css_filtered Astra Dynamic CSS Filters.
 * @return string
 */
function astra_addon_header_sections_colors_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' ) {

	$disable_primary_nav = astra_get_option( 'disable-primary-nav' );
	$above_header_merged = astra_get_option( 'above-header-merge-menu' );
	$below_header_merged = astra_get_option( 'below-header-merge-menu' );

	$header_break_point = astra_header_break_point(); // Header Break Point.

	$parse_css = '';

	/**
	 * Merge Header Section when there is no primary menu
	 */
	if ( $disable_primary_nav && ( $above_header_merged || $below_header_merged ) ) {

		$header_bg_obj           = astra_get_option( 'header-bg-obj-responsive' );
		$desktop_header_bg_color = isset( $header_bg_obj['desktop']['background-color'] ) ? $header_bg_obj['desktop']['background-color'] : '';
		$tablet_header_bg_color  = isset( $header_bg_obj['tablet']['background-color'] ) ? $header_bg_obj['tablet']['background-color'] : '';
		$mobile_header_bg_color  = isset( $header_bg_obj['mobile']['background-color'] ) ? $header_bg_obj['mobile']['background-color'] : '';

		$primary_menu_bg_image   = astra_get_option( 'primary-menu-bg-obj-responsive' );
		$primary_menu_color      = astra_get_option( 'primary-menu-color-responsive' );
		$primary_menu_h_bg_color = astra_get_option( 'primary-menu-h-bg-color-responsive' );
		$primary_menu_h_color    = astra_get_option( 'primary-menu-h-color-responsive' );
		$primary_menu_a_bg_color = astra_get_option( 'primary-menu-a-bg-color-responsive' );
		$primary_menu_a_color    = astra_get_option( 'primary-menu-a-color-responsive' );

		$primary_submenu_b_color    = astra_get_option( 'primary-submenu-b-color' );
		$primary_submenu_bg_color   = astra_get_option( 'primary-submenu-bg-color-responsive' );
		$primary_submenu_color      = astra_get_option( 'primary-submenu-color-responsive' );
		$primary_submenu_h_bg_color = astra_get_option( 'primary-submenu-h-bg-color-responsive' );
		$primary_submenu_h_color    = astra_get_option( 'primary-submenu-h-color-responsive' );
		$primary_submenu_a_bg_color = astra_get_option( 'primary-submenu-a-bg-color-responsive' );
		$primary_submenu_a_color    = astra_get_option( 'primary-submenu-a-color-responsive' );

		// Desktop.
		$desktop_colors = array(

			/**
			 * Primary Menu merge with Above Header & Below Header menu
			 */
			'.ast-header-sections-navigation .menu-item.current-menu-item > .menu-link, .ast-above-header-menu-items .menu-item.current-menu-item > .menu-link,.ast-header-sections-navigation .menu-item.current-menu-ancestor > .menu-link, .ast-above-header-menu-items .menu-item.current-menu-ancestor > .menu-link' => array(
				'color'            => esc_attr( $primary_menu_a_color['desktop'] ),
				'background-color' => esc_attr( $primary_menu_a_bg_color['desktop'] ),
			),
			'.main-header-menu .menu-link:hover, .ast-header-custom-item .menu-link:hover, .main-header-menu .menu-item:hover > .menu-link, .main-header-menu .menu-item.focus > .menu-link, .ast-header-break-point .ast-header-sections-navigation .menu-link:hover, .ast-header-break-point .ast-header-sections-navigation .menu-link:focus' => array(
				'background-color' => esc_attr( $primary_menu_h_bg_color['desktop'] ),
				'color'            => esc_attr( $primary_menu_h_color['desktop'] ),
			),
			'.ast-header-sections-navigation .menu-item:hover > .ast-menu-toggle, .ast-header-sections-navigation .menu-item.focus > .ast-menu-toggle' => array(
				'color' => esc_attr( $primary_menu_h_color['desktop'] ),
			),

			'.ast-header-sections-navigation, .ast-header-sections-navigation .menu-link' => array(
				'color' => esc_attr( $primary_menu_color['desktop'] ),
			),

			'.ast-header-sections-navigation .ast-inline-search form' => array(
				'border-color' => esc_attr( $primary_menu_color['desktop'] ),
			),

			/**
			 * Primary Submenu
			 */
			'.ast-header-sections-navigation .sub-menu .menu-link' => array(
				'color' => esc_attr( $primary_submenu_color['desktop'] ),
			),
			'.ast-header-sections-navigation .sub-menu .menu-link:hover' => array(
				'color'            => esc_attr( $primary_submenu_h_color['desktop'] ),
				'background-color' => esc_attr( $primary_submenu_h_bg_color['desktop'] ),
			),
			'.ast-header-sections-navigation .sub-menu .menu-item:hover > .ast-menu-toggle, .ast-header-sections-navigation .sub-menu .menu-item:focus > .ast-menu-toggle, .ast-above-header-menu-items .sub-menu .menu-item:hover > .ast-menu-toggle, .ast-above-header-menu-items .sub-menu .menu-item:focus > .ast-menu-toggle' => array(
				'color' => esc_attr( $primary_submenu_h_color['desktop'] ),
			),
			'.ast-header-sections-navigation .sub-menu .menu-item.current-menu-item > .menu-link' => array(
				'color'            => esc_attr( $primary_submenu_a_color['desktop'] ),
				'background-color' => esc_attr( $primary_submenu_a_bg_color['desktop'] ),
			),
			'.ast-header-sections-navigation .sub-menu > .menu-item > .menu-link' => array(
				'border-color' => esc_attr( $primary_submenu_b_color ),
			),
			'.main-navigation .sub-menu, .ast-header-break-point .main-header-menu .sub-menu, .ast-header-sections-navigation .sub-menu > .menu-item > .menu-link' => array(
				'background-color' => esc_attr( $primary_submenu_bg_color['desktop'] ),
			),
		);

		// Tablet.
		$tablet_colors = array(

			/**
			 * Primary Menu merge with Above Header & Below Header menu
			 */
			'.ast-header-sections-navigation .menu-item.current-menu-item > .menu-link,.ast-header-sections-navigation .menu-item.current-menu-ancestor > .menu-link' => array(
				'color'            => esc_attr( $primary_menu_a_color['tablet'] ),
				'background-color' => esc_attr( $primary_menu_a_bg_color['tablet'] ),
			),
			'.main-header-menu .menu-link:hover, .ast-header-custom-item .menu-link:hover, .main-header-menu .menu-item:hover > .menu-link, .main-header-menu .menu-item.focus > .menu-link, .ast-header-break-point .ast-header-sections-navigation .menu-link:hover, .ast-header-break-point .ast-header-sections-navigation .menu-link:focus' => array(
				'background-color' => esc_attr( $primary_menu_h_bg_color['tablet'] ),
				'color'            => esc_attr( $primary_menu_h_color['tablet'] ),
			),
			'.ast-header-sections-navigation .menu-item:hover > .ast-menu-toggle, .ast-header-sections-navigation .menu-item.focus > .ast-menu-toggle' => array(
				'color' => esc_attr( $primary_menu_h_color['tablet'] ),
			),

			'.ast-header-sections-navigation, .ast-header-sections-navigation .menu-link' => array(
				'color' => esc_attr( $primary_menu_color['tablet'] ),
			),

			'.ast-header-sections-navigation .ast-inline-search form' => array(
				'border-color' => esc_attr( $primary_menu_color['tablet'] ),
			),

			/**
			 * Primary Submenu
			 */
			'.ast-header-sections-navigation .sub-menu .menu-link, .ast-above-header-menu-items .sub-menu .menu-link' => array(
				'color' => esc_attr( $primary_submenu_color['tablet'] ),
			),
			'.ast-header-sections-navigation .sub-menu .menu-link:hover' => array(
				'color'            => esc_attr( $primary_submenu_h_color['tablet'] ),
				'background-color' => esc_attr( $primary_submenu_h_bg_color['tablet'] ),
			),
			'.ast-header-sections-navigation .sub-menu .menu-item:hover > .ast-menu-toggle, .ast-header-sections-navigation .sub-menu .menu-item:focus > .ast-menu-toggle' => array(
				'color' => esc_attr( $primary_submenu_h_color['tablet'] ),
			),
			'.ast-header-sections-navigation .sub-menu .menu-item.current-menu-item > .menu-link' => array(
				'color'            => esc_attr( $primary_submenu_a_color['tablet'] ),
				'background-color' => esc_attr( $primary_submenu_a_bg_color['tablet'] ),
			),
			'.main-navigation .sub-menu, .ast-header-break-point .main-header-menu .sub-menu, .ast-header-sections-navigation .sub-menu > .menu-item > .menu-link' => array(
				'background-color' => esc_attr( $primary_submenu_bg_color['tablet'] ),
			),
		);

		// Mobile.
		$mobile_colors = array(

			/**
			 * Primary Menu merge with Above Header & Below Header menu
			 */
			'.ast-header-sections-navigation .menu-item.current-menu-item > .menu-link,.ast-header-sections-navigation .menu-item.current-menu-ancestor > .menu-link' => array(
				'color'            => esc_attr( $primary_menu_a_color['mobile'] ),
				'background-color' => esc_attr( $primary_menu_a_bg_color['mobile'] ),
			),
			'.main-header-menu .menu-link:hover, .ast-header-custom-item .menu-link:hover, .main-header-menu .menu-item:hover > .menu-link, .main-header-menu .menu-item.focus > .menu-link, .ast-header-break-point .ast-header-sections-navigation .menu-link:hover, .ast-header-break-point .ast-header-sections-navigation .menu-link:focus' => array(
				'background-color' => esc_attr( $primary_menu_h_bg_color['mobile'] ),
				'color'            => esc_attr( $primary_menu_h_color['mobile'] ),
			),
			'.ast-header-sections-navigation .menu-item:hover > .ast-menu-toggle, .ast-header-sections-navigation .menu-item.focus > .ast-menu-toggle' => array(
				'color' => esc_attr( $primary_menu_h_color['mobile'] ),
			),
			'.ast-header-sections-navigation, .ast-header-sections-navigation .menu-link' => array(
				'color' => esc_attr( $primary_menu_color['mobile'] ),
			),
			'.ast-header-sections-navigation .ast-inline-search form' => array(
				'border-color' => esc_attr( $primary_menu_color['mobile'] ),
			),

			/**
			 * Primary Submenu
			 */
			'.ast-header-sections-navigation .sub-menu .menu-link' => array(
				'color' => esc_attr( $primary_submenu_color['mobile'] ),
			),
			'.ast-header-sections-navigation .sub-menu .menu-link:hover' => array(
				'color'            => esc_attr( $primary_submenu_h_color['mobile'] ),
				'background-color' => esc_attr( $primary_submenu_h_bg_color['mobile'] ),
			),
			'.ast-header-sections-navigation .sub-menu .menu-item:hover > .ast-menu-toggle, .ast-header-sections-navigation .sub-menu .menu-item:focus > .ast-menu-toggle' => array(
				'color' => esc_attr( $primary_submenu_h_color['mobile'] ),
			),
			'.ast-header-sections-navigation .sub-menu .menu-item.current-menu-item > .menu-link' => array(
				'color'            => esc_attr( $primary_submenu_a_color['mobile'] ),
				'background-color' => esc_attr( $primary_submenu_a_bg_color['mobile'] ),
			),
			'.main-navigation .sub-menu, .ast-header-break-point .main-header-menu .sub-menu, .ast-header-sections-navigation .sub-menu > .menu-item > .menu-link' => array(
				'background-color' => esc_attr( $primary_submenu_bg_color['mobile'] ),
			),
		);

		// Desktop.
		if ( '' != $primary_menu_bg_image['desktop']['background-color'] || '' != $primary_menu_bg_image['desktop']['background-image'] ) {
			// If primary menu background color is set then only apply it to the Merged menu.
			$desktop_colors['.ast-header-break-point .ast-header-sections-navigation'] = astra_get_responsive_background_obj( $primary_menu_bg_image, 'desktop' );
		} else {
			// If primary menu background color is not set then only apply Header background color to the Merged menu.
			$desktop_colors['.ast-header-break-point .ast-header-sections-navigation'] = array(
				'background-color' => esc_attr( $desktop_header_bg_color ),
			);
		}

		// Tablet.
		if ( '' != $primary_menu_bg_image['tablet']['background-color'] || '' != $primary_menu_bg_image['tablet']['background-image'] ) {
			// If primary menu background color is set then only apply it to the Merged menu.
			$tablet_colors['.ast-header-break-point .ast-header-sections-navigation'] = astra_get_responsive_background_obj( $primary_menu_bg_image, 'tablet' );
		} else {
			// If primary menu background color is not set then only apply Header background color to the Merged menu.
			$tablet_colors['.ast-header-break-point .ast-header-sections-navigation'] = array(
				'background-color' => esc_attr( $tablet_header_bg_color ),
			);
		}

		// mobile.
		if ( '' != $primary_menu_bg_image['mobile']['background-color'] || '' != $primary_menu_bg_image['mobile']['background-image'] ) {
			// If primary menu background color is set then only apply it to the Merged menu.
			$mobile_colors['.ast-header-break-point .ast-header-sections-navigation'] = astra_get_responsive_background_obj( $primary_menu_bg_image, 'mobile' );
		} else {
			// If primary menu background color is not set then only apply Header background color to the Merged menu.
			$mobile_colors['.ast-header-break-point .ast-header-sections-navigation'] = array(
				'background-color' => esc_attr( $mobile_header_bg_color ),
			);
		}

		/* Parse CSS from array() */
		$parse_css .= astra_parse_css( $desktop_colors );
		$parse_css .= astra_parse_css( $tablet_colors, '', astra_addon_get_tablet_breakpoint() );
		$parse_css .= astra_parse_css( $mobile_colors, '', astra_addon_get_mobile_breakpoint() );
	}

	return $dynamic_css . $parse_css;
}
