<?php
/**
 * Astra Addon Button Component Dynamic CSS.
 *
 * @package     astra-builder
 * @link        https://wpastra.com/
 * @since       3.3.0
 */

// No direct access, please.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register Builder Dynamic CSS.
 *
 * @since 3.3.0
 */
class Astra_Addon_Button_Component_Dynamic_CSS {

	/**
	 * Dynamic CSS
	 *
	 * @param string $builder_type Builder Type.
	 * @return String Generated dynamic CSS for Heading Colors.
	 *
	 * @since 3.3.0
	 */
	public static function astra_ext_button_dynamic_css( $builder_type = 'header' ) {

		$dynamic_css = '';

		$number_of_button = ( 'header' === $builder_type ) ? astra_addon_builder_helper()->num_of_header_button : astra_addon_builder_helper()->num_of_footer_button;

		for ( $index = 1; $index <= $number_of_button; $index++ ) {

			if ( ! Astra_Addon_Builder_Helper::is_component_loaded( 'button-' . $index, $builder_type ) ) {
				continue;
			}
			$_section = ( 'header' === $builder_type ) ? 'section-hb-button-' . $index : 'section-fb-button-' . $index;
			$_prefix  = 'button' . $index;

			$selector = '.ast-' . $builder_type . '-button-' . $index . ' .ast-custom-button';

			$dynamic_css .= Astra_Addon_Base_Dynamic_CSS::prepare_box_shadow_dynamic_css( $builder_type . '-button' . $index, $selector );
		}

		return $dynamic_css;
	}
}

/**
 * Kicking this off by creating object of this class.
 */

new Astra_Addon_Button_Component_Dynamic_CSS();
