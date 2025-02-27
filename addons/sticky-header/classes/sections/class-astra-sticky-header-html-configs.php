<?php
/**
 * Sticky Header - HTML Options for our theme.
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

if ( ! class_exists( 'Astra_Sticky_Header_Html_Configs' ) ) {

	/**
	 * Register Sticky Header Above Header ColorsCustomizer Configurations.
	 */
	// @codingStandardsIgnoreStart
	class Astra_Sticky_Header_Html_Configs extends Astra_Customizer_Config_Base {
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

			$html_config = array();

			$component_limit = astra_addon_builder_helper()->component_limit;
			for ( $index = 1; $index <= $component_limit; $index++ ) {

				$_section = 'section-hb-html-' . $index;

				$_configs = array(

					/**
					 * Option: Sticky Header HTML Heading.
					 */
					array(
						'name'     => ASTRA_THEME_SETTINGS . '[sticky-header-html-' . $index . '-heading]',
						'type'     => 'control',
						'control'  => 'ast-heading',
						'section'  => $_section,
						'title'    => __( 'Sticky Header Option', 'astra-addon' ),
						'settings' => array(),
						'priority' => 99,
						'context'  => astra_addon_builder_helper()->design_tab,
						'divider'  => array( 'ast_class' => 'ast-section-spacing' ),
					),
					/**
					 * Option: HTML Color.
					 */
					array(
						'name'              => ASTRA_THEME_SETTINGS . '[sticky-header-html-' . $index . 'color]',
						'default'           => astra_get_option( 'sticky-header-html-' . $index . 'color' ),
						'type'              => 'control',
						'section'           => $_section,
						'priority'          => 99,
						'transport'         => 'postMessage',
						'control'           => 'ast-color',
						'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
						'title'             => __( 'Text Color', 'astra-addon' ),
						'context'           => astra_addon_builder_helper()->design_tab,
						'divider'           => array( 'ast_class' => 'ast-section-spacing' ),
					),
				);

				$html_config[] = $_configs;
			}

			$html_config = call_user_func_array( 'array_merge', $html_config + array( array() ) );
			return array_merge( $configurations, $html_config );
		}
	}
}

new Astra_Sticky_Header_Html_Configs();
