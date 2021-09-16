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

if ( ! class_exists( 'Astra_Woocommerce_Checkout_Configs' ) ) {

	/**
	 * Register Woocommerce Checkout Layout Configurations.
	 */
	class Astra_Woocommerce_Checkout_Configs extends Astra_Customizer_Config_Base {

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
				 * Option: Checkout Content Width
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[checkout-content-width]',
					'default'   => astra_get_option( 'checkout-content-width' ),
					'type'      => 'control',
					'control'   => 'ast-select',
					'priority'  => 5,
					'section'   => 'woocommerce_checkout',
					'transport' => 'postMessage',
					'title'     => __( 'Checkout Form Width', 'astra-addon' ),
					'choices'   => array(
						'default' => __( 'Default', 'astra-addon' ),
						'custom'  => __( 'Custom', 'astra-addon' ),
					),
					'divider'   => array( 'ast_class' => 'ast-bottom-divider' ),
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
					'divider'     => array( 'ast_class' => 'ast-bottom-divider' ),
				),

				/**
				 * Option: Two Step Checkout
				 */
				array(
					'name'    => ASTRA_THEME_SETTINGS . '[two-step-checkout]',
					'default' => astra_get_option( 'two-step-checkout' ),
					'type'    => 'control',
					'section' => 'woocommerce_checkout',
					'title'   => __( 'Two Step Checkout', 'astra-addon' ),
					'control' => Astra_Theme_Extension::$switch_control,
					'divider' => array( 'ast_class' => 'ast-bottom-divider ast-top-divider' ),
				),

				/**
				 * Option: Display Order Note on Checkout Page
				 */
				array(
					'name'    => ASTRA_THEME_SETTINGS . '[checkout-order-notes-display]',
					'default' => astra_get_option( 'checkout-order-notes-display' ),
					'type'    => 'control',
					'section' => 'woocommerce_checkout',
					'title'   => __( 'Display Order Note', 'astra-addon' ),
					'control' => Astra_Theme_Extension::$switch_control,
					'divider' => array( 'ast_class' => 'ast-bottom-divider' ),
				),

				/**
				 * Option: Display Coupon on Checkout Page
				 */
				array(
					'name'    => ASTRA_THEME_SETTINGS . '[checkout-coupon-display]',
					'default' => astra_get_option( 'checkout-coupon-display' ),
					'type'    => 'control',
					'section' => 'woocommerce_checkout',
					'title'   => __( 'Display Apply Coupon Field', 'astra-addon' ),
					'control' => Astra_Theme_Extension::$switch_control,
					'divider' => array( 'ast_class' => 'ast-bottom-divider' ),
				),

				/*
				 * Option: Distraction free Checkout.
				 */
				array(
					'name'    => ASTRA_THEME_SETTINGS . '[checkout-distraction-free]',
					'default' => astra_get_option( 'checkout-distraction-free' ),
					'type'    => 'control',
					'section' => 'woocommerce_checkout',
					'title'   => __( 'Distraction Free Checkout', 'astra-addon' ),
					'control' => Astra_Theme_Extension::$switch_control,
					'divider' => array( 'ast_class' => 'ast-bottom-divider' ),
				),

				/*
				 * Option: Replace Form lable with placeholder
				 */
				array(
					'name'    => ASTRA_THEME_SETTINGS . '[checkout-labels-as-placeholders]',
					'default' => astra_get_option( 'checkout-labels-as-placeholders' ),
					'type'    => 'control',
					'section' => 'woocommerce_checkout',
					'title'   => __( 'Use Labels as Placeholders', 'astra-addon' ),
					'control' => Astra_Theme_Extension::$switch_control,
					'divider' => array( 'ast_class' => 'ast-bottom-divider' ),
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
				),

			);

			$configurations = array_merge( $configurations, $_configs );

			return $configurations;

		}
	}
}


new Astra_Woocommerce_Checkout_Configs();





