<?php
/**
 * Astra Theme Customizer Configuration Base.
 *
 * @package     Astra
 * @author      Astra
 * @copyright   Copyright (c) 2020, Astra
 * @link        https://wpastra.com/
 * @since       Astra 1.4.3
 */

// Block direct access to the file.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Bail if Customizer config base class does not exist.
if ( ! class_exists( 'Astra_Customizer_Config_Base' ) ) {
	return;
}

/**
 * Customizer Sanitizes
 *
 * @since 1.4.3
 */
if ( ! class_exists( 'Astra_Customizer_Lifterlms_Panels_And_Sections' ) ) {

	/**
	 * Register Button Customizer Configurations.
	 */
	class Astra_Customizer_Lifterlms_Panels_And_Sections extends Astra_Customizer_Config_Base {

		/**
		 * Register Panels and Sections Customizer Configurations.
		 *
		 * @param Array                $configurations Astra Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array Astra Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_configs = array(

				/**
				 * General Section
				 */
				array(
					'name'     => 'section-lifterlms-general',
					'type'     => 'section',
					'title'    => __( 'General', 'astra-addon' ),
					'section'  => 'section-lifterlms',
					'priority' => 0,
				),

				/**
				 * Course / Lesson Section
				 */
				array(
					'name'     => 'section-lifterlms-course-lesson',
					'type'     => 'section',
					'priority' => 5,
					'title'    => __( 'Course / Lesson', 'astra-addon' ),
					'section'  => 'section-lifterlms',
				),
			);

			return array_merge( $configurations, $_configs );
		}
	}
}

/**
 * Kicking this off by calling 'get_instance()' method
 */
new Astra_Customizer_Lifterlms_Panels_And_Sections();
