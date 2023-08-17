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
				 * Option: Author info
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[ast-author-info]',
					'default'  => astra_get_option( 'ast-author-info' ),
					'type'     => 'control',
					'section'  => 'section-blog-single',
					'title'    => __( 'Author Info', 'astra-addon' ),
					'control'  => Astra_Theme_Extension::$switch_control,
					'priority' => 9,
					'divider'  => array( 'ast_class' => 'ast-top-section-divider' ),
				),

				/**
				 * Option: Disable Single Post Navigation
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[ast-single-post-navigation]',
					'default'  => astra_get_option( 'ast-single-post-navigation' ),
					'type'     => 'control',
					'section'  => 'section-blog-single',
					'title'    => __( 'Disable Single Post Navigation', 'astra-addon' ),
					'control'  => Astra_Theme_Extension::$switch_control,
					'priority' => 9,
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
					'title'       => __( 'Remove Featured Image Padding', 'astra-addon' ),
					'description' => __( 'This option will not work on full width layouts.', 'astra-addon' ),
					'priority'    => 9,
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
					'divider'  => array( 'ast_class' => 'ast-section-spacing' ),
				),

				/**
				 * Option: Enable social sharing.
				 */
				array(
					'name'        => ASTRA_THEME_SETTINGS . '[single-post-social-sharing-icon-enable]',
					'default'     => astra_get_option( 'single-post-social-sharing-icon-enable' ),
					'type'        => 'control',
					'control'     => Astra_Theme_Extension::$switch_control,
					'section'     => 'section-blog-single',
					'title'       => __( 'Enable Social Sharing', 'astra-addon' ),
					'description' => __( 'Enable / Disable social sharing', 'astra-addon' ),
					'priority'    => 9,
					'divider'     => array( 'ast_class' => 'ast-section-spacing' ),
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
					'section'    => 'section-blog-single',
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
					'divider'    => array( 'ast_class' => 'ast-top-dotted-divider' ),
				),

				/**
				 * Option: Enable Social Sharing Heading.
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[single-post-social-sharing-heading-enable]',
					'default'  => astra_get_option( 'single-post-social-sharing-heading-enable' ),
					'type'     => 'control',
					'control'  => Astra_Theme_Extension::$switch_control,
					'section'  => 'section-blog-single',
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
					'section'   => 'section-blog-single',
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
					'section'    => 'section-blog-single',
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
					'section'    => 'section-blog-single',
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
					'section'  => 'section-blog-single',
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
					'section'    => 'section-blog-single',
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
					'name'     => ASTRA_THEME_SETTINGS . '[single-post-social-sharing-icon-position]',
					'default'  => astra_get_option( 'single-post-social-sharing-icon-position' ),
					'type'     => 'control',
					'section'  => 'section-blog-single',
					'title'    => __( 'Icon Position', 'astra-addon' ),
					'control'  => 'ast-select',
					'priority' => 9,
					'choices'  => array(
						'below-post-title' => __( 'Below Post Title', 'astra-addon' ),
						'below-post'       => __( 'Below Post', 'astra-addon' ),
						'left-content'     => __( 'Left Content', 'astra-addon' ),
						'right-content'    => __( 'Right Content', 'astra-addon' ),
					),
					'divider'  => array( 'ast_class' => 'ast-top-dotted-divider' ),
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
				 * Option: Divider
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[single-post-social-sharing-icon-divider]',
					'section'  => 'section-blog-single',
					'title'    => __( 'Social Sharing', 'astra-addon' ),
					'type'     => 'control',
					'control'  => 'ast-heading',
					'priority' => 1,
					'divider'  => array( 'ast_class' => 'ast-bottom-spacing' ),
					'context'  => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[single-post-social-sharing-icon-enable]',
							'operator' => '==',
							'value'    => true,
						),
					),
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
					'context'    => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[single-post-social-sharing-icon-enable]',
							'operator' => '==',
							'value'    => true,
						),
					),
					'responsive' => false,
					'renderAs'   => 'text',
					'divider'    => array( 'ast_class' => 'ast-bottom-dotted-divider' ),
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
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[single-post-social-sharing-icon-enable]',
							'operator' => '==',
							'value'    => true,
						),
					),
					'responsive' => true,
				),

				array(
					'name'       => ASTRA_THEME_SETTINGS . '[single-post-social-sharing-icon-background-color-group]',
					'default'    => astra_get_option( 'single-post-social-sharing-icon-background-color-group' ),
					'type'       => 'control',
					'control'    => 'ast-color-group',
					'title'      => __( 'Icon Background Color', 'astra-addon' ),
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
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[single-post-social-sharing-icon-enable]',
							'operator' => '==',
							'value'    => true,
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
					'context'    => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[single-post-social-sharing-icon-enable]',
							'operator' => '==',
							'value'    => true,
						),
					),
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
					'context'    => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[single-post-social-sharing-icon-enable]',
							'operator' => '==',
							'value'    => true,
						),
					),
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
					'context'    => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[single-post-social-sharing-icon-enable]',
							'operator' => '==',
							'value'    => true,
						),
					),
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
					'context'    => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[single-post-social-sharing-icon-enable]',
							'operator' => '==',
							'value'    => true,
						),
					),
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
					'context'    => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[single-post-social-sharing-icon-enable]',
							'operator' => '==',
							'value'    => true,
						),
					),
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
					'context'    => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[single-post-social-sharing-icon-enable]',
							'operator' => '==',
							'value'    => true,
						),
					),
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
					'context'    => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[single-post-social-sharing-icon-enable]',
							'operator' => '==',
							'value'    => true,
						),
					),
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
					'context'    => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[single-post-social-sharing-icon-enable]',
							'operator' => '==',
							'value'    => true,
						),
					),
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
					'title'      => __( 'Background color', 'astra-addon' ),
					'context'    => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[single-post-social-sharing-icon-enable]',
							'operator' => '==',
							'value'    => true,
						),
					),
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
					'context'           => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[single-post-social-sharing-icon-enable]',
							'operator' => '==',
							'value'    => true,
						),
					),
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
					'context'           => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[single-post-social-sharing-icon-enable]',
							'operator' => '==',
							'value'    => true,
						),
					),
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
					'context'     => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[single-post-social-sharing-icon-enable]',
							'operator' => '==',
							'value'    => true,
						),
					),
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
							'setting'  => ASTRA_THEME_SETTINGS . '[single-post-social-sharing-icon-enable]',
							'operator' => '==',
							'value'    => true,
						),
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
					'suffix'            => array( 'px', 'em' ),
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
					'suffix'            => array( 'px', 'em' ),
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
					'context'           => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[single-post-social-sharing-icon-enable]',
							'operator' => '==',
							'value'    => true,
						),
					),
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
					'context'           => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[single-post-social-sharing-icon-enable]',
							'operator' => '==',
							'value'    => true,
						),
					),
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
					'context'           => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[single-post-social-sharing-icon-enable]',
							'operator' => '==',
							'value'    => true,
						),
					),
					'divider'           => array( 'ast_class' => 'ast-top-dotted-divider ast-bottom-spacing' ),
				),

			);

			return array_merge( $configurations, $_configs );
		}
	}
}

/**
 * Kicking this off by creating new instance.
 */
new Astra_Customizer_Blog_Pro_Single_Configs();
