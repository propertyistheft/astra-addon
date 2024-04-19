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
 */
class Astra_Addon_Base_Configs {

	/**
	 * Prepare Box Shadow options.
	 *
	 * @param string  $_section section id.
	 * @param string  $_prefix Control Prefix.
	 * @param integer $priority Priority.
	 * @since 3.3.0
	 * @return array
	 */
	public static function prepare_box_shadow_tab( $_section, $_prefix, $priority = 90 ) {

		$configs = array(

			// Option Group: Box shadow Group.
			array(
				'name'      => ASTRA_THEME_SETTINGS . '[' . $_prefix . '-shadow-group]',
				'type'      => 'control',
				'control'   => 'ast-settings-group',
				'title'     => __( 'Box Shadow', 'astra-addon' ),
				'section'   => $_section,
				'transport' => 'postMessage',
				'priority'  => $priority,
				'context'   => astra_addon_builder_helper()->design_tab,
				'divider'   => array( 'ast_class' => 'ast-top-section-divider' ),
			),

			/**
			 * Option: box shadow
			 */
			array(
				'name'              => $_prefix . '-box-shadow-control',
				'default'           => astra_get_option( $_prefix . '-box-shadow-control' ),
				'parent'            => ASTRA_THEME_SETTINGS . '[' . $_prefix . '-shadow-group]',
				'type'              => 'sub-control',
				'transport'         => 'postMessage',
				'control'           => 'ast-box-shadow',
				'section'           => $_section,
				'sanitize_callback' => array( 'Astra_Addon_Customizer', 'sanitize_box_shadow' ),
				'priority'          => 1,
				'title'             => __( 'Value', 'astra-addon' ),
				'choices'           => array(
					'x'      => __( 'X', 'astra-addon' ),
					'y'      => __( 'Y', 'astra-addon' ),
					'blur'   => __( 'Blur', 'astra-addon' ),
					'spread' => __( 'Spread', 'astra-addon' ),
				),
				'context'           => astra_addon_builder_helper()->general_tab,
			),

			array(
				'name'      => $_prefix . '-box-shadow-position',
				'default'   => astra_get_option( $_prefix . '-box-shadow-position' ),
				'parent'    => ASTRA_THEME_SETTINGS . '[' . $_prefix . '-shadow-group]',
				'type'      => 'sub-control',
				'section'   => $_section,
				'transport' => 'postMessage',
				'control'   => 'ast-select',
				'title'     => __( 'Position', 'astra-addon' ),
				'choices'   => array(
					'outline' => __( 'Outline', 'astra-addon' ),
					'inset'   => __( 'Inset', 'astra-addon' ),
				),
				'priority'  => 2,
				'context'   => astra_addon_builder_helper()->general_tab,
			),

			array(
				'name'      => $_prefix . '-box-shadow-color',
				'default'   => astra_get_option( $_prefix . '-box-shadow-color' ),
				'parent'    => ASTRA_THEME_SETTINGS . '[' . $_prefix . '-shadow-group]',
				'type'      => 'sub-control',
				'section'   => $_section,
				'transport' => 'postMessage',
				'control'   => 'ast-color',
				'title'     => __( 'Color', 'astra-addon' ),
				'rgba'      => true,
				'priority'  => 3,
				'context'   => astra_addon_builder_helper()->general_tab,
			),
		);

		return $configs;
	}

}

new Astra_Addon_Base_Configs();
