<?php
/**
 * Astra Addon Builder Helper.
 *
 * @since 3.0.0
 * @package astra-builder
 */

/**
 * Class Astra_Addon_Builder_Helper.
 *
 * @since 3.0.0
 */
final class Astra_Addon_Builder_Helper {
	/**
	 * Member Variable
	 *
	 * @since 3.0.0
	 * @var instance
	 */
	private static $instance = null;

	/**
	 * Cached Helper Variable.
	 *
	 * @since 3.0.0
	 * @var instance
	 */
	private static $cached_properties = null;

	/**
	 *  No. Of. Component count array.
	 *
	 * @var int
	 */
	public static $component_count_array = array();

	/**
	 *  No. Of. Component Limit.
	 *
	 * @var int
	 */
	public static $component_limit = 10;

	/**
	 * No. Of. Header Dividers.
	 *
	 * @since 3.0.0
	 * @var int
	 */
	public static $num_of_header_divider;

	/**
	 * No. Of. Footer Dividers.
	 *
	 * @since 3.0.0
	 * @var int
	 */
	public static $num_of_footer_divider;

	/**
	 * Initiator
	 *
	 * @since 3.0.0
	 */
	public static function get_instance() {

		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Constructor
	 *
	 * @since 3.0.0
	 */
	public function __construct() {

		add_filter( 'astra_builder_elements_count', self::class . '::elements_count', 10 );

		$component_count_by_key = self::elements_count();

		self::$num_of_header_divider = $component_count_by_key['header-divider'];
		self::$num_of_footer_divider = $component_count_by_key['footer-divider'];
	}

	/**
	 * Update the count of elements in HF Builder.
	 *
	 * @param array $elements array of elements having key as slug and value as count.
	 * @return array $elements
	 */
	public static function elements_count( $elements = array() ) {

		$db_elements = get_option( 'astra-settings' );
		$db_elements = isset( $db_elements['cloned-component-track'] ) ? $db_elements['cloned-component-track'] : array();

		/**
		 * If the header-divider & footer-divider is set to 0, then set it to 3.
		 * Case: If the theme is active or any starter template with old astra-settings gets imported then the header-divider & footer-divider will be set to 0. So to avoid the conflict, we are setting it to 3 which is counter by Astra Addon.
		 *
		 * @since 4.3.0
		 */
		if ( isset( $db_elements['header-divider'] ) && 0 === $db_elements['header-divider'] ) {
			$db_elements['header-divider'] = 3;
		}
		if ( isset( $db_elements['footer-divider'] ) && 0 === $db_elements['footer-divider'] ) {
			$db_elements['footer-divider'] = 3;
		}

		if ( ! empty( $db_elements ) ) {
			return $db_elements;
		}

		$elements['header-button']       = 2;
		$elements['footer-button']       = 2;
		$elements['header-html']         = 3;
		$elements['footer-html']         = 2;
		$elements['header-menu']         = 3;
		$elements['header-widget']       = 4;
		$elements['footer-widget']       = 6;
		$elements['header-social-icons'] = 1;
		$elements['footer-social-icons'] = 1;
		$elements['header-divider']      = 3;
		$elements['footer-divider']      = 3;
		$elements['removed-items']       = array();

		return $elements;
	}

	/**
	 * Callback of external properties.
	 *
	 * @param string $property_name property name.
	 * @return false
	 */
	public function __get( $property_name ) {

		if ( isset( self::$cached_properties[ $property_name ] ) ) {
			return self::$cached_properties[ $property_name ];
		}

		if ( property_exists( 'Astra_Addon_Builder_Helper', $property_name ) ) {
			// Directly override theme helper properties.
			$return_value = self::astra_addon_get_addon_helper_static( $property_name );
		} else {
			$return_value = property_exists( 'Astra_Builder_Helper', $property_name ) ? self::astra_addon_get_theme_helper_static( $property_name ) : false;
		}
		self::$cached_properties[ $property_name ] = $return_value;

		return $return_value;
	}

	/**
	 * Callback to get theme's static property.
	 *
	 * @param string $prop_name function name.
	 * @return mixed
	 */
	public static function astra_addon_get_theme_helper_static( $prop_name ) {
		$theme_static_sets = array(
			'general_tab'                       => Astra_Builder_Helper::$general_tab,
			'general_tab_config'                => Astra_Builder_Helper::$general_tab_config,
			'design_tab'                        => Astra_Builder_Helper::$design_tab,
			'design_tab_config'                 => Astra_Builder_Helper::$design_tab_config,
			'tablet_device'                     => Astra_Builder_Helper::$tablet_device,
			'mobile_device'                     => Astra_Builder_Helper::$mobile_device,
			'responsive_devices'                => Astra_Builder_Helper::$responsive_devices,
			'responsive_general_tab'            => Astra_Builder_Helper::$responsive_general_tab,
			'desktop_general_tab'               => Astra_Builder_Helper::$desktop_general_tab,
			'default_responsive_spacing'        => Astra_Builder_Helper::$default_responsive_spacing,
			'default_button_responsive_spacing' => isset( Astra_Builder_Helper::$default_button_responsive_spacing ) ? Astra_Builder_Helper::$default_button_responsive_spacing : Astra_Builder_Helper::$default_responsive_spacing,
			'tablet_general_tab'                => Astra_Builder_Helper::$tablet_general_tab,
			'mobile_general_tab'                => Astra_Builder_Helper::$mobile_general_tab,
			'component_limit'                   => Astra_Builder_Helper::$component_limit,
			'component_count_array'             => Astra_Builder_Helper::$component_count_array,
			'num_of_footer_widgets'             => Astra_Builder_Helper::$num_of_footer_widgets,
			'num_of_footer_html'                => Astra_Builder_Helper::$num_of_footer_html,
			'num_of_header_widgets'             => Astra_Builder_Helper::$num_of_header_widgets,
			'num_of_header_menu'                => Astra_Builder_Helper::$num_of_header_menu,
			'num_of_header_button'              => Astra_Builder_Helper::$num_of_header_button,
			'num_of_footer_button'              => Astra_Builder_Helper::$num_of_footer_button,
			'num_of_header_html'                => Astra_Builder_Helper::$num_of_header_html,
			'num_of_footer_columns'             => Astra_Builder_Helper::$num_of_footer_columns,
			'num_of_header_social_icons'        => Astra_Builder_Helper::$num_of_header_social_icons,
			'num_of_footer_social_icons'        => Astra_Builder_Helper::$num_of_footer_social_icons,
			'num_of_header_divider'             => Astra_Builder_Helper::$num_of_header_divider,
			'num_of_footer_divider'             => Astra_Builder_Helper::$num_of_footer_divider,
			'is_header_footer_builder_active'   => Astra_Builder_Helper::$is_header_footer_builder_active,
			'footer_row_layouts'                => Astra_Builder_Helper::$footer_row_layouts,
			'header_desktop_items'              => Astra_Builder_Helper::$header_desktop_items,
			'footer_desktop_items'              => Astra_Builder_Helper::$footer_desktop_items,
			'header_mobile_items'               => Astra_Builder_Helper::$header_mobile_items,
			'loaded_grid'                       => Astra_Builder_Helper::$loaded_grid,
			'grid_size_mapping'                 => Astra_Builder_Helper::$grid_size_mapping,
		);
		return isset( $theme_static_sets[ $prop_name ] ) ? $theme_static_sets[ $prop_name ] : $prop_name;
	}

	/**
	 * Callback to get addon's static property.
	 *
	 * @param string $prop_name function name.
	 * @return mixed
	 */
	public static function astra_addon_get_addon_helper_static( $prop_name ) {
		$addon_static_sets = array(
			'component_count_array' => self::$component_count_array,
			'component_limit'       => self::$component_limit,
			'num_of_header_divider' => self::$num_of_header_divider,
			'num_of_footer_divider' => self::$num_of_footer_divider,
		);
		return isset( $addon_static_sets[ $prop_name ] ) ? $addon_static_sets[ $prop_name ] : $prop_name;
	}

	/**
	 * Callback exception for static methods.
	 *
	 * @param string $function_name function name.
	 * @param array  $function_agrs function arguments.
	 * @return false|mixed
	 */
	public static function __callStatic( $function_name, $function_agrs ) {

		$key = hash( 'sha256', $function_name ) . hash( 'sha256', maybe_serialize( $function_agrs ) );
		if ( isset( self::$cached_properties[ $key ] ) ) {
			return self::$cached_properties[ $key ];
		}

		if ( method_exists( 'Astra_Addon_Builder_Helper', $function_name ) ) {
			// Check if self method exists.
			$class_name = 'Astra_Addon_Builder_Helper';
		} elseif ( method_exists( 'Astra_Builder_Helper', $function_name ) ) {
			// if self method doesnot exists then check for theme helper.
			$class_name = 'Astra_Builder_Helper';
		} else {
			// If not found anything then return false directly.
			return false;
		}

		$return_value                    = call_user_func_array( array( $class_name, $function_name ), $function_agrs );
		self::$cached_properties[ $key ] = $return_value;
		return $return_value;
	}
}

/**
 *  Prepare if class 'Astra_Addon_Builder_Helper' exist.
 *  Kicking this off by calling 'get_instance()' method
 */
Astra_Addon_Builder_Helper::get_instance();

/**
 * Get instance to call properties and methods.
 *
 * @return Astra_Addon_Builder_Helper|instance|null
 */
function astra_addon_builder_helper() {
	return Astra_Addon_Builder_Helper::get_instance();
}
