<?php
/**
 * Section [Archive] options for astra theme.
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

if ( ! class_exists( 'Astra_Archive_Advanced_Typo_Configs' ) ) {

	/**
	 * Register below header Configurations.
	 */
	// @codingStandardsIgnoreStart
	class Astra_Archive_Advanced_Typo_Configs extends Astra_Customizer_Config_Base {
 // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedClassFound
		// @codingStandardsIgnoreEnd

		/**
		 * Register Typography Customizer Configurations.
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
					'name'     => ASTRA_THEME_SETTINGS . '[blog-post-fonts-divider]',
					'section'  => 'section-blog',
					'title'    => __( 'Post Fonts', 'astra-addon' ),
					'type'     => 'control',
					'control'  => 'ast-heading',
					'priority' => 145,
					'context'  => astra_addon_builder_helper()->design_tab,
				),

				array(
					'name'      => ASTRA_THEME_SETTINGS . '[blog-content-blog-post-title-typo]',
					'default'   => astra_get_option( 'blog-content-blog-post-title-typo' ),
					'type'      => 'control',
					'control'   => 'ast-settings-group',
					'title'     => __( 'Post Title Font', 'astra-addon' ),
					'section'   => 'section-blog',
					'transport' => 'postMessage',
					'priority'  => 145,
					'context'   => astra_addon_builder_helper()->design_tab,
				),

				/**
				 * Option: Blog - Post Title Font Family
				 */
				array(
					'name'      => 'font-family-page-title',
					'parent'    => ASTRA_THEME_SETTINGS . '[blog-content-blog-post-title-typo]',
					'section'   => 'section-blog',
					'type'      => 'sub-control',
					'control'   => 'ast-font',
					'font_type' => 'ast-font-family',
					'default'   => astra_get_option( 'font-family-page-title' ),
					'title'     => __( 'Font Family', 'astra-addon' ),
					'connect'   => ASTRA_THEME_SETTINGS . '[font-weight-page-title]',
					'priority'  => 1,
					'divider'   => array( 'ast_class' => 'ast-sub-bottom-dotted-divider' ),
				),

				/**
				 * Option: Blog - Post Title Font Weight
				 */
				array(
					'name'              => 'font-weight-page-title',
					'parent'            => ASTRA_THEME_SETTINGS . '[blog-content-blog-post-title-typo]',
					'section'           => 'section-blog',
					'type'              => 'sub-control',
					'control'           => 'ast-font',
					'font_type'         => 'ast-font-weight',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_font_weight' ),
					'default'           => astra_get_option( 'font-weight-page-title' ),
					'title'             => __( 'Font Weight', 'astra-addon' ),
					'connect'           => 'font-family-page-title',
					'priority'          => 1,
					'divider'           => array( 'ast_class' => 'ast-sub-bottom-dotted-divider' ),
				),

				/**
				 * Option: Blog - Post Title Font Size
				 */
				array(
					'name'              => 'font-size-page-title',
					'parent'            => ASTRA_THEME_SETTINGS . '[blog-content-blog-post-title-typo]',
					'type'              => 'sub-control',
					'control'           => 'ast-responsive-slider',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_responsive_slider' ),
					'section'           => 'section-blog',
					'transport'         => 'postMessage',
					'title'             => __( 'Font Size', 'astra-addon' ),
					'priority'          => 2,
					'default'           => astra_get_option( 'font-size-page-title' ),
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
				),

				/**
				 * Option: Blog - Post Title Font Extras
				 */
				array(
					'name'     => 'font-extras-page-title',
					'type'     => 'sub-control',
					'parent'   => ASTRA_THEME_SETTINGS . '[blog-content-blog-post-title-typo]',
					'control'  => 'ast-font-extras',
					'section'  => 'section-blog',
					'priority' => 30,
					'default'  => astra_get_option( 'font-extras-page-title' ),
					'title'    => __( 'Font Extras', 'astra-addon' ),
				),

				array(
					'name'      => ASTRA_THEME_SETTINGS . '[blog-content-post-meta-typo]',
					'default'   => astra_get_option( 'blog-content-post-meta-typo' ),
					'type'      => 'control',
					'control'   => 'ast-settings-group',
					'title'     => __( 'Meta Font', 'astra-addon' ),
					'section'   => 'section-blog',
					'transport' => 'postMessage',
					'priority'  => 145,
					'context'   => astra_addon_builder_helper()->design_tab,
				),

				array(
					'name'      => ASTRA_THEME_SETTINGS . '[blog-content-post-tax-typo]',
					'default'   => astra_get_option( 'blog-content-post-tax-typo' ),
					'type'      => 'control',
					'control'   => 'ast-settings-group',
					'title'     => __( 'Taxonomy Font', 'astra-addon' ),
					'section'   => 'section-blog',
					'transport' => 'postMessage',
					'priority'  => 145,
					'context'   => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'relation' => 'OR',
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[blog-post-structure]',
								'operator' => 'contains',
								'value'    => 'category',
							),
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[blog-post-structure]',
								'operator' => 'contains',
								'value'    => 'tag',
							),
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[blog-meta]',
								'operator' => 'contains',
								'value'    => 'category',
							),
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[blog-meta]',
								'operator' => 'contains',
								'value'    => 'tag',
							),
						),
					),
				),

				array(
					'name'      => ASTRA_THEME_SETTINGS . '[blog-content-post-excerpt-typo]',
					'default'   => astra_get_option( 'blog-content-post-excerpt-typo' ),
					'type'      => 'control',
					'control'   => 'ast-settings-group',
					'title'     => __( 'Excerpt Font', 'astra-addon' ),
					'section'   => 'section-blog',
					'transport' => 'postMessage',
					'priority'  => 145,
					'context'   => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[blog-post-structure]',
							'operator' => 'contains',
							'value'    => 'excerpt',
						),
					),
				),

				array(
					'name'      => ASTRA_THEME_SETTINGS . '[blog-content-post-read-more-typo]',
					'default'   => astra_get_option( 'blog-content-post-read-more-typo' ),
					'type'      => 'control',
					'control'   => 'ast-settings-group',
					'title'     => __( 'Read More Font', 'astra-addon' ),
					'section'   => 'section-blog',
					'transport' => 'postMessage',
					'priority'  => 145,
					'context'   => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[blog-post-structure]',
							'operator' => 'contains',
							'value'    => 'read-more',
						),
					),
				),

				array(
					'name'      => ASTRA_THEME_SETTINGS . '[blog-content-pagination-typo]',
					'default'   => astra_get_option( 'blog-content-pagination-typo' ),
					'type'      => 'control',
					'control'   => 'ast-settings-group',
					'title'     => __( 'Pagination Font', 'astra-addon' ),
					'section'   => 'section-blog',
					'transport' => 'postMessage',
					'priority'  => 145,
					'context'   => astra_addon_builder_helper()->design_tab,
				),

				/**
				 * Option: Post Meta Font Family
				 */
				array(
					'name'      => 'font-family-post-meta',
					'parent'    => ASTRA_THEME_SETTINGS . '[blog-content-post-meta-typo]',
					'section'   => 'section-blog',
					'type'      => 'sub-control',
					'control'   => 'ast-font',
					'font_type' => 'ast-font-family',
					'default'   => astra_get_option( 'font-family-post-meta' ),
					'title'     => __( 'Font Family', 'astra-addon' ),
					'connect'   => ASTRA_THEME_SETTINGS . '[font-weight-post-meta]',
					'priority'  => 5,
					'divider'   => array( 'ast_class' => 'ast-sub-bottom-dotted-divider' ),
				),

				/**
				 * Option: Post Meta Font Weight
				 */
				array(
					'name'              => 'font-weight-post-meta',
					'parent'            => ASTRA_THEME_SETTINGS . '[blog-content-post-meta-typo]',
					'section'           => 'section-blog',
					'type'              => 'sub-control',
					'control'           => 'ast-font',
					'font_type'         => 'ast-font-weight',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_font_weight' ),
					'default'           => astra_get_option( 'font-weight-post-meta' ),
					'title'             => __( 'Font Weight', 'astra-addon' ),
					'connect'           => 'font-family-post-meta',
					'priority'          => 5,
					'divider'           => array( 'ast_class' => 'ast-sub-bottom-dotted-divider' ),
				),

				/**
				 * Option: Post Meta Font Size
				 */

				array(
					'name'              => 'font-size-post-meta',
					'parent'            => ASTRA_THEME_SETTINGS . '[blog-content-post-meta-typo]',
					'section'           => 'section-blog',
					'control'           => 'ast-responsive-slider',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_responsive_slider' ),
					'type'              => 'sub-control',
					'transport'         => 'postMessage',
					'title'             => __( 'Font Size', 'astra-addon' ),
					'priority'          => 5,
					'default'           => astra_get_option( 'font-size-post-meta' ),
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
				),

				/**
				 * Option: Post Meta Font Extras
				 */
				array(
					'name'     => 'font-extras-post-meta',
					'type'     => 'sub-control',
					'parent'   => ASTRA_THEME_SETTINGS . '[blog-content-post-meta-typo]',
					'control'  => 'ast-font-extras',
					'section'  => 'section-blog',
					'priority' => 7,
					'default'  => astra_get_option( 'font-extras-post-meta' ),
					'title'    => __( 'Font Extras', 'astra-addon' ),
				),

				/**
				 * Option: Post Tax Font Family
				 */
				array(
					'name'      => 'font-family-post-tax',
					'parent'    => ASTRA_THEME_SETTINGS . '[blog-content-post-tax-typo]',
					'section'   => 'section-blog',
					'type'      => 'sub-control',
					'control'   => 'ast-font',
					'font_type' => 'ast-font-family',
					'default'   => astra_get_option( 'font-family-post-tax' ),
					'title'     => __( 'Font Family', 'astra-addon' ),
					'connect'   => ASTRA_THEME_SETTINGS . '[font-weight-post-tax]',
					'priority'  => 5,
					'divider'   => array( 'ast_class' => 'ast-sub-bottom-dotted-divider' ),
				),

				/**
				 * Option: Post Tax Font Weight
				 */
				array(
					'name'              => 'font-weight-post-tax',
					'parent'            => ASTRA_THEME_SETTINGS . '[blog-content-post-tax-typo]',
					'section'           => 'section-blog',
					'type'              => 'sub-control',
					'control'           => 'ast-font',
					'font_type'         => 'ast-font-weight',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_font_weight' ),
					'default'           => astra_get_option( 'font-weight-post-tax' ),
					'title'             => __( 'Font Weight', 'astra-addon' ),
					'connect'           => 'font-family-post-tax',
					'priority'          => 5,
					'divider'           => array( 'ast_class' => 'ast-sub-bottom-dotted-divider' ),
				),

				/**
				 * Option: Post Tax Font Size
				 */

				array(
					'name'              => 'font-size-post-tax',
					'parent'            => ASTRA_THEME_SETTINGS . '[blog-content-post-tax-typo]',
					'section'           => 'section-blog',
					'control'           => 'ast-responsive-slider',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_responsive_slider' ),
					'type'              => 'sub-control',
					'transport'         => 'postMessage',
					'title'             => __( 'Font Size', 'astra-addon' ),
					'priority'          => 5,
					'default'           => astra_get_option( 'font-size-post-tax' ),
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
				),

				/**
				 * Option: Post Tax Font Extras
				 */
				array(
					'name'     => 'font-extras-post-tax',
					'type'     => 'sub-control',
					'parent'   => ASTRA_THEME_SETTINGS . '[blog-content-post-tax-typo]',
					'control'  => 'ast-font-extras',
					'section'  => 'section-blog',
					'priority' => 7,
					'default'  => astra_get_option( 'font-extras-post-tax' ),
					'title'    => __( 'Font Extras', 'astra-addon' ),
				),

				/**
				 * Option: Post Read More Font Family
				 */
				array(
					'name'      => 'font-family-post-read-more',
					'parent'    => ASTRA_THEME_SETTINGS . '[blog-content-post-read-more-typo]',
					'section'   => 'section-blog',
					'type'      => 'sub-control',
					'control'   => 'ast-font',
					'font_type' => 'ast-font-family',
					'default'   => astra_get_option( 'font-family-post-read-more' ),
					'title'     => __( 'Font Family', 'astra-addon' ),
					'connect'   => ASTRA_THEME_SETTINGS . '[font-weight-post-read-more]',
					'priority'  => 5,
					'divider'   => array( 'ast_class' => 'ast-sub-bottom-dotted-divider' ),
				),

				/**
				 * Option: Post Read More Font Weight
				 */
				array(
					'name'              => 'font-weight-post-read-more',
					'parent'            => ASTRA_THEME_SETTINGS . '[blog-content-post-read-more-typo]',
					'section'           => 'section-blog',
					'type'              => 'sub-control',
					'control'           => 'ast-font',
					'font_type'         => 'ast-font-weight',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_font_weight' ),
					'default'           => astra_get_option( 'font-weight-post-read-more' ),
					'title'             => __( 'Font Weight', 'astra-addon' ),
					'connect'           => 'font-family-post-read-more',
					'priority'          => 5,
					'divider'           => array( 'ast_class' => 'ast-sub-bottom-dotted-divider' ),
				),

				/**
				 * Option: Post Read More Font Size
				 */

				array(
					'name'              => 'font-size-post-read-more',
					'parent'            => ASTRA_THEME_SETTINGS . '[blog-content-post-read-more-typo]',
					'section'           => 'section-blog',
					'control'           => 'ast-responsive-slider',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_responsive_slider' ),
					'type'              => 'sub-control',
					'transport'         => 'postMessage',
					'title'             => __( 'Font Size', 'astra-addon' ),
					'priority'          => 5,
					'default'           => astra_get_option( 'font-size-post-read-more' ),
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
				),

				/**
				 * Option: Post Read More Font Extras
				 */
				array(
					'name'     => 'font-extras-post-read-more',
					'type'     => 'sub-control',
					'parent'   => ASTRA_THEME_SETTINGS . '[blog-content-post-read-more-typo]',
					'control'  => 'ast-font-extras',
					'section'  => 'section-blog',
					'priority' => 7,
					'default'  => astra_get_option( 'font-extras-post-read-more' ),
					'title'    => __( 'Font Extras', 'astra-addon' ),
				),

				/**
				 * Option: Post Excerpt Font Family
				 */
				array(
					'name'      => 'font-family-post-excerpt',
					'parent'    => ASTRA_THEME_SETTINGS . '[blog-content-post-excerpt-typo]',
					'section'   => 'section-blog',
					'type'      => 'sub-control',
					'control'   => 'ast-font',
					'font_type' => 'ast-font-family',
					'default'   => astra_get_option( 'font-family-post-excerpt' ),
					'title'     => __( 'Font Family', 'astra-addon' ),
					'connect'   => ASTRA_THEME_SETTINGS . '[font-weight-post-excerpt]',
					'priority'  => 5,
					'divider'   => array( 'ast_class' => 'ast-sub-bottom-dotted-divider' ),
				),

				/**
				 * Option: Post Excerpt Font Weight
				 */
				array(
					'name'              => 'font-weight-post-excerpt',
					'parent'            => ASTRA_THEME_SETTINGS . '[blog-content-post-excerpt-typo]',
					'section'           => 'section-blog',
					'type'              => 'sub-control',
					'control'           => 'ast-font',
					'font_type'         => 'ast-font-weight',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_font_weight' ),
					'default'           => astra_get_option( 'font-weight-post-excerpt' ),
					'title'             => __( 'Font Weight', 'astra-addon' ),
					'connect'           => 'font-family-post-excerpt',
					'priority'          => 5,
					'divider'           => array( 'ast_class' => 'ast-sub-bottom-dotted-divider' ),
				),

				/**
				 * Option: Post Excerpt Font Size
				 */

				array(
					'name'              => 'font-size-post-excerpt',
					'parent'            => ASTRA_THEME_SETTINGS . '[blog-content-post-excerpt-typo]',
					'section'           => 'section-blog',
					'control'           => 'ast-responsive-slider',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_responsive_slider' ),
					'type'              => 'sub-control',
					'transport'         => 'postMessage',
					'title'             => __( 'Font Size', 'astra-addon' ),
					'priority'          => 5,
					'default'           => astra_get_option( 'font-size-post-excerpt' ),
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
				),

				/**
				 * Option: Post Excerpt Font Extras
				 */
				array(
					'name'     => 'font-extras-post-excerpt',
					'type'     => 'sub-control',
					'parent'   => ASTRA_THEME_SETTINGS . '[blog-content-post-excerpt-typo]',
					'control'  => 'ast-font-extras',
					'section'  => 'section-blog',
					'priority' => 7,
					'default'  => astra_get_option( 'font-extras-post-excerpt' ),
					'title'    => __( 'Font Extras', 'astra-addon' ),
				),

				/**
				 * Option: Pagination Text Transform
				 */
				array(
					'name'      => 'text-transform-post-pagination',
					'parent'    => ASTRA_THEME_SETTINGS . '[blog-content-pagination-typo]',
					'section'   => 'section-blog',
					'title'     => __( 'Text Transform', 'astra-addon' ),
					'default'   => astra_get_option( 'text-transform-post-pagination' ),
					'transport' => 'postMessage',
					'type'      => 'sub-control',
					'control'   => 'ast-select',
					'choices'   => array(
						''           => __( 'Inherit', 'astra-addon' ),
						'none'       => __( 'None', 'astra-addon' ),
						'capitalize' => __( 'Capitalize', 'astra-addon' ),
						'uppercase'  => __( 'Uppercase', 'astra-addon' ),
						'lowercase'  => __( 'Lowercase', 'astra-addon' ),
					),
					'priority'  => 6,
					'divider'   => array( 'ast_class' => 'ast-sub-top-dotted-divider' ),
				),

				/**
				 * Option: Pagination Font Size
				 */

				array(
					'name'              => 'font-size-post-pagination',
					'parent'            => ASTRA_THEME_SETTINGS . '[blog-content-pagination-typo]',
					'type'              => 'sub-control',
					'control'           => 'ast-responsive-slider',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_responsive_slider' ),
					'section'           => 'section-blog',
					'transport'         => 'postMessage',
					'title'             => __( 'Font Size', 'astra-addon' ),
					'priority'          => 5,
					'default'           => astra_get_option( 'font-size-post-pagination' ),
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
				),
			);

			return array_merge( $configurations, $_configs );
		}
	}
}

new Astra_Archive_Advanced_Typo_Configs();
