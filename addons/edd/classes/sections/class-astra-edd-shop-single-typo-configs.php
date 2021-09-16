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

if ( ! class_exists( 'Astra_Edd_Shop_Single_Typo_Configs' ) ) {

	/**
	 * Register Blog Single Layout Configurations.
	 */
	class Astra_Edd_Shop_Single_Typo_Configs extends Astra_Customizer_Config_Base {

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
				 * Option: Single Product Title Font Family
				 */
				array(
					'name'      => 'font-family-edd-product-title',
					'parent'    => ASTRA_THEME_SETTINGS . '[edd-single-product-title-typo]',
					'section'   => 'section-edd-single',
					'default'   => astra_get_option( 'font-family-edd-product-title' ),
					'type'      => 'sub-control',
					'control'   => 'ast-font',
					'font_type' => 'ast-font-family',
					'title'     => __( 'Family', 'astra-addon' ),
					'context'   => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[single-product-structure]',
							'operator' => 'contains',
							'value'    => 'title',
						),
					),
					'connect'   => ASTRA_THEME_SETTINGS . '[font-weight-edd-product-title]',
					'priority'  => 3,
				),

				/**
				 * Option: Single Product Title Font Weight
				 */
				array(
					'name'              => 'font-weight-edd-product-itle]',
					'parent'            => ASTRA_THEME_SETTINGS . '[edd-single-product-title-typo]',
					'section'           => 'section-edd-single',
					'default'           => astra_get_option( 'font-weight-edd-product-title' ),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_font_weight' ),
					'type'              => 'sub-control',
					'control'           => 'ast-font',
					'font_type'         => 'ast-font-weight',
					'title'             => __( 'Weight', 'astra-addon' ),
					'context'           => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[single-product-structure]',
							'operator' => 'contains',
							'value'    => 'title',
						),
					),
					'connect'           => 'font-family-edd-product-title',
					'priority'          => 4,
				),

				/**
				 * Option: Single Product Title Font Size
				 */
				array(
					'name'        => 'font-size-edd-product-title',
					'parent'      => ASTRA_THEME_SETTINGS . '[edd-single-product-title-typo]',
					'section'     => 'section-edd-single',
					'default'     => astra_get_option( 'font-size-edd-product-title' ),
					'type'        => 'sub-control',
					'transport'   => 'postMessage',
					'control'     => 'ast-responsive',
					'priority'    => 3,
					'title'       => __( 'Size', 'astra-addon' ),
					'context'     => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[single-product-structure]',
							'operator' => 'contains',
							'value'    => 'title',
						),
					),
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
					'name'        => 'line-height-edd-product-title',
					'parent'      => ASTRA_THEME_SETTINGS . '[edd-single-product-title-typo]',
					'section'     => 'section-edd-single',
					'default'     => astra_get_option( 'line-height-edd-product-title' ),
					'type'        => 'sub-control',
					'transport'   => 'postMessage',
					'title'       => __( 'Line Height', 'astra-addon' ),
					'control'     => 'ast-slider',
					'context'     => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[single-product-structure]',
							'operator' => 'contains',
							'value'    => 'title',
						),
					),
					'priority'    => 5,
					'suffix'      => 'em',
					'input_attrs' => array(
						'min'  => 1,
						'step' => 0.01,
						'max'  => 5,
					),
				),

				/**
				 * Option: Single Product Title Text Transform
				 */
				array(
					'name'      => 'text-transform-edd-product-title',
					'parent'    => ASTRA_THEME_SETTINGS . '[edd-single-product-title-typo]',
					'section'   => 'section-edd-single',
					'default'   => astra_get_option( 'text-transform-edd-product-title' ),
					'type'      => 'sub-control',
					'transport' => 'postMessage',
					'title'     => __( 'Text Transform', 'astra-addon' ),
					'context'   => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[single-product-structure]',
							'operator' => 'contains',
							'value'    => 'title',
						),
					),
					'control'   => 'ast-select',
					'priority'  => 4,
					'choices'   => array(
						''           => __( 'Inherit', 'astra-addon' ),
						'none'       => __( 'None', 'astra-addon' ),
						'capitalize' => __( 'Capitalize', 'astra-addon' ),
						'uppercase'  => __( 'Uppercase', 'astra-addon' ),
						'lowercase'  => __( 'Lowercase', 'astra-addon' ),
					),
				),

				/**
				 * Option: Single Product Content Font Family
				 */
				array(
					'name'      => 'font-family-edd-product-content',
					'parent'    => ASTRA_THEME_SETTINGS . '[edd-single-product-content-typo]',
					'section'   => 'section-edd-single',
					'default'   => astra_get_option( 'font-family-edd-product-content' ),
					'type'      => 'sub-control',
					'control'   => 'ast-font',
					'font_type' => 'ast-font-family',
					'title'     => __( 'Family', 'astra-addon' ),
					'connect'   => ASTRA_THEME_SETTINGS . '[font-weight-edd-product-content]',
					'priority'  => 18,
				),

				/**
				 * Option: Single Product Content Font Weight
				 */
				array(
					'name'              => 'font-weight-edd-product-content',
					'parent'            => ASTRA_THEME_SETTINGS . '[edd-single-product-content-typo]',
					'section'           => 'section-edd-single',
					'default'           => astra_get_option( 'font-weight-edd-product-content' ),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_font_weight' ),
					'type'              => 'sub-control',
					'control'           => 'ast-font',
					'font_type'         => 'ast-font-weight',
					'title'             => __( 'Weight', 'astra-addon' ),
					'connect'           => 'font-family-edd-product-content',
					'priority'          => 19,
				),

				/**
				 * Option: Single Product Content Font Size
				 */
				array(
					'name'        => 'font-size-edd-product-content',
					'parent'      => ASTRA_THEME_SETTINGS . '[edd-single-product-content-typo]',
					'section'     => 'section-edd-single',
					'default'     => astra_get_option( 'font-size-edd-product-content' ),
					'type'        => 'sub-control',
					'transport'   => 'postMessage',
					'control'     => 'ast-responsive',
					'priority'    => 18,
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
					'name'        => 'line-height-edd-product-content',
					'parent'      => ASTRA_THEME_SETTINGS . '[edd-single-product-content-typo]',
					'section'     => 'section-edd-single',
					'default'     => astra_get_option( 'line-height-edd-product-content' ),
					'type'        => 'sub-control',
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

				/**
				 * Option: Single Product Content Text Transform
				 */
				array(
					'name'      => 'text-transform-edd-product-content',
					'parent'    => ASTRA_THEME_SETTINGS . '[edd-single-product-content-typo]',
					'section'   => 'section-edd-single',
					'default'   => astra_get_option( 'text-transform-edd-product-content' ),
					'type'      => 'sub-control',
					'transport' => 'postMessage',
					'title'     => __( 'Text Transform', 'astra-addon' ),
					'control'   => 'ast-select',
					'priority'  => 19,
					'choices'   => array(
						''           => __( 'Inherit', 'astra-addon' ),
						'none'       => __( 'None', 'astra-addon' ),
						'capitalize' => __( 'Capitalize', 'astra-addon' ),
						'uppercase'  => __( 'Uppercase', 'astra-addon' ),
						'lowercase'  => __( 'Lowercase', 'astra-addon' ),
					),
				),

			);

			$configurations = array_merge( $configurations, $_configs );

			return $configurations;

		}
	}
}


new Astra_Edd_Shop_Single_Typo_Configs();





