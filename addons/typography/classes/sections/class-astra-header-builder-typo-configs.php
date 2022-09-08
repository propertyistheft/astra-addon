<?php
/**
 * [Primary Menu] options for astra theme.
 *
 * @package     Astra Addon
 * @author      Brainstorm Force
 * @copyright   Copyright (c) 2020, Brainstorm Force
 * @link        https://www.brainstormforce.com
 * @since       3.0.0
 */

// Block direct access to the file.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Bail if Customizer config base class does not exist.
if ( ! class_exists( 'Astra_Customizer_Config_Base' ) ) {
	return;
}

if ( ! class_exists( 'Astra_Header_Builder_Typo_Configs' ) ) {

	/**
	 * Register below header Configurations.
	 */
	// @codingStandardsIgnoreStart
	class Astra_Header_Builder_Typo_Configs extends Astra_Customizer_Config_Base {
 // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedClassFound
		// @codingStandardsIgnoreEnd

		/**
		 * Get the configs for the typos.
		 *
		 * @param string $_section section id.
		 * @param string $parent sub control parent.
		 * @return array
		 */
		private function get_typo_configs( $_section, $parent ) {

			return array(

				/**
				 * Option: Font Weight
				 */
				array(
					'name'      => 'font-weight-' . $_section,
					'control'   => 'ast-font',
					'parent'    => $parent,
					'section'   => $_section,
					'font_type' => 'ast-font-weight',
					'type'      => 'sub-control',
					'default'   => astra_get_option( 'font-weight-' . $_section ),
					'title'     => __( 'Weight', 'astra-addon' ),
					'priority'  => 14,
					'connect'   => 'font-family-' . $_section,
				),

				/**
				 * Option: Font Family
				 */
				array(
					'name'      => 'font-family-' . $_section,
					'type'      => 'sub-control',
					'parent'    => $parent,
					'section'   => $_section,
					'control'   => 'ast-font',
					'font_type' => 'ast-font-family',
					'default'   => astra_get_option( 'font-family-' . $_section ),
					'title'     => __( 'Family', 'astra-addon' ),
					'priority'  => 13,
					'connect'   => 'font-weight-' . $_section,
				),

				/**
				 * Option: Line Height.
				 */
				array(
					'name'              => 'line-height-' . $_section,
					'type'              => 'sub-control',
					'parent'            => $parent,
					'section'           => $_section,
					'default'           => astra_get_option( 'line-height-' . $_section ),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_number_n_blank' ),
					'title'             => __( 'Line Height', 'astra-addon' ),
					'transport'         => 'postMessage',
					'control'           => 'ast-slider',
					'priority'          => 17,
					'suffix'            => 'em',
					'input_attrs'       => array(
						'min'  => 1,
						'step' => 0.01,
						'max'  => 5,
					),
				),

				/**
				 * Option: Text Transform
				 */
				array(
					'name'      => 'text-transform-' . $_section,
					'type'      => 'sub-control',
					'parent'    => $parent,
					'section'   => $_section,
					'title'     => __( 'Text Transform', 'astra-addon' ),
					'transport' => 'postMessage',
					'default'   => astra_get_option( 'text-transform-' . $_section ),
					'control'   => 'ast-select',
					'priority'  => 16,
					'choices'   => array(
						''           => __( 'Inherit', 'astra-addon' ),
						'none'       => __( 'None', 'astra-addon' ),
						'capitalize' => __( 'Capitalize', 'astra-addon' ),
						'uppercase'  => __( 'Uppercase', 'astra-addon' ),
						'lowercase'  => __( 'Lowercase', 'astra-addon' ),
					),
				),
			);
		}


		/**
		 * Get the configs for the typos by builder.
		 *
		 * @param string $_section section id.
		 * @param string $_prefix sub control.
		 * @return array
		 */
		private function get_typo_configs_by_builder_type( $_section, $_prefix ) {
			return array(

				/**
				 * Option: Primary Header Button Font Family
				 */
				array(
					'name'      => $_prefix . '-font-family',
					'default'   => astra_get_option( $_prefix . '-font-family' ),
					'parent'    => ASTRA_THEME_SETTINGS . '[' . $_prefix . '-text-typography]',
					'type'      => 'sub-control',
					'section'   => $_section,
					'control'   => 'ast-font',
					'font_type' => 'ast-font-family',
					'title'     => __( 'Family', 'astra-addon' ),
					'context'   => astra_addon_builder_helper()->general_tab,
					'connect'   => $_prefix . '-font-weight',
					'priority'  => 1,
				),

				/**
				 * Option: Primary Footer Button Font Weight
				 */
				array(
					'name'              => $_prefix . '-font-weight',
					'default'           => astra_get_option( $_prefix . '-font-weight' ),
					'parent'            => ASTRA_THEME_SETTINGS . '[' . $_prefix . '-text-typography]',
					'type'              => 'sub-control',
					'section'           => $_section,
					'control'           => 'ast-font',
					'font_type'         => 'ast-font-weight',
					'title'             => __( 'Weight', 'astra-addon' ),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_font_weight' ),
					'connect'           => $_prefix . '-font-family',
					'priority'          => 3,
					'context'           => astra_addon_builder_helper()->general_tab,
				),

				/**
				 * Option: Primary Footer Button Text Transform
				 */
				array(
					'name'      => $_prefix . '-text-transform',
					'default'   => astra_get_option( $_prefix . '-text-transform' ),
					'parent'    => ASTRA_THEME_SETTINGS . '[' . $_prefix . '-text-typography]',
					'transport' => 'postMessage',
					'title'     => __( 'Text Transform', 'astra-addon' ),
					'type'      => 'sub-control',
					'section'   => $_section,
					'control'   => 'ast-select',
					'priority'  => 3,
					'context'   => astra_addon_builder_helper()->general_tab,
					'choices'   => array(
						''           => __( 'Inherit', 'astra-addon' ),
						'none'       => __( 'None', 'astra-addon' ),
						'capitalize' => __( 'Capitalize', 'astra-addon' ),
						'uppercase'  => __( 'Uppercase', 'astra-addon' ),
						'lowercase'  => __( 'Lowercase', 'astra-addon' ),
					),
				),

				/**
				 * Option: Primary Footer Button Line Height
				 */
				array(
					'name'              => $_prefix . '-line-height',
					'default'           => astra_get_option( $_prefix . '-line-height' ),
					'parent'            => ASTRA_THEME_SETTINGS . '[' . $_prefix . '-text-typography]',
					'control'           => 'ast-slider',
					'transport'         => 'postMessage',
					'type'              => 'sub-control',
					'section'           => $_section,
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_number_n_blank' ),
					'title'             => __( 'Line Height', 'astra-addon' ),
					'suffix'            => 'em',
					'context'           => astra_addon_builder_helper()->general_tab,
					'priority'          => 4,
					'input_attrs'       => array(
						'min'  => 1,
						'step' => 0.01,
						'max'  => 5,
					),
				),

				/**
				 * Option: Primary Footer Button Letter Spacing
				 */
				array(
					'name'              => $_prefix . '-letter-spacing',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_number_n_blank' ),
					'parent'            => ASTRA_THEME_SETTINGS . '[' . $_prefix . '-text-typography]',
					'control'           => 'ast-slider',
					'transport'         => 'postMessage',
					'type'              => 'sub-control',
					'default'           => astra_get_option( $_prefix . '-letter-spacing' ),
					'section'           => $_section,
					'title'             => __( 'Letter Spacing', 'astra-addon' ),
					'suffix'            => 'px',
					'priority'          => 5,
					'context'           => astra_addon_builder_helper()->general_tab,
					'input_attrs'       => array(
						'min'  => 1,
						'step' => 1,
						'max'  => 100,
					),
				),
			);
		}


		/**
		 * Get the widget configs for the typos by builder.
		 *
		 * @param string $_section section id.
		 * @param string $_prefix sub control.
		 * @return array
		 */
		private function get_widget_typo_configs_by_builder_type( $_section, $_prefix ) {

			return array(

				/**
				 * Option: Header Widget Titles Font Family
				 */
				array(
					'name'      => $_prefix . '-font-family',
					'default'   => astra_get_option( $_prefix . '-font-family' ),
					'parent'    => ASTRA_THEME_SETTINGS . '[' . $_prefix . '-text-typography]',
					'type'      => 'sub-control',
					'section'   => $_section,
					'control'   => 'ast-font',
					'font_type' => 'ast-font-family',
					'title'     => __( 'Family', 'astra-addon' ),
					'context'   => astra_addon_builder_helper()->general_tab,
					'connect'   => ASTRA_THEME_SETTINGS . '[' . $_prefix . '-font-weight]',
					'priority'  => 1,
				),

				/**
				 * Option: Header Widget Title Font Weight
				 */
				array(
					'name'              => $_prefix . '-font-weight',
					'default'           => astra_get_option( $_prefix . '-font-weight' ),
					'parent'            => ASTRA_THEME_SETTINGS . '[' . $_prefix . '-text-typography]',
					'type'              => 'sub-control',
					'section'           => $_section,
					'control'           => 'ast-font',
					'font_type'         => 'ast-font-weight',
					'title'             => __( 'Weight', 'astra-addon' ),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_font_weight' ),
					'connect'           => $_prefix . '-font-family',
					'priority'          => 3,
					'context'           => astra_addon_builder_helper()->general_tab,
				),

				/**
				 * Option: Header Widget Title Text Transform
				 */
				array(
					'name'      => $_prefix . '-text-transform',
					'default'   => astra_get_option( $_prefix . '-text-transform' ),
					'parent'    => ASTRA_THEME_SETTINGS . '[' . $_prefix . '-text-typography]',
					'transport' => 'postMessage',
					'title'     => __( 'Text Transform', 'astra-addon' ),
					'type'      => 'sub-control',
					'section'   => $_section,
					'control'   => 'ast-select',
					'priority'  => 3,
					'context'   => astra_addon_builder_helper()->general_tab,
					'choices'   => array(
						''           => __( 'Inherit', 'astra-addon' ),
						'none'       => __( 'None', 'astra-addon' ),
						'capitalize' => __( 'Capitalize', 'astra-addon' ),
						'uppercase'  => __( 'Uppercase', 'astra-addon' ),
						'lowercase'  => __( 'Lowercase', 'astra-addon' ),
					),
				),

				/**
				 * Option: Header Widget Title Line Height
				 */
				array(
					'name'              => $_prefix . '-line-height',
					'default'           => astra_get_option( $_prefix . '-line-height' ),
					'parent'            => ASTRA_THEME_SETTINGS . '[' . $_prefix . '-text-typography]',
					'control'           => 'ast-slider',
					'transport'         => 'postMessage',
					'type'              => 'sub-control',
					'section'           => $_section,
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_number_n_blank' ),
					'title'             => __( 'Line Height', 'astra-addon' ),
					'suffix'            => 'em',
					'context'           => astra_addon_builder_helper()->general_tab,
					'priority'          => 4,
					'input_attrs'       => array(
						'min'  => 1,
						'step' => 0.01,
						'max'  => 5,
					),
				),

				/**
				 * Option: Header Widget Title Letter Spacing
				 */
				array(
					'name'              => $_prefix . '-letter-spacing',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_number_n_blank' ),
					'parent'            => ASTRA_THEME_SETTINGS . '[' . $_prefix . '-text-typography]',
					'control'           => 'ast-slider',
					'transport'         => 'postMessage',
					'type'              => 'sub-control',
					'default'           => astra_get_option( $_prefix . '-letter-spacing' ),
					'section'           => $_section,
					'title'             => __( 'Letter Spacing', 'astra-addon' ),
					'suffix'            => 'px',
					'priority'          => 5,
					'context'           => astra_addon_builder_helper()->general_tab,
					'input_attrs'       => array(
						'min'  => 1,
						'step' => 1,
						'max'  => 100,
					),
				),

				/**
				 * Option: Header Widget Content Font Family
				 */
				array(
					'name'      => $_prefix . '-content-font-family',
					'default'   => astra_get_option( $_prefix . '-content-font-family' ),
					'parent'    => ASTRA_THEME_SETTINGS . '[' . $_prefix . '-content-typography]',
					'type'      => 'sub-control',
					'section'   => $_section,
					'control'   => 'ast-font',
					'font_type' => 'ast-font-family',
					'title'     => __( 'Family', 'astra-addon' ),
					'context'   => astra_addon_builder_helper()->general_tab,
					'connect'   => ASTRA_THEME_SETTINGS . '[' . $_prefix . '-content-font-weight]',
					'priority'  => 1,
				),

				/**
				 * Option: Header Widget Content Font Weight
				 */
				array(
					'name'              => $_prefix . '-content-font-weight',
					'default'           => astra_get_option( $_prefix . '-content-font-weight' ),
					'parent'            => ASTRA_THEME_SETTINGS . '[' . $_prefix . '-content-typography]',
					'type'              => 'sub-control',
					'section'           => $_section,
					'control'           => 'ast-font',
					'font_type'         => 'ast-font-weight',
					'title'             => __( 'Weight', 'astra-addon' ),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_font_weight' ),
					'connect'           => $_prefix . '-content-font-family',
					'priority'          => 3,
					'context'           => astra_addon_builder_helper()->general_tab,
				),

				/**
				 * Option: Header Widget Content Text Transform
				 */
				array(
					'name'      => $_prefix . '-content-transform',
					'default'   => astra_get_option( $_prefix . '-content-transform' ),
					'parent'    => ASTRA_THEME_SETTINGS . '[' . $_prefix . '-content-typography]',
					'transport' => 'postMessage',
					'title'     => __( 'Text Transform', 'astra-addon' ),
					'type'      => 'sub-control',
					'section'   => $_section,
					'control'   => 'ast-select',
					'priority'  => 3,
					'context'   => astra_addon_builder_helper()->general_tab,
					'choices'   => array(
						''           => __( 'Inherit', 'astra-addon' ),
						'none'       => __( 'None', 'astra-addon' ),
						'capitalize' => __( 'Capitalize', 'astra-addon' ),
						'uppercase'  => __( 'Uppercase', 'astra-addon' ),
						'lowercase'  => __( 'Lowercase', 'astra-addon' ),
					),
				),

				/**
				 * Option: Header Widget Content Line Height
				 */
				array(
					'name'              => $_prefix . '-content-line-height',
					'default'           => astra_get_option( $_prefix . '-content-line-height' ),
					'parent'            => ASTRA_THEME_SETTINGS . '[' . $_prefix . '-content-typography]',
					'control'           => 'ast-slider',
					'transport'         => 'postMessage',
					'type'              => 'sub-control',
					'section'           => $_section,
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_number_n_blank' ),
					'title'             => __( 'Line Height', 'astra-addon' ),
					'suffix'            => 'em',
					'context'           => astra_addon_builder_helper()->general_tab,
					'priority'          => 4,
					'input_attrs'       => array(
						'min'  => 1,
						'step' => 0.01,
						'max'  => 5,
					),
				),

				/**
				 * Option: Header Widget Content Letter Spacing
				 */
				array(
					'name'              => $_prefix . '-content-letter-spacing',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_number_n_blank' ),
					'parent'            => ASTRA_THEME_SETTINGS . '[' . $_prefix . '-content-typography]',
					'control'           => 'ast-slider',
					'transport'         => 'postMessage',
					'type'              => 'sub-control',
					'default'           => astra_get_option( $_prefix . '-content-letter-spacing' ),
					'section'           => $_section,
					'title'             => __( 'Letter Spacing', 'astra-addon' ),
					'suffix'            => 'px',
					'priority'          => 5,
					'context'           => astra_addon_builder_helper()->general_tab,
					'input_attrs'       => array(
						'min'  => 1,
						'step' => 1,
						'max'  => 100,
					),
				),
			);
		}

		/**
		 * Register Primary Menu typography Customizer Configurations.
		 *
		 * @param Array                $configurations Astra Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 3.0.0
		 * @return Array Astra Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			/**
			 * Header - HTML - Typography
			 */

			$html_config                    = array();
			$astra_has_widgets_block_editor = astra_addon_has_widgets_block_editor();

			$component_limit = astra_addon_builder_helper()->component_limit;
			for ( $index = 1; $index <= $component_limit; $index++ ) {

				$html_config[] = $this->get_typo_configs( 'section-hb-html-' . $index, ASTRA_THEME_SETTINGS . '[section-hb-html-' . $index . '-typography]' );
				$html_config[] = $this->get_typo_configs( 'section-fb-html-' . $index, ASTRA_THEME_SETTINGS . '[section-fb-html-' . $index . '-typography]' );

				$html_config[] = $this->get_typo_configs( 'section-hb-social-icons-' . $index, ASTRA_THEME_SETTINGS . '[section-hb-social-icons-' . $index . '-typography]' );
				$html_config[] = $this->get_typo_configs( 'section-fb-social-icons-' . $index, ASTRA_THEME_SETTINGS . '[section-fb-social-icons-' . $index . '-typography]' );

				$header_section = ( ! $astra_has_widgets_block_editor ) ? 'sidebar-widgets-header-widget-' . $index : 'astra-sidebar-widgets-header-widget-' . $index;
				$footer_section = ( ! $astra_has_widgets_block_editor ) ? 'sidebar-widgets-footer-widget-' . $index : 'astra-sidebar-widgets-footer-widget-' . $index;
				$html_config[]  = $this->get_widget_typo_configs_by_builder_type( $header_section, 'header-widget-' . $index );
				$html_config[]  = $this->get_widget_typo_configs_by_builder_type( $footer_section, 'footer-widget-' . $index );
			}

			/**
			 * Header - Mobile Trigger
			 */

			$_section = 'section-header-mobile-trigger';

			$html_config[] = array(

				// Option: Trigger Font Family.
				array(
					'name'      => 'mobile-header-label-font-family',
					'default'   => astra_get_option( 'mobile-header-label-font-family' ),
					'parent'    => ASTRA_THEME_SETTINGS . '[mobile-header-label-typography]',
					'type'      => 'sub-control',
					'section'   => $_section,
					'transport' => 'postMessage',
					'control'   => 'ast-font',
					'font_type' => 'ast-font-family',
					'title'     => __( 'Family', 'astra-addon' ),
					'priority'  => 22,
					'connect'   => 'mobile-header-label-font-weight',
					'context'   => astra_addon_builder_helper()->design_tab,
				),

				// Option: Trigger Font Weight.
				array(
					'name'              => 'mobile-header-label-font-weight',
					'default'           => astra_get_option( 'mobile-header-label-font-weight' ),
					'parent'            => ASTRA_THEME_SETTINGS . '[mobile-header-label-typography]',
					'section'           => $_section,
					'type'              => 'sub-control',
					'control'           => 'ast-font',
					'transport'         => 'postMessage',
					'font_type'         => 'ast-font-weight',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_font_weight' ),
					'title'             => __( 'Weight', 'astra-addon' ),
					'priority'          => 24,
					'connect'           => 'mobile-header-label-font-family',
					'context'           => astra_addon_builder_helper()->design_tab,
				),

				// Option: Trigger Text Transform.
				array(
					'name'      => 'mobile-header-label-text-transform',
					'default'   => astra_get_option( 'mobile-header-label-text-transform' ),
					'parent'    => ASTRA_THEME_SETTINGS . '[mobile-header-label-typography]',
					'section'   => $_section,
					'type'      => 'sub-control',
					'control'   => 'ast-select',
					'transport' => 'postMessage',
					'title'     => __( 'Text Transform', 'astra-addon' ),
					'priority'  => 25,
					'choices'   => array(
						''           => __( 'Inherit', 'astra-addon' ),
						'none'       => __( 'None', 'astra-addon' ),
						'capitalize' => __( 'Capitalize', 'astra-addon' ),
						'uppercase'  => __( 'Uppercase', 'astra-addon' ),
						'lowercase'  => __( 'Lowercase', 'astra-addon' ),
					),
					'context'   => astra_addon_builder_helper()->design_tab,
				),

				// Option: Trigger Line Height.
				array(
					'name'              => 'mobile-header-label-line-height',
					'parent'            => ASTRA_THEME_SETTINGS . '[mobile-header-label-typography]',
					'section'           => $_section,
					'type'              => 'sub-control',
					'priority'          => 26,
					'title'             => __( 'Line Height', 'astra-addon' ),
					'transport'         => 'postMessage',
					'default'           => astra_get_option( 'mobile-header-label-line-height' ),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_number_n_blank' ),
					'control'           => 'ast-slider',
					'suffix'            => 'em',
					'input_attrs'       => array(
						'min'  => 1,
						'step' => 0.01,
						'max'  => 10,
					),
					'context'           => astra_addon_builder_helper()->design_tab,
				),
			);

			/**
			 * Footer - Copyright - Typography
			 */
			$_section = 'section-footer-copyright';
			$parent   = ASTRA_THEME_SETTINGS . '[' . $_section . '-typography]';

			$html_config[] = array(

				/**
				 * Option: Font Weight
				 */
				array(
					'name'      => 'font-weight-' . $_section,
					'control'   => 'ast-font',
					'parent'    => $parent,
					'section'   => $_section,
					'font_type' => 'ast-font-weight',
					'type'      => 'sub-control',
					'default'   => astra_get_option( 'font-weight-' . $_section ),
					'title'     => __( 'Weight', 'astra-addon' ),
					'priority'  => 14,
					'connect'   => 'font-family-' . $_section,
				),

				/**
				 * Option: Font Family
				 */
				array(
					'name'      => 'font-family-' . $_section,
					'type'      => 'sub-control',
					'parent'    => $parent,
					'section'   => $_section,
					'control'   => 'ast-font',
					'font_type' => 'ast-font-family',
					'default'   => astra_get_option( 'font-family-' . $_section ),
					'title'     => __( 'Family', 'astra-addon' ),
					'priority'  => 13,
					'connect'   => 'font-weight-' . $_section,
				),

				/**
				 * Option: Line Height.
				 */
				array(
					'name'              => 'line-height-' . $_section,
					'type'              => 'sub-control',
					'parent'            => $parent,
					'section'           => $_section,
					'default'           => astra_get_option( 'line-height-' . $_section ),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_number_n_blank' ),
					'title'             => __( 'Line Height', 'astra-addon' ),
					'transport'         => 'postMessage',
					'control'           => 'ast-slider',
					'priority'          => 17,
					'suffix'            => 'em',
					'input_attrs'       => array(
						'min'  => 1,
						'step' => 0.01,
						'max'  => 5,
					),
				),

				/**
				 * Option: Text Transform
				 */
				array(
					'name'      => 'text-transform-' . $_section,
					'type'      => 'sub-control',
					'parent'    => $parent,
					'section'   => $_section,
					'title'     => __( 'Text Transform', 'astra-addon' ),
					'transport' => 'postMessage',
					'default'   => astra_get_option( 'text-transform-' . $_section ),
					'control'   => 'ast-select',
					'priority'  => 16,
					'choices'   => array(
						''           => __( 'Inherit', 'astra-addon' ),
						'none'       => __( 'None', 'astra-addon' ),
						'capitalize' => __( 'Capitalize', 'astra-addon' ),
						'uppercase'  => __( 'Uppercase', 'astra-addon' ),
						'lowercase'  => __( 'Lowercase', 'astra-addon' ),
					),
				),
			);

			/**
			 * Header - Account - Typography
			 */
			$_section = 'section-header-account';
			$parent   = ASTRA_THEME_SETTINGS . '[' . $_section . '-typography]';

			$html_config[] = $this->get_typo_configs( $_section, $parent );

			$html_config[] = array(

				// Option Group: Menu Typography.
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[' . $_section . '-menu-typography]',
					'default'   => astra_get_option( $_section . '-menu-typography' ),
					'type'      => 'control',
					'control'   => 'ast-settings-group',
					'title'     => __( 'Menu Font', 'astra-addon' ),
					'section'   => $_section,
					'transport' => 'postMessage',
					'priority'  => 22,
					'context'   => array(
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[header-account-action-type]',
							'operator' => '==',
							'value'    => 'menu',
						),
						astra_addon_builder_helper()->design_tab_config,
					),
				),

				// Option: Menu Font Family.
				array(
					'name'      => $_section . '-menu-font-family',
					'default'   => astra_get_option( $_section . '-menu-font-family' ),
					'parent'    => ASTRA_THEME_SETTINGS . '[' . $_section . '-menu-typography]',
					'type'      => 'sub-control',
					'section'   => $_section,
					'transport' => 'postMessage',
					'control'   => 'ast-font',
					'font_type' => 'ast-font-family',
					'title'     => __( 'Family', 'astra-addon' ),
					'priority'  => 22,
					'connect'   => $_section . '-menu-font-weight',
					'context'   => astra_addon_builder_helper()->general_tab,
				),

				// Option: Menu Font Weight.
				array(
					'name'              => $_section . '-menu-font-weight',
					'default'           => astra_get_option( $_section . '-menu-font-weight' ),
					'parent'            => ASTRA_THEME_SETTINGS . '[' . $_section . '-menu-typography]',
					'section'           => $_section,
					'type'              => 'sub-control',
					'control'           => 'ast-font',
					'transport'         => 'postMessage',
					'font_type'         => 'ast-font-weight',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_font_weight' ),
					'title'             => __( 'Weight', 'astra-addon' ),
					'priority'          => 24,
					'connect'           => $_section . '-menu-font-family',
					'context'           => astra_addon_builder_helper()->general_tab,
				),

				// Option: Menu Text Transform.
				array(
					'name'      => $_section . '-menu-text-transform',
					'default'   => astra_get_option( $_section . '-menu-text-transform' ),
					'parent'    => ASTRA_THEME_SETTINGS . '[' . $_section . '-menu-typography]',
					'section'   => $_section,
					'type'      => 'sub-control',
					'control'   => 'ast-select',
					'transport' => 'postMessage',
					'title'     => __( 'Text Transform', 'astra-addon' ),
					'priority'  => 25,
					'choices'   => array(
						''           => __( 'Inherit', 'astra-addon' ),
						'none'       => __( 'None', 'astra-addon' ),
						'capitalize' => __( 'Capitalize', 'astra-addon' ),
						'uppercase'  => __( 'Uppercase', 'astra-addon' ),
						'lowercase'  => __( 'Lowercase', 'astra-addon' ),
					),
					'context'   => astra_addon_builder_helper()->general_tab,
				),

				// Option: Menu Font Size.
				array(
					'name'        => $_section . '-menu-font-size',
					'default'     => astra_get_option( $_section . '-menu-font-size' ),
					'parent'      => ASTRA_THEME_SETTINGS . '[' . $_section . '-menu-typography]',
					'section'     => $_section,
					'type'        => 'sub-control',
					'priority'    => 23,
					'title'       => __( 'Size', 'astra-addon' ),
					'control'     => 'ast-responsive',
					'transport'   => 'postMessage',
					'input_attrs' => array(
						'min' => 0,
					),
					'units'       => array(
						'px' => 'px',
						'em' => 'em',
					),
					'context'     => astra_addon_builder_helper()->general_tab,
				),

				// Option: Menu Line Height.
				array(
					'name'              => $_section . '-menu-line-height',
					'parent'            => ASTRA_THEME_SETTINGS . '[' . $_section . '-menu-typography]',
					'section'           => $_section,
					'type'              => 'sub-control',
					'priority'          => 26,
					'title'             => __( 'Line Height', 'astra-addon' ),
					'transport'         => 'postMessage',
					'default'           => 'em',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_number_n_blank' ),
					'control'           => 'ast-slider',
					'suffix'            => 'em',
					'input_attrs'       => array(
						'min'  => 1,
						'step' => 0.01,
						'max'  => 10,
					),
					'context'           => astra_addon_builder_helper()->general_tab,
				),

				/**
				 * Option:  Logged Out Popup text Typography
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[' . $_section . '-popup-typography]',
					'default'   => astra_get_option( $_section . '-popup-typography' ),
					'type'      => 'control',
					'control'   => 'ast-settings-group',
					'title'     => __( 'Login Popup Font', 'astra-addon' ),
					'section'   => $_section,
					'transport' => 'postMessage',
					'context'   => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[header-account-logout-action]',
							'operator' => '==',
							'value'    => 'login',
						),
					),
					'priority'  => 22,
				),

				// Option: Menu Font Size.
				array(
					'name'        => $_section . '-popup-font-size',
					'default'     => astra_get_option( $_section . '-popup-font-size' ),
					'parent'      => ASTRA_THEME_SETTINGS . '[' . $_section . '-popup-typography]',
					'section'     => $_section,
					'type'        => 'sub-control',
					'control'     => 'ast-responsive',
					'priority'    => 1,
					'title'       => __( 'Label / Input Text Size', 'astra-addon' ),
					'transport'   => 'postMessage',
					'input_attrs' => array(
						'min' => 0,
					),
					'units'       => array(
						'px' => 'px',
						'em' => 'em',
					),
					'context'     => astra_addon_builder_helper()->general_tab,
				),

				// Option: Menu Font Size.
				array(
					'name'        => $_section . '-popup-button-font-size',
					'default'     => astra_get_option( $_section . '-popup-button-font-size' ),
					'parent'      => ASTRA_THEME_SETTINGS . '[' . $_section . '-popup-typography]',
					'section'     => $_section,
					'type'        => 'sub-control',
					'control'     => 'ast-responsive',
					'priority'    => 2,
					'title'       => __( 'Button Font Size', 'astra-addon' ),
					'transport'   => 'postMessage',
					'input_attrs' => array(
						'min' => 0,
					),
					'units'       => array(
						'px' => 'px',
						'em' => 'em',
					),
					'context'     => astra_addon_builder_helper()->general_tab,
				),
			);

			/**
			 * Header - language-switcher - Typography
			 */
			$hb_lswitcher_section = 'section-hb-language-switcher';

			$parent = ASTRA_THEME_SETTINGS . '[' . $hb_lswitcher_section . '-typography]';

			$html_config[] = array(

				array(
					'name'      => $parent,
					'default'   => astra_get_option( $hb_lswitcher_section . '-typography' ),
					'type'      => 'control',
					'control'   => 'ast-settings-group',
					'title'     => __( 'Typography', 'astra-addon' ),
					'section'   => $hb_lswitcher_section,
					'transport' => 'postMessage',
					'priority'  => 23,
					'divider'   => array( 'ast_class' => 'ast-top-section-divider' ),
					'context'   => array(
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[header-language-switcher-show-name]',
							'operator' => '==',
							'value'    => true,
						),
						astra_addon_builder_helper()->design_tab_config,
					),
				),

				/**
				 * Option: Font Family
				 */
				array(
					'name'      => 'font-family-' . $hb_lswitcher_section,
					'type'      => 'sub-control',
					'parent'    => $parent,
					'section'   => $hb_lswitcher_section,
					'control'   => 'ast-font',
					'font_type' => 'ast-font-family',
					'default'   => astra_get_option( 'font-family-' . $hb_lswitcher_section ),
					'title'     => __( 'Family', 'astra-addon' ),
					'priority'  => 13,
					'connect'   => 'font-weight-' . $hb_lswitcher_section,
				),

				/**
				 * Option: Font Weight
				 */
				array(
					'name'      => 'font-weight-' . $hb_lswitcher_section,
					'control'   => 'ast-font',
					'parent'    => $parent,
					'section'   => $hb_lswitcher_section,
					'font_type' => 'ast-font-weight',
					'type'      => 'sub-control',
					'default'   => astra_get_option( 'font-weight-' . $hb_lswitcher_section ),
					'title'     => __( 'Weight', 'astra-addon' ),
					'priority'  => 15,
					'connect'   => 'font-family-' . $hb_lswitcher_section,
				),

				/**
				* Option: Font Size
				*/
				array(
					'name'              => 'font-size-' . $hb_lswitcher_section,
					'type'              => 'sub-control',
					'parent'            => $parent,
					'section'           => $hb_lswitcher_section,
					'control'           => 'ast-responsive-slider',
					'default'           => astra_get_option( 'font-size-' . $hb_lswitcher_section ),
					'transport'         => 'postMessage',
					'priority'          => 14,
					'title'             => __( 'Size', 'astra-addon' ),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_responsive_slider' ),
					'suffix'            => array( 'px', 'em' ),
					'input_attrs'       => array(
						'px' => array(
							'min'  => 0,
							'step' => 1,
							'max'  => 100,
						),
						'em' => array(
							'min'  => 0,
							'step' => 0.01,
							'max'  => 20,
						),
					),
				),

				/**
				 * Option: Line Height.
				 */
				array(
					'name'              => 'line-height-' . $hb_lswitcher_section,
					'type'              => 'sub-control',
					'parent'            => $parent,
					'section'           => $hb_lswitcher_section,
					'default'           => astra_get_option( 'line-height-' . $hb_lswitcher_section ),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_number_n_blank' ),
					'title'             => __( 'Line Height', 'astra-addon' ),
					'transport'         => 'postMessage',
					'control'           => 'ast-slider',
					'priority'          => 17,
					'suffix'            => 'em',
					'input_attrs'       => array(
						'min'  => 1,
						'step' => 0.01,
						'max'  => 5,
					),
				),

				/**
				 * Option: Text Transform
				 */
				array(
					'name'      => 'text-transform-' . $hb_lswitcher_section,
					'type'      => 'sub-control',
					'parent'    => $parent,
					'section'   => $hb_lswitcher_section,
					'title'     => __( 'Text Transform', 'astra-addon' ),
					'transport' => 'postMessage',
					'default'   => astra_get_option( 'text-transform-' . $hb_lswitcher_section ),
					'control'   => 'ast-select',
					'priority'  => 16,
					'choices'   => array(
						''           => __( 'Inherit', 'astra-addon' ),
						'none'       => __( 'None', 'astra-addon' ),
						'capitalize' => __( 'Capitalize', 'astra-addon' ),
						'uppercase'  => __( 'Uppercase', 'astra-addon' ),
						'lowercase'  => __( 'Lowercase', 'astra-addon' ),
					),
				),

			);

			/**
			 * Footer - language-switcher - Typography
			 */
			$fb_lswitcher_section = 'section-fb-language-switcher';

			$parent = ASTRA_THEME_SETTINGS . '[' . $fb_lswitcher_section . '-typography]';

			$html_config[] = array(

				array(
					'name'      => $parent,
					'default'   => astra_get_option( $fb_lswitcher_section . '-typography' ),
					'type'      => 'control',
					'control'   => 'ast-settings-group',
					'title'     => __( 'Typography', 'astra-addon' ),
					'section'   => $fb_lswitcher_section,
					'transport' => 'postMessage',
					'priority'  => 2,
					'context'   => array(
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[footer-language-switcher-show-name]',
							'operator' => '==',
							'value'    => true,
						),
						astra_addon_builder_helper()->design_tab_config,
					),
					'divider'   => array( 'ast_class' => 'ast-bottom-section-divider' ),
				),

				/**
				 * Option: Font Family
				 */
				array(
					'name'      => 'font-family-' . $fb_lswitcher_section,
					'type'      => 'sub-control',
					'parent'    => $parent,
					'section'   => $fb_lswitcher_section,
					'control'   => 'ast-font',
					'font_type' => 'ast-font-family',
					'default'   => astra_get_option( 'font-family-' . $fb_lswitcher_section ),
					'title'     => __( 'Family', 'astra-addon' ),
					'priority'  => 13,
					'connect'   => 'font-weight-' . $fb_lswitcher_section,
				),

				/**
				 * Option: Font Weight
				 */
				array(
					'name'      => 'font-weight-' . $fb_lswitcher_section,
					'control'   => 'ast-font',
					'parent'    => $parent,
					'section'   => $fb_lswitcher_section,
					'font_type' => 'ast-font-weight',
					'type'      => 'sub-control',
					'default'   => astra_get_option( 'font-weight-' . $fb_lswitcher_section ),
					'title'     => __( 'Weight', 'astra-addon' ),
					'priority'  => 15,
					'connect'   => 'font-family-' . $fb_lswitcher_section,
				),

				/**
				* Option: Font Size
				*/

				array(
					'name'              => 'font-size-' . $fb_lswitcher_section,
					'type'              => 'sub-control',
					'parent'            => $parent,
					'section'           => $fb_lswitcher_section,
					'control'           => 'ast-responsive-slider',
					'default'           => astra_get_option( 'font-size-' . $fb_lswitcher_section ),
					'transport'         => 'postMessage',
					'priority'          => 14,
					'title'             => __( 'Size', 'astra-addon' ),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_responsive_slider' ),
					'suffix'            => array( 'px', 'em' ),
					'input_attrs'       => array(
						'px' => array(
							'min'  => 0,
							'step' => 1,
							'max'  => 100,
						),
						'em' => array(
							'min'  => 0,
							'step' => 0.01,
							'max'  => 20,
						),
					),
				),
				/**
				 * Option: Line Height.
				 */
				array(
					'name'              => 'line-height-' . $fb_lswitcher_section,
					'type'              => 'sub-control',
					'parent'            => $parent,
					'section'           => $fb_lswitcher_section,
					'default'           => astra_get_option( 'line-height-' . $fb_lswitcher_section ),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_number_n_blank' ),
					'title'             => __( 'Line Height', 'astra-addon' ),
					'transport'         => 'postMessage',
					'control'           => 'ast-slider',
					'priority'          => 17,
					'suffix'            => 'em',
					'input_attrs'       => array(
						'min'  => 1,
						'step' => 0.01,
						'max'  => 5,
					),
				),

				/**
				 * Option: Text Transform
				 */
				array(
					'name'      => 'text-transform-' . $fb_lswitcher_section,
					'type'      => 'sub-control',
					'parent'    => $parent,
					'section'   => $fb_lswitcher_section,
					'title'     => __( 'Text Transform', 'astra-addon' ),
					'transport' => 'postMessage',
					'default'   => astra_get_option( 'text-transform-' . $fb_lswitcher_section ),
					'control'   => 'ast-select',
					'priority'  => 16,
					'choices'   => array(
						''           => __( 'Inherit', 'astra-addon' ),
						'none'       => __( 'None', 'astra-addon' ),
						'capitalize' => __( 'Capitalize', 'astra-addon' ),
						'uppercase'  => __( 'Uppercase', 'astra-addon' ),
						'lowercase'  => __( 'Lowercase', 'astra-addon' ),
					),
				),
			);

			$html_config    = call_user_func_array( 'array_merge', $html_config + array( array() ) );
			$configurations = array_merge( $configurations, $html_config );

			return $configurations;
		}
	}
}

new Astra_Header_Builder_Typo_Configs();
