<?php
/**
 * Astra Theme Customizer Configuration Base.
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

if ( ! class_exists( 'Astra_Ext_Colors_Panels_And_Sections' ) ) {

	/**
	 * Register Blog Pro Panels and sections Customizer Configurations.
	 */
	class Astra_Ext_Colors_Panels_And_Sections extends Astra_Customizer_Config_Base {

		/**
		 * Register Blog Pro Panels and sections Customizer Configurations.
		 *
		 * @param Array                $configurations Astra Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array Astra Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_configs = array(

				/**
				 * Colors & Background - Panels & Sections
				 */
				array(
					'name'     => 'section-colors-content',
					'type'     => 'section',
					'title'    => __( 'Content', 'astra-addon' ),
					'panel'    => 'panel-global',
					'section'  => 'section-colors-background',
					'priority' => 35,
				),
				array(
					'name'     => 'section-colors-header',
					'type'     => 'section',
					'title'    => __( 'Header', 'astra-addon' ),
					'panel'    => 'panel-colors-background',
					'priority' => 20,
				),
			);

			return array_merge( $configurations, $_configs );
		}
	}
}

/**
 * Kicking this off by calling 'get_instance()' method
 */
new Astra_Ext_Colors_Panels_And_Sections();
