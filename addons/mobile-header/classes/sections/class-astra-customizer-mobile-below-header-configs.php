<?php
/**
 * Astra Mobile Header.
 *
 * @package     Astra Addon
 * @author      Brainstorm Force
 * @copyright   Copyright (c) 2020, Brainstorm Force
 * @link        https://www.brainstormforce.com
 * @since       Astra 1.4.0
 */

// Block direct access to the file.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Bail if Customizer config base class does not exist.
if ( ! class_exists( 'Astra_Customizer_Config_Base' ) ) {
	return;
}
if ( ! class_exists( 'Astra_Customizer_Mobile_Below_Header_Configs' ) ) {

	/**
	 * Customizer Sanitizes Initial setup
	 */
	class Astra_Customizer_Mobile_Below_Header_Configs extends Astra_Customizer_Config_Base {

		/**
		 * Register Panels and Sections for Customizer.
		 *
		 * @param Array                $configurations Astra Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array Astra Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$show_deprecated_no_toggle_style = 'no-toggle' == astra_get_option( 'mobile-below-header-menu-style' ) ? true : false;

			// Check deprecated flag has been set or not.
			if ( apply_filters( 'astra_no_toggle_menu_style_deprecate', $show_deprecated_no_toggle_style ) ) {
				$menu_style_choices     = array(
					'default'    => __( 'Dropdown', 'astra-addon' ),
					'flyout'     => __( 'Flyout', 'astra-addon' ),
					'fullscreen' => __( 'Full-Screen', 'astra-addon' ),
					'no-toggle'  => __( 'No Toggle (Deprecated)', 'astra-addon' ),
				);
				$menu_style_description = __( 'No Toggle style will no longer supported. We recommend you to choose different menu style.', 'astra-addon' );
			} else {
				$menu_style_choices     = array(
					'default'    => __( 'Dropdown', 'astra-addon' ),
					'flyout'     => __( 'Flyout', 'astra-addon' ),
					'fullscreen' => __( 'Full-Screen', 'astra-addon' ),
				);
				$menu_style_description = __( 'No Toggle option has been deprecated.', 'astra-addon' );
			}

			$configs = array(

				/**
				 * Option: Mobile Menu Style
				 */
				array(
					'name'        => ASTRA_THEME_SETTINGS . '[mobile-below-header-menu-style]',
					'section'     => 'section-below-header',
					'default'     => astra_get_option( 'mobile-below-header-menu-style' ),
					'title'       => __( 'Menu Style', 'astra-addon' ),
					'type'        => 'control',
					'control'     => 'ast-select',
					'transport'   => 'refresh',
					'context'     => array(
						astra_addon_builder_helper()->general_tab_config,
						'relation' => 'AND',
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[below-header-layout]',
							'operator' => '!=',
							'value'    => 'disabled',
						),
						array(
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[below-header-on-mobile]',
								'operator' => '==',
								'value'    => true,
							),
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[below-header-merge-menu]',
								'operator' => '!=',
								'value'    => true,
							),
						),
					),
					'priority'    => 106,
					'choices'     => $menu_style_choices,
					'description' => $menu_style_description,
				),

				/**
				 * Option: Mobile Menu Style - Flyout alignments
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[flyout-mobile-below-header-menu-alignment]',
					'section'  => 'section-below-header',
					'default'  => astra_get_option( 'flyout-mobile-below-header-menu-alignment' ),
					'title'    => __( 'Flyout Menu Alignment', 'astra-addon' ),
					'type'     => 'control',
					'control'  => 'ast-select',
					'priority' => 106,
					'choices'  => array(
						'left'  => __( 'Left', 'astra-addon' ),
						'right' => __( 'Right', 'astra-addon' ),
					),
					'context'  => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[mobile-below-header-menu-style]',
							'operator' => '==',
							'value'    => 'flyout',
						),
					),
				),

				/**
				* Option: Toggle Button Style
				*/
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[mobile-below-header-toggle-btn-style]',
					'type'      => 'control',
					'control'   => 'ast-select',
					'section'   => 'section-below-header',
					'title'     => __( 'Toggle Button Style', 'astra-addon' ),
					'transport' => 'postMessage',
					'context'   => array(
						astra_addon_builder_helper()->general_tab_config,
						'relation' => 'AND',
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[below-header-layout]',
							'operator' => '!=',
							'value'    => 'disabled',
						),
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[mobile-below-header-menu-style]',
							'operator' => '!=',
							'value'    => 'no-toggle',
						),
					),
					'default'   => astra_get_option( 'mobile-below-header-toggle-btn-style' ),
					'priority'  => 107,
					'choices'   => array(
						'fill'    => __( 'Fill', 'astra-addon' ),
						'outline' => __( 'Outline', 'astra-addon' ),
						'minimal' => __( 'Minimal', 'astra-addon' ),
					),
				),

				/**
				* Option: Toggle Button Color
				*/
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[mobile-below-header-toggle-btn-style-color]',
					'type'              => 'control',
					'control'           => 'ast-color',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
					'divider'           => array( 'ast_class' => 'ast-bottom-divider' ),
					'context'           => array(
						astra_addon_builder_helper()->general_tab_config,
						'relation' => 'AND',
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[below-header-layout]',
							'operator' => '!=',
							'value'    => 'disabled',
						),
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[mobile-below-header-menu-style]',
							'operator' => '!=',
							'value'    => 'no-toggle',
						),
					),
					'default'           => astra_get_option( 'mobile-below-header-toggle-btn-style-color' ),
					'title'             => __( 'Toggle Button Color', 'astra-addon' ),
					'section'           => 'section-below-header',
					'transport'         => 'postMessage',
					'priority'          => 107,
				),

				/**
				* Option: Border Radius
				*/
				array(
					'name'        => ASTRA_THEME_SETTINGS . '[mobile-below-header-toggle-btn-border-radius]',
					'type'        => 'control',
					'control'     => 'ast-slider',
					'transport'   => 'postMessage',
					'context'     => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[mobile-below-header-menu-style]',
							'operator' => '!=',
							'value'    => 'no-toggle',
						),
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[mobile-below-header-toggle-btn-style]',
							'operator' => '!=',
							'value'    => 'minimal',
						),
					),
					'default'     => astra_get_option( 'mobile-below-header-toggle-btn-border-radius' ),
					'section'     => 'section-below-header',
					'title'       => __( 'Border Radius', 'astra-addon' ),
					'priority'    => 107,
					'suffix'      => 'px',
					'input_attrs' => array(
						'min'  => 0,
						'step' => 1,
						'max'  => 100,
					),
				),

				/**
				 * Option: Mobile Header Menu Border
				 */
				array(
					'name'           => ASTRA_THEME_SETTINGS . '[mobile-below-header-menu-all-border]',
					'type'           => 'control',
					'control'        => 'ast-border',
					'transport'      => 'postMessage',
					'section'        => 'section-below-header',
					'default'        => astra_get_option( 'mobile-below-header-menu-all-border' ),
					'title'          => __( 'Menu Items Border', 'astra-addon' ),
					'linked_choices' => true,
					'context'        => array(
						astra_addon_builder_helper()->general_tab_config,
						'relation' => 'AND',
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[below-header-layout]',
							'operator' => '!=',
							'value'    => 'disabled',
						),
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[below-header-on-mobile]',
							'operator' => '==',
							'value'    => true,
						),
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[below-header-merge-menu]',
							'operator' => '!=',
							'value'    => true,
						),
					),
					'priority'       => 130,
					'choices'        => array(
						'top'    => __( 'Top', 'astra-addon' ),
						'right'  => __( 'Right', 'astra-addon' ),
						'bottom' => __( 'Bottom', 'astra-addon' ),
						'left'   => __( 'Left', 'astra-addon' ),
					),
				),

				/**
				 * Option: Mobile Header Menu Border Color
				 */
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[mobile-below-header-menu-b-color]',
					'type'              => 'control',
					'control'           => 'ast-color',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
					'default'           => astra_get_option( 'mobile-below-header-menu-b-color', '#dadada' ),
					'transport'         => 'postMessage',
					'title'             => __( 'Menu Items Border Color', 'astra-addon' ),
					'context'           => array(
						astra_addon_builder_helper()->general_tab_config,
						'relation' => 'AND',
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[below-header-layout]',
							'operator' => '!=',
							'value'    => 'disabled',
						),
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[below-header-on-mobile]',
							'operator' => '==',
							'value'    => true,
						),
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[below-header-merge-menu]',
							'operator' => '!=',
							'value'    => true,
						),
					),
					'section'           => 'section-below-header',
					'priority'          => 135,
				),
			);

			return array_merge( $configurations, $configs );
		}
	}
}

new Astra_Customizer_Mobile_Below_Header_Configs();
