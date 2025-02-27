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

if ( ! class_exists( 'Astra_Existing_Nav_Menu_Below_Header_Colors' ) ) {

	/**
	 * Register Mega Menu Customizer Configurations.
	 */
	// @codingStandardsIgnoreStart
	class Astra_Existing_Nav_Menu_Below_Header_Colors extends Astra_Customizer_Config_Base {
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
				 * Option: Below Header Menus Group
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[below-header-megamenu-group]',
					'default'   => astra_get_option( 'below-header-megamenu-group' ),
					'type'      => 'control',
					'control'   => Astra_Theme_Extension::$group_control,
					'title'     => __( 'Mega Menu Heading', 'astra-addon' ),
					'section'   => 'section-below-header',
					'transport' => 'postMessage',
					'divider'   => array( 'ast_class' => 'ast-bottom-divider' ),
					'priority'  => 136,
					'context'   => array(
						'relation' => 'AND',
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[below-header-layout]',
							'operator' => '!=',
							'value'    => 'disabled',
						),
						array(
							'relation' => 'OR',
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[below-header-section-1]',
								'operator' => '==',
								'value'    => 'menu',
							),
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[below-header-section-2]',
								'operator' => '==',
								'value'    => 'menu',
							),
						),
					),
				),

				// Option: Megamenu Heading Color.
				array(
					'type'              => 'sub-control',
					'priority'          => 12,
					'tab'               => __( 'Normal', 'astra-addon' ),
					'parent'            => ASTRA_THEME_SETTINGS . '[below-header-megamenu-group]',
					'control'           => 'ast-color',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
					'section'           => 'section-below-header',
					'transport'         => 'postMessage',
					'name'              => 'below-header-megamenu-heading-color',
					'default'           => astra_get_option( 'below-header-megamenu-heading-color' ),
					'title'             => __( 'Normal', 'astra-addon' ),
				),

				// Option: Megamenu Heading Hover Color.
				array(
					'type'              => 'sub-control',
					'priority'          => 12,
					'tab'               => __( 'Hover', 'astra-addon' ),
					'parent'            => ASTRA_THEME_SETTINGS . '[below-header-megamenu-group]',
					'control'           => 'ast-color',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
					'section'           => 'section-below-header',
					'transport'         => 'postMessage',
					'name'              => 'below-header-megamenu-heading-h-color',
					'default'           => astra_get_option( 'below-header-megamenu-heading-h-color' ),
					'title'             => __( 'Hover', 'astra-addon' ),
				),

				// Option: Megamenu Heading Color.
				array(
					'type'              => 'sub-control',
					'priority'          => 12,
					'parent'            => ASTRA_THEME_SETTINGS . '[sticky-header-below-mega-menus-colors]',
					'control'           => 'ast-color',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
					'section'           => 'section-below-header',
					'transport'         => 'postMessage',
					'name'              => 'sticky-below-header-megamenu-heading-color',
					'default'           => astra_get_option( 'sticky-below-header-megamenu-heading-color' ),
					'title'             => __( 'Normal', 'astra-addon' ),
					'context'           => array(
						'relation' => 'OR',
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[below-header-section-1]',
							'operator' => '==',
							'value'    => 'menu',
						),
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[below-header-section-2]',
							'operator' => '==',
							'value'    => 'menu',
						),
					),
				),

				// Option: Megamenu Heading Hover Color.
				array(
					'type'              => 'sub-control',
					'priority'          => 12,
					'parent'            => ASTRA_THEME_SETTINGS . '[sticky-header-below-mega-menus-colors]',
					'control'           => 'ast-color',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
					'section'           => 'section-below-header',
					'transport'         => 'postMessage',
					'name'              => 'sticky-below-header-megamenu-heading-h-color',
					'default'           => astra_get_option( 'sticky-below-header-megamenu-heading-h-color' ),
					'title'             => __( 'Hover', 'astra-addon' ),

					'context'           => array(
						'relation' => 'OR',
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[below-header-section-1]',
							'operator' => '==',
							'value'    => 'menu',
						),
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[below-header-section-2]',
							'operator' => '==',
							'value'    => 'menu',
						),
					),
				),
			);

			return array_merge( $configurations, $_configs );
		}
	}
}

new Astra_Existing_Nav_Menu_Below_Header_Colors();
