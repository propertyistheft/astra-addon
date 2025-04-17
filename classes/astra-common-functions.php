<?php
/**
 * Astra Theme & Addon Common function.
 *
 * @package Astra Addon
 */

/**
 * Return theme options from astra-settings option key.
 *
 * This function exists in theme v4.8.9 though included here to prevent errors caused by version mismatches with the theme.
 */
if ( ! function_exists( 'astra_get_options' ) ) {

	/**
	 * Retrieve Astra theme options array.
	 *
	 * @return array The theme options array.
	 *
	 * @since 4.8.9
	 */
	function astra_get_options() {
		// Ensure we're not interfering during WordPress installation.
		if ( wp_installing() ) {
			return array();
		}

		/**
		 * Filter to bypass the cached Astra options.
		 *
		 * Example usage:
		 *     add_filter( 'astra_get_options_nocache', '__return_true' );
		 *
		 * @since 4.8.9
		 * @return bool Whether to bypass the cache. Default is false.
		 */
		if ( apply_filters( 'astra_get_options_nocache', false ) ) {
			$astra_options = get_option( ASTRA_THEME_SETTINGS, array() );
		} else {
			// Use a static variable to cache the options for this request.
			static $cached_astra_options = null;

			// Fetch the options once and cache them in the static variable.
			if ( is_null( $cached_astra_options ) || is_customize_preview() ) {
				$cached_astra_options = is_callable( 'Astra_Theme_Options::get_astra_options' )
					? Astra_Theme_Options::get_astra_options() :
					get_option( ASTRA_THEME_SETTINGS );
			}

			$astra_options = $cached_astra_options;
		}

		/**
		 * Filter the options array for Astra Settings.
		 *
		 * @since 4.8.9
		 * @return array The theme options array.
		 */
		return apply_filters( 'astra_get_options', $astra_options );
	}
}

/**
 * Return translated theme option.
 *
 * This function exists in theme v.4.7.4 though included here to prevent errors caused by version mismatches with the theme.
 */
if ( ! function_exists( 'astra_get_i18n_option' ) ) {

	/**
	 * Returns translated string for strings saved in Astra settings.
	 *
	 * This function retrieves a theme option value and checks if it needs translation.
	 * If the option's translation is needed, it looks it up based on the provided context.
	 * If the translation is not available, it returns the default value.
	 *
	 * Usage examples:
	 * - Retrieve translated theme option with a context description:
	 *      $value = astra_get_i18n_option( 'astra-option-key', esc_html_x( '%astra%', 'Context Description', 'astra-addon' ) );
	 *
	 * - Retrieve translated theme option with a different context:
	 *      $value = astra_get_i18n_option( 'astra-option-key', _x( '%astra%', 'Context Description', 'astra-addon' ) );
	 *
	 * @param  string $option       Option key.
	 * @param  string $translated   Default translation flag.
	 * @param  mixed  $default      Option default value.
	 * @param  string $deprecated   Option default value.
	 *
	 * @return string Return option value.
	 *
	 * @since 4.8.1
	 */
	function astra_get_i18n_option( $option, $translated, $default = '', $deprecated = '' ) {
		// #%astra%# is for TranslatePress compatibility.
		$is_translated = '%astra%' !== $translated && ! strpos( $translated, '#%astra%#' );
		return $is_translated ? $translated : astra_get_option( $option, $default, $deprecated );
	}
}

/**
 * Return translated string.
 *
 * This function exists in theme v.4.7.4 though included here to prevent errors caused by version mismatches with the theme.
 */
if ( ! function_exists( 'astra_get_i18n_string' ) ) {

	/**
	 * Returns translated string.
	 *
	 * This function checks if string has translation.
	 * If the translation is not available, it returns the default value.
	 *
	 * Usage examples:
	 * - Retrieve translated theme option with a context description:
	 *      $value = astra_get_i18n_string( $default, esc_html_x( '%astra%', 'Context Description', 'astra-addon' ) );
	 *
	 * - Retrieve translated theme option with a different context:
	 *      $value = astra_get_i18n_string( $default, _x( '%astra%', 'Context Description', 'astra-addon' ) );
	 *
	 * @param  string $default      Default string value.
	 * @param  string $translated   Default translation flag.
	 *
	 * @return string Return string value.
	 *
	 * @since 4.8.1
	 */
	function astra_get_i18n_string( $default, $translated ) {
		// #%astra%# is for TranslatePress compatibility.
		$is_translated = '%astra%' !== $translated && ! strpos( $translated, '#%astra%#' );
		return $is_translated ? $translated : $default;
	}
}

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

		if ( isset( $font[ $device ] ) && isset( $font[ $device . '-unit' ] ) ) {
			if ( '' != $default ) {
				$font_size = astra_get_css_value( $font[ $device ], $font[ $device . '-unit' ], $default );
			} else {
				$font_size = astra_get_font_css_value( $font[ $device ], $font[ $device . '-unit' ] );
			}
		} elseif ( is_numeric( $font ) ) {
			$font_size = astra_get_css_value( $font );
		} else {
			$font_size = ! is_array( $font ) ? $font : '';
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
			$spacing = ! is_array( $option ) ? $option : '';
		}

		if ( '' !== $prefix && '' !== $spacing ) {
			return $prefix . $spacing;
		}
		return $spacing;
	}
}

/**
 * Check Elementor widgets.
 */
if ( ! function_exists( 'astra_check_elementor_widget' ) ) {

	/**
	 * Added Check if the cart widget exists in the Elementor meta data.
	 *
	 * @since 4.8.2
	 * @param array  $elements_data
	 * @param string $widget_name
	 * @return bool
	 */
	function astra_check_elementor_widget( $elements_data, $widget_name ) {
		foreach ( $elements_data as $element ) {
			if ( isset( $element['widgetType'] ) && $element['widgetType'] === $widget_name ) {
				return true;
			}
			if ( isset( $element['elements'] ) && is_array( $element['elements'] ) ) {
				if ( astra_check_elementor_widget( $element['elements'], $widget_name ) ) {
					return true;
				}
			}
		}
		return false;
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
					$overlay_type  = isset( $bg_obj['overlay-type'] ) ? $bg_obj['overlay-type'] : 'none';
					$overlay_color = isset( $bg_obj['overlay-color'] ) ? $bg_obj['overlay-color'] : '';
					$overlay_grad  = isset( $bg_obj['overlay-gradient'] ) ? $bg_obj['overlay-gradient'] : '';
					if ( '' !== $bg_img ) {
						if ( 'none' !== $overlay_type ) {
							if ( 'classic' === $overlay_type && '' !== $overlay_color ) {
								$gen_bg_css['background-image'] = 'linear-gradient(to right, ' . $overlay_color . ', ' . $overlay_color . '), url(' . $bg_img . ');';
							} elseif ( 'gradient' === $overlay_type && '' !== $overlay_grad ) {
								$gen_bg_css['background-image'] = $overlay_grad . ', url(' . $bg_img . ');';
							} else {
								$gen_bg_css['background-image'] = 'url(' . $bg_img . ');';
							}
						} else {
							$gen_bg_css['background-image'] = 'url(' . $bg_img . ');';
						}
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
		$tablet_css  = isset( $bg_obj_res['tablet']['background-image'] ) && $bg_obj_res['tablet']['background-image'] ? true : false;
		$desktop_css = isset( $bg_obj_res['desktop']['background-image'] ) && $bg_obj_res['desktop']['background-image'] ? true : false;

		$bg_type = isset( $bg_obj['background-type'] ) && $bg_obj['background-type'] ? $bg_obj['background-type'] : '';

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
					/** @psalm-suppress PossiblyUndefinedStringArrayOffset */ // phpcs:ignore Generic.Commenting.DocComment.MissingShort
					$overlay_type = isset( $bg_obj['overlay-type'] ) ? $bg_obj['overlay-type'] : 'none';
					/** @psalm-suppress PossiblyUndefinedStringArrayOffset */ // phpcs:ignore Generic.Commenting.DocComment.MissingShort
					$overlay_color = isset( $bg_obj['overlay-color'] ) ? $bg_obj['overlay-color'] : '';
					/** @psalm-suppress PossiblyUndefinedStringArrayOffset */ // phpcs:ignore Generic.Commenting.DocComment.MissingShort
					$overlay_grad = isset( $bg_obj['overlay-gradient'] ) ? $bg_obj['overlay-gradient'] : '';
					/** @psalm-suppress PossiblyUndefinedStringArrayOffset */ // phpcs:ignore Generic.Commenting.DocComment.MissingShort

					if ( '' !== $bg_img ) {
						if ( 'none' !== $overlay_type ) {
							if ( 'classic' === $overlay_type && '' !== $overlay_color ) {
								$gen_bg_css['background-image'] = 'linear-gradient(to right, ' . $overlay_color . ', ' . $overlay_color . '), url(' . $bg_img . ');';
							} elseif ( 'gradient' === $overlay_type && '' !== $overlay_grad ) {
								$gen_bg_css['background-image'] = $overlay_grad . ', url(' . $bg_img . ');';
							} else {
								$gen_bg_css['background-image'] = 'url(' . $bg_img . ');';
							}
						} else {
							$gen_bg_css['background-image'] = 'url(' . $bg_img . ');';
						}
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
if ( ! function_exists( 'astra_addon_get_search_form' ) ) {
	/**
	 * Display search form.
	 *
	 * @param bool $echo Default to echo and not return the form.
	 * @return string|void String when $echo is false.
	 */
	function astra_addon_get_search_form( $echo = true ) {

		// Check if live search is enabled & accordingly disabling browser search suggestion.
		$live_search       = astra_get_option( 'live-search' );
		$autocomplete_attr = $live_search ? 'autocomplete="off"' : '';

		// get customizer placeholder field value.
		$astra_search_input_placeholder = isset( $args['input_placeholder'] ) ? $args['input_placeholder'] : astra_default_strings( 'string-search-input-placeholder', false );

		$form = '<form role="search" method="get" class="search-form" action="' . esc_url( home_url( '/' ) ) . '">
			<label>
				<span class="screen-reader-text">' . _x( 'Search for:', 'label', 'astra-addon' ) . '</span>
				<input type="search" class="search-field" placeholder="' . esc_attr( $astra_search_input_placeholder ) . '" value="' . get_search_query() . '" name="s" ' . $autocomplete_attr . ' />
			</label>
			<button type="submit" class="search-submit normal-search" value="' . esc_attr__( 'Search', 'astra-addon' ) . '" aria-label= "' . esc_attr__( 'Search', 'astra-addon' ) . '"><i class="astra-search-icon"> ' . Astra_Ext_Adv_Search_Markup::search_icon() . ' </i></button>
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
			echo wp_kses( $result, Astra_Addon_Kses::astra_addon_form_with_post_kses_protocols() );
		} else {
			return $result;
		}
	}
}

/**
 * Icon Selector SVG.
 */
if ( ! function_exists( 'astra_icon_selector_svg' ) ) {
	/**
	 * Renders an SVG icon for SVG Icon Selector Control.
	 *
	 * @param array  $icon    The icon to be rendered. Contains type and value keys.
	 * @param bool   $echo    Whether to echo the SVG markup directly or return it.
	 * @param string $default The default icon to use if no icon is provided.
	 *
	 * @return string|null The SVG icon markup or null if SVG icons are not enabled or no icon is provided.
	 * @since 4.10.0
	 */
	function astra_icon_selector_svg( $icon, $echo = false, $default = '' ) {
		// Bail early if SVG icons are not enabled.
		if ( ! Astra_Icons::is_svg_icons() || ! $icon ) {
			return $echo ? null : '';
		}

		$svg     = '';
		$classes = array( 'ast-icon' );

		if ( isset( $icon['type'], $icon['value'] ) ) {
			$type  = $icon['type'];
			$value = $icon['value'];

			if ( $type === 'custom' ) {
				$svg       = do_shortcode( $value );
				$classes[] = 'icon-' . $type;
			} elseif ( $type !== 'none' && is_callable( 'Astra_Builder_UI_Controller::fetch_svg_icon' ) ) {
				$svg       = Astra_Builder_UI_Controller::fetch_svg_icon( $value );
				$classes[] = 'icon-' . $value;
			}
		}

		if ( ! $svg && $default && is_callable( 'Astra_Builder_UI_Controller::fetch_svg_icon' ) ) {
			$svg = Astra_Builder_UI_Controller::fetch_svg_icon( $default );
		}

		if ( $svg ) {
			$svg = sprintf(
				'<span class="%1$s">%2$s</span>',
				implode( ' ', $classes ),
				$svg
			);
		}

		if ( $echo !== true ) {
			return wp_kses( $svg, Astra_Addon_Kses::astra_addon_svg_kses_protocols() );
		}
		
		echo wp_kses( $svg, Astra_Addon_Kses::astra_addon_svg_kses_protocols() );
	}
}

/**
 * Global color palette names.
 */
if ( ! function_exists( 'astra_get_palette_names' ) ) {
	/**
	 * Function to get global color palette names.
	 *
	 * @return array color palette names.
	 * @since 4.10.0
	 */
	function astra_get_palette_names() {
		$color_palette_reorganize = is_callable( 'Astra_Dynamic_CSS::astra_4_8_9_compatibility' ) && Astra_Dynamic_CSS::astra_4_8_9_compatibility();
		$default_palette_names    = array(
			'palette_1' => 'Default',
			'palette_2' => $color_palette_reorganize ? 'Oak' : 'Style 2',
			'palette_3' => $color_palette_reorganize ? 'Lavender' : 'Style 3',
			'palette_4' => 'Dark',
		);

		$color_palettes = get_option( 'astra-color-palettes', array() );

		$palette_names = $default_palette_names;
		if ( isset( $color_palettes['presetNames'] ) ) {
			$palette_names = $color_palettes['presetNames'];

			// Ensure all 4 palette names exist, use default if empty.
			foreach ( $default_palette_names as $key => $default_name ) {
				if ( empty( $palette_names[ $key ] ) ) {
					$palette_names[ $key ] = $default_name;
				}
			}
		}

		/**
		 * Filter the color palette names before returning them.
		 *
		 * @param array $palette_names The array of color palette names.
		 * @return array The filtered array of color palette names.
		 */
		return apply_filters( 'astra_get_palette_names', $palette_names );
	}
}

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
 * Check whether blogs post structure title & meta is disabled or not.
 *
 * @since 4.0.0
 * @return bool True if blogs post structure title & meta is disabled else false.
 */
function astra_addon_is_blog_title_meta_disabled() {
	$blog_title_meta = astra_get_option( 'blog-post-structure' );
	if ( is_array( $blog_title_meta ) && ! in_array( 'title-meta', $blog_title_meta ) ) {
		return true;
	}
	return false;
}

/**
 * Function which will return CSS for font-extras control.
 * It includes - line-height, letter-spacing, text-decoration, font-style.
 *
 * @param array  $config contains extra font settings.
 * @param string $setting basis on this setting will return.
 * @param mixed  $unit Unit.
 *
 * @since 4.0.0
 */
function astra_addon_get_font_extras( $config, $setting, $unit = false ) {
	$css = isset( $config[ $setting ] ) ? $config[ $setting ] : '';

	if ( $unit && $css ) {
		$unit_val = isset( $config[ $unit ] ) ? $config[ $unit ] : '';
		$unit_val = 'line-height-unit' === $unit ? apply_filters( 'astra_font_line_height_unit', $unit_val ) : $unit_val; // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound
		$css     .= $unit_val;
	}

	return $css;
}

/**
 * Function which will return CSS array for font specific props for further parsing CSS.
 * It includes - font-family, font-weight, font-size, line-height, text-transform, letter-spacing, text-decoration, color (optional).
 *
 * @param string $font_family Font family.
 * @param string $font_weight Font weight.
 * @param array  $font_size Font size.
 * @param string $font_extras contains all font controls.
 * @param string $color In most of cases color is also added, so included optional param here.
 *
 * @return array
 *
 * @since 4.0.0
 */
function astra_addon_get_font_array_css( $font_family, $font_weight, $font_size, $font_extras, $color = '' ) {
	$font_extras_ast_option = astra_get_option( $font_extras );
	return array(
		'color'           => esc_attr( $color ),
		'font-family'     => astra_get_css_value( $font_family, 'font' ),
		'font-weight'     => astra_get_css_value( $font_weight, 'font' ),
		'font-size'       => ! empty( $font_size ) ? astra_responsive_font( $font_size, 'desktop' ) : '',
		'line-height'     => astra_addon_get_font_extras( $font_extras_ast_option, 'line-height', 'line-height-unit' ),
		'text-transform'  => astra_addon_get_font_extras( $font_extras_ast_option, 'text-transform' ),
		'letter-spacing'  => astra_addon_get_font_extras( $font_extras_ast_option, 'letter-spacing', 'letter-spacing-unit' ),
		'text-decoration' => astra_addon_get_font_extras( $font_extras_ast_option, 'text-decoration' ),
	);
}

/**
 * Checks reveal effect option for blog , WooCommerce and for custom post type.
 *
 * @param string $type - Type of condition.
 * @return bool
 *
 * @since 4.6.0
 */
function astra_addon_check_reveal_effect_condition( $type = '' ) {
	$supported_post_types    = class_exists( 'Astra_Posts_Structure_Loader' ) && is_callable( 'Astra_Posts_Structure_Loader::get_supported_post_types' ) ? Astra_Posts_Structure_Loader::get_supported_post_types() : array( 'post' );
	$post_type               = strval( get_post_type() );
	$blog_layout             = astra_addon_get_blog_layout();
	$blog_list_layout        = ( 'blog-layout-2' === $blog_layout || 'blog-layout-3' === $blog_layout || 'blog-layout-5' === $blog_layout );
	$woo_reveal_condition    = ( function_exists( 'is_woocommerce' ) && is_woocommerce() && ( is_shop() || is_product_taxonomy() ) && astra_get_option( 'shop-reveal-effect' ) );
	$blog_reveal_condition   = ( ( ( is_front_page() && 'posts' === get_option( 'show_on_front' ) ) || is_category() || is_tag() || is_home() ) && astra_get_option( 'blog-reveal-effect' ) && ( $blog_list_layout || ! astra_get_option( 'blog-masonry' ) ) );
	$search_reveal_condition = ( is_search() && astra_get_option( 'blog-reveal-effect' ) );
	$custom_post_reveal      = in_array( $post_type, $supported_post_types ) && astra_get_option( 'archive-' . $post_type . '-ast-reveal-effect', false );
	$condition               = '';

	if ( '' === $type || 'all' === $type ) {
		$condition = $woo_reveal_condition || $blog_reveal_condition || $search_reveal_condition || $custom_post_reveal;
	}

	if ( 'blog' === $type ) {
		$condition = $blog_reveal_condition || $search_reveal_condition;
	}

	if ( 'woocommerce' === $type ) {
		$condition = $woo_reveal_condition;
	}

	if ( 'cpt' === $type ) {
		$condition = $custom_post_reveal;
	}

	return $condition;
}

/**
 * Check Astra with modern blog setup.
 *
 * @since 4.6.0
 */
function astra_addon_4_6_0_compatibility() {
	return is_callable( 'Astra_Dynamic_CSS::astra_4_6_0_compatibility' ) ? Astra_Dynamic_CSS::astra_4_6_0_compatibility() : false;
}

/**
 * Determines if the specified palette key corresponds to a dark palette.
 *
 * @param string $palette_key The key of the palette to check. Defaults to 'current' which indicates the current global palette.
 *
 * @since 4.10.0
 * @return bool Returns true if the palette key is associated with a dark palette, false otherwise.
 */
function astra_addon_is_dark_palette( $palette_key = 'current' ) {
	if ( $palette_key === 'current' ) {
		// Check if the 'is_dark_palette' method exists and use it to determine if the current palette is dark.
		if ( method_exists( 'Astra_Global_Palette', 'is_dark_palette' ) ) {
			return Astra_Global_Palette::is_dark_palette();
		}

		// If the 'is_dark_palette' method does not exist, try to get the active global palette key.
		if ( method_exists( 'Astra_Global_Palette', 'astra_get_active_global_palette' ) ) {
			$palette_key = Astra_Global_Palette::astra_get_active_global_palette();
		}
	}

	return $palette_key === 'palette_4';
}
