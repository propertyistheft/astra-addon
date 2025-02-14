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

	$blog_layout           = astra_addon_get_blog_layout();
	$blog_pagination       = astra_get_option( 'blog-pagination' );
	$blog_pagination_style = astra_get_option( 'blog-pagination-style' );

	// Social sharing.
	$is_social_sharing_enabled = astra_get_option( 'single-post-social-sharing-icon-enable' );

	// Author Box social sharing.
	$author_box_enabled                = astra_get_option( 'ast-author-info' );
	$author_box_social_sharing_enabled = astra_get_option( 'author-box-socials' );

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

	$blog_layout = astra_addon_get_blog_layout();
	if ( astra_get_option( 'blog-date-box' ) && ( 'blog-layout-1' === $blog_layout || 'blog-layout-2' === $blog_layout || 'blog-layout-3' === $blog_layout ) ) {
		$css_output['.ast-blog-featured-section.ast-blog-single-element'] = array(
			'float' => is_rtl() ? 'right' : 'left',
		);
	}

	if ( false === astra_get_option( 'ast-single-post-navigation' ) && 'badge' === astra_get_option( 'single-post-navigation-style' ) ) {
		$css_output['.single .post-navigation a']                        = array(
			'padding'       => '8px 14px',
			'transition'    => 'all 0.2s',
			'font-size'     => '14px',
			'color'         => esc_attr( astra_get_option( 'text-color' ) ),
			'border'        => '1px solid var(--ast-single-post-border, var(--ast-border-color))',
			'border-radius' => '4px',
		);
		$css_output['.ast-separate-container.single .post-navigation a'] = array(
			'background-color' => 'var(--ast-global-color-primary, --ast-global-color-5)',
		);
		$css_output['.single .post-navigation a:hover']                  = array(
			'color'        => esc_attr( astra_get_option( 'theme-color' ) ),
			'border-color' => esc_attr( astra_get_option( 'theme-color' ) ),
		);
	}

	if ( true === astra_get_option( 'customizer-default-layout-update', true ) ) {
		$css_output['.ast-page-builder-template .ast-archive-description'] = array(
			'margin-bottom' => '2em',
		);
	}

	// BBpress forum page width compatibility.
	if ( is_post_type_archive( 'forum' ) && is_bbpress() ) {
		$css_output['.post-type-archive-forum .ast-width-md-4, .post-type-archive-forum .ast-width-md-6, .post-type-archive-forum .ast-width-md-3'] = array(
			'width' => '100%',
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

	if ( $is_social_sharing_enabled || ( $author_box_enabled && $author_box_social_sharing_enabled ) ) {

		$selector                   = '.ast-post-social-sharing'; // Post social sharing selector.
		$selector2                  = '.ast-author-box-sharing'; // Author box social sharing.
		$social_share_icon_backward = Astra_Addon_Update_Filter_Function::astra_addon_hide_social_share_icon_position(); // Backward checking of social share icon position.

		$alignment             = astra_get_option( 'single-post-social-sharing-alignment' );
		$icon_sharing_position = astra_get_option( 'single-post-social-sharing-icon-position' );
		$margin                = astra_get_option( 'single-post-social-sharing-margin' );
		$padding               = astra_get_option( 'single-post-social-sharing-padding' );
		$border_radius         = astra_get_option( 'single-post-social-sharing-border-radius' );
		$icon_spacing          = astra_get_option( 'single-post-social-sharing-icon-spacing' );
		$icon_size             = astra_get_option( 'single-post-social-sharing-icon-size' );
		$icon_bg_spacing       = astra_get_option( 'single-post-social-sharing-icon-background-spacing' );
		$icon_radius           = astra_get_option( 'single-post-social-sharing-icon-radius' );

		$icon_spacing_desktop = isset( $icon_spacing['desktop'] ) && '' !== $icon_spacing['desktop'] ? (int) $icon_spacing['desktop'] / 2 : '';
		$icon_spacing_tablet  = isset( $icon_spacing['tablet'] ) && '' !== $icon_spacing['tablet'] ? (int) $icon_spacing['tablet'] / 2 : '';
		$icon_spacing_mobile  = isset( $icon_spacing['mobile'] ) && '' !== $icon_spacing['mobile'] ? (int) $icon_spacing['mobile'] / 2 : '';

		$icon_size_desktop = isset( $icon_size['desktop'] ) && '' !== $icon_size['desktop'] ? (int) $icon_size['desktop'] : '';
		$icon_size_tablet  = isset( $icon_size['tablet'] ) && '' !== $icon_size['tablet'] ? (int) $icon_size['tablet'] : '';
		$icon_size_mobile  = isset( $icon_size['mobile'] ) && '' !== $icon_size['mobile'] ? (int) $icon_size['mobile'] : '';

		$icon_bg_spacing_desktop = isset( $icon_bg_spacing['desktop'] ) && '' !== $icon_bg_spacing['desktop'] ? (int) $icon_bg_spacing['desktop'] : '';
		$icon_bg_spacing_tablet  = isset( $icon_bg_spacing['tablet'] ) && '' !== $icon_bg_spacing['tablet'] ? (int) $icon_bg_spacing['tablet'] : '';
		$icon_bg_spacing_mobile  = isset( $icon_bg_spacing['mobile'] ) && '' !== $icon_bg_spacing['mobile'] ? (int) $icon_bg_spacing['mobile'] : '';

		$icon_radius_desktop = isset( $icon_radius['desktop'] ) && '' !== $icon_radius['desktop'] ? (int) $icon_radius['desktop'] : '';
		$icon_radius_tablet  = isset( $icon_radius['tablet'] ) && '' !== $icon_radius['tablet'] ? (int) $icon_radius['tablet'] : '';
		$icon_radius_mobile  = isset( $icon_radius['mobile'] ) && '' !== $icon_radius['mobile'] ? (int) $icon_radius['mobile'] : '';

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

		$css_output[ $selector . ' .ast-social-inner-wrap .ast-social-icon-a:first-child, ' . $selector2 . ' .ast-social-inner-wrap .ast-social-icon-a:first-child' ] = array(
			'margin-' . $margin_rvs_left => '0',
		);

		$css_output[ $selector . ' .ast-social-inner-wrap .ast-social-icon-a:last-child, ' . $selector2 . ' .ast-social-inner-wrap .ast-social-icon-a:last-child' ] = array(
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

		// Added this block for hiding responsive devices is present with backward.
		if ( $social_share_icon_backward && in_array( $icon_sharing_position, array( 'left-content', 'right-content' ) ) ) {
			$css_output[ '.ast-header-break-point ' . $selector ] = array(
				'display' => 'none',
			);
		}

		$css_output[ $selector2 ] = array(
			'display'        => 'flex',
			'flex-wrap'      => 'wrap',
			'flex-direction' => 'column',
			'align-items'    => 'center' === $alignment ? 'center' : $alignment_rtl,
		);

		$css_output[ $selector . ' .ast-social-inner-wrap, ' . $selector2 . ' .ast-social-inner-wrap' ] = array(
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

		$css_output[ $selector . ' a.ast-social-icon-a, ' . $selector2 . ' a.ast-social-icon-a' ] = array(
			'justify-content' => 'center',
			'line-height'     => 'normal',
			'display'         => $is_social_fixed ? 'flex' : 'inline-flex',
			'text-align'      => 'center',
			'text-decoration' => 'none',
		);

		$css_output[ $selector . ' a.ast-social-icon-a' ]  = array(
			'display'                     => $is_social_fixed ? 'block' : 'inline-block',
			'margin-' . $margin_rvs_left  => astra_get_css_value( $icon_spacing_desktop, 'px' ),
			'margin-' . $margin_rvs_right => astra_get_css_value( $icon_spacing_desktop, 'px' ),
		);
		$css_output[ $selector2 . ' a.ast-social-icon-a' ] = array(
			'display'              => 'inline-block',
			'margin-' . $ltr_left  => astra_get_css_value( $icon_spacing_desktop, 'px' ),
			'margin-' . $ltr_right => astra_get_css_value( $icon_spacing_desktop, 'px' ),
		);

		$css_output[ $selector . ' .social-item-label, ' . $selector2 . ' .social-item-label' ] = array(
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

		$css_output[ $selector . ' .ast-social-element, ' . $selector2 . ' .ast-social-element' ] = array(
			// Icon Background Space.
			'padding'       => astra_get_css_value( $icon_bg_spacing_desktop, 'px' ),
			// Icon Radius.
			'border-radius' => astra_get_css_value( $icon_radius_desktop, 'px' ),
		);

		$css_output[ $selector . ' .ast-social-element svg, ' . $selector2 . ' .ast-social-element svg' ] = array(
			// Icon Size.
			'width'  => astra_get_css_value( $icon_size_desktop, 'px' ),
			'height' => astra_get_css_value( $icon_size_desktop, 'px' ),
		);

		$css_output[ $selector . ' .ast-social-icon-image-wrap, ' . $selector2 . ' .ast-social-icon-image-wrap' ] = array(
			// Icon Background Space.
			'margin' => astra_get_css_value( $icon_bg_spacing_desktop, 'px' ),
		);

		if ( 'custom' === $color_type ) {
			$css_output[ $selector . ' .ast-social-color-type-custom svg, ' . $selector2 . ' .ast-social-color-type-custom svg' ]['fill']                                       = $social_icons_color_desktop;
			$css_output[ $selector . ' .ast-social-color-type-custom .ast-social-element, ' . $selector2 . ' .ast-social-color-type-custom .ast-social-element' ]['background'] = $social_icons_bg_color_desktop;

			$css_output[ $selector . ' .ast-social-color-type-custom .ast-social-icon-a:hover .ast-social-element, ' . $selector2 . ' .ast-social-color-type-custom .ast-social-icon-a:hover .ast-social-element' ] = array(
				// Hover.
				'color'      => $social_icons_h_color_desktop,
				'background' => $social_icons_h_bg_color_desktop,
			);

			$css_output[ $selector . ' .ast-social-color-type-custom .ast-social-icon-a:hover svg, ' . $selector2 . ' .ast-social-color-type-custom .ast-social-icon-a:hover svg' ] = array(
				'fill' => $social_icons_h_color_desktop,
			);

		} else {
			$css_output[ $selector . ' .ast-social-element svg, ' . $selector2 . ' .ast-social-element svg' ]['fill'] = 'var(--color)';
		}

		// Label Color.
		if ( isset( $social_icons_label_color_desktop ) && ! empty( $social_icons_label_color_desktop ) ) {
			$css_output[ $selector . ' .social-item-label, ' . $selector2 . ' .social-item-label' ]['color'] = $social_icons_label_color_desktop;
		}

		// Label Hover Color.
		if ( isset( $social_icons_label_h_color_desktop ) && ! empty( $social_icons_label_h_color_desktop ) ) {
			$css_output[ $selector . ' .ast-social-icon-a:hover .social-item-label, ' . $selector2 . ' .ast-social-icon-a:hover .social-item-label' ]['color'] = $social_icons_label_h_color_desktop;
		}

		// Heading Color.
		if ( isset( $social_heading_color_desktop ) && ! empty( $social_heading_color_desktop ) ) {
			$css_output[ $selector . ' .ast-social-sharing-heading, ' . $selector2 . ' .ast-social-sharing-heading' ]['color'] = $social_heading_color_desktop;
		}

		// Heading Hover Color.
		if ( isset( $social_heading_h_color_desktop ) && ! empty( $social_heading_h_color_desktop ) ) {
			$css_output[ $selector . ' .ast-social-sharing-heading:hover, ' . $selector2 . ' .ast-social-sharing-heading:hover' ]['color'] = $social_heading_h_color_desktop;
		}

		if ( isset( $social_bg_color_desktop ) && ! empty( $social_bg_color_desktop ) ) {
			$css_output[ $selector . ' .ast-social-inner-wrap, ' . $selector2 . ' .ast-social-inner-wrap' ]['background-color'] = $social_bg_color_desktop;
		}

		/**
		 * Social_icons CSS tablet.
		 */
		$css_output_tablet = array(
			$selector . ' .ast-social-element svg, ' . $selector2 . ' .ast-social-element svg' => array(

				// Icon Size.
				'width'  => astra_get_css_value( $icon_size_tablet, 'px' ),
				'height' => astra_get_css_value( $icon_size_tablet, 'px' ),
			),

			$selector . ' .ast-social-inner-wrap .ast-social-icon-a, ' . $selector2 . ' .ast-social-inner-wrap .ast-social-icon-a' => array(
				// Icon Spacing.
				'margin-' . $margin_rvs_left  => astra_get_css_value( $icon_spacing_tablet, 'px' ),
				'margin-' . $margin_rvs_right => astra_get_css_value( $icon_spacing_tablet, 'px' ),
			),

			$selector . ' .ast-social-element, ' . $selector2 . ' .ast-social-element' => array(
				// Icon Background Space.
				'padding'       => astra_get_css_value( $icon_bg_spacing_tablet, 'px' ),

				// Icon Radius.
				'border-radius' => astra_get_css_value( $icon_radius_tablet, 'px' ),
			),

			$selector . ' .ast-social-icon-image-wrap, ' . $selector2 . ' .ast-social-icon-image-wrap' => array(

				// Icon Background Space.
				'margin' => astra_get_css_value( $icon_bg_spacing_tablet, 'px' ),
			),

			$selector . ' .ast-social-inner-wrap, ' . $selector2 . ' .ast-social-inner-wrap' => array(
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
			$css_output_tablet[ $selector . ' .ast-social-color-type-custom svg, ' . $selector2 . ' .ast-social-color-type-custom svg' ]['fill'] = $social_icons_color_tablet;

			$css_output_tablet[ $selector . ' .ast-social-color-type-custom .ast-social-element, ' . $selector2 . ' .ast-social-color-type-custom .ast-social-element' ]['background'] = $social_icons_bg_color_tablet;

			$css_output_tablet[ $selector . ' .ast-social-color-type-custom .ast-social-icon-a:hover .ast-social-element, ' . $selector2 . ' .ast-social-color-type-custom .ast-social-icon-a:hover .ast-social-element' ] = array(
				// Hover.
				'color'      => $social_icons_h_color_tablet,
				'background' => $social_icons_h_bg_color_tablet,
			);
			$css_output_tablet[ $selector . ' .ast-social-color-type-custom .ast-social-icon-a:hover svg, ' . $selector2 . ' .ast-social-color-type-custom .ast-social-icon-a:hover svg' ]                                 = array(
				'fill' => $social_icons_h_color_tablet,
			);
		}

		// Label Color.
		if ( isset( $social_icons_label_color_tablet ) && ! empty( $social_icons_label_color_tablet ) ) {
			$css_output_tablet[ $selector . ' .social-item-label, ' . $selector . ' .social-item-label' ]['color'] = $social_icons_label_color_tablet;
		}

		// Label Hover Color.
		if ( isset( $social_icons_label_h_color_tablet ) && ! empty( $social_icons_label_h_color_tablet ) ) {
			$css_output_tablet[ $selector . ' .ast-social-icon-a:hover .social-item-label, ' . $selector2 . ' .ast-social-icon-a:hover .social-item-label' ]['color'] = $social_icons_label_h_color_tablet;
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
			$css_output_tablet[ $selector . ' .ast-social-inner-wrap, ' . $selector2 . ' .ast-social-inner-wrap' ]['background-color'] = $social_bg_color_tablet;
		}

		/**
		 * Social_icons mobile.
		 */
		$css_output_mobile = array(
			$selector . ' .ast-social-element svg, ' . $selector2 . ' .ast-social-element svg' => array(
				// Icon Size.
				'width'  => astra_get_css_value( $icon_size_mobile, 'px' ),
				'height' => astra_get_css_value( $icon_size_mobile, 'px' ),
			),

			$selector . ' .ast-social-inner-wrap .ast-social-icon-a, ' . $selector2 . ' .ast-social-inner-wrap .ast-social-icon-a' => array(
				// Icon Spacing.
				'margin-' . $margin_rvs_left  => astra_get_css_value( $icon_spacing_mobile, 'px' ),
				'margin-' . $margin_rvs_right => astra_get_css_value( $icon_spacing_mobile, 'px' ),
			),

			$selector . ' .ast-social-element, ' . $selector2 . ' .ast-social-element' => array(
				// Icon Background Space.
				'padding'       => astra_get_css_value( $icon_bg_spacing_mobile, 'px' ),

				// Icon Radius.
				'border-radius' => astra_get_css_value( $icon_radius_mobile, 'px' ),
			),

			$selector . ' .ast-social-icon-image-wrap, ' . $selector2 . ' .ast-social-icon-image-wrap' => array(

				// Icon Background Space.
				'margin' => astra_get_css_value( $icon_bg_spacing_mobile, 'px' ),
			),

			$selector . ' .ast-social-inner-wrap, ' . $selector2 . ' .ast-social-inner-wrap' => array(
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
			$css_output_mobile[ $selector . ' .ast-social-color-type-custom svg, ' . $selector2 . ' .ast-social-color-type-custom svg' ]['fill'] = $social_icons_color_mobile;

			$css_output_mobile[ $selector . ' .ast-social-color-type-custom .ast-social-element, ' . $selector2 . ' .ast-social-color-type-custom .ast-social-element' ]['background'] = $social_icons_bg_color_mobile;

			$css_output_mobile[ $selector . ' .ast-social-color-type-custom .ast-social-icon-a:hover .ast-social-element, ' . $selector2 . ' .ast-social-color-type-custom .ast-social-icon-a:hover .ast-social-element' ] = array(
				// Hover.
				'color'      => $social_icons_h_color_mobile,
				'background' => $social_icons_h_bg_color_mobile,
			);
			$css_output_mobile[ $selector . ' .ast-social-color-type-custom .ast-social-icon-a:hover svg, ' . $selector2 . ' .ast-social-color-type-custom .ast-social-icon-a:hover svg' ]                                 = array(
				'fill' => $social_icons_h_color_mobile,
			);

		}

		// Label Color.
		if ( isset( $social_icons_label_color_mobile ) && ! empty( $social_icons_label_color_mobile ) ) {
			$css_output_mobile[ $selector . ' .social-item-label, ' . $selector2 . ' .social-item-label' ]['color'] = $social_icons_label_color_mobile;
		}

		// Label Hover Color.
		if ( isset( $social_icons_label_h_color_mobile ) && ! empty( $social_icons_label_h_color_mobile ) ) {
			$css_output_mobile[ $selector . ' .ast-social-icon-a:hover .social-item-label, ' . $selector2 . ' .ast-social-icon-a:hover .social-item-label' ]['color'] = $social_icons_label_h_color_mobile;
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
			.ast-post-social-sharing .ast-social-inner-wrap, .ast-author-box-sharing .ast-social-inner-wrap {
				width: fit-content;
			}

			.ast-post-social-sharing .ast-social-element > .ahfb-svg-iconset, .ast-author-box-sharing .ast-social-element > .ahfb-svg-iconset {
				display: flex;
			}

			.ast-post-social-sharing .ast-social-element, .ast-author-box-sharing .ast-social-element {
				display: inline-block;
				vertical-align: middle;
			}

			.ast-post-social-sharing .social-item-label {
				display: block;
				color: var(--ast-global-color-3);
			}
		';

		$parse_css .= Astra_Enqueue_Scripts::trim_css( $social_sharing_static_css );
	}

	if ( astra_get_option( 'ast-author-info' ) ) {
		$author_box_bg_obj = astra_get_option( 'author-box-background' );
		$bg_css            = astra_get_background_obj( $author_box_bg_obj );

		$author_box_dynamic_arr = array(
			'.single .ast-single-author-box .ast-author-meta, .single.ast-separate-container .site-main .ast-author-meta'  => astra_get_background_obj( $author_box_bg_obj ),
		);

		$parse_css .= astra_parse_css( $author_box_dynamic_arr );

		if ( is_callable( 'Astra_Extended_Base_Dynamic_CSS::prepare_inner_section_advanced_css' ) ) {
			$parse_css .= Astra_Extended_Base_Dynamic_CSS::prepare_inner_section_advanced_css( 'ast-sub-section-author-box', '.single .ast-single-author-box .ast-author-meta' );
		}

		$author_box_compat_css = '
			.single article .ast-single-author-box, .single.ast-narrow-container article .ast-single-author-box, .single.ast-plain-container article .ast-single-author-box, .single.ast-separate-container article .ast-single-author-box {
				margin-top: 2em;
				border-top: 1px solid var(--ast-single-post-border, var(--ast-border-color));
			}
			.single.ast-separate-container article .ast-author-meta {
				padding: 0;
			}
			.ast-author-details .ast-author-box-sharing {
				align-items: ' . esc_attr( $is_site_rtl ? 'flex-end' : 'flex-start' ) . ';
				margin-top: 20px;
			}
			.ast-single-author-box.ast-author-container--center .ast-author-meta, .single.ast-separate-container article .ast-author-meta {
				padding: 2em;
			}
			.ast-single-author-box.ast-author-container--center .ast-author-meta * {
				text-align: center;
			}
			.ast-single-author-box.ast-author-container--center .ast-author-meta .ast-author-details {
				display: block;
			}
			.ast-single-author-box.ast-author-container--center .post-author-avatar,
			.ast-single-author-box.ast-author-container--center .post-author-bio {
				float: unset;
			}
			.ast-single-author-box.ast-author-container--center .post-author-avatar {
				margin: 0 0 1em;
			}
			.ast-single-author-box.ast-author-container--center .ast-author-details .ast-author-box-sharing {
				align-items: center;
			}
			.ast-author-box-sharing a.ast-social-icon-a:first-child {
				margin-left: 0;
			}
			.ast-author-box-sharing a.ast-social-icon-a:last-child {
				margin-right: 0;
			}
		';

		if ( ! astra_addon_4_6_0_compatibility() ) {
			$author_box_compat_css .= '
				.single.ast-separate-container .ast-single-author-box {
					border-top: 0;
				}
				.single.ast-plain-container .ast-single-author-box, .single.ast-page-builder-template .ast-single-author-box, .single.ast-narrow-container .ast-single-author-box {
					padding-top: 2em;
				}
				.single.ast-plain-container .ast-single-author-box, .single.ast-narrow-container .ast-single-author-box {
					margin-top: 0;
				}
			';
		} else {
			$author_box_compat_css .= '
				@media(max-width: ' . esc_attr( astra_addon_get_tablet_breakpoint( '', 1 ) ) . 'px) {
					.ast-author-details .ast-author-box-sharing {
						align-items: center;
					}
				}
			';
		}

		$parse_css .= Astra_Enqueue_Scripts::trim_css( $author_box_compat_css );
	}

	if ( is_home() || is_archive() || is_search() ) {

		// Blog card.
		$blog_archive_bs_class  = '';
		$blog_archive_card_grid = astra_addon_get_blog_grid_columns( 'desktop' );
		if ( 'blog-layout-4' === $blog_layout || 'blog-layout-6' === $blog_layout ) {
			if ( 1 === $blog_archive_card_grid ) {
				$blog_archive_bs_class = '.ast-blog-layout-4-grid .ast-article-post, .ast-blog-layout-5-grid .ast-article-post, .ast-blog-layout-6-grid .ast-article-post';
			} else {
				$blog_archive_bs_class = '.ast-blog-layout-4-grid .ast-article-inner, .ast-blog-layout-5-grid .ast-article-inner, .ast-blog-layout-6-grid .ast-article-inner';
			}
		}

		if ( 'blog-layout-5' === $blog_layout ) {
			$blog_archive_bs_class = '.ast-blog-layout-4-grid .ast-article-post, .ast-blog-layout-5-grid .ast-article-post, .ast-blog-layout-6-grid .ast-article-post';
		}

		$parse_css .= Astra_Addon_Base_Dynamic_CSS::prepare_box_shadow_dynamic_css( 'blog-item', $blog_archive_bs_class );

		if ( 'blog-layout-4' === $blog_layout || 'blog-layout-6' === $blog_layout ) {
			$blog_archive_first_full_width = astra_get_option( 'first-post-full-width' );
			if ( $blog_archive_first_full_width ) {
				$css_output['.ast-full-width .ast-article-inner']['width'] = '100%';
			}
		}

		// Blog layout 5 row reverse.
		$blog_row_reverse = astra_get_option( 'blog-row-reverse' );
		if ( $blog_row_reverse && 'blog-layout-5' === $blog_layout ) {
			$css_output['.ast-blog-layout-5-grid .ast-article-inner']['flex-direction']          = 'row-reverse';
			$css_output['.ast-blog-layout-5-grid .post-content'][ 'padding-' . $ltr_left . '' ]  = '1.5em';
			$css_output['.ast-blog-layout-5-grid .post-content'][ 'padding-' . $ltr_right . '' ] = '0';
		}
	}

	/* Parse CSS from array() */
	$parse_css .= astra_parse_css( $css_output );

	if ( $css_output_tablet ) {
		$parse_css .= astra_parse_css( $css_output_tablet, '', astra_addon_get_tablet_breakpoint() );
	}
	if ( $css_output_mobile ) {
		$parse_css .= astra_parse_css( $css_output_mobile, '', astra_addon_get_mobile_breakpoint() );
	}
		/**
		 * Blog Filter.
		 */
		$blog_filter_layout     = astra_get_option( 'blog-filter-layout' );
		$blog_filter_class      = '.ast-post-filter';
		$blog_filter_static_css = '';
		$blog_filter            = astra_get_option( 'blog-filter' );
		$blog_filter_target     = 'li.ast-post-filter-single';

		// Blog filter text color.
		$blog_filter_text_normal_color = astra_get_option( 'blog-filter-taxonomy-text-normal-color' );
		$blog_filter_text_hover_color  = astra_get_option( 'blog-filter-taxonomy-text-hover-color' );
		$blog_filter_text_active_color = astra_get_option( 'blog-filter-taxonomy-text-active-color' );

		// Blog filter background color.
		$blog_filter_bg_normal_color = astra_get_option( 'blog-filter-taxonomy-bg-normal-color' );
		$blog_filter_bg_hover_color  = astra_get_option( 'blog-filter-taxonomy-bg-hover-color' );
		$blog_filter_bg_active_color = astra_get_option( 'blog-filter-taxonomy-bg-active-color' );

		// Blog filter inner/outer spacing.
		$blog_filter_inner_spacing        = astra_get_option( 'blog-filter-inside-spacing' );
		$blog_filter_outer_spacing        = astra_get_option( 'blog-filter-outside-spacing' );
		$blog_filter_outer_parent_spacing = astra_get_option( 'blog-filter-outer-parent-spacing' );

		// Blog filter border radius.
		$blog_filter_border_radius = astra_get_option( 'blog-filter-border-radius' );
		$blog_filter_font_size     = astra_get_option( 'font-size-blog-filter-taxonomy' );

		$blog_filter_alignment_setting = astra_get_option( 'blog-filter-alignment' );
		$desktop_blog_filter_alignment = $blog_filter_alignment_setting['desktop'] === $ltr_left ? 'flex-start' : 'flex-end';
		$tablet_blog_filter_alignment  = $blog_filter_alignment_setting['tablet'] === $ltr_left ? 'flex-start' : 'flex-end';
		$mobile_blog_filter_alignment  = $blog_filter_alignment_setting['mobile'] === $ltr_left ? 'flex-start' : 'flex-end';

		$blog_filter_visibility_setting = astra_get_option( 'responsive-blog-filter-visibility' );
		$desktop_blog_filter_visibility = $blog_filter_visibility_setting['desktop'] ? 'block' : 'none';
		$tablet_blog_filter_visibility  = $blog_filter_visibility_setting['tablet'] ? 'block' : 'none';
		$mobile_blog_filter_visibility  = $blog_filter_visibility_setting['mobile'] ? 'block' : 'none';

	if ( $blog_filter ) {
		$blog_filter_static_css .= '
			' . $blog_filter_class . '{
				overflow: hidden;
			}

			' . $blog_filter_class . ' ul{
				list-style: none;
				margin: 0;
				margin-bottom: 3em;
				display: flex;
				flex-wrap: wrap;
			}

			' . $blog_filter_target . '{
				margin: .375em;
				padding: 0.5em 0.63em;
				cursor: pointer;
				font-weight: 400;
				line-height: normal;
				border-radius: 4px;
				border: 0;
			}
		';

		if ( 'blog-filter-layout-1' === $blog_filter_layout ) {
			$blog_filter_static_css .= '
				' . $blog_filter_target . '.active {
					color: var(--ast-global-color-0);
				}
			';
		}

		$parse_css .= Astra_Enqueue_Scripts::trim_css( $blog_filter_static_css );

		$blog_filter_border_radius_desktop = array();
		if ( 'blog-filter-layout-2' === $blog_filter_layout ) {
			$blog_filter_border_radius_desktop = array(
				'border-top-' . $ltr_left . '-radius'     => astra_responsive_spacing( $blog_filter_border_radius, 'top_left', 'desktop' ),
				'border-top-' . $ltr_right . '-radius'    => astra_responsive_spacing( $blog_filter_border_radius, 'top_right', 'desktop' ),
				'border-bottom-' . $ltr_right . '-radius' => astra_responsive_spacing( $blog_filter_border_radius, 'bottom_right', 'desktop' ),
				'border-bottom-' . $ltr_left . '-radius'  => astra_responsive_spacing( $blog_filter_border_radius, 'bottom_left', 'desktop' ),
			);
		}

		$blog_filter_css_output = array(
			$blog_filter_class         => array(
				'display'              => $desktop_blog_filter_visibility,
				'margin-top'           => astra_responsive_spacing( $blog_filter_outer_parent_spacing, 'top', 'desktop' ),
				'margin-' . $ltr_right => astra_responsive_spacing( $blog_filter_outer_parent_spacing, 'right', 'desktop' ),
				'margin-bottom'        => astra_responsive_spacing( $blog_filter_outer_parent_spacing, 'bottom', 'desktop' ),
				'margin-' . $ltr_left  => astra_responsive_spacing( $blog_filter_outer_parent_spacing, 'left', 'desktop' ),
			),
			$blog_filter_class . ' ul' => array(
				'justify-content'      => isset( $blog_filter_alignment_setting['desktop'] ) && 'center' === $blog_filter_alignment_setting['desktop'] ? 'center' : $desktop_blog_filter_alignment,
				'margin-' . $ltr_right => '-' . astra_responsive_spacing( $blog_filter_outer_spacing, 'right', 'desktop' ),
				'margin-' . $ltr_left  => '-' . astra_responsive_spacing( $blog_filter_outer_spacing, 'left', 'desktop' ),
			),
			$blog_filter_target        => array_merge(
				astra_addon_get_font_array_css( astra_get_option( 'font-family-blog-filter-taxonomy' ), astra_get_option( 'font-weight-blog-filter-taxonomy' ), $blog_filter_font_size, 'font-extras-blog-filter-taxonomy', '' ),
				array(
					'padding-top'           => astra_responsive_spacing( $blog_filter_inner_spacing, 'top', 'desktop' ),
					'padding-' . $ltr_right => astra_responsive_spacing( $blog_filter_inner_spacing, 'right', 'desktop' ),
					'padding-bottom'        => astra_responsive_spacing( $blog_filter_inner_spacing, 'bottom', 'desktop' ),
					'padding-' . $ltr_left  => astra_responsive_spacing( $blog_filter_inner_spacing, 'left', 'desktop' ),
					'margin-top'            => astra_responsive_spacing( $blog_filter_outer_spacing, 'top', 'desktop' ),
					'margin-' . $ltr_right  => astra_responsive_spacing( $blog_filter_outer_spacing, 'right', 'desktop' ),
					'margin-bottom'         => astra_responsive_spacing( $blog_filter_outer_spacing, 'bottom', 'desktop' ),
					'margin-' . $ltr_left   => astra_responsive_spacing( $blog_filter_outer_spacing, 'left', 'desktop' ),
				),
				$blog_filter_border_radius_desktop
			),

			'.ast-row'                 => array(
				'transition-property'        => 'opacity;',
				'transition-duration'        => '.5s',
				'transition-timing-function' => 'cubic-bezier(0.2, 1, 0.2, 1)',
			),
		);

		$blog_filter_css_output[ $blog_filter_target . ':not(.active)' ]['color']       = $blog_filter_text_normal_color;
		$blog_filter_css_output[ $blog_filter_target . '.active' ]['color']             = $blog_filter_text_active_color;
		$blog_filter_css_output[ $blog_filter_target . ':not(.active):hover' ]['color'] = $blog_filter_text_hover_color;

		if ( 'blog-filter-layout-2' === $blog_filter_layout ) {
			$blog_filter_css_output[ $blog_filter_target . ':not(.active)' ]['background-color']       = $blog_filter_bg_normal_color;
			$blog_filter_css_output[ $blog_filter_target . '.active' ]['background-color']             = $blog_filter_bg_active_color;
			$blog_filter_css_output[ $blog_filter_target . ':not(.active):hover' ]['background-color'] = $blog_filter_bg_hover_color;
		}

		/* Parse CSS from array() */
		$parse_css .= astra_parse_css( $blog_filter_css_output );

		$blog_filter_border_radius_tablet = array();
		if ( 'blog-filter-layout-2' === $blog_filter_layout ) {
			$blog_filter_border_radius_tablet = array(
				'border-top-' . $ltr_left . '-radius'     => astra_responsive_spacing( $blog_filter_border_radius, 'top_left', 'tablet' ),
				'border-top-' . $ltr_right . '-radius'    => astra_responsive_spacing( $blog_filter_border_radius, 'top_right', 'tablet' ),
				'border-bottom-' . $ltr_right . '-radius' => astra_responsive_spacing( $blog_filter_border_radius, 'bottom_right', 'tablet' ),
				'border-bottom-' . $ltr_left . '-radius'  => astra_responsive_spacing( $blog_filter_border_radius, 'bottom_left', 'tablet' ),
			);
		}

		$blog_filter_css_output_tablet = array(
			$blog_filter_class         => array(
				'display'              => $tablet_blog_filter_visibility,
				'margin-top'           => astra_responsive_spacing( $blog_filter_outer_parent_spacing, 'top', 'tablet' ),
				'margin-' . $ltr_right => astra_responsive_spacing( $blog_filter_outer_parent_spacing, 'right', 'tablet' ),
				'margin-bottom'        => astra_responsive_spacing( $blog_filter_outer_parent_spacing, 'bottom', 'tablet' ),
				'margin-' . $ltr_left  => astra_responsive_spacing( $blog_filter_outer_parent_spacing, 'left', 'tablet' ),
			),
			$blog_filter_class . ' ul' => array(
				'justify-content'      => isset( $blog_filter_alignment_setting['tablet'] ) && 'center' === $blog_filter_alignment_setting['tablet'] ? 'center' : $tablet_blog_filter_alignment,
				'margin-' . $ltr_right => '-' . astra_responsive_spacing( $blog_filter_outer_spacing, 'right', 'tablet' ),
				'margin-' . $ltr_left  => '-' . astra_responsive_spacing( $blog_filter_outer_spacing, 'left', 'tablet' ),
			),
			$blog_filter_target        => array_merge(
				array(
					'font-size'             => astra_responsive_font( $blog_filter_font_size, 'tablet' ),
					'padding-top'           => astra_responsive_spacing( $blog_filter_inner_spacing, 'top', 'tablet' ),
					'padding-' . $ltr_right => astra_responsive_spacing( $blog_filter_inner_spacing, 'right', 'tablet' ),
					'padding-bottom'        => astra_responsive_spacing( $blog_filter_inner_spacing, 'bottom', 'tablet' ),
					'padding-' . $ltr_left  => astra_responsive_spacing( $blog_filter_inner_spacing, 'left', 'tablet' ),
					'margin-top'            => astra_responsive_spacing( $blog_filter_outer_spacing, 'top', 'tablet' ),
					'margin-' . $ltr_right  => astra_responsive_spacing( $blog_filter_outer_spacing, 'right', 'tablet' ),
					'margin-bottom'         => astra_responsive_spacing( $blog_filter_outer_spacing, 'bottom', 'tablet' ),
					'margin-' . $ltr_left   => astra_responsive_spacing( $blog_filter_outer_spacing, 'left', 'tablet' ),
				),
				$blog_filter_border_radius_tablet
			),
		);

		$parse_css .= astra_parse_css( $blog_filter_css_output_tablet, '', astra_addon_get_tablet_breakpoint() );

		$blog_filter_border_radius_mobile = array();
		if ( 'blog-filter-layout-2' === $blog_filter_layout ) {
			$blog_filter_border_radius_mobile = array(
				'border-top-' . $ltr_left . '-radius'     => astra_responsive_spacing( $blog_filter_border_radius, 'top_left', 'mobile' ),
				'border-top-' . $ltr_right . '-radius'    => astra_responsive_spacing( $blog_filter_border_radius, 'top_right', 'mobile' ),
				'border-bottom-' . $ltr_right . '-radius' => astra_responsive_spacing( $blog_filter_border_radius, 'bottom_right', 'mobile' ),
				'border-bottom-' . $ltr_left . '-radius'  => astra_responsive_spacing( $blog_filter_border_radius, 'bottom_left', 'mobile' ),
			);
		}

		$blog_filter_css_output_mobile = array(
			$blog_filter_class         => array(
				'display'              => $mobile_blog_filter_visibility,
				'margin-top'           => astra_responsive_spacing( $blog_filter_outer_parent_spacing, 'top', 'mobile' ),
				'margin-' . $ltr_right => astra_responsive_spacing( $blog_filter_outer_parent_spacing, 'right', 'mobile' ),
				'margin-bottom'        => astra_responsive_spacing( $blog_filter_outer_parent_spacing, 'bottom', 'mobile' ),
				'margin-' . $ltr_left  => astra_responsive_spacing( $blog_filter_outer_parent_spacing, 'left', 'mobile' ),
			),
			$blog_filter_class . ' ul' => array(
				'justify-content'      => isset( $blog_filter_alignment_setting['mobile'] ) && 'center' === $blog_filter_alignment_setting['mobile'] ? 'center' : $mobile_blog_filter_alignment,
				'margin-' . $ltr_right => '-' . astra_responsive_spacing( $blog_filter_outer_spacing, 'right', 'mobile' ),
				'margin-' . $ltr_left  => '-' . astra_responsive_spacing( $blog_filter_outer_spacing, 'left', 'mobile' ),
			),
			$blog_filter_target        => array_merge(
				array(
					'font-size'             => astra_responsive_font( $blog_filter_font_size, 'mobile' ),
					'padding-top'           => astra_responsive_spacing( $blog_filter_inner_spacing, 'top', 'mobile' ),
					'padding-' . $ltr_right => astra_responsive_spacing( $blog_filter_inner_spacing, 'right', 'mobile' ),
					'padding-bottom'        => astra_responsive_spacing( $blog_filter_inner_spacing, 'bottom', 'mobile' ),
					'padding-' . $ltr_left  => astra_responsive_spacing( $blog_filter_inner_spacing, 'left', 'mobile' ),
					'margin-top'            => astra_responsive_spacing( $blog_filter_outer_spacing, 'top', 'mobile' ),
					'margin-' . $ltr_right  => astra_responsive_spacing( $blog_filter_outer_spacing, 'right', 'mobile' ),
					'margin-bottom'         => astra_responsive_spacing( $blog_filter_outer_spacing, 'bottom', 'mobile' ),
					'margin-' . $ltr_left   => astra_responsive_spacing( $blog_filter_outer_spacing, 'left', 'mobile' ),
				),
				$blog_filter_border_radius_mobile
			),

		);

		$parse_css .= astra_parse_css( $blog_filter_css_output_mobile, '', astra_addon_get_mobile_breakpoint() );

	}

	return $dynamic_css . $parse_css;
}
