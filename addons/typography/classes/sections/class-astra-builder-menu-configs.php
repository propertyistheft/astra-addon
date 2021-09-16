<?php
/**
 * [Primary Menu] options for astra theme.
 *
 * @package     Astra Addon
 * @author      Brainstorm Force
 * @copyright   Copyright (c) 2020, Brainstorm Force
 * @link        https://www.brainstormforce.com
 * @since       3.0.0
 */

// Block direct access to the file.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Bail if Customizer config base class does not exist.
if ( ! class_exists( 'Astra_Customizer_Config_Base' ) ) {
	return;
}

if ( ! class_exists( 'Astra_Builder_Menu_Configs' ) ) {

	/**
	 * Register below header Configurations.
	 */
	class Astra_Builder_Menu_Configs extends Astra_Customizer_Config_Base {

		/**
		 * Register Primary Menu typography Customizer Configurations.
		 *
		 * @param Array                $configurations Astra Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 3.0.0
		 * @return Array Astra Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			/**
			 * Header - Menu - Typography
			 */

			$html_config = array();

			$component_limit = astra_addon_builder_helper()->component_limit;
			for ( $index = 1; $index <= $component_limit; $index++ ) {

				$_section = 'section-hb-menu-' . $index;
				$_prefix  = 'menu' . $index;

				$_configs = array(
					// Option Group: Primary SubMenu Typography.
					array(
						'name'     => ASTRA_THEME_SETTINGS . '[header-' . $_prefix . '-sub-menu-typography]',
						'type'     => 'control',
						'control'  => 'ast-settings-group',
						'title'    => __( 'Submenu Font', 'astra-addon' ),
						'section'  => $_section,
						'priority' => 130,
						'context'  => array(
							array(
								'setting' => 'ast_selected_tab',
								'value'   => 'design',
							),
						),
						'divider'  => array( 'ast_class' => 'ast-bottom-divider' ),
					),

					// Option: Primary Submenu Font Family.
					array(
						'name'      => 'header-font-family-' . $_prefix . '-sub-menu',
						'default'   => astra_get_option( 'header-font-family-' . $_prefix . '-sub-menu' ),
						'parent'    => ASTRA_THEME_SETTINGS . '[header-' . $_prefix . '-sub-menu-typography]',
						'type'      => 'sub-control',
						'section'   => $_section,
						'control'   => 'ast-font',
						'transport' => 'postMessage',
						'font_type' => 'ast-font-family',
						'title'     => __( 'Family', 'astra-addon' ),
						'priority'  => 28,
						'connect'   => 'header-font-weight-' . $_prefix . '-sub-menu',
						'context'   => array(
							array(
								'setting' => 'ast_selected_tab',
								'value'   => 'general',
							),
						),
					),

					// Option: Primary Submenu Font Weight.
					array(
						'name'              => 'header-font-weight-' . $_prefix . '-sub-menu',
						'default'           => astra_get_option( 'header-font-weight-' . $_prefix . '-sub-menu' ),
						'parent'            => ASTRA_THEME_SETTINGS . '[header-' . $_prefix . '-sub-menu-typography]',
						'type'              => 'sub-control',
						'section'           => $_section,
						'control'           => 'ast-font',
						'transport'         => 'postMessage',
						'font_type'         => 'ast-font-weight',
						'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_font_weight' ),
						'title'             => __( 'Weight', 'astra-addon' ),
						'priority'          => 30,
						'connect'           => 'header-font-family-' . $_prefix . '-sub-menu',
						'context'           => array(
							array(
								'setting' => 'ast_selected_tab',
								'value'   => 'general',
							),
						),
					),

					// Option: Primary Submenu Text Transform.
					array(
						'name'      => 'header-text-transform-' . $_prefix . '-sub-menu',
						'default'   => astra_get_option( 'header-text-transform-' . $_prefix . '-sub-menu' ),
						'parent'    => ASTRA_THEME_SETTINGS . '[header-' . $_prefix . '-sub-menu-typography]',
						'section'   => $_section,
						'type'      => 'sub-control',
						'title'     => __( 'Text Transform', 'astra-addon' ),
						'transport' => 'postMessage',
						'priority'  => 31,
						'control'   => 'ast-select',
						'choices'   => array(
							''           => __( 'Inherit', 'astra-addon' ),
							'none'       => __( 'None', 'astra-addon' ),
							'capitalize' => __( 'Capitalize', 'astra-addon' ),
							'uppercase'  => __( 'Uppercase', 'astra-addon' ),
							'lowercase'  => __( 'Lowercase', 'astra-addon' ),
						),
						'context'   => array(
							array(
								'setting' => 'ast_selected_tab',
								'value'   => 'general',
							),
						),
					),

					// Option: Primary Submenu Font Size.
					array(
						'name'        => 'header-font-size-' . $_prefix . '-sub-menu',
						'default'     => astra_get_option( 'header-font-size-' . $_prefix . '-sub-menu' ),
						'parent'      => ASTRA_THEME_SETTINGS . '[header-' . $_prefix . '-sub-menu-typography]',
						'section'     => $_section,
						'title'       => __( 'Size', 'astra-addon' ),
						'type'        => 'sub-control',
						'control'     => 'ast-responsive',
						'transport'   => 'postMessage',
						'priority'    => 29,
						'input_attrs' => array(
							'min' => 0,
						),
						'units'       => array(
							'px' => 'px',
							'em' => 'em',
						),
						'context'     => array(
							array(
								'setting' => 'ast_selected_tab',
								'value'   => 'general',
							),
						),
					),

					// Option: Primary Submenu Line Height.
					array(
						'name'              => 'header-line-height-' . $_prefix . '-sub-menu',
						'parent'            => ASTRA_THEME_SETTINGS . '[header-' . $_prefix . '-sub-menu-typography]',
						'section'           => $_section,
						'type'              => 'sub-control',
						'priority'          => 32,
						'title'             => __( 'Line Height', 'astra-addon' ),
						'transport'         => 'postMessage',
						'default'           => astra_get_option( 'header-line-height-' . $_prefix . '-sub-menu' ),
						'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_number_n_blank' ),
						'control'           => 'ast-slider',
						'suffix'            => 'em',
						'input_attrs'       => array(
							'min'  => 1,
							'step' => 0.01,
							'max'  => 5,
						),
						'context'           => array(
							array(
								'setting' => 'ast_selected_tab',
								'value'   => 'general',
							),
						),
					),
				);

				$html_config[] = $_configs;

				if ( 3 > $index ) {
					$_configs = array(
						// Option Group: Primary Mega Menu col Typography.
						array(
							'name'     => ASTRA_THEME_SETTINGS . '[header-' . $_prefix . '-mega-menu-col-typography]',
							'type'     => 'control',
							'control'  => 'ast-settings-group',
							'title'    => __( 'Mega Menu Heading', 'astra-addon' ),
							'section'  => $_section,
							'priority' => 131,
							'divider'  => array( 'ast_class' => 'ast-bottom-divider' ),
							'context'  => array(
								array(
									'setting' => 'ast_selected_tab',
									'value'   => 'design',
								),
							),
						),

						// Option: Primary Megamenu Header Menu Font Family.
						array(
							'name'      => 'header-' . $_prefix . '-megamenu-heading-font-family',
							'default'   => astra_get_option( 'header-' . $_prefix . '-megamenu-heading-font-family' ),
							'parent'    => ASTRA_THEME_SETTINGS . '[header-' . $_prefix . '-mega-menu-col-typography]',
							'transport' => 'postMessage',
							'type'      => 'sub-control',
							'section'   => $_section,
							'control'   => 'ast-font',
							'font_type' => 'ast-font-family',
							'title'     => __( 'Family', 'astra-addon' ),
							'connect'   => ASTRA_THEME_SETTINGS . '[header-' . $_prefix . '-megamenu-heading-font-weight]',
							'priority'  => 10,
							'context'   => array(
								array(
									'setting' => 'ast_selected_tab',
									'value'   => 'general',
								),
							),
						),

						// Option: Primary Megamenu Header Menu Font Size.
						array(
							'name'        => 'header-' . $_prefix . '-megamenu-heading-font-size',
							'default'     => astra_get_option( 'header-' . $_prefix . '-megamenu-heading-font-size' ),
							'parent'      => ASTRA_THEME_SETTINGS . '[header-' . $_prefix . '-mega-menu-col-typography]',
							'transport'   => 'postMessage',
							'title'       => __( 'Size', 'astra-addon' ),
							'type'        => 'sub-control',
							'section'     => $_section,
							'control'     => 'ast-responsive',
							'input_attrs' => array(
								'min' => 0,
							),
							'units'       => array(
								'px' => 'px',
								'em' => 'em',
							),
							'priority'    => 20,
							'context'     => array(
								array(
									'setting' => 'ast_selected_tab',
									'value'   => 'general',
								),
							),
						),

						// Option: Primary Megamenu Header Menu Font Weight.
						array(
							'name'              => 'header-' . $_prefix . '-megamenu-heading-font-weight',
							'default'           => astra_get_option( 'header-' . $_prefix . '-megamenu-heading-font-weight' ),
							'parent'            => ASTRA_THEME_SETTINGS . '[header-' . $_prefix . '-mega-menu-col-typography]',
							'type'              => 'sub-control',
							'section'           => $_section,
							'control'           => 'ast-font',
							'font_type'         => 'ast-font-weight',
							'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_font_weight' ),
							'title'             => __( 'Weight', 'astra-addon' ),
							'connect'           => 'header-' . $_prefix . '-megamenu-heading-font-family',
							'priority'          => 30,
							'transport'         => 'postMessage',
							'context'           => array(
								array(
									'setting' => 'ast_selected_tab',
									'value'   => 'general',
								),
							),
						),

						// Option: Primary Megamenu Header Menu Text Transform.
						array(
							'name'      => 'header-' . $_prefix . '-megamenu-heading-text-transform',
							'default'   => astra_get_option( 'header-' . $_prefix . '-megamenu-heading-text-transform' ),
							'parent'    => ASTRA_THEME_SETTINGS . '[header-' . $_prefix . '-mega-menu-col-typography]',
							'type'      => 'sub-control',
							'section'   => $_section,
							'control'   => 'ast-select',
							'title'     => __( 'Text Transform', 'astra-addon' ),
							'transport' => 'postMessage',
							'choices'   => array(
								''           => __( 'Inherit', 'astra-addon' ),
								'none'       => __( 'None', 'astra-addon' ),
								'capitalize' => __( 'Capitalize', 'astra-addon' ),
								'uppercase'  => __( 'Uppercase', 'astra-addon' ),
								'lowercase'  => __( 'Lowercase', 'astra-addon' ),
							),
							'priority'  => 40,
							'context'   => array(
								array(
									'setting' => 'ast_selected_tab',
									'value'   => 'general',
								),
							),
						),
					);

					$html_config[] = $_configs;
				}
			}

			/**
			 * Footer - Menu - Typography
			 */

			$_section = 'section-footer-menu';

			$html_config[] = array(
				// Option: Menu Font Family.
				array(
					'name'      => 'footer-menu-font-family',
					'default'   => astra_get_option( 'footer-menu-font-family' ),
					'parent'    => ASTRA_THEME_SETTINGS . '[footer-menu-typography]',
					'type'      => 'sub-control',
					'section'   => $_section,
					'transport' => 'postMessage',
					'control'   => 'ast-font',
					'font_type' => 'ast-font-family',
					'title'     => __( 'Family', 'astra-addon' ),
					'priority'  => 22,
					'connect'   => 'footer-menu-font-weight',
					'context'   => astra_addon_builder_helper()->general_tab,
				),

				// Option: Menu Font Weight.
				array(
					'name'              => 'footer-menu-font-weight',
					'default'           => astra_get_option( 'footer-menu-font-weight' ),
					'parent'            => ASTRA_THEME_SETTINGS . '[footer-menu-typography]',
					'section'           => $_section,
					'type'              => 'sub-control',
					'control'           => 'ast-font',
					'transport'         => 'postMessage',
					'font_type'         => 'ast-font-weight',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_font_weight' ),
					'title'             => __( 'Weight', 'astra-addon' ),
					'priority'          => 24,
					'connect'           => 'footer-menu-font-family',
					'context'           => astra_addon_builder_helper()->general_tab,
				),

				// Option: Menu Text Transform.
				array(
					'name'      => 'footer-menu-text-transform',
					'default'   => astra_get_option( 'footer-menu-text-transform' ),
					'parent'    => ASTRA_THEME_SETTINGS . '[footer-menu-typography]',
					'section'   => $_section,
					'type'      => 'sub-control',
					'control'   => 'ast-select',
					'transport' => 'postMessage',
					'title'     => __( 'Text Transform', 'astra-addon' ),
					'priority'  => 25,
					'choices'   => array(
						''           => __( 'Inherit', 'astra-addon' ),
						'none'       => __( 'None', 'astra-addon' ),
						'capitalize' => __( 'Capitalize', 'astra-addon' ),
						'uppercase'  => __( 'Uppercase', 'astra-addon' ),
						'lowercase'  => __( 'Lowercase', 'astra-addon' ),
					),
					'context'   => astra_addon_builder_helper()->general_tab,
				),

				// Option: Menu Line Height.
				array(
					'name'              => 'footer-menu-line-height',
					'parent'            => ASTRA_THEME_SETTINGS . '[footer-menu-typography]',
					'section'           => $_section,
					'type'              => 'sub-control',
					'priority'          => 26,
					'title'             => __( 'Line Height', 'astra-addon' ),
					'suffix'            => 'em',
					'transport'         => 'postMessage',
					'default'           => astra_get_option( 'footer-menu-line-height' ),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_number_n_blank' ),
					'control'           => 'ast-slider',
					'input_attrs'       => array(
						'min'  => 1,
						'step' => 0.01,
						'max'  => 10,
					),
					'context'           => astra_addon_builder_helper()->general_tab,
				),
			);

			/**
			 * Mobile Menu - Typo.
			 */
			$html_config[] = array(

				// Option Group: Primary SubMenu Typography.
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[header-mobile-menu-sub-menu-typography]',
					'type'     => 'control',
					'control'  => 'ast-settings-group',
					'title'    => __( 'Submenu Font', 'astra-addon' ),
					'section'  => 'section-header-mobile-menu',
					'priority' => 130,
					'context'  => array(
						array(
							'setting' => 'ast_selected_tab',
							'value'   => 'design',
						),
					),
				),

				// Option: Primary Submenu Font Family.
				array(
					'name'      => 'header-font-family-mobile-menu-sub-menu',
					'default'   => astra_get_option( 'header-font-family-mobile-menu-sub-menu' ),
					'parent'    => ASTRA_THEME_SETTINGS . '[header-mobile-menu-sub-menu-typography]',
					'type'      => 'sub-control',
					'section'   => 'section-header-mobile-menu',
					'control'   => 'ast-font',
					'transport' => 'postMessage',
					'font_type' => 'ast-font-family',
					'title'     => __( 'Family', 'astra-addon' ),
					'priority'  => 28,
					'connect'   => 'header-font-weight-mobile-menu-sub-menu',
					'context'   => array(
						array(
							'setting' => 'ast_selected_tab',
							'value'   => 'general',
						),
					),
				),

				// Option: Primary Submenu Font Weight.
				array(
					'name'              => 'header-font-weight-mobile-menu-sub-menu',
					'default'           => astra_get_option( 'header-font-weight-mobile-menu-sub-menu' ),
					'parent'            => ASTRA_THEME_SETTINGS . '[header-mobile-menu-sub-menu-typography]',
					'type'              => 'sub-control',
					'section'           => 'section-header-mobile-menu',
					'control'           => 'ast-font',
					'transport'         => 'postMessage',
					'font_type'         => 'ast-font-weight',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_font_weight' ),
					'title'             => __( 'Weight', 'astra-addon' ),
					'priority'          => 30,
					'connect'           => 'header-font-family-mobile-menu-sub-menu',
					'context'           => array(
						array(
							'setting' => 'ast_selected_tab',
							'value'   => 'general',
						),
					),
				),

				// Option: Primary Submenu Text Transform.
				array(
					'name'      => 'header-text-transform-mobile-menu-sub-menu',
					'default'   => astra_get_option( 'header-text-transform-mobile-menu-sub-menu' ),
					'parent'    => ASTRA_THEME_SETTINGS . '[header-mobile-menu-sub-menu-typography]',
					'section'   => 'section-header-mobile-menu',
					'type'      => 'sub-control',
					'title'     => __( 'Text Transform', 'astra-addon' ),
					'transport' => 'postMessage',
					'priority'  => 31,
					'control'   => 'ast-select',
					'choices'   => array(
						''           => __( 'Inherit', 'astra-addon' ),
						'none'       => __( 'None', 'astra-addon' ),
						'capitalize' => __( 'Capitalize', 'astra-addon' ),
						'uppercase'  => __( 'Uppercase', 'astra-addon' ),
						'lowercase'  => __( 'Lowercase', 'astra-addon' ),
					),
					'context'   => array(
						array(
							'setting' => 'ast_selected_tab',
							'value'   => 'general',
						),
					),
				),

				// Option: Primary Submenu Font Size.
				array(
					'name'        => 'header-font-size-mobile-menu-sub-menu',
					'default'     => astra_get_option( 'header-font-size-mobile-menu-sub-menu' ),
					'parent'      => ASTRA_THEME_SETTINGS . '[header-mobile-menu-sub-menu-typography]',
					'section'     => 'section-header-mobile-menu',
					'title'       => __( 'Size', 'astra-addon' ),
					'type'        => 'sub-control',
					'control'     => 'ast-responsive',
					'transport'   => 'postMessage',
					'priority'    => 29,
					'input_attrs' => array(
						'min' => 0,
					),
					'units'       => array(
						'px' => 'px',
						'em' => 'em',
					),
					'context'     => array(
						array(
							'setting' => 'ast_selected_tab',
							'value'   => 'general',
						),
					),
				),

				// Option: Primary Submenu Line Height.
				array(
					'name'              => 'header-line-height-mobile-menu-sub-menu',
					'parent'            => ASTRA_THEME_SETTINGS . '[header-mobile-menu-sub-menu-typography]',
					'section'           => 'section-header-mobile-menu',
					'type'              => 'sub-control',
					'priority'          => 32,
					'title'             => __( 'Line Height', 'astra-addon' ),
					'transport'         => 'postMessage',
					'default'           => astra_get_option( 'header-line-height-mobile-menu-sub-menu' ),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_number_n_blank' ),
					'control'           => 'ast-slider',
					'suffix'            => 'em',
					'input_attrs'       => array(
						'min'  => 1,
						'step' => 0.01,
						'max'  => 5,
					),
					'context'           => array(
						array(
							'setting' => 'ast_selected_tab',
							'value'   => 'general',
						),
					),
				),
			);

			$html_config    = call_user_func_array( 'array_merge', $html_config + array( array() ) );
			$configurations = array_merge( $configurations, $html_config );

			return $configurations;
		}
	}
}

new Astra_Builder_Menu_Configs();
