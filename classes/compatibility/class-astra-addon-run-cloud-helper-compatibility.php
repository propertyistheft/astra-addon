<?php
/**
 * Astra Addon RunCloud Compatibility
 *
 * @package Astra Addon
 * @since 2.5.0
 */

/**
 * Astra Addon Runcloud Helper Class
 *
 * @since 2.5.0
 */
class Astra_Addon_Run_Cloud_Helper_Compatibility {
	/**
	 * Constructor
	 *
	 * @since 2.5.0
	 */
	public function __construct() {
		add_action( 'astra_addon_assets_refreshed', array( $this, 'refresh_runcloud_helper_cache' ) );
	}

	/**
	 * Purge RunCloud Cache.
	 *
	 * @since 2.5.0
	 * @return void
	 */
	public function refresh_runcloud_helper_cache() {
		if ( is_callable( 'RunCache_Purger::flush_home' ) ) {
			// Function to purge RunCloud cache.
			RunCache_Purger::flush_home( true );
		}
	}

}

/**
 * Conditionally Initialize RunCloud Cache compatibility.
 *
 * @since 2.5.0
 * @return void
 */
function astra_addon_run_cloud_helper_compatibility() {
	if ( class_exists( 'RunCache_Purger' ) ) {
		new Astra_Addon_Run_Cloud_Helper_Compatibility();
	}
}

add_action( 'plugins_loaded', 'astra_addon_run_cloud_helper_compatibility' );
