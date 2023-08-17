<?php
/**
 * Above Header - Typography Options for our theme.
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


if ( ! class_exists( 'Astra_Above_Header_Typo_Configs' ) ) {

	/**
	 * Register above header Configurations.
	 */
	// @codingStandardsIgnoreStart
	class Astra_Above_Header_Typo_Configs extends Astra_Customizer_Config_Base {
 // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedClassFound
		// @codingStandardsIgnoreEnd

		/**
		 * Register Above Header Typo Configurations.
		 *
		 * @param Array                $configurations Astra Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array Astra Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_configs = array(

				/**
				 * Option: Font Family
				 */
				array(
					'name'      => 'above-header-font-family',
					'parent'    => ASTRA_THEME_SETTINGS . '[above-header-typography-menu-styling]',
					'priority'  => 5,
					'type'      => 'sub-control',
					'section'   => 'section-above-header',
					'control'   => 'ast-font',
					'font_type' => 'ast-font-family',
					'default'   => astra_get_option( 'above-header-font-family' ),
					'title'     => __( 'Font Family', 'astra-addon' ),
					'connect'   => ASTRA_THEME_SETTINGS . '[above-header-font-weight]',
				),

				/**
				 * Option: Font Size
				 */
				array(
					'name'        => 'above-header-font-size',
					'parent'      => ASTRA_THEME_SETTINGS . '[above-header-typography-menu-styling]',
					'priority'    => 5,
					'transport'   => 'postMessage',
					'type'        => 'sub-control',
					'section'     => 'section-above-header',
					'default'     => astra_get_option( 'above-header-font-size' ),
					'title'       => __( 'Font Size', 'astra-addon' ),
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
				 * Option: Font Weight
				 */
				array(
					'name'              => 'above-header-font-weight',
					'parent'            => ASTRA_THEME_SETTINGS . '[above-header-typography-menu-styling]',
					'priority'          => 5,
					'default'           => astra_get_option( 'above-header-font-weight' ),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_font_weight' ),
					'type'              => 'sub-control',
					'section'           => 'section-above-header',
					'control'           => 'ast-font',
					'font_type'         => 'ast-font-weight',
					'title'             => __( 'Font Weight', 'astra-addon' ),
					'connect'           => 'above-header-font-family',
				),

				/**
				 * Option: Text Transform
				 */
				array(
					'name'      => 'above-header-text-transform',
					'parent'    => ASTRA_THEME_SETTINGS . '[above-header-typography-menu-styling]',
					'priority'  => 5,
					'transport' => 'postMessage',
					'title'     => __( 'Text Transform', 'astra-addon' ),
					'default'   => astra_get_option( 'above-header-text-transform' ),
					'type'      => 'sub-control',
					'section'   => 'section-above-header',
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
				 * Option: Above Header Submenu Font Family
				 */
				array(
					'name'      => 'font-family-above-header-dropdown-menu',
					'parent'    => ASTRA_THEME_SETTINGS . '[above-header-typography-submenu-styling]',
					'priority'  => 5,
					'type'      => 'sub-control',
					'section'   => 'section-above-header',
					'control'   => 'ast-font',
					'font_type' => 'ast-font-family',
					'title'     => __( 'Font Family', 'astra-addon' ),
					'default'   => astra_get_option( 'font-family-above-header-dropdown-menu' ),
					'connect'   => ASTRA_THEME_SETTINGS . '[font-weight-above-header-dropdown-menu]',
				),

				/**
				 * Option: Above Header Submenu Font Size
				 */
				array(
					'name'        => 'font-size-above-header-dropdown-menu',
					'parent'      => ASTRA_THEME_SETTINGS . '[above-header-typography-submenu-styling]',
					'priority'    => 5,
					'transport'   => 'postMessage',
					'type'        => 'sub-control',
					'section'     => 'section-above-header',
					'title'       => __( 'Font Size', 'astra-addon' ),
					'default'     => astra_get_option( 'font-size-above-header-dropdown-menu' ),
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
				 * Option: Above Header Submenu Font Weight
				 */
				array(
					'name'              => 'font-weight-above-header-dropdown-menu',
					'parent'            => ASTRA_THEME_SETTINGS . '[above-header-typography-submenu-styling]',
					'priority'          => 5,
					'type'              => 'sub-control',
					'section'           => 'section-above-header',
					'control'           => 'ast-font',
					'font_type'         => 'ast-font-weight',
					'default'           => astra_get_option( 'font-weight-above-header-dropdown-menu' ),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_font_weight' ),
					'title'             => __( 'Font Weight', 'astra-addon' ),
					'connect'           => 'font-family-above-header-dropdown-menu',
				),

				/**
				 * Option: Above Header Submenu Text Transform
				 */
				array(
					'name'      => 'text-transform-above-header-dropdown-menu',
					'parent'    => ASTRA_THEME_SETTINGS . '[above-header-typography-submenu-styling]',
					'priority'  => 5,
					'type'      => 'sub-control',
					'section'   => 'section-above-header',
					'transport' => 'postMessage',
					'title'     => __( 'Text Transform', 'astra-addon' ),
					'default'   => astra_get_option( 'text-transform-above-header-dropdown-menu' ),
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
				 * Option: above Header Content Font Family
				 */

				array(
					'name'      => 'font-family-above-header-content',
					'default'   => astra_get_option( 'font-family-above-header-content' ),
					'type'      => 'sub-control',
					'control'   => 'ast-font',
					'section'   => 'section-above-header',
					'font_type' => 'ast-font-family',
					'parent'    => ASTRA_THEME_SETTINGS . '[above-header-content-typography-styling]',
					'title'     => __( 'Font Family', 'astra-addon' ),
					'connect'   => 'font-weight-above-header-content',
				),

				/**
				 * Option: above Header Content Font Size
				 */
				array(
					'name'        => 'font-size-above-header-content',
					'type'        => 'sub-control',
					'transport'   => 'postMessage',
					'default'     => astra_get_option( 'font-size-above-header-content' ),
					'parent'      => ASTRA_THEME_SETTINGS . '[above-header-content-typography-styling]',
					'title'       => __( 'Font Size', 'astra-addon' ),
					'section'     => 'section-above-header',
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
				 * Option: Above Header Content Font Weight
				 */
				array(
					'name'              => 'font-weight-above-header-content',
					'default'           => astra_get_option( 'font-weight-above-header-content' ),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_font_weight' ),
					'type'              => 'sub-control',
					'control'           => 'ast-font',
					'section'           => 'section-above-header',
					'font_type'         => 'ast-font-weight',
					'parent'            => ASTRA_THEME_SETTINGS . '[above-header-content-typography-styling]',
					'title'             => __( 'Font Weight', 'astra-addon' ),
					'connect'           => 'font-family-above-header-content',
				),

				/**
				 * Option: above Header Content Text Transform
				 */
				array(
					'name'      => 'text-transform-above-header-content',
					'type'      => 'sub-control',
					'control'   => 'ast-select',
					'section'   => 'section-above-header',
					'default'   => astra_get_option( 'text-transform-above-header-content' ),
					'transport' => 'postMessage',
					'parent'    => ASTRA_THEME_SETTINGS . '[above-header-content-typography-styling]',
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

new Astra_Above_Header_Typo_Configs();
