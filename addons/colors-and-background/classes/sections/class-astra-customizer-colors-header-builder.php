<?php
/**
 * Colors Primary Menu Options for our theme.
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
if ( ! class_exists( 'Astra_Customizer_Colors_Header_Builder' ) ) {

	/**
	 * Register General Customizer Configurations.
	 */
	// @codingStandardsIgnoreStart
	class Astra_Customizer_Colors_Header_Builder extends Astra_Customizer_Config_Base {
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

			/**
			 * Header - Menu - Colors
			 */

			$html_config = array();

			$component_limit = astra_addon_builder_helper()->component_limit;
			for ( $index = 1; $index <= $component_limit; $index++ ) {

				$_section = 'section-hb-menu-' . $index;
				$_prefix  = 'menu' . $index;

				$_configs = array(

					// Option Group: Sub Menu Colors.
					array(
						'name'       => ASTRA_THEME_SETTINGS . '[header-' . $_prefix . '-submenu-link-colors]',
						'type'       => 'control',
						'control'    => Astra_Theme_Extension::$group_control,
						'title'      => __( 'Text / Link', 'astra-addon' ),
						'section'    => $_section,
						'priority'   => 100,
						'transport'  => 'postMessage',
						'context'    => astra_addon_builder_helper()->design_tab,
						'responsive' => true,
						'divider'    => array(
							'ast_title' => __( 'Submenu Color', 'astra-addon' ),
						),
					),

					array(
						'name'       => ASTRA_THEME_SETTINGS . '[header-' . $_prefix . '-submenu-background-colors]',
						'type'       => 'control',
						'control'    => Astra_Theme_Extension::$group_control,
						'title'      => __( 'Background', 'astra-addon' ),
						'section'    => $_section,
						'priority'   => 100,
						'transport'  => 'postMessage',
						'context'    => astra_addon_builder_helper()->design_tab,
						'responsive' => true,
					),

					// Option: Submenu Color.
					array(
						'name'       => 'header-' . $_prefix . '-submenu-color-responsive',
						'default'    => astra_get_option( 'header-' . $_prefix . '-submenu-color-responsive' ),
						'parent'     => ASTRA_THEME_SETTINGS . '[header-' . $_prefix . '-submenu-link-colors]',
						'type'       => 'sub-control',
						'control'    => 'ast-responsive-color',
						'title'      => __( 'Normal', 'astra-addon' ),
						'tab'        => __( 'Normal', 'astra-addon' ),
						'section'    => $_section,
						'transport'  => 'postMessage',
						'responsive' => true,
						'rgba'       => true,
						'priority'   => 13,
						'context'    => astra_addon_builder_helper()->general_tab,
					),

					// Option: Submenu Background Color.
					array(
						'name'       => 'header-' . $_prefix . '-submenu-bg-color-responsive',
						'default'    => astra_get_option( 'header-' . $_prefix . '-submenu-bg-color-responsive' ),
						'parent'     => ASTRA_THEME_SETTINGS . '[header-' . $_prefix . '-submenu-background-colors]',
						'type'       => 'sub-control',
						'title'      => __( 'Normal', 'astra-addon' ),
						'tab'        => __( 'Normal', 'astra-addon' ),
						'section'    => $_section,
						'control'    => 'ast-responsive-color',
						'transport'  => 'postMessage',
						'responsive' => true,
						'rgba'       => true,
						'priority'   => 15,
						'context'    => astra_addon_builder_helper()->general_tab,
					),

					// Option: Submenu Hover Color.
					array(
						'name'       => 'header-' . $_prefix . '-submenu-h-color-responsive',
						'default'    => astra_get_option( 'header-' . $_prefix . '-submenu-h-color-responsive' ),
						'parent'     => ASTRA_THEME_SETTINGS . '[header-' . $_prefix . '-submenu-link-colors]',
						'type'       => 'sub-control',
						'control'    => 'ast-responsive-color',
						'section'    => $_section,
						'transport'  => 'postMessage',
						'title'      => __( 'Hover', 'astra-addon' ),
						'tab'        => __( 'Hover', 'astra-addon' ),
						'responsive' => true,
						'rgba'       => true,
						'priority'   => 25,
						'context'    => astra_addon_builder_helper()->general_tab,
					),

					// Option: Submenu Hover Background Color.
					array(
						'name'       => 'header-' . $_prefix . '-submenu-h-bg-color-responsive',
						'default'    => astra_get_option( 'header-' . $_prefix . '-submenu-h-bg-color-responsive' ),
						'parent'     => ASTRA_THEME_SETTINGS . '[header-' . $_prefix . '-submenu-background-colors]',
						'type'       => 'sub-control',
						'control'    => 'ast-responsive-color',
						'transport'  => 'postMessage',
						'section'    => $_section,
						'title'      => __( 'Hover', 'astra-addon' ),
						'tab'        => __( 'Hover', 'astra-addon' ),
						'responsive' => true,
						'rgba'       => true,
						'priority'   => 27,
						'context'    => astra_addon_builder_helper()->general_tab,
					),

					// Option: Active Submenu Color.
					array(
						'name'       => 'header-' . $_prefix . '-submenu-a-color-responsive',
						'default'    => astra_get_option( 'header-' . $_prefix . '-submenu-a-color-responsive' ),
						'parent'     => ASTRA_THEME_SETTINGS . '[header-' . $_prefix . '-submenu-link-colors]',
						'type'       => 'sub-control',
						'control'    => 'ast-responsive-color',
						'transport'  => 'postMessage',
						'section'    => $_section,
						'title'      => __( 'Active', 'astra-addon' ),
						'tab'        => __( 'Active', 'astra-addon' ),
						'responsive' => true,
						'rgba'       => true,
						'priority'   => 37,
						'context'    => astra_addon_builder_helper()->general_tab,
					),

					// Option: Active Submenu Background Color.
					array(
						'name'       => 'header-' . $_prefix . '-submenu-a-bg-color-responsive',
						'default'    => astra_get_option( 'header-' . $_prefix . '-submenu-a-bg-color-responsive' ),
						'parent'     => ASTRA_THEME_SETTINGS . '[header-' . $_prefix . '-submenu-background-colors]',
						'type'       => 'sub-control',
						'control'    => 'ast-responsive-color',
						'transport'  => 'postMessage',
						'section'    => $_section,
						'title'      => __( 'Active', 'astra-addon' ),
						'tab'        => __( 'Active', 'astra-addon' ),
						'responsive' => true,
						'rgba'       => true,
						'priority'   => 39,
						'context'    => astra_addon_builder_helper()->general_tab,
					),
				);

				$html_config[] = $_configs;

				if ( 3 > $index ) {
					$_configs = array(
						// Option Group: Primary Mega Menu Colors.
						array(
							'name'      => ASTRA_THEME_SETTINGS . '[header-' . $_prefix . '-mega-menu-col-color-group]',
							'type'      => 'control',
							'transport' => 'postMessage',
							'control'   => 'ast-color-group',
							'title'     => __( 'Mega Menu Heading', 'astra-addon' ),
							'section'   => $_section,
							'priority'  => 100,
							'context'   => astra_addon_builder_helper()->design_tab,
						),

						// Option: Megamenu Heading Color.
						array(
							'name'              => 'header-' . $_prefix . '-header-megamenu-heading-color',
							'default'           => astra_get_option( 'header-' . $_prefix . '-header-megamenu-heading-color' ),
							'parent'            => ASTRA_THEME_SETTINGS . '[header-' . $_prefix . '-mega-menu-col-color-group]',
							'type'              => 'sub-control',
							'control'           => 'ast-color',
							'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
							'section'           => $_section,
							'transport'         => 'postMessage',
							'title'             => __( 'Normal', 'astra-addon' ),
							'context'           => astra_addon_builder_helper()->general_tab,
						),

						// Option: Megamenu Heading Hover Color.
						array(
							'name'              => 'header-' . $_prefix . '-header-megamenu-heading-h-color',
							'default'           => astra_get_option( 'header-' . $_prefix . '-header-megamenu-heading-h-color' ),
							'parent'            => ASTRA_THEME_SETTINGS . '[header-' . $_prefix . '-mega-menu-col-color-group]',
							'type'              => 'sub-control',
							'control'           => 'ast-color',
							'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
							'section'           => $_section,
							'transport'         => 'postMessage',
							'title'             => __( 'Hover', 'astra-addon' ),
							'context'           => astra_addon_builder_helper()->general_tab,
						),
					);

					$html_config[] = $_configs;
				}
			}

			/**
			 * Footer Copyright Link Colors
			 */

			$html_config[] = array(

				/**
				 * Option: Account Colors tab
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[header-account-menu-heading]',
					'type'     => 'control',
					'control'  => 'ast-heading',
					'section'  => 'section-header-account',
					'title'    => __( 'Colors', 'astra-addon' ),
					'priority' => 18,
					'settings' => array(),
					'context'  => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'relation' => 'OR',
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[header-account-action-type]',
								'operator' => '==',
								'value'    => 'menu',
							),
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[header-account-logout-action]',
								'operator' => '==',
								'value'    => 'login',
							),
						),
					),
					'divider'  => array( 'ast_class' => 'ast-section-spacing' ),
				),

				array(
					'name'       => ASTRA_THEME_SETTINGS . '[header-account-menu-link-colors]',
					'type'       => 'control',
					'control'    => Astra_Theme_Extension::$group_control,
					'title'      => __( 'Link', 'astra-addon' ),
					'section'    => 'section-header-account',
					'transport'  => 'postMessage',
					'priority'   => 19,
					'divider'    => array(
						'ast_title' => __( 'Menu Color', 'astra-addon' ),
					),
					'context'    => array(
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[header-account-action-type]',
							'operator' => '==',
							'value'    => 'menu',
						),
						astra_addon_builder_helper()->design_tab_config,
					),
					'responsive' => false,
				),
				array(
					'name'       => ASTRA_THEME_SETTINGS . '[header-account-menu-background-colors]',
					'type'       => 'control',
					'control'    => Astra_Theme_Extension::$group_control,
					'title'      => __( 'Background', 'astra-addon' ),
					'section'    => 'section-header-account',
					'transport'  => 'postMessage',
					'priority'   => 19,
					'divider'    => array( 'ast_class' => 'ast-bottom-section-divider' ),
					'context'    => array(
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[header-account-action-type]',
							'operator' => '==',
							'value'    => 'menu',
						),
						astra_addon_builder_helper()->design_tab_config,
					),
					'responsive' => false,
				),

				// Option: Menu Color.
				array(
					'name'      => 'header-account-menu-color',
					'default'   => astra_get_option( 'header-account-menu-color' ),
					'parent'    => ASTRA_THEME_SETTINGS . '[header-account-menu-link-colors]',
					'type'      => 'sub-control',
					'control'   => 'ast-color',
					'transport' => 'postMessage',
					'tab'       => __( 'Normal', 'astra-addon' ),
					'section'   => 'section-header-account',
					'title'     => __( 'Normal', 'astra-addon' ),
					'priority'  => 7,
					'context'   => array(
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[header-account-action-type]',
							'operator' => '==',
							'value'    => 'menu',
						),
						astra_addon_builder_helper()->design_tab_config,
					),
				),

				// Option: Background Color.
				array(
					'name'      => 'header-account-menu-bg-obj',
					'default'   => astra_get_option( 'header-account-menu-bg-obj' ),
					'parent'    => ASTRA_THEME_SETTINGS . '[header-account-menu-background-colors]',
					'type'      => 'sub-control',
					'control'   => 'ast-color',
					'transport' => 'postMessage',
					'section'   => 'section-header-account',
					'title'     => __( 'Normal', 'astra-addon' ),
					'tab'       => __( 'Normal', 'astra-addon' ),
					'priority'  => 8,
					'context'   => astra_addon_builder_helper()->general_tab,
				),

				// Option: Menu Hover Color.
				array(
					'name'      => 'header-account-menu-h-color',
					'default'   => astra_get_option( 'header-account-menu-h-color' ),
					'parent'    => ASTRA_THEME_SETTINGS . '[header-account-menu-link-colors]',
					'type'      => 'sub-control',
					'control'   => 'ast-color',
					'transport' => 'postMessage',
					'title'     => __( 'Hover', 'astra-addon' ),
					'tab'       => __( 'Hover', 'astra-addon' ),
					'section'   => 'section-header-account',
					'priority'  => 19,
					'context'   => astra_addon_builder_helper()->general_tab,
				),

				// Option: Menu Hover Background Color.
				array(
					'name'      => 'header-account-menu-h-bg-color',
					'default'   => astra_get_option( 'header-account-menu-h-bg-color' ),
					'parent'    => ASTRA_THEME_SETTINGS . '[header-account-menu-background-colors]',
					'type'      => 'sub-control',
					'title'     => __( 'Hover', 'astra-addon' ),
					'tab'       => __( 'Hover', 'astra-addon' ),
					'section'   => 'section-header-account',
					'control'   => 'ast-color',
					'transport' => 'postMessage',
					'priority'  => 21,
					'context'   => astra_addon_builder_helper()->general_tab,
				),

				// Option: Active Menu Color.
				array(
					'name'      => 'header-account-menu-a-color',
					'default'   => astra_get_option( 'header-account-menu-a-color' ),
					'parent'    => ASTRA_THEME_SETTINGS . '[header-account-menu-link-colors]',
					'type'      => 'sub-control',
					'section'   => 'section-header-account',
					'control'   => 'ast-color',
					'transport' => 'postMessage',
					'title'     => __( 'Active', 'astra-addon' ),
					'tab'       => __( 'Active', 'astra-addon' ),
					'priority'  => 31,
					'context'   => astra_addon_builder_helper()->general_tab,
				),

				// Option: Active Menu Background Color.
				array(
					'name'      => 'header-account-menu-a-bg-color',
					'default'   => astra_get_option( 'header-account-menu-a-bg-color' ),
					'parent'    => ASTRA_THEME_SETTINGS . '[header-account-menu-background-colors]',
					'type'      => 'sub-control',
					'control'   => 'ast-color',
					'transport' => 'postMessage',
					'section'   => 'section-header-account',
					'title'     => __( 'Active', 'astra-addon' ),
					'tab'       => __( 'Active', 'astra-addon' ),
					'priority'  => 33,
					'context'   => astra_addon_builder_helper()->general_tab,
				),

				// Option Group: Account Popup Color.
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[header-account-popup-colors]',
					'default'   => astra_get_option( 'header-account-popup-colors' ),
					'type'      => 'control',
					'control'   => 'ast-settings-group',
					'title'     => __( 'Login Popup', 'astra-addon' ),
					'section'   => 'section-header-account',
					'transport' => 'postMessage',
					'priority'  => 20,
					'context'   => array(
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[header-account-logout-action]',
							'operator' => '==',
							'value'    => 'login',
						),
						astra_addon_builder_helper()->design_tab_config,
					),
				),

				// Option: label Color.
				array(
					'name'              => 'header-account-popup-label-color',
					'default'           => astra_get_option( 'header-account-popup-label-color' ),
					'parent'            => ASTRA_THEME_SETTINGS . '[header-account-popup-colors]',
					'type'              => 'sub-control',
					'control'           => 'ast-color',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
					'transport'         => 'postMessage',
					'section'           => 'section-header-account',
					'title'             => __( 'Label Color', 'astra-addon' ),
					'rgba'              => true,
					'priority'          => 1,
					'context'           => astra_addon_builder_helper()->general_tab,
				),

				// Option: input text Color.
				array(
					'name'              => 'header-account-popup-input-text-color',
					'default'           => astra_get_option( 'header-account-popup-input-text-color' ),
					'parent'            => ASTRA_THEME_SETTINGS . '[header-account-popup-colors]',
					'type'              => 'sub-control',
					'control'           => 'ast-color',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
					'transport'         => 'postMessage',
					'section'           => 'section-header-account',
					'title'             => __( 'Input Text Color', 'astra-addon' ),
					'rgba'              => true,
					'priority'          => 2,
					'context'           => astra_addon_builder_helper()->general_tab,
				),

				// Option: Background Color.
				array(
					'name'              => 'header-account-popup-input-border-color',
					'default'           => astra_get_option( 'header-account-popup-input-border-color' ),
					'parent'            => ASTRA_THEME_SETTINGS . '[header-account-popup-colors]',
					'type'              => 'sub-control',
					'control'           => 'ast-color',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
					'transport'         => 'postMessage',
					'section'           => 'section-header-account',
					'title'             => __( 'Input Border Color', 'astra-addon' ),
					'rgba'              => true,
					'priority'          => 3,
					'context'           => astra_addon_builder_helper()->general_tab,
				),

				// Option: Background Color.
				array(
					'name'              => 'header-account-popup-button-text-color',
					'default'           => astra_get_option( 'header-account-popup-button-text-color' ),
					'parent'            => ASTRA_THEME_SETTINGS . '[header-account-popup-colors]',
					'type'              => 'sub-control',
					'control'           => 'ast-color',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
					'transport'         => 'postMessage',
					'section'           => 'section-header-account',
					'title'             => __( 'Button Text Color', 'astra-addon' ),
					'rgba'              => true,
					'priority'          => 4,
					'context'           => astra_addon_builder_helper()->general_tab,
				),

				// Option: Background Color.
				array(
					'name'              => 'header-account-popup-button-bg-color',
					'default'           => astra_get_option( 'header-account-popup-button-bg-color' ),
					'parent'            => ASTRA_THEME_SETTINGS . '[header-account-popup-colors]',
					'type'              => 'sub-control',
					'control'           => 'ast-color',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
					'transport'         => 'postMessage',
					'section'           => 'section-header-account',
					'title'             => __( 'Button Background Color', 'astra-addon' ),
					'rgba'              => true,
					'priority'          => 5,
					'context'           => astra_addon_builder_helper()->general_tab,
				),

				// Option: Popup Background Color.
				array(
					'name'              => 'header-account-popup-bg-color',
					'default'           => astra_get_option( 'header-account-popup-bg-color' ),
					'parent'            => ASTRA_THEME_SETTINGS . '[header-account-popup-colors]',
					'type'              => 'sub-control',
					'control'           => 'ast-color',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
					'transport'         => 'postMessage',
					'section'           => 'section-header-account',
					'title'             => __( 'Popup Background Color', 'astra-addon' ),
					'rgba'              => true,
					'priority'          => 6,
					'context'           => astra_addon_builder_helper()->general_tab,
				),

				/**
				 * Group: Search Border Group
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[footer-copyright-link-color-group]',
					'default'   => astra_get_option( 'footer-copyright-link-color-group' ),
					'type'      => 'control',
					'control'   => Astra_Theme_Extension::$group_control,
					'title'     => __( 'Link Colors', 'astra-addon' ),
					'section'   => 'section-footer-copyright',
					'transport' => 'postMessage',
					'priority'  => 6,
					'context'   => astra_addon_builder_helper()->design_tab,
					'divider'   => array( 'ast_class' => 'ast-section-spacing' ),
				),

				/**
				 * Option: Footer copyright Link Color.
				 */
				array(
					'name'              => 'footer-copyright-link-color',
					'default'           => astra_get_option( 'footer-copyright-link-color' ),
					'parent'            => ASTRA_THEME_SETTINGS . '[footer-copyright-link-color-group]',
					'type'              => 'sub-control',
					'section'           => 'section-footer-copyright',
					'priority'          => 9,
					'transport'         => 'postMessage',
					'control'           => 'ast-color',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
					'title'             => __( 'Normal', 'astra-addon' ),
					'context'           => astra_addon_builder_helper()->design_tab_config,
				),

				/**
				 * Option: Link Hover Color.
				 */
				array(
					'name'              => 'footer-copyright-link-h-color',
					'default'           => astra_get_option( 'footer-copyright-link-h-color' ),
					'type'              => 'sub-control',
					'parent'            => ASTRA_THEME_SETTINGS . '[footer-copyright-link-color-group]',
					'section'           => 'section-footer-copyright',
					'priority'          => 9,
					'transport'         => 'postMessage',
					'control'           => 'ast-color',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
					'title'             => __( 'Hover', 'astra-addon' ),
					'context'           => astra_addon_builder_helper()->design_tab_config,
				),
			);

			/**
			 * Mobile Menu - Submenu Colors
			 */
			$html_config[] = array(

				// Option Group: Sub Menu Colors.
				array(
					'name'       => ASTRA_THEME_SETTINGS . '[header-mobile-menu-submenu-link-colors]',
					'type'       => 'control',
					'control'    => Astra_Theme_Extension::$group_control,
					'title'      => __( 'Link', 'astra-addon' ),
					'divider'    => array(
						'ast_title' => __( 'Submenu Color', 'astra-addon' ),
						'ast_class' => '',
					),
					'section'    => 'section-header-mobile-menu',
					'priority'   => 100,
					'transport'  => 'postMessage',
					'context'    => astra_addon_builder_helper()->design_tab,
					'responsive' => true,
				),

				array(
					'name'       => ASTRA_THEME_SETTINGS . '[header-mobile-menu-submenu-background-colors]',
					'type'       => 'control',
					'control'    => Astra_Theme_Extension::$group_control,
					'title'      => __( 'Background', 'astra-addon' ),
					'section'    => 'section-header-mobile-menu',
					'priority'   => 100,
					'transport'  => 'postMessage',
					'context'    => astra_addon_builder_helper()->design_tab,
					'responsive' => true,
				),

				// Option: Submenu Color.
				array(
					'name'       => 'header-mobile-menu-submenu-color-responsive',
					'default'    => astra_get_option( 'header-mobile-menu-submenu-color-responsive' ),
					'parent'     => ASTRA_THEME_SETTINGS . '[header-mobile-menu-submenu-link-colors]',
					'type'       => 'sub-control',
					'control'    => 'ast-responsive-color',
					'title'      => __( 'Normal', 'astra-addon' ),
					'tab'        => __( 'Normal', 'astra-addon' ),
					'section'    => 'section-header-mobile-menu',
					'transport'  => 'postMessage',
					'responsive' => true,
					'rgba'       => true,
					'priority'   => 13,
					'context'    => astra_addon_builder_helper()->general_tab,
				),

				// Option: Submenu Background Color.
				array(
					'name'       => 'header-mobile-menu-submenu-bg-color-responsive',
					'default'    => astra_get_option( 'header-mobile-menu-submenu-bg-color-responsive' ),
					'parent'     => ASTRA_THEME_SETTINGS . '[header-mobile-menu-submenu-background-colors]',
					'type'       => 'sub-control',
					'title'      => __( 'Normal', 'astra-addon' ),
					'tab'        => __( 'Normal', 'astra-addon' ),
					'section'    => 'section-header-mobile-menu',
					'control'    => 'ast-responsive-color',
					'transport'  => 'postMessage',
					'responsive' => true,
					'rgba'       => true,
					'priority'   => 15,
					'context'    => astra_addon_builder_helper()->general_tab,
				),

				// Option: Submenu Hover Color.
				array(
					'name'       => 'header-mobile-menu-submenu-h-color-responsive',
					'default'    => astra_get_option( 'header-mobile-menu-submenu-h-color-responsive' ),
					'parent'     => ASTRA_THEME_SETTINGS . '[header-mobile-menu-submenu-link-colors]',
					'type'       => 'sub-control',
					'control'    => 'ast-responsive-color',
					'section'    => 'section-header-mobile-menu',
					'transport'  => 'postMessage',
					'title'      => __( 'Hover', 'astra-addon' ),
					'tab'        => __( 'Hover', 'astra-addon' ),
					'responsive' => true,
					'rgba'       => true,
					'priority'   => 25,
					'context'    => astra_addon_builder_helper()->general_tab,
				),

				// Option: Submenu Hover Background Color.
				array(
					'name'       => 'header-mobile-menu-submenu-h-bg-color-responsive',
					'default'    => astra_get_option( 'header-mobile-menu-submenu-h-bg-color-responsive' ),
					'parent'     => ASTRA_THEME_SETTINGS . '[header-mobile-menu-submenu-background-colors]',
					'type'       => 'sub-control',
					'control'    => 'ast-responsive-color',
					'transport'  => 'postMessage',
					'section'    => 'section-header-mobile-menu',
					'title'      => __( 'Hover', 'astra-addon' ),
					'tab'        => __( 'Hover', 'astra-addon' ),
					'responsive' => true,
					'rgba'       => true,
					'priority'   => 27,
					'context'    => astra_addon_builder_helper()->general_tab,
				),

				// Option: Active Submenu Color.
				array(
					'name'       => 'header-mobile-menu-submenu-a-color-responsive',
					'default'    => astra_get_option( 'header-mobile-menu-submenu-a-color-responsive' ),
					'parent'     => ASTRA_THEME_SETTINGS . '[header-mobile-menu-submenu-link-colors]',
					'type'       => 'sub-control',
					'control'    => 'ast-responsive-color',
					'transport'  => 'postMessage',
					'section'    => 'section-header-mobile-menu',
					'title'      => __( 'Active', 'astra-addon' ),
					'tab'        => __( 'Active', 'astra-addon' ),
					'responsive' => true,
					'rgba'       => true,
					'priority'   => 37,
					'context'    => astra_addon_builder_helper()->general_tab,
				),

				// Option: Active Submenu Background Color.
				array(
					'name'       => 'header-mobile-menu-submenu-a-bg-color-responsive',
					'default'    => astra_get_option( 'header-mobile-menu-submenu-a-bg-color-responsive' ),
					'parent'     => ASTRA_THEME_SETTINGS . '[header-mobile-menu-submenu-background-colors]',
					'type'       => 'sub-control',
					'control'    => 'ast-responsive-color',
					'transport'  => 'postMessage',
					'section'    => 'section-header-mobile-menu',
					'title'      => __( 'Active', 'astra-addon' ),
					'tab'        => __( 'Active', 'astra-addon' ),
					'responsive' => true,
					'rgba'       => true,
					'priority'   => 39,
					'context'    => astra_addon_builder_helper()->general_tab,
				),
			);

			/**
			 * Langugae Switcher
			 */
			$html_config[] = array(

				array(
					'name'      => ASTRA_THEME_SETTINGS . '[section-hb-language-switcher-color]',
					'default'   => astra_get_option( 'section-hb-language-switcher-color' ),
					'type'      => 'control',
					'section'   => 'section-hb-language-switcher',
					'priority'  => 2,
					'transport' => 'postMessage',
					'control'   => 'ast-color',
					'title'     => __( 'Color', 'astra-addon' ),
					'context'   => array(
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[header-language-switcher-show-name]',
							'operator' => '==',
							'value'    => true,
						),
						astra_addon_builder_helper()->design_tab_config,
					),
					'divider'   => array( 'ast_class' => 'ast-bottom-section-divider ast-section-spacing' ),
				),
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[section-fb-language-switcher-color]',
					'default'   => astra_get_option( 'section-fb-language-switcher-color' ),
					'type'      => 'control',
					'section'   => 'section-fb-language-switcher',
					'priority'  => 2,
					'transport' => 'postMessage',
					'control'   => 'ast-color',
					'title'     => __( 'Color', 'astra-addon' ),
					'context'   => array(
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[footer-language-switcher-show-name]',
							'operator' => '==',
							'value'    => true,
						),
						astra_addon_builder_helper()->design_tab_config,
					),
					'divider'   => array( 'ast_class' => 'ast-section-spacing ast-bottom-section-divider' ),
				),
			);

			$html_config = call_user_func_array( 'array_merge', $html_config + array( array() ) );
			return array_merge( $configurations, $html_config );
		}
	}
}

/**
 * Kicking this off by calling 'get_instance()' method
 */
new Astra_Customizer_Colors_Header_Builder();
