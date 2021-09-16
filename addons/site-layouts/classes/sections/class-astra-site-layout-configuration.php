<?php
/**
 * Styling Options for Astra Theme.
 *
 * @package     Astra
 * @author      Brainstorm Force
 * @copyright   Copyright (c) 2020, Astra
 * @link        https://wpastra.com/
 * @since       1.4.3
 */

// Block direct access to the file.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Bail if Customizer config base class does not exist.
if ( ! class_exists( 'Astra_Customizer_Config_Base' ) ) {
	return;
}

if ( ! class_exists( 'Astra_Site_Layout_Configuration' ) ) {

	/**
	 * Register Site Layout Customizer Configurations.
	 */
	class Astra_Site_Layout_Configuration extends Astra_Customizer_Config_Base {

		/**
		 * Register Site Layout Customizer Configurations.
		 *
		 * @param Array                $configurations Astra Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array Astra Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_configs = array(

				/**
				 * Option: Site Layout
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[site-layout]',
					'default'  => astra_get_option( 'site-layout' ),
					'type'     => 'control',
					'control'  => 'ast-select',
					'section'  => 'section-container-layout',
					'priority' => 5,
					'divider'  => array( 'ast_class' => 'ast-bottom-divider' ),
					'title'    => __( 'Site Layout', 'astra-addon' ),
					'choices'  => array(
						'ast-full-width-layout'  => __( 'Full Width', 'astra-addon' ),
						'ast-box-layout'         => __( 'Max Width', 'astra-addon' ),
						'ast-padded-layout'      => __( 'Padded', 'astra-addon' ),
						'ast-fluid-width-layout' => __( 'Fluid', 'astra-addon' ),
					),
				),

				/**
				 * Option: Padded Layout Custom Width
				 */
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[site-layout-padded-width]',
					'default'           => astra_get_option( 'site-layout-padded-width' ),
					'type'              => 'control',
					'control'           => 'ast-slider',
					'transport'         => 'postMessage',
					'section'           => 'section-container-layout',
					'priority'          => 15,
					'title'             => __( 'Width', 'astra-addon' ),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_number_n_blank' ),
					'suffix'            => 'px',
					'input_attrs'       => array(
						'min'  => 768,
						'step' => 1,
						'max'  => 1920,
					),
					'context'           => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[site-layout]',
							'operator' => '==',
							'value'    => 'ast-padded-layout',
						),
					),
				),

				/**
				 * Option: Box Width
				 */
				array(
					'name'        => ASTRA_THEME_SETTINGS . '[site-layout-box-width]',
					'default'     => astra_get_option( 'site-layout-box-width' ),
					'type'        => 'control',
					'transport'   => 'postMessage',
					'control'     => 'ast-slider',
					'section'     => 'section-container-layout',
					'priority'    => 25,
					'title'       => __( 'Max Width', 'astra-addon' ),
					'suffix'      => 'px',
					'context'     => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[site-layout]',
							'operator' => '==',
							'value'    => 'ast-box-layout',
						),
					),
					'input_attrs' => array(
						'min'  => 768,
						'step' => 1,
						'max'  => 1920,
					),
				),

				/**
				 * Option: Padded Layout Custom Width
				 */
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[site-layout-padded-pad]',
					'default'           => astra_get_option( 'site-layout-padded-pad' ),
					'type'              => 'control',
					'transport'         => 'postMessage',
					'control'           => 'ast-responsive-spacing',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_responsive_spacing' ),
					'section'           => 'section-container-layout',
					'priority'          => 20,
					'title'             => __( 'Space Outside Body', 'astra-addon' ),
					'divider'           => array( 'ast_class' => 'ast-bottom-divider ast-top-divider' ),
					'context'           => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[site-layout]',
							'operator' => '==',
							'value'    => 'ast-padded-layout',
						),
					),
					'linked_choices'    => true,
					'unit_choices'      => array( 'px', 'em', '%' ),
					'choices'           => array(
						'top'    => __( 'Top', 'astra-addon' ),
						'right'  => __( 'Right', 'astra-addon' ),
						'bottom' => __( 'Bottom', 'astra-addon' ),
						'left'   => __( 'Left', 'astra-addon' ),
					),
				),

				/**
				 * Option: Box Top & Bottom Margin
				 */
				array(
					'name'        => ASTRA_THEME_SETTINGS . '[site-layout-box-tb-margin]',
					'default'     => astra_get_option( 'site-layout-box-tb-margin' ),
					'type'        => 'control',
					'transport'   => 'postMessage',
					'control'     => 'ast-slider',
					'section'     => 'section-container-layout',
					'priority'    => 30,
					'divider'     => array( 'ast_class' => 'ast-bottom-divider ast-top-divider' ),
					'title'       => __( 'Top & Bottom Margin', 'astra-addon' ),
					'context'     => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[site-layout]',
							'operator' => '==',
							'value'    => 'ast-box-layout',
						),
					),
					'suffix'      => 'px',
					'input_attrs' => array(
						'min'  => 0,
						'step' => 1,
						'max'  => 600,
					),
				),

				/**
				 * Layout: Fluid layout
				 */

				/**
				 * Option: Page Left & Right Padding
				 */
				array(
					'name'        => ASTRA_THEME_SETTINGS . '[site-layout-fluid-lr-padding]',
					'default'     => astra_get_option( 'site-layout-fluid-lr-padding' ),
					'type'        => 'control',
					'transport'   => 'postMessage',
					'control'     => 'ast-slider',
					'section'     => 'section-container-layout',
					'divider'     => array( 'ast_class' => 'ast-bottom-divider' ),
					'priority'    => 35,
					'title'       => __( 'Left & Right Padding', 'astra-addon' ),
					'context'     => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[site-layout]',
							'operator' => '==',
							'value'    => 'ast-fluid-width-layout',
						),
					),
					'suffix'      => 'px',
					'input_attrs' => array(
						'min'  => 1,
						'step' => 1,
						'max'  => 200,
					),
				),
			);

			$configurations = array_merge( $configurations, $_configs );

			return $configurations;
		}
	}
}

new Astra_Site_Layout_Configuration();


