<?php
/**
 * Shop Options for our theme.
 *
 * @package     Astra Addon
 * @author      Brainstorm Force
 * @copyright   Copyright (c) 2020, Brainstorm Force
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

if ( ! class_exists( 'Astra_Edd_Shop_Configs' ) ) {

	/**
	 * Register Easy Digital Downloads Shop Layout Configurations.
	 */
	class Astra_Edd_Shop_Configs extends Astra_Customizer_Config_Base {

		/**
		 * Register Easy Digital Downloads Shop Layout Configurations.
		 *
		 * @param Array                $configurations Astra Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.6.10
		 * @return Array Astra Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_configs = array(

				/**
				 * Option: Choose Product Style
				 */
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[edd-archive-style]',
					'default'           => astra_get_option( 'edd-archive-style' ),
					'type'              => 'control',
					'section'           => 'section-edd-archive',
					'title'             => __( 'Layout', 'astra-addon' ),
					'control'           => 'ast-radio-image',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_choices' ),
					'priority'          => 5,
					'divider'           => array( 'ast_class' => 'ast-bottom-divider' ),
					'choices'           => array(
						'edd-archive-page-grid-style' => array(
							'label' => __( 'Grid View', 'astra-addon' ),
							'path'  => ( class_exists( 'Astra_Builder_UI_Controller' ) ) ? Astra_Builder_UI_Controller::fetch_svg_icon( 'edd-archive-page-grid-style', false ) : '',
						),
						'edd-archive-page-list-style' => array(
							'label' => __( 'List View', 'astra-addon' ),
							'path'  => ( class_exists( 'Astra_Builder_UI_Controller' ) ) ? Astra_Builder_UI_Controller::fetch_svg_icon( 'edd-archive-page-list-style', false ) : '',
						),
					),
				),

				/**
				 * Option: EDD Archive Post override-heading to display notice
				 */
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[edd-archive-product-structure]',
					'type'              => 'control',
					'control'           => 'ast-sortable',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_multi_choices' ),
					'section'           => 'section-edd-archive',
					'default'           => astra_get_option( 'edd-archive-product-structure' ),
					'priority'          => 30,
					'divider'           => array( 'ast_class' => 'ast-bottom-divider' ),
					'title'             => __( 'Product Structure', 'astra-addon' ),
					'description'       => __( 'The Image option cannot be sortable if the Product Style is selected to the List Style ', 'astra-addon' ),
					'choices'           => array(
						'image'      => __( 'Image', 'astra-addon' ),
						'title'      => __( 'Title', 'astra-addon' ),
						'price'      => __( 'Price', 'astra-addon' ),
						'short_desc' => __( 'Short Description', 'astra-addon' ),
						'add_cart'   => __( 'Add To Cart', 'astra-addon' ),
						'category'   => __( 'Category', 'astra-addon' ),
					),
				),

				/**
				 * Option: Divider
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[edd-archive-box-styling-divider]',
					'section'  => 'section-edd-archive',
					'title'    => __( 'Product Styling', 'astra-addon' ),
					'type'     => 'control',
					'control'  => 'ast-heading',
					'priority' => 75,
					'settings' => array(),
				),

				/**
				 * Option: Content Alignment
				 */
				array(
					'name'       => ASTRA_THEME_SETTINGS . '[edd-archive-product-align]',
					'default'    => astra_get_option( 'edd-archive-product-align' ),
					'type'       => 'control',
					'divider'    => array( 'ast_class' => 'ast-bottom-divider' ),
					'transport'  => 'postMessage',
					'control'    => Astra_Theme_Extension::$selector_control,
					'section'    => 'section-edd-archive',
					'priority'   => 80,
					'title'      => __( 'Content Alignment', 'astra-addon' ),
					'choices'    => array(
						'align-left'   => 'align-left',
						'align-center' => 'align-center',
						'align-right'  => 'align-right',
					),
					'responsive' => false,
				),

				/**
				 * Option: Box shadow
				 */
				array(
					'name'        => ASTRA_THEME_SETTINGS . '[edd-archive-product-shadow]',
					'default'     => astra_get_option( 'edd-archive-product-shadow' ),
					'type'        => 'control',
					'transport'   => 'postMessage',
					'control'     => 'ast-slider',
					'title'       => __( 'Box Shadow', 'astra-addon' ),
					'section'     => 'section-edd-archive',
					'suffix'      => 'px',
					'priority'    => 85,
					'input_attrs' => array(
						'min'  => 0,
						'step' => 1,
						'max'  => 5,
					),
				),

				/**
				 * Option: Box hover shadow
				 */
				array(
					'name'        => ASTRA_THEME_SETTINGS . '[edd-archive-product-shadow-hover]',
					'default'     => astra_get_option( 'edd-archive-product-shadow-hover' ),
					'type'        => 'control',
					'transport'   => 'postMessage',
					'control'     => 'ast-slider',
					'title'       => __( 'Box Hover Shadow', 'astra-addon' ),
					'section'     => 'section-edd-archive',
					'suffix'      => 'px',
					'priority'    => 90,
					'input_attrs' => array(
						'min'  => 0,
						'step' => 1,
						'max'  => 5,
					),
				),

				/**
				 * Option: Divider
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[edd-archive-button-divider]',
					'section'  => 'section-edd-archive',
					'title'    => __( 'Button', 'astra-addon' ),
					'type'     => 'control',
					'control'  => 'ast-heading',
					'priority' => 110,
					'settings' => array(),
				),

				/**
				 * Option: Vertical Padding
				 */
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[edd-archive-button-v-padding]',
					'default'           => astra_get_option( 'edd-archive-button-v-padding' ),
					'type'              => 'control',
					'transport'         => 'postMessage',
					'divider'           => array( 'ast_class' => 'ast-bottom-divider' ),
					'section'           => 'section-edd-archive',
					'title'             => __( 'Vertical Padding', 'astra-addon' ),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_number_n_blank' ),
					'control'           => 'ast-slider',
					'suffix'            => 'px',
					'priority'          => 110,
					'input_attrs'       => array(
						'min'  => 1,
						'step' => 1,
						'max'  => 200,
					),
				),

				/**
				 * Option: Horizontal Padding
				 */
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[edd-archive-button-h-padding]',
					'default'           => astra_get_option( 'edd-archive-button-h-padding' ),
					'type'              => 'control',
					'transport'         => 'postMessage',
					'section'           => 'section-edd-archive',
					'priority'          => 110,
					'title'             => __( 'Horizontal Padding', 'astra-addon' ),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_number_n_blank' ),
					'control'           => 'ast-slider',
					'suffix'            => 'px',
					'input_attrs'       => array(
						'min'  => 1,
						'step' => 1,
						'max'  => 200,
					),
					'divider'           => array( 'ast_class' => 'ast-bottom-divider' ),
				),

				/**
				 * Option: Display Page Title
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[edd-archive-page-title-display]',
					'default'  => astra_get_option( 'edd-archive-page-title-display' ),
					'type'     => 'control',
					'section'  => 'section-edd-archive',
					'title'    => __( 'Display Page Title', 'astra-addon' ),
					'priority' => 29,
					'divider'  => array( 'ast_class' => 'ast-bottom-divider' ),
					'control'  => Astra_Theme_Extension::$switch_control,
				),

				/**
				 * Option: EDD Product Title Typography
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[edd-archive-product-title-typo]',
					'default'   => astra_get_option( 'edd-archive-product-title-typo' ),
					'type'      => 'control',
					'control'   => 'ast-settings-group',
					'title'     => __( 'Product Title Font', 'astra-addon' ),
					'section'   => 'section-edd-archive',
					'transport' => 'postMessage',
					'priority'  => 233,
				),

				/**
				 * Option: EDD Product Price Typography
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[edd-archive-product-price-typo]',
					'default'   => astra_get_option( 'edd-archive-product-price-typo' ),
					'type'      => 'control',
					'control'   => 'ast-settings-group',
					'title'     => __( 'Product Price Font', 'astra-addon' ),
					'section'   => 'section-edd-archive',
					'transport' => 'postMessage',
					'priority'  => 233,
				),

				/**
				 * Option: EDD Product Content Typography
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[edd-archive-product-content-typo]',
					'default'   => astra_get_option( 'edd-archive-product-content-typo' ),
					'type'      => 'control',
					'control'   => 'ast-settings-group',
					'title'     => __( 'Product Content Font', 'astra-addon' ),
					'section'   => 'section-edd-archive',
					'transport' => 'postMessage',
					'context'   => array(
						'relation' => 'AND',
						astra_addon_builder_helper()->general_tab_config,
						array(
							'relation' => 'OR',
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[edd-archive-product-structure]',
								'operator' => 'contains',
								'value'    => 'category',
							),
							array(
								'setting'  => ASTRA_THEME_SETTINGS . '[edd-archive-product-structure]',
								'operator' => 'contains',
								'value'    => 'structure',
							),
						),

					),
					'priority'  => 233,
				),
			);

			$configurations = array_merge( $configurations, $_configs );

			return $configurations;

		}
	}
}


new Astra_Edd_Shop_Configs();
