<?php
/**
 * Below Header
 *
 * @package     Astra Addon
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
if ( ! class_exists( 'Astra_Customizer_Adv_Search_Below_Header' ) ) {

	/**
	 * Register General Customizer Configurations.
	 */
	// @codingStandardsIgnoreStart
	class Astra_Customizer_Adv_Search_Below_Header extends Astra_Customizer_Config_Base {
		// @codingStandardsIgnoreEnd

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

				// Option: Below Header Section 1 Search Style.
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[below-header-section-1-search-box-type]',
					'default'  => astra_get_option( 'below-header-section-1-search-box-type' ),
					'section'  => 'section-below-header',
					'priority' => 26,
					'title'    => __( 'Search Style', 'astra-addon' ),
					'type'     => 'control',
					'control'  => 'ast-select',
					'choices'  => array(
						'slide-search' => __( 'Slide', 'astra-addon' ),
						'full-screen'  => __( 'Full Screen', 'astra-addon' ),
						'header-cover' => __( 'Header Cover', 'astra-addon' ),
						'search-box'   => __( 'Search Box', 'astra-addon' ),
					),
					'context'  => array(
						( true === astra_addon_builder_helper()->is_header_footer_builder_active ) ?
						astra_addon_builder_helper()->design_tab_config : astra_addon_builder_helper()->general_tab_config,
						'relation' => 'AND',
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[below-header-layout]',
							'operator' => '!=',
							'value'    => 'disabled',
						),
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[below-header-section-1]',
							'operator' => '==',
							'value'    => 'search',
						),
					),
				),

				// Option: Below Header Section 2 Search Style.
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[below-header-section-2-search-box-type]',
					'default'  => astra_get_option( 'below-header-section-2-search-box-type' ),
					'section'  => 'section-below-header',
					'priority' => 46,
					'title'    => __( 'Search Style', 'astra-addon' ),
					'type'     => 'control',
					'control'  => 'ast-select',
					'choices'  => array(
						'slide-search' => __( 'Slide', 'astra-addon' ),
						'full-screen'  => __( 'Full Screen', 'astra-addon' ),
						'header-cover' => __( 'Header Cover', 'astra-addon' ),
						'search-box'   => __( 'Search Box', 'astra-addon' ),
					),
					'context'  => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[below-header-layout]',
							'operator' => '==',
							'value'    => 'below-header-layout-1',
						),
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[below-header-section-2]',
							'operator' => '==',
							'value'    => 'search',
						),

					),
				),
			);

			return array_merge( $configurations, $_configs );
		}
	}
}

/**
 * Kicking this off by calling 'get_instance()' method
 */
new Astra_Customizer_Adv_Search_Below_Header();
