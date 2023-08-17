<?php
/**
 * Shop Options for our theme.
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

if ( ! class_exists( 'Astra_Woocommerce_Shop_Typo_Configs' ) ) {

	/**
	 * Register Woocommerce Shop Typo Layout Configurations.
	 */
	// @codingStandardsIgnoreStart
	class Astra_Woocommerce_Shop_Typo_Configs extends Astra_Customizer_Config_Base {
 // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedClassFound
		// @codingStandardsIgnoreEnd

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
				 * Option: Divider
				 */

				array(
					'name'     => ASTRA_THEME_SETTINGS . '[woo-shop-general-fonts-divider]',
					'section'  => 'woocommerce_product_catalog',
					'title'    => __( 'General Fonts', 'astra-addon' ),
					'type'     => 'control',
					'control'  => 'ast-heading',
					'priority' => 230,
					'settings' => array(),
					'context'  => array(
						astra_addon_builder_helper()->design_tab_config,
					),
					'divider'  => array( 'ast_class' => 'ast-section-spacing' ),
				),

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
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[shop-product-structure]',
							'operator' => 'contains',
							'value'    => 'title',
						),
					),
					'priority'  => 230,
					'divider'   => array( 'ast_class' => 'ast-section-spacing' ),
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
					'title'     => __( 'Font Family', 'astra-addon' ),
					'divider'   => array( 'ast_class' => 'ast-sub-bottom-dotted-divider' ),
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
					'title'             => __( 'Font Weight', 'astra-addon' ),
					'connect'           => 'font-family-shop-product-title',
					'divider'           => array( 'ast_class' => 'ast-sub-bottom-dotted-divider' ),
					'priority'          => 4,
				),

				/**
				 * Option: Product Title Font Size
				 */
				array(
					'name'              => 'font-size-shop-product-title',
					'parent'            => ASTRA_THEME_SETTINGS . '[shop-product-title-group]',
					'section'           => 'woocommerce_product_catalog',
					'control'           => 'ast-responsive-slider',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_responsive_slider' ),
					'type'              => 'sub-control',
					'transport'         => 'postMessage',
					'title'             => __( 'Font Size', 'astra-addon' ),
					'priority'          => 4,
					'default'           => astra_get_option( 'font-size-shop-product-title' ),
					'suffix'            => array( 'px', 'em' ),
					'input_attrs'       => array(
						'px' => array(
							'min'  => 0,
							'step' => 1,
							'max'  => 200,
						),
						'em' => array(
							'min'  => 0,
							'step' => 0.01,
							'max'  => 20,
						),
					),
				),

				/**
				 * Option: Product title Extras.
				 */
				array(
					'name'     => 'font-extras-shop-product-title',
					'type'     => 'sub-control',
					'parent'   => ASTRA_THEME_SETTINGS . '[shop-product-title-group]',
					'control'  => 'ast-font-extras',
					'section'  => 'woocommerce_product_catalog',
					'priority' => 5,
					'default'  => astra_get_option( 'font-extras-shop-product-title' ),
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
						astra_addon_builder_helper()->design_tab_config,
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
					'divider'   => array( 'ast_class' => 'ast-sub-bottom-dotted-divider' ),
					'title'     => __( 'Font Family', 'astra-addon' ),
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
					'divider'           => array( 'ast_class' => 'ast-sub-bottom-dotted-divider' ),
					'font_type'         => 'ast-font-weight',
					'title'             => __( 'Font Weight', 'astra-addon' ),
					'connect'           => 'font-family-shop-product-price',
					'priority'          => 9,
				),

				/**
				 * Option: Product Price Font Size
				 */
				array(
					'name'              => 'font-size-shop-product-price',
					'default'           => astra_get_option( 'font-size-shop-product-price' ),
					'type'              => 'sub-control',
					'parent'            => ASTRA_THEME_SETTINGS . '[shop-product-price-group]',
					'section'           => 'woocommerce_product_catalog',
					'transport'         => 'postMessage',
					'control'           => 'ast-responsive-slider',
					'priority'          => 9,
					'title'             => __( 'Font Size', 'astra-addon' ),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_responsive_slider' ),
					'suffix'            => array( 'px', 'em' ),
					'input_attrs'       => array(
						'px' => array(
							'min'  => 0,
							'step' => 1,
							'max'  => 200,
						),
						'em' => array(
							'min'  => 0,
							'step' => 0.01,
							'max'  => 20,
						),
					),
				),

				/**
				 * Option: Product Price text extras.
				 */
				array(
					'name'     => 'font-extras-shop-product-price',
					'type'     => 'sub-control',
					'parent'   => ASTRA_THEME_SETTINGS . '[shop-product-price-group]',
					'control'  => 'ast-font-extras',
					'section'  => 'woocommerce_product_catalog',
					'priority' => 9,
					'default'  => astra_get_option( 'font-extras-shop-product-price' ),
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
						astra_addon_builder_helper()->design_tab_config,
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
					'divider'   => array( 'ast_class' => 'ast-sub-bottom-dotted-divider' ),
					'title'     => __( 'Font Family', 'astra-addon' ),
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
					'divider'           => array( 'ast_class' => 'ast-sub-bottom-dotted-divider' ),
					'title'             => __( 'Font Weight', 'astra-addon' ),
					'connect'           => 'font-family-shop-product-content',
					'priority'          => 14,
				),

				/**
				 * Option: Product Content Font Size
				 */
				array(
					'name'              => 'font-size-shop-product-content',
					'parent'            => ASTRA_THEME_SETTINGS . '[shop-product-content-group]',
					'section'           => 'woocommerce_product_catalog',
					'control'           => 'ast-responsive-slider',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_responsive_slider' ),
					'type'              => 'sub-control',
					'transport'         => 'postMessage',
					'title'             => __( 'Font Size', 'astra-addon' ),
					'priority'          => 14,
					'default'           => astra_get_option( 'font-size-shop-product-content' ),
					'suffix'            => array( 'px', 'em' ),
					'input_attrs'       => array(
						'px' => array(
							'min'  => 0,
							'step' => 1,
							'max'  => 200,
						),
						'em' => array(
							'min'  => 0,
							'step' => 0.01,
							'max'  => 20,
						),
					),
				),

				/**
				 * Option: Product Title Text extras
				 */
				array(
					'name'     => 'font-extras-shop-product-content',
					'type'     => 'sub-control',
					'parent'   => ASTRA_THEME_SETTINGS . '[shop-product-content-group]',
					'control'  => 'ast-font-extras',
					'section'  => 'woocommerce_product_catalog',
					'priority' => 15,
					'default'  => astra_get_option( 'font-extras-shop-product-content' ),
				),
			);

			$configurations = array_merge( $configurations, $_configs );

			return $configurations;

		}
	}
}

new Astra_Woocommerce_Shop_Typo_Configs();
