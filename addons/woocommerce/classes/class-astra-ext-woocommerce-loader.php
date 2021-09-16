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
	class Astra_Ext_Woocommerce_Loader {

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
			$is_ajax_add_to_cart = astra_get_option( 'single-product-ajax-add-to-cart' );

			if ( wp_doing_ajax() && '1' == $is_ajax_add_to_cart ) {
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

			// Shop page.
			$defaults['shop-style']         = 'shop-page-grid-style';
			$defaults['shop-product-align'] = 'align-left';

			$defaults['product-sale-percent-value'] = '-[value]%';
			$defaults['product-sale-style']         = 'circle';
			$defaults['product-sale-notification']  = 'default';

			$defaults['shop-page-title-display']     = true;
			$defaults['shop-breadcrumb-display']     = true;
			$defaults['shop-toolbar-display']        = true;
			$defaults['shop-active-filters-display'] = true;

			// Off Canvas.
			$defaults['shop-off-canvas-trigger-type']     = 'disable';
			$defaults['shop-filter-trigger-link']         = __( 'Filter', 'astra-addon' );
			$defaults['shop-filter-trigger-custom-class'] = '';

			$defaults['shop-title-disable']       = false;
			$defaults['shop-price-disable']       = false;
			$defaults['shop-rating-disable']      = false;
			$defaults['shop-cart-button-disable'] = false;
			$defaults['shop-description-disable'] = true;
			$defaults['shop-category-disable']    = true;

			$defaults['shop-quick-view-enable']     = 'disabled';
			$defaults['shop-quick-view-stick-cart'] = false;

			$defaults['shop-product-shadow']       = 0;
			$defaults['shop-product-shadow-hover'] = 0;

			$defaults['shop-button-v-padding']      = '';
			$defaults['shop-button-h-padding']      = '';
			$defaults['shop-pagination']            = 'number';
			$defaults['shop-pagination-style']      = 'square';
			$defaults['shop-infinite-scroll-event'] = 'scroll';
			$defaults['shop-load-more-text']        = __( 'Load More', 'astra-addon' );

			// Single product page.
			$defaults['single-product-related-display']         = true;
			$defaults['single-product-image-zoom-effect']       = true;
			$defaults['single-product-ajax-add-to-cart']        = false;
			$defaults['single-product-related-upsell-grid']     = array(
				'desktop' => 4,
				'tablet'  => 3,
				'mobile'  => 2,
			);
			$defaults['single-product-related-upsell-per-page'] = 4;
			$defaults['single-product-image-width']             = 50;
			$defaults['single-product-gallery-layout']          = 'horizontal';

			$defaults['single-product-structure'] = array(
				'title',
				'ratings',
				'price',
				'short_desc',
				'add_cart',
				'meta',
			);

			$defaults['single-product-tabs-display']     = true;
			$defaults['single-product-tabs-layout']      = 'horizontal';
			$defaults['single-product-up-sells-display'] = true;
			$defaults['single-product-nav-style']        = 'disable';

			// Checkout.
			$defaults['two-step-checkout']               = false;
			$defaults['checkout-labels-as-placeholders'] = false;
			$defaults['checkout-order-notes-display']    = true;
			$defaults['checkout-coupon-display']         = true;
			$defaults['checkout-persistence-form-data']  = false;
			$defaults['checkout-content-width']          = 'default';
			$defaults['checkout-content-max-width']      = 1200;

			// General.
			$defaults['woo-header-cart-icon']                = 'default';
			$defaults['woo-header-cart-icon-style']          = 'none';
			$defaults['woo-header-cart-icon-color']          = '';
			$defaults['woo-header-cart-border-width']        = 2;
			$defaults['woo-header-cart-icon-radius']         = 3;
			$defaults['woo-header-cart-total-display']       = true;
			$defaults['woo-header-cart-title-display']       = true;
			$defaults['woo-header-cart-product-count-color'] = '';

			// General Product Price Typo.
			$defaults['font-family-product-price'] = 'inherit';
			$defaults['font-weight-product-price'] = 'inherit';

			// Single Product Title Typo.
			$defaults['font-family-product-title']    = 'inherit';
			$defaults['font-weight-product-title']    = 'inherit';
			$defaults['text-transform-product-title'] = '';
			$defaults['line-height-product-title']    = '';
			$defaults['font-size-product-title']      = array(
				'desktop'      => '',
				'tablet'       => '',
				'mobile'       => '',
				'desktop-unit' => 'px',
				'tablet-unit'  => 'px',
				'mobile-unit'  => 'px',
			);

			$defaults['font-family-product-content']    = 'inherit';
			$defaults['font-weight-product-content']    = 'inherit';
			$defaults['text-transform-product-content'] = '';
			$defaults['line-height-product-content']    = '';
			$defaults['font-size-product-content']      = array(
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
			$defaults['line-height-product-price'] = '';
			$defaults['font-size-product-price']   = array(
				'desktop'      => '',
				'tablet'       => '',
				'mobile'       => '',
				'desktop-unit' => 'px',
				'tablet-unit'  => 'px',
				'mobile-unit'  => 'px',
			);

			// Single Product Breadcrumb Typo.
			$defaults['font-family-product-breadcrumb']    = 'inherit';
			$defaults['font-weight-product-breadcrumb']    = 'inherit';
			$defaults['text-transform-product-breadcrumb'] = '';
			$defaults['line-height-product-breadcrumb']    = '';
			$defaults['font-size-product-breadcrumb']      = array(
				'desktop'      => '',
				'tablet'       => '',
				'mobile'       => '',
				'desktop-unit' => 'px',
				'tablet-unit'  => 'px',
				'mobile-unit'  => 'px',
			);

			// Shop Product Title Typo.
			$defaults['font-family-shop-product-title']    = 'inherit';
			$defaults['font-weight-shop-product-title']    = 'inherit';
			$defaults['text-transform-shop-product-title'] = '';
			$defaults['line-height-shop-product-title']    = '';
			$defaults['font-size-shop-product-title']      = array(
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
			$defaults['line-height-shop-product-price'] = '';
			$defaults['font-size-shop-product-price']   = array(
				'desktop'      => '',
				'tablet'       => '',
				'mobile'       => '',
				'desktop-unit' => 'px',
				'tablet-unit'  => 'px',
				'mobile-unit'  => 'px',
			);

			// Shop Product Category Typo.
			$defaults['font-family-shop-product-content']    = 'inherit';
			$defaults['font-weight-shop-product-content']    = 'inherit';
			$defaults['text-transform-shop-product-content'] = '';
			$defaults['line-height-shop-product-content']    = '';
			$defaults['font-size-shop-product-content']      = array(
				'desktop'      => '',
				'tablet'       => '',
				'mobile'       => '',
				'desktop-unit' => 'px',
				'tablet-unit'  => 'px',
				'mobile-unit'  => 'px',
			);

			// Single Product Colors.
			$defaults['single-product-title-color']      = '';
			$defaults['single-product-price-color']      = '';
			$defaults['single-product-content-color']    = '';
			$defaults['single-product-breadcrumb-color'] = '';

			// Shop Product Colors.
			$defaults['shop-product-title-color']   = '';
			$defaults['shop-product-price-color']   = '';
			$defaults['shop-product-content-color'] = '';

			// General Colors.
			$defaults['single-product-rating-color'] = '';

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
			require_once ASTRA_EXT_WOOCOMMERCE_DIR . 'classes/class-astra-customizer-ext-woocommerce-partials.php';

			/**
			 * Register Sections & Panels
			 */
			require_once ASTRA_EXT_WOOCOMMERCE_DIR . 'classes/class-astra-woocommerce-panels-and-sections.php';

			/**
			 * Sections
			 */
			require_once ASTRA_EXT_WOOCOMMERCE_DIR . 'classes/sections/class-astra-woocommerce-general-configs.php';
			require_once ASTRA_EXT_WOOCOMMERCE_DIR . 'classes/sections/class-astra-woocommerce-shop-configs.php';
			require_once ASTRA_EXT_WOOCOMMERCE_DIR . 'classes/sections/class-astra-woocommerce-shop-single-configs.php';
			require_once ASTRA_EXT_WOOCOMMERCE_DIR . 'classes/sections/class-astra-woocommerce-checkout-configs.php';
			require_once ASTRA_EXT_WOOCOMMERCE_DIR . 'classes/sections/class-astra-woocommerce-general-colors-configs.php';
			require_once ASTRA_EXT_WOOCOMMERCE_DIR . 'classes/sections/class-astra-woocommerce-shop-single-typo-configs.php';
			require_once ASTRA_EXT_WOOCOMMERCE_DIR . 'classes/sections/class-astra-woocommerce-shop-single-colors-configs.php';

			require_once ASTRA_EXT_WOOCOMMERCE_DIR . 'classes/sections/class-astra-woocommerce-shop-typo-configs.php';
			require_once ASTRA_EXT_WOOCOMMERCE_DIR . 'classes/sections/class-astra-woocommerce-shop-colors-configs.php';
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

			wp_register_script( 'ast-woocommerce-customizer-preview', ASTRA_EXT_WOOCOMMERCE_URI . $js_path, array( 'customize-preview', 'astra-customizer-preview-js' ), ASTRA_EXT_VER, true );

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
