<?php
/**
 * Astra Addon Customizer Configuration Button.
 *
 * @package     astra-builder
 * @link        https://wpastra.com/
 * @since       3.1.0
 */

// No direct access, please.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register Button Customizer Configurations.
 *
 * @since 3.1.0
 */
class Astra_Addon_Button_Component_Configs {
	/**
	 * Register Button Customizer Configurations.
	 *
	 * @param Array  $configurations Configurations.
	 * @param string $builder_type Builder Type.
	 * @param string $section Section.
	 *
	 * @since 3.1.0
	 * @return Array Astra Customizer Configurations with updated configurations.
	 */
	public static function register_configuration( $configurations, $builder_type = 'header', $section = 'section-hb-button-' ) {

		$class_obj = '';

		if ( 'footer' === $builder_type && class_exists( 'Astra_Builder_Footer' ) ) {
			$class_obj = Astra_Builder_Footer::get_instance();
		} elseif ( 'header' === $builder_type && class_exists( 'Astra_Builder_Header' ) ) {
			$class_obj = Astra_Builder_Header::get_instance();
		}

		$html_config = array();

		$component_limit = astra_addon_builder_helper()->component_limit;
		for ( $index = 1; $index <= $component_limit; $index++ ) {

			$_section = $section . $index;
			$_prefix  = 'button' . $index;

			$_configs = array(

				array(
					'name'      => ASTRA_THEME_SETTINGS . '[' . $builder_type . '-' . $_prefix . '-size]',
					'default'   => astra_get_option( $builder_type . '-' . $_prefix . '-size' ),
					'type'      => 'control',
					'control'   => 'ast-select',
					'section'   => $_section,
					'priority'  => 30,
					'title'     => __( 'Size', 'astra-addon' ),
					'choices'   => array(
						'default' => __( 'Inherit', 'astra-addon' ),
						'xs'      => __( 'Extra Small', 'astra-addon' ),
						'sm'      => __( 'Small', 'astra-addon' ),
						'md'      => __( 'Medium', 'astra-addon' ),
						'lg'      => __( 'Large', 'astra-addon' ),
						'xl'      => __( 'Extra Large', 'astra-addon' ),
					),
					'transport' => 'postMessage',
					'context'   => astra_addon_builder_helper()->general_tab,
					'partial'   => array(
						'selector'            => '.ast-' . $builder_type . '-button-' . $index,
						'container_inclusive' => false,
						'render_callback'     => array( $class_obj, 'button_' . $index ),
						'fallback_refresh'    => false,
					),
					'divider'   => array( 'ast_class' => 'ast-top-section-divider' ),
				),

			);

			$html_config[] = Astra_Addon_Base_Configs::prepare_box_shadow_tab( $_section, $builder_type . '-' . $_prefix, 99 );

			$html_config[] = $_configs;
		}

		$html_config = call_user_func_array( 'array_merge', $html_config + array( array() ) );

		return array_merge( $configurations, $html_config );
	}
}

/**
 * Kicking this off by creating object of this class.
 */

new Astra_Addon_Button_Component_Configs();
