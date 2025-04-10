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

/**
 * Register Builder Customizer Configurations.
 *
 * @since 3.0.0
 */
// @codingStandardsIgnoreStart
class Astra_Social_Component_Configs {
 // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedClassFound
	// @codingStandardsIgnoreEnd

	/**
	 * Register Builder Customizer Configurations.
	 *
	 * @param Array  $configurations Configurations.
	 * @param string $builder_type Builder Type.
	 * @param string $section Section slug.
	 * @since 3.0.0
	 * @return Array Astra Customizer Configurations with updated configurations.
	 */
	public static function register_configuration( $configurations, $builder_type = 'header', $section = 'section-hb-social-icons-' ) {

		$social_configs         = array();
		$number_of_social_icons = astra_addon_builder_helper()->num_of_header_social_icons;

		if ( 'footer' === $builder_type ) {
			$number_of_social_icons = astra_addon_builder_helper()->num_of_footer_social_icons;
		}

		for ( $index = 1; $index <= $number_of_social_icons; $index++ ) {

			$_section = $section . $index;

			$_configs = array(

				array(
					'name'       => ASTRA_THEME_SETTINGS . '[' . $builder_type . '-social-' . $index . '-stack]',
					'default'    => astra_get_option( $builder_type . '-social-' . $index . '-stack' ),
					'section'    => $_section,
					'type'       => 'control',
					'control'    => 'ast-selector',
					'title'      => __( 'Stack On', 'astra-addon' ),
					'priority'   => 3,
					'choices'    => array(
						'desktop' => __( 'Desktop', 'astra-addon' ),
						'tablet'  => __( 'Tablet', 'astra-addon' ),
						'mobile'  => __( 'Mobile', 'astra-addon' ),
						'none'    => __( 'None', 'astra-addon' ),
					),
					'transport'  => 'postMessage',
					'context'    => astra_addon_builder_helper()->general_tab,
					'renderAs'   => 'text',
					'responsive' => false,
					'divider'    => array( 'ast_class' => 'ast-top-section-divider' ),
				),
			);

			$social_configs[] = $_configs;
		}

		$social_configs = call_user_func_array( 'array_merge', $social_configs + array( array() ) );
		return array_merge( $configurations, $social_configs );
	}
}

/**
 * Kicking this off by creating object of this class.
 */

new Astra_Social_Component_Configs();
