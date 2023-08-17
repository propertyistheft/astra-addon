<?php
/**
 * Astra Social Component Dynamic CSS.
 *
 * @package     astra-builder
 * @link        https://wpastra.com/
 * @since       3.0.0
 */

// No direct access, please.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register Builder Dynamic CSS.
 *
 * @since 3.0.0
 */
// @codingStandardsIgnoreStart
class Astra_Social_Icon_Component_Dynamic_CSS {
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
	public static function astra_social_dynamic_css( $builder_type = 'header' ) {

		$generated_css = '';

		$number_of_social_icons = ( 'header' === $builder_type ) ? astra_addon_builder_helper()->num_of_header_social_icons : astra_addon_builder_helper()->num_of_footer_social_icons;

		for ( $index = 1; $index <= $number_of_social_icons; $index++ ) {

			if ( ! Astra_Addon_Builder_Helper::is_component_loaded( 'social-icons-' . $index, $builder_type ) ) {
				continue;
			}

			$selector        = '.ast-' . $builder_type . '-social-' . $index . '-wrap';
			$icon_spacing    = astra_get_option( $builder_type . '-social-' . $index . '-space' );
			$social_stack_on = astra_get_option( $builder_type . '-social-' . $index . '-stack', 'none' );

			$icon_spacing_desktop = ( isset( $icon_spacing['desktop'] ) && '' !== $icon_spacing['desktop'] ) ? (int) $icon_spacing['desktop'] / 2 : '';
			$icon_spacing_tablet  = ( isset( $icon_spacing['tablet'] ) && '' !== $icon_spacing['tablet'] ) ? (int) $icon_spacing['tablet'] / 2 : '';
			$icon_spacing_mobile  = ( isset( $icon_spacing['mobile'] ) && '' !== $icon_spacing['mobile'] ) ? (int) $icon_spacing['mobile'] / 2 : '';

			/**
			 * Social Icon CSS.
			 */
			$css_output_desktop = array();
			$css_output_tablet  = array();
			$css_output_mobile  = array();

			if ( 'desktop' === $social_stack_on ) {

				$css_output_desktop = array(

					$selector . ' .ast-social-stack-desktop .ast-builder-social-element' => array(
						'display'       => 'flex',
						// Icon Spacing.
						'margin-left'   => 'unset',
						'margin-right'  => 'unset',
						'margin-top'    => astra_get_css_value( $icon_spacing_desktop, 'px' ),
						'margin-bottom' => astra_get_css_value( $icon_spacing_desktop, 'px' ),
					),
				);

				$css_output_tablet[ $selector . ' .ast-social-stack-desktop .ast-builder-social-element' ] = array(
					'margin-top'    => astra_get_css_value( $icon_spacing_tablet, 'px' ),
					'margin-bottom' => astra_get_css_value( $icon_spacing_tablet, 'px' ),
				);

				$css_output_mobile[ $selector . ' .ast-social-stack-desktop .ast-builder-social-element' ] = array(
					'margin-top'    => astra_get_css_value( $icon_spacing_mobile, 'px' ),
					'margin-bottom' => astra_get_css_value( $icon_spacing_mobile, 'px' ),
				);
			}
			/**
			 * Social_icons tablet CSS.
			 */
			if ( 'tablet' === $social_stack_on ) {

				$css_output_tablet = array(

					$selector . ' .ast-social-stack-tablet .ast-builder-social-element' => array(
						'display'       => 'flex',
						// Icon Spacing.
						'margin-left'   => 'unset',
						'margin-right'  => 'unset',
						'margin-top'    => astra_get_css_value( $icon_spacing_tablet, 'px' ),
						'margin-bottom' => astra_get_css_value( $icon_spacing_tablet, 'px' ),
					),
				);

				$css_output_mobile[ $selector . ' .ast-social-stack-tablet .ast-builder-social-element' ] = array(
					'margin-top'    => astra_get_css_value( $icon_spacing_mobile, 'px' ),
					'margin-bottom' => astra_get_css_value( $icon_spacing_mobile, 'px' ),
				);
			}

			/**
			 * Social_icons mobile CSS.
			 */
			if ( 'mobile' === $social_stack_on ) {

				$css_output_mobile = array(

					$selector . ' .ast-social-stack-mobile .ast-builder-social-element' => array(
						'display'       => 'flex',
						// Icon Spacing.
						'margin-left'   => 'unset',
						'margin-right'  => 'unset',
						'margin-top'    => astra_get_css_value( $icon_spacing_mobile, 'px' ),
						'margin-bottom' => astra_get_css_value( $icon_spacing_mobile, 'px' ),
					),
				);
			}
			/* Parse CSS from array() */
			$css_output  = astra_parse_css( $css_output_desktop );
			$css_output .= astra_parse_css( $css_output_tablet, '', astra_addon_get_tablet_breakpoint() );
			$css_output .= astra_parse_css( $css_output_mobile, '', astra_addon_get_mobile_breakpoint() );

			$generated_css .= $css_output;
		}

		return $generated_css;
	}
}

/**
 * Kicking this off by creating object of this class.
 */

new Astra_Social_Icon_Component_Dynamic_CSS();
