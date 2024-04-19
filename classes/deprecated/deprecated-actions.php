<?php
/**
 * Deprecated Actions of Astra Addon.
 *
 * @package     Astra
 * @link        https://wpastra.com/
 * @since       Astra 3.5.7
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( function_exists( 'astra_do_action_deprecated' ) ) {

	/**
	 * Depreciating Astra AJAX pgination actions.
	 *
	 * @since 3.5.7
	 */
	astra_do_action_deprecated( 'astra_shop_pagination_infinite', array(), '3.5.7' );
	astra_do_action_deprecated( 'astra_pagination_infinite', array(), '3.5.7' );
}

// Depreciating astra_get_css_files hook.
add_action( 'astra_addon_get_css_files', 'astra_deprecated_astra_get_css_files_hook' );

/**
 * Depreciating 'astra_get_css_files' action & replacing with 'astra_addon_get_css_files'.
 *
 * @since 3.6.2
 */
function astra_deprecated_astra_get_css_files_hook() { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound
	astra_do_action_deprecated( 'astra_get_css_files', array(), '3.6.2', 'astra_addon_get_css_files' );
}

// Depreciating astra_get_js_files hook.
add_action( 'astra_addon_get_js_files', 'astra_deprecated_astra_get_js_files_hook' );

/**
 * Depreciating 'astra_get_js_files' action & replacing with 'astra_addon_get_js_files'.
 *
 * @since 3.6.2
 */
function astra_deprecated_astra_get_js_files_hook() { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound
	astra_do_action_deprecated( 'astra_get_js_files', array(), '3.6.2', 'astra_addon_get_js_files' );
}

// Depreciating astra_after_render_js hook.
add_action( 'astra_addon_after_render_js', 'astra_deprecated_astra_after_render_js_hook' );

/**
 * Depreciating 'astra_after_render_js' action & replacing with 'astra_addon_after_render_js'.
 *
 * @since 3.6.2
 */
function astra_deprecated_astra_after_render_js_hook() { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound
	astra_do_action_deprecated( 'astra_after_render_js', array(), '3.6.2', 'astra_addon_after_render_js' );
}
