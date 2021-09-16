<?php
/**
 * Deprecated Filters of Astra Addon.
 *
 * @package     Astra
 * @author      Astra
 * @copyright   Copyright (c) 2021, Astra
 * @link        https://wpastra.com/
 * @since       Astra 3.5.7
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( function_exists( 'astra_apply_filters_deprecated' ) ) {

	/**
	 * Astra search results post type filter added for AJAX action
	 *
	 * @since 3.5.7
	 */
	$post_type = 'any';  // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
	astra_apply_filters_deprecated( 'astra_infinite_pagination_post_type', array( $post_type ), '3.5.7' );
}
