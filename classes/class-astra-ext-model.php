<?php
/**
 * Astra Extension Model Class
 *
 * @package Astra Addon
 */

/**
 * Provide Extension related data.
 *
 * @since 1.0
 */
final class Astra_Ext_Model {

	/**
	 * Construct
	 */
	public function __construct() {

		if ( class_exists( 'Astra_Customizer' ) ) {
			$this->load_extensions();
		}
	}

	/**
	 * Load Extensions
	 *
	 * @return void
	 */
	public function load_extensions() {

		$enabled_extension  = Astra_Ext_Extension::get_enabled_addons();
		$default_extensions = Astra_Ext_Extension::get_default_addons();
		$enabled_extension  = $enabled_extension + $default_extensions;

		if ( 0 < count( $enabled_extension ) ) {

			if ( isset( $enabled_extension['all'] ) ) {
				unset( $enabled_extension['all'] );
			}

			foreach ( $enabled_extension as $slug => $value ) {

				if ( false == $value ) {
					continue;
				}

				$extension_path = ASTRA_EXT_DIR . 'addons/' . esc_attr( $slug ) . '/class-astra-ext-' . esc_attr( $slug ) . '.php';
				$extension_path = apply_filters( 'astra_addon_path', $extension_path, $slug );

				// Check for the extension.
				if ( file_exists( $extension_path ) ) {
					require_once $extension_path;
				}
			}
		}
	}
}

new Astra_Ext_Model();

