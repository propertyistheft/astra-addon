<?php
/**
 * Typography - Dynamic CSS
 *
 * @package Astra Addon
 */

add_filter( 'astra_addon_dynamic_css', 'astra_typography_dynamic_css' );

/**
 * Dynamic CSS
 *
 * @param  string $dynamic_css          Astra Dynamic CSS.
 * @param  string $dynamic_css_filtered Astra Dynamic CSS Filters.
 * @return string
 */
function astra_typography_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' ) {

	$body_font_family    = astra_body_font_family();
	$body_text_transform = astra_get_option( 'body-text-transform', 'inherit' );

	$headings_font_family    = astra_get_option( 'headings-font-family' );
	$headings_font_weight    = astra_get_option( 'headings-font-weight' );
	$headings_font_transform = astra_get_option( 'headings-text-transform', $body_text_transform );

	$site_title_font_family     = astra_get_option( 'font-family-site-title' );
	$site_title_font_weight     = astra_get_option( 'font-weight-site-title' );
	$site_title_line_height     = astra_addon_get_font_extras( astra_get_option( 'font-extras-site-title' ), 'line-height', 'line-height-unit' );
	$site_title_text_transform  = astra_addon_get_font_extras( astra_get_option( 'font-extras-site-title', $headings_font_transform ), 'text-transform' );
	$site_title_letter_spacing  = astra_addon_get_font_extras( astra_get_option( 'font-extras-site-title' ), 'letter-spacing', 'letter-spacing-unit' );
	$site_title_text_decoration = astra_addon_get_font_extras( astra_get_option( 'font-extras-site-title' ), 'text-decoration' );

	$archive_page_title_font_family     = astra_get_option( 'font-family-page-title' );
	$archive_page_title_font_weight     = astra_get_option( 'font-weight-page-title' );
	$archive_page_title_text_transform  = astra_addon_get_font_extras( astra_get_option( 'font-extras-page-title', $headings_font_transform ), 'text-transform' );
	$archive_page_title_line_height     = astra_addon_get_font_extras( astra_get_option( 'font-extras-page-title' ), 'line-height', 'line-height-unit' );
	$archive_page_title_letter_spacing  = astra_addon_get_font_extras( astra_get_option( 'font-extras-page-title' ), 'letter-spacing', 'letter-spacing-unit' );
	$archive_page_title_text_decoration = astra_addon_get_font_extras( astra_get_option( 'font-extras-page-title' ), 'text-decoration' );

	$post_meta_font_size = astra_get_option( 'font-size-post-meta' );

	$post_pagination_font_size      = astra_get_option( 'font-size-post-pagination' );
	$post_pagination_text_transform = astra_get_option( 'text-transform-post-pagination' );

	$widget_title_font_size       = astra_get_option( 'font-size-widget-title' );
	$widget_title_font_family     = astra_get_option( 'font-family-widget-title' );
	$widget_title_font_weight     = astra_get_option( 'font-weight-widget-title' );
	$widget_title_line_height     = astra_addon_get_font_extras( astra_get_option( 'font-extras-widget-title' ), 'line-height', 'line-height-unit' );
	$widget_title_text_transform  = astra_addon_get_font_extras( astra_get_option( 'font-extras-widget-title', $headings_font_transform ), 'text-transform' );
	$widget_title_letter_spacing  = astra_addon_get_font_extras( astra_get_option( 'font-extras-widget-title' ), 'letter-spacing', 'letter-spacing-unit' );
	$widget_title_text_decoration = astra_addon_get_font_extras( astra_get_option( 'font-extras-widget-title' ), 'text-decoration' );

	$widget_content_font_size = astra_get_option( 'font-size-widget-content' );

	$footer_content_font_size      = astra_get_option( 'font-size-footer-content' );
	$footer_content_font_family    = astra_get_option( 'font-family-footer-content' );
	$footer_content_font_weight    = astra_get_option( 'font-weight-footer-content' );
	$footer_content_line_height    = astra_get_option( 'line-height-footer-content' );
	$footer_content_text_transform = astra_get_option( 'text-transform-footer-content' );

	$h4_font_weight = astra_get_option( 'font-weight-h4' );
	$h4_line_height = astra_addon_get_font_extras( astra_get_option( 'font-extras-h4' ), 'line-height', 'line-height-unit' );

	$h5_font_weight = astra_get_option( 'font-weight-h5' );
	$h5_line_height = astra_addon_get_font_extras( astra_get_option( 'font-extras-h5' ), 'line-height', 'line-height-unit' );

	$h6_font_weight = astra_get_option( 'font-weight-h6' );
	$h6_line_height = astra_addon_get_font_extras( astra_get_option( 'font-extras-h6' ), 'line-height', 'line-height-unit' );

	$button_font_size      = astra_get_option( 'font-size-button' );
	$button_font_family    = astra_get_option( 'font-family-button' );
	$button_font_weight    = astra_get_option( 'font-weight-button' );
	$button_text_transform = astra_addon_get_font_extras( astra_get_option( 'font-extras-button' ), 'text-transform' );

	$outside_menu_item_font   = astra_get_option( 'outside-menu-font-size' );
	$outside_menu_line_height = astra_get_option( 'outside-menu-line-height' );

	$is_widget_title_support_font_weight = Astra_Addon_Update_Filter_Function::support_addon_font_css_to_widget_and_in_editor();
	$font_weight_prop                    = ( $is_widget_title_support_font_weight ) ? 'inherit' : 'normal';

	// Fallback for Site Title - headings typography.
	if ( 'inherit' == $site_title_font_family ) {
		$site_title_font_family = $headings_font_family;
	}

	if ( $font_weight_prop === $site_title_font_weight ) {
		$site_title_font_weight = $headings_font_weight;
	}

	// Fallback for Archive Page Title - headings typography.
	if ( 'inherit' == $archive_page_title_font_family ) {
		$archive_page_title_font_family = $headings_font_family;
	}
	if ( $font_weight_prop === $archive_page_title_font_weight ) {
		$archive_page_title_font_weight = $headings_font_weight;
	}

	// Fallback for Sidebar Widget Title - headings typography.
	if ( 'inherit' == $widget_title_font_family ) {
		$widget_title_font_family = $headings_font_family;
	}
	if ( $font_weight_prop === $widget_title_font_weight ) {
		$widget_title_font_weight = $headings_font_weight;
	}

	// Fallback for H4 - headings typography.
	if ( $font_weight_prop === $h4_font_weight ) {
		$h4_font_weight = $headings_font_weight;
	}

	// Fallback for H5 - headings typography.
	if ( $font_weight_prop === $h5_font_weight ) {
		$h5_font_weight = $headings_font_weight;
	}

	// Fallback for H6 - headings typography.
	if ( $font_weight_prop === $h6_font_weight ) {
		$h6_font_weight = $headings_font_weight;
	}

	/**
	 * Set font sizes
	 */
	$css_output = array(

		/**
		 * Site Title
		 */
		'.site-title, .site-title a'                  => array(
			'font-weight'     => astra_get_css_value( $site_title_font_weight, 'font' ),
			'font-family'     => astra_get_css_value( $site_title_font_family, 'font', $body_font_family ),
			'line-height'     => esc_attr( $site_title_line_height ),
			'text-transform'  => esc_attr( $site_title_text_transform ),
			'text-decoration' => esc_attr( $site_title_text_decoration ),
			'letter-spacing'  => esc_attr( $site_title_letter_spacing ),
		),

		/**
		 * Site Description
		 */
		'.site-header .site-description'              => astra_addon_get_font_array_css( astra_get_option( 'font-family-site-tagline' ), astra_get_option( 'font-weight-site-tagline' ), array(), 'font-extras-site-tagline' ),

		/**
		 * Post Meta
		 */
		'.entry-meta, .read-more'                     => astra_addon_get_font_array_css( astra_get_option( 'font-family-post-meta' ), astra_get_option( 'font-weight-post-meta' ), $post_meta_font_size, 'font-extras-post-meta' ),

		/**
		 * Pagination
		 */
		'.ast-pagination .page-numbers, .ast-pagination .page-navigation' => array(
			'font-size'      => astra_responsive_font( $post_pagination_font_size, 'desktop' ),
			'text-transform' => esc_attr( $post_pagination_text_transform ),
		),

		/**
		 * Widget Content
		 */
		'.secondary .widget-title, .woocommerce-page #secondary .widget .widget-title' => array(
			'font-size'       => astra_responsive_font( $widget_title_font_size, 'desktop' ),
			'font-weight'     => astra_get_css_value( $widget_title_font_weight, 'font' ),
			'font-family'     => astra_get_css_value( $widget_title_font_family, 'font', $body_font_family ),
			'line-height'     => esc_attr( $widget_title_line_height ),
			'text-transform'  => esc_attr( $widget_title_text_transform ),
			'text-decoration' => esc_attr( $widget_title_text_decoration ),
			'letter-spacing'  => esc_attr( $widget_title_letter_spacing ),
		),

		/**
		 * Widget Content
		 */
		'.secondary .widget > *:not(.widget-title)'   => astra_addon_get_font_array_css( astra_get_option( 'font-family-widget-content' ), astra_get_option( 'font-weight-widget-content' ), $widget_content_font_size, 'font-extras-widget-content' ),

		/**
		 * Small Footer
		 */
		'.ast-small-footer'                           => array(
			'font-size'      => astra_responsive_font( $footer_content_font_size, 'desktop' ),
			'font-weight'    => astra_get_css_value( $footer_content_font_weight, 'font' ),
			'font-family'    => astra_get_css_value( $footer_content_font_family, 'font' ),
			'line-height'    => esc_attr( $footer_content_line_height ),
			'text-transform' => esc_attr( $footer_content_text_transform ),
		),

		/**
		 * Single Entry Title / Page Title
		 */
		'.ast-single-post .entry-title, .page-title'  => astra_addon_get_font_array_css( astra_get_option( 'font-family-entry-title' ), astra_get_option( 'font-weight-entry-title' ), array(), 'font-extras-entry-title' ),

		/**
		 * Archive Summary Box
		 */
		'.ast-archive-description .ast-archive-title' => astra_addon_get_font_array_css( astra_get_option( 'font-family-archive-summary-title' ), astra_get_option( 'font-weight-archive-summary-title' ), array(), 'archive-summary-font-extras' ),

		/**
		 * Entry Title
		 */
		'.blog .entry-title, .blog .entry-title a, .archive .entry-title, .archive .entry-title a, .search .entry-title, .search .entry-title a' => array(
			'font-family'     => astra_get_css_value( $archive_page_title_font_family, 'font', $body_font_family ),
			'font-weight'     => astra_get_css_value( $archive_page_title_font_weight, 'font' ),
			'line-height'     => esc_attr( $archive_page_title_line_height ),
			'text-transform'  => esc_attr( $archive_page_title_text_transform ),
			'text-decoration' => esc_attr( $archive_page_title_text_decoration ),
			'letter-spacing'  => esc_attr( $archive_page_title_letter_spacing ),
		),

		/**
		 * Button
		 */
		'button, .ast-button, input#submit, input[type="button"], input[type="submit"], input[type="reset"]' => array(
			'font-size'      => astra_get_font_css_value( $button_font_size['desktop'], $button_font_size['desktop-unit'] ),
			'font-weight'    => astra_get_css_value( $button_font_weight, 'font' ),
			'font-family'    => astra_get_css_value( $button_font_family, 'font' ),
			'text-transform' => esc_attr( $button_text_transform ),
		),

		'.ast-masthead-custom-menu-items, .ast-masthead-custom-menu-items *' => array(
			'font-size'   => astra_get_font_css_value( $outside_menu_item_font['desktop'], $outside_menu_item_font['desktop-unit'] ),
			'line-height' => esc_attr( $outside_menu_line_height ),
		),
	);

	/* Parse CSS from array() */
	$css_output = astra_parse_css( $css_output );

	/* Adding font-weight support to widget-titles. */
	if ( $is_widget_title_support_font_weight ) {
		$widget_title_font_weight_support = array(
			'h4.widget-title' => array(
				'font-weight' => esc_attr( $h4_font_weight ),
			),
			'h5.widget-title' => array(
				'font-weight' => esc_attr( $h5_font_weight ),
			),
			'h6.widget-title' => array(
				'font-weight' => esc_attr( $h6_font_weight ),
			),
		);

		/* Parse CSS from array() -> All media CSS */
		$css_output .= astra_parse_css( $widget_title_font_weight_support );
	}

	if ( false === astra_addon_builder_helper()->is_header_footer_builder_active ) {

		$primary_menu_font_size      = astra_get_option( 'font-size-primary-menu' );
		$primary_menu_font_weight    = astra_get_option( 'font-weight-primary-menu' );
		$primary_menu_font_family    = astra_get_option( 'font-family-primary-menu' );
		$primary_menu_line_height    = astra_get_option( 'line-height-primary-menu' );
		$primary_menu_text_transform = astra_get_option( 'text-transform-primary-menu' );

		$primary_dropdown_menu_font_size      = astra_get_option( 'font-size-primary-dropdown-menu' );
		$primary_dropdown_menu_font_weight    = astra_get_option( 'font-weight-primary-dropdown-menu' );
		$primary_dropdown_menu_font_family    = astra_get_option( 'font-family-primary-dropdown-menu' );
		$primary_dropdown_menu_line_height    = astra_get_option( 'line-height-primary-dropdown-menu' );
		$primary_dropdown_menu_text_transform = astra_get_option( 'text-transform-primary-dropdown-menu' );

		$primary_menu_css_output = array(
			/**
			 * Primary Menu
			 */
			'.main-navigation'                             => array(
				'font-size'   => astra_responsive_font( $primary_menu_font_size, 'desktop' ),
				'font-weight' => astra_get_css_value( $primary_menu_font_weight, 'font' ),
				'font-family' => astra_get_css_value( $primary_menu_font_family, 'font' ),
			),

			'.main-header-bar'                             => array(
				'line-height' => esc_attr( $primary_menu_line_height ),
			),

			'.main-header-bar .main-header-bar-navigation' => array(
				'text-transform' => esc_attr( $primary_menu_text_transform ),
			),

			/**
			 * Primary Submenu
			 */
			'.main-header-menu > .menu-item > .sub-menu:first-of-type, .main-header-menu > .menu-item > .astra-full-megamenu-wrapper:first-of-type' => array(
				'font-size'   => astra_responsive_font( $primary_dropdown_menu_font_size, 'desktop' ),
				'font-weight' => astra_get_css_value( $primary_dropdown_menu_font_weight, 'font' ),
				'font-family' => astra_get_css_value( $primary_dropdown_menu_font_family, 'font' ),
			),

			'.main-header-bar .main-header-bar-navigation .sub-menu' => array(
				'line-height'    => esc_attr( $primary_dropdown_menu_line_height ),
				'text-transform' => esc_attr( $primary_dropdown_menu_text_transform ),
			),
		);

		/* Parse CSS from array() */
		$css_output .= astra_parse_css( $primary_menu_css_output );
	}

	/**
	 * Elementor & Gutenberg button backward compatibility for default styling.
	 */
	if ( Astra_Addon_Update_Filter_Function::page_builder_addon_button_style_css() ) {

		$global_button_page_builder_css_desktop = array(
			/**
			 * Elementor Heading - <h4>
			 */
			'.elementor-widget-heading h4.elementor-heading-title' => array(
				'line-height' => esc_attr( $h4_line_height ),
			),

			/**
			 * Elementor Heading - <h5>
			 */
			'.elementor-widget-heading h5.elementor-heading-title' => array(
				'line-height' => esc_attr( $h5_line_height ),
			),

			/**
			 * Elementor Heading - <h6>
			 */
			'.elementor-widget-heading h6.elementor-heading-title' => array(
				'line-height' => esc_attr( $h6_line_height ),
			),
		);

		/* Parse CSS from array() */
		$css_output .= astra_parse_css( $global_button_page_builder_css_desktop );
	}

	$tablet_css = array(

		'.entry-meta, .read-more'                   => array(
			'font-size' => astra_responsive_font( $post_meta_font_size, 'tablet' ),
		),

		'.ast-pagination .page-numbers, .ast-pagination .page-navigation' => array(
			'font-size' => astra_responsive_font( $post_pagination_font_size, 'tablet' ),
		),

		'.secondary .widget-title, .woocommerce-page #secondary .widget .widget-title' => array(
			'font-size' => astra_responsive_font( $widget_title_font_size, 'tablet' ),
		),

		'.secondary .widget > *:not(.widget-title)' => array(
			'font-size' => astra_responsive_font( $widget_content_font_size, 'tablet' ),
		),

		'.ast-small-footer'                         => array(
			'font-size' => astra_responsive_font( $footer_content_font_size, 'tablet' ),
		),

		'button, .ast-button, input#submit, input[type="button"], input[type="submit"], input[type="reset"]' => array(
			'font-size' => astra_get_font_css_value( $button_font_size['tablet'], $button_font_size['tablet-unit'] ),
		),

		'.ast-masthead-custom-menu-items, .ast-masthead-custom-menu-items *' => array(
			'font-size' => astra_get_font_css_value( $outside_menu_item_font['tablet'], $outside_menu_item_font['tablet-unit'] ),
		),
	);

	/* Parse CSS from array() */
	$css_output .= astra_parse_css( $tablet_css, '', astra_addon_get_tablet_breakpoint() );

	if ( false === astra_addon_builder_helper()->is_header_footer_builder_active ) {
		$menu_tablet_css = array(
			'.main-navigation' => array(
				'font-size' => astra_responsive_font( $primary_menu_font_size, 'tablet' ),
			),

			'.main-header-menu > .menu-item > .sub-menu:first-of-type, .main-header-menu > .menu-item > .astra-full-megamenu-wrapper:first-of-type' => array(
				'font-size' => astra_responsive_font( $primary_dropdown_menu_font_size, 'tablet' ),
			),
		);

		/* Parse CSS from array() */
		$css_output .= astra_parse_css( $menu_tablet_css, '', astra_addon_get_tablet_breakpoint() );
	}

	$mobile_css = array(

		'.entry-meta, .read-more'                   => array(
			'font-size' => astra_responsive_font( $post_meta_font_size, 'mobile' ),
		),

		'.ast-pagination .page-numbers, .ast-pagination .page-navigation' => array(
			'font-size' => astra_responsive_font( $post_pagination_font_size, 'mobile' ),
		),

		'.secondary .widget-title, .woocommerce-page #secondary .widget .widget-title' => array(
			'font-size' => astra_responsive_font( $widget_title_font_size, 'mobile' ),
		),

		'.secondary .widget > *:not(.widget-title)' => array(
			'font-size' => astra_responsive_font( $widget_content_font_size, 'mobile' ),
		),

		'.ast-small-footer'                         => array(
			'font-size' => astra_responsive_font( $footer_content_font_size, 'mobile' ),
		),

		'button, .ast-button, input#submit, input[type="button"], input[type="submit"], input[type="reset"]' => array(
			'font-size' => astra_get_font_css_value( $button_font_size['mobile'], $button_font_size['mobile-unit'] ),
		),

		'.ast-masthead-custom-menu-items, .ast-masthead-custom-menu-items *' => array(
			'font-size' => astra_get_font_css_value( $outside_menu_item_font['mobile'], $outside_menu_item_font['mobile-unit'] ),
		),
	);

	/* Parse CSS from array() */
	$css_output .= astra_parse_css( $mobile_css, '', astra_addon_get_mobile_breakpoint() );

	if ( false === astra_addon_builder_helper()->is_header_footer_builder_active ) {
		$menu_mobile_css = array(
			'.main-navigation' => array(
				'font-size' => astra_responsive_font( $primary_menu_font_size, 'mobile' ),
			),

			'.main-header-menu > .menu-item > .sub-menu:first-of-type, .main-header-menu > .menu-item > .astra-full-megamenu-wrapper:first-of-type' => array(
				'font-size' => astra_responsive_font( $primary_dropdown_menu_font_size, 'mobile' ),
			),
		);

		/* Parse CSS from array() */
		$css_output .= astra_parse_css( $menu_mobile_css, '', astra_addon_get_mobile_breakpoint() );
	}

	/**
	 * Merge Header Section when no primary menu
	 */
	if ( Astra_Ext_Extension::is_active( 'header-sections' ) && false === astra_addon_builder_helper()->is_header_footer_builder_active ) {
		/**
		 * Set font sizes
		 */
		$header_sections = array(

			/**
			 * Primary Menu
			 */
			'.ast-header-sections-navigation, .ast-above-header-menu-items, .ast-below-header-menu-items'                             => array(

				'font-size'   => astra_responsive_font( $primary_menu_font_size, 'desktop' ),
				'font-weight' => astra_get_css_value( $primary_menu_font_weight, 'font' ),
				'font-family' => astra_get_css_value( $primary_menu_font_family, 'font' ),
			),

			/**
			 * Primary Submenu
			 */
			'.ast-header-sections-navigation li > .sub-menu:first-of-type, .ast-above-header-menu-items .menu-item > .sub-menu:first-of-type, .ast-below-header-menu-items li > .sub-menu:first-of-type' => array(
				'font-size'   => astra_responsive_font( $primary_dropdown_menu_font_size, 'desktop' ),
				'font-weight' => astra_get_css_value( $primary_dropdown_menu_font_weight, 'font' ),
				'font-family' => astra_get_css_value( $primary_dropdown_menu_font_family, 'font' ),
			),

			'.ast-header-sections-navigation .sub-menu, .ast-above-header-menu-items .sub-menu, .ast-below-header-menu-items .sub-menu,' => array(
				'line-height'    => esc_attr( $primary_dropdown_menu_line_height ),
				'text-transform' => esc_attr( $primary_dropdown_menu_text_transform ),
			),

		);

		/* Parse CSS from array() */
		$css_output .= astra_parse_css( $header_sections );

		$tablet_header_sections = array(
			'.ast-header-sections-navigation, .ast-above-header-menu-items, .ast-below-header-menu-items'                          => array(
				'font-size' => astra_responsive_font( $primary_menu_font_size, 'tablet' ),
			),
			'.ast-header-sections-navigation li > .sub-menu:first-of-type, .ast-above-header-menu-items .menu-item > .sub-menu:first-of-type, .ast-below-header-menu-items li > .sub-menu:first-of-type' => array(
				'font-size' => astra_responsive_font( $primary_dropdown_menu_font_size, 'tablet' ),
			),
		);

		/* Parse CSS from array() */
		$css_output .= astra_parse_css( $tablet_header_sections, '', astra_addon_get_tablet_breakpoint() );

		$mobile_header_sections = array(
			'.ast-header-sections-navigation, .ast-above-header-menu-items, .ast-below-header-menu-items'                          => array(
				'font-size' => astra_responsive_font( $primary_menu_font_size, 'mobile' ),
			),
			'.ast-header-sections-navigation li > .sub-menu:first-of-type, .ast-above-header-menu-items .menu-item > .sub-menu:first-of-type, .ast-below-header-menu-items li > .sub-menu:first-of-type' => array(
				'font-size' => astra_responsive_font( $primary_dropdown_menu_font_size, 'mobile' ),
			),
		);

		/* Parse CSS from array() */
		$css_output .= astra_parse_css( $mobile_header_sections, '', astra_addon_get_mobile_breakpoint( 1, '' ) );
	}

	if ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) {

		/**
		 * Header - Menu - Typography.
		 */
		$num_of_header_menu = astra_addon_builder_helper()->num_of_header_menu;
		for ( $index = 1; $index <= $num_of_header_menu; $index++ ) {

			if ( ! Astra_Addon_Builder_Helper::is_component_loaded( 'menu-' . $index, 'header' ) ) {
				continue;
			}

			$_prefix  = 'menu' . $index;
			$_section = 'section-hb-menu-' . $index;

			$selector         = '.ast-hfb-header .ast-builder-menu-' . $index . ' .main-header-menu';
			$selector_desktop = '.ast-hfb-header.ast-desktop .ast-builder-menu-' . $index . ' .main-header-menu';

			if ( version_compare( ASTRA_THEME_VERSION, '3.2.0', '<' ) ) {

				$selector         = '.astra-hfb-header .ast-builder-menu-' . $index . ' .main-header-menu';
				$selector_desktop = '.astra-hfb-header.ast-desktop .ast-builder-menu-' . $index . ' .main-header-menu';
			}

			$sub_menu_font_size              = astra_get_option( 'header-font-size-' . $_prefix . '-sub-menu' );
			$sub_menu_font_size_desktop      = ( isset( $sub_menu_font_size['desktop'] ) ) ? $sub_menu_font_size['desktop'] : '';
			$sub_menu_font_size_tablet       = ( isset( $sub_menu_font_size['tablet'] ) ) ? $sub_menu_font_size['tablet'] : '';
			$sub_menu_font_size_mobile       = ( isset( $sub_menu_font_size['mobile'] ) ) ? $sub_menu_font_size['mobile'] : '';
			$sub_menu_font_size_desktop_unit = ( isset( $sub_menu_font_size['desktop-unit'] ) ) ? $sub_menu_font_size['desktop-unit'] : '';
			$sub_menu_font_size_tablet_unit  = ( isset( $sub_menu_font_size['tablet-unit'] ) ) ? $sub_menu_font_size['tablet-unit'] : '';
			$sub_menu_font_size_mobile_unit  = ( isset( $sub_menu_font_size['mobile-unit'] ) ) ? $sub_menu_font_size['mobile-unit'] : '';

			$css_output_desktop = array(
				$selector . ' .sub-menu .menu-link' => astra_addon_get_font_array_css( astra_get_option( 'header-font-family-' . $_prefix . '-sub-menu' ), astra_get_option( 'header-font-weight-' . $_prefix . '-sub-menu' ), $sub_menu_font_size, 'header-font-extras-' . $_prefix . '-sub-menu' ),
			);

			$css_output_tablet = array(
				$selector . '.ast-nav-menu .sub-menu .menu-item .menu-link' => array(
					'font-size' => astra_get_font_css_value( $sub_menu_font_size_tablet, $sub_menu_font_size_tablet_unit ),
				),
			);

			$css_output_mobile = array(
				$selector . '.ast-nav-menu .sub-menu .menu-item .menu-link' => array(
					'font-size' => astra_get_font_css_value( $sub_menu_font_size_mobile, $sub_menu_font_size_mobile_unit ),
				),
			);

			if ( 3 > $index ) {

				$mega_menu_heading_font_size             = astra_get_option( 'header-' . $_prefix . '-megamenu-heading-font-size' );
				$mega_menu_heading_font_size_desktop     = ( isset( $mega_menu_heading_font_size['desktop'] ) ) ? $mega_menu_heading_font_size['desktop'] : '';
				$mega_menu_heading_font_size_tablet      = ( isset( $mega_menu_heading_font_size['tablet'] ) ) ? $mega_menu_heading_font_size['tablet'] : '';
				$mega_menu_heading_font_size_mobile      = ( isset( $mega_menu_heading_font_size['mobile'] ) ) ? $mega_menu_heading_font_size['mobile'] : '';
				$mega_menu_heading_font_size_tablet_unit = ( isset( $mega_menu_heading_font_size['tablet-unit'] ) ) ? $mega_menu_heading_font_size['tablet-unit'] : '';
				$mega_menu_heading_font_size_mobile_unit = ( isset( $mega_menu_heading_font_size['mobile-unit'] ) ) ? $mega_menu_heading_font_size['mobile-unit'] : '';

				$css_megamenu_output_desktop = array(
					// Mega Menu.
					$selector_desktop . ' .menu-item.menu-item-heading > .menu-link' => astra_addon_get_font_array_css( astra_get_option( 'header-' . $_prefix . '-megamenu-heading-font-family' ), astra_get_option( 'header-' . $_prefix . '-megamenu-heading-font-weight' ), $mega_menu_heading_font_size, 'header-' . $_prefix . '-megamenu-heading-font-extras' ),
				);

				$css_megamenu_output_tablet = array(
					// Mega Menu.
					$selector . ' .menu-item.menu-item-heading > .menu-link' => array(
						'font-size' => astra_get_font_css_value( $mega_menu_heading_font_size_tablet, $mega_menu_heading_font_size_tablet_unit ),
					),
				);

				$css_megamenu_output_mobile = array(
					// Mega Menu.
					$selector . ' .menu-item.menu-item-heading > .menu-link' => array(
						'font-size' => astra_get_font_css_value( $mega_menu_heading_font_size_mobile, $mega_menu_heading_font_size_mobile_unit ),
					),
				);

				$css_output .= astra_parse_css( $css_megamenu_output_desktop );
				$css_output .= astra_parse_css( $css_megamenu_output_tablet, '', astra_addon_get_tablet_breakpoint() );
				$css_output .= astra_parse_css( $css_megamenu_output_mobile, '', astra_addon_get_mobile_breakpoint() );
			}

			$css_output .= astra_parse_css( $css_output_desktop );
			$css_output .= astra_parse_css( $css_output_tablet, '', astra_addon_get_tablet_breakpoint() );
			$css_output .= astra_parse_css( $css_output_mobile, '', astra_addon_get_mobile_breakpoint() );
		}

		/**
		 * Header - HTML - Typography.
		 */
		$num_of_header_html = astra_addon_builder_helper()->num_of_header_html;
		for ( $index = 1; $index <= $num_of_header_html; $index++ ) {

			if ( ! Astra_Addon_Builder_Helper::is_component_loaded( 'html-' . $index, 'header' ) ) {
				continue;
			}

			$_prefix    = 'html' . $index;
			$section    = 'section-hb-html-';
			$selector   = '.site-header-section .ast-builder-layout-element.ast-header-html-' . $index . ' .ast-builder-html-element';
			$section_id = $section . $index;

			/**
			 * Typography CSS.
			 */
			$css_output_desktop = array(
				$selector => astra_addon_get_font_array_css( astra_get_option( 'font-family-' . $section_id, 'inherit' ), astra_get_option( 'font-weight-' . $section_id, 'inherit' ), array(), 'font-extras-' . $section_id ),
			);

			$css_output .= astra_parse_css( $css_output_desktop );
		}

		/**
		 * Header - Widget - Typography.
		 */
		$num_of_header_widgets = astra_addon_builder_helper()->num_of_header_widgets;
		for ( $index = 1; $index <= $num_of_header_widgets; $index++ ) {

			if ( ! Astra_Addon_Builder_Helper::is_component_loaded( 'widget-' . $index, 'header' ) ) {
				continue;
			}

			$_section = 'sidebar-widgets-header-widget-' . $index;
			$selector = '.header-widget-area[data-section="sidebar-widgets-header-widget-' . $index . '"]';

			/**
			 * Typography CSS.
			 */
			$css_output_desktop = array(
				$selector . ' .widget-title' => astra_addon_get_font_array_css( astra_get_option( 'header-widget-' . $index . '-font-family', 'inherit' ), astra_get_option( 'header-widget-' . $index . '-font-weight', 'inherit' ), array(), 'header-widget-' . $index . '-font-extras' ),
			);

			if ( Astra_Addon_Builder_Helper::apply_flex_based_css() ) {
				$header_widget_selector = $selector . '.header-widget-area-inner';
			} else {
				$header_widget_selector = $selector . ' .header-widget-area-inner';
			}

			$css_output_desktop[ $header_widget_selector ] = astra_addon_get_font_array_css( astra_get_option( 'header-widget-' . $index . '-content-font-family', 'inherit' ), astra_get_option( 'header-widget-' . $index . '-content-font-weight', 'inherit' ), array(), 'header-widget-' . $index . '-content-font-extras' );

			$css_output .= astra_parse_css( $css_output_desktop );
		}

		/**
		 * Footer - Widget - Typography.
		 */
		$num_of_footer_widgets = astra_addon_builder_helper()->num_of_footer_widgets;
		for ( $index = 1; $index <= $num_of_footer_widgets; $index++ ) {

			if ( ! Astra_Addon_Builder_Helper::is_component_loaded( 'widget-' . $index, 'footer' ) ) {
				continue;
			}

			$_section = 'sidebar-widgets-footer-widget-' . $index;
			$selector = '.footer-widget-area[data-section="sidebar-widgets-footer-widget-' . $index . '"]';

			/**
			 * Typography CSS.
			 */
			$css_output_desktop = array(
				$selector . ' .widget-title' => astra_addon_get_font_array_css( astra_get_option( 'footer-widget-' . $index . '-font-family', 'inherit' ), astra_get_option( 'footer-widget-' . $index . '-font-weight', 'inherit' ), array(), 'footer-widget-' . $index . '-font-extras' ),
			);

			if ( Astra_Addon_Builder_Helper::apply_flex_based_css() ) {
				$footer_widget_selector = $selector . '.footer-widget-area-inner';
			} else {
				$footer_widget_selector = $selector . ' .footer-widget-area-inner';
			}

			$css_output_desktop[ $footer_widget_selector ] = astra_addon_get_font_array_css( astra_get_option( 'footer-widget-' . $index . '-content-font-family', 'inherit' ), astra_get_option( 'footer-widget-' . $index . '-content-font-weight', 'inherit' ), array(), 'footer-widget-' . $index . '-content-font-extras' );

			$css_output .= astra_parse_css( $css_output_desktop );
		}

		/**
		 * Footer - HTML - Typography.
		 */
		$num_of_footer_html = astra_addon_builder_helper()->num_of_footer_html;
		for ( $index = 1; $index <= $num_of_footer_html; $index++ ) {

			if ( ! Astra_Addon_Builder_Helper::is_component_loaded( 'html-' . $index, 'footer' ) ) {
				continue;
			}

			$_prefix  = 'html' . $index;
			$section  = 'section-fb-html-';
			$selector = '.site-footer-section .ast-footer-html-' . $index . ' .ast-builder-html-element';

			$section_id = $section . $index;

			/**
			 * Typography CSS.
			 */
			$css_output_desktop = array(
				$selector => astra_addon_get_font_array_css( astra_get_option( 'font-family-' . $section_id ), astra_get_option( 'font-weight-' . $section_id ), array(), 'font-extras-' . $section_id ),
			);

			$css_output .= astra_parse_css( $css_output_desktop );
		}

		/**
		 * Header - Social - Typography
		 */

		$num_of_header_social_icons = astra_addon_builder_helper()->num_of_header_social_icons;
		for ( $index = 1; $index <= $num_of_header_social_icons; $index++ ) {

			if ( ! Astra_Addon_Builder_Helper::is_component_loaded( 'social-icons-' . $index, 'header' ) ) {
				continue;
			}

			$_section = 'section-hb-social-icons-' . $index;
			$selector = '.ast-builder-layout-element .ast-header-social-' . $index . '-wrap';

			/**
			 * Typography CSS.
			 */
			$css_output_desktop = array(
				$selector => astra_addon_get_font_array_css( astra_get_option( 'font-family-' . $_section ), astra_get_option( 'font-weight-' . $_section ), array(), 'font-extras-' . $_section ),
			);

			$css_output .= astra_parse_css( $css_output_desktop );
		}

		/**
		 * Footer - Social - Typography
		 */

		$num_of_footer_social_icons = astra_addon_builder_helper()->num_of_footer_social_icons;
		for ( $index = 1; $index <= $num_of_footer_social_icons; $index++ ) {

			if ( ! Astra_Addon_Builder_Helper::is_component_loaded( 'social-icons-' . $index, 'footer' ) ) {
				continue;
			}

			$_section = 'section-fb-social-icons-' . $index;
			$selector = '.ast-builder-layout-element .ast-footer-social-' . $index . '-wrap';

			/**
			 * Typography CSS.
			 */
			$css_output_desktop = array(
				$selector => astra_addon_get_font_array_css( astra_get_option( 'font-family-' . $_section ), astra_get_option( 'font-weight-' . $_section ), array(), 'font-extras-' . $_section ),
			);

			$css_output .= astra_parse_css( $css_output_desktop );
		}

		/**
		 * Footer - Copyright - Typography
		 */

		if ( Astra_Addon_Builder_Helper::is_component_loaded( 'copyright', 'footer' ) ) {
			$selector = '.ast-footer-copyright';
			$_section = 'section-footer-copyright';

			/**
			 * Typography CSS.
			 */
			$css_output_desktop = array(
				$selector => astra_addon_get_font_array_css( astra_get_option( 'font-family-' . $_section ), astra_get_option( 'font-weight-' . $_section ), array(), 'font-extras-' . $_section ),
			);

			$css_output .= astra_parse_css( $css_output_desktop );
		}

		/**
		 * Header - Account - Typography
		 */

		if ( Astra_Addon_Builder_Helper::is_component_loaded( 'account', 'header' ) ) {
			$selector = '.ast-header-account-wrap';
			$_section = 'section-header-account';

			$menu_font_size             = astra_get_option( $_section . '-menu-font-size' );
			$menu_font_size_tablet      = ( isset( $menu_font_size['tablet'] ) ) ? $menu_font_size['tablet'] : '';
			$menu_font_size_mobile      = ( isset( $menu_font_size['mobile'] ) ) ? $menu_font_size['mobile'] : '';
			$menu_font_size_tablet_unit = ( isset( $menu_font_size['tablet-unit'] ) ) ? $menu_font_size['tablet-unit'] : '';
			$menu_font_size_mobile_unit = ( isset( $menu_font_size['mobile-unit'] ) ) ? $menu_font_size['mobile-unit'] : '';
			$popup_font_size            = astra_get_option( $_section . '-popup-font-size' );
			$popup_button_size          = astra_get_option( $_section . '-popup-button-font-size' );

			/**
			 * Typography CSS.
			 */
			$css_output_desktop = array(
				$selector . ' .ast-header-account-text' => astra_addon_get_font_array_css( astra_get_option( 'font-family-' . $_section, 'inherit' ), astra_get_option( 'font-weight-' . $_section, 'inherit' ), array(), 'font-extras-' . $_section ),
				$selector . ' .main-header-menu.ast-account-nav-menu .menu-link' => astra_addon_get_font_array_css( astra_get_option( $_section . '-menu-font-family' ), astra_get_option( $_section . '-menu-font-weight' ), $menu_font_size, $_section . '-menu-font-extras' ),
				$selector . ' .ast-hb-account-login-form label,' . $selector . ' .ast-hb-account-login-form-footer .ast-header-account-footer-link, ' . $selector . ' .ast-hb-account-login-form #loginform input[type=text], ' . $selector . ' .ast-hb-account-login-form #loginform input[type=password]' => array(
					// Typography.
					'font-size' => astra_responsive_font( $popup_font_size, 'desktop' ),
				),
				$selector . ' .ast-hb-account-login-form input[type="submit"]' => array(
					'font-size' => astra_responsive_font( $popup_button_size, 'desktop' ),
				),
			);

			$css_output_tablet = array(
				$selector . ' .ast-hb-account-login-form label,' . $selector . ' .ast-hb-account-login-form-footer .ast-header-account-footer-link, ' . $selector . ' .ast-hb-account-login-form #loginform input[type=text], ' . $selector . ' .ast-hb-account-login-form #loginform input[type=password]' => array(
					'font-size' => astra_responsive_font( $popup_font_size, 'tablet' ),
				),
				$selector . ' .main-header-menu.ast-account-nav-menu .menu-link' => array(
					'font-size' => astra_get_font_css_value( $menu_font_size_tablet, $menu_font_size_tablet_unit ),
				),
				$selector . ' .ast-hb-account-login-form input[type="submit"]' => array(
					'font-size' => astra_responsive_font( $popup_button_size, 'tablet' ),
				),
			);

			$css_output_mobile = array(
				$selector . ' .ast-hb-account-login-form label,' . $selector . ' .ast-hb-account-login-form-footer .ast-header-account-footer-link, ' . $selector . ' .ast-hb-account-login-form #loginform input[type=text], ' . $selector . ' .ast-hb-account-login-form #loginform input[type=password]' => array(
					'font-size' => astra_responsive_font( $popup_font_size, 'mobile' ),
				),
				$selector . ' .main-header-menu.ast-account-nav-menu .menu-link' => array(
					'font-size' => astra_get_font_css_value( $menu_font_size_mobile, $menu_font_size_mobile_unit ),
				),
				$selector . ' .ast-hb-account-login-form input[type="submit"]' => array(
					'font-size' => astra_responsive_font( $popup_button_size, 'mobile' ),
				),
			);

			$css_output .= astra_parse_css( $css_output_desktop );
			$css_output .= astra_parse_css( $css_output_tablet, '', astra_addon_get_tablet_breakpoint() );
			$css_output .= astra_parse_css( $css_output_mobile, '', astra_addon_get_mobile_breakpoint() );
		}

		/**
		 * Footer - Menu - Typography
		 */

		if ( Astra_Addon_Builder_Helper::is_component_loaded( 'menu', 'footer' ) ) {

			$selector           = '#astra-footer-menu';
			$css_output_desktop = array(
				$selector . ' .menu-item > a' => astra_addon_get_font_array_css( astra_get_option( 'footer-menu-font-family' ), astra_get_option( 'footer-menu-font-weight' ), array(), 'footer-menu-font-extras' ),
			);

			$css_output .= astra_parse_css( $css_output_desktop );
		}

		/**
		 * Header - Language Switcher - Typography
		 */
		if ( Astra_Addon_Builder_Helper::is_component_loaded( 'language-switcher', 'header' ) ) {

			$_section  = 'section-hb-language-switcher';
			$selector  = '.ast-lswitcher-item-header';
			$font_size = astra_get_option( 'font-size-' . $_section );

			/**
			 * Typography CSS.
			 */
			$css_output_desktop = array(
				$selector => astra_addon_get_font_array_css( astra_get_option( 'font-family-' . $_section ), astra_get_option( 'font-weight-' . $_section ), $font_size, 'font-extras-' . $_section ),
			);

			$css_output_tablet = array(

				$selector => array(
					'font-size' => astra_get_font_css_value( $font_size['tablet'], $font_size['tablet-unit'] ),
				),
			);

			$css_output_mobile = array(

				$selector => array(
					'font-size' => astra_get_font_css_value( $font_size['mobile'], $font_size['mobile-unit'] ),
				),
			);

			$css_output .= astra_parse_css( $css_output_desktop );
			$css_output .= astra_parse_css( $css_output_tablet, '', astra_addon_get_tablet_breakpoint() );
			$css_output .= astra_parse_css( $css_output_mobile, '', astra_addon_get_mobile_breakpoint() );
		}

		/**
		 * Footer - Language Switcher - Typography
		 */
		if ( Astra_Addon_Builder_Helper::is_component_loaded( 'language-switcher', 'footer' ) ) {
			$_section  = 'section-fb-language-switcher';
			$selector  = '.ast-lswitcher-item-footer';
			$font_size = astra_get_option( 'font-size-' . $_section );

			/**
			 * Typography CSS.
			 */
			$css_output_desktop = array(
				$selector => astra_addon_get_font_array_css( astra_get_option( 'font-family-' . $_section, 'inherit' ), astra_get_option( 'font-weight-' . $_section, 'inherit' ), $font_size, 'font-extras-' . $_section ),
			);

			$css_output_tablet = array(
				$selector => array(
					'font-size' => astra_get_font_css_value( $font_size['tablet'], $font_size['tablet-unit'] ),
				),
			);

			$css_output_mobile = array(
				$selector => array(
					'font-size' => astra_get_font_css_value( $font_size['mobile'], $font_size['mobile-unit'] ),
				),
			);

			$css_output .= astra_parse_css( $css_output_desktop );
			$css_output .= astra_parse_css( $css_output_tablet, '', astra_addon_get_tablet_breakpoint() );
			$css_output .= astra_parse_css( $css_output_mobile, '', astra_addon_get_mobile_breakpoint() );
		}

		/**
		 * Sidebar Widget Title - Typography
		 */
		$sidebar_title_font_size = astra_get_option( 'font-size-sidebar-title' );
		if ( $sidebar_title_font_size ) {

			$sidebar_title_font_size_desktop      = ( isset( $sidebar_title_font_size['desktop'] ) ) ? $sidebar_title_font_size['desktop'] : '';
			$sidebar_title_font_size_tablet       = ( isset( $sidebar_title_font_size['tablet'] ) ) ? $sidebar_title_font_size['tablet'] : '';
			$sidebar_title_font_size_mobile       = ( isset( $sidebar_title_font_size['mobile'] ) ) ? $sidebar_title_font_size['mobile'] : '';
			$sidebar_title_font_size_desktop_unit = ( isset( $sidebar_title_font_size['desktop-unit'] ) ) ? $sidebar_title_font_size['desktop-unit'] : '';
			$sidebar_title_font_size_tablet_unit  = ( isset( $sidebar_title_font_size['tablet-unit'] ) ) ? $sidebar_title_font_size['tablet-unit'] : '';
			$sidebar_title_font_size_mobile_unit  = ( isset( $sidebar_title_font_size['mobile-unit'] ) ) ? $sidebar_title_font_size['mobile-unit'] : '';

			$css_output_common = array(
				'#secondary .wp-block-group h2:first-of-type' => array(
					'font-size' => astra_get_font_css_value( $sidebar_title_font_size_desktop, $sidebar_title_font_size_desktop_unit ),
				),
			);

			$css_output_tablet = array(
				'#secondary .wp-block-group h2:first-of-type' => array(
					'font-size' => astra_get_font_css_value( $sidebar_title_font_size_tablet, $sidebar_title_font_size_tablet_unit ),
				),
			);

			$css_output_mobile = array(
				'#secondary .wp-block-group h2:first-of-type' => array(
					'font-size' => astra_get_font_css_value( $sidebar_title_font_size_mobile, $sidebar_title_font_size_mobile_unit ),
				),
			);

			$css_output .= astra_parse_css( $css_output_common );
			$css_output .= astra_parse_css( $css_output_tablet, '', astra_addon_get_tablet_breakpoint() );
			$css_output .= astra_parse_css( $css_output_mobile, '', astra_addon_get_mobile_breakpoint() );

		}

		/**
		 * Sidebar Widget Content - Typography
		 */
		$sidebar_content_font_size = astra_get_option( 'font-size-sidebar-content' );
		if ( $sidebar_content_font_size ) {

			$sidebar_content_font_size_desktop      = ( isset( $sidebar_content_font_size['desktop'] ) ) ? $sidebar_content_font_size['desktop'] : '';
			$sidebar_content_font_size_tablet       = ( isset( $sidebar_content_font_size['tablet'] ) ) ? $sidebar_content_font_size['tablet'] : '';
			$sidebar_content_font_size_mobile       = ( isset( $sidebar_content_font_size['mobile'] ) ) ? $sidebar_content_font_size['mobile'] : '';
			$sidebar_content_font_size_desktop_unit = ( isset( $sidebar_content_font_size['desktop-unit'] ) ) ? $sidebar_content_font_size['desktop-unit'] : '';
			$sidebar_content_font_size_tablet_unit  = ( isset( $sidebar_content_font_size['tablet-unit'] ) ) ? $sidebar_content_font_size['tablet-unit'] : '';
			$sidebar_content_font_size_mobile_unit  = ( isset( $sidebar_content_font_size['mobile-unit'] ) ) ? $sidebar_content_font_size['mobile-unit'] : '';

			$css_output_common = array(
				'#secondary .wp-block-group *:not(h2:first-of-type)' => array(
					'font-size' => astra_get_font_css_value( $sidebar_content_font_size_desktop, $sidebar_content_font_size_desktop_unit ) . '!important',
				),
			);

			$css_output_tablet = array(
				'#secondary .wp-block-group *:not(h2:first-of-type)' => array(
					'font-size' => astra_get_font_css_value( $sidebar_content_font_size_tablet, $sidebar_content_font_size_tablet_unit ) . '!important',
				),
			);

			$css_output_mobile = array(
				'#secondary .wp-block-group *:not(h2:first-of-type)' => array(
					'font-size' => astra_get_font_css_value( $sidebar_content_font_size_mobile, $sidebar_content_font_size_mobile_unit ) . '!important',
				),
			);

			$css_output .= astra_parse_css( $css_output_common );
			$css_output .= astra_parse_css( $css_output_tablet, '', astra_addon_get_tablet_breakpoint() );
			$css_output .= astra_parse_css( $css_output_mobile, '', astra_addon_get_mobile_breakpoint() );

		}

		/**
		 * Header - Mobile Trigger - Typography
		 */

			/**
			 * Typography CSS.
			 */
			$css_output_desktop = array(
				'[data-section="section-header-mobile-trigger"] .ast-button-wrap .mobile-menu-wrap .mobile-menu' => astra_addon_get_font_array_css( astra_get_option( 'mobile-header-label-font-family' ), astra_get_option( 'mobile-header-label-font-weight' ), array(), 'mobile-header-label-font-extras' ),
			);

			$css_output .= astra_parse_css( $css_output_desktop );

			/**
			 * Mobile Menu - Typography.
			 */

			$_section = 'section-header-mobile-menu';

			$selector = '.ast-hfb-header .ast-builder-menu-mobile .main-header-menu';

			if ( version_compare( ASTRA_THEME_VERSION, '3.2.0', '<' ) ) {
				$selector = '.astra-hfb-header .ast-builder-menu-mobile .main-header-menu';
			}

			$sub_menu_font_size              = astra_get_option( 'header-font-size-mobile-menu-sub-menu' );
			$sub_menu_font_size_desktop      = ( isset( $sub_menu_font_size['desktop'] ) ) ? $sub_menu_font_size['desktop'] : '';
			$sub_menu_font_size_tablet       = ( isset( $sub_menu_font_size['tablet'] ) ) ? $sub_menu_font_size['tablet'] : '';
			$sub_menu_font_size_mobile       = ( isset( $sub_menu_font_size['mobile'] ) ) ? $sub_menu_font_size['mobile'] : '';
			$sub_menu_font_size_desktop_unit = ( isset( $sub_menu_font_size['desktop-unit'] ) ) ? $sub_menu_font_size['desktop-unit'] : '';
			$sub_menu_font_size_tablet_unit  = ( isset( $sub_menu_font_size['tablet-unit'] ) ) ? $sub_menu_font_size['tablet-unit'] : '';
			$sub_menu_font_size_mobile_unit  = ( isset( $sub_menu_font_size['mobile-unit'] ) ) ? $sub_menu_font_size['mobile-unit'] : '';

			$css_output_common = array(
				$selector . ' .sub-menu .menu-link' => astra_addon_get_font_array_css( astra_get_option( 'header-font-family-mobile-menu-sub-menu' ), astra_get_option( 'header-font-weight-mobile-menu-sub-menu' ), array(), 'font-extras-mobile-menu-sub-menu' ),
				$selector . '.ast-nav-menu .sub-menu .menu-item .menu-link' => array(
					'font-size' => astra_get_font_css_value( $sub_menu_font_size_desktop, $sub_menu_font_size_desktop_unit ),
				),
			);

			$css_output_tablet = array(
				$selector . '.ast-nav-menu .sub-menu .menu-item .menu-link' => array(
					'font-size' => astra_get_font_css_value( $sub_menu_font_size_tablet, $sub_menu_font_size_tablet_unit ),
				),
			);

			$css_output_mobile = array(
				$selector . '.ast-nav-menu .sub-menu .menu-item .menu-link' => array(
					'font-size' => astra_get_font_css_value( $sub_menu_font_size_mobile, $sub_menu_font_size_mobile_unit ),
				),
			);

			$css_output .= astra_parse_css( $css_output_common );
			$css_output .= astra_parse_css( $css_output_tablet, '', astra_addon_get_tablet_breakpoint() );
			$css_output .= astra_parse_css( $css_output_mobile, '', astra_addon_get_mobile_breakpoint() );
	}

	return $dynamic_css . $css_output;

}


/**
 * Conditionally iclude CSS Selectors with anchors in the typography settings.
 *
 * Historically Astra adds Colors/Typography CSS for headings and anchors for headings but this causes irregularities with the expected output.
 * For eg Link color does not work for the links inside headings.
 *
 * If filter `astra_include_achors_in_headings_typography` is set to true or Astra Option `include-headings-in-typography` is set to true, This will return selectors with anchors. Else This will return selectors without anchors.
 *
 * @since 1.5.0
 * @param String $selectors_with_achors CSS Selectors with anchors.
 * @param String $selectors_without_achors CSS Selectors withour annchors.
 *
 * @return String CSS Selectors based on the condition of filters.
 */
function astra_addon_typography_conditional_headings_css_selectors( $selectors_with_achors, $selectors_without_achors ) {

	if ( true == astra_addon_typography_anchors_in_css_selectors_heading() ) {
		return $selectors_with_achors;
	} else {
		return $selectors_without_achors;
	}

}

/**
 * Check if CSS selectors in Headings should use anchors.
 *
 * @since 1.5.0
 * @return boolean true if it should include anchors, False if not.
 */
function astra_addon_typography_anchors_in_css_selectors_heading() {

	if ( true == astra_get_option( 'include-headings-in-typography' ) &&
		true === apply_filters(
			'astra_include_achors_in_headings_typography',
			true
		) ) {

			return true;
	} else {

		return false;
	}

}
