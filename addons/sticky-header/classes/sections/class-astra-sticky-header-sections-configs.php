<?php
/**
 * Sticky Header - Header Sections Options for our theme.
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

if ( ! class_exists( 'Astra_Sticky_Header_Sections_Configs' ) ) {

	/**
	 * Register Sticky Header - Header Sections Customizer Configurations.
	 */
	// @codingStandardsIgnoreStart
	class Astra_Sticky_Header_Sections_Configs extends Astra_Customizer_Config_Base {
 // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedClassFound
		// @codingStandardsIgnoreEnd

		/**
		 * Register Sticky Header - Header Sections Customizer Configurations.
		 *
		 * @param Array                $configurations Astra Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array Astra Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_config = array(

				/**
				 * Header Button - Sticky
				 */
				array(
					'name'     => 'section-header-button-sticky',
					'type'     => 'section',
					'priority' => 10,
					'title'    => __( 'Sticky Header Button', 'astra-addon' ),
					'section'  => 'section-header-button',
				),
			);

			if ( Astra_Sticky_Header_Configs::is_header_section_active() ) {
				$control_type = Astra_Sticky_Header_Configs::get_sticky_header_setting_control_type();

				$_config[] = array(
					'name'     => Astra_Sticky_Header_Configs::get_sticky_header_setting_name( 'header-above-stick' ),
					'parent'   => ASTRA_THEME_SETTINGS . '[sticky-header-stick-on]',
					'default'  => astra_get_option( 'header-above-stick' ),
					'type'     => $control_type,
					'section'  => 'section-sticky-header',
					'title'    => __( 'Above Header', 'astra-addon' ),
					'priority' => 5,
					'control'  => Astra_Theme_Extension::$switch_control,
					'context'  => ! astra_addon_builder_helper()->is_header_footer_builder_active ? array( ASTRA_THEME_SETTINGS . '[above-header-layout]', '!=', 'disabled' ) : '',
				);
				$_config[] = array(
					'name'     => Astra_Sticky_Header_Configs::get_sticky_header_setting_name( 'header-below-stick' ),
					'parent'   => ASTRA_THEME_SETTINGS . '[sticky-header-stick-on]',
					'default'  => astra_get_option( 'header-below-stick' ),
					'type'     => $control_type,
					'section'  => 'section-sticky-header',
					'title'    => __( 'Below Header', 'astra-addon' ),
					'priority' => 13,
					'control'  => Astra_Theme_Extension::$switch_control,
					'context'  => ! astra_addon_builder_helper()->is_header_footer_builder_active ? array( ASTRA_THEME_SETTINGS . '[below-header-layout]', '!=', 'disabled' ) : '',
				);
			}

			return array_merge( $configurations, $_config );
		}

	}
}

new Astra_Sticky_Header_Sections_Configs();
