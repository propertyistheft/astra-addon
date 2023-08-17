<?php
/**
 * Above Header - Layout Options for our theme.
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


if ( ! class_exists( 'Astra_Above_Header_Configs' ) ) {

	/**
	 * Register Header Layout Customizer Configurations.
	 */
	// @codingStandardsIgnoreStart
	class Astra_Above_Header_Configs extends Astra_Customizer_Config_Base {
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
					''          => __( 'None', 'astra-addon' ),
					'menu'      => __( 'Menu', 'astra-addon' ),
					'search'    => __( 'Search', 'astra-addon' ),
					'text-html' => __( 'Text / HTML', 'astra-addon' ),
					'widget'    => __( 'Widget', 'astra-addon' ),
				),
				'above-header'
			);

			$_config = array(

				/**
				 * Option: Above Header Layout
				 */

				array(
					'name'              => ASTRA_THEME_SETTINGS . '[above-header-layout]',
					'section'           => 'section-above-header',
					'type'              => 'control',
					'control'           => 'ast-radio-image',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_choices' ),
					'default'           => astra_get_option( 'above-header-layout' ),
					'priority'          => 1,
					'title'             => __( 'Layout', 'astra-addon' ),
					'choices'           => array(
						'disabled'              => array(
							'label' => __( 'Disabled', 'astra-addon' ),
							'path'  => ( class_exists( 'Astra_Builder_UI_Controller' ) ) ? Astra_Builder_UI_Controller::fetch_svg_icon( 'disabled', false ) : '',
						),
						'above-header-layout-1' => array(
							'label' => __( 'Layout 1', 'astra-addon' ),
							'path'  => ( class_exists( 'Astra_Builder_UI_Controller' ) ) ? Astra_Builder_UI_Controller::fetch_svg_icon( 'above-header-layout-1', false ) : '',
						),
						'above-header-layout-2' => array(
							'label' => __( 'Layout 2', 'astra-addon' ),
							'path'  => ( class_exists( 'Astra_Builder_UI_Controller' ) ) ? Astra_Builder_UI_Controller::fetch_svg_icon( 'above-header-layout-2', false ) : '',
						),
					),
				),

				/**
				 *  Section: Section
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[above-header-section-1]',
					'default'  => astra_get_option( 'above-header-section-1' ),
					'type'     => 'control',
					'context'  => array(
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[above-header-layout]',
							'operator' => '!=',
							'value'    => 'disabled',
						),
					),
					'divider'  => array(
						'ast_class' => 'ast-top-divider',
						'ast_title' => __( 'Section 1', 'astra-addon' ),
					),
					'control'  => 'ast-select',
					'section'  => 'section-above-header',
					'priority' => 35,
					'choices'  => $sections,
				),

				/**
				 * Option: Text/HTML
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[above-header-section-1-html]',
					'section'   => 'section-above-header',
					'type'      => 'control',
					'control'   => 'textarea',
					'transport' => 'postMessage',
					'default'   => astra_get_option( 'above-header-section-1-html' ),
					'priority'  => 50,
					'divider'   => array( 'ast_class' => 'ast-bottom-divider' ),
					'context'   => array(

						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[above-header-layout]',
							'operator' => '!=',
							'value'    => 'disabled',
						),
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[above-header-section-1]',
							'operator' => '==',
							'value'    => 'text-html',
						),
					),
					'partial'   => array(
						'selector'            => '.ast-above-header-section-1 .user-select  .ast-custom-html',
						'container_inclusive' => false,
						'render_callback'     => 'Astra_Customizer_Header_Sections_Partials::_render_above_header_section_1_html',
					),
					'title'     => __( 'Text/HTML', 'astra-addon' ),
				),

				/**
				 * Option: Section 2
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[above-header-section-2]',
					'type'     => 'control',
					'control'  => 'ast-select',
					'section'  => 'section-above-header',
					'priority' => 60,
					'default'  => astra_get_option( 'above-header-section-2' ),
					'choices'  => $sections,
					'divider'  => array(
						'ast_class' => 'ast-top-divider ast-bottom-divider',
						'ast_title' => __( 'Section 2', 'astra-addon' ),
					),
					'context'  => array(
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[above-header-layout]',
							'operator' => '==',
							'value'    => 'above-header-layout-1',
						),
					),
				),

				/**
				 * Option: Text/HTML
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[above-header-section-2-html]',
					'type'      => 'control',
					'control'   => 'textarea',
					'transport' => 'postMessage',
					'section'   => 'section-above-header',
					'default'   => astra_get_option( 'above-header-section-2-html' ),
					'priority'  => 75,
					'context'   => array(

						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[above-header-layout]',
							'operator' => '==',
							'value'    => 'above-header-layout-1',
						),
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[above-header-section-2]',
							'operator' => '==',
							'value'    => 'text-html',
						),
					),
					'partial'   => array(
						'selector'            => '.ast-above-header-section-2 .user-select .ast-custom-html',
						'container_inclusive' => false,
						'render_callback'     => 'Astra_Customizer_Header_Sections_Partials::_render_above_header_section_2_html',
					),
					'title'     => __( 'Text/HTML', 'astra-addon' ),
				),

				/**
				 * Option: Above Header Height
				 */
				array(
					'name'        => ASTRA_THEME_SETTINGS . '[above-header-height]',
					'section'     => 'section-above-header',
					'priority'    => 84,
					'transport'   => 'postMessage',
					'title'       => __( 'Height', 'astra-addon' ),
					'default'     => astra_get_option( 'above-header-height' ),
					'context'     => array(

						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[above-header-layout]',
							'operator' => '!=',
							'value'    => 'disabled',
						),
					),
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
				 * Option: Above Header Bottom Border
				 */
				array(
					'name'        => ASTRA_THEME_SETTINGS . '[above-header-divider]',
					'section'     => 'section-above-header',
					'priority'    => 85,
					'transport'   => 'postMessage',
					'context'     => array(
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[above-header-layout]',
							'operator' => '!=',
							'value'    => 'disabled',
						),
					),
					'default'     => astra_get_option( 'above-header-divider' ),
					'title'       => __( 'Bottom Border', 'astra-addon' ),
					'type'        => 'control',
					'suffix'      => 'px',
					'control'     => 'ast-slider',
					'input_attrs' => array(
						'min'  => 0,
						'step' => 1,
						'max'  => 600,
					),
				),

				/**
				 * Option: Above Header Bottom Border Color
				 */
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[above-header-divider-color]',
					'type'              => 'control',
					'control'           => 'ast-color',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
					'transport'         => 'postMessage',
					'default'           => astra_get_option( 'above-header-divider-color' ),
					'context'           => array(
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[above-header-layout]',
							'operator' => '!=',
							'value'    => 'disabled',
						),
					),
					'section'           => 'section-above-header',
					'priority'          => 90,
					'title'             => __( 'Bottom Border Color', 'astra-addon' ),
				),

				/**
				 * Option: Above Header Menu Typography Styling
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[above-header-typography-menu-styling]',
					'default'   => astra_get_option( 'above-header-typography-menu-styling' ),
					'type'      => 'control',
					'control'   => 'ast-settings-group',
					'title'     => __( 'Menu Font', 'astra-addon' ),
					'section'   => 'section-above-header',
					'transport' => 'postMessage',
					'priority'  => 132,
					'divider'   => array( 'ast_class' => 'ast-bottom-divider ast-top-divider' ),
					'context'   => array(
						'relation' => 'OR',
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
				 * Option: Above Header Submenu Typography Styling
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[above-header-typography-submenu-styling]',
					'default'   => astra_get_option( 'above-header-typography-submenu-styling' ),
					'type'      => 'control',
					'control'   => 'ast-settings-group',
					'title'     => __( 'Submenu Font', 'astra-addon' ),
					'section'   => 'section-above-header',
					'transport' => 'postMessage',
					'divider'   => array( 'ast_class' => 'ast-bottom-divider' ),
					'priority'  => 132,
					'context'   => array(
						'relation' => 'OR',
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
				* Option: Above Header typography Group
				*/
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[above-header-content-typography-styling]',
					'default'   => astra_get_option( 'above-header-content-typography-styling' ),
					'type'      => 'control',
					'control'   => 'ast-settings-group',
					'divider'   => array( 'ast_class' => 'ast-bottom-divider' ),
					'title'     => __( 'Content Font', 'astra-addon' ),
					'section'   => 'section-above-header',
					'transport' => 'postMessage',
					'priority'  => 132,
					'context'   => array(
						'relation' => 'AND',
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[above-header-layout]',
							'operator' => '!=',
							'value'    => 'disabled',
						),
						array(
							'relation' => 'OR',
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[above-header-section-1]',
								'operator' => 'in',
								'value'    => array( 'search', 'text-html', 'widget' ),
							),
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[above-header-section-2]',
								'operator' => 'in',
								'value'    => array( 'search', 'text-html', 'widget' ),
							),
						),
					),
				),

				/**
				 * Option: Above Header Menus Styling
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[above-header-menu-colors]',
					'default'   => astra_get_option( 'above-header-menu-colors' ),
					'type'      => 'control',
					'control'   => 'ast-settings-group',
					'title'     => __( 'Menu Colors', 'astra-addon' ),
					'section'   => 'section-above-header',
					'transport' => 'postMessage',
					'priority'  => 131,
					'divider'   => array( 'ast_class' => 'ast-bottom-divider' ),
					'context'   => array(
						'relation' => 'OR',
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
				 * Option: Above Header Menus Styling
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[above-header-submenu-colors]',
					'default'   => astra_get_option( 'above-header-submenu-colors' ),
					'type'      => 'control',
					'control'   => 'ast-settings-group',
					'title'     => __( 'Submenu Colors', 'astra-addon' ),
					'section'   => 'section-above-header',
					'transport' => 'postMessage',
					'priority'  => 131,
					'divider'   => array( 'ast_class' => 'ast-bottom-divider' ),
					'context'   => array(
						'relation' => 'OR',

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
				 * Option: Above Header Content Section Styling
				 */
				array(
					'name'       => ASTRA_THEME_SETTINGS . '[above-header-content-section-link-styling]',
					'default'    => astra_get_option( 'above-header-content-section-styling' ),
					'type'       => 'control',
					'control'    => Astra_Theme_Extension::$group_control,
					'title'      => __( 'Link', 'astra-addon' ),
					'section'    => 'section-above-header',
					'transport'  => 'postMessage',
					'priority'   => 131,
					'responsive' => true,
					'context'    => array(
						'relation' => 'AND',
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[above-header-layout]',
							'operator' => '!=',
							'value'    => 'disabled',
						),
						array(
							'relation' => 'OR',
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[above-header-section-1]',
								'operator' => 'in',
								'value'    => array( 'search', 'text-html', 'widget' ),
							),
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[above-header-section-2]',
								'operator' => 'in',
								'value'    => array( 'search', 'text-html', 'widget' ),
							),
						),
					),
				),

				/**
				 * Option: Above Header Submenu Border Divier
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[above-header-submenu-border-divider]',
					'type'     => 'control',
					'control'  => 'ast-heading',
					'title'    => __( 'Submenu', 'astra-addon' ),
					'context'  => array(
						'relation' => 'OR',
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
					'section'  => 'section-above-header',
					'priority' => 95,
					'settings' => array(),
				),

				/**
				 * Option: Submenu Container Animation
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[above-header-submenu-container-animation]',
					'default'  => astra_get_option( 'above-header-submenu-container-animation' ),
					'type'     => 'control',
					'control'  => 'ast-select',
					'section'  => 'section-above-header',
					'priority' => 95,
					'title'    => __( 'Submenu Container Animation', 'astra-addon' ),
					'context'  => array(
						'relation' => 'OR',
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
					'choices'  => array(
						''           => __( 'Default', 'astra-addon' ),
						'slide-down' => __( 'Slide Down', 'astra-addon' ),
						'slide-up'   => __( 'Slide Up', 'astra-addon' ),
						'fade'       => __( 'Fade', 'astra-addon' ),
					),
				),

				/**
				 * Option: Submenu Border
				 */
				array(
					'name'           => ASTRA_THEME_SETTINGS . '[above-header-submenu-border]',
					'type'           => 'control',
					'control'        => 'ast-border',
					'transport'      => 'postMessage',
					'context'        => array(
						'relation' => 'OR',
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
					'section'        => 'section-above-header',
					'default'        => astra_get_option( 'above-header-submenu-border' ),
					'title'          => __( 'Container Border', 'astra-addon' ),
					'linked_choices' => true,
					'priority'       => 95,
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
					'name'              => ASTRA_THEME_SETTINGS . '[above-header-submenu-border-color]',
					'type'              => 'control',
					'context'           => array(
						'relation' => 'OR',
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
					'control'           => 'ast-color',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
					'default'           => astra_get_option( 'above-header-submenu-border-color' ),
					'priority'          => 95,
					'transport'         => 'postMessage',
					'section'           => 'section-above-header',
					'title'             => __( 'Border Color', 'astra-addon' ),
				),

				/**
				 * Option: Submenu Divider
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[above-header-submenu-item-border]',
					'type'      => 'control',
					'control'   => Astra_Theme_Extension::$switch_control,
					'transport' => 'postMessage',
					'context'   => array(
						'relation' => 'OR',
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
					'section'   => 'section-above-header',
					'default'   => astra_get_option( 'above-header-submenu-item-border' ),
					'title'     => __( 'Submenu Divider', 'astra-addon' ),
					'priority'  => 95,
				),

				/**
				 * Option: Submenu Border Color
				 */
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[above-header-submenu-item-b-color]',
					'type'              => 'control',
					'context'           => array(

						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[above-header-submenu-item-border]',
							'operator' => '==',
							'value'    => true,
						),
					),

					'control'           => 'ast-color',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
					'default'           => astra_get_option( 'above-header-submenu-item-b-color' ),
					'priority'          => 95,
					'transport'         => 'postMessage',
					'section'           => 'section-above-header',
					'title'             => __( 'Divider Color', 'astra-addon' ),
				),

				/**
				 * Option: Mobile Menu Label Divider
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[above-header-mobile-menu-divider]',
					'type'     => 'control',
					'control'  => 'ast-heading',
					'context'  => array(
						'relation' => 'AND',
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[above-header-layout]',
							'operator' => '!=',
							'value'    => 'disabled',
						),
						array(
							'relation' => 'OR',
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[above-header-section-1]',
								'operator' => '!=',
								'value'    => '',
							),
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[above-header-section-2]',
								'operator' => '!=',
								'value'    => '',
							),
						),

					),
					'section'  => 'section-above-header',
					'title'    => __( 'Mobile Header', 'astra-addon' ),
					'priority' => 100,
					'settings' => array(),
				),

				/**
				 * Option: Display Above Header on Mobile
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[above-header-on-mobile]',
					'type'     => 'control',
					'control'  => Astra_Theme_Extension::$switch_control,
					'divider'  => array( 'ast_class' => 'ast-bottom-divider' ),
					'context'  => array(
						'relation' => 'AND',
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[above-header-layout]',
							'operator' => '!=',
							'value'    => 'disabled',
						),
						array(
							'relation' => 'OR',
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[above-header-section-1]',
								'operator' => '!=',
								'value'    => '',
							),
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[above-header-section-2]',
								'operator' => '!=',
								'value'    => '',
							),
						),

					),
					'default'  => astra_get_option( 'above-header-on-mobile' ),
					'section'  => 'section-above-header',
					'title'    => __( 'Display on Mobile Devices', 'astra-addon' ),
					'priority' => 101,
				),

				/**
				 * Option: Merged with primary header menu
				 */
				array(
					'name'        => ASTRA_THEME_SETTINGS . '[above-header-merge-menu]',
					'default'     => astra_get_option( 'above-header-merge-menu' ),
					'type'        => 'control',
					'control'     => Astra_Theme_Extension::$switch_control,
					'context'     => array(
						'relation' => 'OR',
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
					'divider'     => array( 'ast_class' => 'ast-bottom-divider' ),
					'section'     => 'section-above-header',
					'title'       => __( 'Merge Menu on Mobile Devices', 'astra-addon' ),
					'description' => __( 'You can merge menu with primary menu in mobile devices by enabling this option.', 'astra-addon' ),
					'priority'    => 101,
				),

				/**
				 * Option: Swap section on mobile devices
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[above-header-swap-mobile]',
					'type'     => 'control',
					'control'  => Astra_Theme_Extension::$switch_control,
					'context'  => array(

						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[above-header-layout]',
							'operator' => '==',
							'value'    => 'above-header-layout-1',
						),
					),
					'divider'  => array( 'ast_class' => 'ast-bottom-divider' ),
					'section'  => 'section-above-header',
					'default'  => astra_get_option( 'above-header-swap-mobile' ),
					'title'    => __( 'Swap Sections on Mobile Devices', 'astra-addon' ),
					'priority' => 101,
				),

				/**
				 * Option: Mobile Menu Alignment
				 */
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[above-header-menu-align]',
					'default'           => astra_get_option( 'above-header-menu-align' ),
					'section'           => 'section-above-header',
					'priority'          => 101,
					'title'             => __( 'Layout', 'astra-addon' ),
					'type'              => 'control',
					'control'           => 'ast-radio-image',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_choices' ),
					'context'           => array(
						'relation' => 'AND',
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[above-header-layout]',
							'operator' => '!=',
							'value'    => 'disabled',
						),
						array(
							'relation' => 'OR',
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[above-header-section-1]',
								'operator' => '!=',
								'value'    => '',
							),
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[above-header-section-2]',
								'operator' => '!=',
								'value'    => '',
							),
						),

					),
					'choices'           => array(
						'inline' => array(
							'label' => __( 'Inline', 'astra-addon' ),
							'path'  => ( class_exists( 'Astra_Builder_UI_Controller' ) ) ? Astra_Builder_UI_Controller::fetch_svg_icon( 'menu-inline', false ) : '',
						),
						'stack'  => array(
							'label' => __( 'Stack', 'astra-addon' ),
							'path'  => ( class_exists( 'Astra_Builder_UI_Controller' ) ) ? Astra_Builder_UI_Controller::fetch_svg_icon( 'menu-stack', false ) : '',
						),
					),
				),

				/**
				 * Option: Mobile Menu Label
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[above-header-menu-label]',
					'type'      => 'control',
					'control'   => 'text',
					'context'   => array(
						'relation' => 'AND',
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[above-header-layout]',
							'operator' => '!=',
							'value'    => 'disabled',
						),
						array(
							'relation' => 'OR',
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[above-header-on-mobile]',
								'operator' => '==',
								'value'    => true,
							),
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[above-header-merge-menu]',
								'operator' => '!=',
								'value'    => true,
							),
						),
						array(
							'relation' => 'OR',
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
					'section'   => 'section-above-header',
					'default'   => astra_get_option( 'above-header-menu-label' ),
					'transport' => 'postMessage',
					'priority'  => 101,
					'title'     => __( 'Menu Label', 'astra-addon' ),
				),
			);

			return array_merge( $configurations, $_config );
		}

	}
}

new Astra_Above_Header_Configs();
