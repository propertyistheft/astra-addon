<?php
/**
 * Sticky Header - Color Switcher Options for our theme.
 *
 * @package     Astra Addon
 * @link        https://www.brainstormforce.com
 * @since       4.10.0
 */

defined( 'ABSPATH' ) or exit; // Block direct access to the file.

// Bail if Customizer config base class does not exist.
if ( ! class_exists( 'Astra_Customizer_Config_Base' ) ) {
	return;
}

/**
 * Register Color Switcher configuration for Sticky Header.
 */
class Astra_Sticky_Header_Color_Switcher_Configs extends Astra_Customizer_Config_Base {

	/**
	 * Register Sticky Header <> Color Switcher Customizer Configurations.
	 *
	 * @param Array                $configurations Astra Customizer Configurations.
	 * @param WP_Customize_Manager $wp_customize   Instance of WP_Customize_Manager.
	 *
	 * @return Array Astra Customizer Configurations with updated configurations.
	 * @since 4.10.0
	 */
	public function register_configuration( $configurations, $wp_customize ) {

		$_section = 'section-hb-color-switcher';

		/* Option: Heading */
		$configurations[] = array(
			'name'     => ASTRA_THEME_SETTINGS . '[sticky-color-switcher-heading]',
			'type'     => 'control',
			'control'  => 'ast-heading',
			'section'  => $_section,
			'title'    => __( 'Sticky Header Option', 'astra-addon' ),
			'priority' => 2,
			'context'  => astra_addon_builder_helper()->design_tab,
			'divider'  => array( 'ast_class' => 'ast-section-spacing' ),
		);

		/* Option: Icon Color. */
		$configurations[] = array(
			'name'       => ASTRA_THEME_SETTINGS . '[sticky-color-switcher-icon-color]',
			'default'    => astra_get_option( 'sticky-color-switcher-icon-color' ),
			'type'       => 'control',
			'section'    => $_section,
			'priority'   => 2,
			'transport'  => 'postMessage',
			'control'    => 'ast-responsive-color',
			'responsive' => true,
			'rgba'       => true,
			'title'      => __( 'Icon Color', 'astra-addon' ),
			'context'    => astra_addon_builder_helper()->design_tab,
			'divider'    => array( 'ast_class' => 'ast-section-spacing' ),
		);

		/* Heading: Background Group */
		$configurations[] = array(
			'name'       => ASTRA_THEME_SETTINGS . '[sticky-color-switcher-background-group]',
			'default'    => astra_get_option( 'sticky-color-switcher-background-group' ),
			'section'    => $_section,
			'type'       => 'control',
			'control'    => 'ast-color-group',
			'title'      => __( 'Background', 'astra-addon' ),
			'transport'  => 'postMessage',
			'priority'   => 2,
			'context'    => astra_addon_builder_helper()->design_tab,
			'responsive' => true,
		);

		/* Option: Button Background */
		$configurations[] = array(
			'name'       => 'sticky-color-switcher-background',
			'default'    => astra_get_option( 'sticky-color-switcher-background' ),
			'section'    => $_section,
			'parent'     => ASTRA_THEME_SETTINGS . '[sticky-color-switcher-background-group]',
			'type'       => 'sub-control',
			'control'    => 'ast-responsive-color',
			'title'      => __( 'Normal', 'astra-addon' ),
			'transport'  => 'postMessage',
			'responsive' => true,
			'rgba'       => true,
		);

		/* Option: Button Background Hover */
		$configurations[] = array(
			'name'       => 'sticky-color-switcher-background-hover',
			'default'    => astra_get_option( 'sticky-color-switcher-background-hover' ),
			'section'    => $_section,
			'parent'     => ASTRA_THEME_SETTINGS . '[sticky-color-switcher-background-group]',
			'type'       => 'sub-control',
			'control'    => 'ast-responsive-color',
			'title'      => __( 'Hover', 'astra-addon' ),
			'transport'  => 'postMessage',
			'responsive' => true,
			'rgba'       => true,
		);

		return $configurations;
	}
}

new Astra_Sticky_Header_Color_Switcher_Configs();
