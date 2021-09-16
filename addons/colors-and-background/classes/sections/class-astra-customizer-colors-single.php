<?php
/**
 * Colors Single Options for our theme.
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
if ( ! class_exists( 'Astra_Customizer_Colors_Single' ) ) {

	/**
	 * Register General Customizer Configurations.
	 */
	class Astra_Customizer_Colors_Single extends Astra_Customizer_Config_Base {

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

				// Option: Single Post / Page Title Color.
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[entry-title-color]',
					'type'      => 'control',
					'control'   => 'ast-color',
					'default'   => astra_get_option( 'entry-title-color' ),
					'transport' => 'postMessage',
					'title'     => __( 'Post / Page Title Color', 'astra-addon' ),
					'section'   => 'section-blog-single',
					'divider'   => array( 'ast_class' => 'ast-bottom-divider' ),
					'priority'  => ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) ?
					12 : 19,
					'context'   => ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) ?
						astra_addon_builder_helper()->design_tab : astra_addon_builder_helper()->general_tab,
				),

			);

			if ( false === astra_addon_builder_helper()->is_header_footer_builder_active ) {

				$_new_config = array(
					/**
					 * Option: Divider
					 */
					array(
						'name'     => ASTRA_THEME_SETTINGS . '[divider-section-entry-color]',
						'type'     => 'control',
						'control'  => 'ast-heading',
						'section'  => 'section-blog-single',
						'priority' => 18,
						'title'    => __( 'Color', 'astra-addon' ),
						'context'  => astra_addon_builder_helper()->general_tab,
					),
				);

				$_configs = array_merge( $_configs, $_new_config );
			}

			return array_merge( $configurations, $_configs );
		}
	}
}

/**
 * Kicking this off by calling 'get_instance()' method
 */
new Astra_Customizer_Colors_Single();
