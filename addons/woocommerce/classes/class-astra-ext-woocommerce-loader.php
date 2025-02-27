<?php
/**
 * WooCommerce Loader
 *
 * @package Astra Addon
 */

if ( ! class_exists( 'Astra_Ext_Woocommerce_Loader' ) ) {

	/**
	 * Customizer Initialization
	 *
	 * @since 1.0.0
	 */
	// @codingStandardsIgnoreStart
	class Astra_Ext_Woocommerce_Loader {
 // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedClassFound
		// @codingStandardsIgnoreEnd

		/**
		 * Member Variable
		 *
		 * @var instance
		 */
		private static $instance;

		/**
		 * Initiator
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 * Constructor
		 */
		public function __construct() {

			add_filter( 'astra_theme_defaults', array( $this, 'theme_defaults' ) );
			add_action( 'customize_register', array( $this, 'customize_register' ), 2 );
			add_action( 'customize_preview_init', array( $this, 'preview_scripts' ) );

			add_filter( 'astra_woo_shop_hover_style', array( $this, 'woo_shop_hover_style_callback' ) );

			add_filter( 'wc_add_to_cart_message_html', array( $this, 'disable_woo_cart_msg' ), 10, 2 );
		}

		/**
		 * Disable add to cart messages for AJAX request.
		 *
		 * @since 1.1.0
		 * @param  string $message add to cart message.
		 * @param  int    $product_id product ID.
		 * @return string
		 */
		public function disable_woo_cart_msg( $message, $product_id ) {
			$is_ajax_add_to_cart = astra_get_option( 'single-product-add-to-cart-action' );

			if ( wp_doing_ajax() && $is_ajax_add_to_cart && 'default' !== $is_ajax_add_to_cart ) {
				return null;
			}

			return $message;
		}

		/**
		 * Woo Shop hover styles.
		 *
		 * @since 1.1.0
		 * @param  array $styles Hover styles.
		 * @return array
		 */
		public function woo_shop_hover_style_callback( $styles ) {

			$styles['fade']      = __( 'Fade', 'astra-addon' );
			$styles['zoom']      = __( 'Zoom', 'astra-addon' );
			$styles['zoom-fade'] = __( 'Zoom Fade', 'astra-addon' );

			return $styles;
		}

		/**
		 * Set Options Default Values
		 *
		 * @param  array $defaults  Astra options default value array.
		 * @return array
		 */
		public function theme_defaults( $defaults ) {

			$astra_addon_update_modern_shop_defaults = Astra_Ext_WooCommerce::astra_addon_enable_modern_ecommerce_setup();
			$astra_options                           = astra_get_options();

			// Shop page.
			$defaults['shop-page-list-style-alignment'] = array(
				'desktop' => 'center',
				'tablet'  => 'center',
				'mobile'  => 'center',
			);

			$defaults['shop-toolbar-structure']                = array(
				'results',
				'sorting',
			);
			$defaults['shop-toolbar-structure-with-hiddenset'] = array(
				'results'   => true,
				'filters'   => false,
				'sorting'   => true,
				'easy_view' => false,
			);

			$defaults['easy-list-grids'] = array(
				'desktop' => 2,
				'tablet'  => 1,
				'mobile'  => 1,
			);

			$defaults['easy-list-content-alignment']          = array(
				'desktop' => 'center',
				'tablet'  => 'center',
				'mobile'  => 'center',
			);
			$defaults['easy-list-content-enable-description'] = true;
			$defaults['product-sale-percent-value']           = '-[value]%';
			$defaults['product-sale-style']                   = 'circle';
			$defaults['product-sale-notification']            = 'default';
			$defaults['cart-steps-checkout']                  = false;
			$defaults['cart-multistep-steps-numbers']         = false;
			$defaults['cart-multistep-checkout-size']         = 'default';
			$defaults['cart-multistep-checkout-font-case']    = 'normal';
			$defaults['woo-input-style-type']                 = $astra_addon_update_modern_shop_defaults ? 'modern' : 'default';
			$defaults['woo-enable-sale-border-radius']        = false;
			$defaults['woo-sale-border-radius']               = '';

			$defaults['shop-page-title-display']     = true;
			$defaults['shop-breadcrumb-display']     = true;
			$defaults['shop-filter-list-to-buttons'] = true;
			$defaults['shop-active-filters-display'] = true;
			$defaults['shop-reveal-effect']          = false;

			// Off Canvas.
			$defaults['shop-off-canvas-trigger-type']       = 'link';
			$defaults['shop-filter-trigger-link']           = __( 'Filter', 'astra-addon' );
			$defaults['shop-filter-trigger-custom-class']   = '';
			$defaults['shop-filter-position']               = 'shop-filter-flyout';
			$defaults['shop-filter-collapsable-columns']    = array(
				'desktop' => 4,
				'tablet'  => 2,
				'mobile'  => 1,
			);
			$defaults['shop-filter-max-height']             = false;
			$defaults['shop-filter-scrollbar-max-height']   = 130;
			$defaults['shop-active-filters-sticky-sidebar'] = false;

			$defaults['shop-title-disable']       = false;
			$defaults['shop-price-disable']       = false;
			$defaults['shop-rating-disable']      = false;
			$defaults['shop-cart-button-disable'] = false;
			$defaults['shop-description-disable'] = true;
			$defaults['shop-category-disable']    = true;

			$defaults['shop-quick-view-enable']     = 'disabled';
			$defaults['shop-quick-view-stick-cart'] = false;

			$defaults['shop-product-shadow']           = 0;
			$defaults['shop-item-box-shadow-control']  = array(
				'x'      => '0',
				'y'      => '0',
				'blur'   => '0',
				'spread' => '0',
			);
			$defaults['shop-item-box-shadow-color']    = 'rgba(0,0,0,.1)';
			$defaults['shop-item-box-shadow-position'] = 'outline';

			$defaults['shop-item-hover-box-shadow-control']  = array(
				'x'      => '0',
				'y'      => '0',
				'blur'   => '0',
				'spread' => '0',
			);
			$defaults['shop-item-hover-box-shadow-color']    = 'rgba(0,0,0,.1)';
			$defaults['shop-item-hover-box-shadow-position'] = 'outline';

			$defaults['shop-button-padding'] = array(
				'desktop'      => array(
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
				),
				'tablet'       => array(
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
				),
				'mobile'       => array(
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
				),
				'desktop-unit' => 'px',
				'tablet-unit'  => 'px',
				'mobile-unit'  => 'px',
			);

			$defaults['shop-product-content-padding'] = array(
				'desktop'      => array(
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
				),
				'tablet'       => array(
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
				),
				'mobile'       => array(
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
				),
				'desktop-unit' => 'px',
				'tablet-unit'  => 'px',
				'mobile-unit'  => 'px',
			);

			$defaults['shop-pagination']            = 'number';
			$defaults['shop-pagination-style']      = 'square';
			$defaults['shop-infinite-scroll-event'] = 'scroll';
			$defaults['shop-load-more-text']        = __( 'Load More', 'astra-addon' );

			// Single product page.
			$defaults['single-product-related-display']                 = true;
			$defaults['single-product-recently-viewed-display']         = false;
			$defaults['single-product-recently-viewed-text']            = __( 'Recently Viewed Products', 'astra-addon' );
			$defaults['single-product-image-zoom-effect']               = true;
			$defaults['single-product-sticky-product-image']            = false;
			$defaults['single-product-sticky-product-image-top-offset'] = 0;
			$defaults['single-product-add-to-cart-action']              = 'default';
			$defaults['single-product-related-upsell-grid']             = array(
				'desktop' => 4,
				'tablet'  => 3,
				'mobile'  => 2,
			);
			$defaults['single-product-select-variations']               = false;
			$defaults['single-product-related-upsell-per-page']         = 4;
			$defaults['single-product-image-width']                     = 50;
			$defaults['single-product-gallery-layout']                  = 'horizontal-slider';
			$defaults['product-gallery-thumbnail-columns']              = 2;
			$defaults['astra-product-gallery-layout-flag']              = true;
			$defaults['single-product-sticky-summary']                  = false;
			$defaults['single-product-extras-text']                     = __( 'Free shipping on orders over $50!', 'astra-addon' );
			$defaults['single-product-extras-list']                     = array(
				'items' => array(
					array(
						'id'      => 'item-1',
						'enabled' => true,
						'source'  => 'icon',
						'icon'    => 'check-circle',
						'label'   => __( 'No-Risk Money Back Guarantee!', 'astra-addon' ),
						'image'   => '',
					),
					array(
						'id'      => 'item-2',
						'enabled' => true,
						'source'  => 'icon',
						'icon'    => 'check-circle',
						'label'   => __( 'No Hassle Refunds', 'astra-addon' ),
						'image'   => '',
					),
					array(
						'id'      => 'item-3',
						'enabled' => true,
						'source'  => 'icon',
						'icon'    => 'check-circle',
						'label'   => __( 'Secure Payments', 'astra-addon' ),
						'image'   => '',
					),
				),
			);

			$defaults['single-product-tabs-display']             = true;
			$defaults['single-product-heading-tab-normal-color'] = '';
			$defaults['single-product-heading-tab-hover-color']  = '';
			$defaults['single-product-heading-tab-active-color'] = '';
			$defaults['single-product-tabs-layout']              = 'horizontal';
			$defaults['single-product-up-sells-display']         = true;
			$defaults['single-product-nav-style']                = 'disable';
			$defaults['single-product-navigation-preview']       = false;

			// Checkout.
			$defaults['two-step-checkout']                        = false;
			$defaults['checkout-labels-as-placeholders']          = false;
			$defaults['checkout-back-to-cart-button']             = false;
			$defaults['checkout-back-to-cart-button-text']        = __( '« Back to Cart', 'astra-addon' );
			$defaults['checkout-order-notes-display']             = true;
			$defaults['checkout-coupon-display']                  = true;
			$defaults['checkout-persistence-form-data']           = false;
			$defaults['checkout-content-width']                   = 'default';
			$defaults['checkout-layout-type']                     = $astra_addon_update_modern_shop_defaults ? 'modern' : 'default';
			$defaults['checkout-modern-layout-type']              = 'two-column-checkout';
			$defaults['checkout-place-order-text']                = __( 'Place Order', 'astra-addon' );
			$defaults['checkout-order-review-product-images']     = $astra_addon_update_modern_shop_defaults ? true : false;
			$defaults['checkout-order-review-sticky']             = $astra_addon_update_modern_shop_defaults ? true : false;
			$defaults['checkout-modern-order-received']           = $astra_addon_update_modern_shop_defaults ? true : false;
			$defaults['checkout-modern-checkout-button-padlock']  = $astra_addon_update_modern_shop_defaults ? true : false;
			$defaults['checkout-modern-checkout-button-price']    = $astra_addon_update_modern_shop_defaults ? true : false;
			$defaults['two-step-checkout-modern-note']            = false;
			$defaults['two-step-checkout-modern-note-text']       = __( 'Checkout Notes', 'astra-addon' );
			$defaults['two-step-checkout-modern-button-text']     = __( 'For Special Offer Click Here', 'astra-addon' );
			$defaults['two-step-checkout-modern-button-sub-text'] = __( 'Yes! I want this offer!', 'astra-addon' );
			$defaults['two-step-checkout-modern-step-1-text']     = __( 'Shipping', 'astra-addon' );
			$defaults['two-step-checkout-modern-step-1-sub-text'] = __( 'Where to ship it?', 'astra-addon' );
			$defaults['two-step-checkout-modern-step-2-text']     = __( 'Payment', 'astra-addon' );
			$defaults['two-step-checkout-modern-step-2-sub-text'] = __( 'Of your order', 'astra-addon' );

			$defaults['checkout-payment-text']              = __( 'Payment', 'astra-addon' );
			$defaults['woo-coupon-text']                    = __( 'Have a coupon?', 'astra-addon' );
			$defaults['woo-coupon-input-text']              = __( 'Coupon code', 'astra-addon' );
			$defaults['woo-coupon-apply-text']              = __( 'Apply', 'astra-addon' );
			$defaults['checkout-customer-information-text'] = __( 'Customer information', 'astra-addon' );
			$defaults['checkout-show-summary-text']         = __( 'Show Order Summary', 'astra-addon' );
			$defaults['checkout-hide-summary-text']         = __( 'Hide Order Summary', 'astra-addon' );

			// General.
			$defaults['astra-woocommerce-cart-icons-flag'] = true;
			if ( false === astra_addon_builder_helper()->is_header_footer_builder_active ) {
				$defaults['woo-header-cart-icon-style'] = 'none';
			}
			$defaults['woo-header-cart-icon-color']    = '';
			$defaults['woo-header-cart-icon-radius']   = 3;
			$defaults['woo-header-cart-total-display'] = true;
			$defaults['woo-header-cart-title-display'] = true;

			// Single Product Title Typo.
			$defaults['font-family-product-title'] = 'inherit';
			$defaults['font-weight-product-title'] = 'inherit';
			$defaults['font-extras-product-title'] = array(
				'line-height'         => ! isset( $astra_options['font-extras-product-title'] ) && isset( $astra_options['line-height-product-title'] ) ? $astra_options['line-height-product-title'] : '',
				'line-height-unit'    => 'em',
				'letter-spacing'      => '',
				'letter-spacing-unit' => 'px',
				'text-transform'      => ! isset( $astra_options['font-extras-product-title'] ) && isset( $astra_options['text-transform-product-title'] ) ? $astra_options['text-transform-product-title'] : '',
				'text-decoration'     => '',
			);
			$defaults['font-size-product-title']   = array(
				'desktop'      => '',
				'tablet'       => '',
				'mobile'       => '',
				'desktop-unit' => 'px',
				'tablet-unit'  => 'px',
				'mobile-unit'  => 'px',
			);

			$defaults['font-family-product-content'] = 'inherit';
			$defaults['font-weight-product-content'] = 'inherit';
			$defaults['font-extras-product-content'] = array(
				'line-height'         => ! isset( $astra_options['font-extras-product-content'] ) && isset( $astra_options['line-height-product-content'] ) ? $astra_options['line-height-product-content'] : '',
				'line-height-unit'    => 'em',
				'letter-spacing'      => '',
				'letter-spacing-unit' => 'px',
				'text-transform'      => ! isset( $astra_options['font-extras-product-content'] ) && isset( $astra_options['text-transform-product-content'] ) ? $astra_options['text-transform-product-content'] : '',
				'text-decoration'     => '',
			);
			$defaults['font-size-product-content']   = array(
				'desktop'      => '',
				'tablet'       => '',
				'mobile'       => '',
				'desktop-unit' => 'px',
				'tablet-unit'  => 'px',
				'mobile-unit'  => 'px',
			);

			// Single Product Category Typo.
			$defaults['font-family-product-category'] = 'inherit';
			$defaults['font-weight-product-category'] = 'inherit';
			$defaults['font-extras-product-category'] = array(
				'line-height'         => ! isset( $astra_options['font-extras-product-category'] ) && isset( $astra_options['line-height-product-category'] ) ? $astra_options['line-height-product-category'] : '',
				'line-height-unit'    => 'em',
				'letter-spacing'      => '',
				'letter-spacing-unit' => 'px',
				'text-transform'      => ! isset( $astra_options['font-extras-product-category'] ) && isset( $astra_options['text-transform-product-category'] ) ? $astra_options['text-transform-product-category'] : '',
				'text-decoration'     => '',
			);
			$defaults['font-size-product-category']   = array(
				'desktop'      => '',
				'tablet'       => '',
				'mobile'       => '',
				'desktop-unit' => 'px',
				'tablet-unit'  => 'px',
				'mobile-unit'  => 'px',
			);

			// Single Product Price Typo.
			$defaults['font-family-product-price'] = 'inherit';
			$defaults['font-weight-product-price'] = 'inherit';
			$defaults['font-extras-product-price'] = array(
				'line-height'         => ! isset( $astra_options['font-extras-product-price'] ) && isset( $astra_options['line-height-product-price'] ) ? $astra_options['line-height-product-price'] : '',
				'line-height-unit'    => 'em',
				'letter-spacing'      => '',
				'letter-spacing-unit' => 'px',
				'text-transform'      => '',
				'text-decoration'     => '',
			);
			$defaults['font-size-product-price']   = array(
				'desktop'      => '',
				'tablet'       => '',
				'mobile'       => '',
				'desktop-unit' => 'px',
				'tablet-unit'  => 'px',
				'mobile-unit'  => 'px',
			);

			// Single Product Breadcrumb Typo.
			$defaults['font-family-product-breadcrumb'] = 'inherit';
			$defaults['font-weight-product-breadcrumb'] = 'inherit';
			$defaults['font-extras-product-breadcrumb'] = array(
				'line-height'         => ! isset( $astra_options['font-extras-product-breadcrumb'] ) && isset( $astra_options['line-height-product-breadcrumb'] ) ? $astra_options['line-height-product-breadcrumb'] : '',
				'line-height-unit'    => 'em',
				'letter-spacing'      => '',
				'letter-spacing-unit' => 'px',
				'text-transform'      => ! isset( $astra_options['font-extras-product-breadcrumb'] ) && isset( $astra_options['text-transform-product-breadcrumb'] ) ? $astra_options['text-transform-product-breadcrumb'] : '',
				'text-decoration'     => '',
			);
			$defaults['font-size-product-breadcrumb']   = array(
				'desktop'      => '',
				'tablet'       => '',
				'mobile'       => '',
				'desktop-unit' => 'px',
				'tablet-unit'  => 'px',
				'mobile-unit'  => 'px',
			);

			// Shop Product Title Typo.
			$defaults['font-family-shop-product-title'] = 'inherit';
			$defaults['font-weight-shop-product-title'] = 'inherit';
			$defaults['font-extras-shop-product-title'] = array(
				'line-height'         => ! isset( $astra_options['font-extras-shop-product-title'] ) && isset( $astra_options['line-height-shop-product-title'] ) ? $astra_options['line-height-shop-product-title'] : '',
				'line-height-unit'    => 'em',
				'letter-spacing'      => '',
				'letter-spacing-unit' => 'px',
				'text-transform'      => ! isset( $astra_options['font-extras-shop-product-title'] ) && isset( $astra_options['text-transform-shop-product-title'] ) ? $astra_options['text-transform-shop-product-title'] : '',
				'text-decoration'     => '',
			);
			$defaults['font-size-shop-product-title']   = array(
				'desktop'      => '',
				'tablet'       => '',
				'mobile'       => '',
				'desktop-unit' => 'px',
				'tablet-unit'  => 'px',
				'mobile-unit'  => 'px',
			);

			// Shop Product Price Typo.
			$defaults['font-family-shop-product-price'] = 'inherit';
			$defaults['font-weight-shop-product-price'] = 'inherit';
			$defaults['font-extras-shop-product-price'] = array(
				'line-height'         => ! isset( $astra_options['font-extras-shop-product-price'] ) && isset( $astra_options['line-height-shop-product-price'] ) ? $astra_options['line-height-shop-product-price'] : '',
				'line-height-unit'    => 'em',
				'letter-spacing'      => '',
				'letter-spacing-unit' => 'px',
				'text-transform'      => '',
				'text-decoration'     => '',
			);
			$defaults['font-size-shop-product-price']   = array(
				'desktop'      => '',
				'tablet'       => '',
				'mobile'       => '',
				'desktop-unit' => 'px',
				'tablet-unit'  => 'px',
				'mobile-unit'  => 'px',
			);

			// Shop Product Category Typo.
			$defaults['font-family-shop-product-content'] = 'inherit';
			$defaults['font-weight-shop-product-content'] = 'inherit';
			$defaults['font-extras-shop-product-content'] = array(
				'line-height'         => ! isset( $astra_options['font-extras-shop-product-content'] ) && isset( $astra_options['line-height-shop-product-content'] ) ? $astra_options['line-height-shop-product-content'] : '',
				'line-height-unit'    => 'em',
				'letter-spacing'      => '',
				'letter-spacing-unit' => 'px',
				'text-transform'      => ! isset( $astra_options['font-extras-shop-product-content'] ) && isset( $astra_options['text-transform-shop-product-content'] ) ? $astra_options['text-transform-shop-product-content'] : '',
				'text-decoration'     => '',
			);
			$defaults['font-size-shop-product-content']   = array(
				'desktop'      => '',
				'tablet'       => '',
				'mobile'       => '',
				'desktop-unit' => 'px',
				'tablet-unit'  => 'px',
				'mobile-unit'  => 'px',
			);

			// Single Product Colors.
			$defaults['single-product-title-color']      = '';
			$defaults['single-product-title-category']   = '';
			$defaults['single-product-price-color']      = '';
			$defaults['single-product-content-color']    = '';
			$defaults['single-product-breadcrumb-color'] = '';

			// Shop Product Colors.
			$defaults['shop-product-title-color']   = '';
			$defaults['shop-product-price-color']   = '';
			$defaults['shop-product-content-color'] = '';

			// General Colors.
			$defaults['single-product-rating-color'] = '';
			$defaults['product-sale-color']          = '';
			$defaults['product-sale-bg-color']       = '';

			// Cart.
			$defaults['cart-modern-layout']      = $astra_addon_update_modern_shop_defaults && ! defined( 'ELEMENTOR_PRO_VERSION' ) ? true : false;
			$defaults['cart-ajax-cart-quantity'] = $astra_addon_update_modern_shop_defaults ? true : false;
			$defaults['cart-sticky-cart-totals'] = $astra_addon_update_modern_shop_defaults ? true : false;

			// MyAccount page options.
			$defaults['modern-woo-account-view']  = $astra_addon_update_modern_shop_defaults ? true : false;
			$defaults['my-account-user-gravatar'] = $astra_addon_update_modern_shop_defaults ? true : false;
			$defaults['show-woo-grid-orders']     = $astra_addon_update_modern_shop_defaults ? true : false;

			$defaults['my-account-download-text']            = __( 'Downloads', 'astra-addon' );
			$defaults['my-account-download-remaining-text']  = __( 'Downloads Remaining:', 'astra-addon' );
			$defaults['my-account-download-expire-text']     = __( 'Expires:', 'astra-addon' );
			$defaults['my-account-download-expire-alt-text'] = __( 'Never', 'astra-addon' );

			$defaults['my-account-register-description-text'] = __( 'Not a member?', 'astra-addon' );
			$defaults['my-account-register-text']             = __( 'Register', 'astra-addon' );

			$defaults['my-account-login-description-text'] = __( 'Already a member?', 'astra-addon' );
			$defaults['my-account-login-text']             = __( 'Login', 'astra-addon' );

			return $defaults;
		}

		/**
		 * Add postMessage support for site title and description for the Theme Customizer.
		 *
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 */
		public function customize_register( $wp_customize ) {

			/**
			 * Register Partials
			 */
			require_once ASTRA_ADDON_EXT_WOOCOMMERCE_DIR . 'classes/class-astra-customizer-ext-woocommerce-partials.php';

			/**
			 * Register Sections & Panels
			 */
			require_once ASTRA_ADDON_EXT_WOOCOMMERCE_DIR . 'classes/class-astra-woocommerce-panels-and-sections.php';

			/**
			 * Sections
			 */
			require_once ASTRA_ADDON_EXT_WOOCOMMERCE_DIR . 'classes/sections/class-astra-woocommerce-general-configs.php';
			require_once ASTRA_ADDON_EXT_WOOCOMMERCE_DIR . 'classes/sections/class-astra-woocommerce-shop-configs.php';
			require_once ASTRA_ADDON_EXT_WOOCOMMERCE_DIR . 'classes/sections/class-astra-woocommerce-shop-cart-configs.php';
			require_once ASTRA_ADDON_EXT_WOOCOMMERCE_DIR . 'classes/sections/class-astra-woocommerce-shop-single-configs.php';
			require_once ASTRA_ADDON_EXT_WOOCOMMERCE_DIR . 'classes/sections/class-astra-woocommerce-checkout-configs.php';
			require_once ASTRA_ADDON_EXT_WOOCOMMERCE_DIR . 'classes/sections/class-astra-woocommerce-general-colors-configs.php';
			require_once ASTRA_ADDON_EXT_WOOCOMMERCE_DIR . 'classes/sections/class-astra-woocommerce-shop-single-typo-configs.php';
			require_once ASTRA_ADDON_EXT_WOOCOMMERCE_DIR . 'classes/sections/class-astra-woocommerce-shop-single-colors-configs.php';

			require_once ASTRA_ADDON_EXT_WOOCOMMERCE_DIR . 'classes/sections/class-astra-addon-woocommerce-my-account-configs.php';

			require_once ASTRA_ADDON_EXT_WOOCOMMERCE_DIR . 'classes/sections/class-astra-woocommerce-shop-typo-configs.php';
			require_once ASTRA_ADDON_EXT_WOOCOMMERCE_DIR . 'classes/sections/class-astra-woocommerce-shop-colors-configs.php';
		}

		/**
		 * Customizer Controls
		 *
		 * @see 'astra-customizer-preview-js' panel in parent theme
		 */
		public function preview_scripts() {

			if ( SCRIPT_DEBUG ) {
				$js_path = 'assets/js/unminified/customizer-preview.js';
			} else {
				$js_path = 'assets/js/minified/customizer-preview.min.js';
			}

			wp_register_script( 'ast-woocommerce-customizer-preview', ASTRA_ADDON_EXT_WOOCOMMERCE_URI . $js_path, array( 'customize-preview', 'astra-customizer-preview-js' ), ASTRA_EXT_VER, true );

			$localize_array = array(
				'cart_hash_key' => WC()->ajax_url() . '-wc_cart_hash',
			);

			wp_localize_script( 'ast-woocommerce-customizer-preview', 'ast_woocommerce', $localize_array );

			wp_enqueue_script( 'ast-woocommerce-customizer-preview' );
		}
	}
}

/**
 * Kicking this off by calling 'get_instance()' method
 */
Astra_Ext_Woocommerce_Loader::get_instance();
