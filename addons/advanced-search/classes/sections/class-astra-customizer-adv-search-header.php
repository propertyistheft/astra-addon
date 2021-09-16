<?php
/**
 * Primary Header
 *
 * @package     Astra Addon
 * @author      Brainstorm Force
 * @copyright   Copyright (c) 2020, Brainstorm Force
 * @link        https://www.brainstormforce.com
 * @since       1.4.8
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
 * @since 1.4.8
 */
if ( ! class_exists( 'Astra_Customizer_Adv_Search_Header' ) ) {

	/**
	 * Register General Customizer Configurations.
	 */
	class Astra_Customizer_Adv_Search_Header extends Astra_Customizer_Config_Base {

		/**
		 * Register General Customizer Configurations.
		 *
		 * @param Array                $configurations Astra Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.8
		 * @return Array Astra Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_configs = array(

				// Option: Header Search Style.
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[header-main-rt-section-search-box-type]',
					'default'  => astra_get_option( 'header-main-rt-section-search-box-type' ),
					'section'  => 'section-primary-menu',
					'priority' => 20,
					'title'    => __( 'Search Style', 'astra-addon' ),
					'type'     => 'control',
					'control'  => 'ast-select',
					'choices'  => array(
						'slide-search' => __( 'Slide Search', 'astra-addon' ),
						'full-screen'  => __( 'Full Screen Search', 'astra-addon' ),
						'header-cover' => __( 'Header Cover Search', 'astra-addon' ),
						'search-box'   => __( 'Search Box', 'astra-addon' ),
					),
					'context'  => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[header-main-rt-section]',
							'operator' => '==',
							'value'    => 'search',
						),
					),
					'divider'  => array( 'ast_class' => 'ast-top-divider' ),
				),

			);

			return array_merge( $configurations, $_configs );
		}
	}
}

/**
 * Kicking this off by calling 'get_instance()' method
 */
new Astra_Customizer_Adv_Search_Header();
