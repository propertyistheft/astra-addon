<?php
/**
 * Deprecated Functions of Astra Addon.
 *
 * @package     Astra
 * @author      Astra
 * @copyright   Copyright (c) 2020, Astra
 * @link        https://wpastra.com/
 * @since       Astra 1.6.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'astar' ) ) :

	/**
	 * Get a specific property of an array without needing to check if that property exists.
	 *
	 * @since 1.6.2
	 * @deprecated 1.6.2 Use astra_get_prop()
	 * @param array  $array   Array from which the property's value should be retrieved.
	 * @param string $prop    Name of the property to be retrieved.
	 * @param string $default Optional. Value that should be returned if the property is not set or empty. Defaults to null.
	 * @see astra_get_prop()
	 *
	 * @return null|string|mixed The value
	 */
	function astar( $array, $prop, $default = null ) {
		return astra_get_prop( $array, $prop, $default );
	}

endif;

if ( ! function_exists( 'astra_pagination_infinite' ) ) :

	/**
	 * Deprecating astra_pagination_infinite function.
	 *
	 * @since 3.5.7
	 * @deprecated 3.5.7
	 */
	function astra_pagination_infinite() {
		_deprecated_function( __FUNCTION__, '3.5.7' );
	}

endif;

if ( ! function_exists( 'astra_shop_pagination_infinite' ) ) :

	/**
	 * Deprecating astra_shop_pagination_infinite function.
	 *
	 * @since 3.5.7
	 * @deprecated 3.5.7
	 */
	function astra_shop_pagination_infinite() {
		_deprecated_function( __FUNCTION__, '3.5.7' );
	}

endif;

if ( ! function_exists( 'astra_addon_clear_assets_cache' ) ) :

	/**
	 * Deprecating astra_addon_clear_assets_cache function.
	 *
	 * @since 3.5.9
	 * @deprecated 3.5.9
	 */
	function astra_addon_clear_assets_cache() {
		_deprecated_function( __FUNCTION__, '3.5.9' );
	}

endif;
