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

if ( ! class_exists( 'Astra_Woocommerce_Checkout_Configs' ) ) {

	/**
	 * Register Woocommerce Checkout Layout Configurations.
	 */
	// @codingStandardsIgnoreStart
	class Astra_Woocommerce_Checkout_Configs extends Astra_Customizer_Config_Base {
 // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedClassFound
		// @codingStandardsIgnoreEnd

		/**
		 * Register Woocommerce Checkout Layout Configurations.
		 *
		 * @param Array                $configurations Astra Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array Astra Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_configs = array(

				/**
				 * Option: Context for Checkout section.
				 */

				array(
					'name'        => 'section-woo-checkout-ast-context-tabs',
					'section'     => 'woocommerce_checkout',
					'type'        => 'control',
					'control'     => 'ast-builder-header-control',
					'priority'    => 0,
					'description' => '',
				),

				/**
				 * Option: Divider.
				 */

				array(
					'name'     => ASTRA_THEME_SETTINGS . '[woo-checkout-general-divider]',
					'section'  => 'woocommerce_checkout',
					'title'    => __( 'General', 'astra-addon' ),
					'type'     => 'control',
					'control'  => 'ast-heading',
					'priority' => 5,
					'settings' => array(),
				),

				/**
				 * Option: Checkout Content Width
				 */
				array(
					'name'       => ASTRA_THEME_SETTINGS . '[checkout-content-width]',
					'default'    => astra_get_option( 'checkout-content-width' ),
					'section'    => 'woocommerce_checkout',
					'type'       => 'control',
					'control'    => 'ast-selector',
					'title'      => __( 'Checkout Form Width', 'astra-addon' ),
					'priority'   => 5,
					'choices'    => array(
						'default' => __( 'Default', 'astra-addon' ),
						'custom'  => __( 'Custom', 'astra-addon' ),
					),
					'transport'  => 'postMessage',
					'renderAs'   => 'text',
					'responsive' => false,
					'divider'    => array( 'ast_class' => 'ast-section-spacing' ),
				),

				/**
				 * Option: Enter Width
				 */
				array(
					'name'        => ASTRA_THEME_SETTINGS . '[checkout-content-max-width]',
					'default'     => astra_get_option( 'checkout-content-max-width' ),
					'type'        => 'control',
					'transport'   => 'postMessage',
					'control'     => 'ast-slider',
					'context'     => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[checkout-content-width]',
							'operator' => '==',
							'value'    => 'custom',
						),
					),
					'section'     => 'woocommerce_checkout',
					'title'       => __( 'Custom Width', 'astra-addon' ),
					'suffix'      => 'px',
					'priority'    => 5,
					'input_attrs' => array(
						'min'  => 768,
						'step' => 1,
						'max'  => 1920,
					),
					'divider'     => array( 'ast_class' => 'ast-top-dotted-divider' ),
				),

				/**
				* Option: Checkout Layout.
				*/

				array(
					'name'       => ASTRA_THEME_SETTINGS . '[checkout-layout-type]',
					'default'    => astra_get_option( 'checkout-layout-type' ),
					'section'    => 'woocommerce_checkout',
					'type'       => 'control',
					'control'    => 'ast-selector',
					'title'      => __( 'Checkout Layout', 'astra-addon' ),
					'priority'   => 5,
					'choices'    => array(
						'default' => __( 'Default', 'astra-addon' ),
						'modern'  => __( 'Modern', 'astra-addon' ),
					),
					'transport'  => 'refresh',
					'renderAs'   => 'text',
					'responsive' => false,
					'divider'    => array( 'ast_class' => 'ast-top-section-divider' ),
				),

				/**
				 * Option: Modern Checkout Layout.
				 */

				array(
					'name'       => ASTRA_THEME_SETTINGS . '[checkout-modern-layout-type]',
					'default'    => astra_get_option( 'checkout-modern-layout-type' ),
					'section'    => 'woocommerce_checkout',
					'type'       => 'control',
					'control'    => 'ast-selector',
					'title'      => __( 'Modern Checkout Layout', 'astra-addon' ),
					'priority'   => 5,
					'choices'    => array(
						'one-column-checkout' => __( 'One Column Layout', 'astra-addon' ),
						'two-column-checkout' => __( 'Two Column Layout', 'astra-addon' ),
					),
					'transport'  => 'refresh',
					'renderAs'   => 'text',
					'responsive' => false,
					'context'    => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[checkout-layout-type]',
							'operator' => '==',
							'value'    => 'modern',
						),
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[two-step-checkout]',
							'operator' => '==',
							'value'    => false,
						),
					),
					'divider'    => array( 'ast_class' => 'ast-top-dotted-divider ast-bottom-dotted-divider' ),
				),

				/**
				 * Option: Change Place Order Text.
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[checkout-place-order-text]',
					'default'   => astra_get_option( 'checkout-place-order-text' ),
					'section'   => 'woocommerce_checkout',
					'priority'  => 5,
					'title'     => __( 'Button Text', 'astra-addon' ),
					'type'      => 'control',
					'control'   => 'text',
					'transport' => 'postMessage',
					'partial'   => array(
						'selector'            => '#place_order',
						'container_inclusive' => false,
						'render_callback'     => array( ASTRA_Ext_WooCommerce_Markup::get_instance(), 'render_checkout_place_order_text' ),
					),
					'context'   => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[checkout-layout-type]',
							'operator' => '==',
							'value'    => 'modern',
						),
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[two-step-checkout]',
							'operator' => '==',
							'value'    => false,
						),
					),
				),

				/**
				 * Option: Checkout payment text.
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[checkout-payment-text]',
					'default'   => astra_get_option( 'checkout-payment-text' ),
					'section'   => 'woocommerce_checkout',
					'title'     => __( 'Payment Text', 'astra-addon' ),
					'type'      => 'control',
					'control'   => 'text',
					'transport' => 'postMessage',
					'priority'  => 5,
					'partial'   => array(
						'selector'            => '#ast-payment_options_heading',
						'container_inclusive' => false,
						'render_callback'     => array( ASTRA_Ext_WooCommerce_Markup::get_instance(), 'render_checkout_payment_text' ),
						'fallback_refresh'    => false,
					),
					'context'   => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[checkout-layout-type]',
							'operator' => '==',
							'value'    => 'modern',
						),
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[two-step-checkout]',
							'operator' => '==',
							'value'    => false,
						),
					),
				),

				/**
				 * Option: Checkout customer information text.
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[checkout-customer-information-text]',
					'default'   => astra_get_option( 'checkout-customer-information-text' ),
					'section'   => 'woocommerce_checkout',
					'title'     => __( 'Customer information Text', 'astra-addon' ),
					'type'      => 'control',
					'control'   => 'text',
					'transport' => 'postMessage',
					'priority'  => 5,
					'partial'   => array(
						'selector'            => '.ast-checkout-form-heading h3',
						'container_inclusive' => false,
						'render_callback'     => array( ASTRA_Ext_WooCommerce_Markup::get_instance(), 'render_checkout_customer_information_text' ),
						'fallback_refresh'    => false,
					),
					'context'   => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[checkout-layout-type]',
							'operator' => '==',
							'value'    => 'modern',
						),
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[two-step-checkout]',
							'operator' => '==',
							'value'    => false,
						),
					),
				),

				/**
				 * Option: Checkout show summary text.
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[checkout-show-summary-text]',
					'default'  => astra_get_option( 'checkout-show-summary-text' ),
					'section'  => 'woocommerce_checkout',
					'title'    => __( 'Show Summary Text', 'astra-addon' ),
					'type'     => 'control',
					'control'  => 'text',
					'priority' => 5,
					'context'  => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[checkout-layout-type]',
							'operator' => '==',
							'value'    => 'modern',
						),
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[two-step-checkout]',
							'operator' => '==',
							'value'    => false,
						),
					),
				),

				/**
				 * Option: Checkout hide summary text.
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[checkout-hide-summary-text]',
					'default'  => astra_get_option( 'checkout-hide-summary-text' ),
					'section'  => 'woocommerce_checkout',
					'title'    => __( 'Hide Summary Text', 'astra-addon' ),
					'type'     => 'control',
					'control'  => 'text',
					'priority' => 5,
					'context'  => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[checkout-layout-type]',
							'operator' => '==',
							'value'    => 'modern',
						),
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[two-step-checkout]',
							'operator' => '==',
							'value'    => false,
						),
					),
				),

				/*
				 * Option: Modern enable button padlock
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[checkout-modern-checkout-button-padlock]',
					'default'  => astra_get_option( 'checkout-modern-checkout-button-padlock' ),
					'type'     => 'control',
					'section'  => 'woocommerce_checkout',
					'title'    => __( 'Enable Button Padlock', 'astra-addon' ),
					'control'  => Astra_Theme_Extension::$switch_control,
					'priority' => 5,
					'context'  => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[checkout-layout-type]',
							'operator' => '==',
							'value'    => 'modern',
						),
					),
				),

				/*
				 * Option: Modern enable button price.
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[checkout-modern-checkout-button-price]',
					'default'  => astra_get_option( 'checkout-modern-checkout-button-price' ),
					'type'     => 'control',
					'section'  => 'woocommerce_checkout',
					'title'    => __( 'Enable Button Price', 'astra-addon' ),
					'control'  => Astra_Theme_Extension::$switch_control,
					'priority' => 5,
					'context'  => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[checkout-layout-type]',
							'operator' => '==',
							'value'    => 'modern',
						),
					),
				),

				/*
				 * Option: Enable product images in the order review section
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[checkout-order-review-product-images]',
					'default'  => astra_get_option( 'checkout-order-review-product-images' ),
					'type'     => 'control',
					'section'  => 'woocommerce_checkout',
					'title'    => __( 'Display Product Images', 'astra-addon' ),
					'priority' => 5,
					'control'  => Astra_Theme_Extension::$switch_control,
					'context'  => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[checkout-layout-type]',
							'operator' => '==',
							'value'    => 'modern',
						),
					),
					'divider'  => array( 'ast_class' => 'ast-top-dotted-divider' ),
				),

				/*
				 * Option: Modern Order Received.
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[checkout-modern-order-received]',
					'default'  => astra_get_option( 'checkout-modern-order-received' ),
					'type'     => 'control',
					'section'  => 'woocommerce_checkout',
					'title'    => __( 'Enable Modern Order Received', 'astra-addon' ),
					'control'  => Astra_Theme_Extension::$switch_control,
					'priority' => 5,
					'context'  => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[checkout-layout-type]',
							'operator' => '==',
							'value'    => 'modern',
						),
					),
				),

				/*
				 * Option: Enable order review sticky.
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[checkout-order-review-sticky]',
					'default'  => astra_get_option( 'checkout-order-review-sticky' ),
					'type'     => 'control',
					'section'  => 'woocommerce_checkout',
					'title'    => __( 'Enable Sticky Order Review ', 'astra-addon' ),
					'priority' => 5,
					'control'  => Astra_Theme_Extension::$switch_control,
					'context'  => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[checkout-layout-type]',
							'operator' => '==',
							'value'    => 'modern',
						),
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[checkout-modern-layout-type]',
							'operator' => '==',
							'value'    => 'two-column-checkout',
						),
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[two-step-checkout]',
							'operator' => '==',
							'value'    => false,
						),

					),
				),

				/**
				 * Option: Divider
				 */

				array(
					'name'     => ASTRA_THEME_SETTINGS . '[woo-checkout-form-options-divider]',
					'section'  => 'woocommerce_checkout',
					'title'    => __( 'Checkout Options', 'astra-addon' ),
					'type'     => 'control',
					'control'  => 'ast-heading',
					'priority' => 5,
					'settings' => array(),
					'divider'  => array( 'ast_class' => 'ast-section-spacing' ),
				),

				/**
				 * Option: Two Step Checkout
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[two-step-checkout]',
					'default'  => astra_get_option( 'two-step-checkout' ),
					'type'     => 'control',
					'section'  => 'woocommerce_checkout',
					'title'    => __( 'Two Step Checkout', 'astra-addon' ),
					'control'  => Astra_Theme_Extension::$switch_control,
					'priority' => 5,
					'divider'  => array( 'ast_class' => 'ast-section-spacing' ),
				),

				/**
				 * Option: Two Step Notes
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[two-step-checkout-modern-note]',
					'default'  => astra_get_option( 'two-step-checkout-modern-note' ),
					'type'     => 'control',
					'priority' => 5,
					'section'  => 'woocommerce_checkout',
					'title'    => __( 'Enable Checkout Note', 'astra-addon' ),
					'control'  => Astra_Theme_Extension::$switch_control,
					'context'  => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[checkout-layout-type]',
							'operator' => '==',
							'value'    => 'modern',
						),
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[two-step-checkout]',
							'operator' => '==',
							'value'    => true,
						),
					),
				),

				/**
				 * Option: Checkout notes.
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[two-step-checkout-modern-note-text]',
					'default'   => astra_get_option( 'two-step-checkout-modern-note-text' ),
					'section'   => 'woocommerce_checkout',
					'title'     => __( 'Note Text', 'astra-addon' ),
					'type'      => 'control',
					'control'   => 'text',
					'transport' => 'postMessage',
					'priority'  => 5,
					'partial'   => array(
						'selector'            => '.ast-embed-checkout-form-note p',
						'container_inclusive' => false,
						'render_callback'     => array( ASTRA_Ext_WooCommerce_Markup::get_instance(), 'render_checkout_two_step_form_note' ),
					),
					'context'   => array(
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[checkout-layout-type]',
							'operator' => '==',
							'value'    => 'modern',
						),
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[two-step-checkout]',
							'operator' => '==',
							'value'    => true,
						),
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[two-step-checkout-modern-note]',
							'operator' => '==',
							'value'    => true,
						),
					),
				),

				/**
				 * Option: Step 1 Modern Text.
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[two-step-checkout-modern-step-1-text]',
					'default'   => astra_get_option( 'two-step-checkout-modern-step-1-text' ),
					'section'   => 'woocommerce_checkout',
					'title'     => __( 'Step One Title', 'astra-addon' ),
					'type'      => 'control',
					'priority'  => 5,
					'control'   => 'text',
					'transport' => 'postMessage',
					'partial'   => array(
						'selector'            => '.ast-embed-checkout-form-steps .step-one .step-name',
						'container_inclusive' => false,
						'render_callback'     => array( ASTRA_Ext_WooCommerce_Markup::get_instance(), 'render_checkout_step_one_title' ),
						'fallback_refresh'    => false,
					),
					'context'   => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[checkout-layout-type]',
							'operator' => '==',
							'value'    => 'modern',
						),
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[two-step-checkout]',
							'operator' => '==',
							'value'    => true,
						),
					),
				),

				/**
				 * Option: Step 1 Modern Sub Text.
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[two-step-checkout-modern-step-1-sub-text]',
					'default'   => astra_get_option( 'two-step-checkout-modern-step-1-sub-text' ),
					'section'   => 'woocommerce_checkout',
					'title'     => __( 'Step One Sub Title', 'astra-addon' ),
					'type'      => 'control',
					'control'   => 'text',
					'transport' => 'postMessage',
					'priority'  => 5,
					'partial'   => array(
						'selector'            => '.ast-embed-checkout-form-steps .step-one .step-sub-name',
						'container_inclusive' => false,
						'render_callback'     => array( ASTRA_Ext_WooCommerce_Markup::get_instance(), 'render_checkout_step_one_sub_title' ),
						'fallback_refresh'    => false,
					),
					'context'   => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[checkout-layout-type]',
							'operator' => '==',
							'value'    => 'modern',
						),
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[two-step-checkout]',
							'operator' => '==',
							'value'    => true,
						),
					),
				),

				/**
				 * Option: Step 2 Modern Text.
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[two-step-checkout-modern-step-2-text]',
					'default'   => astra_get_option( 'two-step-checkout-modern-step-2-text' ),
					'section'   => 'woocommerce_checkout',
					'title'     => __( 'Step Two Title', 'astra-addon' ),
					'type'      => 'control',
					'control'   => 'text',
					'transport' => 'postMessage',
					'priority'  => 5,
					'partial'   => array(
						'selector'            => '.ast-embed-checkout-form-steps .step-two .step-name',
						'container_inclusive' => false,
						'render_callback'     => array( ASTRA_Ext_WooCommerce_Markup::get_instance(), 'render_checkout_step_two_title' ),
						'fallback_refresh'    => false,
					),
					'context'   => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[checkout-layout-type]',
							'operator' => '==',
							'value'    => 'modern',
						),
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[two-step-checkout]',
							'operator' => '==',
							'value'    => true,
						),
					),
				),

				/**
				 * Option: Step 1 Modern Sub Text.
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[two-step-checkout-modern-step-2-sub-text]',
					'default'   => astra_get_option( 'two-step-checkout-modern-step-2-sub-text' ),
					'section'   => 'woocommerce_checkout',
					'title'     => __( 'Step Two Sub Title', 'astra-addon' ),
					'type'      => 'control',
					'control'   => 'text',
					'transport' => 'postMessage',
					'priority'  => 5,
					'partial'   => array(
						'selector'            => '.ast-embed-checkout-form-steps .step-two .step-sub-name',
						'container_inclusive' => false,
						'render_callback'     => array( ASTRA_Ext_WooCommerce_Markup::get_instance(), 'render_checkout_step_two_sub_title' ),
						'fallback_refresh'    => false,
					),
					'context'   => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[checkout-layout-type]',
							'operator' => '==',
							'value'    => 'modern',
						),
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[two-step-checkout]',
							'operator' => '==',
							'value'    => true,
						),
					),
				),

				/**
				 * Option: Change Next Button Text.
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[two-step-checkout-modern-button-text]',
					'default'   => astra_get_option( 'two-step-checkout-modern-button-text' ),
					'section'   => 'woocommerce_checkout',
					'title'     => __( 'Offer Button Title', 'astra-addon' ),
					'type'      => 'control',
					'control'   => 'text',
					'transport' => 'postMessage',
					'priority'  => 5,
					'partial'   => array(
						'selector'            => '.ast-next-button-content .ast-button-text',
						'container_inclusive' => false,
						'render_callback'     => array( ASTRA_Ext_WooCommerce_Markup::get_instance(), 'render_checkout_step_two_button_text' ),
						'fallback_refresh'    => false,
					),
					'context'   => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[checkout-layout-type]',
							'operator' => '==',
							'value'    => 'modern',
						),
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[two-step-checkout]',
							'operator' => '==',
							'value'    => true,
						),
					),
				),

				/**
				 * Option: Change Next Button Sub Text.
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[two-step-checkout-modern-button-sub-text]',
					'default'   => astra_get_option( 'two-step-checkout-modern-button-sub-text' ),
					'section'   => 'woocommerce_checkout',
					'title'     => __( 'Offer Button Sub Title', 'astra-addon' ),
					'type'      => 'control',
					'control'   => 'text',
					'transport' => 'postMessage',
					'priority'  => 5,
					'partial'   => array(
						'selector'            => '.ast-next-button-content .ast-button-sub-text',
						'container_inclusive' => false,
						'render_callback'     => array( ASTRA_Ext_WooCommerce_Markup::get_instance(), 'render_checkout_step_two_button_sub_text' ),
						'fallback_refresh'    => false,
					),
					'context'   => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[checkout-layout-type]',
							'operator' => '==',
							'value'    => 'modern',
						),
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[two-step-checkout]',
							'operator' => '==',
							'value'    => true,
						),
					),
				),

				/**
				 * Option: Display Order Note on Checkout Page
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[checkout-order-notes-display]',
					'default'  => astra_get_option( 'checkout-order-notes-display' ),
					'type'     => 'control',
					'section'  => 'woocommerce_checkout',
					'title'    => __( 'Display Order Note', 'astra-addon' ),
					'priority' => 5,
					'control'  => Astra_Theme_Extension::$switch_control,
				),

				/**
				 * Option: Display Coupon on Checkout Page
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[checkout-coupon-display]',
					'default'  => astra_get_option( 'checkout-coupon-display' ),
					'type'     => 'control',
					'section'  => 'woocommerce_checkout',
					'priority' => 5,
					'title'    => __( 'Display Apply Coupon Field', 'astra-addon' ),
					'control'  => Astra_Theme_Extension::$switch_control,
				),

				/*
				 * Option: Distraction free Checkout.
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[checkout-distraction-free]',
					'default'  => astra_get_option( 'checkout-distraction-free' ),
					'type'     => 'control',
					'section'  => 'woocommerce_checkout',
					'priority' => 5,
					'title'    => __( 'Distraction Free Checkout', 'astra-addon' ),
					'control'  => Astra_Theme_Extension::$switch_control,
				),

				/*
				 * Option: Replace Form label with placeholder
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[checkout-labels-as-placeholders]',
					'default'  => astra_get_option( 'checkout-labels-as-placeholders' ),
					'type'     => 'control',
					'section'  => 'woocommerce_checkout',
					'title'    => __( 'Use Labels as Placeholders', 'astra-addon' ),
					'control'  => Astra_Theme_Extension::$switch_control,
					'priority' => 5,
					'context'  => array(
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[woo-input-style-type]',
							'operator' => '==',
							'value'    => 'default',
						),
						astra_addon_builder_helper()->general_tab_config,
					),
				),

				/*
				 * Option: Back to cart button on checkout.
				 */
				array(
					'name'        => ASTRA_THEME_SETTINGS . '[checkout-back-to-cart-button]',
					'default'     => astra_get_option( 'checkout-back-to-cart-button' ),
					'type'        => 'control',
					'section'     => 'woocommerce_checkout',
					'title'       => __( 'Back to Cart Button', 'astra-addon' ),
					'control'     => Astra_Theme_Extension::$switch_control,
					'priority'    => 5,
					'description' => __( 'Adds back to cart button below place order button.', 'astra-addon' ),
					'context'     => array(
						astra_addon_builder_helper()->general_tab_config,
					),
				),

				/**
				* Option: Back to cart button text on checkout.
				*/
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[checkout-back-to-cart-button-text]',
					'default'  => astra_get_option( 'checkout-back-to-cart-button-text' ),
					'type'     => 'control',
					'section'  => 'woocommerce_checkout',
					'title'    => __( 'Back to Cart Text', 'astra-addon' ),
					'context'  => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[checkout-back-to-cart-button]',
							'operator' => '==',
							'value'    => true,
						),
					),
					'control'  => 'text',
					'priority' => 5,
				),

				/*
				 * Option: Preserve form data.
				 */
				array(
					'name'        => ASTRA_THEME_SETTINGS . '[checkout-persistence-form-data]',
					'default'     => astra_get_option( 'checkout-persistence-form-data' ),
					'type'        => 'control',
					'section'     => 'woocommerce_checkout',
					'title'       => __( 'Persistent Checkout Form Data', 'astra-addon' ),
					'description' => __( 'Retain the Checkout form fields even if the visitor accidentally reloads the checkout page.', 'astra-addon' ),
					'control'     => Astra_Theme_Extension::$switch_control,
					'priority'    => 5,
				),

				/**
				 * Option: Divider.
				 */

				array(
					'name'     => ASTRA_THEME_SETTINGS . '[woo-checkout-form-fields-divider]',
					'section'  => 'woocommerce_checkout',
					'title'    => __( 'Checkout Form Fields', 'astra-addon' ),
					'type'     => 'control',
					'control'  => 'ast-heading',
					'priority' => 5,
					'settings' => array(),
					'divider'  => array( 'ast_class' => 'ast-section-spacing ast-bottom-spacing' ),
				),

				/**
				 * Option: Divider Order Summary.
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[woo-order-summary-color-divider]',
					'section'  => 'woocommerce_checkout',
					'title'    => __( 'Order Summary', 'astra-addon' ),
					'type'     => 'control',
					'control'  => 'ast-heading',
					'priority' => 4,
					'settings' => array(),
					'context'  => array(
						astra_addon_builder_helper()->design_tab_config,
					),
				),

				/**
				 * Option: Order Summary Background Color.
				 */

				array(
					'name'              => ASTRA_THEME_SETTINGS . '[order-summary-background-color]',
					'default'           => astra_get_option( 'order-summary-background-color' ),
					'type'              => 'control',
					'section'           => 'woocommerce_checkout',
					'control'           => 'ast-color',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
					'transport'         => 'postMessage',
					'title'             => __( 'Content Background', 'astra-addon' ),
					'priority'          => 4,
					'context'           => array(
						astra_addon_builder_helper()->design_tab_config,
					),
				),

				/**
				 * Option: Divider Payment Option.
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[woo-payment-option-color-divider]',
					'section'  => 'woocommerce_checkout',
					'title'    => __( 'Payment Option', 'astra-addon' ),
					'type'     => 'control',
					'control'  => 'ast-heading',
					'priority' => 4,
					'settings' => array(),
					'context'  => array(
						astra_addon_builder_helper()->design_tab_config,
					),
					'divider'  => array( 'ast_class' => 'ast-section-spacing' ),
				),

				/**
				 * Option: Order Summary Header Background Color.
				 */

				array(
					'name'              => ASTRA_THEME_SETTINGS . '[payment-option-content-background-color]',
					'default'           => astra_get_option( 'payment-option-content-background-color' ),
					'type'              => 'control',
					'section'           => 'woocommerce_checkout',
					'control'           => 'ast-color',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
					'transport'         => 'postMessage',
					'title'             => __( 'Content Background', 'astra-addon' ),
					'priority'          => 4,
					'context'           => array(
						astra_addon_builder_helper()->design_tab_config,
					),
				),

			);

			$configurations = array_merge( $configurations, $_configs );

			return $configurations;

		}
	}
}


new Astra_Woocommerce_Checkout_Configs();





