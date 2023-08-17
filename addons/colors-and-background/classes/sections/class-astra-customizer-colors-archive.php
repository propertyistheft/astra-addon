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

				/**
				 * Option: Blog / Archive Color Group
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[blog-content-color-group]',
					'default'   => astra_get_option( 'blog-content-color-group' ),
					'type'      => 'control',
					'control'   => 'ast-settings-group',
					'title'     => $content_colors_config_title,
					'section'   => 'section-blog',
					'transport' => 'postMessage',
					'priority'  => 130,
					'divider'   => array( 'ast_class' => 'ast-section-spacing' ),
					'context'   => ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) ?
						astra_addon_builder_helper()->design_tab : astra_addon_builder_helper()->general_tab,
				),

				// Option: Blog / Archive Post Title Color.
				array(
					'type'              => 'sub-control',
					'tab'               => __( 'Normal', 'astra-addon' ),
					'priority'          => 10,
					'parent'            => ASTRA_THEME_SETTINGS . '[blog-content-color-group]',
					'section'           => 'section-blog',
					'control'           => 'ast-color',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
					'default'           => astra_get_option( 'page-title-color' ),
					'transport'         => 'postMessage',
					'name'              => 'page-title-color',
					'title'             => __( 'Post Title Color', 'astra-addon' ),
				),

				// Option: Post Meta Color.
				array(
					'type'              => 'sub-control',
					'tab'               => __( 'Normal', 'astra-addon' ),
					'priority'          => 10,
					'parent'            => ASTRA_THEME_SETTINGS . '[blog-content-color-group]',
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
					'parent'            => ASTRA_THEME_SETTINGS . '[blog-content-color-group]',
					'section'           => 'section-blog',
					'control'           => 'ast-color',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
					'default'           => astra_get_option( 'post-meta-link-color' ),
					'transport'         => 'postMessage',
					'name'              => 'post-meta-link-color',
					'title'             => __( 'Meta Link Color', 'astra-addon' ),
				),

				// Option: Post Meta Link Hover Color.
				array(
					'type'              => 'sub-control',
					'tab'               => __( 'Hover', 'astra-addon' ),
					'priority'          => 12,
					'parent'            => ASTRA_THEME_SETTINGS . '[blog-content-color-group]',
					'section'           => 'section-blog',
					'control'           => 'ast-color',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
					'default'           => astra_get_option( 'post-meta-link-h-color' ),
					'transport'         => 'postMessage',
					'name'              => 'post-meta-link-h-color',
					'title'             => __( 'Meta Link Color', 'astra-addon' ),
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
						'context'  => astra_addon_builder_helper()->general_tab,
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
