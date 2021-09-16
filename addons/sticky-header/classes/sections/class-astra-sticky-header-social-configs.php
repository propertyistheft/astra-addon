<?php
/**
 * Sticky Header - Social Options for our theme.
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

if ( ! class_exists( 'Astra_Sticky_Header_Social_Configs' ) ) {

	/**
	 * Register Sticky Header Above Header ColorsCustomizer Configurations.
	 */
	class Astra_Sticky_Header_Social_Configs extends Astra_Customizer_Config_Base {

		/**
		 * Register Sticky Header Colors Customizer Configurations.
		 *
		 * @param Array                $configurations Astra Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 3.0.0
		 * @return Array Astra Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$section       = 'section-hb-social-icons-';
			$social_config = array();

			$component_limit = astra_addon_builder_helper()->component_limit;
			for ( $index = 1; $index <= $component_limit; $index++ ) {

				$_section = $section . $index;

				$_configs = array(

					/**
					 * Option: Sticky Header Button Heading.
					 */
					array(
						'name'     => ASTRA_THEME_SETTINGS . '[sticky-header-social-' . $index . '-heading]',
						'type'     => 'control',
						'control'  => 'ast-heading',
						'section'  => $_section,
						'title'    => __( 'Sticky Header Options', 'astra-addon' ),
						'settings' => array(),
						'priority' => 50,
						'context'  => array(
							astra_addon_builder_helper()->design_tab_config,
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[header-social-' . $index . '-color-type]',
								'operator' => '==',
								'value'    => 'custom',
							),
						),
					),

					/**
					 * Group: Primary Social Colors Group
					 */
					array(
						'name'       => ASTRA_THEME_SETTINGS . '[sticky-header-social-' . $index . '-color-group]',
						'default'    => astra_get_option( 'sticky-header-social-' . $index . '-color-group' ),
						'type'       => 'control',
						'control'    => Astra_Theme_Extension::$group_control,
						'title'      => __( 'Color', 'astra-addon' ),
						'section'    => $_section,
						'transport'  => 'postMessage',
						'priority'   => 70,
						'context'    => array(
							astra_addon_builder_helper()->design_tab_config,
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[header-social-' . $index . '-color-type]',
								'operator' => '==',
								'value'    => 'custom',
							),
						),
						'responsive' => true,
					),
					array(
						'name'       => ASTRA_THEME_SETTINGS . '[sticky-header-social-' . $index . '-background-color-group]',
						'default'    => astra_get_option( 'sticky-header-social-' . $index . '-color-group' ),
						'type'       => 'control',
						'control'    => Astra_Theme_Extension::$group_control,
						'title'      => __( 'Background Color', 'astra-addon' ),
						'section'    => $_section,
						'transport'  => 'postMessage',
						'priority'   => 70,
						'context'    => array(
							astra_addon_builder_helper()->design_tab_config,
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[header-social-' . $index . '-color-type]',
								'operator' => '==',
								'value'    => 'custom',
							),
						),
						'responsive' => true,
						'divider'    => array( 'ast_class' => 'ast-bottom-divider' ),
					),

					/**
					* Option: Social Text Color
					*/
					array(
						'name'       => 'sticky-header-social-' . $index . '-color',
						'transport'  => 'postMessage',
						'default'    => astra_get_option( 'sticky-header-social-' . $index . '-color' ),
						'type'       => 'sub-control',
						'parent'     => ASTRA_THEME_SETTINGS . '[sticky-header-social-' . $index . '-color-group]',
						'section'    => $_section,
						'tab'        => __( 'Normal', 'astra-addon' ),
						'control'    => 'ast-responsive-color',
						'responsive' => true,
						'rgba'       => true,
						'priority'   => 9,
						'context'    => astra_addon_builder_helper()->design_tab,
						'title'      => __( 'Normal', 'astra-addon' ),
					),

					/**
					* Option: Social Text Hover Color
					*/
					array(
						'name'       => 'sticky-header-social-' . $index . '-h-color',
						'default'    => astra_get_option( 'sticky-header-social-' . $index . '-h-color' ),
						'transport'  => 'postMessage',
						'type'       => 'sub-control',
						'parent'     => ASTRA_THEME_SETTINGS . '[sticky-header-social-' . $index . '-color-group]',
						'section'    => $_section,
						'tab'        => __( 'Hover', 'astra-addon' ),
						'control'    => 'ast-responsive-color',
						'responsive' => true,
						'rgba'       => true,
						'priority'   => 9,
						'context'    => astra_addon_builder_helper()->design_tab,
						'title'      => __( 'Hover', 'astra-addon' ),
					),

					/**
					* Option: Social Background Color
					*/
					array(
						'name'       => 'sticky-header-social-' . $index . '-bg-color',
						'default'    => astra_get_option( 'sticky-header-social-' . $index . '-bg-color' ),
						'transport'  => 'postMessage',
						'type'       => 'sub-control',
						'parent'     => ASTRA_THEME_SETTINGS . '[sticky-header-social-' . $index . '-background-color-group]',
						'section'    => $_section,
						'control'    => 'ast-responsive-color',
						'responsive' => true,
						'rgba'       => true,
						'priority'   => 9,
						'context'    => astra_addon_builder_helper()->design_tab,
						'title'      => __( 'Normal', 'astra-addon' ),
						'tab'        => __( 'Normal', 'astra-addon' ),
					),

					/**
					* Option: Social Background Hover Color
					*/
					array(
						'name'       => 'sticky-header-social-' . $index . '-bg-h-color',
						'default'    => astra_get_option( 'sticky-header-social-' . $index . '-bg-h-color' ),
						'transport'  => 'postMessage',
						'type'       => 'sub-control',
						'parent'     => ASTRA_THEME_SETTINGS . '[sticky-header-social-' . $index . '-background-color-group]',
						'section'    => $_section,
						'control'    => 'ast-responsive-color',
						'responsive' => true,
						'rgba'       => true,
						'priority'   => 9,
						'context'    => astra_addon_builder_helper()->design_tab,
						'title'      => __( 'Hover', 'astra-addon' ),
						'tab'        => __( 'Hover', 'astra-addon' ),
					),

				);

				$social_config[] = $_configs;

			}

			$social_config = call_user_func_array( 'array_merge', $social_config + array( array() ) );

			$configurations = array_merge( $configurations, $social_config );
			return $configurations;
		}

		/**
		 * Get Social color type..
		 *
		 * @since  3.0.0
		 * @return boolean True - If Transparent Header is enabled, False if not.
		 */
		public function is_social_color_custom() {

			$social_color_type = astra_get_option( 'header-social-color-type' );

			return ( 'custom' === $social_color_type ? true : false );
		}
	}
}

new Astra_Sticky_Header_Social_Configs();



