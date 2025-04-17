<?php
/**
 * Typography - Dynamic CSS
 *
 * @package Astra Addon
 */

add_filter( 'astra_addon_dynamic_css', 'astra_woocommerce_dynamic_css' );

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

	$is_site_rtl         = is_rtl();
	$global_palette      = astra_get_option( 'global-color-palette' );
	$link_h_color        = astra_get_option( 'link-h-color' );
	$theme_color         = astra_get_option( 'theme-color' );
	$link_color          = astra_get_option( 'link-color', $theme_color );
	$product_img_width   = astra_get_option( 'single-product-image-width' );
	$product_nav_style   = astra_get_option( 'single-product-nav-style' );
	$woo_rv_border_color = 'var(--ast-border-color)';

	$ltr_left  = $is_site_rtl ? 'right' : 'left';
	$ltr_right = $is_site_rtl ? 'left' : 'right';

	$btn_h_color = astra_get_option( 'button-h-color' );
	if ( empty( $btn_h_color ) ) {
		$btn_h_color = astra_get_foreground_color( $link_h_color );
	}

	// General Colors.
	$product_rating_color  = astra_get_option( 'single-product-rating-color' );
	$product_price_color   = astra_get_option( 'single-product-price-color' );
	$product_sale_color    = astra_get_option( 'product-sale-color' );
	$product_sale_bg_color = astra_get_option( 'product-sale-bg-color' );

	// Single Product Typo.
	$product_title_font_size = astra_get_option( 'font-size-product-title' );

	// Single Product Category Typo.
	$product_category_font_size = astra_get_option( 'font-size-product-category' );

	// Single Product Content Typo.
	$product_content_font_size    = astra_get_option( 'font-size-product-content' );
	$product_price_font_size      = astra_get_option( 'font-size-product-price' );
	$product_price_font_weight    = astra_get_option( 'font-weight-product-price' );
	$product_breadcrumb_font_size = astra_get_option( 'font-size-product-breadcrumb' );

	// Single Product Colors.
	$product_title_color      = astra_get_option( 'single-product-title-color' );
	$product_price_color      = astra_get_option( 'single-product-price-color' );
	$product_content_color    = astra_get_option( 'single-product-content-color' );
	$product_breadcrumb_color = astra_get_option( 'single-product-breadcrumb-color' );
	$product_category_color   = astra_get_option( 'single-product-category-color' );

	// Shop Typo.
	$shop_product_title_font_size   = astra_get_option( 'font-size-shop-product-title' );
	$shop_product_price_font_size   = astra_get_option( 'font-size-shop-product-price' );
	$shop_product_content_font_size = astra_get_option( 'font-size-shop-product-content' );

	// Single product gallery.
	$single_product_gallery_column = astra_get_option( 'product-gallery-thumbnail-columns' );
	$single_product_gallery_layout = astra_get_option( 'single-product-gallery-layout' );

	// Single product sticky summary.
	$single_product_summary_sticky = astra_get_option( 'single-product-sticky-summary' );

	// Single Product Variations.
	$single_product_variation_select = astra_get_option( 'single-product-select-variations' );

	// Shop Colors.
	$shop_product_title_color   = astra_get_option( 'shop-product-title-color' );
	$shop_product_price_color   = astra_get_option( 'shop-product-price-color' );
	$shop_product_content_color = astra_get_option( 'shop-product-content-color' );

	$shop_btn_padding             = astra_get_option( 'shop-button-padding' );
	$shop_product_content_padding = astra_get_option( 'shop-product-content-padding' );
	$btn_bg_h_color               = astra_get_option( 'button-bg-h-color', $link_h_color );

	$product_desc_width = 96 - intval( $product_img_width );

	$two_step_checkout     = astra_get_option( 'two-step-checkout' );
	$checkout_width        = astra_get_option( 'checkout-content-width' );
	$checkout_custom_width = astra_get_option( 'checkout-content-max-width' );

	$header_cart_icon_style  = astra_get_option( 'woo-header-cart-icon-style' );
	$header_cart_icon_color  = astra_get_option( 'header-woo-cart-icon-color', $theme_color );
	$header_cart_icon_radius = astra_get_option( 'woo-header-cart-icon-radius' );
	$cart_h_color            = astra_get_foreground_color( $header_cart_icon_color );
	$product_sale_style      = astra_get_option( 'product-sale-style' );
	$products_grid           = astra_get_option( 'single-product-related-upsell-grid' );

	$products_grid_desktop = ! empty( $products_grid['desktop'] ) ? $products_grid['desktop'] : 4;
	$products_grid_tablet  = ! empty( $products_grid['tablet'] ) ? $products_grid['tablet'] : 3;
	$products_grid_mobile  = ! empty( $products_grid['mobile'] ) ? $products_grid['mobile'] : 2;
	$load_upsell_grid_css  = Astra_Addon_Builder_Helper::apply_flex_based_css() && astra_get_option( 'single-product-up-sells-display' ) ? true : false;
	$related_product       = Astra_Addon_Builder_Helper::apply_flex_based_css() && astra_get_option( 'single-product-related-display' ) ? true : false;

	// Supporting color setting for default icon as well.
	$can_update_cart_color  = is_callable( 'astra_cart_color_default_icon_old_header' ) && astra_cart_color_default_icon_old_header();
	$cart_new_color_setting = astra_get_option( 'woo-header-cart-icon-color', $theme_color );
	// Quantity Plus Minus Button - Vertical Icon.
	$plusminus_text_normal_color       = esc_attr( astra_get_option( 'plusminus-text-normal-color' ) );
	$plusminus_background_normal_color = esc_attr( astra_get_option( 'plusminus-background-normal-color' ) );
	$cart_plus_minus_button_type       = esc_attr( astra_get_option( 'cart-plus-minus-button-type' ) );

	// Custom product navigation colors for Product Navigation.
	$product_navigation_icon_color             = astra_get_option( 'single-product-nav-icon-n-color' ) ? astra_get_option( 'single-product-nav-icon-n-color' ) : astra_get_foreground_color( $link_color );
	$product_navigation_icon_hover_color       = astra_get_option( 'single-product-nav-icon-h-color' ) ? astra_get_option( 'single-product-nav-icon-h-color' ) : astra_get_foreground_color( $link_color );
	$product_navigation_bg_color               = astra_get_option( 'single-product-nav-bg-n-color' ) ? astra_get_option( 'single-product-nav-bg-n-color' ) : $link_color;
	$product_navigation_bg_hover_color         = astra_get_option( 'single-product-nav-bg-h-color' ) ? astra_get_option( 'single-product-nav-bg-h-color' ) : $link_h_color;
	$product_navigation_icon_color_outline     = astra_get_option( 'single-product-nav-icon-n-color' ) ? astra_get_option( 'single-product-nav-icon-n-color' ) : $link_color;
	$product_navigation_bg_hover_color_outline = astra_get_option( 'single-product-nav-bg-h-color' ) ? astra_get_option( 'single-product-nav-bg-h-color' ) : $link_color;

	/**
	 * Set Single Product Tabs Heading colors
	 */
	$selector_heading_tab                    = '.woocommerce div.product .woocommerce-tabs ul.tabs';
	$selector_heading_tab_active             = '.woocommerce div.product:not(.ast-product-tabs-layout-vertical):not(.ast-product-tabs-layout-horizontal) .woocommerce-tabs ul.tabs';
	$selector_single_product_tab             = 'div.product .ast-woocommerce-tabs .ast-tab-header';
	$selector_single_product_accordion_tab   = 'div.product .ast-woocommerce-accordion .ast-accordion-header';
	$single_product_heading_tab_normal_color = astra_get_option( 'single-product-heading-tab-normal-color' );
	$single_product_heading_tab_hover_color  = astra_get_option( 'single-product-heading-tab-hover-color' );
	$single_product_heading_tab_active_color = astra_get_option( 'single-product-heading-tab-active-color' );
	$single_product_selected_layout          = astra_get_option( 'single-product-tabs-layout' );
	$is_single_product_selected_layout       = astra_get_option( 'single-product-tabs-display' );
	$accordion_inside_summary                = astra_get_option( 'accordion-inside-woo-summary' );

	// Cart.
	$ajax_quantity_cart = astra_get_option( 'cart-ajax-cart-quantity' );
	$cart_modern_layout = astra_get_option( 'cart-modern-layout' );
	$cart_steps         = astra_get_option( 'cart-multistep-checkout' );

	// Shop filter columns.
	$is_filter_accordion_mode = astra_get_option( 'shop-filter-accordion' );
	$is_sidebar_sticky        = astra_get_option( 'shop-active-filters-sticky-sidebar' );

	// Checkout.
	$modern_checkout_layout_type = astra_get_option( 'checkout-modern-layout-type' );
	$checkout_layout_type        = astra_get_option( 'checkout-layout-type' );

	// Modern Order Received.
	$is_modern_order_received = astra_get_option( 'checkout-modern-order-received' );

	/**
	 * Set font sizes
	 */
	$css_output = array(

		/**
		 * Set Single Product Tabs Heading colors
		 */
		$selector_heading_tab . ' li a,' . $selector_single_product_tab . '' => array(
			'color' => esc_attr( $single_product_heading_tab_normal_color ),
		),
		$selector_heading_tab_active . ' li.active a, ' . $selector_single_product_tab . '.active' => array(
			'color' => esc_attr( $single_product_heading_tab_active_color ),
		),
		$selector_heading_tab . ' li a:hover, ' . $selector_single_product_accordion_tab . ':not(.active):hover' => array(
			'color' => esc_attr( $single_product_heading_tab_hover_color ),
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

		'.single-product div.product .entry-title' => astra_addon_get_font_array_css( astra_get_option( 'font-family-product-title' ), astra_get_option( 'font-weight-product-title' ), $product_title_font_size, 'font-extras-product-title', $product_title_color ),

		// Single Product Category Color and Typography.
		'.single-product-category a'               => astra_addon_get_font_array_css( astra_get_option( 'font-family-product-category' ), astra_get_option( 'font-weight-product-category' ), $product_category_font_size, 'font-extras-product-category', $product_category_color ),

		// Single Product Content.
		'.single-product div.product .woocommerce-product-details__short-description, .single-product div.product .product_meta, .single-product div.product .entry-content' => astra_addon_get_font_array_css( astra_get_option( 'font-family-product-content' ), astra_get_option( 'font-weight-product-content' ), $product_content_font_size, 'font-extras-product-content', $product_content_color ),

		'.woocommerce-grouped-product-list p.ast-stock-detail' => array(
			'margin-bottom' => 'unset',
		),

		'.single-product div.product p.price, .single-product div.product span.price' => astra_addon_get_font_array_css( astra_get_option( 'font-family-product-price' ), astra_get_option( 'font-weight-product-price' ), $product_price_font_size, 'font-extras-product-price', $product_price_color ),

		'.woocommerce ul.products li.product .woocommerce-loop-product__title, .woocommerce-page ul.products li.product .woocommerce-loop-product__title, .wc-block-grid .wc-block-grid__products .wc-block-grid__product .wc-block-grid__product-title' => astra_addon_get_font_array_css( astra_get_option( 'font-family-shop-product-title' ), astra_get_option( 'font-weight-shop-product-title' ), $shop_product_title_font_size, 'font-extras-shop-product-title', $shop_product_title_color ),

		'.woocommerce ul.products li.product .price, .woocommerce-page ul.products li.product .price, .wc-block-grid .wc-block-grid__products .wc-block-grid__product .wc-block-grid__product-price' => astra_addon_get_font_array_css( astra_get_option( 'font-family-shop-product-price' ), astra_get_option( 'font-weight-shop-product-price' ), $shop_product_price_font_size, 'font-extras-shop-product-price', $shop_product_price_color ),

		'.woocommerce ul.products li.product .price, .woocommerce div.product p.price, .woocommerce div.product span.price, .woocommerce ul.products li.product .price ins, .woocommerce div.product p.price ins, .woocommerce div.product span.price ins' => array(
			'font-weight' => astra_get_css_value( $product_price_font_weight, 'font' ),
		),

		'.woocommerce .star-rating, .woocommerce .comment-form-rating .stars a, .woocommerce .star-rating::before' => array(
			'color' => esc_attr( $product_rating_color ),
		),

		'.single-product div.product .woocommerce-breadcrumb, .single-product div.product .woocommerce-breadcrumb a' => array(
			'color' => esc_attr( $product_breadcrumb_color ),
		),

		'.single-product div.product .woocommerce-breadcrumb' => astra_addon_get_font_array_css( astra_get_option( 'font-family-product-breadcrumb' ), astra_get_option( 'font-weight-product-breadcrumb' ), $product_breadcrumb_font_size, 'font-extras-product-breadcrumb' ),

		'.woocommerce ul.products li.product .ast-woo-product-category, .woocommerce-page ul.products li.product .ast-woo-product-category, .woocommerce ul.products li.product .ast-woo-shop-product-description, .woocommerce-page ul.products li.product .ast-woo-shop-product-description' => astra_addon_get_font_array_css( astra_get_option( 'font-family-shop-product-content' ), astra_get_option( 'font-weight-shop-product-content' ), $shop_product_content_font_size, 'font-extras-shop-product-content', $shop_product_content_color ),

		// Shop / Archive / Related / Upsell /Woocommerce Shortcode buttons Vertical/Horizontal padding.
		'.woocommerce.archive ul.products li a.button, .woocommerce > ul.products li a.button, .woocommerce related a.button, .woocommerce .related a.button, .woocommerce .up-sells a.button .woocommerce .cross-sells a.button' => array(
			'padding-top'    => astra_responsive_spacing( $shop_btn_padding, 'top', 'desktop' ),
			'padding-right'  => astra_responsive_spacing( $shop_btn_padding, 'right', 'desktop' ),
			'padding-bottom' => astra_responsive_spacing( $shop_btn_padding, 'bottom', 'desktop' ),
			'padding-left'   => astra_responsive_spacing( $shop_btn_padding, 'left', 'desktop' ),
		),

		// Shop / Archive / Related / Upsell /Woocommerce Shortcode content Vertical/Horizontal padding.
		'.woocommerce ul.products li.product .astra-shop-summary-wrap, .woocommerce-page ul.products li.product .astra-shop-summary-wrap, .woocommerce.ast-woocommerce-shop-page-list-style ul.products li.product .astra-shop-summary-wrap, .woocommerce-page.ast-woocommerce-shop-page-list-style ul.products li.product .astra-shop-summary-wrap' => array(
			'padding-top'    => astra_responsive_spacing( $shop_product_content_padding, 'top', 'desktop' ),
			'padding-right'  => astra_responsive_spacing( $shop_product_content_padding, 'right', 'desktop' ),
			'padding-bottom' => astra_responsive_spacing( $shop_product_content_padding, 'bottom', 'desktop' ),
			'padding-left'   => astra_responsive_spacing( $shop_product_content_padding, 'left', 'desktop' ),
		),
	);

	if ( Astra_Addon_Update_Filter_Function::astra_addon_sale_badge_background_color() ) {

		$css_output['.woocommerce ul.products li.product .onsale, .woocommerce-page ul.products li.product .onsale, .woocommerce span.onsale, .woocommerce div.product .onsale.circle-outline, .woocommerce div.product .onsale.square-outline, .woocommerce ul.products li.product .onsale.square-outline, .woocommerce ul.products li.product .onsale.circle-outline, .ast-onsale-card'] = array(
			'color'        => $product_sale_color,
			'border-color' => $product_sale_bg_color,
		);

		$css_output['.woocommerce ul.products li.product .onsale, .woocommerce-page ul.products li.product .onsale, .woocommerce span.onsale, .ast-onsale-card'] = array(
			'background-color' => $product_sale_bg_color,
		);
	} else {

		$css_output['.woocommerce ul.products li.product .onsale, .woocommerce-page ul.products li.product .onsale, .woocommerce span.onsale, .woocommerce div.product .onsale.circle-outline, .woocommerce div.product .onsale.square-outline, .woocommerce ul.products li.product .onsale.square-outline, .woocommerce ul.products li.product .onsale.circle-outline'] = array(
			'color'        => $product_sale_color,
			'border-color' => $product_sale_bg_color,
		);

		$css_output['.woocommerce ul.products li.product .onsale, .woocommerce-page ul.products li.product .onsale, .woocommerce span.onsale'] = array(
			'background-color' => $product_sale_bg_color,
		);

	}

	if ( is_checkout() || is_account_page() ) {

		$input_field_style = astra_get_option( 'woo-input-style-type' );
		$sell_to_countries = get_option( 'woocommerce_allowed_countries', array() );
		$no_of_countries   = get_option( 'woocommerce_specific_allowed_countries', array() );

		// Apply conditional style only if sell to specific country is 1.

		if ( 'specific' === $sell_to_countries && 1 === count( $no_of_countries ) ) {

			$css_output['#billing_country_field > label, #shipping_country_field > label'] = array( 'position' => 'relative' );

			if ( 'modern' === $input_field_style ) {

				$css_output['.woocommerce-input-wrapper > strong'] = array(
					'padding-' . $ltr_left => '0.7em',
				);

			}
		}
	}

	$woo_cart_icon_new_user = astra_get_option( 'astra-woocommerce-cart-icons-flag', true );
	$defaults               = apply_filters( 'astra_woocommerce_cart_icon', $woo_cart_icon_new_user ) ? 'bag' : 'default';

	if ( false === astra_addon_builder_helper()->is_header_footer_builder_active && $can_update_cart_color && 'default' === astra_get_option( 'woo-header-cart-icon', $defaults ) ) {

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

	/* Display Desktop Up sell & related Products */
	if ( $load_upsell_grid_css || $related_product ) {
		$css_output[ '.woocommerce-page.rel-up-columns-' . $products_grid_desktop . ' ul.products' ] = array(
			'grid-template-columns' => 'repeat(' . $products_grid_desktop . ', minmax(0, 1fr))',
		);
	}

	/* Parse CSS from array() */
	$css_output = astra_parse_css( $css_output );

	$css_output .= Astra_Addon_Base_Dynamic_CSS::prepare_box_shadow_dynamic_css( 'shop-item', '.woocommerce ul.products li.product, .woocommerce-page ul.products li.product' );
	$css_output .= Astra_Addon_Base_Dynamic_CSS::prepare_box_shadow_dynamic_css( 'shop-item-hover', '.woocommerce ul.products li.product:hover, .woocommerce-page ul.products li.product:hover' );

	$shop_product_bg_color = astra_get_option( 'shop-product-background-color' );

	if ( $shop_product_bg_color ) {
		$shop_product_bg_color_css = array(
			// Quantity Plus Minus Button - Color Options CSS (NORMAL).
			'.woocommerce ul.products li.product, .woocommerce-page ul.products li.product' => array(
				'background-color' => $shop_product_bg_color,
			),
		);
		$css_output               .= astra_parse_css( $shop_product_bg_color_css );
	}

	/* Filter flyout background colour */
	$filter_background_colour = astra_get_option( 'filter-background-color' );

	if ( $filter_background_colour ) {
		$filter_background_colour_support = array(
			' .woocommerce .astra-off-canvas-sidebar-wrapper .astra-off-canvas-sidebar, .woocommerce-page .astra-off-canvas-sidebar-wrapper .astra-off-canvas-sidebar' => array(
				'background-color' => $filter_background_colour,
			),
		);
		$css_output                      .= astra_parse_css( $filter_background_colour_support );
	}

	$quick_view_bg_color = astra_get_option( 'quick-view-background-color' );

	if ( $quick_view_bg_color ) {
		$quick_view_bg_color_css = array(
			'#ast-quick-view-content, .ast-separate-container #ast-quick-view-content .ast-article-post' => array(
				'background-color' => $quick_view_bg_color,
			),
		);
		$css_output             .= astra_parse_css( $quick_view_bg_color_css );
	}

	$payment_option_content_bg_color = astra_get_option( 'payment-option-content-background-color' );

	if ( $payment_option_content_bg_color ) {
		$payment_option_content_bg_color_css = array(
			// Payment Option Content Bg Button - Color Options CSS (NORMAL).
			'.woocommerce-page.woocommerce-checkout #payment div.payment_box' => array(
				'background-color' => $payment_option_content_bg_color,
			),
			'.woocommerce-page.woocommerce-checkout #payment div.payment_box::before' => array(
				'border-bottom-color' => $payment_option_content_bg_color,
			),
			'.ast-modern-checkout .woocommerce #payment ul.payment_methods div.payment_box' => array(
				'background-color' => $payment_option_content_bg_color,
			),
		);
		$css_output                         .= astra_parse_css( $payment_option_content_bg_color_css );
	}

	/**
	 * Quantity plus minus colors
	 */
	if ( is_callable( 'astra_add_to_cart_quantity_btn_enabled' ) && astra_add_to_cart_quantity_btn_enabled() ) {

		$quantitiy_plus_minus_colors = array(
			// Quantity Plus Minus Button - Color Options CSS (NORMAL).
			'.woocommerce .quantity .minus, .woocommerce .quantity .plus' => array(
				'background-color' => $plusminus_background_normal_color,
				'color'            => $plusminus_text_normal_color,
			),
			// Quantity Plus Minus Button - Color Options CSS (HOVER).
			'.woocommerce .quantity .minus:hover, .woocommerce .quantity .plus:hover' => array(
				'background-color' => esc_attr( astra_get_option( 'plusminus-background-hover-color' ) ),
				'color'            => esc_attr( astra_get_option( 'plusminus-text-hover-color' ) ),
			),
			// Quantity Plus Minus Button - Vertical Icon.
			'.woocommerce .quantity .ast-vertical-icon' => array(
				'color'            => ! empty( $plusminus_text_normal_color ) ? $plusminus_text_normal_color : 'var(--ast-global-color-2)',
				'background-color' => ! empty( $plusminus_background_normal_color ) ? $plusminus_background_normal_color : '',
				'border'           => 'unset',
				'font-size'        => '15px',
			),
			// Quantity Plus Minus Button (qty input) - Merged Style.
			'.woocommerce input[type=number].qty.ast-no-internal-border' => array(
				'color'            => ! empty( $plusminus_text_normal_color ) ? $plusminus_text_normal_color : 'rgb(102, 102, 102)',
				'background-color' => esc_attr( astra_get_option( 'plusminus-background-normal-color' ) ),
				'font-size'        => '13px',
			),
		);
		$css_output .= astra_parse_css( $quantitiy_plus_minus_colors );
	}

	if ( false === Astra_Icons::is_svg_icons() ) {
		$woo_shopping_cart = array(
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
			'#ast-quick-view-close:before' => array(
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
			'.ast-icon-previous:before'    => array(
				'transform' => 'rotate(90deg)',
			),
			'.ast-icon-next:before'        => array(
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
			'#ast-quick-view-close svg'      => array(
				'height' => '12px',
				'width'  => '12px',
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

		if ( $is_site_rtl ) {
			$woo_shopping_cart_rtl = array(
				'.ast-product-icon-previous svg' => array(
					'transform' => 'rotate(-90deg)',
				),
				'.ast-product-icon-next svg'     => array(
					'transform' => 'rotate(90deg)',
				),
				'.ast-product-icon-previous .ast-icon.icon-arrow svg, .ast-product-icon-next .ast-icon.icon-arrow svg' => array(
					'margin-right'  => '0',
					'margin-bottom' => '1px',
					'width'         => '0.8em',
				),
			);
		} else {
			$woo_shopping_cart_rtl = array(
				'.ast-product-icon-previous svg' => array(
					'transform' => 'rotate(90deg)',
				),
				'.ast-product-icon-next svg'     => array(
					'transform' => 'rotate(-90deg)',
				),
				'.ast-product-icon-previous .ast-icon.icon-arrow svg, .ast-product-icon-next .ast-icon.icon-arrow svg' => array(
					'margin-left'   => '0',
					'margin-bottom' => '1px',
					'width'         => '0.8em',
				),
			);
		}

		$css_output .= astra_parse_css( $woo_shopping_cart_rtl );

	}

	/* Parse CSS from array() */
	$css_output .= astra_parse_css( $woo_shopping_cart );
	if ( is_callable( 'astra_add_to_cart_quantity_btn_enabled' ) && astra_add_to_cart_quantity_btn_enabled() ) {

		$quantity_border_default = array(
			'.woocommerce .quantity .plus, .woocommerce .quantity .minus, .woocommerce .quantity .qty' => array(
				'border' => '1px solid ' . $woo_rv_border_color,
			),
			'.woocommerce .quantity .plus'  => array(
				'border-' . $ltr_left => 'none',
			),
			'.woocommerce .quantity .minus' => array(
				'border-' . $ltr_right => 'none',
			),
		);

		$css_output .= astra_parse_css( $quantity_border_default );

		switch ( $cart_plus_minus_button_type ) {
			case 'no-internal-border':
				$quantity_border_merged = array(
					'.woocommerce .quantity .ast-no-internal-border' => array(
						'border-' . $ltr_right => 'none',
						'border-' . $ltr_left  => 'none',
					),
					'.woocommerce .quantity .minus, .woocommerce .quantity .plus' => array(
						'font-size' => '18px',
					),
				);
				$css_output            .= astra_parse_css( $quantity_border_merged );
				break;
			case 'vertical-icon':
				$quantity_vertical_style = array(
					'.woocommerce-js .quantity.buttons_added.ast-vertical-style-applied' => array(
						'position'              => 'relative',
						'padding-' . $ltr_right => '25px',
					),

					'.woocommerce-js .quantity .vertical-icons-applied' => array(
						'border-' . $ltr_right => 'none',
						'width'                => 'unset',
					),
					'.woocommerce-js .quantity .qty.vertical-icons-applied' => array(
						'margin-' . $ltr_left => 'unset',
						'border-radius'       => '4px 0 0 4px',
					),
					'.woocommerce-js .quantity .ast-vertical-icon' => array(
						'margin-' . $ltr_left  => 'unset',
						'width'                => '25px',
						'height'               => '50%',
						'margin-' . $ltr_right => '0px',
						'border'               => '1px solid var(--ast-border-color)',
						'position'             => 'absolute',
						$ltr_right             => '0',
						'text-decoration'      => 'none',
						'font-weight'          => 500,
					),
					'.woocommerce .quantity .ast-vertical-icon.plus' => array(
						'border-bottom-width' => '.5px',
						'border-radius'       => '0 4px 0 0',
					),
					'.woocommerce .quantity .ast-vertical-icon.minus' => array(
						'bottom'           => '0',
						'border-top-width' => '.5px',
						'border-radius'    => '0 0 4px 0',
					),
					'.woocommerce .woocommerce-grouped-product-list-item__quantity' => array(
						'padding-' . $ltr_right => '38px',
					),
				);
				$css_output .= astra_parse_css( $quantity_vertical_style );
				break;
			default:
				$quantity_icon_font_size = array(
					'.woocommerce-js .quantity .minus, .woocommerce .quantity .plus' => array(
						'font-size' => '18px',
					),
				);
				$css_output             .= astra_parse_css( $quantity_icon_font_size );
		}
	}

	if ( $is_site_rtl ) {
		$quantity_plus_minus_rtl_css = array(
			'.woocommerce-js .quantity .plus'  => array(
				'border-' . $ltr_left . '-width' => '1px',
				'margin-' . $ltr_right           => '0px',
			),
			'.woocommerce-js .quantity .qty'   => array(
				'margin-' . $ltr_left => '0px',
			),
			'.woocommerce-js .quantity .minus' => array(
				'margin-' . $ltr_right            => '0px',
				'border-' . $ltr_right . '-width' => '1px',
			),
		);

		$css_output           .= astra_parse_css( $quantity_plus_minus_rtl_css );
		$woo_shopping_cart_rtl = array(
			'.ast-product-icon-previous .ast-icon.icon-arrow svg, .ast-product-icon-next .ast-icon.icon-arrow svg' => array(
				'margin-right' => '0',
			),
		);

		$css_output .= astra_parse_css( $woo_shopping_cart_rtl );
	}

	if ( $is_site_rtl ) {
		$quantity_plus_minus_rtl_css = array(
			'.woocommerce-js form .quantity .plus'  => array(
				'border-left-width' => '1px',
				'margin-right'      => '0px',
			),
			'.woocommerce-js form .quantity .qty'   => array(
				'margin-left' => '0px',
			),
			'.woocommerce-js form .quantity .minus' => array(
				'margin-right'       => '0px',
				'border-right-width' => '1px',
			),
		);

		$css_output           .= astra_parse_css( $quantity_plus_minus_rtl_css );
		$woo_shopping_cart_rtl = array(
			'.ast-product-icon-previous .ast-icon.icon-arrow svg, .ast-product-icon-next .ast-icon.icon-arrow svg' => array(
				'margin-' . $ltr_right => '0',
			),
		);

		$css_output .= astra_parse_css( $woo_shopping_cart_rtl );
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
				$add_background_outline_cart = Astra_Addon_Update_Filter_Function::astra_add_bg_color_outline_cart_header_builder();
				$border_width                = astra_get_option( 'woo-header-cart-border-width' );

				// Outline cart style border.
				$header_cart_icon['.ast-menu-cart-outline .ast-addon-cart-wrap'] = array(
					'border-width' => astra_get_css_value( $border_width, 'px' ),
				);
				$header_cart_icon['.ast-menu-cart-outline .ast-cart-menu-wrap .count, .ast-menu-cart-outline .ast-addon-cart-wrap'] = array(
					'border-style' => 'solid',
					'border-color' => esc_attr( $header_cart_icon_color ),
				);

				if ( $add_background_outline_cart ) {
					$header_cart_icon['.ast-menu-cart-outline .ast-addon-cart-wrap'] = array(
						'border-width' => astra_get_css_value( $border_width, 'px' ),
						'background'   => 'transparent',
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

			'.ast-product-navigation-wrapper .product-links a'  => array(
				'border-color' => $product_navigation_bg_color,
				'background'   => $product_navigation_bg_color,
				'color'        => $product_navigation_icon_color,
			),

			'.ast-product-navigation-wrapper .product-links a:hover'    => array(
				'border-color' => $product_navigation_bg_hover_color,
				'background'   => $product_navigation_bg_hover_color,
				'color'        => $product_navigation_icon_hover_color,
			),

			'.ast-product-navigation-wrapper.circle-outline .product-links a, .ast-product-navigation-wrapper.square-outline .product-links a'  => array(
				'border-color' => $product_navigation_bg_color,
				'background'   => 'none',
				'color'        => $product_navigation_icon_color_outline,
			),

			'.ast-product-navigation-wrapper.circle-outline .product-links a:hover, .ast-product-navigation-wrapper.square-outline .product-links a:hover'  => array(
				'border-color' => $product_navigation_bg_hover_color_outline,
				'background'   => $product_navigation_bg_hover_color_outline,
				'color'        => $product_navigation_icon_hover_color,
			),
		);

		$css_output .= astra_parse_css( $product_nav );
	}

	if ( $two_step_checkout && 'default' === $checkout_layout_type ) {

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

	$sale_offset = 'shop-page-modern-style' === astra_get_option( 'shop-style' ) ? ' + 1.3em' : ' - .5em';

	if ( $is_site_rtl ) {
		$css_output .= '@media screen and ( min-width: ' . astra_addon_get_tablet_breakpoint( '', 1 ) . 'px ) { .woocommerce div.product.ast-product-gallery-layout-vertical .onsale, .woocommerce div.product.ast-product-gallery-layout-vertical .ast-onsale-card {
			left: ' . $left_position . '%;
			left: -webkit-calc(' . $left_position . '%' . $sale_offset . ');
			left: calc(' . $left_position . '%' . $sale_offset . ');
		} .woocommerce div.product.ast-product-gallery-with-no-image .onsale {
			top:  -.5em;
			right: -.5em;
		} }';
	} else {
		$css_output .= '@media screen and ( min-width: ' . astra_addon_get_tablet_breakpoint( '', 1 ) . 'px ) { .woocommerce div.product.ast-product-gallery-layout-vertical .onsale, .woocommerce div.product.ast-product-gallery-layout-vertical .ast-onsale-card {
			left: ' . $left_position . '%;
			left: -webkit-calc(' . $left_position . '%' . $sale_offset . ');
			left: calc(' . $left_position . '%' . $sale_offset . ');
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
	if ( 'custom' === $checkout_width ) {
		$checkout_css  = '@media (min-width: ' . astra_addon_get_tablet_breakpoint( '', 1 ) . 'px) {';
		$checkout_css .= '.woocommerce-checkout form.checkout {';
		$checkout_css .= 'max-width:' . esc_attr( $checkout_custom_width ) . 'px;';
		$checkout_css .= 'margin:' . esc_attr( '0 auto' ) . ';';
		$checkout_css .= '}';
		$checkout_css .= '}';
		$css_output   .= $checkout_css;
	}

	$tablet_min_width = array(
		'#ast-quick-view-content div.summary form.cart.stick .sticky-add-to-cart' => array(
			'position' => 'absolute',
			'bottom'   => 0,
			'margin'   => 0,
			'padding'  => $is_site_rtl ? '16px 0 4px 30px' : '16px 30px 4px 0',
			'width'    => '50%',
			'width'    => '-webkit-calc(50% - 30px)',
			'width'    => 'calc(50% - 30px)',
		),
	);

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
			'height'    => '100%',
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
		// Single Product Category font-size tablet.
		'single-product-category a'                       => array(
			'font-size' => astra_responsive_font( $product_category_font_size, 'tablet' ),
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

		// Shop / Archive / Related / Upsell /Woocommerce Shortcode buttons Vertical/Horizontal padding.
		'.woocommerce.archive ul.products li a.button, .woocommerce > ul.products li a.button, .woocommerce related a.button, .woocommerce .related a.button, .woocommerce .up-sells a.button .woocommerce .cross-sells a.button' => array(
			'padding-top'    => astra_responsive_spacing( $shop_btn_padding, 'top', 'tablet' ),
			'padding-right'  => astra_responsive_spacing( $shop_btn_padding, 'right', 'tablet' ),
			'padding-bottom' => astra_responsive_spacing( $shop_btn_padding, 'bottom', 'tablet' ),
			'padding-left'   => astra_responsive_spacing( $shop_btn_padding, 'left', 'tablet' ),
		),

		// Shop / Archive / Related / Upsell /Woocommerce Shortcode content Vertical/Horizontal padding.
		'.woocommerce ul.products li.product .astra-shop-summary-wrap, .woocommerce-page ul.products li.product .astra-shop-summary-wrap, .woocommerce.ast-woocommerce-shop-page-list-style ul.products li.product .astra-shop-summary-wrap, .woocommerce-page.ast-woocommerce-shop-page-list-style ul.products li.product .astra-shop-summary-wrap' => array(
			'padding-top'    => astra_responsive_spacing( $shop_product_content_padding, 'top', 'tablet' ),
			'padding-right'  => astra_responsive_spacing( $shop_product_content_padding, 'right', 'tablet' ),
			'padding-bottom' => astra_responsive_spacing( $shop_product_content_padding, 'bottom', 'tablet' ),
			'padding-left'   => astra_responsive_spacing( $shop_product_content_padding, 'left', 'tablet' ),
		),

	);

	/* Display Tablet Up sell & Related Products */
	if ( $load_upsell_grid_css || $related_product ) {
		$tablet_css[ '.single-product.woocommerce-page.tablet-rel-up-columns-' . $products_grid_tablet . ' ul.products' ] = array(
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

			'#ast-quick-view-modal .ast-content-main-wrapper' => array(
				'height' => 'auto',
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
			// Single Product Category font-size mobile.
			'single-product-category a'                => array(
				'font-size' => astra_responsive_font( $product_category_font_size, 'mobile' ),
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

			'#ast-quick-view-modal .ast-content-main-wrapper' => array(
				'height' => 'auto',
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
			// Single Product Category font-size mobile.
			'single-product-category a'                => array(
				'font-size' => astra_responsive_font( $product_category_font_size, 'mobile' ),
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

	// Shop / Archive / Related / Upsell /Woocommerce Shortcode buttons Vertical/Horizontal padding.
	$mobile_woo_css['.woocommerce.archive ul.products li a.button, .woocommerce > ul.products li a.button, .woocommerce related a.button, .woocommerce .related a.button, .woocommerce .up-sells a.button .woocommerce .cross-sells a.button'] = array(
		'padding-top'    => astra_responsive_spacing( $shop_btn_padding, 'top', 'mobile' ),
		'padding-right'  => astra_responsive_spacing( $shop_btn_padding, 'right', 'mobile' ),
		'padding-bottom' => astra_responsive_spacing( $shop_btn_padding, 'bottom', 'mobile' ),
		'padding-left'   => astra_responsive_spacing( $shop_btn_padding, 'left', 'mobile' ),
	);

	// Shop / Archive / Related / Upsell /Woocommerce Shortcode content Vertical/Horizontal padding.
	$mobile_woo_css['.woocommerce ul.products li.product .astra-shop-summary-wrap, .woocommerce-page ul.products li.product .astra-shop-summary-wrap, .woocommerce.ast-woocommerce-shop-page-list-style ul.products li.product .astra-shop-summary-wrap, .woocommerce-page.ast-woocommerce-shop-page-list-style ul.products li.product .astra-shop-summary-wrap'] = array(
		'padding-top'    => astra_responsive_spacing( $shop_product_content_padding, 'top', 'mobile' ),
		'padding-right'  => astra_responsive_spacing( $shop_product_content_padding, 'right', 'mobile' ),
		'padding-bottom' => astra_responsive_spacing( $shop_product_content_padding, 'bottom', 'mobile' ),
		'padding-left'   => astra_responsive_spacing( $shop_product_content_padding, 'left', 'mobile' ),
	);

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

	/* Display Single Product extras section. */
	$single_product_extras_array = astra_get_option( 'single-product-structure' );
	if ( is_array( $single_product_extras_array ) && ! empty( $single_product_extras_array ) && in_array( 'summary-extras', $single_product_extras_array ) ) {

		if ( $is_site_rtl ) {

			$product_single_extras = array(
				'.ast-single-product-extras .ast-heading' => array(
					'font-weight' => '600',
				),

				'.ast-single-product-extras p'            => array(
					'margin' => '0.5em 0',
				),

				'.ast-single-product-extras ul'           => array(
					'padding'    => '0',
					'margin'     => '0 0 1.5em 0',
					'list-style' => 'none',
				),

				'.ast-single-product-extras li'           => array(
					'position' => 'relative',
				),
				'.ast-single-product-extras li[data-icon="true"]' => array(
					'padding-right' => '1.5em',
				),

				'.ast-single-product-extras .ahfb-svg-iconset, .ast-single-product-extras .ast-extra-image' => array(
					'position' => 'absolute',
					'right'    => '0',
					'top'      => '0.4em',
				),

				'.ast-single-product-extras svg, .ast-single-product-extras .ast-extra-image' => array(
					'width'  => '1em',
					'height' => '1em',
					'fill'   => 'var(--ast-global-color-3);',
				),
			);
		} else {

			$product_single_extras = array(

				'.ast-single-product-extras .ast-heading' => array(
					'font-weight' => '600',
				),

				'.ast-single-product-extras p'            => array(
					'margin' => '0.5em 0',
				),

				'.ast-single-product-extras ul'           => array(
					'padding'    => '0',
					'margin'     => '0 0 1.5em 0',
					'list-style' => 'none',
				),

				'.ast-single-product-extras li'           => array(
					'position' => 'relative',
				),
				'.ast-single-product-extras li[data-icon="true"]' => array(
					'padding-left' => '1.5em',
				),

				'.ast-single-product-extras .ahfb-svg-iconset, .ast-single-product-extras .ast-extra-image' => array(
					'position' => 'absolute',
					'left'     => '0',
					'top'      => '0.4em',
				),

				'.ast-single-product-extras svg, .ast-single-product-extras .ast-extra-image' => array(
					'width'  => '1em',
					'height' => '1em',
					'fill'   => 'var(--ast-global-color-3);',
				),
			);
		}

		$css_output .= astra_parse_css( $product_single_extras );
	}

	/* Display Mobile Up sell & Related Products */
	if ( $load_upsell_grid_css || $related_product ) {
		$mobile_woo_css[ '.single.single-product.woocommerce-page.mobile-rel-up-columns-' . $products_grid_mobile . ' ul.products' ] = array(
			'grid-template-columns' => 'repeat(' . $products_grid_mobile . ', minmax(0, 1fr))',
		);
	}

	$mobile_woo_css['.ast-header-break-point .ast-shop-toolbar-container']                              = array(
		'column-gap'      => '20px',
		'flex-direction'  => 'column',
		'-js-display'     => 'flex',
		'display'         => 'flex',
		'justify-content' => 'inherit',
		'align-items'     => 'inherit',
	);
	$mobile_woo_css['.ast-header-break-point .ast-shop-toolbar-container .ast-shop-toolbar-aside-wrap'] = array(
		'margin-bottom' => '20px',
	);
	$mobile_woo_css['.ast-header-break-point .ast-shop-toolbar-container .ast-shop-toolbar-aside-wrap > *:first-child'] = array(
		'flex' => '1 1 auto',
	);
	$mobile_woo_css['.ast-header-break-point .ast-shop-toolbar-container > *:last-child']                               = array(
		'float' => 'unset',
	);

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

	if ( is_product() && $is_single_product_selected_layout && $single_product_selected_layout ) {
		/* Single product tabs accordions */
		if ( 'accordion' === $single_product_selected_layout ) {

			if ( $is_site_rtl ) {
				$woo_tabs_accordion = '
					.ast-product-tabs-layout-accordion .ast-woocommerce-accordion {
						border-bottom: 1px solid var(--ast-border-color);
						margin-bottom: 2em;
					}

					div.product.ast-product-tabs-layout-accordion .ast-woocommerce-accordion .ast-accordion-header {
						position: relative;
						border: 1px solid var(--ast-border-color);
						border-bottom: 0;
						padding: 1em 1.3em;
						margin-bottom: 0;
						font-size: 110%;
						font-weight: 700;
						cursor: pointer;
						transition: .3s;
					}

					.ast-product-tabs-layout-accordion .ast-accordion-header .ahfb-svg-iconset {
						position: absolute;
						left: 1em;
						top: 50%;
						transform: translateY( -50% );
						fill: var( --ast-global-color-0 );
						pointer-events: none;
					}

					.ast-accordion-header .ahfb-svg-iconset svg {
						width: 1em;
						height: 1em;
					}

					.ast-product-tabs-layout-accordion .ast-accordion-header.active .ahfb-svg-iconset:nth-child( 1 ) {
						display: none;
					}

					.ast-product-tabs-layout-accordion .ast-accordion-header.active .ahfb-svg-iconset:nth-child( 2 ) {
						display: block;
					}

					.woocommerce div.product.ast-product-tabs-layout-accordion .ast-accordion-content {
						display: block !important; /* override inline style */
						overflow-y: hidden;
						transition: all .5s;
						border: 1px solid var(--ast-border-color);
						border-bottom: 0;
						border-top: 0;
						margin-bottom: 0;
					}

					.ast-product-tabs-layout-accordion .ast-accordion-wrap {
						padding: 1em 1.3em 2em 1.3em;
						display: block;
					}

					.ast-product-tabs-layout-accordion .ast-accordion-wrap > *:nth-last-child(1) {
						margin-bottom: 0;
					}

					.ast-woocommerce-accordion .ast-accordion-header.active {
						color: var( --ast-global-color-0 );
					}
				';
			} else {
				$woo_tabs_accordion = '
					.ast-product-tabs-layout-accordion .ast-woocommerce-accordion {
						border-bottom: 1px solid var(--ast-border-color);
						margin-bottom: 2em;
					}

					div.product.ast-product-tabs-layout-accordion .ast-woocommerce-accordion .ast-accordion-header {
						position: relative;
						border: 1px solid var(--ast-border-color);
						border-bottom: 0;
						padding: 1em 1.3em;
						margin-bottom: 0;
						font-size: 110%;
						font-weight: 700;
						cursor: pointer;
						transition: .3s;
					}

					.ast-product-tabs-layout-accordion .ast-accordion-header .ahfb-svg-iconset {
						position: absolute;
						right: 1em;
						top: 50%;
						transform: translateY( -50% );
						fill: var( --ast-global-color-0 );
						pointer-events: none;
					}

					.ast-accordion-header .ahfb-svg-iconset svg {
					    width: 1em;
    					height: 1em;
					}

					.ast-product-tabs-layout-accordion .ast-accordion-header.active .ahfb-svg-iconset:nth-child( 1 ) {
						display: none;
					}

					.ast-product-tabs-layout-accordion .ast-accordion-header.active .ahfb-svg-iconset:nth-child( 2 ) {
						display: block;
					}

					.woocommerce div.product.ast-product-tabs-layout-accordion .ast-accordion-content {
						display: block !important; /* override inline style */
						overflow-y: hidden;
						transition: all .5s;
						border: 1px solid var(--ast-border-color);
						border-bottom: 0;
						border-top: 0;
						margin-bottom: 0;
					}

					.ast-product-tabs-layout-accordion .ast-accordion-wrap {
						padding: 1em 1.3em 2em 1.3em;
						display: block;
					}

					.ast-product-tabs-layout-accordion .ast-accordion-wrap > *:nth-last-child(1) {
						margin-bottom: 0;
					}

					.ast-woocommerce-accordion .ast-accordion-header.active {
						color: var( --ast-global-color-0 );
					}
				';
			}

			$css_output .= Astra_Enqueue_Scripts::trim_css( $woo_tabs_accordion );

			// When accordion is inside summary section.
			if ( $accordion_inside_summary ) {

				if ( $is_site_rtl ) {
					$woo_accordion_summary = '
						div.product.ast-product-tabs-layout-accordion .summary .ast-woocommerce-accordion .ast-accordion-header {
							padding-right: 0;
							padding-left: 0;
							border-right: 0;
							border-left: 0;
						}

						.woocommerce div.product.ast-product-tabs-layout-accordion .summary .ast-accordion-content {
							border-right: 0;
							border-left: 0;
						}

						.ast-product-tabs-layout-accordion .summary .ast-accordion-wrap {
							padding-top: 0;
							padding-right: 0;
							padding-left: 0;
						}

						.ast-product-tabs-layout-accordion .summary .ast-accordion-header .ahfb-svg-iconset {
							left: 0;
						}

						.ast-product-tabs-layout-accordion .summary #reviews {
							flex-wrap: wrap;
						}
					';
				} else {
					$woo_accordion_summary = '
						div.product.ast-product-tabs-layout-accordion .summary .ast-woocommerce-accordion .ast-accordion-header {
							padding-left: 0;
							padding-right: 0;
							border-left: 0;
							border-right: 0;
						}

						.woocommerce div.product.ast-product-tabs-layout-accordion .summary .ast-accordion-content {
							border-left: 0;
							border-right: 0;
						}

						.ast-product-tabs-layout-accordion .summary .ast-accordion-wrap {
							padding-left: 0;
							padding-right: 0;
						}

						.ast-product-tabs-layout-accordion .summary .ast-accordion-header .ahfb-svg-iconset {
							right: 0;
						}

						.ast-product-tabs-layout-accordion .summary #reviews {
							flex-wrap: wrap;
						}
					';
				}

				$css_output .= Astra_Enqueue_Scripts::trim_css( $woo_accordion_summary );
			}
		}

		/* Single product tabs distributed */
		if ( 'distributed' === $single_product_selected_layout ) {
			$woo_tabs_distributed = '
				div.product.ast-product-tabs-layout-distributed .ast-distributed-header {
					font-size: 134%;
					font-weight: 700;
					margin-bottom: 1.5em;
				}

				div.product.ast-product-tabs-layout-distributed .ast-distributed-content {
					display: block !important;  /* override inline style */
					margin-bottom: 3em;
			   }

			    .woocommerce div.product .woocommerce-tabs .ast-distributed-wrap .shop_attributes,
				.woocommerce div.product .woocommerce-tabs .ast-distributed-wrap .shop_attributes th,
				.woocommerce div.product .woocommerce-tabs .ast-distributed-wrap .shop_attributes td {
					border: 0;
				}

				.woocommerce div.product .woocommerce-tabs .ast-distributed-wrap .shop_attributes th,
				.woocommerce div.product .woocommerce-tabs .ast-distributed-wrap .shop_attributes td {
					padding: 0;
					padding-bottom: 1em;
				}
			';

			$css_output .= Astra_Enqueue_Scripts::trim_css( $woo_tabs_distributed );

			$woo_tabs_distributed_responsive = array(
				'.ast-woocommerce-distributed .ast-single-tab' => array(
					'display'   => 'flex',
					'flex-wrap' => 'wrap',
				),
				'.ast-woocommerce-distributed .ast-distributed-header' => array(
					'width'         => '240px',
					'padding-right' => '1em',
				),
				'.ast-woocommerce-distributed .ast-distributed-content' => array(
					'width' => 'calc( 100% - 240px )',
				),
			);

			$css_output .= astra_parse_css( $woo_tabs_distributed_responsive, 1201, '' );

			$woo_tabs_distributed_responsive_tablet = array(
				'.ast-woocommerce-distributed .ast-single-tab' => array(
					'margin-bottom' => '3em',
				),
			);

			$css_output .= astra_parse_css( $woo_tabs_distributed_responsive_tablet, astra_addon_get_tablet_breakpoint( '', 1 ) );

		}
	}

	if ( is_product() && false === ASTRA_Ext_WooCommerce_Markup::$wc_layout_built_with_themer && apply_filters( 'astra_addon_override_single_product_layout', true ) ) {

		if ( 'first-image-large' === $single_product_gallery_layout ) {

			$woo_gallery_first_image_big = '

				.woocommerce div.product.ast-product-gallery-layout-first-image-large .woocommerce-product-gallery__wrapper {
					display: flex;
					flex-wrap: wrap;
					margin-left: -10px;
					margin-right: -10px;
				}

				.woocommerce div.product.ast-product-gallery-layout-first-image-large .woocommerce-product-gallery__image:nth-child(1) {
					margin-left: 10px;
					margin-right: 10px;
					margin-bottom: 20px;
					width: 100%;
				}

				.woocommerce div.product.ast-product-gallery-layout-first-image-large .woocommerce-product-gallery__wrapper .woocommerce-product-gallery__image:nth-child(n+2){
					padding-left: 10px;
					padding-right: 10px;
					padding-bottom: 20px;
				}
			';

			$css_output .= Astra_Enqueue_Scripts::trim_css( $woo_gallery_first_image_big );

			// First image gallery columns.
			$woo_first_big_image_width_selector = '.woocommerce div.product.ast-product-gallery-layout-first-image-large .woocommerce-product-gallery__wrapper .woocommerce-product-gallery__image:nth-child(n+2)';
			$woo_first_big_image_width          = array();

			if ( 0 === $single_product_gallery_column || 1 === $single_product_gallery_column ) {
				$woo_first_big_image_width = array(
					$woo_first_big_image_width_selector => array(
						'width' => '100%',
					),
				);
			}

			if ( 2 === $single_product_gallery_column ) {
				$woo_first_big_image_width = array(
					$woo_first_big_image_width_selector => array(
						'width' => '50%',
					),
				);
			}

			if ( 3 === $single_product_gallery_column ) {
				$woo_first_big_image_width = array(
					$woo_first_big_image_width_selector => array(
						'width' => '33.33%',
					),
				);
			}

			if ( 4 === $single_product_gallery_column ) {
				$woo_first_big_image_width = array(
					$woo_first_big_image_width_selector => array(
						'width' => '25%',
					),
				);
			}

			$css_output .= astra_parse_css( $woo_first_big_image_width );

			$woo_zoom_color = str_replace( '#', '%23', $global_palette['palette'][3] );
			$woo_zoom_icon  = "data:image/svg+xml,%3Csvg width='96' height='96' fill='" . $woo_zoom_color . "' viewBox='0 0 96 96' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M84 44V12H52L65.16 25.16L25.16 65.16L12 52V84H44L30.84 70.84L70.84 30.84L84 44Z' /%3E%3C/svg%3E";

			// First image large resize icon.
			if ( $is_site_rtl ) {

				$woo_gallery_resize_icon = '
					.woocommerce div.product.ast-product-gallery-layout-first-image-large.ast-magnify-disabled .woocommerce-product-gallery__image:nth-child(1) a,
					.woocommerce div.product.ast-product-gallery-layout-first-image-large .woocommerce-product-gallery__wrapper .woocommerce-product-gallery__image:nth-child(n+2) a {
						display: block;
						position: relative;
					}

					.woocommerce div.product.ast-product-gallery-layout-first-image-large.ast-magnify-disabled .woocommerce-product-gallery__image:nth-child(1) a::after,
					.woocommerce div.product.ast-product-gallery-layout-first-image-large .woocommerce-product-gallery__wrapper .woocommerce-product-gallery__image:nth-child(n+2) a::after{
						content: "";
						position: absolute;
						top: 16px;
						left: 16px;
						height: 1em;
						width: 1em;
						background-image: url("' . $woo_zoom_icon . '");
						background-size: contain;
						background-size: contain;
						opacity: 0;
						transition: .3s;
					}

					.woocommerce div.product.ast-product-gallery-layout-first-image-large.ast-magnify-disabled .woocommerce-product-gallery__image:nth-child(1) a::before,
					.woocommerce div.product.ast-product-gallery-layout-first-image-large .woocommerce-product-gallery__wrapper .woocommerce-product-gallery__image:nth-child(n+2) a::before{
						content: "";
						position: absolute;
						top: 10px;
						left: 10px;
						height: 1.8em;
						width: 1.8em;
						background-color: var( --ast-global-color-primary, --ast-global-color-5 );
						border-radius: 100%;
						opacity: 0;
						transition: .3s;
					}

					.woocommerce div.product.ast-product-gallery-layout-first-image-large.ast-magnify-disabled .woocommerce-product-gallery__image:nth-child(1) a:hover::after,
					.woocommerce div.product.ast-product-gallery-layout-first-image-large.ast-magnify-disabled .woocommerce-product-gallery__image:nth-child(1) a:hover::before,
					.woocommerce div.product.ast-product-gallery-layout-first-image-large .woocommerce-product-gallery__wrapper .woocommerce-product-gallery__image:nth-child(n+2) a:hover::after,
					.woocommerce div.product.ast-product-gallery-layout-first-image-large .woocommerce-product-gallery__wrapper .woocommerce-product-gallery__image:nth-child(n+2) a:hover::before {
						opacity: 1;
					}
				';

			} else {
				$woo_gallery_resize_icon = '
					.woocommerce div.product.ast-product-gallery-layout-first-image-large.ast-magnify-disabled .woocommerce-product-gallery__image:nth-child(1) a,
					.woocommerce div.product.ast-product-gallery-layout-first-image-large .woocommerce-product-gallery__wrapper .woocommerce-product-gallery__image:nth-child(n+2) a {
						display: block;
						position: relative;
					}

					.woocommerce div.product.ast-product-gallery-layout-first-image-large.ast-magnify-disabled .woocommerce-product-gallery__image:nth-child(1) a::after,
					.woocommerce div.product.ast-product-gallery-layout-first-image-large .woocommerce-product-gallery__wrapper .woocommerce-product-gallery__image:nth-child(n+2) a::after{
						content: "";
						position: absolute;
						top: 16px;
						right: 16px;
						height: 1em;
						width: 1em;
						background-image: url("' . $woo_zoom_icon . '");
						background-size: contain;
						background-size: contain;
						opacity: 0;
						transition: .3s;
					}

					.woocommerce div.product.ast-product-gallery-layout-first-image-large.ast-magnify-disabled .woocommerce-product-gallery__image:nth-child(1) a::before,
					.woocommerce div.product.ast-product-gallery-layout-first-image-large .woocommerce-product-gallery__wrapper .woocommerce-product-gallery__image:nth-child(n+2) a::before{
						content: "";
						position: absolute;
						top: 10px;
						right: 10px;
						height: 1.8em;
						width: 1.8em;
						background-color: var( --ast-global-color-primary, --ast-global-color-5 );
						border-radius: 100%;
						opacity: 0;
						transition: .3s;
					}

					.woocommerce div.product.ast-product-gallery-layout-first-image-large.ast-magnify-disabled .woocommerce-product-gallery__image:nth-child(1) a:hover::after,
					.woocommerce div.product.ast-product-gallery-layout-first-image-large.ast-magnify-disabled .woocommerce-product-gallery__image:nth-child(1) a:hover::before,
					.woocommerce div.product.ast-product-gallery-layout-first-image-large .woocommerce-product-gallery__wrapper .woocommerce-product-gallery__image:nth-child(n+2) a:hover::after,
					.woocommerce div.product.ast-product-gallery-layout-first-image-large .woocommerce-product-gallery__wrapper .woocommerce-product-gallery__image:nth-child(n+2) a:hover::before {
						opacity: 1;
					}

				';
			}

			$css_output .= Astra_Enqueue_Scripts::trim_css( $woo_gallery_resize_icon );

			// Remove Resize icon responsive.
			$hide_resize_icon = array(
				'.woocommerce div.product.ast-product-gallery-layout-first-image-large.ast-magnify-disabled .woocommerce-product-gallery__image:nth-child(1) a:hover::after, .woocommerce div.product.ast-product-gallery-layout-first-image-large.ast-magnify-disabled .woocommerce-product-gallery__image:nth-child(1) a:hover::before, .woocommerce div.product.ast-product-gallery-layout-first-image-large .woocommerce-product-gallery__wrapper .woocommerce-product-gallery__image:nth-child(n+2) a:hover::after, .woocommerce div.product.ast-product-gallery-layout-first-image-large .woocommerce-product-gallery__wrapper .woocommerce-product-gallery__image:nth-child(n+2) a:hover::before' => array(
					'opacity' => '0',
				),
			);

			$css_output .= astra_parse_css( $hide_resize_icon, '', astra_addon_get_tablet_breakpoint() );

			// First image large responsive slider.
			if ( $is_site_rtl ) {
				$woo_slider_responsive = '
					.ast-product-gallery-layout-first-image-large .tns-outer {
						position: relative;
						overflow: hidden;
					}

					.ast-product-gallery-layout-first-image-large .tns-nav {
						position: absolute;
						bottom: 1em;
						width: 100%;
						text-align: center;
						z-index: 1;
					}

					.ast-product-gallery-layout-first-image-large .tns-nav button {
						width: 1em;
						height: 1em;
						padding: 0;
						border-radius: 100%;
						margin-right: 0.5em;
						margin-left: 0.5em;
					}

					.ast-product-gallery-layout-first-image-large .tns-nav-active {
						background-color: var(--ast-global-color-1);
					}

					.ast-product-gallery-layout-first-image-large .tns-slider .tns-item {
						margin: 0 !important; /* Override when slider is active*/
						padding: 0 !important; /* Override when slider is active*/
					}

					.ast-product-gallery-layout-first-image-large .tns-controls button {
						position: absolute;
						width: 30px;
						height: 30px;
						padding: 0;
						top: 50%;
						transform: translateY(-50%);
						color: transparent;
						background-color: var(--ast-global-color-primary, --ast-global-color-5);
						border-radius: 100%;
						font-size: 0;
						box-shadow: 0 0 5px 0px rgb(0 0 0 / 30%);
						z-index: 1;
						opacity: .8;
					}

					.ast-product-gallery-layout-first-image-large .tns-controls button:after {
						content: "";
						position: absolute;
						top: 10px;
						right: 9px;
						width: 10px;
						height: 10px;
						text-indent: -9999px;
						border-top: 2px solid var( --ast-global-color-0 );
						border-left: 2px solid var( --ast-global-color-0 );
					}

					.ast-product-gallery-layout-first-image-large .tns-controls button:disabled {
						display: none;
					}

					.ast-product-gallery-layout-first-image-large .tns-controls button[data-controls="prev"] {
						right: 10px;
					}

					.ast-product-gallery-layout-first-image-large .tns-controls button[data-controls="next"] {
						left: 10px;
					}

					.ast-product-gallery-layout-first-image-large .tns-controls button[data-controls="prev"]:after {
						top: 10px;
						right: 12px;
						transform: rotate(133deg);
					}

					.ast-product-gallery-layout-first-image-large .tns-controls button[data-controls="next"]:after {
						transform: rotate(-45deg);
					}

					.ast-product-gallery-layout-first-image-large .tns-inner .tns-item a {
						position: relative;
						padding-bottom: 100%;
						display: block;
					}

					.woocommerce .ast-product-gallery-layout-first-image-large .tns-inner .tns-item img {
						position: absolute;
						top: 0;
						right: 0;
						bottom: 0;
						left: 0;
						object-fit: cover;
						height: 100%;
					}
				';

			} else {
				$woo_slider_responsive = '

					.ast-product-gallery-layout-first-image-large .tns-outer {
						position: relative;
						overflow: hidden;
					}

					.ast-product-gallery-layout-first-image-large .tns-nav {
						position: absolute;
						bottom: 1em;
						width: 100%;
						text-align: center;
						z-index: 1;
					}

					.ast-product-gallery-layout-first-image-large .tns-nav button {
						width: 1em;
						height: 1em;
						padding: 0;
						border-radius: 100%;
						margin-left: 0.5em;
						margin-right: 0.5em;
					}

					.ast-product-gallery-layout-first-image-large .tns-nav-active {
						background-color: var(--ast-global-color-1);
					}

					.ast-product-gallery-layout-first-image-large .tns-slider .tns-item {
						margin: 0 !important; /* Override when slider is active*/
						padding: 0 !important; /* Override when slider is active*/
					}

					.ast-product-gallery-layout-first-image-large .tns-controls button {
						position: absolute;
						width: 30px;
						height: 30px;
						padding: 0;
						top: 50%;
						transform: translateY(-50%);
						color: transparent;
						background-color: var(--ast-global-color-primary, --ast-global-color-5);
						border-radius: 100%;
						font-size: 0;
						box-shadow: 0 0 5px 0px rgb(0 0 0 / 30%);
						z-index: 1;
						opacity: .8;
					}

					.ast-product-gallery-layout-first-image-large .tns-controls button:after {
						content: "";
						position: absolute;
						top: 10px;
						left: 9px;
						width: 10px;
						height: 10px;
						text-indent: -9999px;
						border-top: 2px solid var( --ast-global-color-0 );
						border-right: 2px solid var( --ast-global-color-0 );
					}

					.ast-product-gallery-layout-first-image-large .tns-controls button:disabled {
						display: none;
					}

					.ast-product-gallery-layout-first-image-large .tns-controls button[data-controls="prev"] {
						left: 10px;
					}

					.ast-product-gallery-layout-first-image-large .tns-controls button[data-controls="next"] {
						right: 10px;
					}

					.ast-product-gallery-layout-first-image-large .tns-controls button[data-controls="prev"]:after {
						top: 10px;
						left: 12px;
						transform: rotate(-133deg);
					}

					.ast-product-gallery-layout-first-image-large .tns-controls button[data-controls="next"]:after {
						transform: rotate(45deg);
					}

					.ast-product-gallery-layout-first-image-large .tns-inner .tns-item a {
						position: relative;
						padding-bottom: 100%;
						display: block;
					}

					.woocommerce .ast-product-gallery-layout-first-image-large .tns-inner .tns-item img {
						position: absolute;
						top: 0;
						left: 0;
						bottom: 0;
						right: 0;
						object-fit: cover;
						height: 100%;
					}

				';
			}

			$css_output .= Astra_Enqueue_Scripts::trim_css( $woo_slider_responsive );

		}

		if ( 'vertical-slider' === $single_product_gallery_layout || 'horizontal-slider' === $single_product_gallery_layout ) {

			if ( $is_site_rtl ) {
				$woo_common_slider = '
					.woocommerce div.product div.images .ast-single-product-thumbnails .flex-viewport {
						margin-bottom: 0;
						overflow: hidden;
					}

					.ast-single-product-thumbnails .ast-woocommerce-product-gallery__image > img,
					#ast-vertical-slider-inner img {
						cursor: pointer;
					}

					.woocommerce-product-gallery .flex-direction-nav .flex-prev,
					.woocommerce-product-gallery .flex-direction-nav .flex-next,
					#ast-vertical-navigation-prev,
					#ast-vertical-navigation-next {
						position: absolute;
						width: 30px;
						height: 30px;
						padding: 0;
						color: transparent;
						background-color: var(--ast-global-color-primary, --ast-global-color-5);
						border-radius: 100%;
						font-size: 0;
						box-shadow: 0 0 5px 0px rgb(0 0 0 / 30%);
						z-index: 1;
						opacity: .8;
					}

					.woocommerce-product-gallery .flex-direction-nav .flex-prev:after,
					.woocommerce-product-gallery .flex-direction-nav .flex-next:after,
					#ast-vertical-navigation-prev:after,
					#ast-vertical-navigation-next:after {
						content: "";
						position: absolute;
						top: 10px;
						width: 10px;
						height: 10px;
						text-indent: -9999px;
						border-top: 2px solid var( --ast-global-color-3 );
						border-right: 2px solid var( --ast-global-color-3 );
					}

					.woocommerce-product-gallery .flex-direction-nav .flex-prev:focus,
					.woocommerce-product-gallery .flex-direction-nav .flex-next:focus,
					#ast-vertical-navigation-prev,
					#ast-vertical-navigation-next {
						color: transparent;
					}

					.ast-single-product-thumbnails .flex-direction-nav {
						list-style-type: none;
						margin: 0;
					}

					.flex-direction-nav .flex-disabled,
					.ast-vertical-navigation-wrapper button.flex-disabled {
						display: none;
					}

					.ast-woocommerce-product-gallery__image.flex-active-slide {
						position: relative;
					}

					.ast-woocommerce-product-gallery__image.flex-active-slide:after {
						content: "";
						position: absolute;
						top: 0;
						right: 0;
						left: 0;
						bottom: 0;
						border: 1px solid var( --ast-global-color-0 );
					}

					.ast-product-gallery-with-no-image .ast-single-product-thumbnails,
					.ast-product-gallery-with-no-image #ast-gallery-thumbnails {
						display: none;
					}

					.woocommerce-product-gallery-thumbnails__wrapper {
						display: block;
						width: 100%;
						height: inherit;
					}

				';
			} else {
				$woo_common_slider = '
					.woocommerce div.product div.images .ast-single-product-thumbnails .flex-viewport {
						margin-bottom: 0;
						overflow: hidden;
					}

					.ast-single-product-thumbnails .ast-woocommerce-product-gallery__image > img,
					#ast-vertical-slider-inner img {
						cursor: pointer;
					}

					.woocommerce-product-gallery .flex-direction-nav .flex-prev,
					.woocommerce-product-gallery .flex-direction-nav .flex-next,
					#ast-vertical-navigation-prev,
					#ast-vertical-navigation-next {
					    position: absolute;
						width: 30px;
						height: 30px;
						padding: 0;
						color: transparent;
						background-color: var(--ast-global-color-primary, --ast-global-color-5);
						border-radius: 100%;
						font-size: 0;
						box-shadow: 0 0 5px 0px rgb(0 0 0 / 30%);
						z-index: 1;
						opacity: .8;
					}

					.woocommerce-product-gallery .flex-direction-nav .flex-prev:after,
					.woocommerce-product-gallery .flex-direction-nav .flex-next:after,
					#ast-vertical-navigation-prev:after,
					#ast-vertical-navigation-next:after {
						content: "";
						position: absolute;
						top: 10px;
						width: 10px;
						height: 10px;
						text-indent: -9999px;
						border-top: 2px solid var( --ast-global-color-3 );
						border-left: 2px solid var( --ast-global-color-3 );
					}

					.woocommerce-product-gallery .flex-direction-nav .flex-prev:focus,
					.woocommerce-product-gallery .flex-direction-nav .flex-next:focus,
					#ast-vertical-navigation-prev,
					#ast-vertical-navigation-next {
						color: transparent;
					}

					.ast-single-product-thumbnails .flex-direction-nav {
						list-style-type: none;
						margin: 0;
					}

					.flex-direction-nav .flex-disabled,
					.ast-vertical-navigation-wrapper button.flex-disabled {
						display: none;
					}

					.ast-woocommerce-product-gallery__image.flex-active-slide {
						position: relative;
					}

					.ast-woocommerce-product-gallery__image.flex-active-slide:after {
						content: "";
						position: absolute;
						top: 0;
						left: 0;
						right: 0;
						bottom: 0;
						border: 1px solid var( --ast-global-color-0 );
					}

					.ast-product-gallery-with-no-image .ast-single-product-thumbnails,
					.ast-product-gallery-with-no-image #ast-gallery-thumbnails {
						display: none;
					}

					.woocommerce-product-gallery-thumbnails__wrapper {
						display: block;
						width: 100%;
						height: inherit;
					}

					#ast-vertical-thumbnail-wrapper .woocommerce-product-gallery-thumbnails__wrapper img {
						width: inherit;
					}

				';
			}

			$css_output .= Astra_Enqueue_Scripts::trim_css( $woo_common_slider );
		}

		// Horizontal slider.
		if ( 'horizontal-slider' === $single_product_gallery_layout ) {

			if ( $is_site_rtl ) {
				$woo_single_product_horizontal_slider = '
					.woocommerce-product-gallery {
						display: flex;
						flex-flow: column;
					}

					.ast-single-product-thumbnails {
						order: 5;
						position: relative;
					}

					.ast-single-product-thumbnails .flex-direction-nav .flex-prev,
					.ast-single-product-thumbnails .flex-direction-nav .flex-next {
						transform: translateY(-50%);
						top: 50%;
					}

					.ast-single-product-thumbnails .flex-direction-nav .flex-prev {
						transform: translateY(-50%);
						right: -10px;
					}

					.ast-single-product-thumbnails .flex-direction-nav .flex-next {
						transform: translateY(-50%);
						left: -10px;
					}

					.ast-single-product-thumbnails .flex-direction-nav .flex-prev:after {
						right: 12px;
						transform: rotate(45deg);
					}

					.ast-single-product-thumbnails .flex-direction-nav .flex-next:after {
						right: 8px;
						transform: rotate(-135deg);
					}

					.ast-single-product-thumbnails.slider-disabled {
						padding-right: 0;
						padding-left: 0;
					}

					.ast-single-product-thumbnails.slider-disabled .flex-direction-nav {
						display: none;
					}
				';
			} else {
				$woo_single_product_horizontal_slider = '
					.woocommerce-product-gallery {
						display: flex;
						flex-flow: column;
					}

					.ast-single-product-thumbnails {
						order: 5;
						position: relative;
					}

					.ast-single-product-thumbnails .flex-direction-nav .flex-prev,
					.ast-single-product-thumbnails .flex-direction-nav .flex-next {
						transform: translateY(-50%);
						top: 50%;
					}

					.ast-single-product-thumbnails .flex-direction-nav .flex-prev {
						transform: translateY(-50%);
						left: -10px;
					}

					.ast-single-product-thumbnails .flex-direction-nav .flex-next {
						transform: translateY(-50%);
						right: -10px;
					}

					.ast-single-product-thumbnails .flex-direction-nav .flex-prev:after {
						left: 12px;
						transform: rotate(-45deg);
					}

					.ast-single-product-thumbnails .flex-direction-nav .flex-next:after {
						left: 8px;
						transform: rotate(135deg);
					}

					.ast-single-product-thumbnails.slider-disabled {
						padding-left: 0;
						padding-right: 0;
					}

					.ast-single-product-thumbnails.slider-disabled .flex-direction-nav {
						display: none;
					}

				';
			}

			$css_output .= Astra_Enqueue_Scripts::trim_css( $woo_single_product_horizontal_slider );
		}

		// Vertical slider layout.
		if ( 'vertical-slider' === $single_product_gallery_layout ) {

			if ( $is_site_rtl ) {
				$woo_single_product_vertical_slider = '
					.woocommerce div.product div.images.woocommerce-product-gallery > .flex-viewport {
						margin-right: calc(20% + 10px);
						margin-bottom: 0;
					}

					#ast-vertical-thumbnail-wrapper {
						position: relative;
						overflow: hidden;
					}

					#ast-gallery-thumbnails {
						position: absolute;
						width: 20%;
						margin-top: -5px;
						transition: .3s;
					}

					#ast-gallery-thumbnails.slider-disabled .ast-navigation-wrapper {
						display: none;
					}

					.woocommerce-product-gallery-thumbnails__wrapper {
						position: absolute;
					}

					.ast-woocommerce-product-gallery__image {
						position: relative;
						display: block;
						width: inherit;
						padding-bottom: 100%;
						border-top: 5px solid transparent;
						border-bottom: 5px solid transparent;
					}

					#ast-vertical-thumbnail-wrapper .ast-woocommerce-product-gallery__image img{
						position: absolute;
						right: 0;
						left: 0;
						bottom: 0;
						top: 0;
						width: 100%;
						height: 100%;
						object-fit: cover;
					}

					.ast-woocommerce-product-gallery__image.flex-active-slide:after {
					}

					.ast-vertical-navigation-wrapper {
						position: absolute;
						top: 0;
						right: 0;
						bottom: 0;
						left: 0;
					}

					#ast-vertical-navigation-prev,
					#ast-vertical-navigation-next {
						right: 50%;
						transform: translateX(50%);
					}

					#ast-vertical-navigation-prev {
						top: 0;
					}

					#ast-vertical-navigation-next {
						bottom: 0;
					}

					#ast-vertical-navigation-prev:after {
						transform: rotate( -45deg );
						top: 12px;
						left: 10px;
					}

					#ast-vertical-navigation-next:after {
						transform: rotate( 135deg );
						bottom: 12px;
						left: 10px;
						top: inherit;
					}

					.ast-product-gallery-layout-vertical-slider .flex-viewport {
						height: auto !important; /* Override woocommerce defaults */
					}

					.ast-product-gallery-layout-vertical-slider .flex-viewport .woocommerce-product-gallery__wrapper img {
						object-fit: cover;
					}
				';
			} else {
				$woo_single_product_vertical_slider = '

					.woocommerce div.product div.images.woocommerce-product-gallery > .flex-viewport {
						margin-left: calc(20% + 10px);
						margin-bottom: 0;
					}

					#ast-vertical-thumbnail-wrapper {
						position: relative;
						overflow: hidden;
					}

					#ast-gallery-thumbnails {
						position: absolute;
						width: 20%;
						margin-top: -5px;
						transition: .3s;
					}

					#ast-gallery-thumbnails.slider-disabled .ast-navigation-wrapper {
						display: none;
					}

					.woocommerce-product-gallery-thumbnails__wrapper {
						position: absolute;
					}

					.ast-woocommerce-product-gallery__image {
						position: relative;
						display: block;
						width: inherit;
						padding-bottom: 100%;
						border-top: 5px solid transparent;
						border-bottom: 5px solid transparent;
					}

					#ast-vertical-thumbnail-wrapper .ast-woocommerce-product-gallery__image img{
						position: absolute;
						left: 0;
						right: 0;
						bottom: 0;
						top: 0;
						width: 100%;
						height: 100%;
						object-fit: cover;
					}

					.ast-woocommerce-product-gallery__image.flex-active-slide:after {
					}

					.ast-vertical-navigation-wrapper {
						position: absolute;
						top: 0;
						left: 0;
						bottom: 0;
						right: 0;
					}

					#ast-vertical-navigation-prev,
					#ast-vertical-navigation-next {
						left: 50%;
						transform: translateX(-50%);
					}

					#ast-vertical-navigation-prev {
						top: 0;
					}

					#ast-vertical-navigation-next {
						bottom: 0;
					}

					#ast-vertical-navigation-prev:after {
						transform: rotate( 45deg );
						top: 12px;
						right: 10px;
					}

					#ast-vertical-navigation-next:after {
						transform: rotate( -135deg );
						bottom: 12px;
						right: 10px;
						top: inherit;
					}

					.ast-product-gallery-layout-vertical-slider .flex-viewport {
					    height: auto !important; /* Override woocommerce defaults */
					}

					.ast-product-gallery-layout-vertical-slider .flex-viewport .woocommerce-product-gallery__wrapper img {
						object-fit: cover;
					}
				';
			}
			$css_output .= Astra_Enqueue_Scripts::trim_css( $woo_single_product_vertical_slider );

		}
	}

	// Product Variations to Buttons.
	if ( $single_product_variation_select ) {
		if ( is_rtl() ) {
			$woo_single_product_variation = '
				.woocommerce div.product form.cart .variations .ast-variation-button-group + select {
					display: none;
				}
				.woocommerce div.product form.cart .variations th {
					text-align: right;
					padding-right: 0;
				}
				.ast-variation-button-group {
					display: flex;
					flex-wrap: wrap;
					margin-top: .2em;
				}
				.ast-variation-button-group .ast-single-variation{
					display: inline-block;
					padding: 0.2em 1em;
					margin-bottom: 0.5em;
					margin-left: 0.5em;
					border: 1px solid var(--ast-border-color);
					cursor: pointer;
				}
			';
		} else {
			$woo_single_product_variation = '
				.woocommerce div.product form.cart .variations .ast-variation-button-group + select {
					display: none;
				}
				.woocommerce div.product form.cart .variations th {
					text-align: left;
					padding-left: 0;
				}
				.ast-variation-button-group {
					display: flex;
					flex-wrap: wrap;
					margin-top: .2em;
				}
				.ast-variation-button-group .ast-single-variation{
					display: inline-block;
					padding: 0.2em 1em;
					margin-bottom: 0.5em;
					margin-right: 0.5em;
					border: 1px solid var(--ast-border-color);
					cursor: pointer;
				}
			';
		}
		if ( Astra_Addon_Update_Filter_Function::astra_addon_update_variant_active_style() ) {
			$woo_single_product_variation .= '
				.ast-variation-button-group .ast-single-variation.active {
					color: #ffffff;
					background: var(--ast-global-color-2);
					border: 1px solid var(--ast-global-color-2);
				}
			';
		} else {
			$woo_single_product_variation .= '
				.ast-variation-button-group .ast-single-variation.active {
					border: 1px solid var( --ast-global-color-0 );
				}
			';
		}

		$css_output .= Astra_Enqueue_Scripts::trim_css( $woo_single_product_variation );
	}

	$order_summary_bg_color = astra_get_option( 'order-summary-background-color' );
	$font_style_updates     = Astra_Addon_Update_Filter_Function::astra_update_default_font_styling_addon();

	if ( is_checkout() && ! is_wc_endpoint_url( 'order-received' ) ) {
		if ( class_exists( 'WooCommerce_Germanized' ) ) {
			$germanized_checkout_css = array(
				'.woocommerce-page.woocommerce-checkout form #order_review table' => array(
					'background-color' => $order_summary_bg_color,
					'padding'          => '0 1.2em',
				),
				'.woocommerce-checkout .woocommerce #order_review, .woocommerce-checkout .woocommerce h3#order_review_heading' => array(
					'width' => '100%',
				),
				'form #order_review_heading:not(.elementor-widget-woocommerce-checkout-page #order_review_heading)' => array(
					'border-width' => '0',
					'font-size'    => $font_style_updates ? '' : '1.5em',
					'font-weight'  => $font_style_updates ? '' : '600',
				),
				'form #order_review_heading:not(.elementor-widget-woocommerce-checkout-page #order_review_heading),' => array(
					'padding'       => '0',
					'margin-top'    => '1em',
					'margin-bottom' => '0.7em',
					'border-bottom' => '0',
					'border'        => '0',
					'width'         => '100%',
					'font-size'     => $font_style_updates ? '' : '1.5em',
					'font-weight'   => $font_style_updates ? '' : '600',
				),
				'form #order_review:not(.elementor-widget-woocommerce-checkout-page #order_review)' => array(
					'padding'      => '0',
					'border-width' => '0',
					'font-size'    => $font_style_updates ? '' : '1.5em',
					'font-weight'  => $font_style_updates ? '' : '600',
				),
				'.ast-modern-checkout .woocommerce form #customer_details h3' => array(
					'padding'       => '0',
					'margin-top'    => '1em',
					'margin-bottom' => '0.7em',
					'border-bottom' => '0',
					'border'        => '0',
					'width'         => '100%',
					'font-size'     => $font_style_updates ? '' : '1.5em',
					'font-weight'   => $font_style_updates ? '' : '600',
				),
				'.ast-modern-checkout .woocommerce form #ast-payment_options_heading' => array(
					'font-size'   => $font_style_updates ? '' : '1.5em',
					'font-weight' => $font_style_updates ? '' : '600',
				),
			);
			$css_output             .= astra_parse_css( $germanized_checkout_css );
		} else {
			$order_summary_bg_color_css = array(
				// Order Summary Content Bg - Color Options CSS (NORMAL).
				'.woocommerce-checkout .woocommerce .ast-mobile-order-review-wrap' => array(
					'background-color' => $order_summary_bg_color,
				),
			);
			if ( 'modern' === $checkout_layout_type && 'one-column-checkout' === $modern_checkout_layout_type ) {
				// Order Summary Content Bg - Color Options CSS (NORMAL).
				$order_summary_bg_color_css['form #order_review:not(.elementor-widget-woocommerce-checkout-page #order_review) table'] = array(
					'background-color' => $order_summary_bg_color,
				);
			} else {
				// Order Summary Content Bg - Color Options CSS (NORMAL).
				$order_summary_bg_color_css['form #order_review:not(.elementor-widget-woocommerce-checkout-page #order_review)'] = array(
					'background-color' => $order_summary_bg_color,
				);
			}
			if ( 'modern' === $checkout_layout_type && 'two-column-checkout' === $modern_checkout_layout_type && ( defined( 'WCPAY_MIN_WC_ADMIN_VERSION' ) || defined( 'WC_STRIPE_VERSION' ) ) ) {
				// Strip payment Google-pay icon css.
				$strip_payment_layout_css = array(
					// Order Summary Content Bg - Color Options CSS (NORMAL).
					'[ID*="-payment-request-wrapper"], [ID*="-payment-request-button"]' => array(
						'width' => '100%',
					),
				);
				$css_output              .= astra_parse_css( $strip_payment_layout_css );
			}

			$css_output .= astra_parse_css( $order_summary_bg_color_css );
		}

		if ( 'modern' === $checkout_layout_type ) {

			if ( 'one-column-checkout' === $modern_checkout_layout_type ) {
				$woo_checkout_layout_one_column = '
				.woocommerce-checkout .woocommerce form.woocommerce-checkout #customer_details,
				.woocommerce-checkout .woocommerce form.woocommerce-checkout #order_review_heading,
				.woocommerce-checkout .woocommerce form.woocommerce-checkout #order_review {
					width: 100%;
				}

				.woocommerce-checkout .woocommerce form.woocommerce-checkout #customer_details {
					margin-bottom: 0;
				}
			';
				$css_output                    .= Astra_Enqueue_Scripts::trim_css( $woo_checkout_layout_one_column );
			}

			if ( ! astra_get_option( 'two-step-checkout' ) ) {
				$woo_checkout_hide_items = array();

				if ( ! is_wc_endpoint_url( 'order-pay' ) ) {
					$woo_checkout_hide_items = array(
						'.woocommerce-checkout .woocommerce #order_review, .woocommerce-checkout .woocommerce #order_review_heading' => array(
							'display' => 'none',
						),
					);
				}

				$css_output .= astra_parse_css( $woo_checkout_hide_items );

				$woo_checkout_layout = array(

					'.woocommerce-checkout .woocommerce #order_review, .woocommerce-checkout .woocommerce #order_review_heading' => array(
						'display' => 'block',
					),
					'.woocommerce-checkout .woocommerce .ast-mobile-order-review-wrap' => array(
						'display' => 'none',
					),
				);

				$css_output .= astra_parse_css( $woo_checkout_layout, astra_addon_get_tablet_breakpoint( '', 1 ) );

				$woo_order_summary = array(
					'.woocommerce-checkout .woocommerce .ast-mobile-order-review-wrap' => array(
						'margin-left'  => '-20px',
						'margin-right' => '-20px',
					),
				);

				$css_output .= astra_parse_css( $woo_order_summary, '', astra_addon_get_tablet_breakpoint() );

			}

			if ( class_exists( 'WooCommerce_Germanized' ) ) {
				$germanized_css = array(

					'.woocommerce-checkout .woocommerce .ast-mobile-order-review-wrap' => array(
						'display' => 'none',
					),

					'.woocommerce-checkout .woocommerce #order_review, .woocommerce-checkout .woocommerce #order_review_heading' => array(
						'display' => 'block',
					),

					'.ast-modern-checkout .ast-two-column-checkout .woocommerce-checkout #ast-order-review-wrapper' => array(
						'width' => '100%',
					),
				);

				$css_output .= astra_parse_css( $germanized_css, '', astra_addon_get_tablet_breakpoint() );

			}

			// Imports padlock icon fonts.
			$padlock_font_icon = '
			@font-face {
				font-family: "astra-font-icons";
				src:url("' . ASTRA_EXT_URI . '/assets/fonts/astra-font-icons.eot");
				src:url("' . ASTRA_EXT_URI . '/assets/fonts/astra-font-icons.eot") format("embedded-opentype"),
					url("' . ASTRA_EXT_URI . '/assets/fonts/astra-font-icons.ttf") format("truetype"),
					url("' . ASTRA_EXT_URI . '/assets/fonts/astra-font-icons.woff") format("woff"),
					url("' . ASTRA_EXT_URI . '/assets/fonts/astra-font-icons.svg") format("svg");
					font-weight: normal;
					font-style: normal;
					font-display: block;
			}
		';

			$css_output .= Astra_Enqueue_Scripts::trim_css( $padlock_font_icon );

			$btn_color = astra_get_option( 'button-color' );

			if ( empty( $btn_color ) ) {
				$btn_color = astra_get_foreground_color( $theme_color );
			}

			$btn_h_color = astra_get_option( 'button-h-color' );

			if ( empty( $btn_h_color ) ) {
				$btn_h_color = astra_get_foreground_color( $link_h_color );
			}

			$astra_global_woo_support = is_callable( 'Astra_Dynamic_CSS::astra_woo_support_global_settings' ) ? Astra_Dynamic_CSS::astra_woo_support_global_settings() : false;
			if ( ! $astra_global_woo_support ) {
				$place_order_button = array(
					'#place_order'       => array(
						'color' => $btn_color,
					),

					'#place_order:hover' => array(
						'color' => $btn_h_color,
					),
				);

				$css_output .= astra_parse_css( $place_order_button );
			}

			// Enable padlock on checkout place order button.
			$enable_checkout_button_padlock = astra_get_option( 'checkout-modern-checkout-button-padlock' );

			if ( $enable_checkout_button_padlock ) {
				$enable_checkout_button_padlock_css = array(
					'#place_order:before' => array(
						'content'      => '"\e98f"',
						'font-family'  => 'astra-font-icons',
						'margin-right' => '.3em',
						'font-size'    => '16px',
						'font-weight'  => '500',
					),
				);

				$css_output .= astra_parse_css( $enable_checkout_button_padlock_css );
			}

			$checkout_loader = array(
				'.woocommerce-checkout .woocommerce #order_review .woocommerce-checkout-review-order-table .blockUI.blockOverlay::before, .woocommerce-checkout .woocommerce #ast-order-review-content .woocommerce-checkout-review-order-table .blockUI.blockOverlay::before' => array(
					'background' => "url( '" . ASTRA_EXT_URI . "assets/svg/astra-order-review-skeleton.svg' ) left top",
				),

				'.woocommerce-checkout .woocommerce #payment .blockUI.blockOverlay::before' => array(
					'background' => "url( '" . ASTRA_EXT_URI . "assets/svg/astra-payment-section-loader.svg' ) left top",
				),
			);

			$css_output .= astra_parse_css( $checkout_loader );
		}
	}

	// Back to cart button on checkout.
	if ( is_checkout() && ! is_wc_endpoint_url( 'order-received' ) ) {
		$woo_back_to_cart_on_checkout_css = array(
			'.ast-back-to-cart' => array(
				'clear'       => 'both',
				'padding-top' => '.5em',
				'text-align'  => 'center',
			),
		);

		$css_output .= astra_parse_css( $woo_back_to_cart_on_checkout_css );
	}

	if ( astra_addon_check_elementor_pro_3_5_version() ) {
		$woo_cart_element_css = '
			.elementor-widget-woocommerce-cart form input[type=number].qty::-webkit-inner-spin-button, .elementor-widget-woocommerce-cart form input[type=number].qty::-webkit-outer-spin-button {
				-webkit-appearance: auto;
			}
		';

		$css_output .= Astra_Enqueue_Scripts::trim_css( $woo_cart_element_css );
	}

	if ( is_cart() ) {

		if ( $cart_modern_layout ) {
			$woo_hide_default_coupon = '
				.woocommerce-cart .woocommerce-cart-form table tbody tr:nth-last-child(1) .coupon {
					display: none !important; /* Override */
				}
			';

			$css_output .= Astra_Enqueue_Scripts::trim_css( $woo_hide_default_coupon );

			if ( $ajax_quantity_cart ) {
				$woo_hide_last_cell = '
					.woocommerce-cart .woocommerce-cart-form table tbody tr:nth-last-child(1) {
						display: none;
					}
				';

				$css_output .= Astra_Enqueue_Scripts::trim_css( $woo_hide_last_cell );
			}

			$ltr_right = 'right';
			$ltr_left  = 'left';

			if ( is_rtl() ) {
				$ltr_right = 'left';
				$ltr_left  = 'right';
			}

			$woo_modern_layout = '

				@media screen and ( min-width: ' . astra_addon_get_tablet_breakpoint( '', 1 ) . 'px ) {
					.woocommerce-cart-form__contents .product-thumbnail {
						width: 100px;
					}
					.woocommerce-cart-form .woocommerce-cart-form__contents .product-subtotal {
						padding-' . $ltr_right . ': 3em;
					}
					.woocommerce-cart-form__contents .woocommerce-cart-form__cart-item {
						position: relative;
					}
					#ast-cart-wrapper {
						display: flex;
						flex-wrap: wrap;
						align-items: flex-start;
						justify-content: space-between;
					}
					#ast-cart-wrapper .ast-cart-non-sticky {
						width: 68%;
					}
					#ast-cart-wrapper .cart-collaterals {
						width: 30%;
					}
					#ast-cart-wrapper .cart-collaterals .cart_totals {
						width: 100%;
					}
				}
			';

			$css_output .= Astra_Enqueue_Scripts::trim_css( $woo_modern_layout );

			$cart_loader = array(
				'.woocommerce-cart .woocommerce-cart-form .blockOverlay::before' => array(
					'background' => "url( '" . ASTRA_EXT_URI . "assets/svg/astra-cart-loader.svg' ) left top",
				),

				'.woocommerce-cart .cart_totals .blockOverlay::before' => array(
					'background' => "url( '" . ASTRA_EXT_URI . "assets/svg/astra-cart-totals-loader.svg' ) left top",
				),
			);

			$css_output .= astra_parse_css( $cart_loader );

		} else {
			if ( $ajax_quantity_cart ) {
				$woo_quantity_cart = '
					.woocommerce-cart .woocommerce-cart-form button[name="update_cart"] {
						display: none !important; /* Override */
					}
				';

				$css_output .= Astra_Enqueue_Scripts::trim_css( $woo_quantity_cart );
			}
		}
	}

	if ( ( is_checkout() && ! is_wc_endpoint_url( 'order-received' ) && 'modern' === $checkout_layout_type ) || ( is_cart() && $cart_modern_layout ) ) {
		$woo_custom_coupon = '

			#ast-checkout-coupon {
				margin-bottom: 1em;
				margin-top: 1em;
			}

			#ast-coupon-trigger {
				display: inline-block;
				cursor: pointer;
				margin-bottom: 0;
			}

			#ast-checkout-coupon .coupon, .woocommerce-form-coupon-toggle {
				display: none;
			}

			#ast-checkout-coupon .coupon {
				justify-content: space-between;
			}

			#ast-coupon-code {
				width: 70%;
			}

			#ast-apply-coupon {
				width: 28%;
				padding: 0 0.5em;
				text-align: center;
				line-height: normal;
				cursor: pointer;
				display: inline-flex;
				justify-content: center;
				align-items: center;
			}
			.ast-coupon-label {
				display:none;
			}
		';

		$css_output .= Astra_Enqueue_Scripts::trim_css( $woo_custom_coupon );
	}

	if ( $cart_steps && ( is_cart() || is_checkout() || is_wc_endpoint_url( 'order-received' ) ) ) {
		$cart_steps_hide = array();
		$cart_steps_hide['#ast-checkout-wrap a:not(.ast-current), #ast-checkout-wrap .ahfb-svg-iconset, #ast-checkout-wrap .ast-step-number'] = array(
			'display' => 'none',
		);

		$css_output .= astra_parse_css( $cart_steps_hide, '', astra_addon_get_tablet_breakpoint() );

		if ( $is_site_rtl ) {

			$cart_steps_reverse_arrows = '
				#ast-checkout-wrap .ahfb-svg-iconset {
					transform: rotate(180deg);
				}
			';

			$css_output .= Astra_Enqueue_Scripts::trim_css( $cart_steps_reverse_arrows );
		}
	}

	if ( true === astra_get_option( 'single-product-navigation-preview', false ) ) {
		$woo_np_box_shadow_color_hex = $global_palette['palette'][3];

		// Convert's HEX to RGB for box shadow.
		list($r, $g, $b)         = sscanf( $woo_np_box_shadow_color_hex, '#%02x%02x%02x' );
		$woo_np_box_shadow_color = 'rgba(' . $r . ',' . $g . ',' . $b . ', 0.25)';

		$woo_np_left  = 'left';
		$woo_np_right = 'right';

		if ( is_rtl() ) {
			$woo_np_left  = 'right';
			$woo_np_right = 'left';
		}

		$ltr_right = 'right';
		$ltr_left  = 'left';
		if ( is_rtl() ) {
			$ltr_right = 'left';
			$ltr_left  = 'right';
		}

		$navigation_image_preview_css = '
		.ast-navigation-product-preview {
			display: none;
			position: absolute;
			top: 28px;
			' . $woo_np_right . ': 0;
			z-index: 999;
			padding-top: .7em;
		}

		.ast-navigation-wrapper {
			display: flex;
			align-items: center;
			min-width: 240px;
			background-color: var( --ast-global-color-primary, --ast-global-color-5 );
			box-shadow: 0 0px 3px ' . $woo_np_box_shadow_color . ';
		}

		.ast-navigation-content {
			padding: 0.5em 1em;
			text-align: ' . $woo_np_left . ';
			font-size: .9em;
			line-height: .9em;
		}

		.ast-navigation-product-title {
			margin-bottom: 0.5em;
			color: var(--ast-global-color-2);
			line-height: normal;
		}

		.ast-navigation-price {
			color: var(--ast-global-color-0);
		}

		.ast-navigation-price del {
			color: var(--ast-global-color-0);
			opacity: .6;
		}

		.ast-product-navigation-wrapper a:hover .ast-navigation-product-preview {
			display: block;
		}
	';

		$css_output .= $navigation_image_preview_css;
	}

	if ( ( is_shop() || is_product_taxonomy() ) ) {
		if ( in_array( 'filters', astra_get_option( 'shop-toolbar-structure', array() ) ) ) {

			if ( 'shop-filter-collapsible' === astra_get_option( 'shop-filter-position' ) ) {

				$woo_shop_collapsable_filter = '
					.ast-collapse-filter {
						display: none;
						width: 100%;
						padding-bottom: 1.5em;
					}

					.ast-collapse-filter .ast-filter-wrap {
						display: grid;
						column-gap: 2em;
						width: 100%;
					}

					.ast-collapse-filter .ast-filter-wrap > div {
						-js-display: flex;
						display: flex;
						flex-direction: column;
						width: 100%;
					}

					.ast-collapse-filter .ast-filter-wrap > div.wcapf-widget-hidden {
						display: none;
					}
				';

				$css_output .= Astra_Enqueue_Scripts::trim_css( $woo_shop_collapsable_filter );

				$shop_filter_columns = astra_get_option( 'shop-filter-collapsable-columns' );

				if ( $shop_filter_columns ) {
					$res_index = 1;
					foreach ( $shop_filter_columns as $columns ) {
						$shop_filter_responsive = array();

						if ( 0 === $columns || 1 === $columns ) {
							$shop_filter_responsive['.ast-filter-wrap'] = array(
								'grid-template-columns' => 'repeat(1, 1fr)',
							);
						}

						if ( 2 === $columns ) {
							$shop_filter_responsive['.ast-filter-wrap'] = array(
								'grid-template-columns' => 'repeat(2, 1fr)',
							);
						}

						if ( 3 === $columns ) {
							$shop_filter_responsive['.ast-filter-wrap'] = array(
								'grid-template-columns' => 'repeat(3, 1fr)',
							);
						}

						if ( 4 === $columns ) {
							$shop_filter_responsive['.ast-filter-wrap'] = array(
								'grid-template-columns' => 'repeat(4, 1fr)',
							);
						}

						if ( 5 === $columns ) {
							$shop_filter_responsive['.ast-filter-wrap'] = array(
								'grid-template-columns' => 'repeat(5, 1fr)',
							);
						}

						if ( 6 === $columns ) {
							$shop_filter_responsive['.ast-filter-wrap'] = array(
								'grid-template-columns' => 'repeat(6, 1fr)',
							);
						}

						if ( 1 === $res_index ) {
							$css_output .= astra_parse_css( $shop_filter_responsive );
						}

						if ( 2 === $res_index ) {
							$css_output .= astra_parse_css( $shop_filter_responsive, '', astra_addon_get_tablet_breakpoint( '', 1 ) );
						}

						if ( 3 === $res_index ) {
							$css_output .= astra_parse_css( $shop_filter_responsive, '', astra_addon_get_mobile_breakpoint( '', 1 ) );
						}

						$res_index++;
					}
				}

				$shop_filter_max_height    = astra_get_option( 'shop-filter-scrollbar-max-height' );
				$is_shop_filter_max_height = astra_get_option( 'shop-filter-max-height' );

				if ( $is_shop_filter_max_height && $shop_filter_max_height ) {
					$shop_filter_height = array();
					$shop_filter_height['.ast-collapse-filter .ast-filter-wrap'] = array(
						'max-height' => $shop_filter_max_height . 'px',
						'overflow-y' => 'auto',
					);

					$css_output .= astra_parse_css( $shop_filter_height );
				}
			}
		}

		if ( $is_sidebar_sticky ) {
			$woo_shop_filter_sidebar = '
				.woocommerce-shop.ast-left-sidebar #content .ast-container,
				.woocommerce-shop.ast-right-sidebar #content .ast-container,
				.ast-woo-shop-archive.ast-left-sidebar #content .ast-container,
				.ast-woo-shop-archive.ast-right-sidebar #content .ast-container {
					display: flex;
					align-items: flex-start;
					flex-wrap: wrap;
				}
			';

			$css_output .= Astra_Enqueue_Scripts::trim_css( $woo_shop_filter_sidebar );
		}

		if ( $is_filter_accordion_mode ) {

			if ( $is_site_rtl ) {
				$woo_shop_filter_accordion = '
					.ast-filter-wrap .widget-title {
						position: relative;
						cursor: pointer;
						padding-left: 1em;
					}

					.ast-filter-wrap .widget-title .ahfb-svg-iconset {
						position: absolute;
						left: 0;
						top: 0.5em;
						width: 0.7em;
						fill: var(--ast-global-color-3);
						pointer-events: none;
						transition: .3s;
					}

					.ast-filter-wrap .widget-title.active .ahfb-svg-iconset {
						transform: rotate(-180deg);
					}

					.ast-filter-wrap .ast-filter-content {
						overflow: hidden;
						transition: .3s;
					}

					.ast-filter-wrap .widget-title.active + .ast-filter-content {
						overflow: inherit;
					}

					.ast-filter-content .price_slider_wrapper {
						padding-top: 1em;
					}
				';
			} else {
				$woo_shop_filter_accordion = '
					.ast-filter-wrap .widget-title {
						position: relative;
						cursor: pointer;
						padding-right: 1em;
					}

					.ast-filter-wrap .widget-title .ahfb-svg-iconset {
						position: absolute;
						right: 0;
						top: 0.5em;
						width: 0.7em;
						fill: var(--ast-global-color-3);
						pointer-events: none;
						transition: .3s;
					}

					.ast-filter-wrap .widget-title.active .ahfb-svg-iconset {
						transform: rotate(180deg);
					}

					.ast-filter-wrap .ast-filter-content {
						overflow: hidden;
						transition: .3s;
					}

					.ast-filter-wrap .widget-title.active + .ast-filter-content {
						overflow: inherit;
					}

					.ast-filter-content .price_slider_wrapper {
						padding-top: 1em;
					}
				';
			}

			$css_output .= Astra_Enqueue_Scripts::trim_css( $woo_shop_filter_accordion );

			$woo_shop_filter_flyout = '
				.ast-filter-wrap .ast-woo-sidebar-widget.widget,
				.astra-off-canvas-sidebar .ast-filter-wrap .widget,
				.ast-collapse-filter .ast-filter-wrap > div {
					margin-bottom: 0;
				}
				.ast-accordion-layout .ast-woo-sidebar-widget.widget {
					margin-top: 1.8em;
				}
				.ast-woo-sidebar-widget .ast-filter-content-inner,
				.astra-off-canvas-sidebar .ast-filter-content-inner,
				.ast-collapse-filter .ast-filter-content-inner {
					padding-bottom: 1em;
				}
			';

			$css_output .= Astra_Enqueue_Scripts::trim_css( $woo_shop_filter_flyout );
		} else {
			$filter_single_bottom_spacing = array(
				'.astra-off-canvas-sidebar .ast-filter-wrap .widget, .ast-filter-wrap .ast-woo-sidebar-widget.widget' => array(
					'margin-bottom' => '2.8em',
				),
			);

			$css_output .= astra_parse_css( $filter_single_bottom_spacing );
		}

		if ( ! defined( 'CFVSW_VER' ) ) {

			if ( astra_get_option( 'shop-filter-list-to-buttons' ) ) {

				$ltr_right = 'right';
				$ltr_left  = 'left';

				if ( is_rtl() ) {
					$ltr_right = 'left';
					$ltr_left  = 'right';
				}

				$woo_shop_filter_variations = '
					#secondary .woocommerce-widget-layered-nav-list li,
					#secondary .wc-block-checkbox-list li {
						margin-bottom: 0;
					}

					.woocommerce .woocommerce-widget-layered-nav-list li.woocommerce-widget-layered-nav-list__item,
					.woocommerce .widget .wc-block-checkbox-list li {
						display: inline-block;
					}

					.woocommerce .woocommerce-widget-layered-nav-list li.woocommerce-widget-layered-nav-list__item a,
					.woocommerce .widget .wc-block-checkbox-list li label {
						display: block;
						margin-' . $ltr_right . ': .5em;
						padding: .2em .8em;
						margin-bottom: .5em;
						border-radius: 2px;
						font-size: .9em;
						color: var( --ast-global-color-3 );
						border: 1px solid var( --ast-global-color-3 );
						transition: 0.2s linear;
						outline: none;
						cursor: pointer;
					}

					.woocommerce .woocommerce-widget-layered-nav-list li.woocommerce-widget-layered-nav-list__item a:hover,
					.woocommerce .widget .wc-block-checkbox-list li label:hover,
					.woocommerce .widget .wc-block-checkbox-list li input:checked + label,
					.woocommerce .woocommerce-widget-layered-nav-list li.woocommerce-widget-layered-nav-list__item.chosen a {
						color: var( --ast-global-color-0 );
						border: 1px solid var( --ast-global-color-0 );
					}

					.woocommerce .widget .wc-block-checkbox-list li input[type=checkbox]{
						display: none;
					}

					.woocommerce .widget .wc-block-checkbox-list li input:checked + label:before {
						font-family: "WooCommerce";
						speak: none;
						font-weight: normal;
						font-variant: normal;
						text-transform: none;
						line-height: 1;
						-webkit-font-smoothing: antialiased;
						margin-' . $ltr_right . ': 0.618em;
						content: "";
						text-decoration: none;
						color: #d65d67;
					}
				';

				$css_output .= Astra_Enqueue_Scripts::trim_css( $woo_shop_filter_variations );
			}
		}
	}

	// Woocommerce single product sticky summary.
	if ( $single_product_summary_sticky ) {
		$single_product_sticky_summary = array(
			'.ast-sticky-row'          => array(
				'display'         => 'flex',
				'justify-content' => 'space-between',
				'align-items'     => 'flex-start',
				'flex-wrap'       => 'wrap',
			),

			'.ast-sticky-row .summary' => array(
				'position' => '-webkit-sticky',
				'position' => 'sticky',

			),
		);

		$css_output .= astra_parse_css( $single_product_sticky_summary );
	}

	// Order Received Responsive.
	if ( is_wc_endpoint_url( 'order-received' ) && $is_modern_order_received ) {
		$order_received = array(
			'.woocommerce-checkout.woocommerce-order-received .woocommerce-order ul.woocommerce-order-overview li' => array(
				'width'          => '100%',
				'display'        => 'block',
				'margin'         => '0 0 .8em',
				'padding-bottom' => '.8em',
				'border-bottom'  => '1px solid var(--ast-border-color)',
			),
		);

		$css_output .= astra_parse_css( $order_received, '', astra_addon_get_tablet_breakpoint() );
	}

	$ltr_right = 'right';
	$ltr_left  = 'left';
	if ( is_rtl() ) {
		$ltr_right = 'left';
		$ltr_left  = 'right';
	}

	if ( is_account_page() && true === astra_get_option( 'modern-woo-account-view', false ) ) {
		$astra_addon_tablet_breakpoint = astra_addon_get_tablet_breakpoint();
		$astra_addon_mobile_breakpoint = astra_addon_get_mobile_breakpoint();

		if ( ! is_user_logged_in() ) {

			$my_account_page_css = '
				.woocommerce-account .entry-content .woocommerce {
					max-width: ' . apply_filters( 'astra_addon_modern_account_form_width', '540px' ) . ';
					margin: 2em auto;
					border: 1px solid var(--ast-border-color);
					padding: 40px;
					border-radius: 3px;
				}
				.woocommerce form .form-row-first {
					width: 100%;
				}
				.woocommerce-account .entry-content .woocommerce h2 {
					text-align: center;
					font-weight: bold;
					margin-bottom: 1.5em;
				}
				.woocommerce-account .woocommerce form .form-row {
					margin-bottom: 20px;
				}
				.woocommerce-LostPassword.lost_password {
					text-align: center;
					margin-bottom: 0;
				}

				.woocommerce input[type="checkbox"]:checked::before {
					content: "\2713";
					background: var( --ast-global-color-0 );
					color: var( --ast-global-color-primary, --ast-global-color-5 );
					display: block;
					text-align: center;
					padding-top: 1px;
					margin: 0;
					font-size: 0.8em;
					width: 100%;
					height: 100%;
					-webkit-font-smoothing: antialiased;
				}
				.woocommerce input[type="checkbox"] {
					border: 1px solid var( --ast-global-color-0 );
					background: #fff;
					-webkit-appearance: none;
					appearance: none;
					overflow: hidden;
					border-radius: 3px;
				}

				.woocommerce-account .woocommerce form .form-row input:focus, .woocommerce-account .woocommerce form .form-row input:active {
					border-color: var( --ast-global-color-0 );
				}

				button.woocommerce-button[type="submit"] {
					width: 100%;
				}
				.woocommerce button.button.woocommerce-form-login__submit {
					margin-top: 1.5em;
				}
				.woocommerce-form-login__rememberme input {
					width: 16px;
					height: 16px;
					vertical-align: middle;
					margin-' . esc_attr( $ltr_right ) . ': 5px;
				}
				label.woocommerce-form__label.woocommerce-form__label-for-checkbox.woocommerce-form-login__rememberme {
					font-weight: 600;
				}
				/* Targeting re-enter new password field to take full width. */
				.lost_reset_password .woocommerce-form-row.form-row {
					width: 100%;
				}
			';

			if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) {
				$my_account_page_css .= '
					.woocommerce-account #customer_login .col-1,
					.woocommerce-account #customer_login .col-2 {
						width: 100%;
					}
					#customer_login > .u-column2 {
						display: none;
					}
					.woocommerce-form .ast-woo-form-actions {
						text-align: center;
						margin-top: 1.5em;
						margin-bottom: 0;
					}
				';
			}
		} else {
			$my_account_page_css = '
					.woocommerce-lost-password .woocommerce {
						max-width: ' . apply_filters( 'astra_addon_modern_account_form_width', '540px' ) . ';
						margin: 2em auto;
						border: 1px solid var(--ast-border-color);
						padding: 40px;
						border-radius: 3px;
					}
					.woocommerce-lost-password .woocommerce form .form-row-first {
						width: 100%;
					}
					.woocommerce-account .woocommerce form .form-row {
						margin-bottom: 20px;
					}
					.ast-modern-woo-account-page .entry-content {
						margin: 2em auto;
					}
					.ast-theme-transparent-header.ast-modern-woo-account-page header.ast-no-title + .entry-content {
					margin: 0;
					}
					.woocommerce-MyAccount-navigation-link .ahfb-svg-iconset {
						margin-' . esc_attr( $ltr_right ) . ': 20px;
					}
					.woocommerce-account .woocommerce-MyAccount-navigation {
						width: 22%;
						border-right: 1px solid var(--ast-border-color);

					}
					.woocommerce-MyAccount-navigation .woocommerce-MyAccount-navigation-link + .woocommerce-MyAccount-navigation-link {
						border-top: 1px solid var(--ast-border-color);
					}
					.woocommerce-account .woocommerce-MyAccount-content {
						width: 75%;
					}
					.woocommerce-MyAccount-navigation ul {
						list-style: none;
						padding: 0;
						background: var(--ast-global-color-primary, --ast-global-color-5);
					}
					.woocommerce-MyAccount-navigation-link span.ahfb-svg-iconset {
						vertical-align: middle;
						color: var(--ast-global-color-0);
					}
					.woocommerce-MyAccount-navigation-link span.ahfb-svg-iconset svg, .woocommerce-MyAccount-downloads-file svg {
						fill: currentColor;
					}
					li.woocommerce-MyAccount-navigation-link {
						position: relative;
					}
					li.woocommerce-MyAccount-navigation-link.is-active:after, li.woocommerce-MyAccount-navigation-link:hover:after {
						opacity: 1;
					}
					.woocommerce-MyAccount-navigation ul li a {
						display: inline-flex;
						padding: 1em;
						width: 100%;
						font-weight: 500;
						color: var(--ast-global-color-3);
						transition: all 0.1s;
					}
					.woocommerce-MyAccount-navigation ul li a:focus {
						outline: none;
					}
					.woocommerce-MyAccount-navigation ul li span.ahfb-svg-iconset, .woocommerce-MyAccount-navigation-link a:hover span.ahfb-svg-iconset {
						color: inherit;
					}
					.woocommerce-MyAccount-navigation-link.is-active a, .woocommerce-MyAccount-navigation-link:hover a {
						color: var(--ast-global-color-0);
					}
					/** Account page content. */
					.woocommerce-edit-account .woocommerce form .form-row {
						margin-bottom: 20px;
					}

					.woocommerce-account .woocommerce-MyAccount-content fieldset legend {
						border-bottom: none;
					}
					/** Shop details & columns layout CSS. */
					.woocommerce-order-details .shop_table thead, .woocommerce-order-pay .shop_table thead {
						display: none;
					}
					.woocommerce-order-details .shop_table, .woocommerce-order-pay .shop_table {
						width: 100%;
						border-spacing: 0;
						border-collapse: separate;
						margin: 0 0 30px 0;
						border-radius: 3px;
					}
					.woocommerce-order-details .shop_table tfoot tr:first-child th, .woocommerce-order-details .shop_table tfoot tr:first-child td, .woocommerce-order-pay .shop_table tfoot tr:first-child th, .woocommerce-order-pay .shop_table tfoot tr:first-child td {
						padding-top: 15px;
					}
					.woocommerce-MyAccount-content .woocommerce-order-details .shop_table tbody tr td, .woocommerce-order-details .shop_table thead tr th, .woocommerce-order-pay .shop_table thead tr th, .woocommerce-order-details .shop_table tbody tr td, .woocommerce-order-pay .shop_table tbody tr td {
						padding: 12px 15px;
						border: 0;
						border-bottom: 1px solid var(--ast-border-color);
						box-sizing: border-box;
					}
					.shop_table tfoot tr {
						border-bottom: 1px solid var(--ast-border-color);
					}
					.woocommerce-order-details .shop_table tfoot tr th, .woocommerce-order-details .shop_table tfoot tr td, .woocommerce-order-pay .shop_table tfoot tr th, .woocommerce-order-pay .shop_table tfoot tr td {
						padding-top: 0;
						padding-bottom: 10px;
						border: 0;
						background: rgba(0,0,0,0.03);
						font-weight: normal;
					}
					.woocommerce-order-details .shop_table tfoot tr:last-child th, .woocommerce-order-details .shop_table tfoot tr:last-child td, .woocommerce-order-pay .shop_table tfoot tr:last-child th, .woocommerce-order-pay .shop_table tfoot tr:last-child td {
						border-top: 1px solid var(--ast-border-color);
						font-size: 1em;
						padding-top: 10px;
					}
					.woocommerce-column--1 {
						margin-bottom: 2em;
					}
					.woocommerce table.shop_table .woocommerce-Price-amount, .woocommerce-page table.shop_table .woocommerce-Price-amount {
						font-weight: normal;
					}
					mark.order-status, mark.order-date, mark.order-number, td.woocommerce-table__product-name.product-name a, td.woocommerce-table__product-total.product-total span bdi {
						font-weight: 600;
					}
					.woocommerce-account .woocommerce-MyAccount-content .woocommerce-column__title, .woocommerce .woocommerce-Addresses .woocommerce-Address-title, .woocommerce table.shop_table thead, .woocommerce-page table.shop_table thead {
						background: rgba(0,0,0,0.03);
						border: 1px solid var(--ast-border-color);
					}
					.woocommerce-account .woocommerce-customer-details address, .woocommerce-account .woocommerce-MyAccount-content address, .woocommerce-order-details table.shop_table, .woocommerce-order-pay table.shop_table {
						border: 1px solid var(--ast-border-color);
					}
					.ast-modern-woo-account-page .woocommerce-MyAccount-content .woocommerce-pagination {
						margin-top: 2em;
					}
					@media(min-width: ' . $astra_addon_tablet_breakpoint . 'px) {
						.woocommerce-MyAccount-navigation-link:after {
							content: "";
							position: absolute;
							top: 1px;
							z-index: 9;
							' . esc_attr( $ltr_right ) . ': -1px;
							background-color: var(--ast-global-color-0);
							-webkit-transition: all .3s;
							-o-transition: all .3s;
							transition: all .3s;
							opacity: 0;
							height: 100%;
							width: 3px;
						}
					}
					@media(max-width: ' . $astra_addon_tablet_breakpoint . 'px) {
						.woocommerce-account .woocommerce-MyAccount-navigation, .woocommerce-account .woocommerce-MyAccount-content, .woocommerce-MyAccount-navigation .woocommerce-MyAccount-navigation-link + .woocommerce-MyAccount-navigation-link, .woocommerce-MyAccount-navigation ul li a {
							width: 100%;
							border: none;
						}
						.woocommerce-MyAccount-navigation ul li a {
							padding-' . esc_attr( $ltr_left ) . ': 0;
						}
						.ast-wooaccount-user-wrapper {
							text-align: center;
						}
						.woocommerce-MyAccount-navigation ul {
							display: grid;
							grid-template-columns: repeat( 2, 1fr );
							column-gap: 20px;
							margin-bottom: 2em;
						}
						.woocommerce-downloads .woocommerce-MyAccount-content .woocommerce-Message {
							display: block;
						}
					}
				';

			if ( true === astra_get_option( 'my-account-user-gravatar', false ) ) {
				$my_account_page_css .= '
					.ast-wooaccount-user-wrapper {
						overflow: hidden;
						margin-bottom: 2em;
						display: inline-flex;
						column-gap: 20px;
						align-items: center;
					}
					.ast-wooaccount-user-wrapper img {
						-webkit-border-radius: 60px;
						border-radius: 60px;
					}
				';
			}

			if ( true === astra_get_option( 'show-woo-grid-orders', false ) ) {
				$my_account_page_css .= '
					.ast-woo-grid-orders-container {
						display: grid;
    					grid-row-gap: 2em;
						grid-template-columns: repeat( 1, 1fr );
					}
					.ast-orders-table__row {
						background: var(--ast-global-color-primary, --ast-global-color-5);
						padding: 20px;
						border: 1px solid var(--ast-border-color);
						border-radius: 4px;
						box-shadow: 0 2px 5px 1px rgb(64 60 67 / 16%);
						position: relative;
					}

					.ast-dl-single {
						position: relative;
						margin-bottom: 0.5em;
					}

					.ast-woo-order-date {
						font-size: 1.2em;
					}

					.ast-orders-table__cell, .ast-orders-table__row [class*="download-"]{
						margin-' . esc_attr( $ltr_left ) . ' : 80px;
					}

					.ast-orders-table__cell-order-actions a, .ast-orders-table__row .download-file a {
						margin-' . esc_attr( $ltr_right ) . ': 0.5em;
						white-space: pre;
					}

					.ast-orders-table__cell-order-actions a:nth-last-child(1) , .ast-orders-table__row .download-file a:nth-last-child(1) {
						margin-' . esc_attr( $ltr_right ) . ': 0;
					}

					.ast-orders-table__cell-order-number, .ast-woo-order-image-wrap {
						width: 60px;
						position: absolute;
						top: 0;
						height: 100%;
						display: flex;
						align-items: center;
						margin-' . esc_attr( $ltr_right ) . ': 20px;
						margin-' . esc_attr( $ltr_left ) . ': 0;
					}
					.ast-orders-table__cell-order-number img, .ast-woo-order-image-wrap img {
						border-radius: 4px;
						width: 60px;
					}
					.woocommerce-MyAccount-downloads-file .ahfb-svg-iconset {
						margin-' . esc_attr( $ltr_right ) . ': 5px;
						vertical-align: middle;
					}

					@media(min-width: ' . $astra_addon_mobile_breakpoint . 'px) {
						.ast-orders-table__cell, .ast-orders-table__row [class*="download-"]{
							width: 50%;
						}

						.ast-orders-table__cell-order-actions, .ast-orders-table__row .download-file {
							position: absolute;
							top: 20px;
							' . esc_attr( $ltr_right ) . ': 20px;
							margin-' . esc_attr( $ltr_left ) . ': 0;
							width: calc(50% - 120px);
							text-align: ' . esc_attr( $ltr_right ) . ';
						}

						.ast-orders-table__row .ast-dl-single .download-file {
							' . esc_attr( $ltr_right ) . ': 0;
						}
					}
				';
			}
		}

		$css_output .= $my_account_page_css;
	}

	if ( astra_get_option( 'cart-modern-layout' ) ) {
		$responsive_cart_cross_sells_css = '
			@media screen and ( min-width: ' . astra_addon_get_mobile_breakpoint() . 'px ) {
				body.woocommerce-cart .woocommerce .cross-sells ul.products .ast-article-single .astra-shop-summary-wrap {
					padding-right: 10em;
				}

				body.woocommerce-cart .cross-sells ul.products .ast-article-single .astra-shop-summary-wrap .price {
					max-width: 10.5em;
				}
			}
		';

		$css_output .= $responsive_cart_cross_sells_css;
	}

	if ( 'shop-page-modern-style' === astra_get_option( 'shop-style' ) ) {
		$modern_shop_page_css = '';
		$mobile_breakpoint    = astra_addon_get_mobile_breakpoint();

		if ( ! in_array( 'short_desc', astra_get_option( 'shop-product-structure' ) ) ) {
			$modern_shop_page_css .= '
				.ast-woocommerce-shop-page-modern-style .ast-woo-shop-product-description {
					display: none;
				}
			';
		}

		// Only if shop filters are enabled & either link or button type is set.
		$filters_type = astra_get_option( 'shop-off-canvas-trigger-type' );
		if ( 'link' === $filters_type || 'button' === $filters_type ) {
			$modern_shop_page_css .= '
				.woocommerce.ast-woocommerce-shop-page-modern-style .astra-shop-filter-button {
					vertical-align: middle;
					margin: 0;
				}
				.astra-shop-filter-button svg {
					margin-' . esc_attr( $ltr_right ) . ': 5px;
					fill: currentColor;
				}
				.ast-header-break-point.ast-woocommerce-shop-page-modern-style .astra-shop-filter-button {
					float: ' . esc_attr( $ltr_right ) . ';
				}
			';
		}

		if ( 'on-image' === astra_get_option( 'shop-quick-view-enable' ) ) {
			$modern_shop_page_css .= '
				.ast-quick-view-trigger {
					top: 4em;
				}
			';
		}

		$dynamic_css .= $modern_shop_page_css;

		$dynamic_css .= '
			@media(max-width: ' . $mobile_breakpoint . 'px) {
				.ast-header-break-point .ast-shop-toolbar-container {
					position: fixed;
					bottom: 0;
					left: 0;
					right: 0;
					z-index: 590;
				}
				.ast-header-break-point.ast-woocommerce-shop-page-modern-style .woocommerce-ordering {
					float: left;
					clear: both;
					margin-left: 0;
					width: auto;
				}
				.ast-header-break-point.ast-woocommerce-shop-page-modern-style .ast-shop-toolbar-container,
				.ast-header-break-point.ast-woocommerce-shop-page-modern-style .ast-shop-toolbar-container .ast-shop-toolbar-aside-wrap,
				.ast-header-break-point.ast-woocommerce-shop-page-modern-style .ast-sticky-shop-filters > * {
					margin-bottom: 0;
				}
				.ast-header-break-point.ast-woocommerce-shop-page-modern-style ul.products {
					margin-top: 2.5em;
				}
				.ast-header-break-point.ast-woocommerce-shop-page-modern-style .ast-sticky-shop-filters .woocommerce-result-count {
					display: none;
				}
				.ast-header-break-point.ast-woocommerce-shop-page-modern-style .ast-sticky-shop-filters > *:not(:last-child) {
					margin-right: 15px;
				}
				.ast-header-break-point.ast-woocommerce-shop-page-modern-style .ast-sticky-shop-filters .ast-view-trigger {
					-js-display: flex;
					display: flex;
				}
				.ast-header-break-point.ast-woocommerce-shop-page-modern-style .ast-sticky-shop-filters .ast-products-view {
					-js-display: inline-flex;
					display: inline-flex;
				}
			}
		';
	}

	$qv_enable = astra_get_option( 'shop-quick-view-enable' );

	if ( 'disabled' !== $qv_enable ) {
		$woo_quick_view_css = array(
			'.summary .ast-width-md-6' => array(
				'float' => 'unset',
			),
		);

		$css_output .= astra_parse_css( $woo_quick_view_css );
	}

	if ( in_array( 'easy_view', astra_get_option( 'shop-toolbar-structure', array() ) ) ) {
		$easy_list_view_css = '
			.ast-woocommerce-shop-page-list-view ul.products li.product .astra-shop-summary-wrap {
				align-self: center;
			}

			.woocommerce.ast-woocommerce-shop-page-list-view ul.products li.product {
				display: grid;
				grid-template-columns: 1fr 2fr;
				padding-bottom: 0;
			}
			.woocommerce.ast-woocommerce-shop-page-list-view ul.products li.product .astra-shop-thumbnail-wrap {
				width: 100%;
				margin-bottom: 0;
			}
			.woocommerce.ast-woocommerce-shop-page-list-view .ast-woo-shop-product-description {
				display: block;
			}
			.ast-desktop .woocommerce-ordering {
				margin: 0 10px;
			}
			.ast-view-trigger svg {
				fill: currentColor;
			}
			.ast-products-view {
				display: flex;
				align-items: center;
			}
			.ast-view-trigger {
				height: 17px;
				color: var(--ast-global-color-3);
				cursor: pointer;
			}
			.ast-view-trigger:not(:first-child) {
				margin-' . esc_attr( $ltr_left ) . ': 10px;
			}
			.ast-view-trigger.active {
				color: var(--ast-global-color-0);
			}
			.ast-force-short-desc-listview-display .ast-woo-shop-product-description {
				display: none;
			}
			.ast-force-short-desc-listview-display.ast-woocommerce-shop-page-list-style .ast-woo-shop-product-description {
				display: block;
			}

		';

		$css_output .= $easy_list_view_css;

		// Easy list view alignment.
		$easy_list_alignment = astra_get_option( 'easy-list-content-alignment' );

		$easy_list_alignment_desktop       = isset( $easy_list_alignment['desktop'] ) ? $easy_list_alignment['desktop'] : 'center';
		$easy_list_alignment_tablet        = isset( $easy_list_alignment['tablet'] ) ? $easy_list_alignment['tablet'] : 'center';
		$easy_list_alignment_mobile        = isset( $easy_list_alignment['mobile'] ) ? $easy_list_alignment['mobile'] : 'center';
		$easy_list_view_alignment_selector = '.ast-woocommerce-shop-page-list-view ul.products li.product .astra-shop-summary-wrap';

		if ( $easy_list_alignment ) {

			if ( $easy_list_alignment_desktop ) {

				$easy_list_view_alignment_desktop_css                                       = array();
				$easy_list_view_alignment_desktop_css[ $easy_list_view_alignment_selector ] = array(
					'align-self' => 'top' === $easy_list_alignment_desktop ? 'flex-start' : 'center',
				);

				$css_output .= astra_parse_css( $easy_list_view_alignment_desktop_css, '' );
			}

			if ( $easy_list_alignment_tablet ) {

				$easy_list_view_alignment_tablet_css                                       = array();
				$easy_list_view_alignment_tablet_css[ $easy_list_view_alignment_selector ] = array(
					'align-self' => 'top' === $easy_list_alignment_tablet ? 'flex-start' : 'center',
				);

				$css_output .= astra_parse_css( $easy_list_view_alignment_tablet_css, '', astra_addon_get_tablet_breakpoint() );
			}

			if ( $easy_list_alignment_mobile ) {

				$easy_list_view_alignment_mobile_css                                       = array();
				$easy_list_view_alignment_mobile_css[ $easy_list_view_alignment_selector ] = array(
					'align-self' => 'top' === $easy_list_alignment_mobile ? 'flex-start' : 'center',
				);

				$css_output .= astra_parse_css( $easy_list_view_alignment_mobile_css, '', astra_addon_get_mobile_breakpoint() );
			}
		}

		// Easy list view list grid change.
		$easy_list_view_columns = astra_get_option(
			'easy-list-grids',
			array(
				'desktop' => 2,
				'tablet'  => 1,
				'mobile'  => 1,
			)
		);

		if ( 'shop-page-list-style' !== astra_get_option( 'shop-style' ) && $easy_list_view_columns ) {

			$easy_list_view_columns_desktop = array();
			if ( false === Astra_Addon_Builder_Helper::apply_flex_based_css() ) {
				// Desktop.
				$easy_list_view_columns_desktop['.ast-woocommerce-shop-page-list-view ul.products:before']                                      = array(
					'content' => 'unset',
				);
				$easy_list_view_columns_desktop['.woocommerce ul.products:not(.elementor-grid) li.product']                                     = array(
					'transition' => 'none',
				);
				$easy_list_view_columns_desktop['.ast-woocommerce-shop-page-list-view ul.products:not(.elementor-grid)']                        = array(
					'display'               => 'grid',
					'column-gap'            => '20px',
					'column-gap'            => '20px',
					'grid-template-columns' => 'repeat(' . $easy_list_view_columns['desktop'] . ', minmax(0, 1fr))',
				);
				$easy_list_view_columns_desktop['.woocommerce.ast-woocommerce-shop-page-list-view ul.products:not(.elementor-grid) li.product'] = array(
					'width'      => '100%',
					'transition' => 'none',
				);
			} else {
				// Desktop.
				$easy_list_view_columns_desktop['body.woocommerce.ast-woocommerce-shop-page-list-view ul.products:not(.elementor-grid)'] = array(
					'grid-template-columns' => 'repeat(' . $easy_list_view_columns['desktop'] . ', minmax(0, 1fr))',
				);
			}

			$css_output .= astra_parse_css( $easy_list_view_columns_desktop );

			// Tablet.
			$easy_list_view_columns_tablet = array();
			$easy_list_view_columns_tablet['body.woocommerce.ast-woocommerce-shop-page-list-view ul.products:not(.elementor-grid)'] = array(
				'grid-template-columns' => 'repeat(' . $easy_list_view_columns['tablet'] . ', minmax(0, 1fr))',
			);

			$css_output .= astra_parse_css( $easy_list_view_columns_tablet, '', astra_addon_get_tablet_breakpoint() );

			// Mobile.
			$easy_list_view_columns_mobile = array();
			$easy_list_view_columns_mobile['body.woocommerce.ast-woocommerce-shop-page-list-view ul.products:not(.elementor-grid)'] = array(
				'grid-template-columns' => 'repeat(' . $easy_list_view_columns['mobile'] . ', minmax(0, 1fr))',
			);

			$css_output .= astra_parse_css( $easy_list_view_columns_mobile, '', astra_addon_get_mobile_breakpoint() );
		}
	}

	$shop_style_type                = astra_get_option( 'shop-style' );
	$shop_product_content_alignment = astra_get_option( 'shop-page-list-style-alignment' );

	$shop_product_content_alignment_desktop = isset( $shop_product_content_alignment['desktop'] ) ? $shop_product_content_alignment['desktop'] : 'center';
	$shop_product_content_alignment_tablet  = isset( $shop_product_content_alignment['tablet'] ) ? $shop_product_content_alignment['tablet'] : 'center';
	$shop_product_content_alignment_mobile  = isset( $shop_product_content_alignment['mobile'] ) ? $shop_product_content_alignment['mobile'] : 'center';

	$shop_product_alignment_selector = '.woocommerce.ast-woocommerce-shop-page-list-style ul.products li.product .astra-shop-summary-wrap, .woocommerce-page.ast-woocommerce-shop-page-list-style ul.products li.product .astra-shop-summary-wrap';

	if ( $shop_style_type && 'shop-page-list-style' === $shop_style_type ) {

		if ( $shop_product_content_alignment_desktop ) {

			$shop_product_content_alignment_desktop_css                                     = array();
			$shop_product_content_alignment_desktop_css[ $shop_product_alignment_selector ] = array(
				'align-self' => 'top' === $shop_product_content_alignment_desktop ? 'flex-start' : 'center',
			);

			$css_output .= astra_parse_css( $shop_product_content_alignment_desktop_css );
		}

		if ( $shop_product_content_alignment_tablet ) {

			$shop_product_content_alignment_tablet_css                                     = array();
			$shop_product_content_alignment_tablet_css[ $shop_product_alignment_selector ] = array(
				'align-self' => 'top' === $shop_product_content_alignment_tablet ? 'flex-start' : 'center',
			);

			$css_output .= astra_parse_css( $shop_product_content_alignment_tablet_css, '', astra_addon_get_tablet_breakpoint() );
		}

		if ( $shop_product_content_alignment_mobile ) {

			$shop_product_content_alignment_mobile_css                                     = array();
			$shop_product_content_alignment_mobile_css[ $shop_product_alignment_selector ] = array(
				'align-self' => 'top' === $shop_product_content_alignment_mobile ? 'flex-start' : 'center',
			);

			$css_output .= astra_parse_css( $shop_product_content_alignment_mobile_css, '', astra_addon_get_mobile_breakpoint() );
		}
	}

	$qv_enable = astra_get_option( 'shop-quick-view-enable' );

	if ( 'disabled' !== $qv_enable ) {
		$woo_quick_view_css = array(
			'.summary .ast-width-md-6' => array(
				'float' => 'unset',
			),
		);

		$css_output .= astra_parse_css( $woo_quick_view_css );
	}

	$available_gateways = WC()->payment_gateways->get_available_payment_gateways();

	if ( empty( $available_gateways ) ) {

		$woo_checkout_payment_css = array(
			'.woocommerce.woocommerce-checkout #payment ul.payment_methods, .woocommerce-page.woocommerce-checkout #payment ul.payment_methods' => array(
				'border'        => esc_attr( '0' ),
				'border-radius' => esc_attr( '0' ),
			),

			'.woocommerce.woocommerce-checkout #payment ul.payment_methods > li:first-child, .woocommerce-page.woocommerce-checkout #payment ul.payment_methods > li:first-child' => array(
				'border-radius' => esc_attr( '0' ),
			),
		);

		$css_output .= astra_parse_css( $woo_checkout_payment_css );
	}

	// Sale Badge border radius.
	$woo_sale_border_radius        = astra_get_option( 'woo-sale-border-radius' );
	$woo_enable_sale_border_radius = astra_get_option( 'woo-enable-sale-border-radius' );
	$is_sale_badge_active          = astra_get_option( 'product-sale-notification', 'default' );

	if ( $woo_enable_sale_border_radius && 'none' != $is_sale_badge_active ) {
		$woo_sale_border_radius_css = array();
		$woo_sale_border_radius_css['body.woocommerce .onsale, body.woocommerce-page .onsale, .ast-onsale-card, body .wc-block-grid .wc-block-grid__products .wc-block-grid__product .wc-block-grid__product-onsale'] = array(
			'border-radius' => astra_get_css_value( $woo_sale_border_radius, 'px !important' ),
		);

		$css_output .= astra_parse_css( $woo_sale_border_radius_css );
	}

	// First image large single gallery layout conflicting with Elementor Pro Single Product Page template.
	if ( is_product() && true === ASTRA_Ext_WooCommerce_Markup::$wc_layout_built_with_themer && 'first-image-large' === $single_product_gallery_layout ) {
		$single_product_template_hide_tns_css = array(
			'.tns-outer' => array(
				'display' => 'none',
			),
		);
		$css_output                          .= astra_parse_css( $single_product_template_hide_tns_css, '', astra_addon_get_tablet_breakpoint() );
	}

	$woo_empty_cart_featured_product = astra_get_option( 'woo-cart-empty-featured-product' );

	if ( $woo_empty_cart_featured_product ) {
		$woo_empty_cart_featured_product_css = array(

			'.astra-cart-drawer-content .ast-mini-cart-empty .ast-mini-cart-message, .ast-site-header-cart .ast-empty-cart-content' => array(
				'display' => 'none',
			),

			'.astra-cart-drawer-content .ast-empty-cart-content' => array(
				'padding'  => '1.5em 1em 1em 1em',
				'overflow' => 'auto',
			),

			'.astra-cart-drawer .ast-empty-cart-content > .woocommerce, .astra-cart-drawer-content .ast-empty-cart-content > h2' => array(
				'max-width' => '300px',
				'margin'    => '0 auto',
			),

			'.astra-cart-drawer-content .ast-empty-cart-content > h2' => array(
				'margin-bottom' => '1em',
			),

			'#astra-mobile-cart-drawer .ast-empty-cart-content .products' => array(
				'grid-template-columns' => 'auto',
			),

			'.astra-cart-drawer .ast-empty-cart-content .products .product' => array(
				'padding-bottom' => '0',
				'margin-bottom'  => '0',
			),
		);

		$css_output .= astra_parse_css( $woo_empty_cart_featured_product_css );
	}

	return $dynamic_css . $css_output;
}
