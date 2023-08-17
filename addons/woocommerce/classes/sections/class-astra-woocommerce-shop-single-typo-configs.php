<?php
/**
 * Shop Options for our theme.
 *
 * @package     Astra Addon
 * @link        https://www.brainstormforce.com
 * @since       Astra 1.4.3
 */

// Block direct access to the file.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Bail if Customizer config base class does not exist.
if ( ! class_exists( 'Astra_Customizer_Config_Base' ) ) {
	return;
}

if ( ! class_exists( 'Astra_Woocommerce_Shop_Single_Typo_Configs' ) ) {

	/**
	 * Register Blog Single Layout Configurations.
	 */
	// @codingStandardsIgnoreStart
	class Astra_Woocommerce_Shop_Single_Typo_Configs extends Astra_Customizer_Config_Base {
 // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedClassFound
		// @codingStandardsIgnoreEnd

		/**
		 * Register Blog Single Layout Configurations.
		 *
		 * @param Array                $configurations Astra Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array Astra Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_configs = array(

				/**
				 * Option: Divider.
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[woo-single-product-general-fonts-divider]',
					'section'  => 'section-woo-shop-single',
					'title'    => __( 'General Fonts', 'astra-addon' ),
					'type'     => 'control',
					'control'  => 'ast-heading',
					'priority' => 82,
					'settings' => array(),
					'context'  => array(
						astra_addon_builder_helper()->design_tab_config,
					),
					'divider'  => array( 'ast_class' => 'ast-section-spacing' ),
				),

				/**
				 * Group: WooCommerce Single product title Group
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[single-product-title-group]',
					'default'   => astra_get_option( 'single-product-title-group' ),
					'type'      => 'control',
					'control'   => 'ast-settings-group',
					'title'     => __( 'Title Font', 'astra-addon' ),
					'section'   => 'section-woo-shop-single',
					'transport' => 'postMessage',
					'context'   => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[single-product-structure]',
							'operator' => 'contains',
							'value'    => 'title',
						),
					),

					'priority'  => 82,
				),

				/**
				 * Group: WooCommerce Single product Category Font
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[single-product-category-group]',
					'default'   => astra_get_option( 'single-product-category-group' ),
					'type'      => 'control',
					'control'   => 'ast-settings-group',
					'title'     => __( 'Category Font', 'astra-addon' ),
					'section'   => 'section-woo-shop-single',
					'transport' => 'postMessage',
					'context'   => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[single-product-structure]',
							'operator' => 'contains',
							'value'    => 'category',
						),
					),
					'priority'  => 82,
				),

				/**
				 * Option: Single Product Title Font Family
				 */
				array(
					'name'      => 'font-family-product-title',
					'default'   => astra_get_option( 'font-family-product-title' ),
					'type'      => 'sub-control',
					'parent'    => ASTRA_THEME_SETTINGS . '[single-product-title-group]',
					'section'   => 'section-woo-shop-single',
					'control'   => 'ast-font',
					'font_type' => 'ast-font-family',
					'title'     => __( 'Font Family', 'astra-addon' ),
					'divider'   => array( 'ast_class' => 'ast-sub-bottom-dotted-divider' ),
					'connect'   => 'font-weight-product-title',
					'priority'  => 4,
				),

				/**
				 * Option: Single Product Title Font Weight
				 */
				array(
					'name'              => 'font-weight-product-title',
					'default'           => astra_get_option( 'font-weight-product-title' ),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_font_weight' ),
					'type'              => 'sub-control',
					'parent'            => ASTRA_THEME_SETTINGS . '[single-product-title-group]',
					'section'           => 'section-woo-shop-single',
					'control'           => 'ast-font',
					'font_type'         => 'ast-font-weight',
					'title'             => __( 'Font Weight', 'astra-addon' ),
					'divider'           => array( 'ast_class' => 'ast-sub-bottom-dotted-divider' ),
					'connect'           => 'font-family-product-title',
					'priority'          => 5,
				),

				/**
				 * Option: Single Product Title Font Size
				 */
				array(
					'name'              => 'font-size-product-title',
					'default'           => astra_get_option( 'font-size-product-title' ),
					'type'              => 'sub-control',
					'parent'            => ASTRA_THEME_SETTINGS . '[single-product-title-group]',
					'section'           => 'section-woo-shop-single',
					'transport'         => 'postMessage',
					'control'           => 'ast-responsive-slider',
					'priority'          => 5,
					'title'             => __( 'Font Size', 'astra-addon' ),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_responsive_slider' ),
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
				 * Option: Single Product Title Text Transform
				 */
				array(
					'name'     => 'font-extras-product-title',
					'type'     => 'sub-control',
					'parent'   => ASTRA_THEME_SETTINGS . '[single-product-title-group]',
					'control'  => 'ast-font-extras',
					'section'  => 'section-woo-shop-single',
					'priority' => 5,
					'default'  => astra_get_option( 'font-extras-product-title' ),
				),

				/**
				 * Group: WooCommerce Single product price Group
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[single-product-price-group]',
					'default'   => astra_get_option( 'single-product-price-group' ),
					'type'      => 'control',
					'control'   => 'ast-settings-group',
					'title'     => __( 'Price Font', 'astra-addon' ),
					'section'   => 'section-woo-shop-single',
					'transport' => 'postMessage',
					'context'   => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[single-product-structure]',
							'operator' => 'contains',
							'value'    => 'title',
						),
					),
					'priority'  => 82,
				),

				/**
				 * Option: Single Product Price Font Family
				 */
				array(
					'name'      => 'font-family-product-price',
					'default'   => astra_get_option( 'font-family-product-price' ),
					'type'      => 'sub-control',
					'parent'    => ASTRA_THEME_SETTINGS . '[single-product-price-group]',
					'section'   => 'section-woo-shop-single',
					'control'   => 'ast-font',
					'font_type' => 'ast-font-family',
					'title'     => __( 'Font Family', 'astra-addon' ),
					'divider'   => array( 'ast_class' => 'ast-sub-bottom-dotted-divider' ),
					'connect'   => ASTRA_THEME_SETTINGS . '[font-weight-product-price]',
					'priority'  => 9,
				),

				/**
				 * Option: Single Product price Font Weight
				 */
				array(
					'name'              => 'font-weight-product-price',
					'default'           => astra_get_option( 'font-weight-product-price' ),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_font_weight' ),
					'type'              => 'sub-control',
					'parent'            => ASTRA_THEME_SETTINGS . '[single-product-price-group]',
					'section'           => 'section-woo-shop-single',
					'control'           => 'ast-font',
					'font_type'         => 'ast-font-weight',
					'title'             => __( 'Font Weight', 'astra-addon' ),
					'divider'           => array( 'ast_class' => 'ast-sub-bottom-dotted-divider' ),
					'connect'           => 'font-family-product-price',
					'priority'          => 10,
				),

				/**
				 * Option: Single Product Price Font Size
				 */
				array(
					'name'              => 'font-size-product-price',
					'default'           => astra_get_option( 'font-size-product-price' ),
					'type'              => 'sub-control',
					'parent'            => ASTRA_THEME_SETTINGS . '[single-product-price-group]',
					'section'           => 'section-woo-shop-single',
					'transport'         => 'postMessage',
					'control'           => 'ast-responsive-slider',
					'priority'          => 10,
					'title'             => __( 'Font Size', 'astra-addon' ),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_responsive_slider' ),
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
				 * Option: Single Product Price font extras
				 */
				array(
					'name'     => 'font-extras-product-price',
					'type'     => 'sub-control',
					'parent'   => ASTRA_THEME_SETTINGS . '[single-product-price-group]',
					'control'  => 'ast-font-extras',
					'section'  => 'section-woo-shop-single',
					'priority' => 10,
					'default'  => astra_get_option( 'font-extras-product-price' ),
				),

				/**
				 * Option: Single Product Category Font Family
				 */
				array(
					'name'      => 'font-family-product-category',
					'default'   => astra_get_option( 'font-family-product-category' ),
					'type'      => 'sub-control',
					'parent'    => ASTRA_THEME_SETTINGS . '[single-product-category-group]',
					'section'   => 'section-woo-shop-single',
					'control'   => 'ast-font',
					'divider'   => array( 'ast_class' => 'ast-sub-bottom-dotted-divider' ),
					'font_type' => 'ast-font-family',
					'title'     => __( 'Font Family', 'astra-addon' ),
					'connect'   => ASTRA_THEME_SETTINGS . '[font-weight-product-category]',
					'priority'  => 9,
				),

				/**
				 * Option: Single Product category Font Weight
				 */
				array(
					'name'              => 'font-weight-product-category',
					'default'           => astra_get_option( 'font-weight-product-category' ),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_font_weight' ),
					'type'              => 'sub-control',
					'parent'            => ASTRA_THEME_SETTINGS . '[single-product-category-group]',
					'section'           => 'section-woo-shop-single',
					'control'           => 'ast-font',
					'font_type'         => 'ast-font-weight',
					'divider'           => array( 'ast_class' => 'ast-sub-bottom-dotted-divider' ),
					'title'             => __( 'Font Weight', 'astra-addon' ),
					'connect'           => 'font-family-product-category',
					'priority'          => 10,
				),

				/**
				 * Option: Single Product category Font Size
				 */

				array(
					'name'              => 'font-size-product-category',
					'default'           => astra_get_option( 'font-size-product-category' ),
					'type'              => 'sub-control',
					'parent'            => ASTRA_THEME_SETTINGS . '[single-product-category-group]',
					'section'           => 'section-woo-shop-single',
					'transport'         => 'postMessage',
					'control'           => 'ast-responsive-slider',
					'priority'          => 10,
					'title'             => __( 'Font Size', 'astra-addon' ),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_responsive_slider' ),
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
				 * Option: Single Product Category Text extras.
				 */
				array(
					'name'     => 'font-extras-product-category',
					'type'     => 'sub-control',
					'parent'   => ASTRA_THEME_SETTINGS . '[single-product-category-group]',
					'control'  => 'ast-font-extras',
					'section'  => 'section-woo-shop-single',
					'priority' => 10,
					'default'  => astra_get_option( 'font-extras-product-category' ),
				),

				/**
				 * Group: WooCommerce Single product breadcrumb Group
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[single-product-breadcrumb-group]',
					'default'   => astra_get_option( 'single-product-breadcrumb-group' ),
					'type'      => 'control',
					'control'   => 'ast-settings-group',
					'title'     => __( 'Breadcrumb Font', 'astra-addon' ),
					'section'   => 'section-woo-shop-single',
					'transport' => 'postMessage',
					'context'   => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[single-product-breadcrumb-disable]',
							'operator' => '==',
							'value'    => true,
						),
					),
					'priority'  => 82,
				),

				/**
				 * Option: Single Product Breadcrumb Font Family
				 */
				array(
					'name'      => 'font-family-product-breadcrumb',
					'default'   => astra_get_option( 'font-family-product-breadcrumb' ),
					'type'      => 'sub-control',
					'parent'    => ASTRA_THEME_SETTINGS . '[single-product-breadcrumb-group]',
					'section'   => 'section-woo-shop-single',
					'control'   => 'ast-font',
					'font_type' => 'ast-font-family',
					'divider'   => array( 'ast_class' => 'ast-sub-bottom-dotted-divider' ),
					'title'     => __( 'Font Family', 'astra-addon' ),
					'connect'   => ASTRA_THEME_SETTINGS . '[font-weight-product-breadcrumb]',
					'priority'  => 14,
				),

				/**
				 * Option: Single Product Breadcrumb Font Weight
				 */
				array(
					'name'              => 'font-weight-product-breadcrumb',
					'default'           => astra_get_option( 'font-weight-product-breadcrumb' ),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_font_weight' ),
					'type'              => 'sub-control',
					'parent'            => ASTRA_THEME_SETTINGS . '[single-product-breadcrumb-group]',
					'section'           => 'section-woo-shop-single',
					'control'           => 'ast-font',
					'font_type'         => 'ast-font-weight',
					'title'             => __( 'Font Weight', 'astra-addon' ),
					'divider'           => array( 'ast_class' => 'ast-sub-bottom-dotted-divider' ),
					'connect'           => 'font-family-product-breadcrumb',
					'priority'          => 15,
				),

				/**
				 * Option: Single Product Breadcrumb Font Size
				 */
				array(
					'name'              => 'font-size-product-breadcrumb',
					'default'           => astra_get_option( 'font-size-product-breadcrumb' ),
					'type'              => 'sub-control',
					'parent'            => ASTRA_THEME_SETTINGS . '[single-product-breadcrumb-group]',
					'section'           => 'section-woo-shop-single',
					'transport'         => 'postMessage',
					'control'           => 'ast-responsive-slider',
					'priority'          => 15,
					'title'             => __( 'Font Size', 'astra-addon' ),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_responsive_slider' ),
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
				 * Option: Single Product Breadcrumb Text extras.
				 */
				array(
					'name'     => 'font-extras-product-breadcrumb',
					'type'     => 'sub-control',
					'parent'   => ASTRA_THEME_SETTINGS . '[single-product-breadcrumb-group]',
					'control'  => 'ast-font-extras',
					'section'  => 'section-woo-shop-single',
					'priority' => 15,
					'default'  => astra_get_option( 'font-extras-product-breadcrumb' ),
				),

				/**
				 * Group: WooCommerce Single product content Group
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[single-product-content-group]',
					'default'   => astra_get_option( 'single-product-content-group' ),
					'type'      => 'control',
					'control'   => 'ast-settings-group',
					'title'     => __( 'Content Font', 'astra-addon' ),
					'section'   => 'section-woo-shop-single',
					'transport' => 'postMessage',
					'priority'  => 82,
					'context'   => astra_addon_builder_helper()->design_tab,
				),

				/**
				 * Option: Single Product Content Font Family
				 */
				array(
					'name'      => 'font-family-product-content',
					'default'   => astra_get_option( 'font-family-product-content' ),
					'type'      => 'sub-control',
					'parent'    => ASTRA_THEME_SETTINGS . '[single-product-content-group]',
					'section'   => 'section-woo-shop-single',
					'control'   => 'ast-font',
					'divider'   => array( 'ast_class' => 'ast-sub-bottom-dotted-divider' ),
					'font_type' => 'ast-font-family',
					'title'     => __( 'Font Family', 'astra-addon' ),
					'connect'   => ASTRA_THEME_SETTINGS . '[font-weight-product-content]',
					'priority'  => 19,
				),

				/**
				 * Option: Single Product Content Font Weight
				 */
				array(
					'name'              => 'font-weight-product-content',
					'default'           => astra_get_option( 'font-weight-product-content' ),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_font_weight' ),
					'type'              => 'sub-control',
					'parent'            => ASTRA_THEME_SETTINGS . '[single-product-content-group]',
					'section'           => 'section-woo-shop-single',
					'control'           => 'ast-font',
					'font_type'         => 'ast-font-weight',
					'title'             => __( 'Font Weight', 'astra-addon' ),
					'divider'           => array( 'ast_class' => 'ast-sub-bottom-dotted-divider' ),
					'connect'           => 'font-family-product-content',
					'priority'          => 20,
				),

				/**
				 * Option: Single Product Content Font Size
				 */
				array(
					'name'              => 'font-size-product-content',
					'default'           => astra_get_option( 'font-size-product-content' ),
					'type'              => 'sub-control',
					'parent'            => ASTRA_THEME_SETTINGS . '[single-product-content-group]',
					'section'           => 'section-woo-shop-single',
					'transport'         => 'postMessage',
					'control'           => 'ast-responsive-slider',
					'priority'          => 20,
					'title'             => __( 'Font Size', 'astra-addon' ),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_responsive_slider' ),
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
				 * Option: Single Product Content Text Transform
				 */
				array(
					'name'     => 'font-extras-product-content',
					'type'     => 'sub-control',
					'parent'   => ASTRA_THEME_SETTINGS . '[single-product-content-group]',
					'control'  => 'ast-font-extras',
					'section'  => 'section-woo-shop-single',
					'priority' => 20,
					'default'  => astra_get_option( 'font-extras-product-content' ),
				),
			);

			$configurations = array_merge( $configurations, $_configs );

			return $configurations;

		}
	}
}

new Astra_Woocommerce_Shop_Single_Typo_Configs();
