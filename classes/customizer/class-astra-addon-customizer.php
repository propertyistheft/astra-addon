<?php
/**
 * Astra Addon Customizer
 *
 * @package Astra Addon
 * @since 1.0.0
 */

if ( ! class_exists( 'Astra_Addon_Customizer' ) ) {

	/**
	 * Astra_Addon_Customizer
	 *
	 * @since 1.0.0
	 */
	class Astra_Addon_Customizer {
		/**
		 * Instance
		 *
		 * @since 1.0.0
		 *
		 * @var object Class object.
		 */
		private static $instance;

		/**
		 * Initiator
		 *
		 * @since 1.0.0
		 *
		 * @return object initialized object of class.
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 * Constructor
		 *
		 * @since 1.4.0
		 */
		public function __construct() {
			// Bail early if it is not astra customizer.
			if ( is_callable( 'Astra_Customizer::is_astra_customizer()' ) && ! Astra_Customizer::is_astra_customizer() ) {
				return;
			}

			add_action( 'customize_register', array( $this, 'customize_register' ) );
			add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
			add_action( 'customize_register', array( $this, 'customize_register_new' ), 3 );
			add_action( 'customize_preview_init', array( $this, 'preview_helper_scripts' ) );
		}

		/**
		 * Register custom section and panel.
		 *
		 * @since 1.0.0
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 */
		public function customize_register_new( $wp_customize ) {

			require ASTRA_EXT_DIR . 'classes/customizer/class-astra-customizer-notices-configs.php';
		}

		/**
		 * Register custom section and panel.
		 *
		 * @since 1.0.0
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 */
		public function customize_register( $wp_customize ) {

			// if Customizer Control base class exist.
			if ( class_exists( 'Astra_Customizer_Control_Base' ) ) {

				/**
				 * Add Controls
				 */
				Astra_Customizer_Control_Base::add_control(
					'ast-customizer-refresh',
					array(
						'callback'          => 'Astra_Control_Customizer_refresh',
						'sanitize_callback' => '',
					)
				);

			}

			// Control Class files.
			require ASTRA_EXT_DIR . 'classes/customizer/controls/class-astra-control-customizer-refresh.php';
		}

		/**
		 * Generates an array with responsive values for desktop, tablet and mobile.
		 *
		 * @param int $desktop Desktop value.
		 * @param int $tablet Tablet value.
		 * @param int $mobile Mobile value.
		 *
		 * @return array Array with responsive values.
		 * @since 4.10.0
		 */
		public static function responsive_values( $desktop = '', $tablet = '', $mobile = '' ) {
			return compact( 'desktop', 'tablet', 'mobile' );
		}

		/**
		 * Sanitize Alpha color
		 *
		 * @param  string $color setting input.
		 * @return string        setting input value.
		 */
		public static function sanitize_alpha_color( $color ) {

			if ( '' === $color ) {
				return '';
			}

			if ( false === strpos( $color, 'rgba' ) ) {
				/* Hex sanitize */
				return Astra_Customizer_Sanitizes::sanitize_hex_color( $color );
			}

			/* rgba sanitize */
			$color = str_replace( ' ', '', $color );
			sscanf( $color, 'rgba(%d,%d,%d,%f)', $red, $green, $blue, $alpha );
			return 'rgba(' . $red . ',' . $green . ',' . $blue . ',' . $alpha . ')';
		}

		/**
		 * Sanitize background obj
		 *
		 * @param  array $bg_obj Background object.
		 * @return array         Background object.
		 */
		public static function sanitize_background_obj( $bg_obj ) {
			if ( is_callable( 'Astra_Customizer_Sanitizes::sanitize_background_obj' ) ) {
				return Astra_Customizer_Sanitizes::sanitize_background_obj( $bg_obj );
			}

			return $bg_obj;
		}

		/**
		 * Sanitize Border
		 *
		 * @param  array $border Background object.
		 * @return array         Background object.
		 */
		public static function sanitize_border( $border ) {
			if ( is_callable( 'Astra_Customizer_Sanitizes::sanitize_border' ) ) {
				return Astra_Customizer_Sanitizes::sanitize_border( $border );
			}

			return $border;
		}

		/**
		 * Sanitize Responsive Background Image
		 *
		 * @param  array $bg_obj Background object.
		 * @return array         Background object.
		 */
		public static function sanitize_responsive_background( $bg_obj ) {
			if ( is_callable( 'Astra_Customizer_Sanitizes::sanitize_responsive_background' ) ) {
				return Astra_Customizer_Sanitizes::sanitize_responsive_background( $bg_obj );
			}

			// Default Responsive Background Image.
			$defaults = array(
				'desktop' => array(
					'background-color'      => '',
					'background-image'      => '',
					'background-repeat'     => 'repeat',
					'background-position'   => 'center center',
					'background-size'       => 'auto',
					'background-attachment' => 'scroll',
				),
				'tablet'  => array(
					'background-color'      => '',
					'background-image'      => '',
					'background-repeat'     => 'repeat',
					'background-position'   => 'center center',
					'background-size'       => 'auto',
					'background-attachment' => 'scroll',
				),
				'mobile'  => array(
					'background-color'      => '',
					'background-image'      => '',
					'background-repeat'     => 'repeat',
					'background-position'   => 'center center',
					'background-size'       => 'auto',
					'background-attachment' => 'scroll',
				),
			);

			// Merge responsive background object and default object into $out_bg_obj array.
			$out_bg_obj = wp_parse_args( $bg_obj, $defaults );

			foreach ( $out_bg_obj as $device => $bg ) {
				foreach ( $bg as $key => $value ) {
					if ( 'background-image' === $key ) {
						$out_bg_obj[ $device ] [ $key ] = esc_url_raw( $value );
					} else {
						$out_bg_obj[ $device ] [ $key ] = esc_attr( $value );
					}
				}
			}
			return $out_bg_obj;
		}

		/**
		 * Sanitize Box Shadow control
		 *
		 * @since 3.3.0
		 * @param  array|number $val Customizer setting input number.
		 * @return array        Return number.
		 */
		public static function sanitize_box_shadow( $val ) {

			$box_shadow = array(
				'x'      => '',
				'y'      => '',
				'blur'   => '',
				'spread' => '',
			);
			if ( is_array( $val ) ) {
				$box_shadow['x']      = is_numeric( $val['x'] ) ? $val['x'] : '';
				$box_shadow['y']      = is_numeric( $val['y'] ) ? $val['y'] : '';
				$box_shadow['blur']   = is_numeric( $val['blur'] ) ? $val['blur'] : '';
				$box_shadow['spread'] = is_numeric( $val['spread'] ) ? $val['spread'] : '';
			}
			return $box_shadow;
		}

		/**
		 * Sanitize Responsive Color
		 *
		 * @param  array $color_obj color object.
		 * @return array         color object.
		 */
		public static function sanitize_responsive_color( $color_obj ) {

			// Default Responsive Background Image.
			$defaults = array(
				'desktop' => '',
				'tablet'  => '',
				'mobile'  => '',
			);

			// Merge responsive color object and default object into $out_color_obj array.
			$out_color_obj = wp_parse_args( $color_obj, $defaults );

			foreach ( $out_color_obj as $device => $color ) {
				$out_color_obj[ $device ] = Astra_Customizer_Sanitizes::sanitize_alpha_color( $color );
			}
			return $out_color_obj;
		}

		/**
		 * Enqueue Admin Scripts
		 *
		 * @since 3.1.0
		 */
		public function enqueue_scripts() {

			$js_uri = ASTRA_EXT_URI . 'classes/customizer/assets/js/';

			wp_enqueue_style( 'ast-ext-admin-settings', ASTRA_EXT_URI . 'admin/assets/css/customizer-controls.css', array(), ASTRA_EXT_VER );

			if ( ! SCRIPT_DEBUG ) {
				// Enqueue Customizer script.
				$custom_controls_deps = array(
					'jquery',
					'customize-base',
					'jquery-ui-tabs',
					'jquery-ui-sortable',
					'wp-i18n',
					'wp-components',
					'wp-element',
					'wp-media-utils',
					'wp-block-editor',
				);

				wp_enqueue_script( 'astra-addon-custom-control-script', $js_uri . 'custom-controls.min.js', $custom_controls_deps, ASTRA_EXT_VER, true );

			} else {

				// Enqueue Customizer React.JS script.
				$custom_controls_react_deps = array(
					'astra-custom-control-plain-script',
					'wp-i18n',
					'wp-components',
					'wp-element',
					'wp-media-utils',
					'wp-block-editor',
				);

				wp_enqueue_script( 'astra-addon-custom-control-react-script', ASTRA_EXT_URI . 'classes/customizer/extend-controls/build/index.js', $custom_controls_react_deps, ASTRA_EXT_VER, true );
				wp_set_script_translations( 'astra-addon-custom-control-react-script', 'astra-addon' );
			}
		}

		/**
		 * Enqueue preview helper scripts for the customizer.
		 *
		 * @since 4.10.0
		 */
		public function preview_helper_scripts() {
			$script_handle = 'astra-addon-customizer-preview-helper';
			$folder        = SCRIPT_DEBUG ? 'unminified' : 'minified';
			$prefix        = SCRIPT_DEBUG ? '.js' : '.min.js';

			wp_enqueue_script(
				$script_handle,
				ASTRA_EXT_URI . 'classes/customizer/assets/js/' . $folder . '/customizer-preview-helper' . $prefix,
				array( 'customize-preview' ),
				ASTRA_EXT_VER,
				true
			);

			wp_localize_script(
				$script_handle,
				'astraPreviewHelper',
				array(
					'tabletBreakPoint' => astra_addon_get_tablet_breakpoint(),
					'mobileBreakPoint' => astra_addon_get_mobile_breakpoint(),
				)
			);
		}
	}

	/**
	 * Initialize class object with 'get_instance()' method
	 */
	Astra_Addon_Customizer::get_instance();

}
