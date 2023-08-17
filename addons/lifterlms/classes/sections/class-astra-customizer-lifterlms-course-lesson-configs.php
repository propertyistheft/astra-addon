<?php
/**
 * LifterLMS General Options for our theme.
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

/**
 * Customizer Sanitizes
 *
 * @since 1.4.3
 */
if ( ! class_exists( 'Astra_Customizer_Lifterlms_Course_Lesson_Configs' ) ) {

	/**
	 * Register Course Lesson Customizer Configurations.
	 */
	// @codingStandardsIgnoreStart
	class Astra_Customizer_Lifterlms_Course_Lesson_Configs extends Astra_Customizer_Config_Base {
 // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedClassFound
		// @codingStandardsIgnoreEnd

		/**
		 * Register Course Lesson Customizer Configurations.
		 *
		 * @param Array                $configurations Astra Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array Astra Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_configs = array(

				/**
				 * Option: Divider
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[lifterlms-distraction-free-learning-divider]',
					'section'  => 'section-lifterlms-course-lesson',
					'title'    => __( 'Student View', 'astra-addon' ),
					'type'     => 'control',
					'control'  => 'ast-heading',
					'priority' => 5,
					'settings' => array(),
					'divider'  => array( 'ast_class' => 'ast-section-spacing' ),
				),

				/**
				 * Option: Distraction Free Learning
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[lifterlms-distraction-free-learning]',
					'default'  => astra_get_option( 'lifterlms-distraction-free-learning' ),
					'type'     => 'control',
					'control'  => Astra_Theme_Extension::$switch_control,
					'section'  => 'section-lifterlms-course-lesson',
					'title'    => __( 'Enable Distraction Free Learning', 'astra-addon' ),
					'priority' => 5,
					'divider'  => array( 'ast_class' => 'ast-section-spacing' ),
				),

				/**
				 * Option: Enable Featured Image
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[lifterlms-enable-featured-image]',
					'default'  => astra_get_option( 'lifterlms-enable-featured-image' ),
					'type'     => 'control',
					'control'  => Astra_Theme_Extension::$switch_control,
					'section'  => 'section-lifterlms-course-lesson',
					'title'    => __( 'Enable Featured Image', 'astra-addon' ),
					'priority' => 5,
				),

				/**
				 * Option: Enable Course Description
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[lifterlms-enable-course-description]',
					'default'  => astra_get_option( 'lifterlms-enable-course-description' ),
					'type'     => 'control',
					'control'  => Astra_Theme_Extension::$switch_control,
					'section'  => 'section-lifterlms-course-lesson',
					'title'    => __( 'Enable Course Description', 'astra-addon' ),
					'priority' => 5,
				),

				/**
				 * Option: Enable Course Meta
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[lifterlms-enable-course-meta]',
					'default'  => astra_get_option( 'lifterlms-enable-course-meta' ),
					'type'     => 'control',
					'control'  => Astra_Theme_Extension::$switch_control,
					'section'  => 'section-lifterlms-course-lesson',
					'title'    => __( 'Enable Course Meta', 'astra-addon' ),
					'priority' => 5,
				),

				/**
				 * Option: Enable Instructor Detail
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[lifterlms-enable-instructor-detail]',
					'default'  => astra_get_option( 'lifterlms-enable-instructor-detail' ),
					'type'     => 'control',
					'control'  => Astra_Theme_Extension::$switch_control,
					'section'  => 'section-lifterlms-course-lesson',
					'title'    => __( 'Enable Instructor Detail', 'astra-addon' ),
					'priority' => 5,
				),

				/**
				 * Option: Enable Progress Bar
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[lifterlms-enable-progress-bar]',
					'default'  => astra_get_option( 'lifterlms-enable-progress-bar' ),
					'type'     => 'control',
					'control'  => Astra_Theme_Extension::$switch_control,
					'section'  => 'section-lifterlms-course-lesson',
					'title'    => __( 'Enable Progress Bar', 'astra-addon' ),
					'priority' => 5,
				),

				/**
				 * Option: Divider
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[lifterlms-enable-visitor-divider]',
					'section'  => 'section-lifterlms-course-lesson',
					'title'    => __( 'Visitor View', 'astra-addon' ),
					'type'     => 'control',
					'control'  => 'ast-heading',
					'priority' => 10,
					'settings' => array(),
					'divider'  => array( 'ast_class' => 'ast-section-spacing' ),
				),

				/**
				 * Option: Enable Featured Image
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[lifterlms-enable-visitor-featured-image]',
					'default'  => astra_get_option( 'lifterlms-enable-visitor-featured-image' ),
					'type'     => 'control',
					'control'  => Astra_Theme_Extension::$switch_control,
					'section'  => 'section-lifterlms-course-lesson',
					'title'    => __( 'Enable Featured Image', 'astra-addon' ),
					'priority' => 10,
					'divider'  => array( 'ast_class' => 'ast-section-spacing' ),
				),

				/**
				 * Option: Enable Course Description
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[lifterlms-enable-visitor-course-description]',
					'default'  => astra_get_option( 'lifterlms-enable-visitor-course-description' ),
					'type'     => 'control',
					'section'  => 'section-lifterlms-course-lesson',
					'title'    => __( 'Enable Course Description', 'astra-addon' ),
					'priority' => 10,
					'control'  => Astra_Theme_Extension::$switch_control,
				),

				/**
				 * Option: Enable Course Meta
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[lifterlms-enable-visitor-course-meta]',
					'default'  => astra_get_option( 'lifterlms-enable-visitor-course-meta' ),
					'type'     => 'control',
					'control'  => Astra_Theme_Extension::$switch_control,
					'section'  => 'section-lifterlms-course-lesson',
					'title'    => __( 'Enable Course Meta', 'astra-addon' ),
					'priority' => 10,
				),

				/**
				 * Option: Enable Instructor Detail
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[lifterlms-enable-visitor-instructor-detail]',
					'default'  => astra_get_option( 'lifterlms-enable-visitor-instructor-detail' ),
					'type'     => 'control',
					'control'  => Astra_Theme_Extension::$switch_control,
					'section'  => 'section-lifterlms-course-lesson',
					'title'    => __( 'Enable Instructor Detail', 'astra-addon' ),
					'priority' => 10,
				),

				/**
				 * Option: Enable Syllabus
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[lifterlms-enable-visitor-syllabus]',
					'default'  => astra_get_option( 'lifterlms-enable-visitor-syllabus' ),
					'type'     => 'control',
					'control'  => Astra_Theme_Extension::$switch_control,
					'section'  => 'section-lifterlms-course-lesson',
					'title'    => __( 'Enable Syllabus', 'astra-addon' ),
					'priority' => 10,
				),
			);

			return array_merge( $configurations, $_configs );
		}
	}
}

/**
 * Kicking this off by calling 'get_instance()' method
 */
new Astra_Customizer_Lifterlms_Course_Lesson_Configs();
