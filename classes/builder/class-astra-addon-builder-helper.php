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

		add_filter( 'astra_builder_elements_count', __CLASS__ . '::elements_count', 10 );

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
			$return_value = self::${$property_name};
		} else {
			$return_value = property_exists( 'Astra_Builder_Helper', $property_name ) ? Astra_Builder_Helper::${$property_name} : false;
		}
		self::$cached_properties[ $property_name ] = $return_value;

		return $return_value;
	}

	/**
	 * Callback exception for static methods.
	 *
	 * @param string $function_name function name.
	 * @param array  $function_agrs function arguments.
	 * @return false|mixed
	 */
	public static function __callStatic( $function_name, $function_agrs ) {

		$key = md5( $function_name ) . md5( maybe_serialize( $function_agrs ) );
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
