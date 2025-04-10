<?php
/**
 * Astra Addon Customizer Configuration Off Canvas.
 *
 * @package     astra-addon
 * @link        https://wpastra.com/
 * @since       3.3.0
 */

// No direct access, please.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register Off Canvas Customizer Configurations.
 *
 * @since 3.3.0
 */
class Astra_Addon_Offcanvas_Configs extends Astra_Customizer_Config_Base {
	/**
	 * Register Builder Above Customizer Configurations.
	 *
	 * @param Array                $configurations Astra Customizer Configurations.
	 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
	 * @since 3.3.0
	 * @return Array Astra Customizer Configurations with updated configurations.
	 */
	public function register_configuration( $configurations, $wp_customize ) {

		$_section = 'section-popup-header-builder';

		$_configs = array(

			/**
			 * Option: Popup Width.
			 */
			array(
				'name'        => ASTRA_THEME_SETTINGS . '[off-canvas-width]',
				'section'     => $_section,
				'priority'    => 32,
				'transport'   => 'postMessage',
				'default'     => astra_get_option( 'off-canvas-width' ),
				'title'       => __( 'Popup Width ( % )', 'astra-addon' ),
				'type'        => 'control',
				'control'     => 'ast-responsive-slider',
				'input_attrs' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 100,
				),
				'context'     => array(
					astra_addon_builder_helper()->general_tab_config,
					array(
						'setting'  => ASTRA_THEME_SETTINGS . '[mobile-header-type]',
						'operator' => '==',
						'value'    => 'off-canvas',
					),
				),
			),

		);

		return array_merge( $configurations, $_configs );
	}
}

/**
 * Kicking this off by creating object of this class.
 */
new Astra_Addon_Offcanvas_Configs();
