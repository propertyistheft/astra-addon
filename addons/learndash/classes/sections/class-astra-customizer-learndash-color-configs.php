<?php
/**
 * LearnDash General Options for our theme.
 *
 * @package     Astra Addon
 * @author      Brainstorm Force
 * @copyright   Copyright (c) 2020, Brainstorm Force
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
if ( ! class_exists( 'Astra_Customizer_Learndash_Color_Configs' ) ) {

	/**
	 * Register Learndash color Customizer Configurations.
	 */
	class Astra_Customizer_Learndash_Color_Configs extends Astra_Customizer_Config_Base {

		/**
		 * Register Learndash color Customizer Configurations.
		 *
		 * @param Array                $configurations Astra Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array Astra Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$active_ld_theme = '';

			if ( is_callable( 'LearnDash_Theme_Register::get_active_theme_key' ) ) {
				$active_ld_theme = LearnDash_Theme_Register::get_active_theme_key();
			}

			if ( 'ld30' !== $active_ld_theme ) {

				$_configs = array(

					/**
					 * Group: Learndash Colors Group
					 */
					array(
						'name'      => ASTRA_THEME_SETTINGS . '[learndash-heading-color-group]',
						'default'   => astra_get_option( 'learndash-color-group' ),
						'type'      => 'control',
						'control'   => Astra_Theme_Extension::$group_control,
						'title'     => __( 'Heading Color', 'astra-addon' ),
						'section'   => 'section-learndash',
						'transport' => 'postMessage',
						'priority'  => 41,
						'divider'   => array( 'ast_class' => 'ast-top-divider' ),
					),
					array(
						'name'      => ASTRA_THEME_SETTINGS . '[learndash-title-color-group]',
						'default'   => astra_get_option( 'learndash-color-group' ),
						'type'      => 'control',
						'control'   => Astra_Theme_Extension::$group_control,
						'title'     => __( 'Title Color', 'astra-addon' ),
						'section'   => 'section-learndash',
						'transport' => 'postMessage',
						'priority'  => 41,
					),
					array(
						'name'      => ASTRA_THEME_SETTINGS . '[learndash-icon-color-group]',
						'default'   => astra_get_option( 'learndash-color-group' ),
						'type'      => 'control',
						'control'   => Astra_Theme_Extension::$group_control,
						'title'     => __( 'Icon Color', 'astra-addon' ),
						'section'   => 'section-learndash',
						'transport' => 'postMessage',
						'priority'  => 41,
					),

					/**
					 * Option: Separator Color
					 */
					array(
						'name'     => ASTRA_THEME_SETTINGS . '[learndash-table-title-separator-color]',
						'default'  => astra_get_option( 'learndash-table-title-separator-color' ),
						'type'     => 'control',
						'section'  => 'section-learndash',
						'control'  => 'ast-color',
						'title'    => __( 'Separator Color', 'astra-addon' ),
						'priority' => 41,
					),

					/**
					 * Option: Heading Color
					 */
					array(
						'name'     => 'learndash-table-heading-color',
						'default'  => astra_get_option( 'learndash-table-heading-color' ),
						'type'     => 'sub-control',
						'section'  => 'section-learndash',
						'parent'   => ASTRA_THEME_SETTINGS . '[learndash-heading-color-group]',
						'control'  => 'ast-color',
						'title'    => __( 'Normal', 'astra-addon' ),
						'priority' => 10,
					),

					/**
					 * Option: Heading Background Color
					 */
					array(
						'name'     => 'learndash-table-heading-bg-color',
						'default'  => astra_get_option( 'learndash-table-heading-bg-color' ),
						'type'     => 'sub-control',
						'section'  => 'section-learndash',
						'parent'   => ASTRA_THEME_SETTINGS . '[learndash-heading-color-group]',
						'control'  => 'ast-color',
						'title'    => __( 'Background', 'astra-addon' ),
						'priority' => 15,
					),

					/**
					 * Option: Title Color
					 */
					array(
						'name'     => 'learndash-table-title-color',
						'default'  => astra_get_option( 'learndash-table-title-color' ),
						'type'     => 'sub-control',
						'section'  => 'section-learndash',
						'parent'   => ASTRA_THEME_SETTINGS . '[learndash-title-color-group]',
						'control'  => 'ast-color',
						'title'    => __( 'Normal', 'astra-addon' ),
						'priority' => 20,
					),

					/**
					 * Option: Title Background Color
					 */
					array(
						'name'     => 'learndash-table-title-bg-color',
						'default'  => astra_get_option( 'learndash-table-title-bg-color' ),
						'type'     => 'sub-control',
						'section'  => 'section-learndash',
						'parent'   => ASTRA_THEME_SETTINGS . '[learndash-title-color-group]',
						'control'  => 'ast-color',
						'title'    => __( 'Background', 'astra-addon' ),
						'priority' => 25,
					),

					/**
					 * Option: Complete Icon Color
					 */
					array(
						'name'     => 'learndash-complete-icon-color',
						'default'  => astra_get_option( 'learndash-complete-icon-color' ),
						'type'     => 'sub-control',
						'section'  => 'section-learndash',
						'parent'   => ASTRA_THEME_SETTINGS . '[learndash-icon-color-group]',
						'control'  => 'ast-color',
						'title'    => __( 'Complete', 'astra-addon' ),
						'priority' => 35,
					),

					/**
					 * Option: Incomplete Icon Color
					 */
					array(
						'name'     => 'learndash-incomplete-icon-color',
						'default'  => astra_get_option( 'learndash-incomplete-icon-color' ),
						'type'     => 'sub-control',
						'section'  => 'section-learndash',
						'parent'   => ASTRA_THEME_SETTINGS . '[learndash-icon-color-group]',
						'control'  => 'ast-color',
						'title'    => __( 'Incomplete', 'astra-addon' ),
						'priority' => 40,
					),
				);

			} else {

				$_configs = array(

					array(
						'name'     => ASTRA_THEME_SETTINGS . '[learndash-overwrite-colors]',
						'type'     => 'control',
						'control'  => Astra_Theme_Extension::$switch_control,
						'section'  => 'section-learndash',
						'title'    => __( 'Check this if you wish to overwrite LearnDash Colors', 'astra-addon' ),
						'default'  => astra_get_option( 'learndash-overwrite-colors' ),
						'priority' => 41,
					),

					array(
						'name'     => ASTRA_THEME_SETTINGS . '[learndash-profile-link-enabled]',
						'default'  => astra_get_option( 'learndash-profile-link-enabled' ),
						'type'     => 'control',
						'section'  => 'section-learndash',
						'title'    => __( 'Display Student\'s Gravatar in Primary Header', 'astra-addon' ),
						'priority' => 10,
						'control'  => Astra_Theme_Extension::$switch_control,
					),

					array(
						'name'     => ASTRA_THEME_SETTINGS . '[learndash-profile-link]',
						'default'  => astra_get_option( 'learndash-profile-link' ),
						'type'     => 'control',
						'control'  => 'text',
						'section'  => 'section-learndash',
						'title'    => __( 'Profile Picture Links to:', 'astra-addon' ),
						'priority' => 15,
						'context'  => array(
							astra_addon_builder_helper()->general_tab_config,
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[learndash-profile-link-enabled]',
								'operator' => '==',
								'value'    => true,
							),
						),
					),

					/**
					 * Group: Learndash Colors Group
					 */
					array(
						'name'     => ASTRA_THEME_SETTINGS . '[ldv3-color-group]',
						'default'  => astra_get_option( 'ldv3-color-group' ),
						'type'     => 'control',
						'control'  => 'ast-settings-group',
						'title'    => __( 'Colors', 'astra-addon' ),
						'section'  => 'section-learndash',
						'priority' => 41,
						'context'  => array(
							astra_addon_builder_helper()->general_tab_config,
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[learndash-overwrite-colors]',
								'operator' => '!=',
								'value'    => 0,
							),
						),
					),

					/**
					 * Option: Heading Color
					 */
					array(
						'name'     => 'learndash-course-link-color',
						'default'  => astra_get_option( 'learndash-course-link-color' ),
						'parent'   => ASTRA_THEME_SETTINGS . '[ldv3-color-group]',
						'type'     => 'sub-control',
						'section'  => 'section-learndash',
						'control'  => 'ast-color',
						'title'    => __( 'Link Color', 'astra-addon' ),
						'priority' => 10,
					),
					array(
						'name'     => 'learndash-course-highlight-color',
						'default'  => astra_get_option( 'learndash-course-highlight-color' ),
						'parent'   => ASTRA_THEME_SETTINGS . '[ldv3-color-group]',
						'type'     => 'sub-control',
						'control'  => 'ast-color',
						'title'    => __( 'Highlight Color', 'astra-addon' ),
						'section'  => 'section-learndash',
						'priority' => 10,
					),
					array(
						'name'     => 'learndash-course-highlight-text-color',
						'default'  => astra_get_option( 'learndash-course-highlight-text-color' ),
						'parent'   => ASTRA_THEME_SETTINGS . '[ldv3-color-group]',
						'type'     => 'sub-control',
						'control'  => 'ast-color',
						'title'    => __( 'Highlight Text Color', 'astra-addon' ),
						'section'  => 'section-learndash',
						'priority' => 10,
						'context'  => array(
							astra_addon_builder_helper()->general_tab_config,
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[learndash-overwrite-colors]',
								'operator' => '!=',
								'value'    => 0,
							),
						),
					),
					array(
						'name'     => 'learndash-course-progress-color',
						'default'  => astra_get_option( 'learndash-course-progress-color' ),
						'parent'   => ASTRA_THEME_SETTINGS . '[ldv3-color-group]',
						'type'     => 'sub-control',
						'control'  => 'ast-color',
						'title'    => __( 'Progress Color', 'astra-addon' ),
						'section'  => 'section-learndash',
						'priority' => 10,
						'context'  => array(
							astra_addon_builder_helper()->general_tab_config,
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[learndash-overwrite-colors]',
								'operator' => '!=',
								'value'    => 0,
							),
						),
					),
				);
			}

			return array_merge( $configurations, $_configs );
		}
	}
}

/**
 * Kicking this off by calling 'get_instance()' method
 */
new Astra_Customizer_Learndash_Color_Configs();
