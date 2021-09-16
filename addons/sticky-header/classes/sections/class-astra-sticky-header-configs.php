<?php
/**
 * Sticky Header Options for our theme.
 *
 * @package     Astra Addon
 * @author      Brainstorm Force
 * @copyright   Copyright (c) 2020, Brainstorm Force
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

if ( ! class_exists( 'Astra_Sticky_Header_Configs' ) ) {

	/**
	 * Register Sticky Header Customizer Configurations.
	 */
	class Astra_Sticky_Header_Configs extends Astra_Customizer_Config_Base {

		/**
		 * Register Sticky Header Customizer Configurations.
		 *
		 * @param Array                $configurations Astra Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array Astra Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$header_above_section          = 'section-sticky-header';
			$header_below_section          = 'section-sticky-header';
			$header_primary_section        = 'section-sticky-header';
			$header_color_label            = __( 'Header', 'astra-addon' );
			$header_primary_color_priority = 85;

			if ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) {

				$header_above_section          = 'section-above-header-builder';
				$header_below_section          = 'section-below-header-builder';
				$header_primary_section        = 'section-primary-header-builder';
				$header_primary_color_priority = 85;
				$header_color_label            = __( 'Background Color', 'astra-addon' );
			}

			$_config = array(

				/**
				* Option: Sticky Header Primary Divider
				*/
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[divider-section-sticky-primary-header]',
					'type'     => 'control',
					'control'  => 'ast-heading',
					'section'  => 'section-sticky-header',
					'title'    => __( 'Primary Header Colors', 'astra-addon' ),
					'settings' => array(),
					'priority' => 80,
					'context'  => ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) ?
						astra_addon_builder_helper()->design_tab : astra_addon_builder_helper()->general_tab,
				),

				/**
				 * Option: Stick Primary Header
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[header-main-stick]',
					'default'   => astra_get_option( 'header-main-stick' ),
					'type'      => 'control',
					'section'   => 'section-sticky-header',
					'title'     => __( 'Stick Primary Header', 'astra-addon' ),
					'priority'  => 10,
					'control'   => Astra_Theme_Extension::$switch_control,
					'transport' => 'refresh',
					'divider'   => array( 'ast_class' => 'ast-bottom-divider' ),
				),

				array(
					'name'     => ASTRA_THEME_SETTINGS . '[different-sticky-logo]',
					'default'  => astra_get_option( 'different-sticky-logo' ),
					'type'     => 'control',
					'section'  => 'section-sticky-header',
					'title'    => __( 'Different Logo for Sticky Header?', 'astra-addon' ),
					'priority' => 15,
					'control'  => Astra_Theme_Extension::$switch_control,
					'divider'  => array( 'ast_class' => 'ast-bottom-divider' ),
				),

				/**
				 * Option: Sticky header logo selector
				 */
				array(
					'name'           => ASTRA_THEME_SETTINGS . '[sticky-header-logo]',
					'default'        => astra_get_option( 'sticky-header-logo' ),
					'type'           => 'control',
					'control'        => 'image',
					'section'        => 'section-sticky-header',
					'priority'       => 16,
					'title'          => __( 'Sticky Logo', 'astra-addon' ),
					'library_filter' => array( 'gif', 'jpg', 'jpeg', 'png', 'ico' ),
					'context'        => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[different-sticky-logo]',
							'operator' => '==',
							'value'    => 1,
						),
					),
				),

				/**
				 * Option: Different retina logo
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[different-sticky-retina-logo]',
					'default'  => astra_get_option( 'different-sticky-retina-logo' ),
					'type'     => 'control',
					'section'  => 'section-sticky-header',
					'title'    => __( 'Different Logo for retina devices?', 'astra-addon' ),
					'priority' => 20,
					'control'  => Astra_Theme_Extension::$switch_control,
					'context'  => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[different-sticky-logo]',
							'operator' => '==',
							'value'    => 1,
						),
					),
					'divider'  => array( 'ast_class' => 'ast-bottom-divider ast-top-divider' ),
				),

				/**
				 * Option: Sticky header logo selector
				 */
				array(
					'name'           => ASTRA_THEME_SETTINGS . '[sticky-header-retina-logo]',
					'default'        => astra_get_option( 'sticky-header-retina-logo' ),
					'type'           => 'control',
					'control'        => 'image',
					'section'        => 'section-sticky-header',
					'priority'       => 21,
					'title'          => __( 'Sticky Retina Logo', 'astra-addon' ),
					'library_filter' => array( 'gif', 'jpg', 'jpeg', 'png', 'ico' ),
					'context'        => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[different-sticky-logo]',
							'operator' => '==',
							'value'    => 1,
						),
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[different-sticky-retina-logo]',
							'operator' => '==',
							'value'    => 1,
						),
					),
				),

				/**
				 * Option: Sticky header logo width
				 */
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[sticky-header-logo-width]',
					'default'           => astra_get_option( 'sticky-header-logo-width' ),
					'type'              => 'control',
					'transport'         => 'postMessage',
					'control'           => 'ast-responsive-slider',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_responsive_slider' ),
					'section'           => 'section-sticky-header',
					'priority'          => 25,
					'suffix'            => 'px',
					'title'             => __( 'Sticky Logo Width', 'astra-addon' ),
					'input_attrs'       => array(
						'min'  => 50,
						'step' => 1,
						'max'  => 600,
					),
					'context'           => array(
						'relation' => 'AND',
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[different-sticky-logo]',
							'operator' => '==',
							'value'    => 1,
						),
					),
					'divider'           => array( 'ast_class' => 'ast-bottom-divider' ),
				),

				/**
				 * Option: Shrink Primary Header
				 */
				array(
					'name'        => ASTRA_THEME_SETTINGS . '[header-main-shrink]',
					'default'     => astra_get_option( 'header-main-shrink' ),
					'type'        => 'control',
					'section'     => 'section-sticky-header',
					'title'       => __( 'Enable Shrink Effect', 'astra-addon' ),
					'priority'    => 13.1,
					'control'     => Astra_Theme_Extension::$switch_control,
					'divider'     => array( 'ast_class' => 'ast-bottom-divider' ),
					'description' => __( 'It will shrink the sticky header height, logo, and menu size. Sticky header will display in a compact size.', 'astra-addon' ),
				),

				/**
				 * Option: Hide on scroll
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[sticky-hide-on-scroll]',
					'default'  => astra_get_option( 'sticky-hide-on-scroll' ),
					'type'     => 'control',
					'section'  => 'section-sticky-header',
					'title'    => __( 'Hide When Scrolling Down', 'astra-addon' ),
					'priority' => 13.2,
					'control'  => Astra_Theme_Extension::$switch_control,
					'divider'  => array( 'ast_class' => 'ast-bottom-divider' ),
				),

				/**
				 * Option: Enable disable mobile header
				 */
				array(
					'name'       => ASTRA_THEME_SETTINGS . '[sticky-header-style]',
					'default'    => astra_get_option( 'sticky-header-style' ),
					'type'       => 'control',
					'control'    => Astra_Theme_Extension::$selector_control,
					'section'    => 'section-sticky-header',
					'priority'   => 40,
					'title'      => __( 'Select Animation', 'astra-addon' ),
					'choices'    => array(
						'none'  => __( 'None', 'astra-addon' ),
						'slide' => __( 'Slide', 'astra-addon' ),
						'fade'  => __( 'Fade', 'astra-addon' ),
					),
					'context'    => array(
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[sticky-hide-on-scroll]',
							'operator' => '!=',
							'value'    => 1,
						),
					),
					'transport'  => 'refresh',
					'responsive' => false,
					'renderAs'   => 'text',
					'divider'    => array( 'ast_class' => 'ast-bottom-divider' ),
				),

				/**
				 * Option: Sticky Header Display On
				 */
				array(
					'name'       => ASTRA_THEME_SETTINGS . '[sticky-header-on-devices]',
					'default'    => astra_get_option( 'sticky-header-on-devices' ),
					'type'       => 'control',
					'section'    => 'section-sticky-header',
					'priority'   => 50,
					'title'      => __( 'Enable On', 'astra-addon' ),
					'control'    => Astra_Theme_Extension::$selector_control,
					'choices'    => array(
						'desktop' => __( 'Desktop', 'astra-addon' ),
						'mobile'  => __( 'Mobile', 'astra-addon' ),
						'both'    => __( 'Desktop + Mobile', 'astra-addon' ),
					),
					'responsive' => false,
					'renderAs'   => 'text',
				),

				/**
				 * Group: Theme Button Colors Group
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[sticky-header-button-color-group]',
					'default'   => astra_get_option( 'sticky-header-button-color-group' ),
					'type'      => 'control',
					'control'   => 'ast-settings-group',
					'title'     => __( 'Colors', 'astra-addon' ),
					'section'   => 'section-sticky-header',
					'transport' => 'postMessage',
					'priority'  => 55,
					'context'   => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[header-main-rt-section]',
							'operator' => '==',
							'value'    => 'button',
						),
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[header-main-rt-section-button-style]',
							'operator' => '===',
							'value'    => 'custom-button',
						),
					),
				),
				/**
				 * Group: Theme Button Border Group
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[sticky-header-button-border-group]',
					'default'   => astra_get_option( 'sticky-header-button-border-group' ),
					'type'      => 'control',
					'control'   => 'ast-settings-group',
					'title'     => __( 'Border', 'astra-addon' ),
					'section'   => 'section-sticky-header',
					'transport' => 'postMessage',
					'priority'  => 55,
					'context'   => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[header-main-rt-section]',
							'operator' => '==',
							'value'    => 'button',
						),
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[header-main-rt-section-button-style]',
							'operator' => '===',
							'value'    => 'custom-button',
						),
					),
				),

			);

			if ( self::is_header_section_active() ) {

				$_new_configs = array(
					/**
					 * Option: Sticky Header Above Divider
					 */
					array(
						'name'     => ASTRA_THEME_SETTINGS . '[divider-section-sticky-above-header]',
						'type'     => 'control',
						'control'  => 'ast-heading',
						'section'  => 'section-sticky-header',
						'title'    => __( 'Above Header Colors', 'astra-addon' ),
						'settings' => array(),
						'priority' => 60,
						'context'  => ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) ?
							astra_addon_builder_helper()->design_tab : astra_addon_builder_helper()->general_tab,
					),

					/**
					 * Option: Sticky Header Below Divider
					 */
					array(
						'name'     => ASTRA_THEME_SETTINGS . '[divider-section-sticky-below-header]',
						'type'     => 'control',
						'control'  => 'ast-heading',
						'section'  => 'section-sticky-header',
						'title'    => __( 'Below Header Colors', 'astra-addon' ),
						'settings' => array(),
						'priority' => 110,
						'context'  => ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) ?
							astra_addon_builder_helper()->design_tab : astra_addon_builder_helper()->general_tab,
					),
				);
				if ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) {

					$sticky_individual_configs = array(

						/**
						* Option: Sticky Above Header Heading
						*/
						array(
							'name'     => ASTRA_THEME_SETTINGS . '[sticky-above-header-options]',
							'type'     => 'control',
							'control'  => 'ast-heading',
							'section'  => $header_above_section,
							'title'    => __( 'Sticky Header Option', 'astra-addon' ),
							'settings' => array(),
							'priority' => 80,
							'context'  => ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) ?
								astra_addon_builder_helper()->design_tab : astra_addon_builder_helper()->general_tab,
						),

						/**
						* Option: Sticky Below Header Heading
						*/
						array(
							'name'     => ASTRA_THEME_SETTINGS . '[sticky-below-header-options]',
							'type'     => 'control',
							'control'  => 'ast-heading',
							'section'  => $header_below_section,
							'title'    => __( 'Sticky Header Option', 'astra-addon' ),
							'settings' => array(),
							'priority' => 80,
							'context'  => ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) ?
								astra_addon_builder_helper()->design_tab : astra_addon_builder_helper()->general_tab,
						),

						/**
						* Option: Sticky Primary Header Heading
						*/
						array(
							'name'     => ASTRA_THEME_SETTINGS . '[sticky-primary-header-options]',
							'type'     => 'control',
							'control'  => 'ast-heading',
							'section'  => $header_primary_section,
							'title'    => __( 'Sticky Header Option', 'astra-addon' ),
							'settings' => array(),
							'priority' => 80,
							'context'  => ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) ?
								astra_addon_builder_helper()->design_tab : astra_addon_builder_helper()->general_tab,
						),

						// Option: Site Title Color.
						array(
							'name'    => 'sticky-header-builder-site-title-color',
							'parent'  => ASTRA_THEME_SETTINGS . '[sticky-site-identity-title-color-group]',
							'section' => 'title_tagline',
							'type'    => 'sub-control',
							'control' => 'ast-color',
							'default' => astra_get_option( 'sticky-header-builder-site-title-color' ),
							'title'   => __( 'Normal', 'astra-addon' ),
						),

						// Option: Site Title Hover Color.
						array(
							'name'    => 'sticky-header-builder-site-title-h-color',
							'parent'  => ASTRA_THEME_SETTINGS . '[sticky-site-identity-title-color-group]',
							'section' => 'title_tagline',
							'type'    => 'sub-control',
							'control' => 'ast-color',
							'default' => astra_get_option( 'sticky-header-builder-site-title-h-color' ),
							'title'   => __( 'Hover', 'astra-addon' ),
						),

						array(
							'name'       => ASTRA_THEME_SETTINGS . '[sticky-header-bg-color-responsive]',
							'default'    => astra_get_option( 'sticky-header-bg-color-responsive' ),
							'type'       => 'control',
							'section'    => $header_primary_section,
							'priority'   => $header_primary_color_priority,
							'control'    => 'ast-responsive-color',
							'transport'  => 'postMessage',
							'title'      => __( 'Background Color', 'astra-addon' ),
							'responsive' => true,
							'rgba'       => true,
							'context'    => ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) ?
							astra_addon_builder_helper()->design_tab : astra_addon_builder_helper()->general_tab,
						),
					);

					if ( is_astra_theme_3_5_0_version() ) {
						array_push(
							$sticky_individual_configs,
							/**
							* Option: Sticky Site Identity Heading
							*/
							array(
								'name'     => ASTRA_THEME_SETTINGS . '[sticky-site-identity-options]',
								'type'     => 'control',
								'control'  => 'ast-heading',
								'section'  => 'title_tagline',
								'title'    => __( 'Sticky Header Options', 'astra-addon' ),
								'settings' => array(),
								'priority' => 20,
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
							array(
								'name'      => ASTRA_THEME_SETTINGS . '[sticky-site-identity-title-color-group]',
								'default'   => astra_get_option( 'sticky-site-identity-title-color-group' ),
								'type'      => 'control',
								'control'   => 'ast-color-group',
								'title'     => __( 'Title Color', 'astra-addon' ),
								'section'   => 'title_tagline',
								'transport' => 'postMessage',
								'priority'  => 21,
								'divider'   => array( 'ast_class' => 'ast-bottom-divider' ),
								'context'   => array(
									astra_addon_builder_helper()->design_tab_config,
									array(
										'setting'  => ASTRA_THEME_SETTINGS . '[display-site-title]',
										'operator' => '==',
										'value'    => true,
									),
								),
							),
							// Option: Site Tagline Color.
							array(
								'name'              => ASTRA_THEME_SETTINGS . '[sticky-header-builder-site-tagline-color]',
								'type'              => 'control',
								'control'           => 'ast-color',
								'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
								'priority'          => 22,
								'transport'         => 'postMessage',
								'default'           => astra_get_option( 'sticky-header-builder-site-tagline-color' ),
								'title'             => __( 'Tagline', 'astra-addon' ),
								'section'           => 'title_tagline',
								'divider'           => array( 'ast_class' => 'ast-bottom-divider' ),
								'context'           => array(
									astra_addon_builder_helper()->design_tab_config,
									array(
										'setting'  => ASTRA_THEME_SETTINGS . '[display-site-tagline]',
										'operator' => '==',
										'value'    => true,
									),
								),
							)
						);
					} else {
						array_push(
							$sticky_individual_configs,
							/**
							* Option: Sticky Site Identity Heading
							*/
							array(
								'name'     => ASTRA_THEME_SETTINGS . '[sticky-site-identity-options]',
								'type'     => 'control',
								'control'  => 'ast-heading',
								'section'  => 'title_tagline',
								'title'    => __( 'Sticky Header Options', 'astra-addon' ),
								'settings' => array(),
								'priority' => 20,
								'context'  => array(
									'relation' => 'AND',
									astra_addon_builder_helper()->design_tab_config,
									array(
										'relation' => 'OR',
										array(
											'setting'     => ASTRA_THEME_SETTINGS . '[display-site-title-responsive]',
											'setting-key' => 'desktop',
											'operator'    => '==',
											'value'       => true,
										),
										array(
											'setting'     => ASTRA_THEME_SETTINGS . '[display-site-title-responsive]',
											'setting-key' => 'tablet',
											'operator'    => '==',
											'value'       => true,
										),
										array(
											'setting'     => ASTRA_THEME_SETTINGS . '[display-site-title-responsive]',
											'setting-key' => 'mobile',
											'operator'    => '==',
											'value'       => true,
										),
										array(
											'setting'     => ASTRA_THEME_SETTINGS . '[display-site-tagline-responsive]',
											'setting-key' => 'desktop',
											'operator'    => '==',
											'value'       => true,
										),
										array(
											'setting'     => ASTRA_THEME_SETTINGS . '[display-site-tagline-responsive]',
											'setting-key' => 'tablet',
											'operator'    => '==',
											'value'       => true,
										),
										array(
											'setting'     => ASTRA_THEME_SETTINGS . '[display-site-tagline-responsive]',
											'setting-key' => 'mobile',
											'operator'    => '==',
											'value'       => true,
										),
									),
								),
							),
							array(
								'name'      => ASTRA_THEME_SETTINGS . '[sticky-site-identity-title-color-group]',
								'default'   => astra_get_option( 'sticky-site-identity-title-color-group' ),
								'type'      => 'control',
								'control'   => 'ast-color-group',
								'title'     => __( 'Title Color', 'astra-addon' ),
								'section'   => 'title_tagline',
								'transport' => 'postMessage',
								'priority'  => 21,
								'divider'   => array( 'ast_class' => 'ast-bottom-divider' ),
								'context'   => array(
									astra_addon_builder_helper()->design_tab_config,
									array(
										'relation' => 'OR',
										array(
											'setting'     => ASTRA_THEME_SETTINGS . '[display-site-title-responsive]',
											'setting-key' => 'desktop',
											'operator'    => '==',
											'value'       => true,
										),
										array(
											'setting'     => ASTRA_THEME_SETTINGS . '[display-site-title-responsive]',
											'setting-key' => 'tablet',
											'operator'    => '==',
											'value'       => true,
										),
										array(
											'setting'     => ASTRA_THEME_SETTINGS . '[display-site-title-responsive]',
											'setting-key' => 'mobile',
											'operator'    => '==',
											'value'       => true,
										),
									),
								),
							),
							// Option: Site Tagline Color.
							array(
								'name'              => ASTRA_THEME_SETTINGS . '[sticky-header-builder-site-tagline-color]',
								'type'              => 'control',
								'control'           => 'ast-color',
								'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
								'priority'          => 22,
								'transport'         => 'postMessage',
								'default'           => astra_get_option( 'sticky-header-builder-site-tagline-color' ),
								'title'             => __( 'Tagline', 'astra-addon' ),
								'section'           => 'title_tagline',
								'divider'           => array( 'ast_class' => 'ast-bottom-divider' ),
								'context'           => array(
									astra_addon_builder_helper()->design_tab_config,
									array(
										'relation' => 'OR',
										array(
											'setting'     => ASTRA_THEME_SETTINGS . '[display-site-tagline-responsive]',
											'setting-key' => 'desktop',
											'operator'    => '==',
											'value'       => true,
										),
										array(
											'setting'     => ASTRA_THEME_SETTINGS . '[display-site-tagline-responsive]',
											'setting-key' => 'tablet',
											'operator'    => '==',
											'value'       => true,
										),
										array(
											'setting'     => ASTRA_THEME_SETTINGS . '[display-site-tagline-responsive]',
											'setting-key' => 'mobile',
											'operator'    => '==',
											'value'       => true,
										),
									),
								),
							)
						);
					}

					$sticky_menu_configs = array();

					$component_limit = astra_addon_builder_helper()->component_limit;
					for ( $index = 1; $index <= $component_limit; $index++ ) {

						$_section = 'section-hb-menu-' . $index;
						$_prefix  = 'menu' . $index;

						$sticky_config = array(

							/**
							 * Option: Sticky Menu 1 Heading
							 */
							array(
								'name'     => ASTRA_THEME_SETTINGS . '[sticky-menu-' . $index . '-options]',
								'type'     => 'control',
								'control'  => 'ast-heading',
								'section'  => 'section-hb-menu-' . $index,
								'title'    => __( 'Sticky Header Options', 'astra-addon' ),
								'settings' => array(),
								'priority' => 100,
								'context'  => astra_addon_builder_helper()->design_tab,
							),

							// Option Group: Menu Color.
							array(
								'name'       => ASTRA_THEME_SETTINGS . '[sticky-header-' . $_prefix . '-link-colors]',
								'type'       => 'control',
								'control'    => Astra_Theme_Extension::$group_control,
								'title'      => __( 'Text / Link', 'astra-addon' ),
								'section'    => $_section,
								'priority'   => 101,
								'context'    => astra_addon_builder_helper()->design_tab,
								'responsive' => true,
								'divider'    => array(
									'ast_title' => __( 'Menu Color', 'astra-addon' ),
								),
							),

							array(
								'name'       => ASTRA_THEME_SETTINGS . '[sticky-header-' . $_prefix . '-background-colors]',
								'type'       => 'control',
								'control'    => Astra_Theme_Extension::$group_control,
								'title'      => __( 'Background', 'astra-addon' ),
								'section'    => $_section,
								'priority'   => 101,
								'context'    => astra_addon_builder_helper()->design_tab,
								'responsive' => true,
							),

							// Option: Menu Color.
							array(
								'name'       => 'sticky-header-' . $_prefix . '-color-responsive',
								'default'    => astra_get_option( 'sticky-header-' . $_prefix . '-color-responsive' ),
								'parent'     => ASTRA_THEME_SETTINGS . '[sticky-header-' . $_prefix . '-link-colors]',
								'type'       => 'sub-control',
								'control'    => 'ast-responsive-color',
								'section'    => $_section,
								'title'      => __( 'Normal', 'astra-addon' ),
								'tab'        => __( 'Normal', 'astra-addon' ),
								'responsive' => true,
								'rgba'       => true,
								'priority'   => 7,
								'context'    => astra_addon_builder_helper()->design_tab,
							),

							// Option: Menu Background image, color.
							array(
								'name'       => 'sticky-header-' . $_prefix . '-bg-obj-responsive',
								'default'    => astra_get_option( 'sticky-header-' . $_prefix . '-bg-obj-responsive' ),
								'parent'     => ASTRA_THEME_SETTINGS . '[sticky-header-' . $_prefix . '-background-colors]',
								'type'       => 'sub-control',
								'control'    => 'ast-responsive-color',
								'responsive' => true,
								'rgba'       => true,
								'section'    => $_section,
								'data_attrs' => array( 'name' => 'sticky-header-' . $_prefix . '-bg-obj-responsive' ),
								'title'      => __( 'Normal', 'astra-addon' ),
								'tab'        => __( 'Normal', 'astra-addon' ),
								'priority'   => 9,
								'context'    => astra_addon_builder_helper()->design_tab,
							),

							// Option: Menu Hover Color.
							array(
								'name'       => 'sticky-header-' . $_prefix . '-h-color-responsive',
								'default'    => astra_get_option( 'sticky-header-' . $_prefix . '-h-color-responsive' ),
								'parent'     => ASTRA_THEME_SETTINGS . '[sticky-header-' . $_prefix . '-link-colors]',
								'type'       => 'sub-control',
								'control'    => 'ast-responsive-color',
								'title'      => __( 'Hover', 'astra-addon' ),
								'tab'        => __( 'Hover', 'astra-addon' ),
								'section'    => $_section,
								'responsive' => true,
								'rgba'       => true,
								'priority'   => 19,
								'context'    => astra_addon_builder_helper()->design_tab,
							),

							// Option: Menu Hover Background Color.
							array(
								'name'       => 'sticky-header-' . $_prefix . '-h-bg-color-responsive',
								'default'    => astra_get_option( 'sticky-header-' . $_prefix . '-h-bg-color-responsive' ),
								'parent'     => ASTRA_THEME_SETTINGS . '[sticky-header-' . $_prefix . '-background-colors]',
								'type'       => 'sub-control',
								'title'      => __( 'Hover', 'astra-addon' ),
								'tab'        => __( 'Hover', 'astra-addon' ),
								'section'    => $_section,
								'control'    => 'ast-responsive-color',
								'responsive' => true,
								'rgba'       => true,
								'priority'   => 21,
								'context'    => astra_addon_builder_helper()->design_tab,
							),

							// Option: Active Menu Color.
							array(
								'name'       => 'sticky-header-' . $_prefix . '-a-color-responsive',
								'default'    => astra_get_option( 'sticky-header-' . $_prefix . '-a-color-responsive' ),
								'parent'     => ASTRA_THEME_SETTINGS . '[sticky-header-' . $_prefix . '-link-colors]',
								'type'       => 'sub-control',
								'section'    => $_section,
								'control'    => 'ast-responsive-color',
								'title'      => __( 'Active', 'astra-addon' ),
								'tab'        => __( 'Active', 'astra-addon' ),
								'responsive' => true,
								'rgba'       => true,
								'priority'   => 31,
								'context'    => astra_addon_builder_helper()->design_tab,
							),

							// Option: Active Menu Background Color.
							array(
								'name'       => 'sticky-header-' . $_prefix . '-a-bg-color-responsive',
								'default'    => astra_get_option( 'sticky-header-' . $_prefix . '-a-bg-color-responsive' ),
								'parent'     => ASTRA_THEME_SETTINGS . '[sticky-header-' . $_prefix . '-background-colors]',
								'type'       => 'sub-control',
								'control'    => 'ast-responsive-color',
								'section'    => $_section,
								'title'      => __( 'Active', 'astra-addon' ),
								'tab'        => __( 'Active', 'astra-addon' ),
								'responsive' => true,
								'rgba'       => true,
								'priority'   => 33,
								'context'    => astra_addon_builder_helper()->design_tab,
							),

							// Option Group: Sub Menu Colors.
							array(
								'name'       => ASTRA_THEME_SETTINGS . '[sticky-header-' . $_prefix . '-submenu-link-colors]',
								'type'       => 'control',
								'control'    => Astra_Theme_Extension::$group_control,
								'title'      => __( 'Text / Link', 'astra-addon' ),
								'section'    => $_section,
								'priority'   => 102,
								'context'    => astra_addon_builder_helper()->design_tab,
								'responsive' => true,
								'divider'    => array(
									'ast_class' => 'ast-top-divider',
									'ast_title' => __( 'Submenu Color', 'astra-addon' ),
								),
							),
							array(
								'name'       => ASTRA_THEME_SETTINGS . '[sticky-header-' . $_prefix . '-submenu-background-colors]',
								'type'       => 'control',
								'control'    => Astra_Theme_Extension::$group_control,
								'title'      => __( 'Background', 'astra-addon' ),
								'section'    => $_section,
								'priority'   => 102,
								'context'    => astra_addon_builder_helper()->design_tab,
								'responsive' => true,
								'divider'    => array( 'ast_class' => 'ast-bottom-divider' ),
							),

							// Option: Submenu Color.
							array(
								'name'       => 'sticky-header-' . $_prefix . '-submenu-color-responsive',
								'default'    => astra_get_option( 'sticky-header-' . $_prefix . '-submenu-color-responsive' ),
								'parent'     => ASTRA_THEME_SETTINGS . '[sticky-header-' . $_prefix . '-submenu-link-colors]',
								'type'       => 'sub-control',
								'control'    => 'ast-responsive-color',
								'title'      => __( 'Normal', 'astra-addon' ),
								'tab'        => __( 'Normal', 'astra-addon' ),
								'section'    => $_section,
								'responsive' => true,
								'rgba'       => true,
								'priority'   => 13,
							),

							// Option: Submenu Background Color.
							array(
								'name'       => 'sticky-header-' . $_prefix . '-submenu-bg-color-responsive',
								'default'    => astra_get_option( 'sticky-header-' . $_prefix . '-submenu-bg-color-responsive' ),
								'parent'     => ASTRA_THEME_SETTINGS . '[sticky-header-' . $_prefix . '-submenu-background-colors]',
								'type'       => 'sub-control',
								'title'      => __( 'Normal', 'astra-addon' ),
								'tab'        => __( 'Normal', 'astra-addon' ),
								'section'    => $_section,
								'control'    => 'ast-responsive-color',
								'responsive' => true,
								'rgba'       => true,
								'priority'   => 15,
							),

							// Option: Submenu Hover Color.
							array(
								'name'       => 'sticky-header-' . $_prefix . '-submenu-h-color-responsive',
								'default'    => astra_get_option( 'sticky-header-' . $_prefix . '-submenu-h-color-responsive' ),
								'parent'     => ASTRA_THEME_SETTINGS . '[sticky-header-' . $_prefix . '-submenu-link-colors]',
								'type'       => 'sub-control',
								'control'    => 'ast-responsive-color',
								'section'    => $_section,
								'title'      => __( 'Hover', 'astra-addon' ),
								'tab'        => __( 'Hover', 'astra-addon' ),
								'responsive' => true,
								'rgba'       => true,
								'priority'   => 25,
							),

							// Option: Submenu Hover Background Color.
							array(
								'name'       => 'sticky-header-' . $_prefix . '-submenu-h-bg-color-responsive',
								'default'    => astra_get_option( 'sticky-header-' . $_prefix . '-submenu-h-bg-color-responsive' ),
								'parent'     => ASTRA_THEME_SETTINGS . '[sticky-header-' . $_prefix . '-submenu-background-colors]',
								'type'       => 'sub-control',
								'control'    => 'ast-responsive-color',
								'section'    => $_section,
								'title'      => __( 'Hover', 'astra-addon' ),
								'tab'        => __( 'Hover', 'astra-addon' ),
								'responsive' => true,
								'rgba'       => true,
								'priority'   => 27,
							),

							// Option: Active Submenu Color.
							array(
								'name'       => 'sticky-header-' . $_prefix . '-submenu-a-color-responsive',
								'default'    => astra_get_option( 'sticky-header-' . $_prefix . '-submenu-a-color-responsive' ),
								'parent'     => ASTRA_THEME_SETTINGS . '[sticky-header-' . $_prefix . '-submenu-link-colors]',
								'type'       => 'sub-control',
								'control'    => 'ast-responsive-color',
								'section'    => $_section,
								'title'      => __( 'Active', 'astra-addon' ),
								'tab'        => __( 'Active', 'astra-addon' ),
								'responsive' => true,
								'rgba'       => true,
								'priority'   => 37,
							),

							// Option: Active Submenu Background Color.
							array(
								'name'       => 'sticky-header-' . $_prefix . '-submenu-a-bg-color-responsive',
								'default'    => astra_get_option( 'sticky-header-' . $_prefix . '-submenu-a-bg-color-responsive' ),
								'parent'     => ASTRA_THEME_SETTINGS . '[sticky-header-' . $_prefix . '-submenu-background-colors]',
								'type'       => 'sub-control',
								'control'    => 'ast-responsive-color',
								'section'    => $_section,
								'title'      => __( 'Active', 'astra-addon' ),
								'tab'        => __( 'Active', 'astra-addon' ),
								'responsive' => true,
								'rgba'       => true,
								'priority'   => 39,
							),
						);
						$sticky_menu_configs[] = $sticky_config;

						if ( 3 > $index ) {

							$sticky_config = array(

								// Option Group: Primary Mega Menu Colors.
								array(
									'name'     => ASTRA_THEME_SETTINGS . '[sticky-header-' . $_prefix . '-mega-menu-col-color-group]',
									'type'     => 'control',
									'control'  => 'ast-color-group',
									'title'    => __( 'Mega Menu Heading', 'astra-addon' ),
									'section'  => $_section,
									'priority' => 103,
									'divider'  => array( 'ast_class' => 'ast-bottom-divider' ),
									'context'  => ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) ?
									astra_addon_builder_helper()->design_tab : astra_addon_builder_helper()->general_tab,
								),

								// Option: Megamenu Heading Color.
								array(
									'name'    => 'sticky-header-' . $_prefix . '-header-megamenu-heading-color',
									'default' => astra_get_option( 'sticky-header-' . $_prefix . '-header-megamenu-heading-color' ),
									'parent'  => ASTRA_THEME_SETTINGS . '[sticky-header-' . $_prefix . '-mega-menu-col-color-group]',
									'type'    => 'sub-control',
									'control' => 'ast-color',
									'section' => $_section,
									'title'   => __( 'Normal', 'astra-addon' ),
								),

								// Option: Megamenu Heading Hover Color.
								array(
									'name'    => 'sticky-header-' . $_prefix . '-header-megamenu-heading-h-color',
									'default' => astra_get_option( 'sticky-header-' . $_prefix . '-header-megamenu-heading-h-color' ),
									'parent'  => ASTRA_THEME_SETTINGS . '[sticky-header-' . $_prefix . '-mega-menu-col-color-group]',
									'type'    => 'sub-control',
									'control' => 'ast-color',
									'section' => $_section,
									'title'   => __( 'Hover', 'astra-addon' ),
								),
							);

							$sticky_menu_configs[] = $sticky_config;
						}
					}

					$sticky_menu_configs       = call_user_func_array( 'array_merge', $sticky_menu_configs + array( array() ) );
					$sticky_individual_configs = array_merge( $sticky_individual_configs, $sticky_menu_configs );

				} else {

					$sticky_individual_configs = array(

						/**
						 * Option: Sticky Header primary Color Group
						 */
						array(
							'name'       => ASTRA_THEME_SETTINGS . '[sticky-header-primary-header-colors]',
							'default'    => astra_get_option( 'sticky-header-primary-header-colors' ),
							'type'       => 'control',
							'control'    => Astra_Theme_Extension::$group_control,
							'title'      => 'Site Title Color',
							'section'    => $header_primary_section,
							'transport'  => 'postMessage',
							'priority'   => 86,
							'responsive' => true,
							'divider'    => array( 'ast_class' => 'ast-top-divider' ),
							'context'    => ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) ?
								astra_addon_builder_helper()->design_tab : astra_addon_builder_helper()->general_tab,
						),

						/**
						 * Option: Sticky Header Above Menu Link Color Group
						 */
						array(
							'name'       => ASTRA_THEME_SETTINGS . '[sticky-header-above-menus-link-colors]',
							'default'    => astra_get_option( 'sticky-header-above-menus-link-colors' ),
							'type'       => 'control',
							'control'    => Astra_Theme_Extension::$group_control,
							'title'      => __( 'Link / Text', 'astra-addon' ),
							'section'    => 'section-sticky-header',
							'transport'  => 'postMessage',
							'priority'   => 61,
							'responsive' => true,
							'divider'    => array(
								'ast_class' => 'ast-top-divider',
								'ast_title' => __( 'Menu', 'astra-addon' ),
							),
							'context'    => ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) ?
								astra_addon_builder_helper()->design_tab : astra_addon_builder_helper()->general_tab,
						),
						/**
						 * Option: Sticky Header Above Menu Color Group
						 */
						array(
							'name'       => ASTRA_THEME_SETTINGS . '[sticky-header-above-menus-colors]',
							'default'    => astra_get_option( 'sticky-header-above-menus-colors' ),
							'type'       => 'control',
							'control'    => Astra_Theme_Extension::$group_control,
							'title'      => __( 'Background', 'astra-addon' ),
							'section'    => 'section-sticky-header',
							'transport'  => 'postMessage',
							'priority'   => 61,
							'responsive' => true,
							'context'    => ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) ?
								astra_addon_builder_helper()->design_tab : astra_addon_builder_helper()->general_tab,
						),

						/**
						 * Option: Sticky Header Above Menu Color Group
						 */
						array(
							'name'       => ASTRA_THEME_SETTINGS . '[sticky-header-above-submenus-link-colors]',
							'default'    => astra_get_option( 'sticky-header-above-submenus-link-colors' ),
							'type'       => 'control',
							'control'    => Astra_Theme_Extension::$group_control,
							'title'      => __( 'Link / Text', 'astra-addon' ),
							'section'    => 'section-sticky-header',
							'transport'  => 'postMessage',
							'priority'   => 65,
							'responsive' => true,
							'divider'    => array(
								'ast_class' => 'ast-top-divider',
								'ast_title' => __( 'Submenu', 'astra-addon' ),
							),
							'context'    => ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) ?
								astra_addon_builder_helper()->design_tab : astra_addon_builder_helper()->general_tab,
						),
						/**
						 * Option: Sticky Header Above Menu Color Group
						 */
						array(
							'name'       => ASTRA_THEME_SETTINGS . '[sticky-header-above-submenus-colors]',
							'default'    => astra_get_option( 'sticky-header-above-submenus-colors' ),
							'type'       => 'control',
							'control'    => Astra_Theme_Extension::$group_control,
							'title'      => __( 'Background', 'astra-addon' ),
							'section'    => 'section-sticky-header',
							'transport'  => 'postMessage',
							'priority'   => 65,
							'responsive' => true,
							'context'    => ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) ?
								astra_addon_builder_helper()->design_tab : astra_addon_builder_helper()->general_tab,
						),

						/**
						 * Option: Sticky Header primary Link Color Group
						 */
						array(
							'name'       => ASTRA_THEME_SETTINGS . '[sticky-header-primary-menus-link-colors]',
							'default'    => astra_get_option( 'sticky-header-primary-menus-link-colors' ),
							'type'       => 'control',
							'control'    => Astra_Theme_Extension::$group_control,
							'title'      => __( 'Link / Text', 'astra-addon' ),
							'section'    => 'section-sticky-header',
							'transport'  => 'postMessage',
							'priority'   => 90,
							'divider'    => array(
								'ast_class' => 'ast-top-divider',
								'ast_title' => __( 'Menu', 'astra-addon' ),
							),
							'responsive' => true,
							'context'    => ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) ?
								astra_addon_builder_helper()->design_tab : astra_addon_builder_helper()->general_tab,
						),
						/**
						 * Option: Sticky Header primary Link Color Group
						 */
						array(
							'name'       => ASTRA_THEME_SETTINGS . '[sticky-header-primary-menus-colors]',
							'default'    => astra_get_option( 'sticky-header-primary-menus-colors' ),
							'type'       => 'control',
							'control'    => Astra_Theme_Extension::$group_control,
							'title'      => __( 'Background', 'astra-addon' ),
							'section'    => 'section-sticky-header',
							'transport'  => 'postMessage',
							'priority'   => 90,
							'responsive' => true,
							'context'    => ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) ?
								astra_addon_builder_helper()->design_tab : astra_addon_builder_helper()->general_tab,
						),

						/**
						 * Option: Sticky Header primary Color Group
						 */
						array(
							'name'       => ASTRA_THEME_SETTINGS . '[sticky-header-primary-submenu-link-colors]',
							'default'    => astra_get_option( 'sticky-header-primary-submenu-colors' ),
							'type'       => 'control',
							'control'    => Astra_Theme_Extension::$group_control,
							'title'      => __( 'Link/Text', 'astra-addon' ),
							'section'    => 'section-sticky-header',
							'transport'  => 'postMessage',
							'priority'   => 95,
							'divider'    => array(
								'ast_class' => 'ast-top-divider',
								'ast_title' => __( 'Submenu', 'astra-addon' ),
							),
							'context'    => ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) ?
							astra_addon_builder_helper()->design_tab : astra_addon_builder_helper()->general_tab,
							'responsive' => true,
						),
						array(
							'name'       => ASTRA_THEME_SETTINGS . '[sticky-header-primary-submenu-background-colors]',
							'default'    => astra_get_option( 'sticky-header-primary-submenu-colors' ),
							'type'       => 'control',
							'control'    => Astra_Theme_Extension::$group_control,
							'title'      => __( 'Background', 'astra-addon' ),
							'section'    => 'section-sticky-header',
							'transport'  => 'postMessage',
							'priority'   => 95,
							'context'    => ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) ?
								astra_addon_builder_helper()->design_tab : astra_addon_builder_helper()->general_tab,
							'responsive' => true,
						),

						/**
						 * Option: Sticky Header Below Color Group
						 */
						array(
							'name'       => ASTRA_THEME_SETTINGS . '[sticky-header-below-menus-link-colors]',
							'default'    => astra_get_option( 'sticky-header-below-menus-colors' ),
							'type'       => 'control',
							'control'    => Astra_Theme_Extension::$group_control,
							'title'      => __( 'Link/Text', 'astra-addon' ),
							'section'    => 'section-sticky-header',
							'transport'  => 'postMessage',
							'priority'   => 120,
							'context'    => ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) ?
								astra_addon_builder_helper()->design_tab : astra_addon_builder_helper()->general_tab,
							'responsive' => true,
							'divider'    => array(
								'ast_class' => 'ast-top-divider',
								'ast_title' => __( 'Menu', 'astra-addon' ),
							),
						),
						array(
							'name'       => ASTRA_THEME_SETTINGS . '[sticky-header-below-menus-background-colors]',
							'default'    => astra_get_option( 'sticky-header-below-menus-colors' ),
							'type'       => 'control',
							'control'    => Astra_Theme_Extension::$group_control,
							'title'      => __( 'Background', 'astra-addon' ),
							'section'    => 'section-sticky-header',
							'transport'  => 'postMessage',
							'priority'   => 120,
							'context'    => ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) ?
								astra_addon_builder_helper()->design_tab : astra_addon_builder_helper()->general_tab,
							'responsive' => true,
						),

						/**
						 * Option: Sticky Header Below Submenu Color Group
						 */
						array(
							'name'       => ASTRA_THEME_SETTINGS . '[sticky-header-below-submenus-link-colors]',
							'default'    => astra_get_option( 'sticky-header-below-submenus-colors' ),
							'type'       => 'control',
							'control'    => Astra_Theme_Extension::$group_control,
							'title'      => __( 'Link / Text', 'astra-addon' ),
							'section'    => 'section-sticky-header',
							'transport'  => 'postMessage',
							'priority'   => 125,
							'context'    => ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) ?
								astra_addon_builder_helper()->design_tab : astra_addon_builder_helper()->general_tab,
							'responsive' => true,
							'divider'    => array(
								'ast_class' => 'ast-top-divider',
								'ast_title' => __( 'Submenu', 'astra-addon' ),
							),
						),
						array(
							'name'       => ASTRA_THEME_SETTINGS . '[sticky-header-below-submenus-background-colors]',
							'default'    => astra_get_option( 'sticky-header-below-submenus-colors' ),
							'type'       => 'control',
							'control'    => Astra_Theme_Extension::$group_control,
							'title'      => __( 'Background', 'astra-addon' ),
							'section'    => 'section-sticky-header',
							'transport'  => 'postMessage',
							'priority'   => 125,
							'context'    => ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) ?
								astra_addon_builder_helper()->design_tab : astra_addon_builder_helper()->general_tab,
							'responsive' => true,
						),

						array(
							'name'       => ASTRA_THEME_SETTINGS . '[sticky-header-bg-color-responsive]',
							'default'    => astra_get_option( 'sticky-header-bg-color-responsive' ),
							'type'       => 'control',
							'tab'        => __( 'Normal', 'astra-addon' ),
							'priority'   => 85,
							'section'    => 'section-sticky-header',
							'control'    => 'ast-responsive-color',
							'transport'  => 'postMessage',
							'title'      => __( 'Background Color', 'astra-addon' ),
							'divider'    => array( 'ast_class' => 'ast-bottom-divider' ),
							'responsive' => true,
							'rgba'       => true,
						),
						/**
						* Option: Site Title Color
						*/
						array(
							'name'       => 'sticky-header-color-site-title-responsive',
							'default'    => astra_get_option( 'sticky-header-color-site-title-responsive' ),
							'type'       => 'sub-control',
							'tab'        => __( 'Normal', 'astra-addon' ),
							'priority'   => 7,
							'parent'     => ASTRA_THEME_SETTINGS . '[sticky-header-primary-header-colors]',
							'section'    => 'section-sticky-header',
							'control'    => 'ast-responsive-color',
							'transport'  => 'postMessage',
							'title'      => __( 'Normal', 'astra-addon' ),
							'responsive' => true,
							'rgba'       => true,
						),

						/**
						* Option: Site Title Hover Color
						*/
						array(
							'name'       => 'sticky-header-color-h-site-title-responsive',
							'default'    => astra_get_option( 'sticky-header-color-h-site-title-responsive' ),
							'type'       => 'sub-control',
							'tab'        => __( 'Hover', 'astra-addon' ),
							'priority'   => 8,
							'parent'     => ASTRA_THEME_SETTINGS . '[sticky-header-primary-header-colors]',
							'section'    => 'section-sticky-header',
							'control'    => 'ast-responsive-color',
							'transport'  => 'postMessage',
							'title'      => __( 'Hover', 'astra-addon' ),
							'responsive' => true,
							'rgba'       => true,
						),

						/**
						* Option: Site Tagline Color
						*/
						array(
							'name'       => ASTRA_THEME_SETTINGS . '[sticky-header-color-site-tagline-responsive]',
							'default'    => astra_get_option( 'sticky-header-color-site-tagline-responsive' ),
							'type'       => 'control',
							'priority'   => 85,
							'section'    => 'section-sticky-header',
							'control'    => 'ast-responsive-color',
							'transport'  => 'postMessage',
							'title'      => __( 'Site Tagline Color', 'astra-addon' ),
							'responsive' => true,
							'rgba'       => true,
							'connect'    => ASTRA_THEME_SETTINGS . '[sticky-header-color-site-tagline-responsive]',
						),

						/**
						* Option: Content Section Text color.
						*/
						array(
							'name'       => ASTRA_THEME_SETTINGS . '[sticky-below-header-content-section-text-color-responsive]',
							'default'    => astra_get_option( 'sticky-below-header-content-section-text-color-responsive' ),
							'type'       => 'control',
							'transport'  => 'postMessage',
							'control'    => 'ast-responsive-color',
							'title'      => __( 'Text', 'astra-addon' ),
							'divider'    => array(
								'ast_class' => 'ast-top-divider',
								'ast_title' => __( 'Content', 'astra-addon' ),
							),
							'responsive' => true,
							'rgba'       => true,
							'priority'   => 135,
							'section'    => 'section-sticky-header',
							'context'    => ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) ?
								astra_addon_builder_helper()->design_tab : astra_addon_builder_helper()->general_tab,
						),
						/**
						 * Option: Sticky Header Header Content Color Group
						 */
						array(
							'name'       => ASTRA_THEME_SETTINGS . '[sticky-header-below-header-content-colors]',
							'default'    => astra_get_option( 'sticky-header-below-header-content-colors' ),
							'type'       => 'control',
							'control'    => Astra_Theme_Extension::$group_control,
							'title'      => __( 'Link', 'astra-addon' ),
							'section'    => 'section-sticky-header',
							'transport'  => 'postMessage',
							'priority'   => 135,
							'responsive' => true,
							'context'    => ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) ?
								astra_addon_builder_helper()->design_tab : astra_addon_builder_helper()->general_tab,
						),
						/**
						 * Option: Content Section Text color.
						 */
						array(
							'name'       => ASTRA_THEME_SETTINGS . '[sticky-header-content-section-text-color-responsive]',
							'default'    => astra_get_option( 'sticky-header-content-section-text-color-responsive' ),
							'type'       => 'control',
							'priority'   => 105,
							'section'    => 'section-sticky-header',
							'control'    => 'ast-responsive-color',
							'transport'  => 'postMessage',
							'title'      => __( 'Text', 'astra-addon' ),
							'responsive' => true,
							'rgba'       => true,
							'divider'    => array(
								'ast_class' => 'ast-top-divider',
								'ast_title' => __( 'Outside Item', 'astra-addon' ),
							),
							'context'    => astra_addon_builder_helper()->is_header_footer_builder_active ? astra_addon_builder_helper()->design_tab : astra_addon_builder_helper()->general_tab,
						),
						/**
						 * Option: Sticky Header primary Color Group
						 */
						array(
							'name'       => ASTRA_THEME_SETTINGS . '[sticky-header-primary-outside-item-colors]',
							'default'    => astra_get_option( 'sticky-header-primary-outside-item-colors' ),
							'type'       => 'control',
							'control'    => Astra_Theme_Extension::$group_control,
							'title'      => __( 'Link', 'astra-addon' ),
							'section'    => 'section-sticky-header',
							'transport'  => 'postMessage',
							'priority'   => 105,
							'context'    => ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) ?
								astra_addon_builder_helper()->design_tab : astra_addon_builder_helper()->general_tab,
							'responsive' => true,
						),

						/**
						 * Option: Sticky Header Above Link Color Group
						 */
						array(
							'name'       => ASTRA_THEME_SETTINGS . '[sticky-header-above-outside-item-link-colors]',
							'default'    => astra_get_option( 'sticky-header-above-outside-item-link-colors' ),
							'type'       => 'control',
							'control'    => Astra_Theme_Extension::$group_control,
							'title'      => __( 'Link', 'astra-addon' ),
							'section'    => 'section-sticky-header',
							'transport'  => 'postMessage',
							'priority'   => 75,
							'responsive' => true,
							'context'    => ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) ?
								astra_addon_builder_helper()->design_tab : astra_addon_builder_helper()->general_tab,
						),
					);
				}

				$_new_configs = array_merge( $_new_configs, $sticky_individual_configs );
				$_config      = array_merge( $_config, $_new_configs );
			}

			if ( false === astra_addon_builder_helper()->is_header_footer_builder_active ) {
				$_new_configs = array(
					/**
					 * Option: Button Text Color
					 */
					array(
						'name'              => 'header-main-rt-sticky-section-button-text-color',
						'transport'         => 'postMessage',
						'default'           => astra_get_option( 'header-main-rt-sticky-section-button-text-color' ),
						'type'              => 'sub-control',
						'parent'            => ASTRA_THEME_SETTINGS . '[sticky-header-button-color-group]',
						'section'           => 'section-sticky-header',
						'tab'               => __( 'Normal', 'astra-addon' ),
						'control'           => 'ast-color',
						'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
						'priority'          => 10,
						'title'             => __( 'Text Color', 'astra-addon' ),
					),

					/**
					 * Option: Button Text Hover Color
					 */
					array(
						'name'              => 'header-main-rt-sticky-section-button-text-h-color',
						'default'           => astra_get_option( 'header-main-rt-sticky-section-button-text-h-color' ),
						'transport'         => 'postMessage',
						'type'              => 'sub-control',
						'parent'            => ASTRA_THEME_SETTINGS . '[sticky-header-button-color-group]',
						'section'           => 'section-sticky-header',
						'tab'               => __( 'Hover', 'astra-addon' ),
						'control'           => 'ast-color',
						'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
						'priority'          => 10,
						'title'             => __( 'Text Color', 'astra-addon' ),
					),

					/**
					 * Option: Button Background Color
					 */
					array(
						'name'              => 'header-main-rt-sticky-section-button-back-color',
						'default'           => astra_get_option( 'header-main-rt-sticky-section-button-back-color' ),
						'transport'         => 'postMessage',
						'type'              => 'sub-control',
						'parent'            => ASTRA_THEME_SETTINGS . '[sticky-header-button-color-group]',
						'section'           => 'section-sticky-header',
						'tab'               => __( 'Normal', 'astra-addon' ),
						'control'           => 'ast-color',
						'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
						'priority'          => 10,
						'title'             => __( 'Background Color', 'astra-addon' ),
					),

					/**
					 * Option: Button Button Hover Color
					 */
					array(
						'name'              => 'header-main-rt-sticky-section-button-back-h-color',
						'default'           => astra_get_option( 'header-main-rt-sticky-section-button-back-h-color' ),
						'transport'         => 'postMessage',
						'type'              => 'sub-control',
						'parent'            => ASTRA_THEME_SETTINGS . '[sticky-header-button-color-group]',
						'section'           => 'section-sticky-header',
						'tab'               => __( 'Hover', 'astra-addon' ),
						'control'           => 'ast-color',
						'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
						'priority'          => 10,
						'title'             => __( 'Background Color', 'astra-addon' ),
					),

					// Option: Button Custom Menu Button Border.
					array(
						'type'              => 'control',
						'control'           => 'ast-responsive-spacing',
						'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_responsive_spacing' ),
						'name'              => ASTRA_THEME_SETTINGS . '[header-main-rt-sticky-section-button-padding]',
						'section'           => 'section-sticky-header',
						'transport'         => 'postMessage',
						'linked_choices'    => true,
						'priority'          => 55,
						'default'           => astra_get_option( 'header-main-rt-sticky-section-button-padding' ),
						'title'             => __( 'Padding', 'astra-addon' ),
						'choices'           => array(
							'top'    => __( 'Top', 'astra-addon' ),
							'right'  => __( 'Right', 'astra-addon' ),
							'bottom' => __( 'Bottom', 'astra-addon' ),
							'left'   => __( 'Left', 'astra-addon' ),
						),
						'context'           => array(
							astra_addon_builder_helper()->general_tab_config,
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[header-main-rt-section-button-style]',
								'operator' => '===',
								'value'    => 'custom-button',
							),
						),
					),

					/**
					 * Option: Button Border Size
					 */
					array(
						'type'           => 'sub-control',
						'parent'         => ASTRA_THEME_SETTINGS . '[sticky-header-button-border-group]',
						'section'        => 'section-sticky-header',
						'control'        => 'ast-border',
						'name'           => 'header-main-rt-sticky-section-button-border-size',
						'transport'      => 'postMessage',
						'linked_choices' => true,
						'priority'       => 10,
						'default'        => astra_get_option( 'header-main-rt-sticky-section-button-border-size' ),
						'title'          => __( 'Width', 'astra-addon' ),
						'choices'        => array(
							'top'    => __( 'Top', 'astra-addon' ),
							'right'  => __( 'Right', 'astra-addon' ),
							'bottom' => __( 'Bottom', 'astra-addon' ),
							'left'   => __( 'Left', 'astra-addon' ),
						),
					),

					/**
					 * Option: Button Border Color
					 */
					array(
						'name'              => 'header-main-rt-sticky-section-button-border-color',
						'default'           => astra_get_option( 'header-main-rt-sticky-section-button-border-color' ),
						'transport'         => 'postMessage',
						'type'              => 'sub-control',
						'parent'            => ASTRA_THEME_SETTINGS . '[sticky-header-button-border-group]',
						'section'           => 'section-sticky-header',
						'control'           => 'ast-color',
						'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
						'priority'          => 12,
						'title'             => __( 'Color', 'astra-addon' ),
					),

					/**
					 * Option: Button Border Hover Color
					 */
					array(
						'name'              => 'header-main-rt-sticky-section-button-border-h-color',
						'default'           => astra_get_option( 'header-main-rt-sticky-section-button-border-h-color' ),
						'transport'         => 'postMessage',
						'type'              => 'sub-control',
						'parent'            => ASTRA_THEME_SETTINGS . '[sticky-header-button-border-group]',
						'section'           => 'section-sticky-header',
						'control'           => 'ast-color',
						'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
						'priority'          => 14,
						'title'             => __( 'Hover Color', 'astra-addon' ),
					),

					/**
					 * Option: Button Border Radius
					 */
					array(
						'name'        => 'header-main-rt-sticky-section-button-border-radius',
						'default'     => astra_get_option( 'header-main-rt-sticky-section-button-border-radius' ),
						'type'        => 'sub-control',
						'parent'      => ASTRA_THEME_SETTINGS . '[sticky-header-button-border-group]',
						'section'     => 'section-sticky-header',
						'control'     => 'ast-slider',
						'transport'   => 'postMessage',
						'suffix'      => 'px',
						'priority'    => 16,
						'title'       => __( 'Border Radius', 'astra-addon' ),
						'input_attrs' => array(
							'min'  => 0,
							'step' => 1,
							'max'  => 100,
						),
					),
				);
			} else {
				$_new_configs = array(
					array(
						'name'     => ASTRA_THEME_SETTINGS . '[header-stick-notice]',
						'type'     => 'control',
						'control'  => 'ast-description',
						'section'  => 'section-sticky-header',
						'priority' => 13.5,
						'help'     => __( 'Note: You can find all the Sticky Header related design options in the individual Elements for Logo, Primary Menu, Button etc.', 'astra-addon' ),
						'context'  => array(
							'relation' => 'AND',
							astra_addon_builder_helper()->general_tab_config,
							array(
								'relation' => 'OR',
								array(
									'setting'  => ASTRA_THEME_SETTINGS . '[header-above-stick]',
									'operator' => '==',
									'value'    => true,
								),
								array(
									'setting'  => ASTRA_THEME_SETTINGS . '[header-below-stick]',
									'operator' => '==',
									'value'    => true,
								),
								array(
									'setting'  => ASTRA_THEME_SETTINGS . '[header-main-stick]',
									'operator' => '==',
									'value'    => true,
								),
							),

						),
					),
				);
			}
			$_config = array_merge( $_config, $_new_configs );

			return array_merge( $configurations, $_config );
		}

		/**
		 * Is Header Section addon active.
		 * Decide if the Above & Below option should be visible in Sticky Header depending on Header Section addon.
		 *
		 * @return boolean  True - If the option should be displayed, False - If the option should be hidden.
		 */
		public static function is_header_section_active() {
			$status = false;
			if ( Astra_Ext_Extension::is_active( 'header-sections' ) || true === astra_addon_builder_helper()->is_header_footer_builder_active ) {
				$status = true;
			}
			return $status;
		}

	}
}

new Astra_Sticky_Header_Configs();



