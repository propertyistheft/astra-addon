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

if ( ! class_exists( 'Astra_Woocommerce_Shop_Colors_Configs' ) ) {

	/**
	 * Register Blog Single Layout Configurations.
	 */
	// @codingStandardsIgnoreStart
	class Astra_Woocommerce_Shop_Colors_Configs extends Astra_Customizer_Config_Base {
 // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedClassFound
		// @codingStandardsIgnoreEnd

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

				array(
					'name'     => ASTRA_THEME_SETTINGS . '[woo-shop-design-general-divider]',
					'section'  => 'woocommerce_product_catalog',
					'title'    => __( 'General Colors', 'astra-addon' ),
					'type'     => 'control',
					'control'  => 'ast-heading',
					'priority' => 228,
					'settings' => array(),
					'context'  => array(
						astra_addon_builder_helper()->design_tab_config,
					),
				),

				/**
				 * Shop Product Title Color
				 */
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[shop-product-title-color]',
					'default'           => astra_get_option( 'shop-product-title-color' ),
					'type'              => 'control',
					'section'           => 'woocommerce_product_catalog',
					'control'           => 'ast-color',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
					'transport'         => 'postMessage',
					'title'             => __( 'Product Title', 'astra-addon' ),
					'context'           => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[shop-product-structure]',
							'operator' => 'contains',
							'value'    => 'title',
						),
					),
					'priority'          => 228,
					'divider'           => array( 'ast_class' => 'ast-section-spacing' ),
				),

				/**
				 * Shop Product Price Color
				 */
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[shop-product-price-color]',
					'default'           => astra_get_option( 'shop-product-price-color' ),
					'type'              => 'control',
					'section'           => 'woocommerce_product_catalog',
					'control'           => 'ast-color',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
					'transport'         => 'postMessage',
					'title'             => __( 'Product Price', 'astra-addon' ),
					'context'           => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[shop-product-structure]',
							'operator' => 'contains',
							'value'    => 'title',
						),
					),
					'priority'          => 228,
				),

				/**
				 * Shop Product Content Color
				 */
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[shop-product-content-color]',
					'default'           => astra_get_option( 'shop-product-content-color' ),
					'type'              => 'control',
					'section'           => 'woocommerce_product_catalog',
					'control'           => 'ast-color',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
					'transport'         => 'postMessage',
					'title'             => __( 'Product Content', 'astra-addon' ),
					'context'           => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[shop-product-structure]',
							'operator' => 'contains',
							'value'    => 'title',
						),
					),
					'priority'          => 228,
				),
			);

			return array_merge( $configurations, $_configs );
		}
	}
}

new Astra_Woocommerce_Shop_Colors_Configs();
