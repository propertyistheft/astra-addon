<?php
/**
 * WooCommerce Markup
 *
 * @package Astra Addon
 */

if ( ! class_exists( 'ASTRA_Ext_Edd_Markup' ) ) {

	/**
	 * Advanced Search Markup Initial Setup
	 *
	 * @since 1.6.10
	 */
	class ASTRA_Ext_Edd_Markup {

		/**
		 * Member Varible
		 *
		 * @var object instance
		 */
		private static $instance;

		/**
		 *  Initiator
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

			add_action( 'wp', array( $this, 'edd_initializattion' ) );
			add_action( 'wp', array( $this, 'customization_checkout_page' ) );

			add_action( 'astra_get_css_files', array( $this, 'add_styles' ) );

			add_filter( 'body_class', array( $this, 'body_class' ) );

			add_filter( 'post_class', array( $this, 'post_class' ) );
			add_filter( 'edd_download_class', array( $this, 'shortcode_download_class' ), 10, 4 );

			add_shortcode( 'astra_edd_mini_cart', array( $this, 'astra_edd_mini_cart_markup' ) );

			// Load Google fonts.
			add_action( 'astra_get_fonts', array( $this, 'add_fonts' ), 1 );
		}

		/**
		 * Easy Digital Downloads initialization
		 *
		 * @since  1.6.10
		 * @return void
		 */
		public function edd_initializattion() {
			$is_edd_archive_page        = astra_is_edd_archive_page();
			$is_edd_single_product_page = astra_is_edd_single_product_page();
			// Edd archive page.
			if ( $is_edd_archive_page ) {

				// Edd archive page product style.
				$shop_style                = astra_get_option( 'edd-archive-style' );
				$product_archive_structure = astra_get_option( 'edd-archive-product-structure' );
				if ( 'edd-archive-page-list-style' == $shop_style && in_array( 'image', $product_archive_structure ) ) {
					remove_action( 'astra_edd_archive_image', 'astra_edd_archive_product_image' );
					add_action( 'astra_edd_archive_before_block_wrap', 'astra_edd_archive_product_image' );

				}

				// Edd Archive Page Title.
				if ( ! astra_get_option( 'edd-archive-page-title-display' ) ) {
					add_filter( 'astra_the_title_enabled', '__return_false' );
				}
			}

			if ( $is_edd_single_product_page ) {
				// Remove the purchase button on single EDD Product page.
				$disable_edd_single_product_add_to_cart = astra_get_option( 'disable-edd-single-product-add-to-cart' );
				if ( $disable_edd_single_product_add_to_cart ) {
					remove_action( 'edd_after_download_content', 'edd_append_purchase_link' );
				}
			}
		}

		/**
		 * Add Font Family Callback
		 *
		 * @since  1.6.10
		 * @return void
		 */
		public function add_fonts() {

			$font_family_product_title = astra_get_option( 'font-family-edd-product-title' );
			$font_weight_product_title = astra_get_option( 'font-weight-edd-product-title' );
			Astra_Fonts::add_font( $font_family_product_title, $font_weight_product_title );

			$font_family_shop_product_title = astra_get_option( 'font-family-edd-archive-product-title' );
			$font_weight_shop_product_title = astra_get_option( 'font-weight-edd-archive-product-title' );
			Astra_Fonts::add_font( $font_family_shop_product_title, $font_weight_shop_product_title );

			$font_family_shop_product_price = astra_get_option( 'font-family-edd-archive-product-price' );
			$font_weight_shop_product_price = astra_get_option( 'font-weight-edd-archive-product-price' );
			Astra_Fonts::add_font( $font_family_shop_product_price, $font_weight_shop_product_price );

			$font_family_shop_product_content = astra_get_option( 'font-family-edd-archive-product-content' );
			$font_weight_shop_product_content = astra_get_option( 'font-weight-edd-archive-product-content' );
			Astra_Fonts::add_font( $font_family_shop_product_content, $font_weight_shop_product_content );

			$font_family_product_content = astra_get_option( 'font-family-edd-product-content' );
			$font_weight_product_content = astra_get_option( 'font-weight-edd-product-content' );
			Astra_Fonts::add_font( $font_family_product_content, $font_weight_product_content );

		}

		/**
		 * Mini Cart shortcode `astra_edd_mini_cart` mrakup.
		 *
		 * @since  1.6.10
		 * @param  array $atts Shortcode atts.
		 * @return html
		 */
		public function astra_edd_mini_cart_markup( $atts ) {

			$atts = shortcode_atts(
				array(
					'direction' => 'bottom left',
				),
				$atts
			);

			$output             = '';
			$astra_edd_instance = Astra_Edd::get_instance();

			if ( method_exists( $astra_edd_instance, 'edd_mini_cart_markup' ) ) {

				$output  = '<div class="ast-edd-mini-cart-wrapper ast-edd-mini-cart-dir ' . esc_attr( $atts['direction'] ) . '">';
				$output .= $astra_edd_instance->edd_mini_cart_markup();
				$output .= '</div>';
			}

			return $output;
		}

		/**
		 * Body Class
		 *
		 * @param array $classes Default argument array.
		 *
		 * @return array;
		 */
		public function body_class( $classes ) {
			$is_edd_archive_page = astra_is_edd_archive_page();
			if ( $is_edd_archive_page ) {

				$shop_style = astra_get_option( 'edd-archive-style' );
				if ( 'edd-archive-page-list-style' == $shop_style ) {
					$classes[] = 'ast-' . $shop_style;
				}
			} elseif ( edd_is_checkout() ) {
				if ( astra_get_option( 'edd-distraction-free-checkout' ) ) {
					$classes[] = 'ast-edd-distraction-free-checkout';
				}
			}
			return $classes;
		}

		/**
		 * Post Class
		 *
		 * @param array $classes Default argument array.
		 *
		 * @return array;
		 */
		public function post_class( $classes ) {

			$is_edd_archive_page = astra_is_edd_archive_page();

			if ( $is_edd_archive_page ) {
				// Single product normal & hover box shadow.
				$classes[] = astra_get_option( 'edd-archive-product-align' );
				$classes[] = 'box-shadow-' . astra_get_option( 'edd-archive-product-shadow' );
				$classes[] = 'box-shadow-' . astra_get_option( 'edd-archive-product-shadow-hover' ) . '-hover';
			}

			return $classes;
		}

		/**
		 * Edd shortcode download class
		 *
		 * @param string $class edd shortcode list item class.
		 * @param int    $id current post ID.
		 * @param array  $edd_download_shortcode_item_atts Default shortcode argument array.
		 * @param int    $edd_download_shortcode_item_i shortcode applied to items.
		 *
		 * @return string $class updated class to the shortcode list item;
		 */
		public function shortcode_download_class( $class, $id, $edd_download_shortcode_item_atts, $edd_download_shortcode_item_i ) {

			if ( 'edd_download' === $class ) {
				$classes = array();
				// Single product normal & hover box shadow.
				$classes[] = astra_get_option( 'edd-archive-product-align' );
				$classes[] = 'box-shadow-' . astra_get_option( 'edd-archive-product-shadow' );
				$classes[] = 'box-shadow-' . astra_get_option( 'edd-archive-product-shadow-hover' ) . '-hover';
				$class     = $class . ' ' . implode( ' ', $classes );
			}
			return $class;
		}

		/**
		 * Checkout page markup update using actions & filters only
		 */
		public function customization_checkout_page() {

			if ( ! edd_is_checkout() ) {
				return;
			}

			// Display coupon.
			if ( ! astra_get_option( 'edd-checkout-coupon-display' ) ) {
				remove_action( 'edd_before_purchase_form', 'edd_discount_field', -1 );
				remove_action( 'edd_before_purchase_form', 'edd_agree_to_terms_js' );
			}

			// Distraction Free Checkout.
			if ( astra_get_option( 'edd-distraction-free-checkout' ) ) {

				// HFB Support for distration free checkout.
				if ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) {
					remove_action( 'astra_header', array( Astra_Builder_Header::get_instance(), 'prepare_header_builder_markup' ) );
					remove_action( 'astra_footer', array( Astra_Builder_Footer::get_instance(), 'footer_markup' ), 10 );
				}

				remove_action( 'astra_header', 'astra_header_markup' );
				remove_action( 'astra_footer', 'astra_footer_markup' );

				add_action( 'astra_header', array( $this, 'checkout_header_markup' ) );
				add_action( 'astra_footer', array( $this, 'checkout_footer_markup' ) );

				// Store Sidebar Layout.
				add_filter( 'astra_page_layout', array( $this, 'checkout_sidebar_layout' ), 99 );
			}
		}

		/**
		 * Header markup.
		 */
		public function checkout_header_markup() {

			astra_get_template( 'edd/templates/checkout-header.php' );
		}

		/**
		 * Footer markup.
		 */
		public function checkout_footer_markup() {

			astra_get_template( 'edd/templates/checkout-footer.php' );
		}

		/**
		 * Checkout sidebar layout.
		 *
		 * @param string $sidebar_layout Layout.
		 *
		 * @return string;
		 */
		public function checkout_sidebar_layout( $sidebar_layout ) {

			return 'no-sidebar';
		}

		/**
		 * Add Styles
		 */
		public function add_styles() {

			/*** Start Path Logic */

			/* Define Variables */
			$uri  = ASTRA_EXT_EDD_URI . 'assets/css/';
			$path = ASTRA_EXT_EDD_DIR . 'assets/css/';
			$rtl  = '';

			if ( is_rtl() ) {
				$rtl = '-rtl';
			}

			/* Directory and Extension */
			$file_prefix = $rtl . '.min';
			$dir_name    = 'minified';

			if ( SCRIPT_DEBUG ) {
				$file_prefix = $rtl;
				$dir_name    = 'unminified';
			}

			$css_uri = $uri . $dir_name . '/';
			$css_dir = $path . $dir_name . '/';

			if ( defined( 'ASTRA_THEME_HTTP2' ) && ASTRA_THEME_HTTP2 ) {
				$gen_path = $css_uri;
			} else {
				$gen_path = $css_dir;
			}

			/*** End Path Logic */

			/* Add style.css */
			Astra_Minify::add_css( $gen_path . 'style' . $file_prefix . '.css' );

			// Shop page style.
			$shop_page_style = astra_get_option( 'edd-archive-style' );

			if ( 'edd-archive-page-list-style' == $shop_page_style ) {
				$shop_page_style = Astra_Addon_Builder_Helper::apply_flex_based_css() ? $shop_page_style . '-grid' : $shop_page_style;
				Astra_Minify::add_css( $gen_path . $shop_page_style . $file_prefix . '.css' );
			}
		}
	}
}

/**
 * Kicking this off by calling 'get_instance()' method
 */
ASTRA_Ext_Edd_Markup::get_instance();
