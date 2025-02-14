<?php
/**
 * Blog Pro Single General Options for our theme.
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
if ( ! class_exists( 'Astra_Customizer_Blog_Pro_Single_Configs' ) ) {

	/**
	 * Register General Customizer Configurations.
	 */
	// @codingStandardsIgnoreStart
	class Astra_Customizer_Blog_Pro_Single_Configs extends Astra_Customizer_Config_Base {
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
			$parent_section                = 'section-blog-single';
			$social_design_sharing_context = array(
				astra_addon_builder_helper()->design_tab_config,
				array(
					'relation' => 'OR',
					array(
						'setting'  => ASTRA_THEME_SETTINGS . '[single-post-social-sharing-icon-enable]',
						'operator' => '===',
						'value'    => true,
					),
					array(
						'setting'  => ASTRA_THEME_SETTINGS . '[ast-author-info]',
						'operator' => '===',
						'value'    => true,
					),
				),
			);

			$hide_social_share_icon_positions = Astra_Addon_Update_Filter_Function::astra_addon_hide_social_share_icon_position();

			$_configs = array(

				/**
				 * Option: Single Post Meta
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[blog-single-meta]',
					'type'     => 'control',
					'control'  => 'ast-sortable',
					'default'  => astra_get_option( 'blog-single-meta' ),
					'context'  => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[blog-single-post-structure]',
							'operator' => 'contains',
							'value'    => 'single-title-meta',
						),
					),
					'section'  => 'section-blog-single',
					'priority' => 5,
					'title'    => __( 'Meta', 'astra-addon' ),
					'choices'  => array(
						'comments'  => __( 'Comments', 'astra-addon' ),
						'category'  => __( 'Category', 'astra-addon' ),
						'author'    => __( 'Author', 'astra-addon' ),
						'date'      => __( 'Publish Date', 'astra-addon' ),
						'tag'       => __( 'Tag', 'astra-addon' ),
						'read-time' => __( 'Read Time', 'astra-addon' ),
					),
				),

				/**
				 * Option: Autoposts
				 */
				array(
					'name'        => ASTRA_THEME_SETTINGS . '[ast-auto-prev-post]',
					'default'     => astra_get_option( 'ast-auto-prev-post' ),
					'type'        => 'control',
					'section'     => 'section-blog-single',
					'title'       => __( 'Auto Load Previous Posts', 'astra-addon' ),
					'control'     => Astra_Theme_Extension::$switch_control,
					'description' => __( 'Auto load previous posts cannot be previewed in the customizer.', 'astra-addon' ),
					'divider'     => array( 'ast_class' => 'ast-top-dotted-divider' ),
					'priority'    => 9,
				),

				/**
				 * Option: Remove feature image padding
				 */
				array(
					'name'        => ASTRA_THEME_SETTINGS . '[single-featured-image-padding]',
					'default'     => astra_get_option( 'single-featured-image-padding' ),
					'type'        => 'control',
					'control'     => Astra_Theme_Extension::$switch_control,
					'section'     => 'section-blog-single',
					'title'       => __( 'Remove Image Padding', 'astra-addon' ),
					'description' => __( 'This option will not work on full width layouts.', 'astra-addon' ),
					'priority'    => 9,
					'divider'     => array( 'ast_class' => 'ast-top-dotted-divider' ),
					'context'     => array(
						astra_addon_builder_helper()->general_tab_config,
						'relation' => 'AND',
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[blog-layout]',
							'operator' => '===',
							'value'    => 'blog-layout-1',
						),
					),
				),
				/**
				 * Option: Disable Single Post Navigation
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[single-post-navigation-design-heading]',
					'section'  => 'section-blog-single',
					'title'    => __( 'Post Navigation', 'astra-addon' ),
					'type'     => 'control',
					'control'  => 'ast-heading',
					'divider'  => array( 'ast_class' => 'ast-section-spacing' ),
					'priority' => 9,
					'settings' => array(),
					'context'  => astra_addon_builder_helper()->general_tab,
				),
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[ast-single-post-navigation]',
					'default'  => astra_get_option( 'ast-single-post-navigation' ),
					'type'     => 'control',
					'section'  => 'section-blog-single',
					'title'    => __( 'Disable Navigation', 'astra-addon' ),
					'control'  => Astra_Theme_Extension::$switch_control,
					'divider'  => array( 'ast_class' => 'ast-section-spacing' ),
					'priority' => 9,
				),
				array(
					'name'       => ASTRA_THEME_SETTINGS . '[single-post-navigation-style]',
					'default'    => astra_get_option( 'single-post-navigation-style' ),
					'type'       => 'control',
					'section'    => 'section-blog-single',
					'title'      => __( 'Navigation Style', 'astra-addon' ),
					'control'    => Astra_Theme_Extension::$selector_control,
					'priority'   => 9,
					'choices'    => array(
						'default' => __( 'Default', 'astra-addon' ),
						'badge'   => __( 'Badge', 'astra-addon' ),
					),
					'divider'    => array( 'ast_class' => 'ast-top-dotted-divider' ),
					'context'    => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[ast-single-post-navigation]',
							'operator' => '===',
							'value'    => false,
						),
					),
					'responsive' => false,
					'renderAs'   => 'text',
				),

				/**
				 * Option: Author InfoBox
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[single-post-author-box-heading]',
					'section'  => 'section-blog-single',
					'title'    => __( 'Author Box', 'astra-addon' ),
					'type'     => 'control',
					'control'  => 'ast-heading',
					'divider'  => array( 'ast_class' => 'ast-section-spacing' ),
					'priority' => 9,
					'settings' => array(),
				),
				array(
					'name'        => 'author-box-section-ast-context-tabs',
					'section'     => 'ast-sub-section-author-box',
					'type'        => 'control',
					'control'     => 'ast-builder-header-control',
					'priority'    => 0,
					'description' => '',
					'context'     => array(),
				),
				array(
					'name'     => 'ast-sub-section-author-box',
					'title'    => __( 'Author Box', 'astra-addon' ),
					'type'     => 'section',
					'section'  => $parent_section,
					'panel'    => '',
					'priority' => 1,
				),
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[ast-author-info]',
					'type'     => 'control',
					'default'  => astra_get_option( 'ast-author-info' ),
					'control'  => 'ast-section-toggle',
					'section'  => $parent_section,
					'priority' => 9,
					'linked'   => 'ast-sub-section-author-box',
					'linkText' => __( 'Author Info', 'astra-addon' ),
					'divider'  => array( 'ast_class' => 'ast-bottom-divider ast-bottom-section-divider' ),
				),
				array(
					'name'        => ASTRA_THEME_SETTINGS . '[author-box-placement]',
					'default'     => astra_get_option( 'author-box-placement' ),
					'type'        => 'control',
					'section'     => 'ast-sub-section-author-box',
					'title'       => __( 'Section Placement', 'astra-addon' ),
					'control'     => Astra_Theme_Extension::$selector_control,
					'priority'    => 9,
					'description' => __( 'Decide whether to isolate or integrate the module with the entry content area.', 'astra-addon' ),
					'choices'     => array(
						'inside'  => __( 'Contained', 'astra-addon' ),
						'outside' => __( 'Separated', 'astra-addon' ),
					),
					'context'     => astra_addon_builder_helper()->general_tab,
					'divider'     => array( 'ast_class' => 'ast-section-spacing' ),
					'responsive'  => false,
					'renderAs'    => 'text',
				),
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[author-box-in-new-tab]',
					'default'  => astra_get_option( 'author-box-in-new-tab' ),
					'type'     => 'control',
					'section'  => 'ast-sub-section-author-box',
					'title'    => __( 'Open Link in New Tab', 'astra-addon' ),
					'control'  => Astra_Theme_Extension::$switch_control,
					'context'  => astra_addon_builder_helper()->general_tab,
					'priority' => 9,
					'divider'  => array( 'ast_class' => 'ast-top-dotted-divider' ),
				),
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[author-box-socials]',
					'default'  => astra_get_option( 'author-box-socials' ),
					'type'     => 'control',
					'section'  => 'ast-sub-section-author-box',
					'title'    => __( 'Social Icons', 'astra-addon' ),
					'control'  => Astra_Theme_Extension::$switch_control,
					'context'  => astra_addon_builder_helper()->general_tab,
					'priority' => 9,
					'divider'  => array( 'ast_class' => 'ast-top-dotted-divider' ),
				),
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[author-box-social-icon-list]',
					'section'  => 'ast-sub-section-author-box',
					'type'     => 'control',
					'control'  => 'ast-social-icons',
					'title'    => __( 'Social Icons', 'astra-addon' ),
					'priority' => 9,
					'default'  => astra_get_option( 'author-box-social-icon-list' ),
					'context'  => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[author-box-socials]',
							'operator' => '===',
							'value'    => true,
						),
					),
				),
				array(
					'name'       => ASTRA_THEME_SETTINGS . '[author-box-alignment]',
					'default'    => astra_get_option( 'author-box-alignment' ),
					'type'       => 'control',
					'section'    => 'ast-sub-section-author-box',
					'title'      => __( 'Overall Alignment', 'astra-addon' ),
					'control'    => Astra_Theme_Extension::$selector_control,
					'priority'   => 9,
					'choices'    => array(
						'left'   => __( 'Left', 'astra-addon' ),
						'center' => __( 'Center', 'astra-addon' ),
					),
					'divider'    => array( 'ast_class' => 'ast-top-dotted-divider' ),
					'context'    => astra_addon_builder_helper()->general_tab,
					'responsive' => false,
					'renderAs'   => 'text',
				),

				/**
				 * Option: Social Sharing
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[single-post-social-sharing-heading]',
					'section'  => 'section-blog-single',
					'title'    => __( 'Social Sharing', 'astra-addon' ),
					'type'     => 'control',
					'control'  => 'ast-heading',
					'priority' => 9,
					'settings' => array(),
				),
				array(
					'name'     => 'ast-sub-section-post-social-sharing',
					'title'    => __( 'Social Sharing', 'astra-addon' ),
					'type'     => 'section',
					'section'  => $parent_section,
					'panel'    => '',
					'priority' => 1,
				),
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[single-post-social-sharing-icon-enable]',
					'type'     => 'control',
					'default'  => astra_get_option( 'single-post-social-sharing-icon-enable' ),
					'control'  => 'ast-section-toggle',
					'section'  => $parent_section,
					'priority' => 9,
					'linked'   => 'ast-sub-section-post-social-sharing',
					'linkText' => __( 'Social Sharing', 'astra-addon' ),
					'divider'  => array( 'ast_class' => 'ast-bottom-divider ast-bottom-section-divider' ),
				),

				/**
				 * Option: Social sharing label position
				 */
				array(
					'name'       => ASTRA_THEME_SETTINGS . '[single-post-social-sharing-alignment]',
					'default'    => astra_get_option( 'single-post-social-sharing-alignment' ),
					'type'       => 'control',
					'priority'   => 9,
					'control'    => 'ast-selector',
					'section'    => 'ast-sub-section-post-social-sharing',
					'title'      => __( 'Alignment', 'astra-addon' ),
					'choices'    => array(
						'left'   => __( 'Left', 'astra-addon' ),
						'center' => __( 'Center', 'astra-addon' ),
						'right'  => __( 'Right', 'astra-addon' ),
					),
					'renderAs'   => 'text',
					'responsive' => false,
					'transport'  => 'postMessage',
					'context'    => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[single-post-social-sharing-icon-enable]',
							'operator' => '==',
							'value'    => true,
						),
					),
					'divider'    => array( 'ast_class' => 'ast-section-spacing' ),
				),

				/**
				 * Option: Enable Social Sharing Heading.
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[single-post-social-sharing-heading-enable]',
					'default'  => astra_get_option( 'single-post-social-sharing-heading-enable' ),
					'type'     => 'control',
					'control'  => Astra_Theme_Extension::$switch_control,
					'section'  => 'ast-sub-section-post-social-sharing',
					'title'    => __( 'Enable Heading', 'astra-addon' ),
					'priority' => 9,
					'divider'  => array( 'ast_class' => 'ast-section-spacing' ),
					'context'  => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[single-post-social-sharing-icon-enable]',
							'operator' => '==',
							'value'    => true,
						),
					),
					'divider'  => array( 'ast_class' => 'ast-bottom-dotted-divider ast-top-dotted-divider' ),
				),

				/**
				 * Option: Social Sharing Heading text.
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[single-post-social-sharing-heading-text]',
					'default'   => astra_get_option( 'single-post-social-sharing-heading-text' ),
					'type'      => 'control',
					'section'   => 'ast-sub-section-post-social-sharing',
					'priority'  => 9,
					'title'     => __( 'Heading text', 'astra-addon' ),
					'control'   => 'text',
					'transport' => 'postMessage',
					'context'   => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[single-post-social-sharing-heading-enable]',
							'operator' => '==',
							'value'    => true,
						),
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[single-post-social-sharing-icon-enable]',
							'operator' => '==',
							'value'    => true,
						),
					),
				),

				/**
				 * Option: Social sharing label position.
				 */
				array(
					'name'       => ASTRA_THEME_SETTINGS . '[single-post-social-sharing-heading-position]',
					'default'    => astra_get_option( 'single-post-social-sharing-heading-position' ),
					'type'       => 'control',
					'priority'   => 9,
					'control'    => 'ast-selector',
					'section'    => 'ast-sub-section-post-social-sharing',
					'title'      => __( 'Heading Position', 'astra-addon' ),
					'choices'    => array(
						'above' => __( 'Above', 'astra-addon' ),
						'below' => __( 'Below', 'astra-addon' ),
					),
					'renderAs'   => 'text',
					'responsive' => false,
					'context'    => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[single-post-social-sharing-heading-enable]',
							'operator' => '==',
							'value'    => true,
						),
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[single-post-social-sharing-icon-enable]',
							'operator' => '==',
							'value'    => true,
						),
					),
					'divider'    => array( 'ast_class' => 'ast-top-dotted-divider ast-bottom-dotted-divider' ),

				),

				/**
				 * Option: Social Icons.
				 */
				array(
					'name'       => ASTRA_THEME_SETTINGS . '[single-post-social-sharing-icon-list]',
					'section'    => 'ast-sub-section-post-social-sharing',
					'type'       => 'control',
					'control'    => 'ast-social-icons',
					'title'      => __( 'Social Icons', 'astra-addon' ),
					'priority'   => 9,
					'share_mode' => true,
					'default'    => astra_get_option( 'single-post-social-sharing-icon-list' ),
					'context'    => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[single-post-social-sharing-icon-enable]',
							'operator' => '==',
							'value'    => true,
						),
					),
					'divider'    => array( 'ast_class' => 'ast-bottom-dotted-divider' ),
				),

				/**
				 * Option: Enable / Disable social sharing icon labels
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[single-post-social-sharing-icon-label]',
					'default'  => astra_get_option( 'single-post-social-sharing-icon-label' ),
					'type'     => 'control',
					'control'  => Astra_Theme_Extension::$switch_control,
					'section'  => 'ast-sub-section-post-social-sharing',
					'title'    => __( 'Enable Label', 'astra-addon' ),
					'priority' => 9,
					'context'  => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[single-post-social-sharing-icon-enable]',
							'operator' => '==',
							'value'    => true,
						),
					),
				),

				/**
				 * Option: Social sharing label position
				 */
				array(
					'name'       => ASTRA_THEME_SETTINGS . '[single-post-social-sharing-icon-label-position]',
					'default'    => astra_get_option( 'single-post-social-sharing-icon-label-position' ),
					'type'       => 'control',
					'priority'   => 9,
					'control'    => 'ast-selector',
					'section'    => 'ast-sub-section-post-social-sharing',
					'title'      => __( 'Label Position', 'astra-addon' ),
					'choices'    => array(
						'above' => __( 'Above', 'astra-addon' ),
						'below' => __( 'Below', 'astra-addon' ),
					),
					'renderAs'   => 'text',
					'responsive' => false,
					'context'    => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[single-post-social-sharing-icon-label]',
							'operator' => '==',
							'value'    => true,
						),
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[single-post-social-sharing-icon-enable]',
							'operator' => '==',
							'value'    => true,
						),
					),
					'divider'    => array( 'ast_class' => 'ast-top-dotted-divider' ),

				),

				/**
				 * Option: Social sharing position
				 */
				array(
					'name'        => ASTRA_THEME_SETTINGS . '[single-post-social-sharing-icon-position]',
					'default'     => astra_get_option( 'single-post-social-sharing-icon-position' ),
					'type'        => 'control',
					'section'     => 'ast-sub-section-post-social-sharing',
					'title'       => __( 'Icon Position', 'astra-addon' ),
					'description' => $hide_social_share_icon_positions ? esc_html__( 'Left and Right Sticky Social Share options are for desktop use only to prevent floating UI issues on responsive devices.', 'astra-addon' ) : '',
					'control'     => 'ast-select',
					'priority'    => 9,
					'choices'     => array(
						'below-post-title' => __( 'Below Post Title', 'astra-addon' ),
						'below-post'       => __( 'Below Post', 'astra-addon' ),
						'left-content'     => __( 'Left Content', 'astra-addon' ),
						'right-content'    => __( 'Right Content', 'astra-addon' ),
					),
					'divider'     => array( 'ast_class' => 'ast-top-dotted-divider ast-bottom-section-divider icon-divider' ),
					'context'     => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[single-post-social-sharing-icon-enable]',
							'operator' => '==',
							'value'    => true,
						),
					),
				),

				array(
					'name'     => ASTRA_THEME_SETTINGS . '[social-sharing-extra-settings-notice]',
					'type'     => 'control',
					'control'  => 'ast-description',
					'section'  => 'ast-sub-section-post-social-sharing',
					'priority' => 500,
					'label'    => '',
					'help'     => __( 'Note: Explore social icons design settings by navigating to the Design tab within the parent Single Post section.', 'astra-addon' ),
					'context'  => astra_addon_builder_helper()->general_tab,
				),

				/**
				 * Option: Divider
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[single-post-social-sharing-icon-divider]',
					'section'  => 'section-blog-single',
					'title'    => __( 'Social Sharing', 'astra-addon' ),
					'type'     => 'control',
					'control'  => 'ast-heading',
					'priority' => 1,
					'context'  => $social_design_sharing_context,
				),

				array(
					'name'     => ASTRA_THEME_SETTINGS . '[single-social-sharing-description]',
					'type'     => 'control',
					'control'  => 'ast-description',
					'section'  => 'section-blog-single',
					'priority' => 1,
					'label'    => '',
					'context'  => $social_design_sharing_context,
					'help'     => __( 'These design choices are applicable to both the Author Box and post Social Sharing elements.', 'astra-addon' ),
					'settings' => array(),
				),

				/**
				 * Option: Social sharing icon type.
				 */
				array(
					'name'       => ASTRA_THEME_SETTINGS . '[single-post-social-sharing-icon-color-type]',
					'default'    => astra_get_option( 'single-post-social-sharing-icon-color-type' ),
					'section'    => 'section-blog-single',
					'type'       => 'control',
					'control'    => 'ast-selector',
					'title'      => __( 'Color Type', 'astra-addon' ),
					'priority'   => 1,
					'choices'    => array(
						'custom'   => __( 'Custom', 'astra-addon' ),
						'official' => __( 'Official', 'astra-addon' ),
					),
					'context'    => $social_design_sharing_context,
					'responsive' => false,
					'renderAs'   => 'text',
					'divider'    => array( 'ast_class' => 'ast-bottom-dotted-divider ast-top-dotted-divider' ),
				),

				/**
				 * Group: Primary Social Colors Group
				 */
				array(
					'name'       => ASTRA_THEME_SETTINGS . '[single-post-social-sharing-icon-color-group]',
					'default'    => astra_get_option( 'single-post-social-sharing-icon-color-group' ),
					'type'       => 'control',
					'control'    => 'ast-color-group',
					'title'      => __( 'Icon Color', 'astra-addon' ),
					'section'    => 'section-blog-single',
					'transport'  => 'postMessage',
					'priority'   => 1,
					'context'    => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[single-post-social-sharing-icon-color-type]',
							'operator' => '==',
							'value'    => 'custom',
						),
					),
					'responsive' => true,
				),

				array(
					'name'       => ASTRA_THEME_SETTINGS . '[single-post-social-sharing-icon-background-color-group]',
					'default'    => astra_get_option( 'single-post-social-sharing-icon-background-color-group' ),
					'type'       => 'control',
					'control'    => 'ast-color-group',
					'title'      => __( 'Icon Background', 'astra-addon' ),
					'section'    => 'section-blog-single',
					'transport'  => 'postMessage',
					'priority'   => 1,
					'context'    => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[single-post-social-sharing-icon-color-type]',
							'operator' => '==',
							'value'    => 'custom',
						),
					),
					'responsive' => true,
				),

				/**
				 * Option: Social Text Color
				 */
				array(
					'name'       => 'single-post-social-sharing-icon-color',
					'transport'  => 'postMessage',
					'default'    => astra_get_option( 'single-post-social-sharing-icon-color' ),
					'type'       => 'sub-control',
					'parent'     => ASTRA_THEME_SETTINGS . '[single-post-social-sharing-icon-color-group]',
					'section'    => 'section-blog-single',
					'tab'        => __( 'Normal', 'astra-addon' ),
					'control'    => 'ast-responsive-color',
					'responsive' => true,
					'rgba'       => true,
					'priority'   => 1,
					'context'    => $social_design_sharing_context,
					'title'      => __( 'Normal', 'astra-addon' ),
				),

				/**
				 * Option: Social Text Hover Color
				 */
				array(
					'name'       => 'single-post-social-sharing-icon-h-color',
					'default'    => astra_get_option( 'single-post-social-sharing-icon-h-color' ),
					'transport'  => 'postMessage',
					'type'       => 'sub-control',
					'parent'     => ASTRA_THEME_SETTINGS . '[single-post-social-sharing-icon-color-group]',
					'section'    => 'section-blog-single',
					'tab'        => __( 'Hover', 'astra-addon' ),
					'control'    => 'ast-responsive-color',
					'responsive' => true,
					'rgba'       => true,
					'priority'   => 1,
					'context'    => $social_design_sharing_context,
					'title'      => __( 'Hover', 'astra-addon' ),
				),

				/**
				 * Option: Social Background Color
				 */
				array(
					'name'       => 'single-post-social-sharing-icon-background-color',
					'default'    => astra_get_option( 'single-post-social-sharing-icon-background-color' ),
					'transport'  => 'postMessage',
					'type'       => 'sub-control',
					'parent'     => ASTRA_THEME_SETTINGS . '[single-post-social-sharing-icon-background-color-group]',
					'section'    => 'section-blog-single',
					'tab'        => __( 'Normal', 'astra-addon' ),
					'control'    => 'ast-responsive-color',
					'responsive' => true,
					'rgba'       => true,
					'priority'   => 1,
					'context'    => $social_design_sharing_context,
					'title'      => __( 'Normal', 'astra-addon' ),
				),

				/**
				 * Option: Social Background Hover Color
				 */
				array(
					'name'       => 'single-post-social-sharing-icon-background-h-color',
					'default'    => astra_get_option( 'single-post-social-sharing-icon-background-h-color' ),
					'transport'  => 'postMessage',
					'type'       => 'sub-control',
					'parent'     => ASTRA_THEME_SETTINGS . '[single-post-social-sharing-icon-background-color-group]',
					'section'    => 'section-blog-single',
					'tab'        => __( 'Hover', 'astra-addon' ),
					'control'    => 'ast-responsive-color',
					'responsive' => true,
					'rgba'       => true,
					'priority'   => 1,
					'context'    => $social_design_sharing_context,
					'title'      => __( 'Hover', 'astra-addon' ),
				),

				/**
				 * Option: Social Label Color
				 */
				array(
					'name'       => ASTRA_THEME_SETTINGS . '[single-post-social-sharing-icon-label-color-group]',
					'default'    => astra_get_option( 'single-post-social-sharing-icon-label-color-group' ),
					'type'       => 'control',
					'control'    => 'ast-color-group',
					'title'      => __( 'Label Color', 'astra-addon' ),
					'section'    => 'section-blog-single',
					'transport'  => 'postMessage',
					'priority'   => 1,
					'context'    => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[single-post-social-sharing-icon-enable]',
							'operator' => '==',
							'value'    => true,
						),
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[single-post-social-sharing-icon-label]',
							'operator' => '==',
							'value'    => true,
						),
					),
					'responsive' => true,
				),

				/**
				 * Option: Social Label Normal Color
				 */
				array(
					'name'       => 'single-post-social-sharing-icon-label-color',
					'default'    => astra_get_option( 'single-post-social-sharing-icon-label-color' ),
					'transport'  => 'postMessage',
					'type'       => 'sub-control',
					'parent'     => ASTRA_THEME_SETTINGS . '[single-post-social-sharing-icon-label-color-group]',
					'section'    => 'section-blog-single',
					'tab'        => __( 'Normal', 'astra-addon' ),
					'control'    => 'ast-responsive-color',
					'responsive' => true,
					'rgba'       => true,
					'priority'   => 1,
					'context'    => $social_design_sharing_context,
					'title'      => __( 'Normal', 'astra-addon' ),
				),

				/**
				 * Option: Social Label Hover Color
				 */
				array(
					'name'       => 'single-post-social-sharing-icon-label-h-color',
					'default'    => astra_get_option( 'single-post-social-sharing-icon-label-h-color' ),
					'transport'  => 'postMessage',
					'type'       => 'sub-control',
					'parent'     => ASTRA_THEME_SETTINGS . '[single-post-social-sharing-icon-label-color-group]',
					'section'    => 'section-blog-single',
					'tab'        => __( 'Hover', 'astra-addon' ),
					'control'    => 'ast-responsive-color',
					'responsive' => true,
					'rgba'       => true,
					'priority'   => 1,
					'context'    => $social_design_sharing_context,
					'title'      => __( 'Hover', 'astra-addon' ),
				),

				/**
				 * Option: Social Heading Color
				 */
				array(
					'name'       => ASTRA_THEME_SETTINGS . '[single-post-social-sharing-heading-color-group]',
					'default'    => astra_get_option( 'single-post-social-sharing-heading-color-group' ),
					'type'       => 'control',
					'control'    => 'ast-color-group',
					'title'      => __( 'Heading Color', 'astra-addon' ),
					'section'    => 'section-blog-single',
					'transport'  => 'postMessage',
					'priority'   => 1,
					'context'    => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[single-post-social-sharing-icon-enable]',
							'operator' => '==',
							'value'    => true,
						),
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[single-post-social-sharing-heading-enable]',
							'operator' => '==',
							'value'    => true,
						),
					),
					'responsive' => true,
				),

				/**
				 * Option: Social Heading Normal Color
				 */
				array(
					'name'       => 'single-post-social-sharing-heading-color',
					'default'    => astra_get_option( 'single-post-social-sharing-heading-color' ),
					'transport'  => 'postMessage',
					'type'       => 'sub-control',
					'parent'     => ASTRA_THEME_SETTINGS . '[single-post-social-sharing-heading-color-group]',
					'section'    => 'section-blog-single',
					'tab'        => __( 'Normal', 'astra-addon' ),
					'control'    => 'ast-responsive-color',
					'responsive' => true,
					'rgba'       => true,
					'priority'   => 1,
					'context'    => $social_design_sharing_context,
					'title'      => __( 'Normal', 'astra-addon' ),
				),

				/**
				 * Option: Social Heading Hover Color
				 */
				array(
					'name'       => 'single-post-social-sharing-heading-h-color',
					'default'    => astra_get_option( 'single-post-social-sharing-heading-h-color' ),
					'transport'  => 'postMessage',
					'type'       => 'sub-control',
					'parent'     => ASTRA_THEME_SETTINGS . '[single-post-social-sharing-heading-color-group]',
					'section'    => 'section-blog-single',
					'tab'        => __( 'Hover', 'astra-addon' ),
					'control'    => 'ast-responsive-color',
					'responsive' => true,
					'rgba'       => true,
					'priority'   => 1,
					'context'    => $social_design_sharing_context,
					'title'      => __( 'Hover', 'astra-addon' ),
				),

				/**
				 * Background color.
				 */
				array(
					'name'       => ASTRA_THEME_SETTINGS . '[single-post-social-sharing-background-color]',
					'default'    => astra_get_option( 'single-post-social-sharing-background-color' ),
					'transport'  => 'postMessage',
					'type'       => 'control',
					'section'    => 'section-blog-single',
					'control'    => 'ast-responsive-color',
					'responsive' => true,
					'rgba'       => true,
					'priority'   => 1,
					'title'      => __( 'Background Color', 'astra-addon' ),
					'context'    => $social_design_sharing_context,
					'divider'    => array( 'ast_class' => 'ast-bottom-section-divider' ),
				),

				/**
				 * Option: Social Icon Size
				 */
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[single-post-social-sharing-icon-size]',
					'section'           => 'section-blog-single',
					'priority'          => 1,
					'transport'         => 'postMessage',
					'default'           => astra_get_option( 'single-post-social-sharing-icon-size' ),
					'title'             => __( 'Icon Size', 'astra-addon' ),
					'suffix'            => 'px',
					'type'              => 'control',
					'control'           => 'ast-responsive-slider',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_responsive_slider' ),
					'input_attrs'       => array(
						'min'  => 0,
						'step' => 1,
						'max'  => 50,
					),
					'divider'           => array( 'ast_class' => 'ast-bottom-dotted-divider' ),
					'context'           => $social_design_sharing_context,
				),

				/**
				 * Option: Social Icon Spacing
				 */
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[single-post-social-sharing-icon-spacing]',
					'section'           => 'section-blog-single',
					'priority'          => 2,
					'transport'         => 'postMessage',
					'default'           => astra_get_option( 'single-post-social-sharing-icon-spacing' ),
					'title'             => __( 'Icon Spacing', 'astra-addon' ),
					'suffix'            => 'px',
					'type'              => 'control',
					'control'           => 'ast-responsive-slider',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_responsive_slider' ),
					'input_attrs'       => array(
						'min'  => 0,
						'step' => 1,
						'max'  => 50,
					),
					'divider'           => array( 'ast_class' => 'ast-bottom-dotted-divider' ),
					'context'           => $social_design_sharing_context,
				),

				/**
				 * Option: Social Icon Background Spacing.
				 */
				array(
					'name'        => ASTRA_THEME_SETTINGS . '[single-post-social-sharing-icon-background-spacing]',
					'section'     => 'section-blog-single',
					'priority'    => 2,
					'transport'   => 'postMessage',
					'default'     => astra_get_option( 'single-post-social-sharing-icon-background-spacing' ),
					'title'       => __( 'Icon Background Space', 'astra-addon' ),
					'suffix'      => 'px',
					'type'        => 'control',
					'control'     => 'ast-responsive-slider',
					'input_attrs' => array(
						'min'  => 0,
						'step' => 1,
						'max'  => 50,
					),
					'context'     => $social_design_sharing_context,
				),

				/**
				 * Option: Social Icon Radius
				 */
				array(
					'name'        => ASTRA_THEME_SETTINGS . '[single-post-social-sharing-icon-radius]',
					'section'     => 'section-blog-single',
					'priority'    => 4,
					'transport'   => 'postMessage',
					'default'     => astra_get_option( 'single-post-social-sharing-icon-radius' ),
					'title'       => __( 'Icon Radius', 'astra-addon' ),
					'suffix'      => 'px',
					'type'        => 'control',
					'control'     => 'ast-responsive-slider',
					'divider'     => array( 'ast_class' => 'ast-top-dotted-divider' ),
					'input_attrs' => array(
						'min'  => 0,
						'step' => 1,
						'max'  => 50,
					),
					'context'     => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[single-post-social-sharing-icon-color-type]',
							'operator' => '==',
							'value'    => 'custom',
						),
					),
				),

				/**
				 * Option:  Social Heading typography section.
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[single-post-social-sharing-heading-typo]',
					'default'   => astra_get_option( 'single-post-social-sharing-heading-typo' ),
					'type'      => 'control',
					'control'   => 'ast-settings-group',
					'title'     => __( 'Heading Font', 'astra-addon' ),
					'section'   => 'section-blog-single',
					'transport' => 'postMessage',
					'priority'  => 4,
					'context'   => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[single-post-social-sharing-icon-enable]',
							'operator' => '==',
							'value'    => true,
						),
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[single-post-social-sharing-heading-enable]',
							'operator' => '==',
							'value'    => true,
						),
					),
					'divider'   => array( 'ast_class' => 'ast-top-section-divider' ),
				),

				/**
				 * Option: Social Heading Font Family
				 */
				array(
					'name'      => 'single-post-social-sharing-heading-font-family',
					'type'      => 'sub-control',
					'control'   => 'ast-font',
					'parent'    => ASTRA_THEME_SETTINGS . '[single-post-social-sharing-heading-typo]',
					'font_type' => 'ast-font-family',
					'title'     => __( 'Font Family', 'astra-addon' ),
					'default'   => astra_get_option( 'single-post-social-sharing-heading-font-family' ),
					'section'   => 'section-blog-single',
					'connect'   => 'single-post-social-sharing-heading-font-weight',
					'priority'  => 4,
					'transport' => 'postMessage',
					'divider'   => array( 'ast_class' => 'ast-sub-bottom-dotted-divider' ),
				),

				/**
				 * Option: Social Heading font-weight
				 */
				array(
					'name'              => 'single-post-social-sharing-heading-font-weight',
					'parent'            => ASTRA_THEME_SETTINGS . '[single-post-social-sharing-heading-typo]',
					'type'              => 'sub-control',
					'control'           => 'ast-font',
					'font_type'         => 'ast-font-weight',
					'title'             => __( 'Font Weight', 'astra-addon' ),
					'section'           => 'section-blog-single',
					'default'           => astra_get_option( 'single-post-social-sharing-heading-font-weight' ),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_font_weight' ),
					'priority'          => 4,
					'connect'           => 'single-post-social-sharing-heading-font-family',
					'transport'         => 'postMessage',
					'divider'           => array( 'ast_class' => 'ast-sub-bottom-dotted-divider' ),
				),

				/**
				 * Option: Social Heading font-size
				 */
				array(
					'name'              => 'single-post-social-sharing-heading-font-size',
					'parent'            => ASTRA_THEME_SETTINGS . '[single-post-social-sharing-heading-typo]',
					'type'              => 'sub-control',
					'control'           => 'ast-responsive-slider',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_responsive_slider' ),
					'section'           => 'section-blog-single',
					'default'           => astra_get_option( 'single-post-social-sharing-heading-font-size' ),
					'transport'         => 'postMessage',
					'priority'          => 4,
					'title'             => __( 'Font Size', 'astra-addon' ),
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
				 * Option: Social Heading font extras.
				 */
				array(
					'name'     => 'single-post-social-sharing-heading-font-extras',
					'type'     => 'sub-control',
					'parent'   => ASTRA_THEME_SETTINGS . '[single-post-social-sharing-heading-typo]',
					'control'  => 'ast-font-extras',
					'section'  => 'section-blog-single',
					'priority' => 4,
					'default'  => astra_get_option( 'single-post-social-sharing-heading-font-extras' ),
				),

				/**
				 * Option:  Social icon label typography section.
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[single-post-social-sharing-icon-label-typo]',
					'default'   => astra_get_option( 'single-post-social-sharing-icon-label-typo' ),
					'type'      => 'control',
					'control'   => 'ast-settings-group',
					'title'     => __( 'Label Font', 'astra-addon' ),
					'section'   => 'section-blog-single',
					'transport' => 'postMessage',
					'priority'  => 4,
					'context'   => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[single-post-social-sharing-icon-enable]',
							'operator' => '==',
							'value'    => true,
						),
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[single-post-social-sharing-icon-label]',
							'operator' => '==',
							'value'    => true,
						),
					),
					'divider'   => array( 'ast_class' => 'ast-top-section-divider' ),
				),

				/**
				 * Option: Social icon label font family
				 */
				array(
					'name'      => 'single-post-social-sharing-icon-label-font-family',
					'type'      => 'sub-control',
					'control'   => 'ast-font',
					'parent'    => ASTRA_THEME_SETTINGS . '[single-post-social-sharing-icon-label-typo]',
					'font_type' => 'ast-font-family',
					'title'     => __( 'Font Family', 'astra-addon' ),
					'default'   => astra_get_option( 'single-post-social-sharing-icon-label-font-family' ),
					'section'   => 'section-blog-single',
					'priority'  => 4,
					'connect'   => ASTRA_THEME_SETTINGS . '[single-post-social-sharing-icon-label-font-weight]',
					'transport' => 'postMessage',
					'divider'   => array( 'ast_class' => 'ast-sub-bottom-dotted-divider' ),
				),

				/**
				 * Option: Social icon label font-weight
				 */
				array(
					'name'              => 'single-post-social-sharing-icon-label-font-weight',
					'parent'            => ASTRA_THEME_SETTINGS . '[single-post-social-sharing-icon-label-typo]',
					'type'              => 'sub-control',
					'control'           => 'ast-font',
					'font_type'         => 'ast-font-weight',
					'title'             => __( 'Font Weight', 'astra-addon' ),
					'section'           => 'section-blog-single',
					'default'           => astra_get_option( 'single-post-social-sharing-icon-label-font-weight' ),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_font_weight' ),
					'priority'          => 4,
					'connect'           => 'single-post-social-sharing-icon-label-font-family',
					'transport'         => 'postMessage',
					'divider'           => array( 'ast_class' => 'ast-sub-bottom-dotted-divider' ),
				),

				/**
				 * Option: Social icon font size.
				 */

				array(
					'name'              => 'single-post-social-sharing-icon-label-font-size',
					'parent'            => ASTRA_THEME_SETTINGS . '[single-post-social-sharing-icon-label-typo]',
					'type'              => 'sub-control',
					'control'           => 'ast-responsive-slider',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_responsive_slider' ),
					'section'           => 'section-blog-single',
					'default'           => astra_get_option( 'single-post-social-sharing-icon-label-font-size' ),
					'transport'         => 'postMessage',
					'priority'          => 4,
					'title'             => __( 'Font Size', 'astra-addon' ),
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
				 * Option: Social icon label label font extras
				 */
				array(
					'name'     => 'single-post-social-sharing-icon-label-font-extras',
					'type'     => 'sub-control',
					'parent'   => ASTRA_THEME_SETTINGS . '[single-post-social-sharing-icon-label-typo]',
					'control'  => 'ast-font-extras',
					'section'  => 'section-blog-single',
					'priority' => 4,
					'default'  => astra_get_option( 'single-post-social-sharing-icon-label-font-extras' ),
				),

				/**
				 * Option: Padding Space
				 */
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[single-post-social-sharing-padding]',
					'default'           => astra_get_option( 'single-post-social-sharing-padding' ),
					'type'              => 'control',
					'transport'         => 'postMessage',
					'control'           => 'ast-responsive-spacing',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_responsive_spacing' ),
					'section'           => 'section-blog-single',
					'priority'          => 4,
					'title'             => __( 'Padding', 'astra-addon' ),
					'linked_choices'    => true,
					'unit_choices'      => array( 'px', 'em', '%' ),
					'choices'           => array(
						'top'    => __( 'Top', 'astra-addon' ),
						'right'  => __( 'Right', 'astra-addon' ),
						'bottom' => __( 'Bottom', 'astra-addon' ),
						'left'   => __( 'Left', 'astra-addon' ),
					),
					'context'           => $social_design_sharing_context,
					'divider'           => array( 'ast_class' => 'ast-top-section-divider ' ),
				),

				/**
				 * Option: Margin Space
				 */
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[single-post-social-sharing-margin]',
					'default'           => astra_get_option( 'single-post-social-sharing-margin' ),
					'type'              => 'control',
					'transport'         => 'postMessage',
					'control'           => 'ast-responsive-spacing',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_responsive_spacing' ),
					'section'           => 'section-blog-single',
					'priority'          => 4,
					'title'             => __( 'Margin', 'astra-addon' ),
					'linked_choices'    => true,
					'unit_choices'      => array( 'px', 'em', '%' ),
					'choices'           => array(
						'top'    => __( 'Top', 'astra-addon' ),
						'right'  => __( 'Right', 'astra-addon' ),
						'bottom' => __( 'Bottom', 'astra-addon' ),
						'left'   => __( 'Left', 'astra-addon' ),
					),
					'context'           => $social_design_sharing_context,
					'divider'           => array( 'ast_class' => 'ast-top-dotted-divider' ),
				),

				/**
				 * Option: Padding Space
				 */
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[single-post-social-sharing-border-radius]',
					'default'           => astra_get_option( 'single-post-social-sharing-border-radius' ),
					'type'              => 'control',
					'transport'         => 'postMessage',
					'control'           => 'ast-responsive-spacing',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_responsive_spacing' ),
					'section'           => 'section-blog-single',
					'priority'          => 4,
					'title'             => __( 'Border Radius', 'astra-addon' ),
					'linked_choices'    => true,
					'unit_choices'      => array( 'px', 'em', '%' ),
					'choices'           => array(
						'top_left'     => __( 'Top', 'astra-addon' ),
						'top_right'    => __( 'Right', 'astra-addon' ),
						'bottom_right' => __( 'Bottom', 'astra-addon' ),
						'bottom_left'  => __( 'Left', 'astra-addon' ),
					),
					'context'           => $social_design_sharing_context,
					'divider'           => array( 'ast_class' => 'ast-top-dotted-divider ast-bottom-spacing' ),
				),

				array(
					'name'      => ASTRA_THEME_SETTINGS . '[author-box-background]',
					'type'      => 'control',
					'control'   => 'ast-background',
					'priority'  => 20,
					'section'   => 'ast-sub-section-author-box',
					'transport' => 'postMessage',
					'default'   => astra_get_option( 'author-box-background' ),
					'divider'   => array( 'ast_class' => 'ast-section-spacing' ),
					'title'     => __( 'Background', 'astra-addon' ),
					'context'   => astra_addon_builder_helper()->design_tab,
				),
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[author-box-extra-settings-notice]',
					'type'     => 'control',
					'control'  => 'ast-description',
					'section'  => 'ast-sub-section-author-box',
					'priority' => 500,
					'label'    => '',
					'help'     => __( 'Note: Explore social icons additional design settings by navigating to the Design tab within the parent Single Post section.', 'astra-addon' ),
					'context'  => astra_addon_builder_helper()->design_tab,
				),
			);

			if ( is_callable( 'Astra_Extended_Base_Configuration::prepare_section_spacing_border_options' ) ) {
				$_configs = array_merge( $_configs, Astra_Extended_Base_Configuration::prepare_section_spacing_border_options( 'ast-sub-section-author-box' ) );
			}

			return array_merge( $configurations, $_configs );
		}
	}
}

/**
 * Kicking this off by creating new instance.
 */
new Astra_Customizer_Blog_Pro_Single_Configs();
