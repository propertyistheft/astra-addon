<?php
/**
 * Site Layouts - Dynamic CSS
 *
 * @package Astra Addon
 */

add_filter( 'astra_addon_dynamic_css', 'astra_ext_site_layouts_dynamic_css' );

/**
 * Dynamic CSS
 *
 * @param  string $dynamic_css          Astra Dynamic CSS.
 * @param  string $dynamic_css_filtered Astra Dynamic CSS Filters.
 * @return string
 */
function astra_ext_site_layouts_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' ) {

	/**
	 * - Variable Declaration
	 */
	$page_width            = '100%';
	$parse_css             = '';
	$layout                = astra_get_option( 'site-layout', 'ast-full-width-layout' );
	$single_post_max       = astra_get_option( 'blog-single-width' );
	$single_post_max_width = astra_get_option( 'blog-single-max-width' );
	$blog_width            = astra_get_option( 'blog-width' );
	$blog_max_width        = astra_get_option( 'blog-max-width' );

	$woo_shop_archive_width = astra_get_option( 'shop-archive-width' );

	// set page width depending on site layout.
	if ( 'ast-box-layout' == $layout ) {
		$page_width = astra_get_option( 'site-layout-box-width' ) . 'px';
	} elseif ( 'ast-full-width-layout' == $layout ) {
		$page_width = ASTRA_THEME_CONTAINER_PADDING_TWICE + astra_get_option( 'site-content-width' ) . 'px';
	} elseif ( 'ast-padded-layout' == $layout ) {
		if ( '' != astra_get_option( 'site-layout-padded-width' ) ) {
			$page_width = ASTRA_THEME_CONTAINER_BOX_PADDED_PADDING_TWICE + astra_get_option( 'site-layout-padded-width' ) . 'px';
		}
	}

	// Fluid layout padding.
	$fluid_layout_padding = astra_get_option( 'site-layout-fluid-lr-padding' );

	// Box Layout - Top & Bottom Margin.
	$box_topbottom_margin = astra_get_option( 'site-layout-box-tb-margin' );

	// Box Layout - Background Color / Image.
	$box_bg_color = astra_get_option( 'site-layout-outside-bg-color' );

	// Padded Layout - Padding.
	$padded_layout_padding = astra_get_option( 'site-layout-padded-pad' );

	if ( 'ast-box-layout' == $layout || 'ast-padded-layout' == $layout ) {
		$blog_max_width        = absint( $blog_max_width ) + ASTRA_THEME_CONTAINER_BOX_PADDED_PADDING_TWICE;
		$single_post_max_width = absint( $single_post_max_width ) + ASTRA_THEME_CONTAINER_BOX_PADDED_PADDING_TWICE;
	} else {
		$blog_max_width        = absint( $blog_max_width ) + ASTRA_THEME_CONTAINER_PADDING_TWICE;
		$single_post_max_width = absint( $single_post_max_width ) + ASTRA_THEME_CONTAINER_PADDING_TWICE;
	}

	/* Global Responsive */
	$global_responsive_media = array(
		'.ast-container' => array(
			'max-width' => esc_attr( $page_width ),
		),
	);

	/* Parse CSS from array()*/
	$parse_css .= astra_parse_css( $global_responsive_media, astra_addon_get_tablet_breakpoint( '', 1 ) );
	$parse_css .= astra_parse_css( $global_responsive_media, '993' );
	$parse_css .= astra_parse_css( $global_responsive_media, '1201' );

	if ( 'default' == $woo_shop_archive_width ) {

		if ( 'page-builder' !== astra_get_content_layout() ) {
			/* Global Responsive for default woocommerce shop archive page */
			$woo_shop_archive_responsive_media = array(
				'.ast-woo-shop-archive .site-content > .ast-container' => array(
					'max-width' => esc_attr( $page_width ),
				),
			);

			/* Parse CSS from array()*/
			$parse_css .= astra_parse_css( $woo_shop_archive_responsive_media, astra_addon_get_tablet_breakpoint( '', 1 ) );
			$parse_css .= astra_parse_css( $woo_shop_archive_responsive_media, '993' );
			$parse_css .= astra_parse_css( $woo_shop_archive_responsive_media, '1201' );
		}
	}

	/* Fluid Width Layout CSS */
	if ( 'ast-fluid-width-layout' == $layout ) {
		$fw_layout          = '@media (min-width: ' . astra_addon_get_tablet_breakpoint( '', 1 ) . 'px) {';
			$fw_layout     .= '.ast-container {';
				$fw_layout .= 'padding-left:' . esc_attr( $fluid_layout_padding ) . 'px;';
				$fw_layout .= 'padding-right:' . esc_attr( $fluid_layout_padding ) . 'px;';
			$fw_layout     .= '}';
		$fw_layout         .= '}';
		$parse_css         .= $fw_layout;

		if ( 'default' === $woo_shop_archive_width ) {
			$woo_shop_archive_padding_css  = '@media (min-width:921px) {';
			$woo_shop_archive_padding_css .= 'body.ast-woo-shop-archive .site-content > .ast-container{';
			$woo_shop_archive_padding_css .= 'padding-left:' . esc_attr( $fluid_layout_padding ) . 'px;';
			$woo_shop_archive_padding_css .= 'padding-right:' . esc_attr( $fluid_layout_padding ) . 'px;';
			$woo_shop_archive_padding_css .= '}';
			$woo_shop_archive_padding_css .= '}';
			$parse_css                    .= $woo_shop_archive_padding_css;
		}   
	}

	/* Box Layout CSS */
	if ( 'ast-box-layout' == $layout ) {
		$box_layout = array(
			'#page' => array(
				'max-width'    => $page_width,
				'margin-left'  => 'auto',
				'margin-right' => 'auto',
			),
		);

		/* Parse CSS from array()*/
		$parse_css .= astra_parse_css( $box_layout );

		$bx_layout          = '@media (min-width:' . astra_addon_get_tablet_breakpoint( '', 1 ) . 'px) {';
			$bx_layout     .= '#page{';
				$bx_layout .= 'margin-top:' . esc_attr( $box_topbottom_margin ) . 'px;';
				$bx_layout .= 'margin-bottom:' . esc_attr( $box_topbottom_margin ) . 'px;';
			$bx_layout     .= '}';
			$bx_layout     .= ' .ast-container{';
				$bx_layout .= 'padding-left: ' . ASTRA_THEME_CONTAINER_BOX_PADDED_PADDING . 'px;';
				$bx_layout .= 'padding-right: ' . ASTRA_THEME_CONTAINER_BOX_PADDED_PADDING . 'px;';
			$bx_layout     .= '}';
		$bx_layout         .= '}';
		$parse_css         .= $bx_layout;
	}

	/* Padded Layout CSS */
	if ( 'ast-padded-layout' == $layout ) {
		$padded_layout = array(
			'body' => array(
				'background' => $box_bg_color,
			),
		);

		/* Parse CSS from array()*/
		$parse_css .= astra_parse_css( $padded_layout );

		/**
		 * Padded layout Desktop Spacing
		 */
		$padded_layout_spacing = array(
			'body.ast-padded-layout'         => array(
				'padding-top'    => astra_responsive_spacing( $padded_layout_padding, 'top', 'desktop' ),
				'padding-right'  => astra_responsive_spacing( $padded_layout_padding, 'right', 'desktop' ),
				'padding-bottom' => astra_responsive_spacing( $padded_layout_padding, 'bottom', 'desktop' ),
				'padding-left'   => astra_responsive_spacing( $padded_layout_padding, 'left', 'desktop' ),
			),
			'body.ast-padded-layout::before' => array(
				'padding-top' => astra_responsive_spacing( $padded_layout_padding, 'top', 'desktop' ),
			),
			'body.ast-padded-layout::after'  => array(
				'padding-bottom' => astra_responsive_spacing( $padded_layout_padding, 'bottom', 'desktop' ),
			),
		);

		$parse_css .= astra_parse_css( $padded_layout_spacing );

		/**
		 * Padded layout Tablet Spacing
		 */
		$tablet_padded_layout_spacing = array(
			'body.ast-padded-layout'         => array(
				'padding-top'    => astra_responsive_spacing( $padded_layout_padding, 'top', 'tablet' ),
				'padding-right'  => astra_responsive_spacing( $padded_layout_padding, 'right', 'tablet' ),
				'padding-bottom' => astra_responsive_spacing( $padded_layout_padding, 'bottom', 'tablet' ),
				'padding-left'   => astra_responsive_spacing( $padded_layout_padding, 'left', 'tablet' ),

			),
			'body.ast-padded-layout::before' => array(
				'padding-top' => astra_responsive_spacing( $padded_layout_padding, 'top', 'tablet' ),
			),
			'body.ast-padded-layout::after'  => array(
				'padding-bottom' => astra_responsive_spacing( $padded_layout_padding, 'bottom', 'tablet' ),
			),
		);

		/**
		 * Padded layout Mobile Spacing
		 */
		$mobile_padded_layout_spacing = array(
			'body.ast-padded-layout'         => array(
				'padding-top'    => astra_responsive_spacing( $padded_layout_padding, 'top', 'mobile' ),
				'padding-right'  => astra_responsive_spacing( $padded_layout_padding, 'right', 'mobile' ),
				'padding-bottom' => astra_responsive_spacing( $padded_layout_padding, 'bottom', 'mobile' ),
				'padding-left'   => astra_responsive_spacing( $padded_layout_padding, 'left', 'mobile' ),
			),
			'body.ast-padded-layout::before' => array(
				'padding-top' => astra_responsive_spacing( $padded_layout_padding, 'top', 'mobile' ),
			),
			'body.ast-padded-layout::after'  => array(
				'padding-bottom' => astra_responsive_spacing( $padded_layout_padding, 'bottom', 'mobile' ),
			),
		);

		/**
		 * Padded layout Container Spacing
		 */
		$padded_width = astra_get_option( 'site-layout-padded-width' );
		if ( ! empty( $padded_width ) ) {
			$padded_layout_spacing_container = array(
				'.ast-container' => array(
					'padding-left'  => ASTRA_THEME_CONTAINER_BOX_PADDED_PADDING . 'px',
					'padding-right' => ASTRA_THEME_CONTAINER_BOX_PADDED_PADDING . 'px',
				),
			);
		} else {
			$padded_layout_spacing_container = array(
				'.site-content > .ast-container' => array(
					'padding-left'  => 0,
					'padding-right' => 0,
				),
			);
		}
		// Add Container padding only for desktop devices.
		$parse_css .= astra_parse_css( $padded_layout_spacing_container, astra_addon_get_tablet_breakpoint( '', 1 ) );

		$parse_css .= astra_parse_css( $padded_layout_spacing );
		$parse_css .= astra_parse_css( $tablet_padded_layout_spacing, '', astra_addon_get_tablet_breakpoint() );
		$parse_css .= astra_parse_css( $mobile_padded_layout_spacing, '', astra_addon_get_mobile_breakpoint() );

	}

	/* Blog */
	if ( 'ast-fluid-width-layout' == $layout ) {
		if ( 'custom' === $blog_width ) {
			$blog_css   = '@media (min-width:921px) {';
			$blog_css  .= '.blog .site-content > .ast-container, .archive .site-content > .ast-container, .search .site-content > .ast-container{';
			$blog_css  .= 'padding-left:' . ASTRA_THEME_CONTAINER_PADDING . 'px;';
			$blog_css  .= 'padding-right:' . ASTRA_THEME_CONTAINER_PADDING . 'px;';
			$blog_css  .= '}';
			$blog_css  .= '}';
			$parse_css .= $blog_css;
		}
		if ( 'custom' === $woo_shop_archive_width ) {
			$woo_shop_archive_css  = '@media (min-width:921px) {';
			$woo_shop_archive_css .= '.ast-woo-shop-archive .site-content > .ast-container{';
			$woo_shop_archive_css .= 'padding-left:' . ASTRA_THEME_CONTAINER_PADDING . 'px;';
			$woo_shop_archive_css .= 'padding-right:' . ASTRA_THEME_CONTAINER_PADDING . 'px;';
			$woo_shop_archive_css .= '}';
			$woo_shop_archive_css .= '}';
			$parse_css            .= $woo_shop_archive_css;
		}
	}

	/* Single Blog */
	if ( 'ast-fluid-width-layout' == $layout ) {
		if ( 'custom' === $single_post_max ) {
			$single_blog_css  = '@media (min-width:921px) {';
			$single_blog_css .= '.single .site-content > .ast-container{';
			$single_blog_css .= 'padding-left:' . ASTRA_THEME_CONTAINER_PADDING . 'px;';
			$single_blog_css .= 'padding-right:' . ASTRA_THEME_CONTAINER_PADDING . 'px;';
			$single_blog_css .= '}';
			$single_blog_css .= '}';
			$parse_css       .= $single_blog_css;
		}
	}

	/** Scroll to top compatibility with padded layout. */
	if ( 'ast-padded-layout' === $layout && true === astra_get_option( 'scroll-to-top-enable', true ) ) {
		$scroll_to_top_icon_alignment = astra_get_option( 'scroll-to-top-icon-position' );
		$scroll_to_top_padded_padding = apply_filters( 'astra_scroll_top_padded_padding', 30 );
		$padded_layout_padding        = astra_get_option( 'site-layout-padded-pad' );

		if ( 'em' === $padded_layout_padding['desktop-unit'] || 'em' === $padded_layout_padding['tablet-unit'] || 'em' === $padded_layout_padding['mobile-unit'] ) {
			$scroll_to_top_padded_padding = apply_filters( 'astra_scroll_top_padded_padding', 2 );
		}

		if ( '%' === $padded_layout_padding['desktop-unit'] || '%' === $padded_layout_padding['tablet-unit'] || '%' === $padded_layout_padding['mobile-unit'] ) {
			$scroll_to_top_padded_padding = apply_filters( 'astra_scroll_top_padded_padding', 4 );
		}

		$padded_spacing = array(
			/**
			 * Add spacing based on padded layout spacing
			 */
			'.ast-padded-layout .ast-scroll-to-top-' . $scroll_to_top_icon_alignment => array(
				$scroll_to_top_icon_alignment => astra_get_css_value( intval( $padded_layout_padding['desktop'][ $scroll_to_top_icon_alignment ] ) + $scroll_to_top_padded_padding, $padded_layout_padding['desktop-unit'] ),
				'bottom'                      => astra_get_css_value( intval( $padded_layout_padding['desktop']['bottom'] ) + $scroll_to_top_padded_padding, $padded_layout_padding['desktop-unit'] ),
			),
		);

		$tablet_padded_spacing = array(
			/**
			 * Add spacing based on padded layout spacing
			 */
			'.ast-padded-layout .ast-scroll-to-top-' . $scroll_to_top_icon_alignment => array(
				$scroll_to_top_icon_alignment => astra_get_css_value( intval( $padded_layout_padding['tablet'][ $scroll_to_top_icon_alignment ] ) + $scroll_to_top_padded_padding, $padded_layout_padding['tablet-unit'] ),
				'bottom'                      => astra_get_css_value( intval( $padded_layout_padding['tablet']['bottom'] ) + $scroll_to_top_padded_padding, $padded_layout_padding['tablet-unit'] ),
			),
		);

		$mobile_padded_spacing = array(
			/**
			 * Add spacing based on padded layout spacing
			 */
			'.ast-padded-layout .ast-scroll-to-top-' . $scroll_to_top_icon_alignment => array(
				$scroll_to_top_icon_alignment => astra_get_css_value( intval( $padded_layout_padding['mobile'][ $scroll_to_top_icon_alignment ] ) + $scroll_to_top_padded_padding, $padded_layout_padding['mobile-unit'] ),
				'bottom'                      => astra_get_css_value( intval( $padded_layout_padding['mobile']['bottom'] ) + $scroll_to_top_padded_padding, $padded_layout_padding['mobile-unit'] ),
			),
		);

		/* Parse CSS from array() */
		$parse_css .= astra_parse_css( $padded_spacing );
		$parse_css .= astra_parse_css( $tablet_padded_spacing, '', astra_addon_get_tablet_breakpoint() );
		$parse_css .= astra_parse_css( $mobile_padded_spacing, '', astra_addon_get_mobile_breakpoint() );
	}

	return $dynamic_css . $parse_css;
}
