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
	class Astra_Theme_Extension {
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
		 * Astra theme supported versions map array.
		 *
		 * @var array
		 * @since 4.3.0
		 */
		private static $astra_theme_supported_version_map = array(
			'4.1.6'  => '4.1.0',
			'4.0.0'  => '4.0.0',
			'3.9.4'  => '3.9.2',
			'3.9.1'  => '3.9.0',
			'3.6.11' => ' 3.8.3',
			'3.6.8'  => '3.7.5',
			'3.6.2'  => '3.7.4',
			'3.6.1'  => '3.7.0',
			'3.5.9'  => '3.6.9',
			'3.5.8'  => '3.6.8',
			'3.5.7'  => '3.6.5',
			'3.5.4'  => '3.5.0',
			'3.4.2'  => '3.4.3',
			'3.4.1'  => '3.4.0',
			'3.3.2'  => '3.3.3',
			'3.3.1'  => '3.3.2',
			'3.3.0'  => '3.3.0',
			'3.2.0'  => '3.1.0',
			'3.0.1'  => '3.0.0',
		);

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
				add_action( 'admin_init', array( $this, 'minimum_theme_supported_version_notice' ) );

				// Admin enqueue script alpha color picker.
				add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_color_picker_scripts' ) );

				// Admin DOMPurify script for DOM sanitization.
				add_action(
					'admin_enqueue_scripts',
					static function() {
						wp_enqueue_script( 'astra-admin-dom-purify', ASTRA_EXT_URI . '/assets/js/minified/purify.min.js', array(), ASTRA_EXT_VER, true );
					}
				);
			}

			add_action( 'init', array( $this, 'addons_action_hooks' ), 1 );
			add_action( 'after_setup_theme', array( $this, 'setup' ) );

			add_action( 'customize_controls_enqueue_scripts', array( $this, 'controls_scripts' ) );
			add_action( 'customize_register', array( $this, 'customize_register_before_theme' ), 5 );
			add_action( 'customize_register', array( $this, 'addon_customize_register' ), 99 );
			add_action( 'customize_preview_init', array( $this, 'preview_init' ), 1 );

			add_filter( 'body_class', array( $this, 'body_classes' ), 11, 1 );

			// Load textdomain.
			add_action( 'init', array( $this, 'load_textdomain' ) );
			add_action( 'plugins_loaded', array( $this, 'common_plugin_dependent_files' ) );
			add_action( 'wpml_loaded', array( $this, 'wpml_compatibility' ) );

			// add compatibility for custom layouts with polylang plugin.
			add_action( 'pll_init', array( $this, 'wpml_compatibility' ) );

			// Add the astra search shortcode function to the Polylang home URL whitelist filter.
			add_filter( 'pll_home_url_white_list', array( $this, 'polylang_whitelist_search_form_shortcode' ) );

			// Astra Addon List filter.
			add_filter( 'astra_addon_list', array( $this, 'astra_addon_list' ) );

			add_action( 'plugin_action_links_' . ASTRA_EXT_BASE, array( $this, 'action_links' ) );

			// Redirect if old addon screen rendered.
			add_action( 'admin_init', array( $this, 'redirect_addon_listing_page' ) );

			add_action( 'enqueue_block_editor_assets', array( $this, 'addon_gutenberg_assets' ), 11 );

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

			if ( $wp_version >= 4.7 && ! class_exists( 'Sitepress' ) ) {
				$get_locale = get_user_locale();
			}

			/**
			 * Language Locale for Astra Pro
			 *
			 * @var The $get_locale locale to use. Uses get_user_locale()` in WordPress 4.7 or greater,
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
			$admin_base = is_callable( 'Astra_Menu::get_theme_page_slug' ) ? 'admin.php' : 'themes.php';

			$action_links = array(
				'settings' => '<a href="' . esc_url( admin_url( $admin_base . '?page=' . $slug ) ) . '" aria-label="' . esc_attr__( 'View Astra Pro settings', 'astra-addon' ) . '">' . esc_html__( 'Settings', 'astra-addon' ) . '</a>',
			);

			return array_merge( $action_links, $links );
		}

		/**
		 * Activation Reset
		 */
		public function activation_reset() {

			add_rewrite_endpoint( 'partial', EP_PERMALINK );
			// flush rewrite rules.
			flush_rewrite_rules(); //phpcs:ignore WordPressVIPMinimum.Functions.RestrictedFunctions.flush_rewrite_rules_flush_rewrite_rules -- Used for specific cases and kept to minimal use.

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

			// Enable `Site Builder` module by default on plugin activation.
			Astra_Ext_Extension::activate_extension( 'advanced-hooks', false );

			do_action( 'astra_addon_activate' );
		}

		/**
		 * Deactivation Reset
		 */
		public function deactivation_reset() {
			// flush rewrite rules.
			flush_rewrite_rules(); //phpcs:ignore WordPressVIPMinimum.Functions.RestrictedFunctions.flush_rewrite_rules_flush_rewrite_rules -- Used for specific cases and kept to minimal use.
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
			if ( ASTRA_ADDON_BSF_PACKAGE ) {
				require_once ASTRA_EXT_DIR . 'admin/astra-rollback/class-astra-rollback-version.php';
				require_once ASTRA_EXT_DIR . 'admin/astra-rollback/class-astra-rollback-version-manager.php';
			}
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
			$white_labelled_icon = Astra_Ext_White_Label_Markup::get_whitelabel_string( 'astra', 'icon' );
			if ( false !== $white_labelled_icon ) {
				$dark_active_variation = $white_labelled_icon;
				if ( false !== strpos( $white_labelled_icon, 'whitelabel-branding.svg' ) ) {
					$white_labelled_icon = ASTRA_EXT_URI . 'admin/core/assets/images/whitelabel-branding-dark.svg';
				}
				wp_add_inline_style(
					'astra-meta-box',
					'.components-button svg[data-ast-logo] * {
						display: none;
					}
					.components-button svg[data-ast-logo] {
						background-image: url( ' . esc_url( $white_labelled_icon ) . ' ) !important;
						background-size: 24px 24px;
						background-repeat: no-repeat;
						background-position: center;
					}
					button.components-button.is-pressed svg[data-ast-logo] {
						background-image: url( ' . esc_url( $dark_active_variation ) . ' ) !important;
					}'
				);
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
			// Bail early if it is not astra customizer.
			if ( is_callable( array( 'Astra_Customizer', 'is_astra_customizer' ) ) && ! Astra_Customizer::is_astra_customizer() ) {
				return;
			}

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
			wp_set_script_translations( 'astra-ext-custom-control-react-script', 'astra-addon' );
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
					static function( $header_arr ) {

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
							'<p>' . __( 'Looking for a theme? You can search or browse the WordPress.org theme directory, install and preview themes, then activate them right here.', 'astra-addon' ) . '</p>
							<p>' . __( 'While previewing a new theme, you can continue to tailor things like widgets and menus, and explore theme-specific options.', 'astra-addon' ) . '</p>'
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
		 * Method to modify the Polylang home_url whitelist.
		 *
		 * @param array $whitelist The current whitelist array.
		 * @return array Modified whitelist array.
		 *
		 * @since 4.8.3
		 */
		public function polylang_whitelist_search_form_shortcode( $whitelist ) {
			// Append the 'get_search_form_shortcode' function to the whitelist array.
			$whitelist[] = array( 'function' => 'get_search_form_shortcode' );
			return $whitelist;
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

				if ( class_exists( 'Astra_Notices' ) ) {
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
		}

		/**
		 * Get minimum supported version for Astra addon.
		 * This function will be used to inform the user about incompatible version of Astra addon.
		 *
		 * @param string $input_version Input version of the addon.
		 *
		 * @since 4.3.0
		 */
		public function get_astra_theme_min_supported_version( $input_version ) {

			if ( version_compare( ASTRA_THEME_VERSION, ASTRA_THEME_MIN_VER ) < 0 ) {
				return ASTRA_THEME_MIN_VER;
			}

			$supported_version = '';

			// First, check if the exact version is supported
			if ( isset( self::$astra_theme_supported_version_map[ $input_version ] ) ) {
				$supported_version = self::$astra_theme_supported_version_map[ $input_version ];
			} else {
				foreach ( self::$astra_theme_supported_version_map as $index => $supported ) {
					if ( '' !== $supported_version || version_compare( $input_version, $index ) > 0 ) {
						$supported_version = $supported;
						break;
					}
				}
			}

			return $supported_version;
		}

		/**
		 * This constant will be used to inform the user about incompatible version of Astra addon.
		 *
		 * @since 4.3.0
		 */
		public function minimum_theme_supported_version_notice() {

			if ( ! defined( 'ASTRA_THEME_VERSION' ) ) {
				return;
			}

			// ASTRA_THEME_MIN_VER < ASTRA_THEME_VERSION && ASTRA_THEME_VERSION < 4.0.0.
			if ( version_compare( ASTRA_THEME_VERSION, ASTRA_THEME_MIN_VER ) >= 0 || version_compare( '4.0.0', ASTRA_THEME_VERSION ) < 0 ) {
				return;
			}

			$astra_supported_version = $this->get_astra_theme_min_supported_version( ASTRA_THEME_VERSION );
			$message                 = sprintf(
				/* translators: %1$s: Theme Name, %2$s: Plugin Name, %3$s: Supported required version of the addon */
				'Your current version of %1$s theme is incompatible with %2$s plugin. Please update to at least version %3$s for optimal functionality.',
				astra_get_theme_name(),
				astra_get_addon_name(),
				$astra_supported_version
			);

			$ext_min_supported_version = get_user_meta( get_current_user_id(), 'ast-theme-supported-version-notice', true );

			if ( ! $ext_min_supported_version ) {
				update_user_meta( get_current_user_id(), 'ast-theme-supported-version-notice', $astra_supported_version );
			}

			if ( version_compare( $ext_min_supported_version, $astra_supported_version, '!=' ) ) {
				delete_user_meta( get_current_user_id(), 'ast-theme-minimum-supported-version-notice' );
				update_user_meta( get_current_user_id(), 'ast-theme-supported-version-notice', $astra_supported_version );
			}

			$notice_args = array(
				'id'                         => 'ast-theme-minimum-supported-version-notice',
				'type'                       => 'warning',
				'message'                    => $message,
				'show_if'                    => true,
				'repeat-notice-after'        => false,
				'priority'                   => 20,
				'display-with-other-notices' => false,
			);

			if ( class_exists( 'Astra_Notices' ) ) {
				Astra_Notices::add_notice( $notice_args );
			}
		}

		/**
		 * Modified Astra Addon List
		 *
		 * @since 1.2.1
		 * @param array $addons Astra addon list.
		 * @return array $addons Updated Astra addon list.
		 */
		public function astra_addon_list( $addons = array() ) {

			$enabled_extensions = Astra_Ext_Extension::get_addons();
			$extension_slugs    = array_keys( $enabled_extensions );
			$extension_slugs[]  = 'white-label';
			$whitelabelled      = Astra_Ext_White_Label_Markup::show_branding();

			foreach ( $addons as $addon_slug => $value ) {
				if ( ! in_array( $addon_slug, $extension_slugs ) ) {
					continue;
				}
				$class = 'deactive';
				$links = isset( $addons[ $addon_slug ]['links'] ) ? $addons[ $addon_slug ]['links'] : array();
				$links = $whitelabelled ? $links : array();

				switch ( $addon_slug ) {
					case 'colors-and-background':
						$links[] = array(
							'link_class' => 'customize-module',
							'link_text'  => ! $whitelabelled ? __( 'Customize', 'astra-addon' ) : __( ' | Customize', 'astra-addon' ),
							'link_url'   => admin_url( '/customize.php?autofocus[section]=section-colors-background' ),
						);
						break;
					case 'typography':
						$links[] = array(
							'link_class' => 'customize-module',
							'link_text'  => ! $whitelabelled ? __( 'Customize', 'astra-addon' ) : __( ' | Customize', 'astra-addon' ),
							'link_url'   => admin_url( '/customize.php?autofocus[section]=section-typography' ),
						);
						break;
					case 'spacing':
						$links[] = array(
							'link_class' => 'customize-module',
							'link_text'  => ! $whitelabelled ? __( 'Customize', 'astra-addon' ) : __( ' | Customize', 'astra-addon' ),
							'link_url'   => admin_url( '/customize.php' ),
						);
						break;
					case 'blog-pro':
						$links[] = array(
							'link_class' => 'customize-module',
							'link_text'  => ! $whitelabelled ? __( 'Customize', 'astra-addon' ) : __( ' | Customize', 'astra-addon' ),
							'link_url'   => admin_url( '/customize.php?autofocus[section]=section-blog-group' ),
						);
						break;
					case 'mobile-header':
						$links[] = array(
							'link_class' => 'customize-module',
							'link_text'  => ! $whitelabelled ? __( 'Customize', 'astra-addon' ) : __( ' | Customize', 'astra-addon' ),
							'link_url'   => admin_url( '/customize.php?autofocus[panel]=panel-header-group' ),
						);
						break;
					case 'header-sections':
						$links[] = array(
							'link_class' => 'customize-module',
							'link_text'  => ! $whitelabelled ? __( 'Customize', 'astra-addon' ) : __( ' | Customize', 'astra-addon' ),
							'link_url'   => admin_url( '/customize.php?autofocus[panel]=panel-header-group' ),
						);
						break;
					case 'sticky-header':
						$links[] = array(
							'link_class' => 'customize-module',
							'link_text'  => ! $whitelabelled ? __( 'Customize', 'astra-addon' ) : __( ' | Customize', 'astra-addon' ),
							'link_url'   => admin_url( '/customize.php?autofocus[section]=section-sticky-header' ),
						);
						break;
					case 'site-layouts':
						$links[] = array(
							'link_class' => 'customize-module',
							'link_text'  => ! $whitelabelled ? __( 'Customize', 'astra-addon' ) : __( ' | Customize', 'astra-addon' ),
							'link_url'   => admin_url( '/customize.php?autofocus[section]=section-container-layout' ),
						);
						break;
					case 'advanced-footer':
						$links[] = array(
							'link_class' => 'customize-module',
							'link_text'  => ! $whitelabelled ? __( 'Customize', 'astra-addon' ) : __( ' | Customize', 'astra-addon' ),
							'link_url'   => admin_url( '/customize.php?autofocus[section]=section-footer-group' ),
						);
						break;
					case 'advanced-hooks':
							$links[] = array(
								'link_class' => 'advanced-module',
								'link_text'  => ! $whitelabelled ? __( 'Settings', 'astra-addon' ) : __( ' | Settings', 'astra-addon' ),
								'link_url'   => admin_url( '/admin.php?page=theme-builder' ),
							);
						break;
					case 'advanced-headers':
							$links[] = array(
								'link_class' => 'advanced-module',
								'link_text'  => ! $whitelabelled ? __( 'Settings', 'astra-addon' ) : __( ' | Settings', 'astra-addon' ),
								'link_url'   => admin_url( '/edit.php?post_type=astra_adv_header' ),
							);
						break;

					case 'nav-menu':
						$class  .= ' nav-menu';
						$links[] = array(
							'link_class' => 'advanced-module',
							'link_text'  => ! $whitelabelled ? __( 'Settings', 'astra-addon' ) : __( ' | Settings', 'astra-addon' ),
							'link_url'   => admin_url( '/nav-menus.php' ),
						);
						break;

					case 'white-label':
							$class   = 'white-label';
							$links   = isset( $addons[ $addon_slug ]['links'] ) ? $addons[ $addon_slug ]['links'] : array();
							$links[] = array(
								'link_class'   => 'advanced-module',
								'link_text'    => ! $whitelabelled ? __( 'Settings', 'astra-addon' ) : __( ' | Settings', 'astra-addon' ),
								'link_url'     => is_callable( 'Astra_Menu::get_theme_page_slug' ) ? admin_url( 'admin.php?page=' . Astra_Menu::get_theme_page_slug() . '&path=settings&settings=white-label' ) : '#',
								'target_blank' => false,
							);
						break;

					case 'woocommerce':
						$class  .= ' woocommerce';
						$links[] = array(
							'link_class' => 'customize-module',
							'link_text'  => ! $whitelabelled ? __( 'Customize', 'astra-addon' ) : __( ' | Customize', 'astra-addon' ),
							'link_url'   => admin_url( '/customize.php?autofocus[panel]=woocommerce' ),
						);
						break;

					case 'learndash':
						$class  .= ' learndash';
						$links[] = array(
							'link_class' => 'customize-module',
							'link_text'  => ! $whitelabelled ? __( 'Customize', 'astra-addon' ) : __( ' | Customize', 'astra-addon' ),
							'link_url'   => admin_url( '/customize.php?autofocus[section]=section-learndash' ),
						);
						break;

					case 'lifterlms':
						$class  .= ' lifterlms';
						$links[] = array(
							'link_class' => 'customize-module',
							'link_text'  => ! $whitelabelled ? __( 'Customize', 'astra-addon' ) : __( ' | Customize', 'astra-addon' ),
							'link_url'   => admin_url( '/customize.php?autofocus[section]=section-lifterlms' ),
						);
						break;

					case 'edd':
						$class  .= ' edd';
						$links[] = array(
							'link_class' => 'customize-module',
							'link_text'  => ! $whitelabelled ? __( 'Customize', 'astra-addon' ) : __( ' | Customize', 'astra-addon' ),
							'link_url'   => admin_url( '/customize.php?autofocus[section]=section-edd-group' ),
						);
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
		 * Astra Header Top Right info
		 *
		 * @since 1.2.1
		 */
		public function astra_header_top_right_content() {
			apply_filters(
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

			if ( 'themes.php' === $pagenow && isset( $_GET['action'] ) && 'addons' === $_GET['action'] ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
				wp_safe_redirect( admin_url( '/themes.php?page=astra' ), 301 );
				exit;
			}
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
			$svg_icon_arr = json_decode( ob_get_clean(), true );
			return array_merge( $svg_arr, $svg_icon_arr );
		}

		/**
		 * Add limit to show number of versions to rollback.
		 *
		 * @param int $per_page per page count.
		 * @return int
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
