<?php
/**
 * Shop Options for our theme.
 *
 * @package     Astra
 * @author      Astra
 * @copyright   Copyright (c) 2020, Astra
 * @link        https://wpastra.com/
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

if ( ! class_exists( 'Astra_Edd_Shop_Typo_Configs' ) ) {

	/**
	 * Register Easy Digital Downloads Shop Typo Layout Configurations.
	 */
	class Astra_Edd_Shop_Typo_Configs extends Astra_Customizer_Config_Base {

		/**
		 * Register Easy Digital Downloads Shop Typo Layout Configurations.
		 *
		 * @param Array                $configurations Astra Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.6.10
		 * @return Array Astra Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_configs = array(

				/**
				 * Option: Product Title Font Family
				 */
				array(
					'name'      => 'font-family-edd-archive-product-title',
					'parent'    => ASTRA_THEME_SETTINGS . '[edd-archive-product-title-typo]',
					'section'   => 'section-edd-archive',
					'default'   => astra_get_option( 'font-family-edd-archive-product-title' ),
					'type'      => 'sub-control',
					'control'   => 'ast-font',
					'font_type' => 'ast-font-family',
					'title'     => __( 'Family', 'astra-addon' ),
					'connect'   => ASTRA_THEME_SETTINGS . '[font-weight-edd-archive-product-title]',
					'priority'  => 3,
					'context'   => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[edd-archive-product-structure]',
							'operator' => 'contains',
							'value'    => 'title',
						),
					),
				),

				/**
				 * Option: Product Title Font Weight
				 */
				array(
					'name'              => 'font-weight-edd-archive-product-title',
					'parent'            => ASTRA_THEME_SETTINGS . '[edd-archive-product-title-typo]',
					'section'           => 'section-edd-archive',
					'default'           => astra_get_option( 'font-weight-edd-archive-product-title' ),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_font_weight' ),
					'type'              => 'sub-control',
					'control'           => 'ast-font',
					'font_type'         => 'ast-font-weight',
					'context'           => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[edd-archive-product-structure]',
							'operator' => 'contains',
							'value'    => 'title',
						),
					),
					'title'             => __( 'Weight', 'astra-addon' ),
					'connect'           => 'font-family-edd-archive-product-title',
					'priority'          => 4,
				),

				/**
				 * Option: Product Title Font Size
				 */
				array(
					'name'        => 'font-size-edd-archive-product-title',
					'parent'      => ASTRA_THEME_SETTINGS . '[edd-archive-product-title-typo]',
					'section'     => 'section-edd-archive',
					'default'     => astra_get_option( 'font-size-edd-archive-product-title' ),
					'type'        => 'sub-control',
					'transport'   => 'postMessage',
					'control'     => 'ast-responsive',
					'priority'    => 3,
					'context'     => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[edd-archive-product-structure]',
							'operator' => 'contains',
							'value'    => 'title',
						),
					),
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
				 * Option: Product Title Line Height
				 */
				array(
					'name'        => 'line-height-edd-archive-product-title',
					'parent'      => ASTRA_THEME_SETTINGS . '[edd-archive-product-title-typo]',
					'section'     => 'section-edd-archive',
					'default'     => astra_get_option( 'line-height-edd-archive-product-title' ),
					'type'        => 'sub-control',
					'transport'   => 'postMessage',
					'context'     => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[edd-archive-product-structure]',
							'operator' => 'contains',
							'value'    => 'title',
						),
					),
					'title'       => __( 'Line Height', 'astra-addon' ),
					'control'     => 'ast-slider',
					'priority'    => 5,
					'suffix'      => 'em',
					'input_attrs' => array(
						'min'  => 1,
						'step' => 0.01,
						'max'  => 5,
					),
				),

				/**
				 * Option: Product Title Text Transform
				 */
				array(
					'name'      => 'text-transform-edd-archive-product-title',
					'parent'    => ASTRA_THEME_SETTINGS . '[edd-archive-product-title-typo]',
					'section'   => 'section-edd-archive',
					'default'   => astra_get_option( 'text-transform-edd-archive-product-title' ),
					'type'      => 'sub-control',
					'transport' => 'postMessage',
					'context'   => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[edd-archive-product-structure]',
							'operator' => 'contains',
							'value'    => 'title',
						),
					),
					'title'     => __( 'Text Transform', 'astra-addon' ),
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
				 * Option: Product Price Font Family
				 */
				array(
					'name'      => 'font-family-edd-archive-product-price',
					'parent'    => ASTRA_THEME_SETTINGS . '[edd-archive-product-price-typo]',
					'section'   => 'section-edd-archive',
					'default'   => astra_get_option( 'font-family-edd-archive-product-price' ),
					'type'      => 'sub-control',
					'control'   => 'ast-font',
					'font_type' => 'ast-font-family',
					'context'   => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[edd-archive-product-structure]',
							'operator' => 'contains',
							'value'    => 'price',
						),
					),
					'title'     => __( 'Family', 'astra-addon' ),
					'connect'   => ASTRA_THEME_SETTINGS . '[font-weight-edd-archive-product-price]',
					'priority'  => 9,
				),

				/**
				 * Option: Product Price Font Weight
				 */
				array(
					'name'              => 'font-weight-edd-archive-product-price',
					'parent'            => ASTRA_THEME_SETTINGS . '[edd-archive-product-price-typo]',
					'section'           => 'section-edd-archive',
					'default'           => astra_get_option( 'font-weight-edd-archive-product-price' ),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_font_weight' ),
					'type'              => 'sub-control',
					'control'           => 'ast-font',
					'font_type'         => 'ast-font-weight',
					'context'           => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[edd-archive-product-structure]',
							'operator' => 'contains',
							'value'    => 'price',
						),
					),
					'title'             => __( 'Weight', 'astra-addon' ),
					'connect'           => 'font-family-edd-archive-product-price',
					'priority'          => 10,
				),

				/**
				 * Option: Product Price Font Size
				 */
				array(
					'name'        => 'font-size-edd-archive-product-price',
					'parent'      => ASTRA_THEME_SETTINGS . '[edd-archive-product-price-typo]',
					'section'     => 'section-edd-archive',
					'default'     => astra_get_option( 'font-size-edd-archive-product-price' ),
					'type'        => 'sub-control',
					'transport'   => 'postMessage',
					'control'     => 'ast-responsive',
					'priority'    => 9,
					'context'     => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[edd-archive-product-structure]',
							'operator' => 'contains',
							'value'    => 'price',
						),
					),
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
				 * Option: Product Price Line Height
				 */
				array(
					'name'        => 'line-height-edd-archive-product-price',
					'parent'      => ASTRA_THEME_SETTINGS . '[edd-archive-product-price-typo]',
					'section'     => 'section-edd-archive',
					'default'     => astra_get_option( 'line-height-edd-archive-product-price' ),
					'type'        => 'sub-control',
					'transport'   => 'postMessage',
					'context'     => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[edd-archive-product-structure]',
							'operator' => 'contains',
							'value'    => 'price',
						),
					),
					'title'       => __( 'Line Height', 'astra-addon' ),
					'control'     => 'ast-slider',
					'priority'    => 10,
					'suffix'      => 'em',
					'input_attrs' => array(
						'min'  => 1,
						'step' => 0.01,
						'max'  => 5,
					),
				),

				/**
				 * Option: Product Content Font Family
				 */
				array(
					'name'      => 'font-family-edd-archive-product-content',
					'parent'    => ASTRA_THEME_SETTINGS . '[edd-archive-product-content-typo]',
					'section'   => 'section-edd-archive',
					'default'   => astra_get_option( 'font-family-edd-archive-product-content' ),
					'type'      => 'sub-control',
					'control'   => 'ast-font',
					'font_type' => 'ast-font-family',
					'title'     => __( 'Family', 'astra-addon' ),
					'connect'   => ASTRA_THEME_SETTINGS . '[font-weight-edd-archive-product-content]',
					'priority'  => 13,
				),

				/**
				 * Option: Product Content Font Weight
				 */
				array(
					'name'              => 'font-weight-edd-archive-product-content',
					'parent'            => ASTRA_THEME_SETTINGS . '[edd-archive-product-content-typo]',
					'section'           => 'section-edd-archive',
					'default'           => astra_get_option( 'font-weight-edd-archive-product-content' ),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_font_weight' ),
					'type'              => 'sub-control',
					'control'           => 'ast-font',
					'font_type'         => 'ast-font-weight',
					'title'             => __( 'Weight', 'astra-addon' ),
					'connect'           => 'font-family-edd-archive-product-content',
					'priority'          => 14,
				),

				/**
				 * Option: Product Content Font Size
				 */
				array(
					'name'        => 'font-size-edd-archive-product-content',
					'parent'      => ASTRA_THEME_SETTINGS . '[edd-archive-product-content-typo]',
					'section'     => 'section-edd-archive',
					'default'     => astra_get_option( 'font-size-edd-archive-product-content' ),
					'type'        => 'sub-control',
					'transport'   => 'postMessage',
					'control'     => 'ast-responsive',
					'priority'    => 13,
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
				 * Option: Product Content Line Height
				 */
				array(
					'name'        => 'line-height-edd-archive-product-content',
					'parent'      => ASTRA_THEME_SETTINGS . '[edd-archive-product-content-typo]',
					'section'     => 'section-edd-archive',
					'default'     => astra_get_option( 'line-height-edd-archive-product-content' ),
					'type'        => 'sub-control',
					'transport'   => 'postMessage',
					'title'       => __( 'Line Height', 'astra-addon' ),
					'control'     => 'ast-slider',
					'priority'    => 15,
					'suffix'      => 'em',
					'input_attrs' => array(
						'min'  => 1,
						'step' => 0.01,
						'max'  => 5,
					),
				),

				/**
				 * Option: Product Title Text Transform
				 */
				array(
					'name'      => 'text-transform-edd-archive-product-content',
					'parent'    => ASTRA_THEME_SETTINGS . '[edd-archive-product-content-typo]',
					'section'   => 'section-edd-archive',
					'default'   => astra_get_option( 'text-transform-edd-archive-product-content' ),
					'type'      => 'sub-control',
					'transport' => 'postMessage',
					'title'     => __( 'Text Transform', 'astra-addon' ),
					'control'   => 'ast-select',
					'priority'  => 14,
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


new Astra_Edd_Shop_Typo_Configs();





