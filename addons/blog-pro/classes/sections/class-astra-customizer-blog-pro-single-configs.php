<?php
/**
 * Blog Pro Single General Options for our theme.
 *
 * @package     Astra Addon
 * @author      Brainstorm Force
 * @copyright   Copyright (c) 2020, Brainstorm Force
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
	class Astra_Customizer_Blog_Pro_Single_Configs extends Astra_Customizer_Config_Base {

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
					'divider'  => array( 'ast_class' => 'ast-top-divider ast-bottom-divider' ),
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
					'divider'  => array( 'ast_class' => 'ast-bottom-divider' ),
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
					'divider'     => array( 'ast_class' => 'ast-bottom-divider' ),
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
					'divider'     => array( 'ast_class' => 'ast-bottom-divider' ),
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
