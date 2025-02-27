<?php
/**
 * Astra Mobile Header.
 *
 * @package     Astra Addon
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

if ( ! class_exists( 'Astra_Customizer_Mobile_Header_Configs' ) ) {

	/**
	 * Customizer Sanitizes Initial setup
	 */
	// @codingStandardsIgnoreStart
	class Astra_Customizer_Mobile_Header_Configs extends Astra_Customizer_Config_Base {
 // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedClassFound
		// @codingStandardsIgnoreEnd

		/**
		 * Register Panels and Sections for Customizer.
		 *
		 * @param Array                $configurations Astra Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array Astra Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$show_deprecated_no_toggle_style = 'no-toggle' === astra_get_option( 'mobile-menu-style' ) ? true : false;

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
					'name'        => ASTRA_THEME_SETTINGS . '[mobile-menu-style]',
					'type'        => 'control',
					'control'     => 'ast-select',
					'section'     => 'section-primary-menu',
					'default'     => astra_get_option( 'mobile-menu-style' ),
					'title'       => __( 'Menu Style', 'astra-addon' ),
					'priority'    => 40,
					'choices'     => $menu_style_choices,
					'description' => $menu_style_description,
					'context'     => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[disable-primary-nav]',
							'operator' => '!=',
							'value'    => '1',
						),
					),
				),

				/**
				 * Option: Mobile Menu Style - Flyout alignments
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[flyout-mobile-menu-alignment]',
					'section'  => 'section-primary-menu',
					'title'    => __( 'Flyout Menu Alignment', 'astra-addon' ),
					'default'  => astra_get_option( 'flyout-mobile-menu-alignment' ),
					'type'     => 'control',
					'control'  => 'ast-select',

					'context'  => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[mobile-menu-style]',
							'operator' => '==',
							'value'    => 'flyout',
						),
					),

					'priority' => 41,
					'choices'  => array(
						'left'  => __( 'Left', 'astra-addon' ),
						'right' => __( 'Right', 'astra-addon' ),
					),
				),

				/**
				 * Option - Header Menu Border
				 */
				array(
					'name'           => ASTRA_THEME_SETTINGS . '[mobile-header-menu-all-border]',
					'section'        => 'section-primary-menu',
					'type'           => 'control',
					'control'        => 'ast-border',
					'default'        => astra_get_option( 'mobile-header-menu-all-border' ),
					'transport'      => 'postMessage',
					'title'          => __( 'Border for Menu Items', 'astra-addon' ),
					'linked_choices' => true,
					'priority'       => 65,
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
					'name'              => ASTRA_THEME_SETTINGS . '[mobile-header-menu-b-color]',
					'section'           => 'section-primary-menu',
					'type'              => 'control',
					'control'           => 'ast-color',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
					'title'             => __( 'Border Color', 'astra-addon' ),
					'default'           => astra_get_option( 'mobile-header-menu-b-color', '#dadada' ),
					'transport'         => 'postMessage',
					'priority'          => 68,
				),
			);

			return array_merge( $configurations, $configs );
		}
	}
}

new Astra_Customizer_Mobile_Header_Configs();
