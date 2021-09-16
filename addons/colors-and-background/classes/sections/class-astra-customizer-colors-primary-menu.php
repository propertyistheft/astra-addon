<?php
/**
 * Colors Primary Menu Options for our theme.
 *
 * @package     Astra Addon
 * @author      Brainstorm Force
 * @copyright   Copyright (c) 2020, Brainstorm Force
 * @link        https://www.brainstormforce.com
 * @since       1.4.3
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
 * Customizer Sanitizes
 *
 * @since 1.4.3
 */
if ( ! class_exists( 'Astra_Customizer_Colors_Primary_Menu' ) ) {

	/**
	 * Register General Customizer Configurations.
	 */
	class Astra_Customizer_Colors_Primary_Menu extends Astra_Customizer_Config_Base {

		/**
		 * Register General Customizer Configurations.
		 *
		 * @param Array                $configurations Astra Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array Astra Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_configs = array(

				array(
					'name'       => ASTRA_THEME_SETTINGS . '[primary-menu-link-colors]',
					'default'    => astra_get_option( 'primary-menu-colors' ),
					'type'       => 'control',
					'control'    => Astra_Theme_Extension::$group_control,
					'title'      => __( 'Link / text', 'astra-addon' ),
					'section'    => 'section-primary-menu',
					'transport'  => 'postMessage',
					'priority'   => 70,
					'responsive' => true,
					'divider'    => array(
						'ast_class' => 'ast-top-divider',
						'ast_title' => __( 'Menu Color', 'astra-addon' ),
					),
				),

				array(
					'name'       => ASTRA_THEME_SETTINGS . '[primary-menu-background-colors]',
					'default'    => astra_get_option( 'primary-menu-colors' ),
					'type'       => 'control',
					'control'    => Astra_Theme_Extension::$group_control,
					'title'      => __( 'Background', 'astra-addon' ),
					'section'    => 'section-primary-menu',
					'transport'  => 'postMessage',
					'priority'   => 70,
					'responsive' => true,
				),

				array(
					'name'       => ASTRA_THEME_SETTINGS . '[primary-submenu-link-colors]',
					'default'    => astra_get_option( 'primary-submenu-colors' ),
					'type'       => 'control',
					'control'    => Astra_Theme_Extension::$group_control,
					'title'      => __( 'Link / text', 'astra-addon' ),
					'section'    => 'section-primary-menu',
					'transport'  => 'postMessage',
					'priority'   => 70,
					'responsive' => true,
					'divider'    => array(
						'ast_class' => 'ast-top-divider',
						'ast_title' => __( 'Submenu Color', 'astra-addon' ),
					),
				),
				array(
					'name'       => ASTRA_THEME_SETTINGS . '[primary-submenu-background-colors]',
					'default'    => astra_get_option( 'primary-submenu-colors' ),
					'type'       => 'control',
					'control'    => Astra_Theme_Extension::$group_control,
					'title'      => __( 'Background', 'astra-addon' ),
					'section'    => 'section-primary-menu',
					'transport'  => 'postMessage',
					'priority'   => 70,
					'responsive' => true,
					'divider'    => array( 'ast_class' => 'ast-bottom-divider' ),
				),

				// Option: Primary Menu Color.
				array(
					'type'       => 'sub-control',
					'control'    => 'ast-responsive-color',
					'transport'  => 'postMessage',
					'parent'     => ASTRA_THEME_SETTINGS . '[primary-menu-link-colors]',
					'section'    => 'section-primary-menu',
					'name'       => 'primary-menu-color-responsive',
					'default'    => astra_get_option( 'primary-menu-color-responsive' ),
					'title'      => __( 'Normal', 'astra-addon' ),
					'responsive' => true,
					'rgba'       => true,
					'priority'   => 7,
				),

				// Option: Menu Background image, color.
				array(
					'type'       => 'sub-control',
					'control'    => 'ast-responsive-background',
					'parent'     => ASTRA_THEME_SETTINGS . '[primary-menu-background-colors]',
					'section'    => 'section-primary-menu',
					'default'    => astra_get_option( 'primary-menu-bg-obj-responsive' ),
					'name'       => 'primary-menu-bg-obj-responsive',
					'data_attrs' => array( 'name' => 'primary-menu-bg-obj-responsive' ),
					'title'      => __( 'Normal', 'astra-addon' ),
					'priority'   => 9,
				),

				// Option: Submenu Color.
				array(
					'type'       => 'sub-control',
					'control'    => 'ast-responsive-color',
					'parent'     => ASTRA_THEME_SETTINGS . '[primary-submenu-link-colors]',
					'section'    => 'section-primary-menu',
					'transport'  => 'postMessage',
					'name'       => 'primary-submenu-color-responsive',
					'default'    => astra_get_option( 'primary-submenu-color-responsive' ),
					'title'      => __( 'Normal', 'astra-addon' ),
					'responsive' => true,
					'rgba'       => true,
					'priority'   => 13,
				),

				// Option: Submenu Background Color.
				array(
					'type'       => 'sub-control',
					'parent'     => ASTRA_THEME_SETTINGS . '[primary-submenu-background-colors]',
					'section'    => 'section-primary-menu',
					'control'    => 'ast-responsive-color',
					'transport'  => 'postMessage',
					'name'       => 'primary-submenu-bg-color-responsive',
					'default'    => astra_get_option( 'primary-submenu-bg-color-responsive' ),
					'title'      => __( 'Normal', 'astra-addon' ),
					'responsive' => true,
					'rgba'       => true,
					'priority'   => 15,
				),

				// Option: Menu Hover Color.
				array(
					'type'       => 'sub-control',
					'control'    => 'ast-responsive-color',
					'transport'  => 'postMessage',
					'name'       => 'primary-menu-h-color-responsive',
					'parent'     => ASTRA_THEME_SETTINGS . '[primary-menu-link-colors]',
					'section'    => 'section-primary-menu',
					'default'    => astra_get_option( 'primary-menu-h-color-responsive' ),
					'title'      => __( 'Hover', 'astra-addon' ),
					'responsive' => true,
					'rgba'       => true,
					'priority'   => 19,
				),

				// Option: Menu Hover Background Color.
				array(
					'name'       => 'primary-menu-h-bg-color-responsive',
					'type'       => 'sub-control',
					'parent'     => ASTRA_THEME_SETTINGS . '[primary-menu-background-colors]',
					'section'    => 'section-primary-menu',
					'control'    => 'ast-responsive-color',
					'transport'  => 'postMessage',
					'default'    => astra_get_option( 'primary-menu-h-bg-color-responsive' ),
					'title'      => __( 'Hover', 'astra-addon' ),
					'responsive' => true,
					'rgba'       => true,
					'priority'   => 21,
				),

				// Option: Submenu Hover Color.
				array(
					'type'       => 'sub-control',
					'control'    => 'ast-responsive-color',
					'parent'     => ASTRA_THEME_SETTINGS . '[primary-submenu-link-colors]',
					'section'    => 'section-primary-menu',
					'transport'  => 'postMessage',
					'name'       => 'primary-submenu-h-color-responsive',
					'default'    => astra_get_option( 'primary-submenu-h-color-responsive' ),
					'title'      => __( 'Hover', 'astra-addon' ),
					'responsive' => true,
					'rgba'       => true,
					'priority'   => 25,
				),

				// Option: Submenu Hover Background Color.
				array(
					'type'       => 'sub-control',
					'control'    => 'ast-responsive-color',
					'transport'  => 'postMessage',
					'parent'     => ASTRA_THEME_SETTINGS . '[primary-submenu-background-colors]',
					'section'    => 'section-primary-menu',
					'name'       => 'primary-submenu-h-bg-color-responsive',
					'default'    => astra_get_option( 'primary-submenu-h-bg-color-responsive' ),
					'title'      => __( 'Hover', 'astra-addon' ),
					'responsive' => true,
					'rgba'       => true,
					'priority'   => 27,
				),

				// Option: Active Menu Color.
				array(
					'type'       => 'sub-control',
					'parent'     => ASTRA_THEME_SETTINGS . '[primary-menu-link-colors]',
					'section'    => 'section-primary-menu',
					'control'    => 'ast-responsive-color',
					'transport'  => 'postMessage',
					'name'       => 'primary-menu-a-color-responsive',
					'default'    => astra_get_option( 'primary-menu-a-color-responsive' ),
					'title'      => __( 'Active', 'astra-addon' ),
					'responsive' => true,
					'rgba'       => true,
					'priority'   => 31,
				),

				// Option: Active Menu Background Color.
				array(
					'type'       => 'sub-control',
					'control'    => 'ast-responsive-color',
					'transport'  => 'postMessage',
					'name'       => 'primary-menu-a-bg-color-responsive',
					'parent'     => ASTRA_THEME_SETTINGS . '[primary-menu-background-colors]',
					'section'    => 'section-primary-menu',
					'default'    => astra_get_option( 'primary-menu-a-bg-color-responsive' ),
					'title'      => __( 'Active', 'astra-addon' ),
					'responsive' => true,
					'rgba'       => true,
					'priority'   => 33,
				),

				// Option: Active Submenu Color.
				array(
					'type'       => 'sub-control',
					'control'    => 'ast-responsive-color',
					'transport'  => 'postMessage',
					'parent'     => ASTRA_THEME_SETTINGS . '[primary-submenu-link-colors]',
					'section'    => 'section-primary-menu',
					'name'       => 'primary-submenu-a-color-responsive',
					'default'    => astra_get_option( 'primary-submenu-a-color-responsive' ),
					'title'      => __( 'Active', 'astra-addon' ),
					'responsive' => true,
					'rgba'       => true,
					'priority'   => 37,
				),

				// Option: Active Submenu Background Color.
				array(
					'type'       => 'sub-control',
					'control'    => 'ast-responsive-color',
					'transport'  => 'postMessage',
					'parent'     => ASTRA_THEME_SETTINGS . '[primary-submenu-background-colors]',
					'section'    => 'section-primary-menu',
					'name'       => 'primary-submenu-a-bg-color-responsive',
					'default'    => astra_get_option( 'primary-submenu-a-bg-color-responsive' ),
					'title'      => __( 'Active', 'astra-addon' ),
					'responsive' => true,
					'rgba'       => true,
					'priority'   => 39,
				),
			);

			return array_merge( $configurations, $_configs );
		}
	}
}

/**
 * Kicking this off by calling 'get_instance()' method
 */
new Astra_Customizer_Colors_Primary_Menu();
