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

if ( ! class_exists( 'Astra_Nav_Menu_Below_Header_Typography' ) ) {

	/**
	 * Register Mega Menu Customizer Configurations.
	 */
	class Astra_Nav_Menu_Below_Header_Typography extends Astra_Customizer_Config_Base {

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
				 * Option: Below Header Header Group
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[below-header-megamenu-typography-styling]',
					'default'   => astra_get_option( 'below-header-megamenu-typography-styling' ),
					'type'      => 'control',
					'control'   => 'ast-settings-group',
					'title'     => __( 'Mega Menu Column Heading', 'astra-addon' ),
					'section'   => 'section-below-header',
					'transport' => 'postMessage',
					'divider'   => array( 'ast_class' => 'ast-bottom-divider' ),
					'priority'  => 137,
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

				// Option: Below Megamenu Header Menu Font Family.
				array(
					'name'      => 'below-header-megamenu-heading-font-family',
					'parent'    => ASTRA_THEME_SETTINGS . '[below-header-megamenu-typography-styling]',
					'type'      => 'sub-control',
					'section'   => 'section-below-header',
					'control'   => 'ast-font',
					'font_type' => 'ast-font-family',
					'default'   => astra_get_option( 'below-header-megamenu-heading-font-family' ),
					'title'     => __( 'Family', 'astra-addon' ),
					'connect'   => ASTRA_THEME_SETTINGS . '[below-header-megamenu-heading-font-weight]',
				),

				// Option: Below Megamenu Header Menu Font Size.
				array(
					'name'        => 'below-header-megamenu-heading-font-size',
					'parent'      => ASTRA_THEME_SETTINGS . '[below-header-megamenu-typography-styling]',
					'transport'   => 'postMessage',
					'title'       => __( 'Size', 'astra-addon' ),
					'type'        => 'sub-control',
					'section'     => 'section-below-header',
					'control'     => 'ast-responsive',
					'responsive'  => false,
					'default'     => astra_get_option( 'below-header-megamenu-heading-font-size' ),
					'input_attrs' => array(
						'min' => 0,
					),
					'units'       => array(
						'px' => 'px',
						'em' => 'em',
					),
				),

				// Option: Below Megamenu Header Menu Font Weight.
				array(
					'name'              => 'below-header-megamenu-heading-font-weight',
					'parent'            => ASTRA_THEME_SETTINGS . '[below-header-megamenu-typography-styling]',
					'type'              => 'sub-control',
					'section'           => 'section-below-header',
					'control'           => 'ast-font',
					'font_type'         => 'ast-font-weight',
					'default'           => astra_get_option( 'below-header-megamenu-heading-font-weight' ),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_font_weight' ),
					'title'             => __( 'Weight', 'astra-addon' ),
					'connect'           => 'below-header-megamenu-heading-font-family',
				),

				// Option: Below Megamenu Header Menu Text Transform.
				array(
					'name'      => 'below-header-megamenu-heading-text-transform',
					'parent'    => ASTRA_THEME_SETTINGS . '[below-header-megamenu-typography-styling]',
					'type'      => 'sub-control',
					'section'   => 'section-below-header',
					'control'   => 'ast-select',
					'title'     => __( 'Text Transform', 'astra-addon' ),
					'transport' => 'postMessage',
					'default'   => astra_get_option( 'below-header-megamenu-heading-text-transform' ),
					'choices'   => array(
						''           => __( 'Inherit', 'astra-addon' ),
						'none'       => __( 'None', 'astra-addon' ),
						'capitalize' => __( 'Capitalize', 'astra-addon' ),
						'uppercase'  => __( 'Uppercase', 'astra-addon' ),
						'lowercase'  => __( 'Lowercase', 'astra-addon' ),
					),
				),
			);

			$configurations = array_merge( $configurations, $_configs );

			return $configurations;
		}
	}
}

new Astra_Nav_Menu_Below_Header_Typography();
