<?php
/**
 * Below Header - Dyanamic CSS
 *
 * @package Astra Addon
 */

add_filter( 'astra_addon_dynamic_css', 'astra_ext_below_header_dynamic_css' );

/**
 * Dynamic CSS funtion
 *
 * @param  string $dynamic_css          Astra Dynamic CSS.
 * @param  string $dynamic_css_filtered Astra Dyanamic CSS Filters.
 * @return string
 */
function astra_ext_below_header_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' ) {

	// set page width depending on site layout.
	$below_header_layout = astra_get_option( 'below-header-layout' );

	if ( 'disabled' == $below_header_layout ) {
		return $dynamic_css;
	}

	$theme_text_color = astra_get_option( 'text-color' );
	$theme_link_color = astra_get_option( 'link-color' );

	// Below Header - Height/Line-Height.
	$below_header_line_height = astra_get_option( 'below-header-height' );
	$below_header_border      = astra_get_option( 'below-header-separator' );

	// Background & Color.
	$link_color            = astra_get_option( 'link-color' );
	$link_hover_color      = astra_get_option( 'link-h-color' );
	$text_color            = astra_get_option( 'text-color' );
	$right_left_text_color = astra_get_option( 'below-header-text-color-responsive' );

	$desktop_right_left_link_color = astra_get_prop( astra_get_option( 'below-header-link-color-responsive' ), 'desktop', '#d6d6d6' );
	$tablet_right_left_link_color  = astra_get_prop( astra_get_option( 'below-header-link-color-responsive' ), 'tablet' );
	$mobile_right_left_link_color  = astra_get_prop( astra_get_option( 'below-header-link-color-responsive' ), 'mobile' );

	$desktop_right_left_link_hover_color = astra_get_prop( astra_get_option( 'below-header-link-hover-color-responsive' ), 'desktop', '#ffffff' );
	$tablet_right_left_link_hover_color  = astra_get_prop( astra_get_option( 'below-header-link-hover-color-responsive' ), 'tablet' );
	$mobile_right_left_link_hover_color  = astra_get_prop( astra_get_option( 'below-header-link-hover-color-responsive' ), 'mobile' );

	$below_header_obj        = astra_get_option( 'below-header-bg-obj-responsive' );
	$desktop_below_header_bg = isset( $below_header_obj['desktop']['background-color'] ) ? $below_header_obj['desktop']['background-color'] : '#414042';
	$tablet_below_header_bg  = isset( $below_header_obj['tablet']['background-color'] ) ? $below_header_obj['tablet']['background-color'] : '';
	$mobile_below_header_bg  = isset( $below_header_obj['mobile']['background-color'] ) ? $below_header_obj['mobile']['background-color'] : '';

	$below_header_border_color = astra_get_option( 'below-header-bottom-border-color' );

	$below_header_menu_bg_obj = astra_get_option( 'below-header-menu-bg-obj-responsive' );

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

	$below_header_submenu_border       = astra_get_option( 'below-header-submenu-border' );
	$below_header_submenu_item_border  = astra_get_option( 'below-header-submenu-item-border' );
	$below_header_submenu_item_b_color = astra_get_option( 'below-header-submenu-item-b-color' );
	$below_header_submenu_border_color = astra_get_option( 'below-header-submenu-border-color' );

	$font_size_below_header_content      = astra_get_option( 'font-size-below-header-content' );
	$font_family_below_header_content    = astra_get_option( 'font-family-below-header-content' );
	$font_weight_below_header_content    = astra_get_option( 'font-weight-below-header-content' );
	$text_transform_below_header_content = astra_get_option( 'text-transform-below-header-content' );

	$font_size_below_header_primary      = astra_get_option( 'font-size-below-header-primary-menu' );
	$font_family_below_header_primary    = astra_get_option( 'font-family-below-header-primary-menu' );
	$font_weight_below_header_primary    = astra_get_option( 'font-weight-below-header-primary-menu' );
	$text_transform_below_header_primary = astra_get_option( 'text-transform-below-header-primary-menu' );

	$font_size_below_header_dropdown      = astra_get_option( 'font-size-below-header-dropdown-menu' );
	$font_family_below_header_dropdown    = astra_get_option( 'font-family-below-header-dropdown-menu' );
	$font_weight_below_header_dropdown    = astra_get_option( 'font-weight-below-header-dropdown-menu' );
	$text_transform_below_header_dropdown = astra_get_option( 'text-transform-below-header-dropdown-menu' );

	// Header Break Point.
	$header_break_point = astra_header_break_point();

	$max_height = '26px';
	$padding    = '';
	if ( '' != $below_header_line_height && 30 < $below_header_line_height ) {
		$max_height = ( $below_header_line_height - 8 ) . 'px';
	}

	if ( 60 > $below_header_line_height ) {
		$padding = '.35em';
	}

	$parse_css = '';

	if ( false === Astra_Icons::is_svg_icons() ) {
		$astra_font = array(
			'.ast-desktop .ast-below-header-menu .sub-menu .menu-item.menu-item-has-children > .menu-link:after' => array(
				'position'  => 'absolute',
				'right'     => '1em',
				'top'       => '50%',
				'transform' => 'translate(0, -50%) rotate( 270deg )',
			),
			'.ast-desktop .ast-below-header .menu-item-has-children > .menu-link:after' => array(
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
			'.ast-header-break-point .ast-below-header-actual-nav .menu-item-has-children > .ast-menu-toggle::before' => array(
				'content'         => '"\e900"',
				'font-family'     => "'Astra'",
				'text-decoration' => 'inherit',
				'display'         => 'inline-block',
			),
			'.ast-header-break-point .ast-below-header-actual-nav .sub-menu .menu-item .menu-link:before' => array(
				'content'         => '"\e900"',
				'font-family'     => "'Astra'",
				'text-decoration' => 'inherit',
				'font-size'       => '.65em',
				'display'         => 'inline-block',
				'transform'       => 'translate(0, -2px) rotateZ(270deg)',
				'margin-right'    => '5px',
			),
		);
	} else {
		$astra_font = array(
			'.ast-header-break-point .ast-below-header-menu .menu-item .menu-link .icon-arrow:first-of-type svg' => array(
				'left'         => '.1em',
				'top'          => '.1em',
				'transform'    => 'translate(0,-2px) rotateZ( 270deg )',
				'margin-right' => '5px',
				'position'     => 'unset',
			),
		);
		if ( false === Astra_Builder_Helper::$is_header_footer_builder_active && false === Astra_Ext_Extension::is_active( 'nav-menu' ) ) {
			$astra_font['.ast-desktop .ast-below-header-menu .menu-link > .icon-arrow'] = array(
				'display' => 'none',
			);
		}
	}

	/* Parse CSS from array() */
	$parse_css .= astra_parse_css( $astra_font );

	/**
	 * [1]. Below Header General options
	 * [2]. Below Header Responsive Typography
	 * [3]. Below Header Responsive Colors
	 */

	/**
	 * [1]. Below Header General options
	 */
	$common_css_output = array(

		'.ast-below-header'                => array(
			'border-bottom-width' => astra_get_css_value( $below_header_border, 'px' ),
			'border-bottom-color' => esc_attr( $below_header_border_color ),
			'line-height'         => astra_get_css_value( $below_header_line_height, 'px' ),
		),

		'.ast-below-header-section-wrap'   => array(
			'min-height' => astra_get_css_value( $below_header_line_height, 'px' ),
		),

		'.below-header-user-select .ast-search-menu-icon .search-field' => array(
			'max-height'     => esc_attr( $max_height ),
			'padding-top'    => esc_attr( $padding ),
			'padding-bottom' => esc_attr( $padding ),
		),

		/**
		 * Below Header Navigation
		 */
		'.ast-below-header-menu'           => array(
			'font-family'    => astra_get_css_value( $font_family_below_header_primary, 'font' ),
			'font-weight'    => astra_get_css_value( $font_weight_below_header_primary, 'font' ),
			'font-size'      => astra_responsive_font( $font_size_below_header_primary, 'desktop' ),
			'text-transform' => esc_attr( $text_transform_below_header_primary ),
		),

		/**
		 * Below Header Dropdown Navigation
		 */
		'.ast-below-header-menu .sub-menu' => array(
			'font-family'    => astra_get_css_value( $font_family_below_header_dropdown, 'font' ),
			'font-weight'    => astra_get_css_value( $font_weight_below_header_dropdown, 'font' ),
			'font-size'      => astra_responsive_font( $font_size_below_header_dropdown, 'desktop' ),
			'text-transform' => esc_attr( $text_transform_below_header_dropdown ),
		),

		'.ast-below-header-menu .sub-menu, .ast-below-header-menu .astra-full-megamenu-wrapper' => array(
			'border-color' => esc_attr( $below_header_submenu_border_color ),
		),

		/**
		 * Content Colors & Typography
		 */
		'.below-header-user-select'        => array(
			'font-family'    => astra_get_css_value( $font_family_below_header_content, 'font' ),
			'font-weight'    => astra_get_css_value( $font_weight_below_header_content, 'font' ),
			'font-size'      => astra_responsive_font( $font_size_below_header_content, 'desktop' ),
			'text-transform' => esc_attr( $text_transform_below_header_content ),
		),
	);

	/**
	 * [2]. Below Header General options
	 */
	$tablet_typography_css = array(
		'.ast-below-header-menu'           => array(
			'font-size' => astra_responsive_font( $font_size_below_header_primary, 'tablet' ),
		),
		'.ast-below-header-menu .sub-menu' => array(
			'font-size' => astra_responsive_font( $font_size_below_header_dropdown, 'tablet' ),
		),
		'.below-header-user-select'        => array(
			'font-size' => astra_responsive_font( $font_size_below_header_content, 'tablet' ),
		),
	);

	$mobile_typography_css = array(
		'.ast-below-header-menu'           => array(
			'font-size' => astra_responsive_font( $font_size_below_header_primary, 'mobile' ),
		),
		'.ast-below-header-menu .sub-menu' => array(
			'font-size' => astra_responsive_font( $font_size_below_header_dropdown, 'mobile' ),
		),
		'.below-header-user-select'        => array(
			'font-size' => astra_responsive_font( $font_size_below_header_content, 'mobile' ),
		),
	);

	/**
	 * [3]. Below Header Responsive Colors
	 */
	$desktop_colors = array(
		'.ast-below-header'         => astra_get_responsive_background_obj( $below_header_obj, 'desktop' ),
		'.ast-below-header, .ast-below-header-menu .sub-menu' => array(
			'background-color' => esc_attr( $desktop_below_header_bg ),
		),
		'.ast-below-header-menu.ast-mega-menu-enabled.submenu-with-border .astra-full-megamenu-wrapper' => array(
			'background-color' => esc_attr( $desktop_below_header_bg ),
		),
		'.ast-header-break-point .ast-below-header-section-separated .ast-below-header-actual-nav' => array(
			'background-color' => esc_attr( $desktop_below_header_bg ),
		),
		'.ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-navigation-wrap, .ast-below-header-actual-nav, .ast-header-break-point .ast-below-header-actual-nav, .ast-header-break-point .ast-below-header-section-wrap .ast-below-header-actual-nav' => astra_get_background_obj( $below_header_menu_bg_obj['desktop'] ),

		/**
		 * Below Header Navigation
		 */

		'.ast-below-header-menu, .ast-below-header-menu .menu-link' => array(
			'color' => esc_attr( $below_header_menu_text['desktop'] ),
		),

		'.ast-below-header-menu .menu-item:hover > .menu-link, .ast-below-header-menu .menu-item:focus > .menu-link, .ast-below-header-menu .menu-item.focus > .menu-link' => array(
			'color'            => esc_attr( $below_header_menu_hover_color['desktop'] ),
			'background-color' => esc_attr( $below_header_menu_hover_bg_color['desktop'] ),
		),

		'.ast-below-header-menu .menu-item.current-menu-ancestor > .menu-link, .ast-below-header-menu .menu-item.current-menu-item > .menu-link, .ast-below-header-menu .menu-item.current-menu-ancestor > .ast-menu-toggle, .ast-below-header-menu .menu-item.current-menu-item > .ast-menu-toggle, .ast-below-header-menu .sub-menu .menu-item.current-menu-ancestor:hover > .menu-link, .ast-below-header-menu .sub-menu .menu-item.current-menu-ancestor:focus > .menu-link, .ast-below-header-menu .sub-menu .menu-item.current-menu-ancestor.focus > .menu-link, .ast-below-header-menu .sub-menu .menu-item.current-menu-item:hover > .menu-link, .ast-below-header-menu .sub-menu .menu-item.current-menu-item:focus > .menu-link, .ast-below-header-menu .sub-menu .menu-item.current-menu-item.focus > .menu-link, .ast-below-header-menu .sub-menu .menu-item.current-menu-ancestor:hover > .ast-menu-toggle, .ast-below-header-menu .sub-menu .menu-item.current-menu-ancestor:focus > .ast-menu-toggle, .ast-below-header-menu .sub-menu .menu-item.current-menu-ancestor.focus > .ast-menu-toggle, .ast-below-header-menu .sub-menu .menu-item.current-menu-item:hover > .ast-menu-toggle, .ast-below-header-menu .sub-menu .menu-item.current-menu-item:focus > .ast-menu-toggle, .ast-below-header-menu .sub-menu .menu-item.current-menu-item.focus > .ast-menu-toggle' => array(
			'color' => esc_attr( $below_header_menu_current_color['desktop'] ),
		),

		'.ast-below-header-menu .menu-item.current-menu-ancestor > .menu-link, .ast-below-header-menu .menu-item.current-menu-item > .menu-link, .ast-below-header-menu .sub-menu .menu-item.current-menu-ancestor:hover > .menu-link, .ast-below-header-menu .sub-menu .menu-item.current-menu-ancestor:focus > .menu-link, .ast-below-header-menu .sub-menu .menu-item.current-menu-ancestor.focus > .menu-link, .ast-below-header-menu .sub-menu .menu-item.current-menu-item:hover > .menu-link, .ast-below-header-menu .sub-menu .menu-item.current-menu-item:focus > .menu-link, .ast-below-header-menu .sub-menu .menu-item.current-menu-item.focus > .menu-link' => array(
			'background-color' => esc_attr( $below_header_menu_current_bg_color['desktop'] ),
		),

		/**
		 * Below Header Dropdown Navigation
		 */

		'.ast-below-header-menu .sub-menu .menu-item:hover > .menu-link, .ast-below-header-menu .sub-menu .menu-item:focus > .menu-link, .ast-below-header-menu .sub-menu .menu-item.focus > .menu-link' => array(
			'color'            => esc_attr( $below_header_submenu_hover_color['desktop'] ),
			'background-color' => esc_attr( $below_header_submenu_bg_hover_color['desktop'] ),
		),

		'.ast-below-header-menu .sub-menu .menu-item.current-menu-ancestor > .menu-link, .ast-below-header-menu .sub-menu .menu-item.current-menu-item > .menu-link, .ast-below-header-menu .sub-menu .menu-item.current-menu-ancestor:hover > .menu-link, .ast-below-header-menu .sub-menu .menu-item.current-menu-ancestor:focus > .menu-link, .ast-below-header-menu .sub-menu .menu-item.current-menu-ancestor.focus > .menu-link, .ast-below-header-menu .sub-menu .menu-item.current-menu-item:hover > .menu-link, .ast-below-header-menu .sub-menu .menu-item.current-menu-item:focus > .menu-link, .ast-below-header-menu .sub-menu .menu-item.current-menu-item.focus > .menu-link' => array(
			'color'            => esc_attr( $below_header_submenu_active_color['desktop'] ),
			'background-color' => esc_attr( $below_header_submenu_active_bg_color['desktop'] ),
		),

		'.ast-below-header-menu .sub-menu, .ast-below-header-menu.ast-mega-menu-enabled.submenu-with-border .astra-full-megamenu-wrapper' => array(
			'background-color' => esc_attr( $below_header_submenu_bg_color['desktop'] ),
		),

		'.ast-below-header-menu .sub-menu, .ast-below-header-menu .sub-menu .menu-link' => array(
			'color' => esc_attr( $below_header_submenu_text_color['desktop'] ),
		),

		/**
		 * Content Colors & Typography
		 */
		'.below-header-user-select .widget,.below-header-user-select .widget-title' => array(
			'color' => esc_attr( $right_left_text_color['desktop'] ),
		),

		'.below-header-user-select a, .below-header-user-select .widget a' => array(
			'color' => esc_attr( $desktop_right_left_link_color ),
		),

		'.below-header-user-select a:hover, .below-header-user-select .widget a:hover' => array(
			'color' => esc_attr( $desktop_right_left_link_hover_color ),
		),

		'.below-header-user-select input.search-field:focus, .below-header-user-select input.search-field.focus' => array(
			'border-color' => esc_attr( $desktop_right_left_link_color ),
		),
		'.below-header-user-select' => array(
			'color' => esc_attr( $right_left_text_color['desktop'] ),
		),
	);

	$tablet_colors = array(
		'.ast-below-header'         => astra_get_responsive_background_obj( $below_header_obj, 'tablet' ),
		'.ast-below-header, .ast-below-header-menu .sub-menu, .ast-below-header-menu.ast-mega-menu-enabled.submenu-with-border .astra-full-megamenu-wrapper' => array(
			'background-color' => esc_attr( $tablet_below_header_bg ),
		),
		'.ast-below-header-menu.ast-mega-menu-enabled.submenu-with-border .astra-full-megamenu-wrapper' => array(
			'background-color' => esc_attr( $tablet_below_header_bg ),
		),
		'.ast-header-break-point .ast-below-header-section-separated .ast-below-header-actual-nav' => array(
			'background-color' => esc_attr( $tablet_below_header_bg ),
		),
		'.ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-navigation-wrap, .ast-below-header-actual-nav, .ast-header-break-point .ast-below-header-actual-nav, .ast-header-break-point .ast-below-header-section-wrap .ast-below-header-actual-nav' => astra_get_background_obj( $below_header_menu_bg_obj['tablet'] ),

		/**
		 * Below Header Navigation
		 */

		'.ast-below-header-menu, .ast-below-header-menu .menu-link' => array(
			'color' => esc_attr( $below_header_menu_text['tablet'] ),
		),

		'.ast-below-header-menu .menu-item:hover > .menu-link, .ast-below-header-menu .menu-item:focus > .menu-link, .ast-below-header-menu .menu-item.focus > .menu-link' => array(
			'color'            => esc_attr( $below_header_menu_hover_color['tablet'] ),
			'background-color' => esc_attr( $below_header_menu_hover_bg_color['tablet'] ),
		),

		'.ast-below-header-menu .menu-item.current-menu-ancestor > .menu-link, .ast-below-header-menu .menu-item.current-menu-item > .menu-link, .ast-below-header-menu .menu-item.current-menu-ancestor > .ast-menu-toggle, .ast-below-header-menu .menu-item.current-menu-item > .ast-menu-toggle, .ast-below-header-menu .sub-menu .menu-item.current-menu-ancestor:hover > .menu-link, .ast-below-header-menu .sub-menu .menu-item.current-menu-ancestor:focus > .menu-link, .ast-below-header-menu .sub-menu .menu-item.current-menu-ancestor.focus > .menu-link, .ast-below-header-menu .sub-menu .menu-item.current-menu-item:hover > .menu-link, .ast-below-header-menu .sub-menu .menu-item.current-menu-item:focus > .menu-link, .ast-below-header-menu .sub-menu .menu-item.current-menu-item.focus > .menu-link, .ast-below-header-menu .sub-menu .menu-item.current-menu-ancestor:hover > .ast-menu-toggle, .ast-below-header-menu .sub-menu .menu-item.current-menu-ancestor:focus > .ast-menu-toggle, .ast-below-header-menu .sub-menu .menu-item.current-menu-ancestor.focus > .ast-menu-toggle, .ast-below-header-menu .sub-menu .menu-item.current-menu-item:hover > .ast-menu-toggle, .ast-below-header-menu .sub-menu .menu-item.current-menu-item:focus > .ast-menu-toggle, .ast-below-header-menu .sub-menu .menu-item.current-menu-item.focus > .ast-menu-toggle' => array(
			'color' => esc_attr( $below_header_menu_current_color['tablet'] ),
		),

		'.ast-below-header-menu .menu-item.current-menu-ancestor > .menu-link, .ast-below-header-menu .menu-item.current-menu-item > .menu-link, .ast-below-header-menu .sub-menu .menu-item.current-menu-ancestor:hover > .menu-link, .ast-below-header-menu .sub-menu .menu-item.current-menu-ancestor:focus > .menu-link, .ast-below-header-menu .sub-menu .menu-item.current-menu-ancestor.focus > .menu-link, .ast-below-header-menu .sub-menu .menu-item.current-menu-item:hover > .menu-link, .ast-below-header-menu .sub-menu .menu-item.current-menu-item:focus > .menu-link, .ast-below-header-menu .sub-menu .menu-item.current-menu-item.focus > .menu-link' => array(
			'background-color' => esc_attr( $below_header_menu_current_bg_color['tablet'] ),
		),

		/**
		 * Below Header Dropdown Navigation
		 */

		'.ast-below-header-menu .sub-menu .menu-item:hover > .menu-link, .ast-below-header-menu .sub-menu .menu-item:focus > .menu-link, .ast-below-header-menu .sub-menu .menu-item.focus > .menu-link' => array(
			'color'            => esc_attr( $below_header_submenu_hover_color['tablet'] ),
			'background-color' => esc_attr( $below_header_submenu_bg_hover_color['tablet'] ),
		),

		'.ast-below-header-menu .sub-menu .menu-item.current-menu-ancestor > .menu-link, .ast-below-header-menu .sub-menu .menu-item.current-menu-item > .menu-link, .ast-below-header-menu .sub-menu .menu-item.current-menu-ancestor:hover > .menu-link, .ast-below-header-menu .sub-menu .menu-item.current-menu-ancestor:focus > .menu-link, .ast-below-header-menu .sub-menu .menu-item.current-menu-ancestor.focus > .menu-link, .ast-below-header-menu .sub-menu .menu-item.current-menu-item:hover > .menu-link, .ast-below-header-menu .sub-menu .menu-item.current-menu-item:focus > .menu-link, .ast-below-header-menu .sub-menu .menu-item.current-menu-item.focus > .menu-link' => array(
			'color'            => esc_attr( $below_header_submenu_active_color['tablet'] ),
			'background-color' => esc_attr( $below_header_submenu_active_bg_color['tablet'] ),
		),

		'.ast-below-header-menu .sub-menu, .ast-below-header-menu.ast-mega-menu-enabled.submenu-with-border .astra-full-megamenu-wrapper' => array(
			'background-color' => esc_attr( $below_header_submenu_bg_color['tablet'] ),
		),

		'.ast-below-header-menu .sub-menu, .ast-below-header-menu .sub-menu .menu-link' => array(
			'color' => esc_attr( $below_header_submenu_text_color['tablet'] ),
		),

		/**
		 * Content Colors & Typography
		 */
		'.below-header-user-select .widget,.below-header-user-select .widget-title' => array(
			'color' => esc_attr( $right_left_text_color['tablet'] ),
		),

		'.below-header-user-select a, .below-header-user-select .widget a' => array(
			'color' => esc_attr( $tablet_right_left_link_color ),
		),

		'.below-header-user-select a:hover, .below-header-user-select .widget a:hover' => array(
			'color' => esc_attr( $tablet_right_left_link_hover_color ),
		),

		'.below-header-user-select input.search-field:focus, .below-header-user-select input.search-field.focus' => array(
			'border-color' => esc_attr( $tablet_right_left_link_color ),
		),
		'.below-header-user-select' => array(
			'color' => esc_attr( $right_left_text_color['tablet'] ),
		),
	);

	$mobile_colors = array(
		'.ast-below-header'         => astra_get_responsive_background_obj( $below_header_obj, 'mobile' ),
		'.ast-below-header, .ast-below-header-menu .sub-menu, .ast-below-header-menu.ast-mega-menu-enabled.submenu-with-border .astra-full-megamenu-wrapper' => array(
			'background-color' => esc_attr( $mobile_below_header_bg ),
		),
		'.ast-below-header-menu.ast-mega-menu-enabled.submenu-with-border .astra-full-megamenu-wrapper' => array(
			'background-color' => esc_attr( $mobile_below_header_bg ),
		),
		'.ast-header-break-point .ast-below-header-section-separated .ast-below-header-actual-nav' => array(
			'background-color' => esc_attr( $mobile_below_header_bg ),
		),
		'.ast-no-toggle-below-menu-enable.ast-header-break-point .ast-below-header-navigation-wrap, .ast-below-header-actual-nav, .ast-header-break-point .ast-below-header-actual-nav, .ast-header-break-point .ast-below-header-section-wrap .ast-below-header-actual-nav' => astra_get_background_obj( $below_header_menu_bg_obj['mobile'] ),

		/**
		 * Below Header Navigation
		 */

		'.ast-below-header-menu, .ast-below-header-menu .menu-link' => array(
			'color' => esc_attr( $below_header_menu_text['mobile'] ),
		),

		'.ast-below-header-menu .menu-item:hover > .menu-link, .ast-below-header-menu .menu-item:focus > .menu-link, .ast-below-header-menu .menu-item.focus > .menu-link' => array(
			'color'            => esc_attr( $below_header_menu_hover_color['mobile'] ),
			'background-color' => esc_attr( $below_header_menu_hover_bg_color['mobile'] ),
		),

		'.ast-below-header-menu .menu-item.current-menu-ancestor > .menu-link, .ast-below-header-menu .menu-item.current-menu-item > .menu-link, .ast-below-header-menu .menu-item.current-menu-ancestor > .ast-menu-toggle, .ast-below-header-menu .menu-item.current-menu-item > .ast-menu-toggle, .ast-below-header-menu .sub-menu .menu-item.current-menu-ancestor:hover > .menu-link, .ast-below-header-menu .sub-menu .menu-item.current-menu-ancestor:focus > .menu-link, .ast-below-header-menu .sub-menu .menu-item.current-menu-ancestor.focus > .menu-link, .ast-below-header-menu .sub-menu .menu-item.current-menu-item:hover > .menu-link, .ast-below-header-menu .sub-menu .menu-item.current-menu-item:focus > .menu-link, .ast-below-header-menu .sub-menu .menu-item.current-menu-item.focus > .menu-link, .ast-below-header-menu .sub-menu .menu-item.current-menu-ancestor:hover > .ast-menu-toggle, .ast-below-header-menu .sub-menu .menu-item.current-menu-ancestor:focus > .ast-menu-toggle, .ast-below-header-menu .sub-menu .menu-item.current-menu-ancestor.focus > .ast-menu-toggle, .ast-below-header-menu .sub-menu .menu-item.current-menu-item:hover > .ast-menu-toggle, .ast-below-header-menu .sub-menu .menu-item.current-menu-item:focus > .ast-menu-toggle, .ast-below-header-menu .sub-menu .menu-item.current-menu-item.focus > .ast-menu-toggle' => array(
			'color' => esc_attr( $below_header_menu_current_color['mobile'] ),
		),

		'.ast-below-header-menu .menu-item.current-menu-ancestor > .menu-link, .ast-below-header-menu .menu-item.current-menu-item > .menu-link, .ast-below-header-menu .sub-menu .menu-item.current-menu-ancestor:hover > .menu-link, .ast-below-header-menu .sub-menu .menu-item.current-menu-ancestor:focus > .menu-link, .ast-below-header-menu .sub-menu .menu-item.current-menu-ancestor.focus > .menu-link, .ast-below-header-menu .sub-menu .menu-item.current-menu-item:hover > .menu-link, .ast-below-header-menu .sub-menu .menu-item.current-menu-item:focus > .menu-link, .ast-below-header-menu .sub-menu .menu-item.current-menu-item.focus > .menu-link' => array(
			'background-color' => esc_attr( $below_header_menu_current_bg_color['mobile'] ),
		),

		/**
		 * Below Header Dropdown Navigation
		 */

		'.ast-below-header-menu .sub-menu .menu-item:hover > .menu-link, .ast-below-header-menu .sub-menu .menu-item:focus > .menu-link, .ast-below-header-menu .sub-menu .menu-item.focus > .menu-link' => array(
			'color'            => esc_attr( $below_header_submenu_hover_color['mobile'] ),
			'background-color' => esc_attr( $below_header_submenu_bg_hover_color['mobile'] ),
		),

		'.ast-below-header-menu .sub-menu .menu-item.current-menu-ancestor > .menu-link, .ast-below-header-menu .sub-menu .menu-item.current-menu-item > .menu-link, .ast-below-header-menu .sub-menu .menu-item.current-menu-ancestor:hover > .menu-link, .ast-below-header-menu .sub-menu .menu-item.current-menu-ancestor:focus > .menu-link, .ast-below-header-menu .sub-menu .menu-item.current-menu-ancestor.focus > .menu-link, .ast-below-header-menu .sub-menu .menu-item.current-menu-item:hover > .menu-link, .ast-below-header-menu .sub-menu .menu-item.current-menu-item:focus > .menu-link, .ast-below-header-menu .sub-menu .menu-item.current-menu-item.focus > .menu-link' => array(
			'color'            => esc_attr( $below_header_submenu_active_color['mobile'] ),
			'background-color' => esc_attr( $below_header_submenu_active_bg_color['mobile'] ),
		),

		'.ast-below-header-menu .sub-menu, .ast-below-header-menu.ast-mega-menu-enabled.submenu-with-border .astra-full-megamenu-wrapper' => array(
			'background-color' => esc_attr( $below_header_submenu_bg_color['mobile'] ),
		),

		'.ast-below-header-menu .sub-menu, .ast-below-header-menu .sub-menu .menu-link' => array(
			'color' => esc_attr( $below_header_submenu_text_color['mobile'] ),
		),

		/**
		 * Content Colors & Typography
		 */
		'.below-header-user-select .widget,.below-header-user-select .widget-title' => array(
			'color' => esc_attr( $right_left_text_color['mobile'] ),
		),

		'.below-header-user-select a, .below-header-user-select .widget a' => array(
			'color' => esc_attr( $mobile_right_left_link_color ),
		),

		'.below-header-user-select a:hover, .below-header-user-select .widget a:hover' => array(
			'color' => esc_attr( $mobile_right_left_link_hover_color ),
		),

		'.below-header-user-select input.search-field:focus, .below-header-user-select input.search-field.focus' => array(
			'border-color' => esc_attr( $mobile_right_left_link_color ),
		),
		'.below-header-user-select' => array(
			'color' => esc_attr( $right_left_text_color['mobile'] ),
		),
	);

	// Common options of Below Header.
	$parse_css .= astra_parse_css( $common_css_output );

	// Below Header Responsive Typography.
	$parse_css .= astra_parse_css( $tablet_typography_css, '', astra_addon_get_tablet_breakpoint() );
	$parse_css .= astra_parse_css( $mobile_typography_css, '', astra_addon_get_mobile_breakpoint() );

	// Below Header Responsive Colors.
	$parse_css .= astra_parse_css( $desktop_colors );
	$parse_css .= astra_parse_css( $tablet_colors, '', astra_addon_get_tablet_breakpoint() );
	$parse_css .= astra_parse_css( $mobile_colors, '', astra_addon_get_mobile_breakpoint() );

	/**
	 * Hide the default naviagtion markup for responsive devices.
	 * Once class .ast-header-break-point is added to the body below CSS will be override by the
	 * .ast-header-break-point class
	 */
	$astra_navigation = array(
		'.ast-below-header-actual-nav, .ast-below-header-hide-on-mobile .ast-below-header-wrap' => array(
			'display' => esc_attr( 'none' ),
		),
	);
	$parse_css       .= astra_parse_css( $astra_navigation, '', $header_break_point );

	// Below header border.
	$border = array(
		'.ast-desktop .ast-below-header-menu.submenu-with-border .sub-menu .menu-link' => array(
			'border-bottom-width' => ( true == $below_header_submenu_item_border ) ? '1px' : '0px',
			'border-style'        => 'solid',
			'border-color'        => esc_attr( $below_header_submenu_item_b_color ),
		),
		'.ast-desktop .ast-below-header-menu.submenu-with-border .sub-menu .sub-menu' => array(
			'top' => ( isset( $below_header_submenu_border['top'] ) && '' != $below_header_submenu_border['top'] ) ? astra_get_css_value( '-' . $below_header_submenu_border['top'], 'px' ) : '',
		),
		'.ast-desktop .ast-below-header-menu.submenu-with-border .sub-menu' => array(
			'border-top-width'    => astra_get_css_value( $below_header_submenu_border['top'], 'px' ),
			'border-left-width'   => astra_get_css_value( $below_header_submenu_border['left'], 'px' ),
			'border-right-width'  => astra_get_css_value( $below_header_submenu_border['right'], 'px' ),
			'border-bottom-width' => astra_get_css_value( $below_header_submenu_border['bottom'], 'px' ),
			'border-style'        => 'solid',
		),
	);

	// Submenu items goes outside?
	$submenu_border_for_left_align_menu = array(
		'.ast-below-header-menu .sub-menu .menu-item.ast-left-align-sub-menu:hover > .sub-menu, .ast-below-header-menu .sub-menu .menu-item.ast-left-align-sub-menu.focus > .sub-menu' => array(
			'margin-left' => ( ( isset( $below_header_submenu_border['left'] ) && '' != $below_header_submenu_border['left'] ) || isset( $below_header_submenu_border['right'] ) && '' != $below_header_submenu_border['right'] ) ? astra_get_css_value( '-' . ( $below_header_submenu_border['left'] + $below_header_submenu_border['right'] ), 'px' ) : '',
		),
	);

	/* Parse CSS from array() */
	$parse_css .= astra_parse_css( $border );
	// Submenu items goes outside?
	$parse_css .= astra_parse_css( $submenu_border_for_left_align_menu, astra_addon_get_tablet_breakpoint( '', 1 ) );

	if ( astra_addon_swap_mobile_below_header_sections() ) {

		$swap_mobile_below_header_sections = array(
			'.ast-header-break-point .ast-swap-below-header-sections .below-header-section-1' => array(
				'order'           => 2,
				'justify-content' => 'flex-end',
			),
			'.ast-header-break-point .ast-swap-below-header-sections .below-header-section-2' => array(
				'order'           => 1,
				'justify-content' => 'flex-start',
			),
		);
		$parse_css                        .= astra_parse_css( $swap_mobile_below_header_sections );
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
function astra_addon_swap_mobile_below_header_sections() {
	$astra_settings                                        = get_option( ASTRA_THEME_SETTINGS );
	$astra_settings['support-swap-mobile-header-sections'] = isset( $astra_settings['support-swap-mobile-header-sections'] ) ? false : true;
	return apply_filters( 'astra_apply_swap_mobile_header_sections_css', $astra_settings['support-swap-mobile-header-sections'] );
}
