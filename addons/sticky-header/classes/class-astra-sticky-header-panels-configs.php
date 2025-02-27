<?php
/**
 * Sticky Header - Panels & Sections
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

if ( ! class_exists( 'Astra_Sticky_Header_Panels_Configs' ) ) {

	/**
	 * Register Sticky Header Customizer Configurations.
	 */
	// @codingStandardsIgnoreStart
	class Astra_Sticky_Header_Panels_Configs extends Astra_Customizer_Config_Base {
 // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedClassFound
		// @codingStandardsIgnoreEnd

		/**
		 * Register Sticky Header Customizer Configurations.
		 *
		 * @param Array                $configurations Astra Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array Astra Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_section = 'section-sticky-header';

			$_config = array(

				array(
					'name'     => $_section,
					'title'    => __( 'Sticky Header', 'astra-addon' ),
					'panel'    => true === astra_addon_builder_helper()->is_header_footer_builder_active ? 'panel-header-builder-group' : 'panel-header-group',
					'priority' => 31,
					'type'     => 'section',
				),
			);

			return array_merge( $configurations, $_config );
		}

	}
}

new Astra_Sticky_Header_Panels_Configs();
