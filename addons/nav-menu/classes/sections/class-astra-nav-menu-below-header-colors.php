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

if ( ! class_exists( 'Astra_Nav_Menu_Below_Header_Colors' ) ) {

	/**
	 * Register Mega Menu Customizer Configurations.
	 */
	// @codingStandardsIgnoreStart
	class Astra_Nav_Menu_Below_Header_Colors extends Astra_Customizer_Config_Base {
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

			$_configs = array();

			if ( is_callable( 'Astra_Sticky_Header_Configs::is_header_section_active' ) && Astra_Sticky_Header_Configs::is_header_section_active() && false === astra_addon_builder_helper()->is_header_footer_builder_active ) {

				$_configs = array(

					/**
					 * Option: Sticky Header Below Mega Menu Column Color Group
					 */
					array(
						'name'      => ASTRA_THEME_SETTINGS . '[sticky-header-below-mega-menus-colors]',
						'default'   => astra_get_option( 'sticky-header-below-mega-menus-colors' ),
						'type'      => 'control',
						'control'   => Astra_Theme_Extension::$group_control,
						'title'     => __( 'Mega Menu Heading', 'astra-addon' ),
						'section'   => 'section-sticky-header',
						'transport' => 'postMessage',
						'priority'  => 130,
						'context'   => ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) ?
						astra_addon_builder_helper()->design_tab : astra_addon_builder_helper()->general_tab,
					),

				);

			}

			return array_merge( $configurations, $_configs );
		}
	}
}

new Astra_Nav_Menu_Below_Header_Colors();

