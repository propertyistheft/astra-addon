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
if ( ! class_exists( 'Astra_Customizer_Colors_Header' ) ) {

	/**
	 * Register General Customizer Configurations.
	 */
	// @codingStandardsIgnoreStart
	class Astra_Customizer_Colors_Header extends Astra_Customizer_Config_Base {
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

			if ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) {

				$_configs = array(
					/**
					 * Option: Search height
					 */
					array(
						'name'        => ASTRA_THEME_SETTINGS . '[header-search-height]',
						'section'     => 'section-header-search',
						'priority'    => 2,
						'transport'   => 'postMessage',
						'default'     => astra_get_option( 'header-search-height' ),
						'title'       => __( 'Search Height', 'astra-addon' ),
						'suffix'      => 'px',
						'type'        => 'control',
						'control'     => 'ast-responsive-slider',
						'input_attrs' => array(
							'min'  => 40,
							'step' => 1,
							'max'  => 100,
						),
						'divider'     => array( 'ast_class' => 'ast-top-dotted-divider' ),
						'context'     => array(
							astra_addon_builder_helper()->general_tab_config,
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[header-search-box-type]',
								'operator' => 'in',
								'value'    => array( 'slide-search', 'search-box' ),
							),
						),
					),
					/**
					 * Search Overlay Color
					 */
					array(
						'name'      => ASTRA_THEME_SETTINGS . '[header-search-overlay-color]',
						'default'   => astra_get_option( 'header-search-overlay-color' ),
						'type'      => 'control',
						'section'   => 'section-header-search',
						'priority'  => 9,
						'transport' => 'postMessage',
						'control'   => 'ast-color',
						'title'     => __( 'Overlay Background Color', 'astra-addon' ),
						'context'   => array(
							astra_addon_builder_helper()->design_tab_config,
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[header-search-box-type]',
								'operator' => 'in',
								'value'    => array( 'full-screen', 'header-cover' ),
							),
						),
					),
					/**
					 * Search Overlay Text Color
					 */
					array(
						'name'      => ASTRA_THEME_SETTINGS . '[header-search-overlay-text-color]',
						'default'   => astra_get_option( 'header-search-overlay-text-color' ),
						'type'      => 'control',
						'section'   => 'section-header-search',
						'priority'  => 9,
						'transport' => 'postMessage',
						'control'   => 'ast-color',
						'title'     => __( 'Overlay Text Color', 'astra-addon' ),
						'context'   => array(
							astra_addon_builder_helper()->design_tab_config,
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[header-search-box-type]',
								'operator' => 'in',
								'value'    => array( 'full-screen', 'header-cover' ),
							),
						),
					),
					array(
						'name'       => 'header-search-icon-h-color',
						'default'    => astra_get_option( 'header-search-icon-h-color' ),
						'type'       => 'sub-control',
						'parent'     => ASTRA_THEME_SETTINGS . '[header-search-icon-color-parent]',
						'section'    => 'section-header-search',
						'priority'   => 1,
						'transport'  => 'postMessage',
						'control'    => 'ast-responsive-color',
						'responsive' => true,
						'rgba'       => true,
						'title'      => __( 'Icon Hover Color', 'astra-addon' ),
						'context'    => astra_addon_builder_helper()->design_tab,
						'divider'    => array( 'ast_class' => 'ast-section-spacing' ),
					),
					/**
					 * Option: Search Color.
					 */
					array(
						'name'      => ASTRA_THEME_SETTINGS . '[header-search-bg-color-parent]',
						'default'   => astra_get_option( 'header-search-bg-color-parent' ),
						'type'      => 'control',
						'control'   => 'ast-color-group',
						'title'     => __( 'Box Background', 'astra-addon' ),
						'section'   => 'section-header-search',
						'transport' => 'postMessage',
						'priority'  => 9,
						'context'   => array(
							astra_addon_builder_helper()->design_tab_config,
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[header-search-box-type]',
								'operator' => 'in',
								'value'    => array( 'slide-search', 'search-box' ),
							),
						),
					),
					/**
					 * Search Box Background Color
					 */
					array(
						'name'      => 'header-search-box-background-color',
						'default'   => astra_get_option( 'header-search-box-background-color' ),
						'type'      => 'sub-control',
						'parent'    => ASTRA_THEME_SETTINGS . '[header-search-bg-color-parent]',
						'section'   => 'section-header-search',
						'priority'  => 1,
						'transport' => 'postMessage',
						'control'   => 'ast-color',
						'title'     => __( 'Normal', 'astra-addon' ),
						'context'   => astra_addon_builder_helper()->design_tab,
					),
					/**
					 * Search Box Background hover Color
					 */
					array(
						'name'      => 'header-search-box-background-h-color',
						'default'   => astra_get_option( 'header-search-box-background-h-color' ),
						'type'      => 'sub-control',
						'parent'    => ASTRA_THEME_SETTINGS . '[header-search-bg-color-parent]',
						'section'   => 'section-heade-search',
						'priority'  => 2,
						'transport' => 'postMessage',
						'control'   => 'ast-color',
						'title'     => __( 'Hover', 'astra-addon' ),
						'context'   => astra_addon_builder_helper()->design_tab,
					),
					/**
					 * Group: Search Border Group
					 */
					array(
						'name'      => ASTRA_THEME_SETTINGS . '[header-search-border-color-group]',
						'default'   => astra_get_option( 'header-search-border-color-group' ),
						'type'      => 'control',
						'control'   => Astra_Theme_Extension::$group_control,
						'title'     => __( 'Border Color', 'astra-addon' ),
						'section'   => 'section-header-search',
						'transport' => 'postMessage',
						'priority'  => 9,
						'context'   => array(
							astra_addon_builder_helper()->design_tab_config,
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[header-search-box-type]',
								'operator' => 'in',
								'value'    => array( 'slide-search', 'search-box' ),
							),
						),
					),
					/**
					 * Option: Search Border Color
					 */
					array(
						'name'       => 'header-search-border-color',
						'default'    => astra_get_option( 'header-search-border-color' ),
						'transport'  => 'postMessage',
						'type'       => 'sub-control',
						'parent'     => ASTRA_THEME_SETTINGS . '[header-search-border-color-group]',
						'section'    => 'section-header-search',
						'control'    => 'ast-color',
						'responsive' => true,
						'rgba'       => true,
						'priority'   => 1,
						'context'    => astra_addon_builder_helper()->general_tab,
						'title'      => __( 'Normal', 'astra-addon' ),
					),
					/**
					 * Option: Search Border Hover Color
					 */
					array(
						'name'       => 'header-search-border-h-color',
						'default'    => astra_get_option( 'header-search-border-h-color' ),
						'parent'     => ASTRA_THEME_SETTINGS . '[header-search-border-color-group]',
						'transport'  => 'postMessage',
						'type'       => 'sub-control',
						'section'    => 'section-header-search',
						'control'    => 'ast-color',
						'responsive' => true,
						'rgba'       => true,
						'priority'   => 2,
						'context'    => astra_addon_builder_helper()->general_tab,
						'title'      => __( 'Hover', 'astra-addon' ),
					),
					/**
					 * Option: Search Border Radius
					 */
					array(
						'name'        => ASTRA_THEME_SETTINGS . '[header-search-border-radius]',
						'default'     => astra_get_option( 'header-search-border-radius' ),
						'type'        => 'control',
						'parent'      => ASTRA_THEME_SETTINGS . '[header-search-border-color-group]',
						'section'     => 'section-header-search',
						'control'     => 'ast-slider',
						'transport'   => 'postMessage',
						'priority'    => 9,
						'title'       => __( 'Border Radius', 'astra-addon' ),
						'suffix'      => 'px',
						'input_attrs' => array(
							'min'  => 0,
							'step' => 1,
							'max'  => 100,
						),
						'context'     => array(
							astra_addon_builder_helper()->design_tab_config,
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[header-search-box-type]',
								'operator' => 'in',
								'value'    => array( 'slide-search', 'search-box' ),
							),
						),
						'divider'     => array( 'ast_class' => 'ast-top-section-divider' ),
					),
					/**
					 * Option: Search Border Size
					 */
					array(
						'name'           => ASTRA_THEME_SETTINGS . '[header-search-border-size]',
						'default'        => astra_get_option( 'header-search-border-size' ),
						'type'           => 'control',
						'section'        => 'section-header-search',
						'control'        => 'ast-border',
						'transport'      => 'postMessage',
						'linked_choices' => true,
						'priority'       => 9,
						'title'          => __( 'Border Width', 'astra-addon' ),
						'context'        => array(
							astra_addon_builder_helper()->design_tab_config,
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[header-search-box-type]',
								'operator' => 'in',
								'value'    => array( 'slide-search', 'search-box' ),
							),
						),
						'choices'        => array(
							'top'    => __( 'Top', 'astra-addon' ),
							'right'  => __( 'Right', 'astra-addon' ),
							'bottom' => __( 'Bottom', 'astra-addon' ),
							'left'   => __( 'Left', 'astra-addon' ),
						),
						'divider'        => array( 'ast_class' => 'ast-top-section-divider' ),
					),
					/**
					 * Option: Search text/placeholder Color
					 */
					array(
						'name'       => ASTRA_THEME_SETTINGS . '[header-search-text-placeholder-color]',
						'default'    => astra_get_option( 'header-search-text-placeholder-color' ),
						'transport'  => 'postMessage',
						'type'       => 'control',
						'section'    => 'section-header-search',
						'control'    => 'ast-responsive-color',
						'responsive' => true,
						'rgba'       => true,
						'priority'   => 8.5,
						'title'      => __( 'Text / Placeholder Color', 'astra-addon' ),
						'context'    => array(
							astra_addon_builder_helper()->design_tab_config,
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[header-search-box-type]',
								'operator' => 'in',
								'value'    => array( 'slide-search', 'search-box' ),
							),
						),
					),
				);

				return array_merge( $configurations, $_configs );
			}

			return $configurations;
		}
	}
}

/**
 * Kicking this off by calling 'get_instance()' method
 */
new Astra_Customizer_Colors_Header();
