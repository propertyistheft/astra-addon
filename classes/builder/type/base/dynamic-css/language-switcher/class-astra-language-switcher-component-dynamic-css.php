<?php
/**
 * Astra language switcher Component Dynamic CSS.
 *
 * @package     astra-builder
 * @author      Astra
 * @copyright   Copyright (c) 2020, Astra
 * @link        https://wpastra.com/
 * @since       3.1.0
 */

// No direct access, please.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Bail if Customizer divider dynamic CSS class is already present.
if ( class_exists( 'Astra_Language_Switcher_Component_Dynamic_CSS' ) ) {
	return;
}

/**
 * Register Builder Dynamic CSS.
 *
 * @since 3.1.0
 */
class Astra_Language_Switcher_Component_Dynamic_CSS {

	/**
	 * Dynamic CSS
	 *
	 * @param string $builder_type Builder Type.
	 * @return String Generated dynamic CSS for Heading Colors.
	 *
	 * @since 3.1.0
	 */
	public static function astra_language_switcher_dynamic_css( $builder_type = 'header' ) {

		$generated_css = '';

		$_section = ( 'header' === $builder_type ) ? 'section-hb-language-switcher' : 'section-fb-language-switcher';

		$selector = ( 'header' === $builder_type ) ? '.ast-header-language-switcher' : '.ast-footer-language-switcher-element[data-section="section-fb-language-switcher"]';

		$flag_spacing         = astra_get_option( $_section . '-flag-spacing' );
		$flag_spacing_desktop = isset( $flag_spacing['desktop'] ) ? $flag_spacing['desktop'] : '';
		$flag_spacing_tablet  = isset( $flag_spacing['tablet'] ) ? $flag_spacing['tablet'] : '';
		$flag_spacing_mobile  = isset( $flag_spacing['mobile'] ) ? $flag_spacing['mobile'] : '';

		$flag_size         = astra_get_option( $_section . '-flag-size' );
		$flag_size_desktop = isset( $flag_size['desktop'] ) ? $flag_size['desktop'] : '';
		$flag_size_tablet  = isset( $flag_size['tablet'] ) ? $flag_size['tablet'] : '';
		$flag_size_mobile  = isset( $flag_size['mobile'] ) ? $flag_size['mobile'] : '';

		/**
		 * Desktop CSS.
		 */
		$css_output_desktop = array(
			'.ast-lswitcher-item-' . $builder_type => array(
				'margin-right' => astra_get_css_value( $flag_spacing_desktop, 'px' ),
			),
			'.ast-lswitcher-item-' . $builder_type . ' img' => array(
				'width' => astra_get_css_value( $flag_size_desktop, 'px' ),
			),
			'.ast-lswitcher-item-' . $builder_type . ' svg' => array(
				'width'  => astra_get_css_value( $flag_size_desktop, 'px' ),
				'height' => astra_get_css_value( $flag_size_desktop, 'px' ),
			),
		);

		/**
		 * Tablet CSS.
		 */
		$css_output_tablet = array(
			'.ast-lswitcher-item-' . $builder_type => array(
				'margin-right' => astra_get_css_value( $flag_spacing_tablet, 'px' ),
			),
			'.ast-lswitcher-item-' . $builder_type . ' img' => array(
				'width' => astra_get_css_value( $flag_size_tablet, 'px' ),
			),
			'.ast-lswitcher-item-' . $builder_type . ' svg' => array(
				'width'  => astra_get_css_value( $flag_size_tablet, 'px' ),
				'height' => astra_get_css_value( $flag_size_tablet, 'px' ),
			),
		);

		/**
		 * Tablet CSS.
		 */
		$css_output_mobile = array(
			'.ast-lswitcher-item-' . $builder_type => array(
				'margin-right' => astra_get_css_value( $flag_spacing_mobile, 'px' ),
			),
			'.ast-lswitcher-item-' . $builder_type . ' img' => array(
				'width' => astra_get_css_value( $flag_size_mobile, 'px' ),
			),
			'.ast-lswitcher-item-' . $builder_type . ' svg' => array(
				'width'  => astra_get_css_value( $flag_size_mobile, 'px' ),
				'height' => astra_get_css_value( $flag_size_mobile, 'px' ),
			),
		);

		/* Parse CSS from array() */
		$css_output  = astra_parse_css( $css_output_desktop );
		$css_output .= astra_parse_css( $css_output_tablet, '', astra_addon_get_tablet_breakpoint() );
		$css_output .= astra_parse_css( $css_output_mobile, '', astra_addon_get_mobile_breakpoint() );

		$generated_css .= $css_output;

		$generated_css .= Astra_Builder_Base_Dynamic_CSS::prepare_visibility_css( $_section, $selector );

		return $generated_css;
	}
}

/**
 * Kicking this off by creating object of this class.
 */
new Astra_Language_Switcher_Component_Dynamic_CSS();
