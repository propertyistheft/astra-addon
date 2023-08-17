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

if ( ! class_exists( 'Astra_Existing_Nav_Menu_Above_Header_Colors' ) ) {

	/**
	 * Register Mega Menu Customizer Configurations.
	 */
	// @codingStandardsIgnoreStart
	class Astra_Existing_Nav_Menu_Above_Header_Colors extends Astra_Customizer_Config_Base {
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

				/**
				 * Option: Above Header Megamenu Styling
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[above-header-megamenu-colors]',
					'default'   => astra_get_option( 'above-header-megamenu-colors' ),
					'type'      => 'control',
					'control'   => 'ast-settings-group',
					'title'     => __( 'Mega Menu Column Heading', 'astra-addon' ),
					'section'   => 'section-above-header',
					'transport' => 'postMessage',
					'priority'  => 131,
					'context'   => array(
						'relation' => 'OR',
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[above-header-section-1]',
							'operator' => '==',
							'value'    => 'menu',
						),
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[above-header-section-2]',
							'operator' => '==',
							'value'    => 'menu',
						),
					),
				),

				// Option: Megamenu Heading Color.
				array(
					'type'              => 'sub-control',
					'control'           => 'ast-color',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
					'transport'         => 'postMessage',
					'name'              => 'above-header-megamenu-heading-color',
					'parent'            => ASTRA_THEME_SETTINGS . '[above-header-megamenu-colors]',
					'section'           => 'section-above-header',
					'default'           => astra_get_option( 'above-header-megamenu-heading-color' ),
					'title'             => __( 'Color', 'astra-addon' ),
					'tab'               => __( 'Normal', 'astra-addon' ),
				),

				// Option: Megamenu Heading Hover Color.
				array(
					'type'              => 'sub-control',
					'control'           => 'ast-color',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
					'section'           => 'section-above-header',
					'transport'         => 'postMessage',
					'name'              => 'above-header-megamenu-heading-h-color',
					'parent'            => ASTRA_THEME_SETTINGS . '[above-header-megamenu-colors]',
					'default'           => astra_get_option( 'above-header-megamenu-heading-h-color' ),
					'title'             => __( 'Color', 'astra-addon' ),
					'tab'               => __( 'Hover', 'astra-addon' ),
				),

			);

			$configurations = array_merge( $configurations, $_configs );

			return $configurations;
		}
	}
}

new Astra_Existing_Nav_Menu_Above_Header_Colors();
