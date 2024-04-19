<?php
/**
 * Below Header - Colors Options for our theme.
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

if ( ! class_exists( 'Astra_Below_Header_Colors_Bg_Configs' ) ) {

	/**
	 * Register Header Layout Customizer Configurations.
	 */
	// @codingStandardsIgnoreStart
	class Astra_Below_Header_Colors_Bg_Configs extends Astra_Customizer_Config_Base {
 // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedClassFound
		// @codingStandardsIgnoreEnd

		/**
		 * Register Header Layout Customizer Configurations.
		 *
		 * @param Array                $configurations Astra Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array Astra Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_configs = array(

				/**
				 * Option: Menu Color
				 */
				array(
					'name'       => 'below-header-menu-text-color-responsive',
					'type'       => 'sub-control',
					'section'    => 'section-below-header',
					'priority'   => 6,
					'tab'        => __( 'Normal', 'astra-addon' ),
					'parent'     => ASTRA_THEME_SETTINGS . '[below-header-link-color-group]',
					'control'    => 'ast-responsive-color',
					'transport'  => 'postMessage',
					'default'    => astra_get_option( 'below-header-menu-text-color-responsive' ),
					'title'      => __( 'Normal', 'astra-addon' ),
					'responsive' => true,
					'rgba'       => true,
				),

				/**
				 * Option: Menu Background Color
				 */
				array(
					'name'      => 'below-header-menu-bg-obj-responsive',
					'type'      => 'sub-control',
					'section'   => 'section-below-header',
					'priority'  => 7,
					'tab'       => __( 'Normal', 'astra-addon' ),
					'parent'    => ASTRA_THEME_SETTINGS . '[below-header-bg-color-group]',
					'control'   => 'ast-responsive-background',
					'transport' => 'postMessage',
					'default'   => astra_get_option( 'below-header-menu-bg-obj-responsive' ),
					'title'     => __( 'Normal', 'astra-addon' ),
				),

				/**
				 * Option: Menu Hover Color
				 */

				array(
					'name'       => 'below-header-menu-text-hover-color-responsive',
					'transport'  => 'postMessage',
					'type'       => 'sub-control',
					'section'    => 'section-below-header',
					'priority'   => 8,
					'tab'        => __( 'Hover', 'astra-addon' ),
					'parent'     => ASTRA_THEME_SETTINGS . '[below-header-link-color-group]',
					'control'    => 'ast-responsive-color',
					'default'    => astra_get_option( 'below-header-menu-text-hover-color-responsive' ),
					'title'      => __( 'Hover', 'astra-addon' ),
					'responsive' => true,
					'rgba'       => true,
				),

				// Check Astra_Control_Color is exist in the theme.
				/**
				 * Option: Menu Hover Background Color
				 */
				array(
					'name'       => 'below-header-menu-bg-hover-color-responsive',
					'type'       => 'sub-control',
					'section'    => 'section-below-header',
					'priority'   => 9,
					'tab'        => __( 'Hover', 'astra-addon' ),
					'parent'     => ASTRA_THEME_SETTINGS . '[below-header-bg-color-group]',
					'control'    => 'ast-responsive-color',
					'default'    => astra_get_option( 'below-header-menu-bg-hover-color-responsive' ),
					'title'      => __( 'Hover', 'astra-addon' ),
					'responsive' => true,
					'rgba'       => true,
				),

				/**
				 * Option: Active Menu Color
				 */
				array(
					'name'       => 'below-header-current-menu-text-color-responsive',
					'type'       => 'sub-control',
					'section'    => 'section-below-header',
					'priority'   => 10,
					'tab'        => __( 'Active', 'astra-addon' ),
					'parent'     => ASTRA_THEME_SETTINGS . '[below-header-link-color-group]',
					'control'    => 'ast-responsive-color',
					'transport'  => 'postMessage',
					'default'    => astra_get_option( 'below-header-current-menu-text-color-responsive' ),
					'title'      => __( 'Active', 'astra-addon' ),
					'responsive' => true,
					'rgba'       => true,
				),

				// Check Astra_Control_Color is exist in the theme.
				/**
				 * Option: Active Menu Background Color
				 */
				array(
					'name'       => 'below-header-current-menu-bg-color-responsive',
					'type'       => 'sub-control',
					'section'    => 'section-below-header',
					'priority'   => 11,
					'tab'        => __( 'Active', 'astra-addon' ),
					'parent'     => ASTRA_THEME_SETTINGS . '[below-header-bg-color-group]',
					'control'    => 'ast-responsive-color',
					'default'    => astra_get_option( 'below-header-current-menu-bg-color-responsive' ),
					'title'      => __( 'Active', 'astra-addon' ),
					'responsive' => true,
					'rgba'       => true,
				),

				/**
				 * Option: Submenu Divider
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[below-header-color-bg-dropdown-menu-divider]',
					'type'     => 'control',
					'control'  => 'ast-divider',
					'title'    => __( 'Below Header Submenu', 'astra-addon' ),
					'settings' => array(),
				),

				// Check Astra_Control_Color is exist in the theme.

				/**
				 * Option: Submenu Color
				 */
				array(
					'name'       => 'below-header-submenu-text-color-responsive',
					'transport'  => 'postMessage',
					'type'       => 'sub-control',
					'section'    => 'section-below-header',
					'priority'   => 9,
					'tab'        => __( 'Normal', 'astra-addon' ),
					'parent'     => ASTRA_THEME_SETTINGS . '[below-header-submenus-link-color-group]',
					'control'    => 'ast-responsive-color',
					'default'    => astra_get_option( 'below-header-submenu-text-color-responsive' ),
					'title'      => __( 'Normal', 'astra-addon' ),
					'responsive' => true,
					'rgba'       => true,
				),

				/**
				 * Option: Submenu Background Color
				 */
				array(
					'name'       => 'below-header-submenu-bg-color-responsive',
					'transport'  => 'postMessage',
					'type'       => 'sub-control',
					'section'    => 'section-below-header',
					'priority'   => 9,
					'tab'        => __( 'Normal', 'astra-addon' ),
					'parent'     => ASTRA_THEME_SETTINGS . '[below-header-submenus-bg-color-group]',
					'control'    => 'ast-responsive-color',
					'default'    => astra_get_option( 'below-header-submenu-bg-color-responsive' ),
					'title'      => __( 'Normal', 'astra-addon' ),
					'responsive' => true,
					'rgba'       => true,
				),

				/**
				 * Option: Submenu Hover Color
				 */
				array(
					'name'       => 'below-header-submenu-hover-color-responsive',
					'type'       => 'sub-control',
					'section'    => 'section-below-header',
					'priority'   => 10,
					'tab'        => __( 'Hover', 'astra-addon' ),
					'parent'     => ASTRA_THEME_SETTINGS . '[below-header-submenus-link-color-group]',
					'control'    => 'ast-responsive-color',
					'default'    => astra_get_option( 'below-header-submenu-hover-color-responsive' ),
					'transport'  => 'postMessage',
					'title'      => __( 'Hover', 'astra-addon' ),
					'responsive' => true,
					'rgba'       => true,
				),

				// Check Astra_Control_Color is exist in the theme.
				/**
				 * Option: Menu Hover Background Color
				 */
				array(
					'name'       => 'below-header-submenu-bg-hover-color-responsive',
					'type'       => 'sub-control',
					'section'    => 'section-below-header',
					'priority'   => 10,
					'tab'        => __( 'Hover', 'astra-addon' ),
					'parent'     => ASTRA_THEME_SETTINGS . '[below-header-submenus-bg-color-group]',
					'control'    => 'ast-responsive-color',
					'transport'  => 'postMessage',
					'default'    => astra_get_option( 'below-header-submenu-bg-hover-color-responsive' ),
					'title'      => __( 'Hover', 'astra-addon' ),
					'responsive' => true,
					'rgba'       => true,
				),

				/**
				 * Option: Submenu Active Color
				 */

				array(
					'name'       => 'below-header-submenu-active-color-responsive',
					'transport'  => 'postMessage',
					'type'       => 'sub-control',
					'section'    => 'section-below-header',
					'priority'   => 10,
					'tab'        => __( 'Active', 'astra-addon' ),
					'parent'     => ASTRA_THEME_SETTINGS . '[below-header-submenus-link-color-group]',
					'control'    => 'ast-responsive-color',
					'default'    => astra_get_option( 'below-header-submenu-active-color-responsive' ),
					'title'      => __( 'Active', 'astra-addon' ),
					'responsive' => true,
					'rgba'       => true,
				),

				// Check Astra_Control_Color is exist in the theme.
				/**
				 * Option: Submenu Active Background Color
				 */
				array(
					'name'       => 'below-header-submenu-active-bg-color-responsive',
					'transport'  => 'postMessage',
					'type'       => 'sub-control',
					'section'    => 'section-below-header',
					'priority'   => 10,
					'tab'        => __( 'Active', 'astra-addon' ),
					'parent'     => ASTRA_THEME_SETTINGS . '[below-header-submenus-bg-color-group]',
					'control'    => 'ast-responsive-color',
					'default'    => astra_get_option( 'below-header-submenu-active-bg-color-responsive' ),
					'title'      => __( 'Active', 'astra-addon' ),
					'responsive' => true,
					'rgba'       => true,
				),

				/**
				 * Option: Text Color
				 */
				array(
					'name'       => 'below-header-text-color-responsive',
					'type'       => 'sub-control',
					'section'    => 'section-below-header',
					'control'    => 'ast-responsive-color',
					'default'    => astra_get_option( 'below-header-text-color-responsive' ),
					'transport'  => 'postMessage',
					'parent'     => ASTRA_THEME_SETTINGS . '[below-header-content-group]',
					'title'      => __( 'Text Color', 'astra-addon' ),
					'responsive' => true,
					'rgba'       => true,
					'tab'        => __( 'Normal', 'astra-addon' ),
				),

				/**
				 * Option: Link Color
				 */
				array(
					'name'       => 'below-header-link-color-responsive',
					'type'       => 'sub-control',
					'section'    => 'section-below-header',
					'control'    => 'ast-responsive-color',
					'default'    => astra_get_option( 'below-header-link-color-responsive' ),
					'transport'  => 'postMessage',
					'parent'     => ASTRA_THEME_SETTINGS . '[below-header-content-group]',
					'title'      => __( 'Link Color', 'astra-addon' ),
					'responsive' => true,
					'rgba'       => true,
					'tab'        => __( 'Normal', 'astra-addon' ),
				),

				/**
				 * Option: Link Hover Color
				 */
				array(
					'name'       => 'below-header-link-hover-color-responsive',
					'type'       => 'sub-control',
					'section'    => 'section-below-header',
					'control'    => 'ast-responsive-color',
					'default'    => astra_get_option( 'below-header-link-hover-color-responsive' ),
					'parent'     => ASTRA_THEME_SETTINGS . '[below-header-content-group]',
					'transport'  => 'postMessage',
					'title'      => __( 'Link Color', 'astra-addon' ),
					'responsive' => true,
					'rgba'       => true,
					'tab'        => __( 'Hover', 'astra-addon' ),
				),
			);

			return array_merge( $configurations, $_configs );
		}
	}
}

new Astra_Below_Header_Colors_Bg_Configs();
