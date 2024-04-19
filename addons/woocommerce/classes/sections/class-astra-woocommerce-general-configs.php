<?php
/**
 * Woocommerce General Options for our theme.
 *
 * @package     Astra
 * @link        https://wpastra.com/
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

if ( ! class_exists( 'Astra_Woocommerce_General_Configs' ) ) {

	/**
	 * Register Woocommerce General Layout Configurations.
	 */
	// @codingStandardsIgnoreStart
	class Astra_Woocommerce_General_Configs extends Astra_Customizer_Config_Base {
 // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedClassFound
		// @codingStandardsIgnoreEnd

		/**
		 * Register Woocommerce General Layout Configurations.
		 *
		 * @param Array                $configurations Astra Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array Astra Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_section = ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) ? 'section-header-woo-cart' : 'section-woo-shop-cart';

			$context = ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) ? astra_addon_builder_helper()->design_tab : astra_addon_builder_helper()->general_tab;

			$_configs = array(

				/**
				 * Option: Woocommerce input styles.
				 */

				array(
					'name'        => ASTRA_THEME_SETTINGS . '[woo-input-style-type]',
					'default'     => astra_get_option( 'woo-input-style-type' ),
					'section'     => 'section-woo-misc',
					'type'        => 'control',
					'control'     => 'ast-selector',
					'title'       => __( 'Input Field Style', 'astra-addon' ),
					'priority'    => 15,
					'description' => __( 'Change input field style for all Woocommerce pages.', 'astra-addon' ),
					'choices'     => array(
						'default' => __( 'Default', 'astra-addon' ),
						'modern'  => __( 'Modern', 'astra-addon' ),
					),
					'transport'   => 'refresh',
					'renderAs'    => 'text',
					'responsive'  => false,
					'divider'     => array( 'ast_class' => 'ast-section-spacing' ),
				),

				/**
				 * Option: Sale Notifications Divider.
				 */
				array(
					'name'        => ASTRA_THEME_SETTINGS . '[woo-sale-notification-divider]',
					'section'     => 'section-woo-misc',
					'title'       => __( 'Sale Notifications', 'astra-addon' ),
					'type'        => 'control',
					'control'     => 'ast-heading',
					'description' => '',
					'priority'    => 15,
					'settings'    => array(),
					'divider'     => array( 'ast_class' => 'ast-section-spacing' ),
				),

				/**
				 * Option: Sale Notification
				 */
				array(
					'name'        => ASTRA_THEME_SETTINGS . '[product-sale-notification]',
					'default'     => astra_get_option( 'product-sale-notification' ),
					'type'        => 'control',
					'section'     => 'section-woo-misc',
					'title'       => __( 'Sale Notification', 'astra-addon' ),
					'control'     => 'ast-selector',
					'priority'    => 15,
					'description' => __( 'Change sale badge ui for all products.', 'astra-addon' ),
					'choices'     => array(
						'none'            => __( 'None', 'astra-addon' ),
						'default'         => __( 'Default', 'astra-addon' ),
						'sale-percentage' => __( 'Custom String', 'astra-addon' ),
					),
					'transport'   => 'refresh',
					'renderAs'    => 'text',
					'responsive'  => false,
					'divider'     => array( 'ast_class' => 'ast-section-spacing' ),
				),

				/**
				 * Option: Divider.
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[single-product-plus-minus-button-divider]',
					'section'  => 'section-woo-misc',
					'title'    => __( 'Quantity Plus and Minus', 'astra-addon' ),
					'type'     => 'control',
					'control'  => 'ast-heading',
					'priority' => 58,
					'settings' => array(),
					'divider'  => array( 'ast_class' => 'ast-section-spacing' ),
				),

				/**
				 * Option: Add to cart Plus Minus Button Option.
				 */
				array(
					'name'       => ASTRA_THEME_SETTINGS . '[cart-plus-minus-button-type]',
					'default'    => astra_get_option( 'cart-plus-minus-button-type' ),
					'section'    => 'section-woo-misc',
					'type'       => 'control',
					'control'    => 'ast-selector',
					'title'      => __( 'Quantity Plus Minus Button', 'astra-addon' ),
					'priority'   => 59,
					'choices'    => array(
						'normal'             => __( 'Normal', 'astra-addon' ),
						'no-internal-border' => __( 'Merged', 'astra-addon' ),
						'vertical-icon'      => __( 'Vertical', 'astra-addon' ),
					),
					'transport'  => 'refresh',
					'renderAs'   => 'text',
					'responsive' => false,
					'context'    => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[single-product-plus-minus-button]',
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
					'name'     => ASTRA_THEME_SETTINGS . '[woo-single-product-quantity-color-divider]',
					'section'  => 'section-woo-misc',
					'title'    => __( 'Quantity Colors', 'astra-addon' ),
					'type'     => 'control',
					'control'  => 'ast-heading',
					'priority' => 59,
					'settings' => array(),
					'context'  => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[single-product-plus-minus-button]',
							'operator' => '==',
							'value'    => true,
						),
					),
					'divider'  => array( 'ast_class' => 'ast-section-spacing' ),
				),

				/**
				 * Quantity Plus Minus Button (Text Colors)
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[plusminus-text-color]',
					'default'   => astra_get_option( 'plusminus-text-color' ),
					'type'      => 'control',
					'control'   => 'ast-color-group',
					'title'     => __( 'Text Color', 'astra-addon' ),
					'section'   => 'section-woo-misc',
					'transport' => 'postMessage',
					'priority'  => 59,
					'context'   => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[single-product-plus-minus-button]',
							'operator' => '==',
							'value'    => true,
						),
					),
					'divider'   => array( 'ast_class' => 'ast-section-spacing' ),
				),
				array(
					'name'       => 'plusminus-text-normal-color',
					'default'    => astra_get_option( 'plusminus-text-normal-color' ),
					'type'       => 'sub-control',
					'priority'   => 59,
					'parent'     => ASTRA_THEME_SETTINGS . '[plusminus-text-color]',
					'section'    => 'section-woo-misc',
					'control'    => 'ast-responsive-color',
					'transport'  => 'postMessage',
					'title'      => __( 'Normal', 'astra-addon' ),
					'responsive' => true,
					'rgba'       => true,
				),
				array(
					'name'       => 'plusminus-text-hover-color',
					'default'    => astra_get_option( 'plusminus-text-hover-color' ),
					'type'       => 'sub-control',
					'priority'   => 59,
					'parent'     => ASTRA_THEME_SETTINGS . '[plusminus-text-color]',
					'section'    => 'section-woo-misc',
					'control'    => 'ast-responsive-color',
					'transport'  => 'postMessage',
					'title'      => __( 'Hover', 'astra-addon' ),
					'responsive' => true,
					'rgba'       => true,
				),

				/**
				 * Quantity Plus Minus Button (Background Colors)
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[plusminus-background-color]',
					'default'   => astra_get_option( 'plusminus-background-color' ),
					'type'      => 'control',
					'control'   => 'ast-color-group',
					'title'     => __( 'Background Color', 'astra-addon' ),
					'section'   => 'section-woo-misc',
					'transport' => 'postMessage',
					'priority'  => 59,
					'context'   => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[single-product-plus-minus-button]',
							'operator' => '==',
							'value'    => true,
						),
					),
				),

				array(
					'name'       => 'plusminus-background-normal-color',
					'default'    => astra_get_option( 'plusminus-background-normal-color' ),
					'type'       => 'sub-control',
					'priority'   => 59,
					'parent'     => ASTRA_THEME_SETTINGS . '[plusminus-background-color]',
					'section'    => 'section-woo-misc',
					'control'    => 'ast-responsive-color',
					'transport'  => 'postMessage',
					'title'      => __( 'Normal', 'astra-addon' ),
					'responsive' => true,
					'rgba'       => true,
				),
				array(
					'name'       => 'plusminus-background-hover-color',
					'default'    => astra_get_option( 'plusminus-background-hover-color' ),
					'type'       => 'sub-control',
					'priority'   => 59,
					'parent'     => ASTRA_THEME_SETTINGS . '[plusminus-background-color]',
					'section'    => 'section-woo-misc',
					'control'    => 'ast-responsive-color',
					'transport'  => 'postMessage',
					'title'      => __( 'Hover', 'astra-addon' ),
					'responsive' => true,
					'rgba'       => true,
				),

				/**
				 * Option: Divider.
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[cart-multistep-checkout-divider]',
					'section'  => 'section-woo-misc',
					'title'    => __( 'Steps Navigation', 'astra-addon' ),
					'type'     => 'control',
					'control'  => 'ast-heading',
					'priority' => 59,
					'settings' => array(),
					'divider'  => array( 'ast_class' => 'ast-section-spacing' ),
				),

				/**
				 * Option: Steps Navigation.
				 */
				array(
					'name'        => ASTRA_THEME_SETTINGS . '[cart-multistep-checkout]',
					'default'     => astra_get_option( 'cart-multistep-checkout' ),
					'type'        => 'control',
					'section'     => 'section-woo-misc',
					'title'       => __( 'Enable Steps Navigation', 'astra-addon' ),
					'description' => __( 'Display steps navigation at top of the cart, checkout & thank you page.', 'astra-addon' ),
					'priority'    => 59,
					'control'     => Astra_Theme_Extension::$switch_control,
					'divider'     => array( 'ast_class' => 'ast-section-spacing' ),
				),

				/**
				 * Option: Step Numbers.
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[cart-multistep-steps-numbers]',
					'default'  => astra_get_option( 'cart-multistep-steps-numbers' ),
					'type'     => 'control',
					'section'  => 'section-woo-misc',
					'title'    => __( 'Enable Step Number', 'astra-addon' ),
					'priority' => 59,
					'control'  => Astra_Theme_Extension::$switch_control,
					'context'  => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[cart-multistep-checkout]',
							'operator' => '==',
							'value'    => true,
						),
					),
				),

				/**
				 * Option: Divider.
				 */

				array(
					'name'     => ASTRA_THEME_SETTINGS . '[woo-general-design-steps-divider]',
					'section'  => 'section-woo-misc',
					'title'    => __( 'Steps Navigation Styling', 'astra-addon' ),
					'type'     => 'control',
					'control'  => 'ast-heading',
					'priority' => 59,
					'settings' => array(),
					'context'  => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[cart-multistep-checkout]',
							'operator' => '==',
							'value'    => true,
						),
					),
					'divider'  => array( 'ast_class' => 'ast-section-spacing' ),
				),

				/**
				 * Option: Multistep Checkout Sizes.
				 */

				array(
					'name'       => ASTRA_THEME_SETTINGS . '[cart-multistep-checkout-size]',
					'default'    => astra_get_option( 'cart-multistep-checkout-size' ),
					'section'    => 'section-woo-misc',
					'type'       => 'control',
					'control'    => 'ast-selector',
					'title'      => __( 'Steps Size', 'astra-addon' ),
					'priority'   => 59,
					'choices'    => array(
						'default' => __( 'Default', 'astra-addon' ),
						'small'   => __( 'Small', 'astra-addon' ),
						'smaller' => __( 'Smaller', 'astra-addon' ),
					),
					'transport'  => 'refresh',
					'renderAs'   => 'text',
					'responsive' => false,
					'context'    => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[cart-multistep-checkout]',
							'operator' => '==',
							'value'    => true,
						),
					),
					'divider'    => array( 'ast_class' => 'ast-section-spacing' ),
				),

				/**
				 * Option: Multistep Checkout Sizes.
				 */

				array(
					'name'       => ASTRA_THEME_SETTINGS . '[cart-multistep-checkout-font-case]',
					'default'    => astra_get_option( 'cart-multistep-checkout-font-case' ),
					'section'    => 'section-woo-misc',
					'type'       => 'control',
					'control'    => 'ast-selector',
					'title'      => __( 'Steps Font Case', 'astra-addon' ),
					'priority'   => 59,
					'choices'    => array(
						'normal'    => __( 'Default', 'astra-addon' ),
						'uppercase' => __( 'Uppercase', 'astra-addon' ),
					),
					'transport'  => 'refresh',
					'renderAs'   => 'text',
					'responsive' => false,
					'context'    => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[cart-multistep-checkout]',
							'operator' => '==',
							'value'    => true,
						),
					),
					'divider'    => array( 'ast_class' => 'ast-top-dotted-divider' ),
				),

				/**
				 * Option: Sale Percentage Input
				 */
				array(
					'name'        => ASTRA_THEME_SETTINGS . '[product-sale-percent-value]',
					'default'     => astra_get_option( 'product-sale-percent-value' ),
					'type'        => 'control',
					'section'     => 'section-woo-misc',
					'title'       => __( 'Sale % Value', 'astra-addon' ),
					'description' => __( 'Display custom value for sale badge notification. You can use [value] shortcode to display sale percentage.', 'astra-addon' ),
					'context'     => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[product-sale-notification]',
							'operator' => '==',
							'value'    => 'sale-percentage',
						),
					),
					'control'     => 'text',
					'priority'    => 20,
					'input_attrs' => array(
						'placeholder' => astra_get_option( 'product-sale-percent-value' ),
					),
					'divider'     => array( 'ast_class' => 'ast-top-dotted-divider' ),
				),

				/**
				 * Option: Sale Bubble Shape
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[product-sale-style]',
					'default'   => astra_get_option( 'product-sale-style' ),
					'type'      => 'control',
					'transport' => 'postMessage',
					'section'   => 'section-woo-misc',
					'title'     => __( 'Sale Bubble Style', 'astra-addon' ),
					'context'   => array(
						astra_addon_builder_helper()->general_tab_config,
						'relation' => 'AND',
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[product-sale-notification]',
							'operator' => 'in',
							'value'    => array( 'sale-percentage', 'default' ),
						),
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[shop-style]',
							'operator' => '!=',
							'value'    => 'shop-page-modern-style',
						),
					),
					'control'   => 'ast-select',
					'priority'  => 25,
					'choices'   => array(
						'circle'         => __( 'Circle', 'astra-addon' ),
						'circle-outline' => __( 'Circle Outline', 'astra-addon' ),
						'square'         => __( 'Square', 'astra-addon' ),
						'square-outline' => __( 'Square Outline', 'astra-addon' ),
					),
					'divider'   => array( 'ast_class' => 'ast-top-dotted-divider' ),
				),

				/**
				 * Option: Enable sale border radius.
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[woo-enable-sale-border-radius]',
					'default'  => astra_get_option( 'woo-enable-sale-border-radius' ),
					'type'     => 'control',
					'section'  => 'section-woo-misc',
					'title'    => __( 'Enable Custom Border Radius ', 'astra-addon' ),
					'priority' => 25,
					'control'  => Astra_Theme_Extension::$switch_control,
					'divider'  => array( 'ast_class' => 'ast-top-section-divider' ),
					'context'  => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[product-sale-notification]',
							'operator' => '!=',
							'value'    => 'none',
						),
					),
					'divider'  => array( 'ast_class' => 'ast-top-dotted-divider' ),
				),

				/**
				 * Option: Sale Badge Border Radius
				 */
				array(
					'name'        => ASTRA_THEME_SETTINGS . '[woo-sale-border-radius]',
					'default'     => astra_get_option( 'woo-sale-border-radius' ),
					'type'        => 'control',
					'transport'   => 'postMessage',
					'control'     => 'ast-slider',
					'section'     => 'section-woo-misc',
					'title'       => __( 'Border Radius', 'astra-addon' ),
					'suffix'      => 'px',
					'priority'    => 25,
					'input_attrs' => array(
						'min'  => 0,
						'step' => 1,
						'max'  => 50,
					),
					'context'     => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[woo-enable-sale-border-radius]',
							'operator' => '==',
							'value'    => true,
						),
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[product-sale-notification]',
							'operator' => '!=',
							'value'    => 'none',
						),
					),
					'divider'     => array( 'ast_class' => 'ast-top-dotted-divider' ),
				),

				/**
				 * Option: Sale Notifications Divider.
				 */
				array(
					'name'        => ASTRA_THEME_SETTINGS . '[woo-general-design-divider]',
					'section'     => 'section-woo-misc',
					'title'       => __( 'General Colors', 'astra-addon' ),
					'type'        => 'control',
					'control'     => 'ast-heading',
					'description' => '',
					'priority'    => 23,
					'settings'    => array(),
					'context'     => array(
						astra_addon_builder_helper()->design_tab_config,
					),
				),

				/**
				 * Option: Sale Bubble colors section
				 */

				array(
					'name'       => ASTRA_THEME_SETTINGS . '[product-sale-colors]',
					'default'    => astra_get_option( 'product-sale-colors' ),
					'type'       => 'control',
					'section'    => 'section-woo-misc',
					'title'      => __( 'Sale Badge Color', 'astra-addon' ),
					'context'    => array(
						astra_addon_builder_helper()->design_tab_config,
						'relation' => 'AND',
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[product-sale-notification]',
							'operator' => 'in',
							'value'    => array( 'sale-percentage', 'default' ),
						),
					),
					'control'    => 'ast-color-group',
					'priority'   => 25,
					'responsive' => false,
				),

				/**
				 * Option: Sale Bubble normal color.
				 */

				array(
					'type'       => 'sub-control',
					'parent'     => ASTRA_THEME_SETTINGS . '[product-sale-colors]',
					'control'    => 'ast-responsive-color',
					'transport'  => 'postMessage',
					'section'    => 'section-woo-misc',
					'name'       => 'product-sale-color',
					'default'    => astra_get_option( 'product-sale-color' ),
					'title'      => __( 'Text', 'astra-addon' ),
					'responsive' => false,
					'rgba'       => true,
					'priority'   => 25,
					'context'    => array(
						astra_addon_builder_helper()->general_tab_config,
					),
				),

				/**
				 * Option: Sale Bubble background color section.
				 */
				array(
					'type'       => 'sub-control',
					'parent'     => ASTRA_THEME_SETTINGS . '[product-sale-colors]',
					'control'    => 'ast-responsive-color',
					'transport'  => 'postMessage',
					'section'    => 'section-woo-misc',
					'name'       => 'product-sale-bg-color',
					'default'    => astra_get_option( 'product-sale-bg-color' ),
					'title'      => __( 'Background', 'astra-addon' ),
					'responsive' => false,
					'rgba'       => true,
					'priority'   => 25,
					'context'    => array(
						astra_addon_builder_helper()->general_tab_config,
					),
				),

				/**
				* Option: Woo cart empty featured product
				*/
				array(
					'name'        => ASTRA_THEME_SETTINGS . '[woo-cart-empty-featured-product]',
					'default'     => astra_get_option( 'woo-cart-empty-featured-product' ),
					'type'        => 'control',
					'control'     => Astra_Theme_Extension::$switch_control,
					'section'     => $_section,
					'title'       => __( 'Show Featured Product', 'astra-addon' ),
					'description' => __( 'Show featured product inside flyout cart when cart is empty', 'astra-addon' ),
					'priority'    => 59,
				),

				/**
				 * Option: Divider.
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[woo-coupon-text-divider]',
					'section'  => 'section-woo-misc',
					'title'    => __( 'Coupon Inputs', 'astra-addon' ),
					'type'     => 'control',
					'control'  => 'ast-heading',
					'priority' => 59,
					'settings' => array(),
					'divider'  => array( 'ast_class' => 'ast-section-spacing' ),
				),

				/**
				 * Option: Coupon text.
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[woo-coupon-text]',
					'default'   => astra_get_option( 'woo-coupon-text' ),
					'section'   => 'section-woo-misc',
					'title'     => __( 'Coupon Text', 'astra-addon' ),
					'type'      => 'control',
					'control'   => 'text',
					'transport' => 'postMessage',
					'priority'  => 59,
					'partial'   => array(
						'selector'            => '#ast-coupon-trigger',
						'container_inclusive' => false,
						'render_callback'     => array( ASTRA_Ext_WooCommerce_Markup::get_instance(), 'render_coupon_text' ),
						'fallback_refresh'    => false,
					),
				),

				/**
				 * Option: Coupon text.
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[woo-coupon-input-text]',
					'default'  => astra_get_option( 'woo-coupon-input-text' ),
					'section'  => 'section-woo-misc',
					'title'    => __( 'Coupon Input Text', 'astra-addon' ),
					'type'     => 'control',
					'control'  => 'text',
					'priority' => 59,
				),

				/**
				 * Option: Coupon text.
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[woo-coupon-apply-text]',
					'default'   => astra_get_option( 'woo-coupon-apply-text' ),
					'section'   => 'section-woo-misc',
					'title'     => __( 'Coupon Apply Text', 'astra-addon' ),
					'type'      => 'control',
					'control'   => 'text',
					'transport' => 'postMessage',
					'priority'  => 59,
					'partial'   => array(
						'selector'            => '#ast-apply-coupon',
						'container_inclusive' => false,
						'render_callback'     => array( ASTRA_Ext_WooCommerce_Markup::get_instance(), 'render_coupon_apply_text' ),
						'fallback_refresh'    => false,
					),
				),

			);

			$configurations = array_merge( $configurations, $_configs );

			if ( false === astra_addon_builder_helper()->is_header_footer_builder_active ) {

				$_configs = array(

					/**
					 * Option: Icon Style
					 */
					array(
						'name'      => ASTRA_THEME_SETTINGS . '[woo-header-cart-icon-style]',
						'default'   => astra_get_option( 'woo-header-cart-icon-style' ),
						'type'      => 'control',
						'transport' => 'postMessage',
						'section'   => $_section,
						'title'     => __( 'Style', 'astra-addon' ),
						'control'   => 'ast-select',
						'priority'  => 40,
						'choices'   => array(
							'none'    => __( 'None', 'astra-addon' ),
							'outline' => __( 'Outline', 'astra-addon' ),
							'fill'    => __( 'Fill', 'astra-addon' ),
						),
						'context'   => $context,
					),

					/**
					 * Option: Background color
					 */
					array(
						'name'     => ASTRA_THEME_SETTINGS . '[woo-header-cart-icon-color]',
						'default'  => astra_get_option( 'woo-header-cart-icon-color' ),
						'type'     => 'control',
						'control'  => 'ast-color',
						'context'  => array(
							$context,
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[woo-header-cart-icon-style]',
								'operator' => '!=',
								'value'    => 'none',
							),
						),
						'title'    => __( 'Color', 'astra-addon' ),
						'section'  => $_section,
						'priority' => 45,
					),

					/**
					 * Option: Border Radius
					 */
					array(
						'name'        => ASTRA_THEME_SETTINGS . '[woo-header-cart-icon-radius]',
						'default'     => astra_get_option( 'woo-header-cart-icon-radius' ),
						'type'        => 'control',
						'transport'   => 'postMessage',
						'section'     => $_section,
						'context'     => array(
							$context,
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[woo-header-cart-icon-style]',
								'operator' => '!=',
								'value'    => 'none',
							),
						),
						'title'       => __( 'Border Radius', 'astra-addon' ),
						'control'     => 'ast-slider',
						'priority'    => 45,
						'suffix'      => 'px',
						'input_attrs' => array(
							'min'  => 0,
							'step' => 1,
							'max'  => 200,
						),
					),

					/**
					 * Option: Header cart total
					 */
					array(
						'name'      => ASTRA_THEME_SETTINGS . '[woo-header-cart-total-display]',
						'default'   => astra_get_option( 'woo-header-cart-total-display' ),
						'type'      => 'control',
						'section'   => $_section,
						'transport' => 'postMessage',
						'title'     => __( 'Display Cart Totals', 'astra-addon' ),
						'priority'  => 50,
						'control'   => Astra_Theme_Extension::$switch_control,
						'context'   => astra_addon_builder_helper()->general_tab,
						'divider'   => array( 'ast_class' => 'ast-bottom-divider' ),
					),

					/**
					 * Option: Cart Title
					 */
					array(
						'name'      => ASTRA_THEME_SETTINGS . '[woo-header-cart-title-display]',
						'default'   => astra_get_option( 'woo-header-cart-title-display' ),
						'type'      => 'control',
						'section'   => $_section,
						'transport' => 'postMessage',
						'title'     => __( 'Display Cart Title', 'astra-addon' ),
						'priority'  => 55,
						'control'   => Astra_Theme_Extension::$switch_control,
						'context'   => astra_addon_builder_helper()->general_tab,
						'divider'   => ( true === Astra_Builder_Helper::$is_header_footer_builder_active ) ? array( 'ast_class' => 'ast-bottom-divider' ) : array(),
					),
				);
			}

			$configurations = array_merge( $configurations, $_configs );

			return $configurations;

		}
	}
}


new Astra_Woocommerce_General_Configs();
