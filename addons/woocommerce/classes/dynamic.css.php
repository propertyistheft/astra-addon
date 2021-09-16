<?php
/**
 * Typography - Dynamic CSS
 *
 * @package Astra Addon
 */

add_filter( 'astra_dynamic_css', 'astra_woocommerce_dynamic_css' );

/**
 * Dynamic CSS
 *
 * @param  string $dynamic_css          Astra Dynamic CSS.
 * @param  string $dynamic_css_filtered Astra Dynamic CSS Filters.
 * @return string
 */
function astra_woocommerce_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' ) {

	/**
	 * - Variable Declaration.
	 */
	$is_site_rtl       = is_rtl();
	$link_h_color      = astra_get_option( 'link-h-color' );
	$theme_color       = astra_get_option( 'theme-color' );
	$link_color        = astra_get_option( 'link-color', $theme_color );
	$product_img_width = astra_get_option( 'single-product-image-width' );
	$product_nav_style = astra_get_option( 'single-product-nav-style' );

	$btn_h_color = astra_get_option( 'button-h-color' );
	if ( empty( $btn_h_color ) ) {
		$btn_h_color = astra_get_foreground_color( $link_h_color );
	}

	$body_font_family = astra_body_font_family();

	// General Colors.
	$product_rating_color = astra_get_option( 'single-product-rating-color' );
	$product_price_color  = astra_get_option( 'single-product-price-color' );

	// Single Product Typo.
	$product_title_font_size      = astra_get_option( 'font-size-product-title' );
	$product_title_line_height    = astra_get_option( 'line-height-product-title' );
	$product_title_font_family    = astra_get_option( 'font-family-product-title' );
	$product_title_font_weight    = astra_get_option( 'font-weight-product-title' );
	$product_title_text_transform = astra_get_option( 'text-transform-product-title' );

	// Single Product Content Typo.
	$product_content_font_size      = astra_get_option( 'font-size-product-content' );
	$product_content_line_height    = astra_get_option( 'line-height-product-content' );
	$product_content_font_family    = astra_get_option( 'font-family-product-content' );
	$product_content_font_weight    = astra_get_option( 'font-weight-product-content' );
	$product_content_text_transform = astra_get_option( 'text-transform-product-content' );

	$product_price_font_size   = astra_get_option( 'font-size-product-price' );
	$product_price_line_height = astra_get_option( 'line-height-product-price' );
	$product_price_font_family = astra_get_option( 'font-family-product-price' );
	$product_price_font_weight = astra_get_option( 'font-weight-product-price' );

	$product_breadcrumb_font_family    = astra_get_option( 'font-family-product-breadcrumb' );
	$product_breadcrumb_font_weight    = astra_get_option( 'font-weight-product-breadcrumb' );
	$product_breadcrumb_text_transform = astra_get_option( 'text-transform-product-breadcrumb' );
	$product_breadcrumb_line_height    = astra_get_option( 'line-height-product-breadcrumb' );
	$product_breadcrumb_font_size      = astra_get_option( 'font-size-product-breadcrumb' );

	// Single Product Colors.
	$product_title_color      = astra_get_option( 'single-product-title-color' );
	$product_price_color      = astra_get_option( 'single-product-price-color' );
	$product_content_color    = astra_get_option( 'single-product-content-color' );
	$product_breadcrumb_color = astra_get_option( 'single-product-breadcrumb-color' );

	// Shop Typo.
	$shop_product_title_font_size      = astra_get_option( 'font-size-shop-product-title' );
	$shop_product_title_line_height    = astra_get_option( 'line-height-shop-product-title' );
	$shop_product_title_font_family    = astra_get_option( 'font-family-shop-product-title' );
	$shop_product_title_font_weight    = astra_get_option( 'font-weight-shop-product-title' );
	$shop_product_title_text_transform = astra_get_option( 'text-transform-shop-product-title' );

	$shop_product_price_font_family = astra_get_option( 'font-family-shop-product-price' );
	$shop_product_price_font_weight = astra_get_option( 'font-weight-shop-product-price' );
	$shop_product_price_font_size   = astra_get_option( 'font-size-shop-product-price' );
	$shop_product_price_line_height = astra_get_option( 'line-height-shop-product-price' );

	$shop_product_content_font_family    = astra_get_option( 'font-family-shop-product-content' );
	$shop_product_content_font_weight    = astra_get_option( 'font-weight-shop-product-content' );
	$shop_product_content_line_height    = astra_get_option( 'line-height-shop-product-content' );
	$shop_product_content_text_transform = astra_get_option( 'text-transform-shop-product-content' );
	$shop_product_content_font_size      = astra_get_option( 'font-size-shop-product-content' );

	// Shop Colors.
	$shop_product_title_color   = astra_get_option( 'shop-product-title-color' );
	$shop_product_price_color   = astra_get_option( 'shop-product-price-color' );
	$shop_product_content_color = astra_get_option( 'shop-product-content-color' );

	$btn_v_padding  = astra_get_option( 'shop-button-v-padding' );
	$btn_h_padding  = astra_get_option( 'shop-button-h-padding' );
	$btn_bg_color   = astra_get_option( 'button-bg-color', '', $theme_color );
	$btn_bg_h_color = astra_get_option( 'button-bg-h-color', $link_h_color );

	$product_desc_width = 96 - intval( $product_img_width );

	$two_step_checkout     = astra_get_option( 'two-step-checkout' );
	$checkout_width        = astra_get_option( 'checkout-content-width' );
	$checkout_custom_width = astra_get_option( 'checkout-content-max-width' );

	$header_cart_icon_style    = astra_get_option( 'woo-header-cart-icon-style' );
	$header_cart_icon_color    = astra_get_option( 'header-woo-cart-icon-color', $theme_color );
	$header_cart_icon_radius   = astra_get_option( 'woo-header-cart-icon-radius' );
	$cart_h_color              = astra_get_foreground_color( $header_cart_icon_color );
	$theme_h_color             = astra_get_foreground_color( $theme_color );
	$cart_products_count_color = astra_get_option( 'woo-header-cart-product-count-color', $theme_h_color );

	// Default headings font family.
	$headings_font_family = astra_get_option( 'headings-font-family' );

	$product_sale_style = astra_get_option( 'product-sale-style' );

	$products_grid = astra_get_option( 'single-product-related-upsell-grid' );

	$products_grid_desktop = ( ! empty( $products_grid['desktop'] ) ) ? $products_grid['desktop'] : 4;
	$products_grid_tablet  = ( ! empty( $products_grid['tablet'] ) ) ? $products_grid['tablet'] : 3;
	$products_grid_mobile  = ( ! empty( $products_grid['mobile'] ) ) ? $products_grid['mobile'] : 2;
	$load_upsell_grid_css  = ( Astra_Addon_Builder_Helper::apply_flex_based_css() && astra_get_option( 'single-product-up-sells-display' ) ) ? true : false;

	// Supporting color setting for default icon as well.
	$can_update_cart_color   = Astra_Addon_Update_Filter_Function::astra_cart_color_default_icon_old_header();
	$cart_new_color_setting  = astra_get_option( 'woo-header-cart-icon-color', $theme_color );
	$header_cart_count_color = ( $can_update_cart_color ) ? $cart_new_color_setting : $theme_color;

	/**
	 * Set font sizes
	 */
	$css_output = array(

		// Shop / Archive / Related / Upsell /Woocommerce Shortcode buttons Vertical/Horizontal padding.
		'.woocommerce.archive ul.products li a.button, .woocommerce > ul.products li a.button, .woocommerce related a.button, .woocommerce .related a.button, .woocommerce .up-sells a.button .woocommerce .cross-sells a.button' => array(
			'padding' => $btn_v_padding . 'px ' . $btn_h_padding . 'px',
		),

		/**
		 * Sale Bubble Styles.
		 */
		// Outline.
		'.woocommerce ul.products li.product .onsale.circle-outline, .woocommerce ul.products li.product .onsale.square-outline, .woocommerce div.product .onsale.circle-outline, .woocommerce div.product .onsale.square-outline' => array(
			'background' => '#ffffff',
			'border'     => '2px solid ' . $link_color,
			'color'      => $link_color,
		),

		'.ast-shop-load-more:hover'                => array(
			'color'            => astra_get_foreground_color( $link_color ),
			'border-color'     => esc_attr( $link_color ),
			'background-color' => esc_attr( $link_color ),
		),

		'.ast-loader > div'                        => array(
			'background-color' => esc_attr( $link_color ),
		),

		'.woocommerce nav.woocommerce-pagination ul li > span.current, .woocommerce nav.woocommerce-pagination ul li > .page-numbers' => array(
			'border-color' => esc_attr( $link_color ),
		),

		/**
		 * Checkout button Two step checkout back button
		 */
		'.ast-woo-two-step-checkout .ast-checkout-slides .flex-prev.button' => array(
			'color'            => $btn_h_color,
			'border-color'     => $btn_bg_h_color,
			'background-color' => $btn_bg_h_color,
		),
		'.widget_layered_nav_filters ul li.chosen a::before' => array(
			'color' => esc_attr( $link_color ),
		),
		'.ast-site-header-cart i.astra-icon:after' => array(
			'background' => $header_cart_count_color,
		),

		'.single-product div.product .entry-title' => array(
			'font-size'      => astra_responsive_font( $product_title_font_size, 'desktop' ),
			'line-height'    => esc_attr( $product_title_line_height ),
			'font-weight'    => astra_get_css_value( $product_title_font_weight, 'font' ),
			'font-family'    => astra_get_css_value( $product_title_font_family, 'font', $headings_font_family ),
			'text-transform' => esc_attr( $product_title_text_transform ),
			'color'          => esc_attr( $product_title_color ),
		),
		// Single Product Content.
		'.single-product div.product .woocommerce-product-details__short-description, .single-product div.product .product_meta, .single-product div.product .entry-content' => array(
			'font-size'      => astra_responsive_font( $product_content_font_size, 'desktop' ),
			'line-height'    => esc_attr( $product_content_line_height ),
			'font-weight'    => astra_get_css_value( $product_content_font_weight, 'font' ),
			'font-family'    => astra_get_css_value( $product_content_font_family, 'font', $body_font_family ),
			'text-transform' => esc_attr( $product_content_text_transform ),
			'color'          => esc_attr( $product_content_color ),
		),

		'.single-product div.product p.price, .single-product div.product span.price' => array(
			'font-size'   => astra_responsive_font( $product_price_font_size, 'desktop' ),
			'line-height' => esc_attr( $product_price_line_height ),
			'font-weight' => astra_get_css_value( $product_price_font_weight, 'font' ),
			'font-family' => astra_get_css_value( $product_price_font_family, 'font', $body_font_family ),
			'color'       => esc_attr( $product_price_color ),
		),

		'.woocommerce ul.products li.product .woocommerce-loop-product__title, .woocommerce-page ul.products li.product .woocommerce-loop-product__title, .wc-block-grid .wc-block-grid__products .wc-block-grid__product .wc-block-grid__product-title' => array(
			'font-size'      => astra_responsive_font( $shop_product_title_font_size, 'desktop' ),
			'line-height'    => esc_attr( $shop_product_title_line_height ),
			'font-weight'    => astra_get_css_value( $shop_product_title_font_weight, 'font' ),
			'font-family'    => astra_get_css_value( $shop_product_title_font_family, 'font', $body_font_family ),
			'text-transform' => esc_attr( $shop_product_title_text_transform ),
			'color'          => esc_attr( $shop_product_title_color ),
		),

		'.woocommerce ul.products li.product .price, .woocommerce-page ul.products li.product .price, .wc-block-grid .wc-block-grid__products .wc-block-grid__product .wc-block-grid__product-price' => array(
			'font-family' => astra_get_css_value( $shop_product_price_font_family, 'font', $body_font_family ),
			'font-weight' => astra_get_css_value( $shop_product_price_font_weight, 'font' ),
			'font-size'   => astra_responsive_font( $shop_product_price_font_size, 'desktop' ),
			'line-height' => esc_attr( $shop_product_price_line_height ),
			'color'       => esc_attr( $shop_product_price_color ),
		),

		'.woocommerce ul.products li.product .price, .woocommerce div.product p.price, .woocommerce div.product span.price, .woocommerce ul.products li.product .price ins, .woocommerce div.product p.price ins, .woocommerce div.product span.price ins' => array(
			'font-weight' => astra_get_css_value( $product_price_font_weight, 'font' ),
		),

		'.woocommerce .star-rating, .woocommerce .comment-form-rating .stars a, .woocommerce .star-rating::before' => array(
			'color' => esc_attr( $product_rating_color ),
		),

		'.single-product div.product .woocommerce-breadcrumb, .single-product div.product .woocommerce-breadcrumb a' => array(
			'color' => esc_attr( $product_breadcrumb_color ),
		),

		'.single-product div.product .woocommerce-breadcrumb' => array(
			'font-size'      => astra_responsive_font( $product_breadcrumb_font_size, 'desktop' ),
			'font-weight'    => astra_get_css_value( $product_breadcrumb_font_weight, 'font' ),
			'font-family'    => astra_get_css_value( $product_breadcrumb_font_family, 'font', $body_font_family ),
			'text-transform' => esc_attr( $product_breadcrumb_text_transform ),
			'line-height'    => esc_attr( $product_breadcrumb_line_height ),
		),

		'.woocommerce ul.products li.product .ast-woo-product-category, .woocommerce-page ul.products li.product .ast-woo-product-category, .woocommerce ul.products li.product .ast-woo-shop-product-description, .woocommerce-page ul.products li.product .ast-woo-shop-product-description' => array(
			'font-family'    => astra_get_css_value( $shop_product_content_font_family, 'font', $body_font_family ),
			'font-weight'    => astra_get_css_value( $shop_product_content_font_weight, 'font' ),
			'font-size'      => astra_responsive_font( $shop_product_content_font_size, 'desktop' ),
			'text-transform' => esc_attr( $shop_product_content_text_transform ),
			'line-height'    => esc_attr( $shop_product_content_line_height ),
			'color'          => esc_attr( $shop_product_content_color ),
		),

		'.ast-site-header-cart .ast-addon-cart-wrap i.astra-icon:after' => array(
			'color' => esc_attr( $cart_products_count_color ),
		),
		'.ast-theme-transparent-header .ast-site-header-cart .ast-addon-cart-wrap i.astra-icon:after' => array(
			'color' => esc_attr( $cart_products_count_color ),
		),
	);

	if ( false === astra_addon_builder_helper()->is_header_footer_builder_active && $can_update_cart_color && 'default' === astra_get_option( 'woo-header-cart-icon' ) ) {

		$cart_h_color = astra_get_foreground_color( $cart_new_color_setting );

		$css_output['.ast-site-header-cart .cart-container, .ast-site-header-cart a:focus, .ast-site-header-cart a:hover'] = array(
			'color' => $cart_new_color_setting,
		);
		$css_output['.ast-cart-menu-wrap .count, .ast-cart-menu-wrap .count:after']                                        = array(
			'color'        => $cart_new_color_setting,
			'border-color' => $cart_new_color_setting,
		);
		$css_output['.ast-site-header-cart .ast-cart-menu-wrap:hover .count'] = array(
			'color'            => esc_attr( $cart_h_color ),
			'background-color' => esc_attr( $cart_new_color_setting ),
		);
	}

	/* Display Desktop Up sell Products */
	if ( $load_upsell_grid_css ) {
		$css_output[ '.woocommerce-page.rel-up-columns-' . $products_grid_desktop . ' .up-sells ul.products' ] = array(
			'grid-template-columns' => 'repeat(' . $products_grid_desktop . ', minmax(0, 1fr))',
		);
	}

	/* Parse CSS from array() */
	$css_output = astra_parse_css( $css_output );

	if ( false === Astra_Icons::is_svg_icons() ) {
		$woo_shopping_cart = array(
			'.ast-site-header-cart i.astra-icon:before' => array(
				'font-family' => 'Astra',
			),
			'.ast-icon-shopping-cart:before'            => array(
				'content' => '"\f07a"',
			),
			'.ast-icon-shopping-bag:before'             => array(
				'content' => '"\f290"',
			),
			'.ast-icon-shopping-basket:before'          => array(
				'content' => '"\f291"',
			),
			'.woocommerce .astra-shop-filter-button .astra-woo-filter-icon:after, .woocommerce button.astra-shop-filter-button .astra-woo-filter-icon:after, .woocommerce-page .astra-shop-filter-button .astra-woo-filter-icon:after, .woocommerce-page button.astra-shop-filter-button .astra-woo-filter-icon:after, .woocommerce .astra-shop-filter-button .astra-woo-filter-icon:after, .woocommerce button.astra-shop-filter-button .astra-woo-filter-icon:after, .woocommerce-page .astra-shop-filter-button .astra-woo-filter-icon:after, .woocommerce-page button.astra-shop-filter-button .astra-woo-filter-icon:after' => array(
				'content'         => '"\e5d2"',
				'font-family'     => "'Astra'",
				'text-decoration' => 'inherit',
			),
			'.woocommerce .astra-off-canvas-sidebar-wrapper .close:after, .woocommerce-page .astra-off-canvas-sidebar-wrapper .close:after' => array(
				'content'                 => '"\e5cd"',
				'font-family'             => "'Astra'",
				'display'                 => 'inline-block',
				'font-size'               => '22px',
				'font-size'               => '2rem',
				'text-rendering'          => 'auto',
				'-webkit-font-smoothing'  => 'antialiased',
				'-moz-osx-font-smoothing' => 'grayscale',
				'line-height'             => 'normal',
			),
			'#ast-quick-view-close:before'              => array(
				'content'         => '"\e5cd"',
				'font-family'     => "'Astra'",
				'text-decoration' => 'inherit',
			),
			'.ast-icon-previous:before, .ast-icon-next:before' => array(
				'content'                 => '"\e900"',
				'font-family'             => "'Astra'",
				'display'                 => 'inline-block',
				'font-size'               => '.8rem',
				'font-weight'             => '700',
				'text-rendering'          => 'auto',
				'-webkit-font-smoothing'  => 'antialiased',
				'-moz-osx-font-smoothing' => 'grayscale',
				'vertical-align'          => 'middle',
				'line-height'             => 'normal',
				'font-style'              => 'normal',
			),
			'.ast-icon-previous:before'                 => array(
				'transform' => 'rotate(90deg)',
			),
			'.ast-icon-next:before'                     => array(
				'transform' => 'rotate(-90deg)',
			),
			'#ast-quick-view-modal .ast-qv-image-slider .flex-direction-nav .flex-prev:before, #ast-quick-view-modal .ast-qv-image-slider .flex-direction-nav .flex-next:before' => array(
				'content'     => '"\e900"',
				'font-family' => 'Astra',
				'font-size'   => '20px',
			),
			'#ast-quick-view-modal .ast-qv-image-slider .flex-direction-nav a' => array(
				'width'  => '20px',
				'height' => '20px',
			),
			'#ast-quick-view-modal .ast-qv-image-slider:hover .flex-direction-nav .flex-prev' => array(
				'left' => '10px',
			),
			'#ast-quick-view-modal .ast-qv-image-slider:hover .flex-direction-nav .flex-next' => array(
				'right' => '10px',
			),
			'#ast-quick-view-modal .ast-qv-image-slider .flex-direction-nav .flex-prev' => array(
				'transform' => 'rotate(90deg)',
			),
			'#ast-quick-view-modal .ast-qv-image-slider .flex-direction-nav .flex-next' => array(
				'transform' => 'rotate(-90deg)',
			),
		);

		if ( false === astra_addon_builder_helper()->is_header_footer_builder_active ) {
			$woo_shopping_cart['.ast-site-header-cart .cart-container *']                = array(
				'transition' => 'all 0s linear',
			);
			$woo_shopping_cart['.ast-site-header-cart .ast-woo-header-cart-info-wrap']   = array(
				'padding'     => '0 2px',
				'font-weight' => '600',
				'line-height' => '2.7',
				'display'     => 'inline-block',
			);
			$woo_shopping_cart['.ast-site-header-cart i.astra-icon.no-cart-total:after'] = array(
				'display' => 'none',
			);
			$woo_shopping_cart['.ast-site-header-cart i.astra-icon:after']               = array(
				'content'        => 'attr(data-cart-total)',
				'position'       => 'absolute',
				'font-style'     => 'normal',
				'top'            => '-10px',
				'right'          => '-12px',
				'font-weight'    => 'bold',
				'box-shadow'     => '1px 1px 3px 0px rgba(0, 0, 0, 0.3)',
				'font-size'      => '11px',
				'padding-left'   => '2px',
				'padding-right'  => '2px',
				'line-height'    => '17px',
				'letter-spacing' => '-.5px',
				'height'         => '18px',
				'min-width'      => '18px',
				'border-radius'  => '99px',
				'text-align'     => 'center',
				'z-index'        => '4',
			);
		}
	} else {
		$woo_shopping_cart = array(
			'.ast-addon-cart-wrap .ast-icon' => array(
				'vertical-align' => 'middle',
			),
			'.ast-icon-shopping-cart svg'    => array(
				'height' => '.82em',
			),
			'.ast-icon-shopping-bag svg'     => array(
				'height' => '1em',
				'width'  => '1em',
			),
			'.ast-icon-shopping-basket svg'  => array(
				'height' => '1.15em',
				'width'  => '1.2em',
			),
			'#ast-quick-view-close svg'      => array(
				'height' => '12px',
				'width'  => '12px',
			),
			'.ast-product-icon-previous svg' => array(
				'transform' => 'rotate(90deg)',
			),
			'.ast-product-icon-next svg'     => array(
				'transform' => 'rotate(-90deg)',
			),
			'.ast-product-icon-previous .ast-icon.icon-arrow svg, .ast-product-icon-next .ast-icon.icon-arrow svg' => array(
				'margin-left' => '0',
				'width'       => '0.8em',
			),
			'#ast-quick-view-modal .ast-qv-image-slider .flex-direction-nav .flex-prev:before, #ast-quick-view-modal .ast-qv-image-slider .flex-direction-nav .flex-next:before' => array(
				'content'   => '"\203A"',
				'font-size' => '30px',
			),
			'#ast-quick-view-modal .ast-qv-image-slider .flex-direction-nav a' => array(
				'width'  => '30px',
				'height' => '30px',
			),
			'#ast-quick-view-modal .ast-qv-image-slider:hover .flex-direction-nav .flex-prev' => array(
				'left' => '-10px',
			),
			'#ast-quick-view-modal .ast-qv-image-slider:hover .flex-direction-nav .flex-next' => array(
				'right' => '-10px',
			),
			'#ast-quick-view-modal .ast-qv-image-slider .flex-direction-nav .flex-prev' => array(
				'transform' => 'rotate(180deg)',
			),
			'#ast-quick-view-modal .ast-qv-image-slider .flex-direction-nav .flex-next' => array(
				'transform' => 'rotate(0deg)',
			),
		);
	}

	/* Parse CSS from array() */
	$css_output .= astra_parse_css( $woo_shopping_cart );

	/**
	 * Header Cart color
	 */
	if ( 'none' !== $header_cart_icon_style ) {

		$header_cart_icon = array();

		if ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) {

			/**
			 * Header Cart Icon colors
			 */
			$header_cart_icon['.ast-builder-layout-element[data-section="section-hb-woo-cart"]'] = array(
				'padding'      => esc_attr( 0 ),
				'margin-left'  => esc_attr( '1em' ),
				'margin-right' => esc_attr( '1em' ),
				'margin'       => esc_attr( '0' ),
			);

			$header_cart_icon['.ast-builder-layout-element[data-section="section-hb-woo-cart"] .ast-addon-cart-wrap'] = array(
				'display' => esc_attr( 'inline-block' ),
				'padding' => esc_attr( '0 .6em' ),
			);

			// We adding this conditional CSS only to maintain backwards. Remove this condition after 2-3 updates of theme.
			if ( version_compare( ASTRA_THEME_VERSION, '3.4.3', '>=' ) ) {
				$add_background_outline_cart   = Astra_Addon_Update_Filter_Function::astra_add_bg_color_outline_cart_header_builder();
				$border_width                  = astra_get_option( 'woo-header-cart-border-width' );
				$transparent_header_icon_color = esc_attr( astra_get_option( 'transparent-header-woo-cart-icon-color', $header_cart_icon_color ) );

				// Outline cart style border.
				$header_cart_icon['.ast-menu-cart-outline .ast-addon-cart-wrap'] = array(
					'border-width' => astra_get_css_value( $border_width, 'px' ),
				);
				$header_cart_icon['.ast-menu-cart-outline .ast-cart-menu-wrap .count, .ast-menu-cart-outline .ast-addon-cart-wrap'] = array(
					'border-style' => 'solid',
					'border-color' => esc_attr( $header_cart_icon_color ),
				);

				// Transparent header outline cart style.
				$header_cart_icon['.ast-theme-transparent-header .ast-menu-cart-outline .ast-addon-cart-wrap'] = array(
					'border-width' => astra_get_css_value( $border_width, 'px' ),
					'border-style' => 'solid',
					'border-color' => esc_attr( $transparent_header_icon_color ),
				);

				if ( $add_background_outline_cart ) {
					$header_cart_icon['.ast-menu-cart-outline .ast-addon-cart-wrap'] = array(
						'border-width' => astra_get_css_value( $border_width, 'px' ),
						'background'   => '#ffffff',
					);
				}
			}
		} else {

			if ( $can_update_cart_color ) {
				$header_cart_icon_color = $cart_new_color_setting;
			}

			$header_cart_icon = array(
				// Default icon colors.
				'.ast-woocommerce-cart-menu .ast-cart-menu-wrap .count, .ast-woocommerce-cart-menu .ast-cart-menu-wrap .count:after' => array(
					'border-color' => esc_attr( $header_cart_icon_color ),
					'color'        => esc_attr( $header_cart_icon_color ),
				),
				// Outline icon hover colors.
				'.ast-woocommerce-cart-menu .ast-cart-menu-wrap:hover .count' => array(
					'color'            => esc_attr( $cart_h_color ),
					'background-color' => esc_attr( $header_cart_icon_color ),
				),
				// Outline icon colors.
				'.ast-menu-cart-outline .ast-addon-cart-wrap' => array(
					'background' => '#ffffff',
					'border'     => '1px solid ' . $header_cart_icon_color,
					'color'      => esc_attr( $header_cart_icon_color ),
				),
				// Fill icon Color.
				'.ast-woocommerce-cart-menu .ast-menu-cart-fill .ast-cart-menu-wrap .count, .ast-menu-cart-fill .ast-addon-cart-wrap' => array(
					'background-color' => esc_attr( $header_cart_icon_color ),
					'color'            => esc_attr( $cart_h_color ),
				),

				// Border radius.
				'.ast-site-header-cart.ast-menu-cart-outline .ast-addon-cart-wrap, .ast-site-header-cart.ast-menu-cart-fill .ast-addon-cart-wrap' => array(
					'border-radius' => astra_get_css_value( $header_cart_icon_radius, 'px' ),
				),
			);

			// We adding this conditional CSS only to maintain backwards. Remove this condition after 2-3 updates of theme.
			if ( version_compare( ASTRA_THEME_VERSION, '3.4.3', '>=' ) ) {
				$border_width = astra_get_option( 'woo-header-cart-border-width' );

				// Outline icon colors.
				$header_cart_icon['.ast-menu-cart-outline .ast-addon-cart-wrap'] = array(
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
			$header_cart_icon['li.ast-masthead-custom-menu-items.woocommerce-custom-menu-item, .ast-masthead-custom-menu-items.woocommerce-custom-menu-item'] = array(
				'padding' => esc_attr( 0 ),
			);
			$header_cart_icon['.ast-header-break-point li.ast-masthead-custom-menu-items.woocommerce-custom-menu-item']                                       = array(
				'padding-left'  => esc_attr( '20px' ),
				'padding-right' => esc_attr( '20px' ),
				'margin'        => esc_attr( '0' ),
			);
			$header_cart_icon['.ast-header-break-point .ast-masthead-custom-menu-items.woocommerce-custom-menu-item'] = array(
				'margin-left'  => esc_attr( '1em' ),
				'margin-right' => esc_attr( '1em' ),
			);
			$header_cart_icon['.ast-header-break-point .ast-above-header-mobile-inline.mobile-header-order-2 .ast-masthead-custom-menu-items.woocommerce-custom-menu-item'] = array(
				'margin-left' => esc_attr( '0' ),
			);
			$header_cart_icon['.ast-header-break-point li.ast-masthead-custom-menu-items.woocommerce-custom-menu-item .ast-addon-cart-wrap']                                = array(
				'display' => esc_attr( 'inline-block' ),
			);
			$header_cart_icon['.woocommerce-custom-menu-item .ast-addon-cart-wrap'] = array(
				'padding' => esc_attr( '0 .6em' ),
			);
		}

		$css_output .= astra_parse_css( $header_cart_icon );
	}

	/**
	 * Sale bubble color
	 */
	if ( 'circle-outline' == $product_sale_style ) {
		/**
		 * Sale bubble color - Circle Outline
		 */
		$sale_style_css = array(
			'.wc-block-grid .wc-block-grid__products .wc-block-grid__product .wc-block-grid__product-onsale' => array(
				'line-height' => '2.7',
				'background'  => '#ffffff',
				'border'      => '2px solid ' . $link_color,
				'color'       => $link_color,
			),
		);

		$css_output .= astra_parse_css( $sale_style_css );
	} elseif ( 'square' == $product_sale_style ) {
		/**
		 * Sale bubble color - Square
		 */
		$sale_style_css = array(
			'.wc-block-grid .wc-block-grid__products .wc-block-grid__product .wc-block-grid__product-onsale' => array(
				'border-radius' => '0',
				'line-height'   => '3',
			),
		);

		$css_output .= astra_parse_css( $sale_style_css );
	} elseif ( 'square-outline' == $product_sale_style ) {
		/**
		 * Sale bubble color - Square Outline
		 */
		$sale_style_css = array(
			'.wc-block-grid .wc-block-grid__products .wc-block-grid__product .wc-block-grid__product-onsale' => array(
				'line-height'   => '3',
				'background'    => '#ffffff',
				'border'        => '2px solid ' . $link_color,
				'color'         => $link_color,
				'border-radius' => '0',
			),
		);

		$css_output .= astra_parse_css( $sale_style_css );
	}

	if ( 'disable' != $product_nav_style ) {

		/**
		 * Product Navingation Style
		 */
		$product_nav = array(

			'.ast-product-navigation-wrapper .product-links a'    => array(
				'border-color' => $link_color,
				'color'        => $link_color,
			),

			'.ast-product-navigation-wrapper .product-links a:hover'    => array(
				'background' => $link_color,
				'color'      => astra_get_foreground_color( $link_color ),
			),

			'.ast-product-navigation-wrapper.circle .product-links a, .ast-product-navigation-wrapper.square .product-links a'    => array(
				'background' => $link_color,
				'color'      => astra_get_foreground_color( $link_color ),
			),
		);

		$css_output .= astra_parse_css( $product_nav );
	}

	if ( $two_step_checkout ) {

		$two_step_nav_colors_light  = astra_hex_to_rgba( $link_color, 0.4 );
		$two_step_nav_colors_medium = astra_hex_to_rgba( $link_color, 1 );

		/**
		 * Two Step Checkout Style
		 */
		$two_step_checkout = array(

			'.ast-woo-two-step-checkout .ast-checkout-control-nav li a:after'    => array(
				'background-color' => $link_color,
				'border-color'     => $two_step_nav_colors_medium,
			),
			'.ast-woo-two-step-checkout .ast-checkout-control-nav li:nth-child(2) a.flex-active:after'    => array(
				'border-color' => $two_step_nav_colors_medium,
			),
			'.ast-woo-two-step-checkout .ast-checkout-control-nav li a:before, .ast-woo-two-step-checkout .ast-checkout-control-nav li:nth-child(2) a.flex-active:before'    => array(
				'background-color' => $two_step_nav_colors_medium,
			),
			'.ast-woo-two-step-checkout .ast-checkout-control-nav li:nth-child(2) a:before'    => array(
				'background-color' => $two_step_nav_colors_light,
			),
			'.ast-woo-two-step-checkout .ast-checkout-control-nav li:nth-child(2) a:after '    => array(
				'border-color' => $two_step_nav_colors_light,
			),
		);

		$css_output .= astra_parse_css( $two_step_checkout );
	}

	$product_width = array(
		'.woocommerce #content .ast-woocommerce-container div.product div.images, .woocommerce .ast-woocommerce-container div.product div.images, .woocommerce-page #content .ast-woocommerce-container div.product div.images, .woocommerce-page .ast-woocommerce-container div.product div.images' => array(
			'width' => $product_img_width . '%',
		),
		'.woocommerce #content .ast-woocommerce-container div.product div.summary, .woocommerce .ast-woocommerce-container div.product div.summary, .woocommerce-page #content .ast-woocommerce-container div.product div.summary, .woocommerce-page .ast-woocommerce-container div.product div.summary' => array(
			'width' => $product_desc_width . '%',
		),
		'.woocommerce div.product.ast-product-gallery-layout-vertical div.images .flex-control-thumbs' => array(
			'width' => '20%',
			'width' => 'calc(25% - 1em)',
		),
		'.woocommerce div.product.ast-product-gallery-layout-vertical div.images .flex-control-thumbs li' => array(
			'width' => '100%',
		),
		'.woocommerce.ast-woo-two-step-checkout form #order_review, .woocommerce.ast-woo-two-step-checkout form #order_review_heading, .woocommerce-page.ast-woo-two-step-checkout form #order_review, .woocommerce-page.ast-woo-two-step-checkout form #order_review_heading, .woocommerce.ast-woo-two-step-checkout form #customer_details.col2-set, .woocommerce-page.ast-woo-two-step-checkout form #customer_details.col2-set' => array(
			'width' => '100%',
		),
	);

	$left_position = (int) $product_img_width * 25 / 100;

	if ( $is_site_rtl ) {
		$css_output .= '@media screen and ( min-width: ' . astra_addon_get_tablet_breakpoint( '', 1 ) . 'px ) { .woocommerce div.product.ast-product-gallery-layout-vertical .onsale {
			left: ' . $left_position . '%;
			left: -webkit-calc(' . $left_position . '% - .5em);
			left: calc(' . $left_position . '% - .5em);
		} .woocommerce div.product.ast-product-gallery-with-no-image .onsale {
			top:  -.5em;
			right: -.5em;
		} }';
	} else {
		$css_output .= '@media screen and ( min-width: ' . astra_addon_get_tablet_breakpoint( '', 1 ) . 'px ) { .woocommerce div.product.ast-product-gallery-layout-vertical .onsale {
			left: ' . $left_position . '%;
			left: -webkit-calc(' . $left_position . '% - .5em);
			left: calc(' . $left_position . '% - .5em);
		} .woocommerce div.product.ast-product-gallery-with-no-image .onsale {
			top:  -.5em;
			left: -.5em;
		} }';
	}

	/* Parse CSS from array()*/
	$css_output .= astra_parse_css( $product_width, astra_addon_get_tablet_breakpoint( '', 1 ) );

	if ( $is_site_rtl ) {
		$product_width_lang_direction_css = array(
			'.woocommerce div.product.ast-product-gallery-layout-vertical .flex-viewport' => array(
				'width' => '75%',
				'float' => 'left',
			),
		);
	} else {
		$product_width_lang_direction_css = array(
			'.woocommerce div.product.ast-product-gallery-layout-vertical .flex-viewport' => array(
				'width' => '75%',
				'float' => 'right',
			),
		);
	}

	/* Parse CSS from array()*/
	$css_output .= astra_parse_css( $product_width_lang_direction_css, astra_addon_get_tablet_breakpoint( '', 1 ) );

	$max_tablet_css = array(
		'.ast-product-navigation-wrapper' => array(
			'text-align' => 'center',
		),
	);

	/* Parse CSS from array()*/
	$css_output .= astra_parse_css( $max_tablet_css, '', astra_addon_get_tablet_breakpoint( '', 1 ) );

	/* Checkout Width */
	if ( 'custom' === $checkout_width ) :
			$checkout_css  = '@media (min-width: ' . astra_addon_get_tablet_breakpoint( '', 1 ) . 'px) {';
			$checkout_css .= '.woocommerce-checkout form.checkout {';
			$checkout_css .= 'max-width:' . esc_attr( $checkout_custom_width ) . 'px;';
			$checkout_css .= 'margin:' . esc_attr( '0 auto' ) . ';';
			$checkout_css .= '}';
			$checkout_css .= '}';
			$css_output   .= $checkout_css;
	endif;

	if ( $is_site_rtl ) {
		$tablet_min_width = array(
			'#ast-quick-view-content div.summary form.cart.stick' => array(
				'position'   => 'absolute',
				'bottom'     => 0,
				'background' => '#fff',
				'margin'     => 0,
				'padding'    => '20px 0 30px 30px',
				'width'      => '50%',
				'width'      => '-webkit-calc(50% - 30px)',
				'width'      => 'calc(50% - 30px)',
			),
		);
	} else {
		$tablet_min_width = array(
			'#ast-quick-view-content div.summary form.cart.stick' => array(
				'position'   => 'absolute',
				'bottom'     => 0,
				'background' => '#fff',
				'margin'     => 0,
				'padding'    => '20px 30px 30px 0',
				'width'      => '50%',
				'width'      => '-webkit-calc(50% - 30px)',
				'width'      => 'calc(50% - 30px)',
			),
		);
	}

	$css_output .= astra_parse_css( $tablet_min_width, astra_addon_get_tablet_breakpoint() );

	$tablet_css = array(
		'#ast-quick-view-content div.summary form.cart.stick .button' => array(
			'padding' => '10px',
		),
		'#ast-quick-view-modal .ast-content-main-wrapper' => array(
			'top'       => 0,
			'right'     => 0,
			'bottom'    => 0,
			'left'      => 0,
			'transform' => 'none !important',
			'width'     => '100%',
			'position'  => 'relative',
			'overflow'  => 'hidden',
			'padding'   => '10%',
		),
		'#ast-quick-view-content div.summary, #ast-quick-view-content div.images' => array(
			'min-width' => 'auto',
		),
		'#ast-quick-view-modal.open .ast-content-main'    => array(
			'transform' => 'none !important',
		),
		'.single-product div.product .entry-title'        => array(
			'font-size' => astra_responsive_font( $product_title_font_size, 'tablet' ),
		),
		// Single Product Content.
		'.single-product div.product .woocommerce-product-details__short-description, .single-product div.product .product_meta, .single-product div.product .entry-content' => array(
			'font-size' => astra_responsive_font( $product_content_font_size, 'tablet' ),
		),
		'.single-product div.product p.price, .single-product div.product span.price' => array(
			'font-size' => astra_responsive_font( $product_price_font_size, 'tablet' ),
		),
		'.single-product div.product .woocommerce-breadcrumb' => array(
			'font-size' => astra_responsive_font( $product_breadcrumb_font_size, 'tablet' ),
		),
		'.woocommerce ul.products li.product .woocommerce-loop-product__title, .woocommerce-page ul.products li.product .woocommerce-loop-product__title, .wc-block-grid .wc-block-grid__products .wc-block-grid__product .wc-block-grid__product-title' => array(
			'font-size' => astra_responsive_font( $shop_product_title_font_size, 'tablet' ),
		),
		'.woocommerce ul.products li.product .price, .woocommerce-page ul.products li.product .price, .wc-block-grid .wc-block-grid__products .wc-block-grid__product .wc-block-grid__product-price' => array(
			'font-size' => astra_responsive_font( $shop_product_price_font_size, 'tablet' ),
		),
		'.woocommerce ul.products li.product .ast-woo-product-category, .woocommerce-page ul.products li.product .ast-woo-product-category, .woocommerce ul.products li.product .ast-woo-shop-product-description, .woocommerce-page ul.products li.product .ast-woo-shop-product-description' => array(
			'font-size' => astra_responsive_font( $shop_product_content_font_size, 'tablet' ),
		),
		'.woocommerce .astra-shop-filter-button, .woocommerce button.astra-shop-filter-button, .woocommerce-page .astra-shop-filter-button, .woocommerce-page button.astra-shop-filter-button' => array(
			'margin-bottom' => '10px',
		),
	);

	/* Display Tablet Up sell Products */
	if ( $load_upsell_grid_css ) {
		$tablet_css[ '.woocommerce-page.tablet-rel-up-columns-' . $products_grid_tablet . ' .up-sells ul.products' ] = array(
			'grid-template-columns' => 'repeat(' . $products_grid_tablet . ', minmax(0, 1fr))',
		);
	}

	$css_output .= astra_parse_css( $tablet_css, '', astra_addon_get_tablet_breakpoint() );

	if ( $is_site_rtl ) {
		$max_tablet_lang_direction_css = array(
			'.woocommerce div.product .related.products ul.products li.product, .woocommerce[class*="rel-up-columns-"] div.product .related.products ul.products li.product, .woocommerce-page div.product .related.products ul.products li.product, .woocommerce-page[class*="rel-up-columns-"] div.product .related.products ul.products li.product' => array(
				'margin-left' => '20px',
				'clear'       => 'none',
			),
		);
	} else {
		$max_tablet_lang_direction_css = array(
			'.woocommerce div.product .related.products ul.products li.product, .woocommerce[class*="rel-up-columns-"] div.product .related.products ul.products li.product, .woocommerce-page div.product .related.products ul.products li.product, .woocommerce-page[class*="rel-up-columns-"] div.product .related.products ul.products li.product' => array(
				'margin-right' => '20px',
				'clear'        => 'none',
			),
		);
	}

	$css_output .= astra_parse_css( $max_tablet_lang_direction_css, '', astra_addon_get_tablet_breakpoint() );

	if ( ! Astra_Addon_Builder_Helper::apply_flex_based_css() ) {

		if ( $is_site_rtl ) {
			$max_tablet_min_mobile_css = array(
				'.woocommerce-page.tablet-rel-up-columns-1 div.product .related.products ul.products li.product, .woocommerce-page.tablet-rel-up-columns-1 div.product .up-sells ul.products li.product, .woocommerce.tablet-rel-up-columns-1 div.product .related.products ul.products li.product, .woocommerce.tablet-rel-up-columns-1 div.product .up-sells ul.products li.product' => array(
					'width'       => '100%',
					'margin-left' => 0,
				),
				'.woocommerce-page.tablet-rel-up-columns-2 div.product .related.products ul.products li.product, .woocommerce-page.tablet-rel-up-columns-2 div.product .up-sells ul.products li.product, .woocommerce.tablet-rel-up-columns-2 div.product .related.products ul.products li.product, .woocommerce.tablet-rel-up-columns-2 div.product .up-sells ul.products li.product' => array(
					'width'       => '47.6%',
					'width'       => 'calc(50% - 10px)',
					'margin-left' => '20px',
				),
				'.woocommerce-page.tablet-rel-up-columns-2 div.product .related.products ul.products li.product:nth-child(2n), .woocommerce-page.tablet-rel-up-columns-2 div.product .up-sells ul.products li.product:nth-child(2n), .woocommerce.tablet-rel-up-columns-2 div.product .related.products ul.products li.product:nth-child(2n), .woocommerce.tablet-rel-up-columns-2 div.product .up-sells ul.products li.product:nth-child(2n)' => array(
					'clear'       => 'left',
					'margin-left' => 0,
				),
				'.woocommerce-page.tablet-rel-up-columns-2 div.product .related.products ul.products li.product:nth-child(2n+1), .woocommerce-page.tablet-rel-up-columns-2 div.product .up-sells ul.products li.product:nth-child(2n+1), .woocommerce.tablet-rel-up-columns-2 div.product .related.products ul.products li.product:nth-child(2n+1), .woocommerce.tablet-rel-up-columns-2 div.product .up-sells ul.products li.product:nth-child(2n+1)' => array(
					'clear' => 'right',
				),
				'.woocommerce-page.tablet-rel-up-columns-3 div.product .related.products ul.products li.product, .woocommerce-page.tablet-rel-up-columns-3 div.product .up-sells ul.products li.product, .woocommerce.tablet-rel-up-columns-3 div.product .related.products ul.products li.product, .woocommerce.tablet-rel-up-columns-3 div.product .up-sells ul.products li.product' => array(
					'width' => '30.2%',
					'width' => 'calc(33.33% - 14px)',
				),
				'.woocommerce-page.tablet-rel-up-columns-3 div.product .related.products ul.products li.product:nth-child(3n), .woocommerce-page.tablet-rel-up-columns-3 div.product .up-sells ul.products li.product:nth-child(3n), .woocommerce.tablet-rel-up-columns-3 div.product .related.products ul.products li.product:nth-child(3n), .woocommerce.tablet-rel-up-columns-3 div.product .up-sells ul.products li.product:nth-child(3n)' => array(
					'clear'       => 'left',
					'margin-left' => 0,
				),
				'.woocommerce-page.tablet-rel-up-columns-3 div.product .related.products ul.products li.product:nth-child(3n+1), .woocommerce-page.tablet-rel-up-columns-3 div.product .up-sells ul.products li.product:nth-child(3n+1), .woocommerce.tablet-rel-up-columns-3 div.product .related.products ul.products li.product:nth-child(3n+1), .woocommerce.tablet-rel-up-columns-3 div.product .up-sells ul.products li.product:nth-child(3n+1)' => array(
					'clear' => 'right',
				),
				'.woocommerce-page.tablet-rel-up-columns-4 div.product .related.products ul.products li.product, .woocommerce-page.tablet-rel-up-columns-4 div.product .up-sells ul.products li.product, .woocommerce.tablet-rel-up-columns-4 div.product .related.products ul.products li.product, .woocommerce.tablet-rel-up-columns-4 div.product .up-sells ul.products li.product' => array(
					'width' => '21.5%',
					'width' => 'calc(25% - 15px)',
				),
				'.woocommerce-page.tablet-rel-up-columns-4 div.product .related.products ul.products li.product:nth-child(4n), .woocommerce-page.tablet-rel-up-columns-4 div.product .up-sells ul.products li.product:nth-child(4n), .woocommerce.tablet-rel-up-columns-4 div.product .related.products ul.products li.product:nth-child(4n), .woocommerce.tablet-rel-up-columns-4 div.product .up-sells ul.products li.product:nth-child(4n)' => array(
					'clear'       => 'left',
					'margin-left' => 0,
				),
				'.woocommerce-page.tablet-rel-up-columns-4 div.product .related.products ul.products li.product:nth-child(4n+1), .woocommerce-page.tablet-rel-up-columns-4 div.product .up-sells ul.products li.product:nth-child(4n+1), .woocommerce.tablet-rel-up-columns-4 div.product .related.products ul.products li.product:nth-child(4n+1), .woocommerce.tablet-rel-up-columns-4 div.product .up-sells ul.products li.product:nth-child(4n+1)' => array(
					'clear' => 'right',
				),
				'.woocommerce-page.tablet-rel-up-columns-5 div.product .related.products ul.products li.product, .woocommerce-page.tablet-rel-up-columns-5 div.product .up-sells ul.products li.product, .woocommerce.tablet-rel-up-columns-5 div.product .related.products ul.products li.product, .woocommerce.tablet-rel-up-columns-5 div.product .up-sells ul.products li.product' => array(
					'width' => '16.2%',
					'width' => 'calc(20% - 16px)',
				),
				'.woocommerce-page.tablet-rel-up-columns-5 div.product .related.products ul.products li.product:nth-child(5n), .woocommerce-page.tablet-rel-up-columns-5 div.product .up-sells ul.products li.product:nth-child(5n), .woocommerce.tablet-rel-up-columns-5 div.product .related.products ul.products li.product:nth-child(5n), .woocommerce.tablet-rel-up-columns-5 div.product .up-sells ul.products li.product:nth-child(5n)' => array(
					'clear'       => 'left',
					'margin-left' => 0,
				),
				'.woocommerce-page.tablet-rel-up-columns-5 div.product .related.products ul.products li.product:nth-child(5n+1), .woocommerce-page.tablet-rel-up-columns-5 div.product .up-sells ul.products li.product:nth-child(5n+1), .woocommerce.tablet-rel-up-columns-5 div.product .related.products ul.products li.product:nth-child(5n+1), .woocommerce.tablet-rel-up-columns-5 div.product .up-sells ul.products li.product:nth-child(5n+1)' => array(
					'clear' => 'right',
				),
				'.woocommerce-page.tablet-rel-up-columns-6 div.product .related.products ul.products li.product, .woocommerce-page.tablet-rel-up-columns-6 div.product .up-sells ul.products li.product, .woocommerce.tablet-rel-up-columns-6 div.product .related.products ul.products li.product, .woocommerce.tablet-rel-up-columns-6 div.product .up-sells ul.products li.product' => array(
					'width' => '12.7%',
					'width' => 'calc(16.66% - 17px)',
				),
				'.woocommerce-page.tablet-rel-up-columns-6 div.product .related.products ul.products li.product:nth-child(6n), .woocommerce-page.tablet-rel-up-columns-6 div.product .up-sells ul.products li.product:nth-child(6n), .woocommerce.tablet-rel-up-columns-6 div.product .related.products ul.products li.product:nth-child(6n), .woocommerce.tablet-rel-up-columns-6 div.product .up-sells ul.products li.product:nth-child(6n)' => array(
					'clear'       => 'left',
					'margin-left' => 0,
				),
				'.woocommerce-page.tablet-rel-up-columns-6 div.product .related.products ul.products li.product:nth-child(6n+1), .woocommerce-page.tablet-rel-up-columns-6 div.product .up-sells ul.products li.product:nth-child(6n+1), .woocommerce.tablet-rel-up-columns-6 div.product .related.products ul.products li.product:nth-child(6n+1), .woocommerce.tablet-rel-up-columns-6 div.product .up-sells ul.products li.product:nth-child(6n+1)' => array(
					'clear' => 'right',
				),
			);
		} else {
			$max_tablet_min_mobile_css = array(
				'.woocommerce-page.tablet-rel-up-columns-1 div.product .related.products ul.products li.product, .woocommerce-page.tablet-rel-up-columns-1 div.product .up-sells ul.products li.product, .woocommerce.tablet-rel-up-columns-1 div.product .related.products ul.products li.product, .woocommerce.tablet-rel-up-columns-1 div.product .up-sells ul.products li.product' => array(
					'width'        => '100%',
					'margin-right' => 0,
				),
				'.woocommerce-page.tablet-rel-up-columns-2 div.product .related.products ul.products li.product, .woocommerce-page.tablet-rel-up-columns-2 div.product .up-sells ul.products li.product, .woocommerce.tablet-rel-up-columns-2 div.product .related.products ul.products li.product, .woocommerce.tablet-rel-up-columns-2 div.product .up-sells ul.products li.product' => array(
					'width'        => '47.6%',
					'width'        => 'calc(50% - 10px)',
					'margin-right' => '20px',
				),
				'.woocommerce-page.tablet-rel-up-columns-2 div.product .related.products ul.products li.product:nth-child(2n), .woocommerce-page.tablet-rel-up-columns-2 div.product .up-sells ul.products li.product:nth-child(2n), .woocommerce.tablet-rel-up-columns-2 div.product .related.products ul.products li.product:nth-child(2n), .woocommerce.tablet-rel-up-columns-2 div.product .up-sells ul.products li.product:nth-child(2n)' => array(
					'clear'        => 'right',
					'margin-right' => 0,
				),
				'.woocommerce-page.tablet-rel-up-columns-2 div.product .related.products ul.products li.product:nth-child(2n+1), .woocommerce-page.tablet-rel-up-columns-2 div.product .up-sells ul.products li.product:nth-child(2n+1), .woocommerce.tablet-rel-up-columns-2 div.product .related.products ul.products li.product:nth-child(2n+1), .woocommerce.tablet-rel-up-columns-2 div.product .up-sells ul.products li.product:nth-child(2n+1)' => array(
					'clear' => 'left',
				),
				'.woocommerce-page.tablet-rel-up-columns-3 div.product .related.products ul.products li.product, .woocommerce-page.tablet-rel-up-columns-3 div.product .up-sells ul.products li.product, .woocommerce.tablet-rel-up-columns-3 div.product .related.products ul.products li.product, .woocommerce.tablet-rel-up-columns-3 div.product .up-sells ul.products li.product' => array(
					'width' => '30.2%',
					'width' => 'calc(33.33% - 14px)',
				),
				'.woocommerce-page.tablet-rel-up-columns-3 div.product .related.products ul.products li.product:nth-child(3n), .woocommerce-page.tablet-rel-up-columns-3 div.product .up-sells ul.products li.product:nth-child(3n), .woocommerce.tablet-rel-up-columns-3 div.product .related.products ul.products li.product:nth-child(3n), .woocommerce.tablet-rel-up-columns-3 div.product .up-sells ul.products li.product:nth-child(3n)' => array(
					'clear'        => 'right',
					'margin-right' => 0,
				),
				'.woocommerce-page.tablet-rel-up-columns-3 div.product .related.products ul.products li.product:nth-child(3n+1), .woocommerce-page.tablet-rel-up-columns-3 div.product .up-sells ul.products li.product:nth-child(3n+1), .woocommerce.tablet-rel-up-columns-3 div.product .related.products ul.products li.product:nth-child(3n+1), .woocommerce.tablet-rel-up-columns-3 div.product .up-sells ul.products li.product:nth-child(3n+1)' => array(
					'clear' => 'left',
				),
				'.woocommerce-page.tablet-rel-up-columns-4 div.product .related.products ul.products li.product, .woocommerce-page.tablet-rel-up-columns-4 div.product .up-sells ul.products li.product, .woocommerce.tablet-rel-up-columns-4 div.product .related.products ul.products li.product, .woocommerce.tablet-rel-up-columns-4 div.product .up-sells ul.products li.product' => array(
					'width' => '21.5%',
					'width' => 'calc(25% - 15px)',
				),
				'.woocommerce-page.tablet-rel-up-columns-4 div.product .related.products ul.products li.product:nth-child(4n), .woocommerce-page.tablet-rel-up-columns-4 div.product .up-sells ul.products li.product:nth-child(4n), .woocommerce.tablet-rel-up-columns-4 div.product .related.products ul.products li.product:nth-child(4n), .woocommerce.tablet-rel-up-columns-4 div.product .up-sells ul.products li.product:nth-child(4n)' => array(
					'clear'        => 'right',
					'margin-right' => 0,
				),
				'.woocommerce-page.tablet-rel-up-columns-4 div.product .related.products ul.products li.product:nth-child(4n+1), .woocommerce-page.tablet-rel-up-columns-4 div.product .up-sells ul.products li.product:nth-child(4n+1), .woocommerce.tablet-rel-up-columns-4 div.product .related.products ul.products li.product:nth-child(4n+1), .woocommerce.tablet-rel-up-columns-4 div.product .up-sells ul.products li.product:nth-child(4n+1)' => array(
					'clear' => 'left',
				),
				'.woocommerce-page.tablet-rel-up-columns-5 div.product .related.products ul.products li.product, .woocommerce-page.tablet-rel-up-columns-5 div.product .up-sells ul.products li.product, .woocommerce.tablet-rel-up-columns-5 div.product .related.products ul.products li.product, .woocommerce.tablet-rel-up-columns-5 div.product .up-sells ul.products li.product' => array(
					'width' => '16.2%',
					'width' => 'calc(20% - 16px)',
				),
				'.woocommerce-page.tablet-rel-up-columns-5 div.product .related.products ul.products li.product:nth-child(5n), .woocommerce-page.tablet-rel-up-columns-5 div.product .up-sells ul.products li.product:nth-child(5n), .woocommerce.tablet-rel-up-columns-5 div.product .related.products ul.products li.product:nth-child(5n), .woocommerce.tablet-rel-up-columns-5 div.product .up-sells ul.products li.product:nth-child(5n)' => array(
					'clear'        => 'right',
					'margin-right' => 0,
				),
				'.woocommerce-page.tablet-rel-up-columns-5 div.product .related.products ul.products li.product:nth-child(5n+1), .woocommerce-page.tablet-rel-up-columns-5 div.product .up-sells ul.products li.product:nth-child(5n+1), .woocommerce.tablet-rel-up-columns-5 div.product .related.products ul.products li.product:nth-child(5n+1), .woocommerce.tablet-rel-up-columns-5 div.product .up-sells ul.products li.product:nth-child(5n+1)' => array(
					'clear' => 'left',
				),
				'.woocommerce-page.tablet-rel-up-columns-6 div.product .related.products ul.products li.product, .woocommerce-page.tablet-rel-up-columns-6 div.product .up-sells ul.products li.product, .woocommerce.tablet-rel-up-columns-6 div.product .related.products ul.products li.product, .woocommerce.tablet-rel-up-columns-6 div.product .up-sells ul.products li.product' => array(
					'width' => '12.7%',
					'width' => 'calc(16.66% - 17px)',
				),
				'.woocommerce-page.tablet-rel-up-columns-6 div.product .related.products ul.products li.product:nth-child(6n), .woocommerce-page.tablet-rel-up-columns-6 div.product .up-sells ul.products li.product:nth-child(6n), .woocommerce.tablet-rel-up-columns-6 div.product .related.products ul.products li.product:nth-child(6n), .woocommerce.tablet-rel-up-columns-6 div.product .up-sells ul.products li.product:nth-child(6n)' => array(
					'clear'        => 'right',
					'margin-right' => 0,
				),
				'.woocommerce-page.tablet-rel-up-columns-6 div.product .related.products ul.products li.product:nth-child(6n+1), .woocommerce-page.tablet-rel-up-columns-6 div.product .up-sells ul.products li.product:nth-child(6n+1), .woocommerce.tablet-rel-up-columns-6 div.product .related.products ul.products li.product:nth-child(6n+1), .woocommerce.tablet-rel-up-columns-6 div.product .up-sells ul.products li.product:nth-child(6n+1)' => array(
					'clear' => 'left',
				),
			);
		}
		$css_output .= astra_parse_css( $max_tablet_min_mobile_css, astra_addon_get_mobile_breakpoint( '', 1 ), astra_addon_get_tablet_breakpoint() );
	}

	$mobile_min_css = array(
		'#ast-quick-view-content div.summary' => array(
			'content'    => astra_addon_get_mobile_breakpoint(),
			'overflow-y' => 'auto',
		),
	);

	$css_output .= astra_parse_css( $mobile_min_css, astra_addon_get_mobile_breakpoint( '', 1 ) );

	if ( $is_site_rtl ) {
		$mobile_woo_css = array(
			'.woocommerce button.astra-shop-filter-button, .woocommerce-page button.astra-shop-filter-button' => array(
				'float'   => 'none',
				'display' => 'block',
			),
			'#ast-quick-view-content'                  => array(
				'max-width'  => 'initial !important',
				'max-height' => 'initial !important',
			),
			'#ast-quick-view-content div.images'       => array(
				'width' => '100%',
				'float' => 'none',
			),
			'#ast-quick-view-content div.summary'      => array(
				'width'      => '100%',
				'float'      => 'none',
				'margin'     => 0,
				'padding'    => '15px',
				'width'      => '100%',
				'float'      => 'right',
				'max-height' => 'initial !important',
			),
			'.single-product div.product .entry-title' => array(
				'font-size' => astra_responsive_font( $product_title_font_size, 'mobile' ),
			),
			'.single-product div.product .woocommerce-product-details__short-description, .single-product div.product .product_meta, .single-product div.product .entry-content' => array(
				'font-size' => astra_responsive_font( $product_content_font_size, 'mobile' ),
			),
			'.single-product div.product p.price, .single-product div.product span.price' => array(
				'font-size' => astra_responsive_font( $product_price_font_size, 'mobile' ),
			),
			'.single-product div.product .woocommerce-breadcrumb' => array(
				'font-size' => astra_responsive_font( $product_breadcrumb_font_size, 'mobile' ),
			),
			'.woocommerce ul.products li.product .woocommerce-loop-product__title, .woocommerce-page ul.products li.product .woocommerce-loop-product__title, .wc-block-grid .wc-block-grid__products .wc-block-grid__product .wc-block-grid__product-title' => array(
				'font-size' => astra_responsive_font( $shop_product_title_font_size, 'mobile' ),
			),
			'.woocommerce ul.products li.product .price, .woocommerce-page ul.products li.product .price, .wc-block-grid .wc-block-grid__products .wc-block-grid__product .wc-block-grid__product-price' => array(
				'font-size' => astra_responsive_font( $shop_product_price_font_size, 'mobile' ),
			),
			'.woocommerce ul.products li.product .ast-woo-product-category, .woocommerce-page ul.products li.product .ast-woo-product-category, .woocommerce ul.products li.product .ast-woo-shop-product-description, .woocommerce-page ul.products li.product .ast-woo-shop-product-description' => array(
				'font-size' => astra_responsive_font( $shop_product_content_font_size, 'mobile' ),
			),
			'.ast-header-break-point .ast-above-header-mobile-inline.mobile-header-order-2 .ast-masthead-custom-menu-items.woocommerce-custom-menu-item' => array(
				'margin-right' => 0,
			),
			'.ast-header-break-point .ast-above-header-mobile-inline.mobile-header-order-3 .ast-masthead-custom-menu-items.woocommerce-custom-menu-item, .ast-header-break-point .ast-above-header-mobile-inline.mobile-header-order-5 .ast-masthead-custom-menu-items.woocommerce-custom-menu-item' => array(
				'margin-left' => 0,
			),
		);
	} else {
		$mobile_woo_css = array(
			'.woocommerce button.astra-shop-filter-button, .woocommerce-page button.astra-shop-filter-button' => array(
				'float'   => 'none',
				'display' => 'block',
			),
			'#ast-quick-view-content'                  => array(
				'max-width'  => 'initial !important',
				'max-height' => 'initial !important',
			),
			'#ast-quick-view-content div.images'       => array(
				'width' => '100%',
				'float' => 'none',
			),
			'#ast-quick-view-content div.summary'      => array(
				'width'      => '100%',
				'float'      => 'none',
				'margin'     => 0,
				'padding'    => '15px',
				'width'      => '100%',
				'float'      => 'left',
				'max-height' => 'initial !important',
			),
			'.single-product div.product .entry-title' => array(
				'font-size' => astra_responsive_font( $product_title_font_size, 'mobile' ),
			),
			'.single-product div.product .woocommerce-product-details__short-description, .single-product div.product .product_meta, .single-product div.product .entry-content' => array(
				'font-size' => astra_responsive_font( $product_content_font_size, 'mobile' ),
			),
			'.single-product div.product p.price, .single-product div.product span.price' => array(
				'font-size' => astra_responsive_font( $product_price_font_size, 'mobile' ),
			),
			'.single-product div.product .woocommerce-breadcrumb' => array(
				'font-size' => astra_responsive_font( $product_breadcrumb_font_size, 'mobile' ),
			),
			'.woocommerce ul.products li.product .woocommerce-loop-product__title, .woocommerce-page ul.products li.product .woocommerce-loop-product__title, .wc-block-grid .wc-block-grid__products .wc-block-grid__product .wc-block-grid__product-title' => array(
				'font-size' => astra_responsive_font( $shop_product_title_font_size, 'mobile' ),
			),
			'.woocommerce ul.products li.product .price, .woocommerce-page ul.products li.product .price, .wc-block-grid .wc-block-grid__products .wc-block-grid__product .wc-block-grid__product-price' => array(
				'font-size' => astra_responsive_font( $shop_product_price_font_size, 'mobile' ),
			),
			'.woocommerce ul.products li.product .ast-woo-product-category, .woocommerce-page ul.products li.product .ast-woo-product-category, .woocommerce ul.products li.product .ast-woo-shop-product-description, .woocommerce-page ul.products li.product .ast-woo-shop-product-description' => array(
				'font-size' => astra_responsive_font( $shop_product_content_font_size, 'mobile' ),
			),
			'.ast-header-break-point .ast-above-header-mobile-inline.mobile-header-order-2 .ast-masthead-custom-menu-items.woocommerce-custom-menu-item' => array(
				'margin-left' => 0,
			),
			'.ast-header-break-point .ast-above-header-mobile-inline.mobile-header-order-3 .ast-masthead-custom-menu-items.woocommerce-custom-menu-item, .ast-header-break-point .ast-above-header-mobile-inline.mobile-header-order-5 .ast-masthead-custom-menu-items.woocommerce-custom-menu-item' => array(
				'margin-right' => 0,
			),
		);
	}

	if ( ! Astra_Addon_Builder_Helper::apply_flex_based_css() ) {

		// Load flex based CSS for grid.
		if ( $is_site_rtl ) {
			$mobile_woo_flex_css = array(
				'.woocommerce-page.mobile-rel-up-columns-1 div.product .related.products ul.products li.product, .woocommerce-page.mobile-rel-up-columns-1 div.product .up-sells ul.products li.product, .woocommerce.mobile-rel-up-columns-1 div.product .related.products ul.products li.product, .woocommerce.mobile-rel-up-columns-1 div.product .up-sells ul.products li.product' => array(
					'width'       => '100%',
					'margin-left' => 0,
				),
				'.woocommerce-page.mobile-rel-up-columns-2 div.product .related.products ul.products li.product, .woocommerce-page.mobile-rel-up-columns-2 div.product .up-sells ul.products li.product, .woocommerce.mobile-rel-up-columns-2 div.product .related.products ul.products li.product, .woocommerce.mobile-rel-up-columns-2 div.product .up-sells ul.products li.product' => array(
					'width' => '46.1%',
					'width' => 'calc(50% - 10px)',
				),
				'.woocommerce-page.mobile-rel-up-columns-2 div.product .related.products ul.products li.product:nth-child(2n), .woocommerce-page.mobile-rel-up-columns-2 div.product .up-sells ul.products li.product:nth-child(2n), .woocommerce.mobile-rel-up-columns-2 div.product .related.products ul.products li.product:nth-child(2n), .woocommerce.mobile-rel-up-columns-2 div.product .up-sells ul.products li.product:nth-child(2n)' => array(
					'margin-left' => 0,
					'clear'       => 'left',
				),
				'.woocommerce-page.mobile-rel-up-columns-2 div.product .related.products ul.products li.product:nth-child(2n+1), .woocommerce-page.mobile-rel-up-columns-2 div.product .up-sells ul.products li.product:nth-child(2n+1), .woocommerce.mobile-rel-up-columns-2 div.product .related.products ul.products li.product:nth-child(2n+1), .woocommerce.mobile-rel-up-columns-2 div.product .up-sells ul.products li.product:nth-child(2n+1)' => array(
					'clear' => 'right',
				),
				'.woocommerce-page.mobile-rel-up-columns-3 div.product .related.products ul.products li.product, .woocommerce-page.mobile-rel-up-columns-3 div.product .up-sells ul.products li.product, .woocommerce.mobile-rel-up-columns-3 div.product .related.products ul.products li.product, .woocommerce.mobile-rel-up-columns-3 div.product .up-sells ul.products li.product' => array(
					'width'       => '28.2%',
					'width'       => 'calc(33.33% - 14px)',
					'margin-left' => '20px',
				),
				'.woocommerce-page.mobile-rel-up-columns-3 div.product .related.products ul.products li.product:nth-child(3n), .woocommerce-page.mobile-rel-up-columns-3 div.product .up-sells ul.products li.product:nth-child(3n), .woocommerce.mobile-rel-up-columns-3 div.product .related.products ul.products li.product:nth-child(3n), .woocommerce.mobile-rel-up-columns-3 div.product .up-sells ul.products li.product:nth-child(3n)' => array(
					'margin-left' => 0,
					'clear'       => 'left',
				),
				'.woocommerce-page.mobile-rel-up-columns-3 div.product .related.products ul.products li.product:nth-child(3n+1), .woocommerce-page.mobile-rel-up-columns-3 div.product .up-sells ul.products li.product:nth-child(3n+1), .woocommerce.mobile-rel-up-columns-3 div.product .related.products ul.products li.product:nth-child(3n+1), .woocommerce.mobile-rel-up-columns-3 div.product .up-sells ul.products li.product:nth-child(3n+1)' => array(
					'clear' => 'right',
				),
				'.woocommerce-page.mobile-rel-up-columns-4 div.product .related.products ul.products li.product, .woocommerce-page.mobile-rel-up-columns-4 div.product .up-sells ul.products li.product, .woocommerce.mobile-rel-up-columns-4 div.product .related.products ul.products li.product, .woocommerce.mobile-rel-up-columns-4 div.product .up-sells ul.products li.product' => array(
					'width'       => '19%',
					'width'       => 'calc(25% - 15px)',
					'margin-left' => '20px',
					'clear'       => 'none',
				),
				'.woocommerce-page.mobile-rel-up-columns-4 div.product .related.products ul.products li.product:nth-child(4n), .woocommerce-page.mobile-rel-up-columns-4 div.product .up-sells ul.products li.product:nth-child(4n), .woocommerce.mobile-rel-up-columns-4 div.product .related.products ul.products li.product:nth-child(4n), .woocommerce.mobile-rel-up-columns-4 div.product .up-sells ul.products li.product:nth-child(4n)' => array(
					'clear'       => 'left',
					'margin-left' => 0,
				),
				'.woocommerce-page.mobile-rel-up-columns-4 div.product .related.products ul.products li.product:nth-child(4n+1), .woocommerce-page.mobile-rel-up-columns-4 div.product .up-sells ul.products li.product:nth-child(4n+1), .woocommerce.mobile-rel-up-columns-4 div.product .related.products ul.products li.product:nth-child(4n+1), .woocommerce.mobile-rel-up-columns-4 div.product .up-sells ul.products li.product:nth-child(4n+1)' => array(
					'clear' => 'right',
				),
				'.woocommerce-page.mobile-rel-up-columns-5 div.product .related.products ul.products li.product, .woocommerce-page.mobile-rel-up-columns-5 div.product .up-sells ul.products li.product, .woocommerce.mobile-rel-up-columns-5 div.product .related.products ul.products li.product, .woocommerce.mobile-rel-up-columns-5 div.product .up-sells ul.products li.product' => array(
					'width' => '13%',
					'width' => 'calc(20% - 16px)',
				),
				'.woocommerce-page.mobile-rel-up-columns-5 div.product .related.products ul.products li.product:nth-child(5n), .woocommerce-page.mobile-rel-up-columns-5 div.product .up-sells ul.products li.product:nth-child(5n), .woocommerce.mobile-rel-up-columns-5 div.product .related.products ul.products li.product:nth-child(5n), .woocommerce.mobile-rel-up-columns-5 div.product .up-sells ul.products li.product:nth-child(5n)' => array(
					'margin-left' => 0,
					'clear'       => 'left',
				),
				'.woocommerce-page.mobile-rel-up-columns-5 div.product .related.products ul.products li.product:nth-child(5n+1), .woocommerce-page.mobile-rel-up-columns-5 div.product .up-sells ul.products li.product:nth-child(5n+1), .woocommerce.mobile-rel-up-columns-5 div.product .related.products ul.products li.product:nth-child(5n+1), .woocommerce.mobile-rel-up-columns-5 div.product .up-sells ul.products li.product:nth-child(5n+1)' => array(
					'clear' => 'right',
				),
				'.woocommerce-page.mobile-rel-up-columns-6 div.product .related.products ul.products li.product, .woocommerce-page.mobile-rel-up-columns-6 div.product .up-sells ul.products li.product, .woocommerce.mobile-rel-up-columns-6 div.product .related.products ul.products li.product, .woocommerce.mobile-rel-up-columns-6 div.product .up-sells ul.products li.product' => array(
					'width' => '10.2%',
					'width' => 'calc(16.66% - 17px)',
				),
				'.woocommerce-page.mobile-rel-up-columns-6 div.product .related.products ul.products li.product:nth-child(6n), .woocommerce-page.mobile-rel-up-columns-6 div.product .up-sells ul.products li.product:nth-child(6n), .woocommerce.mobile-rel-up-columns-6 div.product .related.products ul.products li.product:nth-child(6n), .woocommerce.mobile-rel-up-columns-6 div.product .up-sells ul.products li.product:nth-child(6n)' => array(
					'margin-left' => 0,
					'clear'       => 'left',
				),
				'.woocommerce-page.mobile-rel-up-columns-6 div.product .related.products ul.products li.product:nth-child(6n+1), .woocommerce-page.mobile-rel-up-columns-6 div.product .up-sells ul.products li.product:nth-child(6n+1), .woocommerce.mobile-rel-up-columns-6 div.product .related.products ul.products li.product:nth-child(6n+1), .woocommerce.mobile-rel-up-columns-6 div.product .up-sells ul.products li.product:nth-child(6n+1)' => array(
					'clear' => 'right',
				),
			);
		} else {
			$mobile_woo_flex_css = array(
				'.woocommerce-page.mobile-rel-up-columns-1 div.product .related.products ul.products li.product, .woocommerce-page.mobile-rel-up-columns-1 div.product .up-sells ul.products li.product, .woocommerce.mobile-rel-up-columns-1 div.product .related.products ul.products li.product, .woocommerce.mobile-rel-up-columns-1 div.product .up-sells ul.products li.product' => array(
					'width'        => '100%',
					'margin-right' => 0,
				),
				'.woocommerce-page.mobile-rel-up-columns-2 div.product .related.products ul.products li.product, .woocommerce-page.mobile-rel-up-columns-2 div.product .up-sells ul.products li.product, .woocommerce.mobile-rel-up-columns-2 div.product .related.products ul.products li.product, .woocommerce.mobile-rel-up-columns-2 div.product .up-sells ul.products li.product' => array(
					'width' => '46.1%',
					'width' => 'calc(50% - 10px)',
				),
				'.woocommerce-page.mobile-rel-up-columns-2 div.product .related.products ul.products li.product:nth-child(2n), .woocommerce-page.mobile-rel-up-columns-2 div.product .up-sells ul.products li.product:nth-child(2n), .woocommerce.mobile-rel-up-columns-2 div.product .related.products ul.products li.product:nth-child(2n), .woocommerce.mobile-rel-up-columns-2 div.product .up-sells ul.products li.product:nth-child(2n)' => array(
					'margin-right' => 0,
					'clear'        => 'right',
				),
				'.woocommerce-page.mobile-rel-up-columns-2 div.product .related.products ul.products li.product:nth-child(2n+1), .woocommerce-page.mobile-rel-up-columns-2 div.product .up-sells ul.products li.product:nth-child(2n+1), .woocommerce.mobile-rel-up-columns-2 div.product .related.products ul.products li.product:nth-child(2n+1), .woocommerce.mobile-rel-up-columns-2 div.product .up-sells ul.products li.product:nth-child(2n+1)' => array(
					'clear' => 'left',
				),
				'.woocommerce-page.mobile-rel-up-columns-3 div.product .related.products ul.products li.product, .woocommerce-page.mobile-rel-up-columns-3 div.product .up-sells ul.products li.product, .woocommerce.mobile-rel-up-columns-3 div.product .related.products ul.products li.product, .woocommerce.mobile-rel-up-columns-3 div.product .up-sells ul.products li.product' => array(
					'width'        => '28.2%',
					'width'        => 'calc(33.33% - 14px)',
					'margin-right' => '20px',
				),
				'.woocommerce-page.mobile-rel-up-columns-3 div.product .related.products ul.products li.product:nth-child(3n), .woocommerce-page.mobile-rel-up-columns-3 div.product .up-sells ul.products li.product:nth-child(3n), .woocommerce.mobile-rel-up-columns-3 div.product .related.products ul.products li.product:nth-child(3n), .woocommerce.mobile-rel-up-columns-3 div.product .up-sells ul.products li.product:nth-child(3n)' => array(
					'margin-right' => 0,
					'clear'        => 'right',
				),
				'.woocommerce-page.mobile-rel-up-columns-3 div.product .related.products ul.products li.product:nth-child(3n+1), .woocommerce-page.mobile-rel-up-columns-3 div.product .up-sells ul.products li.product:nth-child(3n+1), .woocommerce.mobile-rel-up-columns-3 div.product .related.products ul.products li.product:nth-child(3n+1), .woocommerce.mobile-rel-up-columns-3 div.product .up-sells ul.products li.product:nth-child(3n+1)' => array(
					'clear' => 'left',
				),
				'.woocommerce-page.mobile-rel-up-columns-4 div.product .related.products ul.products li.product, .woocommerce-page.mobile-rel-up-columns-4 div.product .up-sells ul.products li.product, .woocommerce.mobile-rel-up-columns-4 div.product .related.products ul.products li.product, .woocommerce.mobile-rel-up-columns-4 div.product .up-sells ul.products li.product' => array(
					'width'        => '19%',
					'width'        => 'calc(25% - 15px)',
					'margin-right' => '20px',
					'clear'        => 'none',
				),
				'.woocommerce-page.mobile-rel-up-columns-4 div.product .related.products ul.products li.product:nth-child(4n), .woocommerce-page.mobile-rel-up-columns-4 div.product .up-sells ul.products li.product:nth-child(4n), .woocommerce.mobile-rel-up-columns-4 div.product .related.products ul.products li.product:nth-child(4n), .woocommerce.mobile-rel-up-columns-4 div.product .up-sells ul.products li.product:nth-child(4n)' => array(
					'clear'        => 'right',
					'margin-right' => 0,
				),
				'.woocommerce-page.mobile-rel-up-columns-4 div.product .related.products ul.products li.product:nth-child(4n+1), .woocommerce-page.mobile-rel-up-columns-4 div.product .up-sells ul.products li.product:nth-child(4n+1), .woocommerce.mobile-rel-up-columns-4 div.product .related.products ul.products li.product:nth-child(4n+1), .woocommerce.mobile-rel-up-columns-4 div.product .up-sells ul.products li.product:nth-child(4n+1)' => array(
					'clear' => 'left',
				),
				'.woocommerce-page.mobile-rel-up-columns-5 div.product .related.products ul.products li.product, .woocommerce-page.mobile-rel-up-columns-5 div.product .up-sells ul.products li.product, .woocommerce.mobile-rel-up-columns-5 div.product .related.products ul.products li.product, .woocommerce.mobile-rel-up-columns-5 div.product .up-sells ul.products li.product' => array(
					'width' => '13%',
					'width' => 'calc(20% - 16px)',
				),
				'.woocommerce-page.mobile-rel-up-columns-5 div.product .related.products ul.products li.product:nth-child(5n), .woocommerce-page.mobile-rel-up-columns-5 div.product .up-sells ul.products li.product:nth-child(5n), .woocommerce.mobile-rel-up-columns-5 div.product .related.products ul.products li.product:nth-child(5n), .woocommerce.mobile-rel-up-columns-5 div.product .up-sells ul.products li.product:nth-child(5n)' => array(
					'margin-right' => 0,
					'clear'        => 'right',
				),
				'.woocommerce-page.mobile-rel-up-columns-5 div.product .related.products ul.products li.product:nth-child(5n+1), .woocommerce-page.mobile-rel-up-columns-5 div.product .up-sells ul.products li.product:nth-child(5n+1), .woocommerce.mobile-rel-up-columns-5 div.product .related.products ul.products li.product:nth-child(5n+1), .woocommerce.mobile-rel-up-columns-5 div.product .up-sells ul.products li.product:nth-child(5n+1)' => array(
					'clear' => 'left',
				),
				'.woocommerce-page.mobile-rel-up-columns-6 div.product .related.products ul.products li.product, .woocommerce-page.mobile-rel-up-columns-6 div.product .up-sells ul.products li.product, .woocommerce.mobile-rel-up-columns-6 div.product .related.products ul.products li.product, .woocommerce.mobile-rel-up-columns-6 div.product .up-sells ul.products li.product' => array(
					'width' => '10.2%',
					'width' => 'calc(16.66% - 17px)',
				),
				'.woocommerce-page.mobile-rel-up-columns-6 div.product .related.products ul.products li.product:nth-child(6n), .woocommerce-page.mobile-rel-up-columns-6 div.product .up-sells ul.products li.product:nth-child(6n), .woocommerce.mobile-rel-up-columns-6 div.product .related.products ul.products li.product:nth-child(6n), .woocommerce.mobile-rel-up-columns-6 div.product .up-sells ul.products li.product:nth-child(6n)' => array(
					'margin-right' => 0,
					'clear'        => 'right',
				),
				'.woocommerce-page.mobile-rel-up-columns-6 div.product .related.products ul.products li.product:nth-child(6n+1), .woocommerce-page.mobile-rel-up-columns-6 div.product .up-sells ul.products li.product:nth-child(6n+1), .woocommerce.mobile-rel-up-columns-6 div.product .related.products ul.products li.product:nth-child(6n+1), .woocommerce.mobile-rel-up-columns-6 div.product .up-sells ul.products li.product:nth-child(6n+1)' => array(
					'clear' => 'left',
				),
			);
		}

		$mobile_woo_css = array_merge( $mobile_woo_css, $mobile_woo_flex_css );
	}

	/* Display Mobile Up sell Products */
	if ( $load_upsell_grid_css ) {
		$mobile_woo_css[ '.woocommerce-page.mobile-rel-up-columns-' . $products_grid_mobile . ' .up-sells ul.products' ] = array(
			'grid-template-columns' => 'repeat(' . $products_grid_mobile . ', minmax(0, 1fr))',
		);
	}

	$css_output .= astra_parse_css( $mobile_woo_css, '', astra_addon_get_mobile_breakpoint() );

	if ( version_compare( ASTRA_THEME_VERSION, '3.2.0', '<' ) ) {

		$woo_static_css = '
		.astra-hfb-header .ast-addon-cart-wrap {
			padding: 0.2em .6em;
		}
		';

		if ( $is_site_rtl ) {

			$woo_static_css .= '
			.astra-hfb-header .ast-addon-cart-wrap {
				padding: 0.2em .6em;
			}
			';
		}

		$css_output .= Astra_Enqueue_Scripts::trim_css( $woo_static_css );
	}

	return $dynamic_css . $css_output;

}
