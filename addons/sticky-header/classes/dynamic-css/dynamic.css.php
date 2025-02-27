<?php
/**
 * Transparent Header - Dynamic CSS
 *
 * @package Astra Addon
 */

add_filter( 'astra_addon_dynamic_css', 'astra_ext_sticky_header_dynamic_css', 30 );

/**
 * Dynamic CSS
 *
 * @param  string $dynamic_css          Astra Dynamic CSS.
 * @param  string $dynamic_css_filtered Astra Dynamic CSS Filters.
 * @return string
 */
function astra_ext_sticky_header_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' ) {

	/**
	 * Set colors
	 *
	 * If colors extension is_active then get color from it.
	 * Else set theme default colors.
	 */
	$stick_header            = astra_get_option_meta( 'stick-header-meta' );
	$stick_header_main_meta  = astra_get_option_meta( 'header-main-stick-meta' );
	$stick_header_above_meta = astra_get_option_meta( 'header-above-stick-meta' );
	$stick_header_below_meta = astra_get_option_meta( 'header-below-stick-meta' );

	$stick_header_main  = astra_get_option( 'header-main-stick' );
	$stick_header_above = astra_get_option( 'header-above-stick' );
	$stick_header_below = astra_get_option( 'header-below-stick' );

	$sticky_header_style   = astra_get_option( 'sticky-header-style' );
	$sticky_hide_on_scroll = astra_get_option( 'sticky-hide-on-scroll' );

	$sticky_header_logo_width = astra_get_option( 'sticky-header-logo-width' );
	// Old Log Width Option that we are no loginer using it our theme.
	$header_logo_width            = astra_get_option( 'ast-header-logo-width' );
	$header_responsive_logo_width = astra_get_option( 'ast-header-responsive-logo-width' );

	$header_color_site_title = '#222';
	$text_color              = astra_get_option( 'text-color' );
	$link_color              = astra_get_option( 'link-color' );

	$sticky_header_logo_different = astra_get_option( 'different-sticky-logo' );
	$sticky_header_logo           = astra_get_option( 'sticky-header-logo' );

	// Compatible with header full width.
	$header_break_point = astra_header_break_point();
	$astra_header_width = astra_get_option( 'header-main-layout-width' );

	// Sticky Header Background colors.
	$text_color = astra_get_option( 'text-color' );
	$link_color = astra_get_option( 'link-color' );

	$desktop_sticky_header_bg_color = astra_get_prop( astra_get_option( 'sticky-header-bg-color-responsive' ), 'desktop' );
	$tablet_sticky_header_bg_color  = astra_get_prop( astra_get_option( 'sticky-header-bg-color-responsive' ), 'tablet' );
	$mobile_sticky_header_bg_color  = astra_get_prop( astra_get_option( 'sticky-header-bg-color-responsive' ), 'mobile' );

	$sticky_header_bg_blur           = astra_get_option( 'sticky-header-bg-blur' );
	$sticky_header_bg_blur_intensity = astra_get_option( 'sticky-header-bg-blur-intensity' );

	$sticky_header_menu_bg_color = astra_get_option( 'sticky-header-menu-bg-color-responsive' );

	$desktop_sticky_header_color_site_title = astra_get_prop( astra_get_option( 'sticky-header-color-site-title-responsive' ), 'desktop', '#222' );
	$tablet_sticky_header_color_site_title  = astra_get_prop( astra_get_option( 'sticky-header-color-site-title-responsive' ), 'tablet' );
	$mobile_sticky_header_color_site_title  = astra_get_prop( astra_get_option( 'sticky-header-color-site-title-responsive' ), 'mobile' );

	$sticky_header_color_h_site_title = astra_get_option( 'sticky-header-color-h-site-title-responsive' );

	$desktop_sticky_header_color_site_tagline = astra_get_prop( astra_get_option( 'sticky-header-color-site-tagline-responsive' ), 'desktop', $text_color );
	$tablet_sticky_header_color_site_tagline  = astra_get_prop( astra_get_option( 'sticky-header-color-site-tagline-responsive' ), 'tablet' );
	$mobile_sticky_header_color_site_tagline  = astra_get_prop( astra_get_option( 'sticky-header-color-site-tagline-responsive' ), 'mobile' );

	$desktop_sticky_primary_menu_color = astra_get_prop( astra_get_option( 'sticky-header-menu-color-responsive' ), 'desktop' );
	$tablet_sticky_primary_menu_color  = astra_get_prop( astra_get_option( 'sticky-header-menu-color-responsive' ), 'tablet' );
	$mobile_sticky_primary_menu_color  = astra_get_prop( astra_get_option( 'sticky-header-menu-color-responsive' ), 'mobile' );

	$desktop_sticky_primary_menu_h_color = astra_get_prop( astra_get_option( 'sticky-header-menu-h-color-responsive' ), 'desktop' );
	$tablet_sticky_primary_menu_h_color  = astra_get_prop( astra_get_option( 'sticky-header-menu-h-color-responsive' ), 'tablet' );
	$mobile_sticky_primary_menu_h_color  = astra_get_prop( astra_get_option( 'sticky-header-menu-h-color-responsive' ), 'mobile' );

	$sticky_header_menu_h_a_bg_color = astra_get_option( 'sticky-header-menu-h-a-bg-color-responsive' );

	$sticky_header_submenu_bg_color      = astra_get_option( 'sticky-header-submenu-bg-color-responsive' );
	$sticky_primary_submenu_color        = astra_get_option( 'sticky-header-submenu-color-responsive' );
	$sticky_primary_submenu_h_color      = astra_get_option( 'sticky-header-submenu-h-color-responsive' );
	$sticky_primary_submenu_h_a_bg_color = astra_get_option( 'sticky-header-submenu-h-a-bg-color-responsive' );

	$sticky_header_content_section_text_color   = astra_get_option( 'sticky-header-content-section-text-color-responsive' );
	$sticky_header_content_section_link_color   = astra_get_option( 'sticky-header-content-section-link-color-responsive' );
	$sticky_header_content_section_link_h_color = astra_get_option( 'sticky-header-content-section-link-h-color-responsive' );

	$header_custom_button_style                 = astra_get_option( 'header-main-rt-section-button-style' );
	$header_custom_sticky_button_text_color     = astra_get_option( 'header-main-rt-sticky-section-button-text-color' );
	$header_custom_sticky_button_text_h_color   = astra_get_option( 'header-main-rt-sticky-section-button-text-h-color' );
	$header_custom_sticky_button_back_color     = astra_get_option( 'header-main-rt-sticky-section-button-back-color' );
	$header_custom_sticky_button_back_h_color   = astra_get_option( 'header-main-rt-sticky-section-button-back-h-color' );
	$header_custom_sticky_button_spacing        = astra_get_option( 'header-main-rt-sticky-section-button-padding' );
	$header_custom_sticky_button_radius         = astra_get_option( 'header-main-rt-sticky-section-button-border-radius' );
	$header_custom_sticky_button_border_color   = astra_get_option( 'header-main-rt-sticky-section-button-border-color' );
	$header_custom_sticky_button_border_h_color = astra_get_option( 'header-main-rt-sticky-section-button-border-h-color' );
	$header_custom_sticky_button_border_size    = astra_get_option( 'header-main-rt-sticky-section-button-border-size' );

	$default_header_site_title_color       = astra_get_option( 'header-color-site-title' );
	$default_header_site_title_hover_color = astra_get_option( 'header-color-h-site-title' );
	$default_header_site_tagline_color     = astra_get_option( 'header-color-site-tagline' );

	if ( ! $stick_header_main && ! $stick_header_above && ! $stick_header_below && ( 'disabled' !== $stick_header && empty( $stick_header ) && ( empty( $stick_header_above_meta ) || empty( $stick_header_below_meta ) || empty( $stick_header_main_meta ) ) ) ) {
		return $dynamic_css;
	}

	$sticky_header_woo_cart_color       = astra_get_option( 'sticky-header-woo-cart-color' );
	$sticky_header_woo_cart_hover_color = astra_get_option( 'sticky-header-woo-cart-hover-color' );

	$sticky_header_woo_cart_count_color       = astra_get_option( 'sticky-header-woo-cart-count-color' );
	$sticky_header_woo_cart_count_hover_color = astra_get_option( 'sticky-header-woo-cart-count-hover-color' );

	$parse_css = '';

	/**
	 * Sticky Header
	 *
	 * [1]. Apply default colors from theme for sticky header.
	 * [2]. Hide Sticky Header logo if Sticky Header logo is not enabled.
	 * [3]. Sticky Header Logo responsive widths.
	 * [4]. Compatible with Header Width.
	 * [5]. Sticky Header & Sticky Header Primary menu background color.
	 * [6]. Cart icon color for transparent sticky header.
	 */

	/**
	 * [1]. Apply default colors from theme for sticky header.
	 */
	if ( ! Astra_Ext_Extension::is_active( 'colors-and-background' ) ) {
		$css_output = array(
			'#ast-fixed-header .main-header-bar .site-title a, #ast-fixed-header .main-header-bar .site-title a:focus, #ast-fixed-header .main-header-bar .site-title a:hover, #ast-fixed-header .main-header-bar .site-title a:visited, .main-header-bar.ast-sticky-active .site-title a, .main-header-bar.ast-sticky-active .site-title a:focus, .main-header-bar.ast-sticky-active .site-title a:hover, .main-header-bar.ast-sticky-active .site-title a:visited' => array(
				'color' => esc_attr( $header_color_site_title ),
			),
			'#ast-fixed-header .main-header-bar .site-description, .main-header-bar.ast-sticky-active .site-description' => array(
				'color' => esc_attr( $text_color ),
			),
			'.ast-sticky-active .main-header-menu > .menu-item.current-menu-item > .menu-link, .ast-sticky-active .main-header-menu >.menu-item.current-menu-ancestor > .menu-link, .main-header-bar.ast-sticky-active .main-header-menu > .menu-item.current-menu-item > .menu-link, .main-header-bar.ast-sticky-active .main-header-menu >.menu-item.current-menu-ancestor > .menu-link' => array(
				'color' => esc_attr( $link_color ),
			),
			'.ast-sticky-active .main-header-menu, .ast-sticky-active .main-header-menu > .menu-item > .menu-link, .ast-sticky-active .ast-masthead-custom-menu-items, .ast-sticky-active .ast-masthead-custom-menu-items a, .main-header-bar.ast-sticky-active, .main-header-bar.ast-sticky-active .main-header-menu > .menu-item > .menu-link, .main-header-bar.ast-sticky-active .ast-masthead-custom-menu-items, .main-header-bar.ast-sticky-active .ast-masthead-custom-menu-items a' => array(
				'color' => esc_attr( $text_color ),
			),
			'.ast-sticky-active .main-header-menu .menu-link:hover, .ast-sticky-active .main-header-menu .menu-item:hover > .menu-link, .ast-sticky-active .main-header-menu .menu-item.focus > .menu-link, .main-header-bar.ast-sticky-active .main-header-menu .menu-item:hover > .menu-link, .main-header-bar.ast-sticky-active .main-header-menu .menu-item.focus > .menu-link' => array(
				'color' => esc_attr( $link_color ),
			),
			'.ast-sticky-active .main-header-menu .ast-masthead-custom-menu-items a:hover, .ast-sticky-active .main-header-menu .menu-item:hover > .ast-menu-toggle, .ast-sticky-active .main-header-menu .menu-item.focus > .ast-menu-toggle,.main-header-bar.ast-sticky-active .main-header-menu .menu-item:hover > .ast-menu-toggle,.main-header-bar.ast-sticky-active .main-header-menu .menu-item.focus > .ast-menu-toggle' => array(
				'color' => esc_attr( $link_color ),
			),
		);

		/* Parse CSS from array() */
		$parse_css .= astra_parse_css( $css_output );
	}

	/**
	 * [2]. Hide Sticky Header logo if Sticky Header logo is not enabled.
	 */
	if ( '0' === $sticky_header_logo_different && '' != $sticky_header_logo ) {
		$css_output = array(
			'.ast-sticky-active .site-logo-img .custom-logo' => array(
				'display' => 'none',
			),
		);
		$parse_css .= astra_parse_css( $css_output );
	}

	/**
	 *  Add's logo color when sticky header is enabled.
	 */
	if ( astra_get_option( 'sticky-header-builder-logo-color' ) ) {

		$css_output = array(
			'.ast-sticky-active .site-logo-img img' => array(
				'filter' => 'url(#ast-img-color-filter-3)',
			),
		);
		$parse_css .= astra_parse_css( $css_output );
	}

	/**
	 *  Added Display none to submenu when sticky Animation is enabled.
	 *
	 * @since 4.7.2
	 */
	if ( 'slide' === $sticky_header_style || 'fade' === $sticky_header_style ) {

		$css_outputs = array(
			'.ast-primary-sticky-header-active.ast-main-header-nav-open #masthead > #ast-desktop-header ul#ast-desktop-toggle-menu' => array(
				'display' => 'none',
			),
		);
		$parse_css  .= astra_parse_css( $css_outputs );
	}

	/**
	 * [3]. Sticky Header Logo responsive widths
	 */
	// Desktop Sticky Header Logo width.
	$desktop_css_output = array(
		'#masthead .site-logo-img .sticky-custom-logo .astra-logo-svg, .site-logo-img .sticky-custom-logo .astra-logo-svg, .ast-sticky-main-shrink .ast-sticky-shrunk .site-logo-img .astra-logo-svg' => array(
			'max-width' => astra_get_css_value( $sticky_header_logo_width['desktop'], 'px' ),
			'width'     => astra_get_css_value( $sticky_header_logo_width['desktop'], 'px !important' ),
		),
		'.ast-hfb-header .site-logo-img .sticky-custom-logo img' => array(
			'max-width' => astra_get_css_value( $sticky_header_logo_width['desktop'], 'px !important' ),
			'width'     => astra_get_css_value( $sticky_header_logo_width['desktop'], 'px' ),
		),
	);
	$parse_css         .= astra_parse_css( $desktop_css_output );

	// Tablet Sticky Header Logo width.
	$tablet_css_output = array(
		'#masthead .site-logo-img .sticky-custom-logo .astra-logo-svg, .site-logo-img .sticky-custom-logo .astra-logo-svg, .ast-sticky-main-shrink .ast-sticky-shrunk .site-logo-img .astra-logo-svg' => array(
			'max-width' => astra_get_css_value( $sticky_header_logo_width['tablet'], 'px' ),
			'width'     => astra_get_css_value( $sticky_header_logo_width['tablet'], 'px' ),
		),
		'.ast-hfb-header .site-logo-img .sticky-custom-logo img' => array(
			'max-width' => astra_get_css_value( $sticky_header_logo_width['tablet'], 'px !important' ),
			'width'     => astra_get_css_value( $sticky_header_logo_width['tablet'], 'px' ),
		),
	);
	$parse_css        .= astra_parse_css( $tablet_css_output, '', astra_addon_get_tablet_breakpoint() );

	// Mobile Sticky Header Logo width.
	$mobile_css_output = array(
		'#masthead .site-logo-img .sticky-custom-logo .astra-logo-svg, .site-logo-img .sticky-custom-logo .astra-logo-svg, .ast-sticky-main-shrink .ast-sticky-shrunk .site-logo-img .astra-logo-svg' => array(
			'max-width' => astra_get_css_value( $sticky_header_logo_width['mobile'], 'px' ),
			'width'     => astra_get_css_value( $sticky_header_logo_width['mobile'], 'px !important' ),
		),
		'.ast-hfb-header .site-logo-img .sticky-custom-logo img' => array(
			'max-width' => astra_get_css_value( $sticky_header_logo_width['mobile'], 'px !important' ),
			'width'     => astra_get_css_value( $sticky_header_logo_width['mobile'], 'px' ),
		),
	);
	$parse_css        .= astra_parse_css( $mobile_css_output, '', astra_addon_get_mobile_breakpoint( '1' ) );

	// Theme Main Logo width option for responsive devices.
	if ( is_array( $header_responsive_logo_width ) ) {
		/* Responsive main logo width */
		$responsive_logo_output = array(
			'#masthead .site-logo-img .astra-logo-svg, .ast-header-break-point #ast-fixed-header .site-logo-img .custom-logo-link img ' => array(
				'max-width' => astra_get_css_value( $header_responsive_logo_width['desktop'], 'px' ),
			),
		);
		$parse_css             .= astra_parse_css( $responsive_logo_output );

		$responsive_logo_output_tablet = array(
			'#masthead .site-logo-img .astra-logo-svg, .ast-header-break-point #ast-fixed-header .site-logo-img .custom-logo-link img ' => array(
				'max-width' => astra_get_css_value( $header_responsive_logo_width['tablet'], 'px' ),
			),
		);
		$parse_css                    .= astra_parse_css( $responsive_logo_output_tablet, '', astra_addon_get_tablet_breakpoint() );

		$responsive_logo_output_mobile = array(
			'#masthead .site-logo-img .astra-logo-svg, .ast-header-break-point #ast-fixed-header .site-logo-img .custom-logo-link img ' => array(
				'max-width' => astra_get_css_value( $header_responsive_logo_width['mobile'], 'px' ),
			),
		);
		$parse_css                    .= astra_parse_css( $responsive_logo_output_mobile, '', astra_addon_get_mobile_breakpoint( '1' ) );
	} else {
		/* Old main logo width */
		$logo_output = array(
			'#masthead .site-logo-img .astra-logo-svg' => array(
				'width' => astra_get_css_value( $header_logo_width, 'px' ),
			),
		);
		/* Parse CSS from array() */
		$parse_css .= astra_parse_css( $logo_output );
	}

	/**
	 * [4]. Compatible with Header Width
	 */
	if ( 'content' !== $astra_header_width ) {

		$general_global_responsive = array(
			'#ast-fixed-header .ast-container' => array(
				'max-width'     => '100%',
				'padding-left'  => '35px',
				'padding-right' => '35px',
			),
		);
		$padding_below_breakpoint  = array(
			'#ast-fixed-header .ast-container' => array(
				'padding-left'  => '20px',
				'padding-right' => '20px',
			),
		);

		/* Parse CSS from array()*/
		$parse_css .= astra_parse_css( $general_global_responsive );
		$parse_css .= astra_parse_css( $padding_below_breakpoint, '', $header_break_point );
	}

	/**
	 * [5]. Stciky Header & Sticky Header Primary menu colors.
	 */
	if ( 'none' === $sticky_header_style && ! $sticky_hide_on_scroll ) {
		$desktop_css_output = array(

			/**
			 * Header
			 */
			'.ast-transparent-header.ast-primary-sticky-header-active .main-header-bar-wrap .main-header-bar, .ast-primary-sticky-header-active .main-header-bar-wrap .main-header-bar, .ast-primary-sticky-header-active.ast-header-break-point .main-header-bar-wrap .main-header-bar, .ast-transparent-header.ast-primary-sticky-enabled .ast-main-header-wrap .main-header-bar.ast-header-sticked, .ast-primary-sticky-enabled .ast-main-header-wrap .main-header-bar.ast-header-sticked, .ast-primary-sticky-header-ast-primary-sticky-enabled .ast-main-header-wrap .main-header-bar.ast-header-sticked'                      => array(
				'background'              => esc_attr( $desktop_sticky_header_bg_color ),
				'backdrop-filter'         => $sticky_header_bg_blur && $sticky_header_bg_blur_intensity ? 'blur(' . esc_attr( $sticky_header_bg_blur_intensity ) . 'px )' : 'unset',
				'-webkit-backdrop-filter' => $sticky_header_bg_blur && $sticky_header_bg_blur_intensity ? 'blur(' . esc_attr( $sticky_header_bg_blur_intensity ) . 'px)' : 'unset',
			),

			/**
			 * Primary Header Menu
			 */
			'.ast-primary-sticky-header-active .main-header-menu .ast-masthead-custom-menu-items a:hover, .ast-primary-sticky-header-active .main-header-menu .menu-item:hover > .ast-menu-toggle, .ast-primary-sticky-header-active .main-header-menu .menu-item.focus > .ast-menu-toggle' => array(
				'color' => esc_attr( $desktop_sticky_primary_menu_h_color ),
			),
			'.ast-primary-sticky-header-active .main-header-menu, .ast-primary-sticky-header-active .ast-builder-menu-2 .main-header-menu .menu-item > .menu-link, .ast-primary-sticky-header-active .ast-header-custom-item, .ast-header-custom-item a, .ast-primary-sticky-header-active li.ast-masthead-custom-menu-items, .ast-primary-sticky-header-active li.ast-masthead-custom-menu-items a, .ast-primary-sticky-header-active.ast-advanced-headers .main-header-menu > .menu-item > .menu-link' => array(
				'color' => esc_attr( $desktop_sticky_primary_menu_color ),
			),
			'.ast-primary-sticky-header-active .ast-masthead-custom-menu-items .ast-inline-search form' => array(
				'border-color' => esc_attr( $desktop_sticky_primary_menu_color ),
			),

			/**
			 * Primary Submenu
			 */
			'.ast-primary-sticky-header-active .main-navigation ul .sub-menu, .ast-header-break-point.ast-primary-sticky-header-active .main-header-bar-navigation .main-header-menu .sub-menu' => array(
				'background-color' => esc_attr( $sticky_header_submenu_bg_color['desktop'] ),
			),
			'.ast-primary-sticky-header-active .main-header-bar-navigation .main-header-menu .sub-menu, .ast-primary-sticky-header-active .main-header-bar-navigation .main-header-menu .sub-menu .menu-item > .ast-menu-toggle' => array(
				'color' => esc_attr( $sticky_primary_submenu_color['desktop'] ),
			),
			'.ast-primary-sticky-header-active .main-header-menu .sub-menu .menu-link:hover, .ast-primary-sticky-header-active .main-header-bar-navigation .main-header-menu .sub-menu .menu-item:hover > .menu-link, .ast-primary-sticky-header-active .main-header-menu .sub-menu .menu-item.focus > .menu-link' => array(
				'color'            => esc_attr( $sticky_primary_submenu_h_color['desktop'] ),
				'background-color' => esc_attr( $sticky_primary_submenu_h_a_bg_color['desktop'] ),
			),
			'.ast-primary-sticky-header-active .main-header-bar-navigation .main-header-menu .sub-menu .menu-item:hover > .ast-menu-toggle, .ast-primary-sticky-header-active .main-header-bar-navigation .main-header-menu .sub-menu .menu-item.focus > .ast-menu-toggle' => array(
				'color' => esc_attr( $sticky_primary_submenu_h_color['desktop'] ),
			),
			'.ast-primary-sticky-header-active .main-header-bar-navigation .main-header-menu .sub-menu .menu-item.current-menu-ancestor > .menu-link' => array(
				'color'            => esc_attr( $sticky_primary_submenu_h_color['desktop'] ),
				'background-color' => esc_attr( $sticky_primary_submenu_h_a_bg_color['desktop'] ),
			),

			// Content Section text color.
			'.ast-primary-sticky-header-active div.ast-masthead-custom-menu-items, .ast-primary-sticky-header-active div.ast-masthead-custom-menu-items .widget, .ast-primary-sticky-header-active div.ast-masthead-custom-menu-items .widget-title' => array(
				'color' => esc_attr( $sticky_header_content_section_text_color['desktop'] ),
			),
			// Content Section link color.
			'.ast-primary-sticky-header-active div.ast-masthead-custom-menu-items a, .ast-primary-sticky-header-active div.ast-masthead-custom-menu-items .widget a' => array(
				'color' => esc_attr( $sticky_header_content_section_link_color['desktop'] ),
			),
			// Content Section link hover color.
			'.ast-primary-sticky-header-active div.ast-masthead-custom-menu-items a:hover, .ast-primary-sticky-header-active div.ast-masthead-custom-menu-items .widget a:hover' => array(
				'color' => esc_attr( $sticky_header_content_section_link_h_color['desktop'] ),
			),
		);

		$old_sticky_header_desktop_output = array(
			'.ast-primary-sticky-header-active .site-title a, .ast-primary-sticky-header-active .site-title a:focus, .ast-primary-sticky-header-active .site-title a:hover, .ast-primary-sticky-header-active .site-title a:visited' => array(
				'color' => esc_attr( $desktop_sticky_header_color_site_title ),
			),
			'.ast-primary-sticky-header-active .site-header .site-title a:hover'           => array(
				'color' => esc_attr( $sticky_header_color_h_site_title['desktop'] ),
			),
			'.ast-primary-sticky-header-active .site-header .site-description'             => array(
				'color' => esc_attr( $desktop_sticky_header_color_site_tagline ),
			),
			'.ast-primary-sticky-header-active .main-header-bar-navigation .main-header-menu, .ast-flyout-menu-enable.ast-header-break-point .main-header-bar-navigation .site-navigation, .ast-fullscreen-menu-enable.ast-header-break-point .main-header-bar-navigation .site-navigation' => array(
				'background-color' => esc_attr( $sticky_header_menu_bg_color['desktop'] ),
			),
			'.ast-primary-sticky-header-active .main-header-menu .menu-item:hover > .menu-link, .ast-primary-sticky-header-active .ast-builder-menu-1 .main-header-menu .menu-item.current-menu-item > .menu-link, .ast-primary-sticky-header-active .ast-builder-menu-2 .main-header-menu .menu-item.current-menu-item > .menu-link, .ast-primary-sticky-header-active .main-header-menu .menu-item.current-menu-ancestor > .menu-link' => array(
				'color'            => esc_attr( $desktop_sticky_primary_menu_h_color ),
				'background-color' => esc_attr( $sticky_header_menu_h_a_bg_color['desktop'] ),
			),
			'.ast-primary-sticky-header-active .ast-builder-menu-1 .main-header-menu .menu-item.current-menu-item > .menu-link:hover, .ast-primary-sticky-header-active .ast-builder-menu-2 .main-header-menu .menu-item.current-menu-item > .menu-link:hover, .ast-header-custom-item a:hover, .ast-primary-sticky-header-active .ast-builder-menu-1 .main-header-menu .menu-item > .menu-link:hover, .ast-primary-sticky-header-active .main-header-menu, .ast-primary-sticky-header-active .ast-builder-menu-2 .main-header-menu .menu-item > .menu-link:hover .ast-primary-sticky-header-active .main-header-menu .menu-item.focus > .menu-link, .ast-primary-sticky-header-active.ast-advanced-headers .main-header-menu > .menu-item > .menu-link:hover, .ast-primary-sticky-header-active.ast-advanced-headers .main-header-menu > .menu-item > .menu-link:focus' => array(
				'color'            => esc_attr( $desktop_sticky_primary_menu_h_color ),
				'background-color' => esc_attr( $sticky_header_menu_h_a_bg_color['desktop'] ),
			),
		);

		$tablet_css_output = array(

			/**
			 * Header
			 */
			'.ast-transparent-header.ast-primary-sticky-header-active .ast-main-header-wrap .main-header-bar, .ast-primary-sticky-header-active .ast-main-header-wrap .main-header-bar, .ast-primary-sticky-header-active.ast-header-break-point .ast-main-header-wrap .main-header-bar'                      => array(
				'background' => esc_attr( $tablet_sticky_header_bg_color ),
			),
			/**
			 * Primary Header Menu
			 */
			'.ast-primary-sticky-header-active .main-header-bar-navigation .main-header-menu, .ast-flyout-menu-enable.ast-header-break-point .main-header-bar-navigation .site-navigation, .ast-fullscreen-menu-enable.ast-header-break-point .main-header-bar-navigation .site-navigation' => array(
				'background-color' => esc_attr( $sticky_header_menu_bg_color['tablet'] ),
			),
			'.ast-primary-sticky-header-active .ast-builder-menu-1 .main-header-menu .menu-item.current-menu-item > .menu-link, .ast-primary-sticky-header-active .ast-builder-menu-2 .main-header-menu .menu-item.current-menu-item > .menu-link, .ast-primary-sticky-header-active .main-header-menu .menu-item.current-menu-ancestor > .menu-link' => array(
				'color'            => esc_attr( $tablet_sticky_primary_menu_h_color ),
				'background-color' => esc_attr( $sticky_header_menu_h_a_bg_color['tablet'] ),
			),
			'.ast-primary-sticky-header-active .ast-builder-menu-1 .main-header-menu .menu-item.current-menu-item > .menu-link:hover, .ast-primary-sticky-header-active .ast-builder-menu-2 .main-header-menu .menu-item.current-menu-item > .menu-link:hover, .ast-header-custom-item a:hover, .ast-primary-sticky-header-active .main-header-menu .menu-item:hover > .menu-link, .ast-primary-sticky-header-active .main-header-menu .menu-item.focus > .menu-link, .ast-primary-sticky-header-active.ast-advanced-headers .main-header-menu > .menu-item > .menu-link:hover, .ast-primary-sticky-header-active.ast-advanced-headers .main-header-menu > .menu-item > .menu-link:focus' => array(
				'background-color' => esc_attr( $sticky_header_menu_h_a_bg_color['tablet'] ),
				'color'            => esc_attr( $tablet_sticky_primary_menu_h_color ),
			),
			'.ast-primary-sticky-header-active .main-header-menu .ast-masthead-custom-menu-items a:hover, .ast-primary-sticky-header-active .main-header-menu .menu-item:hover > .ast-menu-toggle, .ast-primary-sticky-header-active .main-header-menu .menu-item.focus > .ast-menu-toggle' => array(
				'color' => esc_attr( $tablet_sticky_primary_menu_h_color ),
			),

			'.ast-primary-sticky-header-active .main-header-menu, .ast-primary-sticky-header-active .main-header-menu .menu-link, .ast-primary-sticky-header-active .ast-header-custom-item, .ast-header-custom-item a, .ast-primary-sticky-header-active li.ast-masthead-custom-menu-items, .ast-primary-sticky-header-active li.ast-masthead-custom-menu-items a, .ast-primary-sticky-header-active.ast-advanced-headers .main-header-menu > .menu-item > .menu-link' => array(
				'color' => esc_attr( $tablet_sticky_primary_menu_color ),
			),

			'.ast-primary-sticky-header-active .ast-masthead-custom-menu-items .ast-inline-search form' => array(
				'border-color' => esc_attr( $tablet_sticky_primary_menu_color ),
			),
			/**
			 * Primary Submenu
			 */
			'.ast-primary-sticky-header-active .main-navigation ul .sub-menu, .ast-header-break-point.ast-primary-sticky-header-active .main-header-bar-navigation .main-header-menu .sub-menu' => array(
				'background-color' => esc_attr( $sticky_header_submenu_bg_color['tablet'] ),
			),
			'.ast-primary-sticky-header-active .main-header-bar-navigation .main-header-menu .sub-menu, .ast-primary-sticky-header-active .main-header-bar-navigation .main-header-menu .sub-menu .menu-item > .ast-menu-toggle' => array(
				'color' => esc_attr( $sticky_primary_submenu_color['tablet'] ),
			),
			'.ast-primary-sticky-header-active .main-header-menu .sub-menu .menu-link:hover, .ast-primary-sticky-header-active .main-header-bar-navigation .main-header-menu .sub-menu .menu-item:hover > .menu-link, .ast-primary-sticky-header-active .main-header-menu .sub-menu .menu-item.focus > .menu-link' => array(
				'color'            => esc_attr( $sticky_primary_submenu_h_color['tablet'] ),
				'background-color' => esc_attr( $sticky_primary_submenu_h_a_bg_color['tablet'] ),
			),
			'.ast-primary-sticky-header-active .main-header-bar-navigation .main-header-menu .sub-menu .menu-item:hover > .ast-menu-toggle, .ast-primary-sticky-header-active .main-header-bar-navigation .main-header-menu .sub-menu .menu-item.focus > .ast-menu-toggle' => array(
				'color' => esc_attr( $sticky_primary_submenu_h_color['tablet'] ),
			),
			'.ast-primary-sticky-header-active .main-header-menu .sub-menu .menu-item.current-menu-item > .menu-link, .ast-primary-sticky-header-active .main-header-menu .sub-menu .menu-item.current-menu-ancestor > .menu-link' => array(
				'color'            => esc_attr( $sticky_primary_submenu_h_color['tablet'] ),
				'background-color' => esc_attr( $sticky_primary_submenu_h_a_bg_color['tablet'] ),
			),

			// Content Section text color.
			'.ast-primary-sticky-header-active div.ast-masthead-custom-menu-items, .ast-primary-sticky-header-active div.ast-masthead-custom-menu-items .widget, .ast-primary-sticky-header-active div.ast-masthead-custom-menu-items .widget-title' => array(
				'color' => esc_attr( $sticky_header_content_section_text_color['tablet'] ),
			),
			// Content Section link color.
			'.ast-primary-sticky-header-active div.ast-masthead-custom-menu-items a, .ast-primary-sticky-header-active div.ast-masthead-custom-menu-items .widget a' => array(
				'color' => esc_attr( $sticky_header_content_section_link_color['tablet'] ),
			),
			// Content Section link hover color.
			'.ast-primary-sticky-header-active div.ast-masthead-custom-menu-items a:hover, .ast-primary-sticky-header-active div.ast-masthead-custom-menu-items .widget a:hover' => array(
				'color' => esc_attr( $sticky_header_content_section_link_h_color['tablet'] ),
			),
		);

		$old_sticky_header_tablet_output = array(
			'.ast-primary-sticky-header-active .site-title a, .ast-primary-sticky-header-active .site-title a:focus, .ast-primary-sticky-header-active .site-title a:hover, .ast-primary-sticky-header-active .site-title a:visited' => array(
				'color' => esc_attr( $tablet_sticky_header_color_site_title ),
			),
			'.ast-primary-sticky-header-active .site-header .site-title a:hover'           => array(
				'color' => esc_attr( $sticky_header_color_h_site_title['tablet'] ),
			),
			'.ast-primary-sticky-header-active .site-header .site-description'             => array(
				'color' => esc_attr( $tablet_sticky_header_color_site_tagline ),
			),
		);

		$mobile_css_output = array(

			/**
			 * Header
			 */
			'.ast-transparent-header.ast-primary-sticky-header-active .ast-main-header-wrap .main-header-bar, .ast-primary-sticky-header-active .ast-main-header-wrap .main-header-bar, .ast-primary-sticky-header-active.ast-header-break-point .ast-main-header-wrap .main-header-bar'                      => array(
				'background' => esc_attr( $mobile_sticky_header_bg_color ),
			),
			/**
			 * Primary Header Menu
			 */
			'.ast-primary-sticky-header-active .main-header-bar-navigation .main-header-menu, .ast-flyout-menu-enable.ast-header-break-point .main-header-bar-navigation .site-navigation, .ast-fullscreen-menu-enable.ast-header-break-point .main-header-bar-navigation .site-navigation' => array(
				'background-color' => esc_attr( $sticky_header_menu_bg_color['mobile'] ),
			),
			'.ast-primary-sticky-header-active .ast-builder-menu-1 .main-header-menu .menu-item.current-menu-item > .menu-link, .ast-primary-sticky-header-active .ast-builder-menu-2 .main-header-menu .menu-item.current-menu-item > .menu-link, .ast-primary-sticky-header-active .main-header-menu .menu-item.current-menu-ancestor > .menu-link' => array(
				'color'            => esc_attr( $mobile_sticky_primary_menu_h_color ),
				'background-color' => esc_attr( $sticky_header_menu_h_a_bg_color['mobile'] ),
			),
			'.ast-primary-sticky-header-active .ast-builder-menu-1 .main-header-menu .menu-item.current-menu-item > .menu-link:hover, .ast-primary-sticky-header-active .ast-builder-menu-2 .main-header-menu .menu-item.current-menu-item > .menu-link:hover, .ast-header-custom-item a:hover, .ast-primary-sticky-header-active .main-header-menu .menu-item:hover > .menu-link, .ast-primary-sticky-header-active .main-header-menu .menu-item.focus > .menu-link, .ast-primary-sticky-header-active.ast-advanced-headers .main-header-menu > .menu-item > .menu-link:hover, .ast-primary-sticky-header-active.ast-advanced-headers .main-header-menu > .menu-item > .menu-link:focus' => array(
				'background-color' => esc_attr( $sticky_header_menu_h_a_bg_color['mobile'] ),
				'color'            => esc_attr( $mobile_sticky_primary_menu_h_color ),
			),
			'.ast-primary-sticky-header-active .main-header-menu .ast-masthead-custom-menu-items a:hover, .ast-primary-sticky-header-active .main-header-menu .menu-item:hover > .ast-menu-toggle, .ast-primary-sticky-header-active .main-header-menu .menu-item.focus > .ast-menu-toggle' => array(
				'color' => esc_attr( $mobile_sticky_primary_menu_h_color ),
			),

			'.ast-primary-sticky-header-active .main-header-menu, .ast-primary-sticky-header-active .main-header-menu .menu-link, .ast-primary-sticky-header-active .ast-header-custom-item, .ast-header-custom-item a, .ast-primary-sticky-header-active li.ast-masthead-custom-menu-items, .ast-primary-sticky-header-active li.ast-masthead-custom-menu-items a, .ast-primary-sticky-header-active.ast-advanced-headers .main-header-menu > .menu-item > .menu-link' => array(
				'color' => esc_attr( $mobile_sticky_primary_menu_color ),
			),

			'.ast-primary-sticky-header-active .ast-masthead-custom-menu-items .ast-inline-search form' => array(
				'border-color' => esc_attr( $mobile_sticky_primary_menu_color ),
			),
			/**
			 * Primary Submenu
			 */
			'.ast-primary-sticky-header-active .main-navigation ul .sub-menu, .ast-header-break-point.ast-primary-sticky-header-active .main-header-bar-navigation .main-header-menu .sub-menu' => array(
				'background-color' => esc_attr( $sticky_header_submenu_bg_color['mobile'] ),
			),
			'.ast-primary-sticky-header-active .main-header-bar-navigation .main-header-menu .sub-menu, .ast-primary-sticky-header-active .main-header-bar-navigation .main-header-menu .sub-menu .menu-item > .ast-menu-toggle' => array(
				'color' => esc_attr( $sticky_primary_submenu_color['mobile'] ),
			),
			'.ast-primary-sticky-header-active .main-header-menu .sub-menu .menu-link:hover, .ast-primary-sticky-header-active .main-header-bar-navigation .main-header-menu .sub-menu .menu-item:hover > .menu-link, .ast-primary-sticky-header-active .main-header-menu .sub-menu .menu-item.focus > .menu-link' => array(
				'color'            => esc_attr( $sticky_primary_submenu_h_color['mobile'] ),
				'background-color' => esc_attr( $sticky_primary_submenu_h_a_bg_color['mobile'] ),
			),
			'.ast-primary-sticky-header-active .main-header-bar-navigation .main-header-menu .sub-menu .menu-item:hover > .ast-menu-toggle, .ast-primary-sticky-header-active .main-header-bar-navigation .main-header-menu .sub-menu .menu-item.focus > .ast-menu-toggle' => array(
				'color' => esc_attr( $sticky_primary_submenu_h_color['mobile'] ),
			),
			'.ast-primary-sticky-header-active .main-header-menu .sub-menu .menu-item.current-menu-item > .menu-link, .ast-primary-sticky-header-active .main-header-menu .sub-menu .menu-item.current-menu-ancestor > .menu-link' => array(
				'color'            => esc_attr( $sticky_primary_submenu_h_color['mobile'] ),
				'background-color' => esc_attr( $sticky_primary_submenu_h_a_bg_color['mobile'] ),
			),

			// Content Section text color.
			'.ast-primary-sticky-header-active div.ast-masthead-custom-menu-items, .ast-primary-sticky-header-active div.ast-masthead-custom-menu-items .widget, .ast-primary-sticky-header-active div.ast-masthead-custom-menu-items .widget-title' => array(
				'color' => esc_attr( $sticky_header_content_section_text_color['mobile'] ),
			),
			// Content Section link color.
			'.ast-primary-sticky-header-active div.ast-masthead-custom-menu-items a, .ast-primary-sticky-header-active div.ast-masthead-custom-menu-items .widget a' => array(
				'color' => esc_attr( $sticky_header_content_section_link_color['mobile'] ),
			),
			// Content Section link hover color.
			'.ast-primary-sticky-header-active div.ast-masthead-custom-menu-items a:hover, .ast-primary-sticky-header-active div.ast-masthead-custom-menu-items .widget a:hover' => array(
				'color' => esc_attr( $sticky_header_content_section_link_h_color['mobile'] ),
			),
		);

		$old_sticky_header_mobile_output = array(
			'.ast-primary-sticky-header-active .site-title a, .ast-primary-sticky-header-active .site-title a:focus, .ast-primary-sticky-header-active .site-title a:hover, .ast-primary-sticky-header-active .site-title a:visited' => array(
				'color' => esc_attr( $mobile_sticky_header_color_site_title ),
			),
			'.ast-primary-sticky-header-active .site-header .site-title a:hover'           => array(
				'color' => esc_attr( $sticky_header_color_h_site_title['mobile'] ),
			),
			'.ast-primary-sticky-header-active .site-header .site-description'             => array(
				'color' => esc_attr( $mobile_sticky_header_color_site_tagline ),
			),
		);

		if ( false === astra_addon_builder_helper()->is_header_footer_builder_active ) {
			$desktop_css_output = array_merge( $desktop_css_output, $old_sticky_header_desktop_output );
			$tablet_css_output  = array_merge( $tablet_css_output, $old_sticky_header_tablet_output );
			$mobile_css_output  = array_merge( $mobile_css_output, $old_sticky_header_mobile_output );
		}
	} else {
		// Only when Fixed Header Merkup added.
		$desktop_css_output = array(

			/**
			 * Header
			 */
			'#ast-fixed-header .site-title a, #ast-fixed-header .site-title a:focus, #ast-fixed-header .site-title a:hover, #ast-fixed-header .site-title a:visited' => array(
				'color' => esc_attr( $desktop_sticky_header_color_site_title ),
			),
			'#ast-fixed-header.site-header .site-title a:hover' => array(
				'color' => esc_attr( $sticky_header_color_h_site_title['desktop'] ),
			),
			'#ast-fixed-header.site-header .site-description' => array(
				'color' => esc_attr( $desktop_sticky_header_color_site_tagline ),
			),
			'.ast-transparent-header #ast-fixed-header .main-header-bar, .ast-transparent-header.ast-primary-sticky-enabled .ast-main-header-wrap .main-header-bar.ast-header-sticked, .ast-primary-sticky-enabled .ast-main-header-wrap .main-header-bar.ast-header-sticked, .ast-primary-sticky-header-ast-primary-sticky-enabled .ast-main-header-wrap .main-header-bar.ast-header-sticked, #ast-fixed-header .main-header-bar, #ast-fixed-header .ast-masthead-custom-menu-items .ast-inline-search .search-field, #ast-fixed-header .ast-masthead-custom-menu-items .ast-inline-search .search-field:focus' => array(
				'background'              => esc_attr( $desktop_sticky_header_bg_color ),
				'backdrop-filter'         => $sticky_header_bg_blur && $sticky_header_bg_blur_intensity ? 'blur(' . esc_attr( $sticky_header_bg_blur_intensity ) . 'px )' : 'unset',
				'-webkit-backdrop-filter' => $sticky_header_bg_blur && $sticky_header_bg_blur_intensity ? 'blur(' . esc_attr( $sticky_header_bg_blur_intensity ) . 'px )' : 'unset',
			),

			/**
			 * Primary Submenu
			 */
			'#ast-fixed-header .main-navigation ul .sub-menu, .ast-header-break-point#ast-fixed-header .main-header-menu .sub-menu' => array(
				'background-color' => esc_attr( $sticky_header_submenu_bg_color['desktop'] ),
			),
			'#ast-fixed-header .main-header-bar-navigation .main-header-menu .sub-menu, #ast-fixed-header .main-header-bar-navigation .main-header-menu .sub-menu .menu-link, #ast-fixed-header .main-header-bar-navigation .main-header-menu .sub-menu .menu-item > .ast-menu-toggle' => array(
				'color' => esc_attr( $sticky_primary_submenu_color['desktop'] ),
			),
			'#ast-fixed-header .main-header-menu .sub-menu .menu-link:hover, #ast-fixed-header .main-header-menu .sub-menu .menu-item:hover > .menu-link, #ast-fixed-header .main-header-menu .sub-menu .menu-item.focus > .menu-link' => array(
				'color'            => esc_attr( $sticky_primary_submenu_h_color['desktop'] ),
				'background-color' => esc_attr( $sticky_primary_submenu_h_a_bg_color['desktop'] ),
			),
			'#ast-fixed-header .main-header-menu .sub-menu .menu-item:hover > .ast-menu-toggle, #ast-fixed-header .main-header-menu .sub-menu .menu-item.focus > .ast-menu-toggle' => array(
				'color' => esc_attr( $sticky_primary_submenu_h_color['desktop'] ),
			),
			'#ast-fixed-header .main-header-menu .sub-menu .menu-item.current-menu-item > .menu-link, #ast-fixed-header .main-header-menu .sub-menu .menu-item.current-menu-ancestor > .menu-link' => array(
				'color'            => esc_attr( $sticky_primary_submenu_h_color['desktop'] ),
				'background-color' => esc_attr( $sticky_primary_submenu_h_a_bg_color['desktop'] ),
			),
			// Content Section text color.
			'#ast-fixed-header div.ast-masthead-custom-menu-items, #ast-fixed-header div.ast-masthead-custom-menu-items .widget, #ast-fixed-header div.ast-masthead-custom-menu-items .widget-title' => array(
				'color' => esc_attr( $sticky_header_content_section_text_color['desktop'] ),
			),
			// Content Section link color.
			'#ast-fixed-header div.ast-masthead-custom-menu-items a, #ast-fixed-header div.ast-masthead-custom-menu-items .widget a' => array(
				'color' => esc_attr( $sticky_header_content_section_link_color['desktop'] ),
			),
			// Content Section link hover color.
			'#ast-fixed-header div.ast-masthead-custom-menu-items a:hover, #ast-fixed-header div.ast-masthead-custom-menu-items .widget a:hover' => array(
				'color' => esc_attr( $sticky_header_content_section_link_h_color['desktop'] ),
			),
		);
		$tablet_css_output = array(

			/**
			 * Header
			 */
			'#ast-fixed-header .site-title a, #ast-fixed-header .site-title a:focus, #ast-fixed-header .site-title a:hover, #ast-fixed-header .site-title a:visited' => array(
				'color' => esc_attr( $tablet_sticky_header_color_site_title ),
			),
			'#ast-fixed-header.site-header .site-title a:hover' => array(
				'color' => esc_attr( $sticky_header_color_h_site_title['tablet'] ),
			),
			'#ast-fixed-header.site-header .site-description' => array(
				'color' => esc_attr( $tablet_sticky_header_color_site_tagline ),
			),
			'.ast-transparent-header #ast-fixed-header .main-header-bar, #ast-fixed-header .main-header-bar, #ast-fixed-header .ast-masthead-custom-menu-items .ast-inline-search .search-field, #ast-fixed-header .ast-masthead-custom-menu-items .ast-inline-search .search-field:focus' => array(
				'background' => esc_attr( $tablet_sticky_header_bg_color ),
			),

			/**
			 * Primary Submenu
			 */
			'#ast-fixed-header .main-navigation ul .sub-menu, .ast-header-break-point#ast-fixed-header .main-header-menu .sub-menu' => array(
				'background-color' => esc_attr( $sticky_header_submenu_bg_color['tablet'] ),
			),
			'#ast-fixed-header .main-header-bar-navigation .main-header-menu .sub-menu, #ast-fixed-header .main-header-menu .sub-menu .menu-link, #ast-fixed-header .main-header-bar-navigation .main-header-menu .sub-menu .menu-item > .ast-menu-toggle' => array(
				'color' => esc_attr( $sticky_primary_submenu_color['tablet'] ),
			),
			'#ast-fixed-header .main-header-menu .sub-menu .menu-link:hover, #ast-fixed-header .main-header-menu .sub-menu .menu-item:hover > .menu-link, #ast-fixed-header .main-header-menu .sub-menu .menu-item.focus > .menu-link' => array(
				'color'            => esc_attr( $sticky_primary_submenu_h_color['tablet'] ),
				'background-color' => esc_attr( $sticky_primary_submenu_h_a_bg_color['tablet'] ),
			),
			'#ast-fixed-header .main-header-menu .sub-menu .menu-item:hover > .ast-menu-toggle, #ast-fixed-header .main-header-menu .sub-menu .menu-item.focus > .ast-menu-toggle' => array(
				'color' => esc_attr( $sticky_primary_submenu_h_color['tablet'] ),
			),
			'#ast-fixed-header .main-header-menu .sub-menu .menu-item.current-menu-item > .menu-link, #ast-fixed-header .main-header-menu .sub-menu .menu-item.current-menu-ancestor > .menu-link' => array(
				'color'            => esc_attr( $sticky_primary_submenu_h_color['tablet'] ),
				'background-color' => esc_attr( $sticky_primary_submenu_h_a_bg_color['tablet'] ),
			),
			// Content Section text color.
			'#ast-fixed-header div.ast-masthead-custom-menu-items, #ast-fixed-header div.ast-masthead-custom-menu-items .widget, #ast-fixed-header div.ast-masthead-custom-menu-items .widget-title' => array(
				'color' => esc_attr( $sticky_header_content_section_text_color['tablet'] ),
			),
			// Content Section link color.
			'#ast-fixed-header div.ast-masthead-custom-menu-items a, #ast-fixed-header div.ast-masthead-custom-menu-items .widget a' => array(
				'color' => esc_attr( $sticky_header_content_section_link_color['tablet'] ),
			),
			// Content Section link hover color.
			'#ast-fixed-header div.ast-masthead-custom-menu-items a:hover, #ast-fixed-header div.ast-masthead-custom-menu-items .widget a:hover' => array(
				'color' => esc_attr( $sticky_header_content_section_link_h_color['tablet'] ),
			),
		);
		$mobile_css_output = array(

			/**
			 * Header
			 */
			'#ast-fixed-header .site-title a, #ast-fixed-header .site-title a:focus, #ast-fixed-header .site-title a:hover, #ast-fixed-header .site-title a:visited' => array(
				'color' => esc_attr( $mobile_sticky_header_color_site_title ),
			),
			'#ast-fixed-header.site-header .site-title a:hover' => array(
				'color' => esc_attr( $sticky_header_color_h_site_title['mobile'] ),
			),
			'#ast-fixed-header.site-header .site-description' => array(
				'color' => esc_attr( $mobile_sticky_header_color_site_tagline ),
			),
			'.ast-transparent-header #ast-fixed-header .main-header-bar, #ast-fixed-header .main-header-bar, #ast-fixed-header .ast-masthead-custom-menu-items .ast-inline-search .search-field, #ast-fixed-header .ast-masthead-custom-menu-items .ast-inline-search .search-field:focus' => array(
				'background' => esc_attr( $mobile_sticky_header_bg_color ),
			),

			/**
			 * Primary Submenu
			 */
			'#ast-fixed-header .main-navigation ul .sub-menu, .ast-header-break-point#ast-fixed-header .main-header-menu .sub-menu' => array(
				'background-color' => esc_attr( $sticky_header_submenu_bg_color['mobile'] ),
			),
			'#ast-fixed-header .main-header-bar-navigation .main-header-menu .sub-menu, #ast-fixed-header .main-header-menu .sub-menu .menu-link, #ast-fixed-header .main-header-bar-navigation .main-header-menu .sub-menu .menu-item > .ast-menu-toggle' => array(
				'color' => esc_attr( $sticky_primary_submenu_color['mobile'] ),
			),
			'#ast-fixed-header .main-header-menu .sub-menu .menu-link:hover, #ast-fixed-header .main-header-menu .sub-menu .menu-item:hover > .menu-link, #ast-fixed-header .main-header-menu .sub-menu .menu-item.focus > .menu-link' => array(
				'color'            => esc_attr( $sticky_primary_submenu_h_color['mobile'] ),
				'background-color' => esc_attr( $sticky_primary_submenu_h_a_bg_color['mobile'] ),
			),
			'#ast-fixed-header .main-header-menu .sub-menu .menu-item:hover > .ast-menu-toggle, #ast-fixed-header .main-header-menu .sub-menu .menu-item.focus > .ast-menu-toggle' => array(
				'color' => esc_attr( $sticky_primary_submenu_h_color['mobile'] ),
			),
			'#ast-fixed-header .main-header-menu .sub-menu .menu-item.current-menu-item > .menu-link, #ast-fixed-header .main-header-menu .sub-menu .menu-item.current-menu-ancestor > .menu-link' => array(
				'color'            => esc_attr( $sticky_primary_submenu_h_color['mobile'] ),
				'background-color' => esc_attr( $sticky_primary_submenu_h_a_bg_color['mobile'] ),
			),
			// Content Section text color.
			'#ast-fixed-header div.ast-masthead-custom-menu-items, #ast-fixed-header div.ast-masthead-custom-menu-items .widget, #ast-fixed-header div.ast-masthead-custom-menu-items .widget-title' => array(
				'color' => esc_attr( $sticky_header_content_section_text_color['mobile'] ),
			),
			// Content Section link color.
			'#ast-fixed-header div.ast-masthead-custom-menu-items a, #ast-fixed-header div.ast-masthead-custom-menu-items .widget a' => array(
				'color' => esc_attr( $sticky_header_content_section_link_color['mobile'] ),
			),
			// Content Section link hover color.
			'#ast-fixed-header div.ast-masthead-custom-menu-items a:hover, #ast-fixed-header div.ast-masthead-custom-menu-items .widget a:hover' => array(
				'color' => esc_attr( $sticky_header_content_section_link_h_color['mobile'] ),
			),
		);
	}

	/**
	 * [6]. Cart icon color for transparent sticky header.
	 *
	 * @since 4.6.0
	 */
	$sticky_header_cart_icon_css = array();

	/**
	 * [6.1] Cart icon normal colors.
	 */
	if ( $sticky_header_woo_cart_color ) {
		$sticky_header_cart_icon_css['.ast-sticky-active .ast-menu-cart-outline .ast-cart-menu-wrap .count, .ast-sticky-active .ast-menu-cart-outline .ast-addon-cart-wrap'] = array(
			'color'        => esc_attr( $sticky_header_woo_cart_color ),
			'border-color' => esc_attr( $sticky_header_woo_cart_color ),
		);

		$sticky_header_cart_icon_css['.ast-sticky-active .ast-woo-header-cart-info-wrap [class^="ast-woo-header-cart-"]'] = array(
			'color' => esc_attr( $sticky_header_woo_cart_color ),
		);

		/**
		 * [6.1.1] Cart icon normal colors for cart count.
		 */
		$sticky_header_cart_icon_css['body .ast-sticky-active .ast-site-header-cart .ast-addon-cart-wrap i.astra-icon:after'] = array(
			'color'            => esc_attr( $sticky_header_woo_cart_count_color ),
			'background-color' => esc_attr( $sticky_header_woo_cart_color ),
		);
	}

	/**
	 * [6.2] Cart icon hover colors.
	 */
	if ( $sticky_header_woo_cart_hover_color ) {
		$sticky_header_cart_icon_css['body .ast-sticky-active .ast-site-header-cart .ast-site-header-cart-li:hover .ast-cart-menu-wrap .count, body .ast-sticky-active .ast-site-header-cart .ast-site-header-cart-li:hover .ast-addon-cart-wrap'] = array(
			'color'        => esc_attr( $sticky_header_woo_cart_hover_color ),
			'border-color' => esc_attr( $sticky_header_woo_cart_hover_color ),
		);

		$sticky_header_cart_icon_css['.ast-sticky-active .ast-site-header-cart-li:hover .ast-icon, .ast-sticky-active .ast-site-header-cart-li:hover .ast-woo-header-cart-info-wrap [class^="ast-woo-header-cart-"]'] = array(
			'color' => esc_attr( $sticky_header_woo_cart_hover_color ),
		);

		/**
		 * [6.2.1] Cart icon hover colors for cart count.
		 */
		$sticky_header_cart_icon_css['body .ast-sticky-active .ast-site-header-cart .ast-site-header-cart-li:hover i.astra-icon:after'] = array(
			'color'            => esc_attr( $sticky_header_woo_cart_count_hover_color ),
			'background-color' => esc_attr( $sticky_header_woo_cart_hover_color ),
		);
	}

	/**
	 * [6.3] Parse sticky header cart icon colors into css.
	 */
	if ( $sticky_header_cart_icon_css ) {
		$parse_css .= astra_parse_css( $sticky_header_cart_icon_css );
	}

	if ( 'custom-button' === $header_custom_button_style ) {
		$css_output = array(
			// Custom menu item button - Transparent.
			'.ast-primary-sticky-header-active .main-header-bar .button-custom-menu-item .ast-custom-button-link .ast-custom-button' => array(
				'color'               => esc_attr( $header_custom_sticky_button_text_color ),
				'background-color'    => esc_attr( $header_custom_sticky_button_back_color ),
				'padding-top'         => astra_responsive_spacing( $header_custom_sticky_button_spacing, 'top', 'desktop' ),
				'padding-bottom'      => astra_responsive_spacing( $header_custom_sticky_button_spacing, 'bottom', 'desktop' ),
				'padding-left'        => astra_responsive_spacing( $header_custom_sticky_button_spacing, 'left', 'desktop' ),
				'padding-right'       => astra_responsive_spacing( $header_custom_sticky_button_spacing, 'right', 'desktop' ),
				'border-radius'       => astra_get_css_value( $header_custom_sticky_button_radius, 'px' ),
				'border-style'        => 'solid',
				'border-color'        => esc_attr( $header_custom_sticky_button_border_color ),
				'border-top-width'    => isset( $header_custom_sticky_button_border_size['top'] ) && '' !== $header_custom_sticky_button_border_size['top'] ? astra_get_css_value( $header_custom_sticky_button_border_size['top'], 'px' ) : '',
				'border-right-width'  => isset( $header_custom_sticky_button_border_size['right'] ) && '' !== $header_custom_sticky_button_border_size['right'] ? astra_get_css_value( $header_custom_sticky_button_border_size['right'], 'px' ) : '',
				'border-left-width'   => isset( $header_custom_sticky_button_border_size['left'] ) && '' !== $header_custom_sticky_button_border_size['left'] ? astra_get_css_value( $header_custom_sticky_button_border_size['left'], 'px' ) : '',
				'border-bottom-width' => isset( $header_custom_sticky_button_border_size['bottom'] ) && '' !== $header_custom_sticky_button_border_size['bottom'] ? astra_get_css_value( $header_custom_sticky_button_border_size['bottom'], 'px' ) : '',
			),
			'.ast-primary-sticky-header-active .main-header-bar .button-custom-menu-item .ast-custom-button-link .ast-custom-button:hover' => array(
				'color'            => esc_attr( $header_custom_sticky_button_text_h_color ),
				'background-color' => esc_attr( $header_custom_sticky_button_back_h_color ),
				'border-color'     => esc_attr( $header_custom_sticky_button_border_h_color ),
			),
		);

		/* Parse CSS from array() */
		$parse_css .= astra_parse_css( $css_output );

		$custom_trans_button_css = array(
			'.ast-sticky-active .main-header-bar .button-custom-menu-item .ast-custom-button-link .ast-custom-button' => array(
				'padding-top'    => astra_responsive_spacing( $header_custom_sticky_button_spacing, 'top', 'tablet' ),
				'padding-bottom' => astra_responsive_spacing( $header_custom_sticky_button_spacing, 'bottom', 'tablet' ),
				'padding-left'   => astra_responsive_spacing( $header_custom_sticky_button_spacing, 'left', 'tablet' ),
				'padding-right'  => astra_responsive_spacing( $header_custom_sticky_button_spacing, 'right', 'tablet' ),
			),
		);

		/* Parse CSS from array()*/
		$parse_css .= astra_parse_css( $custom_trans_button_css, '', astra_addon_get_tablet_breakpoint() );

		$custom_trans_button = array(
			'.ast-sticky-active .main-header-bar .button-custom-menu-item .ast-custom-button-link .ast-custom-button' => array(
				'padding-top'    => astra_responsive_spacing( $header_custom_sticky_button_spacing, 'top', 'mobile' ),
				'padding-bottom' => astra_responsive_spacing( $header_custom_sticky_button_spacing, 'bottom', 'mobile' ),
				'padding-left'   => astra_responsive_spacing( $header_custom_sticky_button_spacing, 'left', 'mobile' ),
				'padding-right'  => astra_responsive_spacing( $header_custom_sticky_button_spacing, 'right', 'mobile' ),
			),
		);

		/* Parse CSS from array()*/
		$parse_css .= astra_parse_css( $custom_trans_button, '', astra_addon_get_mobile_breakpoint() );
	}

	if ( false === astra_pro_sticky_header_submenu_below_header_fix() ) {
		$submenu_below_header = array(
			'.ast-sticky-main-shrink .ast-sticky-shrunk .main-header-bar' => array(
				'padding-top'    => '0.5em',
				'padding-bottom' => '0.5em',
			),
			'.ast-sticky-main-shrink .ast-sticky-shrunk .main-header-bar .ast-site-identity' => array(
				'padding-top'    => '0',
				'padding-bottom' => '0',
			),
		);

		$parse_css .= astra_parse_css( $submenu_below_header );
	}

	/**
	 * Sticky Header with Builder > Site Identity colors.
	 */
	if ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) {

		/* Site Identity Sticky Color Options */
		if ( ! astra_addon_sticky_site_title_tagline_css_comp() ) {
			$sticky_site_title_color       = astra_get_option( 'sticky-header-builder-site-title-color' );
			$sticky_site_title_hover_color = astra_get_option( 'sticky-header-builder-site-title-h-color' );
			$sticky_site_tagline_color     = astra_get_option( 'sticky-header-builder-site-tagline-color' );
		} else {
			$sticky_site_title_color       = astra_get_option( 'sticky-header-builder-site-title-color', $default_header_site_title_color );
			$sticky_site_title_hover_color = astra_get_option( 'sticky-header-builder-site-title-h-color', $default_header_site_title_hover_color );
			$sticky_site_tagline_color     = astra_get_option( 'sticky-header-builder-site-tagline-color', $default_header_site_tagline_color );
		}

		$sticky_logo_svg_icon_color       = astra_get_option( 'sticky-logo-svg-icon-color' );
		$sticky_logo_svg_icon_hover_color = astra_get_option( 'sticky-logo-svg-icon-hover-color' );

		$sticky_builder_site_identity_css = array(
			'[CLASS*="-sticky-header-active"] #ast-fixed-header.ast-header-sticked .site-title a, [CLASS*="-sticky-header-active"] .ast-header-sticked .site-title a:focus, [CLASS*="-sticky-header-active"] .ast-header-sticked .site-title a:visited , [CLASS*="-sticky-header-active"] .ast-header-sticked .site-title a' => array(
				'color' => esc_attr( $sticky_site_title_color ),
			),
			'[CLASS*="-sticky-header-active"] #ast-fixed-header.ast-header-sticked .site-title a:hover, [CLASS*="-sticky-header-active"] .ast-header-sticked .site-title a:hover'           => array(
				'color' => esc_attr( $sticky_site_title_hover_color ),
			),
			'[CLASS*="-sticky-header-active"] #ast-fixed-header.ast-header-sticked .ast-site-identity .site-description, [CLASS*="-sticky-header-active"] .ast-header-sticked .ast-site-identity .site-description'             => array(
				'color' => esc_attr( $sticky_site_tagline_color ),
			),
		);

		$sticky_builder_site_identity_css = array_merge(
			array(
				'[CLASS*="-sticky-header-active"] .ast-logo-svg-icon svg'       => array(
					'fill' => esc_attr( $sticky_logo_svg_icon_color ),
				),
				'[CLASS*="-sticky-header-active"] .ast-logo-svg-icon:hover svg' => array(
					'fill' => esc_attr( $sticky_logo_svg_icon_hover_color ),
				),
			),
			$sticky_builder_site_identity_css
		);

		$parse_css .= astra_parse_css( $sticky_builder_site_identity_css );

		$num_of_header_menu = astra_addon_builder_helper()->num_of_header_menu;
		for ( $index = 1; $index <= $num_of_header_menu; $index++ ) {

			/**
			 * Sticky Menu Colors.
			 */
			$desktop_sticky_primary_menu_color = astra_get_prop( astra_get_option( 'sticky-header-menu' . $index . '-color-responsive' ), 'desktop' );
			$tablet_sticky_primary_menu_color  = astra_get_prop( astra_get_option( 'sticky-header-menu' . $index . '-color-responsive' ), 'tablet' );
			$mobile_sticky_primary_menu_color  = astra_get_prop( astra_get_option( 'sticky-header-menu' . $index . '-color-responsive' ), 'mobile' );

			$sticky_header_menu_bg_color = astra_get_option( 'sticky-header-menu' . $index . '-bg-obj-responsive' );

			$desktop_sticky_primary_menu_h_color = astra_get_prop( astra_get_option( 'sticky-header-menu' . $index . '-h-color-responsive' ), 'desktop' );
			$tablet_sticky_primary_menu_h_color  = astra_get_prop( astra_get_option( 'sticky-header-menu' . $index . '-h-color-responsive' ), 'tablet' );
			$mobile_sticky_primary_menu_h_color  = astra_get_prop( astra_get_option( 'sticky-header-menu' . $index . '-h-color-responsive' ), 'mobile' );

			$sticky_header_menu_h_bg_color = astra_get_option( 'sticky-header-menu' . $index . '-h-bg-color-responsive' );

			$desktop_sticky_primary_menu_a_color = astra_get_prop( astra_get_option( 'sticky-header-menu' . $index . '-a-color-responsive' ), 'desktop' );
			$tablet_sticky_primary_menu_a_color  = astra_get_prop( astra_get_option( 'sticky-header-menu' . $index . '-a-color-responsive' ), 'tablet' );
			$mobile_sticky_primary_menu_a_color  = astra_get_prop( astra_get_option( 'sticky-header-menu' . $index . '-a-color-responsive' ), 'mobile' );

			$sticky_header_menu_a_bg_color = astra_get_option( 'sticky-header-menu' . $index . '-a-bg-color-responsive' );

			/**
			 * Sticky Submenu Colors.
			 */
			$desktop_sticky_primary_submenu_color = astra_get_prop( astra_get_option( 'sticky-header-menu' . $index . '-submenu-color-responsive' ), 'desktop' );
			$tablet_sticky_primary_submenu_color  = astra_get_prop( astra_get_option( 'sticky-header-menu' . $index . '-submenu-color-responsive' ), 'tablet' );
			$mobile_sticky_primary_submenu_color  = astra_get_prop( astra_get_option( 'sticky-header-menu' . $index . '-submenu-color-responsive' ), 'mobile' );

			$sticky_header_submenu_bg_color = astra_get_option( 'sticky-header-menu' . $index . '-submenu-bg-color-responsive' );

			$desktop_sticky_primary_submenu_h_color = astra_get_prop( astra_get_option( 'sticky-header-menu' . $index . '-submenu-h-color-responsive' ), 'desktop' );
			$tablet_sticky_primary_submenu_h_color  = astra_get_prop( astra_get_option( 'sticky-header-menu' . $index . '-submenu-h-color-responsive' ), 'tablet' );
			$mobile_sticky_primary_submenu_h_color  = astra_get_prop( astra_get_option( 'sticky-header-menu' . $index . '-submenu-h-color-responsive' ), 'mobile' );

			$sticky_header_submenu_h_bg_color = astra_get_option( 'sticky-header-menu' . $index . '-submenu-h-bg-color-responsive' );

			$desktop_sticky_primary_submenu_a_color = astra_get_prop( astra_get_option( 'sticky-header-menu' . $index . '-submenu-a-color-responsive' ), 'desktop' );
			$tablet_sticky_primary_submenu_a_color  = astra_get_prop( astra_get_option( 'sticky-header-menu' . $index . '-submenu-a-color-responsive' ), 'tablet' );
			$mobile_sticky_primary_submenu_a_color  = astra_get_prop( astra_get_option( 'sticky-header-menu' . $index . '-submenu-a-color-responsive' ), 'mobile' );

			$sticky_header_submenu_a_bg_color = astra_get_option( 'sticky-header-menu' . $index . '-submenu-a-bg-color-responsive' );

			if ( 3 > $index ) {
				/**
				 * Sticky Megamenu Heading Colors.
				 */
				$sticky_megamenu_heading_color   = astra_get_option( 'sticky-header-menu' . $index . '-header-megamenu-heading-color' );
				$sticky_megamenu_heading_h_color = astra_get_option( 'sticky-header-menu' . $index . '-header-megamenu-heading-h-color' );

				$sticky_builder_megamenu_desktop_css = array(
					// Megamenu Heading CSS Starts.
					'[CLASS*="-sticky-header-active"].ast-desktop .ast-builder-menu-' . $index . ' .main-header-menu.ast-mega-menu-enabled .sub-menu .menu-item.menu-item-heading > .menu-link' => array(
						'color'      => esc_attr( $sticky_megamenu_heading_color ),
						'background' => 'transparent',
					),
					'[CLASS*="-sticky-header-active"].ast-desktop .ast-builder-menu-' . $index . ' .main-header-menu.ast-mega-menu-enabled .sub-menu .menu-item.menu-item-heading:hover > .menu-link, [CLASS*="-sticky-header-active"].ast-desktop .ast-builder-menu-' . $index . ' .main-header-menu.ast-mega-menu-enabled .sub-menu .menu-item.menu-item-heading > .menu-link:hover' => array(
						'color'      => esc_attr( $sticky_megamenu_heading_h_color ),
						'background' => 'transparent',
					),
				);

				$parse_css .= astra_parse_css( $sticky_builder_megamenu_desktop_css );
			}

			$sticky_builder_menu_desktop_css = array(
				'[CLASS*="-sticky-header-active"] .ast-builder-menu-' . $index . ' .main-header-menu > .menu-item > .menu-link' => array(
					'color' => esc_attr( $desktop_sticky_primary_menu_color ),
				),
				'[CLASS*="-sticky-header-active"] .ast-builder-menu-' . $index . ' .main-header-menu, [CLASS*="-sticky-header-active"] .ast-builder-menu-' . $index . ' .main-header-menu > .menu-item > .menu-link' => array(
					'background-color' => esc_attr( $sticky_header_menu_bg_color['desktop'] ),
				),
				'[CLASS*="-sticky-header-active"] .ast-builder-menu-' . $index . ' .main-header-menu .menu-item > .menu-link:hover, [CLASS*="-sticky-header-active"] .ast-builder-menu-' . $index . ' .main-header-menu .current-menu-parent > .menu-link:hover, [CLASS*="-sticky-header-active"] .ast-builder-menu-' . $index . ' .main-header-menu .menu-item:hover > .menu-link' => array(
					'color'            => esc_attr( $desktop_sticky_primary_menu_h_color ),
					'background-color' => esc_attr( $sticky_header_menu_h_bg_color['desktop'] ),
				),
				'[CLASS*="-sticky-header-active"] .ast-builder-menu-' . $index . ' .main-header-menu .menu-item.current-menu-item > .menu-link' => array(
					'color'            => esc_attr( $desktop_sticky_primary_menu_a_color ),
					'background-color' => esc_attr( $sticky_header_menu_a_bg_color['desktop'] ),
				),
				'[CLASS*="-sticky-header-active"] .ast-builder-menu-' . $index . ' .main-header-menu .current-menu-parent > .menu-link' => array(
					'color'            => esc_attr( $desktop_sticky_primary_menu_a_color ),
					'background-color' => esc_attr( $sticky_header_menu_a_bg_color['desktop'] ),
				),
				// Submenu CSS starts.
				'[CLASS*="-sticky-header-active"] .ast-builder-menu-' . $index . ' .main-header-menu .menu-item .sub-menu .menu-item .menu-link' => array(
					'color' => esc_attr( $desktop_sticky_primary_submenu_color ),
				),
				'[CLASS*="-sticky-header-active"] .ast-builder-menu-' . $index . ' .main-header-menu .menu-item .sub-menu, [CLASS*="-sticky-header-active"] .ast-builder-menu-' . $index . ' .main-header-menu .menu-item .sub-menu .menu-link' => array(
					'background-color' => esc_attr( $sticky_header_submenu_bg_color['desktop'] ),
				),
				'[CLASS*="-sticky-header-active"] .ast-builder-menu-' . $index . ' .main-header-menu .menu-item .sub-menu .menu-item > .menu-link:hover, [CLASS*="-sticky-header-active"] .ast-builder-menu-' . $index . ' .main-header-menu .menu-item .sub-menu .menu-item:hover > .menu-link' => array(
					'color'            => esc_attr( $desktop_sticky_primary_submenu_h_color ),
					'background-color' => esc_attr( $sticky_header_submenu_h_bg_color['desktop'] ),
				),
				'[CLASS*="-sticky-header-active"] .ast-builder-menu-' . $index . ' .main-header-menu .menu-item .sub-menu .menu-item.current-menu-item > .menu-link, [CLASS*="-sticky-header-active"] .ast-builder-menu-' . $index . ' .main-header-menu .menu-item .sub-menu .menu-item.current-menu-ancestor > .menu-link' => array(
					'color'            => esc_attr( $desktop_sticky_primary_submenu_a_color ),
					'background-color' => esc_attr( $sticky_header_submenu_a_bg_color['desktop'] ),
				),
			);

			$sticky_builder_menu_tablet_css = array(
				'[CLASS*="-sticky-header-active"] .ast-builder-menu-' . $index . ' .main-header-menu > .menu-item > .menu-link' => array(
					'color' => esc_attr( $tablet_sticky_primary_menu_color ),
				),
				'[CLASS*="-sticky-header-active"] .ast-builder-menu-' . $index . ' .main-header-menu, [CLASS*="-sticky-header-active"] .ast-builder-menu-' . $index . ' .main-header-menu > .menu-item > .menu-link' => array(
					'background-color' => esc_attr( $sticky_header_menu_bg_color['tablet'] ),
				),
				'[CLASS*="-sticky-header-active"] .ast-builder-menu-' . $index . ' .main-header-menu .menu-item > .menu-link:hover, [CLASS*="-sticky-header-active"] .ast-builder-menu-' . $index . ' .main-header-menu .menu-item:hover > .menu-link' => array(
					'color'            => esc_attr( $tablet_sticky_primary_menu_h_color ),
					'background-color' => esc_attr( $sticky_header_menu_h_bg_color['tablet'] ),
				),
				'[CLASS*="-sticky-header-active"] .ast-builder-menu-' . $index . ' .main-header-menu .menu-item.current-menu-item > .menu-link, [CLASS*="-sticky-header-active"] .ast-builder-menu-' . $index . ' .main-header-menu .menu-item.current-menu-ancestor > .menu-link' => array(
					'color'            => esc_attr( $tablet_sticky_primary_menu_a_color ),
					'background-color' => esc_attr( $sticky_header_menu_a_bg_color['tablet'] ),
				),
				// Submenu CSS starts.
				'[CLASS*="-sticky-header-active"] .ast-builder-menu-' . $index . ' .main-header-menu .menu-item .sub-menu .menu-item .menu-link' => array(
					'color' => esc_attr( $tablet_sticky_primary_submenu_color ),
				),
				'[CLASS*="-sticky-header-active"] .ast-builder-menu-' . $index . ' .main-header-menu .menu-item .sub-menu, [CLASS*="-sticky-header-active"] .ast-builder-menu-' . $index . ' .main-header-menu .menu-item .sub-menu .menu-link' => array(
					'background-color' => esc_attr( $sticky_header_submenu_bg_color['tablet'] ),
				),
				'[CLASS*="-sticky-header-active"] .ast-builder-menu-' . $index . ' .main-header-menu .menu-item .sub-menu .menu-item > .menu-link:hover, [CLASS*="-sticky-header-active"] .ast-builder-menu-' . $index . ' .main-header-menu .menu-item .sub-menu .menu-item:hover > .menu-link' => array(
					'color'            => esc_attr( $tablet_sticky_primary_submenu_h_color ),
					'background-color' => esc_attr( $sticky_header_submenu_h_bg_color['tablet'] ),
				),
				'[CLASS*="-sticky-header-active"] .ast-builder-menu-' . $index . ' .main-header-menu .menu-item .sub-menu .menu-item.current-menu-item > .menu-link, [CLASS*="-sticky-header-active"] .ast-builder-menu-' . $index . ' .main-header-menu .menu-item .sub-menu .menu-item.current-menu-ancestor > .menu-link' => array(
					'color'            => esc_attr( $tablet_sticky_primary_submenu_a_color ),
					'background-color' => esc_attr( $sticky_header_submenu_a_bg_color['tablet'] ),
				),
				// Sticky Main Menu Scrolling (Tablet & Mobile).
				'.ast-primary-sticky-header-active.ast-main-header-nav-open nav' => array(
					'overflow-y' => 'auto',
					'max-height' => 'calc(100vh - 100px)',
				),

			);

			$sticky_builder_menu_mobile_css = array(
				'[CLASS*="-sticky-header-active"] .ast-builder-menu-' . $index . ' .main-header-menu > .menu-item > .menu-link' => array(
					'color' => esc_attr( $mobile_sticky_primary_menu_color ),
				),
				'[CLASS*="-sticky-header-active"] .ast-builder-menu-' . $index . ' .main-header-menu, [CLASS*="-sticky-header-active"] .ast-builder-menu-' . $index . ' .main-header-menu > .menu-item > .menu-link' => array(
					'background-color' => esc_attr( $sticky_header_menu_bg_color['mobile'] ),
				),
				'[CLASS*="-sticky-header-active"] .ast-builder-menu-' . $index . ' .main-header-menu .menu-item > .menu-link:hover, [CLASS*="-sticky-header-active"] .ast-builder-menu-' . $index . ' .main-header-menu .menu-item:hover > .menu-link' => array(
					'color'            => esc_attr( $mobile_sticky_primary_menu_h_color ),
					'background-color' => esc_attr( $sticky_header_menu_h_bg_color['mobile'] ),
				),
				'[CLASS*="-sticky-header-active"] .ast-builder-menu-' . $index . ' .main-header-menu .menu-item.current-menu-item > .menu-link, [CLASS*="-sticky-header-active"] .ast-builder-menu-' . $index . ' .main-header-menu .menu-item.current-menu-ancestor > .menu-link' => array(
					'color'            => esc_attr( $mobile_sticky_primary_menu_a_color ),
					'background-color' => esc_attr( $sticky_header_menu_a_bg_color['mobile'] ),
				),
				// Submenu CSS starts.
				'[CLASS*="-sticky-header-active"] .ast-builder-menu-' . $index . ' .main-header-menu .menu-item .sub-menu .menu-item .menu-link' => array(
					'color' => esc_attr( $mobile_sticky_primary_submenu_color ),
				),
				'[CLASS*="-sticky-header-active"] .ast-builder-menu-' . $index . ' .main-header-menu .menu-item .sub-menu, [CLASS*="-sticky-header-active"] .ast-builder-menu-' . $index . ' .main-header-menu .menu-item .sub-menu .menu-link' => array(
					'background-color' => esc_attr( $sticky_header_submenu_bg_color['mobile'] ),
				),
				'[CLASS*="-sticky-header-active"] .ast-builder-menu-' . $index . ' .main-header-menu .menu-item .sub-menu .menu-item > .menu-link:hover, [CLASS*="-sticky-header-active"] .ast-builder-menu-' . $index . ' .main-header-menu .menu-item .sub-menu .menu-item:hover > .menu-link' => array(
					'color'            => esc_attr( $mobile_sticky_primary_submenu_h_color ),
					'background-color' => esc_attr( $sticky_header_submenu_h_bg_color['mobile'] ),
				),
				'[CLASS*="-sticky-header-active"] .ast-builder-menu-' . $index . ' .main-header-menu .menu-item .sub-menu .menu-item.current-menu-item > .menu-link, [CLASS*="-sticky-header-active"] .ast-builder-menu-' . $index . ' .main-header-menu .menu-item .sub-menu .menu-item.current-menu-ancestor > .menu-link' => array(
					'color'            => esc_attr( $mobile_sticky_primary_submenu_a_color ),
					'background-color' => esc_attr( $sticky_header_submenu_a_bg_color['mobile'] ),
				),
			);

			/* Parse CSS from array() */
			$parse_css .= astra_parse_css( $sticky_builder_menu_desktop_css );
			$parse_css .= astra_parse_css( $sticky_builder_menu_tablet_css, '', astra_addon_get_tablet_breakpoint() );
			$parse_css .= astra_parse_css( $sticky_builder_menu_mobile_css, '', astra_addon_get_mobile_breakpoint() );
		}
	} else {
		$old_primary_menu_css_desktop = array(
			/**
			 * Primary Header Menu
			 */
			'#ast-fixed-header .main-header-menu' => array(
				'background' => esc_attr( $sticky_header_menu_bg_color['desktop'] ),
			),
			'#ast-fixed-header .main-header-menu .menu-item.current-menu-item > .menu-link, #ast-fixed-header .main-header-menu .menu-item.current-menu-ancestor > .menu-link' => array(
				'color'            => esc_attr( $desktop_sticky_primary_menu_h_color ),
				'background-color' => esc_attr( $sticky_header_menu_h_a_bg_color['desktop'] ),
			),
			'#ast-fixed-header .main-header-menu .menu-link:hover, .ast-header-custom-item a:hover, #ast-fixed-header .main-header-menu .menu-item:hover > .menu-link, #ast-fixed-header .main-header-menu .menu-item.focus > .menu-link' => array(
				'background-color' => esc_attr( $sticky_header_menu_h_a_bg_color['desktop'] ),
				'color'            => esc_attr( $desktop_sticky_primary_menu_h_color ),
			),
			'#ast-fixed-header .main-header-menu .ast-masthead-custom-menu-items a:hover, #ast-fixed-header .main-header-menu .menu-item:hover > .ast-menu-toggle, #ast-fixed-header .main-header-menu .menu-item.focus > .ast-menu-toggle' => array(
				'color' => esc_attr( $desktop_sticky_primary_menu_h_color ),
			),

			'#ast-fixed-header .main-header-menu, #ast-fixed-header .main-header-menu .menu-link, #ast-fixed-header .ast-header-custom-item, .ast-header-custom-item a, #ast-fixed-header li.ast-masthead-custom-menu-items, #ast-fixed-header li.ast-masthead-custom-menu-items a' => array(
				'color' => esc_attr( $desktop_sticky_primary_menu_color ),
			),

			'#ast-fixed-header .ast-masthead-custom-menu-items .ast-inline-search form' => array(
				'border-color' => esc_attr( $desktop_sticky_primary_menu_color ),
			),
		);
		$old_primary_menu_css_tablet = array(
			/**
			 * Primary Header Menu
			 */
			'#ast-fixed-header .main-header-menu' => array(
				'background' => esc_attr( $sticky_header_menu_bg_color['tablet'] ),
			),
			'#ast-fixed-header .main-header-menu .menu-item.current-menu-item > .menu-link, #ast-fixed-header .main-header-menu .menu-item.current-menu-ancestor > .menu-link' => array(
				'color'            => esc_attr( $tablet_sticky_primary_menu_h_color ),
				'background-color' => esc_attr( $sticky_header_menu_h_a_bg_color['tablet'] ),
			),
			'#ast-fixed-header .main-header-menu .menu-link:hover, .ast-header-custom-item a:hover, #ast-fixed-header .main-header-menu .menu-item:hover > .menu-link, #ast-fixed-header .main-header-menu .menu-item.focus > .menu-link' => array(
				'background-color' => esc_attr( $sticky_header_menu_h_a_bg_color['tablet'] ),
				'color'            => esc_attr( $tablet_sticky_primary_menu_h_color ),
			),
			'#ast-fixed-header .main-header-menu .ast-masthead-custom-menu-items a:hover, #ast-fixed-header .main-header-menu .menu-item:hover > .ast-menu-toggle, #ast-fixed-header .main-header-menu .menu-item.focus > .ast-menu-toggle' => array(
				'color' => esc_attr( $tablet_sticky_primary_menu_h_color ),
			),

			'#ast-fixed-header .main-header-menu, #ast-fixed-header .main-header-menu .menu-link, #ast-fixed-header .ast-header-custom-item, .ast-header-custom-item a, #ast-fixed-header li.ast-masthead-custom-menu-items, #ast-fixed-header li.ast-masthead-custom-menu-items a' => array(
				'color' => esc_attr( $tablet_sticky_primary_menu_color ),
			),

			'#ast-fixed-header .ast-masthead-custom-menu-items .ast-inline-search form' => array(
				'border-color' => esc_attr( $tablet_sticky_primary_menu_color ),
			),
		);
		$old_primary_menu_css_mobile = array(
			/**
			 * Primary Header Menu
			 */
			'#ast-fixed-header .main-header-menu' => array(
				'background' => esc_attr( $sticky_header_menu_bg_color['mobile'] ),
			),
			'#ast-fixed-header .main-header-menu .menu-item.current-menu-item > .menu-link, #ast-fixed-header .main-header-menu .menu-item.current-menu-ancestor > .menu-link' => array(
				'color'            => esc_attr( $mobile_sticky_primary_menu_h_color ),
				'background-color' => esc_attr( $sticky_header_menu_h_a_bg_color['mobile'] ),
			),
			'#ast-fixed-header .main-header-menu .menu-link:hover, .ast-header-custom-item a:hover, #ast-fixed-header .main-header-menu .menu-item:hover > .menu-link, #ast-fixed-header .main-header-menu .menu-item.focus > .menu-link' => array(
				'background-color' => esc_attr( $sticky_header_menu_h_a_bg_color['mobile'] ),
				'color'            => esc_attr( $mobile_sticky_primary_menu_h_color ),
			),
			'#ast-fixed-header .main-header-menu .ast-masthead-custom-menu-items a:hover, #ast-fixed-header .main-header-menu .menu-item:hover > .ast-menu-toggle, #ast-fixed-header .main-header-menu .menu-item.focus > .ast-menu-toggle' => array(
				'color' => esc_attr( $mobile_sticky_primary_menu_h_color ),
			),

			'#ast-fixed-header .main-header-menu, #ast-fixed-header .main-header-menu .menu-link, #ast-fixed-header .ast-header-custom-item, .ast-header-custom-item a, #ast-fixed-header li.ast-masthead-custom-menu-items, #ast-fixed-header li.ast-masthead-custom-menu-items a' => array(
				'color' => esc_attr( $mobile_sticky_primary_menu_color ),
			),

			'#ast-fixed-header .ast-masthead-custom-menu-items .ast-inline-search form' => array(
				'border-color' => esc_attr( $mobile_sticky_primary_menu_color ),
			),
		);

		/* Parse CSS from array() */
		$parse_css .= astra_parse_css( $old_primary_menu_css_desktop );
		$parse_css .= astra_parse_css( $old_primary_menu_css_tablet, '', astra_addon_get_tablet_breakpoint() );
		$parse_css .= astra_parse_css( $old_primary_menu_css_mobile, '', astra_addon_get_mobile_breakpoint() );
	}

	if ( version_compare( ASTRA_THEME_VERSION, '3.2.0', '<' ) ) {

		$sticky_static_css = '
		.ast-main-header-nav-open.astra-hfb-header #ast-fixed-header .ast-mobile-header-wrap .ast-mobile-header-content {
			display: none;
		}

		.ast-main-header-nav-open.astra-hfb-header .ast-mobile-header-wrap .ast-mobile-header-content {
			display: block;
		}

		.ast-header-stick-slide-active .ast-main-header-nav-open.astra-hfb-header #ast-fixed-header .ast-mobile-header-wrap .ast-mobile-header-content,
		.ast-header-stick-fade-active .ast-main-header-nav-open.astra-hfb-header #ast-fixed-header .ast-mobile-header-wrap .ast-mobile-header-content,
		.ast-header-stick-scroll-active .ast-main-header-nav-open.astra-hfb-header #ast-fixed-header .ast-mobile-header-wrap .ast-mobile-header-content {
			display: block;
		}

		.ast-header-stick-slide-active .ast-main-header-nav-open.astra-hfb-header #masthead > .ast-mobile-header-wrap .ast-mobile-header-content,
		.ast-header-stick-fade-active .ast-main-header-nav-open.astra-hfb-header #masthead > .ast-mobile-header-wrap .ast-mobile-header-content,
		.ast-header-stick-scroll-active .ast-main-header-nav-open.astra-hfb-header #masthead > .ast-mobile-header-wrap .ast-mobile-header-content {
			display: none;
		}

		.ast-header-stick-slide-active.ast-off-canvas-active .ast-main-header-nav-open.astra-hfb-header #ast-fixed-header .ast-mobile-header-wrap .ast-mobile-header-content,
		.ast-header-stick-fade-active.ast-off-canvas-active .ast-main-header-nav-open.astra-hfb-header #ast-fixed-header .ast-mobile-header-wrap .ast-mobile-header-content,
		.ast-header-stick-scroll-active.ast-off-canvas-active .ast-main-header-nav-open.astra-hfb-header #ast-fixed-header .ast-mobile-header-wrap .ast-mobile-header-content {
			display: none;
		}

		.ast-primary-sticky-header-active.ast-main-header-nav-open.astra-hfb-header #masthead > .ast-mobile-header-wrap .ast-mobile-header-content,
		.ast-above-sticky-header-active.ast-main-header-nav-open.astra-hfb-header #masthead > .ast-mobile-header-wrap .ast-mobile-header-content,
		.ast-below-sticky-header-active.ast-main-header-nav-open.astra-hfb-header #masthead > .ast-mobile-header-wrap .ast-mobile-header-content {
			position: fixed;
		}
		';

		if ( is_rtl() ) {

			$sticky_static_css .= '
			.ast-main-header-nav-open.astra-hfb-header #ast-fixed-header .ast-mobile-header-wrap .ast-mobile-header-content {
				display: none;
			}

			.ast-main-header-nav-open.astra-hfb-header .ast-mobile-header-wrap .ast-mobile-header-content {
				display: block;
			}

			.ast-header-stick-slide-active .ast-main-header-nav-open.astra-hfb-header #ast-fixed-header .ast-mobile-header-wrap .ast-mobile-header-content,
			.ast-header-stick-fade-active .ast-main-header-nav-open.astra-hfb-header #ast-fixed-header .ast-mobile-header-wrap .ast-mobile-header-content,
			.ast-header-stick-scroll-active .ast-main-header-nav-open.astra-hfb-header #ast-fixed-header .ast-mobile-header-wrap .ast-mobile-header-content {
				display: block;
			}

			.ast-header-stick-slide-active .ast-main-header-nav-open.astra-hfb-header #masthead > .ast-mobile-header-wrap .ast-mobile-header-content,
			.ast-header-stick-fade-active .ast-main-header-nav-open.astra-hfb-header #masthead > .ast-mobile-header-wrap .ast-mobile-header-content,
			.ast-header-stick-scroll-active .ast-main-header-nav-open.astra-hfb-header #masthead > .ast-mobile-header-wrap .ast-mobile-header-content {
				display: none;
			}

			.ast-header-stick-slide-active.ast-off-canvas-active .ast-main-header-nav-open.astra-hfb-header #ast-fixed-header .ast-mobile-header-wrap .ast-mobile-header-content,
			.ast-header-stick-fade-active.ast-off-canvas-active .ast-main-header-nav-open.astra-hfb-header #ast-fixed-header .ast-mobile-header-wrap .ast-mobile-header-content,
			.ast-header-stick-scroll-active.ast-off-canvas-active .ast-main-header-nav-open.astra-hfb-header #ast-fixed-header .ast-mobile-header-wrap .ast-mobile-header-content {
				display: none;
			}

			.ast-primary-sticky-header-active.ast-main-header-nav-open.astra-hfb-header #masthead > .ast-mobile-header-wrap .ast-mobile-header-content,
			.ast-above-sticky-header-active.ast-main-header-nav-open.astra-hfb-header #masthead > .ast-mobile-header-wrap .ast-mobile-header-content,
			.ast-below-sticky-header-active.ast-main-header-nav-open.astra-hfb-header #masthead > .ast-mobile-header-wrap .ast-mobile-header-content {
				position: fixed;
			}
			';
		}

		$parse_css .= Astra_Enqueue_Scripts::trim_css( $sticky_static_css );
	}

	/* Parse CSS from array() */
	$parse_css .= astra_parse_css( $desktop_css_output );
	$parse_css .= astra_parse_css( $tablet_css_output, '', astra_addon_get_tablet_breakpoint() );
	$parse_css .= astra_parse_css( $mobile_css_output, '', astra_addon_get_mobile_breakpoint() );

	return $dynamic_css . $parse_css;
}

/**
 * Check backwards compatibility CSS for loading submenu below the header needs to be added.
 *
 * @since 1.6.0
 * @return bool true if CSS should be included, False if not.
 */
function astra_pro_sticky_header_submenu_below_header_fix() {

	if ( false == astra_get_option( 'submenu-below-header', true ) && false === apply_filters( 'astra_submenu_below_header_fix', false ) ) {
		return false;
	}
		return true;
}

/**
 * For existing users, do not apply the defaut header site title color by default.
 *
 * @since 3.5.8
 * @return bool false if it is an existing user , true if not.
 */
function astra_addon_sticky_site_title_tagline_css_comp() {
	$astra_settings = astra_get_options();
	$astra_settings['sticky-header-default-site-title-tagline-css'] = isset( $astra_settings['sticky-header-default-site-title-tagline-css'] ) ? false : true;
	return apply_filters( 'astra_default_site_title_tagline_css_comp', $astra_settings['sticky-header-default-site-title-tagline-css'] );
}
