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

	$site_title_font_family    = astra_get_option( 'font-family-site-title' );
	$site_title_font_weight    = astra_get_option( 'font-weight-site-title' );
	$site_title_line_height    = astra_get_option( 'line-height-site-title' );
	$site_title_text_transform = astra_get_option( 'text-transform-site-title', $headings_font_transform );

	$site_tagline_font_family    = astra_get_option( 'font-family-site-tagline' );
	$site_tagline_font_weight    = astra_get_option( 'font-weight-site-tagline' );
	$site_tagline_line_height    = astra_get_option( 'line-height-site-tagline' );
	$site_tagline_text_transform = astra_get_option( 'text-transform-site-tagline', $headings_font_transform );

	$single_entry_title_font_family    = astra_get_option( 'font-family-entry-title' );
	$single_entry_title_font_weight    = astra_get_option( 'font-weight-entry-title' );
	$single_entry_title_line_height    = astra_get_option( 'line-height-entry-title' );
	$single_entry_title_text_transform = astra_get_option( 'text-transform-entry-title', $headings_font_transform );

	$archive_summary_title_font_family    = astra_get_option( 'font-family-archive-summary-title' );
	$archive_summary_title_font_weight    = astra_get_option( 'font-weight-archive-summary-title' );
	$archive_summary_title_line_height    = astra_get_option( 'line-height-archive-summary-title' );
	$archive_summary_title_text_transform = astra_get_option( 'text-transform-archive-summary-title', $headings_font_transform );

	$archive_page_title_font_family    = astra_get_option( 'font-family-page-title' );
	$archive_page_title_font_weight    = astra_get_option( 'font-weight-page-title' );
	$archive_page_title_text_transform = astra_get_option( 'text-transform-page-title', $headings_font_transform );
	$archive_page_title_line_height    = astra_get_option( 'line-height-page-title' );

	$post_meta_font_size      = astra_get_option( 'font-size-post-meta' );
	$post_meta_font_family    = astra_get_option( 'font-family-post-meta' );
	$post_meta_font_weight    = astra_get_option( 'font-weight-post-meta' );
	$post_meta_line_height    = astra_get_option( 'line-height-post-meta' );
	$post_meta_text_transform = astra_get_option( 'text-transform-post-meta' );

	$post_pagination_font_size      = astra_get_option( 'font-size-post-pagination' );
	$post_pagination_text_transform = astra_get_option( 'text-transform-post-pagination' );

	$widget_title_font_size      = astra_get_option( 'font-size-widget-title' );
	$widget_title_font_family    = astra_get_option( 'font-family-widget-title' );
	$widget_title_font_weight    = astra_get_option( 'font-weight-widget-title' );
	$widget_title_line_height    = astra_get_option( 'line-height-widget-title' );
	$widget_title_text_transform = astra_get_option( 'text-transform-widget-title', $headings_font_transform );

	$widget_content_font_size      = astra_get_option( 'font-size-widget-content' );
	$widget_content_font_family    = astra_get_option( 'font-family-widget-content' );
	$widget_content_font_weight    = astra_get_option( 'font-weight-widget-content' );
	$widget_content_line_height    = astra_get_option( 'line-height-widget-content' );
	$widget_content_text_transform = astra_get_option( 'text-transform-widget-content' );

	$footer_content_font_size      = astra_get_option( 'font-size-footer-content' );
	$footer_content_font_family    = astra_get_option( 'font-family-footer-content' );
	$footer_content_font_weight    = astra_get_option( 'font-weight-footer-content' );
	$footer_content_line_height    = astra_get_option( 'line-height-footer-content' );
	$footer_content_text_transform = astra_get_option( 'text-transform-footer-content' );

	$h1_font_family    = astra_get_option( 'font-family-h1' );
	$h1_font_weight    = astra_get_option( 'font-weight-h1' );
	$h1_line_height    = astra_get_option( 'line-height-h1' );
	$h1_text_transform = astra_get_option( 'text-transform-h1' );

	$h2_font_family    = astra_get_option( 'font-family-h2' );
	$h2_font_weight    = astra_get_option( 'font-weight-h2' );
	$h2_line_height    = astra_get_option( 'line-height-h2' );
	$h2_text_transform = astra_get_option( 'text-transform-h2' );

	$h3_font_family    = astra_get_option( 'font-family-h3' );
	$h3_font_weight    = astra_get_option( 'font-weight-h3' );
	$h3_line_height    = astra_get_option( 'line-height-h3' );
	$h3_text_transform = astra_get_option( 'text-transform-h3' );

	$h4_font_family    = astra_get_option( 'font-family-h4' );
	$h4_font_weight    = astra_get_option( 'font-weight-h4' );
	$h4_line_height    = astra_get_option( 'line-height-h4' );
	$h4_text_transform = astra_get_option( 'text-transform-h4' );

	$h5_font_family    = astra_get_option( 'font-family-h5' );
	$h5_font_weight    = astra_get_option( 'font-weight-h5' );
	$h5_line_height    = astra_get_option( 'line-height-h5' );
	$h5_text_transform = astra_get_option( 'text-transform-h5' );

	$h6_font_family    = astra_get_option( 'font-family-h6' );
	$h6_font_weight    = astra_get_option( 'font-weight-h6' );
	$h6_line_height    = astra_get_option( 'line-height-h6' );
	$h6_text_transform = astra_get_option( 'text-transform-h6' );

	$button_font_size      = astra_get_option( 'font-size-button' );
	$button_font_family    = astra_get_option( 'font-family-button' );
	$button_font_weight    = astra_get_option( 'font-weight-button' );
	$button_line_height    = astra_get_option( 'line-height-button' );
	$button_text_transform = astra_get_option( 'text-transform-button' );

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

	// Fallback for Single Post Title - headings typography.
	if ( 'inherit' == $single_entry_title_font_family ) {
		$single_entry_title_font_family = $headings_font_family;
	}
	if ( $font_weight_prop === $single_entry_title_font_weight ) {
		$single_entry_title_font_weight = $headings_font_weight;
	}

	// Fallback for Archive Summary Box Page Title - headings typography.
	if ( 'inherit' == $archive_summary_title_font_family ) {
		$archive_summary_title_font_family = $headings_font_family;
	}
	if ( $font_weight_prop === $archive_summary_title_font_weight ) {
		$archive_summary_title_font_weight = $headings_font_weight;
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

	// Fallback for H1 - headings typography.
	if ( 'inherit' == $h1_font_family ) {
		$h1_font_family = $headings_font_family;
	}
	if ( $font_weight_prop === $h1_font_weight ) {
		$h1_font_weight = $headings_font_weight;
	}
	if ( '' == $h1_text_transform ) {
		$h1_text_transform = $headings_font_transform;
	}

	// Fallback for H2 - headings typography.
	if ( 'inherit' == $h2_font_family ) {
			$h2_font_family = $headings_font_family;
	}
	if ( $font_weight_prop === $h2_font_weight ) {
		$h2_font_weight = $headings_font_weight;
	}
	if ( '' == $h2_text_transform ) {
		$h2_text_transform = $headings_font_transform;
	}

	// Fallback for H3 - headings typography.
	if ( 'inherit' == $h3_font_family ) {
			$h3_font_family = $headings_font_family;
	}
	if ( $font_weight_prop === $h3_font_weight ) {
		$h3_font_weight = $headings_font_weight;
	}
	if ( '' == $h3_text_transform ) {
		$h3_text_transform = $headings_font_transform;
	}

	// Fallback for H4 - headings typography.
	if ( 'inherit' == $h4_font_family ) {
			$h4_font_family = $headings_font_family;
	}
	if ( $font_weight_prop === $h4_font_weight ) {
		$h4_font_weight = $headings_font_weight;
	}
	if ( '' == $h4_text_transform ) {
		$h4_text_transform = $headings_font_transform;
	}

	// Fallback for H5 - headings typography.
	if ( 'inherit' == $h5_font_family ) {
			$h5_font_family = $headings_font_family;
	}
	if ( $font_weight_prop === $h5_font_weight ) {
		$h5_font_weight = $headings_font_weight;
	}
	if ( '' == $h5_text_transform ) {
		$h5_text_transform = $headings_font_transform;
	}

	// Fallback for H6 - headings typography.
	if ( 'inherit' == $h6_font_family ) {
			$h6_font_family = $headings_font_family;
	}
	if ( $font_weight_prop === $h6_font_weight ) {
		$h6_font_weight = $headings_font_weight;
	}
	if ( '' == $h6_text_transform ) {
		$h6_text_transform = $headings_font_transform;
	}

	/**
	 * Set font sizes
	 */
	$css_output = array(

		/**
		 * Site Title
		 */
		'.site-title, .site-title a'                  => array(
			'font-weight'    => astra_get_css_value( $site_title_font_weight, 'font' ),
			'font-family'    => astra_get_css_value( $site_title_font_family, 'font', $body_font_family ),
			'line-height'    => esc_attr( $site_title_line_height ),
			'text-transform' => esc_attr( $site_title_text_transform ),
		),

		/**
		 * Site Description
		 */
		'.site-header .site-description'              => array(
			'font-weight'    => astra_get_css_value( $site_tagline_font_weight, 'font' ),
			'font-family'    => astra_get_css_value( $site_tagline_font_family, 'font' ),
			'line-height'    => esc_attr( $site_tagline_line_height ),
			'text-transform' => esc_attr( $site_tagline_text_transform ),
		),

		/**
		 * Post Meta
		 */
		'.entry-meta, .read-more'                     => array(
			'font-size'      => astra_responsive_font( $post_meta_font_size, 'desktop' ),
			'font-weight'    => astra_get_css_value( $post_meta_font_weight, 'font' ),
			'font-family'    => astra_get_css_value( $post_meta_font_family, 'font' ),
			'line-height'    => esc_attr( $post_meta_line_height ),
			'text-transform' => esc_attr( $post_meta_text_transform ),
		),

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
		'.secondary .widget-title'                    => array(
			'font-size'      => astra_responsive_font( $widget_title_font_size, 'desktop' ),
			'font-weight'    => astra_get_css_value( $widget_title_font_weight, 'font' ),
			'font-family'    => astra_get_css_value( $widget_title_font_family, 'font', $body_font_family ),
			'line-height'    => esc_attr( $widget_title_line_height ),
			'text-transform' => esc_attr( $widget_title_text_transform ),
		),

		/**
		 * Widget Content
		 */
		'.secondary .widget > *:not(.widget-title)'   => array(
			'font-size'      => astra_responsive_font( $widget_content_font_size, 'desktop' ),
			'font-weight'    => astra_get_css_value( $widget_content_font_weight, 'font' ),
			'font-family'    => astra_get_css_value( $widget_content_font_family, 'font', $body_font_family ),
			'line-height'    => esc_attr( $widget_content_line_height ),
			'text-transform' => esc_attr( $widget_content_text_transform ),
		),

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
		'.ast-single-post .entry-title, .page-title'  => array(
			'font-weight'    => astra_get_css_value( $single_entry_title_font_weight, 'font' ),
			'font-family'    => astra_get_css_value( $single_entry_title_font_family, 'font', $body_font_family ),
			'line-height'    => esc_attr( $single_entry_title_line_height ),
			'text-transform' => esc_attr( $single_entry_title_text_transform ),
		),

		/**
		 * Archive Summary Box
		 */
		'.ast-archive-description .ast-archive-title' => array(
			'font-family'    => astra_get_css_value( $archive_summary_title_font_family, 'font', $body_font_family ),
			'font-weight'    => astra_get_css_value( $archive_summary_title_font_weight, 'font' ),
			'line-height'    => esc_attr( $archive_summary_title_line_height ),
			'text-transform' => esc_attr( $archive_summary_title_text_transform ),
		),

		/**
		 * Entry Title
		 */
		'.blog .entry-title, .blog .entry-title a, .archive .entry-title, .archive .entry-title a, .search .entry-title, .search .entry-title a' => array(
			'font-family'    => astra_get_css_value( $archive_page_title_font_family, 'font', $body_font_family ),
			'font-weight'    => astra_get_css_value( $archive_page_title_font_weight, 'font' ),
			'line-height'    => esc_attr( $archive_page_title_line_height ),
			'text-transform' => esc_attr( $archive_page_title_text_transform ),
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

	if ( astra_addon_has_gcp_typo_preset_compatibility() ) {

		$typography_css = array(

			/**
			 * Heading - <h1>
			 */
			astra_addon_typography_conditional_headings_css_selectors(
				'h1, .entry-content h1, .entry-content h1 a',
				'h1, .entry-content h1'
			) => array(
				'font-weight'    => astra_get_css_value( $h1_font_weight, 'font' ),
				'font-family'    => astra_get_css_value( $h1_font_family, 'font' ),
				'line-height'    => esc_attr( $h1_line_height ),
				'text-transform' => esc_attr( $h1_text_transform ),
			),

			/**
			 * Heading - <h2>
			 */
			astra_addon_typography_conditional_headings_css_selectors(
				'h2, .entry-content h2, .entry-content h2 a',
				'h2, .entry-content h2'
			) => array(
				'font-weight'    => astra_get_css_value( $h2_font_weight, 'font' ),
				'font-family'    => astra_get_css_value( $h2_font_family, 'font' ),
				'line-height'    => esc_attr( $h2_line_height ),
				'text-transform' => esc_attr( $h2_text_transform ),
			),

			/**
			 * Heading - <h3>
			 */
			astra_addon_typography_conditional_headings_css_selectors(
				'h3, .entry-content h3, .entry-content h3 a',
				'h3, .entry-content h3'
			) => array(
				'font-weight'    => astra_get_css_value( $h3_font_weight, 'font' ),
				'font-family'    => astra_get_css_value( $h3_font_family, 'font' ),
				'line-height'    => esc_attr( $h3_line_height ),
				'text-transform' => esc_attr( $h3_text_transform ),
			),

			/**
			 * Heading - <h4>
			 */
			astra_addon_typography_conditional_headings_css_selectors(
				'h4, .entry-content h4, .entry-content h4 a',
				'h4, .entry-content h4'
			) => array(
				'font-weight'    => astra_get_css_value( $h4_font_weight, 'font' ),
				'font-family'    => astra_get_css_value( $h4_font_family, 'font' ),
				'line-height'    => esc_attr( $h4_line_height ),
				'text-transform' => esc_attr( $h4_text_transform ),
			),

			/**
			 * Heading - <h5>
			 */
			astra_addon_typography_conditional_headings_css_selectors(
				'h5, .entry-content h5, .entry-content h5 a',
				'h5, .entry-content h5'
			) => array(
				'font-weight'    => astra_get_css_value( $h5_font_weight, 'font' ),
				'font-family'    => astra_get_css_value( $h5_font_family, 'font' ),
				'line-height'    => esc_attr( $h5_line_height ),
				'text-transform' => esc_attr( $h5_text_transform ),
			),

			/**
			 * Heading - <h6>
			 */
			astra_addon_typography_conditional_headings_css_selectors(
				'h6, .entry-content h6, .entry-content h6 a',
				'h6, .entry-content h6'
			) => array(
				'font-weight'    => astra_get_css_value( $h6_font_weight, 'font' ),
				'font-family'    => astra_get_css_value( $h6_font_family, 'font' ),
				'line-height'    => esc_attr( $h6_line_height ),
				'text-transform' => esc_attr( $h6_text_transform ),
			),
		);

		$css_output = array_merge( $css_output, $typography_css );
	}

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

		'.secondary .widget-title'                  => array(
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

		'.secondary .widget-title'                  => array(
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

			$sub_menu_font_family    = astra_get_option( 'header-font-family-' . $_prefix . '-sub-menu' );
			$sub_menu_font_size      = astra_get_option( 'header-font-size-' . $_prefix . '-sub-menu' );
			$sub_menu_font_weight    = astra_get_option( 'header-font-weight-' . $_prefix . '-sub-menu' );
			$sub_menu_text_transform = astra_get_option( 'header-text-transform-' . $_prefix . '-sub-menu' );
			$sub_menu_line_height    = astra_get_option( 'header-line-height-' . $_prefix . '-sub-menu' );

			$sub_menu_font_size_desktop      = ( isset( $sub_menu_font_size['desktop'] ) ) ? $sub_menu_font_size['desktop'] : '';
			$sub_menu_font_size_tablet       = ( isset( $sub_menu_font_size['tablet'] ) ) ? $sub_menu_font_size['tablet'] : '';
			$sub_menu_font_size_mobile       = ( isset( $sub_menu_font_size['mobile'] ) ) ? $sub_menu_font_size['mobile'] : '';
			$sub_menu_font_size_desktop_unit = ( isset( $sub_menu_font_size['desktop-unit'] ) ) ? $sub_menu_font_size['desktop-unit'] : '';
			$sub_menu_font_size_tablet_unit  = ( isset( $sub_menu_font_size['tablet-unit'] ) ) ? $sub_menu_font_size['tablet-unit'] : '';
			$sub_menu_font_size_mobile_unit  = ( isset( $sub_menu_font_size['mobile-unit'] ) ) ? $sub_menu_font_size['mobile-unit'] : '';

			$css_output_desktop = array(

				$selector . ' .sub-menu .menu-link' => array(
					'font-family'    => astra_get_font_family( $sub_menu_font_family ),
					'font-weight'    => esc_attr( $sub_menu_font_weight ),
					'font-size'      => astra_get_font_css_value( $sub_menu_font_size_desktop, $sub_menu_font_size_desktop_unit ),
					'line-height'    => esc_attr( $sub_menu_line_height ),
					'text-transform' => esc_attr( $sub_menu_text_transform ),
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

			if ( 3 > $index ) {

				$mega_menu_heading_font_family    = astra_get_option( 'header-' . $_prefix . '-megamenu-heading-font-family' );
				$mega_menu_heading_font_size      = astra_get_option( 'header-' . $_prefix . '-megamenu-heading-font-size' );
				$mega_menu_heading_font_weight    = astra_get_option( 'header-' . $_prefix . '-megamenu-heading-font-weight' );
				$mega_menu_heading_text_transform = astra_get_option( 'header-' . $_prefix . '-megamenu-heading-text-transform' );

				$mega_menu_heading_font_size_desktop      = ( isset( $mega_menu_heading_font_size['desktop'] ) ) ? $mega_menu_heading_font_size['desktop'] : '';
				$mega_menu_heading_font_size_tablet       = ( isset( $mega_menu_heading_font_size['tablet'] ) ) ? $mega_menu_heading_font_size['tablet'] : '';
				$mega_menu_heading_font_size_mobile       = ( isset( $mega_menu_heading_font_size['mobile'] ) ) ? $mega_menu_heading_font_size['mobile'] : '';
				$mega_menu_heading_font_size_desktop_unit = ( isset( $mega_menu_heading_font_size['desktop-unit'] ) ) ? $mega_menu_heading_font_size['desktop-unit'] : '';
				$mega_menu_heading_font_size_tablet_unit  = ( isset( $mega_menu_heading_font_size['tablet-unit'] ) ) ? $mega_menu_heading_font_size['tablet-unit'] : '';
				$mega_menu_heading_font_size_mobile_unit  = ( isset( $mega_menu_heading_font_size['mobile-unit'] ) ) ? $mega_menu_heading_font_size['mobile-unit'] : '';

				$css_megamenu_output_desktop = array(
					// Mega Menu.
					$selector_desktop . ' .menu-item.menu-item-heading > .menu-link' => array(
						'font-family'    => astra_get_font_family( $mega_menu_heading_font_family ),
						'font-weight'    => esc_attr( $mega_menu_heading_font_weight ),
						'font-size'      => astra_get_font_css_value( $mega_menu_heading_font_size_desktop, $mega_menu_heading_font_size_desktop_unit ),
						'text-transform' => esc_attr( $mega_menu_heading_text_transform ),
					),
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

			$_prefix  = 'html' . $index;
			$section  = 'section-hb-html-';
			$selector = '.site-header-section .ast-builder-layout-element.ast-header-html-' . $index . ' .ast-builder-html-element';

			$section_id = $section . $index;

			$font_family    = astra_get_option( 'font-family-' . $section_id, 'inherit' );
			$font_weight    = astra_get_option( 'font-weight-' . $section_id, 'inherit' );
			$text_transform = astra_get_option( 'text-transform-' . $section_id );
			$line_height    = astra_get_option( 'line-height-' . $section_id );

			/**
			 * Typography CSS.
			 */
			$css_output_desktop = array(

				$selector => array(

					// Typography.
					'font-family'    => astra_get_css_value( $font_family, 'font' ),
					'font-weight'    => astra_get_css_value( $font_weight, 'font' ),
					'line-height'    => esc_attr( $line_height ),
					'text-transform' => esc_attr( $text_transform ),
				),
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

			$title_font_family    = astra_get_option( 'header-widget-' . $index . '-font-family', 'inherit' );
			$title_font_weight    = astra_get_option( 'header-widget-' . $index . '-font-weight', 'inherit' );
			$title_text_transform = astra_get_option( 'header-widget-' . $index . '-text-transform' );
			$title_line_height    = astra_get_option( 'header-widget-' . $index . '-line-height' );
			$title_letter_spacing = astra_get_option( 'header-widget-' . $index . '-letter-spacing' );

			$content_font_family    = astra_get_option( 'header-widget-' . $index . '-content-font-family', 'inherit' );
			$content_font_weight    = astra_get_option( 'header-widget-' . $index . '-content-font-weight', 'inherit' );
			$content_text_transform = astra_get_option( 'header-widget-' . $index . '-content-transform' );
			$content_line_height    = astra_get_option( 'header-widget-' . $index . '-content-line-height' );
			$content_letter_spacing = astra_get_option( 'header-widget-' . $index . '-content-letter-spacing' );

			/**
			 * Typography CSS.
			 */
			$css_output_desktop = array(

				$selector . ' .widget-title' => array(
					// Typography.
					'font-family'    => astra_get_css_value( $title_font_family, 'font' ),
					'font-weight'    => astra_get_css_value( $title_font_weight, 'font' ),
					'line-height'    => esc_attr( $title_line_height ),
					'text-transform' => esc_attr( $title_text_transform ),
					'letter-spacing' => astra_get_css_value( $title_letter_spacing, 'px' ),
				),
			);

			if ( Astra_Addon_Builder_Helper::apply_flex_based_css() ) {
				$header_widget_selector = $selector . '.header-widget-area-inner';
			} else {
				$header_widget_selector = $selector . ' .header-widget-area-inner';
			}

			$css_output_desktop[ $header_widget_selector ] = array(
				// Typography.
				'font-family'    => astra_get_css_value( $content_font_family, 'font' ),
				'font-weight'    => astra_get_css_value( $content_font_weight, 'font' ),
				'line-height'    => esc_attr( $content_line_height ),
				'text-transform' => esc_attr( $content_text_transform ),
				'letter-spacing' => astra_get_css_value( $content_letter_spacing, 'px' ),
			);

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

			$title_font_family    = astra_get_option( 'footer-widget-' . $index . '-font-family', 'inherit' );
			$title_font_weight    = astra_get_option( 'footer-widget-' . $index . '-font-weight', 'inherit' );
			$title_text_transform = astra_get_option( 'footer-widget-' . $index . '-text-transform' );
			$title_line_height    = astra_get_option( 'footer-widget-' . $index . '-line-height' );
			$title_letter_spacing = astra_get_option( 'footer-widget-' . $index . '-letter-spacing' );

			$content_font_family    = astra_get_option( 'footer-widget-' . $index . '-content-font-family', 'inherit' );
			$content_font_weight    = astra_get_option( 'footer-widget-' . $index . '-content-font-weight', 'inherit' );
			$content_text_transform = astra_get_option( 'footer-widget-' . $index . '-content-transform' );
			$content_line_height    = astra_get_option( 'footer-widget-' . $index . '-content-line-height' );
			$content_letter_spacing = astra_get_option( 'footer-widget-' . $index . '-content-letter-spacing' );

			/**
			 * Typography CSS.
			 */
			$css_output_desktop = array(

				$selector . ' .widget-title' => array(
					// Typography.
					'font-family'    => astra_get_css_value( $title_font_family, 'font' ),
					'font-weight'    => astra_get_css_value( $title_font_weight, 'font' ),
					'line-height'    => esc_attr( $title_line_height ),
					'text-transform' => esc_attr( $title_text_transform ),
					'letter-spacing' => astra_get_css_value( $title_letter_spacing, 'px' ),
				),
			);

			if ( Astra_Addon_Builder_Helper::apply_flex_based_css() ) {
				$footer_widget_selector = $selector . '.footer-widget-area-inner';
			} else {
				$footer_widget_selector = $selector . ' .footer-widget-area-inner';
			}

				$css_output_desktop[ $footer_widget_selector ] = array(
					// Typography.
					'font-family'    => astra_get_css_value( $content_font_family, 'font' ),
					'font-weight'    => astra_get_css_value( $content_font_weight, 'font' ),
					'line-height'    => esc_attr( $content_line_height ),
					'text-transform' => esc_attr( $content_text_transform ),
					'letter-spacing' => astra_get_css_value( $content_letter_spacing, 'px' ),
				);

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

			$font_family    = astra_get_option( 'font-family-' . $section_id, 'inherit' );
			$font_weight    = astra_get_option( 'font-weight-' . $section_id, 'inherit' );
			$text_transform = astra_get_option( 'text-transform-' . $section_id );
			$line_height    = astra_get_option( 'line-height-' . $section_id );

			/**
			 * Typography CSS.
			 */
			$css_output_desktop = array(

				$selector => array(

					// Typography.
					'font-family'    => astra_get_css_value( $font_family, 'font' ),
					'font-weight'    => astra_get_css_value( $font_weight, 'font' ),
					'line-height'    => esc_attr( $line_height ),
					'text-transform' => esc_attr( $text_transform ),
				),
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

			$font_family    = astra_get_option( 'font-family-' . $_section, 'inherit' );
			$font_weight    = astra_get_option( 'font-weight-' . $_section, 'inherit' );
			$text_transform = astra_get_option( 'text-transform-' . $_section );
			$line_height    = astra_get_option( 'line-height-' . $_section );

			/**
			 * Typography CSS.
			 */
			$css_output_desktop = array(

				$selector => array(

					// Typography.
					'font-family'    => astra_get_css_value( $font_family, 'font' ),
					'font-weight'    => astra_get_css_value( $font_weight, 'font' ),
					'line-height'    => esc_attr( $line_height ),
					'text-transform' => esc_attr( $text_transform ),
				),
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

			$font_family    = astra_get_option( 'font-family-' . $_section, 'inherit' );
			$font_weight    = astra_get_option( 'font-weight-' . $_section, 'inherit' );
			$text_transform = astra_get_option( 'text-transform-' . $_section );
			$line_height    = astra_get_option( 'line-height-' . $_section );

			/**
			 * Typography CSS.
			 */
			$css_output_desktop = array(

				$selector => array(

					// Typography.
					'font-family'    => astra_get_css_value( $font_family, 'font' ),
					'font-weight'    => astra_get_css_value( $font_weight, 'font' ),
					'line-height'    => esc_attr( $line_height ),
					'text-transform' => esc_attr( $text_transform ),
				),
			);

			$css_output .= astra_parse_css( $css_output_desktop );
		}

		/**
		 * Footer - Copyright - Typography
		 */

		if ( Astra_Addon_Builder_Helper::is_component_loaded( 'copyright', 'footer' ) ) {
			$selector = '.ast-footer-copyright';
			$_section = 'section-footer-copyright';

			$font_family    = astra_get_option( 'font-family-' . $_section, 'inherit' );
			$font_weight    = astra_get_option( 'font-weight-' . $_section, 'inherit' );
			$text_transform = astra_get_option( 'text-transform-' . $_section );
			$line_height    = astra_get_option( 'line-height-' . $_section );

			/**
			 * Typography CSS.
			 */
			$css_output_desktop = array(

				$selector => array(

					// Typography.
					'font-family'    => astra_get_css_value( $font_family, 'font' ),
					'font-weight'    => astra_get_css_value( $font_weight, 'font' ),
					'line-height'    => esc_attr( $line_height ),
					'text-transform' => esc_attr( $text_transform ),
				),
			);

			$css_output .= astra_parse_css( $css_output_desktop );
		}

		/**
		 * Header - Account - Typography
		 */

		if ( Astra_Addon_Builder_Helper::is_component_loaded( 'account', 'header' ) ) {
			$selector = '.ast-header-account-wrap';
			$_section = 'section-header-account';

			$font_family    = astra_get_option( 'font-family-' . $_section, 'inherit' );
			$font_weight    = astra_get_option( 'font-weight-' . $_section, 'inherit' );
			$text_transform = astra_get_option( 'text-transform-' . $_section );
			$line_height    = astra_get_option( 'line-height-' . $_section );

			$menu_font_family    = astra_get_option( $_section . '-menu-font-family' );
			$menu_font_size      = astra_get_option( $_section . '-menu-font-size' );
			$menu_font_weight    = astra_get_option( $_section . '-menu-font-weight' );
			$menu_text_transform = astra_get_option( $_section . '-menu-text-transform' );
			$menu_line_height    = astra_get_option( $_section . '-menu-line-height' );

			$menu_font_size_desktop      = ( isset( $menu_font_size['desktop'] ) ) ? $menu_font_size['desktop'] : '';
			$menu_font_size_tablet       = ( isset( $menu_font_size['tablet'] ) ) ? $menu_font_size['tablet'] : '';
			$menu_font_size_mobile       = ( isset( $menu_font_size['mobile'] ) ) ? $menu_font_size['mobile'] : '';
			$menu_font_size_desktop_unit = ( isset( $menu_font_size['desktop-unit'] ) ) ? $menu_font_size['desktop-unit'] : '';
			$menu_font_size_tablet_unit  = ( isset( $menu_font_size['tablet-unit'] ) ) ? $menu_font_size['tablet-unit'] : '';
			$menu_font_size_mobile_unit  = ( isset( $menu_font_size['mobile-unit'] ) ) ? $menu_font_size['mobile-unit'] : '';
			$popup_font_size             = astra_get_option( $_section . '-popup-font-size' );
			$popup_button_size           = astra_get_option( $_section . '-popup-button-font-size' );

			/**
			 * Typography CSS.
			 */
			$css_output_desktop = array(

				$selector . '.ast-header-account-text' => array(
					// Typography.
					'font-family'    => astra_get_css_value( $font_family, 'font' ),
					'font-weight'    => astra_get_css_value( $font_weight, 'font' ),
					'line-height'    => esc_attr( $line_height ),
					'text-transform' => esc_attr( $text_transform ),
				),
				$selector . ' .main-header-menu.ast-account-nav-menu .menu-link' => array(
					'font-family'    => astra_get_font_family( $menu_font_family ),
					'font-weight'    => esc_attr( $menu_font_weight ),
					'font-size'      => astra_get_font_css_value( $menu_font_size_desktop, $menu_font_size_desktop_unit ),
					'line-height'    => esc_attr( $menu_line_height ),
					'text-transform' => esc_attr( $menu_text_transform ),
				),
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

			$selector = '#astra-footer-menu';

			$menu_font_family    = astra_get_option( 'footer-menu-font-family' );
			$menu_font_weight    = astra_get_option( 'footer-menu-font-weight' );
			$menu_text_transform = astra_get_option( 'footer-menu-text-transform' );
			$menu_line_height    = astra_get_option( 'footer-menu-line-height' );

			$css_output_desktop = array(
				$selector . ' .menu-item > a' => array(
					'font-family'    => astra_get_font_family( $menu_font_family ),
					'font-weight'    => esc_attr( $menu_font_weight ),
					'line-height'    => esc_attr( $menu_line_height ),
					'text-transform' => esc_attr( $menu_text_transform ),
				),
			);

			$css_output .= astra_parse_css( $css_output_desktop );
		}

		/**
		 * Header - Language Switcher - Typography
		 */
		if ( Astra_Addon_Builder_Helper::is_component_loaded( 'language-switcher', 'header' ) ) {

			$_section = 'section-hb-language-switcher';

			$selector = '.ast-lswitcher-item-header';

			$font_family    = astra_get_option( 'font-family-' . $_section );
			$font_weight    = astra_get_option( 'font-weight-' . $_section, 'inherit' );
			$text_transform = astra_get_option( 'text-transform-' . $_section );
			$line_height    = astra_get_option( 'line-height-' . $_section );
			$font_size      = astra_get_option( 'font-size-' . $_section );

			/**
			 * Typography CSS.
			 */
			$css_output_desktop = array(

				$selector => array(
					// Typography.
					'font-size'      => astra_get_font_css_value( $font_size['desktop'], $font_size['desktop-unit'] ),
					'font-family'    => astra_get_font_family( $font_family ),
					'font-weight'    => astra_get_css_value( $font_weight, 'font' ),
					'line-height'    => esc_attr( $line_height ),
					'text-transform' => esc_attr( $text_transform ),
				),
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
			$_section = 'section-fb-language-switcher';

			$selector = '.ast-lswitcher-item-footer';

			$font_family    = astra_get_option( 'font-family-' . $_section, 'inherit' );
			$font_weight    = astra_get_option( 'font-weight-' . $_section, 'inherit' );
			$text_transform = astra_get_option( 'text-transform-' . $_section );
			$line_height    = astra_get_option( 'line-height-' . $_section );
			$font_size      = astra_get_option( 'font-size-' . $_section );

			/**
			 * Typography CSS.
			 */
			$css_output_desktop = array(

				$selector => array(
					// Typography.
					'font-size'      => astra_get_font_css_value( $font_size['desktop'], $font_size['desktop-unit'] ),
					'font-family'    => astra_get_css_value( $font_family, 'font' ),
					'font-weight'    => astra_get_css_value( $font_weight, 'font' ),
					'line-height'    => esc_attr( $line_height ),
					'text-transform' => esc_attr( $text_transform ),
				),
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

		$font_family    = astra_get_option( 'mobile-header-label-font-family' );
		$font_weight    = astra_get_option( 'mobile-header-label-font-weight' );
		$text_transform = astra_get_option( 'mobile-header-label-text-transform' );
		$line_height    = astra_get_option( 'mobile-header-label-line-height' );

			/**
			 * Typography CSS.
			 */
			$css_output_desktop = array(

				'[data-section="section-header-mobile-trigger"] .ast-button-wrap .mobile-menu-wrap .mobile-menu' => array(

					// Typography.
					'font-family'    => astra_get_css_value( $font_family, 'font' ),
					'font-weight'    => astra_get_css_value( $font_weight, 'font' ),
					'line-height'    => esc_attr( $line_height ),
					'text-transform' => esc_attr( $text_transform ),
				),
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

			$sub_menu_font_family    = astra_get_option( 'header-font-family-mobile-menu-sub-menu' );
			$sub_menu_font_size      = astra_get_option( 'header-font-size-mobile-menu-sub-menu' );
			$sub_menu_font_weight    = astra_get_option( 'header-font-weight-mobile-menu-sub-menu' );
			$sub_menu_text_transform = astra_get_option( 'header-text-transform-mobile-menu-sub-menu' );
			$sub_menu_line_height    = astra_get_option( 'header-line-height-mobile-menu-sub-menu' );

			$sub_menu_font_size_desktop      = ( isset( $sub_menu_font_size['desktop'] ) ) ? $sub_menu_font_size['desktop'] : '';
			$sub_menu_font_size_tablet       = ( isset( $sub_menu_font_size['tablet'] ) ) ? $sub_menu_font_size['tablet'] : '';
			$sub_menu_font_size_mobile       = ( isset( $sub_menu_font_size['mobile'] ) ) ? $sub_menu_font_size['mobile'] : '';
			$sub_menu_font_size_desktop_unit = ( isset( $sub_menu_font_size['desktop-unit'] ) ) ? $sub_menu_font_size['desktop-unit'] : '';
			$sub_menu_font_size_tablet_unit  = ( isset( $sub_menu_font_size['tablet-unit'] ) ) ? $sub_menu_font_size['tablet-unit'] : '';
			$sub_menu_font_size_mobile_unit  = ( isset( $sub_menu_font_size['mobile-unit'] ) ) ? $sub_menu_font_size['mobile-unit'] : '';

			$css_output_common = array(

				$selector . ' .sub-menu .menu-link' => array(
					'font-family'    => astra_get_font_family( $sub_menu_font_family ),
					'font-weight'    => esc_attr( $sub_menu_font_weight ),
					'line-height'    => esc_attr( $sub_menu_line_height ),
					'text-transform' => esc_attr( $sub_menu_text_transform ),
				),
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
 * @access Private.
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
