<?php
/**
 * Shop Options for our theme.
 *
 * @package     Astra Addon
 * @author      Brainstorm Force
 * @copyright   Copyright (c) 2020, Brainstorm Force
 * @link        https://www.brainstormforce.com
 * @since       Astra 1.4.3
 */

// Block direct access to the file.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Bail if Customizer config base class does not exist.
if ( ! class_exists( 'Astra_Customizer_Config_Base' ) ) {
	return;
}

if ( ! class_exists( 'Astra_Woocommerce_Shop_Configs' ) ) {

	/**
	 * Register Woocommerce Shop Layout Configurations.
	 */
	class Astra_Woocommerce_Shop_Configs extends Astra_Customizer_Config_Base {

		/**
		 * Register Woocommerce Shop Layout Configurations.
		 *
		 * @param Array                $configurations Astra Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array Astra Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_configs = array(

				/**
				 * Option: Choose Product Style
				 */
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[shop-style]',
					'default'           => astra_get_option( 'shop-style' ),
					'type'              => 'control',
					'section'           => 'woocommerce_product_catalog',
					'title'             => __( 'Layout', 'astra-addon' ),
					'control'           => 'ast-radio-image',
					'divider'           => array( 'ast_class' => 'ast-bottom-divider' ),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_choices' ),
					'priority'          => 10,
					'choices'           => array(
						'shop-page-grid-style' => array(
							'label' => __( 'Grid View', 'astra-addon' ),
							'path'  => ( class_exists( 'Astra_Builder_UI_Controller' ) ) ? Astra_Builder_UI_Controller::fetch_svg_icon( 'shop-page-grid-style', false ) : '',
						),
						'shop-page-list-style' => array(
							'label' => __( 'List View', 'astra-addon' ),
							'path'  => ( class_exists( 'Astra_Builder_UI_Controller' ) ) ? Astra_Builder_UI_Controller::fetch_svg_icon( 'shop-page-list-style', false ) : '',
						),
					),
				),

				/**
				 * Option: Divider
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[shop-box-styling]',
					'section'  => 'woocommerce_product_catalog',
					'title'    => __( 'Product Styling', 'astra-addon' ),
					'type'     => 'control',
					'control'  => 'ast-heading',
					'priority' => 75,
					'settings' => array(),
				),

				/**
				 * Option: Content Alignment
				 */
				array(
					'name'       => ASTRA_THEME_SETTINGS . '[shop-product-align]',
					'default'    => astra_get_option( 'shop-product-align' ),
					'type'       => 'control',
					'transport'  => 'postMessage',
					'control'    => Astra_Theme_Extension::$selector_control,
					'section'    => 'woocommerce_product_catalog',
					'priority'   => 80,
					'divider'    => array( 'ast_class' => 'ast-bottom-divider' ),
					'title'      => __( 'Content Alignment', 'astra-addon' ),
					'responsive' => false,
					'choices'    => array(
						'align-left'   => 'align-left',
						'align-center' => 'align-center',
						'align-right'  => 'align-right',
					),
				),

				/**
				 * Option: Box shadow
				 */
				array(
					'name'        => ASTRA_THEME_SETTINGS . '[shop-product-shadow]',
					'default'     => astra_get_option( 'shop-product-shadow' ),
					'type'        => 'control',
					'transport'   => 'postMessage',
					'control'     => 'ast-slider',
					'title'       => __( 'Box Shadow', 'astra-addon' ),
					'section'     => 'woocommerce_product_catalog',
					'suffix'      => 'px',
					'priority'    => 85,
					'input_attrs' => array(
						'min'  => 0,
						'step' => 1,
						'max'  => 5,
					),
				),

				/**
				 * Option: Box hover shadow
				 */
				array(
					'name'        => ASTRA_THEME_SETTINGS . '[shop-product-shadow-hover]',
					'default'     => astra_get_option( 'shop-product-shadow-hover' ),
					'type'        => 'control',
					'transport'   => 'postMessage',
					'control'     => 'ast-slider',
					'title'       => __( 'Box Hover Shadow', 'astra-addon' ),
					'section'     => 'woocommerce_product_catalog',
					'suffix'      => 'px',
					'priority'    => 90,
					'input_attrs' => array(
						'min'  => 0,
						'step' => 1,
						'max'  => 5,
					),
					'divider'     => array( 'ast_class' => 'ast-bottom-divider' ),
				),

				/**
				 * Option: Product Hover Style
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[shop-hover-style]',
					'type'     => 'control',
					'control'  => 'ast-select',
					'section'  => 'woocommerce_product_catalog',
					'default'  => astra_get_option( 'shop-hover-style' ),
					'priority' => 90,
					'title'    => __( 'Product Image Hover Style', 'astra-addon' ),
					'choices'  => apply_filters(
						'astra_woo_shop_hover_style',
						array(
							''     => __( 'None', 'astra-addon' ),
							'swap' => __( 'Swap Images', 'astra-addon' ),
						)
					),
				),

				/**
				 * Option: Divider
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[shop-button-divider]',
					'section'  => 'woocommerce_product_catalog',
					'title'    => __( 'Button', 'astra-addon' ),
					'type'     => 'control',
					'control'  => 'ast-heading',
					'priority' => 110,
					'settings' => array(),
				),

				/**
				 * Option: Vertical Padding
				 */
				array(
					'name'        => ASTRA_THEME_SETTINGS . '[shop-button-v-padding]',
					'default'     => astra_get_option( 'shop-button-v-padding' ),
					'type'        => 'control',
					'transport'   => 'postMessage',
					'section'     => 'woocommerce_product_catalog',
					'title'       => __( 'Vertical Padding', 'astra-addon' ),
					'control'     => 'ast-slider',
					'suffix'      => 'px',
					'priority'    => 110,
					'input_attrs' => array(
						'min'  => 1,
						'step' => 1,
						'max'  => 200,
					),
					'divider'     => array( 'ast_class' => 'ast-bottom-divider' ),
				),

				/**
				 * Option: Horizontal Padding
				 */
				array(
					'name'        => ASTRA_THEME_SETTINGS . '[shop-button-h-padding]',
					'default'     => astra_get_option( 'shop-button-h-padding' ),
					'type'        => 'control',
					'transport'   => 'postMessage',
					'section'     => 'woocommerce_product_catalog',
					'priority'    => 110,
					'title'       => __( 'Horizontal Padding', 'astra-addon' ),
					'control'     => 'ast-slider',
					'suffix'      => 'px',
					'input_attrs' => array(
						'min'  => 1,
						'step' => 1,
						'max'  => 200,
					),
				),

				/**
				 * Option: Divider
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[shop-pagination-divider]',
					'section'  => 'woocommerce_product_catalog',
					'title'    => __( 'Pagination', 'astra-addon' ),
					'type'     => 'control',
					'control'  => 'ast-heading',
					'priority' => 140,
					'settings' => array(),
				),

				/**
				 * Option: Shop Pagination
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[shop-pagination]',
					'default'  => astra_get_option( 'shop-pagination' ),
					'type'     => 'control',
					'control'  => 'ast-select',
					'section'  => 'woocommerce_product_catalog',
					'priority' => 145,
					'title'    => __( 'Shop Pagination', 'astra-addon' ),
					'choices'  => array(
						'number'   => __( 'Number', 'astra-addon' ),
						'infinite' => __( 'Infinite Scroll', 'astra-addon' ),
					),
				),

				/**
				 * Option: Shop Pagination Style
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[shop-pagination-style]',
					'default'   => astra_get_option( 'shop-pagination-style' ),
					'type'      => 'control',
					'transport' => 'postMessage',
					'control'   => 'ast-select',
					'section'   => 'woocommerce_product_catalog',
					'divider'   => array( 'ast_class' => 'ast-bottom-divider' ),
					'context'   => array(
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[shop-pagination]',
							'operator' => '==',
							'value'    => 'number',
						),
					),
					'priority'  => 150,
					'title'     => __( 'Shop Pagination Style', 'astra-addon' ),
					'choices'   => array(
						'default' => __( 'Default', 'astra-addon' ),
						'square'  => __( 'Square', 'astra-addon' ),
						'circle'  => __( 'Circle', 'astra-addon' ),
					),
				),

				/**
				 * Option: Event to Trigger Infinite Loading
				 */
				array(
					'name'        => ASTRA_THEME_SETTINGS . '[shop-infinite-scroll-event]',
					'default'     => astra_get_option( 'shop-infinite-scroll-event' ),
					'type'        => 'control',
					'control'     => 'ast-select',
					'section'     => 'woocommerce_product_catalog',
					'description' => __( 'Infinite Scroll cannot be previewed in the Customizer.', 'astra-addon' ),
					'context'     => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[shop-pagination]',
							'operator' => '==',
							'value'    => 'infinite',
						),
					),
					'priority'    => 155,
					'title'       => __( 'Event to Trigger Infinite Loading', 'astra-addon' ),
					'choices'     => array(
						'scroll' => __( 'Scroll', 'astra-addon' ),
						'click'  => __( 'Click', 'astra-addon' ),
					),
					'divider'     => array( 'ast_class' => 'ast-bottom-divider ast-top-divider' ),
				),

				/**
				 * Option: Read more text
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[shop-load-more-text]',
					'default'   => astra_get_option( 'shop-load-more-text' ),
					'type'      => 'control',
					'transport' => 'postMessage',
					'section'   => 'woocommerce_product_catalog',
					'priority'  => 160,
					'title'     => __( 'Load More Text', 'astra-addon' ),
					'context'   => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[shop-pagination]',
							'operator' => '==',
							'value'    => 'infinite',
						),
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[shop-infinite-scroll-event]',
							'operator' => '==',
							'value'    => 'click',
						),
					),
					'control'   => 'text',
					'partial'   => array(
						'selector'            => '.ast-shop-pagination-infinite .ast-shop-load-more',
						'container_inclusive' => false,
						'render_callback'     => 'Astra_Customizer_Ext_WooCommerce_Partials::_render_shop_load_more',
					),
				),

				/**
				 * Option: Display Page Title
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[shop-page-title-display]',
					'default'  => astra_get_option( 'shop-page-title-display' ),
					'type'     => 'control',
					'section'  => 'woocommerce_product_catalog',
					'title'    => __( 'Display Page Title', 'astra-addon' ),
					'divider'  => array( 'ast_class' => 'ast-bottom-divider' ),
					'priority' => 29,
					'control'  => Astra_Theme_Extension::$switch_control,
				),

				/**
				 * Option: Display Breadcrumb
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[shop-breadcrumb-display]',
					'default'  => astra_get_option( 'shop-breadcrumb-display' ),
					'type'     => 'control',
					'section'  => 'woocommerce_product_catalog',
					'title'    => __( 'Display Breadcrumb', 'astra-addon' ),
					'divider'  => array( 'ast_class' => 'ast-bottom-divider' ),
					'priority' => 29,
					'control'  => Astra_Theme_Extension::$switch_control,
				),

				/**
				 * Option: Display Toolbar
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[shop-toolbar-display]',
					'default'  => astra_get_option( 'shop-toolbar-display' ),
					'type'     => 'control',
					'section'  => 'woocommerce_product_catalog',
					'title'    => __( 'Display Toolbar', 'astra-addon' ),
					'priority' => 29,
					'control'  => Astra_Theme_Extension::$switch_control,
				),

				/**
				 * Option: Display Off Canvas On Click Of
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[shop-off-canvas-trigger-type]',
					'default'  => astra_get_option( 'shop-off-canvas-trigger-type' ),
					'type'     => 'control',
					'control'  => 'ast-select',
					'section'  => 'woocommerce_product_catalog',
					'priority' => 200,
					'divider'  => array( 'ast_class' => 'ast-bottom-divider' ),
					'title'    => __( 'Trigger for Off Canvas Sidebar', 'astra-addon' ),
					'choices'  => array(
						'disable'      => __( 'Disable', 'astra-addon' ),
						'link'         => __( 'Link', 'astra-addon' ),
						'button'       => __( 'Button', 'astra-addon' ),
						'custom-class' => __( 'Custom Class', 'astra-addon' ),
					),
				),

				/**
				 * Option: Filter Button Text
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[shop-filter-trigger-link]',
					'default'  => astra_get_option( 'shop-filter-trigger-link' ),
					'type'     => 'control',
					'section'  => 'woocommerce_product_catalog',
					'context'  => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[shop-off-canvas-trigger-type]',
							'operator' => 'in',
							'value'    => array( 'button', 'link' ),
						),
					),
					'priority' => 205,
					'title'    => __( 'Off Canvas Button/Link Text', 'astra-addon' ),
					'control'  => 'text',
				),

				/**
				 * Option: Custom Class
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[shop-filter-trigger-custom-class]',
					'default'  => astra_get_option( 'shop-filter-trigger-custom-class' ),
					'type'     => 'control',
					'section'  => 'woocommerce_product_catalog',
					'context'  => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[shop-off-canvas-trigger-type]',
							'operator' => '==',
							'value'    => 'custom-class',
						),
					),
					'priority' => 210,
					'title'    => __( 'Custom Class', 'astra-addon' ),
					'control'  => 'text',
				),

				/**
				 * Option: Display Active Filters
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[shop-active-filters-display]',
					'default'  => astra_get_option( 'shop-active-filters-display' ),
					'type'     => 'control',
					'section'  => 'woocommerce_product_catalog',
					'context'  => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[shop-off-canvas-trigger-type]',
							'operator' => '!=',
							'value'    => 'disable',
						),
					),
					'title'    => __( 'Display Active Filters', 'astra-addon' ),
					'priority' => 215,
					'control'  => Astra_Theme_Extension::$switch_control,
					'divider'  => array( 'ast_class' => 'ast-bottom-divider' ),
				),

				/**
				 * Option: Enable Quick View
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[shop-quick-view-enable]',
					'default'  => astra_get_option( 'shop-quick-view-enable' ),
					'type'     => 'control',
					'section'  => 'woocommerce_product_catalog',
					'title'    => __( 'Quick View', 'astra-addon' ),
					'divider'  => array( 'ast_class' => 'ast-bottom-divider' ),
					'control'  => 'ast-select',
					'priority' => 190,
					'choices'  => array(
						'disabled'       => __( 'Disabled', 'astra-addon' ),
						'on-image'       => __( 'On Image', 'astra-addon' ),
						'on-image-click' => __( 'On Image Click', 'astra-addon' ),
						'after-summary'  => __( 'After Summary', 'astra-addon' ),
					),
				),

				/**
				 * Option: Stick Quick View
				 */
				array(
					'name'        => ASTRA_THEME_SETTINGS . '[shop-quick-view-stick-cart]',
					'default'     => astra_get_option( 'shop-quick-view-stick-cart' ),
					'type'        => 'control',
					'section'     => 'woocommerce_product_catalog',
					'title'       => __( 'Stick Add to Cart Button', 'astra-addon' ),
					'description' => __( 'If contents of the popup is larger then the button will stick at the end of the popup.', 'astra-addon' ),
					'control'     => Astra_Theme_Extension::$switch_control,
					'priority'    => 190,
					'divider'     => array( 'ast_class' => 'ast-bottom-divider' ),
					'context'     => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[shop-quick-view-enable]',
							'operator' => '!=',
							'value'    => 'disabled',
						),
					),
				),
			);

			$configurations = array_merge( $configurations, $_configs );

			return $configurations;

		}
	}
}


new Astra_Woocommerce_Shop_Configs();
