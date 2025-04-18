<?php
/**
 * Astra Addon Helper.
 *
 * @package Astra Addon
 */

/**
 * Class Astra_Addon_Filesystem.
 */
class Astra_Addon_Filesystem {
	/**
	 * Store instance of Astra_Addon_Filesystem
	 *
	 * @since 2.6.4.
	 * @var Astra_Addon_Filesystem
	 */
	protected static $instance = null;

	/**
	 * Get instance of Astra_Addon_Filesystem
	 *
	 * @since 2.6.4
	 * @return Astra_Addon_Filesystem
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Get WP_Filesystem instance.
	 *
	 * @since 2.6.4
	 * @return WP_Filesystem
	 */
	public function get_filesystem() {
		global $wp_filesystem;

		if ( ! $wp_filesystem ) {
			require_once ABSPATH . '/wp-admin/includes/file.php';// phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound

			$context = apply_filters( 'request_filesystem_credentials_context', false ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound

			add_filter( 'request_filesystem_credentials', array( $this, 'request_filesystem_credentials' ) );

			$creds = request_filesystem_credentials( site_url(), '', false, $context, null );

			WP_Filesystem( $creds, $context );
			remove_filter( 'request_filesystem_credentials', array( $this, 'request_filesystem_credentials' ) );
		}

		// Set the permission constants if not already set.
		if ( ! defined( 'FS_CHMOD_DIR' ) ) {
			define( 'FS_CHMOD_DIR', 0755 ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedConstantFound
		}

		if ( ! defined( 'FS_CHMOD_FILE' ) ) {
			define( 'FS_CHMOD_FILE', 0644 ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedConstantFound
		}

		return $wp_filesystem;
	}

	/**
	 * Sets credentials to true.
	 *
	 * @since 2.6.4
	 */
	public function request_filesystem_credentials() {
		return true;
	}

	/**
	 * Checks to see if the site has SSL enabled or not.
	 *
	 * @since 2.6.4
	 * @return bool
	 */
	public function is_ssl() {
		if ( is_ssl() ) {
			return true;
		}
		if ( 0 === stripos( get_option( 'siteurl' ), 'https://' ) ) {
			return true;
		}
		if ( isset( $_SERVER['HTTP_X_FORWARDED_PROTO'] ) && 'https' === $_SERVER['HTTP_X_FORWARDED_PROTO'] ) {
			return true;
		}

		return false;
	}

	/**
	 * Create uploads directory if it does not exist.
	 *
	 * @since 2.6.4
	 * @param String $dir directory path to be created.
	 * @return bool True of the directory is created. False if directory is not created.
	 */
	public function maybe_create_uploads_dir( $dir ) {
		// Create the upload dir if it doesn't exist.
		if ( ! file_exists( $dir ) ) {
			// Create the directory.
			$status = astra_addon_filesystem()->get_filesystem()->mkdir( $dir );

			// IF a directory cannot be created, return with false status.
			if ( false === $status ) {
				astra_addon_filesystem()->update_filesystem_access_status( $status );
				return false;
			}

			// Add an index file for security.
			astra_addon_filesystem()->get_filesystem()->put_contents( $dir . 'index.php', '' );
		}

		return true;
	}

	/**
	 * Update Filesystem status.
	 *
	 * @since 2.6.4
	 * @param bool $status status for filesystem access.
	 * @return void
	 */
	public function update_filesystem_access_status( $status ) {
		astra_update_option( 'file-write-access', $status );
	}

	/**
	 * Check if filesystem has write access.
	 *
	 * @since 2.6.4
	 * @return bool True if filesystem has access, false if does not have access.
	 */
	public function can_access_filesystem() {
		return (bool) astra_get_option( 'file-write-access', true );
	}

	/**
	 * Reset filesystem access status.
	 *
	 * @since 2.6.4
	 * @return void
	 */
	public function reset_filesystem_access_status() {
		astra_delete_option( 'file-write-access' );
	}

	/**
	 * Returns an array of paths for the upload directory
	 * of the current site.
	 *
	 * @since 2.6.4
	 * @param String $assets_dir directory name to be created in the WordPress uploads directory.
	 * @return array
	 */
	public function get_uploads_dir( $assets_dir ) {
		$wp_info = wp_upload_dir( null, false );

		// SSL workaround.
		if ( $this->is_ssl() ) {
			$wp_info['baseurl'] = str_ireplace( 'http://', 'https://', $wp_info['baseurl'] );
		}

		// Build the paths.
		$dir_info = array(
			'path' => $wp_info['basedir'] . '/' . $assets_dir . '/',
			'url'  => $wp_info['baseurl'] . '/' . $assets_dir . '/',
		);

		return apply_filters( 'astra_addon_get_assets_uploads_dir', $dir_info );
	}

	/**
	 * Delete file from the filesystem.
	 *
	 * @since 2.6.4
	 * @param String $file Path to the file or directory.
	 * @param bool   $recursive If set to true, changes file group recursively.
	 * @param bool   $type Type of resource. 'f' for file, 'd' for directory.
	 * @return void
	 */
	public function delete( $file, $recursive = false, $type = false ) {
		astra_addon_filesystem()->get_filesystem()->delete( $file, $recursive, $type );
	}

	/**
	 * Adds contents to the file.
	 *
	 * @param  string $file_path  Gets the assets path info.
	 * @param  string $style_data   Gets the CSS data.
	 * @since  2.6.4
	 * @return bool $put_content returns false if file write is not successful.
	 */
	public function put_contents( $file_path, $style_data ) {
		return astra_addon_filesystem()->get_filesystem()->put_contents( $file_path, $style_data );
	}

	/**
	 * Get contents of the file.
	 *
	 * @param  string $file_path  Gets the assets path info.
	 * @since  2.6.4
	 * @return bool $get_contents Gets te file contents.
	 */
	public function get_contents( $file_path ) {
		return astra_addon_filesystem()->get_filesystem()->get_contents( $file_path );
	}
}
