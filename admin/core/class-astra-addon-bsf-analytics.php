<?php
/**
 * Astra Addon BSF Analytics class helps to connect BSF Analytics.
 *
 * @package astra.
 */

defined( 'ABSPATH' ) or exit;

/**
 * Astra Addon BSF Analytics class.
 *
 * @since 4.10.0
 */
class Astra_Addon_BSF_Analytics {
	/**
	 * Instance object.
	 *
	 * @var self Class Instance.
	 */
	private static $instance = null;

	/**
	 * Class constructor.
	 *
	 * @return void
	 * @since 4.10.0
	 */
	public function __construct() {
		/*
		* BSF Analytics.
		*/
		if ( ! class_exists( 'BSF_Analytics_Loader' ) ) {
			require_once ASTRA_EXT_DIR . 'admin/bsf-analytics/class-bsf-analytics-loader.php';
		}

		add_action( 'init', array( $this, 'init_bsf_analytics' ), 5 );
		add_filter( 'bsf_core_stats', array( $this, 'add_astra_addon_analytics_data' ) );
		add_filter( 'astra_deactivation_survey_data', array( $this, 'addon_deactivation_survey_data' ) );
	}

	/**
	 * Initializes BSF Analytics.
	 *
	 * @since 4.10.0
	 * @return void
	 */
	public function init_bsf_analytics() {
		// Bail early if BSF_Analytics_Loader::get_instance is not callable and if Astra white labelling is enabled.
		if ( ! is_callable( '\BSF_Analytics_Loader::get_instance' ) || ! Astra_Ext_White_Label_Markup::show_branding() ) {
			return;
		}

		// Skip initialization if the Astra theme version is 4.10.0 or higher, as they already have analytics integrated.
		if ( version_compare( ASTRA_THEME_VERSION, '4.10.0', '>=' ) ) {
			return;
		}

		$astra_addon_bsf_analytics = \BSF_Analytics_Loader::get_instance();
		$astra_addon_bsf_analytics->set_entity(
			array(
				'astra' => array(
					'product_name'        => 'Astra Pro',
					'path'                => ASTRA_EXT_DIR . 'admin/bsf-analytics',
					'author'              => 'brainstormforce',
					'time_to_display'     => '+24 hours',

					/* Deactivation Survey */
					'deactivation_survey' => apply_filters(
						'astra_deactivation_survey_data',
						$this->addon_deactivation_survey_data( array() )
					),
				),
			)
		);
	}

	/**
	 * Callback function to add Astra Addon specific analytics data.
	 *
	 * @param array $stats_data existing stats_data.
	 *
	 * @since 4.10.0
	 * @return array
	 */
	public function add_astra_addon_analytics_data( $stats_data ) {
		$license_enabled         = ASTRA_ADDON_BSF_PACKAGE && class_exists( 'BSF_License_Manager' ) && BSF_License_Manager::bsf_is_active_license( bsf_extract_product_id( ASTRA_EXT_DIR ) );
		$is_using_color_switcher = class_exists( 'Astra_Addon_Builder_Helper' ) && Astra_Addon_Builder_Helper::is_component_loaded( 'color-switcher', 'header' );

		if ( ! isset( $stats_data['plugin_data']['astra'] ) ) {
			$stats_data['plugin_data']['astra'] = array();
		}

		$astra_addon_stats = array(
			'pro_version'     => ASTRA_EXT_VER,
			'boolean_values'  => array(
				'license_enabled'         => $license_enabled,
				'is_using_color_switcher' => $is_using_color_switcher,
			),
			'file_generation' => get_option( '_astra_file_generation', 'disable' ),
			'beta'            => get_option( '_astra_beta_updates', 'disable' ),
		);

		self::add_addon_modules_analytics_data( $astra_addon_stats );

		$stats_data['plugin_data']['astra'] = array_merge_recursive( $stats_data['plugin_data']['astra'], $astra_addon_stats );

		return $stats_data;
	}

	/**
	 * Method to updates the analytics data with the enabled status of these modules.
	 *     advanced-hooks (Site Builder)
	 *     blog-pro
	 *     colors-and-background
	 *     advanced-footer
	 *     mobile-header
	 *     header-sections
	 *     lifterlms
	 *     learndash
	 *     advanced-headers (Page Headers)
	 *     site-layouts
	 *     spacing
	 *     sticky-header
	 *     transparent-header
	 *     typography
	 *     woocommerce
	 *     edd
	 *     nav-menu
	 *
	 * @param array $astra_addon_stats The analytics data array to be updated.
	 *
	 * @since 4.10.0
	 * @return void
	 */
	public static function add_addon_modules_analytics_data( &$astra_addon_stats ) {
		// Fetch enabled modules.
		$active_modules = Astra_Ext_Extension::get_enabled_addons();
		foreach ( $active_modules as $module => $status ) {
			$key = 'module_' . str_replace( '-', '_', $module ) . '_enabled';
			$astra_addon_stats['boolean_values'][ $key ] = boolval( $status );
		}
	}

	/**
	 * Adds Astra Addon specific deactivation survey data to the existing array.
	 *
	 * @param array $deactivation_data Existing deactivation survey data.
	 *
	 * @since 4.10.0
	 * @return array Updated array including Astra Addon deactivation survey data.
	 */
	public function addon_deactivation_survey_data( $deactivation_data ) {
		$deactivation_data[] = array(
			'id'                => 'deactivation-survey-astra-addon',
			'popup_logo'        => ASTRA_THEME_URI . 'inc/assets/images/astra-logo.svg',
			'plugin_slug'       => 'astra-addon',
			'popup_title'       => __( 'Quick Feedback', 'astra-addon' ),
			'support_url'       => 'https://wpastra.com/contact/',
			'popup_description' => __( 'If you have a moment, please share why you are deactivating Astra Pro:', 'astra-addon' ),
			'show_on_screens'   => array( 'plugins' ),
			'plugin_version'    => ASTRA_EXT_VER,
		);

		return $deactivation_data;
	}

	/**
	 * Initiator.
	 *
	 * @since 4.10.0
	 * @return self initialized object of class.
	 */
	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}
}

/**
 * Initiates the Astra_Addon_BSF_Analytics class instance.
 */
Astra_Addon_BSF_Analytics::get_instance();
