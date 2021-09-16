<?php
/**
 * Sticky Header - Search Options for our theme.
 *
 * @package     Astra Addon
 * @author      Brainstorm Force
 * @copyright   Copyright (c) 2020, Brainstorm Force
 * @link        https://www.brainstormforce.com
 * @since       3.0.0
 */

// Block direct access to the file.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Bail if Customizer config base class does not exist.
if ( ! class_exists( 'Astra_Customizer_Config_Base' ) ) {
	return;
}

if ( ! class_exists( 'Astra_Sticky_Header_Search_Configs' ) ) {

	/**
	 * Register Sticky Header Above Header ColorsCustomizer Configurations.
	 */
	class Astra_Sticky_Header_Search_Configs extends Astra_Customizer_Config_Base {

		/**
		 * Register Sticky Header Colors Customizer Configurations.
		 *
		 * @param Array                $configurations Astra Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 3.0.0
		 * @return Array Astra Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_section = 'section-header-search';

			$_configs = array(

				/**
				 * Option: Sticky Header Search Heading.
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[sticky-header-search-heading]',
					'type'     => 'control',
					'control'  => 'ast-heading',
					'section'  => $_section,
					'title'    => __( 'Sticky Header Option', 'astra-addon' ),
					'settings' => array(),
					'priority' => 10,
					'context'  => astra_addon_builder_helper()->design_tab,
				),

				/**
				 * Option: Search text/placeholder Color
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[sticky-header-search-text-placeholder-color]',
					'default'   => astra_get_option( 'sticky-header-search-text-placeholder-color' ),
					'transport' => 'postMessage',
					'type'      => 'control',
					'section'   => $_section,
					'control'   => 'ast-color',
					'priority'  => 20,
					'title'     => __( 'Text / Placeholder Color', 'astra-addon' ),
					'context'   => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[header-search-box-type]',
							'operator' => 'in',
							'value'    => array( 'slide-search', 'search-box' ),
						),
					),
				),

				/**
				 * Option: Search icon Color.
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[sticky-header-search-icon-color-parent]',
					'default'   => astra_get_option( 'sticky-header-search-icon-color-parent' ),
					'type'      => 'control',
					'control'   => Astra_Theme_Extension::$group_control,
					'title'     => __( 'Icon Color', 'astra-addon' ),
					'section'   => 'section-header-search',
					'transport' => 'postMessage',
					'priority'  => 20,
					'context'   => astra_addon_builder_helper()->design_tab,
				),

				/**
				 * Option: Search Color.
				 */
				array(
					'name'              => 'sticky-header-search-icon-color',
					'default'           => astra_get_option( 'sticky-header-search-icon-color' ),
					'type'              => 'sub-control',
					'parent'            => ASTRA_THEME_SETTINGS . '[sticky-header-search-icon-color-parent]',
					'section'           => $_section,
					'priority'          => 20,
					'transport'         => 'postMessage',
					'control'           => 'ast-color',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
					'title'             => __( 'Normal', 'astra-addon' ),
					'tab'               => __( 'Normal', 'astra-addon' ),
					'context'           => astra_addon_builder_helper()->general_tab,
				),
				/**
				 * Option: Search Color.
				 */
				array(
					'name'      => 'sticky-header-search-icon-h-color',
					'default'   => astra_get_option( 'sticky-header-search-icon-h-color' ),
					'type'      => 'sub-control',
					'parent'    => ASTRA_THEME_SETTINGS . '[sticky-header-search-icon-color-parent]',
					'section'   => $_section,
					'priority'  => 20,
					'transport' => 'postMessage',
					'control'   => 'ast-color',
					'title'     => __( 'Hover', 'astra-addon' ),
					'tab'       => __( 'Hover', 'astra-addon' ),
					'context'   => astra_addon_builder_helper()->general_tab,
				),

				/**
				 * Option: Search bg Color.
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[sticky-header-search-bg-color-parent]',
					'default'   => astra_get_option( 'sticky-header-search-bg-color-parent' ),
					'type'      => 'control',
					'control'   => Astra_Theme_Extension::$group_control,
					'title'     => __( 'Box Background', 'astra-addon' ),
					'section'   => 'section-header-search',
					'transport' => 'postMessage',
					'priority'  => 20,
					'context'   => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[header-search-box-type]',
							'operator' => 'in',
							'value'    => array( 'slide-search', 'search-box' ),
						),
					),
					'divider'   => array( 'ast_class' => 'ast-bottom-divider' ),
				),

				/**
				 * Search Box Background Color
				 */
				array(
					'name'      => 'sticky-header-search-box-background-color',
					'default'   => astra_get_option( 'sticky-header-search-box-background-color' ),
					'type'      => 'sub-control',
					'parent'    => ASTRA_THEME_SETTINGS . '[sticky-header-search-bg-color-parent]',
					'section'   => $_section,
					'priority'  => 1,
					'transport' => 'postMessage',
					'control'   => 'ast-color',
					'title'     => __( 'Normal', 'astra-addon' ),
					'tab'       => __( 'Normal', 'astra-addon' ),
					'context'   => astra_addon_builder_helper()->general_tab,
				),
				/**
				 * Search Box Background hover Color
				 */
				array(
					'name'      => 'sticky-header-search-box-background-h-color',
					'default'   => astra_get_option( 'sticky-header-search-box-background-h-color' ),
					'type'      => 'sub-control',
					'parent'    => ASTRA_THEME_SETTINGS . '[sticky-header-search-bg-color-parent]',
					'section'   => $_section,
					'priority'  => 2,
					'transport' => 'postMessage',
					'control'   => 'ast-color',
					'title'     => __( 'Hover', 'astra-addon' ),
					'tab'       => __( 'Hover', 'astra-addon' ),
					'context'   => astra_addon_builder_helper()->general_tab,
				),
			);

			return array_merge( $configurations, $_configs );
		}
	}
}

new Astra_Sticky_Header_Search_Configs();



