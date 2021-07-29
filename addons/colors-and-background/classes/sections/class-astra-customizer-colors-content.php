<?php
/**
 * Blog Pro General Options for our theme.
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
if ( ! class_exists( 'Astra_Customizer_Colors_Content' ) ) {

	/**
	 * Register General Customizer Configurations.
	 */
	class Astra_Customizer_Colors_Content extends Astra_Customizer_Config_Base {

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

				// Option: Content Background Color.
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[content-bg-obj-responsive]',
					'default'   => astra_get_option( 'content-bg-obj-responsive' ),
					'type'      => 'control',
					'control'   => 'ast-responsive-background',
					'label'     => __( 'Background', 'astra-addon' ),
					'section'   => 'section-colors-content',
					'transport' => 'postMessage',
					'divider'   => array( 'ast_class' => 'ast-bottom-divider' ),
				),

				// Option: Heading 1 <h1> Color.
				array(
					'default'           => astra_get_option( 'h1-color' ),
					'type'              => 'control',
					'control'           => 'ast-color',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
					'transport'         => 'postMessage',
					'name'              => ASTRA_THEME_SETTINGS . '[h1-color]',
					'title'             => __( 'Heading 1', 'astra-addon' ),
					'section'           => 'section-colors-content',
				),

				// Option: Heading 2 <h2> Color.
				array(
					'default'           => astra_get_option( 'h2-color' ),
					'type'              => 'control',
					'control'           => 'ast-color',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
					'transport'         => 'postMessage',
					'name'              => ASTRA_THEME_SETTINGS . '[h2-color]',
					'title'             => __( 'Heading 2', 'astra-addon' ),
					'section'           => 'section-colors-content',
				),

				// Option: Heading 3 <h3> Color.
				array(
					'type'              => 'control',
					'control'           => 'ast-color',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
					'transport'         => 'postMessage',
					'name'              => ASTRA_THEME_SETTINGS . '[h3-color]',
					'default'           => astra_get_option( 'h3-color' ),
					'title'             => __( 'Heading 3', 'astra-addon' ),
					'section'           => 'section-colors-content',
				),

				// Option: Heading 4 <h4> Color.
				array(
					'type'              => 'control',
					'control'           => 'ast-color',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
					'transport'         => 'postMessage',
					'default'           => astra_get_option( 'h4-color' ),
					'name'              => ASTRA_THEME_SETTINGS . '[h4-color]',
					'title'             => __( 'Heading 4', 'astra-addon' ),
					'section'           => 'section-colors-content',
				),

				// Option: Heading 5 <h5> Color.
				array(
					'type'              => 'control',
					'control'           => 'ast-color',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
					'default'           => astra_get_option( 'h5-color' ),
					'transport'         => 'postMessage',
					'name'              => ASTRA_THEME_SETTINGS . '[h5-color]',
					'title'             => __( 'Heading 5', 'astra-addon' ),
					'section'           => 'section-colors-content',
				),

				// Option: Heading 6 <h6> Color.
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[h6-color]',
					'type'              => 'control',
					'control'           => 'ast-color',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
					'transport'         => 'postMessage',
					'default'           => astra_get_option( 'h6-color' ),
					'title'             => __( 'Heading 6', 'astra-addon' ),
					'section'           => 'section-colors-content',
				),

			);

			return array_merge( $configurations, $_configs );
		}
	}
}

/**
 * Kicking this off by calling 'get_instance()' method
 */
new Astra_Customizer_Colors_Content();
