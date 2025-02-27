<?php
/**
 * Above Header Header Color Options for our theme.
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

if ( ! class_exists( 'Astra_Above_Header_Colors_Bg_Configs' ) ) {

	/**
	 * Register Header Layout Customizer Configurations.
	 */
	// @codingStandardsIgnoreStart
	class Astra_Above_Header_Colors_Bg_Configs extends Astra_Customizer_Config_Base {
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

			$_config = array(

				/**
				 * Option: Background
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[above-header-bg-obj-responsive]',
					'type'      => 'control',
					'section'   => 'section-above-header',
					'control'   => 'ast-responsive-background',
					'transport' => 'postMessage',
					'default'   => astra_get_option( 'above-header-bg-obj-responsive' ),
					'label'     => __( 'Colors and background', 'astra-addon' ),
					'priority'  => 130,
					'divider'   => array(
						'ast_class' => 'ast-bottom-divider',
					),
					'context'   => array(
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[above-header-layout]',
							'operator' => '!=',
							'value'    => 'disabled',
						),
					),
				),
				/**
				 * Option: Menu Color
				 */
				array(
					'name'       => 'above-header-menu-color-responsive',
					'parent'     => ASTRA_THEME_SETTINGS . '[above-header-menu-colors]',
					'priority'   => 2,
					'type'       => 'sub-control',
					'section'    => 'section-above-header',
					'control'    => 'ast-responsive-color',
					'default'    => astra_get_option( 'above-header-menu-color-responsive' ),
					'transport'  => 'postMessage',
					'title'      => __( 'Link / Text Color', 'astra-addon' ),
					'responsive' => true,
					'rgba'       => true,
					'tab'        => __( 'Normal', 'astra-addon' ),
				),

				/**
				 * Option: Menu Background Image, Color
				 */
				array(
					'name'      => 'above-header-menu-bg-obj-responsive',
					'parent'    => ASTRA_THEME_SETTINGS . '[above-header-menu-colors]',
					'priority'  => 2,
					'type'      => 'sub-control',
					'section'   => 'section-above-header',
					'control'   => 'ast-responsive-background',
					'transport' => 'postMessage',
					'default'   => astra_get_option( 'above-header-menu-bg-obj-responsive' ),
					'label'     => __( 'Background', 'astra-addon' ),
					'tab'       => __( 'Normal', 'astra-addon' ),
					'id'        => 'above-header-menu',
				),

				// Check Astra_Control_Color is exist in the theme.

				/**
				 * Option: Submenu Color
				 */
				array(
					'name'       => 'above-header-submenu-text-color-responsive',
					'parent'     => ASTRA_THEME_SETTINGS . '[above-header-submenu-colors]',
					'priority'   => 3,
					'type'       => 'sub-control',
					'section'    => 'section-above-header',
					'control'    => 'ast-responsive-color',
					'transport'  => 'postMessage',
					'default'    => astra_get_option( 'above-header-submenu-text-color-responsive' ),
					'title'      => __( 'Link / Text Color', 'astra-addon' ),
					'responsive' => true,
					'rgba'       => true,
					'tab'        => __( 'Normal', 'astra-addon' ),
				),

				/**
				 * Option: Submenu Background Color
				 */
				array(
					'name'       => 'above-header-submenu-bg-color-responsive',
					'parent'     => ASTRA_THEME_SETTINGS . '[above-header-submenu-colors]',
					'priority'   => 3,
					'type'       => 'sub-control',
					'section'    => 'section-above-header',
					'control'    => 'ast-responsive-color',
					'transport'  => 'postMessage',
					'default'    => astra_get_option( 'above-header-submenu-bg-color-responsive' ),
					'title'      => __( 'Background Color', 'astra-addon' ),
					'responsive' => true,
					'rgba'       => true,
					'tab'        => __( 'Normal', 'astra-addon' ),
				),

				// Check Astra_Control_Color is exist in the theme.
				/**
				 * Option: Menu Hover Background Color
				 */

				/**
				 * Option: Menu Hover Color
				 */
				array(
					'name'       => 'above-header-menu-h-color-responsive',
					'parent'     => ASTRA_THEME_SETTINGS . '[above-header-menu-colors]',
					'priority'   => 5,
					'type'       => 'sub-control',
					'section'    => 'section-above-header',
					'control'    => 'ast-responsive-color',
					'default'    => astra_get_option( 'above-header-menu-h-color-responsive' ),
					'transport'  => 'postMessage',
					'title'      => __( 'Link Color', 'astra-addon' ),
					'responsive' => true,
					'rgba'       => true,
					'tab'        => __( 'Hover', 'astra-addon' ),
				),

				array(
					'name'       => 'above-header-menu-h-bg-color-responsive',
					'parent'     => ASTRA_THEME_SETTINGS . '[above-header-menu-colors]',
					'priority'   => 5,
					'type'       => 'sub-control',
					'section'    => 'section-above-header',
					'control'    => 'ast-responsive-color',
					'default'    => astra_get_option( 'above-header-menu-h-bg-color-responsive' ),
					'title'      => __( 'Background Color', 'astra-addon' ),
					'responsive' => true,
					'rgba'       => true,
					'tab'        => __( 'Hover', 'astra-addon' ),
				),

				// Check Astra_Control_Color is exist in the theme.

				/**
				 * Option: Submenu Hover Color
				 */
				array(
					'name'       => 'above-header-submenu-hover-color-responsive',
					'parent'     => ASTRA_THEME_SETTINGS . '[above-header-submenu-colors]',
					'priority'   => 7,
					'type'       => 'sub-control',
					'section'    => 'section-above-header',
					'control'    => 'ast-responsive-color',
					'default'    => astra_get_option( 'above-header-submenu-hover-color-responsive' ),
					'transport'  => 'postMessage',
					'title'      => __( 'Link Color', 'astra-addon' ),
					'responsive' => true,
					'rgba'       => true,
					'tab'        => __( 'Hover', 'astra-addon' ),
				),

				/**
				 * Option: Menu Hover Background Color
				 */
				array(
					'name'       => 'above-header-submenu-bg-hover-color-responsive',
					'parent'     => ASTRA_THEME_SETTINGS . '[above-header-submenu-colors]',
					'priority'   => 7,
					'type'       => 'sub-control',
					'section'    => 'section-above-header',
					'control'    => 'ast-responsive-color',
					'transport'  => 'postMessage',
					'default'    => astra_get_option( 'above-header-submenu-bg-hover-color-responsive' ),
					'title'      => __( 'Background Color', 'astra-addon' ),
					'responsive' => true,
					'rgba'       => true,
					'tab'        => __( 'Hover', 'astra-addon' ),
				),

				// Check Astra_Control_Color is exist in the theme.

				/**
				 * Option: Menu Active Color
				 */
				array(
					'name'       => 'above-header-menu-active-color-responsive',
					'parent'     => ASTRA_THEME_SETTINGS . '[above-header-menu-colors]',
					'priority'   => 9,
					'type'       => 'sub-control',
					'section'    => 'section-above-header',
					'control'    => 'ast-responsive-color',
					'default'    => astra_get_option( 'above-header-menu-active-color-responsive' ),
					'transport'  => 'postMessage',
					'title'      => __( 'Link Color', 'astra-addon' ),
					'responsive' => true,
					'rgba'       => true,
					'tab'        => __( 'Active', 'astra-addon' ),
				),

				/**
				 * Option: Menu Active Background Color
				 */
				array(
					'name'       => 'above-header-menu-active-bg-color-responsive',
					'parent'     => ASTRA_THEME_SETTINGS . '[above-header-menu-colors]',
					'priority'   => 9,
					'type'       => 'sub-control',
					'section'    => 'section-above-header',
					'control'    => 'ast-responsive-color',
					'default'    => astra_get_option( 'above-header-menu-active-bg-color-responsive' ),
					'title'      => __( 'Background Color', 'astra-addon' ),
					'responsive' => true,
					'rgba'       => true,
					'tab'        => __( 'Active', 'astra-addon' ),
				),

				// Check Astra_Control_Color is exist in the theme.

				/**
				 * Option: Submenu Active Color
				 */
				array(
					'name'       => 'above-header-submenu-active-color-responsive',
					'parent'     => ASTRA_THEME_SETTINGS . '[above-header-submenu-colors]',
					'priority'   => 9,
					'transport'  => 'postMessage',
					'type'       => 'sub-control',
					'section'    => 'section-above-header',
					'control'    => 'ast-responsive-color',
					'default'    => astra_get_option( 'above-header-submenu-active-color-responsive' ),
					'title'      => __( 'Link Color', 'astra-addon' ),
					'responsive' => true,
					'rgba'       => true,
					'tab'        => __( 'Active', 'astra-addon' ),
				),

				/**
				 * Option: Submenu Active Background Color
				 */
				array(
					'name'       => 'above-header-submenu-active-bg-color-responsive',
					'parent'     => ASTRA_THEME_SETTINGS . '[above-header-submenu-colors]',
					'priority'   => 9,
					'type'       => 'sub-control',
					'section'    => 'section-above-header',
					'control'    => 'ast-responsive-color',
					'transport'  => 'postMessage',
					'default'    => astra_get_option( 'above-header-submenu-active-bg-color-responsive' ),
					'title'      => __( 'Background Color', 'astra-addon' ),
					'responsive' => true,
					'rgba'       => true,
					'tab'        => __( 'Active', 'astra-addon' ),
				),

				/**
				 * Option: Text Color
				 */
				array(
					'name'       => ASTRA_THEME_SETTINGS . '[above-header-text-color-responsive]',
					'priority'   => 132,
					'type'       => 'control',
					'control'    => 'ast-responsive-color',
					'section'    => 'section-above-header',
					'transport'  => 'postMessage',
					'default'    => astra_get_option( 'above-header-text-color-responsive' ),
					'responsive' => true,
					'rgba'       => true,
					'title'      => 'Text',
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
				 * Option: Link Color
				 */
				array(
					'name'       => 'above-header-link-color-responsive',
					'parent'     => ASTRA_THEME_SETTINGS . '[above-header-content-section-link-styling]',
					'priority'   => 5,
					'type'       => 'sub-control',
					'control'    => 'ast-responsive-color',
					'section'    => 'section-above-header',
					'default'    => astra_get_option( 'above-header-link-color-responsive' ),
					'transport'  => 'postMessage',
					'title'      => __( 'Normal', 'astra-addon' ),
					'responsive' => true,
					'rgba'       => true,
				),

				/**
				 * Option: Link Hover Color
				 */
				array(
					'name'       => 'above-header-link-h-color-responsive',
					'parent'     => ASTRA_THEME_SETTINGS . '[above-header-content-section-link-styling]',
					'priority'   => 5,
					'type'       => 'sub-control',
					'section'    => 'section-above-header',
					'control'    => 'ast-responsive-color',
					'transport'  => 'postMessage',
					'default'    => astra_get_option( 'above-header-link-h-color-responsive' ),
					'title'      => __( 'Hover', 'astra-addon' ),
					'responsive' => true,
					'rgba'       => true,
				),
			);

			return array_merge( $configurations, $_config );
		}

	}
}

new Astra_Above_Header_Colors_Bg_Configs();
