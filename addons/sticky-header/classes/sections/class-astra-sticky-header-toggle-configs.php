<?php
/**
 * Sticky Header - Toggle Options for our theme.
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

if ( ! class_exists( 'Astra_Sticky_Header_Toggle_Configs' ) ) {

	/**
	 * Register Sticky Header > Toggle component Customizer Configurations.
	 */
	// @codingStandardsIgnoreStart
	class Astra_Sticky_Header_Toggle_Configs extends Astra_Customizer_Config_Base {
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

			$_section = 'section-header-mobile-trigger';

			$_configs = array(

				/**
				 * Option: Sticky Header divider Heading.
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[sticky-header-toggle-design-heading]',
					'type'     => 'control',
					'control'  => 'ast-heading',
					'section'  => $_section,
					'title'    => __( 'Sticky Header Option', 'astra-addon' ),
					'settings' => array(),
					'priority' => 110,
					'context'  => astra_addon_builder_helper()->design_tab,
					'divider'  => array( 'ast_class' => 'ast-section-spacing' ),
				),

				/**
				 * Option: Toggle Button Color
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[sticky-header-toggle-btn-color]',
					'default'   => astra_get_option( 'sticky-header-toggle-btn-color' ),
					'type'      => 'control',
					'control'   => 'ast-color',
					'title'     => __( 'Color', 'astra-addon' ),
					'section'   => $_section,
					'transport' => 'postMessage',
					'priority'  => 115,
					'context'   => astra_addon_builder_helper()->design_tab,
					'divider'   => array( 'ast_class' => 'ast-section-spacing' ),
				),

				/**
				 * Option: Toggle Button Bg Color
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[sticky-header-toggle-btn-bg-color]',
					'default'   => astra_get_option( 'sticky-header-toggle-btn-bg-color' ),
					'type'      => 'control',
					'control'   => 'ast-color',
					'title'     => __( 'Background Color', 'astra-addon' ),
					'section'   => $_section,
					'transport' => 'postMessage',
					'priority'  => 120,
					'context'   => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[mobile-header-toggle-btn-style]',
							'operator' => '==',
							'value'    => 'fill',
						),
					),
				),

				/**
				 * Option: Toggle Button Border Color
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[sticky-header-toggle-border-color]',
					'default'   => astra_get_option( 'sticky-header-toggle-border-color' ),
					'type'      => 'control',
					'control'   => 'ast-color',
					'title'     => __( 'Border Color', 'astra-addon' ),
					'section'   => $_section,
					'transport' => 'postMessage',
					'priority'  => 125,
					'context'   => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[mobile-header-toggle-btn-style]',
							'operator' => '==',
							'value'    => 'outline',
						),
					),
				),
			);

			return array_merge( $configurations, $_configs );
		}
	}
}

new Astra_Sticky_Header_Toggle_Configs();
