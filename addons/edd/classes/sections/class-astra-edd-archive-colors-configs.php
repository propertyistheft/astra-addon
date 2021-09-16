<?php
/**
 * Shop Options for our theme.
 *
 * @package     Astra Addon
 * @author      Brainstorm Force
 * @copyright   Copyright (c) 2020, Brainstorm Force
 * @link        https://www.brainstormforce.com
 * @since       Astra 1.6.10
 */

// Block direct access to the file.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Bail if Customizer config base class does not exist.
if ( ! class_exists( 'Astra_Customizer_Config_Base' ) ) {
	return;
}

if ( ! class_exists( 'Astra_Edd_Archive_Colors_Configs' ) ) {

	/**
	 * Register Blog Single Layout Configurations.
	 */
	class Astra_Edd_Archive_Colors_Configs extends Astra_Customizer_Config_Base {

		/**
		 * Register Blog Single Layout Configurations.
		 *
		 * @param Array                $configurations Astra Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.6.10
		 * @return Array Astra Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_configs = array(

				/**
				 * Shop Product Title Color
				 */
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[edd-archive-product-title-color]',
					'section'           => 'section-edd-archive',
					'default'           => astra_get_option( 'edd-archive-product-title-color' ),
					'type'              => 'control',
					'control'           => 'ast-color',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
					'transport'         => 'postMessage',
					'context'           => array(
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[edd-archive-product-structure]',
							'operator' => 'contains',
							'value'    => 'title',
						),
					),
					'title'             => __( 'Product Title', 'astra-addon' ),
					'priority'          => 231,
				),

				/**
				 * Shop Product Price Color
				 */
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[edd-archive-product-price-color]',
					'section'           => 'section-edd-archive',
					'default'           => astra_get_option( 'edd-archive-product-price-color' ),
					'type'              => 'control',
					'control'           => 'ast-color',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
					'transport'         => 'postMessage',
					'context'           => array(
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[edd-archive-product-structure]',
							'operator' => 'contains',
							'value'    => 'price',
						),
					),
					'title'             => __( 'Product Price', 'astra-addon' ),
					'priority'          => 231,
				),

				/**
				 * Shop Product Content Color
				 */
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[edd-archive-product-content-color]',
					'section'           => 'section-edd-archive',
					'default'           => astra_get_option( 'edd-archive-product-content-color' ),
					'type'              => 'control',
					'divider'           => array( 'ast_class' => 'ast-bottom-divider' ),
					'control'           => 'ast-color',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
					'transport'         => 'postMessage',
					'title'             => __( 'Product Content', 'astra-addon' ),
					'priority'          => 231,
				),
			);
			return array_merge( $configurations, $_configs );
		}
	}
}

new Astra_Edd_Archive_Colors_Configs();
