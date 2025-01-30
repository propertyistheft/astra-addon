<?php
/**
 * Admin settings helper
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package     Astra Addon
 * @link        https://wpastra.com/
 * @since       Astra 4.1.1
 */

/**
 * Astra Addon kses for data process.
 */
class Astra_Addon_Kses {
	/**
	 * Echo kses code based on SVG type.
	 *
	 * @since 4.1.1
	 *
	 * @return array Return the array for allowed SVG protocols.
	 */
	public static function astra_addon_svg_kses_protocols() {
		return array(
			'a'        => array(
				'class'            => array(),
				'href'             => array(),
				'rel'              => array(),
				'data-quantity'    => array(),
				'data-product_id'  => array(),
				'data-product_sku' => array(),
				'aria-label'       => array(),
				'rev'              => true,
				'name'             => true,
				'target'           => true,
				'download'         => array(
					'valueless' => 'y',
				),
				'aria-describedby' => true,
				'aria-details'     => true,
				'aria-label'       => true,
				'aria-labelledby'  => true,
				'aria-hidden'      => true,
				'class'            => true,
				'data-*'           => true,
				'dir'              => true,
				'id'               => true,
				'lang'             => true,
				'style'            => true,
				'title'            => true,
				'role'             => true,
				'xml:lang'         => true,
			),
			'i'        => array(
				'aria-describedby' => true,
				'aria-details'     => true,
				'aria-label'       => true,
				'aria-labelledby'  => true,
				'aria-hidden'      => true,
				'class'            => true,
				'data-*'           => true,
				'dir'              => true,
				'id'               => true,
				'lang'             => true,
				'style'            => true,
				'title'            => true,
				'role'             => true,
				'xml:lang'         => true,
			),
			'span'     => array(
				'data-product_id'  => array(),
				'align'            => true,
				'aria-describedby' => true,
				'aria-details'     => true,
				'aria-label'       => true,
				'aria-labelledby'  => true,
				'aria-hidden'      => true,
				'class'            => true,
				'data-*'           => true,
				'dir'              => true,
				'id'               => true,
				'lang'             => true,
				'style'            => true,
				'title'            => true,
				'role'             => true,
				'xml:lang'         => true,
			),
			'svg'      => array(
				'xmlns:xlink'       => array(),
				'version'           => array(),
				'x'                 => array(),
				'y'                 => array(),
				'enable-background' => array(),
				'xml:space'         => array(),
				'class'             => array(),
				'data-*'            => true,
				'aria-hidden'       => array(),
				'aria-labelledby'   => array(),
				'role'              => array(),
				'xmlns'             => array(),
				'width'             => array(),
				'fill'              => array(),
				'height'            => array(),
				'viewbox'           => array(),
			),
			'g'        => array(
				'fill'         => array(),
				'stroke-width' => array(),
				'transform'    => array(),
				'stroke'       => array(),
				'id'           => array(),
				'clip-path'    => array(),
			),
			'use'      => array(
				'xlink:href'   => array(),
				'clip-path'    => array(),
				'stroke-width' => array(),
				'id'           => array(),
				'stroke'       => array(),
				'fill'         => array(),
				'transform'    => array(),
			),
			'polyline' => array(
				'fill'      => array(),
				'points'    => array(),
				'transform' => array(),
				'id'        => array(),
			),
			'clippath' => array( 'id' => array() ),
			'title'    => array( 'title' => array() ),
			'path'     => array(
				'd'            => array(),
				'fill'         => array(),
				'id'           => array(),
				'clip-path'    => array(),
				'stroke'       => array(),
				'transform'    => array(),
				'stroke-width' => array(),
			),
			'circle'   => array(
				'cx'        => array(),
				'cy'        => array(),
				'r'         => array(),
				'fill'      => array(),
				'fill'      => array(),
				'style'     => array(),
				'transform' => array(),
			),
			'rect'     => array(
				'y'      => array(),
				'x'      => array(),
				'r'      => array(),
				'style'  => array(),
				'id'     => array(),
				'fill'   => array(),
				'width'  => array(),
				'height' => array(),
			),
			'polygon'  => array(
				'style'     => array(),
				'points'    => array(),
				'fill'      => array(),
				'transform' => array(),
			),
		);
	}

	/**
	 * Echo kses post allowed HTML protocols along with above SVG protocols.
	 *
	 * @since 4.1.1
	 *
	 * @return array Return the array for allowed protocols.
	 */
	public static function astra_addon_svg_with_post_kses_protocols() {
		return apply_filters(
			'astra_addon_all_kses_protocols',
			array_merge( wp_kses_allowed_html( 'post' ), self::astra_addon_svg_kses_protocols() )
		);
	}

	/**
	 * Echo kses allowed 'post' kses protocols along with 'form' tag.
	 *
	 * @since 4.1.1
	 *
	 * @return array Return the array for allowed protocols.
	 */
	public static function astra_addon_form_with_post_kses_protocols() {
		return apply_filters(
			'astra_addon_form_post_kses_protocols',
			array_merge(
				array(
					'div'    => array(
						'class'  => array(),
						'id'     => array(),
						'style'  => array(),
						'data-*' => true,
						'align'  => array(),
					),
					'form'   => array(
						'class'          => array(),
						'id'             => array(),
						'action'         => array(),
						'role'           => array(),
						'data-*'         => true,
						'accept'         => array(),
						'accept-charset' => array(),
						'enctype'        => array(),
						'method'         => array(),
						'name'           => array(),
						'target'         => array(),
					),
					'label'  => array(
						'class' => array(),
						'for'   => array(),
					),
					'input'  => array(
						'class'        => array(),
						'placeholder'  => array(),
						'data-*'       => true,
						'type'         => array(),
						'role'         => array(),
						'value'        => array(),
						'name'         => array(),
						'autocomplete' => array(),
					),
					'button' => array(
						'class'      => array(),
						'data-*'     => true,
						'aria-label' => array(),
						'value'      => array(),
						'type'       => array(),
					),
				),
				self::astra_addon_svg_kses_protocols()
			)
		);
	}
}
