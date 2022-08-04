<?php
/**
 * Astra Theme Extension
 *
 * @package Astra Addon
 */

if ( ! class_exists( 'Astra_Theme_Extension' ) ) {

	/**
	 * Astra_Theme_Extension initial setup
	 *
	 * @since 1.0.0
	 */
	// @codingStandardsIgnoreStart
	class Astra_Theme_Extension { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedClassFound
		// @codingStandardsIgnoreEnd

		/**
		 * Member Variable
		 *
		 * @var instance
		 */
		private static $instance;

		/**
		 * Member Variable
		 *
		 * @var options
		 */
		public static $options;

		/**
		 * Control Value to use Checkbox | Toggle control in WP_Customize
		 *
		 * @var const control
		 */
		public static $switch_control;

		/**
		 * Control Value to use Setting Group | Color Group in WP_Customize
		 *
		 * @var const control
		 */
		public static $group_control;

		/**
		 * Control Value to use Selector control in WP_Customize
		 *
		 * @var const control
		 */
		public static $selector_control;

		/**
		 *  Initiator
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 * Constructor
		 */
		public function __construct() {

			// Activation hook.
			register_activation_hook( ASTRA_EXT_FILE, array( $this, 'activation_reset' ) );

			// deActivation hook.
			register_deactivation_hook( ASTRA_EXT_FILE, array( $this, 'deactivation_reset' ) );

			// Includes Required Files.
			$this->includes();

			if ( is_admin() ) {

				add_action( 'admin_init', array( $this, 'min_theme_version__error' ) );

				add_filter( 'astra_menu_options', array( $this, 'extension_menu_options' ), 9, 1 );

				// Enqueue Admin Scripts.
				add_action( 'astra_admin_settings_scripts', array( $this, 'admin_scripts' ) );

				// Ajax requests.
				add_action( 'wp_ajax_astra_addon_activate_module', array( $this, 'activate_module' ) );
				add_action( 'wp_ajax_astra_addon_deactivate_module', array( $this, 'deactivate_module' ) );

				add_action( 'wp_ajax_astra_addon_bulk_activate_modules', array( $this, 'bulk_activate_modules' ) );
				add_action( 'wp_ajax_astra_addon_bulk_deactivate_modules', array( $this, 'bulk_deactivate_modules' ) );

				add_action( 'wp_ajax_astra_addon_clear_cache', array( $this, 'clear_cache' ) );

				// Enable/Disable beta updates.
				add_action( 'wp_ajax_astra_beta_updates', array( $this, 'enable_disable_beta_updates' ) );

				// Enable/Disable file generation.
				add_action( 'wp_ajax_astra_file_generation', array( $this, 'enable_disable_file_generation' ) );

				// Admin enqueue script alpha color picker.
				add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_color_picker_scripts' ) );
			}

			add_action( 'init', array( $this, 'addons_action_hooks' ), 1 );
			add_action( 'after_setup_theme', array( $this, 'setup' ) );

			add_action( 'customize_controls_enqueue_scripts', array( $this, 'controls_scripts' ) );
			add_action( 'customize_register', array( $this, 'customize_register_before_theme' ), 5 );
			add_action( 'customize_register', array( $this, 'addon_customize_register' ), 99 );
			add_action( 'customize_preview_init', array( $this, 'preview_init' ), 1 );

			add_filter( 'body_class', array( $this, 'body_classes' ), 11, 1 );

			// Load textdomain.
			add_action( 'plugins_loaded', array( $this, 'load_textdomain' ) );
			add_action( 'plugins_loaded', array( $this, 'common_plugin_dependent_files' ) );
			add_action( 'wpml_loaded', array( $this, 'wpml_compatibility' ) );

			// add compatibility for custom layouts with polylang plugin.
			add_action( 'pll_init', array( $this, 'wpml_compatibility' ) );

			// Astra Addon List filter.
			add_filter( 'astra_addon_list', array( $this, 'astra_addon_list' ) );
			add_filter( 'astra_quick_settings', array( $this, 'astra_addon_quick_settings' ) );
			add_action( 'astra_addon_bulk_action', array( $this, 'astra_addon_bulk_action_markup' ) );

			add_action( 'plugin_action_links_' . ASTRA_EXT_BASE, array( $this, 'action_links' ) );

			if ( Astra_Ext_White_Label_Markup::show_branding() ) {
				add_action( 'astra_welcome_page_right_sidebar_before', array( $this, 'addon_licence_form' ) );
			} else {
				// if White Lebel settings is selected to Hide setting.
				add_action( 'astra_welcome_page_content_after', array( $this, 'addon_licence_form' ) );
			}

			add_action( 'astra_welcome_page_right_sidebar_content', array( $this, 'version_rollback_form' ), 30 );

			add_action( 'astra_welcome_page_right_sidebar_content', array( $this, 'astra_refresh_assets_files' ), 40 );

			add_action( 'astra_welcome_page_right_sidebar_content', array( $this, 'astra_beta_updates_form' ), 50 );

			// Redirect if old addon screen rendered.
			add_action( 'admin_init', array( $this, 'redirect_addon_listing_page' ) );

			add_action( 'enqueue_block_editor_assets', array( $this, 'addon_gutenberg_assets' ) );

			add_filter( 'astra_svg_icons', array( $this, 'astra_addon_svg_icons' ), 1, 10 );

			add_filter( 'bsf_show_versions_to_rollback_astra-addon', array( $this, 'astra_addon_rollback_versions_limit' ), 1, 10 );
		}

		/**
		 * Astra Addon action hooks
		 *
		 * @return void
		 */
		public function addons_action_hooks() {

			$activate_transient   = get_transient( 'astra_addon_activated_transient' );
			$deactivate_transient = get_transient( 'astra_addon_deactivated_transient' );

			if ( false != $activate_transient ) {
				do_action( 'astra_addon_activated', $activate_transient );
				delete_transient( 'astra_addon_activated_transient' );
			}

			if ( false != $deactivate_transient ) {
				do_action( 'astra_addon_deactivated', $deactivate_transient );
				delete_transient( 'astra_addon_deactivated_transient' );
			}
		}

		/**
		 * Activate module
		 */
		public function activate_module() {

			check_ajax_referer( 'astra-addon-module-nonce', 'nonce' );

			$module_id                = sanitize_text_field( $_POST['module_id'] );
			$extensions               = Astra_Ext_Extension::get_enabled_addons();
			$extensions[ $module_id ] = $module_id;
			$extensions               = array_map( 'esc_attr', $extensions );
			Astra_Admin_Helper::update_admin_settings_option( '_astra_ext_enabled_extensions', $extensions );

			if ( 'http2' == $module_id ) {
				Astra_Admin_Helper::update_admin_settings_option( '_astra_ext_http2', true );
			}

			set_transient( 'astra_addon_activated_transient', $module_id );

			wp_send_json_success();
		}

		/**
		 * Deactivate module
		 */
		public function deactivate_module() {

			check_ajax_referer( 'astra-addon-module-nonce', 'nonce' );
			$module_id                = sanitize_text_field( $_POST['module_id'] );
			$extensions               = Astra_Ext_Extension::get_enabled_addons();
			$extensions[ $module_id ] = false;
			$extensions               = array_map( 'esc_attr', $extensions );
			Astra_Admin_Helper::update_admin_settings_option( '_astra_ext_enabled_extensions', $extensions );

			if ( 'http2' == $module_id ) {
				Astra_Admin_Helper::delete_admin_settings_option( '_astra_ext_http2' );
			}

			set_transient( 'astra_addon_deactivated_transient', $module_id );

			wp_send_json_success();
		}

		/**
		 * Activate all module
		 */
		public function bulk_activate_modules() {

			check_ajax_referer( 'astra-addon-module-nonce', 'nonce' );

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

			echo 'success';

			die();
		}

		/**
		 * Deactivate all module
		 */
		public function bulk_deactivate_modules() {

			check_ajax_referer( 'astra-addon-module-nonce', 'nonce' );

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

			echo 'success';

			die();
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
			check_ajax_referer( 'astra-addon-module-nonce', 'nonce' );

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
			check_ajax_referer( 'astra-addon-module-nonce', 'nonce' );

			$status = isset( $_POST['status'] ) ? sanitize_text_field( $_POST['status'] ) : false;

			if ( false !== $status ) {
				update_option( '_astra_file_generation', $status );
				wp_send_json_success();
			}

			wp_send_json_error();
		}

		/**
		 * Add Body Classes
		 *
		 * @param  array $classes Body Class Array.
		 * @return array
		 */
		public function body_classes( $classes ) {

			// Current Astra Addon version.
			$classes[] = esc_attr( 'astra-addon-' . ASTRA_EXT_VER );

			return $classes;
		}


		/**
		 * Load Astra Pro Text Domain.
		 * This will load the translation textdomain depending on the file priorities.
		 *      1. Global Languages /wp-content/languages/astra-addon/ folder
		 *      2. Local dorectory /wp-content/plugins/astra-addon/languages/ folder
		 *
		 * @since  1.0.0
		 * @return void
		 */
		public function load_textdomain() {
			// Default languages directory for Astra Pro.
			$lang_dir = ASTRA_EXT_DIR . 'languages/';

			/**
			 * Filters the languages directory path to use for Astra Addon.
			 *
			 * @param string $lang_dir The languages directory path.
			 */
			$lang_dir = apply_filters( 'astra_addon_languages_directory', $lang_dir );

			// Traditional WordPress plugin locale filter.
			global $wp_version;

			$get_locale = get_locale();

			if ( $wp_version >= 4.7 ) {
				$get_locale = get_user_locale();
			}

			/**
			 * Language Locale for Astra Pro
			 *
			 * @var $get_locale The locale to use. Uses get_user_locale()` in WordPress 4.7 or greater,
			 *                  otherwise uses `get_locale()`.
			 */
			$locale = apply_filters( 'plugin_locale', $get_locale, 'astra-addon' ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound
			$mofile = sprintf( '%1$s-%2$s.mo', 'astra-addon', $locale );

			// Setup paths to current locale file.
			$mofile_local  = $lang_dir . $mofile;
			$mofile_global = WP_LANG_DIR . '/plugins/' . $mofile;

			if ( file_exists( $mofile_global ) ) {
				// Look in global /wp-content/languages/astra-addon/ folder.
				load_textdomain( 'astra-addon', $mofile_global );
			} elseif ( file_exists( $mofile_local ) ) {
				// Look in local /wp-content/plugins/astra-addon/languages/ folder.
				load_textdomain( 'astra-addon', $mofile_local );
			} else {
				// Load the default language files.
				load_plugin_textdomain( 'astra-addon', false, 'astra-addon/languages' );
			}
		}

		/**
		 * Show action links on the plugin screen.
		 *
		 * @param   mixed $links Plugin Action links.
		 * @return  array
		 */
		public function action_links( $links = array() ) {

			$slug                     = 'astra';
			$theme_whitelabelled_name = Astra_Ext_White_Label_Markup::get_whitelabel_string( 'astra', 'name', false );
			if ( false !== $theme_whitelabelled_name && ! empty( $theme_whitelabelled_name ) ) {
				$slug = Astra_Ext_White_Label_Markup::get_instance()->astra_whitelabelled_slug( 'astra' );
			}

			$action_links = array(
				'settings' => '<a href="' . esc_url( admin_url( 'themes.php?page=' . $slug ) ) . '" aria-label="' . esc_attr__( 'View Astra Pro settings', 'astra-addon' ) . '">' . esc_html__( 'Settings', 'astra-addon' ) . '</a>',
			);

			return array_merge( $action_links, $links );

		}

		/**
		 * Activation Reset
		 */
		public function activation_reset() {

			add_rewrite_endpoint( 'partial', EP_PERMALINK );
			// flush rewrite rules.
			flush_rewrite_rules();

			// Force check graupi bundled products.
			update_site_option( 'bsf_force_check_extensions', true );

			if ( is_multisite() ) {
				$branding = get_site_option( '_astra_ext_white_label' );
			} else {
				$branding = get_option( '_astra_ext_white_label' );
			}

			if ( isset( $branding['astra-agency']['hide_branding'] ) && false != $branding['astra-agency']['hide_branding'] ) {

				$branding['astra-agency']['hide_branding'] = false;

				if ( is_multisite() ) {
					update_site_option( '_astra_ext_white_label', $branding );
				} else {
					update_option( '_astra_ext_white_label', $branding );
				}
			}
			do_action( 'astra_addon_activate' );
		}

		/**
		 * Deactivation Reset
		 */
		public function deactivation_reset() {
			// flush rewrite rules.
			flush_rewrite_rules();
		}

		/**
		 * Includes
		 */
		public function includes() {
			require_once ASTRA_EXT_DIR . 'classes/helper-functions.php';
			require_once ASTRA_EXT_DIR . 'classes/class-astra-admin-helper.php';
			require_once ASTRA_EXT_DIR . 'classes/astra-theme-compatibility-functions.php';
			require_once ASTRA_EXT_DIR . 'classes/customizer/class-astra-addon-customizer.php';
			require_once ASTRA_EXT_DIR . 'classes/modules/target-rule/class-astra-target-rules-fields.php';
			require_once ASTRA_EXT_DIR . 'classes/modules/menu-sidebar/class-astra-menu-sidebar-animation.php';
			require_once ASTRA_EXT_DIR . 'classes/class-astra-ext-extension.php';
			require_once ASTRA_EXT_DIR . 'classes/class-astra-templates.php';

			// White Lebel.
			require_once ASTRA_EXT_DIR . 'classes/class-astra-ext-white-label-markup.php';

			// Page Builder compatibility base class.
			require_once ASTRA_EXT_DIR . 'classes/compatibility/class-astra-addon-page-builder-compatibility.php';

			require_once ASTRA_EXT_DIR . 'classes/compatibility/class-astra-addon-beaver-builder-compatibility.php';
			require_once ASTRA_EXT_DIR . 'classes/compatibility/class-astra-addon-divi-compatibility.php';
			require_once ASTRA_EXT_DIR . 'classes/compatibility/class-astra-addon-elementor-compatibility.php';
			require_once ASTRA_EXT_DIR . 'classes/compatibility/class-astra-addon-thrive-compatibility.php';
			require_once ASTRA_EXT_DIR . 'classes/compatibility/class-astra-addon-visual-composer-compatibility.php';
			require_once ASTRA_EXT_DIR . 'classes/compatibility/class-astra-addon-brizy-compatibility.php';
			require_once ASTRA_EXT_DIR . 'classes/compatibility/class-astra-addon-nginx-helper-compatibility.php';
			require_once ASTRA_EXT_DIR . 'classes/compatibility/class-astra-addon-run-cloud-helper-compatibility.php';
			require_once ASTRA_EXT_DIR . 'classes/compatibility/class-astra-addon-gutenberg-compatibility.php';

			// AMP Compatibility.
			require_once ASTRA_EXT_DIR . 'classes/compatibility/class-astra-addon-amp-compatibility.php';
			require_once ASTRA_EXT_DIR . 'admin/astra-rollback/class-astra-rollback-version.php';
			require_once ASTRA_EXT_DIR . 'admin/astra-rollback/class-astra-rollback-version-manager.php';
		}

		/**
		 * Add extension option in menu page
		 *
		 * @param  array $actions   Array of actions.
		 * @return array            Return the actions.
		 */
		public function extension_menu_options( $actions ) {

			$actions['addons'] = array(
				'label' => esc_html__( 'Addons', 'astra-addon' ),
				'show'  => ! is_network_admin(),
			);
			return $actions;
		}

		/**
		 * Admin Scripts
		 */
		public function admin_scripts() {
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );
		}

		/**
		 * Admin Scripts Callback
		 */
		public function enqueue_admin_scripts() {

			// Styles.
			wp_enqueue_style( 'ast-ext-admin-settings', ASTRA_EXT_URI . 'admin/assets/css/ast-ext-admin-settings.css', array(), ASTRA_EXT_VER );

			// Scripts.
			wp_enqueue_script( 'astra-ext-admin-settings', ASTRA_EXT_URI . 'admin/assets/js/ast-ext-admin-settings.js', array( 'jquery-ui-tooltip' ), ASTRA_EXT_VER, false );

			$options = array(
				'ajax_nonce'                 => wp_create_nonce( 'astra-addon-module-nonce' ),
				'activate'                   => __( 'Activate', 'astra-addon' ),
				'deactivate'                 => __( 'Deactivate', 'astra-addon' ),
				'enableBetaUpdates'          => __( 'Enable Beta Updates', 'astra-addon' ),
				'disableBetaUpdates'         => __( 'Disable Beta Updates', 'astra-addon' ),
				'enableFileGeneration'       => __( 'Enable File Generation', 'astra-addon' ),
				'disableFileGeneration'      => __( 'Disable File Generation', 'astra-addon' ),
				'assetsRefreshingButtonText' => __( 'Refreshing', 'astra-addon' ),
				'assetsRefreshedButtonText'  => __( 'Refreshed', 'astra-addon' ),
				'adminUrl'                   => admin_url( 'post-new.php?post_type=' ),
				'customLayoutText'           => __( 'Custom Layouts', 'astra-addon' ),
				'pageHeadersText'            => __( 'Page Headers', 'astra-addon' ),
			);

			wp_localize_script( 'astra-ext-admin-settings', 'astraAddonModules', $options );
		}

		/**
		 * After Setup Theme
		 */
		public function setup() {

			if ( ! defined( 'ASTRA_THEME_VERSION' ) ) {
				return;
			}
			require_once ASTRA_EXT_DIR . 'classes/class-astra-icons.php';

			if ( version_compare( ASTRA_THEME_VERSION, '3.1.0', '>=' ) ) {
				self::$switch_control   = 'ast-toggle-control';
				self::$group_control    = 'ast-color-group';
				self::$selector_control = 'ast-selector';
			} else {
				self::$switch_control   = 'checkbox';
				self::$group_control    = 'ast-settings-group';
				self::$selector_control = 'select';
			}

			require_once ASTRA_EXT_DIR . 'classes/class-astra-addon-builder-loader.php';

			/**
			 * Load deprecated filters.
			 */
			require_once ASTRA_EXT_DIR . 'classes/deprecated/deprecated-filters.php';

			/**
			 * Load deprecated actions.
			 */
			require_once ASTRA_EXT_DIR . 'classes/deprecated/deprecated-actions.php';

			require_once ASTRA_EXT_DIR . 'classes/astra-common-functions.php';
			require_once ASTRA_EXT_DIR . 'classes/class-astra-addon-update-filter-function.php';

			require_once ASTRA_EXT_DIR . 'classes/astra-common-dynamic-css.php';

			if ( function_exists( 'astra_addon_filesystem' ) ) {
				require_once ASTRA_EXT_DIR . 'classes/cache/class-astra-cache-base.php';
				require_once ASTRA_EXT_DIR . 'classes/cache/class-astra-cache.php';
			}

			require_once ASTRA_EXT_DIR . 'classes/class-astra-minify.php';

			if ( function_exists( 'astra_addon_filesystem' ) ) {
				require_once ASTRA_EXT_DIR . 'classes/cache/class-astra-addon-cache.php';
			}
			require_once ASTRA_EXT_DIR . 'classes/class-astra-ext-model.php';

		}
		/**
		 * Load Gutenberg assets
		 */
		public function addon_gutenberg_assets() {

			if ( ! defined( 'ASTRA_THEME_VERSION' ) ) {
				return;
			}
			// Gutenberg dynamic css for Astra Addon.
			require_once ASTRA_EXT_DIR . 'classes/class-addon-gutenberg-editor-css.php';
		}

		/**
		 * Enqueues the needed CSS/JS for the customizer.
		 *
		 * @since 1.0
		 * @return void
		 */
		public function controls_scripts() {

			wp_enqueue_script( 'ast-ext-admin-settings', ASTRA_EXT_URI . 'admin/assets/js/customizer-controls.js', array(), ASTRA_EXT_VER, false );

			// Enqueue Customizer React.JS script.
			$custom_controls_react_deps = array(
				'astra-custom-control-plain-script',
				'wp-i18n',
				'wp-components',
				'wp-element',
				'wp-media-utils',
				'wp-block-editor',
			);

			wp_enqueue_script( 'astra-ext-custom-control-react-script', ASTRA_EXT_URI . 'classes/customizer/extend-controls/build/index.js', $custom_controls_react_deps, ASTRA_EXT_VER, true );

			if ( function_exists( 'astra_get_option' ) ) {
				$show_deprecated_no_toggle_style = 'no-toggle' == astra_get_option( 'mobile-menu-style' ) ? true : false;

				wp_localize_script(
					'ast-ext-admin-settings',
					'astAdminLacalizeVars',
					array(
						'astra_no_toggle_menu_style_deprecate' => apply_filters( 'astra_no_toggle_menu_style_deprecate', $show_deprecated_no_toggle_style ), // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound
					)
				);
			}

		}

		/**
		 * Customizer Preview Init
		 *
		 * @since 1.0.0
		 * @return void
		 */
		public function preview_init() {

			if ( SCRIPT_DEBUG ) {
				$js_path = 'assets/js/unminified/ast-addon-customizer-preview.js';
			} else {
				$js_path = 'assets/js/minified/ast-addon-customizer-preview.min.js';
			}

			$addons = Astra_Ext_Extension::get_enabled_addons();

			wp_enqueue_script( 'astra-addon-customizer-preview-js', ASTRA_EXT_URI . $js_path, array( 'customize-preview', 'astra-customizer-preview-js' ), ASTRA_EXT_VER, true );

			wp_localize_script( 'astra-addon-customizer-preview-js', 'ast_enabled_addons', $addons );
		}


		/**
		 * Base on addon activation section registered.
		 *
		 * @since 1.0.0
		 * @param object $wp_customize customizer object.
		 * @return void
		 */
		public function customize_register_before_theme( $wp_customize ) {

			if ( ! defined( 'ASTRA_THEME_VERSION' ) ) {
				return;
			}

			if ( ! class_exists( 'Astra_WP_Customize_Section' ) ) {
				wp_die( 'You are using an older version of the Astra theme. Please update the Astra theme to the latest version.' );
			}

			$addons = Astra_Ext_Extension::get_enabled_addons();

			// Update the Customizer Sections under Layout.
			if ( false != $addons['header-sections'] ) {
				$wp_customize->add_section(
					new Astra_WP_Customize_Section(
						$wp_customize,
						'section-mobile-primary-header-layout',
						array(
							'title'    => __( 'Primary Header', 'astra-addon' ),
							'section'  => 'section-mobile-header',
							'priority' => 10,
						)
					)
				);
			}

			// Update the Customizer Sections under Typography.
			if ( false != $addons['typography'] ) {

				$wp_customize->add_section(
					new Astra_WP_Customize_Section(
						$wp_customize,
						'section-header-typo-group',
						array(
							'title'    => __( 'Header', 'astra-addon' ),
							'panel'    => 'panel-typography',
							'priority' => 20,
						)
					)
				);

				add_filter(
					'astra_customizer_primary_header_typo',
					function( $header_arr ) {

						$header_arr['section'] = 'section-header-typo-group';

						return $header_arr;
					}
				);

			}
		}

		/**
		 * Register Customizer Control.
		 *
		 * @since 1.0.2
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 */
		public function addon_customize_register( $wp_customize ) {

			if ( function_exists( 'WP_Customize_Themes_Panel' ) ) {

				$wp_customize->add_panel(
					new WP_Customize_Themes_Panel(
						$this,
						'themes',
						array(
							'title'       => astra_get_theme_name(),
							'description' => (
							'<p>' . __( 'Looking for a theme? You can search or browse the WordPress.org theme directory, install and preview themes, then activate them right here.', 'astra-addon' ) . '</p>' .
							'<p>' . __( 'While previewing a new theme, you can continue to tailor things like widgets and menus, and explore theme-specific options.', 'astra-addon' ) . '</p>'
							),
							'capability'  => 'switch_themes',
							'priority'    => 0,
						)
					)
				);
			}
		}

		/**
		 * WPML Compatibility.
		 *
		 * @since 1.1.0
		 */
		public function wpml_compatibility() {

			require_once ASTRA_EXT_DIR . 'compatibility/class-astra-wpml-compatibility.php';
		}

		/**
		 * Common plugin dependent file which dependd on other plugins.
		 *
		 * @since 1.1.0
		 */
		public function common_plugin_dependent_files() {

			// If plugin - 'Ubermenu' not exist then return.
			if ( class_exists( 'UberMenu' ) ) {
				require_once ASTRA_EXT_DIR . 'compatibility/class-astra-ubermenu-pro.php';
			}
		}

		/**
		 * Check compatible theme version.
		 *
		 * @since 1.2.0
		 */
		public function min_theme_version__error() {

			$astra_global_options = get_option( 'astra-settings' );

			if ( isset( $astra_global_options['theme-auto-version'] ) && ( version_compare( $astra_global_options['theme-auto-version'], ASTRA_THEME_MIN_VER ) < 0 ) && ( false !== get_theme_update_available( wp_get_theme( get_template() ) ) ) ) {

				$astra_theme_name = 'Astra';
				if ( function_exists( 'astra_get_theme_name' ) ) {
					$astra_theme_name = astra_get_theme_name();
				}

				$message = sprintf(
					/* translators: %1$1s: Theme Name, %2$2s: Minimum Required version of the Astra Theme */
					__( 'Please update %1$1s Theme to version %2$2s or higher. Ignore if already updated.', 'astra-addon' ),
					$astra_theme_name,
					ASTRA_THEME_MIN_VER
				);

				$min_version = get_user_meta( get_current_user_id(), 'theme-min-version-notice-min-ver', true );

				if ( ! $min_version ) {
					update_user_meta( get_current_user_id(), 'theme-min-version-notice-min-ver', ASTRA_THEME_MIN_VER );
				}

				if ( version_compare( $min_version, ASTRA_THEME_MIN_VER, '!=' ) ) {
					delete_user_meta( get_current_user_id(), 'theme-min-version-notice' );
					update_user_meta( get_current_user_id(), 'theme-min-version-notice-min-ver', ASTRA_THEME_MIN_VER );
				}

				Astra_Notices::add_notice(
					array(
						'id'                         => 'theme-min-version-notice',
						'type'                       => 'warning',
						'message'                    => $message,
						'show_if'                    => true,
						'repeat-notice-after'        => false,
						'priority'                   => 20,
						'display-with-other-notices' => true,
					)
				);
			}
		}


		/**
		 * Modified Astra Quick settings links update based on the activated plugins
		 *
		 * @since 1.2.1
		 * @param array $quick_settings quick settings list.
		 * @return array $quick_settings Updated quick settings list.
		 */
		public function astra_addon_quick_settings( $quick_settings = array() ) {
			$enabled_extensions = Astra_Ext_Extension::get_addons();
			// Update the quick setting link for header group.
			$headers_addons = array( 'header-sections', 'transparent-header', 'sticky-header' );

			foreach ( $enabled_extensions as $addon_slug => $value ) {
				if ( ! in_array( $addon_slug, $headers_addons ) || ! Astra_Ext_Extension::is_active( $addon_slug ) ) {
					continue;
				}
				$quick_settings['header']['quick_url'] = admin_url( 'customize.php?autofocus[panel]=panel-header-group' );
			}
			return $quick_settings;
		}

		/**
		 * Modified Astra Addon List
		 *
		 * @since 1.2.1
		 * @param array $addons Astra addon list.
		 * @return array $addons Updated Astra addon list.
		 */
		public function astra_addon_list( $addons = array() ) {

			$enabled_extensions  = Astra_Ext_Extension::get_addons();
			$extension_slugs     = array_keys( $enabled_extensions );
			$extension_slugs[]   = 'white-label';
			$ext_activate_notice = __( 'This plugin needs to be installed/activated', 'astra-addon' );

			foreach ( $addons as $addon_slug => $value ) {
				if ( ! in_array( $addon_slug, $extension_slugs ) ) {
					continue;
				}
				$class = 'deactive';
				$links = array(
					array(
						'link_class' => 'ast-activate-module',
						'link_text'  => __( 'Activate', 'astra-addon' ),
						'link_url'   => '',
					),
				);

				if ( Astra_Ext_Extension::is_active( $addon_slug ) ) {
					$class = 'active';
					$links = array(
						array(
							'link_class' => 'ast-deactivate-module',
							'link_text'  => __( 'Deactivate', 'astra-addon' ),
							'link_url'   => '',
						),
					);
				}

				switch ( $addon_slug ) {
					case 'advanced-hooks':
							$links[] = array(
								'link_class' => 'advanced-module',
								'link_text'  => __( 'Settings', 'astra-addon' ),
								'link_url'   => admin_url( '/edit.php?post_type=astra-advanced-hook' ),
							);
						break;
					case 'advanced-headers':
							$links[] = array(
								'link_class' => 'advanced-module',
								'link_text'  => __( 'Settings', 'astra-addon' ),
								'link_url'   => admin_url( '/edit.php?post_type=astra_adv_header' ),
							);
						break;

					case 'white-label':
							$class   = 'white-label';
							$links   = false;
							$links[] = array(
								'link_class'   => 'advanced-module',
								'link_text'    => __( 'Settings', 'astra-addon' ),
								'link_url'     => Astra_Admin_Settings::get_page_url( $addon_slug ),
								'target_blank' => false,
							);
						break;

					case 'woocommerce':
						$class .= ' woocommerce';
						if ( ! class_exists( 'WooCommerce' ) ) {
							$class .= ' ast-disable ast-modules-not-activated';
							$links  = array(
								array(
									'link_class' => 'ast-deactivate-module',
									'link_text'  => $ext_activate_notice,
									'link_url'   => '',
								),
							);
						}

						break;

					case 'learndash':
						$class .= ' learndash';
						if ( ! class_exists( 'SFWD_LMS' ) ) {
							$class .= ' ast-disable ast-modules-not-activated';
							$links  = array(
								array(
									'link_class' => 'ast-deactivate-module',
									'link_text'  => $ext_activate_notice,
									'link_url'   => '',
								),
							);
						}
						break;

					case 'lifterlms':
						$class .= ' lifterlms';
						if ( ! class_exists( 'LifterLMS' ) ) {
							$class .= ' ast-disable ast-modules-not-activated';
							$links  = array(
								array(
									'link_class' => 'ast-deactivate-module',
									'link_text'  => $ext_activate_notice,
									'link_url'   => '',
								),
							);
						}
						break;

					case 'edd':
						$class .= ' edd';
						if ( ! class_exists( 'Easy_Digital_Downloads' ) ) {
							$class .= ' ast-disable ast-modules-not-activated';
							$links  = array(
								array(
									'link_class' => 'ast-deactivate-module',
									'link_text'  => $ext_activate_notice,
									'link_url'   => '',
								),
							);
						}
						break;
				}

				$addons[ $addon_slug ]['links'] = $links;
				$addons[ $addon_slug ]['class'] = $class;

				// Don't show White Label tab if white label branding is hidden.
				if ( ! Astra_Ext_White_Label_Markup::show_branding() ) {
					unset( $addons['white-label'] );
				}
			}

			return $addons;
		}

		/**
		 * Astra Addon Bulk action
		 *
		 * @since 1.2.1
		 */
		public function astra_addon_bulk_action_markup() {
			?>
				<div class="ast-bulk-actions-wrap">
					<a class="bulk-action ast-activate-all button"> <?php esc_html_e( 'Activate All', 'astra-addon' ); ?> </a>
					<a class="bulk-action ast-deactivate-all button"> <?php esc_html_e( 'Deactivate All', 'astra-addon' ); ?> </a>
				</div>
			<?php
		}

		/**
		 * Astra Header Top Right info
		 *
		 * @since 1.2.1
		 */
		public function astra_header_top_right_content() {
			$top_links = apply_filters(
				'astra_header_top_links', // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound
				array(
					'astra-theme-info' => array(
						'title' => __( 'Stylish, Lightning Fast & Easily Customizable!', 'astra-addon' ),
					),
				)
			);

		}

		/**
		 * Redirect to astra welcome page if visited old Astra Addon Listing page
		 *
		 * @since 1.2.1
		 * @return void
		 */
		public function redirect_addon_listing_page() {

			global $pagenow;
			/* Check current admin page. */

			if ( 'themes.php' == $pagenow && isset( $_GET['action'] ) && 'addons' == $_GET['action'] ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
				wp_safe_redirect( admin_url( '/themes.php?page=astra' ), 301 );
				exit;
			}
		}

		/**
		 * Addon Activation / Deactivation markup
		 *
		 * @since 1.2.1
		 * @return void
		 */
		public function addon_licence_form() {

			if ( is_multisite() ) {
				$white_label = get_site_option( '_astra_ext_white_label' );
			} else {
				$white_label = get_option( '_astra_ext_white_label' );
			}

			$pro_name = __( 'Astra Pro License', 'astra-addon' );

			if ( ! empty( $white_label['astra-pro']['name'] ) ) {
				/* translators: %s: Astra Pro name */
				$pro_name = sprintf( __( '%s License', 'astra-addon' ), $white_label['astra-pro']['name'] );
			}

			$pro_whitelabelled_name = Astra_Ext_White_Label_Markup::get_whitelabel_string( 'astra-pro', 'name', false );

			if ( false !== $pro_whitelabelled_name ) {
				/* translators: %s: Astra Pro name */
				$pro_name = sprintf( __( '%s License', 'astra-addon' ), $pro_whitelabelled_name );
			}

			/* translators: %s: Astra Pro name */
			$not_active_status = sprintf( __( 'Please enter your valid %s license key to receive updates and support.', 'astra-addon' ), $pro_name );

			?>
			<div class="postbox">
				<h2 class="hndle ast-normal-cusror"><span><?php echo esc_html( $pro_name ); ?></span></h2>
				<div class="inside">
				<?php
					$bsf_product_id = bsf_extract_product_id( ASTRA_EXT_DIR );
					$args           = array(
						'product_id'                       => $bsf_product_id,
						'button_text_activate'             => esc_html__( 'Activate License', 'astra-addon' ),
						'button_text_deactivate'           => esc_html__( 'Deactivate License', 'astra-addon' ),
						'license_form_title'               => '',
						'license_deactivate_status'        => esc_html__( 'Your license is not active!', 'astra-addon' ),
						'license_activate_status'          => esc_html__( 'Your license is activated!', 'astra-addon' ),
						'submit_button_class'              => 'astra-product-license button-default',
						'form_class'                       => 'form-wrap bsf-license-register-' . esc_attr( $bsf_product_id ),
						'bsf_license_form_heading_class'   => 'astra-license-heading',
						'bsf_license_active_class'         => 'success-message',
						'bsf_license_not_activate_message' => 'license-error',
						'size'                             => 'regular',
						'bsf_license_allow_email'          => false,
						'bsf_license_active_status'        => __( 'Active!', 'astra-addon' ),
						'bsf_license_not_active_status'    => $not_active_status,
					);
					echo bsf_license_activation_form( $args ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					?>
				</div>
			</div>
			<?php
		}

		/**
		 * Astra Theme and Pro rollback version form.
		 *
		 * @since 3.6.1
		 * @return bool
		 */
		public function version_rollback_form() {

			$bsf_product_id = bsf_extract_product_id( ASTRA_EXT_DIR );
			if ( ! bsf_display_rollback_version_form( $bsf_product_id ) ) {
				return false;
			}

			$them_name = Astra_Rollback_version::astra_get_white_lable_name();
			$pro_name  = bsf_get_white_lable_product_name( $bsf_product_id, 'Astra Pro' );
			?>
			<div class="postbox">
				<h2 class="hndle ast-normal-cusror"><span><?php echo esc_html__( 'Rollback Version', 'astra-addon' ); ?></span></h2>
				<div class="inside">
				<h4 class="ast-normal-cusror"><span><?php echo esc_html( $them_name ); ?></span></h4>
				<?php
					// Display Theme Rollback version form.
					render_theme_rollback_form();
				?>
				<div class="hndle rollback-divider"></div>
				<h4 class="ast-normal-cusror"><span><?php echo esc_html( $pro_name ); ?></span></h4>
				<?php
					// Display Addon Rollback version form.
					bsf_get_version_rollback_form( $bsf_product_id );
				?>
				</div>
			</div>

			<?php
		}

		/**
		 * Include Welcome page right side Astra community content
		 *
		 * @since 1.2.4
		 */
		public function astra_beta_updates_form() {
			$allow_beta = Astra_Admin_Helper::get_admin_settings_option( '_astra_beta_updates', true, 'disable' );
			?>

			<div class="postbox">
				<h2 class="hndle ast-normal-cusror">
					<span class="dashicons dashicons-update"></span>
					<span>
						<?php
							esc_html_e( 'Allow Beta updates', 'astra-addon' );
						?>
				</h2>
				<div class="inside">
					<p>
						<?php esc_html_e( 'Enable this option to receive update notifications for beta versions.', 'astra-addon' ); ?>
					</p>
					<p>
					<?php
						$a_tag_open  = '<a target="_blank" rel="noopener" href="' . esc_url( 'https://wpastra.com/docs/automatic-beta-updates-for-astra/?utm_source=welcome_page&utm_medium=sidebar&utm_campaign=astra_pro' ) . '">';
						$a_tag_close = '</a>';

						printf(
							/* translators: %1$s: a tag open. */
							__( 'Please read %1$s this article %2$s to know more.', 'astra-addon' ), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							$a_tag_open, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							$a_tag_close // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						);
					?>
					</p>

					<label for="astra_beta_updates">
						<?php

						if ( 'disable' === $allow_beta ) {
							$beta_string = __( 'Enable Beta Updates', 'astra-addon' );
						} else {
							$beta_string = __( 'Disable Beta Updates', 'astra-addon' );
						}
						?>
						<button class="button astra-beta-updates" id="astra_beta_updates" data-value="<?php echo esc_attr( $allow_beta ); ?>">
							<?php echo esc_html( $beta_string ); ?>
						</button>
					</label>
				</div>
			</div>
			<?php
		}

		/**
		 * Include the refresh button to delete and regenerate new assets files.
		 *
		 * @since 1.2.4
		 */
		public function astra_refresh_assets_files() {

			if ( ! function_exists( 'astra_addon_filesystem' ) ) {
				return;
			}

			$allow_file_generation = get_option( '_astra_file_generation', 'disable' );

			$file_generation_message  = esc_html__( 'Enable this option to generate CSS files.', 'astra-addon' );
			$file_generation_doc_link = esc_url( 'https://wpastra.com/astra-2-1/?utm_source=welcome_page&utm_medium=sidebar&utm_campaign=astra_pro' );

			if ( astra_addon_filesystem()->can_access_filesystem() ) {
				$refresh_assets_button_text = esc_html__( 'Refresh', 'astra-addon' );
				$refresh_assets_message     = esc_html__( 'Click on the \'Refresh\' button to regenerate CSS files.', 'astra-addon' );
				$refresh_assets_doc_link    = esc_url( '#' );
			} else {
				$refresh_assets_button_text = esc_html__( 'Recheck', 'astra-addon' );
				$refresh_assets_message     = esc_html__( 'Click on the \'Recheck\' button to check if the uploads folder has write access.', 'astra-addon' );
				$refresh_assets_doc_link    = esc_url( '#' );
			}
			?>

			<div class="postbox">
				<h2 class="hndle ast-normal-cusror">
					<span class="dashicons dashicons-admin-page"></span>
					<span>
						<?php esc_html_e( 'CSS File Generation', 'astra-addon' ); ?>
					</span>
				</h2>
				<div class="inside">
					<p class="warning">
					</p>
						<?php echo esc_html( $file_generation_message ); ?>
					<p>
					<?php
					if ( Astra_Ext_White_Label_Markup::show_branding() ) {

						$a_tag_open  = '<a target="_blank" rel="noopener" href="' . $file_generation_doc_link . '">';
						$a_tag_close = '</a>';

						printf(
							/* translators: %1$s: a tag open. */
							__( 'Please read %1$s this article %2$s to know more.', 'astra-addon' ), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							$a_tag_open, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							$a_tag_close // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						);
					}
					?>
					</p>
					<label for="astra_file_generation">
						<?php

						if ( 'disable' === $allow_file_generation ) {
							$file_generation_string = __( 'Enable File Generation', 'astra-addon' );
						} else {
							$file_generation_string = __( 'Disable File Generation', 'astra-addon' );
						}
						?>
						<button class="button astra-beta-updates" id="astra_file_generation" data-value="<?php echo esc_attr( $allow_file_generation ); ?>">
							<?php echo esc_html( $file_generation_string ); ?>
						</button>
					</label>
						<div class="astra-refresh-assets-wrapper" style="<?php echo ( 'disable' === $allow_file_generation ) ? 'display: none' : 'display: block'; ?>">
							<p class="warning">
								<?php echo esc_html( $refresh_assets_message ); ?>
							</p>

							<label for="astra_refresh_assets">
								<button class="button astra-refresh-assets" id="astra_refresh_assets">
									<span class="ast-loader"></span>
									<span class="ast-refresh-btn-text"><?php echo esc_html( $refresh_assets_button_text ); ?></span>
								</button>
							</label>
						</div>
				</div>
			</div>
			<?php
		}

		/**
		 * Register Scripts & Styles on admin_enqueue_scripts hook.
		 * As we moved to React customizer so registering the 'astra-color-alpha' script in addon as there is no use of that script in theme (apperently it removed from theme).
		 *
		 * @since 2.7.0
		 */
		public function enqueue_color_picker_scripts() {

			wp_register_script( 'astra-color-alpha', ASTRA_EXT_URI . 'admin/assets/js/wp-color-picker-alpha.js', array( 'jquery', 'wp-color-picker' ), ASTRA_EXT_VER, true );

			/**
			 * Localize wp-color-picker & wpColorPickerL10n.
			 *
			 * This is only needed in WordPress version >= 5.5 because wpColorPickerL10n has been removed.
			 *
			 * @see https://github.com/WordPress/WordPress/commit/7e7b70cd1ae5772229abb769d0823411112c748b
			 *
			 * This is should be removed once the issue is fixed from wp-color-picker-alpha repo.
			 * @see https://github.com/kallookoo/wp-color-picker-alpha/issues/35
			 *
			 * @since 2.7.0
			 */
			if ( function_exists( 'astra_addon_wp_version_compare' ) && astra_addon_wp_version_compare( '5.4.99', '>=' ) ) {
				// Localizing variables.
				wp_localize_script(
					'wp-color-picker',
					'wpColorPickerL10n',
					array(
						'clear'            => __( 'Clear', 'astra-addon' ),
						'clearAriaLabel'   => __( 'Clear color', 'astra-addon' ),
						'defaultString'    => __( 'Default', 'astra-addon' ),
						'defaultAriaLabel' => __( 'Select default color', 'astra-addon' ),
						'pick'             => __( 'Select Color', 'astra-addon' ),
						'defaultLabel'     => __( 'Color value', 'astra-addon' ),
					)
				);
			}
		}

		/**
		 * Load SVG Icon array from the JSON file.
		 *
		 * @param Array $svg_arr Array of svg icons.
		 * @since 3.0.0
		 * @return Array addon svg icons.
		 */
		public function astra_addon_svg_icons( $svg_arr = array() ) {

			ob_start();
			// Include SVGs Json file.
			include_once ASTRA_EXT_DIR . 'assets/svg/svgs.json';
			$svg_icon_arr  = json_decode( ob_get_clean(), true );
			$ast_svg_icons = array_merge( $svg_arr, $svg_icon_arr );
			return $ast_svg_icons;
		}

		/**
		 * Add limit to show number of versions to rollback.
		 *
		 * @param integer $per_page per page count.
		 * @return integer
		 */
		public function astra_addon_rollback_versions_limit( $per_page ) {
			return 6;
		}
	}
}

/**
 *  Prepare if class 'Astra_Customizer_Loader' exist.
 *  Kicking this off by calling 'get_instance()' method
 */
Astra_Theme_Extension::get_instance();
