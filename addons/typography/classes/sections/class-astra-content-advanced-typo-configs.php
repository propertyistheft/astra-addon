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
	// @codingStandardsIgnoreStart
	class Astra_Content_Advanced_Typo_Configs extends Astra_Customizer_Config_Base {
 // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedClassFound
		// @codingStandardsIgnoreEnd

		/**
		 * Register Header Layout Customizer Configurations.
		 *
		 * @param Array                $configurations Astra Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array Astra Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$load_heading_typo_options = astra_addon_has_gcp_typo_preset_compatibility();

			$section = $load_heading_typo_options ? 'section-content-typo' : 'section-typography';

			if ( $load_heading_typo_options ) {

				$_configs = array(

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
						'section'   => $section,
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
						'section'           => $section,
						'priority'          => 22,
						'connect'           => ASTRA_THEME_SETTINGS . '[font-family-h4]',
						'transport'         => 'postMessage',
					),

					/**
					 * Option: Heading <H4> Text Transform
					 */
					array(
						'name'      => ASTRA_THEME_SETTINGS . '[text-transform-h4]',
						'section'   => $section,
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
						'section'           => $section,
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
						'section'   => $section,
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
						'section'           => $section,
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
						'section'   => $section,
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
						'section'           => $section,
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
						'section'   => $section,
						'priority'  => $load_heading_typo_options ? 30 : 27,
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
						'section'           => $section,
						'priority'          => 32,
						'connect'           => ASTRA_THEME_SETTINGS . '[font-family-h6]',
						'transport'         => 'postMessage',
					),

					/**
					 * Option: Heading <H6> Text Transform
					 */
					array(
						'name'      => ASTRA_THEME_SETTINGS . '[text-transform-h6]',
						'section'   => $section,
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
						'section'           => $section,
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

			return $configurations;
		}
	}
}

new Astra_Content_Advanced_Typo_Configs();
