<?php
/**
 * Blog Pro General Options for our theme.
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
if ( ! class_exists( 'Astra_Customizer_Colors_Archive' ) ) {

	/**
	 * Register General Customizer Configurations.
	 */
	// @codingStandardsIgnoreStart
	class Astra_Customizer_Colors_Archive extends Astra_Customizer_Config_Base {
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

			$content_colors_config_title = __( 'Content', 'astra-addon' );
			if ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) {
				$content_colors_config_title = __( 'Content Color', 'astra-addon' );
			}

			$_configs = array(
				// Option: Blog Content Color.
				array(
					'type'              => 'control',
					'control'           => 'ast-color',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
					'transport'         => 'postMessage',
					'priority'          => 2,
					'name'              => ASTRA_THEME_SETTINGS . '[blog-content-color]',
					'default'           => astra_get_option( 'blog-content-color' ),
					'title'             => __( 'Content Color', 'astra-addon' ),
					'section'           => 'section-blog',
					'context'           => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[blog-layout]',
							'operator' => '===',
							'value'    => 'blog-layout-6',
						),
					),
				),

				// Option: Blog Content Background Color.
				array(
					'type'              => 'control',
					'control'           => 'ast-color',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
					'transport'         => 'postMessage',
					'priority'          => 2,
					'name'              => ASTRA_THEME_SETTINGS . '[blog-content-bg-color]',
					'default'           => astra_get_option( 'blog-content-bg-color' ),
					'title'             => __( 'Background Color', 'astra-addon' ),
					'description'       => __( 'This option applies solely to post cards without a featured image.', 'astra-addon' ),
					'section'           => 'section-blog',
					'context'           => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[blog-layout]',
							'operator' => '===',
							'value'    => 'blog-layout-6',
						),
					),
				),

				// Option: Blog / Archive Post Title Color.
				array(
					'type'              => 'control',
					'control'           => 'ast-color',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
					'transport'         => 'postMessage',
					'priority'          => 130,
					'name'              => ASTRA_THEME_SETTINGS . '[page-title-color]',
					'default'           => astra_get_option( 'page-title-color' ),
					'title'             => __( 'Post Title Color', 'astra-addon' ),
					'section'           => 'section-blog',
					'context'           => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[blog-post-structure]',
							'operator' => 'contains',
							'value'    => 'title',
						),
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[blog-layout]',
							'operator' => '!=',
							'value'    => 'blog-layout-6',
						),
					),
				),

				// Option: Blog Excerpt Color.
				array(
					'type'              => 'control',
					'control'           => 'ast-color',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
					'transport'         => 'postMessage',
					'priority'          => 130,
					'name'              => ASTRA_THEME_SETTINGS . '[blog-excerpt-color]',
					'default'           => astra_get_option( 'blog-excerpt-color' ),
					'title'             => __( 'Excerpt Color', 'astra-addon' ),
					'section'           => 'section-blog',
					'context'           => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[blog-post-structure]',
							'operator' => 'contains',
							'value'    => 'excerpt',
						),
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[blog-layout]',
							'operator' => '!=',
							'value'    => 'blog-layout-6',
						),
					),
				),

				array(
					'name'      => ASTRA_THEME_SETTINGS . '[blog-meta-color-group]',
					'default'   => astra_get_option( 'blog-meta-color-group' ),
					'type'      => 'control',
					'control'   => 'ast-settings-group',
					'title'     => __( 'Meta Color', 'astra-addon' ),
					'section'   => 'section-blog',
					'transport' => 'postMessage',
					'priority'  => 130,
					'context'   => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[blog-post-structure]',
							'operator' => 'contains',
							'value'    => 'title-meta',
						),
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[blog-layout]',
							'operator' => '!=',
							'value'    => 'blog-layout-6',
						),
					),
				),

				array(
					'name'      => ASTRA_THEME_SETTINGS . '[blog-taxonomy-color-group]',
					'default'   => astra_get_option( 'blog-taxonomy-color-group' ),
					'type'      => 'control',
					'control'   => 'ast-settings-group',
					'title'     => __( 'Taxonomy Color', 'astra-addon' ),
					'section'   => 'section-blog',
					'transport' => 'postMessage',
					'priority'  => 130,
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
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[blog-layout]',
							'operator' => '!=',
							'value'    => 'blog-layout-6',
						),
					),
				),

				array(
					'name'      => ASTRA_THEME_SETTINGS . '[blog-read-more-color-group]',
					'default'   => astra_get_option( 'blog-read-more-color-group' ),
					'type'      => 'control',
					'control'   => 'ast-settings-group',
					'title'     => __( 'Read More Color', 'astra-addon' ),
					'section'   => 'section-blog',
					'transport' => 'postMessage',
					'priority'  => 130,
					'context'   => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[blog-post-structure]',
							'operator' => 'contains',
							'value'    => 'read-more',
						),
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[blog-layout]',
							'operator' => '!=',
							'value'    => 'blog-layout-6',
						),
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[blog-read-more-as-button]',
							'operator' => '!=',
							'value'    => true,
						),
					),
				),

				// Option: Blog Read More Color.
				array(
					'type'              => 'sub-control',
					'tab'               => __( 'Normal', 'astra-addon' ),
					'priority'          => 10,
					'parent'            => ASTRA_THEME_SETTINGS . '[blog-read-more-color-group]',
					'section'           => 'section-blog',
					'control'           => 'ast-color',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
					'default'           => astra_get_option( 'blog-read-more-color' ),
					'transport'         => 'postMessage',
					'name'              => 'blog-read-more-color',
					'title'             => __( 'Read More Color', 'astra-addon' ),
				),

				// Option: Post Meta Color.
				array(
					'type'              => 'sub-control',
					'tab'               => __( 'Normal', 'astra-addon' ),
					'priority'          => 10,
					'parent'            => ASTRA_THEME_SETTINGS . '[blog-meta-color-group]',
					'section'           => 'section-blog',
					'control'           => 'ast-color',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
					'default'           => astra_get_option( 'post-meta-color' ),
					'transport'         => 'postMessage',
					'name'              => 'post-meta-color',
					'title'             => __( 'Meta Color', 'astra-addon' ),
				),

				// Option: Post Meta Link Color.
				array(
					'type'              => 'sub-control',
					'tab'               => __( 'Normal', 'astra-addon' ),
					'priority'          => 10,
					'parent'            => ASTRA_THEME_SETTINGS . '[blog-meta-color-group]',
					'section'           => 'section-blog',
					'control'           => 'ast-color',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
					'default'           => astra_get_option( 'post-meta-link-color' ),
					'transport'         => 'postMessage',
					'name'              => 'post-meta-link-color',
					'title'             => __( 'Meta Link Color', 'astra-addon' ),
				),

				// Option: Post Tax Text Color.
				array(
					'type'              => 'sub-control',
					'tab'               => __( 'Normal', 'astra-addon' ),
					'priority'          => 10,
					'parent'            => ASTRA_THEME_SETTINGS . '[blog-taxonomy-color-group]',
					'section'           => 'section-blog',
					'control'           => 'ast-color',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
					'default'           => astra_get_option( 'blog-tax-color' ),
					'transport'         => 'postMessage',
					'name'              => 'blog-tax-color',
					'title'             => __( 'Taxonomy Text Color', 'astra-addon' ),
				),

				// Option: Post Tax Background Color.
				array(
					'type'              => 'sub-control',
					'tab'               => __( 'Normal', 'astra-addon' ),
					'priority'          => 10,
					'parent'            => ASTRA_THEME_SETTINGS . '[blog-taxonomy-color-group]',
					'section'           => 'section-blog',
					'control'           => 'ast-color',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
					'default'           => astra_get_option( 'blog-tax-bg-color' ),
					'transport'         => 'postMessage',
					'name'              => 'blog-tax-bg-color',
					'title'             => __( 'Taxonomy Background', 'astra-addon' ),
				),

				// Option: Post Tax Border Color.
				array(
					'type'              => 'sub-control',
					'tab'               => __( 'Normal', 'astra-addon' ),
					'priority'          => 10,
					'parent'            => ASTRA_THEME_SETTINGS . '[blog-taxonomy-color-group]',
					'section'           => 'section-blog',
					'control'           => 'ast-color',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
					'default'           => astra_get_option( 'blog-tax-border-color' ),
					'transport'         => 'postMessage',
					'name'              => 'blog-tax-border-color',
					'title'             => __( 'Taxonomy Border Color', 'astra-addon' ),
				),

				// Option: Post Meta Link Hover Color.
				array(
					'type'              => 'sub-control',
					'tab'               => __( 'Hover', 'astra-addon' ),
					'priority'          => 12,
					'parent'            => ASTRA_THEME_SETTINGS . '[blog-meta-color-group]',
					'section'           => 'section-blog',
					'control'           => 'ast-color',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
					'default'           => astra_get_option( 'post-meta-link-h-color' ),
					'transport'         => 'postMessage',
					'name'              => 'post-meta-link-h-color',
					'title'             => __( 'Meta Link Color', 'astra-addon' ),
				),

				// Option: Post Tax Text Hover Color.
				array(
					'type'              => 'sub-control',
					'tab'               => __( 'Hover', 'astra-addon' ),
					'priority'          => 12,
					'parent'            => ASTRA_THEME_SETTINGS . '[blog-taxonomy-color-group]',
					'section'           => 'section-blog',
					'control'           => 'ast-color',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
					'default'           => astra_get_option( 'blog-tax-h-color' ),
					'transport'         => 'postMessage',
					'name'              => 'blog-tax-h-color',
					'title'             => __( 'Taxonomy Text Color', 'astra-addon' ),
				),

				// Option: Post Tax Text Background Hover Color.
				array(
					'type'              => 'sub-control',
					'tab'               => __( 'Hover', 'astra-addon' ),
					'priority'          => 12,
					'parent'            => ASTRA_THEME_SETTINGS . '[blog-taxonomy-color-group]',
					'section'           => 'section-blog',
					'control'           => 'ast-color',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
					'default'           => astra_get_option( 'blog-tax-bg-h-color' ),
					'transport'         => 'postMessage',
					'name'              => 'blog-tax-bg-h-color',
					'title'             => __( 'Taxonomy Background', 'astra-addon' ),
				),

				// Option: Post Tax Text Border Hover Color.
				array(
					'type'              => 'sub-control',
					'tab'               => __( 'Hover', 'astra-addon' ),
					'priority'          => 12,
					'parent'            => ASTRA_THEME_SETTINGS . '[blog-taxonomy-color-group]',
					'section'           => 'section-blog',
					'control'           => 'ast-color',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
					'default'           => astra_get_option( 'blog-tax-border-h-color' ),
					'transport'         => 'postMessage',
					'name'              => 'blog-tax-border-h-color',
					'title'             => __( 'Taxonomy Border Color', 'astra-addon' ),
				),

				// Option: Blog Read More Hover Color.
				array(
					'type'              => 'sub-control',
					'tab'               => __( 'Hover', 'astra-addon' ),
					'priority'          => 12,
					'parent'            => ASTRA_THEME_SETTINGS . '[blog-read-more-color-group]',
					'section'           => 'section-blog',
					'control'           => 'ast-color',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
					'default'           => astra_get_option( 'blog-read-more-h-color' ),
					'transport'         => 'postMessage',
					'name'              => 'blog-read-more-h-color',
					'title'             => __( 'Read More Color', 'astra-addon' ),
				),

				// Option Group: Box shadow Group.
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[blog-items-box-shadow-group]',
					'type'      => 'control',
					'control'   => 'ast-settings-group',
					'title'     => __( 'Box Shadow', 'astra-addon' ),
					'section'   => 'section-blog',
					'transport' => 'postMessage',
					'priority'  => 143,
					'context'   => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'relation' => 'OR',
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[blog-layout]',
								'operator' => '===',
								'value'    => 'blog-layout-4',
							),
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[blog-layout]',
								'operator' => '===',
								'value'    => 'blog-layout-5',
							),
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[blog-layout]',
								'operator' => '===',
								'value'    => 'blog-layout-6',
							),
						),
					),
				),

				/**
				 * Option: Blog Box Shadow Sub Controls.
				 */
				array(
					'name'              => 'blog-item-box-shadow-control',
					'default'           => astra_get_option( 'blog-item-box-shadow-control' ),
					'parent'            => ASTRA_THEME_SETTINGS . '[blog-items-box-shadow-group]',
					'type'              => 'sub-control',
					'transport'         => 'postMessage',
					'control'           => 'ast-box-shadow',
					'section'           => 'section-blog',
					'sanitize_callback' => array( 'Astra_Addon_Customizer', 'sanitize_box_shadow' ),
					'priority'          => 1,
					'title'             => __( 'Value', 'astra-addon' ),
					'choices'           => array(
						'x'      => __( 'X', 'astra-addon' ),
						'y'      => __( 'Y', 'astra-addon' ),
						'blur'   => __( 'Blur', 'astra-addon' ),
						'spread' => __( 'Spread', 'astra-addon' ),
					),
				),

				array(
					'name'      => 'blog-item-box-shadow-position',
					'default'   => astra_get_option( 'blog-item-box-shadow-position' ),
					'parent'    => ASTRA_THEME_SETTINGS . '[blog-items-box-shadow-group]',
					'type'      => 'sub-control',
					'section'   => 'section-blog',
					'transport' => 'postMessage',
					'control'   => 'ast-select',
					'title'     => __( 'Position', 'astra-addon' ),
					'choices'   => array(
						'outline' => __( 'Outline', 'astra-addon' ),
						'inset'   => __( 'Inset', 'astra-addon' ),
					),
					'priority'  => 2,
				),

				array(
					'name'      => 'blog-item-box-shadow-color',
					'default'   => astra_get_option( 'blog-item-box-shadow-color' ),
					'parent'    => ASTRA_THEME_SETTINGS . '[blog-items-box-shadow-group]',
					'type'      => 'sub-control',
					'section'   => 'woocommerce_product_catalog',
					'transport' => 'postMessage',
					'control'   => 'ast-color',
					'title'     => __( 'Color', 'astra-addon' ),
					'rgba'      => true,
					'priority'  => 3,
				),
			);

			if ( false === astra_addon_builder_helper()->is_header_footer_builder_active ) {

				array_push(
					$_configs,
					/**
					 * Option: Blog Color Section heading
					 */
					array(
						'name'     => ASTRA_THEME_SETTINGS . '[blog-color-heading-divider]',
						'type'     => 'control',
						'control'  => 'ast-heading',
						'section'  => 'section-blog',
						'title'    => __( 'Colors and Background', 'astra-addon' ),
						'priority' => 125,
						'settings' => array(),
						'context'  => astra_addon_builder_helper()->design_tab,
					)
				);
			}

			return array_merge( $configurations, $_configs );
		}
	}
}

/**
 * Kicking this off by calling 'get_instance()' method
 */
new Astra_Customizer_Colors_Archive();
