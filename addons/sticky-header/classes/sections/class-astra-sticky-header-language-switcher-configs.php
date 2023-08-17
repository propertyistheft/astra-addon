<?php
/**
 * Sticky Header - language-switcher Options for our theme.
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

/**
 * Register Sticky Header Above Header Colors Customizer Configurations.
 */
// @codingStandardsIgnoreStart
class Astra_Sticky_Header_Language_Switcher_Configs extends Astra_Customizer_Config_Base {
 // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedClassFound
		// @codingStandardsIgnoreEnd

	/**
	 * Register Sticky Header Colors Customizer Configurations.
	 *
	 * @param Array                $configurations Astra Customizer Configurations.
	 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
	 * @since 3.1.0
	 * @return Array Astra Customizer Configurations with updated configurations.
	 */
	public function register_configuration( $configurations, $wp_customize ) {

		$_section = 'section-hb-language-switcher';

		$_configs = array(

			/**
			 * Option: Sticky Header language-switcher Heading.
			 */
			array(
				'name'     => ASTRA_THEME_SETTINGS . '[sticky-header-language-switcher-heading]',
				'type'     => 'control',
				'control'  => 'ast-heading',
				'section'  => $_section,
				'title'    => __( 'Sticky Header Option', 'astra-addon' ),
				'settings' => array(),
				'priority' => 110,
				'context'  => array(
					array(
						'setting'  => ASTRA_THEME_SETTINGS . '[header-language-switcher-show-name]',
						'operator' => '==',
						'value'    => true,
					),
					astra_addon_builder_helper()->design_tab_config,
				),
				'divider'  => array( 'ast_class' => 'ast-section-spacing' ),
			),
			/**
			 * Option: language-switcher Color.
			 */
			array(
				'name'      => ASTRA_THEME_SETTINGS . '[sticky-header-language-switcher-color]',
				'default'   => astra_get_option( 'sticky-header-language-switcher-color' ),
				'type'      => 'control',
				'section'   => $_section,
				'priority'  => 120,
				'transport' => 'postMessage',
				'control'   => 'ast-color',
				'title'     => __( 'Color', 'astra-addon' ),
				'divider'   => array( 'ast_class' => 'ast-bottom-spacing' ),
				'context'   => array(
					array(
						'setting'  => ASTRA_THEME_SETTINGS . '[header-language-switcher-show-name]',
						'operator' => '==',
						'value'    => true,
					),
					astra_addon_builder_helper()->design_tab_config,
				),
			),
		);

		return array_merge( $configurations, $_configs );
	}
}

new Astra_Sticky_Header_Language_Switcher_Configs();
