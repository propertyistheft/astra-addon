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

if ( ! class_exists( 'Astra_Edd_Single_Colors_Configs' ) ) {

	/**
	 * Register Easy Digital Downloads Shop Single Color Layout Configurations.
	 */
	class Astra_Edd_Single_Colors_Configs extends Astra_Customizer_Config_Base {

		/**
		 * Register Easy Digital Downloads Shop Single Color Layout Configurations.
		 *
		 * @param Array                $configurations Astra Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.6.10
		 * @return Array Astra Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_configs = array(

				/**
				 * Single Product Title Color
				 */
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[edd-single-product-title-color]',
					'section'           => 'section-edd-single',
					'default'           => astra_get_option( 'edd-single-product-title-color' ),
					'type'              => 'control',
					'control'           => 'ast-color',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
					'transport'         => 'postMessage',
					'title'             => __( 'Product Title', 'astra-addon' ),
					'priority'          => 231,
				),

				/**
				 * Single Product Content Color
				 */
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[edd-single-product-content-color]',
					'section'           => 'section-edd-single',
					'default'           => astra_get_option( 'edd-single-product-content-color' ),
					'type'              => 'control',
					'control'           => 'ast-color',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
					'transport'         => 'postMessage',
					'title'             => __( 'Product Content', 'astra-addon' ),
					'priority'          => 231,
				),

				/**
				 * Single Product Breadcrumb Color
				 */
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[edd-single-product-navigation-color]',
					'section'           => 'section-edd-single',
					'default'           => astra_get_option( 'edd-single-product-navigation-color' ),
					'type'              => 'control',
					'control'           => 'ast-color',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
					'context'           => array(
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[disable-edd-single-product-nav]',
							'operator' => '!=',
							'value'    => '1',
						),
					),
					'transport'         => 'postMessage',
					'title'             => __( 'Product Navigation', 'astra-addon' ),
					'priority'          => 231,
				),
			);

			$configurations = array_merge( $configurations, $_configs );

			return $configurations;

		}
	}
}


new Astra_Edd_Single_Colors_Configs();





