<?php
/**
 * LifterLMS Loader
 *
 * @package Astra Addon
 */

if ( ! class_exists( 'Astra_Ext_LifterLMS_Loader' ) ) {

	/**
	 * Customizer Initialization
	 *
	 * @since 1.0.0
	 */
	// @codingStandardsIgnoreStart
	class Astra_Ext_LifterLMS_Loader {
 // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedClassFound
		// @codingStandardsIgnoreEnd

		/**
		 * Member Variable
		 *
		 * @var instance
		 */
		private static $instance;

		/**
		 * Initiator
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 * Constructor
		 */
		public function __construct() {

			add_filter( 'astra_theme_defaults', array( $this, 'theme_defaults' ) );
			add_action( 'customize_register', array( $this, 'customize_register' ), 2 );
			add_action( 'customize_preview_init', array( $this, 'preview_scripts' ) );
			add_filter( 'astra_theme_lifterlms_settings', array( $this, 'register_builder_fields' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );

		}

		/**
		 * Set Options Default Values
		 *
		 * @param  array $defaults  Astra options default value array.
		 * @return array
		 */
		public function theme_defaults( $defaults ) {

			// Student View.
			$defaults['lifterlms-distraction-free-learning'] = true;
			$defaults['lifterlms-enable-featured-image']     = true;
			$defaults['lifterlms-enable-progress-bar']       = true;
			$defaults['lifterlms-enable-course-description'] = true;
			$defaults['lifterlms-enable-course-meta']        = true;
			$defaults['lifterlms-enable-instructor-detail']  = true;

			// Visitor's View.
			$defaults['lifterlms-enable-visitor-featured-image']     = true;
			$defaults['lifterlms-enable-visitor-course-description'] = true;
			$defaults['lifterlms-enable-visitor-course-meta']        = true;
			$defaults['lifterlms-enable-visitor-instructor-detail']  = true;
			$defaults['lifterlms-enable-visitor-syllabus']           = true;

			$defaults['lifterlms-distraction-free-checkout'] = false;

			$defaults['lifterlms-profile-link-enabled'] = false;
			$defaults['lifterlms-my-account-vertical']  = false;

			return $defaults;
		}

		/**
		 * Add postMessage support for site title and description for the Theme Customizer.
		 *
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 */
		public function customize_register( $wp_customize ) {

			/**
			 * Register Sections & Panels
			 */
			require_once ASTRA_ADDON_EXT_LIFTERLMS_DIR . 'classes/class-astra-customizer-lifterlms-panels-and-sections.php';

			/**
			 * Sections
			 */
			require_once ASTRA_ADDON_EXT_LIFTERLMS_DIR . 'classes/sections/class-astra-customizer-lifterlms-general-configs.php';
			require_once ASTRA_ADDON_EXT_LIFTERLMS_DIR . 'classes/sections/class-astra-customizer-lifterlms-course-lesson-configs.php';

		}

		/**
		 * Customizer Controls
		 *
		 * @see 'astra-customizer-preview-js' panel in parent theme
		 */
		public function preview_scripts() {

			if ( SCRIPT_DEBUG ) {
				$js_path = 'assets/js/unminified/customizer-preview.js';
			} else {
				$js_path = 'assets/js/minified/customizer-preview.min.js';
			}

			wp_register_script( 'ast-lifterlms-customizer-preview', ASTRA_ADDON_EXT_LIFTERLMS_URI . $js_path, array( 'customize-preview', 'astra-customizer-preview-js' ), ASTRA_EXT_VER, true );
			wp_enqueue_script( 'ast-lifterlms-customizer-preview' );
		}


		/**
		 * Register theme postmeta fields with the LifterLMS Builder
		 *
		 * @since [version]
		 * @param string $default_fields Default custom field definitions.
		 * @return string $default_fields Updated custom field definitions.
		 */
		public function register_builder_fields( $default_fields ) {

			$disable_fields      = array();
			$addon_fields        = array();
			$show_meta_field     = ! Astra_Meta_Boxes::is_bb_themer_layout();
			$above_header_layout = astra_get_option( 'above-header-layout' );
			$below_header_layout = astra_get_option( 'below-header-layout' );

			$header_options = Astra_Target_Rules_Fields::get_post_selection( 'astra_adv_header' );

			foreach ( $header_options as $key => $value ) {
				$page_headers[ $key ] = $value;
			}

			if ( empty( $header_options ) ) {
				$page_headers = array(
					'' => __( 'No Page Headers Found', 'astra-addon' ),
				);
			}

			if ( Astra_Ext_Extension::is_active( 'sticky-header' ) ) {
				if ( $show_meta_field ) {
					$disable_fields[] = array(
						'attribute'  => 'header-main-stick-meta',
						'id'         => 'header-main-stick-meta',
						'label'      => esc_html__( 'Stick Primary Header', 'astra-addon' ),
						'switch_on'  => 'on',
						'switch_off' => 'off',
						'type'       => 'switch',
					);
				}
			}

			if ( Astra_Ext_Extension::is_active( 'sticky-header' ) ) {
				if ( $show_meta_field ) {
					$disable_fields[] = array(
						'attribute'  => 'header-above-stick-meta',
						'id'         => 'header-above-stick-meta',
						'label'      => esc_html__( 'Stick Above Header', 'astra-addon' ),
						'switch_on'  => 'on',
						'switch_off' => 'off',
						'type'       => 'switch',
					);
				}
			}

			if ( Astra_Ext_Extension::is_active( 'sticky-header' ) ) {
				if ( $show_meta_field ) {
					$disable_fields[] = array(
						'attribute'  => 'header-below-stick-meta',
						'id'         => 'header-below-stick-meta',
						'label'      => esc_html__( 'Stick Below Header', 'astra-addon' ),
						'switch_on'  => 'on',
						'switch_off' => 'off',
						'type'       => 'switch',
					);
				}
			}

			if ( 'disabled' !== $above_header_layout ) {
				if ( $show_meta_field ) {
					$disable_fields[] = array(
						'attribute' => 'ast-above-header-display',
						'id'        => 'ast-above-header-display',
						'label'     => esc_html__( 'Disable Above Header', 'astra-addon' ),
						'switch_on' => 'disabled',
						'type'      => 'switch',
					);
				}
			}

			if ( 'disabled' !== $below_header_layout ) {
				if ( $show_meta_field ) {
					$disable_fields[] = array(
						'attribute' => 'ast-below-header-display',
						'id'        => 'ast-below-header-display',
						'label'     => esc_html__( 'Disable Below Header', 'astra-addon' ),
						'switch_on' => 'disabled',
						'type'      => 'switch',
					);
				}
			}

			if ( Astra_Ext_Extension::is_active( 'advanced-headers' ) ) {
				$addon_fields[] = array(
					'attribute' => 'adv-header-id-meta',
					'id'        => 'adv-header-id-meta',
					'label'     => esc_html__( 'Page Header ', 'astra-addon' ),
					'type'      => 'ast-select',
					'options'   => $page_headers,
				);
			}

			if ( Astra_Ext_Extension::is_active( 'sticky-header' ) ) {
				$addon_fields[] = array(
					'attribute' => 'stick-header-meta',
					'id'        => 'stick-header-meta',
					'label'     => esc_html__( 'Sticky Header ', 'astra-addon' ),
					'type'      => 'ast-select',
					'options'   => array(
						'default'  => esc_html__( 'Customizer Setting', 'astra-addon' ),
						'enabled'  => esc_html__( 'Enabled', 'astra-addon' ),
						'disabled' => esc_html__( 'Disabled', 'astra-addon' ),
					),
				);
			}

			if ( Astra_Ext_Extension::is_active( 'transparent-header' ) ) {
				$addon_fields[] = array(
					'attribute' => 'theme-transparent-header-meta',
					'id'        => 'theme-transparent-header-meta',
					'label'     => esc_html__( 'Transparent Header ', 'astra-addon' ),
					'type'      => 'ast-select',
					'options'   => array(
						'default'  => esc_html__( 'Customizer Setting', 'astra-addon' ),
						'enabled'  => esc_html__( 'Enabled', 'astra-addon' ),
						'disabled' => esc_html__( 'Disabled', 'astra-addon' ),
					),
				);
			}

			$default_fields[] = $addon_fields;
			$default_fields[] = $disable_fields;

			return $default_fields;
		}

		/**
		 * Enqueue admin Scripts and Styles.
		 *
		 * @since  1.3.3
		 */
		public function admin_scripts() {

			if ( class_exists( 'LLMS_Admin_Assets' ) ) {

				$obj = new LLMS_Admin_Assets();

				if ( $obj->is_llms_page() ) {

					if ( SCRIPT_DEBUG ) {
						$js_path = 'assets/js/unminified/lifterlms-builder-settings.js';
					} else {
						$js_path = 'assets/js/minified/lifterlms-builder-settings.min.js';
					}

					wp_enqueue_script( 'ast-lifterlms-builder-settings-', ASTRA_ADDON_EXT_LIFTERLMS_URI . $js_path, array(), ASTRA_EXT_VER, true );
				}
			}
		}
	}
}

/**
* Kicking this off by calling 'get_instance()' method
*/
Astra_Ext_LifterLMS_Loader::get_instance();
