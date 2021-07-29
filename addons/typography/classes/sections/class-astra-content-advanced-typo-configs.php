<?php
/**
 * Section [Content] options for astra theme.
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

if ( ! class_exists( 'Astra_Content_Advanced_Typo_Configs' ) ) {

	/**
	 * Register below header Configurations.
	 */
	class Astra_Content_Advanced_Typo_Configs extends Astra_Customizer_Config_Base {

		/**
		 * Register Header Layout Customizer Configurations.
		 *
		 * @param Array                $configurations Astra Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array Astra Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_configs = array(

				/**
				 * Option: Heading <H1> Font Family
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[font-family-h1]',
					'type'      => 'control',
					'control'   => 'ast-font',
					'font-type' => 'ast-font-family',
					'default'   => astra_get_option( 'font-family-h1' ),
					'title'     => __( 'Family', 'astra-addon' ),
					'section'   => 'section-content-typo',
					'priority'  => 5,
					'connect'   => ASTRA_THEME_SETTINGS . '[font-weight-h1]',
					'transport' => 'postMessage',
				),

				/**
				 * Option: Heading <H1> Font Weight
				 */
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[font-weight-h1]',
					'type'              => 'control',
					'control'           => 'ast-font',
					'font-type'         => 'ast-font-weight',
					'title'             => __( 'Weight', 'astra-addon' ),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_font_weight' ),
					'default'           => astra_get_option( 'font-weight-h1' ),
					'section'           => 'section-content-typo',
					'priority'          => 7,
					'connect'           => ASTRA_THEME_SETTINGS . '[font-family-h1]',
					'transport'         => 'postMessage',
				),

				/**
				 * Option: Heading <H1> Text Transform
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[text-transform-h1]',
					'section'   => 'section-content-typo',
					'default'   => astra_get_option( 'text-transform-h1' ),
					'title'     => __( 'Text Transform', 'astra-addon' ),
					'type'      => 'control',
					'control'   => 'ast-select',
					'priority'  => 8,
					'choices'   => array(
						''           => __( 'Inherit', 'astra-addon' ),
						'none'       => __( 'None', 'astra-addon' ),
						'capitalize' => __( 'Capitalize', 'astra-addon' ),
						'uppercase'  => __( 'Uppercase', 'astra-addon' ),
						'lowercase'  => __( 'Lowercase', 'astra-addon' ),
					),
					'transport' => 'postMessage',
				),

				/**
				 * Option: Heading <H1> Line Height
				 */
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[line-height-h1]',
					'section'           => 'section-content-typo',
					'default'           => astra_get_option( 'line-height-h1' ),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_number_n_blank' ),
					'type'              => 'control',
					'control'           => 'ast-slider',
					'title'             => __( 'Line Height', 'astra-addon' ),
					'transport'         => 'postMessage',
					'priority'          => 8,
					'suffix'            => 'em',
					'input_attrs'       => array(
						'min'  => 1,
						'step' => 0.01,
						'max'  => 5,
					),
				),

				/**
				 * Option: Heading <H2> Font Family
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[font-family-h2]',
					'type'      => 'control',
					'control'   => 'ast-font',
					'font-type' => 'ast-font-family',
					'title'     => __( 'Family', 'astra-addon' ),
					'default'   => astra_get_option( 'font-family-h2' ),
					'section'   => 'section-content-typo',
					'priority'  => 10,
					'connect'   => ASTRA_THEME_SETTINGS . '[font-weight-h2]',
					'transport' => 'postMessage',
				),

				/**
				 * Option: Heading <H2> Font Weight
				 */
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[font-weight-h2]',
					'type'              => 'control',
					'control'           => 'ast-font',
					'font-type'         => 'ast-font-weight',
					'title'             => __( 'Weight', 'astra-addon' ),
					'section'           => 'section-content-typo',
					'default'           => astra_get_option( 'font-weight-h2' ),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_font_weight' ),
					'priority'          => 12,
					'connect'           => ASTRA_THEME_SETTINGS . '[font-family-h2]',
					'transport'         => 'postMessage',
				),

				/**
				 * Option: Heading <H2> Text Transform
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[text-transform-h2]',
					'section'   => 'section-content-typo',
					'default'   => astra_get_option( 'text-transform-h2' ),
					'title'     => __( 'Text Transform', 'astra-addon' ),
					'type'      => 'control',
					'control'   => 'ast-select',
					'transport' => 'postMessage',
					'priority'  => 13,
					'choices'   => array(
						''           => __( 'Inherit', 'astra-addon' ),
						'none'       => __( 'None', 'astra-addon' ),
						'capitalize' => __( 'Capitalize', 'astra-addon' ),
						'uppercase'  => __( 'Uppercase', 'astra-addon' ),
						'lowercase'  => __( 'Lowercase', 'astra-addon' ),
					),
					'transport' => 'postMessage',
				),

				/**
				 * Option: Heading <H2> Line Height
				 */

				array(
					'name'              => ASTRA_THEME_SETTINGS . '[line-height-h2]',
					'section'           => 'section-content-typo',
					'type'              => 'control',
					'control'           => 'ast-slider',
					'default'           => astra_get_option( 'line-height-h2' ),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_number_n_blank' ),
					'transport'         => 'postMessage',
					'title'             => __( 'Line Height', 'astra-addon' ),
					'priority'          => 14,
					'suffix'            => 'em',
					'input_attrs'       => array(
						'min'  => 1,
						'step' => 0.01,
						'max'  => 5,
					),
				),

				/**
				 * Option: Heading <H3> Font Family
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[font-family-h3]',
					'type'      => 'control',
					'control'   => 'ast-font',
					'font-type' => 'ast-font-family',
					'default'   => astra_get_option( 'font-family-h3' ),
					'title'     => __( 'Family', 'astra-addon' ),
					'section'   => 'section-content-typo',
					'priority'  => 15,
					'connect'   => ASTRA_THEME_SETTINGS . '[font-weight-h3]',
					'transport' => 'postMessage',
				),

				/**
				 * Option: Heading <H3> Font Weight
				 */
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[font-weight-h3]',
					'type'              => 'control',
					'control'           => 'ast-font',
					'font-type'         => 'ast-font-weight',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_font_weight' ),
					'default'           => astra_get_option( 'font-weight-h3' ),
					'title'             => __( 'Weight', 'astra-addon' ),
					'section'           => 'section-content-typo',
					'priority'          => 17,
					'connect'           => ASTRA_THEME_SETTINGS . '[font-family-h3]',
					'transport'         => 'postMessage',
				),

				/**
				 * Option: Heading <H3> Text Transform
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[text-transform-h3]',
					'type'      => 'control',
					'section'   => 'section-content-typo',
					'title'     => __( 'Text Transform', 'astra-addon' ),
					'default'   => astra_get_option( 'text-transform-h3' ),
					'transport' => 'postMessage',
					'control'   => 'ast-select',
					'priority'  => 18,
					'choices'   => array(
						''           => __( 'Inherit', 'astra-addon' ),
						'none'       => __( 'None', 'astra-addon' ),
						'capitalize' => __( 'Capitalize', 'astra-addon' ),
						'uppercase'  => __( 'Uppercase', 'astra-addon' ),
						'lowercase'  => __( 'Lowercase', 'astra-addon' ),
					),
					'transport' => 'postMessage',
				),

				/**
				 * Option: Heading <H3> Line Height
				 */
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[line-height-h3]',
					'type'              => 'control',
					'control'           => 'ast-slider',
					'section'           => 'section-content-typo',
					'title'             => __( 'Line Height', 'astra-addon' ),
					'transport'         => 'postMessage',
					'default'           => astra_get_option( 'line-height-h3' ),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_number_n_blank' ),
					'priority'          => 19,
					'suffix'            => 'em',
					'input_attrs'       => array(
						'min'  => 1,
						'step' => 0.01,
						'max'  => 5,
					),
				),

				/**
				 * Option: Heading <H4> Font Family
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[font-family-h4]',
					'type'      => 'control',
					'control'   => 'ast-font',
					'font-type' => 'ast-font-family',
					'title'     => __( 'Family', 'astra-addon' ),
					'default'   => astra_get_option( 'font-family-h4' ),
					'section'   => 'section-content-typo',
					'priority'  => 20,
					'connect'   => ASTRA_THEME_SETTINGS . '[font-weight-h4]',
					'transport' => 'postMessage',
				),

				/**
				 * Option: Heading <H4> Font Weight
				 */
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[font-weight-h4]',
					'type'              => 'control',
					'control'           => 'ast-font',
					'font-type'         => 'ast-font-weight',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_font_weight' ),
					'title'             => __( 'Weight', 'astra-addon' ),
					'default'           => astra_get_option( 'font-weight-h4' ),
					'section'           => 'section-content-typo',
					'priority'          => 22,
					'connect'           => ASTRA_THEME_SETTINGS . '[font-family-h4]',
					'transport'         => 'postMessage',
				),

				/**
				 * Option: Heading <H4> Text Transform
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[text-transform-h4]',
					'section'   => 'section-content-typo',
					'type'      => 'control',
					'title'     => __( 'Text Transform', 'astra-addon' ),
					'default'   => astra_get_option( 'text-transform-h4' ),
					'transport' => 'postMessage',
					'control'   => 'ast-select',
					'priority'  => 23,
					'choices'   => array(
						''           => __( 'Inherit', 'astra-addon' ),
						'none'       => __( 'None', 'astra-addon' ),
						'capitalize' => __( 'Capitalize', 'astra-addon' ),
						'uppercase'  => __( 'Uppercase', 'astra-addon' ),
						'lowercase'  => __( 'Lowercase', 'astra-addon' ),
					),
					'transport' => 'postMessage',
				),

				/**
				 * Option: Heading <H4> Line Height
				 */
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[line-height-h4]',
					'type'              => 'control',
					'section'           => 'section-content-typo',
					'default'           => astra_get_option( 'line-height-h4' ),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_number_n_blank' ),
					'title'             => __( 'Line Height', 'astra-addon' ),
					'control'           => 'ast-slider',
					'priority'          => 24,
					'transport'         => 'postMessage',
					'suffix'            => 'em',
					'input_attrs'       => array(
						'min'  => 1,
						'step' => 0.01,
						'max'  => 5,
					),
				),

				/**
				 * Option: Heading <H5> Font Family
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[font-family-h5]',
					'type'      => 'control',
					'control'   => 'ast-font',
					'font-type' => 'ast-font-family',
					'default'   => astra_get_option( 'font-family-h5' ),
					'title'     => __( 'Family', 'astra-addon' ),
					'section'   => 'section-content-typo',
					'priority'  => 25,
					'connect'   => ASTRA_THEME_SETTINGS . '[font-weight-h5]',
					'transport' => 'postMessage',
				),

				/**
				 * Option: Heading <H5> Font Weight
				 */
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[font-weight-h5]',
					'type'              => 'control',
					'control'           => 'ast-font',
					'font-type'         => 'ast-font-weight',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_font_weight' ),
					'title'             => __( 'Weight', 'astra-addon' ),
					'section'           => 'section-content-typo',
					'default'           => astra_get_option( 'font-weight-h5' ),
					'priority'          => 27,
					'connect'           => ASTRA_THEME_SETTINGS . '[font-family-h5]',
					'transport'         => 'postMessage',
				),

				/**
				 * Option: Heading <H5> Text Transform
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[text-transform-h5]',
					'type'      => 'control',
					'section'   => 'section-content-typo',
					'control'   => 'ast-select',
					'title'     => __( 'Text Transform', 'astra-addon' ),
					'transport' => 'postMessage',
					'default'   => astra_get_option( 'text-transform-h5' ),
					'priority'  => 28,
					'choices'   => array(
						''           => __( 'Inherit', 'astra-addon' ),
						'none'       => __( 'None', 'astra-addon' ),
						'capitalize' => __( 'Capitalize', 'astra-addon' ),
						'uppercase'  => __( 'Uppercase', 'astra-addon' ),
						'lowercase'  => __( 'Lowercase', 'astra-addon' ),
					),
					'transport' => 'postMessage',
				),

				/**
				 * Option: Heading <H5> Line Height
				 */

				array(
					'name'              => ASTRA_THEME_SETTINGS . '[line-height-h5]',
					'type'              => 'control',
					'control'           => 'ast-slider',
					'section'           => 'section-content-typo',
					'default'           => astra_get_option( 'line-height-h5' ),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_number_n_blank' ),
					'title'             => __( 'Line Height', 'astra-addon' ),
					'transport'         => 'postMessage',
					'priority'          => 29,
					'suffix'            => 'em',
					'input_attrs'       => array(
						'min'  => 1,
						'step' => 0.01,
						'max'  => 5,
					),
				),

				/**
				 * Option: Heading <H6> Font Family
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[font-family-h6]',
					'type'      => 'control',
					'control'   => 'ast-font',
					'font-type' => 'ast-font-family',
					'default'   => astra_get_option( 'font-family-h6' ),
					'title'     => __( 'Family', 'astra-addon' ),
					'section'   => 'section-content-typo',
					'priority'  => 30,
					'connect'   => ASTRA_THEME_SETTINGS . '[font-weight-h6]',
					'transport' => 'postMessage',
				),

				/**
				 * Option: Heading <H6> Font Weight
				 */
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[font-weight-h6]',
					'type'              => 'control',
					'control'           => 'ast-font',
					'font-type'         => 'ast-font-weight',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_font_weight' ),
					'default'           => astra_get_option( 'font-weight-h6' ),
					'title'             => __( 'Weight', 'astra-addon' ),
					'section'           => 'section-content-typo',
					'priority'          => 32,
					'connect'           => ASTRA_THEME_SETTINGS . '[font-family-h6]',
					'transport'         => 'postMessage',
				),

				/**
				 * Option: Heading <H6> Text Transform
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[text-transform-h6]',
					'section'   => 'section-content-typo',
					'type'      => 'control',
					'control'   => 'ast-select',
					'title'     => __( 'Text Transform', 'astra-addon' ),
					'transport' => 'postMessage',
					'priority'  => 33,
					'default'   => astra_get_option( 'text-transform-h6' ),
					'choices'   => array(
						''           => __( 'Inherit', 'astra-addon' ),
						'none'       => __( 'None', 'astra-addon' ),
						'capitalize' => __( 'Capitalize', 'astra-addon' ),
						'uppercase'  => __( 'Uppercase', 'astra-addon' ),
						'lowercase'  => __( 'Lowercase', 'astra-addon' ),
					),
					'transport' => 'postMessage',
				),

				/**
				 * Option: Heading <H6> Line Height
				 */
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[line-height-h6]',
					'type'              => 'control',
					'section'           => 'section-content-typo',
					'transport'         => 'postMessage',
					'default'           => astra_get_option( 'line-height-h6' ),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_number_n_blank' ),
					'title'             => __( 'Line Height', 'astra-addon' ),
					'control'           => 'ast-slider',
					'priority'          => 34,
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

new Astra_Content_Advanced_Typo_Configs();
