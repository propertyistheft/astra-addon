<?php
/**
 * Astra Addon Customizer Configuration for Menu.
 *
 * @package     Astra Addon
 * @link        https://wpastra.com/
 * @since       3.3.0
 */

// No direct access, please.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register Builder Customizer Configurations.
 *
 * @since 3.3.0
 */
class Astra_Addon_Header_Menu_Component_Configs extends Astra_Customizer_Config_Base {
	/**
	 * Register Builder Customizer Configurations.
	 *
	 * @param Array                $configurations Astra Customizer Configurations.
	 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
	 * @since 3.3.0
	 * @return Array Astra Customizer Configurations with updated configurations.
	 */
	public function register_configuration( $configurations, $wp_customize ) {

		$html_config     = array();
		$component_limit = astra_addon_builder_helper()->component_limit;

		for ( $index = 1; $index <= $component_limit; $index++ ) {

			$_section = 'section-hb-menu-' . $index;
			$_prefix  = 'menu' . $index;

			$html_config[] = Astra_Addon_Base_Configs::prepare_box_shadow_tab( $_section, 'header-' . $_prefix, 100 );

		}

		$html_config = call_user_func_array( 'array_merge', $html_config + array( array() ) );
		return array_merge( $configurations, $html_config );
	}
}

/**
 * Kicking this off by creating object of this class.
 */

new Astra_Addon_Header_Menu_Component_Configs();
