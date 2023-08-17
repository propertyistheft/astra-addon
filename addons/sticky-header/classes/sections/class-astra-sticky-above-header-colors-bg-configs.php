<?php
/**
 * Sticky Header - Above Header Colors Options for our theme.
 *
 * @package     Astra Addon
 * @link        https://www.brainstormforce.com
 * @since       1.0.0
 */

// Block direct access to the file.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Bail if Customizer config base class does not exist.
if ( ! class_exists( 'Astra_Customizer_Config_Base' ) ) {
	return;
}

if ( ! class_exists( 'Astra_Sticky_Above_Header_Colors_Bg_Configs' ) ) {

	/**
	 * Register Sticky Header Above Header ColorsCustomizer Configurations.
	 */
	// @codingStandardsIgnoreStart
	class Astra_Sticky_Above_Header_Colors_Bg_Configs extends Astra_Customizer_Config_Base {
 // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedClassFound
		// @codingStandardsIgnoreEnd

		/**
		 * Register Sticky Header Colors Customizer Configurations.
		 *
		 * @param Array                $configurations Astra Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array Astra Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$header_above_section        = 'section-sticky-header';
			$header_above_color_priority = 60;
			$context                     = astra_addon_builder_helper()->general_tab_config;

			if ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) {

				$header_above_section        = 'section-above-header-builder';
				$header_above_color_priority = 85;
				$context                     = astra_addon_builder_helper()->design_tab;

				$_config = array(

					array(
						'name'       => ASTRA_THEME_SETTINGS . '[sticky-above-header-bg-color-responsive]',
						'default'    => astra_get_option( 'sticky-above-header-bg-color-responsive' ),
						'type'       => 'control',
						'priority'   => $header_above_color_priority,
						'section'    => $header_above_section,
						'transport'  => 'postMessage',
						'control'    => 'ast-responsive-color',
						'title'      => __( 'Background Color', 'astra-addon' ),
						'responsive' => true,
						'rgba'       => true,
						'context'    => $context,
						'divider'    => array( 'ast_class' => 'ast-section-spacing ast-bottom-section-divider' ),
					),

					/**
					 * Option: Sticky Background Blur.
					 */
					array(
						'name'        => ASTRA_THEME_SETTINGS . '[sticky-above-header-bg-blur]',
						'default'     => astra_get_option( 'sticky-above-header-bg-blur' ),
						'type'        => 'control',
						'control'     => Astra_Theme_Extension::$switch_control,
						'title'       => __( 'Background Blur', 'astra-addon' ),
						'priority'    => $header_above_color_priority,
						'section'     => $header_above_section,
						'context'     => $context,
						'description' => __( 'Background blur is dependent on the background color opacity', 'astra-addon' ),
					),

					/**
					 * Option: Sticky Background Blur Intensity.
					 */
					array(
						'name'        => ASTRA_THEME_SETTINGS . '[sticky-above-header-bg-blur-intensity]',
						'default'     => astra_get_option( 'sticky-above-header-bg-blur-intensity' ),
						'type'        => 'control',
						'priority'    => $header_above_color_priority,
						'section'     => $header_above_section,
						'title'       => __( 'Background Blur Intensity', 'astra-addon' ),
						'control'     => 'ast-slider',
						'suffix'      => 'px',
						'context'     => array(
							astra_addon_builder_helper()->design_tab_config,
							'relation' => 'AND',
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[sticky-above-header-bg-blur]',
								'operator' => '==',
								'value'    => true,
							),
						),
						'input_attrs' => array(
							'min'  => 1,
							'step' => 1,
							'max'  => 20,
						),
						'divider'     => array( 'ast_class' => 'ast-top-dotted-divider' ),
					),
				);
			} else {
				$_config = array(

					array(
						'name'       => ASTRA_THEME_SETTINGS . '[sticky-above-header-bg-color-responsive]',
						'default'    => astra_get_option( 'sticky-above-header-bg-color-responsive' ),
						'type'       => 'control',
						'priority'   => $header_above_color_priority,
						'section'    => $header_above_section,
						'transport'  => 'postMessage',
						'control'    => 'ast-responsive-color',
						'title'      => __( 'Background Color', 'astra-addon' ),
						'responsive' => true,
						'rgba'       => true,
						'context'    => $context,
					),

					/**
					 * Option: Primary Menu Color
					 */
					array(
						'name'       => 'sticky-above-header-menu-color-responsive',
						'default'    => astra_get_option( 'sticky-above-header-menu-color-responsive' ),
						'type'       => 'sub-control',
						'tab'        => __( 'Normal', 'astra-addon' ),
						'priority'   => 6,
						'parent'     => ASTRA_THEME_SETTINGS . '[sticky-header-above-menus-link-colors]',
						'section'    => 'section-sticky-header',
						'transport'  => 'postMessage',
						'control'    => 'ast-responsive-color',
						'title'      => __( 'Normal', 'astra-addon' ),
						'responsive' => true,
						'rgba'       => true,
						'context'    => array(
							'relation' => 'OR',
							astra_addon_builder_helper()->general_tab_config,
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[above-header-section-1]',
								'operator' => '==',
								'value'    => 'menu',
							),
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[above-header-section-2]',
								'operator' => '==',
								'value'    => 'menu',
							),
						),
					),
					/**
					 * Option: Menu Background Color
					 */
					array(
						'name'       => 'sticky-above-header-menu-bg-color-responsive',
						'default'    => astra_get_option( 'sticky-above-header-menu-bg-color-responsive' ),
						'type'       => 'sub-control',
						'tab'        => __( 'Normal', 'astra-addon' ),
						'priority'   => 7,
						'parent'     => ASTRA_THEME_SETTINGS . '[sticky-header-above-menus-colors]',
						'section'    => 'section-sticky-header',
						'transport'  => 'postMessage',
						'control'    => 'ast-responsive-color',
						'title'      => __( 'Normal', 'astra-addon' ),
						'responsive' => true,
						'rgba'       => true,
						'context'    => array(
							'relation' => 'OR',
							astra_addon_builder_helper()->general_tab_config,
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[above-header-section-1]',
								'operator' => '==',
								'value'    => 'menu',
							),
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[above-header-section-2]',
								'operator' => '==',
								'value'    => 'menu',
							),
						),
					),

					/**
					 * Option: Menu Hover Color
					 */
					array(
						'name'       => 'sticky-above-header-menu-h-color-responsive',
						'default'    => astra_get_option( 'sticky-above-header-menu-h-color-responsive' ),
						'type'       => 'sub-control',
						'tab'        => __( 'Hover', 'astra-addon' ),
						'priority'   => 6,
						'parent'     => ASTRA_THEME_SETTINGS . '[sticky-header-above-menus-link-colors]',
						'section'    => 'section-sticky-header',
						'transport'  => 'postMessage',
						'control'    => 'ast-responsive-color',
						'title'      => __( 'Active/Hover', 'astra-addon' ),
						'responsive' => true,
						'rgba'       => true,
						'context'    => array(
							'relation' => 'OR',
							astra_addon_builder_helper()->general_tab_config,
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[above-header-section-1]',
								'operator' => '==',
								'value'    => 'menu',
							),
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[above-header-section-2]',
								'operator' => '==',
								'value'    => 'menu',
							),
						),
					),
					/**
					 * Option: Menu Link / Hover Background Color
					 */
					array(
						'name'       => 'sticky-above-header-menu-h-a-bg-color-responsive',
						'default'    => astra_get_option( 'sticky-above-header-menu-h-a-bg-color-responsive' ),
						'type'       => 'sub-control',
						'tab'        => __( 'Hover', 'astra-addon' ),
						'priority'   => 7,
						'parent'     => ASTRA_THEME_SETTINGS . '[sticky-header-above-menus-colors]',
						'section'    => 'section-sticky-header',
						'transport'  => 'postMessage',
						'control'    => 'ast-responsive-color',
						'title'      => __( 'Active/Hover', 'astra-addon' ),
						'responsive' => true,
						'rgba'       => true,
						'context'    => array(
							'relation' => 'OR',
							astra_addon_builder_helper()->general_tab_config,
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[above-header-section-1]',
								'operator' => '==',
								'value'    => 'menu',
							),
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[above-header-section-2]',
								'operator' => '==',
								'value'    => 'menu',
							),
						),
					),

					/**
					 * Option: Primary Menu Color
					 */
					array(
						'name'       => 'sticky-above-header-submenu-color-responsive',
						'default'    => astra_get_option( 'sticky-above-header-submenu-color-responsive' ),
						'type'       => 'sub-control',
						'tab'        => __( 'Normal', 'astra-addon' ),
						'priority'   => 9,
						'parent'     => ASTRA_THEME_SETTINGS . '[sticky-header-above-submenus-link-colors]',
						'section'    => 'section-sticky-header',
						'transport'  => 'postMessage',
						'control'    => 'ast-responsive-color',
						'title'      => __( 'Normal', 'astra-addon' ),
						'responsive' => true,
						'rgba'       => true,
						'context'    => array(
							'relation' => 'OR',
							astra_addon_builder_helper()->general_tab_config,
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[above-header-section-1]',
								'operator' => '==',
								'value'    => 'menu',
							),
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[above-header-section-2]',
								'operator' => '==',
								'value'    => 'menu',
							),
						),
					),
					/**
					 * Option: SubMenu Background Color
					 */
					array(
						'name'       => 'sticky-above-header-submenu-bg-color-responsive',
						'default'    => astra_get_option( 'sticky-above-header-submenu-bg-color-responsive' ),
						'type'       => 'sub-control',
						'tab'        => __( 'Normal', 'astra-addon' ),
						'priority'   => 10,
						'parent'     => ASTRA_THEME_SETTINGS . '[sticky-header-above-submenus-colors]',
						'section'    => 'section-sticky-header',
						'transport'  => 'postMessage',
						'control'    => 'ast-responsive-color',
						'title'      => __( 'Normal', 'astra-addon' ),
						'responsive' => true,
						'rgba'       => true,
						'context'    => array(
							'relation' => 'OR',
							astra_addon_builder_helper()->general_tab_config,
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[above-header-section-1]',
								'operator' => '==',
								'value'    => 'menu',
							),
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[above-header-section-2]',
								'operator' => '==',
								'value'    => 'menu',
							),
						),
					),

					/**
					 * Option: Menu Hover Color
					 */
					array(
						'name'       => 'sticky-above-header-submenu-h-color-responsive',
						'default'    => astra_get_option( 'sticky-above-header-submenu-h-color-responsive' ),
						'type'       => 'sub-control',
						'tab'        => __( 'Hover', 'astra-addon' ),
						'priority'   => 9,
						'parent'     => ASTRA_THEME_SETTINGS . '[sticky-header-above-submenus-link-colors]',
						'section'    => 'section-sticky-header',
						'transport'  => 'postMessage',
						'control'    => 'ast-responsive-color',
						'title'      => __( 'Active/Hover', 'astra-addon' ),
						'responsive' => true,
						'rgba'       => true,
						'context'    => array(
							'relation' => 'OR',
							astra_addon_builder_helper()->general_tab_config,
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[above-header-section-1]',
								'operator' => '==',
								'value'    => 'menu',
							),
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[above-header-section-2]',
								'operator' => '==',
								'value'    => 'menu',
							),
						),
					),

					/**
					 * Option: SubMenu Link / Hover Background Color
					 */
					array(
						'name'       => 'sticky-above-header-submenu-h-a-bg-color-responsive',
						'default'    => astra_get_option( 'sticky-above-header-submenu-h-a-bg-color-responsive' ),
						'type'       => 'sub-control',
						'tab'        => __( 'Hover', 'astra-addon' ),
						'priority'   => 10,
						'parent'     => ASTRA_THEME_SETTINGS . '[sticky-header-above-submenus-colors]',
						'section'    => 'section-sticky-header',
						'transport'  => 'postMessage',
						'control'    => 'ast-responsive-color',
						'title'      => __( 'Active/Hover', 'astra-addon' ),
						'responsive' => true,
						'rgba'       => true,
						'context'    => array(
							'relation' => 'OR',
							astra_addon_builder_helper()->general_tab_config,
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[above-header-section-1]',
								'operator' => '==',
								'value'    => 'menu',
							),
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[above-header-section-2]',
								'operator' => '==',
								'value'    => 'menu',
							),
						),
					),

					/**
					* Option: Content Section Text color.
					*/
					array(
						'name'       => ASTRA_THEME_SETTINGS . '[sticky-above-header-content-section-text-color-responsive]',
						'default'    => astra_get_option( 'sticky-above-header-content-section-text-color-responsive' ),
						'type'       => 'control',
						'priority'   => 74,
						'section'    => 'section-sticky-header',
						'transport'  => 'postMessage',
						'control'    => 'ast-responsive-color',
						'title'      => __( 'Text', 'astra-addon' ),
						'responsive' => true,
						'rgba'       => true,
						'divider'    => array(
							'ast_class' => 'ast-top-divider',
							'ast_title' => __( 'Content', 'astra-addon' ),
						),
						'context'    => array(
							'relation' => 'AND',
							astra_addon_builder_helper()->is_header_footer_builder_active ? astra_addon_builder_helper()->design_tab : astra_addon_builder_helper()->general_tab,
							array(
								'relation' => 'OR',
								array(
									'setting'  => ASTRA_THEME_SETTINGS . '[above-header-section-1]',
									'operator' => 'in',
									'value'    => array( 'search', 'widget', 'text-html', 'edd' ),
								),
								array(
									'setting'  => ASTRA_THEME_SETTINGS . '[above-header-section-2]',
									'operator' => 'in',
									'value'    => array( 'search', 'widget', 'text-html', 'edd' ),
								),
							),
						),
					),
					/**
					 * Option: Content Section Link color.
					 */
					array(
						'name'       => 'sticky-above-header-content-section-link-color-responsive',
						'default'    => astra_get_option( 'sticky-above-header-content-section-link-color-responsive' ),
						'type'       => 'sub-control',
						'tab'        => __( 'Normal', 'astra-addon' ),
						'priority'   => 19,
						'parent'     => ASTRA_THEME_SETTINGS . '[sticky-header-above-outside-item-link-colors]',
						'section'    => 'section-sticky-header',
						'transport'  => 'postMessage',
						'control'    => 'ast-responsive-color',
						'title'      => __( 'Normal', 'astra-addon' ),
						'responsive' => true,
						'rgba'       => true,
						'context'    => array(
							'relation' => 'OR',
							astra_addon_builder_helper()->general_tab_config,
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[above-header-section-1]',
								'operator' => '==',
								'value'    => array( 'search', 'widget', 'text-html', 'edd' ),
							),
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[above-header-section-2]',
								'operator' => '==',
								'value'    => array( 'search', 'widget', 'text-html', 'edd' ),
							),
						),
					),

					/**
					 * Option: Content Section Link Hover color.
					 */
					array(
						'name'       => 'sticky-above-header-content-section-link-h-color-responsive',
						'default'    => astra_get_option( 'sticky-above-header-content-section-link-h-color-responsive' ),
						'type'       => 'sub-control',
						'tab'        => __( 'Hover', 'astra-addon' ),
						'priority'   => 20,
						'parent'     => ASTRA_THEME_SETTINGS . '[sticky-header-above-outside-item-link-colors]',
						'section'    => 'section-sticky-header',
						'transport'  => 'postMessage',
						'control'    => 'ast-responsive-color',
						'title'      => __( 'Hover', 'astra-addon' ),
						'responsive' => true,
						'rgba'       => true,
						'context'    => array(
							'relation' => 'OR',
							astra_addon_builder_helper()->general_tab_config,
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[above-header-section-1]',
								'operator' => '==',
								'value'    => array( 'search', 'widget', 'text-html', 'edd' ),
							),
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[above-header-section-2]',
								'operator' => '==',
								'value'    => array( 'search', 'widget', 'text-html', 'edd' ),
							),
						),

					),
				);
			}

			return array_merge( $configurations, $_config );
		}

	}
}

new Astra_Sticky_Above_Header_Colors_Bg_Configs();
