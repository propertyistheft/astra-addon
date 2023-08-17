<?php
/**
 * Sticky Header - Widget Options for our theme.
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

if ( ! class_exists( 'Astra_Sticky_Header_Widget_Configs' ) ) {

	/**
	 * Register Sticky Header Above Header ColorsCustomizer Configurations.
	 */
	// @codingStandardsIgnoreStart
	class Astra_Sticky_Header_Widget_Configs extends Astra_Customizer_Config_Base {
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

			$html_config                    = array();
			$astra_has_widgets_block_editor = astra_addon_has_widgets_block_editor();

			$num_of_header_widgets = astra_addon_builder_helper()->num_of_header_widgets;
			for ( $index = 1; $index <= $num_of_header_widgets; $index++ ) {

				$_section = ( ! $astra_has_widgets_block_editor ) ? 'sidebar-widgets-header-widget-' . $index : 'astra-sidebar-widgets-header-widget-' . $index;

				$_configs = array(

					/**
					 * Option: Sticky Header HTML Heading.
					 */
					array(
						'name'     => ASTRA_THEME_SETTINGS . '[sticky-header-widget-' . $index . '-heading]',
						'type'     => 'control',
						'control'  => 'ast-heading',
						'section'  => $_section,
						'title'    => __( 'Sticky Header Options', 'astra-addon' ),
						'settings' => array(),
						'priority' => 110,
					),

					/**
					 * Option: Widget title color.
					 */
					array(
						'name'              => ASTRA_THEME_SETTINGS . '[sticky-header-widget-' . $index . '-title-color]',
						'default'           => astra_get_option( 'sticky-header-widget-' . $index . '-title-color' ),
						'type'              => 'control',
						'section'           => $_section,
						'priority'          => 120,
						'transport'         => 'postMessage',
						'control'           => 'ast-color',
						'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
						'title'             => __( 'Title Color', 'astra-addon' ),
					),

					/**
					 * Option: Widget Color.
					 */
					array(
						'name'              => ASTRA_THEME_SETTINGS . '[sticky-header-widget-' . $index . '-color]',
						'default'           => astra_get_option( 'sticky-header-widget-' . $index . '-color' ),
						'type'              => 'control',
						'section'           => $_section,
						'priority'          => 130,
						'transport'         => 'postMessage',
						'control'           => 'ast-color',
						'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
						'title'             => __( 'Content Color', 'astra-addon' ),
					),

					/**
					 * Option: Widget link color.
					 */
					array(
						'name'              => ASTRA_THEME_SETTINGS . '[sticky-header-widget-' . $index . '-link-color]',
						'default'           => astra_get_option( 'sticky-header-widget-' . $index . '-link-color' ),
						'type'              => 'control',
						'section'           => $_section,
						'priority'          => 140,
						'transport'         => 'postMessage',
						'control'           => 'ast-color',
						'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
						'title'             => __( 'Link Color', 'astra-addon' ),
					),

					/**
					 * Option: Widget link hover color.
					 */
					array(
						'name'              => ASTRA_THEME_SETTINGS . '[sticky-header-widget-' . $index . '-link-h-color]',
						'default'           => astra_get_option( 'sticky-header-widget-' . $index . '-link-h-color' ),
						'type'              => 'control',
						'section'           => $_section,
						'priority'          => 150,
						'transport'         => 'postMessage',
						'control'           => 'ast-color',
						'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
						'title'             => __( 'Link Hover Color', 'astra-addon' ),
						'divider'           => array( 'ast_class' => 'ast-bottom-divider' ),
					),
				);

				$html_config[] = $_configs;
			}

			$html_config    = call_user_func_array( 'array_merge', $html_config + array( array() ) );
			$configurations = array_merge( $configurations, $html_config );

			return $configurations;
		}
	}
}

new Astra_Sticky_Header_Widget_Configs();
