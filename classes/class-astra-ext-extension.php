<?php
/**
 * Astra Extension Class
 *
 * @package Astra Addon
 */

/**
 * Provide Extension related data.
 *
 * @since 1.0
 */
// @codingStandardsIgnoreStart
final class Astra_Ext_Extension {
	// @codingStandardsIgnoreEnd

	/**
	 * Default Extensions
	 *
	 * @since 1.4.8
	 * @return array
	 */
	public static function get_default_addons() {
		return apply_filters(
			'astra_addon_ext_default_addons',
			array(
				'advanced-search' => 'advanced-search',
			)
		);
	}

	/**
	 * Provide Extension array().
	 *
	 * @return array()
	 * @since 1.0
	 */
	public static function get_addons() {

		$extensions = array(
			'advanced-hooks'        => array(),
			'blog-pro'              => array(),
			'colors-and-background' => array(),
			'advanced-footer'       => array(),
			'mobile-header'         => array(),
			'header-sections'       => array(),
			'lifterlms'             => array(),
			'learndash'             => array(),
			'advanced-headers'      => array(),
			'site-layouts'          => array(),
			'spacing'               => array(),
			'sticky-header'         => array(),
			'transparent-header'    => array(),
			'typography'            => array(),
			'woocommerce'           => array(),
			'edd'                   => array(),
			'nav-menu'              => array(),
		);

		return apply_filters( 'astra_addon_get_addons', $extensions );
	}

	/**
	 * Provide Enable Extension array().
	 *
	 * @return array()
	 * @since 1.0
	 */
	public static function get_enabled_addons() {

		$enabled_data = array();

		$extensions         = self::get_addons();
		$enabled_extensions = Astra_Admin_Helper::get_admin_settings_option( '_astra_ext_enabled_extensions' );

		if ( empty( $enabled_extensions ) ) {

			foreach ( $extensions as $slug => $data ) {
				$enabled_data[ $slug ] = isset( $data['default'] ) ? $data['default'] : false;
			}

			$enabled_data['all'] = 'all';
		} else {
			$enabled_data = $enabled_extensions;

			if ( isset( $enabled_extensions['all'] ) && false != $enabled_extensions['all'] ) {
				// add new key.
				foreach ( $extensions as $slug => $data ) {
					if ( ! array_key_exists( $slug, $enabled_extensions ) ) {
						$enabled_data[ $slug ] = isset( $data['default'] ) ? $data['default'] : false;
					}
				}
			}
		}

		return apply_filters( 'astra_addon_enabled_extensions', $enabled_data );
	}

	/**
	 * Activates the specified extension.
	 *
	 * @param string $extension_name Extension Name.
	 * @param bool   $force          Force to activate.
	 *
	 * @return void
	 *
	 * @since 4.8.8
	 */
	public static function activate_extension( $extension_name, $force = true ) {
		// Get the list of currently enabled extensions.
		$extensions = self::get_enabled_addons();

		// Check if the extension needs to be activated.
		if ( ! isset( $extensions[ $extension_name ] ) || ( $force && ! $extensions[ $extension_name ] ) || $extensions[ $extension_name ] === false ) {
			$extensions[ $extension_name ] = $extension_name;
			Astra_Admin_Helper::update_admin_settings_option( '_astra_ext_enabled_extensions', $extensions );
		}
	}

	/**
	 * Check extension status
	 *
	 * @param string $key      Key to find in Extensions Array.
	 * @param bool   $default  Default if Key not exist in Extensions Array.
	 * @return bool
	 * @since 1.0
	 */
	public static function is_active( $key, $default = false ) {
		$extensions = array_merge( self::get_enabled_addons(), self::get_default_addons() );

		if ( array_key_exists( $key, $extensions ) && $extensions[ $key ] ) {
			return true;
		}

		return $default;
	}

	/**
	 * Provide Custom 404 array().
	 *
	 * @return array()
	 * @since 1.0
	 */
	public static function get_custom_404() {

		$custom_404_default = array(
			'enable_404'  => false,
			'page_404'    => '',
			'page_404_id' => '',
		);

		return apply_filters( 'astra_addon_custom_404_options', $custom_404_default );
	}
}
