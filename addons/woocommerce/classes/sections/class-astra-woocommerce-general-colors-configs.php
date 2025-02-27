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

if ( ! class_exists( 'Astra_Woocommerce_General_Colors_Configs' ) ) {

	/**
	 * Register Woocommerce general Color Layout Configurations.
	 */
	// @codingStandardsIgnoreStart
	class Astra_Woocommerce_General_Colors_Configs extends Astra_Customizer_Config_Base {
 // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedClassFound
		// @codingStandardsIgnoreEnd

		/**
		 * Register Woocommerce general Color Layout Configurations.
		 *
		 * @param Array                $configurations Astra Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array Astra Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_configs = array(

				/**
				 * Single Product Rating Color
				 */
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[single-product-rating-color]',
					'default'           => astra_get_option( 'single-product-rating-color' ),
					'type'              => 'control',
					'control'           => 'ast-color',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
					'transport'         => 'postMessage',
					'title'             => __( 'Product Rating Color', 'astra-addon' ),
					'section'           => 'section-woo-misc',
					'priority'          => 24,
					'context'           => array(
						astra_addon_builder_helper()->design_tab_config,
					),
					'divider'           => array( 'ast_class' => 'ast-section-spacing' ),
				),

			);

			return array_merge( $configurations, $_configs );
		}
	}
}

new Astra_Woocommerce_General_Colors_Configs();
