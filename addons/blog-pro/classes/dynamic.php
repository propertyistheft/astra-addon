<?php
/**
 * Blog Pro - Dynamic CSS
 *
 * @package Astra Addon
 */

add_filter( 'astra_addon_dynamic_css', 'astra_ext_blog_pro_dynamic_css' );

/**
 * Dynamic CSS
 *
 * @param  string $dynamic_css          Astra Dynamic CSS.
 * @param  string $dynamic_css_filtered Astra Dynamic CSS Filters.
 * @return string
 */
function astra_ext_blog_pro_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' ) {

	$parse_css         = '';
	$css_output_tablet = '';
	$css_output_mobile = '';

	$is_site_rtl = is_rtl();
	$ltr_left    = $is_site_rtl ? 'right' : 'left';
	$ltr_right   = $is_site_rtl ? 'left' : 'right';

	$body_font_family = astra_body_font_family();
	$link_color       = astra_get_option( 'link-color' );
	$text_color       = astra_get_option( 'text-color' );

	$blog_layout           = astra_get_option( 'blog-layout' );
	$blog_pagination       = astra_get_option( 'blog-pagination' );
	$blog_pagination_style = astra_get_option( 'blog-pagination-style' );

	// Social sharing.
	$is_social_sharing_enabled = astra_get_option( 'single-post-social-sharing-icon-enable' );

	$css_output = array(
		// Blog Layout 1 Dynamic Style.
		'.ast-article-post .ast-date-meta .posted-on, .ast-article-post .ast-date-meta .posted-on *' => array(
			'background' => esc_attr( $link_color ),
			'color'      => astra_get_foreground_color( $link_color ),
		),
		'.ast-article-post .ast-date-meta .posted-on .date-month, .ast-article-post .ast-date-meta .posted-on .date-year' => array(
			'color' => astra_get_foreground_color( $link_color ),
		),
		'.ast-load-more:hover' => array(
			'color'            => astra_get_foreground_color( $link_color ),
			'border-color'     => esc_attr( $link_color ),
			'background-color' => esc_attr( $link_color ),
		),
		'.ast-loader > div'    => array(
			'background-color' => esc_attr( $link_color ),
		),
	);

	if ( true === astra_get_option( 'customizer-default-layout-update', true ) ) {
		$css_output['.ast-page-builder-template .ast-archive-description'] = array(
			'margin-bottom' => '2em',
		);
	}

	if ( 'number' === $blog_pagination ) {

		if ( 'circle' === $blog_pagination_style || 'square' === $blog_pagination_style ) {

			$css_output['.ast-pagination .page-numbers'] = array(
				'color'        => $text_color,
				'border-color' => $link_color,
			);

			$css_output['.ast-pagination .page-numbers.current, .ast-pagination .page-numbers:focus, .ast-pagination .page-numbers:hover'] = array(
				'color'            => astra_get_foreground_color( $link_color ),
				'background-color' => $link_color,
				'border-color'     => $link_color,
			);
		}
	}

	if ( $is_social_sharing_enabled ) {

		$selector = '.ast-post-social-sharing';

		$alignment             = astra_get_option( 'single-post-social-sharing-alignment' );
		$icon_sharing_position = astra_get_option( 'single-post-social-sharing-icon-position' );
		$margin                = astra_get_option( 'single-post-social-sharing-margin' );
		$padding               = astra_get_option( 'single-post-social-sharing-padding' );
		$border_radius         = astra_get_option( 'single-post-social-sharing-border-radius' );
		$icon_spacing          = astra_get_option( 'single-post-social-sharing-icon-spacing' );
		$icon_size             = astra_get_option( 'single-post-social-sharing-icon-size' );
		$icon_bg_spacing       = astra_get_option( 'single-post-social-sharing-icon-background-spacing' );
		$icon_radius           = astra_get_option( 'single-post-social-sharing-icon-radius' );

		$icon_spacing_desktop = ( isset( $icon_spacing['desktop'] ) && '' !== $icon_spacing['desktop'] ) ? (int) $icon_spacing['desktop'] / 2 : '';
		$icon_spacing_tablet  = ( isset( $icon_spacing['tablet'] ) && '' !== $icon_spacing['tablet'] ) ? (int) $icon_spacing['tablet'] / 2 : '';
		$icon_spacing_mobile  = ( isset( $icon_spacing['mobile'] ) && '' !== $icon_spacing['mobile'] ) ? (int) $icon_spacing['mobile'] / 2 : '';

		$icon_size_desktop = ( isset( $icon_size['desktop'] ) && '' !== $icon_size['desktop'] ) ? (int) $icon_size['desktop'] : '';
		$icon_size_tablet  = ( isset( $icon_size['tablet'] ) && '' !== $icon_size['tablet'] ) ? (int) $icon_size['tablet'] : '';
		$icon_size_mobile  = ( isset( $icon_size['mobile'] ) && '' !== $icon_size['mobile'] ) ? (int) $icon_size['mobile'] : '';

		$icon_bg_spacing_desktop = ( isset( $icon_bg_spacing['desktop'] ) && '' !== $icon_bg_spacing['desktop'] ) ? (int) $icon_bg_spacing['desktop'] : '';
		$icon_bg_spacing_tablet  = ( isset( $icon_bg_spacing['tablet'] ) && '' !== $icon_bg_spacing['tablet'] ) ? (int) $icon_bg_spacing['tablet'] : '';
		$icon_bg_spacing_mobile  = ( isset( $icon_bg_spacing['mobile'] ) && '' !== $icon_bg_spacing['mobile'] ) ? (int) $icon_bg_spacing['mobile'] : '';

		$icon_radius_desktop = ( isset( $icon_radius['desktop'] ) && '' !== $icon_radius['desktop'] ) ? (int) $icon_radius['desktop'] : '';
		$icon_radius_tablet  = ( isset( $icon_radius['tablet'] ) && '' !== $icon_radius['tablet'] ) ? (int) $icon_radius['tablet'] : '';
		$icon_radius_mobile  = ( isset( $icon_radius['mobile'] ) && '' !== $icon_radius['mobile'] ) ? (int) $icon_radius['mobile'] : '';

		// Normal Responsive Colors.
		$color_type                 = astra_get_option( 'single-post-social-sharing-icon-color-type' );
		$social_icons_color_desktop = astra_get_prop( astra_get_option( 'single-post-social-sharing-icon-color' ), 'desktop' );
		$social_icons_color_tablet  = astra_get_prop( astra_get_option( 'single-post-social-sharing-icon-color' ), 'tablet' );
		$social_icons_color_mobile  = astra_get_prop( astra_get_option( 'single-post-social-sharing-icon-color' ), 'mobile' );

		// Hover Responsive Colors.
		$social_icons_h_color_desktop = astra_get_prop( astra_get_option( 'single-post-social-sharing-icon-h-color' ), 'desktop' );
		$social_icons_h_color_tablet  = astra_get_prop( astra_get_option( 'single-post-social-sharing-icon-h-color' ), 'tablet' );
		$social_icons_h_color_mobile  = astra_get_prop( astra_get_option( 'single-post-social-sharing-icon-h-color' ), 'mobile' );

		// Normal Responsive Bg Colors.
		$social_icons_bg_color_desktop = astra_get_prop( astra_get_option( 'single-post-social-sharing-icon-background-color' ), 'desktop' );
		$social_icons_bg_color_tablet  = astra_get_prop( astra_get_option( 'single-post-social-sharing-icon-background-color' ), 'tablet' );
		$social_icons_bg_color_mobile  = astra_get_prop( astra_get_option( 'single-post-social-sharing-icon-background-color' ), 'mobile' );

		// Hover Responsive Bg Colors.
		$social_icons_h_bg_color_desktop = astra_get_prop( astra_get_option( 'single-post-social-sharing-icon-background-h-color' ), 'desktop' );
		$social_icons_h_bg_color_tablet  = astra_get_prop( astra_get_option( 'single-post-social-sharing-icon-background-h-color' ), 'tablet' );
		$social_icons_h_bg_color_mobile  = astra_get_prop( astra_get_option( 'single-post-social-sharing-icon-background-h-color' ), 'mobile' );

		// Normal Responsive Label Colors.
		$social_icons_label_color_desktop = astra_get_prop( astra_get_option( 'single-post-social-sharing-icon-label-color' ), 'desktop' );
		$social_icons_label_color_tablet  = astra_get_prop( astra_get_option( 'single-post-social-sharing-icon-label-color' ), 'tablet' );
		$social_icons_label_color_mobile  = astra_get_prop( astra_get_option( 'single-post-social-sharing-icon-label-color' ), 'mobile' );

		// Hover Responsive Label Colors.
		$social_icons_label_h_color_desktop = astra_get_prop( astra_get_option( 'single-post-social-sharing-icon-label-h-color' ), 'desktop' );
		$social_icons_label_h_color_tablet  = astra_get_prop( astra_get_option( 'single-post-social-sharing-icon-label-h-color' ), 'tablet' );
		$social_icons_label_h_color_mobile  = astra_get_prop( astra_get_option( 'single-post-social-sharing-icon-label-h-color' ), 'mobile' );

		// Normal Responsive Header Colors.
		$social_heading_color_desktop = astra_get_prop( astra_get_option( 'single-post-social-sharing-heading-color' ), 'desktop' );
		$social_heading_color_tablet  = astra_get_prop( astra_get_option( 'single-post-social-sharing-heading-color' ), 'tablet' );
		$social_heading_color_mobile  = astra_get_prop( astra_get_option( 'single-post-social-sharing-heading-color' ), 'mobile' );

		// Hover Responsive Header Colors.
		$social_heading_h_color_desktop = astra_get_prop( astra_get_option( 'single-post-social-sharing-heading-h-color' ), 'desktop' );
		$social_heading_h_color_tablet  = astra_get_prop( astra_get_option( 'single-post-social-sharing-heading-h-color' ), 'tablet' );
		$social_heading_h_color_mobile  = astra_get_prop( astra_get_option( 'single-post-social-sharing-heading-h-color' ), 'mobile' );

		$social_heading_position = astra_get_option( 'single-post-social-sharing-heading-position' );

		// Background color.
		$social_bg_color_desktop = astra_get_prop( astra_get_option( 'single-post-social-sharing-background-color' ), 'desktop' );
		$social_bg_color_tablet  = astra_get_prop( astra_get_option( 'single-post-social-sharing-background-color' ), 'tablet' );
		$social_bg_color_mobile  = astra_get_prop( astra_get_option( 'single-post-social-sharing-background-color' ), 'mobile' );

		// Label font.
		$icon_label_font_size       = astra_get_option( 'single-post-social-sharing-icon-label-font-size' );
		$icon_label_font_family     = astra_get_option( 'single-post-social-sharing-icon-label-font-family' );
		$icon_label_font_weight     = astra_get_option( 'single-post-social-sharing-icon-label-font-weight' );
		$icon_label_line_height     = astra_addon_get_font_extras( astra_get_option( 'single-post-social-sharing-icon-label-font-extras' ), 'line-height', 'line-height-unit' );
		$icon_label_text_transform  = astra_addon_get_font_extras( astra_get_option( 'single-post-social-sharing-icon-label-font-extras' ), 'text-transform' );
		$icon_label_letter_spacing  = astra_addon_get_font_extras( astra_get_option( 'single-post-social-sharing-icon-label-font-extras' ), 'letter-spacing', 'letter-spacing-unit' );
		$icon_label_text_decoration = astra_addon_get_font_extras( astra_get_option( 'single-post-social-sharing-icon-label-font-extras' ), 'text-decoration' );

		// Heading font.
		$heading_font_size       = astra_get_option( 'single-post-social-sharing-heading-font-size' );
		$heading_font_family     = astra_get_option( 'single-post-social-sharing-heading-font-family' );
		$heading_font_weight     = astra_get_option( 'single-post-social-sharing-heading-font-weight' );
		$heading_line_height     = astra_addon_get_font_extras( astra_get_option( 'single-post-social-sharing-heading-font-extras' ), 'line-height', 'line-height-unit' );
		$heading_text_transform  = astra_addon_get_font_extras( astra_get_option( 'single-post-social-sharing-heading-font-extras' ), 'text-transform' );
		$heading_letter_spacing  = astra_addon_get_font_extras( astra_get_option( 'single-post-social-sharing-heading-font-extras' ), 'letter-spacing', 'letter-spacing-unit' );
		$heading_text_decoration = astra_addon_get_font_extras( astra_get_option( 'single-post-social-sharing-heading-font-extras' ), 'text-decoration' );

		$fixed_social        = array();
		$fixed_social_single = array();

		$is_social_fixed = 'left-content' === $icon_sharing_position || 'right-content' === $icon_sharing_position;

		$margin_rvs_left  = $is_social_fixed ? 'top' : $ltr_left;
		$margin_rvs_right = $is_social_fixed ? 'bottom' : $ltr_right;

		if ( $is_social_fixed ) {

			$fixed_social_sharing_position = 'left-content' === $icon_sharing_position ? $ltr_left : $ltr_right;

			$fixed_social = array(
				'position'                     => 'fixed',
				$fixed_social_sharing_position => '0',
				'top'                          => '50%',
				'transform'                    => 'translateY(-50%)',
				'z-index'                      => '99',
			);
		}

		$fixed_social_single = array(
			'display' => $is_social_fixed ? 'block' : 'inline-block',
		);

		$css_output[ $selector . ' .ast-social-inner-wrap .ast-social-icon-a:first-child' ] = array(
			'margin-' . $margin_rvs_left => '0',
		);

		$css_output[ $selector . ' .ast-social-inner-wrap .ast-social-icon-a:last-child' ] = array(
			'margin-' . $margin_rvs_right => '0',
		);

		$alignment_rtl = $alignment === $ltr_left ? 'flex-start' : 'flex-end';

		$css_output[ $selector ] = array_merge(
			array(
				'display'        => 'flex',
				'flex-wrap'      => 'wrap',
				'flex-direction' => 'column',
				'align-items'    => 'center' === $alignment ? 'center' : $alignment_rtl,
			),
			$fixed_social
		);

		$css_output[ $selector . ' .ast-social-inner-wrap' ] = array(
			'margin-top'                              => astra_responsive_spacing( $margin, 'top', 'desktop' ),
			'margin-bottom'                           => astra_responsive_spacing( $margin, 'bottom', 'desktop' ),
			'margin-' . $ltr_left                     => astra_responsive_spacing( $margin, 'left', 'desktop' ),
			'margin-' . $ltr_right                    => astra_responsive_spacing( $margin, 'right', 'desktop' ),
			'padding-top'                             => astra_responsive_spacing( $padding, 'top', 'desktop' ),
			'padding-bottom'                          => astra_responsive_spacing( $padding, 'bottom', 'desktop' ),
			'padding-' . $ltr_left                    => astra_responsive_spacing( $padding, 'left', 'desktop' ),
			'padding-' . $ltr_right                   => astra_responsive_spacing( $padding, 'right', 'desktop' ),
			'border-top-' . $ltr_left . '-radius'     => astra_responsive_spacing( $border_radius, 'top_left', 'desktop' ),
			'border-top-' . $ltr_right . '-radius'    => astra_responsive_spacing( $border_radius, 'top_right', 'desktop' ),
			'border-bottom-' . $ltr_left . '-radius'  => astra_responsive_spacing( $border_radius, 'bottom_left', 'desktop' ),
			'border-bottom-' . $ltr_right . '-radius' => astra_responsive_spacing( $border_radius, 'bottom_right', 'desktop' ),
			'width'                                   => 'auto',
		);

		$css_output[ $selector . ' a.ast-social-icon-a' ] = array_merge(
			array(
				'justify-content'             => 'center',
				'line-height'                 => 'normal',
				'display'                     => $is_social_fixed ? 'flex' : 'inline-flex',
				'margin-' . $margin_rvs_left  => astra_get_css_value( $icon_spacing_desktop, 'px' ),
				'margin-' . $margin_rvs_right => astra_get_css_value( $icon_spacing_desktop, 'px' ),
				'text-align'                  => 'center',
				'text-decoration'             => 'none',
			),
			$fixed_social_single
		);

		$css_output[ $selector . ' .social-item-label' ] = array(
			// Margin CSS.
			'font-size'       => astra_responsive_font( $icon_label_font_size, 'desktop' ),
			'font-weight'     => astra_get_css_value( $icon_label_font_weight, 'font' ),
			'font-family'     => astra_get_css_value( $icon_label_font_family, 'font' ),
			'line-height'     => esc_attr( $icon_label_line_height ),
			'text-transform'  => esc_attr( $icon_label_text_transform ),
			'text-decoration' => esc_attr( $icon_label_text_decoration ),
			'letter-spacing'  => esc_attr( $icon_label_letter_spacing ),
			'width'           => '100%',
			'text-align'      => 'center',
		);

		$css_output[ $selector . ' .ast-social-sharing-heading' ] = array(
			// Margin CSS.
			'font-size'       => astra_responsive_font( $heading_font_size, 'desktop' ),
			'font-weight'     => astra_get_css_value( $heading_font_weight, 'font' ),
			'font-family'     => astra_get_css_value( $heading_font_family, 'font' ),
			'line-height'     => esc_attr( $heading_line_height ),
			'text-transform'  => esc_attr( $heading_text_transform ),
			'text-decoration' => esc_attr( $heading_text_decoration ),
			'letter-spacing'  => esc_attr( $heading_letter_spacing ),
		);

		$css_output[ $selector . ' .ast-social-element' ] = array(
			// Icon Background Space.
			'padding'       => astra_get_css_value( $icon_bg_spacing_desktop, 'px' ),
			// Icon Radius.
			'border-radius' => astra_get_css_value( $icon_radius_desktop, 'px' ),
		);

		$css_output[ $selector . ' .ast-social-element svg' ] = array(
			// Icon Size.
			'width'  => astra_get_css_value( $icon_size_desktop, 'px' ),
			'height' => astra_get_css_value( $icon_size_desktop, 'px' ),
		);

		$css_output[ $selector . ' .ast-social-icon-image-wrap' ] = array(
			// Icon Background Space.
			'margin' => astra_get_css_value( $icon_bg_spacing_desktop, 'px' ),
		);

		if ( 'custom' === $color_type ) {
			$css_output[ $selector . ' .ast-social-color-type-custom svg' ]['fill']                       = $social_icons_color_desktop;
			$css_output[ $selector . ' .ast-social-color-type-custom .ast-social-element' ]['background'] = $social_icons_bg_color_desktop;

			$css_output[ $selector . ' .ast-social-color-type-custom .ast-social-icon-a:hover .ast-social-element' ] = array(
				// Hover.
				'color'      => $social_icons_h_color_desktop,
				'background' => $social_icons_h_bg_color_desktop,
			);

			$css_output[ $selector . ' .ast-social-color-type-custom .ast-social-icon-a:hover svg' ] = array(
				'fill' => $social_icons_h_color_desktop,
			);

		} else {
			$css_output[ $selector . ' .ast-social-element svg' ]['fill'] = 'var(--color)';
		}

		// Label Color.
		if ( isset( $social_icons_label_color_desktop ) && ! empty( $social_icons_label_color_desktop ) ) {
			$css_output[ $selector . ' .social-item-label' ]['color'] = $social_icons_label_color_desktop;
		}

		// Label Hover Color.
		if ( isset( $social_icons_label_h_color_desktop ) && ! empty( $social_icons_label_h_color_desktop ) ) {
			$css_output[ $selector . ' .ast-social-icon-a:hover .social-item-label' ]['color'] = $social_icons_label_h_color_desktop;
		}

		// Heading Color.
		if ( isset( $social_heading_color_desktop ) && ! empty( $social_heading_color_desktop ) ) {
			$css_output[ $selector . ' .ast-social-sharing-heading' ]['color'] = $social_heading_color_desktop;
		}

		// Heading Hover Color.
		if ( isset( $social_heading_h_color_desktop ) && ! empty( $social_heading_h_color_desktop ) ) {
			$css_output[ $selector . ' .ast-social-sharing-heading:hover' ]['color'] = $social_heading_h_color_desktop;
		}

		if ( isset( $social_bg_color_desktop ) && ! empty( $social_bg_color_desktop ) ) {
			$css_output[ $selector . ' .ast-social-inner-wrap' ]['background-color'] = $social_bg_color_desktop;
		}

		/**
		 * Social_icons CSS tablet.
		 */
		$css_output_tablet = array(
			$selector . ' .ast-social-element svg'     => array(

				// Icon Size.
				'width'  => astra_get_css_value( $icon_size_tablet, 'px' ),
				'height' => astra_get_css_value( $icon_size_tablet, 'px' ),
			),

			$selector . ' .ast-social-inner-wrap .ast-social-icon-a' => array(
				// Icon Spacing.
				'margin-' . $margin_rvs_left  => astra_get_css_value( $icon_spacing_tablet, 'px' ),
				'margin-' . $margin_rvs_right => astra_get_css_value( $icon_spacing_tablet, 'px' ),
			),

			$selector . ' .ast-social-element'         => array(
				// Icon Background Space.
				'padding'       => astra_get_css_value( $icon_bg_spacing_tablet, 'px' ),

				// Icon Radius.
				'border-radius' => astra_get_css_value( $icon_radius_tablet, 'px' ),
			),

			$selector . ' .ast-social-icon-image-wrap' => array(

				// Icon Background Space.
				'margin' => astra_get_css_value( $icon_bg_spacing_tablet, 'px' ),
			),

			$selector . ' .ast-social-inner-wrap'      => array(
				// Margin CSS.
				'margin-top'                              => astra_responsive_spacing( $margin, 'top', 'tablet' ),
				'margin-bottom'                           => astra_responsive_spacing( $margin, 'bottom', 'tablet' ),
				'margin-' . $ltr_left                     => astra_responsive_spacing( $margin, 'left', 'tablet' ),
				'margin-' . $ltr_right                    => astra_responsive_spacing( $margin, 'right', 'tablet' ),
				'padding-top'                             => astra_responsive_spacing( $padding, 'top', 'tablet' ),
				'padding-bottom'                          => astra_responsive_spacing( $padding, 'bottom', 'tablet' ),
				'padding-' . $ltr_left                    => astra_responsive_spacing( $padding, 'left', 'tablet' ),
				'padding-' . $ltr_right                   => astra_responsive_spacing( $padding, 'right', 'tablet' ),
				'border-top-' . $ltr_left . '-radius'     => astra_responsive_spacing( $border_radius, 'top_left', 'tablet' ),
				'border-top-' . $ltr_right . '-radius'    => astra_responsive_spacing( $border_radius, 'top_right', 'tablet' ),
				'border-bottom-' . $ltr_left . '-radius'  => astra_responsive_spacing( $border_radius, 'bottom_left', 'tablet' ),
				'border-bottom-' . $ltr_right . '-radius' => astra_responsive_spacing( $border_radius, 'bottom_right', 'tablet' ),
			),

			$selector . ' .social-item-label'          => array(
				// Margin CSS.
				'font-size' => astra_responsive_font( $icon_label_font_size, 'tablet' ),
			),

			$selector . ' .ast-social-sharing-heading' => array(
				// Margin CSS.
				'font-size' => astra_responsive_font( $heading_font_size, 'tablet' ),
			),

		);

		if ( 'custom' === $color_type ) {
			$css_output_tablet[ $selector . ' .ast-social-color-type-custom svg' ]['fill'] = $social_icons_color_tablet;

			$css_output_tablet[ $selector . ' .ast-social-color-type-custom .ast-social-element' ]['background'] = $social_icons_bg_color_tablet;

			$css_output_tablet[ $selector . ' .ast-social-color-type-custom .ast-social-icon-a:hover .ast-social-element' ] = array(
				// Hover.
				'color'      => $social_icons_h_color_tablet,
				'background' => $social_icons_h_bg_color_tablet,
			);
			$css_output_tablet[ $selector . ' .ast-social-color-type-custom .ast-social-icon-a:hover svg' ]                 = array(
				'fill' => $social_icons_h_color_tablet,
			);
		}

		// Label Color.
		if ( isset( $social_icons_label_color_tablet ) && ! empty( $social_icons_label_color_tablet ) ) {
			$css_output_tablet[ $selector . ' .social-item-label' ]['color'] = $social_icons_label_color_tablet;
		}

		// Label Hover Color.
		if ( isset( $social_icons_label_h_color_tablet ) && ! empty( $social_icons_label_h_color_tablet ) ) {
			$css_output_tablet[ $selector . ' .ast-social-icon-a:hover .social-item-label' ]['color'] = $social_icons_label_h_color_tablet;
		}

		// Heading Color.
		if ( isset( $social_heading_color_tablet ) && ! empty( $social_heading_color_tablet ) ) {
			$css_output_tablet[ $selector . ' .ast-social-sharing-heading' ]['color'] = $social_heading_color_tablet;
		}

		// Heading Hover Color.
		if ( isset( $social_heading_h_color_tablet ) && ! empty( $social_heading_h_color_tablet ) ) {
			$css_output_tablet[ $selector . ' .ast-social-sharing-heading:hover' ]['color'] = $social_heading_h_color_tablet;
		}

		if ( isset( $social_bg_color_tablet ) && ! empty( $social_bg_color_tablet ) ) {
			$css_output_tablet[ $selector . ' .ast-social-inner-wrap' ]['background-color'] = $social_bg_color_tablet;
		}

		/**
		 * Social_icons mobile.
		 */
		$css_output_mobile = array(
			$selector . ' .ast-social-element svg'     => array(
				// Icon Size.
				'width'  => astra_get_css_value( $icon_size_mobile, 'px' ),
				'height' => astra_get_css_value( $icon_size_mobile, 'px' ),
			),

			$selector . ' .ast-social-inner-wrap .ast-social-icon-a' => array(
				// Icon Spacing.
				'margin-' . $margin_rvs_left  => astra_get_css_value( $icon_spacing_mobile, 'px' ),
				'margin-' . $margin_rvs_right => astra_get_css_value( $icon_spacing_mobile, 'px' ),
			),

			$selector . ' .ast-social-element'         => array(
				// Icon Background Space.
				'padding'       => astra_get_css_value( $icon_bg_spacing_mobile, 'px' ),

				// Icon Radius.
				'border-radius' => astra_get_css_value( $icon_radius_mobile, 'px' ),
			),

			$selector . ' .ast-social-icon-image-wrap' => array(

				// Icon Background Space.
				'margin' => astra_get_css_value( $icon_bg_spacing_mobile, 'px' ),
			),

			$selector . ' .ast-social-inner-wrap'      => array(
				'margin-top'                              => astra_responsive_spacing( $margin, 'top', 'mobile' ),
				'margin-bottom'                           => astra_responsive_spacing( $margin, 'bottom', 'mobile' ),
				'margin-' . $ltr_left                     => astra_responsive_spacing( $margin, 'left', 'mobile' ),
				'margin-' . $ltr_right                    => astra_responsive_spacing( $margin, 'right', 'mobile' ),
				'padding-top'                             => astra_responsive_spacing( $padding, 'top', 'mobile' ),
				'padding-bottom'                          => astra_responsive_spacing( $padding, 'bottom', 'mobile' ),
				'padding-' . $ltr_left                    => astra_responsive_spacing( $padding, 'left', 'mobile' ),
				'padding-' . $ltr_right                   => astra_responsive_spacing( $padding, 'right', 'mobile' ),
				'border-top-' . $ltr_left . '-radius'     => astra_responsive_spacing( $border_radius, 'top_left', 'mobile' ),
				'border-top-' . $ltr_right . '-radius'    => astra_responsive_spacing( $border_radius, 'top_right', 'mobile' ),
				'border-bottom-' . $ltr_left . '-radius'  => astra_responsive_spacing( $border_radius, 'bottom_left', 'mobile' ),
				'border-bottom-' . $ltr_right . '-radius' => astra_responsive_spacing( $border_radius, 'bottom_right', 'mobile' ),
			),

			$selector . ' .social-item-label'          => array(
				// Margin CSS.
				'font-size' => astra_responsive_font( $icon_label_font_size, 'mobile' ),
			),

			$selector . ' .ast-social-sharing-heading' => array(
				// Margin CSS.
				'font-size' => astra_responsive_font( $heading_font_size, 'mobile' ),
			),
		);

		if ( 'custom' === $color_type ) {
			$css_output_mobile[ $selector . ' .ast-social-color-type-custom svg' ]['fill'] = $social_icons_color_mobile;

			$css_output_mobile[ $selector . ' .ast-social-color-type-custom .ast-social-element' ]['background'] = $social_icons_bg_color_mobile;

			$css_output_mobile[ $selector . ' .ast-social-color-type-custom .ast-social-icon-a:hover .ast-social-element' ] = array(
				// Hover.
				'color'      => $social_icons_h_color_mobile,
				'background' => $social_icons_h_bg_color_mobile,
			);
			$css_output_mobile[ $selector . ' .ast-social-color-type-custom .ast-social-icon-a:hover svg' ]                 = array(
				'fill' => $social_icons_h_color_mobile,
			);

		}

		// Label Color.
		if ( isset( $social_icons_label_color_mobile ) && ! empty( $social_icons_label_color_mobile ) ) {
			$css_output_mobile[ $selector . ' .social-item-label' ]['color'] = $social_icons_label_color_mobile;
		}

		// Label Hover Color.
		if ( isset( $social_icons_label_h_color_mobile ) && ! empty( $social_icons_label_h_color_mobile ) ) {
			$css_output_mobile[ $selector . ' .ast-social-icon-a:hover .social-item-label' ]['color'] = $social_icons_label_h_color_mobile;
		}

		// Heading Color.
		if ( isset( $social_heading_color_mobile ) && ! empty( $social_heading_color_mobile ) ) {
			$css_output_mobile[ $selector . ' .ast-social-sharing-heading' ]['color'] = $social_heading_color_mobile;
		}

		// Heading Hover Color.
		if ( isset( $social_heading_h_color_mobile ) && ! empty( $social_heading_h_color_mobile ) ) {
			$css_output_mobile[ $selector . ' .ast-social-sharing-heading:hover' ]['color'] = $social_heading_h_color_mobile;
		}

		if ( isset( $social_bg_color_mobile ) && ! empty( $social_bg_color_mobile ) ) {
			$css_output_mobile[ $selector . ' .ast-social-inner-wrap' ]['background-color'] = $social_bg_color_mobile;
		}

		$social_sharing_static_css = '';

		if ( 'below-post' === $icon_sharing_position ) {
			$social_sharing_static_css .= '
				.ast-post-social-sharing .ast-social-inner-wrap {
					padding-top: 1em;
				}
			';
		}

		if ( 'left-content' === $icon_sharing_position || 'right-content' === $icon_sharing_position ) {
			$social_sharing_static_css .= '
				.ast-post-social-sharing .ast-social-inner-wrap {
					padding: 1em;
				}

				.ast-post-social-sharing .ast-social-sharing-heading {
					margin-left: .5em;
					margin-right: .5em;
				}
			';
		}

		if ( 'above' === $social_heading_position ) {
			$social_sharing_static_css .= '
				.ast-post-social-sharing .ast-social-sharing-heading {
					margin-bottom: .5em;
				}
			';
		}

		if ( 'below' === $social_heading_position ) {
			$social_sharing_static_css .= '
				.ast-post-social-sharing .ast-social-sharing-heading {
					margin-top: .5em;
				}
			';
		}

		$social_sharing_static_css .= '
			.ast-post-social-sharing .ast-social-inner-wrap {
				width: fit-content;
			}

			.ast-post-social-sharing .ast-social-element > .ahfb-svg-iconset {
				display: flex;
			}

			.ast-post-social-sharing .ast-social-element {
				display: inline-block;
			}

			.ast-post-social-sharing .social-item-label {
				display: block;
				color: var(--ast-global-color-3);
			}
		';

		$parse_css .= Astra_Enqueue_Scripts::trim_css( $social_sharing_static_css );
	}

	/* Parse CSS from array() */
	$parse_css .= astra_parse_css( $css_output );

	if ( $css_output_tablet ) {
		$parse_css .= astra_parse_css( $css_output_tablet, '', astra_addon_get_tablet_breakpoint() );
	}
	if ( $css_output_mobile ) {
		$parse_css .= astra_parse_css( $css_output_mobile, '', astra_addon_get_mobile_breakpoint() );
	}

	return $dynamic_css . $parse_css;
}
