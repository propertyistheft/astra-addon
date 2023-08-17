<?php
/**
 * Single Post Spacing Options for our theme.
 *
 * @package     Astra Addon
 * @link        https://www.brainstormforce.com
 * @since       Astra 3.5.0
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
 * @since 3.5.0
 */
if ( ! class_exists( 'Astra_Customizer_Single_Post_Spacing_Configs' ) ) {

	/**
	 * Register Single Post Spacing Customizer Configurations.
	 */
	// @codingStandardsIgnoreStart
	class Astra_Customizer_Single_Post_Spacing_Configs extends Astra_Customizer_Config_Base {
 // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedClassFound
		// @codingStandardsIgnoreEnd

		/**
		 * Register Single Post Spacing Customizer Configurations.
		 *
		 * @param Array                $configurations Astra Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 3.5.0
		 * @return Array Astra Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_configs = array(

				/**
				 * Option: Divider
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[section-blog-single-spacing-divider]',
					'section'  => 'section-blog-single',
					'title'    => __( 'Container Spacing', 'astra-addon' ),
					'type'     => 'control',
					'control'  => 'ast-heading',
					'priority' => 24,
					'context'  => ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) ?
						astra_addon_builder_helper()->design_tab : astra_addon_builder_helper()->general_tab,
					'divider'  => array( 'ast_class' => 'ast-section-spacing' ),
				),

				/**
				 * Option: Single Post Spacing
				 */
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[single-post-outside-spacing]',
					'default'           => astra_get_option( 'single-post-outside-spacing' ),
					'type'              => 'control',
					'control'           => 'ast-responsive-spacing',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_responsive_spacing' ),
					'section'           => 'section-blog-single',
					'title'             => __( 'Outside', 'astra-addon' ),
					'linked_choices'    => true,
					'transport'         => 'postMessage',
					'unit_choices'      => array( 'px', 'em', '%' ),
					'choices'           => array(
						'top'    => __( 'Top', 'astra-addon' ),
						'right'  => __( 'Right', 'astra-addon' ),
						'bottom' => __( 'Bottom', 'astra-addon' ),
						'left'   => __( 'Left', 'astra-addon' ),
					),
					'priority'          => 25,
					'divider'           => array( 'ast_class' => 'ast-section-spacing ast-bottom-section-divider' ),
					'context'           => ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) ?
						astra_addon_builder_helper()->design_tab : astra_addon_builder_helper()->general_tab,
				),

				/**
				 * Option: Single Post Margin
				 */
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[single-post-inside-spacing]',
					'default'           => astra_get_option( 'single-post-inside-spacing' ),
					'type'              => 'control',
					'control'           => 'ast-responsive-spacing',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_responsive_spacing' ),
					'section'           => 'section-blog-single',
					'title'             => __( 'Inside', 'astra-addon' ),
					'linked_choices'    => true,
					'transport'         => 'postMessage',
					'unit_choices'      => array( 'px', 'em', '%' ),
					'choices'           => array(
						'top'    => __( 'Top', 'astra-addon' ),
						'right'  => __( 'Right', 'astra-addon' ),
						'bottom' => __( 'Bottom', 'astra-addon' ),
						'left'   => __( 'Left', 'astra-addon' ),
					),
					'priority'          => 30,
					'divider'           => array( 'ast_class' => 'ast-top-dotted-divider' ),
					'context'           => ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) ?
						astra_addon_builder_helper()->design_tab : astra_addon_builder_helper()->general_tab,
				),
			);

			return array_merge( $configurations, $_configs );
		}
	}
}

/**
 * Kicking this off by creating NEW instance.
 */
new Astra_Customizer_Single_Post_Spacing_Configs();
