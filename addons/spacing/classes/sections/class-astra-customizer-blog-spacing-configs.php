<?php
/**
 * Blog Spacing Options for our theme.
 *
 * @package     Astra
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
if ( ! class_exists( 'Astra_Customizer_Blog_Spacing_Configs' ) ) {

	/**
	 * Register Blog Spacing Customizer Configurations.
	 */
	// @codingStandardsIgnoreStart
	class Astra_Customizer_Blog_Spacing_Configs extends Astra_Customizer_Config_Base {
 // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedClassFound
		// @codingStandardsIgnoreEnd

		/**
		 * Register Blog Spacing Customizer Configurations.
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
					'name'     => ASTRA_THEME_SETTINGS . '[blog-post-layout-divider]',
					'section'  => 'section-blog',
					'title'    => __( 'Post Spacing', 'astra-addon' ),
					'type'     => 'control',
					'control'  => 'ast-heading',
					'priority' => 164,
					'divider'  => array( 'ast_class' => 'ast-bottom-spacing' ),
					'context'  => ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) ?
						astra_addon_builder_helper()->design_tab : astra_addon_builder_helper()->general_tab,
				),

				/**
				 * Option: Post Outside Spacing
				 */
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[blog-post-outside-spacing]',
					'default'           => astra_get_option( 'blog-post-outside-spacing' ),
					'type'              => 'control',
					'control'           => 'ast-responsive-spacing',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_responsive_spacing' ),
					'transport'         => 'postMessage',
					'section'           => 'section-blog',
					'context'           => ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) ?
						astra_addon_builder_helper()->design_tab : astra_addon_builder_helper()->general_tab,
					'priority'          => 165,
					'title'             => __( 'Outside', 'astra-addon' ),
					'linked_choices'    => true,
					'unit_choices'      => array( 'px', 'em', '%' ),
					'choices'           => array(
						'top'    => __( 'Top', 'astra-addon' ),
						'right'  => __( 'Right', 'astra-addon' ),
						'bottom' => __( 'Bottom', 'astra-addon' ),
						'left'   => __( 'Left', 'astra-addon' ),
					),
					'divider'           => array( 'ast_class' => 'ast-bottom-section-divider' ),
				),

				/**
				 * Option: Post Inside Spacing
				 */
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[blog-post-inside-spacing]',
					'default'           => astra_get_option( 'blog-post-inside-spacing' ),
					'type'              => 'control',
					'control'           => 'ast-responsive-spacing',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_responsive_spacing' ),
					'transport'         => 'postMessage',
					'section'           => 'section-blog',
					'context'           => ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) ?
						astra_addon_builder_helper()->design_tab : astra_addon_builder_helper()->general_tab,
					'priority'          => 170,
					'title'             => __( 'Inside', 'astra-addon' ),
					'linked_choices'    => true,
					'unit_choices'      => array( 'px', 'em', '%' ),
					'choices'           => array(
						'top'    => __( 'Top', 'astra-addon' ),
						'right'  => __( 'Right', 'astra-addon' ),
						'bottom' => __( 'Bottom', 'astra-addon' ),
						'left'   => __( 'Left', 'astra-addon' ),
					),
				),

				/**
				 * Option: Post Pagination Spacing
				 */
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[blog-post-pagination-spacing]',
					'default'           => astra_get_option( 'blog-post-pagination-spacing' ),
					'type'              => 'control',
					'control'           => 'ast-responsive-spacing',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_responsive_spacing' ),
					'transport'         => 'postMessage',
					'section'           => 'section-blog',
					'priority'          => 175,
					'title'             => __( 'Pagination', 'astra-addon' ),
					'context'           => array(
						'context' => ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) ?
							astra_addon_builder_helper()->design_tab_config : astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[blog-pagination]',
							'operator' => '==',
							'value'    => 'number',
						),
					),
					'linked_choices'    => true,
					'unit_choices'      => array( 'px', 'em', '%' ),
					'choices'           => array(
						'top'    => __( 'Top', 'astra-addon' ),
						'right'  => __( 'Right', 'astra-addon' ),
						'bottom' => __( 'Bottom', 'astra-addon' ),
						'left'   => __( 'Left', 'astra-addon' ),
					),
					'divider'           => array( 'ast_class' => 'ast-top-section-divider' ),
				),
			);

			return array_merge( $configurations, $_configs );
		}
	}
}

/**
 * Kicking this off by calling 'get_instance()' method
 */
new Astra_Customizer_Blog_Spacing_Configs();
