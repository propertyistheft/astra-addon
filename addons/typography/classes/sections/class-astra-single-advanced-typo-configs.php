<?php
/**
 * Section [Footer] options for astra theme.
 *
 * @package     Astra Addon
 * @author      Brainstorm Force
 * @copyright   Copyright (c) 2020, Brainstorm Force
 * @link        https://www.brainstormforce.com
 * @since       1.0.0
 */

// Block direct access to the file.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Bail if Customizer config base class does not exist.
if ( ! class_exists( 'Astra_Customizer_Config_Base' ) ) {
	return;
}

if ( ! class_exists( 'Astra_Single_Advanced_Typo_Configs' ) ) {

	/**
	 * Register below header Configurations.
	 */
	class Astra_Single_Advanced_Typo_Configs extends Astra_Customizer_Config_Base {

		/**
		 * Register Side bar typography Customizer Configurations.
		 *
		 * @param Array                $configurations Astra Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array Astra Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_configs = array(

				/**
				 * Option: Single Post / Page Title Font Family
				 */
				array(
					'name'      => 'font-family-entry-title',
					'parent'    => ASTRA_THEME_SETTINGS . '[blog-single-title-typo]',
					'section'   => 'section-blog-single',
					'type'      => 'sub-control',
					'control'   => 'ast-font',
					'font_type' => 'ast-font-family',
					'default'   => astra_get_option( 'font-family-entry-title' ),
					'title'     => __( 'Family', 'astra-addon' ),
					'connect'   => ASTRA_THEME_SETTINGS . '[font-weight-entry-title]',
					'priority'  => 7,
				),

				/**
				 * Option: Single Post / Page Title Font Weight
				 */
				array(
					'name'              => 'font-weight-entry-title',
					'parent'            => ASTRA_THEME_SETTINGS . '[blog-single-title-typo]',
					'section'           => 'section-blog-single',
					'type'              => 'sub-control',
					'control'           => 'ast-font',
					'font_type'         => 'ast-font-weight',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_font_weight' ),
					'default'           => astra_get_option( 'font-weight-entry-title' ),
					'title'             => __( 'Weight', 'astra-addon' ),
					'connect'           => 'font-family-entry-title',
					'priority'          => 9,
				),

				/**
				 * Option: Single Post / Page Title Line Height
				 */
				array(
					'name'              => 'line-height-entry-title',
					'parent'            => ASTRA_THEME_SETTINGS . '[blog-single-title-typo]',
					'section'           => 'section-blog-single',
					'type'              => 'sub-control',
					'transport'         => 'postMessage',
					'default'           => astra_get_option( 'line-height-entry-title' ),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_number_n_blank' ),
					'title'             => __( 'Line Height', 'astra-addon' ),
					'control'           => 'ast-slider',
					'priority'          => 15,
					'suffix'            => 'em',
					'input_attrs'       => array(
						'min'  => 1,
						'step' => 0.01,
						'max'  => 5,
					),
				),

				/**
				 * Option: Single Post / Page Title Text Transform
				 */
				array(
					'name'      => 'text-transform-entry-title',
					'parent'    => ASTRA_THEME_SETTINGS . '[blog-single-title-typo]',
					'section'   => 'section-blog-single',
					'type'      => 'sub-control',
					'title'     => __( 'Text Transform', 'astra-addon' ),
					'default'   => astra_get_option( 'text-transform-entry-title' ),
					'transport' => 'postMessage',
					'control'   => 'ast-select',
					'priority'  => 10,
					'choices'   => array(
						''           => __( 'Inherit', 'astra-addon' ),
						'none'       => __( 'None', 'astra-addon' ),
						'capitalize' => __( 'Capitalize', 'astra-addon' ),
						'uppercase'  => __( 'Uppercase', 'astra-addon' ),
						'lowercase'  => __( 'Lowercase', 'astra-addon' ),
					),
				),
			);

			return array_merge( $configurations, $_configs );
		}
	}
}

new Astra_Single_Advanced_Typo_Configs();


