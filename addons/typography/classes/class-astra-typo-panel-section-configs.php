<?php
/**
 * Typography - Panels & Sections
 *
 * @package Astra Addon
 */

// Block direct access to the file.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Bail if Customizer config base class does not exist.
if ( ! class_exists( 'Astra_Customizer_Config_Base' ) ) {
	return;
}

if ( ! class_exists( 'Astra_Typo_Panel_Section_Configs' ) ) {

	/**
	 * Register below header Configurations.
	 */
	// @codingStandardsIgnoreStart
	class Astra_Typo_Panel_Section_Configs extends Astra_Customizer_Config_Base {
 // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedClassFound
		// @codingStandardsIgnoreEnd

		/**
		 * Register Typography Customizer Configurations.
		 *
		 * @param Array                $configurations Astra Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array Astra Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_configs = array(

				array(
					'name'     => 'section-primary-menu-typo',
					'type'     => 'section',
					'title'    => __( 'Primary Menu', 'astra-addon' ),
					'panel'    => 'panel-typography',
					'section'  => 'section-header-typo-group',
					'priority' => 25,
				),
			);

			return array_merge( $configurations, $_configs );
		}
	}
}

new Astra_Typo_Panel_Section_Configs();
