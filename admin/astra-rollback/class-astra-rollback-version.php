<?php
/**
 * Astra version Rollback file.
 *
 * @version 3.6.1
 *
 * @package astra-addon
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

/**
 * Class Astra_Rollback_version.
 */
class Astra_Rollback_Version {

	/**
	 * Version.
	 *
	 * Holds the version.
	 *
	 * @since 3.6.1
	 * @access protected
	 *
	 * @var string Package URL.
	 */
	protected $version;

	/**
	 * Plugin name.
	 *
	 * Holds the theme name.
	 *
	 * @since 3.6.1
	 * @access protected
	 *
	 * @var string Plugin name.
	 */
	protected $theme_name;

	/**
	 * Theme slug.
	 *
	 * Holds the Theme slug.
	 *
	 * @since 3.6.1
	 * @access protected
	 *
	 * @var string Theme slug.
	 */
	protected $theme_slug;

	/**
	 *
	 * Initializing Rollback.
	 *
	 * @since 3.6.1
	 * @access public
	 *
	 * @param array $args arguments for theme rollback.
	 */
	public function __construct( $args = array() ) {
		foreach ( $args as $key => $value ) {
			$this->{$key} = $value;
		}
	}

	/**
	 * Apply package.
	 *
	 * Change the theme data when WordPress checks for updates. This method
	 * modifies package data to update the theme from a specific URL containing
	 * the version package.
	 *
	 * @since 3.6.1
	 * @access protected
	 */
	protected function apply_package() {
		$update_themes = get_site_transient( 'update_themes' );
		if ( ! is_object( $update_themes ) ) {
			$update_themes = new stdClass();
		}

		$theme_info                = array();
		$theme_info['theme']       = $this->theme_slug;
		$theme_info['new_version'] = $this->version;
		$theme_info['slug']        = $this->theme_slug;
		$theme_info['package']     = sprintf( 'https://downloads.wordpress.org/theme/%s.%s.zip', $this->theme_slug, $this->version );

		$update_themes->response[ $this->theme_slug ] = $theme_info;
		set_site_transient( 'update_themes', $update_themes );
	}

	/**
	 * Upgrade.
	 *
	 * Run WordPress upgrade to Rollback to previous version.
	 *
	 * @since 3.6.1
	 * @access protected
	 */
	protected function upgrade() {

		require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
		$theme_name = self::astra_get_white_lable_name();

		$upgrader_args = array(
			'url'   => 'update.php?action=upgrade-theme&theme=' . rawurlencode( $this->theme_slug ),
			'theme' => $this->theme_slug,
			'nonce' => 'upgrade-theme_' . $this->theme_slug,
			/* translators: %s: whitelable name and version */
			'title' => sprintf( __( 'Rollback %1$s to version %2$s', 'astra-addon' ), $theme_name, $this->version ),
		);

		$upgrader = new Theme_Upgrader( new Theme_Upgrader_Skin( $upgrader_args ) );
		$upgrader->upgrade( $this->theme_slug );
	}

	/**
	 *
	 * Rollback to previous versions.
	 *
	 * @since 3.6.1
	 * @access public
	 */
	public function run() {
		$this->apply_package();
		$this->upgrade();
	}

	/**
	 * Get Rollback versions.
	 *
	 * @since 3.6.1
	 * @return array
	 * @access public
	 */
	public static function get_theme_all_versions() {

		$rollback_versions = get_transient( 'astra_theme_rollback_versions_' . ASTRA_THEME_VERSION );
		if ( ! empty( $rollback_versions ) ) {
			return $rollback_versions;
		}

		$max_versions      = apply_filters( 'astra_show_max_rollback_versions', 5 );
		$rollback_versions = array();

		require_once ABSPATH . 'wp-admin/includes/theme-install.php';

		$theme_information = themes_api(
			'theme_information',
			array(
				'slug'   => 'astra',
				'fields' => array(
					'versions' => true,
				),
			)
		);

		if ( empty( $theme_information->versions ) || ! is_array( $theme_information->versions ) ) {
			return $rollback_versions;
		}

		$reverse_theme_versions = array_reverse( $theme_information->versions ); // Reverse the order of array elements.

		foreach ( $reverse_theme_versions as $version => $download_link ) {

			$lowercase_version = strtolower( $version );

			$is_valid_rollback_version = ! preg_match( '/(trunk|beta|rc|dev)/i', $lowercase_version );

			if ( ! $is_valid_rollback_version ) {
				continue;
			}

			if ( version_compare( $version, ASTRA_THEME_VERSION, '>=' ) ) {
				continue;
			}

			$rollback_versions[] = $version;
		}

		$rollback_versions = array_slice( $rollback_versions, 0, $max_versions, true ); // Max verisons to be shown.
		set_transient( 'astra_theme_rollback_versions_' . ASTRA_THEME_VERSION, $rollback_versions, WEEK_IN_SECONDS );

		return $rollback_versions;
	}

	/**
	 * Get the astra white lable name.
	 */
	public static function astra_get_white_lable_name() {

		$theme_name               = __( 'Astra', 'astra-addon' );
		$theme_whitelabelled_name = Astra_Ext_White_Label_Markup::get_whitelabel_string( 'astra', 'name', false );

		if ( false !== $theme_whitelabelled_name ) {
			return $theme_whitelabelled_name;
		}

		return $theme_name;
	}

}
