<?php
/**
 * Shop Options for our theme.
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

if ( ! class_exists( 'Astra_Woocommerce_Shop_Typo_Configs' ) ) {

	/**
	 * Register Woocommerce Shop Typo Layout Configurations.
	 */
	class Astra_Woocommerce_Shop_Typo_Configs extends Astra_Customizer_Config_Base {

		/**
		 * Register Woocommerce Shop Typo Layout Configurations.
		 *
		 * @param Array                $configurations Astra Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array Astra Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_configs = array(

				/**
				 * Group: WooCommerce Shop product title Group
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[shop-product-title-group]',
					'default'   => astra_get_option( 'shop-product-title-group' ),
					'type'      => 'control',
					'control'   => 'ast-settings-group',
					'title'     => __( 'Product Title Font', 'astra-addon' ),
					'section'   => 'woocommerce_product_catalog',
					'transport' => 'postMessage',
					'context'   => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[shop-product-structure]',
							'operator' => 'contains',
							'value'    => 'title',
						),
					),
					'priority'  => 230,
				),

				/**
				 * Option: Product Title Font Family
				 */
				array(
					'name'      => 'font-family-shop-product-title',
					'default'   => astra_get_option( 'font-family-shop-product-title' ),
					'type'      => 'sub-control',
					'parent'    => ASTRA_THEME_SETTINGS . '[shop-product-title-group]',
					'section'   => 'woocommerce_product_catalog',
					'control'   => 'ast-font',
					'font_type' => 'ast-font-family',
					'title'     => __( 'Family', 'astra-addon' ),
					'connect'   => ASTRA_THEME_SETTINGS . '[font-weight-shop-product-title]',
					'priority'  => 4,
				),

				/**
				 * Option: Product Title Font Weight
				 */
				array(
					'name'              => 'font-weight-shop-product-title',
					'default'           => astra_get_option( 'font-weight-shop-product-title' ),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_font_weight' ),
					'type'              => 'sub-control',
					'parent'            => ASTRA_THEME_SETTINGS . '[shop-product-title-group]',
					'section'           => 'woocommerce_product_catalog',
					'control'           => 'ast-font',
					'font_type'         => 'ast-font-weight',
					'title'             => __( 'Weight', 'astra-addon' ),
					'connect'           => 'font-family-shop-product-title',
					'priority'          => 5,
				),

				/**
					 * Option: Product Title Text Transform
					 */
				array(
					'name'      => 'text-transform-shop-product-title',
					'default'   => astra_get_option( 'text-transform-shop-product-title' ),
					'transport' => 'postMessage',
					'type'      => 'sub-control',
					'parent'    => ASTRA_THEME_SETTINGS . '[shop-product-title-group]',
					'section'   => 'woocommerce_product_catalog',
					'title'     => __( 'Text Transform', 'astra-addon' ),
					'control'   => 'ast-select',
					'priority'  => 5,
					'choices'   => array(
						''           => __( 'Inherit', 'astra-addon' ),
						'none'       => __( 'None', 'astra-addon' ),
						'capitalize' => __( 'Capitalize', 'astra-addon' ),
						'uppercase'  => __( 'Uppercase', 'astra-addon' ),
						'lowercase'  => __( 'Lowercase', 'astra-addon' ),
					),
				),

				/**
				 * Option: Product Title Font Size
				 */
				array(
					'name'        => 'font-size-shop-product-title',
					'default'     => astra_get_option( 'font-size-shop-product-title' ),
					'type'        => 'sub-control',
					'parent'      => ASTRA_THEME_SETTINGS . '[shop-product-title-group]',
					'section'     => 'woocommerce_product_catalog',
					'transport'   => 'postMessage',
					'control'     => 'ast-responsive',
					'priority'    => 4,
					'title'       => __( 'Size', 'astra-addon' ),
					'input_attrs' => array(
						'min' => 0,
					),
					'units'       => array(
						'px' => 'px',
						'em' => 'em',
					),
				),

				/**
				 * Option: Product Title Line Height
				 */
				array(
					'name'              => 'line-height-shop-product-title',
					'default'           => astra_get_option( 'line-height-shop-product-title' ),
					'transport'         => 'postMessage',
					'type'              => 'sub-control',
					'parent'            => ASTRA_THEME_SETTINGS . '[shop-product-title-group]',
					'section'           => 'woocommerce_product_catalog',
					'title'             => __( 'Line Height', 'astra-addon' ),
					'control'           => 'ast-slider',
					'priority'          => 5,
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_number_n_blank' ),
					'suffix'            => 'em',
					'input_attrs'       => array(
						'min'  => 1,
						'step' => 0.01,
						'max'  => 5,
					),
				),

				/**
				 * Group: WooCommerce Shop product price Group
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[shop-product-price-group]',
					'default'   => astra_get_option( 'shop-product-price-group' ),
					'type'      => 'control',
					'control'   => 'ast-settings-group',
					'title'     => __( 'Product Price Font', 'astra-addon' ),
					'section'   => 'woocommerce_product_catalog',
					'transport' => 'postMessage',
					'context'   => array(
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[shop-product-structure]',
							'operator' => 'contains',
							'value'    => 'price',
						),
					),
					'priority'  => 230,
				),

				/**
				 * Option: Product Price Font Family
				 */
				array(
					'name'      => 'font-family-shop-product-price',
					'default'   => astra_get_option( 'font-family-shop-product-price' ),
					'type'      => 'sub-control',
					'parent'    => ASTRA_THEME_SETTINGS . '[shop-product-price-group]',
					'section'   => 'woocommerce_product_catalog',
					'control'   => 'ast-font',
					'font_type' => 'ast-font-family',
					'title'     => __( 'Family', 'astra-addon' ),
					'connect'   => ASTRA_THEME_SETTINGS . '[font-weight-shop-product-price]',
					'priority'  => 9,
				),

				/**
				 * Option: Product Price Font Weight
				 */
				array(
					'name'              => 'font-weight-shop-product-price',
					'default'           => astra_get_option( 'font-weight-shop-product-price' ),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_font_weight' ),
					'type'              => 'sub-control',
					'parent'            => ASTRA_THEME_SETTINGS . '[shop-product-price-group]',
					'section'           => 'woocommerce_product_catalog',
					'control'           => 'ast-font',
					'font_type'         => 'ast-font-weight',
					'title'             => __( 'Weight', 'astra-addon' ),
					'connect'           => 'font-family-shop-product-price',
					'priority'          => 10,
				),

				/**
				 * Option: Product Price Font Size
				 */
				array(
					'name'        => 'font-size-shop-product-price',
					'default'     => astra_get_option( 'font-size-shop-product-price' ),
					'type'        => 'sub-control',
					'parent'      => ASTRA_THEME_SETTINGS . '[shop-product-price-group]',
					'section'     => 'woocommerce_product_catalog',
					'transport'   => 'postMessage',
					'control'     => 'ast-responsive',
					'priority'    => 9,
					'title'       => __( 'Size', 'astra-addon' ),
					'input_attrs' => array(
						'min' => 0,
					),
					'units'       => array(
						'px' => 'px',
						'em' => 'em',
					),
				),

				/**
				 * Option: Product Price Line Height
				 */
				array(
					'name'        => 'line-height-shop-product-price',
					'default'     => astra_get_option( 'line-height-shop-product-price' ),
					'type'        => 'sub-control',
					'parent'      => ASTRA_THEME_SETTINGS . '[shop-product-price-group]',
					'section'     => 'woocommerce_product_catalog',
					'transport'   => 'postMessage',
					'title'       => __( 'Line Height', 'astra-addon' ),
					'control'     => 'ast-slider',
					'priority'    => 10,
					'suffix'      => 'em',
					'input_attrs' => array(
						'min'  => 1,
						'step' => 0.01,
						'max'  => 5,
					),
				),

				/**
				 * Group: WooCommerce Shop product content Group
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[shop-product-content-group]',
					'default'   => astra_get_option( 'shop-product-content-group' ),
					'type'      => 'control',
					'control'   => 'ast-settings-group',
					'title'     => __( 'Product Content Font', 'astra-addon' ),
					'section'   => 'woocommerce_product_catalog',
					'transport' => 'postMessage',
					'context'   => array(
						'relation' => 'AND',
						astra_addon_builder_helper()->general_tab_config,
						array(
							'relation' => 'OR',
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[shop-product-structure]',
								'operator' => 'contains',
								'value'    => 'category',
							),
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[shop-product-structure]',
								'operator' => 'contains',
								'value'    => 'structure',
							),

						),

					),
					'priority'  => 230,
				),

				/**
				 * Option: Product Content Font Family
				 */
				array(
					'name'      => 'font-family-shop-product-content',
					'default'   => astra_get_option( 'font-family-shop-product-content' ),
					'type'      => 'sub-control',
					'parent'    => ASTRA_THEME_SETTINGS . '[shop-product-content-group]',
					'section'   => 'woocommerce_product_catalog',
					'control'   => 'ast-font',
					'font_type' => 'ast-font-family',
					'title'     => __( 'Family', 'astra-addon' ),
					'connect'   => ASTRA_THEME_SETTINGS . '[font-weight-shop-product-content]',
					'priority'  => 14,
				),

				/**
				 * Option: Product Content Font Weight
				 */
				array(
					'name'              => 'font-weight-shop-product-content',
					'default'           => astra_get_option( 'font-weight-shop-product-content' ),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_font_weight' ),
					'type'              => 'sub-control',
					'parent'            => ASTRA_THEME_SETTINGS . '[shop-product-content-group]',
					'section'           => 'woocommerce_product_catalog',
					'control'           => 'ast-font',
					'font_type'         => 'ast-font-weight',
					'title'             => __( 'Weight', 'astra-addon' ),
					'connect'           => 'font-family-shop-product-content',
					'priority'          => 15,
				),

				/**
				 * Option: Product Title Text Transform
				 */
				array(
					'name'      => 'text-transform-shop-product-content',
					'default'   => astra_get_option( 'text-transform-shop-product-content' ),
					'type'      => 'sub-control',
					'parent'    => ASTRA_THEME_SETTINGS . '[shop-product-content-group]',
					'section'   => 'woocommerce_product_catalog',
					'transport' => 'postMessage',
					'title'     => __( 'Text Transform', 'astra-addon' ),
					'control'   => 'ast-select',
					'priority'  => 15,
					'choices'   => array(
						''           => __( 'Inherit', 'astra-addon' ),
						'none'       => __( 'None', 'astra-addon' ),
						'capitalize' => __( 'Capitalize', 'astra-addon' ),
						'uppercase'  => __( 'Uppercase', 'astra-addon' ),
						'lowercase'  => __( 'Lowercase', 'astra-addon' ),
					),
				),

				/**
				 * Option: Product Content Font Size
				 */
				array(
					'name'        => 'font-size-shop-product-content',
					'default'     => astra_get_option( 'font-size-shop-product-content' ),
					'type'        => 'sub-control',
					'parent'      => ASTRA_THEME_SETTINGS . '[shop-product-content-group]',
					'section'     => 'woocommerce_product_catalog',
					'transport'   => 'postMessage',
					'control'     => 'ast-responsive',
					'priority'    => 14,
					'title'       => __( 'Size', 'astra-addon' ),
					'input_attrs' => array(
						'min' => 0,
					),
					'units'       => array(
						'px' => 'px',
						'em' => 'em',
					),
				),

				/**
				 * Option: Product Content Line Height
				 */
				array(
					'name'        => 'line-height-shop-product-content',
					'default'     => astra_get_option( 'line-height-shop-product-content' ),
					'type'        => 'sub-control',
					'parent'      => ASTRA_THEME_SETTINGS . '[shop-product-content-group]',
					'section'     => 'woocommerce_product_catalog',
					'transport'   => 'postMessage',
					'title'       => __( 'Line Height', 'astra-addon' ),
					'control'     => 'ast-slider',
					'priority'    => 15,
					'suffix'      => 'em',
					'input_attrs' => array(
						'min'  => 1,
						'step' => 0.01,
						'max'  => 5,
					),
				),
			);

			$configurations = array_merge( $configurations, $_configs );

			return $configurations;

		}
	}
}


new Astra_Woocommerce_Shop_Typo_Configs();





