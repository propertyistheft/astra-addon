<?php
/**
 * [Header] options for astra theme.
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

if ( ! class_exists( 'Astra_Site_Header_Typo_Configs' ) ) {

	/**
	 * Register below header Configurations.
	 */
	// @codingStandardsIgnoreStart
	class Astra_Site_Header_Typo_Configs extends Astra_Customizer_Config_Base {
 // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedClassFound
		// @codingStandardsIgnoreEnd

		/**
		 * Register Footer typography Customizer Configurations.
		 *
		 * @param Array                $configurations Astra Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array Astra Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_configs = array(

				/**
				 * Option: Site Title Font Family
				 */
				array(
					'name'      => 'font-family-site-title',
					'type'      => 'sub-control',
					'parent'    => ASTRA_THEME_SETTINGS . '[site-title-typography]',
					'section'   => 'title_tagline',
					'control'   => 'ast-font',
					'font_type' => 'ast-font-family',
					'default'   => astra_get_option( 'font-family-site-title' ),
					'title'     => __( 'Font Family', 'astra-addon' ),
					'priority'  => 8,
					'connect'   => ASTRA_THEME_SETTINGS . '[font-weight-site-title]',
					'divider'   => array( 'ast_class' => 'ast-sub-bottom-dotted-divider' ),
				),

				/**
				 * Option: Site Title Font Weight
				 */
				array(
					'name'      => 'font-weight-site-title',
					'control'   => 'ast-font',
					'parent'    => ASTRA_THEME_SETTINGS . '[site-title-typography]',
					'section'   => 'title_tagline',
					'font_type' => 'ast-font-weight',
					'type'      => 'sub-control',
					'title'     => __( 'Font Weight', 'astra-addon' ),
					'default'   => astra_get_option( 'font-weight-site-title' ),
					'priority'  => 10,
					'connect'   => 'font-family-site-title',
					'divider'   => array( 'ast_class' => 'ast-sub-bottom-dotted-divider' ),
				),

				/**
				 * Option: Widget Content Font Extras
				 */
				array(
					'name'     => 'font-extras-site-title',
					'type'     => 'sub-control',
					'parent'   => ASTRA_THEME_SETTINGS . '[site-title-typography]',
					'control'  => 'ast-font-extras',
					'priority' => 12,
					'section'  => 'title_tagline',
					'default'  => astra_get_option( 'font-extras-site-title' ),
					'title'    => __( 'Font Extras', 'astra-addon' ),
				),

				/**
				 * Option: Site Tagline Font Family
				 */
				array(
					'name'      => 'font-family-site-tagline',
					'type'      => 'sub-control',
					'parent'    => ASTRA_THEME_SETTINGS . '[site-tagline-typography]',
					'section'   => 'title_tagline',
					'control'   => 'ast-font',
					'font_type' => 'ast-font-family',
					'default'   => astra_get_option( 'font-family-site-tagline' ),
					'title'     => __( 'Font Family', 'astra-addon' ),
					'priority'  => 13,
					'connect'   => ASTRA_THEME_SETTINGS . '[font-weight-site-tagline]',
					'divider'   => array( 'ast_class' => 'ast-sub-bottom-dotted-divider' ),
				),

				/**
				 * Option: Site Tagline Font Weight
				 */
				array(
					'name'      => 'font-weight-site-tagline',
					'control'   => 'ast-font',
					'parent'    => ASTRA_THEME_SETTINGS . '[site-tagline-typography]',
					'section'   => 'title_tagline',
					'font_type' => 'ast-font-weight',
					'type'      => 'sub-control',
					'default'   => astra_get_option( 'font-weight-site-tagline' ),
					'title'     => __( 'Font Weight', 'astra-addon' ),
					'priority'  => 15,
					'connect'   => 'font-family-site-tagline',
					'divider'   => array( 'ast_class' => 'ast-sub-bottom-dotted-divider' ),
				),

				/**
				 * Option: Widget Content Font Extras
				 */
				array(
					'name'     => 'font-extras-site-tagline',
					'type'     => 'sub-control',
					'parent'   => ASTRA_THEME_SETTINGS . '[site-tagline-typography]',
					'control'  => 'ast-font-extras',
					'priority' => 17,
					'section'  => 'title_tagline',
					'default'  => astra_get_option( 'font-extras-site-tagline' ),
					'title'    => __( 'Font Extras', 'astra-addon' ),
				),
			);

			return array_merge( $configurations, $_configs );
		}
	}
}

new Astra_Site_Header_Typo_Configs();
