<?php
/**
 * [Primary Menu] options for astra theme.
 *
 * @package     Astra Addon
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
		 * Get the customizer defaults for font-extras control.
		 *
		 * @param string $font_extras_key Font extras key.
		 * @param string $line_height_key Line height key.
		 * @param string $text_transform_key Text transform key.
		 * @return array
		 *
		 * @since 4.0.0
		 */
		private function get_font_extras_default( $font_extras_key, $line_height_key, $text_transform_key ) {
			$astra_options = astra_get_options();

			return array(
				'line-height'         => ! isset( $astra_options[ $font_extras_key ] ) && isset( $astra_options[ $line_height_key ] ) ? $astra_options[ $line_height_key ] : '',
				'line-height-unit'    => 'em',
				'letter-spacing'      => '',
				'letter-spacing-unit' => 'px',
				'text-transform'      => ! isset( $astra_options[ $font_extras_key ] ) && isset( $astra_options[ $text_transform_key ] ) ? $astra_options[ $text_transform_key ] : '',
				'text-decoration'     => '',
			);
		}

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
					'default'   => astra_get_option( 'font-weight-' . $_section, 'inherit' ),
					'title'     => __( 'Font Weight', 'astra-addon' ),
					'priority'  => 14,
					'connect'   => 'font-family-' . $_section,
					'divider'   => array( 'ast_class' => 'ast-sub-bottom-dotted-divider' ),
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
					'default'   => astra_get_option( 'font-family-' . $_section, 'inherit' ),
					'title'     => __( 'Font Family', 'astra-addon' ),
					'priority'  => 13,
					'connect'   => 'font-weight-' . $_section,
					'divider'   => array( 'ast_class' => 'ast-sub-bottom-dotted-divider' ),
				),

				/**
				 * Option: Font Extras
				 */
				array(
					'name'     => 'font-extras-' . $_section,
					'parent'   => $parent,
					'section'  => $_section,
					'type'     => 'sub-control',
					'control'  => 'ast-font-extras',
					'priority' => 17,
					'default'  => astra_get_option( 'font-extras-' . $_section, $this->get_font_extras_default( 'font-extras-' . $_section, 'line-height-' . $_section, 'text-transform-' . $_section ) ),
					'title'    => __( 'Font Extras', 'astra-addon' ),
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
					'title'     => __( 'Font Family', 'astra-addon' ),
					'context'   => astra_addon_builder_helper()->general_tab,
					'connect'   => ASTRA_THEME_SETTINGS . '[' . $_prefix . '-font-weight]',
					'priority'  => 1,
					'divider'   => array( 'ast_class' => 'ast-sub-bottom-dotted-divider' ),
				),

				/**
				 * Option: Header Widget Title Font Weight
				 */
				array(
					'name'              => $_prefix . '-font-weight',
					'default'           => astra_get_option( $_prefix . '-font-weight', 'inherit' ),
					'parent'            => ASTRA_THEME_SETTINGS . '[' . $_prefix . '-text-typography]',
					'type'              => 'sub-control',
					'section'           => $_section,
					'control'           => 'ast-font',
					'font_type'         => 'ast-font-weight',
					'title'             => __( 'Font Weight', 'astra-addon' ),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_font_weight' ),
					'connect'           => $_prefix . '-font-family',
					'priority'          => 1,
					'context'           => astra_addon_builder_helper()->general_tab,
					'divider'           => array( 'ast_class' => 'ast-sub-bottom-dotted-divider' ),
				),

				/**
				 * Option: Header widget title font extras
				 */
				array(
					'name'     => $_prefix . '-font-extras',
					'default'  => astra_get_option( $_prefix . '-font-extras', $this->get_font_extras_default( $_prefix . '-font-extras', $_prefix . '-line-height', $_prefix . '-text-transform' ) ),
					'parent'   => ASTRA_THEME_SETTINGS . '[' . $_prefix . '-text-typography]',
					'type'     => 'sub-control',
					'section'  => $_section,
					'control'  => 'ast-font-extras',
					'priority' => 4,
					'title'    => __( 'Font Extras', 'astra-addon' ),
					'context'  => astra_addon_builder_helper()->general_tab,
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
					'title'     => __( 'Font Family', 'astra-addon' ),
					'context'   => astra_addon_builder_helper()->general_tab,
					'connect'   => ASTRA_THEME_SETTINGS . '[' . $_prefix . '-content-font-weight]',
					'priority'  => 1,
					'divider'   => array( 'ast_class' => 'ast-sub-bottom-dotted-divider' ),
				),

				/**
				 * Option: Header Widget Content Font Weight
				 */
				array(
					'name'              => $_prefix . '-content-font-weight',
					'default'           => astra_get_option( $_prefix . '-content-font-weight', 'inherit' ),
					'parent'            => ASTRA_THEME_SETTINGS . '[' . $_prefix . '-content-typography]',
					'type'              => 'sub-control',
					'section'           => $_section,
					'control'           => 'ast-font',
					'font_type'         => 'ast-font-weight',
					'title'             => __( 'Font Weight', 'astra-addon' ),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_font_weight' ),
					'connect'           => $_prefix . '-content-font-family',
					'priority'          => 1,
					'context'           => astra_addon_builder_helper()->general_tab,
					'divider'           => array( 'ast_class' => 'ast-sub-bottom-dotted-divider' ),
				),

				/**
				 * Option: Header widget content font extras
				 */
				array(
					'name'     => $_prefix . '-content-font-extras',
					'default'  => astra_get_option( $_prefix . '-content-font-extras', $this->get_font_extras_default( $_prefix . '-content-font-extras', $_prefix . '-content-line-height', $_prefix . '-content-text-transform' ) ),
					'parent'   => ASTRA_THEME_SETTINGS . '[' . $_prefix . '-content-typography]',
					'type'     => 'sub-control',
					'section'  => $_section,
					'control'  => 'ast-font-extras',
					'priority' => 4,
					'title'    => __( 'Content Font Extras', 'astra-addon' ),
					'context'  => astra_addon_builder_helper()->general_tab,
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

				$header_section = ! $astra_has_widgets_block_editor ? 'sidebar-widgets-header-widget-' . $index : 'astra-sidebar-widgets-header-widget-' . $index;
				$footer_section = ! $astra_has_widgets_block_editor ? 'sidebar-widgets-footer-widget-' . $index : 'astra-sidebar-widgets-footer-widget-' . $index;
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
					'title'     => __( 'Font Family', 'astra-addon' ),
					'priority'  => 22,
					'connect'   => 'mobile-header-label-font-weight',
					'context'   => astra_addon_builder_helper()->design_tab,
				),

				// Option: Trigger Font Weight.
				array(
					'name'              => 'mobile-header-label-font-weight',
					'default'           => astra_get_option( 'mobile-header-label-font-weight', 'inherit' ),
					'parent'            => ASTRA_THEME_SETTINGS . '[mobile-header-label-typography]',
					'section'           => $_section,
					'type'              => 'sub-control',
					'control'           => 'ast-font',
					'transport'         => 'postMessage',
					'font_type'         => 'ast-font-weight',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_font_weight' ),
					'title'             => __( 'Font Weight', 'astra-addon' ),
					'priority'          => 24,
					'connect'           => 'mobile-header-label-font-family',
					'context'           => astra_addon_builder_helper()->design_tab,
				),

				/**
				 * Option: Font extras
				 */
				array(
					'name'     => 'mobile-header-label-font-extras',
					'default'  => astra_get_option( 'mobile-header-label-font-extras', $this->get_font_extras_default( 'mobile-header-label-font-extras', 'mobile-header-label-line-height', 'mobile-header-label-text-transform' ) ),
					'parent'   => ASTRA_THEME_SETTINGS . '[mobile-header-label-typography]',
					'type'     => 'sub-control',
					'section'  => $_section,
					'control'  => 'ast-font-extras',
					'priority' => 25,
					'title'    => __( 'Font Extras', 'astra-addon' ),
					'context'  => astra_addon_builder_helper()->design_tab,
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
					'default'   => astra_get_option( 'font-weight-' . $_section, 'inherit' ),
					'title'     => __( 'Font Weight', 'astra-addon' ),
					'priority'  => 14,
					'connect'   => 'font-family-' . $_section,
					'divider'   => array( 'ast_class' => 'ast-sub-bottom-dotted-divider' ),
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
					'title'     => __( 'Font Family', 'astra-addon' ),
					'priority'  => 13,
					'connect'   => 'font-weight-' . $_section,
					'divider'   => array( 'ast_class' => 'ast-sub-bottom-dotted-divider' ),
				),

				/**
				 * Option: Font Extras
				 */
				array(
					'name'     => 'font-extras-' . $_section,
					'type'     => 'sub-control',
					'parent'   => $parent,
					'control'  => 'ast-font-extras',
					'section'  => $_section,
					'priority' => 17,
					'default'  => astra_get_option( 'font-extras-' . $_section, $this->get_font_extras_default( 'font-extras-' . $_section, 'line-height-' . $_section, 'text-transform-' . $_section ) ),
					'title'    => __( 'Font Extras', 'astra-addon' ),
				),
			);

			/**
			 * Header - Account - Typography
			 */
			$_section = 'section-header-account';
			$parent   = ASTRA_THEME_SETTINGS . '[' . $_section . '-typography]';

			$html_config[] = $this->get_typo_configs( $_section, $parent );

			$html_config[] = array(

				// Font heading.
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[' . $_section . '-font-label]',
					'type'     => 'control',
					'control'  => 'ast-heading',
					'section'  => $_section,
					'title'    => __( 'Font', 'astra-addon' ),
					'priority' => 21,
					'settings' => array(),
					'context'  => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[header-account-logout-action]',
							'operator' => '==',
							'value'    => 'login',
						),
					),
					'divider'  => array(),
				),

				// Option Group: Menu Typography.
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[' . $_section . '-menu-typography]',
					'default'   => astra_get_option( $_section . '-menu-typography' ),
					'type'      => 'control',
					'control'   => 'ast-settings-group',
					'title'     => __( 'Menu Font', 'astra-addon' ),
					'section'   => $_section,
					'transport' => 'postMessage',
					'divider'   => array( 'ast_class' => 'ast-bottom-spacing' ),
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
					'title'     => __( 'Font Family', 'astra-addon' ),
					'divider'   => array( 'ast_class' => 'ast-sub-bottom-dotted-divider' ),
					'priority'  => 22,
					'connect'   => $_section . '-menu-font-weight',
					'context'   => astra_addon_builder_helper()->general_tab,
				),

				// Option: Menu Font Weight.
				array(
					'name'              => $_section . '-menu-font-weight',
					'default'           => astra_get_option( $_section . '-menu-font-weight', 'inherit' ),
					'parent'            => ASTRA_THEME_SETTINGS . '[' . $_section . '-menu-typography]',
					'section'           => $_section,
					'type'              => 'sub-control',
					'control'           => 'ast-font',
					'transport'         => 'postMessage',
					'font_type'         => 'ast-font-weight',
					'divider'           => array( 'ast_class' => 'ast-sub-bottom-dotted-divider' ),
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_font_weight' ),
					'title'             => __( 'Font Weight', 'astra-addon' ),
					'priority'          => 22,
					'connect'           => $_section . '-menu-font-family',
					'context'           => astra_addon_builder_helper()->general_tab,
				),

				// Option: Menu Font Size.
				array(
					'name'        => $_section . '-menu-font-size',
					'default'     => astra_get_option( $_section . '-menu-font-size' ),
					'parent'      => ASTRA_THEME_SETTINGS . '[' . $_section . '-menu-typography]',
					'section'     => $_section,
					'type'        => 'sub-control',
					'priority'    => 23,
					'title'       => __( 'Font Size', 'astra-addon' ),
					'transport'   => 'postMessage',
					'control'     => 'ast-responsive-slider',
					'suffix'      => array( 'px', 'em', 'vw', 'rem' ),
					'input_attrs' => array(
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
					'context'     => astra_addon_builder_helper()->general_tab,
				),

				/**
				 * Option: Font extras
				 */
				array(
					'name'     => $_section . '-menu-font-extras',
					'default'  => astra_get_option( $_section . '-menu-font-extras', $this->get_font_extras_default( $_section . '-menu-font-extras', $_section . '-menu-line-height', $_section . '-menu-text-transform' ) ),
					'parent'   => ASTRA_THEME_SETTINGS . '[' . $_section . '-menu-typography]',
					'type'     => 'sub-control',
					'section'  => $_section,
					'control'  => 'ast-font-extras',
					'priority' => 25,
					'title'    => __( 'Font Extras', 'astra-addon' ),
					'context'  => astra_addon_builder_helper()->general_tab,
				),

				/**
				 * Option:  Logged Out Popup text Typography
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[' . $_section . '-popup-typography]',
					'default'   => astra_get_option( $_section . '-popup-typography' ),
					'type'      => 'control',
					'control'   => 'ast-settings-group',
					'title'     => __( 'Login Popup Font Size', 'astra-addon' ),
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

				// Option: Login Popup Label / Input Font Size.
				array(
					'name'        => $_section . '-popup-font-size',
					'default'     => astra_get_option( $_section . '-popup-font-size' ),
					'parent'      => ASTRA_THEME_SETTINGS . '[' . $_section . '-popup-typography]',
					'section'     => $_section,
					'type'        => 'sub-control',
					'priority'    => 1,
					'title'       => __( 'Label / Input ', 'astra-addon' ),
					'transport'   => 'postMessage',
					'control'     => 'ast-responsive-slider',
					'suffix'      => array( 'px', 'em', 'vw', 'rem' ),
					'input_attrs' => array(
						'px'  => array(
							'min'  => 0,
							'step' => 1,
							'max'  => 100,
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
					'context'     => astra_addon_builder_helper()->general_tab,
				),

				// Option: Login Popup Button Font Size.
				array(
					'name'        => $_section . '-popup-button-font-size',
					'default'     => astra_get_option( $_section . '-popup-button-font-size' ),
					'parent'      => ASTRA_THEME_SETTINGS . '[' . $_section . '-popup-typography]',
					'section'     => $_section,
					'type'        => 'sub-control',
					'priority'    => 2,
					'title'       => __( 'Button', 'astra-addon' ),
					'transport'   => 'postMessage',
					'control'     => 'ast-responsive-slider',
					'suffix'      => array( 'px', 'em', 'vw', 'rem' ),
					'input_attrs' => array(
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
					'title'     => __( 'Font Family', 'astra-addon' ),
					'priority'  => 13,
					'connect'   => 'font-weight-' . $hb_lswitcher_section,
					'divider'   => array( 'ast_class' => 'ast-sub-bottom-dotted-divider' ),
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
					'default'   => astra_get_option( 'font-weight-' . $hb_lswitcher_section, 'inherit' ),
					'title'     => __( 'Font Weight', 'astra-addon' ),
					'priority'  => 14,
					'connect'   => 'font-family-' . $hb_lswitcher_section,
					'divider'   => array( 'ast_class' => 'ast-sub-bottom-dotted-divider' ),
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
					'priority'          => 15,
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
				 * Option: Font Extras
				 */
				array(
					'name'     => 'font-extras-' . $hb_lswitcher_section,
					'parent'   => $parent,
					'section'  => $hb_lswitcher_section,
					'type'     => 'sub-control',
					'control'  => 'ast-font-extras',
					'priority' => 15,
					'default'  => astra_get_option( 'font-extras-' . $hb_lswitcher_section, $this->get_font_extras_default( 'font-extras-' . $hb_lswitcher_section, 'line-height-' . $hb_lswitcher_section, 'text-transform-' . $hb_lswitcher_section ) ),
					'title'    => __( 'Font Extras', 'astra-addon' ),
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
					'title'     => __( 'Font Family', 'astra-addon' ),
					'priority'  => 13,
					'connect'   => 'font-weight-' . $fb_lswitcher_section,
					'divider'   => array( 'ast_class' => 'ast-sub-bottom-dotted-divider' ),
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
					'default'   => astra_get_option( 'font-weight-' . $fb_lswitcher_section, 'inherit' ),
					'title'     => __( 'Font Weight', 'astra-addon' ),
					'priority'  => 14,
					'connect'   => 'font-family-' . $fb_lswitcher_section,
					'divider'   => array( 'ast_class' => 'ast-sub-bottom-dotted-divider' ),
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
					'priority'          => 15,
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
				 * Option: Font Extras
				 */
				array(
					'name'     => 'font-extras-' . $fb_lswitcher_section,
					'parent'   => $parent,
					'section'  => $fb_lswitcher_section,
					'type'     => 'sub-control',
					'control'  => 'ast-font-extras',
					'priority' => 15,
					'default'  => astra_get_option( 'font-extras-' . $fb_lswitcher_section, $this->get_font_extras_default( 'font-extras-' . $fb_lswitcher_section, 'line-height-' . $fb_lswitcher_section, 'text-transform-' . $fb_lswitcher_section ) ),
					'title'    => __( 'Font Extras', 'astra-addon' ),
				),
			);

			$html_config = call_user_func_array( 'array_merge', $html_config + array( array() ) );
			return array_merge( $configurations, $html_config );
		}
	}
}

new Astra_Header_Builder_Typo_Configs();
