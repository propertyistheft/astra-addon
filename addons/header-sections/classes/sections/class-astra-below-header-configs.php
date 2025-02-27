<?php
/**
 * Below Header - Layout Options for our theme.
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

if ( ! class_exists( 'Astra_Below_Header_Configs' ) ) {

	/**
	 * Register below header Configurations.
	 */
	// @codingStandardsIgnoreStart
	class Astra_Below_Header_Configs extends Astra_Customizer_Config_Base {
 // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedClassFound
		// @codingStandardsIgnoreEnd

		/**
		 * Register Header Layout Customizer Configurations.
		 *
		 * @param Array                $configurations Astra Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array Astra Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$sections = apply_filters(
				'astra_header_section_elements',
				array(
					'none'      => __( 'None', 'astra-addon' ),
					'menu'      => __( 'Menu', 'astra-addon' ),
					'search'    => __( 'Search', 'astra-addon' ),
					'text-html' => __( 'Text / HTML', 'astra-addon' ),
					'widget'    => __( 'Widget', 'astra-addon' ),
				),
				'below-header'
			);

			$_config = array(

				/**
				 * Option: Below Header Layout
				 */
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[below-header-layout]',
					'section'           => 'section-below-header',
					'default'           => astra_get_option( 'below-header-layout' ),
					'priority'          => 5,
					'title'             => __( 'Layout', 'astra-addon' ),
					'type'              => 'control',
					'control'           => 'ast-radio-image',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_choices' ),
					'choices'           => array(
						'disabled'              => array(
							'label' => __( 'Disabled', 'astra-addon' ),
							'path'  => class_exists( 'Astra_Builder_UI_Controller' ) ? Astra_Builder_UI_Controller::fetch_svg_icon( 'disabled', false ) : '',
						),
						'below-header-layout-1' => array(
							'label' => __( 'Layout 1', 'astra-addon' ),
							'path'  => class_exists( 'Astra_Builder_UI_Controller' ) ? Astra_Builder_UI_Controller::fetch_svg_icon( 'below-header-layout-1', false ) : '',
						),
						'below-header-layout-2' => array(
							'label' => __( 'Layout 2', 'astra-addon' ),
							'path'  => class_exists( 'Astra_Builder_UI_Controller' ) ? Astra_Builder_UI_Controller::fetch_svg_icon( 'below-header-layout-2', false ) : '',
						),
					),
				),

				/**
				 * Option: Section 1
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[below-header-section-1]',
					'section'  => 'section-below-header',
					'type'     => 'control',
					'control'  => 'ast-select',
					'divider'  => array(
						'ast_class' => 'ast-top-divider',
						'ast_title' => __( 'Section 1', 'astra-addon' ),
					),
					'default'  => astra_get_option( 'below-header-section-1' ),
					'priority' => 15,
					'choices'  => $sections,
					'context'  => array(
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[below-header-layout]',
							'operator' => '!=',
							'value'    => 'disabled',
						),
					),
				),

				/**
				 * Option: Text/HTML
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[below-header-section-1-html]',
					'section'   => 'section-below-header',
					'default'   => astra_get_option( 'below-header-section-1-html' ),
					'priority'  => 20,
					'context'   => array(

						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[below-header-layout]',
							'operator' => '!=',
							'value'    => 'disabled',
						),
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[below-header-section-1]',
							'operator' => '==',
							'value'    => 'text-html',
						),
					),
					'title'     => __( 'Text/HTML', 'astra-addon' ),
					'type'      => 'control',
					'control'   => 'textarea',
					'transport' => 'postMessage',
					'partial'   => array(
						'selector'            => '.below-header-section-1 .user-select .ast-custom-html',
						'container_inclusive' => false,
						'render_callback'     => 'Astra_Customizer_Header_Sections_Partials::_render_below_header_section_1',
					),
				),

				/**
				 * Option: Section 2
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[below-header-section-2]',
					'default'  => astra_get_option( 'below-header-section-2' ),
					'section'  => 'section-below-header',
					'priority' => 35,
					'context'  => array(

						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[below-header-layout]',
							'operator' => '==',
							'value'    => 'below-header-layout-1',
						),
					),
					'divider'  => array(
						'ast_class' => 'ast-top-divider ast-bottom-divider',
						'ast_title' => __( 'Section 2', 'astra-addon' ),
					),
					'type'     => 'control',
					'control'  => 'ast-select',
					'choices'  => $sections,
				),

				/**
				 * Option: Text/HTML
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[below-header-section-2-html]',
					'section'   => 'section-below-header',
					'type'      => 'control',
					'control'   => 'textarea',
					'transport' => 'postMessage',
					'default'   => astra_get_option( 'below-header-section-2-html' ),
					'context'   => array(

						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[below-header-layout]',
							'operator' => '==',
							'value'    => 'below-header-layout-1',
						),
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[below-header-section-2]',
							'operator' => '==',
							'value'    => 'text-html',
						),
					),
					'partial'   => array(
						'selector'            => '.below-header-section-2 .user-select .ast-custom-html',
						'container_inclusive' => false,
						'render_callback'     => 'Astra_Customizer_Header_Sections_Partials::_render_below_header_section_2',
					),
					'priority'  => 40,
					'title'     => __( 'Text/HTML', 'astra-addon' ),
				),

				/**
				 * Option: Below Header Height
				 */
				array(
					'name'        => ASTRA_THEME_SETTINGS . '[below-header-height]',
					'section'     => 'section-below-header',
					'transport'   => 'postMessage',
					'default'     => astra_get_option( 'below-header-height' ),
					'priority'    => 54,
					'divider'     => array( 'ast_class' => 'ast-bottom-divider' ),
					'context'     => array(
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[below-header-layout]',
							'operator' => '!=',
							'value'    => 'disabled',
						),
					),
					'title'       => __( 'Height', 'astra-addon' ),
					'type'        => 'control',
					'control'     => 'ast-slider',
					'suffix'      => 'px',
					'input_attrs' => array(
						'min'  => 30,
						'step' => 1,
						'max'  => 600,
					),
				),

				/**
				 * Option: Below Header Height
				 */
				array(
					'name'        => ASTRA_THEME_SETTINGS . '[below-header-separator]',
					'section'     => 'section-below-header',
					'priority'    => 55,
					'transport'   => 'postMessage',
					'default'     => astra_get_option( 'below-header-separator' ),
					'title'       => __( 'Bottom Border', 'astra-addon' ),
					'type'        => 'control',
					'context'     => array(
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[below-header-layout]',
							'operator' => '!=',
							'value'    => 'disabled',
						),
					),
					'suffix'      => 'px',
					'control'     => 'ast-slider',
					'input_attrs' => array(
						'min'  => 0,
						'step' => 1,
						'max'  => 600,
					),
				),

				/**
				 * Option: Bottom Border Color
				 */
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[below-header-bottom-border-color]',
					'transport'         => 'postMessage',
					'default'           => astra_get_option( 'below-header-bottom-border-color' ),
					'type'              => 'control',
					'context'           => array(
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[below-header-layout]',
							'operator' => '!=',
							'value'    => 'disabled',
						),
					),
					'control'           => 'ast-color',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
					'section'           => 'section-below-header',
					'priority'          => 60,
					'title'             => __( 'Bottom Border Color', 'astra-addon' ),
				),

				/**
				 * Option: Below Header Divider
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[below-header-submenu-border-divider]',
					'type'     => 'control',
					'control'  => 'ast-heading',
					'title'    => __( 'Submenu', 'astra-addon' ),
					'section'  => 'section-below-header',
					'priority' => 75,
					'context'  => array(
						'relation' => 'AND',
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[below-header-layout]',
							'operator' => '!=',
							'value'    => 'disabled',
						),
						array(
							'relation' => 'OR',
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[below-header-section-1]',
								'operator' => '==',
								'value'    => 'menu',
							),
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[below-header-section-2]',
								'operator' => '==',
								'value'    => 'menu',
							),
						),

					),
					'settings' => array(),
				),

				/**
				 * Option: Submenu Border
				 */
				array(
					'name'           => ASTRA_THEME_SETTINGS . '[below-header-submenu-border]',
					'default'        => astra_get_option( 'below-header-submenu-border' ),
					'type'           => 'control',
					'control'        => 'ast-border',
					'transport'      => 'postMessage',
					'priority'       => 75,
					'context'        => array(
						'relation' => 'AND',
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[below-header-layout]',
							'operator' => '!=',
							'value'    => 'disabled',
						),
						array(
							'relation' => 'OR',
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[below-header-section-1]',
								'operator' => '==',
								'value'    => 'menu',
							),
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[below-header-section-2]',
								'operator' => '==',
								'value'    => 'menu',
							),
						),
					),
					'section'        => 'section-below-header',
					'title'          => __( 'Container Border', 'astra-addon' ),
					'linked_choices' => true,
					'choices'        => array(
						'top'    => __( 'Top', 'astra-addon' ),
						'right'  => __( 'Right', 'astra-addon' ),
						'bottom' => __( 'Bottom', 'astra-addon' ),
						'left'   => __( 'Left', 'astra-addon' ),
					),
				),

				/**
				 * Option: Submenu Border Color
				 */

				array(
					'name'              => ASTRA_THEME_SETTINGS . '[below-header-submenu-border-color]',
					'type'              => 'control',
					'control'           => 'ast-color',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
					'transport'         => 'postMessage',
					'priority'          => 75,
					'divider'           => array( 'ast_class' => 'ast-bottom-divider' ),
					'context'           => array(
						'relation' => 'AND',
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[below-header-layout]',
							'operator' => '!=',
							'value'    => 'disabled',
						),
						array(
							'relation' => 'OR',

							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[below-header-section-1]',
								'operator' => '==',
								'value'    => 'menu',
							),
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[below-header-section-2]',
								'operator' => '==',
								'value'    => 'menu',
							),
						),
					),
					'default'           => astra_get_option( 'below-header-submenu-border-color' ),
					'section'           => 'section-below-header',
					'title'             => __( 'Border Color', 'astra-addon' ),
				),

				/**
				 * Option: Submenu Divider
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[below-header-submenu-item-border]',
					'default'   => astra_get_option( 'below-header-submenu-item-border' ),
					'type'      => 'control',
					'control'   => Astra_Theme_Extension::$switch_control,
					'divider'   => array( 'ast_class' => 'ast-bottom-divider' ),
					'transport' => 'postMessage',
					'priority'  => 75,
					'context'   => array(
						'relation' => 'AND',
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[below-header-layout]',
							'operator' => '!=',
							'value'    => 'disabled',
						),
						array(
							'relation' => 'OR',
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[below-header-section-1]',
								'operator' => '==',
								'value'    => 'menu',
							),
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[below-header-section-2]',
								'operator' => '==',
								'value'    => 'menu',
							),
						),
					),
					'section'   => 'section-below-header',
					'title'     => __( 'Submenu Divider', 'astra-addon' ),
				),

				/**
				 * Option: Submenu Divider Color
				 */
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[below-header-submenu-item-b-color]',
					'type'              => 'control',
					'control'           => 'ast-color',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
					'transport'         => 'postMessage',
					'priority'          => 75,
					'context'           => array(
						'relation' => 'AND',
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[below-header-layout]',
							'operator' => '!=',
							'value'    => 'disabled',
						),
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[below-header-submenu-item-border]',
							'operator' => '==',
							'value'    => true,
						),
					),
					'default'           => astra_get_option( 'below-header-submenu-item-b-color' ),
					'section'           => 'section-below-header',
					'title'             => __( 'Divider Color', 'astra-addon' ),
				),

				// Option: Submenu Container Animation.
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[below-header-submenu-container-animation]',
					'default'  => astra_get_option( 'below-header-submenu-container-animation' ),
					'type'     => 'control',
					'control'  => 'ast-select',
					'section'  => 'section-below-header',
					'priority' => 75,
					'title'    => __( 'Container Animation', 'astra-addon' ),
					'context'  => array(
						'relation' => 'AND',
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[below-header-layout]',
							'operator' => '!=',
							'value'    => 'disabled',
						),
						array(
							'relation' => 'OR',
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[below-header-section-1]',
								'operator' => '==',
								'value'    => 'menu',
							),
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[below-header-section-2]',
								'operator' => '==',
								'value'    => 'menu',
							),
						),
					),
					'choices'  => array(
						''           => __( 'Default', 'astra-addon' ),
						'slide-down' => __( 'Slide Down', 'astra-addon' ),
						'slide-up'   => __( 'Slide Up', 'astra-addon' ),
						'fade'       => __( 'Fade', 'astra-addon' ),
					),

				),

				/**
				 * Option: Below Header Header Group
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[below-header-menu-typography-styling]',
					'default'   => astra_get_option( 'below-header-menu-typography-styling' ),
					'type'      => 'control',
					'control'   => 'ast-settings-group',
					'title'     => __( 'Menu Font', 'astra-addon' ),
					'section'   => 'section-below-header',
					'transport' => 'postMessage',
					'priority'  => 137,
					'divider'   => array( 'ast_class' => 'ast-bottom-divider' ),
					'context'   => array(
						'relation' => 'AND',
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[below-header-layout]',
							'operator' => '!=',
							'value'    => 'disabled',
						),
						array(
							'relation' => 'OR',
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[below-header-section-1]',
								'operator' => '==',
								'value'    => 'menu',
							),
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[below-header-section-2]',
								'operator' => '==',
								'value'    => 'menu',
							),
						),
					),
				),

				/**
				 * Option: Below Header Header Group
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[below-header-submenu-typography-styling]',
					'default'   => astra_get_option( 'below-header-submenu-typography-styling' ),
					'type'      => 'control',
					'control'   => 'ast-settings-group',
					'title'     => __( 'Submenu Font', 'astra-addon' ),
					'section'   => 'section-below-header',
					'transport' => 'postMessage',
					'divider'   => array( 'ast_class' => 'ast-bottom-divider' ),
					'priority'  => 137,
					'context'   => array(
						'relation' => 'AND',
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[below-header-layout]',
							'operator' => '!=',
							'value'    => 'disabled',
						),
						array(
							'relation' => 'OR',
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[below-header-section-1]',
								'operator' => '==',
								'value'    => 'menu',
							),
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[below-header-section-2]',
								'operator' => '==',
								'value'    => 'menu',
							),
						),
					),
				),

				/**
				 * Option: Below Header Header Group
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[below-header-content-typography-styling]',
					'default'   => astra_get_option( 'below-header-content-typography-styling' ),
					'type'      => 'control',
					'control'   => 'ast-settings-group',
					'title'     => __( 'Content Font', 'astra-addon' ),
					'section'   => 'section-below-header',
					'transport' => 'postMessage',
					'divider'   => array( 'ast_class' => 'ast-bottom-divider' ),
					'priority'  => 137,
					'context'   => array(
						'relation' => 'OR',

						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[below-header-section-1]',
							'operator' => '==',
							'value'    => array( 'search', 'text-html', 'widget' ),
						),
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[below-header-section-2]',
							'operator' => '==',
							'value'    => array( 'search', 'text-html', 'widget' ),
						),
					),
				),

				/**
				 * Option: Background
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[below-header-bg-obj-responsive]',
					'section'   => 'section-below-header',
					'divider'   => array( 'ast_class' => 'ast-bottom-divider' ),
					'type'      => 'control',
					'control'   => 'ast-responsive-background',
					'transport' => 'postMessage',
					'context'   => array(
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[below-header-layout]',
							'operator' => '!=',
							'value'    => 'disabled',
						),
					),
					'default'   => astra_get_option( 'below-header-bg-obj-responsive' ),
					'label'     => __( 'Background Color', 'astra-addon' ),
					'priority'  => 136,
				),

				/**
				 * Option: Below Header Menus Group
				 */
				array(
					'name'       => ASTRA_THEME_SETTINGS . '[below-header-link-color-group]',
					'default'    => astra_get_option( 'below-header-link-color-group' ),
					'type'       => 'control',
					'control'    => Astra_Theme_Extension::$group_control,
					'title'      => __( 'Link', 'astra-addon' ),
					'section'    => 'section-below-header',
					'transport'  => 'postMessage',
					'priority'   => 136,
					'context'    => array(
						'relation' => 'AND',
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[below-header-layout]',
							'operator' => '!=',
							'value'    => 'disabled',
						),
						array(
							'relation' => 'OR',
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[below-header-section-1]',
								'operator' => '==',
								'value'    => 'menu',
							),
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[below-header-section-2]',
								'operator' => '==',
								'value'    => 'menu',
							),
						),
					),
					'responsive' => true,
				),

				array(
					'name'       => ASTRA_THEME_SETTINGS . '[below-header-bg-color-group]',
					'default'    => astra_get_option( 'below-header-bg-color-group' ),
					'type'       => 'control',
					'control'    => Astra_Theme_Extension::$group_control,
					'title'      => __( 'Background', 'astra-addon' ),
					'section'    => 'section-below-header',
					'transport'  => 'postMessage',
					'priority'   => 136,
					'context'    => array(
						'relation' => 'AND',
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[below-header-layout]',
							'operator' => '!=',
							'value'    => 'disabled',
						),
						array(
							'relation' => 'OR',
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[below-header-section-1]',
								'operator' => '==',
								'value'    => 'menu',
							),
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[below-header-section-2]',
								'operator' => '==',
								'value'    => 'menu',
							),
						),
					),
					'responsive' => true,
				),

				/**
				 * Option: Below Header Menus Group
				 */
				array(
					'name'       => ASTRA_THEME_SETTINGS . '[below-header-submenus-link-color-group]',
					'default'    => astra_get_option( 'below-header-submenus-link-color-group' ),
					'type'       => 'control',
					'control'    => Astra_Theme_Extension::$group_control,
					'title'      => __( 'Link', 'astra-addon' ),
					'section'    => 'section-below-header',
					'transport'  => 'postMessage',
					'priority'   => 136,
					'divider'    => array(
						'ast_class' => 'ast-top-divider',
						'ast_title' => __( 'Submenu Colors', 'astra-addon' ),
					),
					'context'    => array(
						'relation' => 'AND',
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[below-header-layout]',
							'operator' => '!=',
							'value'    => 'disabled',
						),
						array(
							'relation' => 'OR',
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[below-header-section-1]',
								'operator' => '==',
								'value'    => 'menu',
							),
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[below-header-section-2]',
								'operator' => '==',
								'value'    => 'menu',
							),
						),
					),
					'responsive' => true,
				),
				array(
					'name'       => ASTRA_THEME_SETTINGS . '[below-header-submenus-bg-color-group]',
					'default'    => astra_get_option( 'below-header-submenus-bg-color-group' ),
					'type'       => 'control',
					'control'    => Astra_Theme_Extension::$group_control,
					'title'      => __( 'Background', 'astra-addon' ),
					'divider'    => array( 'ast_class' => 'ast-bottom-divider' ),
					'section'    => 'section-below-header',
					'transport'  => 'postMessage',
					'priority'   => 136,
					'context'    => array(
						'relation' => 'AND',
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[below-header-layout]',
							'operator' => '!=',
							'value'    => 'disabled',
						),
						array(
							'relation' => 'OR',
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[below-header-section-1]',
								'operator' => '==',
								'value'    => 'menu',
							),
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[below-header-section-2]',
								'operator' => '==',
								'value'    => 'menu',
							),
						),
					),
					'responsive' => true,
				),

				/**
				 * Option: Below Header Menus Group
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[below-header-content-group]',
					'default'   => astra_get_option( 'below-header-content-group' ),
					'type'      => 'control',
					'control'   => 'ast-settings-group',
					'title'     => __( 'Content', 'astra-addon' ),
					'section'   => 'section-below-header',
					'transport' => 'postMessage',
					'priority'  => 136,
					'context'   => array(
						'relation' => 'OR',

						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[below-header-section-1]',
							'operator' => '==',
							'value'    => array( 'search', 'widget', 'text-html', 'edd' ),
						),
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[below-header-section-2]',
							'operator' => '==',
							'value'    => array( 'search', 'widget', 'text-html', 'edd' ),
						),
					),
				),

				/**
				 * Option: Divider
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[below-header-mobile-menu-divider]',
					'section'  => 'section-below-header',
					'type'     => 'control',
					'context'  => array(
						'relation' => 'AND',
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[below-header-layout]',
							'operator' => '!=',
							'value'    => 'disabled',
						),
						array(
							'relation' => 'OR',
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[below-header-section-1]',
								'operator' => '!=',
								'value'    => 'none',
							),
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[below-header-section-2]',
								'operator' => '!=',
								'value'    => 'none',
							),
						),
					),
					'control'  => 'ast-heading',
					'priority' => 100,
					'title'    => __( 'Mobile Header', 'astra-addon' ),
					'settings' => array(),
				),

				/**
				 * Option: Display Below Header on Mobile.
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[below-header-on-mobile]',
					'type'     => 'control',
					'control'  => Astra_Theme_Extension::$switch_control,
					'divider'  => array( 'ast_class' => 'ast-bottom-divider' ),
					'context'  => array(
						'relation' => 'AND',
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[below-header-layout]',
							'operator' => '!=',
							'value'    => 'disabled',
						),
						array(
							'relation' => 'OR',
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[below-header-section-1]',
								'operator' => '!=',
								'value'    => '',
							),
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[below-header-section-2]',
								'operator' => '!=',
								'value'    => '',
							),
						),
					),
					'default'  => astra_get_option( 'below-header-on-mobile' ),
					'section'  => 'section-below-header',
					'title'    => __( 'Display on Mobile Devices', 'astra-addon' ),
					'priority' => 105,
				),

				/**
				 * Option: Merged with primary header menu
				 */
				array(
					'name'        => ASTRA_THEME_SETTINGS . '[below-header-merge-menu]',
					'type'        => 'control',
					'divider'     => array( 'ast_class' => 'ast-bottom-divider' ),
					'control'     => Astra_Theme_Extension::$switch_control,
					'context'     => array(
						'relation' => 'AND',
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[below-header-layout]',
							'operator' => '!=',
							'value'    => 'disabled',
						),
						array(
							'relation' => 'OR',
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[below-header-section-1]',
								'operator' => '==',
								'value'    => 'menu',
							),
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[below-header-section-2]',
								'operator' => '==',
								'value'    => 'menu',
							),
						),
					),
					'default'     => astra_get_option( 'below-header-merge-menu' ),
					'section'     => 'section-below-header',
					'title'       => __( 'Merge Menu on Mobile Devices', 'astra-addon' ),
					'description' => __( 'You can merge menu with primary menu in mobile devices by enabling this option.', 'astra-addon' ),
					'priority'    => 105,
				),

				/**
				 * Option: Swap section on mobile devices
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[below-header-swap-mobile]',
					'default'  => astra_get_option( 'below-header-swap-mobile' ),
					'type'     => 'control',
					'control'  => Astra_Theme_Extension::$switch_control,
					'divider'  => array( 'ast_class' => 'ast-bottom-divider' ),
					'context'  => array(
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[below-header-layout]',
							'operator' => '==',
							'value'    => 'below-header-layout-1',
						),
					),
					'section'  => 'section-below-header',
					'title'    => __( 'Swap Sections on Mobile Devices', 'astra-addon' ),
					'priority' => 105,
				),

				/**
				 * Option: Mobile Menu Alignment
				 */

				array(
					'name'              => ASTRA_THEME_SETTINGS . '[below-header-menu-align]',
					'section'           => 'section-below-header',
					'type'              => 'control',
					'divider'           => array( 'ast_class' => 'ast-bottom-divider' ),
					'control'           => 'ast-radio-image',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_choices' ),
					'default'           => astra_get_option( 'below-header-menu-align' ),
					'priority'          => 105,
					'context'           => array(
						'relation' => 'AND',
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[below-header-layout]',
							'operator' => '!=',
							'value'    => 'disabled',
						),
						array(
							'relation' => 'OR',

							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[below-header-section-1]',
								'operator' => '!=',
								'value'    => 'none',
							),
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[below-header-section-2]',
								'operator' => '!=',
								'value'    => 'none',
							),
						),
					),
					'title'             => __( 'Layout', 'astra-addon' ),
					'choices'           => array(
						'inline' => array(
							'label' => __( 'Inline', 'astra-addon' ),
							'path'  => class_exists( 'Astra_Builder_UI_Controller' ) ? Astra_Builder_UI_Controller::fetch_svg_icon( 'below-header-inline', false ) : '',
						),
						'stack'  => array(
							'label' => __( 'Stack', 'astra-addon' ),
							'path'  => class_exists( 'Astra_Builder_UI_Controller' ) ? Astra_Builder_UI_Controller::fetch_svg_icon( 'below-header-stack', false ) : '',
						),
					),
				),

				/**
				 * Option: Mobile Menu Label
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[below-header-menu-label]',
					'section'   => 'section-below-header',
					'type'      => 'control',
					'control'   => 'text',
					'transport' => 'postMessage',
					'context'   => array(
						'relation' => 'AND',
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[below-header-layout]',
							'operator' => '!=',
							'value'    => 'disabled',
						),
						array(
							'relation' => 'OR',
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[below-header-on-mobile]',
								'operator' => '==',
								'value'    => true,
							),
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[below-header-merge-menu]',
								'operator' => '==',
								'value'    => true,
							),
						),
					),
					'priority'  => 105,
					'default'   => astra_get_option( 'below-header-menu-label' ),
					'title'     => __( 'Menu Label', 'astra-addon' ),
				),
			);

			return array_merge( $configurations, $_config );
		}
	}
}

new Astra_Below_Header_Configs();
