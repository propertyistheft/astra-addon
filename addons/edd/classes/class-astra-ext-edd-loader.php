<?php
/**
 * WooCommerce Loader
 *
 * @package Astra Addon
 */

if ( ! class_exists( 'Astra_Ext_Edd_Loader' ) ) {

	/**
	 * Customizer Initialization
	 *
	 * @since 1.6.10
	 */
	// @codingStandardsIgnoreStart
	class Astra_Ext_Edd_Loader {
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

		}


		/**
		 * Set Options Default Values
		 *
		 * @param  array $defaults  Astra options default value array.
		 * @return array
		 */
		public function theme_defaults( $defaults ) {

			// Shop page.
			$defaults['edd-archive-style']         = 'edd-archive-page-grid-style';
			$defaults['edd-archive-product-align'] = 'align-center';

			$defaults['edd-archive-page-title-display'] = true;

			$defaults['edd-archive-product-shadow']       = 0;
			$defaults['edd-archive-product-shadow-hover'] = 0;

			$defaults['edd-archive-button-v-padding'] = '';
			$defaults['edd-archive-button-h-padding'] = '';

			// Checkout.
			$defaults['two-step-checkout']              = false;
			$defaults['edd-checkout-coupon-display']    = true;
			$defaults['edd-checkout-content-width']     = 'default';
			$defaults['edd-checkout-content-max-width'] = 1200;

			// General.
			$defaults['edd-header-cart-icon']                = 'default';
			$defaults['edd-header-cart-icon-style']          = 'none';
			$defaults['edd-header-cart-icon-color']          = '';
			$defaults['edd-header-cart-border-width']        = 1;
			$defaults['edd-header-cart-icon-radius']         = 3;
			$defaults['edd-header-cart-total-display']       = true;
			$defaults['edd-header-cart-title-display']       = true;
			$defaults['edd-header-cart-product-count-color'] = '';

			// General Product Price Typo.
			$defaults['font-family-product-price'] = 'inherit';
			$defaults['font-weight-product-price'] = 'inherit';

			// Single Product.
			$defaults['disable-edd-single-product-add-to-cart'] = false;

			// Single Product Title Typo.
			$defaults['font-family-edd-product-title'] = 'inherit';
			$defaults['font-weight-edd-product-title'] = 'inherit';
			$defaults['font-extras-edd-product-title'] = array(
				'line-height'         => ! isset( $astra_options['font-extras-edd-product-title'] ) && isset( $astra_options['line-height-edd-product-title'] ) ? $astra_options['line-height-edd-product-title'] : '',
				'line-height-unit'    => 'em',
				'letter-spacing'      => '',
				'letter-spacing-unit' => 'px',
				'text-transform'      => ! isset( $astra_options['font-extras-edd-product-title'] ) && isset( $astra_options['text-transform-edd-product-title'] ) ? $astra_options['text-transform-edd-product-title'] : '',
				'text-decoration'     => '',
			);
			$defaults['font-size-edd-product-title']   = array(
				'desktop'      => '',
				'tablet'       => '',
				'mobile'       => '',
				'desktop-unit' => 'px',
				'tablet-unit'  => 'px',
				'mobile-unit'  => 'px',
			);

			$defaults['font-family-edd-product-content'] = 'inherit';
			$defaults['font-weight-edd-product-content'] = 'inherit';
			$defaults['font-extras-edd-product-content'] = array(
				'line-height'         => ! isset( $astra_options['font-extras-edd-product-content'] ) && isset( $astra_options['line-height-edd-product-content'] ) ? $astra_options['line-height-edd-product-content'] : '',
				'line-height-unit'    => 'em',
				'letter-spacing'      => '',
				'letter-spacing-unit' => 'px',
				'text-transform'      => ! isset( $astra_options['font-extras-edd-product-content'] ) && isset( $astra_options['text-transform-edd-product-content'] ) ? $astra_options['text-transform-edd-product-content'] : '',
				'text-decoration'     => '',
			);
			$defaults['font-size-edd-product-content']   = array(
				'desktop'      => '',
				'tablet'       => '',
				'mobile'       => '',
				'desktop-unit' => 'px',
				'tablet-unit'  => 'px',
				'mobile-unit'  => 'px',
			);

			// Shop Product Title Typo.
			$defaults['font-family-edd-archive-product-title'] = 'inherit';
			$defaults['font-weight-edd-archive-product-title'] = 'inherit';
			$defaults['font-extras-edd-archive-product-title'] = array(
				'line-height'         => ! isset( $astra_options['font-extras-edd-archive-product-title'] ) && isset( $astra_options['line-height-edd-archive-product-title'] ) ? $astra_options['line-height-edd-archive-product-title'] : '',
				'line-height-unit'    => 'em',
				'letter-spacing'      => '',
				'letter-spacing-unit' => 'px',
				'text-transform'      => ! isset( $astra_options['font-extras-edd-archive-product-title'] ) && isset( $astra_options['text-transform-edd-archive-product-title'] ) ? $astra_options['text-transform-edd-archive-product-title'] : '',
				'text-decoration'     => '',
			);
			$defaults['font-size-edd-archive-product-title']   = array(
				'desktop'      => '',
				'tablet'       => '',
				'mobile'       => '',
				'desktop-unit' => 'px',
				'tablet-unit'  => 'px',
				'mobile-unit'  => 'px',
			);

			// Shop Product Price Typo.
			$defaults['font-family-edd-archive-product-price'] = 'inherit';
			$defaults['font-weight-edd-archive-product-price'] = 'inherit';
			$defaults['font-extras-edd-archive-product-price'] = array(
				'line-height'         => ! isset( $astra_options['font-extras-edd-archive-product-price'] ) && isset( $astra_options['line-height-edd-archive-product-price'] ) ? $astra_options['line-height-edd-archive-product-price'] : '',
				'line-height-unit'    => 'em',
				'letter-spacing'      => '',
				'letter-spacing-unit' => 'px',
				'text-transform'      => '',
				'text-decoration'     => '',
			);
			$defaults['font-size-edd-archive-product-price']   = array(
				'desktop'      => '',
				'tablet'       => '',
				'mobile'       => '',
				'desktop-unit' => 'px',
				'tablet-unit'  => 'px',
				'mobile-unit'  => 'px',
			);

			// Shop Product Category Typo.
			$defaults['font-family-edd-archive-product-content'] = 'inherit';
			$defaults['font-weight-edd-archive-product-content'] = 'inherit';
			$defaults['font-extras-edd-archive-product-content'] = array(
				'line-height'         => ! isset( $astra_options['font-extras-edd-archive-product-content'] ) && isset( $astra_options['line-height-edd-archive-product-content'] ) ? $astra_options['line-height-edd-archive-product-content'] : '',
				'line-height-unit'    => 'em',
				'letter-spacing'      => '',
				'letter-spacing-unit' => 'px',
				'text-transform'      => ! isset( $astra_options['font-extras-edd-archive-product-content'] ) && isset( $astra_options['text-transform-edd-archive-product-content'] ) ? $astra_options['text-transform-edd-archive-product-content'] : '',
				'text-decoration'     => '',
			);
			$defaults['font-size-edd-archive-product-content']   = array(
				'desktop'      => '',
				'tablet'       => '',
				'mobile'       => '',
				'desktop-unit' => 'px',
				'tablet-unit'  => 'px',
				'mobile-unit'  => 'px',
			);

			// Single Product Colors.
			$defaults['edd-single-product-title-color']      = '';
			$defaults['edd-single-product-content-color']    = '';
			$defaults['edd-single-product-navigation-color'] = '';

			// EDD Archive Product Colors.
			$defaults['edd-archive-product-category-color'] = '';
			$defaults['edd-archive-product-title-color']    = '';
			$defaults['edd-archive-product-price-color']    = '';
			$defaults['edd-archive-product-content-color']  = '';

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
			 * Register Sections & Panels
			 */
			require_once ASTRA_ADDON_EXT_EDD_DIR . 'classes/class-astra-edd-panels-and-sections.php';

			/**
			 * Sections
			 */
			require_once ASTRA_ADDON_EXT_EDD_DIR . 'classes/sections/class-astra-edd-general-configs.php';
			require_once ASTRA_ADDON_EXT_EDD_DIR . 'classes/sections/class-astra-edd-shop-configs.php';
			require_once ASTRA_ADDON_EXT_EDD_DIR . 'classes/sections/class-astra-edd-shop-single-configs.php';
			require_once ASTRA_ADDON_EXT_EDD_DIR . 'classes/sections/class-astra-edd-checkout-configs.php';
			require_once ASTRA_ADDON_EXT_EDD_DIR . 'classes/sections/class-astra-edd-shop-single-typo-configs.php';
			require_once ASTRA_ADDON_EXT_EDD_DIR . 'classes/sections/class-astra-edd-single-colors-configs.php';

			require_once ASTRA_ADDON_EXT_EDD_DIR . 'classes/sections/class-astra-edd-shop-typo-configs.php';
			require_once ASTRA_ADDON_EXT_EDD_DIR . 'classes/sections/class-astra-edd-archive-colors-configs.php';

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

			wp_enqueue_script( 'ast-edd-customizer-preview', ASTRA_ADDON_EXT_EDD_URI . $js_path, array( 'customize-preview', 'astra-customizer-preview-js' ), ASTRA_EXT_VER, true );
			if ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) {

				wp_localize_script(
					'ast-edd-customizer-preview',
					'astAddonTabletBreakpoint',
					array(
						'value' => astra_addon_get_tablet_breakpoint( '', 1 ),
					)
				);
			}
		}
	}
}

/**
* Kicking this off by calling 'get_instance()' method
*/
Astra_Ext_Edd_Loader::get_instance();
