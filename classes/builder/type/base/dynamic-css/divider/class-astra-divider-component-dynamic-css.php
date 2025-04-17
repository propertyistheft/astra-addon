<?php
/**
 * Astra Divider Component Dynamic CSS.
 *
 * @package     astra-builder
 * @link        https://wpastra.com/
 * @since       3.0.0
 */

// No direct access, please.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Bail if Customizer divider dynamic CSS class is already present.
if ( class_exists( 'Astra_Divider_Component_Dynamic_CSS' ) ) {
	return;
}

/**
 * Register Builder Dynamic CSS.
 *
 * @since 3.0.0
 */
// @codingStandardsIgnoreStart
class Astra_Divider_Component_Dynamic_CSS {
 // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedClassFound
	// @codingStandardsIgnoreEnd

	/**
	 * Dynamic CSS
	 *
	 * @param string $builder_type Builder Type.
	 * @return String Generated dynamic CSS for Heading Colors.
	 *
	 * @since 3.0.0
	 */
	public static function astra_divider_dynamic_css( $builder_type = 'header' ) {

		$generated_css = '';

		$number_of_divider = 'header' === $builder_type ? astra_addon_builder_helper()->num_of_header_divider : astra_addon_builder_helper()->num_of_footer_divider;

		for ( $index = 1; $index <= $number_of_divider; $index++ ) {

			if ( ! Astra_Addon_Builder_Helper::is_component_loaded( 'divider-' . $index, $builder_type ) ) {
				continue;
			}

			$_section = 'header' === $builder_type ? 'section-hb-divider-' . $index : 'section-fb-divider-' . $index;

			$selector = 'header' === $builder_type ? '.ast-header-divider-' . $index : '.ast-builder-grid-row-container-inner .footer-widget-area[data-section="section-fb-divider-' . $index . '"]';

			$divider_style = astra_get_option( $builder_type . '-divider-' . $index . '-style' );

			$divider_thickness = astra_get_option( $builder_type . '-divider-' . $index . '-thickness' );
			$divider_size      = astra_get_option( $builder_type . '-divider-' . $index . '-size' );
			$divider_size      = is_array( $divider_size ) ? $divider_size : array();

			$divider_size_desktop = isset( $divider_size['desktop'] ) ? $divider_size['desktop'] : '';
			$divider_size_tablet  = isset( $divider_size['tablet'] ) ? $divider_size['tablet'] : '';
			$divider_size_mobile  = isset( $divider_size['mobile'] ) ? $divider_size['mobile'] : '';

			$footer_vertical_divider_size   = astra_get_option( 'footer-vertical-divider-' . $index . '-size' );
			$header_horizontal_divider_size = astra_get_option( 'header-horizontal-divider-' . $index . '-size' );
			$margin                         = astra_get_option( $_section . '-margin' );

			$footer_vertical_divider_size_desktop = isset( $footer_vertical_divider_size['desktop'] ) ? (int) $footer_vertical_divider_size['desktop'] : '';
			$footer_vertical_divider_size_tablet  = isset( $footer_vertical_divider_size['tablet'] ) ? (int) $footer_vertical_divider_size['tablet'] : '';
			$footer_vertical_divider_size_mobile  = isset( $footer_vertical_divider_size['mobile'] ) ? (int) $footer_vertical_divider_size['mobile'] : '';

			/**
			 * Desktop CSS.
			 */
			$css_output_desktop = array(

				/**
				 * Button Colors.
				 */
				$selector . ' .ast-divider-wrapper' => array(
					'border-style' => $divider_style,
					'border-color' => astra_get_option( $builder_type . '-divider-' . $index . '-color' ),
				),

				$selector . ' .ast-divider-layout-vertical' => array(
					'border-right-width' => astra_get_css_value( $divider_thickness['desktop'], 'px' ),
				),

				$selector . '.ast-hb-divider-layout-vertical .ast-divider-layout-vertical' => array(
					'height' => astra_get_css_value( $divider_size_desktop, '%' ),
				),

				$selector . '.ast-fb-divider-layout-vertical .ast-divider-layout-vertical' => array(
					'height' => astra_get_css_value( $footer_vertical_divider_size_desktop, 'px' ),
				),

				$selector . ' .ast-divider-layout-horizontal' => array(
					'border-top-width' => astra_get_css_value( $divider_thickness['desktop'], 'px' ),
				),

				$selector . '.ast-fb-divider-layout-horizontal .ast-divider-layout-horizontal' => array(
					'width' => astra_get_css_value( $divider_size_desktop, '%' ),
				),

				$selector . '.ast-hb-divider-layout-horizontal .ast-divider-layout-horizontal' => array(
					'width' => astra_get_css_value( $header_horizontal_divider_size['desktop'], 'px' ),
				),

				$selector                           => array(
					// Margin.
					'margin-top'    => astra_responsive_spacing( $margin, 'top', 'desktop' ),
					'margin-bottom' => astra_responsive_spacing( $margin, 'bottom', 'desktop' ),
					'margin-left'   => astra_responsive_spacing( $margin, 'left', 'desktop' ),
					'margin-right'  => astra_responsive_spacing( $margin, 'right', 'desktop' ),
				),
				'.ast-container[data-section="section-above-header-builder"],.ast-container[data-section="section-primary-header-builder"],.ast-container[data-section="section-below-header-builder"],.ast-container[data-section="section-above-header-builder"] .site-header-above-section-left,.ast-container[data-section="section-above-header-builder"] .site-header-above-section-center,.ast-container[data-section="section-above-header-builder"] .site-header-above-section-right,.ast-container[data-section="section-primary-header-builder"] .site-header-primary-section-left,.ast-container[data-section="section-primary-header-builder"] .site-header-primary-section-center,.ast-container[data-section="section-primary-header-builder"] .site-header-primary-section-right,.ast-container[data-section="section-below-header-builder"] .site-header-below-section-left,.ast-container[data-section="section-below-header-builder"] .site-header-below-section-center,.ast-container[data-section="section-below-header-builder"] .site-header-below-section-right' => array(
					'position' => 'relative',
				),
			);

			/**
			 * Tablet CSS.
			 */
			$css_output_tablet = array(

				/**
				 * Button Colors.
				 */
				$selector . ' .ast-divider-wrapper' => array(
					'border-style' => $divider_style,
					'border-color' => astra_get_option( $builder_type . '-divider-' . $index . '-color' ),
				),

				'.ast-mobile-popup-content ' . $selector . ' .ast-divider-wrapper' => array(
					'border-color' => astra_get_option( $builder_type . '-divider-' . $index . '-color' ),
				),

				$selector . ' .ast-divider-layout-vertical' => array(
					'border-right-width' => astra_get_css_value( $divider_thickness['tablet'], 'px' ),
				),

				$selector . '.ast-hb-divider-layout-vertical .ast-divider-layout-vertical' => array(
					'height' => astra_get_css_value( $divider_size_tablet, '%' ),
				),

				$selector . '.ast-fb-divider-layout-vertical .ast-divider-layout-vertical' => array(
					'height' => astra_get_css_value( $footer_vertical_divider_size_tablet, 'px' ),
				),

				$selector . ' .ast-divider-layout-horizontal' => array(
					'border-top-width' => astra_get_css_value( $divider_thickness['tablet'], 'px' ),
				),

				$selector . '.ast-fb-divider-layout-horizontal .ast-divider-layout-horizontal' => array(
					'width' => astra_get_css_value( $divider_size_tablet, '%' ),
				),

				$selector . '.ast-hb-divider-layout-horizontal .ast-divider-layout-horizontal' => array(
					'width' => astra_get_css_value( $header_horizontal_divider_size['tablet'], 'px' ),
				),

				$selector                           => array(
					// Margin CSS.
					'margin-top'    => astra_responsive_spacing( $margin, 'top', 'tablet' ),
					'margin-bottom' => astra_responsive_spacing( $margin, 'bottom', 'tablet' ),
					'margin-left'   => astra_responsive_spacing( $margin, 'left', 'tablet' ),
					'margin-right'  => astra_responsive_spacing( $margin, 'right', 'tablet' ),
				),
			);

			/**
			 * Tablet CSS.
			 */
			$css_output_mobile = array(

				/**
				 * Button Colors.
				 */
				$selector . ' .ast-divider-wrapper' => array(
					'border-style' => $divider_style,
					'border-color' => astra_get_option( $builder_type . '-divider-' . $index . '-color' ),
				),

				'.ast-mobile-popup-content ' . $selector . ' .ast-divider-wrapper' => array(
					'border-color' => astra_get_option( $builder_type . '-divider-' . $index . '-color' ),
				),

				$selector . ' .ast-divider-layout-vertical' => array(
					'border-right-width' => astra_get_css_value( $divider_thickness['mobile'], 'px' ),
				),

				$selector . '.ast-hb-divider-layout-vertical .ast-divider-layout-vertical' => array(
					'height' => astra_get_css_value( $divider_size_mobile, '%' ),
				),

				$selector . '.ast-fb-divider-layout-vertical .ast-divider-layout-vertical' => array(
					'height' => astra_get_css_value( $footer_vertical_divider_size_mobile, 'px' ),
				),

				$selector . ' .ast-divider-layout-horizontal' => array(
					'border-top-width' => astra_get_css_value( $divider_thickness['mobile'], 'px' ),
				),

				$selector . '.ast-fb-divider-layout-horizontal .ast-divider-layout-horizontal' => array(
					'width' => astra_get_css_value( $divider_size_mobile, '%' ),
				),

				$selector . '.ast-hb-divider-layout-horizontal .ast-divider-layout-horizontal' => array(
					'width' => astra_get_css_value( $header_horizontal_divider_size['mobile'], 'px' ),
				),

				$selector                           => array(
					// Margin CSS.
					'margin-top'    => astra_responsive_spacing( $margin, 'top', 'mobile' ),
					'margin-bottom' => astra_responsive_spacing( $margin, 'bottom', 'mobile' ),
					'margin-left'   => astra_responsive_spacing( $margin, 'left', 'mobile' ),
					'margin-right'  => astra_responsive_spacing( $margin, 'right', 'mobile' ),
				),
			);

			/* Parse CSS from array() */
			$css_output  = astra_parse_css( $css_output_desktop );
			$css_output .= astra_parse_css( $css_output_tablet, '', astra_addon_get_tablet_breakpoint() );
			$css_output .= astra_parse_css( $css_output_mobile, '', astra_addon_get_mobile_breakpoint() );

			$generated_css .= $css_output;

			if ( class_exists( 'Astra_Builder_Base_Dynamic_CSS' ) && method_exists( 'Astra_Builder_Base_Dynamic_CSS', 'prepare_visibility_css' ) ) {
				$generated_css .= Astra_Builder_Base_Dynamic_CSS::prepare_visibility_css( $_section, $selector );
			}
		}

		return $generated_css;
	}
}

/**
 * Kicking this off by creating object of this class.
 */

new Astra_Divider_Component_Dynamic_CSS();
