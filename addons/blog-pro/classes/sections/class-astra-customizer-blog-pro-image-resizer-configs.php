<?php
/**
 * Blog Pro Image Resizer Options for our theme.
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
if ( ! class_exists( 'Astra_Customizer_Blog_Pro_Image_Resizer_Configs' ) ) {

	/**
	 * Register General Customizer Configurations.
	 */
	// @codingStandardsIgnoreStart
	class Astra_Customizer_Blog_Pro_Image_Resizer_Configs extends Astra_Customizer_Config_Base {
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
				 * Option: Blog Archive
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[blog-archive-image-size-heading]',
					'type'     => 'control',
					'control'  => 'ast-divider',
					'section'  => 'section-blog',
					'title'    => __( 'Featured Images Size', 'astra-addon' ),
					'suffix'   => '(px)',
					'priority' => 50,
					'settings' => array(),
					'divider'  => array( 'ast_class' => 'ast-top-section-divider' ),
					'context'  => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[blog-post-structure]',
							'operator' => 'contains',
							'value'    => 'image',
						),
					),
				),

				/**
				 * Option: Featured Image width
				 */
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[blog-archive-image-width]',
					'type'              => 'control',
					'control'           => 'number',
					'transport'         => 'postMessage',
					'default'           => astra_get_option( 'blog-archive-image-width' ),
					'section'           => 'section-blog',
					'priority'          => 50,
					'title'             => __( 'Width', 'astra-addon' ),
					'input_attrs'       => array(
						'style'       => 'text-align:center;',
						'placeholder' => __( 'Auto', 'astra-addon' ),
						'min'         => 5,
						'max'         => 1920,
					),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_number_n_blank' ),
					'context'           => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[blog-post-structure]',
							'operator' => 'contains',
							'value'    => 'image',
						),
					),
				),

				/**
				 * Option: Featured Image height
				 */
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[blog-archive-image-height]',
					'type'              => 'control',
					'control'           => 'number',
					'transport'         => 'postMessage',
					'default'           => astra_get_option( 'blog-archive-image-height' ),
					'section'           => 'section-blog',
					'priority'          => 50,
					'title'             => __( 'Height', 'astra-addon' ),
					'input_attrs'       => array(
						'style'       => 'text-align:center;',
						'placeholder' => __( 'Auto', 'astra-addon' ),
						'min'         => 5,
						'max'         => 1920,
					),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_number_n_blank' ),
					'context'           => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[blog-post-structure]',
							'operator' => 'contains',
							'value'    => 'image',
						),
					),
				),

				/**
				 * Option: Featured Image apply size
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[blog-archive-image-apply-sizes]',
					'type'     => 'control',
					'control'  => 'ast-customizer-refresh',
					'section'  => 'section-blog',
					'default'  => astra_get_option( 'log-archive-image-apply-sizes' ),
					'priority' => 50,
					'title'    => __( 'Apply Size', 'astra-addon' ),
					'context'  => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[blog-post-structure]',
							'operator' => 'contains',
							'value'    => 'image',
						),
					),
				),

				/**
				 * Option: Blog Single Post
				 */
				array(
					'name'        => ASTRA_THEME_SETTINGS . '[blog-single-post-image-size-heading]',
					'type'        => 'control',
					'control'     => 'ast-divider',
					'section'     => 'section-blog-single',
					'title'       => __( 'Featured Images Size', 'astra-addon' ),
					'suffix'      => '(px)',
					'divider'     => array( 'ast_class' => 'ast-top-spacing ast-top-dotted-divider' ),
					'priority'    => 6,
					'settings'    => array(),
					'description' => __( 'This custom size will be used for the title area and content before featured images.', 'astra-addon' ),
					'context'     => astra_addon_builder_helper()->general_tab,
				),

				/**
				 * Option: Featured Image width
				 */
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[blog-single-post-image-width]',
					'type'              => 'control',
					'control'           => 'number',
					'transport'         => 'postMessage',
					'default'           => astra_get_option( 'blog-single-post-image-width' ),
					'section'           => 'section-blog-single',
					'priority'          => 6,
					'title'             => __( 'Width', 'astra-addon' ),
					'input_attrs'       => array(
						'style'       => 'text-align:center;',
						'placeholder' => __( 'Auto', 'astra-addon' ),
						'min'         => 5,
						'max'         => 1920,
					),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_number_n_blank' ),
					'context'           => astra_addon_builder_helper()->general_tab,
				),

				/**
				 * Option: Featured Image height
				 */
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[blog-single-post-image-height]',
					'type'              => 'control',
					'control'           => 'number',
					'transport'         => 'postMessage',
					'default'           => astra_get_option( 'blog-single-post-image-height' ),
					'section'           => 'section-blog-single',
					'priority'          => 6,
					'title'             => __( 'Height', 'astra-addon' ),
					'input_attrs'       => array(
						'style'       => 'text-align:center;',
						'placeholder' => __( 'Auto', 'astra-addon' ),
						'min'         => 5,
						'max'         => 1920,
					),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_number_n_blank' ),
					'context'           => astra_addon_builder_helper()->general_tab,
				),

				/**
				 * Option: Featured Image apply size
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[blog-single-post-image-apply-sizes]',
					'type'     => 'control',
					'control'  => 'ast-customizer-refresh',
					'section'  => 'section-blog-single',
					'default'  => astra_get_option( 'blog-single-post-image-apply-sizes' ),
					'priority' => 6,
					'title'    => __( 'Apply Size', 'astra-addon' ),
					'context'  => astra_addon_builder_helper()->general_tab,
				),
			);

			return array_merge( $configurations, $_configs );
		}
	}
}

/**
 * Kicking this off by calling 'get_instance()' method
 */
new Astra_Customizer_Blog_Pro_Image_Resizer_Configs();
