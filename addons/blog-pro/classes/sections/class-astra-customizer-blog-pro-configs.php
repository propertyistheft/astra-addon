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
				 * Option: Divider
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[blog-divider]',
					'section'  => 'section-blog',
					'title'    => __( 'Blog Layout', 'astra-addon' ),
					'type'     => 'control',
					'control'  => 'ast-heading',
					'priority' => 5,
					'settings' => array(),
					'divider'  => array( 'ast_class' => 'ast-section-spacing ast-bottom-spacing' ),
				),

				/**
				 * Option: Blog Layout
				 */
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[blog-layout]',
					'type'              => 'control',
					'control'           => 'ast-radio-image',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_choices' ),
					'section'           => 'section-blog',
					'default'           => astra_get_option( 'blog-layout' ),
					'priority'          => 5,
					'title'             => __( 'Layout', 'astra-addon' ),
					'choices'           => array(
						'blog-layout-1' => array(
							'label' => __( 'Layout 1', 'astra-addon' ),
							'path'  => ( class_exists( 'Astra_Builder_UI_Controller' ) ) ? Astra_Builder_UI_Controller::fetch_svg_icon( 'blog-layout-1', false ) : '',
						),
						'blog-layout-2' => array(
							'label' => __( 'Layout 2', 'astra-addon' ),
							'path'  => ( class_exists( 'Astra_Builder_UI_Controller' ) ) ? Astra_Builder_UI_Controller::fetch_svg_icon( 'blog-layout-2', false ) : '',
						),
						'blog-layout-3' => array(
							'label' => __( 'Layout 3', 'astra-addon' ),
							'path'  => ( class_exists( 'Astra_Builder_UI_Controller' ) ) ? Astra_Builder_UI_Controller::fetch_svg_icon( 'blog-layout-3', false ) : '',
						),
					),
				),

				/**
				 * Option: Grid Layout
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[blog-grid]',
					'type'     => 'control',
					'control'  => 'ast-select',
					'section'  => 'section-blog',
					'default'  => astra_get_option( 'blog-grid' ),
					'priority' => 10,
					'title'    => __( 'Grid Layout', 'astra-addon' ),
					'choices'  => array(
						'1' => __( '1 Column', 'astra-addon' ),
						'2' => __( '2 Columns', 'astra-addon' ),
						'3' => __( '3 Columns', 'astra-addon' ),
						'4' => __( '4 Columns', 'astra-addon' ),
					),
					'context'  => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[blog-layout]',
							'operator' => '===',
							'value'    => 'blog-layout-1',
						),
					),
					'divider'  => array( 'ast_class' => 'ast-top-dotted-divider' ),
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
					'priority'  => 15,
				),

				/**
				 * Option: Masonry Effect
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[blog-masonry]',
					'default'  => astra_get_option( 'blog-masonry' ),
					'type'     => 'control',
					'control'  => Astra_Theme_Extension::$switch_control,
					'section'  => 'section-blog',
					'title'    => __( 'Masonry Layout', 'astra-addon' ),
					'priority' => 20,
					'context'  => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[blog-layout]',
							'operator' => '===',
							'value'    => 'blog-layout-1',
						),
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[blog-grid]',
							'operator' => '!=',
							'value'    => 1,
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
					'description' => __( 'This will not work if Masonry Layout is enabled.', 'astra-addon' ),
					'priority'    => 25,
					'context'     => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[blog-layout]',
							'operator' => '===',
							'value'    => 'blog-layout-1',
						),
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[blog-grid]',
							'operator' => '!=',
							'value'    => 1,
						),
					),
				),

				/**
				 * Option: Disable Date Box
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[blog-date-box]',
					'default'  => astra_get_option( 'blog-date-box' ),
					'type'     => 'control',
					'control'  => Astra_Theme_Extension::$switch_control,
					'section'  => 'section-blog',
					'title'    => __( 'Enable Date Box', 'astra-addon' ),
					'priority' => 30,
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
					),
					'responsive' => false,
					'renderAs'   => 'text',
					'divider'    => array( 'ast_class' => 'ast-top-dotted-divider' ),
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
					'title'       => __( 'Remove Featured Image Padding', 'astra-addon' ),
					'description' => __( 'This option will not work on full width layouts.', 'astra-addon' ),
					'priority'    => 40,
					'context'     => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[blog-layout]',
							'operator' => '===',
							'value'    => 'blog-layout-1',
						),
					),
				),

				/**
				 * Option: Excerpt Count
				 */
				array(
					'name'        => ASTRA_THEME_SETTINGS . '[blog-excerpt-count]',
					'default'     => astra_get_option( 'blog-excerpt-count' ),
					'type'        => 'control',
					'control'     => 'number',
					'section'     => 'section-blog',
					'priority'    => 80,
					'title'       => __( 'Excerpt Count', 'astra-addon' ),
					'input_attrs' => array(
						'min'  => 0,
						'step' => 1,
						'max'  => 3000,
					),
					'context'     => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[blog-post-content]',
							'operator' => '===',
							'value'    => 'excerpt',
						),
					),
					'divider'     => array( 'ast_class' => 'ast-top-dotted-divider' ),
				),

				/**
				 * Option: Read more text
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[blog-read-more-text]',
					'default'  => astra_get_option( 'blog-read-more-text' ),
					'type'     => 'control',
					'section'  => 'section-blog',
					'priority' => 85,
					'title'    => __( 'Read More Text', 'astra-addon' ),
					'control'  => 'text',
					'context'  => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[blog-post-content]',
							'operator' => '===',
							'value'    => 'excerpt',
						),
					),
				),

				/**
				 * Option: Display read more as button
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[blog-read-more-as-button]',
					'default'  => astra_get_option( 'blog-read-more-as-button' ),
					'type'     => 'control',
					'control'  => Astra_Theme_Extension::$switch_control,
					'section'  => 'section-blog',
					'title'    => __( 'Display Read More as Button', 'astra-addon' ),
					'priority' => 90,
					'divider'  => array( 'ast_class' => 'ast-bottom-section-divider' ),
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
					'divider'    => array( 'ast_class' => 'ast-bottom-dotted-divider ast-top-section-divider' ),
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
				 * Option: Post Filter Heading.
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[blog-filter-heading]',
					'section'  => 'section-blog',
					'title'    => __( 'Post Filter', 'astra-addon' ),
					'type'     => 'control',
					'control'  => 'ast-heading',
					'priority' => 115,
					'settings' => array(),
					'divider'  => array( 'ast_class' => 'ast-section-spacing ast-bottom-spacing' ),
				),

				/**
				 * Option: Blog Post Filter.
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[blog-filter]',
					'default'  => astra_get_option( 'blog-filter' ),
					'type'     => 'control',
					'control'  => Astra_Theme_Extension::$switch_control,
					'section'  => 'section-blog',
					'title'    => __( 'Post Filter', 'astra-addon' ),
					'priority' => 115,
				),

				/**
				 * Option: Blog Filter Style.
				 */
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[blog-filter-layout]',
					'type'              => 'control',
					'control'           => 'ast-radio-image',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_choices' ),
					'section'           => 'section-blog',
					'default'           => astra_get_option( 'blog-filter-layout' ),
					'priority'          => 115,
					'title'             => __( 'Style', 'astra-addon' ),
					'choices'           => array(
						'blog-filter-layout-1' => array(
							'label' => __( 'Style 1', 'astra-addon' ),
							'path'  => ( class_exists( 'Astra_Builder_UI_Controller' ) ) ? Astra_Builder_UI_Controller::fetch_svg_icon( 'blog-filter-layout-1', false ) : '',
						),
						'blog-filter-layout-2' => array(
							'label' => __( 'Style 2', 'astra-addon' ),
							'path'  => ( class_exists( 'Astra_Builder_UI_Controller' ) ) ? Astra_Builder_UI_Controller::fetch_svg_icon( 'blog-filter-layout-2', false ) : '',
						),
					),
					'divider'           => array( 'ast_class' => 'ast-top-section-divider' ),
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
					'section'    => 'section-blog',
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
					'section'   => 'section-blog',
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
					'section'   => 'section-blog',
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
					'section'   => 'section-blog',
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
					'section'   => 'section-blog',
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
				 * Option: Post Filter Heading for design tab.
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[blog-filter-design-heading]',
					'section'  => 'section-blog',
					'title'    => __( 'Post Filter', 'astra-addon' ),
					'type'     => 'control',
					'control'  => 'ast-heading',
					'priority' => 163,
					'settings' => array(),
					'context'  => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[blog-filter]',
							'operator' => '===',
							'value'    => true,
						),
					),
					'divider'  => array( 'ast_class' => 'ast-bottom-spacing' ),
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
					'section'   => 'section-blog',
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
					'divider'   => array( 'ast_class' => 'ast-bottom-section-divider' ),
				),

				/**
				 * Option: Blog Filter taxonomy Font Family
				 */
				array(
					'name'      => 'font-family-blog-filter-taxonomy',
					'parent'    => ASTRA_THEME_SETTINGS . '[blog-filter-taxonomy-typo]',
					'section'   => 'section-blog',
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
					'section'           => 'section-blog',
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
					'section'           => 'section-blog',
					'control'           => 'ast-responsive-slider',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_responsive_slider' ),
					'type'              => 'sub-control',
					'transport'         => 'postMessage',
					'title'             => __( 'Font Size', 'astra-addon' ),
					'priority'          => 163,
					'default'           => astra_get_option( 'font-size-blog-filter-taxonomy' ),
					'suffix'            => array( 'px', 'em', 'vw' ),
					'input_attrs'       => array(
						'px' => array(
							'min'  => 0,
							'step' => 1,
							'max'  => 200,
						),
						'em' => array(
							'min'  => 0,
							'step' => 0.01,
							'max'  => 20,
						),
						'vw' => array(
							'min'  => 0,
							'step' => 0.1,
							'max'  => 25,
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
					'section'  => 'section-blog',
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
				'section'    => 'section-blog',
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
					'section'    => 'section-blog',
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
					'section'    => 'section-blog',
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
					'section'    => 'section-blog',
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
					'section'    => 'section-blog',
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
					'section'    => 'section-blog',
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
					'section'    => 'section-blog',
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
					'section'    => 'section-blog',
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
					'section'           => 'section-blog',
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
					'section'           => 'section-blog',
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
					'section'           => 'section-blog',
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
					'section'           => 'section-blog',
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
