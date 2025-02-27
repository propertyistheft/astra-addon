<?php
/**
 * Section [Sidebar] options for astra theme.
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

if ( ! class_exists( 'Astra_Sidebar_Typo_Configs' ) ) {

	/**
	 * Register below header Configurations.
	 */
	// @codingStandardsIgnoreStart
	class Astra_Sidebar_Typo_Configs extends Astra_Customizer_Config_Base {
 // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedClassFound
		// @codingStandardsIgnoreEnd

		/**
		 * Register Side bar typography Customizer Configurations.
		 *
		 * @param Array                $configurations Astra Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array Astra Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_configs = array(

				/**
				 * Option: Divider
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[sidebar-typography-divider]',
					'section'  => 'section-sidebars',
					'title'    => __( 'Font', 'astra-addon' ),
					'type'     => 'control',
					'control'  => 'ast-heading',
					'priority' => 24,
					'divider'  => array( 'ast_class' => 'ast-section-spacing' ),
					'context'  => true === astra_addon_builder_helper()->is_header_footer_builder_active ?
						astra_addon_builder_helper()->design_tab : astra_addon_builder_helper()->general_tab,
				),

				/**
				 * Option: SideBar title typography Group
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[sidebar-title-typography-group]',
					'default'   => astra_get_option( 'sidebar-title-typography-group' ),
					'type'      => 'control',
					'control'   => 'ast-settings-group',
					'title'     => __( 'Title Font', 'astra-addon' ),
					'section'   => 'section-sidebars',
					'transport' => 'postMessage',
					'priority'  => 24,
					'divider'   => array( 'ast_class' => 'ast-section-spacing' ),
					'context'   => true === astra_addon_builder_helper()->is_header_footer_builder_active ?
						astra_addon_builder_helper()->design_tab : astra_addon_builder_helper()->general_tab,
				),

				/**
				 * Option: Widget Title Font Family
				 */
				array(
					'name'      => 'font-family-widget-title',
					'type'      => 'sub-control',
					'parent'    => ASTRA_THEME_SETTINGS . '[sidebar-title-typography-group]',
					'section'   => 'section-sidebars',
					'control'   => 'ast-font',
					'font_type' => 'ast-font-family',
					'default'   => astra_get_option( 'font-family-widget-title' ),
					'title'     => __( 'Font Family', 'astra-addon' ),
					'connect'   => ASTRA_THEME_SETTINGS . '[font-weight-widget-title]',
					'divider'   => array( 'ast_class' => 'ast-sub-bottom-dotted-divider' ),
				),

				/**
				 * Option: Widget Title Font Weight
				 */
				array(
					'name'              => 'font-weight-widget-title',
					'type'              => 'sub-control',
					'parent'            => ASTRA_THEME_SETTINGS . '[sidebar-title-typography-group]',
					'section'           => 'section-sidebars',
					'control'           => 'ast-font',
					'font_type'         => 'ast-font-weight',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_font_weight' ),
					'default'           => astra_get_option( 'font-weight-widget-title' ),
					'title'             => __( 'Font Weight', 'astra-addon' ),
					'connect'           => 'font-family-widget-title',
					'divider'           => array( 'ast_class' => 'ast-sub-bottom-dotted-divider' ),
				),

				/**
				 * Option: Widget Title Font Size
				 */
				array(
					'name'              => 'font-size-widget-title',
					'type'              => 'sub-control',
					'parent'            => ASTRA_THEME_SETTINGS . '[sidebar-title-typography-group]',
					'section'           => 'section-sidebars',
					'transport'         => 'postMessage',
					'default'           => astra_get_option( 'font-size-widget-title' ),
					'control'           => 'ast-responsive-slider',
					'title'             => __( 'Font Size', 'astra-addon' ),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_responsive_slider' ),
					'suffix'            => array( 'px', 'em', 'vw', 'rem' ),
					'input_attrs'       => array(
						'px'  => array(
							'min'  => 0,
							'step' => 1,
							'max'  => 200,
						),
						'em'  => array(
							'min'  => 0,
							'step' => 0.01,
							'max'  => 20,
						),
						'vw'  => array(
							'min'  => 0,
							'step' => 0.1,
							'max'  => 25,
						),
						'rem' => array(
							'min'  => 0,
							'step' => 0.1,
							'max'  => 20,
						),
					),
				),

				/**
				 * Option: Widget Title Font Extras
				 */
				array(
					'name'    => 'font-extras-widget-title',
					'type'    => 'sub-control',
					'parent'  => ASTRA_THEME_SETTINGS . '[sidebar-title-typography-group]',
					'control' => 'ast-font-extras',
					'section' => 'section-sidebars',
					'default' => astra_get_option( 'font-extras-widget-title' ),
					'title'   => __( 'Font Extras', 'astra-addon' ),
				),

				/**
				 * Option: SideBar Content typography Group
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[sidebar-content-typography-group]',
					'default'   => astra_get_option( 'sidebar-content-typography-group' ),
					'type'      => 'control',
					'control'   => 'ast-settings-group',
					'title'     => __( 'Content Font', 'astra-addon' ),
					'section'   => 'section-sidebars',
					'transport' => 'postMessage',
					'priority'  => 24,
					'context'   => true === astra_addon_builder_helper()->is_header_footer_builder_active ?
						astra_addon_builder_helper()->design_tab : astra_addon_builder_helper()->general_tab,
				),

				/**
				 * Option: Widget Content Font Family
				 */
				array(
					'name'      => 'font-family-widget-content',
					'control'   => 'ast-font',
					'font_type' => 'ast-font-family',
					'type'      => 'sub-control',
					'parent'    => ASTRA_THEME_SETTINGS . '[sidebar-content-typography-group]',
					'section'   => 'section-sidebars',
					'default'   => astra_get_option( 'font-family-widget-content' ),
					'title'     => __( 'Font Family', 'astra-addon' ),
					'connect'   => ASTRA_THEME_SETTINGS . '[font-weight-widget-content]',
					'divider'   => array( 'ast_class' => 'ast-sub-bottom-dotted-divider' ),
				),

				/**
				 * Option: Widget Content Font Weight
				 */
				array(
					'name'              => 'font-weight-widget-content',
					'type'              => 'sub-control',
					'parent'            => ASTRA_THEME_SETTINGS . '[sidebar-content-typography-group]',
					'section'           => 'section-sidebars',
					'control'           => 'ast-font',
					'font_type'         => 'ast-font-weight',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_font_weight' ),
					'default'           => astra_get_option( 'font-weight-widget-content' ),
					'title'             => __( 'Font Weight', 'astra-addon' ),
					'connect'           => 'font-family-widget-content',
					'divider'           => array( 'ast_class' => 'ast-sub-bottom-dotted-divider' ),
				),

				/**
				 * Option: Widget Content Font Size
				 */

				array(
					'name'              => 'font-size-widget-content',
					'type'              => 'sub-control',
					'parent'            => ASTRA_THEME_SETTINGS . '[sidebar-content-typography-group]',
					'section'           => 'section-sidebars',
					'control'           => 'ast-responsive-slider',
					'default'           => astra_get_option( 'font-size-widget-content' ),
					'title'             => __( 'Font Size', 'astra-addon' ),
					'transport'         => 'postMessage',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_responsive_slider' ),
					'suffix'            => array( 'px', 'em', 'vw', 'rem' ),
					'input_attrs'       => array(
						'px'  => array(
							'min'  => 0,
							'step' => 1,
							'max'  => 200,
						),
						'em'  => array(
							'min'  => 0,
							'step' => 0.01,
							'max'  => 20,
						),
						'vw'  => array(
							'min'  => 0,
							'step' => 0.1,
							'max'  => 25,
						),
						'rem' => array(
							'min'  => 0,
							'step' => 0.1,
							'max'  => 20,
						),
					),
				),

				/**
				 * Option: Widget Content Font Extras
				 */
				array(
					'name'    => 'font-extras-widget-content',
					'type'    => 'sub-control',
					'parent'  => ASTRA_THEME_SETTINGS . '[sidebar-content-typography-group]',
					'control' => 'ast-font-extras',
					'section' => 'section-sidebars',
					'default' => astra_get_option( 'font-extras-widget-content' ),
					'title'   => __( 'Font Extras', 'astra-addon' ),
				),

				/**
				 * Option: Widget Title Font Size
				 */

				array(
					'name'              => ASTRA_THEME_SETTINGS . '[font-size-sidebar-title]',
					'type'              => 'control',
					'control'           => 'ast-responsive-slider',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_responsive_slider' ),
					'section'           => 'section-sidebars',
					'transport'         => 'refresh',
					'title'             => __( 'Widget Title Size', 'astra-addon' ),
					'priority'          => 24,
					'default'           => astra_get_option( 'font-size-sidebar-title' ),
					'suffix'            => array( 'px', 'em', 'vw', 'rem' ),
					'input_attrs'       => array(
						'px'  => array(
							'min'  => 0,
							'step' => 1,
							'max'  => 200,
						),
						'em'  => array(
							'min'  => 0,
							'step' => 0.01,
							'max'  => 20,
						),
						'vw'  => array(
							'min'  => 0,
							'step' => 0.1,
							'max'  => 25,
						),
						'rem' => array(
							'min'  => 0,
							'step' => 0.1,
							'max'  => 20,
						),
					),
					'divider'           => array( 'ast_class' => 'ast-top-section-divider ast-bottom-section-divider' ),
					'context'           => true === astra_addon_builder_helper()->is_header_footer_builder_active ?
						astra_addon_builder_helper()->design_tab : astra_addon_builder_helper()->general_tab,
				),

				/**
				 * Option: Widget Font Size
				 */

				array(
					'name'              => ASTRA_THEME_SETTINGS . '[font-size-sidebar-content]',
					'type'              => 'control',
					'control'           => 'ast-responsive-slider',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_responsive_slider' ),
					'section'           => 'section-sidebars',
					'transport'         => 'refresh',
					'title'             => __( 'Widget Font Size ', 'astra-addon' ),
					'priority'          => 24,
					'default'           => astra_get_option( 'font-size-sidebar-content' ),
					'suffix'            => array( 'em' ),
					'input_attrs'       => array(
						'em' => array(
							'min'  => 0,
							'step' => 0.01,
							'max'  => 5,
						),
					),
					'context'           => true === astra_addon_builder_helper()->is_header_footer_builder_active ?
						astra_addon_builder_helper()->design_tab : astra_addon_builder_helper()->general_tab,
				),
			);

			if ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) {
				$_configs[] = array(
					'name'        => 'section-sidebars-ast-context-tabs',
					'section'     => 'section-sidebars',
					'type'        => 'control',
					'control'     => 'ast-builder-header-control',
					'priority'    => 0,
					'description' => '',
				);
			}

			return array_merge( $configurations, $_configs );
		}
	}
}

new Astra_Sidebar_Typo_Configs();
