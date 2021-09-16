<?php
/**
 * Astra Theme Customizer Configuration Builder.
 *
 * @package     astra-builder
 * @author      Astra
 * @copyright   Copyright (c) 2020, Astra
 * @link        https://wpastra.com/
 * @since       3.1.0
 */

// No direct access, please.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Bail if Customizer config language_switcher base class is already present.
if ( class_exists( 'Astra_Language_Switcher_Component_Configs' ) ) {
	return;
}

/**
 * Register Builder Customizer Configurations.
 *
 * @since 3.1.0
 */
class Astra_Language_Switcher_Component_Configs {

	/**
	 * Register Builder Customizer Configurations.
	 *
	 * @param Array  $configurations Configurations.
	 * @param string $builder_type Builder Type.
	 * @param string $_section Section.
	 *
	 * @since 3.1.0
	 * @return Array Astra Customizer Configurations with updated configurations.
	 */
	public static function register_configuration( $configurations, $builder_type = 'header', $_section = 'section-hb-language-switcher' ) {

		$lang_config = array();

		if ( 'footer' === $builder_type ) {
			$class_obj = Astra_Addon_Builder_Footer::get_instance();
		} else {
			$class_obj = Astra_Addon_Builder_Header::get_instance();
		}

		$language_choices = array(
			'custom' => __( 'Custom', 'astra-addon' ),
		);

		if ( class_exists( 'SitePress' ) ) {
			$language_choices['wpml'] = __( 'WPML', 'astra-addon' );
		}

		$type_context = astra_addon_builder_helper()->general_tab;

		if ( count( $language_choices ) > 1 ) {
			$type_context = array(
				array(
					'setting'  => ASTRA_THEME_SETTINGS . '[' . $builder_type . '-language-switcher-type]',
					'operator' => '==',
					'value'    => 'custom',
				),
				astra_addon_builder_helper()->general_tab_config,
			);
		}

		/**
		 * These options are related to Header Section - language switcher.
		 */
		$_configs = array(

			/**
			 * Option: Header Builder Tabs
			 */
			array(
				'name'        => $_section . '-ast-context-tabs',
				'section'     => $_section,
				'type'        => 'control',
				'control'     => 'ast-builder-header-control',
				'priority'    => 0,
				'description' => '',
			),
			array(
				'name'     => $_section,
				'type'     => 'section',
				'priority' => 1,
				'title'    => __( 'Language Switcher', 'astra-addon' ),
				'panel'    => 'panel-' . $builder_type . '-builder-group',
			),
			array(
				'name'      => ASTRA_THEME_SETTINGS . '[' . $builder_type . '-language-switcher-options]',
				'section'   => $_section,
				'type'      => 'control',
				'control'   => 'ast-language-selector',
				'title'     => __( 'Select Languages', 'astra-addon' ),
				'transport' => 'postMessage',
				'priority'  => 2,
				'default'   => astra_get_option( $builder_type . '-language-switcher-options' ),
				'partial'   => array(
					'selector'        => '.ast-' . $builder_type . '-language-switcher',
					'render_callback' => array( $class_obj, $builder_type . '_language_switcher' ),
				),
				'context'   => $type_context,
			),

			/**
			 * Option: Position
			 */
			array(
				'name'       => ASTRA_THEME_SETTINGS . '[' . $builder_type . '-language-switcher-layout]',
				'default'    => astra_get_option( $builder_type . '-language-switcher-layout' ),
				'type'       => 'control',
				'control'    => Astra_Theme_Extension::$selector_control,
				'section'    => $_section,
				'priority'   => 3,
				'title'      => __( 'Layout', 'astra-addon' ),
				'choices'    => array(
					'horizontal' => __( 'Horizontal', 'astra-addon' ),
					'vertical'   => __( 'Vertical', 'astra-addon' ),
				),
				'transport'  => 'postMessage',
				'partial'    => array(
					'selector'        => '.ast-' . $builder_type . '-language-switcher',
					'render_callback' => array( $class_obj, $builder_type . '_language_switcher' ),
				),
				'context'    => astra_addon_builder_helper()->general_tab,
				'responsive' => false,
				'renderAs'   => 'text',
				'divider'    => array( 'ast_class' => 'ast-bottom-divider ast-top-divider' ),
			),

			array(
				'name'      => ASTRA_THEME_SETTINGS . '[' . $builder_type . '-language-switcher-show-flag]',
				'default'   => astra_get_option( $builder_type . '-language-switcher-show-flag' ),
				'type'      => 'control',
				'control'   => Astra_Theme_Extension::$switch_control,
				'section'   => $_section,
				'priority'  => 3,
				'title'     => __( 'Show Country Flag', 'astra-addon' ),
				'partial'   => array(
					'selector'        => '.ast-' . $builder_type . '-language-switcher',
					'render_callback' => array( $class_obj, $builder_type . '_language_switcher' ),
				),
				'transport' => 'postMessage',
				'context'   => astra_addon_builder_helper()->general_tab,
				'divider'   => array( 'ast_class' => 'ast-bottom-divider' ),
			),

			array(
				'name'      => ASTRA_THEME_SETTINGS . '[' . $builder_type . '-language-switcher-show-name]',
				'default'   => astra_get_option( $builder_type . '-language-switcher-show-name' ),
				'type'      => 'control',
				'control'   => Astra_Theme_Extension::$switch_control,
				'section'   => $_section,
				'priority'  => 3,
				'title'     => __( 'Show Name', 'astra-addon' ),
				'partial'   => array(
					'selector'        => '.ast-' . $builder_type . '-language-switcher',
					'render_callback' => array( $class_obj, $builder_type . '_language_switcher' ),
				),
				'transport' => 'postMessage',
				'context'   => astra_addon_builder_helper()->general_tab,
			),

			array(
				'name'      => ASTRA_THEME_SETTINGS . '[' . $builder_type . '-language-switcher-show-tname]',
				'default'   => astra_get_option( $builder_type . '-language-switcher-show-tname' ),
				'type'      => 'control',
				'control'   => Astra_Theme_Extension::$switch_control,
				'section'   => $_section,
				'priority'  => 3,
				'title'     => __( 'Show Translated Name', 'astra-addon' ),
				'transport' => 'postMessage',
				'partial'   => array(
					'selector'        => '.ast-' . $builder_type . '-language-switcher',
					'render_callback' => array( $class_obj, $builder_type . '_language_switcher' ),
				),
				'context'   => array(
					array(
						'setting'  => ASTRA_THEME_SETTINGS . '[' . $builder_type . '-language-switcher-type]',
						'operator' => '==',
						'value'    => 'wpml',
					),
					astra_addon_builder_helper()->general_tab_config,
				),
			),

			array(
				'name'      => ASTRA_THEME_SETTINGS . '[' . $builder_type . '-language-switcher-show-code]',
				'default'   => astra_get_option( $builder_type . '-language-switcher-show-code' ),
				'type'      => 'control',
				'control'   => Astra_Theme_Extension::$switch_control,
				'section'   => $_section,
				'priority'  => 3,
				'title'     => __( 'Show Language Code', 'astra-addon' ),
				'transport' => 'postMessage',
				'partial'   => array(
					'selector'        => '.ast-' . $builder_type . '-language-switcher',
					'render_callback' => array( $class_obj, $builder_type . '_language_switcher' ),
				),
				'context'   => array(
					array(
						'setting'  => ASTRA_THEME_SETTINGS . '[' . $builder_type . '-language-switcher-type]',
						'operator' => '==',
						'value'    => 'wpml',
					),
					astra_addon_builder_helper()->general_tab_config,
				),
			),

			array(
				'name'        => ASTRA_THEME_SETTINGS . '[' . $_section . '-flag-size]',
				'section'     => $_section,
				'priority'    => 2,
				'transport'   => 'postMessage',
				'default'     => astra_get_option( $_section . '-flag-size' ),
				'title'       => __( 'Flag Size', 'astra-addon' ),
				'type'        => 'control',
				'control'     => 'ast-responsive-slider',
				'input_attrs' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 50,
				),
				'divider'     => array( 'ast_class' => 'ast-bottom-divider' ),
				'suffix'      => 'px',
				'context'     => array(
					array(
						'setting'  => ASTRA_THEME_SETTINGS . '[' . $builder_type . '-language-switcher-show-flag]',
						'operator' => '==',
						'value'    => true,
					),
					astra_addon_builder_helper()->design_tab_config,
				),
			),

			// Section: Above Footer Border.
			array(
				'name'        => ASTRA_THEME_SETTINGS . '[' . $_section . '-flag-spacing]',
				'section'     => $_section,
				'priority'    => 2,
				'transport'   => 'postMessage',
				'default'     => astra_get_option( $_section . '-flag-spacing' ),
				'title'       => __( 'Flag & Text Spacing', 'astra-addon' ),
				'type'        => 'control',
				'suffix'      => 'px',
				'control'     => 'ast-responsive-slider',
				'input_attrs' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 60,
				),
				'divider'     => array( 'ast_class' => 'ast-bottom-divider' ),
				'context'     => array(
					array(
						'setting'  => ASTRA_THEME_SETTINGS . '[' . $builder_type . '-language-switcher-show-name]',
						'operator' => '==',
						'value'    => true,
					),
					astra_addon_builder_helper()->design_tab_config,
				),
			),

		);

		if ( count( $language_choices ) > 1 ) {
			$_configs[] = array(
				'name'      => ASTRA_THEME_SETTINGS . '[' . $builder_type . '-language-switcher-type]',
				'default'   => astra_get_option( $builder_type . '-language-switcher-type' ),
				'type'      => 'control',
				'control'   => 'ast-select',
				'section'   => $_section,
				'priority'  => 1,
				'title'     => __( 'Type', 'astra-addon' ),
				'choices'   => $language_choices,
				'transport' => 'postMessage',
				'partial'   => array(
					'selector'        => '.ast-' . $builder_type . '-language-switcher',
					'render_callback' => array( $class_obj, $builder_type . '_language_switcher' ),
				),
			);
		}

		if ( 'footer' === $builder_type ) {

			$_configs[] = array(
				'name'       => ASTRA_THEME_SETTINGS . '[footer-language-switcher-alignment]',
				'default'    => astra_get_option( 'footer-language-switcher-alignment' ),
				'type'       => 'control',
				'control'    => Astra_Theme_Extension::$selector_control,
				'section'    => $_section,
				'priority'   => 35,
				'title'      => __( 'Alignment', 'astra-addon' ),
				'context'    => astra_addon_builder_helper()->general_tab,
				'divider'    => array( 'ast_class' => 'ast-top-divider' ),
				'transport'  => 'postMessage',
				'responsive' => true,
				'choices'    => array(
					'flex-start' => 'align-left',
					'center'     => 'align-center',
					'flex-end'   => 'align-right',
				),
			);
		}

		if ( is_callable( 'Astra_Builder_Base_Configuration::prepare_visibility_tab' ) ) {
			$lang_config[] = Astra_Builder_Base_Configuration::prepare_visibility_tab( $_section, $builder_type );
		}

		$lang_config[] = $_configs;

		$lang_config    = call_user_func_array( 'array_merge', $lang_config + array( array() ) );
		$configurations = array_merge( $configurations, $lang_config );

		return $configurations;
	}
}

/**
 * Kicking this off by creating object of this class.
 */

new Astra_Language_Switcher_Component_Configs();
