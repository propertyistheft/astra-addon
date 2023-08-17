<?php
/**
 * Advanced Footer - Panels & Sections
 *
 * @package Astra Addon
 */

// Block direct access to the file.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Bail if Customizer config base class does not exist.
if ( ! class_exists( 'Astra_Customizer_Config_Base' ) ) {
	return;
}

if ( ! class_exists( 'Astra_Advanced_Footer_Panels_Configs' ) ) {

	/**
	 * Register Advanced Footer Layout Customizer Configurations.
	 */
	// @codingStandardsIgnoreStart
	class Astra_Advanced_Footer_Panels_Configs extends Astra_Customizer_Config_Base {
		// @codingStandardsIgnoreEnd

		/**
		 * Register Advanced Footer Layout Customizer Configurations.
		 *
		 * @param Array                $configurations Astra Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array Astra Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_config = array(

				array(
					'name'     => 'section-footer-adv',
					'type'     => 'section',
					'title'    => __( 'Footer Widgets', 'astra-addon' ),
					'section'  => 'section-footer-group',
					'priority' => 5,
				),
			);

			return array_merge( $configurations, $_config );
		}

	}
}

new Astra_Advanced_Footer_Panels_Configs();
