<?php
/**
 * Astra Admin Loader
 *
 * @package Astra
 * @since 4.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Astra_Addon_Admin_Loader
 *
 * @since 4.0.0
 */
class Astra_Addon_Admin_Loader {
	/**
	 * Instance
	 *
	 * @var object Class object.
	 * @since 4.0.0
	 */
	private static $instance;

	/**
	 * Option name
	 *
	 * @var string $option_name DB option name.
	 * @since 4.0.0
	 */
	private static $option_name = 'astra_admin_settings';

	/**
	 * Admin settings dataset
	 *
	 * @var array $astra_admin_settings Settings array.
	 * @since 4.0.0
	 */
	private static $astra_admin_settings = array();

	/**
	 * Plugin slug
	 *
	 * @since 1.0
	 * @var array $plugin_slug
	 */
	public static $plugin_slug = 'astra';

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
	 * Constructor
	 *
	 * @since 4.0.0
	 */
	public function __construct() {
		self::$astra_admin_settings = get_option( self::$option_name, array() );

		define( 'ASTRA_ADDON_ADMIN_DIR', ASTRA_EXT_DIR . 'admin/core/' );
		define( 'ASTRA_ADDON_ADMIN_URL', ASTRA_EXT_URI . 'admin/core/' );

		$this->includes();

		add_filter( 'astra_menu_priority', array( $this, 'update_admin_menu_position' ) );

		add_filter( 'astra_dashboard_rest_options', array( $this, 'update_addon_options_defaults' ) );
		add_filter( 'astra_admin_settings_datatypes', array( $this, 'update_addon_options_datatypes' ) );

		add_action( 'after_setup_theme', array( $this, 'init_admin_settings' ), 99 );
		add_action( 'admin_init', array( $this, 'settings_admin_scripts' ) );

		// Let WooCommerce know, Astra Pro is compatible with HPOS & New Product Editor.
		add_action( 'before_woocommerce_init', array( $this, 'declare_woo_compatibility' ) );
	}

	/**
	 * Update Astra's menu priority to show after Dashboard menu.
	 *
	 * @param int $menu_priority priority for admin menu.
	 * @since 4.0.0
	 */
	public function update_admin_menu_position( $menu_priority ) {
		return 2.1;
	}

	/**
	 * Update datatypes for further AJAX move.
	 *
	 * @param array $defaults Defaults for admin app.
	 *
	 * @since 4.0.0
	 */
	public function update_addon_options_datatypes( $defaults ) {
		$defaults['enable_beta']            = 'string';
		$defaults['enable_file_generation'] = 'string';

		return $defaults;
	}

	/**
	 * Update defaults on REST call.
	 *
	 * @param array $defaults Defaults for admin app.
	 *
	 * @since 4.0.0
	 */
	public function update_addon_options_defaults( $defaults ) {
		$white_label_markup_instance = Astra_Ext_White_Label_Markup::get_instance();

		$defaults['pro_addons']             = Astra_Ext_Extension::get_enabled_addons();
		$defaults['enable_file_generation'] = get_option( '_astra_file_generation', 'disable' );
		$defaults['show_self_branding']     = Astra_Ext_White_Label_Markup::show_branding();
		$defaults['enable_beta_update']     = Astra_Admin_Helper::get_admin_settings_option( '_astra_beta_updates', true, 'disable' );
		$defaults['plugin_description']     = $white_label_markup_instance->astra_pro_whitelabel_description();
		$defaults['plugin_name']            = $white_label_markup_instance->astra_pro_whitelabel_name();
		$defaults['theme_screenshot_url']   = $white_label_markup_instance::get_whitelabel_string( 'astra', 'screenshot', false );
		$defaults['theme_description']      = $white_label_markup_instance::get_whitelabel_string( 'astra', 'description', false );
		$defaults['theme_name']             = $white_label_markup_instance::get_whitelabel_string( 'astra', 'name', false );
		$defaults['agency_license_link']    = $white_label_markup_instance::get_whitelabel_string( 'astra-agency', 'licence', false );
		$defaults['agency_author_url']      = $white_label_markup_instance->astra_pro_whitelabel_author_url();
		$defaults['agency_author_name']     = $white_label_markup_instance->astra_pro_whitelabel_author();
		$defaults['theme_icon_url']         = $white_label_markup_instance::get_whitelabel_string( 'astra', 'icon', false );
		$defaults['st_plugin_name']         = $white_label_markup_instance::get_whitelabel_string( 'astra-sites', 'name', false );
		$defaults['st_plugin_description']  = $white_label_markup_instance::get_whitelabel_string( 'astra-sites', 'description', false );

		return $defaults;
	}

	/**
	 * Include required classes.
	 *
	 * @since 4.0.0
	 */
	public function init_admin_settings() {
		self::$plugin_slug = is_callable( 'Astra_Menu::get_theme_page_slug' ) ? Astra_Menu::get_theme_page_slug() : 'astra';
	}

	/**
	 * Include required classes.
	 *
	 * @since 4.0.0
	 */
	public function includes() {
		if ( is_admin() ) {
			/* Ajax init */
			require_once ASTRA_ADDON_ADMIN_DIR . 'includes/class-astra-addon-admin-ajax.php';

			/* BSF Analytics */
			require_once ASTRA_ADDON_ADMIN_DIR . 'class-astra-addon-bsf-analytics.php';
		}
	}

	/**
	 * Get Changelogs from API.
	 *
	 * @since 4.0.0
	 * @return array $changelog_data Changelog Data.
	 */
	public static function astra_get_addon_changelog_feed_data() {
		$changelog_data = array();
		$posts          = json_decode( wp_remote_retrieve_body( wp_remote_get( 'https://wpastra.com/wp-json/wp/v2/changelog?product=98&per_page=3' ) ) ); // Astra Pro.

		if ( isset( $posts ) && is_array( $posts ) ) {
			foreach ( $posts as $post ) {
				$changelog_data[] = array(
					'title'       => $post->title->rendered,
					'date'        => gmdate( 'l F j, Y', strtotime( $post->date ) ),
					'description' => $post->content->rendered,
					'link'        => $post->link,
				);
			}
		}

		return $changelog_data;
	}

	/**
	 * Get Theme Rollback versions.
	 *
	 * @param string $product astra-theme|astra-addon.
	 * @return array
	 * @since 4.0.0
	 */
	public static function astra_get_rollback_versions( $product = 'astra-theme' ) {
		$rollback_versions_options = array();

		if ( ASTRA_ADDON_BSF_PACKAGE ) {
			$rollback_versions = Astra_Rollback_version::get_theme_all_versions();

			if ( 'astra-addon' === $product ) {
				$product_id        = is_callable( 'bsf_extract_product_id' ) ? bsf_extract_product_id( ASTRA_EXT_DIR ) : '';
				$product_details   = get_brainstorm_product( $product_id );
				$installed_version = isset( $product_details['version'] ) ? $product_details['version'] : '';
				$product_versions  = BSF_Rollback_Version::bsf_get_product_versions( $product_id ); // Get Remote versions
				// Show versions above than latest install version of the product.
				$rollback_versions = BSF_Rollback_Version::sort_product_versions( $product_versions, $installed_version );
			}

			foreach ( $rollback_versions as $version ) {

				$version = array(
					'label' => $version,
					'value' => $version,
				);

				$rollback_versions_options[] = $version;
			}
		}

		return $rollback_versions_options;
	}

	/**
	 * Returns an value,
	 * based on the settings database option for the admin settings page.
	 *
	 * @param  string $key     The sub-option key.
	 * @param  mixed  $default Option default value if option is not available.
	 * @return mixed            Return the option value based on provided key
	 * @since 4.0.0
	 */
	public static function get_admin_settings_option( $key, $default = false ) {
		return isset( self::$astra_admin_settings[ $key ] ) ? self::$astra_admin_settings[ $key ] : $default;
	}

	/**
	 * Update an value of a key,
	 * from the settings database option for the admin settings page.
	 *
	 * @param string $key       The option key.
	 * @param mixed  $value     The value to update.
	 * @return mixed            Return the option value based on provided key
	 * @since 4.0.0
	 */
	public static function update_admin_settings_option( $key, $value ) {
		$astra_admin_updated_settings         = get_option( self::$option_name, array() );
		$astra_admin_updated_settings[ $key ] = $value;
		update_option( self::$option_name, $astra_admin_updated_settings );
	}

	/**
	 *  Initialize after Astra gets loaded.
	 *
	 * @since 4.0.0
	 */
	public function settings_admin_scripts() {
		// Enqueue admin scripts.
		if ( ! empty( $_GET['page'] ) && ( self::$plugin_slug === sanitize_text_field( $_GET['page'] ) || false !== strpos( sanitize_text_field( $_GET['page'] ), self::$plugin_slug . '_' ) ) ) { //phpcs:ignore
			add_action( 'admin_enqueue_scripts', array( $this, 'styles_scripts' ) );
		}
	}

	/**
	 * Enqueues the needed CSS/JS for the builder's admin settings page.
	 *
	 * @since 4.0.0
	 */
	public function styles_scripts() {

		if ( is_customize_preview() ) {
			return;
		}

		$handle            = 'astra-addon-admin-dashboard-app';
		$build_path        = ASTRA_ADDON_ADMIN_DIR . 'assets/build/';
		$build_url         = ASTRA_ADDON_ADMIN_URL . 'assets/build/';
		$script_asset_path = $build_path . 'dashboard-app.asset.php';

		$script_info = file_exists( $script_asset_path ) ? include $script_asset_path : array(
			'dependencies' => array(),
			'version'      => ASTRA_EXT_VER,
		);

		$script_dep = $script_info['dependencies'];

		wp_register_script(
			$handle,
			$build_url . 'dashboard-app.js',
			$script_dep,
			$script_info['version'],
			true
		);

		wp_register_style(
			$handle,
			ASTRA_ADDON_ADMIN_URL . 'assets/css/admin-custom.css',
			array(),
			ASTRA_EXT_VER
		);

		wp_enqueue_script( $handle );

		wp_set_script_translations( $handle, 'astra-addon' );

		wp_enqueue_style( $handle );

		wp_style_add_data( $handle, 'rtl', 'replace' );

		$product_id = ASTRA_ADDON_BSF_PACKAGE && is_callable( 'bsf_extract_product_id' ) ? bsf_extract_product_id( ASTRA_EXT_DIR ) : '';

		$white_label_markup_instance = Astra_Ext_White_Label_Markup::get_instance();
		$rollback_version            = isset( self::astra_get_rollback_versions( 'astra-addon' )[0] ) ? self::astra_get_rollback_versions( 'astra-addon' )[0] : ''; // phpcs:ignore PHPCompatibility.Syntax.NewFunctionArrayDereferencing.Found

		$localize = array(
			'theme_versions'                       => self::astra_get_rollback_versions(),
			'addon_versions'                       => self::astra_get_rollback_versions( 'astra-addon' ),
			'addon_rollback_nonce_url'             => esc_url( add_query_arg( 'version_no', $rollback_version, wp_nonce_url( admin_url( 'index.php?action=bsf_rollback&product_id=' . $product_id ), 'bsf_rollback' ) ) ),
			'addon_rollback_nonce_placeholder_url' => esc_url( wp_nonce_url( admin_url( 'index.php?action=bsf_rollback&version_no=VERSION&product_id=' . $product_id ), 'bsf_rollback' ) ),
			'astra_pro_changelog_data'             => self::astra_get_addon_changelog_feed_data(),
			'addon_name'                           => astra_get_addon_name(),
			'rollback_theme_name'                  => 'astra',
			'rollback_plugin_name'                 => 'astra-addon',
			'theme_rollback_url'                   => esc_url( admin_url() . 'index.php?action=astra-rollback&version_no=VERSION&_wpnonce=' . wp_create_nonce( 'astra_rollback' ) ),
			'addon_rollback_url'                   => esc_url( admin_url() . 'index.php?action=bsf_rollback&version_no=VERSION&product_id=astra-addon&_wpnonce=' . wp_create_nonce( 'bsf_rollback' ) ),
			'license_status'                       => ASTRA_ADDON_BSF_PACKAGE ? BSF_License_Manager::bsf_is_active_license( $product_id ) : false,
			'product'                              => 'astra-addon',
			'bsf_graupi_nonce'                     => wp_create_nonce( 'bsf_license_activation_deactivation_nonce' ),
			'update_nonce'                         => wp_create_nonce( 'astra_addon_update_admin_setting' ),
			'enable_beta'                          => Astra_Admin_Helper::get_admin_settings_option( '_astra_beta_updates', true, 'disable' ),
			'enable_file_generation'               => get_option( '_astra_file_generation', 'disable' ),
			'pro_extensions'                       => Astra_Ext_Extension::get_enabled_addons(),
			'show_self_branding'                   => Astra_Ext_White_Label_Markup::show_branding(),
			'plugin_description'                   => $white_label_markup_instance->astra_pro_whitelabel_description(),
			'plugin_name'                          => $white_label_markup_instance->astra_pro_whitelabel_name(),
			'theme_screenshot_url'                 => $white_label_markup_instance::get_whitelabel_string( 'astra', 'screenshot', false ),
			'theme_description'                    => $white_label_markup_instance::get_whitelabel_string( 'astra', 'description', false ),
			'theme_name'                           => $white_label_markup_instance::get_whitelabel_string( 'astra', 'name', false ),
			'agency_license_link'                  => $white_label_markup_instance::get_whitelabel_string( 'astra-agency', 'licence', false ),
			'agency_author_url'                    => $white_label_markup_instance->astra_pro_whitelabel_author_url(),
			'agency_author_name'                   => $white_label_markup_instance->astra_pro_whitelabel_author(),
			'theme_icon_url'                       => $white_label_markup_instance::get_whitelabel_string( 'astra', 'icon', false ),
			'st_plugin_name'                       => $white_label_markup_instance::get_whitelabel_string( 'astra-sites', 'name', false ),
			'st_plugin_description'                => $white_label_markup_instance::get_whitelabel_string( 'astra-sites', 'description', false ),
			'rest_api'                             => get_rest_url( '', 'astra/v1/admin/settings' ),
			'is_bsf_package'                       => ASTRA_ADDON_BSF_PACKAGE,
		);

		wp_localize_script( $handle, 'astra_addon_admin', apply_filters( 'astra_addon_react_admin_localize', $localize ) );
	}

	/**
	 * Get default/active tab for CPT admin tables.
	 *
	 * @since 4.0.0
	 * @param string $default default tab attr.
	 * @return string $current_tab
	 */
	public static function get_active_tab( $default = '' ) {
		$current_tab = $default;

		if ( ! empty( $_REQUEST['layout_type'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Nonce verification is not required for this non-sensitive request parameter.
			$current_tab = sanitize_text_field( $_REQUEST['layout_type'] ); // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Nonce verification is not required for this non-sensitive request parameter.
		}

		return $current_tab;
	}

	/**
	 * HTML Template for Admin Top Header preview.
	 *
	 * @param string $title Title.
	 * @param bool   $tabs Show tabs true/false.
	 * @param string $button_url Button redirection URL.
	 * @param string $kb_docs_url Button redirection URL.
	 *
	 * @since 4.0.0
	 */
	public static function admin_dashboard_header( $title, $tabs, $button_url, $kb_docs_url ) {
		?>
		<div class="ast-site-builder-table-view">
			<div class="-ml-5 ast-admin-top-bar-root -mb-11.5 [2.875rem] sm:mb-0">
				<div class="bg-white border-b border-solid border-slate-200 px-5">
					<div class="max-w-3xl mx-auto lg:max-w-full h-[62px]">
						<div class="relative flex flex-wrap flex-col sm:flex-row justify-between items-start sm:items-center h-full min-h-24 sm:min-h-15 pt-14 sm:pb-0 sm:pt-0">
							<div class="flex items-center gap-6">
								<a href="" target="_blank" rel="noopener">
									<img src="<?php echo esc_url( apply_filters( 'astra_admin_menu_icon', ASTRA_THEME_URI . 'inc/assets/images/astra-logo.svg' ) ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound ?>" class="lg:block h-[2.6rem] w-auto ast-theme-icon" alt="Workflow" >
								</a>
								<div class="flex items-center">
								<h5 class="text-2xl [8px] my-0 mr-3 pl-6 border-l-[1px] border-slate-200 font-semibold tracking-[-0.006em] align-middle table-view-header">Site Builder</h5>
									<a href="<?php echo esc_url( admin_url( $button_url ) ); ?>" class="text-xs text-astra font-medium leading-4 px-3 py-2 rounded-[0.1875rem] border border-solid bg-[#F6F7F7] no-underline">Add New</a>
								</div>
							</div>
							<div class="flex justify-end items-center font-inter gap-x-4">	
							<svg width="40" height="20" viewBox="0 0 40 20" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M4 0.25H36C38.0711 0.25 39.75 1.92893 39.75 4V16C39.75 18.0711 38.0711 19.75 36 19.75H4C1.92893 19.75 0.25 18.0711 0.25 16V4C0.25 1.92893 1.92893 0.25 4 0.25Z" fill="#F3F3F8"/>
								<path d="M4 0.25H36C38.0711 0.25 39.75 1.92893 39.75 4V16C39.75 18.0711 38.0711 19.75 36 19.75H4C1.92893 19.75 0.25 18.0711 0.25 16V4C0.25 1.92893 1.92893 0.25 4 0.25Z" stroke="#E6E6EF" stroke-width="0.5"/>
								<path d="M9.09144 14V5.6H11.9234C12.4834 5.6 12.9754 5.716 13.3994 5.948C13.8314 6.172 14.1674 6.488 14.4074 6.896C14.6554 7.296 14.7794 7.764 14.7794 8.3C14.7794 8.82 14.6674 9.284 14.4434 9.692C14.2194 10.1 13.9074 10.42 13.5074 10.652C13.1154 10.884 12.6634 11 12.1514 11H10.2674V14H9.09144ZM10.2674 9.908H12.1394C12.5634 9.908 12.9114 9.76 13.1834 9.464C13.4554 9.16 13.5914 8.772 13.5914 8.3C13.5914 7.812 13.4314 7.42 13.1114 7.124C12.7994 6.828 12.3994 6.68 11.9114 6.68H10.2674V9.908ZM16.1227 14V5.6H18.9547C19.5147 5.6 20.0067 5.712 20.4307 5.936C20.8627 6.152 21.1987 6.456 21.4387 6.848C21.6867 7.232 21.8107 7.68 21.8107 8.192C21.8107 8.696 21.6787 9.144 21.4147 9.536C21.1587 9.928 20.8067 10.236 20.3587 10.46C19.9107 10.676 19.4067 10.784 18.8467 10.784H17.2987V14H16.1227ZM20.8147 14L18.8227 10.568L19.7587 9.944L22.1467 14H20.8147ZM17.2987 9.704H19.0627C19.3507 9.704 19.6067 9.64 19.8307 9.512C20.0627 9.376 20.2467 9.196 20.3827 8.972C20.5267 8.74 20.5987 8.48 20.5987 8.192C20.5987 7.744 20.4427 7.38 20.1307 7.1C19.8187 6.82 19.4147 6.68 18.9187 6.68H17.2987V9.704ZM27.329 14.144C26.513 14.144 25.789 13.96 25.157 13.592C24.525 13.224 24.029 12.712 23.669 12.056C23.317 11.4 23.141 10.648 23.141 9.8C23.141 8.952 23.317 8.204 23.669 7.556C24.029 6.9 24.521 6.388 25.145 6.02C25.769 5.644 26.489 5.456 27.305 5.456C28.121 5.456 28.841 5.644 29.465 6.02C30.089 6.388 30.577 6.9 30.929 7.556C31.281 8.204 31.457 8.952 31.457 9.8C31.457 10.648 31.281 11.4 30.929 12.056C30.577 12.712 30.089 13.224 29.465 13.592C28.849 13.96 28.137 14.144 27.329 14.144ZM27.329 13.064C27.905 13.064 28.413 12.924 28.853 12.644C29.293 12.364 29.637 11.98 29.885 11.492C30.133 11.004 30.257 10.44 30.257 9.8C30.257 9.168 30.129 8.608 29.873 8.12C29.625 7.624 29.277 7.236 28.829 6.956C28.389 6.676 27.881 6.536 27.305 6.536C26.729 6.536 26.217 6.676 25.769 6.956C25.321 7.236 24.969 7.624 24.713 8.12C24.465 8.608 24.341 9.168 24.341 9.8C24.341 10.44 24.469 11.004 24.725 11.492C24.981 11.98 25.333 12.364 25.781 12.644C26.237 12.924 26.753 13.064 27.329 13.064Z" fill="#4F4E7C"/>
							</svg>
								<?php

								if ( ! astra_is_white_labelled() ) {
									?>
									<a href="<?php echo esc_url( $kb_docs_url ); ?>" target="_blank" class=" h-8 sm:h-10 flex items-center justify-center cursor-pointer rounded-full border border-slate-200">
										<?php echo class_exists( 'Astra_Builder_UI_Controller' ) ? wp_kses( Astra_Builder_UI_Controller::fetch_svg_icon( 'knowledge-base', false ), Astra_Addon_Kses::astra_addon_svg_kses_protocols() ) : ''; ?>
									</a>
									<?php
								}

								if ( Astra_Ext_White_Label_Markup::show_branding() ) {
									?>
									<a href="<?php echo esc_url( 'https://wpastra.com/whats-new/' ); ?>" target="_blank" class=" h-8 sm:h-10 flex items-center justify-center cursor-pointer rounded-full border border-slate-200">
									<?php echo class_exists( 'Astra_Builder_UI_Controller' ) ? wp_kses( Astra_Builder_UI_Controller::fetch_svg_icon( 'horn2', false ), Astra_Addon_Kses::astra_addon_svg_kses_protocols() ) : ''; ?>
								</a>
									<?php
								}
								?>

							</div>
						</div>
					</div>
				</div>
				<?php
				if ( $tabs ) {
					$current_type = '';
					$active_class = ' text-astra border-astra';
					$current_tab  = self::get_active_tab();

					if ( ! empty( $_REQUEST['layout_type'] ) && 'all' !== $current_tab ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Nonce verification is not required for this non-sensitive request parameter.
						$current_type = sanitize_text_field( $_REQUEST['layout_type'] ); // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Nonce verification is not required for this non-sensitive request parameter.
						$active_class = '';
					}

					$url_args = array(
						'post_type'   => ASTRA_ADVANCED_HOOKS_POST_TYPE,
						'layout_type' => $current_tab,
					);

					$custom_layout_types = array(
						'header'   => __( 'Header', 'astra-addon' ),
						'footer'   => __( 'Footer', 'astra-addon' ),
						'hooks'    => __( 'Hooks', 'astra-addon' ),
						'404-page' => __( '404 Page', 'astra-addon' ),
						'content'  => __( 'Page Content', 'astra-addon' ),
						'template' => __( 'Custom Template', 'astra-addon' ),
					);

					$baseurl         = add_query_arg( $url_args, admin_url( 'edit.php' ) );
					$all_layouts_url = add_query_arg( 'layout_type', 'all', admin_url( 'edit.php?post_type=' . ASTRA_ADVANCED_HOOKS_POST_TYPE ) );
					?>

					<div class="bg-white border-b border-slate-200 flex flex-wrap items-center -mb-0.5 border-b border-solid table-view-layout-section">
						<a class="text-sm font-medium ml-2 px-5 py-4 border-b-2 border-white no-underline <?php echo esc_attr( $active_class ); ?>" href="<?php echo esc_url( $all_layouts_url ); ?>">
							<?php
								echo esc_html__( 'All', 'astra-addon' );
							?>
						</a>
						<?php
						foreach ( $custom_layout_types as $type => $title ) {
							$type_url     = esc_url( add_query_arg( 'layout_type', $type, $baseurl ) );
							$active_class = $current_type === $type ? ' text-astra border-astra' : 'text-slate-600 border-white';
							?>
							<a
								class="text-sm font-medium px-5 py-4 border-b-2 no-underline <?php echo esc_attr( $active_class ); ?> hover:text-[#5c2ede]"
								href="<?php echo esc_url( $type_url ); ?>"
							>
								<?php echo esc_attr( $title ); ?>
							</a>
							<?php
						}

						?>
					</div>
				<?php } ?>
			</div>
					</div>
		<?php
	}

	/**
	 *  Declare Woo HPOS & New Product Editor Compatibility.
	 *
	 * @since 4.5.1
	 * @return void
	 */
	public function declare_woo_compatibility() {
		if ( class_exists( '\Automattic\WooCommerce\Utilities\FeaturesUtil' ) ) {
			\Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility( 'custom_order_tables', ASTRA_EXT_FILE, true );
			\Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility( 'product_block_editor', ASTRA_EXT_FILE, true );
		}
	}

}

Astra_Addon_Admin_Loader::get_instance();
