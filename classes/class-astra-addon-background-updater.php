<?php
/**
 * Astra Addon Batch Update
 *
 * @package     Astra Addon
 * @since       2.1.3
 */

if ( ! class_exists( 'Astra_Addon_Background_Updater' ) ) {

	/**
	 * Astra_Addon_Background_Updater Class.
	 */
	class Astra_Addon_Background_Updater {
		/**
		 * Background update class.
		 *
		 * @var object
		 */
		private static $background_updater;

		/**
		 * DB updates and callbacks that need to be run per version.
		 *
		 * @var array
		 */
		private static $db_updates = array(
			'4.0.0'  => array(
				'astra_addon_background_updater_4_0_0',
			),
			'4.1.0'  => array(
				'astra_addon_background_updater_4_1_0',
			),
			'4.1.6'  => array(
				'astra_addon_background_updater_4_1_6',
			),
			'4.4.0'  => array(
				'astra_addon_background_updater_4_4_0',
			),
			'4.6.0'  => array(
				'astra_addon_background_updater_4_6_0',
			),
			'4.6.1'  => array(
				'astra_addon_background_updater_4_6_1',
			),
			'4.6.8'  => array(
				'astra_addon_background_updater_4_6_8',
			),
			'4.7.0'  => array(
				'astra_addon_background_updater_4_7_0',
			),
			'4.8.4'  => array(
				'astra_addon_background_updater_4_8_4',
			),
			'4.9.2'  => array(
				'astra_addon_background_updater_4_9_2',
			),
			'4.10.0' => array(
				'astra_addon_background_updater_4_10_0',
			),
		);

		/**
		 *  Constructor
		 */
		public function __construct() {

			// Addon Updates.
			if ( is_admin() ) {
				add_action( 'admin_init', array( $this, 'install_actions' ) );
			} else {
				add_action( 'wp', array( $this, 'install_actions' ) );
			}

			// Core Helpers - Batch Processing.
			require_once ASTRA_EXT_DIR . 'classes/library/batch-processing/wp-async-request.php';
			require_once ASTRA_EXT_DIR . 'classes/library/batch-processing/wp-background-process.php';
			require_once ASTRA_EXT_DIR . 'classes/library/batch-processing/class-wp-background-process-astra-addon.php';

			self::$background_updater = new WP_Background_Process_Astra_Addon();
		}

		/**
		 * Check if database is migrated
		 *
		 * @since 2.3.2
		 *
		 * @return true If the database migration should not be run through CRON.
		 */
		public function check_if_data_migrated() {

			$fallback = false;

			$is_db_version_updated = $this->is_db_version_updated();
			if ( ! $is_db_version_updated ) {

				$db_migrated = get_transient( 'astra-addon-db-migrated' );

				if ( ! $db_migrated ) {
					$db_migrated = array();
				}

				array_push( $db_migrated, $is_db_version_updated );
				set_transient( 'astra-addon-db-migrated', $db_migrated, 3600 );

				$db_migrate_count = count( $db_migrated );
				if ( $db_migrate_count >= 5 ) {

					$customizer_options = get_option( 'astra-settings' );

					// Get all customizer options.
					$version_array = array(
						'is_astra_addon_queue_running' => false,
					);

					// Merge customizer options with version.
					$astra_options = wp_parse_args( $version_array, $customizer_options );

					update_option( 'astra-settings', $astra_options );

					$fallback = true;
				}
			}
			return $fallback;
		}

		/**
		 * Checks if astra addon version is updated in the database
		 *
		 * @since 2.3.2
		 *
		 * @return true if astra addon version is updated.
		 */
		public function is_db_version_updated() {
			// Get auto saved version number.
			$saved_version = Astra_Addon_Update::astra_addon_stored_version();

			return version_compare( $saved_version, ASTRA_EXT_VER, '=' );
		}

		/**
		 * Check Cron Status
		 *
		 * Gets the current cron status by performing a test spawn. Cached for one hour when all is well.
		 *
		 * @since 2.3.0
		 *
		 * @return true if there is a problem spawning a call to Wp-Cron system.
		 */
		public function test_cron() {

			global $wp_version;

			if ( defined( 'DISABLE_WP_CRON' ) && DISABLE_WP_CRON ) {
				return true;
			}

			if ( defined( 'ALTERNATE_WP_CRON' ) && ALTERNATE_WP_CRON ) {
				return true;
			}

			$cached_status = get_transient( 'astra-addon-cron-test-ok' );

			if ( $cached_status ) {
				return false;
			}

			$sslverify     = version_compare( $wp_version, 4.0, '<' );
			$doing_wp_cron = sprintf( '%.22F', microtime( true ) );

			$cron_request = apply_filters(
				'cron_request', // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound
				array(
					'url'  => site_url( 'wp-cron.php?doing_wp_cron=' . $doing_wp_cron ),
					'args' => array(
						'timeout'   => 3,
						'blocking'  => true,
						'sslverify' => apply_filters( 'https_local_ssl_verify', $sslverify ), // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound
					),
				)
			);

			$result = wp_remote_post( $cron_request['url'], $cron_request['args'] );

			if ( wp_remote_retrieve_response_code( $result ) >= 300 ) {
				return true;
			}

			set_transient( 'astra-addon-cron-test-ok', 1, 3600 );
			return false;
		}

		/**
		 * Install actions when a update button is clicked within the admin area.
		 *
		 * This function is hooked into admin_init to affect admin and wp to affect the frontend.
		 *
		 * @since 2.1.3
		 * @return void
		 */
		public function install_actions() {

			if ( true === $this->is_new_install() ) {
				self::update_db_version();
				return;
			}

			$customizer_options = get_option( 'astra-settings' );

			$fallback         = $this->test_cron();
			$db_migrated      = $this->check_if_data_migrated();
			$is_queue_running = isset( $customizer_options['is_astra_addon_queue_running'] ) && '' !== $customizer_options['is_astra_addon_queue_running'] ? $customizer_options['is_astra_addon_queue_running'] : false;

			$fallback = $db_migrated ? $db_migrated : $fallback;

			if ( $this->needs_db_update() && ! $is_queue_running ) {
				$this->update( $fallback );
			} else {
				if ( ! $is_queue_running ) {
					self::update_db_version();
				}
			}
		}

		/**
		 * Is this a brand new addon install?
		 *
		 * @since 2.1.3
		 * @return bool
		 */
		private function is_new_install() {
			// Get auto saved version number.
			$saved_version = Astra_Addon_Update::astra_addon_stored_version();
			return false === $saved_version;
		}

		/**
		 * Is a DB update needed?
		 *
		 * @since 2.1.3
		 * @return bool
		 */
		private function needs_db_update() {

			$updates = $this->get_db_update_callbacks();

			if ( empty( $updates ) ) {
				return false;
			}

			$versions = array_keys( $updates );
			$latest   = $versions[ count( $versions ) - 1 ];

			$customizer_options = get_option( 'astra-settings' );

			$addon_auto_version = isset( $customizer_options['astra-addon-auto-version'] ) && '' !== $customizer_options['astra-addon-auto-version'] ? $customizer_options['astra-addon-auto-version'] : null;

			return ! is_null( $addon_auto_version ) && version_compare( $addon_auto_version, $latest, '<' );
		}

		/**
		 * Get list of DB update callbacks.
		 *
		 * @since 2.1.3
		 * @return array
		 */
		public function get_db_update_callbacks() {
			return self::$db_updates;
		}

		/**
		 * Push all needed DB updates to the queue for processing.
		 *
		 * @param bool $fallback Fallback migration.
		 */
		private function update( $fallback ) {

			$current_db_version = Astra_Addon_Update::astra_addon_stored_version();

			// Check if the error_log function exists before calling it.
			if ( function_exists( 'error_log' ) ) {
				error_log( 'Astra Addon: Batch Process Started!' ); // phpcs:ignore WordPress.PHP.DevelopmentFunctions.error_log_error_log
			}

			if ( count( $this->get_db_update_callbacks() ) > 0 ) {
				foreach ( $this->get_db_update_callbacks() as $version => $update_callbacks ) {
					if ( version_compare( $current_db_version, $version, '<' ) ) {
						foreach ( $update_callbacks as $update_callback ) {
							if ( $fallback ) {
								call_user_func( $update_callback );
							} else {
								// Check if the error_log function exists before calling it.
								if ( function_exists( 'error_log' ) ) {
									error_log( sprintf( 'Astra Addon: Queuing %s - %s', $version, $update_callback ) ); // phpcs:ignore WordPress.PHP.DevelopmentFunctions.error_log_error_log
								}
								self::$background_updater->push_to_queue( $update_callback );
							}
						}
					}
				}

				if ( $fallback ) {
					// Check if the error_log function exists before calling it.
					if ( function_exists( 'error_log' ) ) {
						error_log( 'Astra Addon: Running migration without batch processing.' ); // phpcs:ignore WordPress.PHP.DevelopmentFunctions.error_log_error_log
					}
					self::update_db_version();
				} else {
					$customizer_options = get_option( 'astra-settings' );

					// Get all customizer options.
					$version_array = array(
						'is_astra_addon_queue_running' => true,
					);

					// Merge customizer options with version.
					$astra_options = wp_parse_args( $version_array, $customizer_options );

					update_option( 'astra-settings', $astra_options );

					self::$background_updater->push_to_queue( 'update_db_version' );
				}
			} else {
				self::$background_updater->push_to_queue( 'update_db_version' );
			}
			self::$background_updater->save()->dispatch();
		}

		/**
		 * Update DB version to current.
		 *
		 * @param string|null $version New Astra addon version or null.
		 */
		public static function update_db_version( $version = null ) {

			do_action( 'astra_addon_update_before' );

			// Get auto saved version number.
			$saved_version       = Astra_Addon_Update::astra_addon_stored_version();
			$astra_addon_version = ASTRA_EXT_VER;

			if ( false === $saved_version ) {

				// Get all customizer options.
				$customizer_options = get_option( 'astra-settings' );

				// Get all customizer options.
				/* Add Current version constant "ASTRA_EXT_VER" here after 1.0.0-rc.9 update */
				$version_array = array(
					'astra-addon-auto-version' => ASTRA_EXT_VER,
				);
				$saved_version = ASTRA_EXT_VER;

				// Merge customizer options with version.
				$astra_options = wp_parse_args( $version_array, $customizer_options );

				// Update auto saved version number.
				update_option( 'astra-settings', $astra_options );

			}

			// If equals then return.
			if ( version_compare( $saved_version, ASTRA_EXT_VER, '=' ) ) {

				// Get all customizer options.
				$customizer_options = get_option( 'astra-settings' );

				// Get all customizer options.
				$options_array = array(
					'is_astra_addon_queue_running' => false,
				);

				// Merge customizer options with version.
				$astra_options = wp_parse_args( $options_array, $customizer_options );

				// Update auto saved version number.
				update_option( 'astra-settings', $astra_options );

				return;
			}

			$astra_addon_version = ASTRA_EXT_VER;

			// Get all customizer options.
			$customizer_options = get_option( 'astra-settings' );

			// Get all customizer options.
			$options_array = array(
				'astra-addon-auto-version'     => $astra_addon_version,
				'is_astra_addon_queue_running' => false,
			);

			// Merge customizer options with version.
			$astra_options = wp_parse_args( $options_array, $customizer_options );

			// Update auto saved version number.
			update_option( 'astra-settings', $astra_options );
			if ( function_exists( 'error_log' ) ) {
				error_log( 'Astra Addon: DB version updated!' ); // phpcs:ignore WordPress.PHP.DevelopmentFunctions.error_log_error_log
			}
			// Update variables.
			Astra_Theme_Options::refresh();

			// Refresh Astra Addon CSS and JS Files on update.
			Astra_Minify::refresh_assets();

			delete_transient( 'astra-addon-db-migrated' );

			do_action( 'astra_addon_update_after' );
		}
	}
}

/**
 * Kicking this off by creating a new instance
 */
new Astra_Addon_Background_Updater();
