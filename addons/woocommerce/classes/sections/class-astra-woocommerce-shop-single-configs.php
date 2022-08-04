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

if ( ! class_exists( 'Astra_Woocommerce_Shop_Single_Configs' ) ) {

	/**
	 * Register Woocommerce shop single Layout Configurations.
	 */
	// @codingStandardsIgnoreStart
	class Astra_Woocommerce_Shop_Single_Configs extends Astra_Customizer_Config_Base {
 // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedClassFound
		// @codingStandardsIgnoreEnd

		/**
		 * Register Woocommerce shop single Layout Configurations.
		 *
		 * @param Array                $configurations Astra Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array Astra Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$clonning_attr    = array();
			$add_to_cart_attr = array();
			/**
			 * Single product payment control.
			 */

			$clonning_attr['single-product-payments'] = array(
				'clone'       => false,
				'is_parent'   => true,
				'main_index'  => 'single-product-payments',
				'clone_limit' => 2,
				'title'       => __( 'Payments', 'astra-addon' ),
			);

			/**
			 * Single product extras control.
			 */
			$clonning_attr['summary-extras'] = array(
				'clone'       => false,
				'is_parent'   => true,
				'main_index'  => 'summary-extras',
				'clone_limit' => 2,
				'title'       => __( 'Extras', 'astra-addon' ),
			);

			/**
			 * Single product add to cart control.
			 */
			$add_to_cart_attr['add_cart'] = array(
				'clone'       => false,
				'is_parent'   => true,
				'main_index'  => 'add_cart',
				'clone_limit' => 2,
				'title'       => __( 'Add To Cart', 'astra-addon' ),
			);

			/**
			 * Condition to check if the user is new or old and display product layout choices accordiongly.
			 */

			if ( astra_get_option( 'astra-product-gallery-layout-flag' ) ) {
				$single_product_layout = array(
					'first-image-large' => array(
						'label' => __( 'First Image Large', 'astra-addon' ),
						'path'  => ( class_exists( 'Astra_Builder_UI_Controller' ) ) ? Astra_Builder_UI_Controller::fetch_svg_icon( 'first-image-large', false ) : '',
					),
					'vertical-slider'   => array(
						'label' => __( 'Vertical Slider', 'astra-addon' ),
						'path'  => ( class_exists( 'Astra_Builder_UI_Controller' ) ) ? Astra_Builder_UI_Controller::fetch_svg_icon( 'vertical-slider', false ) : '',
					),
					'horizontal-slider' => array(
						'label' => __( 'Horizontal Slider', 'astra-addon' ),
						'path'  => ( class_exists( 'Astra_Builder_UI_Controller' ) ) ? Astra_Builder_UI_Controller::fetch_svg_icon( 'horizontal-slider', false ) : '',
					),
				);
			} else {
				$single_product_layout = array(
					'vertical'          => array(
						'label' => __( 'Vertical', 'astra-addon' ),
						'path'  => ( class_exists( 'Astra_Builder_UI_Controller' ) ) ? Astra_Builder_UI_Controller::fetch_svg_icon( 'vertical-slider', false ) : '',
					),
					'horizontal'        => array(
						'label' => __( 'Horizontal', 'astra-addon' ),
						'path'  => ( class_exists( 'Astra_Builder_UI_Controller' ) ) ? Astra_Builder_UI_Controller::fetch_svg_icon( 'horizontal-slider', false ) : '',
					),
					'first-image-large' => array(
						'label' => __( 'First Image Large', 'astra-addon' ),
						'path'  => ( class_exists( 'Astra_Builder_UI_Controller' ) ) ? Astra_Builder_UI_Controller::fetch_svg_icon( 'first-image-large', false ) : '',
					),
					'vertical-slider'   => array(
						'label' => __( 'Vertical Slider', 'astra-addon' ),
						'path'  => ( class_exists( 'Astra_Builder_UI_Controller' ) ) ? Astra_Builder_UI_Controller::fetch_svg_icon( 'vertical-slider', false ) : '',
					),
					'horizontal-slider' => array(
						'label' => __( 'Horizontal Slider', 'astra-addon' ),
						'path'  => ( class_exists( 'Astra_Builder_UI_Controller' ) ) ? Astra_Builder_UI_Controller::fetch_svg_icon( 'horizontal-slider', false ) : '',
					),
				);
			}

			$_configs = array(

				array(
					'name'        => 'section-woo-shop-single-ast-context-tabs',
					'section'     => 'section-woo-shop-single',
					'type'        => 'control',
					'control'     => 'ast-builder-header-control',
					'priority'    => 0,
					'description' => '',
				),

				/**
				 * Option: Divider
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[woo-single-product-gallery-divider]',
					'section'  => 'section-woo-shop-single',
					'title'    => __( 'Single Product Gallery', 'astra-addon' ),
					'type'     => 'control',
					'control'  => 'ast-heading',
					'priority' => 5,
					'settings' => array(),
					'divider'  => array( 'ast_class' => 'ast-section-spacing' ),
				),

				/**
				 * Option: Product Gallery Layout
				 */
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[single-product-gallery-layout]',
					'default'           => astra_get_option( 'single-product-gallery-layout' ),
					'type'              => 'control',
					'section'           => 'section-woo-shop-single',
					'title'             => __( 'Gallery Layout', 'astra-addon' ),
					'control'           => 'ast-radio-image',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_choices' ),
					'priority'          => 5,
					'choices'           => $single_product_layout,
					'alt_layout'        => false,
					'divider'           => array( 'ast_class' => 'ast-section-spacing' ),
				),

				/**
				 * Option: Product Gallery Layout
				 */
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[product-gallery-thumbnail-columns]',
					'default'           => astra_get_option( 'product-gallery-thumbnail-columns' ),
					'type'              => 'control',
					'control'           => 'ast-slider',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_responsive_slider' ),
					'section'           => 'section-woo-shop-single',
					'context'           => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[single-product-gallery-layout]',
							'operator' => '==',
							'value'    => 'first-image-large',
						),
					),
					'priority'          => 5,
					'title'             => __( 'Thumbnail Columns', 'astra-addon' ),
					'input_attrs'       => array(
						'step' => 1,
						'min'  => 1,
						'max'  => 4,
					),
				),

				/**
				 * Option: Enable product zoom effect.
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[single-product-image-zoom-effect]',
					'default'  => astra_get_option( 'single-product-image-zoom-effect' ),
					'type'     => 'control',
					'section'  => 'section-woo-shop-single',
					'title'    => __( 'Enable Image Zoom Effect', 'astra-addon' ),
					'priority' => 5,
					'control'  => Astra_Theme_Extension::$switch_control,
					'divider'  => array( 'ast_class' => 'ast-top-dotted-divider' ),
				),

				/**
				 * Option: Product Image Width
				 */
				array(
					'name'        => ASTRA_THEME_SETTINGS . '[single-product-image-width]',
					'default'     => astra_get_option( 'single-product-image-width' ),
					'type'        => 'control',
					'transport'   => 'postMessage',
					'control'     => 'ast-slider',
					'section'     => 'section-woo-shop-single',
					'title'       => __( 'Image Width', 'astra-addon' ),
					'suffix'      => '%',
					'priority'    => 5,
					'input_attrs' => array(
						'min'  => 20,
						'step' => 1,
						'max'  => 70,
					),
					'divider'     => array( 'ast_class' => 'ast-top-dotted-divider' ),
				),

				/**
				 * Option: Divider.
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[woo-single-product-structure-divider]',
					'section'  => 'section-woo-shop-single',
					'title'    => __( 'Single Product Structure', 'astra-addon' ),
					'type'     => 'control',
					'control'  => 'ast-heading',
					'priority' => 5,
					'settings' => array(),
					'divider'  => array( 'ast_class' => 'ast-section-spacing' ),
				),

				/**
				 * Option: Single Post Meta
				 */
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[single-product-structure]',
					'default'           => astra_get_option( 'single-product-structure' ),
					'type'              => 'control',
					'control'           => 'ast-sortable',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_multi_choices' ),
					'section'           => 'section-woo-shop-single',
					'priority'          => 15,
					'choices'           => array_merge(
						array(
							'title'   => __( 'Title', 'astra-addon' ),
							'price'   => __( 'Price', 'astra-addon' ),
							'ratings' => __( 'Ratings', 'astra-addon' ),
						),
						$add_to_cart_attr,
						array(
							'short_desc' => __( 'Short Description', 'astra-addon' ),
							'meta'       => __( 'Meta', 'astra-addon' ),
							'category'   => __( 'Category', 'astra-addon' ),
						),
						$clonning_attr
					),
					'divider'           => array( 'ast_class' => 'ast-section-spacing' ),
				),

				/**
				 * Option: Enable product sticky summary.
				 */
				array(
					'name'        => ASTRA_THEME_SETTINGS . '[single-product-sticky-summary]',
					'default'     => astra_get_option( 'single-product-sticky-summary' ),
					'type'        => 'control',
					'section'     => 'section-woo-shop-single',
					'title'       => __( 'Enable Sticky Product Summary', 'astra-addon' ),
					'description' => __( 'Sticks the product summary on the top while scrolling.', 'astra-addon' ),
					'priority'    => 16,
					'control'     => Astra_Theme_Extension::$switch_control,
				),

				/**
				 * Option: Divider.
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[single-product-product-navigation-divider]',
					'section'  => 'section-woo-shop-single',
					'title'    => __( 'Product Navigation', 'astra-addon' ),
					'type'     => 'control',
					'control'  => 'ast-heading',
					'priority' => 16,
					'settings' => array(),
					'divider'  => array( 'ast_class' => 'ast-section-spacing' ),
				),

				/**
				 * Option: Navigation Style
				 */
				array(
					'name'        => ASTRA_THEME_SETTINGS . '[single-product-nav-style]',
					'default'     => astra_get_option( 'single-product-nav-style' ),
					'type'        => 'control',
					'section'     => 'section-woo-shop-single',
					'title'       => __( 'Product Navigation', 'astra-addon' ),
					'description' => __( 'Adds a product navigation control on the top of product summary section.', 'astra-addon' ),
					'control'     => 'ast-select',
					'priority'    => 16,
					'choices'     => array(
						'disable'        => __( 'Disable', 'astra-addon' ),
						'circle'         => __( 'Circle', 'astra-addon' ),
						'circle-outline' => __( 'Circle Outline', 'astra-addon' ),
						'square'         => __( 'Square', 'astra-addon' ),
						'square-outline' => __( 'Square Outline', 'astra-addon' ),
					),
					'divider'     => array( 'ast_class' => 'ast-section-spacing' ),
				),

				/**
				 * Option: Enable Product Navigation Preview Image.
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[single-product-navigation-preview]',
					'default'  => astra_get_option( 'single-product-navigation-preview' ),
					'type'     => 'control',
					'section'  => 'section-woo-shop-single',
					'title'    => __( 'Enable Navigation Preview', 'astra-addon' ),
					'control'  => Astra_Theme_Extension::$switch_control,
					'context'  => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[single-product-nav-style]',
							'operator' => '!=',
							'value'    => 'disable',
						),
					),
					'priority' => 16,
					'divider'  => array( 'ast_class' => 'ast-top-dotted-divider' ),
				),

				/**
				 * Option: Divider.
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[woo-single-product-navigation-color-divider]',
					'section'  => 'section-woo-shop-single',
					'title'    => __( 'Product Navigation Colors', 'astra-addon' ),
					'type'     => 'control',
					'control'  => 'ast-heading',
					'priority' => 81,
					'settings' => array(),
					'context'  => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[single-product-nav-style]',
							'operator' => '!=',
							'value'    => 'disable',
						),
					),
					'divider'  => array( 'ast_class' => 'ast-section-spacing' ),
				),

				/**
				* Option: Product navigation icon color
				*/
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[single-product-nav-icon-color]',
					'default'   => astra_get_option( 'single-product-nav-icon-color' ),
					'type'      => 'control',
					'control'   => Astra_Theme_Extension::$group_control,
					'title'     => __( 'Icon Color', 'astra-addon' ),
					'section'   => 'section-woo-shop-single',
					'transport' => 'postMessage',
					'priority'  => 81,
					'context'   => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[single-product-nav-style]',
							'operator' => '!=',
							'value'    => 'disable',
						),
					),
					'divider'   => array( 'ast_class' => 'ast-section-spacing' ),
				),

				// Option: Link Color.
				array(
					'type'     => 'sub-control',
					'priority' => 81,
					'parent'   => ASTRA_THEME_SETTINGS . '[single-product-nav-icon-color]',
					'section'  => 'section-woo-shop-single',
					'control'  => 'ast-color',
					'default'  => astra_get_option( 'single-product-nav-icon-n-color' ),
					'name'     => 'single-product-nav-icon-n-color',
					'title'    => __( 'Normal', 'astra-addon' ),
					'tab'      => __( 'Normal', 'astra-addon' ),
				),

				// Option: Link Hover Color.
				array(
					'type'              => 'sub-control',
					'priority'          => 81,
					'parent'            => ASTRA_THEME_SETTINGS . '[single-product-nav-icon-color]',
					'section'           => 'section-woo-shop-single',
					'control'           => 'ast-color',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
					'default'           => astra_get_option( 'single-product-nav-icon-h-color' ),
					'transport'         => 'postMessage',
					'name'              => 'single-product-nav-icon-h-color',
					'title'             => __( 'Hover', 'astra-addon' ),
					'tab'               => __( 'Hover', 'astra-addon' ),
				),

				/**
				 * Option: Product navigation background color
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[single-product-nav-bg-color]',
					'default'   => astra_get_option( 'single-product-nav-bg-color' ),
					'type'      => 'control',
					'control'   => Astra_Theme_Extension::$group_control,
					'title'     => __( 'Navigation Color', 'astra-addon' ),
					'section'   => 'section-woo-shop-single',
					'transport' => 'postMessage',
					'priority'  => 81,
					'context'   => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[single-product-nav-style]',
							'operator' => '!=',
							'value'    => 'disable',
						),
					),
				),

				// Option: Link Color.
				array(
					'type'     => 'sub-control',
					'priority' => 81,
					'parent'   => ASTRA_THEME_SETTINGS . '[single-product-nav-bg-color]',
					'section'  => 'section-woo-shop-single',
					'control'  => 'ast-color',
					'default'  => astra_get_option( 'single-product-nav-bg-n-color' ),
					'name'     => 'single-product-nav-bg-n-color',
					'title'    => __( 'Normal', 'astra-addon' ),
					'tab'      => __( 'Normal', 'astra-addon' ),
				),

				// Option: Link Hover Color.
				array(
					'type'              => 'sub-control',
					'priority'          => 81,
					'parent'            => ASTRA_THEME_SETTINGS . '[single-product-nav-bg-color]',
					'section'           => 'section-woo-shop-single',
					'control'           => 'ast-color',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
					'default'           => astra_get_option( 'single-product-nav-bg-h-color' ),
					'transport'         => 'postMessage',
					'name'              => 'single-product-nav-bg-h-color',
					'title'             => __( 'Hover', 'astra-addon' ),
					'tab'               => __( 'Hover', 'astra-addon' ),
				),

				/**
				 * Option: Divider.
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[single-product-product-variation-divider]',
					'section'  => 'section-woo-shop-single',
					'title'    => __( 'Product Variation', 'astra-addon' ),
					'type'     => 'control',
					'control'  => 'ast-heading',
					'priority' => 16,
					'settings' => array(),
					'divider'  => array( 'ast_class' => 'ast-section-spacing' ),
				),

				/**
				 * Option: Enable Product Variations Select to Buttons
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[single-product-select-variations]',
					'default'  => astra_get_option( 'single-product-select-variations' ),
					'type'     => 'control',
					'section'  => 'section-woo-shop-single',
					'title'    => __( 'Change Dropdown to Buttons', 'astra-addon' ),
					'priority' => 16,
					'control'  => Astra_Theme_Extension::$switch_control,
					'divider'  => array( 'ast_class' => 'ast-section-spacing ast-bottom-dotted-divider' ),

				),

				/**
				 * Option: Divider.
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[single-product-tabs-divider]',
					'section'  => 'section-woo-shop-single',
					'title'    => __( 'Product Description', 'astra-addon' ),
					'type'     => 'control',
					'control'  => 'ast-heading',
					'priority' => 30,
					'settings' => array(),
					'divider'  => array( 'ast_class' => 'ast-section-spacing' ),
				),

				/**
				 * Option: Enable Product Tabs Layout
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[single-product-tabs-display]',
					'default'  => astra_get_option( 'single-product-tabs-display' ),
					'type'     => 'control',
					'section'  => 'section-woo-shop-single',
					'title'    => __( 'Enable Product Description', 'astra-addon' ),
					'control'  => Astra_Theme_Extension::$switch_control,
					'priority' => 30,
					'divider'  => array( 'ast_class' => 'ast-section-spacing ast-bottom-dotted-divider' ),
				),

				/**
				 * Option: Product Tabs Layout
				 */
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[single-product-tabs-layout]',
					'type'              => 'control',
					'control'           => 'ast-radio-image',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_choices' ),
					'default'           => astra_get_option( 'single-product-tabs-layout' ),
					'priority'          => 30,
					'title'             => __( 'Layout', 'astra-addon' ),
					'section'           => 'section-woo-shop-single',
					'choices'           => array(
						'horizontal'  => array(
							'label' => __( 'Horizontal', 'astra-addon' ),
							'path'  => Astra_Builder_UI_Controller::fetch_svg_icon( 'description-horizontal' ),
						),
						'vertical'    => array(
							'label' => __( 'Vertical', 'astra-addon' ),
							'path'  => Astra_Builder_UI_Controller::fetch_svg_icon( 'description-vertical' ),
						),
						'accordion'   => array(
							'label' => __( 'Accordion', 'astra-addon' ),
							'path'  => Astra_Builder_UI_Controller::fetch_svg_icon( 'description-accordion' ),
						),
						'distributed' => array(
							'label' => __( 'Distributed', 'astra-addon' ),
							'path'  => Astra_Builder_UI_Controller::fetch_svg_icon( 'description-distributed' ),
						),
					),
					'context'           => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[single-product-tabs-display]',
							'operator' => '==',
							'value'    => true,
						),
					),
				),

				/**
				* Option: Divider.
				*/
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[woo-single-product-tab-color-divider]',
					'section'  => 'section-woo-shop-single',
					'title'    => __( 'Product Description Colors', 'astra-addon' ),
					'type'     => 'control',
					'control'  => 'ast-heading',
					'priority' => 81,
					'settings' => array(),
					'context'  => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[single-product-tabs-display]',
							'operator' => '==',
							'value'    => true,
						),
					),
					'divider'  => array( 'ast_class' => 'ast-section-spacing' ),
				),

				/**
				 * Option: Product Tabs Heading colors section
				 */
				array(
					'name'       => ASTRA_THEME_SETTINGS . '[single-product-heading-tab-colors]',
					'default'    => astra_get_option( 'single-product-heading-tab-colors' ),
					'type'       => 'control',
					'section'    => 'section-woo-shop-single',
					'title'      => __( 'Heading color', 'astra-addon' ),
					'control'    => 'ast-color-group',
					'priority'   => 81,
					'responsive' => false,
					'context'    => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[single-product-tabs-display]',
							'operator' => '==',
							'value'    => true,
						),
					),
					'divider'    => array( 'ast_class' => 'ast-section-spacing' ),
				),

				/**
				 * Option: Product Heading Tabs Normal Color section
				 */
				array(
					'type'       => 'sub-control',
					'parent'     => ASTRA_THEME_SETTINGS . '[single-product-heading-tab-colors]',
					'control'    => 'ast-responsive-color',
					'transport'  => 'postMessage',
					'section'    => 'section-woo-shop-single',
					'name'       => 'single-product-heading-tab-normal-color',
					'default'    => astra_get_option( 'single-product-heading-tab-normal-color' ),
					'title'      => __( 'Normal', 'astra-addon' ),
					'responsive' => false,
					'rgba'       => true,
					'priority'   => 40,
					'context'    => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[single-product-tabs-display]',
							'operator' => '==',
							'value'    => true,
						),
					),
				),

				/**
				 * Option: Product Heading Tabs Hover Color section
				 */
				array(
					'type'       => 'sub-control',
					'parent'     => ASTRA_THEME_SETTINGS . '[single-product-heading-tab-colors]',
					'control'    => 'ast-responsive-color',
					'transport'  => 'postMessage',
					'section'    => 'section-woo-shop-single',
					'name'       => 'single-product-heading-tab-hover-color',
					'default'    => astra_get_option( 'single-product-heading-tab-hover-color' ),
					'title'      => __( 'Hover', 'astra-addon' ),
					'responsive' => false,
					'rgba'       => true,
					'priority'   => 40,
					'context'    => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[single-product-tabs-display]',
							'operator' => '==',
							'value'    => true,
						),
					),
				),

				/**
				 * Option: Product Heading Tabs Active Color section
				 */
				array(
					'type'       => 'sub-control',
					'parent'     => ASTRA_THEME_SETTINGS . '[single-product-heading-tab-colors]',
					'control'    => 'ast-responsive-color',
					'transport'  => 'postMessage',
					'section'    => 'section-woo-shop-single',
					'name'       => 'single-product-heading-tab-active-color',
					'default'    => astra_get_option( 'single-product-heading-tab-active-color' ),
					'title'      => __( 'Active', 'astra-addon' ),
					'responsive' => false,
					'rgba'       => true,
					'priority'   => 40,
					'context'    => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[single-product-tabs-display]',
							'operator' => '==',
							'value'    => true,
						),
					),
				),

				/**
				 * Option: Move Accordion to summary
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[accordion-inside-woo-summary]',
					'default'  => astra_get_option( 'accordion-inside-woo-summary' ),
					'type'     => 'control',
					'section'  => 'section-woo-shop-single',
					'title'    => __( 'Accordion Inside Summary', 'astra-addon' ),
					'priority' => 35,
					'control'  => Astra_Theme_Extension::$switch_control,
					'context'  => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[single-product-tabs-layout]',
							'operator' => '==',
							'value'    => 'accordion',
						),
					),
					'divider'  => array( 'ast_class' => 'ast-top-dotted-divider' ),
				),

				/**
				 * Option: Divider.
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[single-product-related-divider]',
					'section'  => 'section-woo-shop-single',
					'title'    => __( 'Related & Up Sell Products', 'astra-addon' ),
					'type'     => 'control',
					'control'  => 'ast-heading',
					'priority' => 60,
					'settings' => array(),
					'divider'  => array( 'ast_class' => 'ast-section-spacing' ),
				),

				/**
				 * Option: Display related products
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[single-product-related-display]',
					'default'  => astra_get_option( 'single-product-related-display' ),
					'type'     => 'control',
					'section'  => 'section-woo-shop-single',
					'title'    => __( 'Display Related Products', 'astra-addon' ),
					'control'  => Astra_Theme_Extension::$switch_control,
					'priority' => 65,
					'divider'  => array( 'ast_class' => 'ast-section-spacing' ),
				),

				/**
				 * Option: Display Up Sells
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[single-product-up-sells-display]',
					'default'  => astra_get_option( 'single-product-up-sells-display' ),
					'type'     => 'control',
					'section'  => 'section-woo-shop-single',
					'title'    => __( 'Display Up Sells', 'astra-addon' ),
					'control'  => Astra_Theme_Extension::$switch_control,
					'priority' => 60,
				),

				/**
				 * Option: Related Product Columns
				 */
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[single-product-related-upsell-grid]',
					'default'           => astra_get_option(
						'single-product-related-upsell-grid',
						array(
							'desktop' => 4,
							'tablet'  => 3,
							'mobile'  => 2,
						)
					),
					'type'              => 'control',
					'transport'         => 'postMessage',
					'control'           => 'ast-responsive-slider',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_responsive_slider' ),
					'section'           => 'section-woo-shop-single',
					'context'           => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[single-product-related-display]',
							'operator' => '==',
							'value'    => true,
						),
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[single-product-up-sells-display]',
							'operator' => '==',
							'value'    => true,
						),
					),
					'priority'          => 70,
					'title'             => __( 'Columns', 'astra-addon' ),
					'input_attrs'       => array(
						'step' => 1,
						'min'  => 1,
						'max'  => 6,
					),
					'divider'           => array( 'ast_class' => 'ast-top-dotted-divider ast-bottom-dotted-divider' ),
				),

				/**
				 * Option: No. of Related Product
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[single-product-related-upsell-per-page]',
					'default'  => astra_get_option( 'single-product-related-upsell-per-page' ),
					'type'     => 'control',
					'section'  => 'section-woo-shop-single',
					'title'    => __( 'No. of Related Product', 'astra-addon' ),
					'context'  => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[single-product-related-display]',
							'operator' => '==',
							'value'    => true,
						),
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[single-product-up-sells-display]',
							'operator' => '==',
							'value'    => true,
						),
					),
					'control'  => 'number',
					'priority' => 75,
				),

				/**
				 * Option: Divider.
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[single-product-sticky-add-to-cart-divider]',
					'section'  => 'section-woo-shop-single',
					'title'    => __( 'Sticky Add To Cart', 'astra-addon' ),
					'type'     => 'control',
					'control'  => 'ast-heading',
					'priority' => 76,
					'settings' => array(),
					'divider'  => array( 'ast_class' => 'ast-section-spacing' ),
				),

				/**
				* Option: Sticky add to cart.
				*/
				array(
					'name'        => ASTRA_THEME_SETTINGS . '[single-product-sticky-add-to-cart]',
					'default'     => astra_get_option( 'single-product-sticky-add-to-cart' ),
					'type'        => 'control',
					'section'     => 'section-woo-shop-single',
					'title'       => __( 'Enable Sticky Add to Cart', 'astra-addon' ),
					'description' => __( 'This works for only desktop devices', 'astra-addon' ),
					'control'     => Astra_Theme_Extension::$switch_control,
					'priority'    => 76,
					'divider'     => array( 'ast_class' => 'ast-section-spacing' ),
				),

				/**
				 * Option: Sticky add to cart position.
				 */
				array(
					'name'       => ASTRA_THEME_SETTINGS . '[single-product-sticky-add-to-cart-position]',
					'default'    => astra_get_option( 'single-product-sticky-add-to-cart-position' ),
					'type'       => 'control',
					'control'    => Astra_Theme_Extension::$selector_control,
					'section'    => 'section-woo-shop-single',
					'priority'   => 76,
					'title'      => __( 'Sticky Placement ', 'astra-addon' ),
					'choices'    => array(
						'top'    => __( 'Top', 'astra-addon' ),
						'bottom' => __( 'Bottom', 'astra-addon' ),
					),
					'transport'  => 'postMessage',
					'renderAs'   => 'text',
					'responsive' => false,
					'context'    => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[single-product-sticky-add-to-cart]',
							'operator' => '==',
							'value'    => true,
						),
					),
					'divider'    => array( 'ast_class' => 'ast-top-dotted-divider' ),
				),

				/**
				 * Option: Divider.
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[woo-single-product-sticky-color-divider]',
					'section'  => 'section-woo-shop-single',
					'title'    => __( 'Sticky Add To Cart Colors', 'astra-addon' ),
					'type'     => 'control',
					'control'  => 'ast-heading',
					'priority' => 82,
					'settings' => array(),
					'context'  => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[single-product-sticky-add-to-cart]',
							'operator' => '==',
							'value'    => true,
						),
					),
					'divider'  => array( 'ast_class' => 'ast-section-spacing' ),
				),

				/**
				 * Option: Sticky add to cart text color.
				 */
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[single-product-sticky-add-to-cart-text-color]',
					'default'           => astra_get_option( 'single-product-sticky-add-to-cart-text-color' ),
					'type'              => 'control',
					'section'           => 'section-woo-shop-single',
					'control'           => 'ast-color',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
					'transport'         => 'postMessage',
					'title'             => __( 'Text Color', 'astra-addon' ),
					'context'           => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[single-product-sticky-add-to-cart]',
							'operator' => '==',
							'value'    => true,
						),
					),
					'priority'          => 82,
					'divider'           => array( 'ast_class' => 'ast-section-spacing' ),
				),

				/**
				 * Option: Sticky add to cart background color.
				 */
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[single-product-sticky-add-to-cart-bg-color]',
					'default'           => astra_get_option( 'single-product-sticky-add-to-cart-bg-color' ),
					'type'              => 'control',
					'section'           => 'section-woo-shop-single',
					'control'           => 'ast-color',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
					'transport'         => 'postMessage',
					'title'             => __( 'Background Color', 'astra-addon' ),
					'context'           => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[single-product-sticky-add-to-cart]',
							'operator' => '==',
							'value'    => true,
						),
					),
					'priority'          => 82,
				),

				/**
				* Option: Sticky add to cart button text color.
				*/
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[single-product-sticky-add-to-cart-btn-color]',
					'default'   => astra_get_option( 'single-product-sticky-add-to-cart-btn-color' ),
					'type'      => 'control',
					'control'   => Astra_Theme_Extension::$group_control,
					'title'     => __( 'Button Text', 'astra-addon' ),
					'section'   => 'section-woo-shop-single',
					'transport' => 'postMessage',
					'priority'  => 82,
					'context'   => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[single-product-sticky-add-to-cart]',
							'operator' => '==',
							'value'    => true,
						),
					),
				),

				// Option: Link Color.
				array(
					'type'     => 'sub-control',
					'priority' => 76,
					'parent'   => ASTRA_THEME_SETTINGS . '[single-product-sticky-add-to-cart-btn-color]',
					'section'  => 'section-woo-shop-single',
					'control'  => 'ast-color',
					'default'  => astra_get_option( 'single-product-sticky-add-to-cart-btn-n-color' ),
					'name'     => 'single-product-sticky-add-to-cart-btn-n-color',
					'title'    => __( 'Normal', 'astra-addon' ),
					'tab'      => __( 'Normal', 'astra-addon' ),
				),

				// Option: Link Hover Color.
				array(
					'type'              => 'sub-control',
					'priority'          => 82,
					'parent'            => ASTRA_THEME_SETTINGS . '[single-product-sticky-add-to-cart-btn-color]',
					'section'           => 'section-woo-shop-single',
					'control'           => 'ast-color',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
					'default'           => astra_get_option( 'single-product-sticky-add-to-cart-btn-h-color' ),
					'transport'         => 'postMessage',
					'name'              => 'single-product-sticky-add-to-cart-btn-h-color',
					'title'             => __( 'Hover', 'astra-addon' ),
					'tab'               => __( 'Hover', 'astra-addon' ),
				),

				/**
				 * Option: Sticky add to cart button background color.
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[single-product-sticky-add-to-cart-btn-bg-color]',
					'default'   => astra_get_option( 'single-product-sticky-add-to-cart-btn-bg-color' ),
					'type'      => 'control',
					'control'   => Astra_Theme_Extension::$group_control,
					'title'     => __( 'Button Background', 'astra-addon' ),
					'section'   => 'section-woo-shop-single',
					'transport' => 'postMessage',
					'priority'  => 82,
					'context'   => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[single-product-sticky-add-to-cart]',
							'operator' => '==',
							'value'    => true,
						),
					),
				),

				// Option: Link Color.
				array(
					'type'     => 'sub-control',
					'priority' => 82,
					'parent'   => ASTRA_THEME_SETTINGS . '[single-product-sticky-add-to-cart-btn-bg-color]',
					'section'  => 'section-woo-shop-single',
					'control'  => 'ast-color',
					'default'  => astra_get_option( 'single-product-sticky-add-to-cart-btn-bg-n-color' ),
					'name'     => 'single-product-sticky-add-to-cart-btn-bg-n-color',
					'title'    => __( 'Normal', 'astra-addon' ),
					'tab'      => __( 'Normal', 'astra-addon' ),
				),

				// Option: Link Hover Color.
				array(
					'type'              => 'sub-control',
					'priority'          => 82,
					'parent'            => ASTRA_THEME_SETTINGS . '[single-product-sticky-add-to-cart-btn-bg-color]',
					'section'           => 'section-woo-shop-single',
					'control'           => 'ast-color',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
					'default'           => astra_get_option( 'single-product-sticky-add-to-cart-btn-bg-h-color' ),
					'transport'         => 'postMessage',
					'name'              => 'single-product-sticky-add-to-cart-btn-bg-h-color',
					'title'             => __( 'Hover', 'astra-addon' ),
					'tab'               => __( 'Hover', 'astra-addon' ),
				),
			);

			/**
			 * Single product add to cart.
			 */

			$_configs[] = array(
				'name'        => 'single-product-ajax-add-to-cart',
				'parent'      => ASTRA_THEME_SETTINGS . '[single-product-structure]',
				'default'     => astra_get_option( 'single-product-ajax-add-to-cart' ),
				'linked'      => 'add_cart',
				'type'        => 'sub-control',
				'control'     => 'ast-toggle',
				'section'     => 'section-woo-shop-single',
				'priority'    => 10,
				'title'       => __( 'Real-Time Add To Cart', 'astra-addon' ),
				'description' => __( 'Enables users to add to cart without refreshing the page', 'astra-addon' ),
				'transport'   => 'postMessage',
			);

			/**
			 * Single product payment sub control Visa.
			 */
			$_configs[] = array(
				'name'      => 'single-product-payment-visa',
				'parent'    => ASTRA_THEME_SETTINGS . '[single-product-structure]',
				'default'   => astra_get_option( 'single-product-payment-visa' ),
				'linked'    => 'single-product-payments',
				'type'      => 'sub-control',
				'control'   => 'ast-toggle',
				'section'   => 'section-woo-shop-single',
				'priority'  => 10,
				'title'     => __( 'Show Visa', 'astra-addon' ),
				'transport' => 'postMessage',
			);

			/**
			 * Single product payment sub control MasterCard.
			 */
			$_configs[] = array(
				'name'      => 'single-product-payment-mastercard',
				'parent'    => ASTRA_THEME_SETTINGS . '[single-product-structure]',
				'default'   => astra_get_option( 'single-product-payment-mastercard' ),
				'linked'    => 'single-product-payments',
				'type'      => 'sub-control',
				'control'   => 'ast-toggle',
				'section'   => 'section-woo-shop-single',
				'priority'  => 10,
				'title'     => __( 'Show MasterCard', 'astra-addon' ),
				'transport' => 'postMessage',
			);

			/**
			 * Single product payment sub control Amex.
			 */
			$_configs[] = array(
				'name'      => 'single-product-payment-amex',
				'parent'    => ASTRA_THEME_SETTINGS . '[single-product-structure]',
				'default'   => astra_get_option( 'single-product-payment-amex' ),
				'linked'    => 'single-product-payments',
				'type'      => 'sub-control',
				'control'   => 'ast-toggle',
				'section'   => 'section-woo-shop-single',
				'priority'  => 10,
				'title'     => __( 'Show Amex', 'astra-addon' ),
				'transport' => 'postMessage',
			);

			/**
			 * Single product payment sub control Discover.
			 */
			$_configs[] = array(
				'name'      => 'single-product-payment-discover',
				'parent'    => ASTRA_THEME_SETTINGS . '[single-product-structure]',
				'default'   => astra_get_option( 'single-product-payment-discover' ),
				'linked'    => 'single-product-payments',
				'type'      => 'sub-control',
				'control'   => 'ast-toggle',
				'section'   => 'section-woo-shop-single',
				'priority'  => 10,
				'title'     => __( 'Show Discover', 'astra-addon' ),
				'transport' => 'postMessage',
			);

			/**
			 * Single product payment sub control Paypal.
			 */
			$_configs[] = array(
				'name'      => 'single-product-payment-paypal',
				'parent'    => ASTRA_THEME_SETTINGS . '[single-product-structure]',
				'default'   => astra_get_option( 'single-product-payment-paypal' ),
				'linked'    => 'single-product-payments',
				'type'      => 'sub-control',
				'control'   => 'ast-toggle',
				'section'   => 'section-woo-shop-single',
				'priority'  => 10,
				'title'     => __( 'Show Paypal', 'astra-addon' ),
				'transport' => 'postMessage',
			);

			/**
			 * Single product payment sub control Apple Pay.
			 */
			$_configs[] = array(
				'name'      => 'single-product-payment-apple-pay',
				'parent'    => ASTRA_THEME_SETTINGS . '[single-product-structure]',
				'default'   => astra_get_option( 'single-product-payment-apple-pay' ),
				'linked'    => 'single-product-payments',
				'type'      => 'sub-control',
				'control'   => 'ast-toggle',
				'section'   => 'section-woo-shop-single',
				'priority'  => 10,
				'title'     => __( 'Show Apple Pay', 'astra-addon' ),
				'transport' => 'postMessage',
			);

			/**
			 * Single product payment icon color style.
			 */
			$_configs[] = array(
				'name'       => 'single-product-payment-icon-color',
				'parent'     => ASTRA_THEME_SETTINGS . '[single-product-structure]',
				'default'    => astra_get_option( 'single-product-payment-icon-color' ),
				'linked'     => 'single-product-payments',
				'type'       => 'sub-control',
				'control'    => 'ast-selector',
				'section'    => 'section-woo-shop-single',
				'priority'   => 5,
				'title'      => __( 'Choose Icon Colors', 'astra-addon' ),
				'choices'    => array(
					'inherit'            => __( 'Default', 'astra-addon' ),
					'inherit_text_color' => __( 'Grayscale', 'astra-addon' ),
				),
				'transport'  => 'postMessage',
				'responsive' => false,
				'renderAs'   => 'text',
			);

			/**
			 * Single product payment heading text.
			 */
			$_configs[] = array(
				'name'      => 'single-product-payment-text',
				'parent'    => ASTRA_THEME_SETTINGS . '[single-product-structure]',
				'default'   => astra_get_option( 'single-product-payment-text' ),
				'linked'    => 'single-product-payments',
				'type'      => 'sub-control',
				'control'   => 'ast-text-input',
				'section'   => 'section-woo-shop-single',
				'priority'  => 5,
				'transport' => 'postMessage',
				'title'     => __( 'Payment Title', 'astra-addon' ),
				'settings'  => array(),
			);

				/**
				 * Single product extras heading text.
				 */
				$_configs[] = array(
					'name'      => 'single-product-extras-text',
					'parent'    => ASTRA_THEME_SETTINGS . '[single-product-structure]',
					'default'   => astra_get_option( 'single-product-extras-text' ),
					'linked'    => 'summary-extras',
					'type'      => 'sub-control',
					'control'   => 'ast-text-input',
					'section'   => 'section-woo-shop-single',
					'priority'  => 5,
					'transport' => 'postMessage',
					'title'     => 'Extras Title',
					'settings'  => array(),
				);

				/**
				 * Single product extras list.
				 */
				$_configs[] = array(
					'name'     => 'single-product-extras-list',
					'parent'   => ASTRA_THEME_SETTINGS . '[single-product-structure]',
					'default'  => astra_get_option( 'single-product-extras-list' ),
					'linked'   => 'summary-extras',
					'type'     => 'sub-control',
					'control'  => 'ast-list-icons',
					'section'  => 'section-woo-shop-single',
					'priority' => 10,
					'divider'  => array( 'ast_class' => 'ast-bottom-divider' ),
				);

				$configurations = array_merge( $configurations, $_configs );

				return $configurations;

		}
	}
}

new Astra_Woocommerce_Shop_Single_Configs();
