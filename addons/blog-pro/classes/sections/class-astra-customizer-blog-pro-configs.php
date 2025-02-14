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
if ( ! class_exists( 'Astra_Customizer_Blog_Pro_Configs' ) ) {

	/**
	 * Register General Customizer Configurations.
	 */
	// @codingStandardsIgnoreStart
	class Astra_Customizer_Blog_Pro_Configs extends Astra_Customizer_Config_Base {
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

			$term_args      = array(
				'hide_empty' => true,
			);
			$categories     = array();
			$tags           = array();
			$category_query = get_terms( 'category', $term_args );

			foreach ( $category_query as $single ) {
				$categories[ $single->term_id ] = array(
					'name' => $single->name,
				);
			}
			$tag_query = get_terms( 'post_tag', $term_args );

			foreach ( $tag_query as $single ) {
				$tags[ $single->term_id ] = array(
					'name' => $single->name,
				);
			}

			$_configs = array(

				/**
				 * Option: No of Columns
				 */
				array(
					'name'         => ASTRA_THEME_SETTINGS . '[blog-grid-resp]',
					'default'      => astra_addon_get_blog_grid_columns(),
					'type'         => 'control',
					'control'      => 'ast-number',
					'qty_selector' => true,
					'section'      => 'section-blog',
					'title'        => __( 'No of Columns', 'astra-addon' ),
					'priority'     => 15,
					'responsive'   => true,
					'input_attrs'  => array(
						'min'  => 1,
						'step' => 1,
						'max'  => 4,
					),
					'context'      => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'relation' => 'OR',
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[blog-layout]',
								'operator' => '===',
								'value'    => 'blog-layout-1',
							),
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[blog-layout]',
								'operator' => '===',
								'value'    => 'blog-layout-4',
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
				 * Option: Space Between Post
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[blog-space-bet-posts]',
					'default'   => astra_get_option( 'blog-space-bet-posts' ),
					'type'      => 'control',
					'control'   => Astra_Theme_Extension::$switch_control,
					'section'   => 'section-blog',
					'title'     => __( 'Add Space Between Posts', 'astra-addon' ),
					'transport' => 'postMessage',
					'divider'   => array( 'ast_class' => 'ast-top-dotted-divider' ),
					'priority'  => 15,
					'context'   => array(
						astra_addon_builder_helper()->general_tab_config,
					),
				),

				/**
				 * Option: Masonry Effect
				 */
				array(
					'name'        => ASTRA_THEME_SETTINGS . '[blog-masonry]',
					'default'     => astra_get_option( 'blog-masonry' ),
					'type'        => 'control',
					'control'     => Astra_Theme_Extension::$switch_control,
					'section'     => 'section-blog',
					'title'       => __( 'Masonry Layout', 'astra-addon' ),
					'description' => __( 'This will not work if the number of columns is set to 1.', 'astra-addon' ),
					'priority'    => 20,
					'divider'     => array( 'ast_class' => 'ast-top-section-spacing' ),
					'context'     => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'relation' => 'OR',
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[blog-layout]',
								'operator' => '===',
								'value'    => 'blog-layout-1',
							),
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[blog-layout]',
								'operator' => '===',
								'value'    => 'blog-layout-4',
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
				 * Option: First Post full width
				 */
				array(
					'name'        => ASTRA_THEME_SETTINGS . '[first-post-full-width]',
					'default'     => astra_get_option( 'first-post-full-width' ),
					'type'        => 'control',
					'control'     => Astra_Theme_Extension::$switch_control,
					'section'     => 'section-blog',
					'title'       => __( 'Highlight First Post', 'astra-addon' ),
					'description' => __( 'This will not work if the number of columns is set to 1 or Masonry Layout is enabled.', 'astra-addon' ),
					'divider'     => array( 'ast_class' => 'ast-top-section-spacing' ),
					'priority'    => 25,
					'context'     => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'relation' => 'OR',
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[blog-layout]',
								'operator' => '===',
								'value'    => 'blog-layout-1',
							),
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[blog-layout]',
								'operator' => '===',
								'value'    => 'blog-layout-4',
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
				 * Option: Blog Equal Grids.
				 */
				array(
					'name'        => ASTRA_THEME_SETTINGS . '[blog-equal-grid]',
					'default'     => astra_get_option( 'blog-equal-grid' ),
					'type'        => 'control',
					'control'     => Astra_Theme_Extension::$switch_control,
					'section'     => 'section-blog',
					'title'       => __( 'Equal Grids', 'astra-addon' ),
					'description' => __( 'This will not work if the number of columns is set to 1.', 'astra-addon' ),
					'divider'     => array( 'ast_class' => 'ast-top-section-spacing' ),
					'priority'    => 25,
					'context'     => array(
						astra_addon_builder_helper()->general_tab_config,
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
								'value'    => 'blog-layout-6',
							),
						),
					),
				),

				/**
				 * Option: Blog Reveal Effect.
				 */
				array(
					'name'        => ASTRA_THEME_SETTINGS . '[blog-reveal-effect]',
					'default'     => astra_get_option( 'blog-reveal-effect' ),
					'type'        => 'control',
					'control'     => Astra_Theme_Extension::$switch_control,
					'section'     => 'section-blog',
					'divider'     => array( 'ast_class' => 'ast-top-section-spacing' ),
					'description' => __( 'This will not work if Masonry Layout is enabled.', 'astra-addon' ),
					'title'       => __( 'Reveal Effect', 'astra-addon' ),
					'priority'    => 25,
					'context'     => array(
						astra_addon_builder_helper()->general_tab_config,
					),
				),

				/**
				 * Option: First Post full width
				 */
				array(
					'name'        => ASTRA_THEME_SETTINGS . '[blog-row-reverse]',
					'default'     => astra_get_option( 'blog-row-reverse' ),
					'type'        => 'control',
					'control'     => Astra_Theme_Extension::$switch_control,
					'section'     => 'section-blog',
					'title'       => __( 'Row Reverse', 'astra-addon' ),
					'description' => __( 'This option reverses the position of post-content and featured image.', 'astra-addon' ),
					'divider'     => array( 'ast_class' => 'ast-top-section-spacing' ),
					'priority'    => 25,
					'context'     => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[blog-layout]',
							'operator' => '===',
							'value'    => 'blog-layout-5',
						),
					),
				),

				/**
				 * Option: Remove feature image padding
				 */
				array(
					'name'        => ASTRA_THEME_SETTINGS . '[blog-featured-image-padding]',
					'default'     => astra_get_option( 'blog-featured-image-padding' ),
					'type'        => 'control',
					'control'     => Astra_Theme_Extension::$switch_control,
					'section'     => 'section-blog',
					'title'       => __( 'Remove Image Padding', 'astra-addon' ),
					'description' => __( 'This option will not work on full width layouts.', 'astra-addon' ),
					'divider'     => array( 'ast_class' => 'ast-top-section-spacing' ),
					'priority'    => 26,
					'context'     => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'relation' => 'OR',
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[blog-layout]',
								'operator' => '===',
								'value'    => 'blog-layout-1',
							),
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[blog-layout]',
								'operator' => '===',
								'value'    => 'blog-layout-4',
							),
						),
					),
				),

				/**
				 * Option: Disable Date Box.
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[blog-date-box]',
					'default'  => astra_get_option( 'blog-date-box' ),
					'type'     => 'control',
					'control'  => Astra_Theme_Extension::$switch_control,
					'section'  => 'section-blog',
					'title'    => __( 'Enable Date Box', 'astra-addon' ),
					'divider'  => array( 'ast_class' => 'ast-top-section-spacing' ),
					'priority' => 30,
					'context'  => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'relation' => 'OR',
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[blog-layout]',
								'operator' => '===',
								'value'    => 'blog-layout-1',
							),
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[blog-layout]',
								'operator' => '===',
								'value'    => 'blog-layout-2',
							),
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[blog-layout]',
								'operator' => '===',
								'value'    => 'blog-layout-3',
							),
						),
					),
				),

				/**
				 * Option: Date Box Style
				 */
				array(
					'name'       => ASTRA_THEME_SETTINGS . '[blog-date-box-style]',
					'default'    => astra_get_option( 'blog-date-box-style' ),
					'type'       => 'control',
					'section'    => 'section-blog',
					'title'      => __( 'Date Box Style', 'astra-addon' ),
					'control'    => Astra_Theme_Extension::$selector_control,
					'priority'   => 35,
					'choices'    => array(
						'square' => __( 'Square', 'astra-addon' ),
						'circle' => __( 'Circle', 'astra-addon' ),
					),
					'context'    => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[blog-date-box]',
							'operator' => '===',
							'value'    => true,
						),
						array(
							'relation' => 'OR',
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[blog-layout]',
								'operator' => '===',
								'value'    => 'blog-layout-1',
							),
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[blog-layout]',
								'operator' => '===',
								'value'    => 'blog-layout-2',
							),
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[blog-layout]',
								'operator' => '===',
								'value'    => 'blog-layout-3',
							),
						),
					),
					'responsive' => false,
					'renderAs'   => 'text',
					'divider'    => array( 'ast_class' => 'ast-top-dotted-divider' ),
				),

				array(
					'name'              => ASTRA_THEME_SETTINGS . '[blog-meta]',
					'type'              => 'control',
					'control'           => 'ast-sortable',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_multi_choices' ),
					'section'           => 'section-blog',
					'default'           => astra_get_option( 'blog-meta' ),
					'priority'          => 52,
					'context'           => array(
						Astra_Builder_Helper::$general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[blog-post-structure]',
							'operator' => 'contains',
							'value'    => 'title-meta',
						),
					),
					'title'             => __( 'Meta', 'astra-addon' ),
					'choices'           => array(
						'comments'  => __( 'Comments', 'astra-addon' ),
						'category'  => array(
							'clone'       => false,
							'is_parent'   => true,
							'main_index'  => 'category',
							'clone_limit' => 1,
							'title'       => __( 'Categories', 'astra-addon' ),
						),
						'author'    => array(
							'clone'       => false,
							'is_parent'   => true,
							'main_index'  => 'author',
							'clone_limit' => 1,
							'title'       => __( 'Author', 'astra-addon' ),
						),
						'date'      => array(
							'clone'       => false,
							'is_parent'   => true,
							'main_index'  => 'date',
							'clone_limit' => 1,
							'title'       => __( 'Published Date', 'astra-addon' ),
						),
						'tag'       => array(
							'clone'       => false,
							'is_parent'   => true,
							'main_index'  => 'tag',
							'clone_limit' => 1,
							'title'       => __( 'Tags', 'astra-addon' ),
						),
						'read-time' => __( 'Read Time', 'astra-addon' ),
					),
					'divider'           => array( 'ast_class' => 'ast-top-section-divider' ),
				),

				/**
				 * Option: Excerpt Count
				 */
				array(
					'name'         => 'blog-excerpt-count',
					'parent'       => ASTRA_THEME_SETTINGS . '[blog-post-structure]',
					'section'      => 'section-blog',
					'default'      => astra_get_option( 'blog-excerpt-count' ),
					'type'         => 'sub-control',
					'control'      => 'ast-number',
					'qty_selector' => true,
					'linked'       => 'excerpt',
					'priority'     => 80,
					'responsive'   => false,
					'transport'    => 'postMessage',
					'title'        => __( 'Excerpt Count', 'astra-addon' ),
					'input_attrs'  => array(
						'min'  => 0,
						'step' => 1,
						'max'  => 300,
					),
					'divider'      => array( 'ast_class' => 'ast-top-dotted-divider' ),
				),

				/**
				 * Option: Read more text
				 */
				array(
					'name'    => 'blog-read-more-text',
					'parent'  => ASTRA_THEME_SETTINGS . '[blog-post-structure]',
					'default' => astra_get_option( 'blog-read-more-text' ),
					'type'    => 'sub-control',
					'section' => 'section-blog',
					'linked'  => 'read-more',
					'title'   => __( 'Text', 'astra-addon' ),
					'control' => 'ast-text-input',
				),

				/**
				 * Option: Display read more as button
				 */
				array(
					'name'    => 'blog-read-more-as-button',
					'parent'  => ASTRA_THEME_SETTINGS . '[blog-post-structure]',
					'default' => astra_get_option( 'blog-read-more-as-button' ),
					'type'    => 'sub-control',
					'linked'  => 'read-more',
					'control' => 'ast-toggle',
					'section' => 'section-blog',
					'title'   => __( 'As Button', 'astra-addon' ),
					'divider' => array( 'ast_class' => 'ast-top-dotted-divider' ),
				),

				/**
				 * Option: Divider
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[blog-pagination-divider]',
					'section'  => 'section-blog',
					'title'    => __( 'Pagination', 'astra-addon' ),
					'type'     => 'control',
					'control'  => 'ast-heading',
					'priority' => 110,
					'settings' => array(),
					'divider'  => array( 'ast_class' => 'ast-section-spacing ast-bottom-spacing' ),
				),

				/**
				 * Option: Post Pagination
				 */
				array(
					'name'       => ASTRA_THEME_SETTINGS . '[blog-pagination]',
					'default'    => astra_get_option( 'blog-pagination' ),
					'type'       => 'control',
					'control'    => Astra_Theme_Extension::$selector_control,
					'section'    => 'section-blog',
					'priority'   => 110,
					'title'      => __( 'Post Pagination', 'astra-addon' ),
					'choices'    => array(
						'number'   => __( 'Number', 'astra-addon' ),
						'infinite' => __( 'Infinite Scroll', 'astra-addon' ),
					),
					'responsive' => false,
					'renderAs'   => 'text',
					'divider'    => array( 'ast_class' => 'ast-bottom-dotted-divider' ),
				),

				/**
				 * Option: Event to Trigger Infinite Loading
				 */
				array(
					'name'        => ASTRA_THEME_SETTINGS . '[blog-infinite-scroll-event]',
					'default'     => astra_get_option( 'blog-infinite-scroll-event' ),
					'type'        => 'control',
					'control'     => Astra_Theme_Extension::$selector_control,
					'section'     => 'section-blog',
					'description' => __( 'Infinite Scroll cannot be previewed in the Customizer.', 'astra-addon' ),
					'priority'    => 112,
					'title'       => __( 'Event to Trigger Infinite Loading', 'astra-addon' ),
					'choices'     => array(
						'scroll' => __( 'Scroll', 'astra-addon' ),
						'click'  => __( 'Click', 'astra-addon' ),
					),
					'context'     => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[blog-pagination]',
							'operator' => '===',
							'value'    => 'infinite',
						),
					),
					'responsive'  => false,
					'renderAs'    => 'text',
				),

				/**
				 * Option: Post Pagination Style
				 */
				array(
					'name'       => ASTRA_THEME_SETTINGS . '[blog-pagination-style]',
					'default'    => astra_get_option( 'blog-pagination-style' ),
					'type'       => 'control',
					'control'    => Astra_Theme_Extension::$selector_control,
					'section'    => 'section-blog',
					'priority'   => 115,
					'title'      => __( 'Post Pagination Style', 'astra-addon' ),
					'choices'    => array(
						'default' => __( 'Default', 'astra-addon' ),
						'square'  => __( 'Square', 'astra-addon' ),
						'circle'  => __( 'Circle', 'astra-addon' ),
					),
					'context'    => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[blog-pagination]',
							'operator' => '===',
							'value'    => 'number',
						),
					),
					'responsive' => false,
					'renderAs'   => 'text',
				),

				/**
				 * Option: Read more text
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[blog-load-more-text]',
					'default'  => astra_get_option( 'blog-load-more-text' ),
					'type'     => 'control',
					'section'  => 'section-blog',
					'priority' => 113,
					'title'    => __( 'Load More Text', 'astra-addon' ),
					'control'  => 'text',
					'context'  => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[blog-pagination]',
							'operator' => '===',
							'value'    => 'infinite',
						),
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[blog-infinite-scroll-event]',
							'operator' => '===',
							'value'    => 'click',
						),
					),
				),

				/**
				 * Option: Author Prefix Label.
				 */
				array(
					'name'      => 'blog-meta-author-avatar-prefix-label',
					'default'   => astra_get_option( 'blog-meta-author-avatar-prefix-label', astra_default_strings( 'string-blog-meta-author-by', false ) ),
					'parent'    => ASTRA_THEME_SETTINGS . '[blog-meta]',
					'linked'    => 'author',
					'type'      => 'sub-control',
					'control'   => 'ast-text-input',
					'section'   => 'section-blog',
					'divider'   => array( 'ast_class' => 'ast-bottom-dotted-divider ast-bottom-section-spacing' ),
					'title'     => __( 'Prefix Label', 'astra-addon' ),
					'transport' => 'postMessage',
				),

				/**
				 * Option: Author Avatar.
				 */
				array(
					'name'    => 'blog-meta-author-avatar',
					'parent'  => ASTRA_THEME_SETTINGS . '[blog-meta]',
					'default' => astra_get_option( 'blog-meta-author-avatar' ),
					'type'    => 'sub-control',
					'linked'  => 'author',
					'control' => 'ast-toggle',
					'section' => 'section-blog',
					'title'   => __( 'Author Avatar', 'astra-addon' ),
				),

				/**
				 * Option: Author Avatar size.
				 */
				array(
					'name'              => 'blog-meta-author-avatar-size',
					'default'           => astra_get_option( 'blog-meta-author-avatar-size' ),
					'type'              => 'sub-control',
					'parent'            => ASTRA_THEME_SETTINGS . '[blog-meta]',
					'section'           => 'section-blog',
					'linked'            => 'author',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_number_n_blank' ),
					'title'             => __( 'Image Size', 'astra-addon' ),
					'control'           => 'ast-slider',
					'suffix'            => 'px',
					'input_attrs'       => array(
						'min'  => 1,
						'step' => 1,
						'max'  => 100,
					),
				),

				/**
				 * Option: Post Filter Heading.
				 */
				array(
					'name'        => 'post-filter-section-ast-context-tabs',
					'section'     => 'ast-sub-section-post-filter',
					'type'        => 'control',
					'control'     => 'ast-builder-header-control',
					'priority'    => 0,
					'description' => '',
					'context'     => array(),
				),
				array(
					'name'     => 'ast-sub-section-post-filter',
					'title'    => __( 'Post Filter', 'astra-addon' ),
					'type'     => 'section',
					'section'  => 'section-blog',
					'panel'    => '',
					'priority' => 1,
				),
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[blog-filter-heading]',
					'section'  => 'section-blog',
					'title'    => __( 'Post Filter', 'astra-addon' ),
					'type'     => 'control',
					'control'  => 'ast-heading',
					'priority' => 115,
					'settings' => array(),
					'divider'  => array( 'ast_class' => 'ast-section-spacing' ),
				),
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[blog-filter]',
					'type'     => 'control',
					'default'  => astra_get_option( 'blog-filter' ),
					'control'  => 'ast-section-toggle',
					'section'  => 'section-blog',
					'priority' => 115,
					'linked'   => 'ast-sub-section-post-filter',
					'linkText' => __( 'Post Filter', 'astra-addon' ),
					'divider'  => array( 'ast_class' => 'ast-bottom-divider ast-bottom-section-divider' ),
				),

				/**
				 * Option: Blog Filter Style.
				 */
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[blog-filter-layout]',
					'type'              => 'control',
					'control'           => 'ast-radio-image',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_choices' ),
					'section'           => 'ast-sub-section-post-filter',
					'default'           => astra_get_option( 'blog-filter-layout' ),
					'priority'          => 115,
					'title'             => __( 'Style', 'astra-addon' ),
					'choices'           => array(
						'blog-filter-layout-1' => array(
							'label' => __( 'Style 1', 'astra-addon' ),
							'path'  => class_exists( 'Astra_Builder_UI_Controller' ) ? Astra_Builder_UI_Controller::fetch_svg_icon( 'blog-filter-layout-1', false ) : '',
						),
						'blog-filter-layout-2' => array(
							'label' => __( 'Style 2', 'astra-addon' ),
							'path'  => class_exists( 'Astra_Builder_UI_Controller' ) ? Astra_Builder_UI_Controller::fetch_svg_icon( 'blog-filter-layout-2', false ) : '',
						),
					),
					'divider'           => array( 'ast_class' => 'ast-top-section-spacing' ),
					'context'           => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[blog-filter]',
							'operator' => '===',
							'value'    => true,
						),
					),
				),

				/**
				 * Option: Blog Filter by
				 */
				array(
					'name'       => ASTRA_THEME_SETTINGS . '[blog-filter-by]',
					'default'    => astra_get_option( 'blog-filter-by' ),
					'type'       => 'control',
					'priority'   => 115,
					'control'    => 'ast-selector',
					'section'    => 'ast-sub-section-post-filter',
					'title'      => __( 'Filter source', 'astra-addon' ),
					'choices'    => array(
						'categories' => __( 'Categories', 'astra-addon' ),
						'tags'       => __( 'Tags', 'astra-addon' ),
					),
					'renderAs'   => 'text',
					'responsive' => false,
					'context'    => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[blog-filter]',
							'operator' => '===',
							'value'    => true,
						),
					),
					'divider'    => array( 'ast_class' => 'ast-top-section-divider' ),
				),

				/**
				 * Option: Blog filter category to include
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[blog-filter-category-exclude]',
					'default'   => astra_get_option( 'blog-filter-category-exclude' ),
					'type'      => 'control',
					'priority'  => 115,
					'control'   => 'ast-select-multi',
					'section'   => 'ast-sub-section-post-filter',
					'title'     => __( 'Categories Exclude', 'astra-addon' ),
					'choices'   => $categories,
					'transport' => 'refresh',
					'context'   => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[blog-filter]',
							'operator' => '===',
							'value'    => true,
						),
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[blog-filter-by]',
							'operator' => '===',
							'value'    => 'categories',
						),
					),
					'divider'   => array( 'ast_class' => 'ast-top-section-divider' ),
				),

				/**
				 * Option: Blog filter tags to include
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[blog-filter-tag-exclude]',
					'default'   => astra_get_option( 'blog-filter-tag-exclude' ),
					'type'      => 'control',
					'priority'  => 115,
					'control'   => 'ast-select-multi',
					'section'   => 'ast-sub-section-post-filter',
					'title'     => __( 'Tags Exclude', 'astra-addon' ),
					'choices'   => $tags,
					'transport' => 'refresh',
					'context'   => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[blog-filter]',
							'operator' => '===',
							'value'    => true,
						),
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[blog-filter-by]',
							'operator' => '===',
							'value'    => 'tags',
						),
					),
					'divider'   => array( 'ast_class' => 'ast-top-section-divider' ),
				),

				/**
				 * Option: Blog Filter alignment
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[blog-filter-alignment]',
					'default'   => astra_get_option( 'blog-filter-alignment' ),
					'type'      => 'control',
					'priority'  => 115,
					'control'   => 'ast-selector',
					'section'   => 'ast-sub-section-post-filter',
					'title'     => __( 'Alignment', 'astra-addon' ),
					'choices'   => array(
						'left'   => __( 'Left', 'astra-addon' ),
						'center' => __( 'Center', 'astra-addon' ),
						'right'  => __( 'Right', 'astra-addon' ),
					),
					'renderAs'  => 'text',
					'transport' => 'postMessage',
					'context'   => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[blog-filter]',
							'operator' => '===',
							'value'    => true,
						),
					),
					'divider'   => array( 'ast_class' => 'ast-top-section-divider' ),
				),

				/**
				 * Option: Blog Filter visibility
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[responsive-blog-filter-visibility]',
					'default'   => astra_get_option( 'responsive-blog-filter-visibility' ),
					'type'      => 'control',
					'control'   => 'ast-multi-selector',
					'section'   => 'ast-sub-section-post-filter',
					'priority'  => 115,
					'title'     => __( 'Visibility', 'astra-addon' ),
					'context'   => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[blog-filter]',
							'operator' => '===',
							'value'    => true,
						),
					),
					'transport' => 'postMessage',
					'choices'   => array(
						'desktop' => 'customizer-desktop',
						'tablet'  => 'customizer-tablet',
						'mobile'  => 'customizer-mobile',
					),
					'divider'   => array( 'ast_class' => 'ast-top-section-divider' ),
				),

				/**
				 * Option: Blog Filter taxonomy Font Family
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[blog-filter-taxonomy-typo]',
					'default'   => astra_get_option( 'blog-filter-taxonomy-typo' ),
					'type'      => 'control',
					'control'   => 'ast-settings-group',
					'title'     => __( 'Text Font', 'astra-addon' ),
					'section'   => 'ast-sub-section-post-filter',
					'transport' => 'postMessage',
					'priority'  => 163,
					'context'   => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[blog-filter]',
							'operator' => '===',
							'value'    => true,
						),
					),
					'divider'   => array( 'ast_class' => 'ast-top-section-spacing ast-bottom-section-divider' ),
				),

				/**
				 * Option: Blog Filter taxonomy Font Family
				 */
				array(
					'name'      => 'font-family-blog-filter-taxonomy',
					'parent'    => ASTRA_THEME_SETTINGS . '[blog-filter-taxonomy-typo]',
					'section'   => 'ast-sub-section-post-filter',
					'type'      => 'sub-control',
					'control'   => 'ast-font',
					'font_type' => 'ast-font-family',
					'default'   => astra_get_option( 'font-family-blog-filter-taxonomy' ),
					'title'     => __( 'Font Family', 'astra-addon' ),
					'connect'   => ASTRA_THEME_SETTINGS . '[font-weight-post-meta]',
					'priority'  => 163,
					'divider'   => array( 'ast_class' => 'ast-sub-bottom-dotted-divider' ),
				),

				/**
				 * Option: Blog Filter taxonomy Font Weight
				 */
				array(
					'name'              => 'font-weight-blog-filter-taxonomy',
					'parent'            => ASTRA_THEME_SETTINGS . '[blog-filter-taxonomy-typo]',
					'section'           => 'ast-sub-section-post-filter',
					'type'              => 'sub-control',
					'control'           => 'ast-font',
					'font_type'         => 'ast-font-weight',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_font_weight' ),
					'default'           => astra_get_option( 'font-weight-blog-filter-taxonomy' ),
					'title'             => __( 'Font Weight', 'astra-addon' ),
					'connect'           => 'font-family-blog-filter-taxonomy',
					'priority'          => 163,
					'divider'           => array( 'ast_class' => 'ast-sub-bottom-dotted-divider' ),
				),

				/**
				 * Option: Blog Filter taxonomy Font Size
				 */

				array(
					'name'              => 'font-size-blog-filter-taxonomy',
					'parent'            => ASTRA_THEME_SETTINGS . '[blog-filter-taxonomy-typo]',
					'section'           => 'ast-sub-section-post-filter',
					'control'           => 'ast-responsive-slider',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_responsive_slider' ),
					'type'              => 'sub-control',
					'transport'         => 'postMessage',
					'title'             => __( 'Font Size', 'astra-addon' ),
					'priority'          => 163,
					'default'           => astra_get_option( 'font-size-blog-filter-taxonomy' ),
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
				 * Option: Blog Filter taxonomy Font Extras
				 */
				array(
					'name'     => 'font-extras-blog-filter-taxonomy',
					'type'     => 'sub-control',
					'parent'   => ASTRA_THEME_SETTINGS . '[blog-filter-taxonomy-typo]',
					'control'  => 'ast-font-extras',
					'section'  => 'ast-sub-section-post-filter',
					'priority' => 163,
					'default'  => astra_get_option( 'font-extras-blog-filter-taxonomy' ),
					'title'    => __( 'Font Extras', 'astra-addon' ),
				),

				/**
				 * Option: Blog Filter taxonomy background color group.
				 */
				array(
					'name'       => ASTRA_THEME_SETTINGS . '[blog-filter-taxonomy-bg-colors]',
					'default'    => astra_get_option( 'blog-filter-taxonomy-bg-colors' ),
					'type'       => 'control',
					'section'    => 'ast-sub-section-post-filter',
					'title'      => __( 'Background Color', 'astra-addon' ),
					'control'    => 'ast-color-group',
					'priority'   => 163,
					'responsive' => false,
					'context'    => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[blog-filter]',
							'operator' => '===',
							'value'    => true,
						),
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[blog-filter-layout]',
							'operator' => '===',
							'value'    => 'blog-filter-layout-2',
						),
					),
				),

				/**
				 * Option: Blog Filter taxonomy background normal color.
				 */
				array(
					'type'       => 'sub-control',
					'parent'     => ASTRA_THEME_SETTINGS . '[blog-filter-taxonomy-bg-colors]',
					'control'    => 'ast-responsive-color',
					'transport'  => 'postMessage',
					'section'    => 'ast-sub-section-post-filter',
					'name'       => 'blog-filter-taxonomy-bg-normal-color',
					'default'    => astra_get_option( 'blog-filter-taxonomy-bg-normal-color' ),
					'title'      => __( 'Normal', 'astra-addon' ),
					'responsive' => false,
					'rgba'       => true,
					'priority'   => 163,
					'context'    => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[blog-filter]',
							'operator' => '===',
							'value'    => true,
						),
					),
				),

				/**
				 * Option: Blog Filter taxonomy background hover color.
				 */
				array(
					'type'       => 'sub-control',
					'parent'     => ASTRA_THEME_SETTINGS . '[blog-filter-taxonomy-bg-colors]',
					'control'    => 'ast-responsive-color',
					'transport'  => 'postMessage',
					'section'    => 'ast-sub-section-post-filter',
					'name'       => 'blog-filter-taxonomy-bg-hover-color',
					'default'    => astra_get_option( 'blog-filter-taxonomy-bg-hover-color' ),
					'title'      => __( 'Hover', 'astra-addon' ),
					'responsive' => false,
					'rgba'       => true,
					'priority'   => 163,
					'context'    => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[blog-filter]',
							'operator' => '===',
							'value'    => true,
						),
					),
				),

				/**
				 * Option: Blog Filter taxonomy background active color.
				 */
				array(
					'type'       => 'sub-control',
					'parent'     => ASTRA_THEME_SETTINGS . '[blog-filter-taxonomy-bg-colors]',
					'control'    => 'ast-responsive-color',
					'transport'  => 'postMessage',
					'section'    => 'ast-sub-section-post-filter',
					'name'       => 'blog-filter-taxonomy-bg-active-color',
					'default'    => astra_get_option( 'blog-filter-taxonomy-bg-active-color' ),
					'title'      => __( 'Active', 'astra-addon' ),
					'responsive' => false,
					'rgba'       => true,
					'priority'   => 163,
					'context'    => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[blog-filter]',
							'operator' => '===',
							'value'    => true,
						),
					),
				),

				/**
				 * Option: Blog Filter taxonomy text color group.
				 */
				array(
					'name'       => ASTRA_THEME_SETTINGS . '[blog-filter-taxonomy-text-colors]',
					'default'    => astra_get_option( 'blog-filter-taxonomy-text-colors' ),
					'type'       => 'control',
					'section'    => 'ast-sub-section-post-filter',
					'title'      => __( 'Text Color', 'astra-addon' ),
					'control'    => 'ast-color-group',
					'priority'   => 163,
					'responsive' => false,
					'context'    => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[blog-filter]',
							'operator' => '===',
							'value'    => true,
						),
					),
				),

				/**
				 * Option: Blog Filter taxonomy text normal color.
				 */
				array(
					'type'       => 'sub-control',
					'parent'     => ASTRA_THEME_SETTINGS . '[blog-filter-taxonomy-text-colors]',
					'control'    => 'ast-responsive-color',
					'transport'  => 'postMessage',
					'section'    => 'ast-sub-section-post-filter',
					'name'       => 'blog-filter-taxonomy-text-normal-color',
					'default'    => astra_get_option( 'blog-filter-taxonomy-text-normal-color' ),
					'title'      => __( 'Normal', 'astra-addon' ),
					'responsive' => false,
					'rgba'       => true,
					'priority'   => 163,
					'context'    => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[blog-filter]',
							'operator' => '===',
							'value'    => true,
						),
					),
				),

				/**
				 * Option: Blog Filter taxonomy text hover color.
				 */
				array(
					'type'       => 'sub-control',
					'parent'     => ASTRA_THEME_SETTINGS . '[blog-filter-taxonomy-text-colors]',
					'control'    => 'ast-responsive-color',
					'transport'  => 'postMessage',
					'section'    => 'ast-sub-section-post-filter',
					'name'       => 'blog-filter-taxonomy-text-hover-color',
					'default'    => astra_get_option( 'blog-filter-taxonomy-text-hover-color' ),
					'title'      => __( 'Hover', 'astra-addon' ),
					'responsive' => false,
					'rgba'       => true,
					'priority'   => 163,
					'context'    => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[blog-filter]',
							'operator' => '===',
							'value'    => true,
						),
					),
				),

				/**
				 * Option: Blog Filter taxonomy text active color.
				 */
				array(
					'type'       => 'sub-control',
					'parent'     => ASTRA_THEME_SETTINGS . '[blog-filter-taxonomy-text-colors]',
					'control'    => 'ast-responsive-color',
					'transport'  => 'postMessage',
					'section'    => 'ast-sub-section-post-filter',
					'name'       => 'blog-filter-taxonomy-text-active-color',
					'default'    => astra_get_option( 'blog-filter-taxonomy-text-active-color' ),
					'title'      => __( 'Active', 'astra-addon' ),
					'responsive' => false,
					'rgba'       => true,
					'priority'   => 163,
					'context'    => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[blog-filter]',
							'operator' => '===',
							'value'    => true,
						),
					),
				),

				/**
				 * Option: Blog Filter padding.
				 */
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[blog-filter-outer-parent-spacing]',
					'default'           => astra_get_option( 'blog-filter-outer-parent-spacing' ),
					'type'              => 'control',
					'control'           => 'ast-responsive-spacing',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_responsive_spacing' ),
					'transport'         => 'postMessage',
					'section'           => 'ast-sub-section-post-filter',
					'priority'          => 163,
					'title'             => __( 'Margin', 'astra-addon' ),
					'linked_choices'    => true,
					'context'           => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[blog-filter]',
							'operator' => '===',
							'value'    => true,
						),
					),
					'unit_choices'      => array( 'px', 'em', '%' ),
					'choices'           => array(
						'top'    => __( 'Top', 'astra-addon' ),
						'right'  => __( 'Right', 'astra-addon' ),
						'bottom' => __( 'Bottom', 'astra-addon' ),
						'left'   => __( 'Left', 'astra-addon' ),
					),
					'divider'           => array( 'ast_class' => 'ast-top-section-divider' ),
				),

				/**
				 * Option: Blog Filter Outside Spacing
				 */
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[blog-filter-outside-spacing]',
					'default'           => astra_get_option( 'blog-filter-outside-spacing' ),
					'type'              => 'control',
					'control'           => 'ast-responsive-spacing',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_responsive_spacing' ),
					'transport'         => 'postMessage',
					'section'           => 'ast-sub-section-post-filter',
					'priority'          => 163,
					'title'             => __( 'Outside', 'astra-addon' ),
					'linked_choices'    => true,
					'context'           => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[blog-filter]',
							'operator' => '===',
							'value'    => true,
						),
					),
					'unit_choices'      => array( 'px', 'em', '%' ),
					'choices'           => array(
						'top'    => __( 'Top', 'astra-addon' ),
						'right'  => __( 'Right', 'astra-addon' ),
						'bottom' => __( 'Bottom', 'astra-addon' ),
						'left'   => __( 'Left', 'astra-addon' ),
					),
					'divider'           => array( 'ast_class' => 'ast-bottom-section-divider ast-top-section-divider' ),
				),

				/**
				 * Option: Blog Filter Inside Spacing
				 */
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[blog-filter-inside-spacing]',
					'default'           => astra_get_option( 'blog-filter-inside-spacing' ),
					'type'              => 'control',
					'control'           => 'ast-responsive-spacing',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_responsive_spacing' ),
					'transport'         => 'postMessage',
					'section'           => 'ast-sub-section-post-filter',
					'priority'          => 163,
					'title'             => __( 'Inside', 'astra-addon' ),
					'linked_choices'    => true,
					'context'           => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[blog-filter]',
							'operator' => '===',
							'value'    => true,
						),
					),
					'unit_choices'      => array( 'px', 'em', '%' ),
					'choices'           => array(
						'top'    => __( 'Top', 'astra-addon' ),
						'right'  => __( 'Right', 'astra-addon' ),
						'bottom' => __( 'Bottom', 'astra-addon' ),
						'left'   => __( 'Left', 'astra-addon' ),
					),
					'divider'           => array( 'ast_class' => 'ast-bottom-spacing' ),
				),

				/**
				 * Option: Blog Filter Radius
				 */
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[blog-filter-border-radius]',
					'default'           => astra_get_option( 'blog-filter-border-radius' ),
					'type'              => 'control',
					'control'           => 'ast-responsive-spacing',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_responsive_spacing' ),
					'section'           => 'ast-sub-section-post-filter',
					'title'             => __( 'Border Radius', 'astra-addon' ),
					'linked_choices'    => true,
					'transport'         => 'postMessage',
					'unit_choices'      => array( 'px', 'em', '%' ),
					'choices'           => array(
						'top_left'     => __( 'Top', 'astra-addon' ),
						'top_right'    => __( 'Right', 'astra-addon' ),
						'bottom_right' => __( 'Bottom', 'astra-addon' ),
						'bottom_left'  => __( 'Left', 'astra-addon' ),
					),
					'context'           => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[blog-filter]',
							'operator' => '===',
							'value'    => true,
						),
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[blog-filter-layout]',
							'operator' => '===',
							'value'    => 'blog-filter-layout-2',
						),
					),
					'priority'          => 163,
					'connected'         => true,
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
new Astra_Customizer_Blog_Pro_Configs();
