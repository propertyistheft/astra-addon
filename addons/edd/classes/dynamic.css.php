<?php
/**
 * EDD - Dynamic CSS
 *
 * @package Astra Addon
 */

add_filter( 'astra_addon_dynamic_css', 'astra_edd_dynamic_css' );

/**
 * Dynamic CSS
 *
 * @param  string $dynamic_css          Astra Dynamic CSS.
 * @param  string $dynamic_css_filtered Astra Dynamic CSS Filters.
 * @return string
 */
function astra_edd_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' ) {

	$theme_color = astra_get_option( 'theme-color' );

	// Single Product Content Typo.
	$product_content_font_size = astra_get_option( 'font-size-edd-product-content' );
	$product_title_font_size   = astra_get_option( 'font-size-edd-product-title' );

	// Single Product Colors.
	$product_title_color      = astra_get_option( 'edd-single-product-title-color' );
	$product_content_color    = astra_get_option( 'edd-single-product-content-color' );
	$product_navigation_color = astra_get_option( 'edd-single-product-navigation-color' );

	// EDD archive Typo.
	$edd_archive_product_title_font_size   = astra_get_option( 'font-size-edd-archive-product-title' );
	$edd_archive_product_price_font_size   = astra_get_option( 'font-size-edd-archive-product-price' );
	$edd_archive_product_content_font_size = astra_get_option( 'font-size-edd-archive-product-content' );

	// EDD archive Colors.
	$edd_archive_product_title_color   = astra_get_option( 'edd-archive-product-title-color' );
	$edd_archive_product_price_color   = astra_get_option( 'edd-archive-product-price-color' );
	$edd_archive_product_content_color = astra_get_option( 'edd-archive-product-content-color' );

	$btn_v_padding = astra_get_option( 'edd-archive-button-v-padding' );
	$btn_h_padding = astra_get_option( 'edd-archive-button-h-padding' );

	$checkout_width        = astra_get_option( 'edd-checkout-content-width' );
	$checkout_custom_width = astra_get_option( 'edd-checkout-content-max-width' );

	$header_cart_icon_style    = astra_get_option( 'edd-header-cart-icon-style' );
	$header_cart_icon_color    = astra_get_option( 'edd-header-cart-icon-color', $theme_color );
	$header_cart_icon_radius   = astra_get_option( 'edd-header-cart-icon-radius' );
	$cart_h_color              = astra_get_foreground_color( $header_cart_icon_color );
	$cart_products_count_color = astra_get_option( 'edd-header-cart-product-count-color', astra_get_foreground_color( $theme_color ) );

	// Supporting color setting for default icon as well.
	$can_update_cart_color   = is_callable( 'astra_cart_color_default_icon_old_header' ) && astra_cart_color_default_icon_old_header();
	$header_cart_count_color = ( $can_update_cart_color ) ? $header_cart_icon_color : $theme_color;

	/**
	 * Set font sizes
	 */
	$css_output = array(

		'.ast-edd-archive-block-wrap .edd-add-to-cart, .ast-edd-archive-block-wrap .edd_go_to_checkout, .ast-edd-archive-block-wrap .ast-edd-variable-btn, .edd_downloads_list .edd-add-to-cart, .edd_downloads_list .edd_go_to_checkout, .edd_downloads_list .ast-edd-variable-btn' => array(
			'padding-top'    => astra_get_css_value( $btn_v_padding, 'px' ),
			'padding-bottom' => astra_get_css_value( $btn_v_padding, 'px' ),
			'padding-left'   => astra_get_css_value( $btn_h_padding, 'px' ),
			'padding-right'  => astra_get_css_value( $btn_h_padding, 'px' ),
		),

		'.ast-edd-site-header-cart .ast-addon-cart-wrap span.astra-icon:after' => array(
			'background' => $header_cart_count_color,
			'color'      => $cart_products_count_color,
		),

		'.single-download .entry-title'       => astra_addon_get_font_array_css( astra_get_option( 'font-family-edd-product-title' ), astra_get_option( 'font-weight-edd-product-title' ), $product_title_font_size, 'font-extras-edd-product-title', $product_title_color ),

		// Single Product Content.
		'.single-download .entry-content'     => astra_addon_get_font_array_css( astra_get_option( 'font-family-edd-product-content' ), astra_get_option( 'font-weight-edd-product-content' ), $product_content_font_size, 'font-extras-edd-product-content', $product_content_color ),

		'.ast-edd-archive-block-wrap .edd_download_title a, .edd_downloads_list .edd_download_title a' => astra_addon_get_font_array_css( astra_get_option( 'font-family-edd-archive-product-title' ), astra_get_option( 'font-weight-edd-archive-product-title' ), $edd_archive_product_title_font_size, 'font-extras-edd-archive-product-title', $edd_archive_product_title_color ),

		'.ast-edd-archive-block-wrap .edd_price, .edd_downloads_list .edd_price,.ast-edd-archive-block-wrap .edd_price_options, .edd_downloads_list .edd_price_options' => astra_addon_get_font_array_css( astra_get_option( 'font-family-edd-archive-product-price' ), astra_get_option( 'font-weight-edd-archive-product-price' ), $edd_archive_product_price_font_size, 'font-extras-edd-archive-product-price', $edd_archive_product_price_color ),

		'.single-download .post-navigation a' => array(
			'color' => esc_attr( $product_navigation_color ),
		),

		'.ast-edd-archive-block-wrap .edd_download_excerpt p, .edd_downloads_list .edd_download_excerpt p' => astra_addon_get_font_array_css( astra_get_option( 'font-family-edd-archive-product-content' ), astra_get_option( 'font-weight-edd-archive-product-content' ), $edd_archive_product_content_font_size, 'font-extras-edd-archive-product-content', $edd_archive_product_content_color ),
	);

	if ( false === astra_addon_builder_helper()->is_header_footer_builder_active && $can_update_cart_color && 'default' === astra_get_option( 'edd-header-cart-icon' ) ) {
		$css_output['.ast-edd-site-header-cart .ast-edd-cart-container, .ast-edd-site-header-cart a:focus, .ast-edd-site-header-cart a:hover'] = array(
			'color' => $header_cart_icon_color,
		);
	}

	/* Parse CSS from array() */
	$css_output = astra_parse_css( $css_output );

	if ( false === Astra_Icons::is_svg_icons() ) {
		$edd_shopping_cart_icon = array(
			'.ast-edd-site-header-cart span.astra-icon:before' => array(
				'font-family' => 'Astra',
			),
			'.ast-icon-shopping-cart:before'   => array(
				'content' => '"\f07a"',
			),
			'.ast-icon-shopping-bag:before'    => array(
				'content' => '"\f290"',
			),
			'.ast-icon-shopping-basket:before' => array(
				'content' => '"\f291"',
			),
		);

		/* Parse CSS from array() */
		$css_output .= astra_parse_css( $edd_shopping_cart_icon );
	}

	/**
	 * Header Cart color
	 */
	if ( 'none' !== $header_cart_icon_style ) {

		$header_cart_icon = array();

		if ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) {

			/**
			 * Header Cart Icon colors
			 */
			$header_cart_icon['.ast-builder-layout-element[data-section="section-hb-edd-cart"]'] = array(
				'padding'       => esc_attr( 0 ),
				'margin-left'   => esc_attr( '1em' ),
				'margin-right'  => esc_attr( '1em' ),
				'padding-left'  => esc_attr( '20px' ),
				'padding-right' => esc_attr( '20px' ),
				'margin'        => esc_attr( '0' ),
			);

			$header_cart_icon['.ast-builder-layout-element[data-section="section-hb-edd-cart"] .ast-addon-cart-wrap'] = array(
				'display' => esc_attr( 'inline-block' ),
				'padding' => esc_attr( '0 .6em' ),
			);

			// We adding this conditional CSS only to maintain backwards. Remove this condition after 2-3 updates of theme.
			if ( version_compare( ASTRA_THEME_VERSION, '3.4.3', '>=' ) ) {
				$add_background_outline_cart  = Astra_Addon_Update_Filter_Function::astra_add_bg_color_outline_cart_header_builder();
				$border_width                 = astra_get_option( 'edd-header-cart-border-width' );
				$trans_header_cart_icon_color = astra_get_option( 'transparent-header-edd-cart-icon-color', $theme_color );

				// Outline cart style border.
				$header_cart_icon['.ast-edd-menu-cart-outline .ast-addon-cart-wrap'] = array(
					'border-width' => astra_get_css_value( $border_width, 'px' ),
					'border-style' => 'solid',
					'border-color' => esc_attr( $header_cart_icon_color ),
				);

				// Transparent header outline cart style.
				$header_cart_icon['.ast-theme-transparent-header .ast-edd-menu-cart-outline .ast-addon-cart-wrap'] = array(
					'border-width' => astra_get_css_value( $border_width, 'px' ),
					'border-style' => 'solid',
					'border-color' => esc_attr( $trans_header_cart_icon_color ),
				);

				if ( $add_background_outline_cart ) {
					$header_cart_icon['.ast-edd-menu-cart-outline .ast-addon-cart-wrap'] = array(
						'border-width' => astra_get_css_value( $border_width, 'px' ),
						'border-style' => 'solid',
						'border-color' => esc_attr( $header_cart_icon_color ),
						'background'   => '#ffffff',
					);
				}
			}
		} else {

			/**
			 * Header Cart Icon colors
			 */
			$header_cart_icon = array(
				// Default icon colors.
				'.ast-edd-cart-menu-wrap .count, .ast-edd-cart-menu-wrap .count:after' => array(
					'border-color' => esc_attr( $header_cart_icon_color ),
					'color'        => esc_attr( $header_cart_icon_color ),
				),
				// Outline icon hover colors.
				'.ast-edd-cart-menu-wrap:hover .count' => array(
					'color'            => esc_attr( $cart_h_color ),
					'background-color' => esc_attr( $header_cart_icon_color ),
				),
				// Outline icon colors.
				'.ast-edd-menu-cart-outline .ast-addon-cart-wrap' => array(
					'background' => '#ffffff',
					'border'     => '1px solid ' . $header_cart_icon_color,
					'color'      => esc_attr( $header_cart_icon_color ),
				),
				// Fill icon Color.
				'.ast-edd-site-header-cart.ast-edd-menu-cart-fill .ast-edd-cart-menu-wrap .count,.ast-edd-menu-cart-fill .ast-addon-cart-wrap' => array(
					'background-color' => esc_attr( $header_cart_icon_color ),
					'color'            => esc_attr( $cart_h_color ),
				),

				// Border radius.
				'.ast-edd-site-header-cart.ast-edd-menu-cart-outline .ast-addon-cart-wrap, .ast-edd-site-header-cart.ast-edd-menu-cart-fill .ast-addon-cart-wrap' => array(
					'border-radius' => astra_get_css_value( $header_cart_icon_radius, 'px' ),
				),
			);

			// We adding this conditional CSS only to maintain backwards. Remove this condition after 2-3 updates of theme.
			if ( version_compare( ASTRA_THEME_VERSION, '3.4.3', '>=' ) ) {
				$border_width = astra_get_option( 'edd-header-cart-border-width' );

				// Outline icon colors.
				$header_cart_icon['.ast-edd-menu-cart-outline .ast-addon-cart-wrap'] = array(
					'background'   => '#ffffff',
					'border-width' => astra_get_css_value( $border_width, 'px' ),
					'border-style' => 'solid',
					'border-color' => esc_attr( $header_cart_icon_color ),
					'color'        => esc_attr( $header_cart_icon_color ),
				);
			}

			/**
			 * Header Cart Icon colors
			 */

			$header_cart_icon['li.ast-masthead-custom-menu-items.edd-custom-menu-item, .ast-masthead-custom-menu-items.edd-custom-menu-item'] = array(
				'padding' => esc_attr( 0 ),
			);
			$header_cart_icon['.ast-header-break-point li.ast-masthead-custom-menu-items.edd-custom-menu-item']                               = array(
				'padding-left'  => esc_attr( '20px' ),
				'padding-right' => esc_attr( '20px' ),
				'margin'        => esc_attr( '0' ),
			);
			$header_cart_icon['.ast-header-break-point .ast-masthead-custom-menu-items.edd-custom-menu-item']                                 = array(
				'margin-left'  => esc_attr( '1em' ),
				'margin-right' => esc_attr( '1em' ),
			);
			$header_cart_icon['.ast-header-break-point .ast-above-header-mobile-inline.mobile-header-order-2 .ast-masthead-custom-menu-items.edd-custom-menu-item'] = array(
				'margin-left' => esc_attr( '0' ),
			);
			$header_cart_icon['.ast-header-break-point li.ast-masthead-custom-menu-items.edd-custom-menu-item .ast-addon-cart-wrap']                                = array(
				'display' => esc_attr( 'inline-block' ),
			);

			$header_cart_icon['.edd-custom-menu-item .ast-addon-cart-wrap'] = array(
				'padding' => esc_attr( '0 .6em' ),
			);
		}

		$css_output .= astra_parse_css( $header_cart_icon );
	}

	/* Checkout Width */
	if ( 'custom' === $checkout_width ) :
			$checkout_css  = '@media (min-width:' . astra_addon_get_tablet_breakpoint( '', 1 ) . 'px) {';
			$checkout_css .= '.edd-checkout #edd_checkout_wrap {';
			$checkout_css .= 'max-width:' . esc_attr( $checkout_custom_width ) . 'px;';
			$checkout_css .= 'margin:' . esc_attr( '0 auto' ) . ';';
			$checkout_css .= '}';
			$checkout_css .= '}';
			$css_output   .= $checkout_css;
	endif;

	$tablet_css = array(

		'.single-download .entry-title'   => array(
			'font-size' => astra_responsive_font( $product_title_font_size, 'tablet' ),
		),
		// Single Product Content.
		'.single-download .entry-content' => array(
			'font-size' => astra_responsive_font( $product_content_font_size, 'tablet' ),
		),
		'.ast-edd-archive-block-wrap .edd_download_title a, .edd_downloads_list .edd_download_title a' => array(
			'font-size' => astra_responsive_font( $edd_archive_product_title_font_size, 'tablet' ),
		),
		'.ast-edd-archive-block-wrap .edd_price, .edd_downloads_list .edd_price,.ast-edd-archive-block-wrap .edd_price_options, .edd_downloads_list .edd_price_options' => array(
			'font-size' => astra_responsive_font( $edd_archive_product_price_font_size, 'tablet' ),
		),
		'.ast-edd-archive-block-wrap .edd_download_excerpt p, .edd_downloads_list .edd_download_excerpt p' => array(
			'font-size' => astra_responsive_font( $edd_archive_product_content_font_size, 'tablet' ),
		),
	);
	$css_output .= astra_parse_css( $tablet_css, '', astra_addon_get_tablet_breakpoint() );

	$mobile_css  = array(
		'.single-download .entry-title'   => array(
			'font-size' => astra_responsive_font( $product_title_font_size, 'mobile' ),
		),
		'.single-download .entry-content' => array(
			'font-size' => astra_responsive_font( $product_content_font_size, 'mobile' ),
		),
		'.ast-edd-archive-block-wrap .edd_download_title a, .edd_downloads_list .edd_download_title a' => array(
			'font-size' => astra_responsive_font( $edd_archive_product_title_font_size, 'mobile' ),
		),
		'.ast-edd-archive-block-wrap .edd_price, .edd_downloads_list .edd_price,.ast-edd-archive-block-wrap .edd_price_options, .edd_downloads_list .edd_price_options' => array(
			'font-size' => astra_responsive_font( $edd_archive_product_price_font_size, 'mobile' ),
		),
		'.ast-edd-archive-block-wrap .edd_download_excerpt p, .edd_downloads_list .edd_download_excerpt p' => array(
			'font-size' => astra_responsive_font( $edd_archive_product_content_font_size, 'mobile' ),
		),
	);
	$css_output .= astra_parse_css( $mobile_css, '', astra_addon_get_mobile_breakpoint() );

	return $dynamic_css . $css_output;

}
