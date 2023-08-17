<?php
/**
 * Astra Theme Customizer Configuration Builder.
 *
 * @package     astra-addon
 * @link        https://wpastra.com/
 * @since       3.0.0
 */

// No direct access, please.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Astra_Customizer_Config_Base' ) ) {
	return;
}

/**
 * Register Builder Customizer Configurations.
 *
 * @since 3.0.0
 */
// @codingStandardsIgnoreStart
class Astra_Customizer_Adv_Search_Configs extends Astra_Customizer_Config_Base {
	// @codingStandardsIgnoreEnd

	/**
	 * Register Builder Customizer Configurations.
	 *
	 * @param Array                $configurations Astra Customizer Configurations.
	 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
	 * @since 3.0.0
	 * @return Array Astra Customizer Configurations with updated configurations.
	 */
	public function register_configuration( $configurations, $wp_customize ) {

		$_section = 'section-header-search';

		/**
		 * Option: Pro Search Bar Configs.
		 */
		$_configs = array(
			// Option: Header Search Style.
			array(
				'name'      => ASTRA_THEME_SETTINGS . '[header-search-box-type]',
				'default'   => astra_get_option( 'header-search-box-type' ),
				'section'   => $_section,
				'priority'  => 1,
				'title'     => __( 'Search Style', 'astra-addon' ),
				'type'      => 'control',
				'control'   => 'ast-select',
				'choices'   => array(
					'slide-search' => __( 'Slide Search', 'astra-addon' ),
					'full-screen'  => __( 'Full Screen Search', 'astra-addon' ),
					'header-cover' => __( 'Header Cover Search', 'astra-addon' ),
					'search-box'   => __( 'Search Box', 'astra-addon' ),
				),
				'context'   => astra_addon_builder_helper()->general_tab,
				'transport' => 'postMessage',
				'partial'   => array(
					'selector'            => '.ast-header-search',
					'container_inclusive' => false,
					'render_callback'     => array( Astra_Ext_Adv_Search_Markup::get_instance(), 'get_search_markup' ),
				),
				'divider'   => array( 'ast_class' => 'ast-section-spacing' ),
			),

			/**
			 * Option: search placeholder text.
			 */
			array(
				'name'      => ASTRA_THEME_SETTINGS . '[header-search-box-placeholder]',
				'default'   => astra_get_option( 'header-search-box-placeholder' ),
				'section'   => $_section,
				'priority'  => 3,
				'title'     => __( 'Placeholder Text', 'astra-addon' ),
				'type'      => 'control',
				'control'   => 'text',
				'transport' => 'postMessage',
				'partial'   => array(
					'selector'            => '.ast-header-search',
					'container_inclusive' => false,
					'render_callback'     => array( Astra_Ext_Adv_Search_Markup::get_instance(), 'get_search_markup' ),
				),
				'context'   => astra_addon_builder_helper()->general_tab,
				'divider'   => array( 'ast_class' => 'ast-top-section-divider ast-bottom-section-divider' ),
			),
		);

		return array_merge( $configurations, $_configs );
	}
}

/**
 * Kicking this off by creating object of this class.
 */

new Astra_Customizer_Adv_Search_Configs();

