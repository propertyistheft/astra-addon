<?php
/**
 * Astra Theme Header Builder's Color Switcher Widget Customizer Configurations.
 *
 * @package     astra-builder
 * @link        https://wpastra.com/
 * @since       4.10.0
 */

// No direct access, please.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Astra_Customizer_Config_Base' ) ) {
	return;
}

/**
 * Register Header Builder's Color Switcher Widget Customizer Configurations.
 *
 * @since 4.10.0
 */
class Astra_Header_Color_Switcher_Configs extends Astra_Customizer_Config_Base {
	/**
	 * Register Header Builder's Color Switcher Widget Customizer Configurations.
	 *
	 * @param Array                $configurations Astra Customizer Configurations.
	 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
	 * @since 4.10.0
	 * @return Array Astra Customizer Configurations with updated configurations.
	 */
	public function register_configuration( $configurations, $wp_customize ) {
		return Astra_Color_Switcher_Component_Configs::register_configuration( $configurations, 'header', 'section-hb-color-switcher' );
	}
}

/**
 * Kicking this off by creating object of this class.
 */
new Astra_Header_Color_Switcher_Configs();
