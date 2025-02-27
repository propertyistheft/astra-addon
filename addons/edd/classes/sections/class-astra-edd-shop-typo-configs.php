<?php
/**
 * Shop Options for our theme.
 *
 * @package     Astra
 * @link        https://wpastra.com/
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

if ( ! class_exists( 'Astra_Edd_Shop_Typo_Configs' ) ) {

	/**
	 * Register Easy Digital Downloads Shop Typo Layout Configurations.
	 */
	// @codingStandardsIgnoreStart
	class Astra_Edd_Shop_Typo_Configs extends Astra_Customizer_Config_Base {
		// @codingStandardsIgnoreEnd

		/**
		 * Register Easy Digital Downloads Shop Typo Layout Configurations.
		 *
		 * @param Array                $configurations Astra Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.6.10
		 * @return Array Astra Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_configs = array(

				/**
				 * Option: Product Title Font Family
				 */
				array(
					'name'      => 'font-family-edd-archive-product-title',
					'parent'    => ASTRA_THEME_SETTINGS . '[edd-archive-product-title-typo]',
					'section'   => 'section-edd-archive',
					'default'   => astra_get_option( 'font-family-edd-archive-product-title' ),
					'type'      => 'sub-control',
					'control'   => 'ast-font',
					'font_type' => 'ast-font-family',
					'divider'   => array( 'ast_class' => 'ast-sub-bottom-dotted-divider' ),
					'title'     => __( 'Font Family', 'astra-addon' ),
					'connect'   => ASTRA_THEME_SETTINGS . '[font-weight-edd-archive-product-title]',
					'priority'  => 3,
					'context'   => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[edd-archive-product-structure]',
							'operator' => 'contains',
							'value'    => 'title',
						),
					),
				),

				/**
				 * Option: Product Title Font Weight
				 */
				array(
					'name'              => 'font-weight-edd-archive-product-title',
					'parent'            => ASTRA_THEME_SETTINGS . '[edd-archive-product-title-typo]',
					'section'           => 'section-edd-archive',
					'default'           => astra_get_option( 'font-weight-edd-archive-product-title' ),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_font_weight' ),
					'type'              => 'sub-control',
					'control'           => 'ast-font',
					'divider'           => array( 'ast_class' => 'ast-sub-bottom-dotted-divider' ),
					'font_type'         => 'ast-font-weight',
					'context'           => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[edd-archive-product-structure]',
							'operator' => 'contains',
							'value'    => 'title',
						),
					),
					'title'             => __( 'Font Weight', 'astra-addon' ),
					'connect'           => 'font-family-edd-archive-product-title',
					'priority'          => 4,
				),

				/**
				 * Option: Product Title Font Size
				 */

				array(
					'name'              => 'font-size-edd-archive-product-title',
					'parent'            => ASTRA_THEME_SETTINGS . '[edd-archive-product-title-typo]',
					'section'           => 'section-edd-archive',
					'default'           => astra_get_option( 'font-size-edd-archive-product-title' ),
					'type'              => 'sub-control',
					'transport'         => 'postMessage',
					'control'           => 'ast-responsive-slider',
					'priority'          => 4,
					'context'           => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[edd-archive-product-structure]',
							'operator' => 'contains',
							'value'    => 'title',
						),
					),
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
				 * Option: Product Title Font extras
				 */
				array(
					'name'     => 'font-extras-edd-archive-product-title',
					'type'     => 'sub-control',
					'parent'   => ASTRA_THEME_SETTINGS . '[edd-archive-product-title-typo]',
					'control'  => 'ast-font-extras',
					'section'  => 'section-edd-archive',
					'priority' => 5,
					'default'  => astra_get_option( 'font-extras-edd-archive-product-title' ),
				),

				/**
				 * Option: Product Price Font Family
				 */
				array(
					'name'      => 'font-family-edd-archive-product-price',
					'parent'    => ASTRA_THEME_SETTINGS . '[edd-archive-product-price-typo]',
					'section'   => 'section-edd-archive',
					'default'   => astra_get_option( 'font-family-edd-archive-product-price' ),
					'type'      => 'sub-control',
					'divider'   => array( 'ast_class' => 'ast-sub-bottom-dotted-divider' ),
					'control'   => 'ast-font',
					'font_type' => 'ast-font-family',
					'context'   => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[edd-archive-product-structure]',
							'operator' => 'contains',
							'value'    => 'price',
						),
					),
					'title'     => __( 'Font Family', 'astra-addon' ),
					'connect'   => ASTRA_THEME_SETTINGS . '[font-weight-edd-archive-product-price]',
					'priority'  => 9,
				),

				/**
				 * Option: Product Price Font Weight
				 */
				array(
					'name'              => 'font-weight-edd-archive-product-price',
					'parent'            => ASTRA_THEME_SETTINGS . '[edd-archive-product-price-typo]',
					'section'           => 'section-edd-archive',
					'default'           => astra_get_option( 'font-weight-edd-archive-product-price' ),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_font_weight' ),
					'type'              => 'sub-control',
					'control'           => 'ast-font',
					'divider'           => array( 'ast_class' => 'ast-sub-bottom-dotted-divider' ),
					'font_type'         => 'ast-font-weight',
					'context'           => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[edd-archive-product-structure]',
							'operator' => 'contains',
							'value'    => 'price',
						),
					),
					'title'             => __( 'Font Weight', 'astra-addon' ),
					'connect'           => 'font-family-edd-archive-product-price',
					'priority'          => 10,
				),

				/**
				 * Option: Product Price Font Size
				 */

				array(
					'name'              => 'font-size-edd-archive-product-price',
					'parent'            => ASTRA_THEME_SETTINGS . '[edd-archive-product-price-typo]',
					'section'           => 'section-edd-archive',
					'default'           => astra_get_option( 'font-size-edd-archive-product-price' ),
					'type'              => 'sub-control',
					'transport'         => 'postMessage',
					'control'           => 'ast-responsive-slider',
					'priority'          => 10,
					'context'           => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[edd-archive-product-structure]',
							'operator' => 'contains',
							'value'    => 'price',
						),
					),
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
				 * Option: Product Font Extras
				 */
				array(
					'name'     => 'font-extras-edd-archive-product-price',
					'type'     => 'sub-control',
					'parent'   => ASTRA_THEME_SETTINGS . '[edd-archive-product-price-typo]',
					'control'  => 'ast-font-extras',
					'section'  => 'section-edd-archive',
					'priority' => 10,
					'context'  => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[edd-archive-product-structure]',
							'operator' => 'contains',
							'value'    => 'price',
						),
					),
					'default'  => astra_get_option( 'font-extras-edd-archive-product-price' ),
				),

				/**
				 * Option: Product Content Font Family
				 */
				array(
					'name'      => 'font-family-edd-archive-product-content',
					'parent'    => ASTRA_THEME_SETTINGS . '[edd-archive-product-content-typo]',
					'section'   => 'section-edd-archive',
					'default'   => astra_get_option( 'font-family-edd-archive-product-content' ),
					'type'      => 'sub-control',
					'control'   => 'ast-font',
					'font_type' => 'ast-font-family',
					'divider'   => array( 'ast_class' => 'ast-sub-bottom-dotted-divider' ),
					'title'     => __( 'Font Family', 'astra-addon' ),
					'connect'   => ASTRA_THEME_SETTINGS . '[font-weight-edd-archive-product-content]',
					'priority'  => 13,
				),

				/**
				 * Option: Product Content Font Weight
				 */
				array(
					'name'              => 'font-weight-edd-archive-product-content',
					'parent'            => ASTRA_THEME_SETTINGS . '[edd-archive-product-content-typo]',
					'section'           => 'section-edd-archive',
					'default'           => astra_get_option( 'font-weight-edd-archive-product-content' ),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_font_weight' ),
					'type'              => 'sub-control',
					'control'           => 'ast-font',
					'font_type'         => 'ast-font-weight',
					'divider'           => array( 'ast_class' => 'ast-sub-bottom-dotted-divider' ),
					'title'             => __( 'Font Weight', 'astra-addon' ),
					'connect'           => 'font-family-edd-archive-product-content',
					'priority'          => 14,
				),

				/**
				 * Option: Product Content Font Size
				 */
				array(
					'name'              => 'font-size-edd-archive-product-content',
					'parent'            => ASTRA_THEME_SETTINGS . '[edd-archive-product-content-typo]',
					'section'           => 'section-edd-archive',
					'default'           => astra_get_option( 'font-size-edd-archive-product-content' ),
					'type'              => 'sub-control',
					'transport'         => 'postMessage',
					'control'           => 'ast-responsive-slider',
					'priority'          => 14,
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
				 * Option: Product Content Line Height
				 */
				array(
					'name'     => 'font-extras-edd-archive-product-content',
					'type'     => 'sub-control',
					'parent'   => ASTRA_THEME_SETTINGS . '[edd-archive-product-content-typo]',
					'control'  => 'ast-font-extras',
					'section'  => 'section-edd-archive',
					'priority' => 15,
					'default'  => astra_get_option( 'font-extras-edd-archive-product-content' ),
				),
			);

			return array_merge( $configurations, $_configs );
		}
	}
}

new Astra_Edd_Shop_Typo_Configs();
