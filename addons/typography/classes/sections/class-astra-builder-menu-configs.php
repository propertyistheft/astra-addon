<?php
/**
 * [Primary Menu] options for astra theme.
 *
 * @package     Astra Addon
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
	// @codingStandardsIgnoreStart
	class Astra_Builder_Menu_Configs extends Astra_Customizer_Config_Base {
 // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedClassFound
		// @codingStandardsIgnoreEnd

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
						'title'     => __( 'Font Family', 'astra-addon' ),
						'priority'  => 28,
						'connect'   => 'header-font-weight-' . $_prefix . '-sub-menu',
						'context'   => array(
							array(
								'setting' => 'ast_selected_tab',
								'value'   => 'general',
							),
						),
						'divider'   => array( 'ast_class' => 'ast-sub-bottom-dotted-divider' ),
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
						'title'             => __( 'Font Weight', 'astra-addon' ),
						'priority'          => 29,
						'connect'           => 'header-font-family-' . $_prefix . '-sub-menu',
						'context'           => array(
							array(
								'setting' => 'ast_selected_tab',
								'value'   => 'general',
							),
						),
						'divider'           => array( 'ast_class' => 'ast-sub-bottom-dotted-divider' ),
					),

					// Option: Primary Submenu Font Size.
					array(
						'name'              => 'header-font-size-' . $_prefix . '-sub-menu',
						'default'           => astra_get_option( 'header-font-size-' . $_prefix . '-sub-menu' ),
						'parent'            => ASTRA_THEME_SETTINGS . '[header-' . $_prefix . '-sub-menu-typography]',
						'section'           => $_section,
						'type'              => 'sub-control',
						'transport'         => 'postMessage',
						'control'           => 'ast-responsive-slider',
						'priority'          => 30,
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
						'context'           => array(
							array(
								'setting' => 'ast_selected_tab',
								'value'   => 'general',
							),
						),
					),

					/**
					 * Option: Primary Sub Menu Font Extras
					 */
					array(
						'name'     => 'header-font-extras-' . $_prefix . '-sub-menu',
						'parent'   => ASTRA_THEME_SETTINGS . '[header-' . $_prefix . '-sub-menu-typography]',
						'section'  => $_section,
						'type'     => 'sub-control',
						'control'  => 'ast-font-extras',
						'priority' => 32,
						'default'  => astra_get_option( 'header-font-extras-' . $_prefix . '-sub-menu' ),
						'title'    => __( 'Font Extras', 'astra-addon' ),
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
							'priority' => 130,
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
							'title'     => __( 'Font Family', 'astra-addon' ),
							'connect'   => ASTRA_THEME_SETTINGS . '[header-' . $_prefix . '-megamenu-heading-font-weight]',
							'priority'  => 10,
							'context'   => array(
								array(
									'setting' => 'ast_selected_tab',
									'value'   => 'general',
								),
							),
							'divider'   => array( 'ast_class' => 'ast-sub-bottom-dotted-divider' ),
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
							'title'             => __( 'Font Weight', 'astra-addon' ),
							'connect'           => 'header-' . $_prefix . '-megamenu-heading-font-family',
							'priority'          => 19,
							'transport'         => 'postMessage',
							'context'           => array(
								array(
									'setting' => 'ast_selected_tab',
									'value'   => 'general',
								),
							),
							'divider'           => array( 'ast_class' => 'ast-sub-bottom-dotted-divider' ),
						),

						// Option: Primary Megamenu Header Menu Font Size.
						array(
							'name'              => 'header-' . $_prefix . '-megamenu-heading-font-size',
							'default'           => astra_get_option( 'header-' . $_prefix . '-megamenu-heading-font-size' ),
							'parent'            => ASTRA_THEME_SETTINGS . '[header-' . $_prefix . '-mega-menu-col-typography]',
							'transport'         => 'postMessage',
							'title'             => __( 'Font Size', 'astra-addon' ),
							'type'              => 'sub-control',
							'section'           => $_section,
							'control'           => 'ast-responsive-slider',
							'priority'          => 20,
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
							'context'           => array(
								array(
									'setting' => 'ast_selected_tab',
									'value'   => 'general',
								),
							),
						),

						/**
						 * Option: Primary Menu Font Extras
						 */
						array(
							'name'     => 'header-' . $_prefix . '-megamenu-heading-font-extras',
							'parent'   => ASTRA_THEME_SETTINGS . '[header-' . $_prefix . '-mega-menu-col-typography]',
							'section'  => $_section,
							'type'     => 'sub-control',
							'control'  => 'ast-font-extras',
							'priority' => 40,
							'default'  => astra_get_option( 'header-' . $_prefix . '-megamenu-heading-font-extras' ),
							'title'    => __( 'Font Extras', 'astra-addon' ),
							'context'  => array(
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
					'title'     => __( 'Font Family', 'astra-addon' ),
					'priority'  => 22,
					'divider'   => array( 'ast_class' => 'ast-sub-bottom-dotted-divider' ),
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
					'divider'           => array( 'ast_class' => 'ast-sub-bottom-dotted-divider' ),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_font_weight' ),
					'title'             => __( 'Font Weight', 'astra-addon' ),
					'priority'          => 22,
					'connect'           => 'footer-menu-font-family',
					'context'           => astra_addon_builder_helper()->general_tab,
				),

				/**
				 * Option: Footer Content Font Extras
				 */
				array(
					'name'     => 'footer-menu-font-extras',
					'type'     => 'sub-control',
					'parent'   => ASTRA_THEME_SETTINGS . '[footer-menu-typography]',
					'control'  => 'ast-font-extras',
					'section'  => $_section,
					'priority' => 26,
					'default'  => astra_get_option( 'footer-menu-font-extras' ),
					'title'    => __( 'Font Extras', 'astra-addon' ),
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
					'title'     => __( 'Font Family', 'astra-addon' ),
					'priority'  => 28,
					'connect'   => 'header-font-weight-mobile-menu-sub-menu',
					'context'   => array(
						array(
							'setting' => 'ast_selected_tab',
							'value'   => 'general',
						),
					),
					'divider'   => array( 'ast_class' => 'ast-sub-bottom-dotted-divider' ),
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
					'title'             => __( 'Font Weight', 'astra-addon' ),
					'priority'          => 29,
					'connect'           => 'header-font-family-mobile-menu-sub-menu',
					'context'           => array(
						array(
							'setting' => 'ast_selected_tab',
							'value'   => 'general',
						),
					),
					'divider'           => array( 'ast_class' => 'ast-sub-bottom-dotted-divider' ),
				),

				// Option: Primary Submenu Font Size.
				array(
					'name'              => 'header-font-size-mobile-menu-sub-menu',
					'default'           => astra_get_option( 'header-font-size-mobile-menu-sub-menu' ),
					'parent'            => ASTRA_THEME_SETTINGS . '[header-mobile-menu-sub-menu-typography]',
					'section'           => 'section-header-mobile-menu',
					'title'             => __( 'Font Size', 'astra-addon' ),
					'type'              => 'sub-control',
					'control'           => 'ast-responsive-slider',
					'transport'         => 'postMessage',
					'priority'          => 29,
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
					'context'           => array(
						array(
							'setting' => 'ast_selected_tab',
							'value'   => 'general',
						),
					),
				),

				/**
				 * Option: Font Extras
				 */
				array(
					'name'     => 'font-extras-mobile-menu-sub-menu',
					'parent'   => ASTRA_THEME_SETTINGS . '[header-mobile-menu-sub-menu-typography]',
					'section'  => 'section-header-mobile-menu',
					'type'     => 'sub-control',
					'control'  => 'ast-font-extras',
					'priority' => 29,
					'default'  => astra_get_option( 'font-extras-mobile-menu-sub-menu' ),
					'title'    => __( 'Font Extras', 'astra-addon' ),
				),
			);

			$html_config = call_user_func_array( 'array_merge', $html_config + array( array() ) );
			return array_merge( $configurations, $html_config );
		}
	}
}

new Astra_Builder_Menu_Configs();
