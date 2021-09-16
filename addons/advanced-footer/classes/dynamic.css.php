<?php
/**
 * Footer Widgets - Dynamic CSS
 *
 * @package Astra Addon
 */

add_filter( 'astra_dynamic_css', 'astra_ext_footer_adv_dynamic_css' );

/**
 * Dynamic CSS
 *
 * @param  string $dynamic_css          Astra Dynamic CSS.
 * @param  string $dynamic_css_filtered Astra Dynamic CSS Filters.
 * @return string
 */
function astra_ext_footer_adv_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' ) {

	$body_font_family    = astra_body_font_family();
	$body_text_transform = astra_get_option( 'body-text-transform', 'inherit' );

	// Typography.
	$footer_adv_title_font_family      = astra_get_option( 'footer-adv-wgt-title-font-family', 'inherit' );
	$footer_adv_title_font_weight      = astra_get_option( 'footer-adv-wgt-title-font-weight', 'inherit' );
	$footer_adv_title_font_size        = astra_get_option( 'footer-adv-wgt-title-font-size' );
	$footer_adv_title_text_transform   = astra_get_option( 'footer-adv-wgt-title-text-transform', $body_text_transform );
	$footer_adv_title_line_height      = astra_get_option( 'footer-adv-wgt-title-line-height' );
	$footer_adv_content_font_family    = astra_get_option( 'footer-adv-wgt-content-font-family', 'inherit' );
	$footer_adv_content_font_weight    = astra_get_option( 'footer-adv-wgt-content-font-weight', 'inherit' );
	$footer_adv_content_font_size      = astra_get_option( 'footer-adv-wgt-content-font-size' );
	$footer_adv_content_text_transform = astra_get_option( 'footer-adv-wgt-content-text-transform' );
	$footer_adv_content_line_height    = astra_get_option( 'footer-adv-wgt-content-line-height' );

	// Spacing.
	$footer_adv_area_padding = astra_get_option( 'footer-adv-area-padding' );

	// Color.
	$footer_adv_text_color         = astra_get_option( 'footer-adv-text-color' );
	$footer_adv_widget_title_color = astra_get_option( 'footer-adv-wgt-title-color' );
	$footer_adv_link_color         = astra_get_option( 'footer-adv-link-color' );
	$footer_adv_link_h_color       = astra_get_option( 'footer-adv-link-h-color' );

	$footer_adv_width = astra_get_option( 'footer-adv-layout-width' );

	$footer_adv = array(

		// Advanced Fotter colors/fonts.
		'.footer-adv .widget-title,.footer-adv .widget-title a' => array(
			'color' => esc_attr( $footer_adv_widget_title_color ),
		),

		'.footer-adv'                                => array(
			'color' => esc_attr( $footer_adv_text_color ),
		),

		'.footer-adv a'                              => array(
			'color' => esc_attr( $footer_adv_link_color ),
		),

		'.footer-adv .tagcloud a:hover, .footer-adv .tagcloud a.current-item' => array(
			'border-color'     => esc_attr( $footer_adv_link_color ),
			'background-color' => esc_attr( $footer_adv_link_color ),
		),

		'.footer-adv a:hover, .footer-adv .no-widget-text a:hover, .footer-adv a:focus, .footer-adv .no-widget-text a:focus' => array(
			'color' => esc_attr( $footer_adv_link_h_color ),
		),

		'.footer-adv .calendar_wrap #today, .footer-adv a:hover + .post-count' => array(
			'background-color' => esc_attr( $footer_adv_link_color ),
		),

		'.footer-adv .widget-title, .footer-adv .widget-title a.rsswidget, .ast-no-widget-row .widget-title' => array(
			'font-family'    => astra_get_css_value( $footer_adv_title_font_family, 'font', $body_font_family ),
			'font-weight'    => astra_get_css_value( $footer_adv_title_font_weight, 'font' ),
			'font-size'      => astra_responsive_font( $footer_adv_title_font_size, 'desktop' ),
			'line-height'    => esc_attr( $footer_adv_title_line_height ),
			'text-transform' => esc_attr( $footer_adv_title_text_transform ),
		),

		'.footer-adv .widget > *:not(.widget-title)' => array(
			'font-family'    => astra_get_css_value( $footer_adv_content_font_family, 'font', $body_font_family ),
			'font-weight'    => astra_get_css_value( $footer_adv_content_font_weight, 'font' ),
			'font-size'      => astra_responsive_font( $footer_adv_content_font_size, 'desktop' ),
			'line-height'    => esc_attr( $footer_adv_content_line_height ),
			'text-transform' => esc_attr( $footer_adv_content_text_transform ),
		),

		'.footer-adv-overlay'                        => array(
			'padding-top'    => astra_responsive_spacing( $footer_adv_area_padding, 'top', 'desktop' ),
			'padding-bottom' => astra_responsive_spacing( $footer_adv_area_padding, 'bottom', 'desktop' ),
		),
	);

	$adv_footer_css_output = astra_parse_css( $footer_adv );

	$tablet_css = array(
		'.footer-adv .widget-title, .footer-adv .widget-title a.rsswidget, .ast-no-widget-row .widget-title' => array(
			'font-size' => astra_responsive_font( $footer_adv_title_font_size, 'tablet' ),
		),

		'.footer-adv .widget > *:not(.widget-title)' => array(
			'font-size' => astra_responsive_font( $footer_adv_content_font_size, 'tablet' ),
		),
		'.footer-adv-overlay'                        => array(
			'padding-top'    => astra_responsive_spacing( $footer_adv_area_padding, 'top', 'tablet' ),
			'padding-bottom' => astra_responsive_spacing( $footer_adv_area_padding, 'bottom', 'tablet' ),
		),
	);

	$adv_footer_css_output .= astra_parse_css( $tablet_css, '', astra_addon_get_tablet_breakpoint() );

	$mobile_css = array(
		'.footer-adv .widget-title, .footer-adv .widget-title a.rsswidget, .ast-no-widget-row .widget-title' => array(
			'font-size' => astra_responsive_font( $footer_adv_title_font_size, 'mobile' ),
		),

		'.footer-adv .widget > *:not(.widget-title)' => array(
			'font-size' => astra_responsive_font( $footer_adv_content_font_size, 'mobile' ),
		),
		'.footer-adv-overlay'                        => array(
			'padding-top'    => astra_responsive_spacing( $footer_adv_area_padding, 'top', 'mobile' ),
			'padding-bottom' => astra_responsive_spacing( $footer_adv_area_padding, 'bottom', 'mobile' ),
		),
	);

	$adv_footer_css_output .= astra_parse_css( $mobile_css, '', astra_addon_get_mobile_breakpoint() );

	/* Width for Footer Widgets */
	if ( 'content' != $footer_adv_width ) {

		$footer_adv_left_padding  = 35;
		$footer_adv_right_padding = 35;

		$footer_adv_left_padding_t  = 35;
		$footer_adv_right_padding_t = 35;

		$footer_adv_left_padding_m  = 35;
		$footer_adv_right_padding_m = 35;

		// Desktop.
		if ( '' != $footer_adv_area_padding['desktop']['left'] ) {
			$footer_adv_left_padding = $footer_adv_area_padding['desktop']['left'];
		}
		if ( '' != $footer_adv_area_padding['desktop']['right'] ) {
			$footer_adv_right_padding = $footer_adv_area_padding['desktop']['right'];
		}
		// Tablet.
		if ( '' != $footer_adv_area_padding['tablet']['left'] ) {
			$footer_adv_left_padding_t = $footer_adv_area_padding['tablet']['left'];
		}
		if ( '' != $footer_adv_area_padding['tablet']['right'] ) {
			$footer_adv_right_padding_t = $footer_adv_area_padding['tablet']['right'];
		}
		// Mobile.
		if ( '' != $footer_adv_area_padding['mobile']['left'] ) {
			$footer_adv_left_padding_m = $footer_adv_area_padding['mobile']['left'];
		}
		if ( '' != $footer_adv_area_padding['mobile']['right'] ) {
			$footer_adv_right_padding_m = $footer_adv_area_padding['mobile']['right'];
		}

		$genral_global_responsive = array(
			'.footer-adv .ast-container' => array(
				'max-width'     => '100%',
				'padding-left'  => astra_get_css_value( $footer_adv_left_padding, 'px' ),
				'padding-right' => astra_get_css_value( $footer_adv_right_padding, 'px' ),
			),
		);
		/* Parse CSS from array()*/
		$adv_footer_css_output .= astra_parse_css( $genral_global_responsive );

		// Tablet.
		$tablet_css = array(
			'.footer-adv .ast-container' => array(
				'max-width'     => '100%',
				'padding-left'  => astra_get_css_value( $footer_adv_left_padding_t, 'px' ),
				'padding-right' => astra_get_css_value( $footer_adv_right_padding_t, 'px' ),
			),
		);
		/* Parse CSS from array()*/
		$adv_footer_css_output .= astra_parse_css( $tablet_css, '', astra_addon_get_tablet_breakpoint() );

		// Mobile.
		$mobile_css = array(
			'.footer-adv .ast-container' => array(
				'max-width'     => '100%',
				'padding-left'  => astra_get_css_value( $footer_adv_left_padding_m, 'px' ),
				'padding-right' => astra_get_css_value( $footer_adv_right_padding_m, 'px' ),
			),
		);

		$adv_footer_css_output .= astra_parse_css( $mobile_css, '', astra_addon_get_mobile_breakpoint() );

	} else {
		$desktop_lr_padding['.footer-adv .ast-container'] = array(
			'padding-right' => astra_responsive_spacing( $footer_adv_area_padding, 'right', 'desktop' ),
			'padding-left'  => astra_responsive_spacing( $footer_adv_area_padding, 'left', 'desktop' ),
		);
		$adv_footer_css_output                           .= astra_parse_css( $desktop_lr_padding );

		$tablet_lr_padding['.footer-adv .ast-container'] = array(
			'padding-right' => astra_responsive_spacing( $footer_adv_area_padding, 'right', 'tablet' ),
			'padding-left'  => astra_responsive_spacing( $footer_adv_area_padding, 'left', 'tablet' ),
		);
		$adv_footer_css_output                          .= astra_parse_css( $tablet_lr_padding, '', astra_addon_get_tablet_breakpoint() );

		$mobile_lr_padding['.footer-adv .ast-container'] = array(
			'padding-right' => astra_responsive_spacing( $footer_adv_area_padding, 'right', 'mobile' ),
			'padding-left'  => astra_responsive_spacing( $footer_adv_area_padding, 'left', 'mobile' ),
		);
		$adv_footer_css_output                          .= astra_parse_css( $mobile_lr_padding, '', astra_addon_get_mobile_breakpoint() );

	}
	// Foreground color.
	if ( ! empty( $footer_adv_link_color ) ) {
		$footer_adv_tagcloud    = array(
			'.footer-adv .tagcloud a:hover, .footer-adv .tagcloud a.current-item' => array(
				'color' => astra_get_foreground_color( $footer_adv_link_color ),
			),
			'.footer-adv .calendar_wrap #today' => array(
				'color' => astra_get_foreground_color( $footer_adv_link_color ),
			),
		);
		$adv_footer_css_output .= astra_parse_css( $footer_adv_tagcloud );
	}

	return $dynamic_css . $adv_footer_css_output;
}
