<?php
/**
 * Astra Addon Customizer
 *
 * @package Astra Addon
 * @since 2.0.0
 */

/**
 * Astra Addon Page Builder Compatibility base class
 *
 * @since 2.0.0
 */
class Astra_Addon_Nginx_Helper_Compatibility {

	/**
	 * Setup the class
	 */
	public function __construct() {
		add_action( 'astra_addon_assets_refreshed', array( $this, 'refresh_nginx_helper_cache' ) );
	}

	/**
	 * Purge Nginx Helper's Cache.
	 *
	 * @since 2.0.0
	 * @return void
	 */
	public function refresh_nginx_helper_cache() {
		// Nginx FastCGI using Nginx Helper.
		do_action( 'rt_nginx_helper_purge_all' ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound
	}

}

/**
 * Conditionally Initialize Nginx_Helper compatibility.
 *
 * @since 2.1.0
 * @return void
 */
function astra_addon_nginx_helper_compatibility() {
	if ( class_exists( 'Nginx_Helper' ) ) {
		new Astra_Addon_Nginx_Helper_Compatibility();
	}
}

add_action( 'plugins_loaded', 'astra_addon_nginx_helper_compatibility' );
