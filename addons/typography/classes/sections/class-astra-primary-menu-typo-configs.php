<?php
/**
 * [Primary Menu] options for astra theme.
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

if ( ! class_exists( 'Astra_Primary_Menu_Typo_Configs' ) ) {

	/**
	 * Register below header Configurations.
	 */
	// @codingStandardsIgnoreStart
	class Astra_Primary_Menu_Typo_Configs extends Astra_Customizer_Config_Base {
 // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedClassFound
		// @codingStandardsIgnoreEnd

		/**
		 * Register Primary Menu typography Customizer Configurations.
		 *
		 * @param Array                $configurations Astra Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array Astra Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_configs = array(

				array(
					'name'      => ASTRA_THEME_SETTINGS . '[primary-header-menu-typography]',
					'default'   => astra_get_option( 'primary-header-menu-typography' ),
					'type'      => 'control',
					'control'   => 'ast-settings-group',
					'title'     => __( 'Menu Font', 'astra-addon' ),
					'section'   => 'section-primary-menu',
					'transport' => 'postMessage',
					'priority'  => 72,
					'divider'   => array( 'ast_class' => 'ast-bottom-divider' ),
				),

				array(
					'name'      => ASTRA_THEME_SETTINGS . '[primary-sub-menu-typography]',
					'default'   => astra_get_option( 'primary-sub-menu-typography' ),
					'type'      => 'control',
					'control'   => 'ast-settings-group',
					'title'     => __( 'Submenu Font', 'astra-addon' ),
					'section'   => 'section-primary-menu',
					'transport' => 'postMessage',
					'priority'  => 72,
					'divider'   => array( 'ast_class' => 'ast-bottom-divider' ),
				),

				/**
				 * Option: Primary Menu Font Family
				 */
				array(
					'name'      => 'font-family-primary-menu',
					'type'      => 'sub-control',
					'parent'    => ASTRA_THEME_SETTINGS . '[primary-header-menu-typography]',
					'section'   => 'section-primary-menu',
					'control'   => 'ast-font',
					'font_type' => 'ast-font-family',
					'default'   => astra_get_option( 'font-family-primary-menu' ),
					'title'     => __( 'Font Family', 'astra-addon' ),
					'priority'  => 22,
					'connect'   => 'font-weight-primary-menu',
				),

				/**
				 * Option: Primary Menu Font Weight
				 */
				array(
					'name'              => 'font-weight-primary-menu',
					'parent'            => ASTRA_THEME_SETTINGS . '[primary-header-menu-typography]',
					'section'           => 'section-primary-menu',
					'type'              => 'sub-control',
					'control'           => 'ast-font',
					'font_type'         => 'ast-font-weight',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_font_weight' ),
					'default'           => astra_get_option( 'font-weight-primary-menu' ),
					'title'             => __( 'Font Weight', 'astra-addon' ),
					'priority'          => 24,
					'connect'           => 'font-family-primary-menu',
				),

				/**
				 * Option: Primary Menu Text Transform
				 */
				array(
					'name'      => 'text-transform-primary-menu',
					'parent'    => ASTRA_THEME_SETTINGS . '[primary-header-menu-typography]',
					'section'   => 'section-primary-menu',
					'type'      => 'sub-control',
					'control'   => 'ast-select',
					'transport' => 'postMessage',
					'title'     => __( 'Text Transform', 'astra-addon' ),
					'priority'  => 25,
					'default'   => astra_get_option( 'text-transform-primary-menu' ),
					'choices'   => array(
						''           => __( 'Inherit', 'astra-addon' ),
						'none'       => __( 'None', 'astra-addon' ),
						'capitalize' => __( 'Capitalize', 'astra-addon' ),
						'uppercase'  => __( 'Uppercase', 'astra-addon' ),
						'lowercase'  => __( 'Lowercase', 'astra-addon' ),
					),
				),

				/**
				 * Option: Primary Menu Font Size
				 */
				array(
					'name'        => 'font-size-primary-menu',
					'parent'      => ASTRA_THEME_SETTINGS . '[primary-header-menu-typography]',
					'section'     => 'section-primary-menu',
					'type'        => 'sub-control',
					'default'     => astra_get_option( 'font-size-primary-menu' ),
					'priority'    => 23,
					'title'       => __( 'Font Size', 'astra-addon' ),
					'transport'   => 'postMessage',
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
				 * Option: Primary Menu Line Height
				 */
				array(
					'name'              => 'line-height-primary-menu',
					'parent'            => ASTRA_THEME_SETTINGS . '[primary-header-menu-typography]',
					'section'           => 'section-primary-menu',
					'type'              => 'sub-control',
					'priority'          => 26,
					'title'             => __( 'Line Height', 'astra-addon' ),
					'transport'         => 'postMessage',
					'default'           => astra_get_option( 'line-height-primary-menu' ),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_number_n_blank' ),
					'control'           => 'ast-slider',
					'suffix'            => 'em',
					'input_attrs'       => array(
						'min'  => 1,
						'step' => 0.01,
						'max'  => 10,
					),
				),

				/**
				 * Option: Primary Submenu Font Family
				 */
				array(
					'name'      => 'font-family-primary-dropdown-menu',
					'type'      => 'sub-control',
					'parent'    => ASTRA_THEME_SETTINGS . '[primary-sub-menu-typography]',
					'section'   => 'section-primary-menu',
					'control'   => 'ast-font',
					'font_type' => 'ast-font-family',
					'title'     => __( 'Font Family', 'astra-addon' ),
					'default'   => astra_get_option( 'font-family-primary-dropdown-menu' ),
					'priority'  => 28,
					'connect'   => 'font-weight-primary-dropdown-menu',
				),

				/**
				 * Option: Primary Submenu Font Weight
				 */
				array(
					'name'              => 'font-weight-primary-dropdown-menu',
					'type'              => 'sub-control',
					'parent'            => ASTRA_THEME_SETTINGS . '[primary-sub-menu-typography]',
					'section'           => 'section-primary-menu',
					'control'           => 'ast-font',
					'font_type'         => 'ast-font-weight',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_font_weight' ),
					'default'           => astra_get_option( 'font-weight-primary-dropdown-menu' ),
					'title'             => __( 'Font Weight', 'astra-addon' ),
					'priority'          => 30,
					'connect'           => 'font-family-primary-dropdown-menu',
				),

				/**
				 * Option: Primary Submenu Text Transform
				 */
				array(
					'name'      => 'text-transform-primary-dropdown-menu',
					'parent'    => ASTRA_THEME_SETTINGS . '[primary-sub-menu-typography]',
					'section'   => 'section-primary-menu',
					'type'      => 'sub-control',
					'title'     => __( 'Text Transform', 'astra-addon' ),
					'transport' => 'postMessage',
					'priority'  => 31,
					'default'   => astra_get_option( 'text-transform-primary-dropdown-menu' ),
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
				 * Option: Primary Submenu Font Size
				 */
				array(
					'name'        => 'font-size-primary-dropdown-menu',
					'parent'      => ASTRA_THEME_SETTINGS . '[primary-sub-menu-typography]',
					'section'     => 'section-primary-menu',
					'title'       => __( 'Font Size', 'astra-addon' ),
					'type'        => 'sub-control',
					'transport'   => 'postMessage',
					'priority'    => 29,
					'default'     => astra_get_option( 'font-size-primary-dropdown-menu' ),
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
				 * Option: Primary Submenu Line Height
				 */

				array(
					'name'              => 'line-height-primary-dropdown-menu',
					'parent'            => ASTRA_THEME_SETTINGS . '[primary-sub-menu-typography]',
					'section'           => 'section-primary-menu',
					'type'              => 'sub-control',
					'priority'          => 32,
					'title'             => __( 'Line Height', 'astra-addon' ),
					'transport'         => 'postMessage',
					'default'           => astra_get_option( 'line-height-primary-dropdown-menu' ),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_number_n_blank' ),
					'control'           => 'ast-slider',
					'suffix'            => 'em',
					'input_attrs'       => array(
						'min'  => 1,
						'step' => 0.01,
						'max'  => 5,
					),
				),

				/**
				 * Option: Primary Header Outside Menu Item Typography Group
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[primary-header-outside-menu-item-typography-group]',
					'default'   => astra_get_option( 'primary-header-outside-menu-item-typography-group' ),
					'type'      => 'control',
					'control'   => 'ast-settings-group',
					'title'     => __( 'Outside menu item', 'astra-addon' ),
					'section'   => 'section-primary-menu',
					'transport' => 'postMessage',
					'context'   => array(
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[header-display-outside-menu]',
							'operator' => '==',
							'value'    => '1',
						),
					),
					'priority'  => 73,
				),

				/**
				 * Option: Outside menu font size
				 */

				array(
					'name'        => 'outside-menu-font-size',
					'parent'      => ASTRA_THEME_SETTINGS . '[primary-header-outside-menu-item-typography-group]',
					'section'     => 'section-primary-menu',
					'type'        => 'sub-control',
					'default'     => astra_get_option( 'outside-menu-font-size' ),
					'priority'    => 5,
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
				 * Option: outside Menu Line Height
				 */
				array(
					'name'              => 'outside-menu-line-height',
					'transport'         => 'postMessage',
					'title'             => __( 'Line Height', 'astra-addon' ),
					'parent'            => ASTRA_THEME_SETTINGS . '[primary-header-outside-menu-item-typography-group]',
					'section'           => 'section-primary-menu',
					'type'              => 'sub-control',
					'control'           => 'ast-slider',
					'default'           => astra_get_option( 'outside-menu-line-height' ),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_number_n_blank' ),
					'priority'          => 7,
					'suffix'            => 'em',
					'input_attrs'       => array(
						'min'  => 1,
						'step' => 0.01,
						'max'  => 10,
					),
				),
			);

			return array_merge( $configurations, $_configs );
		}
	}
}

new Astra_Primary_Menu_Typo_Configs();
