<?php
/**
 * Sticky Header Buttons Dynamic CSS
 *
 * @package Astra Addon
 */

add_filter( 'astra_addon_dynamic_css', 'astra_sticky_header_button_dynamic_css' );

/**
 * Dynamic CSS
 *
 * @param  string $dynamic_css          Astra Dynamic CSS.
 * @param  string $dynamic_css_filtered Astra Dynamic CSS Filters.
 * @return string
 */
function astra_sticky_header_button_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' ) {

	/**
	 * Button Style - Theme Button / Custom Button.
	 */

	$num_of_header_button = astra_addon_builder_helper()->num_of_header_button;
	for ( $index = 1; $index <= $num_of_header_button; $index++ ) {

		if ( ! Astra_Addon_Builder_Helper::is_component_loaded( 'button-' . $index, 'header' ) ) {
			continue;
		}

		$_prefix  = 'button' . $index;
		$_section = 'section-hb-button-' . $index;
		$selector = '.ast-header-sticked .ast-header-button-' . $index;

		$button_border_width         = astra_get_option( 'sticky-header-' . $_prefix . '-border-size' );
		$button_border_radius_fields = astra_get_option( 'sticky-header-' . $_prefix . '-border-radius-fields' );
		// Normal Responsive Colors.
		$button_bg_color_desktop = astra_get_prop( astra_get_option( 'sticky-header-' . $_prefix . '-back-color' ), 'desktop' );
		$button_bg_color_tablet  = astra_get_prop( astra_get_option( 'sticky-header-' . $_prefix . '-back-color' ), 'tablet' );
		$button_bg_color_mobile  = astra_get_prop( astra_get_option( 'sticky-header-' . $_prefix . '-back-color' ), 'mobile' );
		$button_color_desktop    = astra_get_prop( astra_get_option( 'sticky-header-' . $_prefix . '-text-color' ), 'desktop' );
		$button_color_tablet     = astra_get_prop( astra_get_option( 'sticky-header-' . $_prefix . '-text-color' ), 'tablet' );
		$button_color_mobile     = astra_get_prop( astra_get_option( 'sticky-header-' . $_prefix . '-text-color' ), 'mobile' );
		// Hover Responsive Colors.
		$button_bg_h_color_desktop = astra_get_prop( astra_get_option( 'sticky-header-' . $_prefix . '-back-h-color' ), 'desktop' );
		$button_bg_h_color_tablet  = astra_get_prop( astra_get_option( 'sticky-header-' . $_prefix . '-back-h-color' ), 'tablet' );
		$button_bg_h_color_mobile  = astra_get_prop( astra_get_option( 'sticky-header-' . $_prefix . '-back-h-color' ), 'mobile' );
		$button_h_color_desktop    = astra_get_prop( astra_get_option( 'sticky-header-' . $_prefix . '-text-h-color' ), 'desktop' );
		$button_h_color_tablet     = astra_get_prop( astra_get_option( 'sticky-header-' . $_prefix . '-text-h-color' ), 'tablet' );
		$button_h_color_mobile     = astra_get_prop( astra_get_option( 'sticky-header-' . $_prefix . '-text-h-color' ), 'mobile' );

		// Normal Responsive Colors.
		$button_border_color_desktop = astra_get_prop( astra_get_option( 'sticky-header-' . $_prefix . '-border-color' ), 'desktop' );
		$button_border_color_tablet  = astra_get_prop( astra_get_option( 'sticky-header-' . $_prefix . '-border-color' ), 'tablet' );
		$button_border_color_mobile  = astra_get_prop( astra_get_option( 'sticky-header-' . $_prefix . '-border-color' ), 'mobile' );

		// Hover Responsive Colors.
		$button_border_h_color_desktop = astra_get_prop( astra_get_option( 'sticky-header-' . $_prefix . '-border-h-color' ), 'desktop' );
		$button_border_h_color_tablet  = astra_get_prop( astra_get_option( 'sticky-header-' . $_prefix . '-border-h-color' ), 'tablet' );
		$button_border_h_color_mobile  = astra_get_prop( astra_get_option( 'sticky-header-' . $_prefix . '-border-h-color' ), 'mobile' );

		// Border width.
		$button_border_width_top    = isset( $button_border_width['top'] ) ? astra_get_css_value( $button_border_width['top'], 'px' ) : '';
		$button_border_width_bottom = isset( $button_border_width['bottom'] ) ? astra_get_css_value( $button_border_width['bottom'], 'px' ) : '';
		$button_border_width_left   = isset( $button_border_width['left'] ) ? astra_get_css_value( $button_border_width['left'], 'px' ) : '';
		$button_border_width_right  = isset( $button_border_width['right'] ) ? astra_get_css_value( $button_border_width['right'], 'px' ) : '';

		// Padding.
		$padding = astra_get_option( 'sticky-header-' . $_prefix . '-padding' );

		/**
		 * Button CSS.
		 */
		$css_output_desktop = array(

			/**
			 * Button Colors.
			 */
			$selector . ' .ast-builder-button-wrap .ast-custom-button'       => array(
				// Colors.
				'color'                      => $button_color_desktop,
				'background'                 => $button_bg_color_desktop,

				// Border.
				'border-color'               => $button_border_color_desktop,
				'border-top-width'           => $button_border_width_top,
				'border-bottom-width'        => $button_border_width_bottom,
				'border-left-width'          => $button_border_width_left,
				'border-right-width'         => $button_border_width_right,
				'border-top-left-radius'     => astra_responsive_spacing( $button_border_radius_fields, 'top', 'desktop' ),
				'border-top-right-radius'    => astra_responsive_spacing( $button_border_radius_fields, 'right', 'desktop' ),
				'border-bottom-right-radius' => astra_responsive_spacing( $button_border_radius_fields, 'bottom', 'desktop' ),
				'border-bottom-left-radius'  => astra_responsive_spacing( $button_border_radius_fields, 'left', 'desktop' ),
				// Padding.
				'padding-top'                => astra_responsive_spacing( $padding, 'top', 'desktop' ),
				'padding-bottom'             => astra_responsive_spacing( $padding, 'bottom', 'desktop' ),
				'padding-left'               => astra_responsive_spacing( $padding, 'left', 'desktop' ),
				'padding-right'              => astra_responsive_spacing( $padding, 'right', 'desktop' ),
			),
			// Hover Options.
			$selector . ' .ast-builder-button-wrap:hover .ast-custom-button' => array(
				'color'        => $button_h_color_desktop,
				'background'   => $button_bg_h_color_desktop,
				'border-color' => $button_border_h_color_desktop,
			),
		);

		/**
		 * Button CSS.
		 */
		$css_output_tablet = array(

			/**
			 * Button Colors.
			 */
			$selector . ' .ast-builder-button-wrap .ast-custom-button'       => array(
				// Colors.
				'color'                      => $button_color_tablet,
				'background'                 => $button_bg_color_tablet,
				'border-color'               => $button_border_color_tablet,
				'border-top-left-radius'     => astra_responsive_spacing( $button_border_radius_fields, 'top', 'tablet' ),
				'border-top-right-radius'    => astra_responsive_spacing( $button_border_radius_fields, 'right', 'tablet' ),
				'border-bottom-right-radius' => astra_responsive_spacing( $button_border_radius_fields, 'bottom', 'tablet' ),
				'border-bottom-left-radius'  => astra_responsive_spacing( $button_border_radius_fields, 'left', 'tablet' ),
				// Padding.
				'padding-top'                => astra_responsive_spacing( $padding, 'top', 'tablet' ),
				'padding-bottom'             => astra_responsive_spacing( $padding, 'bottom', 'tablet' ),
				'padding-left'               => astra_responsive_spacing( $padding, 'left', 'tablet' ),
				'padding-right'              => astra_responsive_spacing( $padding, 'right', 'tablet' ),
			),
			// Hover Options.
			$selector . ' .ast-builder-button-wrap:hover .ast-custom-button' => array(
				'color'        => $button_h_color_tablet,
				'background'   => $button_bg_h_color_tablet,
				'border-color' => $button_border_h_color_tablet,
			),
		);

		/**
		 * Button CSS.
		 */
		$css_output_mobile = array(

			/**
			 * Button Colors.
			 */
			$selector . ' .ast-builder-button-wrap .ast-custom-button'       => array(
				// Colors.
				'color'                      => $button_color_mobile,
				'background'                 => $button_bg_color_mobile,
				'border-color'               => $button_border_color_mobile,
				'border-top-left-radius'     => astra_responsive_spacing( $button_border_radius_fields, 'top', 'mobile' ),
				'border-top-right-radius'    => astra_responsive_spacing( $button_border_radius_fields, 'right', 'mobile' ),
				'border-bottom-right-radius' => astra_responsive_spacing( $button_border_radius_fields, 'bottom', 'mobile' ),
				'border-bottom-left-radius'  => astra_responsive_spacing( $button_border_radius_fields, 'left', 'mobile' ),
				// Padding.
				'padding-top'                => astra_responsive_spacing( $padding, 'top', 'mobile' ),
				'padding-bottom'             => astra_responsive_spacing( $padding, 'bottom', 'mobile' ),
				'padding-left'               => astra_responsive_spacing( $padding, 'left', 'mobile' ),
				'padding-right'              => astra_responsive_spacing( $padding, 'right', 'mobile' ),
			),
			// Hover Options.
			$selector . ' .ast-builder-button-wrap:hover .ast-custom-button' => array(
				'color'        => $button_h_color_mobile,
				'background'   => $button_bg_h_color_mobile,
				'border-color' => $button_border_h_color_mobile,
			),
		);

		/* Parse CSS from array() */
		$css_output  = astra_parse_css( $css_output_desktop );
		$css_output .= astra_parse_css( $css_output_tablet, '', astra_addon_get_tablet_breakpoint() );
		$css_output .= astra_parse_css( $css_output_mobile, '', astra_addon_get_mobile_breakpoint() );

		$dynamic_css .= $css_output;
	}

	return $dynamic_css;

}
