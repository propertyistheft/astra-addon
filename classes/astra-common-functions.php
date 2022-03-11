<?php
/**
 * Astra Theme & Addon Common function.
 *
 * @package Astra Addon
 */

/**
 * Apply CSS for the element
 */
if ( ! function_exists( 'astra_color_responsive_css' ) ) {

	/**
	 * Astra Responsive Colors
	 *
	 * @param  array  $setting      Responsive colors.
	 * @param  string $css_property CSS property.
	 * @param  string $selector     CSS selector.
	 * @return string               Dynamic responsive CSS.
	 */
	function astra_color_responsive_css( $setting, $css_property, $selector ) { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound
		$css = '';
		if ( isset( $setting['desktop'] ) && ! empty( $setting['desktop'] ) ) {
			$css .= $selector . '{' . $css_property . ':' . esc_attr( $setting['desktop'] ) . ';}';
		}
		if ( isset( $setting['tablet'] ) && ! empty( $setting['tablet'] ) ) {
			$css .= '@media (max-width:' . astra_addon_get_tablet_breakpoint() . 'px) {' . $selector . '{' . $css_property . ':' . esc_attr( $setting['tablet'] ) . ';} }';
		}
		if ( isset( $setting['mobile'] ) && ! empty( $setting['mobile'] ) ) {
			$css .= '@media (max-width:' . astra_addon_get_mobile_breakpoint() . 'px) {' . $selector . '{' . $css_property . ':' . esc_attr( $setting['mobile'] ) . ';} }';
		}
		return $css;
	}
}

/**
 * Get Font Size value
 */
if ( ! function_exists( 'astra_responsive_font' ) ) {

	/**
	 * Get Font CSS value
	 *
	 * @param  array  $font    CSS value.
	 * @param  string $device  CSS device.
	 * @param  string $default Default value.
	 * @return mixed
	 */
	function astra_responsive_font( $font, $device = 'desktop', $default = '' ) { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound
		$css_val = '';

		if ( isset( $font[ $device ] ) && isset( $font[ $device . '-unit' ] ) ) {
			if ( '' != $default ) {
				$font_size = astra_get_css_value( $font[ $device ], $font[ $device . '-unit' ], $default );
			} else {
				$font_size = astra_get_font_css_value( $font[ $device ], $font[ $device . '-unit' ] );
			}
		} elseif ( is_numeric( $font ) ) {
			$font_size = astra_get_css_value( $font );
		} else {
			$font_size = ( ! is_array( $font ) ) ? $font : '';
		}

		return $font_size;
	}
}

if ( function_exists( 'astra_do_action_deprecated' ) ) {

	// Depreciating astra_woo_qv_product_summary filter.
	add_action( 'astra_woo_quick_view_product_summary', 'astra_addon_deprecated_astra_woo_quick_view_product_summary_action', 10 );

	/**
	 * Astra Color Palettes
	 *
	 * @since 1.1.2
	 */
	function astra_addon_deprecated_astra_woo_quick_view_product_summary_action() {

		astra_do_action_deprecated( 'astra_woo_qv_product_summary', array(), '1.0.22', 'astra_woo_quick_view_product_summary', '' );
	}
}

/**
 * Get Responsive Spacing
 */
if ( ! function_exists( 'astra_responsive_spacing' ) ) {

	/**
	 * Get Spacing value
	 *
	 * @param  array  $option    CSS value.
	 * @param  string $side  top | bottom | left | right.
	 * @param  string $device  CSS device.
	 * @param  string $default Default value.
	 * @param  string $prefix Prefix value.
	 * @return mixed
	 */
	function astra_responsive_spacing( $option, $side = '', $device = 'desktop', $default = '', $prefix = '' ) { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound

		if ( isset( $option[ $device ][ $side ] ) && isset( $option[ $device . '-unit' ] ) ) {
			$spacing = astra_get_css_value( $option[ $device ][ $side ], $option[ $device . '-unit' ], $default );
		} elseif ( is_numeric( $option ) ) {
			$spacing = astra_get_css_value( $option );
		} else {
			$spacing = ( ! is_array( $option ) ) ? $option : '';
		}

		if ( '' !== $prefix && '' !== $spacing ) {
			return $prefix . $spacing;
		}
		return $spacing;
	}
}

/**
 * Get calc Responsive Spacing
 */
if ( ! function_exists( 'astra_calc_spacing' ) ) {

	/**
	 * Get Spacing value
	 *
	 * @param  array  $value        Responsive spacing value with unit.
	 * @param  string $operation    + | - | * | /.
	 * @param  string $from         Perform operation from the value.
	 * @param  string $from_unit    Perform operation from the value of unit.
	 * @return mixed
	 */
	function astra_calc_spacing( $value, $operation = '', $from = '', $from_unit = '' ) { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound

		$css = '';
		if ( ! empty( $value ) ) {
			$css = $value;
			if ( ! empty( $operation ) && ! empty( $from ) ) {
				if ( ! empty( $from_unit ) ) {
					$css = 'calc( ' . $value . ' ' . $operation . ' ' . $from . $from_unit . ' )';
				}
				if ( '*' === $operation || '/' === $operation ) {
					$css = 'calc( ' . $value . ' ' . $operation . ' ' . $from . ' )';
				}
			}
		}

		return $css;
	}
}

/**
 * Adjust the background obj.
 */
if ( ! function_exists( 'astra_get_background_obj' ) ) {

	/**
	 * Adjust Brightness
	 *
	 * @param  array $bg_obj   Color code in HEX.
	 *
	 * @return array         Color code in HEX.
	 */
	function astra_get_background_obj( $bg_obj ) { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound

		$gen_bg_css = array();

		$bg_img   = isset( $bg_obj['background-image'] ) ? $bg_obj['background-image'] : '';
		$bg_color = isset( $bg_obj['background-color'] ) ? $bg_obj['background-color'] : '';
		$bg_type  = isset( $bg_obj['background-type'] ) ? $bg_obj['background-type'] : '';

		if ( '' !== $bg_type ) {
			switch ( $bg_type ) {
				case 'color':
					if ( '' !== $bg_img && '' !== $bg_color ) {
						$gen_bg_css['background-image'] = 'linear-gradient(to right, ' . $bg_color . ', ' . $bg_color . '), url(' . $bg_img . ');';
					} elseif ( '' === $bg_img ) {
						$gen_bg_css['background-color'] = $bg_color . ';';
					}
					break;

				case 'image':
					if ( '' !== $bg_img && '' !== $bg_color && ( ! is_numeric( strpos( $bg_color, 'linear-gradient' ) ) && ! is_numeric( strpos( $bg_color, 'radial-gradient' ) ) ) ) {
						$gen_bg_css['background-image'] = 'linear-gradient(to right, ' . $bg_color . ', ' . $bg_color . '), url(' . $bg_img . ');';
					}
					if ( '' === $bg_color || is_numeric( strpos( $bg_color, 'linear-gradient' ) ) || is_numeric( strpos( $bg_color, 'radial-gradient' ) ) && '' !== $bg_img ) {
						$gen_bg_css['background-image'] = 'url(' . $bg_img . ');';
					}
					break;

				case 'gradient':
					if ( isset( $bg_color ) ) {
						$gen_bg_css['background-image'] = $bg_color . ';';
					}
					break;

				default:
					break;
			}
		} elseif ( '' !== $bg_color ) {
			$gen_bg_css['background-color'] = $bg_color . ';';
		}

		if ( '' !== $bg_img ) {
			if ( isset( $bg_obj['background-repeat'] ) ) {
				$gen_bg_css['background-repeat'] = esc_attr( $bg_obj['background-repeat'] );
			}

			if ( isset( $bg_obj['background-position'] ) ) {
				$gen_bg_css['background-position'] = esc_attr( $bg_obj['background-position'] );
			}

			if ( isset( $bg_obj['background-size'] ) ) {
				$gen_bg_css['background-size'] = esc_attr( $bg_obj['background-size'] );
			}

			if ( isset( $bg_obj['background-attachment'] ) ) {
				$gen_bg_css['background-attachment'] = esc_attr( $bg_obj['background-attachment'] );
			}
		}

		return $gen_bg_css;
	}
}

/**
 * Adjust the background obj.
 */
if ( ! function_exists( 'astra_get_responsive_background_obj' ) ) {

	/**
	 * Add Responsive bacground CSS
	 *
	 * @param  array $bg_obj_res   Color array.
	 * @param  array $device       Device name.
	 *
	 * @return array         Color code in HEX.
	 */
	function astra_get_responsive_background_obj( $bg_obj_res, $device ) { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound

		$gen_bg_css = array();

		if ( ! is_array( $bg_obj_res ) ) {
			return;
		}

		$bg_obj = $bg_obj_res[ $device ];

		$bg_img      = isset( $bg_obj['background-image'] ) ? $bg_obj['background-image'] : '';
		$bg_tab_img  = isset( $bg_obj_res['tablet']['background-image'] ) ? $bg_obj_res['tablet']['background-image'] : '';
		$bg_desk_img = isset( $bg_obj_res['desktop']['background-image'] ) ? $bg_obj_res['desktop']['background-image'] : '';
		$bg_color    = isset( $bg_obj['background-color'] ) ? $bg_obj['background-color'] : '';
		$tablet_css  = ( isset( $bg_obj_res['tablet']['background-image'] ) && $bg_obj_res['tablet']['background-image'] ) ? true : false;
		$desktop_css = ( isset( $bg_obj_res['desktop']['background-image'] ) && $bg_obj_res['desktop']['background-image'] ) ? true : false;

		$bg_type = ( isset( $bg_obj['background-type'] ) && $bg_obj['background-type'] ) ? $bg_obj['background-type'] : '';

		if ( '' !== $bg_type ) {
			switch ( $bg_type ) {
				case 'color':
					if ( '' !== $bg_img && '' !== $bg_color ) {
						$gen_bg_css['background-image'] = 'linear-gradient(to right, ' . $bg_color . ', ' . $bg_color . '), url(' . $bg_img . ');';
					} elseif ( 'mobile' === $device ) {
						if ( $desktop_css ) {
							$gen_bg_css['background-image'] = 'linear-gradient(to right, ' . $bg_color . ', ' . $bg_color . '), url(' . $bg_desk_img . ');';
						} elseif ( $tablet_css ) {
							$gen_bg_css['background-image'] = 'linear-gradient(to right, ' . $bg_color . ', ' . $bg_color . '), url(' . $bg_tab_img . ');';
						} else {
							$gen_bg_css['background-color'] = $bg_color . ';';
							$gen_bg_css['background-image'] = 'none;';
						}
					} elseif ( 'tablet' === $device ) {
						if ( $desktop_css ) {
							$gen_bg_css['background-image'] = 'linear-gradient(to right, ' . $bg_color . ', ' . $bg_color . '), url(' . $bg_desk_img . ');';
						} else {
							$gen_bg_css['background-color'] = $bg_color . ';';
							$gen_bg_css['background-image'] = 'none;';
						}
					} elseif ( '' === $bg_img ) {
						$gen_bg_css['background-color'] = $bg_color . ';';
						$gen_bg_css['background-image'] = 'none;';
					}
					break;

				case 'image':
					if ( '' !== $bg_img && '' !== $bg_color && ( ! is_numeric( strpos( $bg_color, 'linear-gradient' ) ) && ! is_numeric( strpos( $bg_color, 'radial-gradient' ) ) ) ) {
						$gen_bg_css['background-image'] = 'linear-gradient(to right, ' . $bg_color . ', ' . $bg_color . '), url(' . $bg_img . ');';
					}
					if ( '' === $bg_color || is_numeric( strpos( $bg_color, 'linear-gradient' ) ) || is_numeric( strpos( $bg_color, 'radial-gradient' ) ) && '' !== $bg_img ) {
						$gen_bg_css['background-image'] = 'url(' . $bg_img . ');';
					}
					break;

				case 'gradient':
					if ( isset( $bg_color ) ) {
						$gen_bg_css['background-image'] = $bg_color . ';';
					}
					break;

				default:
					break;
			}
		} elseif ( '' !== $bg_color ) {
			$gen_bg_css['background-color'] = $bg_color . ';';
		}

		if ( '' !== $bg_img ) {
			if ( isset( $bg_obj['background-repeat'] ) ) {
				$gen_bg_css['background-repeat'] = esc_attr( $bg_obj['background-repeat'] );
			}

			if ( isset( $bg_obj['background-position'] ) ) {
				$gen_bg_css['background-position'] = esc_attr( $bg_obj['background-position'] );
			}

			if ( isset( $bg_obj['background-size'] ) ) {
				$gen_bg_css['background-size'] = esc_attr( $bg_obj['background-size'] );
			}

			if ( isset( $bg_obj['background-attachment'] ) ) {
				$gen_bg_css['background-attachment'] = esc_attr( $bg_obj['background-attachment'] );
			}
		}

		return $gen_bg_css;
	}
}

/**
 * Search Form
 */
if ( ! function_exists( 'astra_addon_get_search_form' ) ) :
	/**
	 * Display search form.
	 *
	 * @param bool $echo Default to echo and not return the form.
	 * @return string|void String when $echo is false.
	 */
	function astra_addon_get_search_form( $echo = true ) {

		// get customizer placeholder field value.
		$astra_search_input_placeholder = isset( $args['input_placeholder'] ) ? $args['input_placeholder'] : astra_default_strings( 'string-search-input-placeholder', false );

		$form = '<form role="search" method="get" class="search-form" action="' . esc_url( home_url( '/' ) ) . '">
			<label>
				<span class="screen-reader-text">' . _x( 'Search for:', 'label', 'astra-addon' ) . '</span>
				<input type="search" class="search-field" placeholder="' . esc_html( $astra_search_input_placeholder ) . '" value="' . get_search_query() . '" name="s" />
			</label>
			<button type="submit" class="search-submit" value="' . esc_html__( 'Search', 'astra-addon' ) . '" aria-label= "' . esc_attr__( 'Search', 'astra-addon' ) . '"><i class="astra-search-icon"> ' . Astra_Icons::get_icons( 'search' ) . ' </i></button>
		</form>';

		/**
		 * Filters the HTML output of the search form.
		 *
		 * @param string $form The search form HTML output.
		 */
		$result = apply_filters( 'astra_get_search_form', $form ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound

		if ( null === $result ) {
			$result = $form;
		}

		if ( $echo ) {
			echo $result; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		} else {
			return $result;
		}
	}
endif;

/**
 * Get instance of WP_Filesystem.
 *
 * @since 2.6.4
 *
 * @return WP_Filesystem
 */
function astra_addon_filesystem() {
	return astra_addon_filesystem::instance();
}

/**
 * Check the WordPress version.
 *
 * @since  2.7.0
 * @param string $version   WordPress version to compare with the current version.
 * @param string $compare   Comparison value i.e > or < etc.
 * @return bool            True/False based on the  $version and $compare value.
 */
function astra_addon_wp_version_compare( $version, $compare ) {
	return version_compare( get_bloginfo( 'version' ), $version, $compare );
}

/**
 * Adjust Brightness
 *
 * @param  array $bg_obj   Color code in HEX.
 *
 * @return array         Color code in HEX.
 *
 * @since 2.7.1
 */
function astra_addon_get_megamenu_background_obj( $bg_obj ) {

	$gen_bg_css = array();

	$bg_img   = isset( $bg_obj['background-image'] ) ? $bg_obj['background-image'] : '';
	$bg_color = isset( $bg_obj['background-color'] ) ? $bg_obj['background-color'] : '';

	if ( '' !== $bg_img && '' !== $bg_color ) {
		$gen_bg_css = array(
			'background-image' => 'linear-gradient(to right, ' . esc_attr( $bg_color ) . ', ' . esc_attr( $bg_color ) . '), url(' . esc_url( $bg_img ) . ')',
		);
	} elseif ( '' !== $bg_img ) {
		$gen_bg_css = array( 'background-image' => 'url(' . esc_url( $bg_img ) . ')' );
	} elseif ( '' !== $bg_color ) {
		$gen_bg_css = array( 'background-color' => esc_attr( $bg_color ) );
	}

	if ( '' !== $bg_img ) {
		if ( isset( $bg_obj['background-repeat'] ) ) {
			$gen_bg_css['background-repeat'] = esc_attr( $bg_obj['background-repeat'] );
		}

		if ( isset( $bg_obj['background-position'] ) ) {
			$gen_bg_css['background-position'] = esc_attr( $bg_obj['background-position'] );
		}

		if ( isset( $bg_obj['background-size'] ) ) {
			$gen_bg_css['background-size'] = esc_attr( $bg_obj['background-size'] );
		}

		if ( isset( $bg_obj['background-attachment'] ) ) {
			$gen_bg_css['background-attachment'] = esc_attr( $bg_obj['background-attachment'] );
		}
	}

	return $gen_bg_css;
}

/**
 * Calculate Astra Mega-menu spacing.
 *
 * @param  array $spacing_obj - Spacing dimensions with their values.
 *
 * @return array parsed CSS.
 *
 * @since 3.0.0
 */
function astra_addon_get_megamenu_spacing_css( $spacing_obj ) {

	$gen_spacing_css = array();

	foreach ( $spacing_obj as $property => $value ) {

		if ( '' == $value && 0 !== $value ) {
			continue;
		}

		$gen_spacing_css[ $property ] = esc_attr( $spacing_obj[ $property ] ) . 'px';
	}

	return $gen_spacing_css;
}

/**
 * Check the Astra 3.5.0 version is using or not.
 * As this is major update and frequently we used version_compare, added a function for this for easy maintenance.
 *
 * @since  3.5.0
 */
function astra_addon_check_theme_3_5_0_version() {
	return version_compare( ASTRA_THEME_VERSION, '3.5.0', '<' );
}
