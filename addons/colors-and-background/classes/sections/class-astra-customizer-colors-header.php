<?php
/**
 * Colors Header Options for our theme.
 *
 * @package     Astra Addon
 * @author      Brainstorm Force
 * @copyright   Copyright (c) 2020, Brainstorm Force
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
	class Astra_Customizer_Colors_Header extends Astra_Customizer_Config_Base {

		/**
		 * Register General Customizer Configurations.
		 *
		 * @param Array                $configurations Astra Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array Astra Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$title_color_heading = __( 'Colors', 'astra-addon' );
			if ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) {
				$title_color_heading = __( 'Title', 'astra-addon' );
			}

			$_configs = array();

			/**
			 * We adding this control only to maintain backwards. Remove this condition after 2-3 updates of theme.
			 * Moving Site Title color & Tagline color option into theme.
			 *
			 * @since 3.5.0
			 */
			if ( is_astra_theme_3_5_0_version() ) {
				array_push(
					$_configs,
					array(
						'name'       => ASTRA_THEME_SETTINGS . '[site-identity-title-color-group]',
						'default'    => astra_get_option( 'site-identity-title-color-group' ),
						'type'       => 'control',
						'control'    => Astra_Theme_Extension::$group_control,
						'title'      => astra_addon_builder_helper()->is_header_footer_builder_active ? __( 'Title Color', 'astra-addon' ) : __( 'Colors', 'astra-addon' ),
						'section'    => 'title_tagline',
						'responsive' => false,
						'transport'  => 'postMessage',
						'priority'   => 8,
						'context'    => ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) ? array(
							astra_addon_builder_helper()->design_tab_config,
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[display-site-title]',
								'operator' => '==',
								'value'    => true,
							),
						) : array(
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[display-site-title]',
								'operator' => '==',
								'value'    => true,
							),
						),
					),
					// Option: Site Tagline Color.
					array(
						'name'      => ASTRA_THEME_SETTINGS . '[header-color-site-tagline]',
						'type'      => 'control',
						'control'   => 'ast-color',
						'transport' => 'postMessage',
						'default'   => astra_get_option( 'header-color-site-tagline' ),
						'title'     => ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) ? __( 'Tagline', 'astra-addon' ) : __( 'Color', 'astra-addon' ),
						'section'   => 'title_tagline',
						'priority'  => ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) ? 8 : 11,
						'context'   => ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) ? array(
							astra_addon_builder_helper()->design_tab_config,
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[display-site-tagline]',
								'operator' => '==',
								'value'    => true,
							),
						) : array(
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[display-site-tagline]',
								'operator' => '==',
								'value'    => true,
							),
						),
					)
				);

				if ( false === astra_addon_builder_helper()->is_header_footer_builder_active ) {
					array_push(
						$_configs,
						/**
						 * Option: Color heading
						 */
						array(
							'name'     => ASTRA_THEME_SETTINGS . '[site-identity-colors-heading]',
							'type'     => 'control',
							'control'  => 'ast-heading',
							'section'  => 'title_tagline',
							'title'    => __( 'Colors', 'astra-addon' ),
							'priority' => 7,
							'settings' => array(),
							'context'  => array(
								'relation' => 'AND',
								astra_addon_builder_helper()->design_tab_config,
								array(
									'relation' => 'OR',
									array(
										'setting'  => ASTRA_THEME_SETTINGS . '[display-site-title]',
										'operator' => '==',
										'value'    => true,
									),
									array(
										'setting'  => ASTRA_THEME_SETTINGS . '[display-site-tagline]',
										'operator' => '==',
										'value'    => true,
									),
								),
							),
						),
						// Option: Site Title Color.
						array(
							'name'      => 'header-color-site-title',
							'parent'    => ASTRA_THEME_SETTINGS . '[site-identity-title-color-group]',
							'section'   => 'title_tagline',
							'type'      => 'sub-control',
							'control'   => 'ast-color',
							'default'   => astra_get_option( 'header-color-site-title' ),
							'transport' => 'postMessage',
							'title'     => __( 'Normal', 'astra-addon' ),
							'context'   => astra_addon_builder_helper()->design_tab,
						),
						// Option: Site Title Hover Color.
						array(
							'name'      => 'header-color-h-site-title',
							'parent'    => ASTRA_THEME_SETTINGS . '[site-identity-title-color-group]',
							'section'   => 'title_tagline',
							'type'      => 'sub-control',
							'control'   => 'ast-color',
							'transport' => 'postMessage',
							'default'   => astra_get_option( 'header-color-h-site-title' ),
							'title'     => __( 'Hover', 'astra-addon' ),
							'context'   => astra_addon_builder_helper()->design_tab,
						)
					);
				}
			}

			if ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) {

				array_push(
					$_configs,
					/**
					 * Option: Search height
					 */
					array(
						'name'        => ASTRA_THEME_SETTINGS . '[header-search-height]',
						'section'     => 'section-header-search',
						'priority'    => 3,
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
						'divider'     => array( 'ast_class' => 'ast-top-divider' ),
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
						'divider'   => array( 'ast_class' => 'ast-bottom-divider' ),
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
						'title'          => __( 'Width', 'astra-addon' ),
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
					)
				);
			}

			return array_merge( $configurations, $_configs );
		}
	}
}

/**
 * Kicking this off by calling 'get_instance()' method
 */
new Astra_Customizer_Colors_Header();
