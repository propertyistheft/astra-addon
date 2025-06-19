<?php
/**
 * Astra Addon Base Configuration.
 *
 * @package astra-builder
 */

// No direct access, please.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Astra_Addon_Base_Configs.
 * 
 * Handles base configurations for Astra Addon builder elements.
 * Provides methods to generate common configuration arrays for customizer controls.
 */
class Astra_Addon_Base_Configs {
	/**
	 * Prepare Box Shadow options.
	 *
	 * @param string $_section section id.
	 * @param string $_prefix Control Prefix.
	 * @param int    $priority Priority.
	 * @param array  $context Context array. Since 4.11.0.
	 *
	 * @since 3.3.0
	 * @return array
	 */
	public static function prepare_box_shadow_tab( $_section, $_prefix, $priority = 90, $context = array() ) {

		// If context is empty, set it to the design tab.
		if ( empty( $context ) ) {
			$context = astra_addon_builder_helper()->design_tab;
		}

		return array(
			/**
			 * Option: Box Shadow Heading
			 */
			array(
				'name'     => ASTRA_THEME_SETTINGS . '[' . $_prefix . '-box-shadow-heading]',
				'type'     => 'control',
				'control'  => 'ast-heading',
				'section'  => $_section,
				'title'    => __( 'Box Shadow', 'astra-addon' ),
				'priority' => $priority,
				'context'  => $context,
				'divider'  => array( 'ast_class' => 'ast-top-section-divider' ),
			),

			/**
			 * Option: box shadow
			 */
			array(
				'name'              => ASTRA_THEME_SETTINGS . '[' . $_prefix . '-box-shadow-control]',
				'default'           => astra_get_option( $_prefix . '-box-shadow-control' ),
				'type'              => 'control',
				'transport'         => 'postMessage',
				'control'           => 'ast-box-shadow',
				'section'           => $_section,
				'sanitize_callback' => array( 'Astra_Addon_Customizer', 'sanitize_box_shadow' ),
				'priority'          => $priority,
				'title'             => __( 'Value', 'astra-addon' ),
				'choices'           => array(
					'x'      => __( 'X', 'astra-addon' ),
					'y'      => __( 'Y', 'astra-addon' ),
					'blur'   => __( 'Blur', 'astra-addon' ),
					'spread' => __( 'Spread', 'astra-addon' ),
				),
				'context'           => $context,
			),

			array(
				'name'      => ASTRA_THEME_SETTINGS . '[' . $_prefix . '-box-shadow-position]',
				'default'   => astra_get_option( $_prefix . '-box-shadow-position' ),
				'type'      => 'control',
				'section'   => $_section,
				'transport' => 'postMessage',
				'control'   => 'ast-select',
				'title'     => __( 'Position', 'astra-addon' ),
				'choices'   => array(
					'outline' => __( 'Outline', 'astra-addon' ),
					'inset'   => __( 'Inset', 'astra-addon' ),
				),
				'priority'  => $priority,
				'context'   => $context,
			),

			array(
				'name'      => ASTRA_THEME_SETTINGS . '[' . $_prefix . '-box-shadow-color]',
				'default'   => astra_get_option( $_prefix . '-box-shadow-color' ),
				'type'      => 'control',
				'section'   => $_section,
				'transport' => 'postMessage',
				'control'   => 'ast-color',
				'title'     => __( 'Color', 'astra-addon' ),
				'rgba'      => true,
				'priority'  => $priority,
				'context'   => $context,
			),
		);
	}

}

new Astra_Addon_Base_Configs();
