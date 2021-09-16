<?php
/**
 * Advanced Footer Typography Options for our theme.
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

if ( ! class_exists( 'Astra_Advanced_Footer_Typo_Configs' ) ) {

	/**
	 * Register Advanced Footer Typography Customizer Configurations.
	 */
	class Astra_Advanced_Footer_Typo_Configs extends Astra_Customizer_Config_Base {

		/**
		 * Register Advanced Footer Typography Customizer Configurations.
		 *
		 * @param Array                $configurations Astra Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array Astra Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_config = array(

				/**
				 * Option: Footer Widget Title Typography Group
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[footer-widget-title-typography-group]',
					'default'   => astra_get_option( 'footer-widget-title-typography-group' ),
					'type'      => 'control',
					'control'   => 'ast-settings-group',
					'title'     => __( 'Widget Title Font', 'astra-addon' ),
					'section'   => 'section-footer-adv',
					'transport' => 'postMessage',
					'divider'   => array( 'ast_class' => 'ast-bottom-divider' ),
					'priority'  => 48,
					'context'   => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[footer-adv]',
							'operator' => '!=',
							'value'    => 'disabled',
						),
					),
				),

				array(
					'name'      => 'footer-adv-wgt-title-font-family',
					'default'   => astra_get_option( 'footer-adv-wgt-title-font-family' ),
					'type'      => 'sub-control',
					'parent'    => ASTRA_THEME_SETTINGS . '[footer-widget-title-typography-group]',
					'section'   => 'section-footer-adv',
					'control'   => 'ast-font',
					'font_type' => 'ast-font-family',
					'title'     => __( 'Family', 'astra-addon' ),
					'connect'   => ASTRA_THEME_SETTINGS . '[footer-adv-wgt-title-font-weight]',
				),

				array(
					'name'        => 'footer-adv-wgt-title-font-size',
					'default'     => astra_get_option( 'footer-adv-wgt-title-font-size' ),
					'type'        => 'sub-control',
					'parent'      => ASTRA_THEME_SETTINGS . '[footer-widget-title-typography-group]',
					'section'     => 'section-footer-adv',
					'title'       => __( 'Size', 'astra-addon' ),
					'control'     => 'ast-responsive',
					'input_attrs' => array(
						'min' => 0,
					),
					'units'       => array(
						'px' => 'px',
						'em' => 'em',
					),
				),

				array(
					'name'              => 'footer-adv-wgt-title-font-weight',
					'default'           => astra_get_option( 'footer-adv-wgt-title-font-weight' ),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_font_weight' ),
					'type'              => 'sub-control',
					'parent'            => ASTRA_THEME_SETTINGS . '[footer-widget-title-typography-group]',
					'section'           => 'section-footer-adv',
					'control'           => 'ast-font',
					'font_type'         => 'ast-font-weight',
					'title'             => __( 'Weight', 'astra-addon' ),
					'connect'           => 'footer-adv-wgt-title-font-family',
				),

				array(
					'name'    => 'footer-adv-wgt-title-text-transform',
					'default' => astra_get_option( 'footer-adv-wgt-title-text-transform' ),
					'type'    => 'sub-control',
					'parent'  => ASTRA_THEME_SETTINGS . '[footer-widget-title-typography-group]',
					'section' => 'section-footer-adv',
					'title'   => __( 'Text Transform', 'astra-addon' ),
					'control' => 'ast-select',
					'choices' => array(
						''           => __( 'Inherit', 'astra-addon' ),
						'none'       => __( 'None', 'astra-addon' ),
						'capitalize' => __( 'Capitalize', 'astra-addon' ),
						'uppercase'  => __( 'Uppercase', 'astra-addon' ),
						'lowercase'  => __( 'Lowercase', 'astra-addon' ),
					),
				),

				array(
					'name'              => 'footer-adv-wgt-title-line-height',
					'default'           => astra_get_option( 'footer-adv-wgt-title-line-height' ),
					'type'              => 'sub-control',
					'parent'            => ASTRA_THEME_SETTINGS . '[footer-widget-title-typography-group]',
					'section'           => 'section-footer-adv',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_number_n_blank' ),
					'title'             => __( 'Line Height', 'astra-addon' ),
					'control'           => 'ast-slider',
					'suffix'            => 'em',
					'input_attrs'       => array(
						'min'  => 1,
						'step' => 0.01,
						'max'  => 5,
					),
				),

				/**
				 * Option: Footer Widget Content Typography Group
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[footer-widget-content-typography-group]',
					'default'   => astra_get_option( 'footer-widget-content-typography-group' ),
					'type'      => 'control',
					'control'   => 'ast-settings-group',
					'title'     => __( 'Widget Content Font', 'astra-addon' ),
					'section'   => 'section-footer-adv',
					'transport' => 'postMessage',
					'priority'  => 48,
					'context'   => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[footer-adv]',
							'operator' => '!=',
							'value'    => 'disabled',
						),
					),
				),

				array(
					'name'      => 'footer-adv-wgt-content-font-family',
					'default'   => astra_get_option( 'footer-adv-wgt-content-font-family' ),
					'type'      => 'sub-control',
					'parent'    => ASTRA_THEME_SETTINGS . '[footer-widget-content-typography-group]',
					'section'   => 'section-footer-adv',
					'control'   => 'ast-font',
					'font_type' => 'ast-font-family',
					'title'     => __( 'Family', 'astra-addon' ),
					'connect'   => ASTRA_THEME_SETTINGS . '[footer-adv-wgt-content-font-weight]',
				),

				array(
					'name'        => 'footer-adv-wgt-content-font-size',
					'default'     => astra_get_option( 'footer-adv-wgt-content-font-size' ),
					'type'        => 'sub-control',
					'parent'      => ASTRA_THEME_SETTINGS . '[footer-widget-content-typography-group]',
					'section'     => 'section-footer-adv',
					'title'       => __( 'Size', 'astra-addon' ),
					'control'     => 'ast-responsive',
					'input_attrs' => array(
						'min' => 0,
					),
					'units'       => array(
						'px' => 'px',
						'em' => 'em',
					),
				),

				array(
					'name'              => 'footer-adv-wgt-content-font-weight',
					'default'           => astra_get_option( 'footer-adv-wgt-content-font-weight' ),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_font_weight' ),
					'type'              => 'sub-control',
					'parent'            => ASTRA_THEME_SETTINGS . '[footer-widget-content-typography-group]',
					'section'           => 'section-footer-adv',
					'control'           => 'ast-font',
					'font_type'         => 'ast-font-weight',
					'title'             => __( 'Weight', 'astra-addon' ),
					'connect'           => 'footer-adv-wgt-content-font-family',
				),

				array(
					'name'    => 'footer-adv-wgt-content-text-transform',
					'default' => astra_get_option( 'footer-adv-wgt-content-text-transform' ),
					'type'    => 'sub-control',
					'parent'  => ASTRA_THEME_SETTINGS . '[footer-widget-content-typography-group]',
					'section' => 'section-footer-adv',
					'title'   => __( 'Text Transform', 'astra-addon' ),
					'control' => 'ast-select',
					'choices' => array(
						''           => __( 'Inherit', 'astra-addon' ),
						'none'       => __( 'None', 'astra-addon' ),
						'capitalize' => __( 'Capitalize', 'astra-addon' ),
						'uppercase'  => __( 'Uppercase', 'astra-addon' ),
						'lowercase'  => __( 'Lowercase', 'astra-addon' ),
					),
				),

				array(
					'name'              => 'footer-adv-wgt-content-line-height',
					'default'           => astra_get_option( 'footer-adv-wgt-content-line-height' ),
					'type'              => 'sub-control',
					'parent'            => ASTRA_THEME_SETTINGS . '[footer-widget-content-typography-group]',
					'section'           => 'section-footer-adv',
					'title'             => __( 'Line Height', 'astra-addon' ),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_number_n_blank' ),
					'control'           => 'ast-slider',
					'suffix'            => 'em',
					'input_attrs'       => array(
						'min'  => 1,
						'step' => 0.01,
						'max'  => 5,
					),
				),

			);

			return array_merge( $configurations, $_config );
		}

	}
}

new Astra_Advanced_Footer_Typo_Configs();



