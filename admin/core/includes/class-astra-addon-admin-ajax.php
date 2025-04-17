<?php
/**
 * Astra Admin Ajax Base.
 *
 * @package Astra
 * @since 4.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class Astra_Addon_Admin_Ajax.
 *
 * @since 4.0.0
 */
class Astra_Addon_Admin_Ajax {
	/**
	 * Ajax action prefix.
	 *
	 * @var string
	 * @since 4.0.0
	 */
	private $prefix = 'astra';

	/**
	 * Instance
	 *
	 * @var object Class object.
	 * @since 4.0.0
	 */
	private static $instance;

	/**
	 * Initiator
	 *
	 * @since 4.0.0
	 * @return object initialized object of class.
	 */
	public static function get_instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Erros class instance.
	 *
	 * @var object
	 * @since 4.0.0
	 */
	private $errors = array();

	/**
	 * Constructor
	 *
	 * @since 4.0.0
	 */
	public function __construct() {
		// Delay translation loading.
		add_action( 'init', array( $this, 'load_translations' ) );
	
		// Ajax requests.
		add_action( 'wp_ajax_astra_addon_update_module_status', array( $this, 'update_module_status' ) );

		add_action( 'wp_ajax_astra_addon_bulk_activate_modules', array( $this, 'bulk_activate_modules' ) );
		add_action( 'wp_ajax_astra_addon_bulk_deactivate_modules', array( $this, 'bulk_deactivate_modules' ) );

		add_action( 'wp_ajax_astra_addon_clear_cache', array( $this, 'clear_cache' ) );

		// Enable/Disable beta updates.
		add_action( 'wp_ajax_astra_beta_updates', array( $this, 'enable_disable_beta_updates' ) );

		// Enable/Disable file generation.
		add_action( 'wp_ajax_astra_file_generation', array( $this, 'enable_disable_file_generation' ) );

		// Enable/Disable file generation.
		add_action( 'wp_ajax_astra_addon_update_whitelabel', array( $this, 'astra_addon_update_whitelabel' ) );
	}
	
	/**
	 * Load translation strings after 'init'.
	 * @since 4.10.0
	 */
	public function load_translations() {
		$this->errors = array(
			'permission' => __( 'Sorry, you are not allowed to do this operation.', 'astra-addon' ),
			'nonce'      => __( 'Nonce validation failed', 'astra-addon' ),
			'default'    => __( 'Sorry, something went wrong.', 'astra-addon' ),
			'invalid'    => __( 'No post data found!', 'astra-addon' ),
		);
	}
	

	/**
	 * Return settings for admin dashboard app.
	 *
	 * @param array $data_settings admin settings based on their data types.
	 *
	 * @return array
	 * @since 4.0.0
	 */
	public function astra_admin_settings_typewise( $data_settings ) {
		return $data_settings;
	}

	/**
	 * Update pro addon module status. activate/deactivate
	 *
	 * @since 4.0.0
	 */
	public function update_module_status() {

		$response_data = array( 'message' => $this->get_error_msg( 'permission' ) );

		if ( ! current_user_can( 'manage_options' ) ) {
			wp_send_json_error( $response_data );
		}

		if ( empty( $_POST ) ) {
			$response_data = array( 'message' => $this->get_error_msg( 'invalid' ) );
			wp_send_json_error( $response_data );
		}

		/**
		 * Nonce verification.
		 */
		if ( ! check_ajax_referer( 'astra_addon_update_admin_setting', 'security', false ) ) {
			$response_data = array( 'message' => $this->get_error_msg( 'nonce' ) );
			wp_send_json_error( $response_data );
		}

		$module_id                = isset( $_POST['module_id'] ) ? sanitize_text_field( $_POST['module_id'] ) : '';
		$module_status            = isset( $_POST['module_status'] ) ? sanitize_text_field( $_POST['module_status'] ) : '';
		$extensions               = Astra_Ext_Extension::get_enabled_addons();
		$extensions[ $module_id ] = 'activate' === $module_status ? $module_id : false;
		$extensions               = array_map( 'esc_attr', $extensions );
		Astra_Admin_Helper::update_admin_settings_option( '_astra_ext_enabled_extensions', $extensions );

		if ( 'http2' == $module_id ) {
			Astra_Admin_Helper::update_admin_settings_option( '_astra_ext_http2', true );
		}

		set_transient( 'astra_addon_activated_transient', $module_id );

		wp_send_json_success();
	}

	/**
	 * Activate all module
	 */
	public function bulk_activate_modules() {

		$response_data = array( 'message' => $this->get_error_msg( 'permission' ) );

		if ( ! current_user_can( 'manage_options' ) ) {
			wp_send_json_error( $response_data );
		}

		if ( empty( $_POST ) ) {
			$response_data = array( 'message' => $this->get_error_msg( 'invalid' ) );
			wp_send_json_error( $response_data );
		}

		/**
		 * Nonce verification.
		 */
		if ( ! check_ajax_referer( 'astra_addon_update_admin_setting', 'security', false ) ) {
			$response_data = array( 'message' => $this->get_error_msg( 'nonce' ) );
			wp_send_json_error( $response_data );
		}

		// Get all extensions.
		$all_extensions = Astra_Ext_Extension::get_addons();

		// Sanitize Addon list.
		foreach ( $all_extensions as $key => $value ) {
			$all_extensions[ sanitize_key( $key ) ] = $value;
		}

		$new_extensions = array();

		// Set all extension to enabled.
		foreach ( $all_extensions  as $slug => $value ) {
			$new_extensions[ $slug ] = $slug;
		}

		// Escape attrs.
		$new_extensions = array_map( 'esc_attr', $new_extensions );

		// Update new_extensions.
		Astra_Admin_Helper::update_admin_settings_option( '_astra_ext_enabled_extensions', $new_extensions );

		Astra_Admin_Helper::update_admin_settings_option( '_astra_ext_http2', true );

		set_transient( 'astra_addon_activated_transient', $new_extensions );

		wp_send_json_success();
	}

	/**
	 * Deactivate all module
	 */
	public function bulk_deactivate_modules() {

		$response_data = array( 'message' => $this->get_error_msg( 'permission' ) );

		if ( ! current_user_can( 'manage_options' ) ) {
			wp_send_json_error( $response_data );
		}

		if ( empty( $_POST ) ) {
			$response_data = array( 'message' => $this->get_error_msg( 'invalid' ) );
			wp_send_json_error( $response_data );
		}

		/**
		 * Nonce verification.
		 */
		if ( ! check_ajax_referer( 'astra_addon_update_admin_setting', 'security', false ) ) {
			$response_data = array( 'message' => $this->get_error_msg( 'nonce' ) );
			wp_send_json_error( $response_data );
		}

		// Get all extensions.
		$old_extensions = array_map( 'sanitize_text_field', Astra_Ext_Extension::get_enabled_addons() );
		$new_extensions = array();

		// Set all extension to enabled.
		foreach ( $old_extensions  as $slug => $value ) {
			$new_extensions[ $slug ] = false;
		}

		// Escape attrs.
		$new_extensions = array_map( 'esc_attr', $new_extensions );

		// Update new_extensions.
		Astra_Admin_Helper::update_admin_settings_option( '_astra_ext_enabled_extensions', $new_extensions );

		Astra_Admin_Helper::delete_admin_settings_option( '_astra_ext_http2' );

		set_transient( 'astra_addon_deactivated_transient', $new_extensions );

		wp_send_json_success();
	}

	/**
	 * Clear assets cache.
	 */
	public function clear_cache() {

		Astra_Minify::refresh_assets();

		wp_send_json_success();
	}

	/**
	 * Ajax handler to enable / disable the beta updates for Astra Theme and Astra Pro.
	 *
	 * @since 1.5.1
	 * @return void
	 */
	public function enable_disable_beta_updates() {
		$response_data = array( 'message' => $this->get_error_msg( 'permission' ) );

		if ( ! current_user_can( 'manage_options' ) ) {
			wp_send_json_error( $response_data );
		}

		if ( empty( $_POST ) ) {
			$response_data = array( 'message' => $this->get_error_msg( 'invalid' ) );
			wp_send_json_error( $response_data );
		}

		/**
		 * Nonce verification.
		 */
		if ( ! check_ajax_referer( 'astra_addon_update_admin_setting', 'security', false ) ) {
			$response_data = array( 'message' => $this->get_error_msg( 'nonce' ) );
			wp_send_json_error( $response_data );
		}

		$status = isset( $_POST['status'] ) ? sanitize_text_field( $_POST['status'] ) : false;

		if ( false !== $status ) {
			Astra_Admin_Helper::update_admin_settings_option( '_astra_beta_updates', $status, true );
			wp_send_json_success();
		}

		wp_send_json_error();
	}

	/**
	 * Ajax handler to enable / disable the file generation of scripts/styles for Astra Theme and Astra Pro.
	 *
	 * @since 1.5.1
	 * @return void
	 */
	public function enable_disable_file_generation() {
		$response_data = array( 'message' => $this->get_error_msg( 'permission' ) );

		if ( ! current_user_can( 'manage_options' ) ) {
			wp_send_json_error( $response_data );
		}

		if ( empty( $_POST ) ) {
			$response_data = array( 'message' => $this->get_error_msg( 'invalid' ) );
			wp_send_json_error( $response_data );
		}

		/**
		 * Nonce verification.
		 */
		if ( ! check_ajax_referer( 'astra_addon_update_admin_setting', 'security', false ) ) {
			$response_data = array( 'message' => $this->get_error_msg( 'nonce' ) );
			wp_send_json_error( $response_data );
		}

		$status = isset( $_POST['status'] ) ? sanitize_text_field( $_POST['status'] ) : false;

		if ( false !== $status ) {
			update_option( '_astra_file_generation', $status );
			wp_send_json_success();
		}

		wp_send_json_error();
	}

	/**
	 * Save whitelabel Settings.
	 *
	 * @since 4.0.0
	 */
	public function astra_addon_update_whitelabel() {

		$response_data = array( 'message' => $this->get_error_msg( 'permission' ) );

		if ( ! current_user_can( 'manage_options' ) ) {
			wp_send_json_error( $response_data );
		}

		if ( empty( $_POST ) ) {
			$response_data = array( 'message' => $this->get_error_msg( 'invalid' ) );
			wp_send_json_error( $response_data );
		}

		/**
		 * Nonce verification.
		 */
		if ( ! check_ajax_referer( 'astra_addon_update_admin_setting', 'security', false ) ) {
			$response_data = array( 'message' => $this->get_error_msg( 'nonce' ) );
			wp_send_json_error( $response_data );
		}

		$white_label_settings = Astra_Ext_White_Label_Markup::get_white_labels();
		$data                 = isset( $_POST['data'] ) ? array_map( 'sanitize_text_field', json_decode( stripslashes( sanitize_text_field( $_POST['data'] ) ), true ) ) : array();

		$parent = isset( $_POST['parent'] ) ? sanitize_text_field( $_POST['parent'] ) : false;
		$key    = isset( $_POST['key'] ) ? sanitize_text_field( $_POST['key'] ) : false;
		$value  = isset( $_POST['value'] ) ? stripslashes( sanitize_text_field( $_POST['value'] ) ) : false;

		if ( $parent && $key ) {
			if ( ! $parent || ! $key || ! $value ) {
				$response_data = array( 'message' => $this->get_error_msg( 'invalid' ) );
				wp_send_json_error( $response_data );
			}
			$white_label_settings[ $parent ][ $key ] = $value;
		} else {
			if ( ! $data ) {
				$response_data = array( 'message' => $this->get_error_msg( 'invalid' ) );
				wp_send_json_error( $response_data );
			}
			$white_label_settings['astra-agency']['author']     = isset( $data['agencyAuthorName'] ) ? $data['agencyAuthorName'] : $white_label_settings['astra-agency']['author'];
			$white_label_settings['astra-agency']['author_url'] = isset( $data['agencyAuthorURL'] ) ? $data['agencyAuthorURL'] : $white_label_settings['astra-agency']['author_url'];
			$white_label_settings['astra-agency']['licence']    = isset( $data['agencyLicenseLink'] ) ? $data['agencyLicenseLink'] : $white_label_settings['astra-agency']['licence'];
			$white_label_settings['astra']['name']              = isset( $data['themeName'] ) ? $data['themeName'] : $white_label_settings['astra']['name'];
			$white_label_settings['astra']['description']       = isset( $data['themeDescription'] ) ? $data['themeDescription'] : $white_label_settings['astra']['description'];
			$white_label_settings['astra']['screenshot']        = isset( $data['themeScreenshotURL'] ) ? $data['themeScreenshotURL'] : $white_label_settings['astra']['screenshot'];
			$white_label_settings['astra']['icon']              = isset( $data['themeIconURL'] ) ? $data['themeIconURL'] : $white_label_settings['astra']['icon'];
			$white_label_settings['astra-pro']['name']          = isset( $data['pluginName'] ) ? $data['pluginName'] : $white_label_settings['astra-pro']['name'];
			$white_label_settings['astra-pro']['description']   = isset( $data['pluginDescription'] ) ? $data['pluginDescription'] : $white_label_settings['astra-pro']['description'];
			$white_label_settings['astra-sites']['name']        = isset( $data['sTPluginName'] ) ? $data['sTPluginName'] : $white_label_settings['astra-sites']['name'];
			$white_label_settings['astra-sites']['description'] = isset( $data['sTPluginDescription'] ) ? $data['sTPluginDescription'] : $white_label_settings['astra-sites']['description'];
		}

		Astra_Admin_Helper::update_admin_settings_option( '_astra_ext_white_label', $white_label_settings, true );

		$theme_name = Astra_Ext_White_Label_Markup::get_whitelabel_string( 'astra', 'name', 'astra' );
		$response   = array(
			'rebranded_theme_name' => rawurlencode( $theme_name ),
		);

		wp_send_json_success( $response );
	}

	/**
	 * Get ajax error message.
	 *
	 * @param string $type Message type.
	 * @return string
	 * @since 4.0.0
	 */
	public function get_error_msg( $type ) {

		if ( ! isset( $this->errors[ $type ] ) ) {
			$type = 'default';
		}

		return $this->errors[ $type ];
	}
}

Astra_Addon_Admin_Ajax::get_instance();
