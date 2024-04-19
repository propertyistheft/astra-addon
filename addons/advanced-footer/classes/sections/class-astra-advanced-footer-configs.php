<?php
/**
 * Advanced Footer Options for our theme.
 *
 * @package     Astra Addon
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

if ( ! class_exists( 'Astra_Advanced_Footer_Configs' ) ) {

	/**
	 * Register Advanced Footer Customizer Configurations.
	 */
	// @codingStandardsIgnoreStart
	class Astra_Advanced_Footer_Configs extends Astra_Customizer_Config_Base {
		// @codingStandardsIgnoreEnd

		/**
		 * Register Advanced Footer Customizer Configurations.
		 *
		 * @param Array                $configurations Astra Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array Astra Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_config = array(
				/**
				 * Option: Footer Widgets Layout
				 */
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[footer-adv]',
					'default'           => astra_get_option( 'footer-adv' ),
					'type'              => 'control',
					'priority'          => 0,
					'control'           => 'ast-radio-image',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_choices' ),
					'title'             => __( 'Layout', 'astra-addon' ),
					'section'           => 'section-footer-adv',
					'choices'           => array(
						'disabled' => array(
							'label' => __( 'Disable', 'astra-addon' ),
							'path'  => ( class_exists( 'Astra_Builder_UI_Controller' ) ) ? Astra_Builder_UI_Controller::fetch_svg_icon( 'disabled', false ) : '',
						),
						'layout-1' => array(
							'label' => __( 'Layout 1', 'astra-addon' ),
							'path'  => ( class_exists( 'Astra_Builder_UI_Controller' ) ) ? Astra_Builder_UI_Controller::fetch_svg_icon( 'footer-adv-layout-1', false ) : '',
						),
						'layout-2' => array(
							'label' => __( 'Layout 2', 'astra-addon' ),
							'path'  => ( class_exists( 'Astra_Builder_UI_Controller' ) ) ? Astra_Builder_UI_Controller::fetch_svg_icon( 'footer-adv-layout-2', false ) : '',
						),
						'layout-3' => array(
							'label' => __( 'Layout 3', 'astra-addon' ),
							'path'  => ( class_exists( 'Astra_Builder_UI_Controller' ) ) ? Astra_Builder_UI_Controller::fetch_svg_icon( 'footer-adv-layout-3', false ) : '',
						),
						'layout-4' => array(
							'label' => __( 'Layout 4', 'astra-addon' ),
							'path'  => ( class_exists( 'Astra_Builder_UI_Controller' ) ) ? Astra_Builder_UI_Controller::fetch_svg_icon( 'footer-layout-4', false ) : '',
						),
						'layout-5' => array(
							'label' => __( 'Layout 5', 'astra-addon' ),
							'path'  => ( class_exists( 'Astra_Builder_UI_Controller' ) ) ? Astra_Builder_UI_Controller::fetch_svg_icon( 'footer-adv-layout-5', false ) : '',
						),
						'layout-6' => array(
							'label' => __( 'Layout 6', 'astra-addon' ),
							'path'  => ( class_exists( 'Astra_Builder_UI_Controller' ) ) ? Astra_Builder_UI_Controller::fetch_svg_icon( 'footer-adv-layout-6', false ) : '',
						),
						'layout-7' => array(
							'label' => __( 'Layout 7', 'astra-addon' ),
							'path'  => ( class_exists( 'Astra_Builder_UI_Controller' ) ) ? Astra_Builder_UI_Controller::fetch_svg_icon( 'footer-adv-layout-7', false ) : '',
						),
					),
				),

				/**
				 * Option: Footer Widgets Width
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[footer-adv-layout-width]',
					'default'  => astra_get_option( 'footer-adv-layout-width' ),
					'type'     => 'control',
					'priority' => 1,
					'control'  => 'ast-select',
					'divider'  => array( 'ast_class' => 'ast-bottom-divider' ),
					'section'  => 'section-footer-adv',
					'title'    => __( 'Width', 'astra-addon' ),
					'choices'  => array(
						'full'    => __( 'Full Width', 'astra-addon' ),
						'content' => __( 'Content Width', 'astra-addon' ),
					),
					'context'  => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[footer-adv]',
							'operator' => '!=',
							'value'    => 'disabled',
						),
					),
					'divider'  => array( 'ast_class' => 'ast-top-divider' ),
				),

				/**
				 * Footer Widgets Padding
				 *
				 * @since 1.2.0 Updated to support responsive spacing param
				 */
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[footer-adv-area-padding]',
					'default'           => astra_get_option( 'footer-adv-area-padding' ),
					'type'              => 'control',
					'transport'         => 'postMessage',
					'divider'           => array( 'ast_class' => 'ast-bottom-divider' ),
					'priority'          => 2,
					'control'           => 'ast-responsive-spacing',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_responsive_spacing' ),
					'section'           => 'section-footer-adv',
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
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[footer-adv]',
							'operator' => '!=',
							'value'    => 'disabled',
						),
					),
				),
			);

			return array_merge( $configurations, $_config );
		}

	}
}

new Astra_Advanced_Footer_Configs();
