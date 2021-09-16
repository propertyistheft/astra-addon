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

if ( ! class_exists( 'Astra_Woocommerce_Shop_Single_Typo_Configs' ) ) {

	/**
	 * Register Blog Single Layout Configurations.
	 */
	class Astra_Woocommerce_Shop_Single_Typo_Configs extends Astra_Customizer_Config_Base {

		/**
		 * Register Blog Single Layout Configurations.
		 *
		 * @param Array                $configurations Astra Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array Astra Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_configs = array(

				/**
				 * Group: WooCommerce Single product title Group
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[single-product-title-group]',
					'default'   => astra_get_option( 'single-product-title-group' ),
					'type'      => 'control',
					'control'   => 'ast-settings-group',
					'title'     => __( 'Title Font', 'astra-addon' ),
					'section'   => 'section-woo-shop-single',
					'transport' => 'postMessage',
					'context'   => array(
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[single-product-structure]',
							'operator' => 'contains',
							'value'    => 'title',
						),
					),

					'priority'  => 82,
				),

				/**
				 * Option: Single Product Title Font Family
				 */
				array(
					'name'      => 'font-family-product-title',
					'default'   => astra_get_option( 'font-family-product-title' ),
					'type'      => 'sub-control',
					'parent'    => ASTRA_THEME_SETTINGS . '[single-product-title-group]',
					'section'   => 'section-woo-shop-single',
					'control'   => 'ast-font',
					'font_type' => 'ast-font-family',
					'title'     => __( 'Family', 'astra-addon' ),
					'connect'   => 'font-weight-product-title',
					'priority'  => 4,
				),

				/**
				 * Option: Single Product Title Font Weight
				 */
				array(
					'name'              => 'font-weight-product-title',
					'default'           => astra_get_option( 'font-weight-product-title' ),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_font_weight' ),
					'type'              => 'sub-control',
					'parent'            => ASTRA_THEME_SETTINGS . '[single-product-title-group]',
					'section'           => 'section-woo-shop-single',
					'control'           => 'ast-font',
					'font_type'         => 'ast-font-weight',
					'title'             => __( 'Weight', 'astra-addon' ),
					'connect'           => 'font-family-product-title',
					'priority'          => 5,
				),

				/**
					 * Option: Single Product Title Text Transform
					 */
				array(
					'name'      => 'text-transform-product-title',
					'default'   => astra_get_option( 'text-transform-product-title' ),
					'type'      => 'sub-control',
					'parent'    => ASTRA_THEME_SETTINGS . '[single-product-title-group]',
					'section'   => 'section-woo-shop-single',
					'transport' => 'postMessage',
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
				 * Option: Single Product Title Font Size
				 */
				array(
					'name'        => 'font-size-product-title',
					'default'     => astra_get_option( 'font-size-product-title' ),
					'type'        => 'sub-control',
					'parent'      => ASTRA_THEME_SETTINGS . '[single-product-title-group]',
					'section'     => 'section-woo-shop-single',
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
				 * Option: Single Product Title Line Height
				 */
				array(
					'name'              => 'line-height-product-title',
					'default'           => astra_get_option( 'line-height-product-title' ),
					'type'              => 'sub-control',
					'parent'            => ASTRA_THEME_SETTINGS . '[single-product-title-group]',
					'section'           => 'section-woo-shop-single',
					'transport'         => 'postMessage',
					'title'             => __( 'Line Height', 'astra-addon' ),
					'control'           => 'ast-slider',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_number_n_blank' ),
					'priority'          => 5,
					'suffix'            => 'em',
					'input_attrs'       => array(
						'min'  => 1,
						'step' => 0.01,
						'max'  => 5,
					),
				),

				/**
				 * Group: WooCommerce Single product price Group
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[single-product-price-group]',
					'default'   => astra_get_option( 'single-product-price-group' ),
					'type'      => 'control',
					'control'   => 'ast-settings-group',
					'title'     => __( 'Price Font', 'astra-addon' ),
					'section'   => 'section-woo-shop-single',
					'transport' => 'postMessage',
					'context'   => array(
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[single-product-structure]',
							'operator' => 'contains',
							'value'    => 'title',
						),
					),
					'priority'  => 82,
				),

				/**
				 * Option: Single Product Price Font Family
				 */
				array(
					'name'      => 'font-family-product-price',
					'default'   => astra_get_option( 'font-family-product-price' ),
					'type'      => 'sub-control',
					'parent'    => ASTRA_THEME_SETTINGS . '[single-product-price-group]',
					'section'   => 'section-woo-shop-single',
					'control'   => 'ast-font',
					'font_type' => 'ast-font-family',
					'title'     => __( 'Family', 'astra-addon' ),
					'connect'   => ASTRA_THEME_SETTINGS . '[font-weight-product-price]',
					'priority'  => 9,
				),

				/**
				 * Option: Single Product price Font Weight
				 */
				array(
					'name'              => 'font-weight-product-price',
					'default'           => astra_get_option( 'font-weight-product-price' ),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_font_weight' ),
					'type'              => 'sub-control',
					'parent'            => ASTRA_THEME_SETTINGS . '[single-product-price-group]',
					'section'           => 'section-woo-shop-single',
					'control'           => 'ast-font',
					'font_type'         => 'ast-font-weight',
					'title'             => __( 'Weight', 'astra-addon' ),
					'connect'           => 'font-family-product-price',
					'priority'          => 10,
				),

				/**
				 * Option: Single Product Price Font Size
				 */
				array(
					'name'        => 'font-size-product-price',
					'default'     => astra_get_option( 'font-size-product-price' ),
					'type'        => 'sub-control',
					'parent'      => ASTRA_THEME_SETTINGS . '[single-product-price-group]',
					'section'     => 'section-woo-shop-single',
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
				 * Option: Single Product Price Line Height
				 */
				array(
					'name'        => 'line-height-product-price',
					'default'     => astra_get_option( 'line-height-product-price' ),
					'type'        => 'sub-control',
					'parent'      => ASTRA_THEME_SETTINGS . '[single-product-price-group]',
					'section'     => 'section-woo-shop-single',
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
				 * Group: WooCommerce Single product breadcrumb Group
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[single-product-breadcrumb-group]',
					'default'   => astra_get_option( 'single-product-breadcrumb-group' ),
					'type'      => 'control',
					'control'   => 'ast-settings-group',
					'title'     => __( 'Breadcrumb Font', 'astra-addon' ),
					'section'   => 'section-woo-shop-single',
					'transport' => 'postMessage',
					'context'   => array(
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[single-product-breadcrumb-disable]',
							'operator' => '!=',
							'value'    => 1,
						),
					),
					'priority'  => 82,
				),

				/**
				 * Option: Single Product Breadcrumb Font Family
				 */
				array(
					'name'      => 'font-family-product-breadcrumb',
					'default'   => astra_get_option( 'font-family-product-breadcrumb' ),
					'type'      => 'sub-control',
					'parent'    => ASTRA_THEME_SETTINGS . '[single-product-breadcrumb-group]',
					'section'   => 'section-woo-shop-single',
					'control'   => 'ast-font',
					'font_type' => 'ast-font-family',
					'title'     => __( 'Family', 'astra-addon' ),
					'connect'   => ASTRA_THEME_SETTINGS . '[font-weight-product-breadcrumb]',
					'priority'  => 14,
				),

				/**
				 * Option: Single Product Breadcrumb Font Weight
				 */
				array(
					'name'              => 'font-weight-product-breadcrumb',
					'default'           => astra_get_option( 'font-weight-product-breadcrumb' ),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_font_weight' ),
					'type'              => 'sub-control',
					'parent'            => ASTRA_THEME_SETTINGS . '[single-product-breadcrumb-group]',
					'section'           => 'section-woo-shop-single',
					'control'           => 'ast-font',
					'font_type'         => 'ast-font-weight',
					'title'             => __( 'Weight', 'astra-addon' ),
					'connect'           => 'font-family-product-breadcrumb',
					'priority'          => 15,
				),

				/**
					 * Option: Single Product Breadcrumb Text Transform
					 */
				array(
					'name'      => 'text-transform-product-breadcrumb',
					'default'   => astra_get_option( 'text-transform-product-breadcrumb' ),
					'type'      => 'sub-control',
					'parent'    => ASTRA_THEME_SETTINGS . '[single-product-breadcrumb-group]',
					'section'   => 'section-woo-shop-single',
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
				 * Option: Single Product Breadcrumb Font Size
				 */
				array(
					'name'        => 'font-size-product-breadcrumb',
					'default'     => astra_get_option( 'font-size-product-breadcrumb' ),
					'type'        => 'sub-control',
					'parent'      => ASTRA_THEME_SETTINGS . '[single-product-breadcrumb-group]',
					'section'     => 'section-woo-shop-single',
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
				 * Option: Single Product Breadcrumb Line Height
				 */
				array(
					'name'        => 'line-height-product-breadcrumb',
					'default'     => astra_get_option( 'line-height-product-breadcrumb' ),
					'type'        => 'sub-control',
					'parent'      => ASTRA_THEME_SETTINGS . '[single-product-breadcrumb-group]',
					'section'     => 'section-woo-shop-single',
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

				/**
				 * Group: WooCommerce Single product content Group
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[single-product-content-group]',
					'default'   => astra_get_option( 'single-product-content-group' ),
					'type'      => 'control',
					'control'   => 'ast-settings-group',
					'title'     => __( 'Content Font', 'astra-addon' ),
					'section'   => 'section-woo-shop-single',
					'transport' => 'postMessage',
					'priority'  => 82,
				),

				/**
				 * Option: Single Product Content Font Family
				 */
				array(
					'name'      => 'font-family-product-content',
					'default'   => astra_get_option( 'font-family-product-content' ),
					'type'      => 'sub-control',
					'parent'    => ASTRA_THEME_SETTINGS . '[single-product-content-group]',
					'section'   => 'section-woo-shop-single',
					'control'   => 'ast-font',
					'font_type' => 'ast-font-family',
					'title'     => __( 'Family', 'astra-addon' ),
					'connect'   => ASTRA_THEME_SETTINGS . '[font-weight-product-content]',
					'priority'  => 19,
				),

				/**
				 * Option: Single Product Content Font Weight
				 */
				array(
					'name'              => 'font-weight-product-content',
					'default'           => astra_get_option( 'font-weight-product-content' ),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_font_weight' ),
					'type'              => 'sub-control',
					'parent'            => ASTRA_THEME_SETTINGS . '[single-product-content-group]',
					'section'           => 'section-woo-shop-single',
					'control'           => 'ast-font',
					'font_type'         => 'ast-font-weight',
					'title'             => __( 'Weight', 'astra-addon' ),
					'connect'           => 'font-family-product-content',
					'priority'          => 20,
				),

				/**
					 * Option: Single Product Content Text Transform
					 */
				array(
					'name'      => 'text-transform-product-content',
					'default'   => astra_get_option( 'text-transform-product-content' ),
					'type'      => 'sub-control',
					'parent'    => ASTRA_THEME_SETTINGS . '[single-product-content-group]',
					'section'   => 'section-woo-shop-single',
					'transport' => 'postMessage',
					'title'     => __( 'Text Transform', 'astra-addon' ),
					'control'   => 'ast-select',
					'priority'  => 20,
					'choices'   => array(
						''           => __( 'Inherit', 'astra-addon' ),
						'none'       => __( 'None', 'astra-addon' ),
						'capitalize' => __( 'Capitalize', 'astra-addon' ),
						'uppercase'  => __( 'Uppercase', 'astra-addon' ),
						'lowercase'  => __( 'Lowercase', 'astra-addon' ),
					),
				),

				/**
				 * Option: Single Product Content Font Size
				 */
				array(
					'name'        => 'font-size-product-content',
					'default'     => astra_get_option( 'font-size-product-content' ),
					'type'        => 'sub-control',
					'parent'      => ASTRA_THEME_SETTINGS . '[single-product-content-group]',
					'section'     => 'section-woo-shop-single',
					'transport'   => 'postMessage',
					'control'     => 'ast-responsive',
					'priority'    => 19,
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
				 * Option: Single Product Content Line Height
				 */
				array(
					'name'        => 'line-height-product-content',
					'default'     => astra_get_option( 'line-height-product-content' ),
					'type'        => 'sub-control',
					'parent'      => ASTRA_THEME_SETTINGS . '[single-product-content-group]',
					'section'     => 'section-woo-shop-single',
					'transport'   => 'postMessage',
					'title'       => __( 'Line Height', 'astra-addon' ),
					'control'     => 'ast-slider',
					'priority'    => 20,
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


new Astra_Woocommerce_Shop_Single_Typo_Configs();





