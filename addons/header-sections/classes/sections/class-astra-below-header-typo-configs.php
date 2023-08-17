<?php
/**
 * Below Header - Typpography Options for our theme.
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

if ( ! class_exists( 'Astra_Below_Header_Typo_Configs' ) ) {

	/**
	 * Register below header Configurations.
	 */
	// @codingStandardsIgnoreStart
	class Astra_Below_Header_Typo_Configs extends Astra_Customizer_Config_Base {
 // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedClassFound
		// @codingStandardsIgnoreEnd

		/**
		 * Register Below Header Typo Configurations.
		 *
		 * @param Array                $configurations Astra Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array Astra Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_configs = array(

				/**
				 * Option: Below Header Menu Font Family
				 */

				array(
					'name'      => 'font-family-below-header-primary-menu',
					'parent'    => ASTRA_THEME_SETTINGS . '[below-header-menu-typography-styling]',
					'type'      => 'sub-control',
					'section'   => 'section-below-header',
					'control'   => 'ast-font',
					'font_type' => 'ast-font-family',
					'default'   => astra_get_option( 'font-family-below-header-primary-menu' ),
					'title'     => __( 'Font Family', 'astra-addon' ),
					'connect'   => ASTRA_THEME_SETTINGS . '[font-weight-below-header-primary-menu]',
				),

				/**
				 * Option: Below Header Menu Font Size
				 */
				array(
					'name'        => 'font-size-below-header-primary-menu',
					'transport'   => 'postMessage',
					'parent'      => ASTRA_THEME_SETTINGS . '[below-header-menu-typography-styling]',
					'title'       => __( 'Font Size', 'astra-addon' ),
					'type'        => 'sub-control',
					'section'     => 'section-below-header',
					'default'     => astra_get_option( 'font-size-below-header-primary-menu' ),
					'control'     => 'ast-responsive-slider',
					'suffix'      => array( 'px', 'em' ),
					'input_attrs' => array(
						'px' => array(
							'min'  => 0,
							'step' => 1,
							'max'  => 200,
						),
						'em' => array(
							'min'  => 0,
							'step' => 0.01,
							'max'  => 20,
						),
					),
				),

				/**
				 * Option: Below Header Menu Font Weight
				 */
				array(
					'name'              => 'font-weight-below-header-primary-menu',
					'parent'            => ASTRA_THEME_SETTINGS . '[below-header-menu-typography-styling]',
					'type'              => 'sub-control',
					'control'           => 'ast-font',
					'section'           => 'section-below-header',
					'font_type'         => 'ast-font-weight',
					'default'           => astra_get_option( 'font-weight-below-header-primary-menu' ),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_font_weight' ),
					'title'             => __( 'Font Weight', 'astra-addon' ),
					'connect'           => 'font-family-below-header-primary-menu',
				),

				/**
				 * Option: Below Header Menu Text Transform
				 */
				array(
					'name'      => 'text-transform-below-header-primary-menu',
					'parent'    => ASTRA_THEME_SETTINGS . '[below-header-menu-typography-styling]',
					'type'      => 'sub-control',
					'control'   => 'ast-select',
					'section'   => 'section-below-header',
					'title'     => __( 'Text Transform', 'astra-addon' ),
					'transport' => 'postMessage',
					'default'   => astra_get_option( 'text-transform-below-header-primary-menu' ),
					'choices'   => array(
						''           => __( 'Inherit', 'astra-addon' ),
						'none'       => __( 'None', 'astra-addon' ),
						'capitalize' => __( 'Capitalize', 'astra-addon' ),
						'uppercase'  => __( 'Uppercase', 'astra-addon' ),
						'lowercase'  => __( 'Lowercase', 'astra-addon' ),
					),
				),

				/**
				 * Option: Below Header Submenu Font Family
				 */
				array(
					'name'      => 'font-family-below-header-dropdown-menu',
					'type'      => 'sub-control',
					'control'   => 'ast-font',
					'section'   => 'section-below-header',
					'font_type' => 'ast-font-family',
					'parent'    => ASTRA_THEME_SETTINGS . '[below-header-submenu-typography-styling]',
					'title'     => __( 'Font Family', 'astra-addon' ),
					'default'   => astra_get_option( 'font-family-below-header-dropdown-menu' ),
					'connect'   => ASTRA_THEME_SETTINGS . '[font-weight-below-header-dropdown-menu]',
				),

				/**
				 * Option: Below Header Submenu Font Size
				 */
				array(
					'name'        => 'font-size-below-header-dropdown-menu',
					'transport'   => 'postMessage',
					'type'        => 'sub-control',
					'section'     => 'section-below-header',
					'parent'      => ASTRA_THEME_SETTINGS . '[below-header-submenu-typography-styling]',
					'title'       => __( 'Font Size', 'astra-addon' ),
					'default'     => astra_get_option( 'font-size-below-header-dropdown-menu' ),
					'control'     => 'ast-responsive-slider',
					'suffix'      => array( 'px', 'em' ),
					'input_attrs' => array(
						'px' => array(
							'min'  => 0,
							'step' => 1,
							'max'  => 200,
						),
						'em' => array(
							'min'  => 0,
							'step' => 0.01,
							'max'  => 20,
						),
					),
				),

				/**
				 * Option: Below Header Submenu Font Weight
				 */
				array(
					'name'              => 'font-weight-below-header-dropdown-menu',
					'type'              => 'sub-control',
					'control'           => 'ast-font',
					'section'           => 'section-below-header',
					'font_type'         => 'ast-font-weight',
					'default'           => astra_get_option( 'font-weight-below-header-dropdown-menu' ),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_font_weight' ),
					'parent'            => ASTRA_THEME_SETTINGS . '[below-header-submenu-typography-styling]',
					'title'             => __( 'Font Weight', 'astra-addon' ),
					'connect'           => 'font-family-below-header-dropdown-menu',
				),

				/**
				 * Option: Below Header Submenu Text Transform
				 */
				array(
					'name'      => 'text-transform-below-header-dropdown-menu',
					'transport' => 'postMessage',
					'parent'    => ASTRA_THEME_SETTINGS . '[below-header-submenu-typography-styling]',
					'title'     => __( 'Text Transform', 'astra-addon' ),
					'default'   => astra_get_option( 'text-transform-below-header-dropdown-menu' ),
					'type'      => 'sub-control',
					'section'   => 'section-below-header',
					'control'   => 'ast-select',
					'choices'   => array(
						''           => __( 'Inherit', 'astra-addon' ),
						'none'       => __( 'None', 'astra-addon' ),
						'capitalize' => __( 'Capitalize', 'astra-addon' ),
						'uppercase'  => __( 'Uppercase', 'astra-addon' ),
						'lowercase'  => __( 'Lowercase', 'astra-addon' ),
					),
				),

				/**
				 * Option: Below Header Content Font Family
				 */

				array(
					'name'      => 'font-family-below-header-content',
					'default'   => astra_get_option( 'font-family-below-header-content' ),
					'type'      => 'sub-control',
					'control'   => 'ast-font',
					'section'   => 'section-below-header',
					'font_type' => 'ast-font-family',
					'parent'    => ASTRA_THEME_SETTINGS . '[below-header-content-typography-styling]',
					'title'     => __( 'Font Family', 'astra-addon' ),
					'connect'   => 'font-weight-below-header-content',
				),

				/**
				 * Option: Below Header Content Font Size
				 */
				array(
					'name'        => 'font-size-below-header-content',
					'type'        => 'sub-control',
					'transport'   => 'postMessage',
					'default'     => astra_get_option( 'font-size-below-header-content' ),
					'parent'      => ASTRA_THEME_SETTINGS . '[below-header-content-typography-styling]',
					'title'       => __( 'Font Size', 'astra-addon' ),
					'section'     => 'section-below-header',
					'control'     => 'ast-responsive-slider',
					'suffix'      => array( 'px', 'em' ),
					'input_attrs' => array(
						'px' => array(
							'min'  => 0,
							'step' => 1,
							'max'  => 200,
						),
						'em' => array(
							'min'  => 0,
							'step' => 0.01,
							'max'  => 20,
						),
					),
				),

				/**
				 * Option: Below Header Content Font Weight
				 */
				array(
					'name'              => 'font-weight-below-header-content',
					'default'           => astra_get_option( 'font-weight-below-header-content' ),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_font_weight' ),
					'type'              => 'sub-control',
					'control'           => 'ast-font',
					'section'           => 'section-below-header',
					'font_type'         => 'ast-font-weight',
					'parent'            => ASTRA_THEME_SETTINGS . '[below-header-content-typography-styling]',
					'title'             => __( 'Font Weight', 'astra-addon' ),
					'connect'           => 'font-family-below-header-content',
				),

				/**
				 * Option: Below Header Content Text Transform
				 */
				array(
					'name'      => 'text-transform-below-header-content',
					'type'      => 'sub-control',
					'control'   => 'ast-select',
					'section'   => 'section-below-header',
					'default'   => astra_get_option( 'text-transform-below-header-content' ),
					'transport' => 'postMessage',
					'parent'    => ASTRA_THEME_SETTINGS . '[below-header-content-typography-styling]',
					'title'     => __( 'Text Transform', 'astra-addon' ),
					'choices'   => array(
						''           => __( 'Inherit', 'astra-addon' ),
						'none'       => __( 'None', 'astra-addon' ),
						'capitalize' => __( 'Capitalize', 'astra-addon' ),
						'uppercase'  => __( 'Uppercase', 'astra-addon' ),
						'lowercase'  => __( 'Lowercase', 'astra-addon' ),
					),
				),

			);

			return array_merge( $configurations, $_configs );
		}
	}
}

new Astra_Below_Header_Typo_Configs();


