<?php
/**
 * Sticky Header Colors Options for our theme.
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

if ( ! class_exists( 'Astra_Sticky_Header_Colors_Bg_Configs' ) ) {

	/**
	 * Register Sticky Header  ColorsCustomizer Configurations.
	 */
	// @codingStandardsIgnoreStart
	class Astra_Sticky_Header_Colors_Bg_Configs extends Astra_Customizer_Config_Base {
 // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedClassFound
		// @codingStandardsIgnoreEnd

		/**
		 * Register Sticky Header Colors Customizer Configurations.
		 *
		 * @param Array                $configurations Astra Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array Astra Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_config = array(

				/**
				 * Option: Primary Menu Color
				 */
				array(
					'name'       => 'sticky-header-menu-color-responsive',
					'default'    => astra_get_option( 'sticky-header-menu-color-responsive' ),
					'type'       => 'sub-control',
					'tab'        => __( 'Normal', 'astra-addon' ),
					'priority'   => 6,
					'parent'     => ASTRA_THEME_SETTINGS . '[sticky-header-primary-menus-link-colors]',
					'section'    => 'section-sticky-header',
					'control'    => 'ast-responsive-color',
					'transport'  => 'postMessage',
					'title'      => __( 'Normal', 'astra-addon' ),
					'responsive' => true,
					'rgba'       => true,
				),
				/**
				 * Option: Menu Background Color
				 */
				array(
					'name'       => 'sticky-header-menu-bg-color-responsive',
					'default'    => astra_get_option( 'sticky-header-menu-bg-color-responsive' ),
					'type'       => 'sub-control',
					'tab'        => __( 'Normal', 'astra-addon' ),
					'priority'   => 7,
					'parent'     => ASTRA_THEME_SETTINGS . '[sticky-header-primary-menus-colors]',
					'section'    => 'section-sticky-header',
					'control'    => 'ast-responsive-color',
					'transport'  => 'postMessage',
					'title'      => __( 'Normal', 'astra-addon' ),
					'responsive' => true,
					'rgba'       => true,
				),

				/**
				 * Option: Menu Hover Color
				 */
				array(
					'name'       => 'sticky-header-menu-h-color-responsive',
					'default'    => astra_get_option( 'sticky-header-menu-h-color-responsive' ),
					'type'       => 'sub-control',
					'tab'        => __( 'Hover', 'astra-addon' ),
					'priority'   => 6,
					'parent'     => ASTRA_THEME_SETTINGS . '[sticky-header-primary-menus-link-colors]',
					'section'    => 'section-sticky-header',
					'control'    => 'ast-responsive-color',
					'transport'  => 'postMessage',
					'title'      => __( 'Active/Hover', 'astra-addon' ),
					'responsive' => true,
					'rgba'       => true,
					'connect'    => ASTRA_THEME_SETTINGS . '[sticky-header-menu-h-color-responsive]',
				),
				/**
				 * Option: Menu Link / Hover Background Color
				 */
				array(
					'name'       => 'sticky-header-menu-h-a-bg-color-responsive',
					'default'    => astra_get_option( 'sticky-header-menu-h-a-bg-color-responsive' ),
					'type'       => 'sub-control',
					'tab'        => __( 'Hover', 'astra-addon' ),
					'priority'   => 7,
					'parent'     => ASTRA_THEME_SETTINGS . '[sticky-header-primary-menus-colors]',
					'section'    => 'section-sticky-header',
					'control'    => 'ast-responsive-color',
					'transport'  => 'postMessage',
					'title'      => __( 'Active/Hover', 'astra-addon' ),
					'responsive' => true,
					'rgba'       => true,
				),
				/**
				 * Option: Primary Menu Color
				 */
				array(
					'name'       => 'sticky-header-submenu-color-responsive',
					'default'    => astra_get_option( 'sticky-header-submenu-color-responsive' ),
					'type'       => 'sub-control',
					'priority'   => 9,
					'parent'     => ASTRA_THEME_SETTINGS . '[sticky-header-primary-submenu-link-colors]',
					'section'    => 'section-sticky-header',
					'control'    => 'ast-responsive-color',
					'transport'  => 'postMessage',
					'title'      => __( 'Normal', 'astra-addon' ),
					'responsive' => true,
					'rgba'       => true,
					'connect'    => ASTRA_THEME_SETTINGS . '[sticky-header-submenu-color-responsive]',
				),
				/**
				 * Option: SubMenu Background Color
				 */
				array(
					'name'       => 'sticky-header-submenu-bg-color-responsive',
					'default'    => astra_get_option( 'sticky-header-submenu-bg-color-responsive' ),
					'type'       => 'sub-control',
					'priority'   => 10,
					'parent'     => ASTRA_THEME_SETTINGS . '[sticky-header-primary-submenu-background-colors]',
					'section'    => 'section-sticky-header',
					'control'    => 'ast-responsive-color',
					'transport'  => 'postMessage',
					'title'      => __( 'Normal', 'astra-addon' ),
					'responsive' => true,
					'rgba'       => true,
				),

				// Option: Divider.
				array(
					'name'     => 'divider-sticky-priamry-submenu-h-menu-colors',
					'control'  => 'ast-divider',
					'default'  => '',
					'type'     => 'sub-control',
					'parent'   => ASTRA_THEME_SETTINGS . '[sticky-header-primary-submenu-colors]',
					'section'  => 'section-sticky-header',
					'title'    => __( 'Active / Hover', 'astra-addon' ),
					'tab'      => __( 'Hover', 'astra-addon' ),
					'priority' => 5,
					'settings' => array(),
				),

				/**
				 * Option: Menu Hover Color
				 */
				array(
					'name'       => 'sticky-header-submenu-h-color-responsive',
					'default'    => astra_get_option( 'sticky-header-submenu-h-color-responsive' ),
					'type'       => 'sub-control',
					'priority'   => 9,
					'parent'     => ASTRA_THEME_SETTINGS . '[sticky-header-primary-submenu-link-colors]',
					'section'    => 'section-sticky-header',
					'control'    => 'ast-responsive-color',
					'transport'  => 'postMessage',
					'title'      => __( 'Hover', 'astra-addon' ),
					'responsive' => true,
					'rgba'       => true,
					'connect'    => ASTRA_THEME_SETTINGS . '[sticky-header-submenu-h-color-responsive]',
				),
				/**
				 * Option: SubMenu Link / Hover Background Color
				 */
				array(
					'name'       => 'sticky-header-submenu-h-a-bg-color-responsive',
					'default'    => astra_get_option( 'sticky-header-submenu-h-a-bg-color-responsive' ),
					'type'       => 'sub-control',
					'priority'   => 10,
					'parent'     => ASTRA_THEME_SETTINGS . '[sticky-header-primary-submenu-background-colors]',
					'section'    => 'section-sticky-header',
					'control'    => 'ast-responsive-color',
					'transport'  => 'postMessage',
					'title'      => __( 'Hover', 'astra-addon' ),
					'responsive' => true,
					'rgba'       => true,
					'connect'    => ASTRA_THEME_SETTINGS . '[sticky-header-submenu-h-a-bg-color-responsive]',
				),

				/**
				 * Option: Content Section Link color.
				 */
				array(
					'name'       => 'sticky-header-content-section-link-color-responsive',
					'default'    => astra_get_option( 'sticky-header-content-section-link-color-responsive' ),
					'type'       => 'sub-control',
					'priority'   => 21,
					'parent'     => ASTRA_THEME_SETTINGS . '[sticky-header-primary-outside-item-colors]',
					'section'    => 'section-sticky-header',
					'transport'  => 'postMessage',
					'control'    => 'ast-responsive-color',
					'title'      => __( 'Normal', 'astra-addon' ),
					'responsive' => true,
					'rgba'       => true,
					'connect'    => ASTRA_THEME_SETTINGS . '[sticky-header-content-section-link-color-responsive]',
				),

				/**
				 * Option: Content Section Link Hover color.
				 */
				array(
					'name'       => 'sticky-header-content-section-link-h-color-responsive',
					'default'    => astra_get_option( 'sticky-header-content-section-link-h-color-responsive' ),
					'type'       => 'sub-control',
					'priority'   => 22,
					'parent'     => ASTRA_THEME_SETTINGS . '[sticky-header-primary-outside-item-colors]',
					'section'    => 'section-sticky-header',
					'transport'  => 'postMessage',
					'control'    => 'ast-responsive-color',
					'title'      => __( 'Hover', 'astra-addon' ),
					'responsive' => true,
					'rgba'       => true,
					'connect'    => ASTRA_THEME_SETTINGS . '[sticky-header-content-section-link-h-color-responsive]',
				),
			);

			return array_merge( $configurations, $_config );
		}

	}
}

new Astra_Sticky_Header_Colors_Bg_Configs();
