<?php
/**
 * Easy Digital Downloads General Options for our theme.
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

if ( ! class_exists( 'Astra_Edd_General_Configs' ) ) {

	/**
	 * Register Easy Digital Downloads General Layout Configurations.
	 */
	// @codingStandardsIgnoreStart
	class Astra_Edd_General_Configs extends Astra_Customizer_Config_Base {
		// @codingStandardsIgnoreEnd

		/**
		 * Register Easy Digital Downloads General Layout Configurations.
		 *
		 * @param Array                $configurations Astra Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.6.10
		 * @return Array Astra Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_section = ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) ? 'section-header-edd-cart' : 'section-edd-general';

			$context = ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) ? astra_addon_builder_helper()->design_tab : astra_addon_builder_helper()->general_tab;

			$cart_outline_width_context = ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) ? astra_addon_builder_helper()->design_tab_config : astra_addon_builder_helper()->general_tab_config;

			$_configs = array(

				/**
				 * Option: Header Cart Icon
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[edd-header-cart-icon]',
					'default'  => astra_get_option( 'edd-header-cart-icon' ),
					'type'     => 'control',
					'section'  => $_section,
					'title'    => __( 'Icon', 'astra-addon' ),
					'control'  => 'select',
					'priority' => 35,
					'choices'  => array(
						'default' => __( 'Default', 'astra-addon' ),
						'cart'    => __( 'Cart', 'astra-addon' ),
						'bag'     => __( 'Bag', 'astra-addon' ),
						'basket'  => __( 'Basket', 'astra-addon' ),
					),
					'context'  => astra_addon_builder_helper()->general_tab,
				),

				/**
				 * Option: Cart Count color
				 */
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[edd-header-cart-product-count-color]',
					'default'           => astra_get_option( 'edd-header-cart-product-count-color' ),
					'type'              => 'control',
					'control'           => 'ast-color',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
					'transport'         => 'postMessage',
					'title'             => __( 'Count Color', 'astra-addon' ),
					'context'           => array(
						Astra_Builder_Helper::$design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[edd-header-cart-icon]',
							'operator' => '!=',
							'value'    => 'default',
						),
					),
					'section'           => $_section,
					'priority'          => 45,
				),

				/**
				 * Option: Border Width
				 */
				array(
					'name'        => ASTRA_THEME_SETTINGS . '[edd-header-cart-border-width]',
					'default'     => astra_get_option( 'edd-header-cart-border-width' ),
					'type'        => 'control',
					'transport'   => 'postMessage',
					'section'     => $_section,
					'context'     => array(
						$cart_outline_width_context,
						'relation' => 'AND',
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[edd-header-cart-icon-style]',
							'operator' => '==',
							'value'    => 'outline',
						),
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[edd-header-cart-icon]',
							'operator' => '!=',
							'value'    => 'default',
						),
					),
					'title'       => __( 'Border Width', 'astra-addon' ),
					'suffix'      => 'px',
					'control'     => 'ast-slider',
					'priority'    => 46,
					'divider'     => array( 'ast_class' => 'ast-top-section-divider' ),
					'input_attrs' => array(
						'min'  => 0,
						'step' => 1,
						'max'  => 20,
					),
				),
			);

			$configurations = array_merge( $configurations, $_configs );

			$_configs = array(
				/**
				 * Option: Divider
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[edd-header-cart-icon-divider]',
					'section'  => $_section,
					'title'    => __( 'Header Cart Icon', 'astra-addon' ),
					'type'     => 'control',
					'control'  => 'ast-heading',
					'priority' => 30,
					'settings' => array(),
					'context'  => astra_addon_builder_helper()->general_tab,
				),
				/**
				 * Option: Icon Style
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[edd-header-cart-icon-style]',
					'default'   => astra_get_option( 'edd-header-cart-icon-style' ),
					'type'      => 'control',
					'transport' => 'postMessage',
					'section'   => $_section,
					'title'     => __( 'Style', 'astra-addon' ),
					'control'   => 'select',
					'priority'  => 40,
					'choices'   => array(
						'none'    => __( 'None', 'astra-addon' ),
						'outline' => __( 'Outline', 'astra-addon' ),
						'fill'    => __( 'Fill', 'astra-addon' ),
					),
					'context'   => $context,
				),
				/**
				 * Option: Background color
				 */
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[edd-header-cart-icon-color]',
					'default'           => astra_get_option( 'edd-header-cart-icon-color' ),
					'type'              => 'control',
					'control'           => 'ast-color',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
					'title'             => __( 'Color', 'astra-addon' ),
					'transport'         => 'postMessage',
					'section'           => $_section,
					'priority'          => 45,
					'context'           => array(
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[edd-header-cart-icon-style]',
							'operator' => '!=',
							'value'    => 'none',
						),
						astra_addon_builder_helper()->design_tab,
					),
				),

				/**
				 * Option: Background color
				 */
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[edd-header-cart-icon-color]',
					'default'           => astra_get_option( 'edd-header-cart-icon-color' ),
					'type'              => 'control',
					'control'           => 'ast-color',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
					'title'             => __( 'Color', 'astra-addon' ),
					'transport'         => 'postMessage',
					'section'           => $_section,
					'priority'          => 45,
					'context'           => array(
						$context,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[edd-header-cart-icon-style]',
							'operator' => '!=',
							'value'    => 'none',
						),
					),
				),

				/**
				 * Option: Border Radius
				 */
				array(
					'name'        => ASTRA_THEME_SETTINGS . '[edd-header-cart-icon-radius]',
					'default'     => astra_get_option( 'edd-header-cart-icon-radius' ),
					'type'        => 'control',
					'transport'   => 'postMessage',
					'section'     => $_section,
					'title'       => __( 'Border Radius', 'astra-addon' ),
					'control'     => 'ast-slider',
					'priority'    => 47,
					'input_attrs' => array(
						'min'  => 0,
						'step' => 1,
						'max'  => 200,
					),
					'suffix'      => 'px',
					'context'     => array(
						$context,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[edd-header-cart-icon-style]',
							'operator' => '!=',
							'value'    => 'none',
						),
					),
				),

				/**
				 * Option: Header cart total
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[edd-header-cart-total-display]',
					'default'  => astra_get_option( 'edd-header-cart-total-display' ),
					'type'     => 'control',
					'section'  => $_section,
					'title'    => __( 'Display Cart Totals', 'astra-addon' ),
					'priority' => 50,
					'control'  => Astra_Theme_Extension::$switch_control,
					'context'  => astra_addon_builder_helper()->general_tab,
				),

				/**
				 * Option: Cart Title
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[edd-header-cart-title-display]',
					'default'  => astra_get_option( 'edd-header-cart-title-display' ),
					'type'     => 'control',
					'section'  => $_section,
					'title'    => __( 'Display Cart Title', 'astra-addon' ),
					'priority' => 55,
					'control'  => Astra_Theme_Extension::$switch_control,
					'context'  => astra_addon_builder_helper()->general_tab,
				),
			);

			if ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) {
				$_configs = array(
					/**
					 * EDD Cart section
					 */
					array(
						'name'     => $_section,
						'type'     => 'section',
						'priority' => 5,
						'title'    => __( 'EDD Cart', 'astra-addon' ),
						'panel'    => 'panel-header-builder-group',
					),

				);
			}

			$configurations = array_merge( $configurations, $_configs );

			return $configurations;

		}
	}
}


new Astra_Edd_General_Configs();
