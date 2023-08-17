<?php
/**
 * Above Header - Dyanamic CSS
 *
 * @package Astra Addon
 */

add_filter( 'astra_addon_dynamic_css', 'astra_ext_above_header_dynamic_css' );

/**
 * Dynamic CSS funtion
 *
 * @param  string $dynamic_css          Astra Dynamic CSS.
 * @param  string $dynamic_css_filtered Astra Dyanamic CSS Filters.
 * @return string
 */
function astra_ext_above_header_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' ) {

	$above_header_layout = astra_get_option( 'above-header-layout' );

	if ( 'disabled' == $above_header_layout ) {
		return $dynamic_css;
	}

	$parse_css = '';

	$height       = astra_get_option( 'above-header-height' );
	$border_width = astra_get_option( 'above-header-divider' );
	$border_color = astra_get_option( 'above-header-divider-color' );

	$theme_color            = astra_get_option( 'theme-color' );
	$theme_text_color       = astra_get_option( 'text-color' );
	$theme_link_color       = astra_get_option( 'link-color' );
	$theme_link_hover_color = astra_get_option( 'link-h-color' );

	$font_size_above_header_content      = astra_get_option( 'font-size-above-header-content' );
	$font_family_above_header_content    = astra_get_option( 'font-family-above-header-content' );
	$font_weight_above_header_content    = astra_get_option( 'font-weight-above-header-content' );
	$text_transform_above_header_content = astra_get_option( 'text-transform-above-header-content' );

	$desktop_above_header_text_color = astra_get_prop( astra_get_option( 'above-header-text-color-responsive' ), 'desktop' );
	$tablet_above_header_text_color  = astra_get_prop( astra_get_option( 'above-header-text-color-responsive' ), 'tablet' );
	$mobile_above_header_text_color  = astra_get_prop( astra_get_option( 'above-header-text-color-responsive' ), 'mobile' );

	$desktop_above_header_link_color = astra_get_prop( astra_get_option( 'above-header-link-color-responsive' ), 'desktop', $theme_link_color );
	$tablet_above_header_link_color  = astra_get_prop( astra_get_option( 'above-header-link-color-responsive' ), 'tablet' );
	$mobile_above_header_link_color  = astra_get_prop( astra_get_option( 'above-header-link-color-responsive' ), 'mobile' );

	$desktop_above_header_link_h_color = astra_get_prop( astra_get_option( 'above-header-link-h-color-responsive' ), 'desktop', $theme_link_hover_color );
	$tablet_above_header_link_h_color  = astra_get_prop( astra_get_option( 'above-header-link-h-color-responsive' ), 'tablet' );
	$mobile_above_header_link_h_color  = astra_get_prop( astra_get_option( 'above-header-link-h-color-responsive' ), 'mobile' );

	$above_header_bg_obj = astra_get_option( 'above-header-bg-obj-responsive' );
	$desktop_background  = isset( $above_header_bg_obj['desktop']['background-color'] ) ? $above_header_bg_obj['desktop']['background-color'] : '';
	$tablet_background   = isset( $above_header_bg_obj['tablet']['background-color'] ) ? $above_header_bg_obj['tablet']['background-color'] : '';
	$mobile_background   = isset( $above_header_bg_obj['mobile']['background-color'] ) ? $above_header_bg_obj['mobile']['background-color'] : '';

	$above_header_menu_bg_obj = astra_get_option( 'above-header-menu-bg-obj-responsive' );

	$desktop_above_header_menu_color = astra_get_prop( astra_get_option( 'above-header-menu-color-responsive' ), 'desktop' );
	$tablet_above_header_menu_color  = astra_get_prop( astra_get_option( 'above-header-menu-color-responsive' ), 'tablet' );
	$mobile_above_header_menu_color  = astra_get_prop( astra_get_option( 'above-header-menu-color-responsive' ), 'mobile' );

	$desktop_above_header_menu_h_color = astra_get_prop( astra_get_option( 'above-header-menu-h-color-responsive' ), 'desktop' );
	$tablet_above_header_menu_h_color  = astra_get_prop( astra_get_option( 'above-header-menu-h-color-responsive' ), 'tablet' );
	$mobile_above_header_menu_h_color  = astra_get_prop( astra_get_option( 'above-header-menu-h-color-responsive' ), 'mobile' );

	$desktop_above_header_menu_h_bg_color = astra_get_prop( astra_get_option( 'above-header-menu-h-bg-color-responsive' ), 'desktop' );
	$tablet_above_header_menu_h_bg_color  = astra_get_prop( astra_get_option( 'above-header-menu-h-bg-color-responsive' ), 'tablet' );
	$mobile_above_header_menu_h_bg_color  = astra_get_prop( astra_get_option( 'above-header-menu-h-bg-color-responsive' ), 'mobile' );

	$desktop_above_header_menu_active_color = astra_get_prop( astra_get_option( 'above-header-menu-active-color-responsive' ), 'desktop' );
	$tablet_above_header_menu_active_color  = astra_get_prop( astra_get_option( 'above-header-menu-active-color-responsive' ), 'tablet' );
	$mobile_above_header_menu_active_color  = astra_get_prop( astra_get_option( 'above-header-menu-active-color-responsive' ), 'mobile' );

	$desktop_above_header_menu_active_bg_color = astra_get_prop( astra_get_option( 'above-header-menu-active-bg-color-responsive' ), 'desktop' );
	$tablet_above_header_menu_active_bg_color  = astra_get_prop( astra_get_option( 'above-header-menu-active-bg-color-responsive' ), 'tablet' );
	$mobile_above_header_menu_active_bg_color  = astra_get_prop( astra_get_option( 'above-header-menu-active-bg-color-responsive' ), 'mobile' );

	$desktop_above_header_submenu_text_color = astra_get_prop( astra_get_option( 'above-header-submenu-text-color-responsive' ), 'desktop' );
	$tablet_above_header_submenu_text_color  = astra_get_prop( astra_get_option( 'above-header-submenu-text-color-responsive' ), 'tablet' );
	$mobile_above_header_submenu_text_color  = astra_get_prop( astra_get_option( 'above-header-submenu-text-color-responsive' ), 'mobile' );

	$desktop_above_header_submenu_bg_color = astra_get_prop( astra_get_option( 'above-header-submenu-bg-color-responsive' ), 'desktop' );
	$tablet_above_header_submenu_bg_color  = astra_get_prop( astra_get_option( 'above-header-submenu-bg-color-responsive' ), 'tablet' );
	$mobile_above_header_submenu_bg_color  = astra_get_prop( astra_get_option( 'above-header-submenu-bg-color-responsive' ), 'mobile' );

	$desktop_above_header_submenu_hover_color = astra_get_prop( astra_get_option( 'above-header-submenu-hover-color-responsive' ), 'desktop' );
	$tablet_above_header_submenu_hover_color  = astra_get_prop( astra_get_option( 'above-header-submenu-hover-color-responsive' ), 'tablet' );
	$mobile_above_header_submenu_hover_color  = astra_get_prop( astra_get_option( 'above-header-submenu-hover-color-responsive' ), 'mobile' );

	$desktop_above_header_submenu_bg_hover_color = astra_get_prop( astra_get_option( 'above-header-submenu-bg-hover-color-responsive' ), 'desktop' );
	$tablet_above_header_submenu_bg_hover_color  = astra_get_prop( astra_get_option( 'above-header-submenu-bg-hover-color-responsive' ), 'tablet' );
	$mobile_above_header_submenu_bg_hover_color  = astra_get_prop( astra_get_option( 'above-header-submenu-bg-hover-color-responsive' ), 'mobile' );

	$desktop_above_header_submenu_active_color = astra_get_prop( astra_get_option( 'above-header-submenu-active-color-responsive' ), 'desktop' );
	$tablet_above_header_submenu_active_color  = astra_get_prop( astra_get_option( 'above-header-submenu-active-color-responsive' ), 'tablet' );
	$mobile_above_header_submenu_active_color  = astra_get_prop( astra_get_option( 'above-header-submenu-active-color-responsive' ), 'mobile' );

	$desktop_above_header_submenu_active_bg_color = astra_get_prop( astra_get_option( 'above-header-submenu-active-bg-color-responsive' ), 'desktop' );
	$tablet_above_header_submenu_active_bg_color  = astra_get_prop( astra_get_option( 'above-header-submenu-active-bg-color-responsive' ), 'tablet' );
	$mobile_above_header_submenu_active_bg_color  = astra_get_prop( astra_get_option( 'above-header-submenu-active-bg-color-responsive' ), 'mobile' );

	$above_header_submenu_border       = astra_get_option( 'above-header-submenu-border' );
	$above_header_submenu_item_border  = astra_get_option( 'above-header-submenu-item-border' );
	$above_header_submenu_item_b_color = astra_get_option( 'above-header-submenu-item-b-color', '#eaeaea' );
	$above_header_submenu_border_color = astra_get_option( 'above-header-submenu-border-color', $theme_color );

	$font_family    = astra_get_option( 'above-header-font-family' );
	$font_weight    = astra_get_option( 'above-header-font-weight' );
	$font_size      = astra_get_option( 'above-header-font-size' );
	$text_transform = astra_get_option( 'above-header-text-transform' );

	// Above header submenu typography.
	$font_size_above_header_dropdown      = astra_get_option( 'font-size-above-header-dropdown-menu' );
	$font_family_above_header_dropdown    = astra_get_option( 'font-family-above-header-dropdown-menu' );
	$font_weight_above_header_dropdown    = astra_get_option( 'font-weight-above-header-dropdown-menu' );
	$text_transform_above_header_dropdown = astra_get_option( 'text-transform-above-header-dropdown-menu' );

	// Header Break Point.
	$header_break_point = astra_header_break_point();

	$max_height = '26px';
	$padding    = '';
	if ( '' != $height && 30 < $height ) {
		$max_height = ( $height - 6 ) . 'px';
	}

	if ( 60 > $height ) {
		$padding = '.35em';
	}

	if ( false === Astra_Icons::is_svg_icons() ) {
		$astra_font = array(
			'.ast-above-header-menu .sub-menu .menu-item.menu-item-has-children > .menu-link::after' => array(
				'position'  => 'absolute',
				'right'     => '1em',
				'top'       => '50%',
				'transform' => 'translate(0, -50%) rotate( 270deg )',
			),
			'.ast-desktop .ast-above-header .menu-item-has-children > .menu-link:after' => array(
				'content'                 => '"\e900"',
				'display'                 => 'inline-block',
				'font-family'             => "'Astra'",
				'font-size'               => '9px',
				'font-size'               => '.6rem',
				'font-weight'             => 'bold',
				'text-rendering'          => 'auto',
				'-webkit-font-smoothing'  => 'antialiased',
				'-moz-osx-font-smoothing' => 'grayscale',
				'margin-left'             => '10px',
				'line-height'             => 'normal',
			),
			'.ast-header-break-point .ast-above-header-navigation .menu-item-has-children > .ast-menu-toggle::before' => array(
				'content'         => '"\e900"',
				'font-family'     => "'Astra'",
				'text-decoration' => 'inherit',
				'display'         => 'inline-block',
			),
			'.ast-header-break-point .ast-above-header-navigation .sub-menu .menu-item .menu-link:before' => array(
				'content'         => '"\e900"',
				'font-family'     => "'Astra'",
				'text-decoration' => 'inherit',
				'display'         => 'inline-block',
				'font-size'       => '.65em',
				'transform'       => 'translate(0, -2px) rotateZ(270deg)',
				'margin-right'    => '5px',
			),
		);
	} else {
		$astra_font = array(
			'.ast-header-break-point .ast-above-header-menu .menu-item .menu-link .icon-arrow:first-of-type svg' => array(
				'left'         => '.1em',
				'top'          => '.1em',
				'transform'    => 'translate(0,-2px) rotateZ( 270deg )',
				'margin-right' => '5px',
				'position'     => 'unset',
			),
		);
		if ( false === Astra_Builder_Helper::$is_header_footer_builder_active && false === Astra_Ext_Extension::is_active( 'nav-menu' ) ) {
			$astra_font['.ast-desktop .ast-above-header-menu .menu-link > .icon-arrow'] = array(
				'display' => 'none',
			);
		}
	}

	/* Parse CSS from array() */
	$parse_css .= astra_parse_css( $astra_font );

	/**
	 * [1]. Above Header General options
	 * [2]. Above Header Responsive Typography
	 * [3]. Above Header Responsive Colors
	 */

	/**
	 * [1]. Above Header General options
	 */
	$common_css_output = array(

		'.ast-above-header'                => array(
			'border-bottom-width' => astra_get_css_value( $border_width, 'px' ),
			'border-bottom-color' => esc_attr( $border_color ),
			'line-height'         => astra_get_css_value( $height, 'px' ),
		),
		'.ast-above-header-menu, .ast-above-header .user-select' => array(
			'font-family'    => astra_get_css_value( $font_family, 'font' ),
			'font-weight'    => astra_get_css_value( $font_weight, 'font' ),
			'font-size'      => astra_responsive_font( $font_size, 'desktop' ),
			'text-transform' => esc_attr( $text_transform ),
		),
		/**
		 * Above Header Dropdown Navigation
		 */
		'.ast-above-header-menu .sub-menu' => array(
			'font-family'    => astra_get_css_value( $font_family_above_header_dropdown, 'font' ),
			'font-weight'    => astra_get_css_value( $font_weight_above_header_dropdown, 'font' ),
			'font-size'      => astra_responsive_font( $font_size_above_header_dropdown, 'desktop' ),
			'text-transform' => esc_attr( $text_transform_above_header_dropdown ),
		),
		'.ast-header-break-point .ast-above-header-merged-responsive .ast-above-header' => array(
			'border-bottom-width' => astra_get_css_value( $border_width, 'px' ),
			'border-bottom-color' => esc_attr( $border_color ),
		),

		'.ast-above-header .ast-search-menu-icon .search-field' => array(
			'max-height'     => esc_attr( $max_height ),
			'padding-top'    => esc_attr( $padding ),
			'padding-bottom' => esc_attr( $padding ),
		),

		'.ast-above-header-section-wrap'   => array(
			'min-height' => astra_get_css_value( $height, 'px' ),
		),
		'.ast-above-header-menu .sub-menu, .ast-above-header-menu .sub-menu .menu-link, .ast-above-header-menu .astra-full-megamenu-wrapper' => array(
			'border-color' => esc_attr( $above_header_submenu_border_color ),
		),
		'.ast-header-break-point .ast-below-header-merged-responsive .below-header-user-select, .ast-header-break-point .ast-below-header-merged-responsive .below-header-user-select .widget, .ast-header-break-point .ast-below-header-merged-responsive .below-header-user-select .widget-title' => array(
			'color' => esc_attr( $theme_text_color ),
		),
		'.ast-header-break-point .ast-below-header-merged-responsive .below-header-user-select a' => array(
			'color' => esc_attr( $theme_link_color ),
		),
		/**
		 * Above header content typography.
		 */
		'.ast-above-header-section .above-header-user-select' => array(
			'font-family'    => astra_get_css_value( $font_family_above_header_content, 'font' ),
			'font-weight'    => astra_get_css_value( $font_weight_above_header_content, 'font' ),
			'font-size'      => astra_responsive_font( $font_size_above_header_content, 'desktop' ),
			'text-transform' => esc_attr( $text_transform_above_header_content ),
		),
	);

	/**
	 * [2]. Above Header General options
	 */
	$tablet_typography_css = array(
		'.ast-above-header-menu, .ast-above-header .user-select' => array(
			'font-size' => astra_responsive_font( $font_size, 'tablet' ),
		),
		'.ast-above-header-menu .sub-menu' => array(
			'font-size' => astra_responsive_font( $font_size_above_header_dropdown, 'tablet' ),
		),
		/**
		 * Above header content typography.
		 */
		'.ast-above-header-section .above-header-user-select' => array(
			'font-size' => astra_responsive_font( $font_size_above_header_content, 'tablet' ),
		),
	);

	$mobile_typography_css = array(
		'.ast-above-header-menu, .ast-above-header .user-select' => array(
			'font-size' => astra_responsive_font( $font_size, 'mobile' ),
		),
		'.ast-above-header-menu .sub-menu' => array(
			'font-size' => astra_responsive_font( $font_size_above_header_dropdown, 'mobile' ),
		),
		/**
		 * Above header content typography.
		 */
		'.ast-above-header-section .above-header-user-select' => array(
			'font-size' => astra_responsive_font( $font_size_above_header_content, 'mobile' ),
		),
	);

	/**
	 * [3]. Above Header Responsive Colors
	 */
	$desktop_colors = array(
		'.ast-above-header'                             => astra_get_responsive_background_obj( $above_header_bg_obj, 'desktop' ),
		'.ast-header-break-point .ast-above-header-merged-responsive .ast-above-header' => array(
			'background-color' => esc_attr( $desktop_background ),
		),
		'.ast-header-break-point .ast-above-header-section-separated .ast-above-header-navigation, .ast-header-break-point .ast-above-header-section-separated .ast-above-header-navigation ul' => array(
			'background-color' => esc_attr( $desktop_background ),
		),
		'.ast-above-header-menu, .ast-header-break-point .ast-above-header-section-separated .ast-above-header-navigation .ast-above-header-menu' => astra_get_responsive_background_obj( $above_header_menu_bg_obj, 'desktop' ),

		'.ast-above-header-section .user-select, .ast-above-header-section .widget, .ast-above-header-section .widget-title' => array(
			'color' => esc_attr( $desktop_above_header_text_color ),
		),

		'.ast-above-header-section .user-select a, .ast-above-header-section .widget a' => array(
			'color' => esc_attr( $desktop_above_header_link_color ),
		),

		'.ast-above-header-section .search-field:focus' => array(
			'border-color' => esc_attr( $desktop_above_header_link_color ),
		),

		'.ast-above-header-section .user-select a:hover, .ast-above-header-section .widget a:hover' => array(
			'color' => esc_attr( $desktop_above_header_link_h_color ),
		),

		'.ast-above-header-navigation a'                => array(
			'color' => esc_attr( $desktop_above_header_menu_color ),
		),

		'.ast-above-header-navigation .menu-item:hover > .menu-link' => array(
			'color'            => esc_attr( $desktop_above_header_menu_h_color ),
			'background-color' => esc_attr( $desktop_above_header_menu_h_bg_color ),
		),

		'.ast-above-header-navigation .menu-item.focus > .menu-link' => array(
			'color'            => esc_attr( $desktop_above_header_menu_h_color ),
			'background-color' => esc_attr( $desktop_above_header_menu_h_bg_color ),
		),

		'.ast-above-header-navigation .menu-item.current-menu-item > .menu-link, .ast-above-header-navigation .menu-item.current-menu-ancestor > .menu-link' => array(
			'color'            => esc_attr( $desktop_above_header_menu_active_color ),
			'background-color' => esc_attr( $desktop_above_header_menu_active_bg_color ),
		),

		/**
		 * Below Header Dropdown Navigation
		 */
		'.ast-above-header-menu .sub-menu .menu-item:hover > .menu-link, .ast-above-header-menu .sub-menu .menu-item:focus > .menu-link, .ast-above-header-menu .sub-menu .menu-item.focus > .menu-link,.ast-above-header-menu .sub-menu .menu-item:hover > .ast-menu-toggle, .ast-above-header-menu .sub-menu .menu-item:focus > .ast-menu-toggle, .ast-above-header-menu .sub-menu .menu-item.focus > .ast-menu-toggle' => array(
			'color'            => esc_attr( $desktop_above_header_submenu_hover_color ),
			'background-color' => esc_attr( $desktop_above_header_submenu_bg_hover_color ),
		),
		'.ast-above-header-menu .sub-menu .menu-item.current-menu-ancestor > .ast-menu-toggle, .ast-above-header-menu .sub-menu .menu-item.current-menu-item > .ast-menu-toggle, .ast-above-header-menu .sub-menu .menu-item.current-menu-ancestor:hover > .ast-menu-toggle, .ast-above-header-menu .sub-menu .menu-item.current-menu-ancestor:focus > .ast-menu-toggle, .ast-above-header-menu .sub-menu .menu-item.current-menu-ancestor.focus > .ast-menu-toggle, .ast-above-header-menu .sub-menu .menu-item.current-menu-item:hover > .ast-menu-toggle, .ast-above-header-menu .sub-menu .menu-item.current-menu-item:focus > .ast-menu-toggle, .ast-above-header-menu .sub-menu .menu-item.current-menu-item.focus > .ast-menu-toggle' => array(
			'color' => esc_attr( $desktop_above_header_submenu_active_color ),
		),
		'.ast-above-header-menu .sub-menu .menu-item.current-menu-ancestor > .menu-link, .ast-above-header-menu .sub-menu .menu-item.current-menu-item > .menu-link, .ast-above-header-menu .sub-menu .menu-item.current-menu-ancestor:hover > .menu-link, .ast-above-header-menu .sub-menu .menu-item.current-menu-ancestor:focus > .menu-link, .ast-above-header-menu .sub-menu .menu-item.current-menu-ancestor.focus > .menu-link, .ast-above-header-menu .sub-menu .menu-item.current-menu-item:hover > .menu-link, .ast-above-header-menu .sub-menu .menu-item.current-menu-item:focus > .menu-link, .ast-above-header-menu .sub-menu .menu-item.current-menu-item.focus > .menu-link' => array(
			'color'            => esc_attr( $desktop_above_header_submenu_active_color ),
			'background-color' => esc_attr( $desktop_above_header_submenu_active_bg_color ),
		),
		'.ast-above-header-menu .sub-menu, .ast-header-break-point .ast-above-header-section-separated .ast-above-header-navigation ul ul' => array(
			'background-color' => esc_attr( $desktop_above_header_submenu_bg_color ),
		),
		'.ast-above-header-menu .sub-menu, .ast-above-header-menu .sub-menu .menu-link' => array(
			'color' => esc_attr( $desktop_above_header_submenu_text_color ),
		),
	);

	$tablet_colors = array(
		'.ast-above-header'                             => astra_get_responsive_background_obj( $above_header_bg_obj, 'tablet' ),
		'.ast-header-break-point .ast-above-header-merged-responsive .ast-above-header' => array(
			'background-color' => esc_attr( $tablet_background ),
		),
		'.ast-header-break-point .ast-above-header-section-separated .ast-above-header-navigation, .ast-header-break-point .ast-above-header-section-separated .ast-above-header-navigation ul' => array(
			'background-color' => esc_attr( $tablet_background ),
		),
		'.ast-above-header-menu,.ast-header-break-point .ast-above-header-section-separated .ast-above-header-navigation .ast-above-header-menu' => astra_get_responsive_background_obj( $above_header_menu_bg_obj, 'tablet' ),
		'.ast-above-header-section .user-select, .ast-above-header-section .widget, .ast-above-header-section .widget-title' => array(
			'color' => esc_attr( $tablet_above_header_text_color ),
		),

		'.ast-above-header-section .user-select a, .ast-above-header-section .widget a, .ast-header-break-point .ast-above-header-section .user-select a, .ast-above-header-section .ast-header-break-point .ast-above-header-section .user-select a' => array(
			'color' => esc_attr( $tablet_above_header_link_color ),
		),

		'.ast-above-header-section .search-field:focus' => array(
			'border-color' => esc_attr( $tablet_above_header_link_color ),
		),

		'.ast-above-header-section .user-select a:hover, .ast-above-header-section .widget a:hover, .ast-header-break-point .ast-above-header-section .user-select a:hover, .ast-above-header-section .ast-header-break-point .ast-above-header-section .user-select a:hover' => array(
			'color' => esc_attr( $tablet_above_header_link_h_color ),
		),

		'.ast-above-header-navigation a'                => array(
			'color' => esc_attr( $tablet_above_header_menu_color ),
		),

		'.ast-above-header-navigation .menu-item:hover > .menu-link' => array(
			'color'            => esc_attr( $tablet_above_header_menu_h_color ),
			'background-color' => esc_attr( $tablet_above_header_menu_h_bg_color ),
		),

		'.ast-above-header-navigation .menu-item.focus > .menu-link' => array(
			'color'            => esc_attr( $tablet_above_header_menu_h_color ),
			'background-color' => esc_attr( $tablet_above_header_menu_h_bg_color ),
		),

		'.ast-above-header-navigation .menu-item.current-menu-item > .menu-link, .ast-above-header-navigation .menu-item.current-menu-ancestor > .menu-link' => array(
			'color'            => esc_attr( $tablet_above_header_menu_active_color ),
			'background-color' => esc_attr( $tablet_above_header_menu_active_bg_color ),
		),

		/**
		 * Below Header Dropdown Navigation
		 */
		'.ast-above-header-menu .sub-menu .menu-item:hover > .menu-link, .ast-above-header-menu .sub-menu .menu-item:focus > .menu-link, .ast-above-header-menu .sub-menu .menu-item.focus > .menu-link,.ast-above-header-menu .sub-menu .menu-item:hover > .ast-menu-toggle, .ast-above-header-menu .sub-menu .menu-item:focus > .ast-menu-toggle, .ast-above-header-menu .sub-menu .menu-item.focus > .ast-menu-toggle' => array(
			'color'            => esc_attr( $tablet_above_header_submenu_hover_color ),
			'background-color' => esc_attr( $tablet_above_header_submenu_bg_hover_color ),
		),
		'.ast-above-header-menu .sub-menu .menu-item.current-menu-ancestor > .ast-menu-toggle, .ast-above-header-menu .sub-menu .menu-item.current-menu-item > .ast-menu-toggle, .ast-above-header-menu .sub-menu .menu-item.current-menu-ancestor:hover > .ast-menu-toggle, .ast-above-header-menu .sub-menu .menu-item.current-menu-ancestor:focus > .ast-menu-toggle, .ast-above-header-menu .sub-menu .menu-item.current-menu-ancestor.focus > .ast-menu-toggle, .ast-above-header-menu .sub-menu .menu-item.current-menu-item:hover > .ast-menu-toggle, .ast-above-header-menu .sub-menu .menu-item.current-menu-item:focus > .ast-menu-toggle, .ast-above-header-menu .sub-menu .menu-item.current-menu-item.focus > .ast-menu-toggle' => array(
			'color' => esc_attr( $tablet_above_header_submenu_active_color ),
		),
		'.ast-above-header-menu .sub-menu .menu-item.current-menu-ancestor > .menu-link, .ast-above-header-menu .sub-menu .menu-item.current-menu-item > .menu-link, .ast-above-header-menu .sub-menu .menu-item.current-menu-ancestor:hover > .menu-link, .ast-above-header-menu .sub-menu .menu-item.current-menu-ancestor:focus > .menu-link, .ast-above-header-menu .sub-menu .menu-item.current-menu-ancestor.focus > .menu-link, .ast-above-header-menu .sub-menu .menu-item.current-menu-item:hover > .menu-link, .ast-above-header-menu .sub-menu .menu-item.current-menu-item:focus > .menu-link, .ast-above-header-menu .sub-menu .menu-item.current-menu-item.focus > .menu-link' => array(
			'color'            => esc_attr( $tablet_above_header_submenu_active_color ),
			'background-color' => esc_attr( $tablet_above_header_submenu_active_bg_color ),
		),
		'.ast-above-header-menu .sub-menu, .ast-header-break-point .ast-above-header-section-separated .ast-above-header-navigation ul ul' => array(
			'background-color' => esc_attr( $tablet_above_header_submenu_bg_color ),
		),
		'.ast-above-header-menu .sub-menu, .ast-above-header-menu .sub-menu .menu-link' => array(
			'color' => esc_attr( $tablet_above_header_submenu_text_color ),
		),
	);

	$mobile_colors = array(
		'.ast-above-header'                             => astra_get_responsive_background_obj( $above_header_bg_obj, 'mobile' ),
		'.ast-header-break-point .ast-above-header-merged-responsive .ast-above-header' => array(
			'background-color' => esc_attr( $mobile_background ),
		),
		'.ast-header-break-point .ast-above-header-section-separated .ast-above-header-navigation, .ast-header-break-point .ast-above-header-section-separated .ast-above-header-navigation ul' => array(
			'background-color' => esc_attr( $mobile_background ),
		),
		'.ast-above-header-menu,.ast-header-break-point .ast-above-header-section-separated .ast-above-header-navigation .ast-above-header-menu' => astra_get_responsive_background_obj( $above_header_menu_bg_obj, 'mobile' ),
		'.ast-above-header-section .user-select, .ast-above-header-section .widget, .ast-above-header-section .widget-title' => array(
			'color' => esc_attr( $mobile_above_header_text_color ),
		),

		'.ast-above-header-section .user-select a, .ast-above-header-section .widget a, .ast-header-break-point .ast-above-header-section .user-select a, .ast-above-header-section .ast-header-break-point .ast-above-header-section .user-select a' => array(
			'color' => esc_attr( $mobile_above_header_link_color ),
		),

		'.ast-above-header-section .search-field:focus' => array(
			'border-color' => esc_attr( $mobile_above_header_link_color ),
		),

		'.ast-above-header-section .user-select a:hover, .ast-above-header-section .widget a:hover, .ast-header-break-point .ast-above-header-section .user-select a:hover, .ast-above-header-section .ast-header-break-point .ast-above-header-section .user-select a:hover' => array(
			'color' => esc_attr( $mobile_above_header_link_h_color ),
		),

		'.ast-above-header-navigation a'                => array(
			'color' => esc_attr( $mobile_above_header_menu_color ),
		),

		'.ast-above-header-navigation .menu-item:hover > .menu-link' => array(
			'color'            => esc_attr( $mobile_above_header_menu_h_color ),
			'background-color' => esc_attr( $mobile_above_header_menu_h_bg_color ),
		),

		'.ast-above-header-navigation .menu-item.focus > .menu-link' => array(
			'color'            => esc_attr( $mobile_above_header_menu_h_color ),
			'background-color' => esc_attr( $mobile_above_header_menu_h_bg_color ),
		),

		'.ast-above-header-navigation .menu-item.current-menu-item > .menu-link, .ast-above-header-navigation .menu-item.current-menu-ancestor > .menu-link' => array(
			'color'            => esc_attr( $mobile_above_header_menu_active_color ),
			'background-color' => esc_attr( $mobile_above_header_menu_active_bg_color ),
		),

		/**
		 * Below Header Dropdown Navigation
		 */
		'.ast-above-header-menu .sub-menu .menu-item:hover > .menu-link, .ast-above-header-menu .sub-menu .menu-item:focus > .menu-link, .ast-above-header-menu .sub-menu .menu-item.focus > .menu-link,.ast-above-header-menu .sub-menu .menu-item:hover > .ast-menu-toggle, .ast-above-header-menu .sub-menu .menu-item:focus > .ast-menu-toggle, .ast-above-header-menu .sub-menu .menu-item.focus > .ast-menu-toggle' => array(
			'color'            => esc_attr( $mobile_above_header_submenu_hover_color ),
			'background-color' => esc_attr( $mobile_above_header_submenu_bg_hover_color ),
		),
		'.ast-above-header-menu .sub-menu .menu-item.current-menu-ancestor > .ast-menu-toggle, .ast-above-header-menu .sub-menu .menu-item.current-menu-item > .ast-menu-toggle, .ast-above-header-menu .sub-menu .menu-item.current-menu-ancestor:hover > .ast-menu-toggle, .ast-above-header-menu .sub-menu .menu-item.current-menu-ancestor:focus > .ast-menu-toggle, .ast-above-header-menu .sub-menu .menu-item.current-menu-ancestor.focus > .ast-menu-toggle, .ast-above-header-menu .sub-menu .menu-item.current-menu-item:hover > .ast-menu-toggle, .ast-above-header-menu .sub-menu .menu-item.current-menu-item:focus > .ast-menu-toggle, .ast-above-header-menu .sub-menu .menu-item.current-menu-item.focus > .ast-menu-toggle' => array(
			'color' => esc_attr( $mobile_above_header_submenu_active_color ),
		),
		'.ast-above-header-menu .sub-menu .menu-item.current-menu-ancestor > .menu-link, .ast-above-header-menu .sub-menu .menu-item.current-menu-item > .menu-link, .ast-above-header-menu .sub-menu .menu-item.current-menu-ancestor:hover > .menu-link, .ast-above-header-menu .sub-menu .menu-item.current-menu-ancestor:focus > .menu-link, .ast-above-header-menu .sub-menu .menu-item.current-menu-ancestor.focus > .menu-link, .ast-above-header-menu .sub-menu .menu-item.current-menu-item:hover > .menu-link, .ast-above-header-menu .sub-menu .menu-item.current-menu-item:focus > .menu-link, .ast-above-header-menu .sub-menu .menu-item.current-menu-item.focus > .menu-link' => array(
			'color'            => esc_attr( $mobile_above_header_submenu_active_color ),
			'background-color' => esc_attr( $mobile_above_header_submenu_active_bg_color ),
		),
		'.ast-above-header-menu .sub-menu, .ast-header-break-point .ast-above-header-section-separated .ast-above-header-navigation ul ul' => array(
			'background-color' => esc_attr( $mobile_above_header_submenu_bg_color ),
		),
		'.ast-above-header-menu .sub-menu, .ast-above-header-menu .sub-menu .menu-link' => array(
			'color' => esc_attr( $mobile_above_header_submenu_text_color ),
		),
	);

	// Common options of Above Header.
	$parse_css .= astra_parse_css( $common_css_output );

	// Above Header Responsive Typography.
	$parse_css .= astra_parse_css( $tablet_typography_css, '', astra_addon_get_tablet_breakpoint() );
	$parse_css .= astra_parse_css( $mobile_typography_css, '', astra_addon_get_mobile_breakpoint() );

	// Above Header Responsive Colors.
	$parse_css .= astra_parse_css( $desktop_colors );
	$parse_css .= astra_parse_css( $tablet_colors, '', astra_addon_get_tablet_breakpoint() );
	$parse_css .= astra_parse_css( $mobile_colors, '', astra_addon_get_mobile_breakpoint() );

	/**
	 * Hide the default naviagtion markup for responsive devices.
	 * Once class .ast-header-break-point is added to the body below CSS will be override by the
	 * .ast-header-break-point class
	 */
	$astra_navigation = array(
		'.ast-above-header-navigation,.ast-above-header-hide-on-mobile .ast-above-header-wrap' => array(
			'display' => esc_attr( 'none' ),
		),
	);
	$parse_css       .= astra_parse_css( $astra_navigation, '', $header_break_point );

	// Above header border.
	$border = array(
		'.ast-desktop .ast-above-header-menu.submenu-with-border .sub-menu .menu-link' => array(
			'border-bottom-width' => ( true == $above_header_submenu_item_border ) ? '1px' : '0px',
			'border-style'        => 'solid',
			'border-color'        => esc_attr( $above_header_submenu_item_b_color ),
		),
		'.ast-desktop .ast-above-header-menu.submenu-with-border .sub-menu .sub-menu' => array(
			'top' => ( isset( $above_header_submenu_border['top'] ) && '' != $above_header_submenu_border['top'] ) ? astra_get_css_value( '-' . $above_header_submenu_border['top'], 'px' ) : '',
		),
		'.ast-desktop .ast-above-header-menu.submenu-with-border .sub-menu' => array(
			'border-top-width'    => astra_get_css_value( $above_header_submenu_border['top'], 'px' ),
			'border-left-width'   => astra_get_css_value( $above_header_submenu_border['left'], 'px' ),
			'border-right-width'  => astra_get_css_value( $above_header_submenu_border['right'], 'px' ),
			'border-bottom-width' => astra_get_css_value( $above_header_submenu_border['bottom'], 'px' ),
			'border-style'        => 'solid',
		),
	);

	// Submenu items goes outside?
	$submenu_border_for_left_align_menu = array(
		'.ast-above-header-menu .sub-menu .menu-item.ast-left-align-sub-menu:hover > .sub-menu, .ast-above-header-menu .sub-menu .menu-item.ast-left-align-sub-menu.focus > .sub-menu' => array(
			'margin-left' => ( ( isset( $above_header_submenu_border['left'] ) && '' != $above_header_submenu_border['left'] ) || isset( $above_header_submenu_border['right'] ) && '' != $above_header_submenu_border['right'] ) ? astra_get_css_value( '-' . ( $above_header_submenu_border['left'] + $above_header_submenu_border['right'] ), 'px' ) : '',
		),
	);

	/* Parse CSS from array() */
	$parse_css .= astra_parse_css( $border );
	// Submenu items goes outside?
	$parse_css .= astra_parse_css( $submenu_border_for_left_align_menu, astra_addon_get_tablet_breakpoint( '', 1 ) );

	if ( astra_addon_support_swap_mobile_above_header_sections() ) {

		$swap_mobile_above_header_sections = array(
			'.ast-header-break-point .ast-swap-above-header-sections .ast-above-header-section-1' => array(
				'order'           => 2,
				'justify-content' => 'flex-end',
			),
			'.ast-header-break-point .ast-swap-above-header-sections .ast-above-header-section-2' => array(
				'order'           => 1,
				'justify-content' => 'flex-start',
			),
		);
		$parse_css                        .= astra_parse_css( $swap_mobile_above_header_sections );
	}

	// Add Inline style.
	return $dynamic_css . $parse_css;
}

/**
 * Whether to fix the Swap Sections on Mobile Devices not working case or not.
 * As this is frontend reflecting change added this backwards for existing users.
 *
 * @since 3.5.7
 * @return boolean false if it is an existing user, true if not.
 */
function astra_addon_support_swap_mobile_above_header_sections() {
	$astra_settings                                        = get_option( ASTRA_THEME_SETTINGS );
	$astra_settings['support-swap-mobile-header-sections'] = isset( $astra_settings['support-swap-mobile-header-sections'] ) ? false : true;
	return apply_filters( 'astra_apply_swap_mobile_header_sections_css', $astra_settings['support-swap-mobile-header-sections'] );
}
