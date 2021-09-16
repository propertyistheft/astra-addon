<?php
/**
 * Site Identity Spacing Options for our theme.
 *
 * @package     Astra
 * @author      Brainstorm Force
 * @copyright   Copyright (c) 2020, Brainstorm Force
 * @link        https://www.brainstormforce.com
 * @since       Astra 1.4.3
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
if ( ! class_exists( 'Astra_Customizer_Site_Identity_Spacing_Configs' ) ) {

	/**
	 * Register Site Identity Spacing Customizer Configurations.
	 */
	class Astra_Customizer_Site_Identity_Spacing_Configs extends Astra_Customizer_Config_Base {

		/**
		 * Register Site Identity Spacing Customizer Configurations.
		 *
		 * @param Array                $configurations Astra Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array Astra Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			if ( is_astra_theme_3_5_0_version() ) {

				$_configs = array(

					/**
					 * Option: Divider
					 */
					array(
						'name'     => ASTRA_THEME_SETTINGS . '[divider-section-site-identity-spacing]',
						'type'     => 'control',
						'control'  => 'ast-heading',
						'section'  => 'title_tagline',
						'title'    => __( 'Spacing', 'astra-addon' ),
						'context'  => array(
							'relation' => 'AND',
							astra_addon_builder_helper()->general_tab_config,
							array(
								'relation' => 'OR',
								array(
									'setting'  => ASTRA_THEME_SETTINGS . '[display-site-title]',
									'operator' => '!=',
									'value'    => 0,
								),
								array(
									'setting'  => 'custom_logo',
									'operator' => '!=',
									'value'    => '',
								),
							),
						),
						'priority' => 50,
						'settings' => array(),
					),

					/**
					 * Option - Header Space
					 */
					array(
						'name'              => ASTRA_THEME_SETTINGS . '[site-identity-spacing]',
						'default'           => astra_get_option( 'site-identity-spacing' ),
						'type'              => 'control',
						'transport'         => 'postMessage',
						'control'           => 'ast-responsive-spacing',
						'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_responsive_spacing' ),
						'section'           => 'title_tagline',
						'priority'          => 50,
						'title'             => __( 'Site Identity Space', 'astra-addon' ),
						'context'           => array(
							'relation' => 'AND',
							astra_addon_builder_helper()->general_tab_config,
							array(
								'relation' => 'OR',
								array(
									'setting'  => ASTRA_THEME_SETTINGS . '[display-site-title]',
									'operator' => '!=',
									'value'    => 0,
								),
								array(
									'setting'  => 'custom_logo',
									'operator' => '!=',
									'value'    => '',
								),
							),
						),
						'linked_choices'    => true,
						'unit_choices'      => array( 'px', 'em', '%' ),
						'choices'           => array(
							'top'    => __( 'Top', 'astra-addon' ),
							'right'  => __( 'Right', 'astra-addon' ),
							'bottom' => __( 'Bottom', 'astra-addon' ),
							'left'   => __( 'Left', 'astra-addon' ),
						),
					),
				);

			} else {
				$_configs = array(

					/**
					 * Option: Divider
					 */
					array(
						'name'     => ASTRA_THEME_SETTINGS . '[divider-section-site-identity-spacing]',
						'type'     => 'control',
						'control'  => 'ast-heading',
						'section'  => 'title_tagline',
						'title'    => __( 'Spacing', 'astra-addon' ),
						'context'  => array(
							'relation' => 'AND',
							astra_addon_builder_helper()->general_tab_config,
							array(
								'relation' => 'OR',
								array(
									'setting'     => ASTRA_THEME_SETTINGS . '[display-site-title-responsive]',
									'setting-key' => 'desktop',
									'operator'    => '!=',
									'value'       => 0,
								),
								array(
									'setting'     => ASTRA_THEME_SETTINGS . '[display-site-title-responsive]',
									'setting-key' => 'tablet',
									'operator'    => '!=',
									'value'       => 0,
								),
								array(
									'setting'     => ASTRA_THEME_SETTINGS . '[display-site-title-responsive]',
									'setting-key' => 'mobile',
									'operator'    => '!=',
									'value'       => 0,
								),
								array(
									'setting'  => 'custom_logo',
									'operator' => '!=',
									'value'    => '',
								),
							),
						),
						'priority' => 50,
						'settings' => array(),
					),

					/**
					 * Option - Header Space
					 */
					array(
						'name'              => ASTRA_THEME_SETTINGS . '[site-identity-spacing]',
						'default'           => astra_get_option( 'site-identity-spacing' ),
						'type'              => 'control',
						'transport'         => 'postMessage',
						'control'           => 'ast-responsive-spacing',
						'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_responsive_spacing' ),
						'section'           => 'title_tagline',
						'priority'          => 50,
						'title'             => __( 'Site Identity Space', 'astra-addon' ),
						'context'           => array(
							'relation' => 'AND',
							astra_addon_builder_helper()->general_tab_config,
							array(
								'relation' => 'OR',
								array(
									'setting'     => ASTRA_THEME_SETTINGS . '[display-site-title-responsive]',
									'setting-key' => 'desktop',
									'operator'    => '!=',
									'value'       => 0,
								),
								array(
									'setting'     => ASTRA_THEME_SETTINGS . '[display-site-title-responsive]',
									'setting-key' => 'tablet',
									'operator'    => '!=',
									'value'       => 0,
								),
								array(
									'setting'     => ASTRA_THEME_SETTINGS . '[display-site-title-responsive]',
									'setting-key' => 'mobile',
									'operator'    => '!=',
									'value'       => 0,
								),
								array(
									'setting'  => 'custom_logo',
									'operator' => '!=',
									'value'    => '',
								),
							),
						),
						'linked_choices'    => true,
						'unit_choices'      => array( 'px', 'em', '%' ),
						'choices'           => array(
							'top'    => __( 'Top', 'astra-addon' ),
							'right'  => __( 'Right', 'astra-addon' ),
							'bottom' => __( 'Bottom', 'astra-addon' ),
							'left'   => __( 'Left', 'astra-addon' ),
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
new Astra_Customizer_Site_Identity_Spacing_Configs();
