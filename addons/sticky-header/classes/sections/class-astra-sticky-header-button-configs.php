<?php
/**
 * Sticky Header - Button Options for our theme.
 *
 * @package     Astra Addon
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

if ( ! class_exists( 'Astra_Sticky_Header_Button_Configs' ) ) {

	/**
	 * Register Sticky Header Above Header ColorsCustomizer Configurations.
	 */
	// @codingStandardsIgnoreStart
	class Astra_Sticky_Header_Button_Configs extends Astra_Customizer_Config_Base {
 // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedClassFound
		// @codingStandardsIgnoreEnd

		/**
		 * Register Sticky Header Colors Customizer Configurations.
		 *
		 * @param Array                $configurations Astra Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array Astra Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$html_config = array();

			$main_stick  = astra_get_option( 'header-main-stick' );
			$above_stick = astra_get_option( 'header-above-stick' );
			$below_stick = astra_get_option( 'header-below-stick' );

			$component_limit = astra_addon_builder_helper()->component_limit;
			for ( $index = 1; $index <= $component_limit; $index++ ) {

				$_section = 'section-hb-button-' . $index;
				$_prefix  = 'button' . $index;

				$_configs = array(

					/**
					 * Option: Sticky Header Button Heading.
					 */
					array(
						'name'     => ASTRA_THEME_SETTINGS . '[sticky-header-' . $_prefix . '-heading]',
						'type'     => 'control',
						'control'  => 'ast-heading',
						'section'  => $_section,
						'title'    => __( 'Sticky Header Options', 'astra-addon' ),
						'settings' => array(),
						'priority' => 100,
						'context'  => astra_addon_builder_helper()->design_tab,
						'divider'  => array( 'ast_class' => 'ast-section-spacing' ),
					),
					/**
					 * Group: Primary Header Button Colors Group
					 */
					array(
						'name'       => ASTRA_THEME_SETTINGS . '[sticky-header-' . $_prefix . '-text-color-group]',
						'default'    => astra_get_option( 'sticky-header-' . $_prefix . '-color-group' ),
						'type'       => 'control',
						'control'    => Astra_Theme_Extension::$group_control,
						'title'      => __( 'Text Color', 'astra-addon' ),
						'section'    => $_section,
						'transport'  => 'postMessage',
						'priority'   => 101,
						'context'    => astra_addon_builder_helper()->design_tab,
						'responsive' => true,
						'divider'    => array( 'ast_class' => 'ast-section-spacing' ),

					),

					array(
						'name'       => ASTRA_THEME_SETTINGS . '[sticky-header-' . $_prefix . '-background-color-group]',
						'default'    => astra_get_option( 'sticky-header-' . $_prefix . '-color-group' ),
						'type'       => 'control',
						'control'    => Astra_Theme_Extension::$group_control,
						'title'      => __( 'Background Color', 'astra-addon' ),
						'section'    => $_section,
						'transport'  => 'postMessage',
						'priority'   => 101,
						'context'    => astra_addon_builder_helper()->design_tab,
						'responsive' => true,
					),

					/**
					* Option: Button Text Color
					*/
					array(
						'name'       => 'sticky-header-' . $_prefix . '-text-color',
						'transport'  => 'postMessage',
						'default'    => astra_get_option( 'sticky-header-' . $_prefix . '-text-color' ),
						'type'       => 'sub-control',
						'parent'     => ASTRA_THEME_SETTINGS . '[sticky-header-' . $_prefix . '-text-color-group]',
						'section'    => $_section,
						'control'    => 'ast-responsive-color',
						'responsive' => true,
						'rgba'       => true,
						'priority'   => 10,
						'context'    => astra_addon_builder_helper()->design_tab,
						'title'      => __( 'Normal', 'astra-addon' ),
						'tab'        => __( 'Normal', 'astra-addon' ),
					),

					/**
					* Option: Button Text Hover Color
					*/
					array(
						'name'       => 'sticky-header-' . $_prefix . '-text-h-color',
						'default'    => astra_get_option( 'sticky-header-' . $_prefix . '-text-h-color' ),
						'transport'  => 'postMessage',
						'type'       => 'sub-control',
						'parent'     => ASTRA_THEME_SETTINGS . '[sticky-header-' . $_prefix . '-text-color-group]',
						'section'    => $_section,
						'control'    => 'ast-responsive-color',
						'responsive' => true,
						'rgba'       => true,
						'priority'   => 10,
						'context'    => astra_addon_builder_helper()->design_tab,
						'title'      => __( 'Hover', 'astra-addon' ),
						'tab'        => __( 'Hover', 'astra-addon' ),
					),

					/**
					* Option: Button Background Color
					*/
					array(
						'name'       => 'sticky-header-' . $_prefix . '-back-color',
						'default'    => astra_get_option( 'sticky-header-' . $_prefix . '-back-color' ),
						'transport'  => 'postMessage',
						'type'       => 'sub-control',
						'parent'     => ASTRA_THEME_SETTINGS . '[sticky-header-' . $_prefix . '-background-color-group]',
						'section'    => $_section,
						'control'    => 'ast-responsive-color',
						'responsive' => true,
						'rgba'       => true,
						'priority'   => 10,
						'context'    => astra_addon_builder_helper()->design_tab,
						'title'      => __( 'Normal', 'astra-addon' ),
						'tab'        => __( 'Normal', 'astra-addon' ),
					),

					/**
					* Option: Button Button Hover Color
					*/
					array(
						'name'       => 'sticky-header-' . $_prefix . '-back-h-color',
						'default'    => astra_get_option( 'sticky-header-' . $_prefix . '-back-h-color' ),
						'transport'  => 'postMessage',
						'type'       => 'sub-control',
						'parent'     => ASTRA_THEME_SETTINGS . '[sticky-header-' . $_prefix . '-background-color-group]',
						'section'    => $_section,
						'control'    => 'ast-responsive-color',
						'responsive' => true,
						'rgba'       => true,
						'priority'   => 10,
						'context'    => astra_addon_builder_helper()->design_tab,
						'title'      => __( 'Hover', 'astra-addon' ),
						'tab'        => __( 'Hover', 'astra-addon' ),
					),

					// Padding.
					array(
						'name'              => ASTRA_THEME_SETTINGS . '[sticky-header-' . $_prefix . '-padding]',
						'default'           => astra_get_option( 'sticky-header-' . $_prefix . '-padding' ),
						'type'              => 'control',
						'transport'         => 'postMessage',
						'control'           => 'ast-responsive-spacing',
						'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_responsive_spacing' ),
						'section'           => $_section,
						'priority'          => 120,
						'title'             => __( 'Sticky Header Padding', 'astra-addon' ),
						'linked_choices'    => true,
						'unit_choices'      => array( 'px', 'em', '%' ),
						'choices'           => array(
							'top'    => __( 'Top', 'astra-addon' ),
							'right'  => __( 'Right', 'astra-addon' ),
							'bottom' => __( 'Bottom', 'astra-addon' ),
							'left'   => __( 'Left', 'astra-addon' ),
						),
						'context'           => astra_addon_builder_helper()->design_tab,
					),

					/**
					* Option: Button Border Size
					*/
					array(
						'name'           => ASTRA_THEME_SETTINGS . '[sticky-header-' . $_prefix . '-border-size]',
						'default'        => astra_get_option( 'sticky-header-' . $_prefix . '-border-size' ),
						'type'           => 'control',
						'section'        => $_section,
						'control'        => 'ast-border',
						'transport'      => 'postMessage',
						'linked_choices' => true,
						'priority'       => 120,
						'title'          => __( 'Border Width', 'astra-addon' ),
						'context'        => astra_addon_builder_helper()->design_tab,
						'choices'        => array(
							'top'    => __( 'Top', 'astra-addon' ),
							'right'  => __( 'Right', 'astra-addon' ),
							'bottom' => __( 'Bottom', 'astra-addon' ),
							'left'   => __( 'Left', 'astra-addon' ),
						),
						'divider'        => array( 'ast_class' => 'ast-top-section-divider' ),
					),

					array(
						'name'       => ASTRA_THEME_SETTINGS . '[header-' . $_prefix . '-button-border-colors-group]',
						'type'       => 'control',
						'control'    => Astra_Theme_Extension::$group_control,
						'title'      => __( 'Border Color', 'astra-addon' ),
						'section'    => $_section,
						'priority'   => 110,
						'transport'  => 'postMessage',
						'context'    => astra_addon_builder_helper()->design_tab,
						'responsive' => true,
						'divider'    => array( 'ast_class' => 'ast-bottom-section-divider' ),
					),

					/**
					* Option: Button Border Color
					*/
					array(
						'name'       => 'sticky-header-' . $_prefix . '-border-color',
						'default'    => astra_get_option( 'sticky-header-' . $_prefix . '-border-color' ),
						'parent'     => ASTRA_THEME_SETTINGS . '[header-' . $_prefix . '-button-border-colors-group]',
						'transport'  => 'postMessage',
						'type'       => 'sub-control',
						'section'    => $_section,
						'control'    => 'ast-responsive-color',
						'responsive' => true,
						'rgba'       => true,
						'priority'   => 110,
						'context'    => astra_addon_builder_helper()->design_tab,
						'title'      => __( 'Normal', 'astra-addon' ),
					),

					/**
					* Option: Button Border Hover Color
					*/
					array(
						'name'       => 'sticky-header-' . $_prefix . '-border-h-color',
						'default'    => astra_get_option( 'sticky-header-' . $_prefix . '-border-h-color' ),
						'parent'     => ASTRA_THEME_SETTINGS . '[header-' . $_prefix . '-button-border-colors-group]',
						'transport'  => 'postMessage',
						'type'       => 'sub-control',
						'section'    => $_section,
						'control'    => 'ast-responsive-color',
						'responsive' => true,
						'rgba'       => true,
						'priority'   => 110,
						'context'    => astra_addon_builder_helper()->design_tab,
						'title'      => __( 'Hover', 'astra-addon' ),
					),

					/**
					 * Option: Button Radius Fields
					 */
					array(
						'name'              => ASTRA_THEME_SETTINGS . '[sticky-header-' . $_prefix . '-border-radius-fields]',
						'default'           => astra_get_option( 'sticky-header-' . $_prefix . '-border-radius-fields' ),
						'type'              => 'control',
						'control'           => 'ast-responsive-spacing',
						'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_responsive_spacing' ),
						'section'           => $_section,
						'title'             => __( 'Border Radius', 'astra-addon' ),
						'linked_choices'    => true,
						'transport'         => 'postMessage',
						'unit_choices'      => array( 'px', 'em', '%' ),
						'choices'           => array(
							'top'    => __( 'Top', 'astra-addon' ),
							'right'  => __( 'Right', 'astra-addon' ),
							'bottom' => __( 'Bottom', 'astra-addon' ),
							'left'   => __( 'Left', 'astra-addon' ),
						),
						'priority'          => 120,
						'context'           => astra_addon_builder_helper()->design_tab,
						'connected'         => false,
						'divider'           => array( 'ast_class' => 'ast-top-section-divider' ),
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

new Astra_Sticky_Header_Button_Configs();



