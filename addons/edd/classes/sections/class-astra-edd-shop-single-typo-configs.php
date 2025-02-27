<?php
/**
 * Shop Options for our theme.
 *
 * @package     Astra Addon
 * @link        https://www.brainstormforce.com
 * @since       Astra 1.6.10
 */

// Block direct access to the file.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Bail if Customizer config base class does not exist.
if ( ! class_exists( 'Astra_Customizer_Config_Base' ) ) {
	return;
}

if ( ! class_exists( 'Astra_Edd_Shop_Single_Typo_Configs' ) ) {

	/**
	 * Register Blog Single Layout Configurations.
	 */
	// @codingStandardsIgnoreStart
	class Astra_Edd_Shop_Single_Typo_Configs extends Astra_Customizer_Config_Base {
		// @codingStandardsIgnoreEnd

		/**
		 * Register Blog Single Layout Configurations.
		 *
		 * @param Array                $configurations Astra Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.6.10
		 * @return Array Astra Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_configs = array(

				/**
				 * Option: Single Product Title Font Family
				 */
				array(
					'name'      => 'font-family-edd-product-title',
					'parent'    => ASTRA_THEME_SETTINGS . '[edd-single-product-title-typo]',
					'section'   => 'section-edd-single',
					'default'   => astra_get_option( 'font-family-edd-product-title' ),
					'type'      => 'sub-control',
					'control'   => 'ast-font',
					'font_type' => 'ast-font-family',
					'divider'   => array( 'ast_class' => 'ast-sub-bottom-dotted-divider' ),
					'title'     => __( 'Font Family', 'astra-addon' ),
					'context'   => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[single-product-structure]',
							'operator' => 'contains',
							'value'    => 'title',
						),
					),
					'connect'   => ASTRA_THEME_SETTINGS . '[font-weight-edd-product-title]',
					'priority'  => 3,
				),

				/**
				 * Option: Single Product Title Font Weight
				 */
				array(
					'name'              => 'font-weight-edd-product-itle]',
					'parent'            => ASTRA_THEME_SETTINGS . '[edd-single-product-title-typo]',
					'section'           => 'section-edd-single',
					'default'           => astra_get_option( 'font-weight-edd-product-title' ),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_font_weight' ),
					'type'              => 'sub-control',
					'control'           => 'ast-font',
					'font_type'         => 'ast-font-weight',
					'title'             => __( 'Font Weight', 'astra-addon' ),
					'context'           => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[single-product-structure]',
							'operator' => 'contains',
							'value'    => 'title',
						),
					),
					'divider'           => array( 'ast_class' => 'ast-sub-bottom-dotted-divider' ),
					'connect'           => 'font-family-edd-product-title',
					'priority'          => 4,
				),

				/**
				 * Option: Single Product Title Font Size
				 */
				array(
					'name'              => 'font-size-edd-product-title',
					'parent'            => ASTRA_THEME_SETTINGS . '[edd-single-product-title-typo]',
					'section'           => 'section-edd-single',
					'default'           => astra_get_option( 'font-size-edd-product-title' ),
					'type'              => 'sub-control',
					'transport'         => 'postMessage',
					'control'           => 'ast-responsive-slider',
					'priority'          => 4,
					'title'             => __( 'Font Size', 'astra-addon' ),
					'context'           => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[single-product-structure]',
							'operator' => 'contains',
							'value'    => 'title',
						),
					),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_responsive_slider' ),
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
				 * Option: Single Product Title Font extras
				 */
				array(
					'name'     => 'font-extras-edd-product-title',
					'type'     => 'sub-control',
					'parent'   => ASTRA_THEME_SETTINGS . '[edd-single-product-title-typo]',
					'control'  => 'ast-font-extras',
					'section'  => 'section-edd-single',
					'priority' => 5,
					'default'  => astra_get_option( 'font-extras-edd-product-title' ),
					'context'  => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[single-product-structure]',
							'operator' => 'contains',
							'value'    => 'title',
						),
					),
				),

				/**
				 * Option: Single Product Content Font Family
				 */
				array(
					'name'      => 'font-family-edd-product-content',
					'parent'    => ASTRA_THEME_SETTINGS . '[edd-single-product-content-typo]',
					'section'   => 'section-edd-single',
					'default'   => astra_get_option( 'font-family-edd-product-content' ),
					'type'      => 'sub-control',
					'divider'   => array( 'ast_class' => 'ast-sub-bottom-dotted-divider' ),
					'control'   => 'ast-font',
					'font_type' => 'ast-font-family',
					'title'     => __( 'Font Family', 'astra-addon' ),
					'connect'   => ASTRA_THEME_SETTINGS . '[font-weight-edd-product-content]',
					'priority'  => 18,
				),

				/**
				 * Option: Single Product Content Font Weight
				 */
				array(
					'name'              => 'font-weight-edd-product-content',
					'parent'            => ASTRA_THEME_SETTINGS . '[edd-single-product-content-typo]',
					'section'           => 'section-edd-single',
					'default'           => astra_get_option( 'font-weight-edd-product-content' ),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_font_weight' ),
					'type'              => 'sub-control',
					'divider'           => array( 'ast_class' => 'ast-sub-bottom-dotted-divider' ),
					'control'           => 'ast-font',
					'font_type'         => 'ast-font-weight',
					'title'             => __( 'Font Weight', 'astra-addon' ),
					'connect'           => 'font-family-edd-product-content',
					'priority'          => 19,
				),

				/**
				 * Option: Single Product Content Font Size
				 */

				array(
					'name'              => 'font-size-edd-product-content',
					'parent'            => ASTRA_THEME_SETTINGS . '[edd-single-product-content-typo]',
					'section'           => 'section-edd-single',
					'default'           => astra_get_option( 'font-size-edd-product-content' ),
					'type'              => 'sub-control',
					'transport'         => 'postMessage',
					'control'           => 'ast-responsive-slider',
					'priority'          => 19,
					'title'             => __( 'Font Size', 'astra-addon' ),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_responsive_slider' ),
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
				 * Option: Single Product Content Font extras.
				 */
				array(
					'name'     => 'font-extras-edd-product-content',
					'type'     => 'sub-control',
					'parent'   => ASTRA_THEME_SETTINGS . '[edd-single-product-content-typo]',
					'control'  => 'ast-font-extras',
					'section'  => 'section-edd-single',
					'priority' => 20,
					'default'  => astra_get_option( 'font-extras-edd-product-content' ),
				),
			);

			return array_merge( $configurations, $_configs );
		}
	}
}

new Astra_Edd_Shop_Single_Typo_Configs();
