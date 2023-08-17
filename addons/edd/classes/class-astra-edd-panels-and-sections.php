<?php
/**
 * Register customizer panels & sections.
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

if ( ! class_exists( 'Astra_Edd_Panels_And_Sections' ) ) {

	/**
	 * Register Easy Digital Downloads Panels and sections Layout Configurations.
	 */
	// @codingStandardsIgnoreStart
	class Astra_Edd_Panels_And_Sections extends Astra_Customizer_Config_Base {
		// @codingStandardsIgnoreEnd

		/**
		 * Register Easy Digital Downloads Panels and sections Layout Configurations.
		 *
		 * @param Array                $configurations Astra Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.6.10
		 * @return Array Astra Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_configs = array(

				/**
				 * Section General
				 */
				array(
					'name'     => 'section-edd-general',
					'title'    => __( 'General', 'astra-addon' ),
					'type'     => 'section',
					'section'  => 'section-edd-group',
					'priority' => 5,
				),

				/**
				 * Section Checkout Page
				 */
				array(
					'name'     => 'section-edd-checkout-page',
					'priority' => 25,
					'title'    => __( 'Checkout Page', 'astra-addon' ),
					'type'     => 'section',
					'section'  => 'section-edd-group',
				),
			);

			$configurations = array_merge( $configurations, $_configs );

			return $configurations;

		}
	}
}


new Astra_Edd_Panels_And_Sections();





