<?php
/**
 * Astra Theme Customizer Configuration Builder.
 *
 * @package     astra-builder
 * @link        https://wpastra.com/
 * @since       3.0.0
 */

// No direct access, please.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Bail if Customizer config divider base class is already present.
if ( class_exists( 'Astra_Divider_Component_Configs' ) ) {
	return;
}

/**
 * Register Builder Customizer Configurations.
 *
 * @since 3.0.0
 */
// @codingStandardsIgnoreStart
class Astra_Divider_Component_Configs {
 // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedClassFound
	// @codingStandardsIgnoreEnd

	/**
	 * Register Builder Customizer Configurations.
	 *
	 * @param Array  $configurations Configurations.
	 * @param string $builder_type Builder Type.
	 * @param string $section Section.
	 *
	 * @since 3.0.0
	 * @return Array Astra Customizer Configurations with updated configurations.
	 */
	public static function register_configuration( $configurations, $builder_type = 'header', $section = 'section-hb-divider-' ) {

		$divider_config = array();

		if ( 'footer' === $builder_type ) {
			$class_obj           = Astra_Addon_Builder_Footer::get_instance();
			$number_of_divider   = astra_addon_builder_helper()->num_of_footer_divider;
			$divider_size_layout = 'horizontal';
		} else {
			$class_obj           = Astra_Addon_Builder_Header::get_instance();
			$number_of_divider   = astra_addon_builder_helper()->num_of_header_divider;
			$divider_size_layout = 'vertical';
		}

		$component_limit = astra_addon_builder_helper()->component_limit;
		for ( $index = 1; $index <= $component_limit; $index++ ) {

			$_section = $section . $index;

			/**
			 * These options are related to Header Section - divider.
			 * Prefix hs represents - Header Section.
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

				/*
				* Header Builder section - divider Component Configs.
				*/
				array(
					'name'        => $_section,
					'type'        => 'section',
					'priority'    => 50,
					/* translators: %s Index */
					'title'       => 1 === $number_of_divider ? __( 'Divider', 'astra-addon' ) : sprintf( __( 'Divider %s', 'astra-addon' ), $index ),
					'panel'       => 'panel-' . $builder_type . '-builder-group',
					'clone_index' => $index,
					'clone_type'  => $builder_type . '-divider',
				),

				/**
				 * Option: Position
				 */
				array(
					'name'       => ASTRA_THEME_SETTINGS . '[' . $builder_type . '-divider-' . $index . '-layout]',
					'default'    => astra_get_option( $builder_type . '-divider-' . $index . '-layout' ),
					'type'       => 'control',
					'control'    => Astra_Theme_Extension::$selector_control,
					'section'    => $_section,
					'priority'   => 30,
					'title'      => __( 'Layout', 'astra-addon' ),
					'choices'    => array(
						'horizontal' => __( 'Horizontal', 'astra-addon' ),
						'vertical'   => __( 'Vertical', 'astra-addon' ),
					),
					'transport'  => 'postMessage',
					'partial'    => array(
						'selector'        => '.ast-' . $builder_type . '-divider-' . $index,
						'render_callback' => array( $class_obj, $builder_type . '_divider_' . $index ),
					),
					'responsive' => false,
					'renderAs'   => 'text',
					'divider'    => array( 'ast_class' => 'ast-section-spacing' ),
				),

				// Vertical divider notice.
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[' . $builder_type . '-divider-' . $index . '-description]',
					'type'     => 'control',
					'control'  => 'ast-description',
					'section'  => $_section,
					'priority' => 30,
					'label'    => '',
					/* translators: %1$s builder type param */
					'help'     => sprintf( __( 'If the Divider don\'t seem to be visible please check if elements are added in the current %1$s row.', 'astra-addon' ), $builder_type ),
					'context'  => array(
						astra_addon_builder_helper()->general_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[' . $builder_type . '-divider-' . $index . '-layout]',
							'operator' => '==',
							'value'    => 'vertical',
						),
					),
				),

				/**
				 * Option:  Divider Style
				 */
				array(
					'name'       => ASTRA_THEME_SETTINGS . '[' . $builder_type . '-divider-' . $index . '-style]',
					'default'    => astra_get_option( $builder_type . '-divider-' . $index . '-style' ),
					'type'       => 'control',
					'control'    => Astra_Theme_Extension::$selector_control,
					'section'    => $_section,
					'priority'   => 30,
					'title'      => __( 'Style', 'astra-addon' ),
					'choices'    => array(
						'solid'  => __( 'Solid', 'astra-addon' ),
						'dashed' => __( 'Dashed', 'astra-addon' ),
						'dotted' => __( 'Dotted', 'astra-addon' ),
						'double' => __( 'Double', 'astra-addon' ),
					),
					'transport'  => 'postMessage',
					'responsive' => false,
					'renderAs'   => 'text',
					'divider'    => array( 'ast_class' => 'ast-top-section-divider' ),
				),

				// Section: Above Footer Border.
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[' . $builder_type . '-divider-' . $index . '-thickness]',
					'section'           => $_section,
					'priority'          => 40,
					'transport'         => 'postMessage',
					'default'           => astra_get_option( $builder_type . '-divider-' . $index . '-thickness' ),
					'title'             => __( 'Thickness', 'astra-addon' ),
					'type'              => 'control',
					'control'           => 'ast-responsive-slider',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_responsive_slider' ),
					'input_attrs'       => array(
						'min'  => 0,
						'step' => 1,
						'max'  => 60,
					),
					'divider'           => array( 'ast_class' => 'ast-bottom-section-divider' ),
					'suffix'            => 'px',
					'context'           => astra_addon_builder_helper()->design_tab,
				),

				// Section: Above Footer Border.
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[' . $builder_type . '-divider-' . $index . '-size]',
					'section'           => $_section,
					'priority'          => 40,
					'transport'         => 'postMessage',
					'default'           => astra_get_option( $builder_type . '-divider-' . $index . '-size' ),
					'title'             => __( 'Size', 'astra-addon' ),
					'type'              => 'control',
					'control'           => 'ast-responsive-slider',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_responsive_slider' ),
					'input_attrs'       => array(
						'min'  => 0,
						'step' => 1,
						'max'  => 100,
					),
					'suffix'            => '%',
					'context'           => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[' . $builder_type . '-divider-' . $index . '-layout]',
							'operator' => '==',
							'value'    => $divider_size_layout,
						),
					),
				),

				/**
				 * Option: divider Color.
				 */
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[' . $builder_type . '-divider-' . $index . '-color]',
					'default'           => astra_get_option( $builder_type . '-divider-' . $index . '-color' ),
					'type'              => 'control',
					'section'           => $_section,
					'priority'          => 8,
					'transport'         => 'postMessage',
					'control'           => 'ast-color',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_alpha_color' ),
					'title'             => __( 'Color', 'astra-addon' ),
					'context'           => astra_addon_builder_helper()->design_tab,
					'divider'           => array( 'ast_class' => 'ast-section-spacing ast-bottom-section-divider' ),
				),

				/**
				 * Option: Divider
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[' . $_section . '-margin-divider]',
					'section'  => $_section,
					'title'    => __( 'Spacing', 'astra-addon' ),
					'type'     => 'control',
					'control'  => 'ast-heading',
					'priority' => 99,
					'settings' => array(),
					'context'  => astra_addon_builder_helper()->design_tab,
					'divider'  => array( 'ast_class' => 'ast-section-spacing' ),
				),

				/**
				 * Option: Margin Space
				 */
				array(
					'name'              => ASTRA_THEME_SETTINGS . '[' . $_section . '-margin]',
					'default'           => astra_get_option( $_section . '-margin' ),
					'type'              => 'control',
					'control'           => 'ast-responsive-spacing',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_responsive_spacing' ),
					'section'           => $_section,
					'transport'         => 'postMessage',
					'priority'          => 99,
					'title'             => __( 'Margin', 'astra-addon' ),
					'linked_choices'    => true,
					'unit_choices'      => array( 'px', 'em', '%' ),
					'choices'           => array(
						'top'    => __( 'Top', 'astra-addon' ),
						'right'  => __( 'Right', 'astra-addon' ),
						'bottom' => __( 'Bottom', 'astra-addon' ),
						'left'   => __( 'Left', 'astra-addon' ),
					),
					'context'           => astra_addon_builder_helper()->design_tab,
					'divider'           => array( 'ast_class' => 'ast-section-spacing' ),
				),

			);

			if ( 'footer' === $builder_type ) {
				$_configs[] = array(
					'name'       => ASTRA_THEME_SETTINGS . '[footer-divider-' . $index . '-alignment]',
					'default'    => astra_get_option( 'footer-divider-' . $index . '-alignment' ),
					'type'       => 'control',
					'control'    => Astra_Theme_Extension::$selector_control,
					'section'    => $_section,
					'priority'   => 35,
					'title'      => __( 'Alignment', 'astra-addon' ),
					'choices'    => array(
						'flex-start' => __( 'Left', 'astra-addon' ),
						'center'     => __( 'Center', 'astra-addon' ),
						'flex-end'   => __( 'Right', 'astra-addon' ),
					),
					'transport'  => 'postMessage',
					'responsive' => true,
					'renderAs'   => 'text',
					'divider'    => array( 'ast_class' => 'ast-top-section-divider' ),
				);

				// Footer vertical divider size.
				$_configs[] = array(
					'name'              => ASTRA_THEME_SETTINGS . '[footer-vertical-divider-' . $index . '-size]',
					'section'           => $_section,
					'priority'          => 40,
					'transport'         => 'postMessage',
					'default'           => astra_get_option( 'footer-vertical-divider-' . $index . '-size' ),
					'title'             => __( 'Size', 'astra-addon' ),
					'type'              => 'control',
					'control'           => 'ast-responsive-slider',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_responsive_slider' ),
					'input_attrs'       => array(
						'min'  => 0,
						'step' => 1,
						'max'  => 1000,
					),
					'suffix'            => 'px',
					'context'           => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[' . $builder_type . '-divider-' . $index . '-layout]',
							'operator' => '==',
							'value'    => 'vertical',
						),
					),
				);
			}

			if ( 'header' === $builder_type ) {

				// Header horizontal divider size.
				$_configs[] = array(
					'name'              => ASTRA_THEME_SETTINGS . '[header-horizontal-divider-' . $index . '-size]',
					'section'           => $_section,
					'priority'          => 40,
					'transport'         => 'postMessage',
					'default'           => astra_get_option( 'header-horizontal-divider-' . $index . '-size' ),
					'title'             => __( 'Size', 'astra-addon' ),
					'type'              => 'control',
					'control'           => 'ast-responsive-slider',
					'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_responsive_slider' ),
					'input_attrs'       => array(
						'min'  => 0,
						'step' => 1,
						'max'  => 1000,
					),
					'suffix'            => 'px',
					'context'           => array(
						astra_addon_builder_helper()->design_tab_config,
						array(
							'setting'  => ASTRA_THEME_SETTINGS . '[' . $builder_type . '-divider-' . $index . '-layout]',
							'operator' => '==',
							'value'    => 'horizontal',
						),
					),
				);
			}

			if ( class_exists( 'Astra_Builder_Base_Configuration' ) && method_exists( 'Astra_Builder_Base_Configuration', 'prepare_visibility_tab' ) ) {
				$divider_config[] = Astra_Builder_Base_Configuration::prepare_visibility_tab( $_section, $builder_type );
			}

			$divider_config[] = $_configs;
		}

		$divider_config = call_user_func_array( 'array_merge', $divider_config + array( array() ) );
		return array_merge( $configurations, $divider_config );
	}
}

/**
 * Kicking this off by creating object of this class.
 */

new Astra_Divider_Component_Configs();
