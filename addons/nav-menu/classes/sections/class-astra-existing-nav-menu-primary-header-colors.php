<?php
/**
 * Mega Menu Options configurations.
 *
 * @package     Astra Addon
 * @author      Brainstorm Force
 * @copyright   Copyright (c) 2020, Brainstorm Force
 * @link        https://www.brainstormforce.com
 * @since       1.6.0
 */

// Block direct access to the file.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Bail if Customizer config base class does not exist.
if ( ! class_exists( 'Astra_Customizer_Config_Base' ) ) {
	return;
}

if ( ! class_exists( 'Astra_Existing_Nav_Menu_Primary_Header_Colors' ) ) {

	/**
	 * Register Mega Menu Customizer Configurations.
	 */
	class Astra_Existing_Nav_Menu_Primary_Header_Colors extends Astra_Customizer_Config_Base {

		/**
		 * Register Mega Menu Customizer Configurations.
		 *
		 * @param Array                $configurations Astra Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.6.0
		 * @return Array Astra Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_configs = array(

				array(
					'name'      => ASTRA_THEME_SETTINGS . '[primary-mega-menu-col-color-group]',
					'default'   => astra_get_option( 'primary-mega-menu-col-color-group' ),
					'type'      => 'control',
					'control'   => Astra_Theme_Extension::$group_control,
					'title'     => __( 'Mega Menu Heading', 'astra-addon' ),
					'section'   => 'section-primary-menu',
					'transport' => 'postMessage',
					'priority'  => 70,
					'divider'   => array( 'ast_class' => 'ast-bottom-divider' ),
				),

				// Option: Megamenu Heading Color.
				array(
					'type'              => 'sub-control',
					'control'           => 'ast-color',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
					'section'           => 'section-primary-menu',
					'transport'         => 'postMessage',
					'name'              => 'primary-header-megamenu-heading-color',
					'parent'            => ASTRA_THEME_SETTINGS . '[primary-mega-menu-col-color-group]',
					'default'           => astra_get_option( 'primary-header-megamenu-heading-color' ),
					'title'             => __( 'Normal', 'astra-addon' ),
				),

				// Option: Megamenu Heading Hover Color.
				array(
					'type'              => 'sub-control',
					'control'           => 'ast-color',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
					'section'           => 'section-primary-menu',
					'transport'         => 'postMessage',
					'name'              => 'primary-header-megamenu-heading-h-color',
					'parent'            => ASTRA_THEME_SETTINGS . '[primary-mega-menu-col-color-group]',
					'default'           => astra_get_option( 'primary-header-megamenu-heading-h-color' ),
					'title'             => __( 'Hover', 'astra-addon' ),
				),
			);

			$configurations = array_merge( $configurations, $_configs );

			return $configurations;
		}
	}
}

new Astra_Existing_Nav_Menu_Primary_Header_Colors();
