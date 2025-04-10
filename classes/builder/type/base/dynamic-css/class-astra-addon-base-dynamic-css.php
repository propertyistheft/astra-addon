<?php
/**
 * Astra Addon Base Dynamic CSS.
 *
 * @since 3.3.0
 * @package astra-addon
 */

// No direct access, please.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Astra_Addon_Base_Dynamic_CSS.
 */
class Astra_Addon_Base_Dynamic_CSS {
	/**
	 * Dynamic CSS
	 *
	 * @param string $prefix control prefix.
	 * @param string $selector control CSS selector.
	 * @return String Generated dynamic CSS for Box Shadow.
	 *
	 * @since 3.3.0
	 */
	public static function prepare_box_shadow_dynamic_css( $prefix, $selector ) {

		$dynamic_css = '';

		$box_shadow       = astra_get_option( $prefix . '-box-shadow-control' );
		$box_shadow_color = astra_get_option( $prefix . '-box-shadow-color' );
		$position         = astra_get_option( $prefix . '-box-shadow-position' );
		$is_shadow        = isset( $box_shadow );

		// Box Shadow.
		$box_shadow_x = $is_shadow && isset( $box_shadow['x'] ) && '' !== $box_shadow['x'] ? $box_shadow['x'] . 'px ' : '0px ';

		$box_shadow_y = $is_shadow && isset( $box_shadow['y'] ) && '' !== $box_shadow['y'] ? $box_shadow['y'] . 'px ' : '0px ';

		$box_shadow_blur = $is_shadow && isset( $box_shadow['blur'] ) && '' !== $box_shadow['blur'] ? $box_shadow['blur'] . 'px ' : '0px ';

		$box_shadow_spread = $is_shadow && isset( $box_shadow['spread'] ) && '' !== $box_shadow['spread'] ? $box_shadow['spread'] . 'px ' : '0px ';

		$shadow_position = $is_shadow && isset( $position ) && 'inset' === $position ? ' inset' : '';

		$shadow_color = ( isset( $box_shadow_color ) ? $box_shadow_color : 'rgba(0,0,0,0.5)' );

		$css_output = array(
			$selector => array(
				// box shadow.
				'box-shadow' => $box_shadow_x . $box_shadow_y . $box_shadow_blur . $box_shadow_spread . $shadow_color . $shadow_position,
			),
		);

		/* Parse CSS from array() */
		return $dynamic_css . astra_parse_css( $css_output );
	}
}

/**
 *  Prepare if class 'Astra_Addon_Base_Dynamic_CSS' exist.
 *  Kicking this off by calling 'get_instance()' method
 */
new Astra_Addon_Base_Dynamic_CSS();
