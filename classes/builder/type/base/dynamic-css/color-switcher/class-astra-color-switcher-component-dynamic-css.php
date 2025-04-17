<?php
/**
 * Astra Color Switcher Component Dynamic CSS.
 *
 * @package     astra-builder
 * @link        https://wpastra.com/
 * @since       4.10.0
 */

// No direct access, please.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Bail if Customizer divider dynamic CSS class is already present.
if ( class_exists( 'Astra_Color_Switcher_Component_Dynamic_CSS' ) ) {
	return;
}

/**
 * Register Builder Dynamic CSS.
 *
 * @since 4.10.0
 */
class Astra_Color_Switcher_Component_Dynamic_CSS {

	/**
	 * Dynamic CSS
	 *
	 * @param string $builder_type Builder Type.
	 * @return String Generated dynamic CSS for Color Switcher.
	 *
	 * @since 4.10.0
	 */
	public static function astra_color_switcher_dynamic_css( $builder_type = 'header' ) {
		$generated_css = '';

		// Options.
		$icon_size        = astra_get_option( 'color-switcher-icon-size' );
		$visibility       = astra_get_option( 'color-switcher-visibility' );
		$icon_color       = astra_get_option( 'color-switcher-icon-color' );
		$background       = astra_get_option( 'color-switcher-background' );
		$background_hover = astra_get_option( 'color-switcher-background-hover' );
		$border_radius    = astra_get_option( 'color-switcher-radius' );
		$margin           = astra_get_option( 'color-switcher-margin' );
		$padding          = astra_get_option( 'color-switcher-padding' );

		// Transparent Header.
		$is_transparent_header = false;
		if ( is_callable( array( 'Astra_Ext_Transparent_Header_Markup', 'is_transparent_header' ) ) ) {
			$is_transparent_header = Astra_Ext_Transparent_Header_Markup::is_transparent_header();
			if ( $is_transparent_header ) {
				$transparent_icon_color       = astra_get_option( 'transparent-color-switcher-icon-color' );
				$transparent_background       = astra_get_option( 'transparent-color-switcher-background' );
				$transparent_background_hover = astra_get_option( 'transparent-color-switcher-background-hover' );
			}
		}

		// Sticky Header.
		$sticky_icon_color       = astra_get_option( 'sticky-color-switcher-icon-color' );
		$sticky_background       = astra_get_option( 'sticky-color-switcher-background' );
		$sticky_background_hover = astra_get_option( 'sticky-color-switcher-background-hover' );

		/**
		 * Dynamic CSS for Color Switcher.
		 */
		$css = array(
			/**
			 * Common CSS (applies to all devices).
			 */
			'common'  => array(
				'.ast-color-switcher-wrapper .ast-builder-color-switcher,
				.ast-color-switcher-wrapper .ast-builder-color-switcher .ast-icon' => array(
					'display' => 'flex',
				),
				'.ast-color-switcher-wrapper .ast-switcher-button' => array(
					'background'    => 'transparent',
					'padding'       => 0,
					'margin'        => 0,
					'border-radius' => 0,
					'color'         => 'var( --ast-global-color-3 )', // Text Color.
					'box-shadow'    => 'none',
					'transition'    => 'all .25s ease-in-out',
				),
				'.ast-color-switcher-wrapper .ast-switcher-button:focus-visible' => array(
					'outline-width' => '1px',
					'outline-style' => 'dotted',
				),
				'.ast-color-switcher-wrapper .ast-switcher-button .ast-switcher-icon' => array(
					'display'    => 'none',
				),
				'.ast-color-switcher-wrapper .ast-switcher-button .ast-switcher-icon.ast-current' => array(
					'display'     => 'flex',
					'align-items' => 'center',
					'gap'         => '4px',
				),
				'.ast-color-switcher-wrapper .ast-switcher-button.ast-animate .ast-icon' => array(
					'animation' => 'spin 2.5s linear',
				),
			),
			/**
			 * Device-Specific Overrides (initialized empty).
			 */
			'desktop' => array(),
			'tablet'  => array(),
			'mobile'  => array(),
		);

		/**
		 * Dynamically add Visibility, Icon Size, Spacing & Color for all devices.
		 */
		foreach ( [ 'desktop', 'tablet', 'mobile' ] as $device ) {
			$css[ $device ]['.ast-header-color-switcher-element'] = array(
				'display' => astra_get_prop( $visibility, $device ) !== 0 ? 'block' : 'none',
			);
			
			$css[ $device ]['.ast-color-switcher-wrapper svg'] = array(
				'width'  => astra_get_css_value( astra_get_prop( $icon_size, $device ) ),
				'height' => astra_get_css_value( astra_get_prop( $icon_size, $device ) ),
			);

			$css[ $device ]['.ast-color-switcher-wrapper .ast-switcher-button'] = array(
				'color'          => astra_get_prop( $icon_color, $device ),
				'background'     => astra_get_prop( $background, $device ),
				// Margin.
				'margin-top'     => astra_responsive_spacing( $margin, 'top', $device ),
				'margin-bottom'  => astra_responsive_spacing( $margin, 'bottom', $device ),
				'margin-left'    => astra_responsive_spacing( $margin, 'left', $device ),
				'margin-right'   => astra_responsive_spacing( $margin, 'right', $device ),
				// Padding.
				'padding-top'    => astra_responsive_spacing( $padding, 'top', $device ),
				'padding-bottom' => astra_responsive_spacing( $padding, 'bottom', $device ),
				'padding-left'   => astra_responsive_spacing( $padding, 'left', $device ),
				'padding-right'  => astra_responsive_spacing( $padding, 'right', $device ),
				// Border Radius.
				'border-top-left-radius'     => astra_responsive_spacing( $border_radius, 'top', $device ),
				'border-top-right-radius'    => astra_responsive_spacing( $border_radius, 'right', $device ),
				'border-bottom-right-radius' => astra_responsive_spacing( $border_radius, 'bottom', $device ),
				'border-bottom-left-radius'  => astra_responsive_spacing( $border_radius, 'left', $device ),
			);

			$css[ $device ]['.ast-color-switcher-wrapper .ast-switcher-button:hover'] = array(
				'background' => astra_get_prop( $background_hover, $device ),
			);

			// Transparent Header CSS.
			if ( $is_transparent_header ) {
				$css[ $device ]['.ast-theme-transparent-header .ast-color-switcher-wrapper .ast-switcher-button'] = array(
					'color'      => astra_get_prop( $transparent_icon_color, $device ),
					'background' => astra_get_prop( $transparent_background, $device ),
				);

				$css[ $device ]['.ast-theme-transparent-header .ast-color-switcher-wrapper .ast-switcher-button:hover'] = array(
					'background' => astra_get_prop( $transparent_background_hover, $device ),
				);
			}

			// Sticky Header CSS.
			$css[ $device ]['.ast-header-sticked .ast-color-switcher-wrapper .ast-switcher-button'] = array(
				'color'      => astra_get_prop( $sticky_icon_color, $device ),
				'background' => astra_get_prop( $sticky_background, $device ),
			);

			$css[ $device ]['.ast-header-sticked .ast-color-switcher-wrapper .ast-switcher-button:hover'] = array(
				'background' => astra_get_prop( $sticky_background_hover, $device ),
			);
		}

		/**
		 * Merge and generate final CSS
		 */
		$generated_css .= astra_parse_css( $css['common'] );
		$generated_css .= astra_parse_css( $css['desktop'] );
		$generated_css .= astra_parse_css( $css['tablet'], '', astra_addon_get_tablet_breakpoint() );
		$generated_css .= astra_parse_css( $css['mobile'], '', astra_addon_get_mobile_breakpoint() );

		return $generated_css;
	}
}

/**
 * Kicking this off by creating object of this class.
 */
new Astra_Color_Switcher_Component_Dynamic_CSS();
