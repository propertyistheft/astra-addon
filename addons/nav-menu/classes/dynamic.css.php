<?php
/**
 * Mega Menu - Dynamic CSS
 *
 * @package Astra Addon
 */

add_filter( 'astra_addon_dynamic_css', 'astra_addon_mega_menu_dynamic_css' );

/**
 * Dynamic CSS
 *
 * @param  string $dynamic_css          Astra Dynamic CSS.
 * @param  string $dynamic_css_filtered Astra Dynamic CSS Filters.
 * @return string
 */
function astra_addon_mega_menu_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' ) {

	// set page width depending on site layout.
	$above_header_layout    = astra_get_option( 'above-header-layout' );
	$above_header_section_1 = astra_get_option( 'above-header-section-1' );
	$above_header_section_2 = astra_get_option( 'above-header-section-2' );

	$below_header_layout    = astra_get_option( 'below-header-layout' );
	$below_header_section_1 = astra_get_option( 'below-header-section-1' );
	$below_header_section_2 = astra_get_option( 'below-header-section-2' );

	$above_header_enabled = ( 'disabled' !== $above_header_layout ) && ( 'menu' === $above_header_section_1 || 'menu' === $above_header_section_2 ) ? true : false;
	$below_header_enabled = ( 'disabled' !== $below_header_layout ) && ( 'menu' === $below_header_section_1 || 'menu' === $below_header_section_2 ) ? true : false;

	$css = '';

	$submenu_border          = astra_get_option( 'primary-submenu-border' );
	$primary_submenu_b_color = astra_get_option( 'primary-submenu-b-color' );

	if ( Astra_Ext_Extension::is_active( 'header-sections' ) ) {
		$above_header_h_color                = astra_get_option( 'above-header-menu-h-color-responsive' );
		$above_header_submenu_h_color        = astra_get_option( 'above-header-submenu-hover-color-responsive' );
		$below_header_h_color                = astra_get_option( 'below-header-menu-text-hover-color-responsive' );
		$below_header_submneu_h_color        = astra_get_option( 'below-header-submenu-hover-color-responsive' );
		$above_header_submenu_bg_color       = astra_get_option( 'above-header-submenu-bg-color-responsive' );
		$below_header_submenu_bg_color       = astra_get_option( 'below-header-submenu-bg-color-responsive' );
		$above_header_submenu_border_color   = astra_get_option( 'above-header-submenu-border-color' );
		$below_header_submenu_border_color   = astra_get_option( 'below-header-submenu-border-color' );
		$above_header_menu_h_bg_color        = astra_get_option( 'above-header-menu-h-bg-color-responsive' );
		$above_header_submenu_bg_hover_color = astra_get_option( 'above-header-submenu-bg-hover-color-responsive' );
		$below_header_menu_hover_bg_color    = astra_get_option( 'below-header-menu-bg-hover-color-responsive' );
		$below_header_submenu_bg_hover_color = astra_get_option( 'below-header-submenu-bg-hover-color-responsive' );

		// Responsive Colors.
		$desktop_colors = array(
			'.ast-above-header-menu.ast-mega-menu-enabled .astra-full-megamenu-wrapper' => array(
				'background-color' => esc_attr( $above_header_submenu_bg_color['desktop'] ),
			),
			'.ast-below-header-menu .astra-full-megamenu-wrapper' => array(
				'background-color' => esc_attr( $below_header_submenu_bg_color['desktop'] ),
			),
			// Above header bg color - Added for tablet & mobile devices only.
			'.ast-desktop .ast-above-header-navigation .ast-mega-menu-enabled .astra-megamenu-li a:hover,.ast-desktop .ast-above-header-navigation .ast-mega-menu-enabled .astra-megamenu-li a:focus'     => array(
				'background-color' => esc_attr( $above_header_menu_h_bg_color['desktop'] ),
			),
			// Above header bg color - Added for tablet & mobile devices only.
			'.ast-desktop .ast-mega-menu-enabled.ast-above-header-menu .sub-menu .menu-item .menu-link:hover' => array(
				'background-color' => esc_attr( $above_header_submenu_bg_hover_color['desktop'] ),
			),
			// Below header bg color - Added for tablet & mobile devices only.
			'.ast-desktop .ast-mega-menu-enabled.ast-below-header-menu .menu-item .menu-link:hover, .ast-desktop .ast-mega-menu-enabled.ast-below-header-menu .menu-item .menu-link:focus' => array(
				'background-color' => esc_attr( $below_header_menu_hover_bg_color['desktop'] ),
			),
			// Below header bg color - Added for tablet & mobile devices only.
			'.ast-desktop .ast-mega-menu-enabled.ast-below-header-menu .sub-menu .menu-item .menu-link:hover' => array(
				'background-color' => esc_attr( $below_header_submenu_bg_hover_color['desktop'] ),
			),

			// Above header color.
			'.ast-desktop .ast-above-header-navigation .astra-megamenu-li .menu-item .menu-link:hover, .ast-desktop .ast-above-header-navigation .astra-megamenu-li .menu-item .menu-link:focus' => array(
				'color' => esc_attr( $above_header_h_color['desktop'] ),
			),
			'.ast-desktop .ast-above-header-navigation .ast-above-header-menu .astra-megamenu-li .sub-menu .menu-item .menu-link:hover, .ast-desktop .ast-above-header-navigation .ast-above-header-menu .astra-megamenu-li .sub-menu .menu-item .menu-link:focus' => array(
				'color' => esc_attr( $above_header_submenu_h_color['desktop'] ),
			),

			// Below header color.
			'.ast-desktop .ast-below-header-navigation .astra-megamenu-li .menu-item .menu-link:hover, .ast-desktop .ast-below-header-navigation .astra-megamenu-li .menu-item .menu-link:focus' => array(
				'color' => esc_attr( $below_header_h_color['desktop'] ),
			),
			'.ast-desktop .ast-below-header-navigation .astra-megamenu-li .sub-menu .menu-item .menu-link:hover, .ast-desktop .ast-below-header-navigation .astra-megamenu-li .sub-menu .menu-item .menu-link:focus' => array(
				'color' => esc_attr( $below_header_submneu_h_color['desktop'] ),
			),
		);
		$tablet_colors = array(
			'.ast-above-header .astra-full-megamenu-wrapper' => array(
				'background-color' => esc_attr( $above_header_submenu_bg_color['tablet'] ),
			),
			'.ast-below-header .astra-full-megamenu-wrapper' => array(
				'background-color' => esc_attr( $below_header_submenu_bg_color['tablet'] ),
			),
		);
		$mobile_colors = array(
			'.ast-above-header .astra-full-megamenu-wrapper' => array(
				'background-color' => esc_attr( $above_header_submenu_bg_color['mobile'] ),
			),
			'.ast-below-header .astra-full-megamenu-wrapper' => array(
				'background-color' => esc_attr( $below_header_submenu_bg_color['mobile'] ),
			),
		);

		$css .= astra_parse_css( $desktop_colors );
		$css .= astra_parse_css( $tablet_colors, '', astra_addon_get_tablet_breakpoint() );
		$css .= astra_parse_css( $mobile_colors, '', astra_addon_get_mobile_breakpoint() );

		$colors_options_style = array(
			// Box Shadow.
			'.ast-above-header-menu .astra-full-megamenu-wrapper' => array(
				'box-shadow' => '0 5px 20px rgba(0,0,0,0.06)',
			),
			'.ast-above-header-menu .astra-full-megamenu-wrapper .sub-menu, .ast-above-header-menu .astra-megamenu .sub-menu' => array(
				'box-shadow' => 'none',
			),

			'.ast-above-header-menu.ast-mega-menu-enabled.submenu-with-border .astra-full-megamenu-wrapper' => array(
				'border-color' => esc_attr( $above_header_submenu_border_color ),
			),
			'.ast-below-header-menu.ast-mega-menu-enabled.submenu-with-border .astra-full-megamenu-wrapper' => array(
				'border-color' => esc_attr( $below_header_submenu_border_color ),
			),
			// Box Shadow.
			'.ast-below-header-menu .astra-full-megamenu-wrapper' => array(
				'box-shadow' => '0 5px 20px rgba(0,0,0,0.06)',
			),
			'.ast-below-header-menu .astra-full-megamenu-wrapper .sub-menu, .ast-below-header-menu .astra-megamenu .sub-menu' => array(
				'box-shadow' => 'none',
			),
		);

		/* Parse CSS from array() */
		$css .= astra_parse_css( $colors_options_style );
	}

	if ( Astra_Ext_Extension::is_active( 'colors-and-background' ) ) {

		$primary_header_h_color         = astra_get_option( 'primary-menu-h-color-responsive' );
		$primary_header_submenu_h_color = astra_get_option( 'primary-submenu-h-color-responsive' );
		$primary_submenu_bg_color       = astra_get_option( 'primary-submenu-bg-color-responsive' );
		$primary_menu_h_bg_color        = astra_get_option( 'primary-menu-h-bg-color-responsive' );
		$primary_submenu_h_bg_color     = astra_get_option( 'primary-submenu-h-bg-color-responsive' );

		$border = array(
			'.ast-desktop .main-header-menu.submenu-with-border .astra-megamenu, .ast-desktop .main-header-menu.ast-mega-menu-enabled.submenu-with-border .astra-full-megamenu-wrapper' => array(
				'border-top-width'    => ! empty( $submenu_border['top'] ) ? astra_get_css_value( $submenu_border['top'], 'px' ) : '',
				'border-left-width'   => ! empty( $submenu_border['left'] ) ? astra_get_css_value( $submenu_border['left'], 'px' ) : '',
				'border-right-width'  => ! empty( $submenu_border['right'] ) ? astra_get_css_value( $submenu_border['right'], 'px' ) : '',
				'border-bottom-width' => ! empty( $submenu_border['bottom'] ) ? astra_get_css_value( $submenu_border['bottom'], 'px' ) : '',
				'border-style'        => 'solid',
				'border-color'        => esc_attr( $primary_submenu_b_color ),
			),
		);

		/* Parse CSS from array() */
		$css .= astra_parse_css( $border );

		$colors_options_style = array(
			/**
			 * Sub Menu Border Colors support for the Full Width Mega Menu
			 */
			'.main-header-menu.ast-mega-menu-enabled.submenu-with-border .astra-full-megamenu-wrapper' => array(
				'border-color' => esc_attr( $primary_submenu_b_color ),
			),
		);
		/* Parse CSS from array() */
		$css .= astra_parse_css( $colors_options_style );

		// Responsive Colors.
		$desktop_colors = array(
			/**
			 * Sub Menu Background Colors support for the Full Width Mega Menu
			 */
			'.main-header-menu.ast-mega-menu-enabled .astra-full-megamenu-wrapper' => array(
				'background-color' => esc_attr( $primary_submenu_bg_color['desktop'] ),
			),
			'.ast-desktop .main-header-menu .astra-megamenu-li .menu-item .menu-link:hover, .ast-desktop .main-header-menu .astra-megamenu-li .menu-item .menu-link:focus' => array(
				'color' => esc_attr( $primary_header_h_color['desktop'] ),
			),

			'.ast-desktop .main-header-menu .astra-megamenu-li .sub-menu .menu-item .menu-link:hover, .ast-desktop .main-header-menu .astra-megamenu-li .sub-menu .menu-item .menu-link:focus' => array(
				'color' => esc_attr( $primary_header_submenu_h_color['desktop'] ),
			),

			/**
			 * Primary header bg color
			 */
			'.ast-desktop .ast-mega-menu-enabled.main-header-menu .menu-item .menu-link:hover, .ast-desktop .ast-mega-menu-enabled.main-header-menu .menu-item .menu-link:focus' => array(
				'background-color' => esc_attr( $primary_menu_h_bg_color['desktop'] ),
			),
			'.ast-desktop .ast-mega-menu-enabled.main-header-menu .sub-menu .menu-item .menu-link:hover, .ast-desktop .ast-mega-menu-enabled.main-header-menu .sub-menu .menu-item .menu-link:focus' => array(
				'background-color' => esc_attr( $primary_submenu_h_bg_color['desktop'] ),
			),
		);
		$tablet_colors = array(
			/**
			 * Sub Menu Background Colors support for the Full Width Mega Menu
			 */
			'.main-header-menu .astra-full-megamenu-wrapper' => array(
				'background-color' => esc_attr( $primary_submenu_bg_color['tablet'] ),
			),
		);
		$mobile_colors = array(
			/**
			 * Sub Menu Background Colors support for the Full Width Mega Menu
			 */
			'.main-header-menu .astra-full-megamenu-wrapper' => array(
				'background-color' => esc_attr( $primary_submenu_bg_color['mobile'] ),
			),
		);

		$css .= astra_parse_css( $desktop_colors );
		$css .= astra_parse_css( $tablet_colors, '', astra_addon_get_tablet_breakpoint() );
		$css .= astra_parse_css( $mobile_colors, '', astra_addon_get_mobile_breakpoint() );
	}

	$sticky_above_mega_menu_heading_color   = astra_get_option( 'sticky-above-header-megamenu-heading-color' );
	$sticky_above_mega_menu_heading_h_color = astra_get_option( 'sticky-above-header-megamenu-heading-h-color' );
	$sticky_mega_menu_heading_color         = astra_get_option( 'sticky-primary-header-megamenu-heading-color' );
	$sticky_mega_menu_heading_h_color       = astra_get_option( 'sticky-primary-header-megamenu-heading-h-color' );
	$sticky_below_mega_menu_heading_color   = astra_get_option( 'sticky-below-header-megamenu-heading-color' );
	$sticky_below_mega_menu_heading_h_color = astra_get_option( 'sticky-below-header-megamenu-heading-h-color' );
	$above_mega_menu_heading_color          = astra_get_option( 'above-header-megamenu-heading-color' );
	$above_mega_menu_heading_h_color        = astra_get_option( 'above-header-megamenu-heading-h-color' );
	$primary_mega_menu_heading_color        = astra_get_option( 'primary-header-megamenu-heading-color' );
	$primary_mega_menu_heading_h_color      = astra_get_option( 'primary-header-megamenu-heading-h-color' );
	$below_mega_menu_heading_color          = astra_get_option( 'below-header-megamenu-heading-color' );
	$below_mega_menu_heading_h_color        = astra_get_option( 'below-header-megamenu-heading-h-color' );

	/**
	 * Executing condition for managing backward compatibility in case of Colors when sticky is active.
	 *
	 * Because till previous to this version normal header Mega Menu heading colors overriden by sticky colors.
	 *
	 * @since 2.6.0
	 */
	$astra_settings              = astra_get_options();
	$backward_sticky_header_comp = isset( $astra_settings['can-inherit-sticky-colors-in-header'] ) && $astra_settings['can-inherit-sticky-colors-in-header'] ? true : false;

	if ( $backward_sticky_header_comp ) {
		// For above menu colors.
		$above_mega_menu_heading_color   = $sticky_above_mega_menu_heading_color;
		$above_mega_menu_heading_h_color = $sticky_above_mega_menu_heading_h_color;
		// For primary menu colors.
		$primary_mega_menu_heading_color   = $sticky_mega_menu_heading_color;
		$primary_mega_menu_heading_h_color = $sticky_mega_menu_heading_h_color;
		// For below menu colors.
		$below_mega_menu_heading_color   = $sticky_below_mega_menu_heading_color;
		$below_mega_menu_heading_h_color = $sticky_below_mega_menu_heading_h_color;
	}

	$colors = array(
		// Normal Above Header.
		'.ast-desktop .ast-mega-menu-enabled.ast-above-header-menu .menu-item-heading > .menu-link' => array(
			'color' => esc_attr( $above_mega_menu_heading_color ),
		),
		'.ast-desktop .ast-mega-menu-enabled.ast-above-header-menu .sub-menu .menu-item.menu-item-heading:hover > .menu-link, .ast-desktop .ast-mega-menu-enabled.ast-above-header-menu .sub-menu.menu-item .menu-item-heading:focus > .menu-link, .ast-desktop .ast-mega-menu-enabled.ast-above-header-menu .sub-menu .menu-item.menu-item-heading.focus > .menu-link, .ast-desktop .ast-mega-menu-enabled.ast-above-header-menu .sub-menu .menu-item.menu-item-heading > .menu-link:hover' => array(
			'color' => esc_attr( $above_mega_menu_heading_h_color ),
		),

		// Sticky Above Header.
		'.ast-desktop.ast-above-sticky-header-active .ast-mega-menu-enabled.ast-above-header-menu .menu-item-heading > .menu-link, .ast-desktop.ast-above-sticky-header-active #ast-fixed-header .ast-mega-menu-enabled.ast-above-header-menu .menu-item-heading > .menu-link' => array(
			'color' => esc_attr( $sticky_above_mega_menu_heading_color ),
		),
		'.ast-desktop .astra-megamenu-li .menu-item-heading > .menu-link:hover, .ast-desktop .ast-mega-menu-enabled.submenu-with-border .astra-megamenu-li .menu-item-heading > .menu-link:hover, .ast-desktop .ast-mega-menu-enabled .astra-megamenu-li .menu-item-heading > .menu-link:hover, .ast-desktop.ast-above-sticky-header-active .ast-mega-menu-enabled.ast-above-header-menu .sub-menu .menu-item-heading:hover > .menu-link, .ast-desktop.ast-above-sticky-header-active .ast-mega-menu-enabled.ast-above-header-menu .sub-menu .menu-item-heading:focus > .menu-link, .ast-desktop.ast-above-sticky-header-active .ast-mega-menu-enabled.ast-above-header-menu .sub-menu .menu-item-heading > .menu-link.hover, .ast-desktop.ast-above-sticky-header-active #ast-fixed-header .ast-mega-menu-enabled.ast-above-header-menu .menu-item-heading:hover > .menu-link' => array(
			'color' => esc_attr( $sticky_above_mega_menu_heading_h_color ),
		),

		// Primary Header.
		'.ast-desktop .ast-mega-menu-enabled.main-header-menu .menu-item-heading > .menu-link' => array(
			'color' => esc_attr( $primary_mega_menu_heading_color ),
		),
		'.ast-desktop .ast-mega-menu-enabled.main-header-menu .menu-item.menu-item-heading > .menu-link:hover, .ast-desktop .ast-mega-menu-enabled.main-header-menu .menu-item.menu-item-heading > .menu-link:focus' => array(
			'color' => esc_attr( $primary_mega_menu_heading_h_color ),
		),

		// Sticky Primary Header.
		'.ast-desktop.ast-primary-sticky-header-active .ast-mega-menu-enabled.main-header-menu .sub-menu .menu-item.menu-item-heading > .menu-link, .ast-desktop #ast-fixed-header .ast-mega-menu-enabled.main-header-menu .sub-menu .menu-item.menu-item-heading > .menu-link' => array(
			'color' => esc_attr( $sticky_mega_menu_heading_color ),
		),
		'.ast-desktop.ast-primary-sticky-header-active .ast-mega-menu-enabled.main-header-menu .menu-item-heading > .menu-link:hover, .ast-desktop.ast-primary-sticky-header-active .ast-mega-menu-enabled.main-header-menu .menu-item-heading > .menu-link:focus, .ast-desktop.ast-primary-sticky-header-active .ast-mega-menu-enabled.main-header-menu .menu-item-heading > .menu-link.focus, .ast-desktop #ast-fixed-header .ast-mega-menu-enabled.main-header-menu .sub-menu .menu-item-heading > .menu-link:hover, .ast-desktop #ast-fixed-header .ast-mega-menu-enabled.main-header-menu .sub-menu .menu-item-heading > .menu-link:focus, .ast-desktop #ast-fixed-header .ast-mega-menu-enabled.main-header-menu .sub-menu .menu-item-heading > .menu-link.focus' => array(
			'color' => esc_attr( $sticky_mega_menu_heading_h_color ),
		),

		// Normal Below Header.
		'.ast-desktop .ast-mega-menu-enabled.ast-below-header-menu .menu-item-heading > .menu-link' => array(
			'color' => esc_attr( $below_mega_menu_heading_color ),
		),
		'.ast-desktop.ast-below-sticky-header-active .ast-mega-menu-enabled.ast-below-header-menu .menu-item.menu-item-heading > .menu-link:hover, .ast-desktop.ast-below-sticky-header-active .ast-mega-menu-enabled.ast-below-header-menu .menu-item.menu-item-heading > .menu-link:focus, .ast-desktop.ast-below-sticky-header-active .ast-mega-menu-enabled.ast-below-header-menu .menu-item.menu-item-heading > .menu-link.focus' => array(
			'color' => esc_attr( $below_mega_menu_heading_h_color ),
		),

		// Sticky Below Header.
		'.ast-desktop.ast-below-sticky-header-active .ast-mega-menu-enabled .menu-item-heading > .menu-link, .ast-desktop.ast-below-sticky-header-active #ast-fixed-header .ast-mega-menu-enabled.ast-below-header-menu .menu-item-heading > .menu-link' => array(
			'color' => esc_attr( $sticky_below_mega_menu_heading_color ),
		),
		'.ast-desktop.ast-below-sticky-header-active .ast-mega-menu-enabled .menu-item-heading > .menu-link:hover, .ast-desktop.ast-below-sticky-header-active .ast-mega-menu-enabled .menu-item-heading > .menu-link:focus, .ast-desktop.ast-below-sticky-header-active .ast-mega-menu-enabled .menu-item-heading > .menu-link.focus, .ast-desktop.ast-below-sticky-header-active #ast-fixed-header .ast-mega-menu-enabled.ast-below-header-menu.menu-item .menu-item-heading > .menu-link:hover, .ast-desktop.ast-below-sticky-header-active #ast-fixed-header .ast-mega-menu-enabled.ast-below-header-menu .menu-item-heading > .menu-link:focus, .ast-desktop.ast-below-sticky-header-active #ast-fixed-header .ast-mega-menu-enabled.ast-below-header-menu .menu-item-heading > .menu-link.focus' => array(
			'color' => esc_attr( $sticky_below_mega_menu_heading_h_color ),
		),
	);

	// Common options of Above Header.
	$css .= astra_parse_css( $colors );

	$font_size      = astra_get_option( 'primary-header-megamenu-heading-font-size' );
	$font_family    = astra_get_option( 'primary-header-megamenu-heading-font-family' );
	$font_weight    = astra_get_option( 'primary-header-megamenu-heading-font-weight' );
	$text_transform = astra_get_option( 'primary-header-megamenu-heading-text-transform' );

	$common_css_output = array(
		'.ast-desktop .ast-mega-menu-enabled.main-header-menu .menu-item-heading > .menu-link' => array(
			'font-family'    => astra_get_css_value( $font_family, 'font' ),
			'font-weight'    => astra_get_css_value( $font_weight, 'font' ),
			'font-size'      => astra_responsive_font( $font_size, 'desktop' ),
			'text-transform' => esc_attr( $text_transform ),
		),
	);

	// Common options of Above Header.
	$css .= astra_parse_css( $common_css_output );

	$site_identity_spacing = astra_get_option( 'primary-header-megamenu-heading-space' );

	// Desktop Spacing.
	$spacing = array(

		// Site Identity Spacing.
		'.ast-desktop .ast-mega-menu-enabled.main-header-menu .menu-item-heading > .menu-link'  => array(
			'padding-top'    => astra_responsive_spacing( $site_identity_spacing, 'top', 'desktop' ),
			'padding-right'  => astra_responsive_spacing( $site_identity_spacing, 'right', 'desktop' ),
			'padding-bottom' => astra_responsive_spacing( $site_identity_spacing, 'bottom', 'desktop' ),
			'padding-left'   => astra_responsive_spacing( $site_identity_spacing, 'left', 'desktop' ),
		),
	);

	$tablet_spacing = array(

		// Site Identity Spacing.
		'.ast-desktop .ast-mega-menu-enabled.main-header-menu .menu-item-heading > .menu-link'  => array(
			'padding-top'    => astra_responsive_spacing( $site_identity_spacing, 'top', 'tablet' ),
			'padding-right'  => astra_responsive_spacing( $site_identity_spacing, 'right', 'tablet' ),
			'padding-bottom' => astra_responsive_spacing( $site_identity_spacing, 'bottom', 'tablet' ),
			'padding-left'   => astra_responsive_spacing( $site_identity_spacing, 'left', 'tablet' ),
		),
	);

	// Site Identity Spacing.
	$mobile_spacing = array(
		'.ast-desktop .ast-mega-menu-enabled.main-header-menu .menu-item-heading > .menu-link'  => array(
			'padding-top'    => astra_responsive_spacing( $site_identity_spacing, 'top', 'mobile' ),
			'padding-right'  => astra_responsive_spacing( $site_identity_spacing, 'right', 'mobile' ),
			'padding-bottom' => astra_responsive_spacing( $site_identity_spacing, 'bottom', 'mobile' ),
			'padding-left'   => astra_responsive_spacing( $site_identity_spacing, 'left', 'mobile' ),
		),
	);

	$css .= astra_parse_css( $spacing );
	$css .= astra_parse_css( $mobile_spacing, '', astra_addon_get_mobile_breakpoint() );
	$css .= astra_parse_css( $tablet_spacing, '', astra_addon_get_tablet_breakpoint() );

	/**
	 * Above Header.
	 */
	if ( $above_header_enabled ) {
		$above_megamenu_space = astra_get_option( 'above-header-megamenu-heading-space' );

		// Desktop Spacing.
		$spacing = array(

			// Site Identity Spacing.
			'.ast-above-header-navigation .ast-mega-menu-enabled.ast-above-header-menu .astra-megamenu .menu-item-heading > .menu-link'  => array(
				'padding-top'    => astra_responsive_spacing( $above_megamenu_space, 'top', 'desktop' ),
				'padding-right'  => astra_responsive_spacing( $above_megamenu_space, 'right', 'desktop' ),
				'padding-bottom' => astra_responsive_spacing( $above_megamenu_space, 'bottom', 'desktop' ),
				'padding-left'   => astra_responsive_spacing( $above_megamenu_space, 'left', 'desktop' ),
			),
		);

		$tablet_spacing = array(

			// Site Identity Spacing.
			'.ast-above-header-navigation .ast-mega-menu-enabled.ast-above-header-menu .astra-megamenu .menu-item-heading > .menu-link'  => array(
				'padding-top'    => astra_responsive_spacing( $above_megamenu_space, 'top', 'tablet' ),
				'padding-right'  => astra_responsive_spacing( $above_megamenu_space, 'right', 'tablet' ),
				'padding-bottom' => astra_responsive_spacing( $above_megamenu_space, 'bottom', 'tablet' ),
				'padding-left'   => astra_responsive_spacing( $above_megamenu_space, 'left', 'tablet' ),
			),
		);

		// Site Identity Spacing.
		$mobile_spacing = array(
			'.ast-above-header-navigation .ast-mega-menu-enabled.ast-above-header-menu .astra-megamenu .menu-item-heading > .menu-link'  => array(
				'padding-top'    => astra_responsive_spacing( $above_megamenu_space, 'top', 'mobile' ),
				'padding-right'  => astra_responsive_spacing( $above_megamenu_space, 'right', 'mobile' ),
				'padding-bottom' => astra_responsive_spacing( $above_megamenu_space, 'bottom', 'mobile' ),
				'padding-left'   => astra_responsive_spacing( $above_megamenu_space, 'left', 'mobile' ),
			),
		);

		$css .= astra_parse_css( $spacing );
		$css .= astra_parse_css( $mobile_spacing, '', astra_addon_get_mobile_breakpoint() );
		$css .= astra_parse_css( $tablet_spacing, '', astra_addon_get_tablet_breakpoint() );

		$font_size      = astra_get_option( 'above-header-megamenu-heading-font-size' );
		$font_family    = astra_get_option( 'above-header-megamenu-heading-font-family' );
		$font_weight    = astra_get_option( 'above-header-megamenu-heading-font-weight' );
		$text_transform = astra_get_option( 'above-header-megamenu-heading-text-transform' );

		$common_css_output = array(
			'.ast-desktop .ast-mega-menu-enabled.ast-above-header-menu .menu-item-heading > .menu-link' => array(
				'font-family'    => astra_get_css_value( $font_family, 'font' ),
				'font-weight'    => astra_get_css_value( $font_weight, 'font' ),
				'font-size'      => astra_responsive_font( $font_size, 'desktop' ),
				'text-transform' => esc_attr( $text_transform ),
			),
		);

		// Common options of Above Header.
		$css .= astra_parse_css( $common_css_output );
	}

	/**
	 * Below Header.
	 */
	if ( $below_header_enabled ) {
		$below_megamenu_space = astra_get_option( 'below-header-megamenu-heading-space' );

		// Desktop Spacing.
		$spacing = array(

			// Site Identity Spacing.
			'.ast-below-header-navigation .ast-mega-menu-enabled.ast-below-header-menu .astra-megamenu .menu-item-heading > .menu-link'  => array(
				'padding-top'    => astra_responsive_spacing( $below_megamenu_space, 'top', 'desktop' ),
				'padding-right'  => astra_responsive_spacing( $below_megamenu_space, 'right', 'desktop' ),
				'padding-bottom' => astra_responsive_spacing( $below_megamenu_space, 'bottom', 'desktop' ),
				'padding-left'   => astra_responsive_spacing( $below_megamenu_space, 'left', 'desktop' ),
			),
		);

		$tablet_spacing = array(

			// Site Identity Spacing.
			'.ast-below-header-navigation .ast-mega-menu-enabled.ast-below-header-menu .astra-megamenu .menu-item-heading > .menu-link'  => array(
				'padding-top'    => astra_responsive_spacing( $below_megamenu_space, 'top', 'tablet' ),
				'padding-right'  => astra_responsive_spacing( $below_megamenu_space, 'right', 'tablet' ),
				'padding-bottom' => astra_responsive_spacing( $below_megamenu_space, 'bottom', 'tablet' ),
				'padding-left'   => astra_responsive_spacing( $below_megamenu_space, 'left', 'tablet' ),
			),
		);

		// Site Identity Spacing.
		$mobile_spacing = array(
			'.ast-below-header-navigation .ast-mega-menu-enabled.ast-below-header-menu .astra-megamenu .menu-item-heading > .menu-link'  => array(
				'padding-top'    => astra_responsive_spacing( $below_megamenu_space, 'top', 'mobile' ),
				'padding-right'  => astra_responsive_spacing( $below_megamenu_space, 'right', 'mobile' ),
				'padding-bottom' => astra_responsive_spacing( $below_megamenu_space, 'bottom', 'mobile' ),
				'padding-left'   => astra_responsive_spacing( $below_megamenu_space, 'left', 'mobile' ),
			),
		);

		$css .= astra_parse_css( $spacing );
		$css .= astra_parse_css( $mobile_spacing, '', astra_addon_get_mobile_breakpoint() );
		$css .= astra_parse_css( $tablet_spacing, '', astra_addon_get_tablet_breakpoint() );

		$font_size      = astra_get_option( 'below-header-megamenu-heading-font-size' );
		$font_family    = astra_get_option( 'below-header-megamenu-heading-font-family' );
		$font_weight    = astra_get_option( 'below-header-megamenu-heading-font-weight' );
		$text_transform = astra_get_option( 'below-header-megamenu-heading-text-transform' );

		$common_css_output = array(
			'.ast-desktop .ast-mega-menu-enabled.ast-below-header-menu .menu-item-heading > .menu-link' => array(
				'font-family'    => astra_get_css_value( $font_family, 'font' ),
				'font-weight'    => astra_get_css_value( $font_weight, 'font' ),
				'font-size'      => astra_responsive_font( $font_size, 'desktop' ),
				'text-transform' => esc_attr( $text_transform ),
			),
		);

		// Common options of Below Header.
		$css .= astra_parse_css( $common_css_output );
	}

	if ( Astra_Ext_Extension::is_active( 'header-sections' ) ) {

		// Above header border.
		$above_header_submenu_border = astra_get_option( 'above-header-submenu-border' );

		$border = array(
			'.ast-desktop .ast-above-header .submenu-with-border .astra-full-megamenu-wrapper' => array(
				'border-top-width'    => ! empty( $above_header_submenu_border['top'] ) ? astra_get_css_value( $above_header_submenu_border['top'], 'px' ) : '',
				'border-left-width'   => ! empty( $above_header_submenu_border['left'] ) ? astra_get_css_value( $above_header_submenu_border['left'], 'px' ) : '',
				'border-right-width'  => ! empty( $above_header_submenu_border['right'] ) ? astra_get_css_value( $above_header_submenu_border['right'], 'px' ) : '',
				'border-bottom-width' => ! empty( $above_header_submenu_border['bottom'] ) ? astra_get_css_value( $above_header_submenu_border['bottom'], 'px' ) : '',
				'border-style'        => 'solid',
			),

		);

		/* Parse CSS from array() */
		$css .= astra_parse_css( $border );

		// Below header border.
		$below_header_submenu_border = astra_get_option( 'below-header-submenu-border' );

		$border = array(
			'.ast-desktop .ast-below-header .submenu-with-border .astra-full-megamenu-wrapper' => array(
				'border-top-width'    => ! empty( $below_header_submenu_border['top'] ) ? astra_get_css_value( $below_header_submenu_border['top'], 'px' ) : '',
				'border-left-width'   => ! empty( $below_header_submenu_border['left'] ) ? astra_get_css_value( $below_header_submenu_border['left'], 'px' ) : '',
				'border-right-width'  => ! empty( $below_header_submenu_border['right'] ) ? astra_get_css_value( $below_header_submenu_border['right'], 'px' ) : '',
				'border-bottom-width' => ! empty( $below_header_submenu_border['bottom'] ) ? astra_get_css_value( $below_header_submenu_border['bottom'], 'px' ) : '',
				'border-style'        => 'solid',
			),
		);

		/* Parse CSS from array() */
		$css .= astra_parse_css( $border );
	}

	if ( false === Astra_Icons::is_svg_icons() ) {
		$astra_font = array(
			'.ast-desktop .ast-mega-menu-enabled.main-header-menu > .menu-item-has-children > .menu-link .sub-arrow:after, .ast-desktop .ast-mega-menu-enabled.ast-below-header-menu > .menu-item-has-children > .menu-link .sub-arrow:after, .ast-desktop .ast-mega-menu-enabled.ast-above-header-menu > .menu-item-has-children > .menu-link .sub-arrow:after' => array(
				'content'                 => '"\e900"',
				'display'                 => 'inline-block',
				'font-family'             => 'Astra',
				'font-size'               => '9px',
				'font-size'               => '.6rem',
				'font-weight'             => 'bold',
				'text-rendering'          => 'auto',
				'-webkit-font-smoothing'  => 'antialiased',
				'-moz-osx-font-smoothing' => 'grayscale',
				'margin-left'             => '10px',
				'line-height'             => 'normal',
			),
		);
	} else {
		$astra_font = array(
			'.ast-header-break-point .menu-text + .icon-arrow, .ast-header-break-point .menu-link .icon-arrow:first-child, .ast-desktop .menu-link > .icon-arrow:first-child, .ast-header-break-point .astra-mm-highlight-label + .icon-arrow' => array(
				'display' => 'none',
			),
			'.ast-header-break-point .sub-menu .menu-link > .icon-arrow:first-child' => array(
				'display' => 'inline-block',
			),
		);
	}

	/* Parse CSS from array() */
	$css .= astra_parse_css( $astra_font );

	return $dynamic_css . $css;
}
