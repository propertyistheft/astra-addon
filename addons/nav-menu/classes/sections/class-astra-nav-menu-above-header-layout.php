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

if ( ! class_exists( 'Astra_Nav_Menu_Above_Header_Layout' ) ) {

	/**
	 * Register Mega Menu Customizer Configurations.
	 */
	// @codingStandardsIgnoreStart
	class Astra_Nav_Menu_Above_Header_Layout extends Astra_Customizer_Config_Base {
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

				// Option - Megamenu Heading Space.
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[above-header-megamenu-heading-space]',
					'default'           => astra_get_option( 'above-header-megamenu-heading-space' ),
					'type'              => 'control',
					'transport'         => 'postMessage',
					'control'           => 'ast-responsive-spacing',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_responsive_spacing' ),
					'priority'          => 175,
					'title'             => __( 'Megamenu Heading Space', 'astra-addon' ),
					'linked_choices'    => true,
					'unit_choices'      => array( 'px', 'em', '%' ),
					'choices'           => array(
						'top'    => __( 'Top', 'astra-addon' ),
						'right'  => __( 'Right', 'astra-addon' ),
						'bottom' => __( 'Bottom', 'astra-addon' ),
						'left'   => __( 'Left', 'astra-addon' ),
					),
					'section'           => 'section-above-header',
					'context'           => array(
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
			);

			$configurations = array_merge( $configurations, $_configs );

			return $configurations;
		}
	}
}

new Astra_Nav_Menu_Above_Header_Layout();

