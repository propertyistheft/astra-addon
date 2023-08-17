<?php
/**
 * Mega Menu Options configurations.
 *
 * @package     Astra Addon
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

if ( ! class_exists( 'Astra_Nav_Menu_Primary_Header_Colors' ) ) {

	/**
	 * Register Mega Menu Customizer Configurations.
	 */
	// @codingStandardsIgnoreStart
	class Astra_Nav_Menu_Primary_Header_Colors extends Astra_Customizer_Config_Base {
 // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedClassFound
		// @codingStandardsIgnoreEnd

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

				// Option: Megamenu Heading Color.
				array(
					'type'              => 'sub-control',
					'priority'          => 12,
					'parent'            => ASTRA_THEME_SETTINGS . '[sticky-header-primary-megamenu-colors]',
					'control'           => 'ast-color',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
					'section'           => 'section-sticky-header',
					'transport'         => 'postMessage',
					'name'              => 'sticky-primary-header-megamenu-heading-color',
					'default'           => astra_get_option( 'sticky-primary-header-megamenu-heading-color' ),
					'title'             => __( 'Normal', 'astra-addon' ),
				),

				// Option: Megamenu Heading Hover Color.
				array(
					'type'              => 'sub-control',
					'priority'          => 12,
					'parent'            => ASTRA_THEME_SETTINGS . '[sticky-header-primary-megamenu-colors]',
					'control'           => 'ast-color',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
					'section'           => 'section-sticky-header',
					'transport'         => 'postMessage',
					'name'              => 'sticky-primary-header-megamenu-heading-h-color',
					'default'           => astra_get_option( 'sticky-primary-header-megamenu-heading-h-color' ),
					'title'             => __( 'Hover', 'astra-addon' ),
				),
			);

			if ( false === astra_addon_builder_helper()->is_header_footer_builder_active ) {

				$new_configs = array(

					/**
					 * Option: Sticky Header primary Color Group
					 */
					array(
						'name'      => ASTRA_THEME_SETTINGS . '[sticky-header-primary-megamenu-colors]',
						'default'   => astra_get_option( 'sticky-header-primary-megamenu-colors' ),
						'type'      => 'control',
						'control'   => Astra_Theme_Extension::$group_control,
						'title'     => __( 'Mega Menu Heading', 'astra-addon' ),
						'section'   => 'section-sticky-header',
						'transport' => 'postMessage',
						'priority'  => 100,
						'context'   => ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) ?
							astra_addon_builder_helper()->design_tab : astra_addon_builder_helper()->general_tab,
					),
				);
				$_configs    = array_merge( $_configs, $new_configs );
			}
			$configurations = array_merge( $configurations, $_configs );

			return $configurations;
		}
	}
}

new Astra_Nav_Menu_Primary_Header_Colors();

