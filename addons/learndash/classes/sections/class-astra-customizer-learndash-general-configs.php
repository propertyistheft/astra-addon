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
if ( ! class_exists( 'Astra_Customizer_Learndash_General_Configs' ) ) {

	/**
	 * Register General Customizer Configurations.
	 */
	class Astra_Customizer_Learndash_General_Configs extends Astra_Customizer_Config_Base {

		/**
		 * Register General Customizer Configurations.
		 *
		 * @param Array                $configurations Astra Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array Astra Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_configs = array(

				/**
				 * Option: Distraction Free Learning
				 */
				array(
					'name'        => ASTRA_THEME_SETTINGS . '[learndash-distraction-free-learning]',
					'default'     => astra_get_option( 'learndash-distraction-free-learning' ),
					'type'        => 'control',
					'section'     => 'section-learndash',
					'title'       => __( 'Enable Distraction Free Learning', 'astra-addon' ),
					'description' => __( 'Remove extra links in the header and footer in LearnDash learning pages', 'astra-addon' ),
					'priority'    => 5,
					'control'     => Astra_Theme_Extension::$switch_control,
					'divider'     => array( 'ast_class' => 'ast-bottom-divider' ),
				),

				/**
				 * Option: Enable Header Profile Link
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[learndash-profile-link-enabled]',
					'default'  => astra_get_option( 'learndash-profile-link-enabled' ),
					'type'     => 'control',
					'section'  => 'section-learndash',
					'title'    => __( 'Display Student\'s Gravatar in Primary Header', 'astra-addon' ),
					'priority' => 10,
					'control'  => Astra_Theme_Extension::$switch_control,
				),

				/**
				 * Option: Profile Link
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[learndash-profile-link]',
					'default'  => astra_get_option( 'learndash-profile-link' ),
					'type'     => 'control',
					'control'  => 'text',
					'section'  => 'section-learndash',
					'title'    => __( 'Profile Picture Links to:', 'astra-addon' ),
					'priority' => 15,
					'divider'  => array( 'ast_class' => 'ast-bottom-divider' ),
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
				 * Option: Table Border Radius
				 */
				array(
					'name'        => ASTRA_THEME_SETTINGS . '[learndash-table-border-radius]',
					'default'     => astra_get_option( 'learndash-table-border-radius' ),
					'type'        => 'control',
					'transport'   => 'postMessage',
					'control'     => 'ast-slider',
					'title'       => __( 'Table Border Radius', 'astra-addon' ),
					'section'     => 'section-learndash',
					'suffix'      => 'px',
					'priority'    => 35,
					'divider'     => array(
						'ast_class' => 'ast-top-divider',
					),
					'input_attrs' => array(
						'min'  => 0,
						'step' => 1,
						'max'  => 50,
					),
				),
			);

			return array_merge( $configurations, $_configs );
		}
	}
}

/**
 * Kicking this off by calling 'get_instance()' method
 */
new Astra_Customizer_Learndash_General_Configs();
