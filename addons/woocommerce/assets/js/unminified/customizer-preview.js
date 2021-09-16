/**
 * This file adds some LIVE to the Customizer live preview. To leverage
 * this, set your custom settings to 'postMessage' and then add your handling
 * here. Your javascript should grab settings from customizer controls, and
 * then make any necessary changes to the page using jQuery.
 *
 * @package Astra Addon
 * @since  1.0.0
 */

( function( $ ) {

	/**
	 * Shop: Content Alignment
	 */
	wp.customize( 'astra-settings[shop-product-align]', function( setting ) {
		setting.bind( function( alignment ) {

			var products = $(document).find('.woocommerce-page .products .product, .woocommerce .products .product');
			products.removeClass('align-left align-right align-center');
			products.addClass( alignment );
		} );
	} );

	/**
	 * Shop: Box Shadow
	 */
	wp.customize( 'astra-settings[shop-product-shadow]', function( setting ) {
		setting.bind( function( product_shadow ) {

			var products = $(document).find('.woocommerce-page .products .product, .woocommerce .products .product');
			product_shadow = product_shadow > 5 ? 5 : ( product_shadow < 0 ? 0 : product_shadow );
			products.removeClass('box-shadow-0 box-shadow-1 box-shadow-2 box-shadow-3 box-shadow-4 box-shadow-5');
			products.addClass( 'box-shadow-' + product_shadow );
		} );
	} );

	/**
	 * Shop: Box Hover Shadow
	 */
	wp.customize( 'astra-settings[shop-product-shadow-hover]', function( setting ) {
		setting.bind( function( product_shadow ) {

			var products = $(document).find('.woocommerce-page .products .product, .woocommerce .products .product');
			product_shadow = product_shadow > 5 ? 5 : ( product_shadow < 0 ? 0 : product_shadow );

			products.removeClass('box-shadow-0-hover box-shadow-1-hover box-shadow-2-hover box-shadow-3-hover box-shadow-4-hover box-shadow-5-hover');
			products.addClass( 'box-shadow-' + product_shadow + '-hover' );
		} );
	} );

	/**
	 * Shop: Button vertical padding
	 */
	wp.customize( 'astra-settings[shop-button-v-padding]', function( setting ) {
		setting.bind( function( v_padding ) {

			var dynamicStyle = '';

			dynamicStyle += '.woocommerce.archive ul.products li a.button, .woocommerce > ul.products li a.button, .woocommerce related a.button, .woocommerce .related a.button, .woocommerce .up-sells a.button .woocommerce .cross-sells a.button{';
			dynamicStyle += 'padding-top:' + v_padding + 'px;';
			dynamicStyle += 'padding-bottom:' + v_padding + 'px;';
			dynamicStyle += '}';

			astra_add_dynamic_css( 'shop-button-v-padding', dynamicStyle );
		} );
	} );

	/**
	 * Shop: Button horizontal padding
	 */
	wp.customize( 'astra-settings[shop-button-h-padding]', function( setting ) {
		setting.bind( function( h_padding ) {

			var dynamicStyle = '';

			dynamicStyle += '.woocommerce.archive ul.products li a.button, .woocommerce > ul.products li a.button, .woocommerce related a.button, .woocommerce .related a.button, .woocommerce .up-sells a.button .woocommerce .cross-sells a.button{';
			dynamicStyle += 'padding-left:' + h_padding + 'px;';
			dynamicStyle += 'padding-right:' + h_padding + 'px;';
			dynamicStyle += '}';

			astra_add_dynamic_css( 'shop-button-h-padding', dynamicStyle );
		} );
	} );

	/**
	 * Shop: Sale Bubble Shape
	 */
	wp.customize( 'astra-settings[product-sale-style]', function( setting ) {
		setting.bind( function( bubble_style ) {

			var buttons = $(document).find('.woocommerce-page .products .product .onsale, .woocommerce .products .product .onsale, .woocommerce .product .onsale');
			buttons.removeClass('circle square circle-outline square-outline');
			buttons.addClass( bubble_style );
		} );
	} );

	/**
	 * Shop: Shop Pagination Style
	 */
	wp.customize( 'astra-settings[shop-pagination-style]', function( setting ) {
		setting.bind( function( pagination_style ) {

			var body = $('body.woocommerce, body.woocommerce-page');

			body.removeClass('ast-woocommerce-pagination-default ast-woocommerce-pagination-circle ast-woocommerce-pagination-square');
			body.addClass( 'ast-woocommerce-pagination-' + pagination_style );
		} );
	} );

	/**
	 * Single Product: Gallery Layout
	 */
	wp.customize( 'astra-settings[single-product-gallery-layout]', function( setting ) {
		setting.bind( function( gallery_layout ) {

			var product = $(document).find('.woocommerce-page.single .ast-woocommerce-container .product, .woocommerce.single .ast-woocommerce-container .product');

			product.removeClass('ast-product-gallery-layout-vertical ast-product-gallery-layout-horizontal');
			product.addClass( 'ast-product-gallery-layout-' + gallery_layout );

			$(window).trigger('resize');
			$(window).trigger('resize');
		});
	} );

	/**
	 * Single Product: Image Width
	 */
	wp.customize( 'astra-settings[single-product-image-width]', function( setting ) {
		setting.bind( function( width ) {

			if ( width != '' ) {
				var dynamicStyle = '',
					desc_width = 96 - width;

				dynamicStyle += '@media (min-width: 769px) { ';
				dynamicStyle += '.woocommerce #content .ast-woocommerce-container div.product div.images, .woocommerce .ast-woocommerce-container div.product div.images, .woocommerce-page #content .ast-woocommerce-container div.product div.images, .woocommerce-page .ast-woocommerce-container div.product div.images { width: ' + width + '% }';
				dynamicStyle += '.woocommerce #content .ast-woocommerce-container div.product div.summary, .woocommerce .ast-woocommerce-container div.product div.summary, .woocommerce-page #content .ast-woocommerce-container div.product div.summary, .woocommerce-page .ast-woocommerce-container div.product div.summary { width: ' + desc_width + '% }';
				dynamicStyle += ' }';
				astra_add_dynamic_css( 'woocommerce-single-product-image-width', dynamicStyle );

				$(window).trigger('resize');
			}
			else{
				wp.customize.preview.send( 'refresh' );
			}
		});
	} );

	/**
	 * Single Product: Related & Upsell Product Columns
	 */
	wp.customize( 'astra-settings[single-product-related-upsell-grid]', function( setting ) {
		setting.bind( function( grid ) {

			var body = $('body.woocommerce.single-product, body.woocommerce-page.single-product');

			body.removeClass('rel-up-columns-1 rel-up-columns-2 rel-up-columns-3 rel-up-columns-4 rel-up-columns-5 rel-up-columns-6 tablet-rel-up-columns-1 tablet-rel-up-columns-2 tablet-rel-up-columns-3 tablet-rel-up-columns-4 tablet-rel-up-columns-5 tablet-rel-up-columns-6 mobile-rel-up-columns-1 mobile-rel-up-columns-2 mobile-rel-up-columns-3 mobile-rel-up-columns-4 mobile-rel-up-columns-5 mobile-rel-up-columns-6');
			body.addClass( 'rel-up-columns-' + grid['desktop'] );
			body.addClass( 'tablet-rel-up-columns-' + grid['tablet'] );
			body.addClass( 'mobile-rel-up-columns-' + grid['mobile'] );
		});
	} );

	/*
	 * Checkout Custom Width
	 */
	wp.customize( 'astra-settings[checkout-content-max-width]', function( setting ) {
		setting.bind( function( width ) {

			var dynamicStyle = '@media all and ( min-width: 769px ) {';
				dynamicStyle += '.woocommerce-checkout form.checkout{ max-width: ' + (  parseInt( width ) ) + 'px; margin: 0 auto; } ';
			dynamicStyle += '}';
			astra_add_dynamic_css( 'checkout-content-max-width', dynamicStyle );

		} );
	});

	/**
	 * Cart icon type
	 */
	wp.customize( 'astra-settings[woo-header-cart-icon]', function( setting ) {
		setting.bind( function( icon_type ) {
			$( document.body ).trigger( 'wc_fragment_refresh' );
		} );
	} );

	/**
	 * Cart Count Color.
	 */
	wp.customize( 'astra-settings[woo-header-cart-product-count-color]', function( setting ) {
		setting.bind( function( color ) {
			var dynamicStyle = '.ast-site-header-cart .ast-addon-cart-wrap i.astra-icon:after { color: ' + color + '; } ';
			astra_add_dynamic_css( 'woo-header-cart-product-count-color', dynamicStyle );
		} );
	} );

	/**
	 * Cart total display
	 */
	wp.customize( 'astra-settings[woo-header-cart-total-display]', function( setting ) {
		setting.bind( function( cart_total_display ) {
			$( document.body ).trigger( 'wc_fragment_refresh' );
		} );
	} );

	/**
	 * Cart title display
	 */
	wp.customize( 'astra-settings[woo-header-cart-title-display]', function( setting ) {
		setting.bind( function( cart_title_display ) {
			$( document.body ).trigger( 'wc_fragment_refresh' );
		} );
	} );

	/**
	 * Cart icon style
	 */
	wp.customize( 'astra-settings[woo-header-cart-icon-style]', function( setting ) {
		setting.bind( function( icon_style ) {

			var buttons = $(document).find('.ast-site-header-cart');
			buttons.removeClass('ast-menu-cart-fill ast-menu-cart-outline');
			buttons.addClass( 'ast-menu-cart-' + icon_style );
			var dynamicStyle = '.ast-site-header-cart a, .ast-site-header-cart a *{ transition: all 0s; } ';
			astra_add_dynamic_css( 'woo-header-cart-icon-style', dynamicStyle );
		} );
	} );

	/**
	 * Cart Border Width.
	 */
	astra_css( 'astra-settings[woo-header-cart-border-width]', 'border-width', '.ast-menu-cart-outline .ast-addon-cart-wrap, .ast-theme-transparent-header .ast-menu-cart-outline .ast-addon-cart-wrap', 'px' );

	/**
	 * Button Border Radius
	 */
	wp.customize( 'astra-settings[woo-header-cart-icon-radius]', function( setting ) {
		setting.bind( function( border ) {

			var dynamicStyle = '.ast-site-header-cart.ast-menu-cart-outline .ast-addon-cart-wrap, .ast-site-header-cart.ast-menu-cart-fill .ast-addon-cart-wrap{ border-radius: ' + ( parseInt( border ) ) + 'px } ';
			astra_add_dynamic_css( 'woo-header-cart-icon-radius', dynamicStyle );

		} );
	} );

	/**
	 * Cart icon color
	 */
	wp.customize( 'astra-settings[header-woo-cart-icon-color]', function( setting ) {
		setting.bind( function( color ) {


			var dynamicStyle = '.ast-menu-cart-fill .ast-addon-cart-wrap .count, .ast-menu-cart-fill .ast-addon-cart-wrap { background-color: ' + color + '; } ';
			dynamicStyle += '.ast-site-header-cart .ast-addon-cart-wrap .count, .ast-site-header-cart .ast-addon-cart-wrap .count:after { border-color: ' + color + '; } ';
			astra_add_dynamic_css( 'header-woo-cart-icon-color', dynamicStyle );
			wp.customize.preview.send( 'refresh' );
		} );
	} );

	// Single Product Colors.
	astra_css( 'astra-settings[single-product-title-color]', 'color', '.single-product div.product .entry-title' );
	astra_css( 'astra-settings[single-product-price-color]', 'color', '.single-product div.product p.price, .single-product div.product span.price' );
	astra_css( 'astra-settings[single-product-content-color]', 'color', '.single-product div.product .woocommerce-product-details__short-description, .single-product div.product .product_meta, .single-product div.product .entry-content' );
	astra_css( 'astra-settings[single-product-breadcrumb-color]', 'color', '.single-product div.product .woocommerce-breadcrumb, .single-product div.product .woocommerce-breadcrumb a' );

	// Shop Colors.
	astra_css( 'astra-settings[shop-product-title-color]', 'color', '.woocommerce ul.products li.product .woocommerce-loop-product__title, .woocommerce-page ul.products li.product .woocommerce-loop-product__title' );
	astra_css( 'astra-settings[shop-product-price-color]', 'color', '.woocommerce ul.products li.product .price, .woocommerce-page ul.products li.product .price' );
	astra_css( 'astra-settings[shop-product-content-color]', 'color', '.woocommerce ul.products li.product .ast-woo-product-category, .woocommerce-page ul.products li.product .ast-woo-product-category, .woocommerce ul.products li.product .ast-woo-shop-product-description, .woocommerce-page ul.products li.product .ast-woo-shop-product-description' );

	// General Color.
	astra_css( 'astra-settings[single-product-price-color]', 'color', '.woocommerce ul.products li.product .price, .woocommerce div.product p.price, .woocommerce div.product span.price' );
	astra_css( 'astra-settings[single-product-rating-color]', 'color', '.woocommerce .star-rating, .woocommerce .comment-form-rating .stars a, .woocommerce .star-rating::before' );

	// Shop Product Title Typography
	astra_generate_outside_font_family_css( 'astra-settings[font-family-shop-product-title]', '.woocommerce ul.products li.product .woocommerce-loop-product__title, .woocommerce-page ul.products li.product .woocommerce-loop-product__title' );

	astra_css( 'astra-settings[font-weight-shop-product-title]', 'font-weight', '.woocommerce ul.products li.product .woocommerce-loop-product__title, .woocommerce-page ul.products li.product .woocommerce-loop-product__title' );

	astra_css( 'astra-settings[text-transform-shop-product-title]', 'text-transform', '.woocommerce ul.products li.product .woocommerce-loop-product__title, .woocommerce-page ul.products li.product .woocommerce-loop-product__title' );

	astra_responsive_font_size( 'astra-settings[font-size-shop-product-title]', '.woocommerce ul.products li.product .woocommerce-loop-product__title, .woocommerce-page ul.products li.product .woocommerce-loop-product__title' );

	astra_css( 'astra-settings[line-height-shop-product-title]', 'line-height', '.woocommerce ul.products li.product .woocommerce-loop-product__title, .woocommerce-page ul.products li.product .woocommerce-loop-product__title' );

	// Shop Product Price Typography
	astra_generate_outside_font_family_css( 'astra-settings[font-family-shop-product-price]', '.woocommerce ul.products li.product .price, .woocommerce-page ul.products li.product .price' );

	astra_css( 'astra-settings[font-weight-shop-product-price]', 'font-weight', '.woocommerce ul.products li.product .price, .woocommerce-page ul.products li.product .price' );

	astra_responsive_font_size( 'astra-settings[font-size-shop-product-price]', '.woocommerce ul.products li.product .price, .woocommerce-page ul.products li.product .price' );

	astra_css( 'astra-settings[line-height-shop-product-price]', 'line-height', '.woocommerce ul.products li.product .price, .woocommerce-page ul.products li.product .price' );

	// Shop Product Content Typography
	astra_generate_outside_font_family_css( 'astra-settings[font-family-shop-product-content]', '.woocommerce ul.products li.product .ast-woo-product-category, .woocommerce-page ul.products li.product .ast-woo-product-category, .woocommerce ul.products li.product .ast-woo-shop-product-description, .woocommerce-page ul.products li.product .ast-woo-shop-product-description' );

	astra_css( 'astra-settings[font-weight-shop-product-content]', 'font-weight', '.woocommerce ul.products li.product .ast-woo-product-category, .woocommerce-page ul.products li.product .ast-woo-product-category, .woocommerce ul.products li.product .ast-woo-shop-product-description, .woocommerce-page ul.products li.product .ast-woo-shop-product-description' );

	astra_css( 'astra-settings[text-transform-shop-product-content]', 'text-transform', '.woocommerce ul.products li.product .ast-woo-product-category, .woocommerce-page ul.products li.product .ast-woo-product-category, .woocommerce ul.products li.product .ast-woo-shop-product-description, .woocommerce-page ul.products li.product .ast-woo-shop-product-description' );

	astra_responsive_font_size( 'astra-settings[font-size-shop-product-content]', '.woocommerce ul.products li.product .ast-woo-product-category, .woocommerce-page ul.products li.product .ast-woo-product-category, .woocommerce ul.products li.product .ast-woo-shop-product-description, .woocommerce-page ul.products li.product .ast-woo-shop-product-description' );

	astra_css( 'astra-settings[line-height-shop-product-content]', 'line-height', '.woocommerce ul.products li.product .ast-woo-product-category, .woocommerce-page ul.products li.product .ast-woo-product-category, .woocommerce ul.products li.product .ast-woo-shop-product-description, .woocommerce-page ul.products li.product .ast-woo-shop-product-description' );

	// Single Product Title Typography
	astra_generate_outside_font_family_css( 'astra-settings[font-family-product-title]', '.single-product div.product .entry-title' );

	astra_css( 'astra-settings[font-weight-product-title]', 'font-weight', '.single-product div.product .entry-title' );

	astra_css( 'astra-settings[text-transform-product-title]', 'text-transform', '.single-product div.product .entry-title' );

	astra_responsive_font_size( 'astra-settings[font-size-product-title]', '.single-product div.product .entry-title' );

	astra_css( 'astra-settings[line-height-product-title]', 'line-height', '.single-product div.product .entry-title' );

	// Single Product price Typography
	astra_generate_outside_font_family_css( 'astra-settings[font-family-product-price]', '.single-product div.product p.price, .single-product div.product span.price' );

	astra_css( 'astra-settings[font-weight-product-price]', 'font-weight', '.single-product div.product p.price, .single-product div.product span.price' );

	astra_responsive_font_size( 'astra-settings[font-size-product-price]', '.single-product div.product p.price, .single-product div.product span.price' );

	astra_css( 'astra-settings[line-height-product-price]', 'line-height', '.single-product div.product p.price, .single-product div.product span.price' );

	// Single Product Breadcrumbs Typography
	astra_generate_outside_font_family_css( 'astra-settings[font-family-product-breadcrumb]', '.single-product div.product .woocommerce-breadcrumb' );

	astra_css( 'astra-settings[font-weight-product-breadcrumb]', 'font-weight', '.single-product div.product .woocommerce-breadcrumb' );

	astra_css( 'astra-settings[text-transform-product-breadcrumb]', 'text-transform', '.single-product div.product .woocommerce-breadcrumb' );

	astra_responsive_font_size( 'astra-settings[font-size-product-breadcrumb]', '.single-product div.product .woocommerce-breadcrumb' );

	astra_css( 'astra-settings[line-height-product-breadcrumb]', 'line-height', '.single-product div.product .woocommerce-breadcrumb' );

	// Single Product Content Typography
	astra_generate_outside_font_family_css( 'astra-settings[font-family-product-content]', '.single-product div.product .woocommerce-product-details__short-description, .single-product div.product .product_meta, .single-product div.product .entry-content' );

	astra_css( 'astra-settings[font-weight-product-content]', 'font-weight', '.single-product div.product .woocommerce-product-details__short-description, .single-product div.product .product_meta, .single-product div.product .entry-content' );

	astra_css( 'astra-settings[text-transform-product-content]', 'text-transform', '.single-product div.product .woocommerce-product-details__short-description, .single-product div.product .product_meta, .single-product div.product .entry-content' );

	astra_responsive_font_size( 'astra-settings[font-size-product-content]', '.single-product div.product .woocommerce-product-details__short-description, .single-product div.product .product_meta, .single-product div.product .entry-content' );

	astra_css( 'astra-settings[line-height-product-content]', 'line-height', '.single-product div.product .woocommerce-product-details__short-description, .single-product div.product .product_meta, .single-product div.product .entry-content' );
	//
} )( jQuery );

// Refresh cart icon sessionstorage for woocommerce cart fragments.
function astra_customizer_refresh_fragments() {

	var cart_hash_key = ast_woocommerce.cart_hash_key;
	window.sessionStorage.setItem(cart_hash_key, 'blank');
}

astra_customizer_refresh_fragments();
