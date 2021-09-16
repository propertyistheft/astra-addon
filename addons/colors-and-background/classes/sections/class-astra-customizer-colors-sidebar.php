<?php
/**
 * Colors Sidebar Options for our theme.
 *
 * @package     Astra Addon
 * @author      Brainstorm Force
 * @copyright   Copyright (c) 2020, Brainstorm Force
 * @link        https://www.brainstormforce.com
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

/**
 * Customizer Sanitizes
 *
 * @since 1.4.3
 */
if ( ! class_exists( 'Astra_Customizer_Colors_Sidebar' ) ) {

	/**
	 * Register General Customizer Configurations.
	 */
	class Astra_Customizer_Colors_Sidebar extends Astra_Customizer_Config_Base {

		/**
		 * Register General Customizer Configurations.
		 *
		 * @param Array                $configurations Astra Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array Astra Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_configs = array(

				// Option: Sidebar Background.
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[sidebar-bg-obj]',
					'type'      => 'control',
					'control'   => 'ast-background',
					'priority'  => 23,
					'section'   => 'section-sidebars',
					'transport' => 'postMessage',
					'default'   => astra_get_option( 'sidebar-bg-obj' ),
					'title'     => __( 'Background', 'astra-addon' ),
					'divider'   => array( 'ast_class' => 'ast-bottom-divider' ),
					'context'   => ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) ?
					astra_addon_builder_helper()->design_tab : astra_addon_builder_helper()->general_tab,
				),

				/**
				 * Option: SideBar Content Group
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[sidebar-content-link-group]',
					'default'   => astra_get_option( 'sidebar-content-group' ),
					'type'      => 'control',
					'control'   => Astra_Theme_Extension::$group_control,
					'title'     => __( 'Content Link', 'astra-addon' ),
					'section'   => 'section-sidebars',
					'transport' => 'postMessage',
					'priority'  => 24,
					'divider'   => array( 'ast_class' => 'ast-bottom-divider' ),
					'context'   => ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) ?
						astra_addon_builder_helper()->design_tab : astra_addon_builder_helper()->general_tab,
				),

				// Option: Widget Title Color.
				array(
					'type'              => 'control',
					'priority'          => 23,
					'section'           => 'section-sidebars',
					'control'           => 'ast-color',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
					'default'           => astra_get_option( 'sidebar-widget-title-color' ),
					'transport'         => 'postMessage',
					'name'              => ASTRA_THEME_SETTINGS . '[sidebar-widget-title-color]',
					'title'             => __( 'Content Title', 'astra-addon' ),
					'context'           => ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) ?
						astra_addon_builder_helper()->design_tab : astra_addon_builder_helper()->general_tab,
				),

				// Option: Text Color.
				array(
					'type'              => 'control',
					'priority'          => 23,
					'section'           => 'section-sidebars',
					'control'           => 'ast-color',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
					'default'           => astra_get_option( 'sidebar-text-color' ),
					'transport'         => 'postMessage',
					'name'              => ASTRA_THEME_SETTINGS . '[sidebar-text-color]',
					'title'             => __( 'Content Text', 'astra-addon' ),
					'context'           => ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) ?
						astra_addon_builder_helper()->design_tab : astra_addon_builder_helper()->general_tab,
				),

				// Option: Link Color.
				array(
					'type'     => 'sub-control',
					'priority' => 10,
					'parent'   => ASTRA_THEME_SETTINGS . '[sidebar-content-link-group]',
					'section'  => 'section-sidebars',
					'control'  => 'ast-color',
					'default'  => astra_get_option( 'sidebar-link-color' ),
					'name'     => 'sidebar-link-color',
					'title'    => __( 'Normal', 'astra-addon' ),
					'tab'      => __( 'Normal', 'astra-addon' ),
				),

				// Option: Link Hover Color.
				array(
					'type'              => 'sub-control',
					'priority'          => 11,
					'parent'            => ASTRA_THEME_SETTINGS . '[sidebar-content-link-group]',
					'section'           => 'section-sidebars',
					'control'           => 'ast-color',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
					'default'           => astra_get_option( 'sidebar-link-h-color' ),
					'transport'         => 'postMessage',
					'name'              => 'sidebar-link-h-color',
					'title'             => __( 'Hover', 'astra-addon' ),
					'tab'               => __( 'Hover', 'astra-addon' ),
				),

			);

			if ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) {

				$_configs[] = array(
					'name'        => 'section-sidebars-ast-context-tabs',
					'section'     => 'section-sidebars',
					'type'        => 'control',
					'control'     => 'ast-builder-header-control',
					'priority'    => 0,
					'description' => '',
				);
			} else {

				$_configs[] = array(
					'name'     => ASTRA_THEME_SETTINGS . '[sidebar-color-background-heading-divider]',
					'type'     => 'control',
					'control'  => 'ast-heading',
					'section'  => 'section-sidebars',
					'title'    => __( 'Colors & Background', 'astra-addon' ),
					'priority' => 23,
					'settings' => array(),
					'context'  => astra_addon_builder_helper()->general_tab,
				);
			}

			return array_merge( $configurations, $_configs );
		}
	}
}

/**
 * Kicking this off by calling 'get_instance()' method
 */
new Astra_Customizer_Colors_Sidebar();
