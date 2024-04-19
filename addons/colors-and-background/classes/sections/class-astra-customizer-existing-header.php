<?php
/**
 * Colors Header Options for our theme.
 *
 * @package     Astra Addon
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
if ( ! class_exists( 'Astra_Customizer_Existing_Header' ) ) {

	/**
	 * Register General Customizer Configurations.
	 */
	// @codingStandardsIgnoreStart
	class Astra_Customizer_Existing_Header extends Astra_Customizer_Config_Base {
		// @codingStandardsIgnoreEnd

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
				array(
					'name'       => ASTRA_THEME_SETTINGS . '[header-bg-obj-responsive]',
					'section'    => 'section-header',
					'type'       => 'control',
					'control'    => 'ast-responsive-background',
					'transport'  => 'postMessage',
					'data_attrs' => array(
						'name' => 'header-bg-obj-responsive',
					),
					'default'    => astra_get_option( 'header-bg-obj-responsive' ),
					'label'      => __( 'Background', 'astra-addon' ),
					'priority'   => 71,
					'divider'    => array( 'ast_class' => 'ast-bottom-divider' ),
				),
			);

			return array_merge( $configurations, $_configs );
		}
	}
}

/**
 * Kicking this off by calling 'get_instance()' method
 */
new Astra_Customizer_Existing_Header();
