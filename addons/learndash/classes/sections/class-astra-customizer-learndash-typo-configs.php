<?php
/**
 * LearnDash General Options for our theme.
 *
 * @package     Astra Addon
 * @link        https://www.brainstormforce.com
 * @since       1.4.3
 */

// Block direct access to the file.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Bail if Customizer config base class does not exist.
if ( ! class_exists( 'Astra_Customizer_Config_Base' ) ) {
	return;
}

/**
 * Customizer Sanitizes
 *
 * @since 1.4.3
 */
if ( ! class_exists( 'Astra_Customizer_Learndash_Typo_Configs' ) ) {

	/**
	 * Register Typo Customizer Configurations.
	 */
	// @codingStandardsIgnoreStart
	class Astra_Customizer_Learndash_Typo_Configs extends Astra_Customizer_Config_Base {
 // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedClassFound
		// @codingStandardsIgnoreEnd

		/**
		 * Register Typo Customizer Configurations.
		 *
		 * @param Array                $configurations Astra Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array Astra Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_configs = array(

				/**
				 * Group: Learndash Header Typography Group
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[learndash-header-typography-group]',
					'default'   => astra_get_option( 'learndash-header-typography-group' ),
					'type'      => 'control',
					'control'   => 'ast-settings-group',
					'title'     => __( 'Header Font', 'astra-addon' ),
					'section'   => 'section-learndash',
					'transport' => 'postMessage',
					'priority'  => 43,
					'divider'   => array( 'ast_class' => 'ast-top-divider' ),
				),

				/**
				 * Group: Learndash Content Typography Group
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[learndash-content-typography-group]',
					'default'   => astra_get_option( 'learndash-content-typography-group' ),
					'type'      => 'control',
					'control'   => 'ast-settings-group',
					'title'     => __( 'Content Font', 'astra-addon' ),
					'section'   => 'section-learndash',
					'transport' => 'postMessage',
					'priority'  => 43,
					'divider'   => array( 'ast_class' => 'ast-top-divider' ),
				),

				/**
				 * Option: Table Heading Font Family
				 */
				array(
					'name'      => 'font-family-learndash-table-heading',
					'default'   => astra_get_option( 'font-family-learndash-table-heading' ),
					'control'   => 'ast-font',
					'type'      => 'sub-control',
					'parent'    => ASTRA_THEME_SETTINGS . '[learndash-header-typography-group]',
					'font_type' => 'ast-font-family',
					'title'     => __( 'Font Family', 'astra-addon' ),
					'connect'   => ASTRA_THEME_SETTINGS . '[font-weight-learndash-table-heading]',
					'priority'  => 15,
				),

				/**
				 * Option: Table Heading Font Weight
				 */
				array(
					'name'              => 'font-weight-learndash-table-heading',
					'default'           => astra_get_option( 'font-weight-learndash-table-heading' ),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_font_weight' ),
					'type'              => 'sub-control',
					'parent'            => ASTRA_THEME_SETTINGS . '[learndash-header-typography-group]',
					'control'           => 'ast-font',
					'font_type'         => 'ast-font-weight',
					'title'             => __( 'Font Weight', 'astra-addon' ),
					'connect'           => 'font-family-learndash-table-heading',
					'priority'          => 20,
				),

				/**
				 * Option: Table Heading Text Transform
				 */
				array(
					'name'      => 'text-transform-learndash-table-heading',
					'default'   => astra_get_option( 'text-transform-learndash-table-heading' ),
					'type'      => 'sub-control',
					'parent'    => ASTRA_THEME_SETTINGS . '[learndash-header-typography-group]',
					'transport' => 'postMessage',
					'title'     => __( 'Text Transform', 'astra-addon' ),
					'control'   => 'ast-select',
					'choices'   => array(
						''           => __( 'Inherit', 'astra-addon' ),
						'none'       => __( 'None', 'astra-addon' ),
						'capitalize' => __( 'Capitalize', 'astra-addon' ),
						'uppercase'  => __( 'Uppercase', 'astra-addon' ),
						'lowercase'  => __( 'Lowercase', 'astra-addon' ),
					),
					'priority'  => 25,
				),

				/**
				 * Option: Table Heading Font Size
				 */
				array(
					'name'        => 'font-size-learndash-table-heading',
					'default'     => astra_get_option( 'font-size-learndash-table-heading' ),
					'type'        => 'sub-control',
					'parent'      => ASTRA_THEME_SETTINGS . '[learndash-header-typography-group]',
					'transport'   => 'postMessage',
					'title'       => __( 'Font Size', 'astra-addon' ),
					'control'     => 'ast-responsive-slider',
					'suffix'      => array( 'px', 'em', 'vw', 'rem' ),
					'input_attrs' => array(
						'px'  => array(
							'min'  => 0,
							'step' => 1,
							'max'  => 200,
						),
						'em'  => array(
							'min'  => 0,
							'step' => 0.01,
							'max'  => 20,
						),
						'vw'  => array(
							'min'  => 0,
							'step' => 0.1,
							'max'  => 25,
						),
						'rem' => array(
							'min'  => 0,
							'step' => 0.1,
							'max'  => 20,
						),
					),
					'priority'    => 16,
				),

				/**
				 * Option: Table Heading Font Family
				 */
				array(
					'name'      => 'font-family-learndash-table-content',
					'default'   => astra_get_option( 'font-family-learndash-table-content' ),
					'type'      => 'sub-control',
					'parent'    => ASTRA_THEME_SETTINGS . '[learndash-content-typography-group]',
					'control'   => 'ast-font',
					'font_type' => 'ast-font-family',
					'title'     => __( 'Font Family', 'astra-addon' ),
					'connect'   => ASTRA_THEME_SETTINGS . '[font-weight-learndash-table-content]',
					'priority'  => 40,
				),

				/**
				 * Option: Table Heading Font Weight
				 */
				array(
					'name'              => 'font-weight-learndash-table-content',
					'default'           => astra_get_option( 'font-weight-learndash-table-content' ),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_font_weight' ),
					'type'              => 'sub-control',
					'parent'            => ASTRA_THEME_SETTINGS . '[learndash-content-typography-group]',
					'control'           => 'ast-font',
					'font_type'         => 'ast-font-weight',
					'title'             => __( 'Font Weight', 'astra-addon' ),
					'connect'           => 'font-family-learndash-table-content',
					'priority'          => 45,
				),

				/**
				 * Option: Table Heading Text Transform
				 */
				array(
					'name'      => 'text-transform-learndash-table-content',
					'default'   => astra_get_option( 'text-transform-learndash-table-content' ),
					'type'      => 'sub-control',
					'parent'    => ASTRA_THEME_SETTINGS . '[learndash-content-typography-group]',
					'control'   => 'ast-select',
					'transport' => 'postMessage',
					'title'     => __( 'Text Transform', 'astra-addon' ),
					'choices'   => array(
						''           => __( 'Inherit', 'astra-addon' ),
						'none'       => __( 'None', 'astra-addon' ),
						'capitalize' => __( 'Capitalize', 'astra-addon' ),
						'uppercase'  => __( 'Uppercase', 'astra-addon' ),
						'lowercase'  => __( 'Lowercase', 'astra-addon' ),
					),
					'priority'  => 50,
				),

				/**
				 * Option: Table Heading Font Size
				 */
				array(
					'name'        => 'font-size-learndash-table-content',
					'default'     => astra_get_option( 'font-size-learndash-table-content' ),
					'type'        => 'sub-control',
					'parent'      => ASTRA_THEME_SETTINGS . '[learndash-content-typography-group]',
					'transport'   => 'postMessage',
					'title'       => __( 'Font Size', 'astra-addon' ),
					'control'     => 'ast-responsive-slider',
					'suffix'      => array( 'px', 'em', 'vw', 'rem' ),
					'input_attrs' => array(
						'px'  => array(
							'min'  => 0,
							'step' => 1,
							'max'  => 200,
						),
						'em'  => array(
							'min'  => 0,
							'step' => 0.01,
							'max'  => 20,
						),
						'vw'  => array(
							'min'  => 0,
							'step' => 0.1,
							'max'  => 25,
						),
						'rem' => array(
							'min'  => 0,
							'step' => 0.1,
							'max'  => 20,
						),
					),
					'priority'    => 41,
				),
			);

			return array_merge( $configurations, $_configs );
		}
	}
}

/**
 * Kicking this off by calling 'get_instance()' method
 */
new Astra_Customizer_Learndash_Typo_Configs();
