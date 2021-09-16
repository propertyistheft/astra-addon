<?php
/**
 * Woocommerce General Options for our theme.
 *
 * @package     Astra
 * @author      Astra
 * @copyright   Copyright (c) 2020, Astra
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
	class Astra_Woocommerce_General_Configs extends Astra_Customizer_Config_Base {

		/**
		 * Register Woocommerce General Layout Configurations.
		 *
		 * @param Array                $configurations Astra Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array Astra Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_section = ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) ? 'section-header-woo-cart' : 'section-woo-general';

			$context = ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) ? astra_addon_builder_helper()->design_tab : astra_addon_builder_helper()->general_tab;

			$cart_outline_width_context = ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) ? astra_addon_builder_helper()->design_tab_config : astra_addon_builder_helper()->general_tab_config;

			$_configs = array(

				/**
				 * Option: Sale Notification
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[product-sale-notification]',
					'default'  => astra_get_option( 'product-sale-notification' ),
					'type'     => 'control',
					'section'  => 'section-woo-general',
					'title'    => __( 'Sale Notification', 'astra-addon' ),
					'control'  => 'ast-select',
					'divider'  => array( 'ast_class' => 'ast-bottom-divider' ),
					'priority' => 15,
					'choices'  => array(
						'none'            => __( 'None', 'astra-addon' ),
						'default'         => __( 'Default', 'astra-addon' ),
						'sale-percentage' => __( 'Custom String', 'astra-addon' ),
					),
				),

				/**
				 * Option: Sale Percentage Input
				 */
				array(
					'name'        => ASTRA_THEME_SETTINGS . '[product-sale-percent-value]',
					'default'     => astra_get_option( 'product-sale-percent-value' ),
					'type'        => 'control',
					'section'     => 'section-woo-general',
					'title'       => __( 'Sale % Value', 'astra-addon' ),
					'description' => __( 'Sale percentage(%) value = [value]', 'astra-addon' ),
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
					'divider'     => array( 'ast_class' => 'ast-bottom-divider' ),
				),

				/**
				 * Option: Sale Bubble Shape
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[product-sale-style]',
					'default'   => astra_get_option( 'product-sale-style' ),
					'type'      => 'control',
					'transport' => 'postMessage',
					'section'   => 'section-woo-general',
					'title'     => __( 'Sale Bubble Style', 'astra-addon' ),
					'divider'   => array( 'ast_class' => 'ast-bottom-divider' ),
					'context'   => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[product-sale-notification]',
							'operator' => 'in',
							'value'    => array( 'sale-percentage', 'default' ),
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
				),

				/**
				 * Option: Header Cart Icon
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[woo-header-cart-icon]',
					'default'   => astra_get_option( 'woo-header-cart-icon' ),
					'type'      => 'control',
					'section'   => $_section,
					'transport' => 'postMessage',
					'title'     => __( 'Icon', 'astra-addon' ),
					'control'   => 'ast-select',
					'priority'  => 35,
					'choices'   => array(
						'default' => __( 'Default', 'astra-addon' ),
						'cart'    => __( 'Cart', 'astra-addon' ),
						'bag'     => __( 'Bag', 'astra-addon' ),
						'basket'  => __( 'Basket', 'astra-addon' ),
					),
					'context'   => astra_addon_builder_helper()->general_tab,
				),

				/**
				 * Option: Cart Count color
				 */
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[woo-header-cart-product-count-color]',
					'default'           => astra_get_option( 'woo-header-cart-product-count-color' ),
					'type'              => 'control',
					'control'           => 'ast-color',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
					'transport'         => 'postMessage',
					'title'             => __( 'Count Color', 'astra-addon' ),
					'context'           => array(
						Astra_Builder_Helper::$design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[woo-header-cart-icon]',
							'operator' => '!=',
							'value'    => 'default',
						),
					),
					'section'           => $_section,
					'priority'          => 45,
				),

				/**
				 * Option: Border Width
				 */
				array(
					'name'        => ASTRA_THEME_SETTINGS . '[woo-header-cart-border-width]',
					'default'     => astra_get_option( 'woo-header-cart-border-width' ),
					'type'        => 'control',
					'transport'   => 'postMessage',
					'section'     => $_section,
					'context'     => array(
						$cart_outline_width_context,
						'relation' => 'AND',
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[woo-header-cart-icon-style]',
							'operator' => '==',
							'value'    => 'outline',
						),
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[woo-header-cart-icon]',
							'operator' => '!=',
							'value'    => 'default',
						),
					),
					'title'       => __( 'Border Width', 'astra-addon' ),
					'control'     => 'ast-slider',
					'suffix'      => 'px',
					'priority'    => 46,
					'input_attrs' => array(
						'min'  => 0,
						'step' => 1,
						'max'  => 20,
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
						'divider'   => array( 'ast_class' => 'ast-bottom-divider' ),
					),
				);
			}

			$configurations = array_merge( $configurations, $_configs );

			return $configurations;

		}
	}
}


new Astra_Woocommerce_General_Configs();
