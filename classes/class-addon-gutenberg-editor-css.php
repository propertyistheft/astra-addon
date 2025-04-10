<?php
/**
 * Astra Addon - Gutenberg Editor CSS
 *
 * @package Astra Addon
 */

if ( ! class_exists( 'Addon_Gutenberg_Editor_CSS' ) ) {

	/**
	 * Addon_Gutenberg_Editor_CSS initial setup
	 *
	 * @since 1.6.2
	 */
	// @codingStandardsIgnoreStart
	class Addon_Gutenberg_Editor_CSS {
		// @codingStandardsIgnoreEnd

		/**
		 * Class instance.
		 *
		 * @var Class $instance instance.
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
		 *  Constructor
		 */
		public function __construct() {
			if ( Astra_Ext_Extension::is_active( 'colors-and-background' ) ) {
				add_filter( 'astra_block_editor_dynamic_css', array( $this, 'colors_and_background_addon_gutenberg_dynamic_css' ) );
			}
			if ( Astra_Ext_Extension::is_active( 'spacing' ) ) {
				add_filter( 'astra_block_editor_dynamic_css', array( $this, 'spacing_addon_gutenberg_dynamic_css' ) );
			}
			if ( Astra_Ext_Extension::is_active( 'woocommerce' ) ) {
				add_filter( 'astra_block_editor_dynamic_css', array( $this, 'woo_gb_blocks_dynamic_css' ) );
			}
		}

		/**
		 * Dynamic CSS - Colors and Background
		 *
		 * @since  1.6.2
		 * @param  string $dynamic_css          Astra Gutenberg Dynamic CSS.
		 * @param  string $dynamic_css_filtered Astra Gutenberg Dynamic CSS Filters.
		 * @return string
		 */
		public function colors_and_background_addon_gutenberg_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' ) {
			$h1_color                = astra_get_option( 'h1-color' );
			$h2_color                = astra_get_option( 'h2-color' );
			$h3_color                = astra_get_option( 'h3-color' );
			$h4_color                = astra_get_option( 'h4-color' );
			$h5_color                = astra_get_option( 'h5-color' );
			$h6_color                = astra_get_option( 'h6-color' );
			$single_post_title_color = astra_get_option( 'ast-dynamic-single-' . esc_attr( strval( get_post_type() ) ) . '-banner-title-color' );

			$parse_css = '';
			/**
			 * Colors and Background
			 */
			$colors_and_background_output = array(
				/**
				 * Content <h1> to <h6> headings
				 */
				'.editor-styles-wrapper .block-editor-block-list__block h1, .wp-block-heading h1.editor-rich-text__tinymce, .editor-post-title__block .editor-post-title__input, .edit-post-visual-editor h1.block-editor-block-list__block' => array(
					'color' => esc_attr( $h1_color ),
				),
				'.editor-styles-wrapper .block-editor-block-list__block h2, .wp-block-heading h2.editor-rich-text__tinymce, .edit-post-visual-editor h2.block-editor-block-list__block' => array(
					'color' => esc_attr( $h2_color ),
				),
				'.editor-styles-wrapper .block-editor-block-list__block h3, .wp-block-heading h3.editor-rich-text__tinymce, .edit-post-visual-editor h3.block-editor-block-list__block' => array(
					'color' => esc_attr( $h3_color ),
				),
				'.editor-styles-wrapper .block-editor-block-list__block h4, .wp-block-heading h4.editor-rich-text__tinymce, .edit-post-visual-editor h4.block-editor-block-list__block' => array(
					'color' => esc_attr( $h4_color ),
				),
				'.editor-styles-wrapper .block-editor-block-list__block h5, .wp-block-heading h5.editor-rich-text__tinymce, .edit-post-visual-editor h5.block-editor-block-list__block' => array(
					'color' => esc_attr( $h5_color ),
				),
				'.editor-styles-wrapper .block-editor-block-list__block h6, .wp-block-heading h6.editor-rich-text__tinymce, .edit-post-visual-editor h6.block-editor-block-list__block' => array(
					'color' => esc_attr( $h6_color ),
				),
			);

			if ( 'post' === get_post_type() ) {
				$colors_and_background_output['.editor-post-title__block .editor-post-title__input'] = array(
					'color' => esc_attr( $single_post_title_color ),
				);
			}

			$parse_css .= astra_parse_css( $colors_and_background_output );

			$boxed_container        = array();
			$boxed_container_tablet = array();
			$boxed_container_mobile = array();

			$container_layout = get_post_meta( get_the_id(), 'site-content-layout', true );
			if ( 'default' === $container_layout || '' === $container_layout ) {
				$container_layout = astra_get_option( 'single-' . get_post_type() . '-content-layout' );

				if ( 'default' === $container_layout ) {
					$container_layout = astra_get_option( 'site-content-layout' );
				}
			}

			if ( isset( $container_layout ) ) {
				// Setting up "Full-Width / Stretched" layout transparent but not for "Full-Width / Contained" in case of Max-Width site layout.
				// Because we showcase container with "Full-Width / Contained" layout, so it should be visible as it looks on frontend with their content background styles.
				$boxed_container = array(
					'.ast-max-width-layout.ast-plain-container .edit-post-visual-editor .block-editor-writing-flow' => array(
						'padding' => '20px',
					),
				);

				$boxed_container_tablet = array(
					'.ast-max-width-layout.ast-plain-container .edit-post-visual-editor .block-editor-writing-flow' => array(
						'padding' => '20px',
					),
				);
				$boxed_container_mobile = array(
					'.ast-max-width-layout.ast-plain-container .edit-post-visual-editor .block-editor-writing-flow' => array(
						'padding' => '20px',
					),
				);
			}

			$parse_css .= astra_parse_css( $boxed_container );
			$parse_css .= astra_parse_css( $boxed_container_tablet, '', astra_addon_get_tablet_breakpoint() );
			$parse_css .= astra_parse_css( $boxed_container_mobile, '', astra_addon_get_mobile_breakpoint() );

			return $dynamic_css . $parse_css;
		}

		/**
		 * Dynamic CSS - Spacing Addon
		 *
		 * @since  1.6.2
		 * @param  string $dynamic_css          Astra Gutenberg Dynamic CSS.
		 * @param  string $dynamic_css_filtered Astra Gutenberg Dynamic CSS Filters.
		 * @return string
		 */
		public function spacing_addon_gutenberg_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' ) {

			if ( 'custom' === astra_get_option( 'wp-blocks-ui', 'custom' ) ) {
				return $dynamic_css;
			}

			$container_layout = get_post_meta( get_the_id(), 'site-content-layout', true );
			if ( 'default' === $container_layout ) {
				$container_layout = astra_get_option( 'single-' . get_post_type() . '-content-layout' );

				if ( 'default' === $container_layout ) {
					$container_layout = astra_get_option( 'site-content-layout' );
				}
			}

			$boxed_container = array();

			if ( 'content-boxed-container' === $container_layout || 'boxed-container' === $container_layout ) {

				$continer_inside_spacing = astra_get_option( 'container-inside-spacing' );
				$site_content_width      = astra_get_option( 'site-content-width', 1200 );

				$boxed_container = array(

					'.block-editor-block-list__layout, .editor-post-title' => array(
						'padding-top'    => astra_responsive_spacing( $continer_inside_spacing, 'top', 'desktop' ),
						'padding-bottom' => astra_responsive_spacing( $continer_inside_spacing, 'bottom', 'desktop' ),
						'padding-left'   => astra_responsive_spacing( $continer_inside_spacing, 'left', 'desktop' ),
						'padding-right'  => astra_responsive_spacing( $continer_inside_spacing, 'right', 'desktop' ),
					),

					'.block-editor-writing-flow .block-editor-block-list__layout' => array(
						'padding-top' => '0',
					),

					'.editor-post-title'              => array(
						'padding-bottom' => '0',
					),

					'.block-editor-block-list__block' => array(
						'max-width' => 'calc(' . astra_get_css_value( $site_content_width, 'px' ) . ' - ' . astra_responsive_spacing( $continer_inside_spacing, 'left', 'desktop' ) . ')',
					),

					'.block-editor-block-list__layout .block-editor-block-list__block[data-align="full"] > .editor-block-list__block-edit' => array(
						'margin-left'  => - (int) astra_responsive_spacing( $continer_inside_spacing, 'left', 'desktop' ) . 'px',
						'margin-right' => - (int) astra_responsive_spacing( $continer_inside_spacing, 'right', 'desktop' ) . 'px',
					),

					'.block-editor-block-list__block[data-align=wide]' => array(
						'margin-left'  => '-' . ( 15 - (int) astra_responsive_spacing( $continer_inside_spacing, 'left', 'desktop' ) ) . 'px',
						'margin-right' => '-' . ( 15 - (int) astra_responsive_spacing( $continer_inside_spacing, 'right', 'desktop' ) ) . 'px',
					),

				);

				if ( '' !== astra_responsive_spacing( $continer_inside_spacing, 'left', 'desktop' ) ) {
					$boxed_container['.edit-post-visual-editor .block-editor-block-list__block .editor-block-list__block-edit, .editor-post-title__block .editor-post-title__input'] = array(
						'padding-left'  => 0,
						'padding-right' => 0,
					);
				}
			}

			$parse_css = astra_parse_css( $boxed_container );

			return $dynamic_css . $parse_css;
		}

		/**
		 * Dynamic CSS - WooCommerce Blocks
		 *
		 * @since  2.1.2
		 * @param  string $dynamic_css          Astra Gutenberg Dynamic CSS.
		 * @param  string $dynamic_css_filtered Astra Gutenberg Dynamic CSS Filters.
		 * @return string
		 */
		public function woo_gb_blocks_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' ) {

			// Shop Typo.
			$shop_product_title_font_size = astra_get_option( 'font-size-shop-product-title' );

			// Shop Product Title color.
			$shop_product_title_color     = astra_get_option( 'shop-product-title-color' );
			$shop_product_price_font_size = astra_get_option( 'font-size-shop-product-price' );

			// Shop Product Price color.
			$shop_product_price_color = astra_get_option( 'shop-product-price-color' );

			$theme_color        = astra_get_option( 'theme-color' );
			$link_color         = astra_get_option( 'link-color', $theme_color );
			$product_sale_style = astra_get_option( 'product-sale-style' );

			/**
			 * Set font sizes
			 */
			$css_output = array(
				'.wc-block-grid .wc-block-grid__products .wc-block-grid__product .wc-block-grid__product-title' => astra_addon_get_font_array_css( astra_get_option( 'font-family-shop-product-title' ), astra_get_option( 'font-weight-shop-product-title' ), $shop_product_title_font_size, 'font-extras-shop-product-title', $shop_product_title_color ),
				'.wc-block-grid .wc-block-grid__products .wc-block-grid__product .wc-block-grid__product-price' => astra_addon_get_font_array_css( astra_get_option( 'font-family-shop-product-price' ), astra_get_option( 'font-weight-shop-product-price' ), $shop_product_price_font_size, 'font-extras-shop-product-price', $shop_product_price_color ),
			);

			/* Parse CSS from array() */
			$css_output = astra_parse_css( $css_output );

			$tablet_css = array(
				'.wc-block-grid .wc-block-grid__products .wc-block-grid__product .wc-block-grid__product-title' => array(
					'font-size' => astra_responsive_font( $shop_product_title_font_size, 'tablet' ),
				),
				'.wc-block-grid .wc-block-grid__products .wc-block-grid__product .wc-block-grid__product-price' => array(
					'font-size' => astra_responsive_font( $shop_product_price_font_size, 'tablet' ),
				),
			);

			$css_output .= astra_parse_css( $tablet_css, '', astra_addon_get_tablet_breakpoint() );

			$mobile_css = array(
				'.wc-block-grid .wc-block-grid__products .wc-block-grid__product .wc-block-grid__product-title' => array(
					'font-size' => astra_responsive_font( $shop_product_title_font_size, 'mobile' ),
				),
				'.wc-block-grid .wc-block-grid__products .wc-block-grid__product .wc-block-grid__product-price' => array(
					'font-size' => astra_responsive_font( $shop_product_price_font_size, 'mobile' ),
				),
			);

			/**
			 * Sale bubble color
			 */
			if ( 'circle-outline' === $product_sale_style ) {
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
			} elseif ( 'square' === $product_sale_style ) {
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
			} elseif ( 'square-outline' === $product_sale_style ) {
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

			$css_output .= astra_parse_css( $mobile_css, '', astra_addon_get_mobile_breakpoint() );

			return $dynamic_css . $css_output;
		}

	}
}

/**
 * Kicking this off by calling 'get_instance()' method
 */
Addon_Gutenberg_Editor_CSS::get_instance();
