<?php
/**
 * [Header] options for astra theme.
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

if ( ! class_exists( 'Astra_Site_Header_Typo_Configs' ) ) {

	/**
	 * Register below header Configurations.
	 */
	class Astra_Site_Header_Typo_Configs extends Astra_Customizer_Config_Base {

		/**
		 * Register Footer typography Customizer Configurations.
		 *
		 * @param Array                $configurations Astra Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array Astra Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_configs = array(

				/**
				 * Option: Site Title Font Family
				 */
				array(
					'name'      => 'font-family-site-title',
					'type'      => 'sub-control',
					'parent'    => ASTRA_THEME_SETTINGS . '[site-title-typography]',
					'section'   => 'title_tagline',
					'control'   => 'ast-font',
					'font_type' => 'ast-font-family',
					'default'   => astra_get_option( 'font-family-site-title' ),
					'title'     => __( 'Family', 'astra-addon' ),
					'priority'  => 8,
					'connect'   => ASTRA_THEME_SETTINGS . '[font-weight-site-title]',
				),

				/**
				 * Option: Site Title Font Weight
				 */
				array(
					'name'      => 'font-weight-site-title',
					'control'   => 'ast-font',
					'parent'    => ASTRA_THEME_SETTINGS . '[site-title-typography]',
					'section'   => 'title_tagline',
					'font_type' => 'ast-font-weight',
					'type'      => 'sub-control',
					'title'     => __( 'Weight', 'astra-addon' ),
					'default'   => astra_get_option( 'font-weight-site-title' ),
					'priority'  => 10,
					'connect'   => 'font-family-site-title',
				),

				/**
				 * Option: Site Title Text Transform
				 */
				array(
					'name'      => 'text-transform-site-title',
					'type'      => 'sub-control',
					'parent'    => ASTRA_THEME_SETTINGS . '[site-title-typography]',
					'section'   => 'title_tagline',
					'default'   => astra_get_option( 'text-transform-site-title' ),
					'title'     => __( 'Text Transform', 'astra-addon' ),
					'transport' => 'postMessage',
					'control'   => 'ast-select',
					'priority'  => 11,
					'choices'   => array(
						''           => __( 'Inherit', 'astra-addon' ),
						'none'       => __( 'None', 'astra-addon' ),
						'capitalize' => __( 'Capitalize', 'astra-addon' ),
						'uppercase'  => __( 'Uppercase', 'astra-addon' ),
						'lowercase'  => __( 'Lowercase', 'astra-addon' ),
					),
				),

				/**
				 * Option: Site Title Line Height
				 */
				array(
					'name'              => 'line-height-site-title',
					'parent'            => ASTRA_THEME_SETTINGS . '[site-title-typography]',
					'section'           => 'title_tagline',
					'type'              => 'sub-control',
					'title'             => __( 'Line Height', 'astra-addon' ),
					'transport'         => 'postMessage',
					'default'           => astra_get_option( 'line-height-site-title' ),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_number_n_blank' ),
					'control'           => 'ast-slider',
					'priority'          => 12,
					'suffix'            => 'em',
					'input_attrs'       => array(
						'min'  => 1,
						'step' => 0.01,
						'max'  => 5,
					),
				),

				/**
				 * Option: Site Tagline Font Family
				 */
				array(
					'name'      => 'font-family-site-tagline',
					'type'      => 'sub-control',
					'parent'    => ASTRA_THEME_SETTINGS . '[site-tagline-typography]',
					'section'   => 'title_tagline',
					'control'   => 'ast-font',
					'font_type' => 'ast-font-family',
					'default'   => astra_get_option( 'font-family-site-tagline' ),
					'title'     => __( 'Family', 'astra-addon' ),
					'priority'  => 13,
					'connect'   => ASTRA_THEME_SETTINGS . '[font-weight-site-tagline]',
				),

				/**
				 * Option: Site Tagline Font Weight
				 */
				array(
					'name'      => 'font-weight-site-tagline',
					'control'   => 'ast-font',
					'parent'    => ASTRA_THEME_SETTINGS . '[site-tagline-typography]',
					'section'   => 'title_tagline',
					'font_type' => 'ast-font-weight',
					'type'      => 'sub-control',
					'default'   => astra_get_option( 'font-weight-site-tagline' ),
					'title'     => __( 'Weight', 'astra-addon' ),
					'priority'  => 15,
					'connect'   => 'font-family-site-tagline',
				),

				/**
				 * Option: Site Tagline Text Transform
				 */
				array(
					'name'      => 'text-transform-site-tagline',
					'type'      => 'sub-control',
					'parent'    => ASTRA_THEME_SETTINGS . '[site-tagline-typography]',
					'section'   => 'title_tagline',
					'title'     => __( 'Text Transform', 'astra-addon' ),
					'transport' => 'postMessage',
					'default'   => astra_get_option( 'text-transform-site-tagline' ),
					'control'   => 'ast-select',
					'priority'  => 16,
					'choices'   => array(
						''           => __( 'Inherit', 'astra-addon' ),
						'none'       => __( 'None', 'astra-addon' ),
						'capitalize' => __( 'Capitalize', 'astra-addon' ),
						'uppercase'  => __( 'Uppercase', 'astra-addon' ),
						'lowercase'  => __( 'Lowercase', 'astra-addon' ),
					),
				),

				/**
				 * Option: Site Tagline Line Height
				 */

				array(
					'name'              => 'line-height-site-tagline',
					'type'              => 'sub-control',
					'parent'            => ASTRA_THEME_SETTINGS . '[site-tagline-typography]',
					'section'           => 'title_tagline',
					'default'           => astra_get_option( 'line-height-site-tagline' ),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_number_n_blank' ),
					'title'             => __( 'Line Height', 'astra-addon' ),
					'transport'         => 'postMessage',
					'control'           => 'ast-slider',
					'priority'          => 17,
					'suffix'            => 'em',
					'input_attrs'       => array(
						'min'  => 1,
						'step' => 0.01,
						'max'  => 5,
					),
				),
			);

			return array_merge( $configurations, $_configs );
		}
	}
}

new Astra_Site_Header_Typo_Configs();
