<?php
/**
 * Advanced Headers - Dynamic CSS
 *
 * @package Astra Addon
 */

add_filter( 'astra_dynamic_css', 'astra_ext_advanced_headers_dynamic_css', 20 );

/**
 * Dynamic CSS
 *
 * @param  string $dynamic_css          Astra Dynamic CSS.
 * @param  string $dynamic_css_filtered Astra Dynamic CSS Filters.
 * @return string
 */
function astra_ext_advanced_headers_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' ) {

	if ( is_front_page() && 'posts' == get_option( 'show_on_front' ) ) {
		return $dynamic_css;
	}

	// Layout options.
	$advanced_headers_layout = Astra_Ext_Advanced_Headers_Loader::astra_advanced_headers_layout_option( 'layout' );
	$advanced_headers_merged = Astra_Ext_Advanced_Headers_Loader::astra_advanced_headers_layout_option( 'merged' );
	$above_header_enabled    = Astra_Ext_Advanced_Headers_Loader::astra_advanced_headers_layout_option( 'above-header-enabled' );
	$below_header_enabled    = Astra_Ext_Advanced_Headers_Loader::astra_advanced_headers_layout_option( 'below-header-enabled' );

	// Design options.
	$logo_url           = Astra_Ext_Advanced_Headers_Loader::astra_advanced_headers_design_option( 'logo-url' );
	$page_post_featured = Astra_Ext_Advanced_Headers_Loader::astra_advanced_headers_design_option( 'page-post-featured' );
	$bg_image           = Astra_Ext_Advanced_Headers_Loader::astra_advanced_headers_design_option( 'bg-image' );
	$header_logo_width  = Astra_Ext_Advanced_Headers_Loader::astra_advanced_headers_design_option( 'header-logo-width' );
	$parallax_device    = Astra_Ext_Advanced_Headers_Loader::astra_advanced_headers_design_option( 'parallax-device' );

	// Title Colors.
	$title_color = Astra_Ext_Advanced_Headers_Loader::astra_advanced_headers_design_option( 'title-color' );
	if ( $advanced_headers_merged && 'disable' == $advanced_headers_layout ) {
		$title_color = '';
	}
	$breadcrumb_color = Astra_Ext_Advanced_Headers_Loader::astra_advanced_headers_design_option( 'b-text-color', $title_color );

	// Breadcrumb Fall-back Colors.
	$breadcrumb_fb_link_color = $title_color;
	// Breadcrumb link hover Fall-back Colors.
	$breadcrumb_fb_link_h_color = $title_color;
	$breadcrumb_link_color      = Astra_Ext_Advanced_Headers_Loader::astra_advanced_headers_design_option( 'b-link-color' );
	if ( $breadcrumb_link_color ) {
		$breadcrumb_fb_link_color   = $breadcrumb_link_color;
		$breadcrumb_fb_link_h_color = $breadcrumb_link_color;
	}

	$breadcrumb_link_h_color = Astra_Ext_Advanced_Headers_Loader::astra_advanced_headers_design_option( 'b-link-hover-color' );

	if ( $breadcrumb_link_h_color ) {
		$breadcrumb_fb_link_h_color = $breadcrumb_link_h_color;
	}

	$bg_color = Astra_Ext_Advanced_Headers_Loader::astra_advanced_headers_design_option( 'background-color', '' );

	$overlay_bg_color = Astra_Ext_Advanced_Headers_Loader::astra_advanced_headers_design_option( 'overlay-bg-color', '' );

	$header_bg_color           = Astra_Ext_Advanced_Headers_Loader::astra_advanced_headers_design_option( 'header-bg-color', '' );
	$header_color_site_title   = Astra_Ext_Advanced_Headers_Loader::astra_advanced_headers_design_option( 'site-title-color', '' );
	$header_color_h_site_title = Astra_Ext_Advanced_Headers_Loader::astra_advanced_headers_design_option( 'site-title-h-color', '' );
	$header_color_site_tagline = Astra_Ext_Advanced_Headers_Loader::astra_advanced_headers_design_option( 'site-tagline-color', '' );

	$header_main_sep       = Astra_Ext_Advanced_Headers_Loader::astra_advanced_headers_design_option( 'header-main-sep', 0 );
	$header_main_sep_color = Astra_Ext_Advanced_Headers_Loader::astra_advanced_headers_design_option( 'header-main-sep-color', 'transparent' );

	// Site fall back color.
	$header_color_site_fb_title   = $title_color;
	$header_color_site_h_fb_title = $title_color;
	$header_color_site_tagline_fb = $title_color;
	if ( $header_color_site_title ) {
		$header_color_site_fb_title   = $header_color_site_title;
		$header_color_site_h_fb_title = $header_color_site_title;
		$header_color_site_tagline_fb = $header_color_site_title;
	}
	if ( $header_color_h_site_title ) {
		$header_color_site_h_fb_title = $header_color_h_site_title;
	}
	if ( $header_color_site_tagline ) {
		$header_color_site_tagline_fb = $header_color_site_tagline;
	}

	// Primary menu Colors.
	$primary_menu_bg_color = Astra_Ext_Advanced_Headers_Loader::astra_advanced_headers_design_option( 'primary-menu-bg-color', 'transparent' );
	$primary_menu_color    = Astra_Ext_Advanced_Headers_Loader::astra_advanced_headers_design_option( 'primary-menu-color' );
	$primary_menu_h_color  = Astra_Ext_Advanced_Headers_Loader::astra_advanced_headers_design_option( 'primary-menu-h-color' );
	$primary_menu_a_color  = Astra_Ext_Advanced_Headers_Loader::astra_advanced_headers_design_option( 'primary-menu-a-color' );

	// Primary menu fall-back colors.
	$primary_menu_fb_color   = $title_color;
	$primary_menu_h_fb_color = $title_color;
	$primary_menu_a_fb_color = $title_color;

	if ( $primary_menu_color ) {
		$primary_menu_fb_color   = $primary_menu_color;
		$primary_menu_h_fb_color = $primary_menu_color;
		$primary_menu_a_fb_color = $primary_menu_color;
	}
	if ( $primary_menu_h_color ) {
		$primary_menu_h_fb_color = $primary_menu_h_color;
		$primary_menu_a_fb_color = $primary_menu_h_color;
	}
	if ( $primary_menu_a_color ) {
		$primary_menu_a_fb_color = $primary_menu_a_color;
	}

	// Primary Header -> Submenu Colors.
	$primary_header_submenu_bg_color               = Astra_Ext_Advanced_Headers_Loader::astra_advanced_headers_design_option( 'primary-submenu-bg-color' );
	$primary_header_submenu_text_color             = Astra_Ext_Advanced_Headers_Loader::astra_advanced_headers_design_option( 'primary-submenu-color' );
	$primary_header_submenu_text_link_hover_color  = Astra_Ext_Advanced_Headers_Loader::astra_advanced_headers_design_option( 'primary-submenu-h-color' );
	$primary_header_submenu_text_link_active_color = Astra_Ext_Advanced_Headers_Loader::astra_advanced_headers_design_option( 'primary-submenu-a-color' );

	// Above Header Colors.
	$above_header_bg_color          = Astra_Ext_Advanced_Headers_Loader::astra_advanced_headers_design_option( 'above-header-bg-color' );
	$above_header_text_link_color   = Astra_Ext_Advanced_Headers_Loader::astra_advanced_headers_design_option( 'above-header-text-link-color' );
	$above_header_text_link_h_color = Astra_Ext_Advanced_Headers_Loader::astra_advanced_headers_design_option( 'above-header-h-color' );
	$above_header_text_link_a_color = Astra_Ext_Advanced_Headers_Loader::astra_advanced_headers_design_option( 'above-header-a-color' );

	// Above Header fall-back colors.
	$above_header_text_link_fb_color   = $title_color;
	$above_header_text_link_h_fb_color = $title_color;
	$above_header_text_link_a_fb_color = $title_color;

	if ( $above_header_text_link_color ) {
		$above_header_text_link_fb_color   = $above_header_text_link_color;
		$above_header_text_link_h_fb_color = $above_header_text_link_color;
		$above_header_text_link_a_fb_color = $above_header_text_link_color;
	}
	if ( $above_header_text_link_h_color ) {
		$above_header_text_link_h_fb_color = $above_header_text_link_h_color;
		$above_header_text_link_a_fb_color = $above_header_text_link_h_color;
	}
	if ( $above_header_text_link_a_color ) {
		$above_header_text_link_a_fb_color = $above_header_text_link_a_color;
	}

	// Above Header -> Submenu Colors.
	$above_header_submenu_bg_color             = Astra_Ext_Advanced_Headers_Loader::astra_advanced_headers_design_option( 'above-header-submenu-bg-color' );
	$above_header_submenu_text_link_fb_color   = Astra_Ext_Advanced_Headers_Loader::astra_advanced_headers_design_option( 'above-header-submenu-link-color' );
	$above_header_submenu_text_link_h_fb_color = Astra_Ext_Advanced_Headers_Loader::astra_advanced_headers_design_option( 'above-header-submenu-h-color' );
	$above_header_submenu_text_link_a_fb_color = Astra_Ext_Advanced_Headers_Loader::astra_advanced_headers_design_option( 'above-header-submenu-a-color' );

	// Below Header Colors.
	$below_header_bg_color          = Astra_Ext_Advanced_Headers_Loader::astra_advanced_headers_design_option( 'below-header-bg-color' );
	$below_header_text_link_color   = Astra_Ext_Advanced_Headers_Loader::astra_advanced_headers_design_option( 'below-header-text-link-color' );
	$below_header_text_link_h_color = Astra_Ext_Advanced_Headers_Loader::astra_advanced_headers_design_option( 'below-header-h-color' );
	$below_header_text_link_a_color = Astra_Ext_Advanced_Headers_Loader::astra_advanced_headers_design_option( 'below-header-a-color' );

	// Below Header fall-back colors.
	$below_header_text_link_fb_color   = $title_color;
	$below_header_text_link_h_fb_color = $title_color;
	$below_header_text_link_a_fb_color = $title_color;

	if ( $below_header_text_link_color ) {
		$below_header_text_link_fb_color   = $below_header_text_link_color;
		$below_header_text_link_h_fb_color = $below_header_text_link_color;
		$below_header_text_link_a_fb_color = $below_header_text_link_color;
	}
	if ( $below_header_text_link_h_color ) {
		$below_header_text_link_h_fb_color = $below_header_text_link_h_color;
		$below_header_text_link_a_fb_color = $below_header_text_link_h_color;
	}
	if ( $below_header_text_link_a_color ) {
		$below_header_text_link_a_fb_color = $below_header_text_link_a_color;
	}

	// Below Header -> Submenu Colors.
	$below_header_submenu_bg_color             = Astra_Ext_Advanced_Headers_Loader::astra_advanced_headers_design_option( 'below-header-submenu-bg-color' );
	$below_header_submenu_text_link_fb_color   = Astra_Ext_Advanced_Headers_Loader::astra_advanced_headers_design_option( 'below-header-submenu-link-color' );
	$below_header_submenu_text_link_h_fb_color = Astra_Ext_Advanced_Headers_Loader::astra_advanced_headers_design_option( 'below-header-submenu-h-color' );
	$below_header_submenu_text_link_a_fb_color = Astra_Ext_Advanced_Headers_Loader::astra_advanced_headers_design_option( 'below-header-submenu-a-color' );

	$background_size            = Astra_Ext_Advanced_Headers_Loader::astra_advanced_headers_design_option( 'bg-size' );
	$custom_background_top_p    = Astra_Ext_Advanced_Headers_Loader::astra_advanced_headers_design_option( 'bg-custom-size-top-padding' );
	$custom_background_bottom_p = Astra_Ext_Advanced_Headers_Loader::astra_advanced_headers_design_option( 'bg-custom-size-bottom-padding' );

	// Header Break Point.
	$header_break_point = astra_header_break_point();

	// If advanced header disabled.
	$title_bar_bg_img = '';

	if ( ( is_archive() || is_search() || is_404() || is_home() ) && $bg_image ) {
		$title_bar_bg_img = $bg_image;
	} else {
		// If selected Post / Page Featured image.
		if ( 'enabled' == $page_post_featured ) {

			if ( has_post_thumbnail( get_the_ID() ) ) {
					$src              = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'thumbnail_size' );
					$title_bar_bg_img = $src[0];
			} else {
				// Custom Background Image.
				if ( $bg_image ) {
					$title_bar_bg_img = $bg_image;
				}
			}
		} else {
			// Custom Background Image.
			if ( $bg_image ) {
				$title_bar_bg_img = $bg_image;
			}
		}
	}

	$title_bar_bg_img = apply_filters( 'astra_advanced_headers_title_bar_bg', $title_bar_bg_img, $page_post_featured );

	// Custom Background Size.
	$custom_top_padding    = '';
	$custom_bottom_padding = '';
	if ( 'custom-bg-size' == $background_size ) {

		$custom_top_padding = $custom_background_top_p;
		if ( is_numeric( $custom_background_top_p ) ) {
			$custom_top_padding = $custom_background_top_p . '%';
		}
		$custom_bottom_padding = $custom_background_bottom_p;
		if ( is_numeric( $custom_background_bottom_p ) ) {
			$custom_bottom_padding = $custom_background_bottom_p . '%';
		}
	}

	$parse_css              = '';
	$adv_header_logo_output = array(
		'.ast-advanced-headers-different-logo .advanced-header-logo, .ast-header-break-point .ast-has-mobile-header-logo .advanced-header-logo' => array(
			'display' => 'inline-block',
		),
		'.ast-header-break-point.ast-advanced-headers-different-logo .ast-has-mobile-header-logo .ast-mobile-header-logo' => array(
			'display' => 'none',
		),
	);

	if ( true == Astra_Addon_Builder_Helper::apply_flex_based_css() ) {

		$flex_based_page_header_layout_2 = array(
			'.ast-advanced-headers-layout.ast-advanced-headers-layout-2 .ast-container' => array(
				'flex-direction' => 'column',
			),
		);
		$parse_css                      .= astra_parse_css( $flex_based_page_header_layout_2 );
	}

	$parse_css .= astra_parse_css( $adv_header_logo_output );

	if ( 'disable' !== $advanced_headers_layout ) {

		$page_header = array(
			'.ast-title-bar-wrap header .site-logo-img .custom-logo-link img' => array(
				'max-width' => astra_get_css_value( $header_logo_width, 'px' ),
			),
		);
		$parse_css  .= astra_parse_css( $page_header );

		/**
		 * Above Header Style
		 */
		$css_output = array(
			'.ast-advanced-headers-layout' => array(
				'padding-top'    => esc_attr( $custom_top_padding ),
				'padding-bottom' => esc_attr( $custom_bottom_padding ),
				'width'          => '100%',
			),
			'.ast-advanced-headers-wrap, .ast-advanced-headers-title' => array(
				'color' => esc_attr( $title_color ),
			),

			'.ast-advanced-headers-breadcrumb, .ast-advanced-headers-breadcrumb .woocommerce-breadcrumb' => array(
				'color' => esc_attr( $breadcrumb_color ),
			),

			'.ast-advanced-headers-breadcrumb a, .woocommerce .ast-advanced-headers-breadcrumb a' => array(
				'color' => esc_attr( $breadcrumb_fb_link_color ),
			),

			'.ast-advanced-headers-breadcrumb a:hover, .woocommerce .ast-advanced-headers-breadcrumb a:hover' => array(
				'color' => esc_attr( $breadcrumb_fb_link_h_color ),
			),

		);
		$parse_css .= astra_parse_css( $css_output );
		// merge page with site header enabled.
		if ( $advanced_headers_merged ) {

			$above_header_style = '';
			$below_header_style = '';

			$merge_header_style = array(
				/**
				 * Header
				 */
				'.ast-advanced-headers .main-header-bar' => array(
					'background-color' => esc_attr( $header_bg_color ),
				),
				'.ast-advanced-headers .site-title a, .site-title a:focus, .ast-advanced-headers .site-title a:hover, .ast-advanced-headers .site-title a:visited' => array(
					'color' => esc_attr( $header_color_site_fb_title ),
				),
				'.ast-advanced-headers .site-header .site-title a:hover' => array(
					'color' => esc_attr( $header_color_site_h_fb_title ),
				),
				'.ast-advanced-headers .site-header .site-description' => array(
					'color' => esc_attr( $header_color_site_tagline_fb ),
				),

				/**
				 * Primary Menu
				 */
				'.ast-advanced-headers .main-header-menu, .ast-advanced-headers.ast-header-break-point .main-header-menu, .ast-advanced-headers .ast-masthead-custom-menu-items' => array(
					'background-color' => esc_attr( $primary_menu_bg_color ),
				),
				'.ast-advanced-headers .main-header-menu > .menu-item.current-menu-ancestor > .menu-link, .ast-advanced-headers .main-header-menu > .menu-item.current-menu-item > .menu-link' => array(
					'color' => esc_attr( $primary_menu_a_fb_color ),
				),
				'.ast-advanced-headers .main-header-menu > .menu-item > .menu-link:hover, .ast-advanced-headers .main-header-menu > .menu-item:hover > .menu-link' => array(
					'color' => esc_attr( $primary_menu_h_fb_color ),
				),
				'.ast-advanced-headers .main-header-menu .ast-masthead-custom-menu-items a:hover' => array(
					'color' => esc_attr( $primary_menu_h_fb_color ),
				),
				'.ast-advanced-headers .main-header-menu, .ast-advanced-headers .main-header-menu > .menu-item > .menu-link, .ast-advanced-headers .ast-masthead-custom-menu-items, .ast-advanced-headers .ast-masthead-custom-menu-items a' => array(
					'color' => esc_attr( $primary_menu_fb_color ),
				),

				/**
				 * Primary Submenu
				 */
				'.ast-advanced-headers .main-navigation .sub-menu, .ast-advanced-headers.ast-header-break-point .main-header-menu .sub-menu, .ast-advanced-headers .ast-header-sections-navigation div > .menu-item > .sub-menu, .ast-advanced-headers .ast-above-header-menu-items .menu-item > .sub-menu, .ast-advanced-headers .ast-below-header-menu-items .menu-item > .sub-menu' => array(
					'background-color' => esc_attr( $primary_header_submenu_bg_color ),
				),
				'.ast-advanced-headers .main-header-menu .sub-menu, .ast-advanced-headers .main-header-menu .sub-menu .menu-link' => array(
					'color' => esc_attr( $primary_header_submenu_text_color ),
				),
				'.ast-advanced-headers .main-header-menu .sub-menu .menu-link:hover, .ast-advanced-headers .main-header-menu .sub-menu .menu-item:hover > .menu-link, .ast-advanced-headers .main-header-menu .sub-menu .menu-item.focus > .menu-link' => array(
					'color' => esc_attr( $primary_header_submenu_text_link_hover_color ),
				),
				'.ast-advanced-headers .main-header-menu .sub-menu .menu-item:hover > .ast-menu-toggle, .ast-advanced-headers .main-header-menu .sub-menu .menu-item.focus > .ast-menu-toggle' => array(
					'color' => esc_attr( $primary_header_submenu_text_link_hover_color ),
				),
				'.ast-advanced-headers .main-header-menu .sub-menu .menu-item.current-menu-ancestor > .menu-link, .ast-advanced-headers.ast-header-break-point .main-header-menu .sub-menu .menu-item.current-menu-item > .menu-link, .ast-advanced-headers .main-header-menu .sub-menu .menu-item.current-menu-item > .menu-link, .ast-advanced-headers.ast-desktop .ast-mega-menu-enabled.main-header-menu .sub-menu .menu-item-heading.current-menu-item' => array(
					'color' => esc_attr( $primary_header_submenu_text_link_active_color ),
				),
			);

			if ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) {
				$merge_header_style = array(
					/**
					 * Header
					 */
					'.ast-advanced-headers .main-header-bar' => array(
						'background-color' => esc_attr( $header_bg_color ),
					),
					'.ast-advanced-headers .site-title a, .site-title a:focus, .ast-advanced-headers .site-title a:hover, .ast-advanced-headers .site-title a:visited' => array(
						'color' => esc_attr( $header_color_site_fb_title ),
					),
					'.ast-advanced-headers .site-header .site-title a:hover' => array(
						'color' => esc_attr( $header_color_site_h_fb_title ),
					),
					'.ast-advanced-headers .site-header .site-description' => array(
						'color' => esc_attr( $header_color_site_tagline_fb ),
					),

					/**
					 * Primary Menu
					 */
					'.ast-advanced-headers .ast-primary-header .main-header-menu, .ast-advanced-headers.ast-header-break-point #ast-mobile-popup-wrapper .main-header-menu' => array(
						'background-color' => esc_attr( $primary_menu_bg_color ),
					),
					'.ast-advanced-headers .ast-primary-header .main-header-menu > .menu-item.current-menu-ancestor > .menu-link, .ast-advanced-headers .ast-primary-header .main-header-menu > .menu-item.current-menu-item > .menu-link' => array(
						'color' => esc_attr( $primary_menu_a_fb_color ),
					),
					'.ast-advanced-headers .ast-primary-header .main-header-menu > .menu-item > .menu-link:hover, .ast-advanced-headers .ast-primary-header .main-header-menu > .menu-item:hover > .menu-link' => array(
						'color' => esc_attr( $primary_menu_h_fb_color ),
					),
					'.ast-advanced-headers .ast-primary-header .main-header-menu, .ast-advanced-headers .ast-primary-header .main-header-menu > .menu-item > .menu-link' => array(
						'color' => esc_attr( $primary_menu_fb_color ),
					),

					/**
					 * Primary Submenu
					 */
					'.ast-advanced-headers .ast-primary-header .main-navigation .sub-menu' => array(
						'background-color' => esc_attr( $primary_header_submenu_bg_color ),
					),
					'.ast-advanced-headers .ast-primary-header .main-header-menu .sub-menu, .ast-advanced-headers .ast-primary-header .main-header-menu .sub-menu .menu-link' => array(
						'color' => esc_attr( $primary_header_submenu_text_color ),
					),
					'.ast-advanced-headers .ast-primary-header .main-header-menu .sub-menu .menu-link:hover, .ast-advanced-headers .ast-primary-header .main-header-menu .sub-menu .menu-item:hover > .menu-link, .ast-advanced-headers .ast-primary-header .main-header-menu .sub-menu .menu-item.focus > .menu-link' => array(
						'color' => esc_attr( $primary_header_submenu_text_link_hover_color ),
					),
					'.ast-advanced-headers .ast-primary-header .main-header-menu .sub-menu .menu-item:hover > .ast-menu-toggle, .ast-advanced-headers .ast-primary-header .main-header-menu .sub-menu .menu-item.focus > .ast-menu-toggle' => array(
						'color' => esc_attr( $primary_header_submenu_text_link_hover_color ),
					),
					'.ast-advanced-headers .ast-primary-header .main-header-menu .sub-menu .menu-item.current-menu-ancestor > .menu-link, .ast-advanced-headers.ast-header-break-point .ast-primary-header .main-header-menu .sub-menu .menu-item.current-menu-item > .menu-link, .ast-advanced-headers .ast-primary-header .main-header-menu .sub-menu .menu-item.current-menu-item > .menu-link, .ast-advanced-headers.ast-desktop .ast-primary-header .ast-mega-menu-enabled.main-header-menu .sub-menu .menu-item-heading.current-menu-item' => array(
						'color' => esc_attr( $primary_header_submenu_text_link_active_color ),
					),
				);
			}

			$parse_css                                        .= astra_parse_css( $merge_header_style );
			$is_page_headers_designs_compatible_builder_layout = apply_filters( 'astra_addon_page_header_options_compatibility', astra_get_option( 'can-update-page-header-compatibility-to-header-builder', false ) );

			// Above Headder enabled.
			if ( true === astra_addon_builder_helper()->is_header_footer_builder_active && Astra_Addon_Builder_Helper::is_row_empty( 'above', 'header', 'desktop' ) ) {
				/**
				 * Above Heaader
				*/
				$above_header_style = array(
					/**
					 * Above Header Menus
					 */
					'.ast-advanced-headers .ast-above-header .main-header-menu, .ast-advanced-headers.ast-header-break-point #ast-mobile-popup-wrapper .main-header-menu' => array(
						'background-color' => esc_attr( $above_header_bg_color ),
					),
					'.ast-advanced-headers .ast-above-header .main-header-menu > .menu-item.current-menu-ancestor > .menu-link, .ast-advanced-headers .ast-above-header .main-header-menu > .menu-item.current-menu-item > .menu-link' => array(
						'color' => esc_attr( $above_header_text_link_a_fb_color ),
					),
					'.ast-advanced-headers .ast-above-header .main-header-menu > .menu-item > .menu-link:hover, .ast-advanced-headers .ast-above-header .main-header-menu > .menu-item:hover > .menu-link' => array(
						'color' => esc_attr( $above_header_text_link_h_fb_color ),
					),
					'.ast-advanced-headers .ast-above-header .main-header-menu, .ast-advanced-headers .ast-above-header .main-header-menu > .menu-item > .menu-link' => array(
						'color' => esc_attr( $above_header_text_link_fb_color ),
					),

					/**
					 * Above Header Submenu
					 */
					'.ast-advanced-headers .ast-above-header .main-navigation .sub-menu' => array(
						'background-color' => esc_attr( $above_header_submenu_bg_color ),
					),
					'.ast-advanced-headers .ast-above-header .main-header-menu .sub-menu, .ast-advanced-headers .ast-above-header .main-header-menu .sub-menu .menu-link' => array(
						'color' => esc_attr( $above_header_submenu_text_link_fb_color ),
					),
					'.ast-advanced-headers .ast-above-header .main-header-menu .sub-menu .menu-link:hover, .ast-advanced-headers .ast-above-header .main-header-menu .sub-menu .menu-item:hover > .menu-link, .ast-advanced-headers .ast-above-header .main-header-menu .sub-menu .menu-item.focus > .menu-link' => array(
						'color' => esc_attr( $above_header_submenu_text_link_h_fb_color ),
					),
					'.ast-advanced-headers .ast-above-header .main-header-menu .sub-menu .menu-item:hover > .ast-menu-toggle, .ast-advanced-headers .ast-above-header .main-header-menu .sub-menu .menu-item.focus > .ast-menu-toggle' => array(
						'color' => esc_attr( $above_header_submenu_text_link_h_fb_color ),
					),
					'.ast-advanced-headers .ast-above-header .main-header-menu .sub-menu .menu-item.current-menu-ancestor > .menu-link, .ast-advanced-headers.ast-header-break-point .ast-above-header .main-header-menu .sub-menu .menu-item.current-menu-item > .menu-link, .ast-advanced-headers .ast-above-header .main-header-menu .sub-menu .menu-item.current-menu-item > .menu-link, .ast-advanced-headers.ast-desktop .ast-above-header .ast-mega-menu-enabled.main-header-menu .sub-menu .menu-item-heading.current-menu-item' => array(
						'color' => esc_attr( $above_header_submenu_text_link_a_fb_color ),
					),
				);

				if ( $is_page_headers_designs_compatible_builder_layout ) {
					$above_header_style['.ast-advanced-headers .ast-above-header .main-navigation .main-header-menu .menu-item > .menu-link, .ast-advanced-headers .ast-above-header .main-navigation .main-header-menu .menu-item > .menu-link:hover'] = array(
						'background' => 'transparent',
					);
				}
			} elseif ( $above_header_enabled ) {
				/**
				 * Above Heaader
				*/
				$above_header_style = array(
					'.ast-advanced-headers .ast-above-header, .ast-advanced-headers .ast-above-header .slide-search' => array(
						'background' => esc_attr( $above_header_bg_color ),
					),
					'.ast-advanced-headers .ast-above-header-menu > .menu-item.current-menu-item > .menu-link,.ast-advanced-headers .ast-above-header-menu >.menu-item.current-menu-ancestor > .menu-link' => array(
						'color' => esc_attr( $above_header_text_link_h_fb_color ),
					),
					'.ast-advanced-headers .ast-above-header-menu > .menu-item > .menu-link:hover, .ast-advanced-headers .ast-above-header-menu > .menu-item:hover > .menu-link' => array(
						'color' => esc_attr( $above_header_text_link_h_fb_color ),
					),
					'.ast-advanced-headers .ast-above-header > a:hover, .ast-advanced-headers .ast-above-header .user-select a:hover, .ast-advanced-headers .ast-above-header .widget a:hover' => array(
						'color' => esc_attr( $above_header_text_link_h_fb_color ),
					),
					'.ast-above-header-navigation .menu-item.current-menu-item > .menu-link, .ast-above-header-navigation .menu-item.current-menu-ancestor > .menu-link' => array(
						'color' => esc_attr( $above_header_text_link_a_fb_color ),
					),
					'.ast-advanced-headers .ast-above-header, .ast-advanced-headers .ast-above-header-menu > .menu-item > .menu-link, .ast-advanced-headers .ast-above-header .user-select, .ast-advanced-headers .ast-above-header .user-select a, .ast-advanced-headers .ast-above-header .widget, .ast-advanced-headers .ast-above-header .widget a, .ast-advanced-headers .ast-above-header-menu-items > .menu-item > .menu-link' => array(
						'color' => esc_attr( $above_header_text_link_fb_color ),
					),

					/*
					* Above header Submenu navigation
					*/
					'.ast-advanced-headers .ast-above-header-menu .sub-menu' => array(
						'background-color' => esc_attr( $above_header_submenu_bg_color ),
					),
					'.ast-advanced-headers .ast-above-header-menu .sub-menu, .ast-advanced-headers .ast-above-header-menu .sub-menu .menu-link' => array(
						'color' => esc_attr( $above_header_submenu_text_link_fb_color ),
					),
					'.ast-advanced-headers .ast-above-header-menu .sub-menu .menu-item:hover > .menu-link, .ast-advanced-headers .ast-above-header-menu .sub-menu .menu-item:focus > .menu-link, .ast-advanced-headers .ast-above-header-menu .sub-menu .menu-item.focus > .menu-link, .ast-advanced-headers .ast-above-header-menu .sub-menu .menu-item:hover > .ast-menu-toggle, .ast-advanced-headers .ast-above-header-menu .sub-menu .menu-item:focus > .ast-menu-toggle, .ast-advanced-headers .ast-above-header-menu .sub-menu .menu-item.focus > .ast-menu-toggle' => array(
						'color' => esc_attr( $above_header_submenu_text_link_h_fb_color ),
					),
					'.ast-advanced-headers .ast-above-header-menu .sub-menu .menu-item.current-menu-ancestor > .ast-menu-toggle, .ast-advanced-headers .ast-above-header-menu .sub-menu .menu-item.current-menu-item > .ast-menu-toggle, .ast-advanced-headers .ast-above-header-menu .sub-menu .menu-item.current-menu-ancestor:hover > .ast-menu-toggle, .ast-advanced-headers .ast-above-header-menu .sub-menu .menu-item.current-menu-ancestor:focus > .ast-menu-toggle, .ast-advanced-headers .ast-above-header-menu .sub-menu .menu-item.current-menu-ancestor.focus > .ast-menu-toggle, .ast-advanced-headers .ast-above-header-menu .sub-menu .menu-item.current-menu-item:hover > .ast-menu-toggle, .ast-advanced-headers .ast-above-header-menu .sub-menu .menu-item.current-menu-item:focus > .ast-menu-toggle, .ast-advanced-headers .ast-above-header-menu .sub-menu .menu-item.current-menu-item.focus > .ast-menu-toggle' => array(
						'color' => esc_attr( $above_header_submenu_text_link_a_fb_color ),
					),
					'.ast-advanced-headers .ast-above-header-menu .sub-menu .menu-item.current-menu-ancestor > .menu-link, .ast-advanced-headers .ast-above-header-menu .sub-menu .menu-item.current-menu-item > .menu-link, .ast-advanced-headers .ast-above-header-menu .sub-menu .menu-item.current-menu-ancestor:hover > .menu-link, .ast-advanced-headers .ast-above-header-menu .sub-menu .menu-item.current-menu-ancestor:focus > .menu-link, .ast-advanced-headers .ast-above-header-menu .sub-menu .menu-item.current-menu-ancestor.focus > .menu-link, .ast-advanced-headers .ast-above-header-menu .sub-menu .menu-item.current-menu-item:hover > .menu-link, .ast-advanced-headers .ast-above-header-menu .sub-menu .menu-item.current-menu-item:focus > .menu-link, .ast-advanced-headers .ast-above-header-menu .sub-menu .menu-item.current-menu-item.focus > .menu-link' => array(
						'color' => esc_attr( $above_header_submenu_text_link_a_fb_color ),
					),
				);
			}

			$parse_css .= astra_parse_css( $above_header_style );

			// Below Headder enabled.
			if ( true === astra_addon_builder_helper()->is_header_footer_builder_active && Astra_Addon_Builder_Helper::is_row_empty( 'below', 'header', 'desktop' ) ) {
				/**
				 * Below Heaader
				 */
				$below_header_style = array(
					/**
					 * Above Header Menus
					 */
					'.ast-advanced-headers .ast-below-header .main-header-menu, .ast-advanced-headers.ast-header-break-point #ast-mobile-popup-wrapper .main-header-menu' => array(
						'background-color' => esc_attr( $below_header_bg_color ),
					),
					'.ast-advanced-headers .ast-below-header .main-header-menu > .menu-item.current-menu-ancestor > .menu-link, .ast-advanced-headers .ast-below-header .main-header-menu > .menu-item.current-menu-item > .menu-link' => array(
						'color' => esc_attr( $below_header_text_link_a_fb_color ),
					),
					'.ast-advanced-headers .ast-below-header .main-header-menu > .menu-item > .menu-link:hover, .ast-advanced-headers .ast-below-header .main-header-menu > .menu-item:hover > .menu-link' => array(
						'color' => esc_attr( $below_header_text_link_h_fb_color ),
					),
					'.ast-advanced-headers .ast-below-header .main-header-menu, .ast-advanced-headers .ast-below-header .main-header-menu > .menu-item > .menu-link' => array(
						'color' => esc_attr( $below_header_text_link_fb_color ),
					),

					/**
					 * Above Header Submenu
					 */
					'.ast-advanced-headers .ast-below-header .main-navigation .sub-menu' => array(
						'background-color' => esc_attr( $below_header_submenu_bg_color ),
					),
					'.ast-advanced-headers .ast-below-header .main-header-menu .sub-menu, .ast-advanced-headers .ast-below-header .main-header-menu .sub-menu .menu-link' => array(
						'color' => esc_attr( $below_header_submenu_text_link_fb_color ),
					),
					'.ast-advanced-headers .ast-below-header .main-header-menu .sub-menu .menu-link:hover, .ast-advanced-headers .ast-below-header .main-header-menu .sub-menu .menu-item:hover > .menu-link, .ast-advanced-headers .ast-below-header .main-header-menu .sub-menu .menu-item.focus > .menu-link' => array(
						'color' => esc_attr( $below_header_submenu_text_link_h_fb_color ),
					),
					'.ast-advanced-headers .ast-below-header .main-header-menu .sub-menu .menu-item:hover > .ast-menu-toggle, .ast-advanced-headers .ast-below-header .main-header-menu .sub-menu .menu-item.focus > .ast-menu-toggle' => array(
						'color' => esc_attr( $below_header_submenu_text_link_h_fb_color ),
					),
					'.ast-advanced-headers .ast-below-header .main-header-menu .sub-menu .menu-item.current-menu-ancestor > .menu-link, .ast-advanced-headers.ast-header-break-point .ast-below-header .main-header-menu .sub-menu .menu-item.current-menu-item > .menu-link, .ast-advanced-headers .ast-below-header .main-header-menu .sub-menu .menu-item.current-menu-item > .menu-link, .ast-advanced-headers.ast-desktop .ast-below-header .ast-mega-menu-enabled.main-header-menu .sub-menu .menu-item-heading.current-menu-item' => array(
						'color' => esc_attr( $below_header_submenu_text_link_a_fb_color ),
					),
				);
				if ( $is_page_headers_designs_compatible_builder_layout ) {
					$below_header_style['.ast-advanced-headers .ast-below-header .main-navigation .main-header-menu .menu-item > .menu-link, .ast-advanced-headers .ast-below-header .main-navigation .main-header-menu .menu-item > .menu-link:hover'] = array(
						'background' => 'transparent',
					);
				}
			} elseif ( $below_header_enabled ) {
				/**
				 * Below Heaader
				 */
				$below_header_style = array(
					'.ast-advanced-headers .ast-below-header,  .ast-advanced-headers .ast-below-header .slide-search' => array(
						'background' => esc_attr( $below_header_bg_color ),
					),
					'.ast-advanced-headers .ast-below-header-menu > .menu-item.current-menu-ancestor > .menu-link, .ast-advanced-headers .ast-below-header-menu > .menu-item.current-menu-item > .menu-link' => array(
						'color' => esc_attr( $below_header_text_link_a_fb_color ),
					),
					'.ast-advanced-headers .ast-below-header-menu .menu-link:hover, .ast-advanced-headers .ast-below-header-menu > .menu-item:hover > .menu-link' => array(
						'color' => esc_attr( $below_header_text_link_h_fb_color ),
					),
					'.ast-advanced-headers .ast-below-header > a:hover, .ast-advanced-headers .ast-below-header .user-select a:hover, .ast-advanced-headers .ast-below-header .widget a:hover' => array(
						'color' => esc_attr( $below_header_text_link_h_fb_color ),
					),
					'.ast-advanced-headers .ast-below-header, .ast-advanced-headers .ast-below-header-menu > .menu-item > .menu-link, .ast-advanced-headers .ast-below-header .user-select, .ast-advanced-headers .ast-below-header .user-select a, .ast-advanced-headers .ast-below-header .widget, .ast-advanced-headers .ast-below-header .widget a, .below-header-user-select, .ast-advanced-headers .ast-below-header-menu-items > .menu-item > .menu-link' => array(
						'color' => esc_attr( $below_header_text_link_fb_color ),
					),

					/*
					* Below header Submenu navigation
					*/
					'.ast-advanced-headers .ast-below-header-menu .sub-menu' => array(
						'background-color' => esc_attr( $below_header_submenu_bg_color ),
					),
					'.ast-advanced-headers .ast-below-header-menu .sub-menu, .ast-advanced-headers .ast-below-header-menu .sub-menu .menu-link' => array(
						'color' => esc_attr( $below_header_submenu_text_link_fb_color ),
					),
					'.ast-advanced-headers .ast-below-header-menu .sub-menu .menu-item:hover > .menu-link, .ast-advanced-headers .ast-below-header-menu .sub-menu .menu-item:focus > .menu-link, .ast-advanced-headers .ast-below-header-menu .sub-menu .menu-item.focus > .menu-link' => array(
						'color' => esc_attr( $below_header_submenu_text_link_h_fb_color ),
					),
					'.ast-advanced-headers .ast-below-header-menu .sub-menu .menu-item.current-menu-ancestor > .menu-link, .ast-advanced-headers .ast-below-header-menu .sub-menu .menu-item.current-menu-item > .menu-link, .ast-advanced-headers .ast-below-header-menu .sub-menu .menu-item.current-menu-ancestor:hover > .menu-link, .ast-advanced-headers .ast-below-header-menu .sub-menu .menu-item.current-menu-ancestor:focus > .menu-link, .ast-advanced-headers .ast-below-header-menu .sub-menu .menu-item.current-menu-ancestor.focus > .menu-link, .ast-advanced-headers .ast-below-header-menu .sub-menu .menu-item.current-menu-item:hover > .menu-link, .ast-advanced-headers .ast-below-header-menu .sub-menu .menu-item.current-menu-item:focus > .menu-link, .ast-advanced-headers .ast-below-header-menu .sub-menu .menu-item.current-menu-item.focus > .menu-link' => array(
						'color' => esc_attr( $below_header_submenu_text_link_a_fb_color ),
					),
				);
			}

			$parse_css .= astra_parse_css( $below_header_style );

			$css = '';

			// Header Separator.
			$css       .= '.ast-advanced-headers.ast-header-break-point .main-header-bar {';
			$css       .= 'border-bottom-width:' . astra_get_css_value( $header_main_sep, 'px' ) . ';';
			$css       .= 'border-bottom-color:' . esc_attr( $header_main_sep_color ) . ';';
			$css       .= '}';
			$css       .= '@media (min-width: ' . astra_addon_get_tablet_breakpoint( '', 1 ) . 'px) {';
			$css       .= '.ast-advanced-headers .main-header-bar {';
			$css       .= 'border-bottom-width:' . astra_get_css_value( $header_main_sep, 'px' ) . ';';
			$css       .= 'border-bottom-color:' . esc_attr( $header_main_sep_color ) . ';';
			$css       .= '}';
			$css       .= '}';
			$parse_css .= $css;
		}
		/**
		 * Background
		 */
		if ( '' != $title_bar_bg_img ) {
			$background['.ast-title-bar-wrap']['background-image']    = 'url(' . esc_url( $title_bar_bg_img ) . ')';
			$background['.ast-title-bar-wrap']['background-repeat']   = esc_attr( 'repeat' );
			$background['.ast-title-bar-wrap']['background-size']     = esc_attr( 'cover' );
			$background['.ast-title-bar-wrap']['background-position'] = esc_attr( 'center center' );
		} else {
			$background['.ast-title-bar-wrap']['background'] = esc_attr( $bg_color );
		}

		if ( $overlay_bg_color ) {
			$background['.ast-title-bar-wrap:after'] = array(
				'content'          => '""',
				'position'         => 'absolute',
				'left'             => '0',
				'right'            => '0',
				'top'              => '0',
				'bottom'           => '0',
				'background-color' => esc_attr( $bg_color ),
			);
		}
		$parse_css .= astra_parse_css( $background );
	}

	// Transparent header is enable and not archive, search , 404 page.
	if ( ( $advanced_headers_merged && 'disable' == $advanced_headers_layout ) &&
		( ! ( is_archive() || is_search() || is_404() || is_home() ) || Astra_Ext_Advanced_Headers_Markup::transparent_header_disabled_archive() )
		) {
		// default fall-back color variables.
		$tr_header_bg_color = 'transparent';
		if ( $header_bg_color ) {
			$tr_header_bg_color = $header_bg_color;
		}
		$tr_header_color_site_title   = $header_color_site_title;
		$tr_header_color_site_h_title = $header_color_site_title;
		$tr_header_color_site_tagline = $header_color_site_title;
		$tr_primary_menu_bg_color     = $primary_menu_bg_color;
		$tr_primary_menu_color        = $header_color_site_title;
		$tr_primary_menu_h_color      = $header_color_site_title;
		$primary_menu_a_color         = $header_color_site_title;

		// Above Header fall-back colors.
		$tr_above_header_bg_color             = 'transparent';
		$tr_above_header_text_link_fb_color   = $header_color_site_title;
		$tr_above_header_text_link_h_fb_color = $header_color_site_title;
		$above_header_text_link_a_color       = $header_color_site_title;

		// Below Header fall-back colors.
		$tr_below_header_bg_color             = 'transparent';
		$tr_below_header_text_link_fb_color   = '';
		$tr_below_header_text_link_h_fb_color = '';
		$below_header_text_link_a_color       = '';

		if ( $header_color_h_site_title ) {
			$tr_header_color_site_h_title = $header_color_h_site_title;
		}
		if ( $header_color_site_tagline ) {
			$tr_header_color_site_tagline = $header_color_site_tagline;
		}
		if ( $primary_menu_color ) {
			$tr_primary_menu_color   = $primary_menu_color;
			$tr_primary_menu_h_color = $primary_menu_color;
			$primary_menu_a_color    = $primary_menu_color;
		}
		if ( $primary_menu_h_color ) {
			$tr_primary_menu_h_color = $primary_menu_h_color;
			$primary_menu_a_color    = $primary_menu_h_color;
		}

		// Above Header colors.
		if ( $header_bg_color ) {
			$tr_above_header_bg_color = $header_bg_color;
		}
		if ( $above_header_bg_color ) {
			$tr_above_header_bg_color = $above_header_bg_color;
		}
		if ( $above_header_text_link_color ) {
			$tr_above_header_text_link_fb_color   = $above_header_text_link_color;
			$tr_above_header_text_link_h_fb_color = $above_header_text_link_color;
			$above_header_text_link_a_color       = $above_header_text_link_color;
		}
		if ( $above_header_text_link_h_color ) {
			$tr_above_header_text_link_h_fb_color = $above_header_text_link_h_color;
			$above_header_text_link_a_color       = $above_header_text_link_h_color;
		}

		// Below Header colors.
		if ( $header_bg_color ) {
			$tr_below_header_bg_color = $header_bg_color;
		}
		if ( $below_header_bg_color ) {
			$tr_below_header_bg_color = $below_header_bg_color;
		}
		if ( $below_header_text_link_fb_color ) {
			$tr_below_header_text_link_fb_color   = $below_header_text_link_color;
			$tr_below_header_text_link_h_fb_color = $below_header_text_link_color;
			$below_header_text_link_a_color       = $below_header_text_link_color;
		}
		if ( $below_header_text_link_h_fb_color ) {
			$tr_below_header_text_link_h_fb_color = $below_header_text_link_h_color;
			$below_header_text_link_a_color       = $below_header_text_link_h_color;
		}

		$transparent_header_style = array(
			/**
			 * Header
			 */
			'.ast-transparent-header .main-header-bar' => array(
				'background-color' => esc_attr( $tr_header_bg_color ),
			),

			'.ast-transparent-header #masthead'        => array(
				'position' => esc_attr( 'absolute' ),
				'left'     => esc_attr( 0 ),
				'right'    => esc_attr( 0 ),
			),
			/**
			 * Header
			 */
			'.ast-transparent-header #masthead .site-logo-img .custom-logo-link img' => array(
				'max-width' => astra_get_css_value( $header_logo_width, 'px' ),
			),
			'.ast-transparent-header #masthead .site-logo-img .custom-logo-link .astra-logo-svg' => array(
				'width' => astra_get_css_value( $header_logo_width, 'px' ),
			),
		);

		$parse_css .= astra_parse_css( $transparent_header_style );

		$transparent_header_mobile_style = array(

			'.ast-transparent-header .site-title a, .site-title a:focus, .ast-transparent-header .site-title a:hover, .ast-transparent-header .site-title a:visited' => array(
				'color' => esc_attr( $tr_header_color_site_title ),
			),
			'.ast-transparent-header .site-header .site-title a:hover' => array(
				'color' => esc_attr( $tr_header_color_site_h_title ),
			),
			'.ast-transparent-header .site-header .site-description' => array(
				'color' => esc_attr( $tr_header_color_site_tagline ),
			),

			/**
			 * Primary Menu
			 */
			'.ast-transparent-header .main-header-menu, .ast-transparent-header.ast-header-break-point .main-header-menu, .ast-transparent-header .ast-masthead-custom-menu-items, .ast-transparent-header.ast-header-break-point .main-header-menu' => array(
				'background-color' => esc_attr( $tr_primary_menu_bg_color ),
			),
			'.ast-transparent-header .main-header-menu > .menu-item.current-menu-ancestor > .menu-link, .ast-transparent-header .main-header-menu > .menu-item.current-menu-item > .menu-link' => array(
				'color' => esc_attr( $primary_menu_a_color ),
			),
			'.ast-transparent-header .main-header-menu > .menu-item > .menu-link:hover, .ast-transparent-header .main-header-menu > .menu-item:hover > .menu-link' => array(
				'color' => esc_attr( $tr_primary_menu_h_color ),
			),
			'.ast-transparent-header .main-header-menu .ast-masthead-custom-menu-items a:hover' => array(
				'color' => esc_attr( $tr_primary_menu_h_color ),
			),
			'.ast-transparent-header .main-header-menu, .main-header-menu > .menu-item > .menu-link, .ast-transparent-header .ast-masthead-custom-menu-items, .ast-transparent-header .ast-masthead-custom-menu-items a' => array(
				'color' => esc_attr( $tr_primary_menu_color ),
			),

			/*
			 * Primary Menu -> Submenu
			 */
			'.ast-transparent-header .main-header-menu .sub-menu, .ast-transparent-header.ast-header-break-point .main-header-menu .sub-menu' => array(
				'background-color' => esc_attr( $primary_header_submenu_bg_color ),
			),
			'.ast-transparent-header .main-header-menu .sub-menu, .ast-transparent-header .main-header-menu .sub-menu .menu-link' => array(
				'color' => esc_attr( $primary_header_submenu_text_color ),
			),
			'.ast-transparent-header .main-header-menu .sub-menu .menu-link:hover, .ast-transparent-header .main-header-menu .sub-menu .menu-item:hover > .menu-link, .ast-transparent-header .main-header-menu .sub-menu .menu-item.focus > .menu-link' => array(
				'color' => esc_attr( $primary_header_submenu_text_link_hover_color ),
			),
			'.ast-transparent-header .main-header-menu .sub-menu .menu-item:hover > .ast-menu-toggle, .ast-transparent-header .main-header-menu .sub-menu .menu-item.focus > .ast-menu-toggle' => array(
				'color' => esc_attr( $primary_header_submenu_text_link_hover_color ),
			),
			'.ast-transparent-header .main-header-menu .sub-menu .menu-item.current-menu-ancestor > .menu-link, .ast-transparent-header.ast-header-break-point .main-header-menu .sub-menu .menu-item.current-menu-item > .menu-link, .ast-transparent-header .main-header-menu .sub-menu .menu-item.current-menu-item > .menu-link, .ast-transparent-header.ast-desktop .ast-mega-menu-enabled.main-header-menu .sub-menu .menu-item-heading.current-menu-item' => array(
				'color' => esc_attr( $primary_header_submenu_text_link_active_color ),
			),

			/**
			 * Above Heaader
			 */
			'.ast-transparent-header .ast-above-header' => array(
				'background-color' => esc_attr( $tr_above_header_bg_color ),
			),
			'.ast-transparent-header .ast-above-header-menu > .menu-item.current-menu-ancestor > .menu-link, .ast-transparent-header .ast-above-header-menu > .menu-item.current-menu-item > .menu-link' => array(
				'color' => esc_attr( $above_header_text_link_a_color ),
			),
			'.ast-transparent-header .ast-above-header-menu > .menu-item > .menu-link:hover, .ast-transparent-header .ast-above-header-menu > .menu-item:hover > .menu-link' => array(
				'color' => esc_attr( $tr_above_header_text_link_h_fb_color ),
			),
			'.ast-transparent-header .ast-above-header > a:hover, .ast-transparent-header .ast-above-header .user-select a:hover, .ast-transparent-header .ast-above-header .widget a:hover' => array(
				'color' => esc_attr( $tr_above_header_text_link_h_fb_color ),
			),
			'.ast-transparent-header .ast-above-header, .ast-transparent-header .ast-above-header-menu > .menu-item > .menu-link, .ast-transparent-header .ast-above-header .user-select, .ast-transparent-header .ast-above-header .user-select a, .ast-transparent-header .ast-above-header .widget, .ast-transparent-header .ast-above-header .widget a' => array(
				'color' => esc_attr( $tr_above_header_text_link_fb_color ),
			),

			/*
			* Above header -> Submenu
			*/
			'.ast-transparent-header .ast-above-header .ast-above-header-menu .sub-menu' => array(
				'background-color' => esc_attr( $above_header_submenu_bg_color ),
			),
			'.ast-transparent-header .ast-above-header-menu .sub-menu, .ast-transparent-header .ast-above-header-menu .sub-menu .menu-link' => array(
				'color' => esc_attr( $above_header_submenu_text_link_fb_color ),
			),
			'.ast-transparent-header .ast-above-header-menu .sub-menu .menu-item:hover > .menu-link, .ast-transparent-header .ast-above-header-menu .sub-menu .menu-item:focus > .menu-link, .ast-transparent-header .ast-above-header-menu .sub-menu .menu-item.focus > .menu-link, .ast-transparent-header .ast-above-header-menu .sub-menu .menu-item:hover > .ast-menu-toggle, .ast-transparent-header .ast-above-header-menu .sub-menu .menu-item:focus > .ast-menu-toggle, .ast-transparent-header .ast-above-header-menu .sub-menu .menu-item.focus > .ast-menu-toggle' => array(
				'color' => esc_attr( $above_header_submenu_text_link_h_fb_color ),
			),
			'.ast-transparent-header .ast-above-header-menu .sub-menu .menu-item.current-menu-ancestor > .ast-menu-toggle, .ast-transparent-header .ast-above-header-menu .sub-menu .menu-item.current-menu-item > .ast-menu-toggle, .ast-transparent-header .ast-above-header-menu .sub-menu .menu-item.current-menu-ancestor:hover > .ast-menu-toggle, .ast-transparent-header .ast-above-header-menu .sub-menu .menu-item.current-menu-ancestor:focus > .ast-menu-toggle, .ast-transparent-header .ast-above-header-menu .sub-menu .menu-item.current-menu-ancestor.focus > .ast-menu-toggle, .ast-transparent-header .ast-above-header-menu .sub-menu .menu-item.current-menu-item:hover > .ast-menu-toggle, .ast-transparent-header .ast-above-header-menu .sub-menu .menu-item.current-menu-item:focus > .ast-menu-toggle, .ast-transparent-header .ast-above-header-menu .sub-menu .menu-item.current-menu-item.focus > .ast-menu-toggle' => array(
				'color' => esc_attr( $above_header_submenu_text_link_a_fb_color ),
			),
			'.ast-transparent-header .ast-above-header-menu .sub-menu .menu-item.current-menu-ancestor > .menu-link, .ast-transparent-header .ast-above-header-menu .sub-menu .menu-item.current-menu-item > .menu-link, .ast-transparent-header .ast-above-header-menu .sub-menu .menu-item.current-menu-ancestor:hover > .menu-link, .ast-transparent-header .ast-above-header-menu .sub-menu .menu-item.current-menu-ancestor:focus > .menu-link, .ast-transparent-header .ast-above-header-menu .sub-menu .menu-item.current-menu-ancestor.focus > .menu-link, .ast-transparent-header .ast-above-header-menu .sub-menu .menu-item.current-menu-item:hover > .menu-link, .ast-transparent-header .ast-above-header-menu .sub-menu .menu-item.current-menu-item:focus > .menu-link, .ast-transparent-header .ast-above-header-menu .sub-menu .menu-item.current-menu-item.focus > .menu-link' => array(
				'color' => esc_attr( $above_header_submenu_text_link_a_fb_color ),
			),

			/**
			 * Below Heaader
			 */
			'.ast-transparent-header .ast-below-header' => array(
				'background-color' => esc_attr( $tr_below_header_bg_color ),
			),
			'.ast-transparent-header .ast-below-header-menu > .menu-item.current-menu-ancestor > .menu-link, .ast-transparent-header .ast-below-header-menu > .menu-item.current-menu-item > .menu-link' => array(
				'color' => esc_attr( $below_header_text_link_a_color ),
			),
			'.ast-transparent-header .ast-below-header-menu > .menu-item > .menu-link:hover, .ast-transparent-header .ast-below-header-menu > .menu-item:hover > .menu-link' => array(
				'color' => esc_attr( $tr_below_header_text_link_h_fb_color ),
			),
			'.ast-transparent-header .ast-below-header > a:hover, .ast-transparent-header .ast-below-header .user-select a:hover, .ast-transparent-header .ast-below-header .widget a:hover' => array(
				'color' => esc_attr( $tr_below_header_text_link_h_fb_color ),
			),
			'.ast-transparent-header .ast-below-header, .ast-transparent-header .ast-below-header-menu > .menu-item > .menu-link, .ast-transparent-header .ast-below-header .user-select, .ast-transparent-header .ast-below-header .user-select a, .ast-transparent-header .ast-below-header .widget, .ast-transparent-header .ast-below-header .widget a' => array(
				'color' => esc_attr( $tr_below_header_text_link_fb_color ),
			),

			/*
			* Below header -> Submenu
			*/
			'.ast-transparent-header .ast-below-header .ast-below-header-menu .sub-menu' => array(
				'background-color' => esc_attr( $below_header_submenu_bg_color ),
			),
			'.ast-transparent-header .ast-below-header-menu .sub-menu, .ast-transparent-header .ast-below-header-menu .sub-menu .menu-link' => array(
				'color' => esc_attr( $below_header_submenu_text_link_fb_color ),
			),
			'.ast-transparent-header .ast-below-header-menu .sub-menu .menu-item:hover > .menu-link, .ast-transparent-header .ast-below-header-menu .sub-menu .menu-item:focus > .menu-link, .ast-transparent-header .ast-below-header-menu .sub-menu .menu-item.focus > .menu-link' => array(
				'color' => esc_attr( $below_header_submenu_text_link_h_fb_color ),
			),
			'.ast-transparent-header .ast-below-header-menu .sub-menu .menu-item.current-menu-ancestor > .menu-link, .ast-transparent-header .ast-below-header-menu .sub-menu .menu-item.current-menu-item > .menu-link, .ast-transparent-header .ast-below-header-menu .sub-menu .menu-item.current-menu-ancestor:hover > .menu-link, .ast-transparent-header .ast-below-header-menu .sub-menu .menu-item.current-menu-ancestor:focus > .menu-link, .ast-transparent-header .ast-below-header-menu .sub-menu .menu-item.current-menu-ancestor.focus > .menu-link, .ast-transparent-header .ast-below-header-menu .sub-menu .menu-item.current-menu-item:hover > .menu-link, .ast-transparent-header .ast-below-header-menu .sub-menu .menu-item.current-menu-item:focus > .menu-link, .ast-transparent-header .ast-below-header-menu .sub-menu .menu-item.current-menu-item.focus > .menu-link' => array(
				'color' => esc_attr( $below_header_submenu_text_link_a_fb_color ),
			),
		);

		// If background color is transparent.
		if ( 'transparent' == $tr_header_bg_color ) {
			$parse_css .= astra_parse_css( $transparent_header_mobile_style, $header_break_point );
		} else {
			$parse_css .= astra_parse_css( $transparent_header_mobile_style );
		}

		$css = '';
		// Header Separator.
		$css .= '.ast-transparent-header.ast-header-break-point .main-header-bar {';
		$css .= 'border-bottom-width:' . astra_get_css_value( $header_main_sep, 'px' ) . ';';
		$css .= 'border-bottom-color:' . esc_attr( $header_main_sep_color ) . ';';
		$css .= '}';
		$css .= '@media (min-width: ' . astra_addon_get_tablet_breakpoint( '', 1 ) . 'px) {';
		$css .= '.ast-transparent-header .main-header-bar {';
		$css .= 'border-bottom-width:' . astra_get_css_value( $header_main_sep, 'px' ) . ';';
		$css .= 'border-bottom-color:' . esc_attr( $header_main_sep_color ) . ';';
		$css .= '}';
		$css .= '} ';
		/**
		 * Generate Dynamic CSS
		 */
		$css       .= ' body.elementor-editor-active.ast-transparent-header #masthead, .fl-builder-edit .ast-transparent-header .site-header, body.vc_editor.ast-transparent-header #masthead { ';
		$css       .= ' z-index: 0; ';
		$css       .= ' } ';
		$parse_css .= $css;
	}

	// Above Headder enabled.
	if ( $above_header_enabled ) {
		/**
		 * Above Heaader
		 */
		$above_header_style = array(
			'.ast-advanced-headers .ast-above-header, .ast-advanced-headers .ast-above-header .slide-search' => array(
				'background' => esc_attr( $above_header_bg_color ),
			),
			'.ast-advanced-headers .ast-above-header-menu > .menu-item.current-menu-ancestor > .menu-link, .ast-advanced-headers .ast-above-header-menu > .menu-item.current-menu-item > .menu-link' => array(
				'color' => esc_attr( $above_header_text_link_a_color ),
			),
			'.ast-advanced-headers .ast-above-header-menu > .menu-item > .menu-link:hover, .ast-advanced-headers .ast-above-header-menu > .menu-item:hover > .menu-link' => array(
				'color' => esc_attr( $above_header_text_link_h_color ),
			),
			'.ast-advanced-headers .ast-above-header > a:hover, .ast-advanced-headers .ast-above-header .user-select a:hover, .ast-advanced-headers .ast-above-header .widget a:hover' => array(
				'color' => esc_attr( $above_header_text_link_h_color ),
			),
			'.ast-advanced-headers .ast-above-header, .ast-advanced-headers .ast-above-header-menu > .menu-item > .menu-link, .ast-advanced-headers .ast-above-header .user-select, .ast-advanced-headers .ast-above-header .user-select a, .ast-advanced-headers .ast-above-header .widget, .ast-advanced-headers .ast-above-header .widget a, .ast-advanced-headers .ast-above-header-menu-items > .menu-item > .menu-link' => array(
				'color' => esc_attr( $above_header_text_link_color ),
			),
		);
		$parse_css         .= astra_parse_css( $above_header_style );
	}

	// Below Headder enabled.
	if ( $below_header_enabled ) {
		/**
		 * Below Heaader
		 */
		$below_header_style = array(

			'.ast-advanced-headers .ast-below-header,  .ast-advanced-headers .ast-below-header .slide-search' => array(
				'background' => esc_attr( $below_header_bg_color ),
			),
			'.ast-advanced-headers .ast-below-header-menu > .menu-item.current-menu-ancestor > .menu-link, .ast-advanced-headers .ast-below-header-menu > .menu-item.current-menu-item > .menu-link' => array(
				'color' => esc_attr( $below_header_text_link_a_color ),
			),
			'.ast-advanced-headers .ast-below-header-menu .menu-link:hover, .ast-advanced-headers .ast-below-header-menu > .menu-item:hover > .menu-link' => array(
				'color' => esc_attr( $below_header_text_link_h_color ),
			),
			'.ast-advanced-headers .ast-below-header > a:hover, .ast-advanced-headers .ast-below-header .user-select a:hover, .ast-advanced-headers .ast-below-header .widget a:hover' => array(
				'color' => esc_attr( $below_header_text_link_h_color ),
			),
			'.ast-advanced-headers .ast-below-header, .ast-advanced-headers .ast-below-header-menu > .menu-item > .menu-link, .ast-advanced-headers .ast-below-header .user-select, .ast-advanced-headers .ast-below-header .user-select a, .ast-advanced-headers .ast-below-header .widget, .ast-advanced-headers .ast-below-header .widget a, .below-header-user-select, .ast-advanced-headers .ast-below-header-menu-items > .menu-item > .menu-link' => array(
				'color' => esc_attr( $below_header_text_link_color ),
			),
		);

		$parse_css .= astra_parse_css( $below_header_style );
	}

	$parallax_style = '';
	if ( 'both' === $parallax_device ) {
		$parallax_style = array(
			'.ast-advanced-headers-parallax' => array(
				'background-attachment' => 'fixed',
			),
		);

	} elseif ( 'desktop' === $parallax_device ) {
		$parallax_style = array(
			'.ast-desktop .ast-advanced-headers-parallax' => array(
				'background-attachment' => 'fixed',
			),
		);
	} else {
		$parallax_style = array(
			'.ast-header-break-point .ast-advanced-headers-parallax' => array(
				'background-attachment' => 'fixed',
			),
		);
	}

	$parse_css .= astra_parse_css( $parallax_style );

	return $dynamic_css . $parse_css;
}
