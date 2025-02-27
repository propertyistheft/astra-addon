<?php
/**
 * Shop Options for our theme.
 *
 * @package     Astra Addon
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

			/**
			 * Condition to check if the user is new or old and display product layout choices accordiongly.
			 */

			if ( astra_get_option( 'astra-product-gallery-layout-flag' ) ) {
				$single_product_layout = array(
					'first-image-large' => array(
						'label' => __( 'First Image Large', 'astra-addon' ),
						'path'  => class_exists( 'Astra_Builder_UI_Controller' ) ? Astra_Builder_UI_Controller::fetch_svg_icon( 'first-image-large', false ) : '',
					),
					'vertical-slider'   => array(
						'label' => __( 'Vertical Slider', 'astra-addon' ),
						'path'  => class_exists( 'Astra_Builder_UI_Controller' ) ? Astra_Builder_UI_Controller::fetch_svg_icon( 'vertical-slider', false ) : '',
					),
					'horizontal-slider' => array(
						'label' => __( 'Horizontal Slider', 'astra-addon' ),
						'path'  => class_exists( 'Astra_Builder_UI_Controller' ) ? Astra_Builder_UI_Controller::fetch_svg_icon( 'horizontal-slider', false ) : '',
					),
				);
			} else {
				$single_product_layout = array(
					'vertical'          => array(
						'label' => __( 'Vertical', 'astra-addon' ),
						'path'  => class_exists( 'Astra_Builder_UI_Controller' ) ? Astra_Builder_UI_Controller::fetch_svg_icon( 'vertical-slider', false ) : '',
					),
					'horizontal'        => array(
						'label' => __( 'Horizontal', 'astra-addon' ),
						'path'  => class_exists( 'Astra_Builder_UI_Controller' ) ? Astra_Builder_UI_Controller::fetch_svg_icon( 'horizontal-slider', false ) : '',
					),
					'first-image-large' => array(
						'label' => __( 'First Image Large', 'astra-addon' ),
						'path'  => class_exists( 'Astra_Builder_UI_Controller' ) ? Astra_Builder_UI_Controller::fetch_svg_icon( 'first-image-large', false ) : '',
					),
					'vertical-slider'   => array(
						'label' => __( 'Vertical Slider', 'astra-addon' ),
						'path'  => class_exists( 'Astra_Builder_UI_Controller' ) ? Astra_Builder_UI_Controller::fetch_svg_icon( 'vertical-slider', false ) : '',
					),
					'horizontal-slider' => array(
						'label' => __( 'Horizontal Slider', 'astra-addon' ),
						'path'  => class_exists( 'Astra_Builder_UI_Controller' ) ? Astra_Builder_UI_Controller::fetch_svg_icon( 'horizontal-slider', false ) : '',
					),
				);
			}

			$_configs = array(

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
				 * Option: Handles Single Product Sticky Product Image.
				 *
				 * @since 4.6.5
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[single-product-sticky-product-image]',
					'default'  => astra_get_option( 'single-product-sticky-product-image' ),
					'type'     => 'control',
					'section'  => 'section-woo-shop-single',
					'title'    => __( 'Enable Sticky Product Image', 'astra-addon' ),
					'priority' => 5,
					'control'  => Astra_Theme_Extension::$switch_control,
					'divider'  => array( 'ast_class' => 'ast-top-dotted-divider' ),
				),

				/**
				 * Option: Sticky Image Top Offset.
				 *
				 * @since 4.6.5
				 */
				array(
					'name'        => ASTRA_THEME_SETTINGS . '[single-product-sticky-product-image-top-offset]',
					'default'     => astra_get_option( 'single-product-sticky-product-image-top-offset' ),
					'type'        => 'control',
					'transport'   => 'postMessage',
					'control'     => 'ast-slider',
					'section'     => 'section-woo-shop-single',
					'title'       => __( 'Sticky Image Top Offset', 'astra-addon' ),
					'suffix'      => 'px',
					'priority'    => 5,
					'input_attrs' => array(
						'min'  => 0,
						'step' => 1,
						'max'  => 500,
					),
					'context'     => array(
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[single-product-sticky-product-image]',
							'operator' => '==',
							'value'    => true,
						),
					),
					'divider'     => array( 'ast_class' => 'ast-top-dotted-divider' ),
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
				 * Option: Enable product sticky summary.
				 */
				array(
					'name'        => ASTRA_THEME_SETTINGS . '[single-product-sticky-summary]',
					'default'     => astra_get_option( 'single-product-sticky-summary' ),
					'type'        => 'control',
					'section'     => 'section-woo-shop-single',
					'title'       => __( 'Sticky Product Summary', 'astra-addon' ),
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
					'divider'  => array( 'ast_class' => 'ast-section-spacing' ),
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
					'divider'           => array( 'ast_class' => 'ast-top-dotted-divider' ),
				),

				/**
				 * Option: Divider.
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[woo-single-product-tab-color-divider]',
					'section'  => 'section-woo-shop-single',
					'title'    => __( 'Description Colors', 'astra-addon' ),
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
					'title'    => __( 'Related, Recent & Up Sell', 'astra-addon' ),
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
				),

				/**
				 * Option: Display recently products
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[single-product-recently-viewed-display]',
					'default'  => astra_get_option( 'single-product-recently-viewed-display' ),
					'type'     => 'control',
					'section'  => 'section-woo-shop-single',
					'title'    => __( 'Recently Viewed Products', 'astra-addon' ),
					'control'  => Astra_Theme_Extension::$switch_control,
					'priority' => 65,
				),

				/**
				 * Option: Recently viewed products text
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[single-product-recently-viewed-text]',
					'default'  => astra_get_option( 'single-product-recently-viewed-text' ),
					'type'     => 'control',
					'section'  => 'section-woo-shop-single',
					'title'    => __( 'Recently Viewed Products Text', 'astra-addon' ),
					'context'  => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[single-product-recently-viewed-display]',
							'operator' => '==',
							'value'    => true,
						),
					),
					'control'  => 'text',
					'priority' => 65,
					'divider'  => array( 'ast_class' => 'ast-bottom-spacing' ),
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
						'relation' => 'AND',
						array(
							'relation' => 'OR',
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
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[single-product-recently-viewed-display]',
								'operator' => '==',
								'value'    => true,
							),
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
				 * Option: No. of Related / Recently Viewed Products.
				 */
				array(
					'name'        => ASTRA_THEME_SETTINGS . '[single-product-related-upsell-per-page]',
					'default'     => astra_get_option( 'single-product-related-upsell-per-page' ),
					'type'        => 'control',
					'control'     => 'ast-slider',
					'section'     => 'section-woo-shop-single',
					'title'       => __( 'No. of Products', 'astra-addon' ),
					'priority'    => 75,
					'input_attrs' => array(
						'min'  => 1,
						'step' => 1,
						'max'  => 20,
					),
					'context'     => array(
						astra_addon_builder_helper()->general_tab_config,
						'relation' => 'AND',
						array(
							'relation' => 'OR',
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
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[single-product-recently-viewed-display]',
								'operator' => '==',
								'value'    => true,
							),
						),
					),
				),

			);

			/**
			 * Option: Single product Add to cart action.
			 */
			$_configs[] = array(
				'name'       => 'single-product-add-to-cart-action',
				'parent'     => ASTRA_THEME_SETTINGS . '[single-product-structure]',
				'default'    => astra_get_option( 'single-product-add-to-cart-action' ),
				'section'    => 'section-woo-shop-single',
				'title'      => __( 'Add To Cart Action', 'astra-addon' ),
				'type'       => 'sub-control',
				'control'    => 'ast-select',
				'linked'     => 'add_cart',
				'priority'   => 10,
				'choices'    => array(
					'default'                => __( 'Default', 'astra-addon' ),
					'rt_add_to_cart'         => __( 'Real Time Add To Cart', 'astra-addon' ),
					'slide_in_cart'          => __( 'Slide In Cart', 'astra-addon' ),
					'redirect_cart_page'     => __( 'Redirect To Cart Page', 'astra-addon' ),
					'redirect_checkout_page' => __( 'Redirect To Checkout Page', 'astra-addon' ),
				),
				'responsive' => false,
				'renderAs'   => 'text',
				'transport'  => 'postMessage',
			);

			/**
			 * Option: Single product Add to cart action notice.
			 */
			$_configs[] = array(
				'name'     => 'single-product-add-to-cart-action-notice',
				'parent'   => ASTRA_THEME_SETTINGS . '[single-product-structure]',
				'type'     => 'sub-control',
				'control'  => 'ast-description',
				'section'  => 'section-woo-shop-single',
				'priority' => 10,
				'label'    => '',
				'linked'   => 'add_cart',
				'help'     => __( 'Please save and see changes in frontend.<br />[Slide in cart requires Cart added inside Header Builder]', 'astra-addon' ),
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

			return array_merge( $configurations, $_configs );
		}
	}
}

new Astra_Woocommerce_Shop_Single_Configs();
