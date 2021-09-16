<?php
/**
 * Content Spacing Options for our theme.
 *
 * @package     Astra
 * @author      Brainstorm Force
 * @copyright   Copyright (c) 2020, Brainstorm Force
 * @link        https://www.brainstormforce.com
 * @since       Astra 1.4.3
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
if ( ! class_exists( 'Astra_Customizer_Header_Builder_Menu_Configs' ) ) {

	/**
	 * Register Content Spacing Customizer Configurations.
	 */
	class Astra_Customizer_Header_Builder_Menu_Configs extends Astra_Customizer_Config_Base {

		/**
		 * Register Content Spacing Customizer Configurations.
		 *
		 * @param Array                $configurations Astra Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array Astra Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$html_config = array();

			$component_limit = astra_addon_builder_helper()->component_limit;
			for ( $index = 1; $index <= $component_limit; $index++ ) {

				$_section = 'section-hb-menu-' . $index;
				$_prefix  = 'menu' . $index;

				$_configs = array(

					// Option - Primary Sub Menu Space.
					array(
						'name'              => ASTRA_THEME_SETTINGS . '[header-' . $_prefix . '-submenu-spacing]',
						'default'           => astra_get_option( 'header-' . $_prefix . '-submenu-spacing' ),
						'type'              => 'control',
						'transport'         => 'postMessage',
						'control'           => 'ast-responsive-spacing',
						'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_responsive_spacing' ),
						'section'           => $_section,
						'priority'          => 160,
						'title'             => __( 'Submenu Spacing', 'astra-addon' ),
						'linked_choices'    => true,
						'unit_choices'      => array( 'px', 'em', '%' ),
						'choices'           => array(
							'top'    => __( 'Top', 'astra-addon' ),
							'right'  => __( 'Right', 'astra-addon' ),
							'bottom' => __( 'Bottom', 'astra-addon' ),
							'left'   => __( 'Left', 'astra-addon' ),
						),
						'context'           => astra_addon_builder_helper()->design_tab,
						'divider'           => array( 'ast_class' => 'ast-bottom-divider' ),
					),
				);

				$html_config[] = $_configs;

				if ( 3 > $index ) {

					$_configs = array(
						// Option - Megamenu Heading Space.
						array(
							'name'              => ASTRA_THEME_SETTINGS . '[header-' . $_prefix . '-megamenu-heading-space]',
							'default'           => astra_get_option( 'header-' . $_prefix . '-megamenu-heading-space' ),
							'type'              => 'control',
							'transport'         => 'postMessage',
							'control'           => 'ast-responsive-spacing',
							'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_responsive_spacing' ),
							'priority'          => 170,
							'title'             => __( 'Megamenu Heading Spacing', 'astra-addon' ),
							'linked_choices'    => true,
							'unit_choices'      => array( 'px', 'em', '%' ),
							'section'           => $_section,
							'choices'           => array(
								'top'    => __( 'Top', 'astra-addon' ),
								'right'  => __( 'Right', 'astra-addon' ),
								'bottom' => __( 'Bottom', 'astra-addon' ),
								'left'   => __( 'Left', 'astra-addon' ),
							),
							'context'           => astra_addon_builder_helper()->design_tab,
							'divider'           => array( 'ast_class' => 'ast-bottom-divider' ),
						),
					);

					$html_config[] = $_configs;
				}
			}

			$html_config[] = array(

				/**
				 * Option: Item Spacing
				 */
				array(
					'name'           => ASTRA_THEME_SETTINGS . '[section-hb-language-switcher-item-spacing]',
					'default'        => astra_get_option( 'section-hb-language-switcher-item-spacing' ),
					'type'           => 'control',
					'transport'      => 'postMessage',
					'control'        => 'ast-responsive-spacing',
					'section'        => 'section-hb-language-switcher',
					'priority'       => 320,
					'title'          => __( 'Item Spacing', 'astra-addon' ),
					'linked_choices' => true,
					'unit_choices'   => array( 'px', 'em', '%' ),
					'divider'        => array( 'ast_class' => 'ast-bottom-divider' ),
					'choices'        => array(
						'top'    => __( 'Top', 'astra-addon' ),
						'right'  => __( 'Right', 'astra-addon' ),
						'bottom' => __( 'Bottom', 'astra-addon' ),
						'left'   => __( 'Left', 'astra-addon' ),
					),
					'context'        => astra_addon_builder_helper()->design_tab,
				),

				/**
				 * Option: Margin Space
				 */
				array(
					'name'           => ASTRA_THEME_SETTINGS . '[section-hb-language-switcher-margin]',
					'default'        => astra_get_option( 'section-hb-language-switcher-margin' ),
					'type'           => 'control',
					'transport'      => 'postMessage',
					'control'        => 'ast-responsive-spacing',
					'section'        => 'section-hb-language-switcher',
					'priority'       => 330,
					'title'          => __( 'Margin', 'astra-addon' ),
					'linked_choices' => true,
					'unit_choices'   => array( 'px', 'em', '%' ),
					'choices'        => array(
						'top'    => __( 'Top', 'astra-addon' ),
						'right'  => __( 'Right', 'astra-addon' ),
						'bottom' => __( 'Bottom', 'astra-addon' ),
						'left'   => __( 'Left', 'astra-addon' ),
					),
					'context'        => astra_addon_builder_helper()->design_tab,
				),

			);

			$html_config[] = array(

				/**
				 * Option: Item Spacing
				 */
				array(
					'name'           => ASTRA_THEME_SETTINGS . '[section-fb-language-switcher-item-spacing]',
					'default'        => astra_get_option( 'section-fb-language-switcher-item-spacing' ),
					'type'           => 'control',
					'transport'      => 'postMessage',
					'control'        => 'ast-responsive-spacing',
					'section'        => 'section-fb-language-switcher',
					'priority'       => 320,
					'title'          => __( 'Item Spacing', 'astra-addon' ),
					'linked_choices' => true,
					'unit_choices'   => array( 'px', 'em', '%' ),
					'choices'        => array(
						'top'    => __( 'Top', 'astra-addon' ),
						'right'  => __( 'Right', 'astra-addon' ),
						'bottom' => __( 'Bottom', 'astra-addon' ),
						'left'   => __( 'Left', 'astra-addon' ),
					),
					'context'        => astra_addon_builder_helper()->design_tab,
					'divider'        => array( 'ast_class' => 'ast-bottom-divider' ),
				),

				/**
				 * Option: Margin Space
				 */
				array(
					'name'           => ASTRA_THEME_SETTINGS . '[section-fb-language-switcher-margin]',
					'default'        => astra_get_option( 'section-fb-language-switcher-margin' ),
					'type'           => 'control',
					'transport'      => 'postMessage',
					'control'        => 'ast-responsive-spacing',
					'section'        => 'section-fb-language-switcher',
					'priority'       => 330,
					'title'          => __( 'Margin', 'astra-addon' ),
					'linked_choices' => true,
					'unit_choices'   => array( 'px', 'em', '%' ),
					'choices'        => array(
						'top'    => __( 'Top', 'astra-addon' ),
						'right'  => __( 'Right', 'astra-addon' ),
						'bottom' => __( 'Bottom', 'astra-addon' ),
						'left'   => __( 'Left', 'astra-addon' ),
					),
					'context'        => astra_addon_builder_helper()->design_tab,
				),

			);

			/**
			 * Mobile Menu - Spacing.
			 */
			$html_config[] = array(

				// Option - Primary Sub Menu Space.
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[header-mobile-menu-submenu-spacing]',
					'default'           => astra_get_option( 'header-mobile-menu-submenu-spacing' ),
					'type'              => 'control',
					'transport'         => 'postMessage',
					'control'           => 'ast-responsive-spacing',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_responsive_spacing' ),
					'section'           => 'section-header-mobile-menu',
					'priority'          => 160,
					'title'             => __( 'Submenu Spacing', 'astra-addon' ),
					'linked_choices'    => true,
					'unit_choices'      => array( 'px', 'em', '%' ),
					'choices'           => array(
						'top'    => __( 'Top', 'astra-addon' ),
						'right'  => __( 'Right', 'astra-addon' ),
						'bottom' => __( 'Bottom', 'astra-addon' ),
						'left'   => __( 'Left', 'astra-addon' ),
					),
					'context'           => astra_addon_builder_helper()->design_tab,
				),

				// Option - Account Menu Space.
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[header-account-menu-spacing]',
					'default'           => astra_get_option( 'header-account-menu-spacing' ),
					'type'              => 'control',
					'control'           => 'ast-responsive-spacing',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_responsive_spacing' ),
					'transport'         => 'postMessage',
					'section'           => 'section-header-account',
					'priority'          => 510,
					'title'             => __( 'Menu Spacing', 'astra-addon' ),
					'linked_choices'    => true,
					'unit_choices'      => array( 'px', 'em', '%' ),
					'choices'           => array(
						'top'    => __( 'Top', 'astra-addon' ),
						'right'  => __( 'Right', 'astra-addon' ),
						'bottom' => __( 'Bottom', 'astra-addon' ),
						'left'   => __( 'Left', 'astra-addon' ),
					),
					'divider'           => array( 'ast_class' => 'ast-bottom-divider' ),
					'context'           => array(
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[header-account-action-type]',
							'operator' => '==',
							'value'    => 'menu',
						),
						astra_addon_builder_helper()->design_tab_config,
					),
				),
			);

			$html_config    = call_user_func_array( 'array_merge', $html_config + array( array() ) );
			$configurations = array_merge( $configurations, $html_config );

			return $configurations;
		}
	}
}

/**
 * Kicking this off by calling 'get_instance()' method
 */
new Astra_Customizer_Header_Builder_Menu_Configs();
