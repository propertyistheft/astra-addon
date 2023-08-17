<?php
/**
 * Sticky Header - Account options for our theme.
 *
 * @package     Astra Addon
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

if ( ! class_exists( 'Astra_Sticky_Header_Account_Configs' ) ) {

	/**
	 * Register Sticky Header Above Header ColorsCustomizer Configurations.
	 */
	// @codingStandardsIgnoreStart
	class Astra_Sticky_Header_Account_Configs extends Astra_Customizer_Config_Base {
 // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedClassFound
		// @codingStandardsIgnoreEnd

		/**
		 * Register Sticky Header Colors Customizer Configurations.
		 *
		 * @param Array                $configurations Astra Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 3.0.0
		 * @return Array Astra Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_section = 'section-header-account';

			$_configs = array(

				/**
				 * Option: Sticky Header account Heading.
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[sticky-header-account-heading]',
					'type'     => 'control',
					'control'  => 'ast-heading',
					'section'  => $_section,
					'title'    => __( 'Sticky Header Option', 'astra-addon' ),
					'settings' => array(),
					'priority' => 120,
					'context'  => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'relation' => 'OR',
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[header-account-login-style]',
								'operator' => '==',
								'value'    => 'icon',
							),
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[header-account-login-style]',
								'operator' => '==',
								'value'    => 'text',
							),
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[header-account-logout-style]',
								'operator' => '!=',
								'value'    => 'none',
							),
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[header-account-action-type]',
								'operator' => '==',
								'value'    => 'menu',
							),
						),
					),
				),

				/**
				 * Option: Search Color.
				 */
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[sticky-header-account-icon-color]',
					'default'           => astra_get_option( 'sticky-header-account-icon-color' ),
					'type'              => 'control',
					'section'           => $_section,
					'priority'          => 130,
					'transport'         => 'postMessage',
					'control'           => 'ast-color',
					'divider'           => array( 'ast_class' => 'ast-bottom-spacing ast-section-spacing' ),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
					'title'             => __( 'Icon Color', 'astra-addon' ),
					'context'           => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'relation' => 'OR',
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[header-account-login-style]',
								'operator' => '==',
								'value'    => 'icon',
							),
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[header-account-logout-style]',
								'operator' => '==',
								'value'    => 'icon',
							),
						),
					),
				),

				/**
				 * Option: Text Color.
				 */
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[sticky-header-account-type-text-color]',
					'default'           => astra_get_option( 'sticky-header-account-type-text-color' ),
					'type'              => 'control',
					'section'           => $_section,
					'priority'          => 131,
					'transport'         => 'postMessage',
					'control'           => 'ast-color',
					'divider'           => array( 'ast_class' => 'ast-bottom-spacing' ),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
					'title'             => __( 'Text Color', 'astra-addon' ),
					'context'           => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'relation' => 'OR',
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[header-account-login-style]',
								'operator' => '==',
								'value'    => 'text',
							),
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[header-account-logout-style]',
								'operator' => '==',
								'value'    => 'text',
							),
						),
					),
				),

				array(
					'name'       => ASTRA_THEME_SETTINGS . '[sticky-header-account-menu-colors]',
					'default'    => astra_get_option( 'sticky-header-account-menu-colors' ),
					'type'       => 'control',
					'control'    => Astra_Theme_Extension::$group_control,
					'divider'    => array(
						'ast_title' => __( 'Menu Color', 'astra-addon' ),
					),
					'title'      => __( 'Link', 'astra-addon' ),
					'section'    => $_section,
					'transport'  => 'postMessage',
					'priority'   => 140,
					'context'    => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[header-account-action-type]',
							'operator' => '==',
							'value'    => 'menu',
						),
					),
					'responsive' => false,
				),

				array(
					'name'       => ASTRA_THEME_SETTINGS . '[sticky-header-account-menu-bg-colors]',
					'type'       => 'control',
					'control'    => Astra_Theme_Extension::$group_control,
					'title'      => __( 'Background', 'astra-addon' ),
					'section'    => $_section,
					'transport'  => 'postMessage',
					'priority'   => 140,
					'divider'    => array( 'ast_class' => 'ast-bottom-spacing' ),
					'context'    => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[header-account-action-type]',
							'operator' => '==',
							'value'    => 'menu',
						),
					),
					'responsive' => false,
				),

				// Option: Menu Color.
				array(
					'name'      => 'sticky-header-account-menu-color',
					'default'   => astra_get_option( 'sticky-header-account-menu-color' ),
					'parent'    => ASTRA_THEME_SETTINGS . '[sticky-header-account-menu-colors]',
					'type'      => 'sub-control',
					'control'   => 'ast-color',
					'transport' => 'postMessage',
					'tab'       => __( 'Normal', 'astra-addon' ),
					'section'   => $_section,
					'title'     => __( 'Normal', 'astra-addon' ),
					'priority'  => 7,
					'context'   => array(
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[header-account-action-type]',
							'operator' => '==',
							'value'    => 'menu',
						),
						astra_addon_builder_helper()->design_tab,
					),
				),

				// Option: Background Color.
				array(
					'name'      => 'sticky-header-account-menu-bg-obj',
					'default'   => astra_get_option( 'sticky-header-account-menu-bg-obj' ),
					'parent'    => ASTRA_THEME_SETTINGS . '[sticky-header-account-menu-bg-colors]',
					'type'      => 'sub-control',
					'control'   => 'ast-color',
					'transport' => 'postMessage',
					'section'   => $_section,
					'title'     => __( 'Normal', 'astra-addon' ),
					'tab'       => __( 'Normal', 'astra-addon' ),
					'priority'  => 8,
					'context'   => astra_addon_builder_helper()->design_tab,
				),

				// Option: Menu Hover Color.
				array(
					'name'      => 'sticky-header-account-menu-h-color',
					'default'   => astra_get_option( 'sticky-header-account-menu-h-color' ),
					'parent'    => ASTRA_THEME_SETTINGS . '[sticky-header-account-menu-colors]',
					'tab'       => __( 'Hover', 'astra-addon' ),
					'type'      => 'sub-control',
					'control'   => 'ast-color',
					'transport' => 'postMessage',
					'title'     => __( 'Hover', 'astra-addon' ),
					'section'   => $_section,
					'priority'  => 19,
					'context'   => astra_addon_builder_helper()->design_tab,
				),

				// Option: Menu Hover Background Color.
				array(
					'name'      => 'sticky-header-account-menu-h-bg-color',
					'default'   => astra_get_option( 'sticky-header-account-menu-h-bg-color' ),
					'parent'    => ASTRA_THEME_SETTINGS . '[sticky-header-account-menu-bg-colors]',
					'type'      => 'sub-control',
					'title'     => __( 'Hover', 'astra-addon' ),
					'section'   => $_section,
					'control'   => 'ast-color',
					'transport' => 'postMessage',
					'tab'       => __( 'Hover', 'astra-addon' ),
					'priority'  => 21,
					'context'   => astra_addon_builder_helper()->design_tab,
				),

				// Option: Active Menu Color.
				array(
					'name'      => 'sticky-header-account-menu-a-color',
					'default'   => astra_get_option( 'sticky-header-account-menu-a-color' ),
					'parent'    => ASTRA_THEME_SETTINGS . '[sticky-header-account-menu-colors]',
					'type'      => 'sub-control',
					'section'   => $_section,
					'control'   => 'ast-color',
					'transport' => 'postMessage',
					'tab'       => __( 'Active', 'astra-addon' ),
					'title'     => __( 'Active', 'astra-addon' ),
					'priority'  => 31,
					'context'   => astra_addon_builder_helper()->design_tab,
				),

				// Option: Active Menu Background Color.
				array(
					'name'      => 'sticky-header-account-menu-a-bg-color',
					'default'   => astra_get_option( 'sticky-header-account-menu-a-bg-color' ),
					'parent'    => ASTRA_THEME_SETTINGS . '[sticky-header-account-menu-bg-colors]',
					'type'      => 'sub-control',
					'control'   => 'ast-color',
					'transport' => 'postMessage',
					'section'   => $_section,
					'title'     => __( 'Active', 'astra-addon' ),
					'tab'       => __( 'Active', 'astra-addon' ),
					'priority'  => 33,
					'context'   => astra_addon_builder_helper()->design_tab,
				),
			);

			return array_merge( $configurations, $_configs );
		}
	}
}

new Astra_Sticky_Header_Account_Configs();
