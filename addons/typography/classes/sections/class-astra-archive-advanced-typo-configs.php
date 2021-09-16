<?php
/**
 * Section [Archive] options for astra theme.
 *
 * @package     Astra Addon
 * @author      Brainstorm Force
 * @copyright   Copyright (c) 2020, Brainstorm Force
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
	class Astra_Archive_Advanced_Typo_Configs extends Astra_Customizer_Config_Base {

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
				 * Option: Archive Summary Box - Title Font Family
				 */
				array(
					'name'      => 'font-family-archive-summary-title',
					'parent'    => ASTRA_THEME_SETTINGS . '[blog-content-archive-summary-typo]',
					'section'   => 'section-blog',
					'type'      => 'sub-control',
					'control'   => 'ast-font',
					'font_type' => 'ast-font-family',
					'title'     => __( 'Family', 'astra-addon' ),
					'default'   => astra_get_option( 'font-family-archive-summary-title' ),
					'connect'   => ASTRA_THEME_SETTINGS . '[font-weight-archive-summary-title]',
					'priority'  => 7,
				),

				/**
				 * Option: Archive Summary Box Title Font Weight
				 */
				array(
					'name'              => 'font-weight-archive-summary-title',
					'parent'            => ASTRA_THEME_SETTINGS . '[blog-content-archive-summary-typo]',
					'section'           => 'section-blog',
					'type'              => 'sub-control',
					'control'           => 'ast-font',
					'font_type'         => 'ast-font-weight',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_font_weight' ),
					'default'           => astra_get_option( 'font-weight-archive-summary-title' ),
					'title'             => __( 'Weight', 'astra-addon' ),
					'connect'           => 'font-family-archive-summary-title',
					'priority'          => 11,
				),

				/**
				 * Option: Archive Summary Box Title Line Height
				 */
				array(
					'name'              => 'line-height-archive-summary-title',
					'parent'            => ASTRA_THEME_SETTINGS . '[blog-content-archive-summary-typo]',
					'section'           => 'section-blog',
					'transport'         => 'postMessage',
					'default'           => astra_get_option( 'line-height-archive-summary-title' ),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_number_n_blank' ),
					'title'             => __( 'Line Height', 'astra-addon' ),
					'type'              => 'sub-control',
					'control'           => 'ast-slider',
					'priority'          => 30,
					'suffix'            => 'em',
					'input_attrs'       => array(
						'min'  => 1,
						'step' => 0.01,
						'max'  => 5,
					),
				),

				/**
				 * Option: Archive Summary Box Text Transform
				 */
				array(
					'name'      => 'text-transform-archive-summary-title',
					'parent'    => ASTRA_THEME_SETTINGS . '[blog-content-archive-summary-typo]',
					'section'   => 'section-blog',
					'title'     => __( 'Text Transform', 'astra-addon' ),
					'transport' => 'postMessage',
					'type'      => 'sub-control',
					'control'   => 'ast-select',
					'default'   => astra_get_option( 'text-transform-archive-summary-title' ),
					'priority'  => 12,
					'choices'   => array(
						''           => __( 'Inherit', 'astra-addon' ),
						'none'       => __( 'None', 'astra-addon' ),
						'capitalize' => __( 'Capitalize', 'astra-addon' ),
						'uppercase'  => __( 'Uppercase', 'astra-addon' ),
						'lowercase'  => __( 'Lowercase', 'astra-addon' ),
					),
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
					'divider'   => array( 'ast_class' => 'ast-bottom-divider' ),
					'context'   => ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) ?
						astra_addon_builder_helper()->design_tab : astra_addon_builder_helper()->general_tab,
				),

				array(
					'name'      => ASTRA_THEME_SETTINGS . '[blog-content-pagination-typo]',
					'default'   => astra_get_option( 'blog-content-pagination-typo' ),
					'type'      => 'control',
					'control'   => 'ast-settings-group',
					'title'     => __( 'Pagination Font', 'astra-addon' ),
					'section'   => 'section-blog',
					'transport' => 'postMessage',
					'priority'  => 150,
					'divider'   => array( 'ast_class' => 'ast-bottom-divider' ),
					'context'   => ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) ?
						astra_addon_builder_helper()->design_tab : astra_addon_builder_helper()->general_tab,
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
					'title'     => __( 'Family', 'astra-addon' ),
					'connect'   => ASTRA_THEME_SETTINGS . '[font-weight-page-title]',
					'priority'  => 1,
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
					'title'             => __( 'Weight', 'astra-addon' ),
					'connect'           => 'font-family-page-title',
					'priority'          => 3,
				),

				/**
				 * Option: Blog - Post Title Line Height
				 */
				array(
					'name'              => 'line-height-page-title',
					'parent'            => ASTRA_THEME_SETTINGS . '[blog-content-blog-post-title-typo]',
					'section'           => 'section-blog',
					'title'             => __( 'Line Height', 'astra-addon' ),
					'default'           => astra_get_option( 'line-height-page-title' ),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_number_n_blank' ),
					'type'              => 'sub-control',
					'control'           => 'ast-slider',
					'transport'         => 'postMessage',
					'priority'          => 6,
					'suffix'            => 'em',
					'input_attrs'       => array(
						'min'  => 1,
						'step' => 0.01,
						'max'  => 5,
					),
				),

				/**
				 * Option: Blog - Post Title Text Transform
				 */
				array(
					'name'      => 'text-transform-page-title',
					'parent'    => ASTRA_THEME_SETTINGS . '[blog-content-blog-post-title-typo]',
					'section'   => 'section-blog',
					'title'     => __( 'Text Transform', 'astra-addon' ),
					'default'   => astra_get_option( 'text-transform-page-title' ),
					'transport' => 'postMessage',
					'type'      => 'sub-control',
					'control'   => 'ast-select',
					'priority'  => 4,
					'choices'   => array(
						''           => __( 'Inherit', 'astra-addon' ),
						'none'       => __( 'None', 'astra-addon' ),
						'capitalize' => __( 'Capitalize', 'astra-addon' ),
						'uppercase'  => __( 'Uppercase', 'astra-addon' ),
						'lowercase'  => __( 'Lowercase', 'astra-addon' ),
					),
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
					'title'     => __( 'Family', 'astra-addon' ),
					'connect'   => ASTRA_THEME_SETTINGS . '[font-weight-post-meta]',
					'priority'  => 5,
				),

				/**
				 * Option: Post Meta Font Size
				 */
				array(
					'name'        => 'font-size-post-meta',
					'parent'      => ASTRA_THEME_SETTINGS . '[blog-content-post-meta-typo]',
					'section'     => 'section-blog',
					'title'       => __( 'Size', 'astra-addon' ),
					'default'     => astra_get_option( 'font-size-post-meta' ),
					'transport'   => 'postMessage',
					'type'        => 'sub-control',
					'control'     => 'ast-responsive',
					'input_attrs' => array(
						'min' => 0,
					),
					'units'       => array(
						'px' => 'px',
						'em' => 'em',
					),
					'priority'    => 5,
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
					'title'             => __( 'Weight', 'astra-addon' ),
					'connect'           => 'font-family-post-meta',
					'priority'          => 5,
				),

				/**
				 * Option: Post Meta Line Height
				 */
				array(
					'name'              => 'line-height-post-meta',
					'parent'            => ASTRA_THEME_SETTINGS . '[blog-content-post-meta-typo]',
					'section'           => 'section-blog',
					'title'             => __( 'Line Height', 'astra-addon' ),
					'type'              => 'sub-control',
					'control'           => 'ast-slider',
					'default'           => astra_get_option( 'line-height-post-meta' ),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_number_n_blank' ),
					'transport'         => 'postMessage',
					'suffix'            => 'em',
					'input_attrs'       => array(
						'min'  => 1,
						'step' => 0.01,
						'max'  => 5,
					),
					'priority'          => 7,
				),

				/**
				 * Option: Post Meta Text Transform
				 */
				array(
					'name'      => 'text-transform-post-meta',
					'parent'    => ASTRA_THEME_SETTINGS . '[blog-content-post-meta-typo]',
					'section'   => 'section-blog',
					'type'      => 'sub-control',
					'control'   => 'ast-select',
					'title'     => __( 'Text Transform', 'astra-addon' ),
					'default'   => astra_get_option( 'text-transform-post-meta' ),
					'transport' => 'postMessage',
					'choices'   => array(
						''           => __( 'Inherit', 'astra-addon' ),
						'none'       => __( 'None', 'astra-addon' ),
						'capitalize' => __( 'Capitalize', 'astra-addon' ),
						'uppercase'  => __( 'Uppercase', 'astra-addon' ),
						'lowercase'  => __( 'Lowercase', 'astra-addon' ),
					),
					'priority'  => 5,
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
				),

				/**
				 * Option: Pagination Font Size
				 */
				array(
					'name'        => 'font-size-post-pagination',
					'parent'      => ASTRA_THEME_SETTINGS . '[blog-content-pagination-typo]',
					'section'     => 'section-blog',
					'default'     => astra_get_option( 'font-size-post-pagination' ),
					'transport'   => 'postMessage',
					'title'       => __( 'Size', 'astra-addon' ),
					'type'        => 'sub-control',
					'control'     => 'ast-responsive',
					'input_attrs' => array(
						'min' => 0,
					),
					'units'       => array(
						'px' => 'px',
						'em' => 'em',
					),
					'priority'    => 5,
				),
			);

			return array_merge( $configurations, $_configs );
		}
	}
}

new Astra_Archive_Advanced_Typo_Configs();
