<?php
/**
 * White Label Markup
 *
 * @package Astra Pro
 */

if ( ! class_exists( 'Astra_Ext_White_Label_Markup' ) ) {

	/**
	 * White Label Markup Initial Setup
	 *
	 * @since 1.0.0
	 */
	class Astra_Ext_White_Label_Markup {

		/**
		 * Member Variable
		 *
		 * @var object instance
		 */
		private static $instance;

		/**
		 * Member Variable
		 *
		 * @var array instance
		 * @deprecated 1.6.15
		 */
		public static $branding;

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
		 *  Constructor
		 */
		public function __construct() {

			add_filter( 'astra_theme_author', array( $this, 'theme_author_callback' ) );
			if ( is_admin() ) {
				add_filter( 'all_plugins', array( $this, 'plugins_page' ) );
				add_filter( 'wp_prepare_themes_for_js', array( $this, 'themes_page' ) );
				add_filter( 'all_themes', array( $this, 'network_themes_page' ) );
				add_filter( 'update_right_now_text', array( $this, 'admin_dashboard_page' ) );
				add_action( 'customize_render_section', array( $this, 'theme_customizer' ) );

				// Change menu page title.
				add_filter( 'astra_menu_page_title', array( $this, 'menu_page_title' ), 10, 1 );
				add_filter( 'astra_theme_name', array( $this, 'menu_page_title' ), 10, 1 );
				add_filter( 'astra_addon_name', array( $this, 'addon_page_name' ), 10, 1 );
				add_filter( 'astra_addon_list_tagline', array( $this, 'addon_addon_list_tagline' ), 10, 1 );

				// Theme welcome Page right sections filter.
				add_filter( 'astra_support_link', array( $this, 'agency_author_link' ), 10, 1 );
				add_filter( 'astra_community_group_link', array( $this, 'agency_author_link' ), 10, 1 );
				add_filter( 'astra_knowledge_base_documentation_link', array( $this, 'agency_author_link' ), 10, 1 );
				add_filter( 'astra_starter_sites_documentation_link', array( $this, 'agency_author_link' ), 10, 1 );

				// Astra Addon List filter.
				add_filter( 'astra_addon_list', array( $this, 'astra_addon_list' ) );

				add_filter( 'astra_site_url', array( $this, 'agency_author_link' ), 10, 1 );
				add_action( 'astra_welcome_page_header_title', array( $this, 'welcome_page_header_site_title' ) );
				add_filter( 'astra_page_top_icon', array( $this, 'astra_welcome_page_icon' ), 10, 1 );

				if ( false !== self::get_whitelabel_string( 'astra', 'name', false ) ) {
					// Gettext filter.
					add_filter( 'gettext', array( $this, 'theme_gettext' ), 20, 3 );
				}

				if ( false !== self::astra_pro_whitelabel_name() ) {
					add_filter( 'gettext', array( $this, 'plugin_gettext' ), 20, 3 );
				}

				// Add menu item.
				if ( self::show_branding() ) {
					add_action( 'astra_menu_white_label_action', array( $this, 'settings_page' ) );
				} else {
					add_action( 'init', array( $this, 'white_label_hide_settings' ) );
					add_filter( 'astra_welcome_wrapper_class', array( $this, 'welcome_wrapper_class' ), 10, 1 );

					// Remove Action Heading if white label is enabled.
					add_filter( 'astra_advanced_hooks_list_action_column_headings', array( $this, 'remove_white_label_action' ), 10, 1 );

					// Remove Action Description.
					add_filter( 'astra_custom_layouts_hooks', array( $this, 'remove_description_custom_layouts' ), 10, 1 );

					// Rename custom layout post url slug.
					add_filter( 'astra_advanced_hooks_rewrite_slug', array( $this, 'change_custom_hook_url_slug' ), 20, 2 );

					// Hide Themes section in the customizer as the theme name cannot be edited in it.
					add_action( 'customize_register', array( $this, 'remove_themes_section' ), 30 );

					add_filter( 'bsf_product_changelog_astra-addon', '__return_empty_string' );

					add_filter( 'bsf_white_label_options', array( $this, 'astra_bsf_analytics_white_label' ) );
				}

				// White label save action.
				add_action( 'admin_init', array( $this, 'settings_save' ) );

				// Add menu item.
				add_filter( 'astra_addon_licence_url', array( $this, 'addon_licence_url' ), 10, 1 );

				// Change the theme page slug only if the value if added by user.
				$theme_whitelabelled_name = self::get_whitelabel_string( 'astra', 'name', false );
				if ( false !== $theme_whitelabelled_name && ! empty( $theme_whitelabelled_name ) ) {
					add_filter( 'astra_theme_page_slug', array( $this, 'astra_whitelabelled_slug' ) );
					add_filter( 'admin_body_class', array( $this, 'astra_page_admin_classes' ) );
				}
			}

			add_action( 'admin_enqueue_scripts', array( $this, 'updates_core_page' ) );

			// White Label graupi updates screen.
			add_filter( 'bsf_product_name_astra-addon', array( $this, 'astra_pro_whitelabel_name' ) );
			add_filter( 'bsf_product_description_astra-addon', array( $this, 'astra_pro_whitelabel_description' ) );
			add_filter( 'bsf_product_author_astra-addon', array( $this, 'astra_pro_whitelabel_author' ) );
			add_filter( 'bsf_product_homepage_astra-addon', array( $this, 'astra_pro_whitelabel_author_url' ) );
			if ( false !== self::get_whitelabel_string( 'astra', 'screenshot' ) ) {
				add_filter( 'bsf_product_icons_astra-addon', array( $this, 'astra_pro_branded_icons' ) );
			}
		}

		/**
		 * Add admin page class to Astra Options page.
		 *
		 * @since 1.6.14
		 * @param String $classes CSS class names for thee body attribute.
		 * @return String SS class names for thee body attribute with new CSS classes for Astra Options page.
		 */
		public function astra_page_admin_classes( $classes ) {
			$current_screen = get_current_screen();

			if ( 'appearance_page_' . $this->astra_whitelabelled_slug( 'astra' ) === $current_screen->base ) {
				$classes = $classes . ' appearance_page_astra';
			}

			return $classes;
		}


		/**
		 * Provide White Label array().
		 *
		 * @return array()
		 * @since 1.0
		 */
		public static function get_white_labels() {

			$branding_default = apply_filters(
				'astra_addon_branding_options',
				array(
					'astra-agency' => array(
						'author'        => '',
						'author_url'    => '',
						'licence'       => '',
						'hide_branding' => false,
					),
					'astra'        => array(
						'name'        => '',
						'description' => '',
						'screenshot'  => '',
					),
					'astra-pro'    => array(
						'name'        => '',
						'description' => '',
					),
				)
			);

			$branding = Astra_Admin_Helper::get_admin_settings_option( '_astra_ext_white_label', true );
			$branding = wp_parse_args( $branding, $branding_default );

			return apply_filters( 'astra_addon_get_white_labels', $branding );
		}

		/**
		 * Get individual whitelabel setting.
		 *
		 * @param String $product Product Slug for which whitelabel value is to be received.
		 * @param String $key whitelabel key to be received from the database.
		 * @param mixed  $default default value to be retturned if the whitelabel value is not aset by user.
		 *
		 * @return mixed.
		 */
		public static function get_whitelabel_string( $product, $key, $default = false ) {
			$constant = self::branding_key_to_constant( $product, $key );

			if ( defined( $constant ) ) {
				return constant( $constant );
			}

			$whitelabel_settings = self::get_white_labels();

			if ( isset( $whitelabel_settings[ $product ][ $key ] ) && '' !== $whitelabel_settings[ $product ][ $key ] ) {
				return $whitelabel_settings[ $product ][ $key ];
			}

			return $default;
		}

		/**
		 * Convert brainding key to a constant.
		 * Adds a prefix of 'AST_WL_' to all the constants followed by uppercase of the product and uppercased key.
		 * Agency Name will be converted to AST_WL_ASTRA_AGENCY_NAME
		 *
		 * @param String $product Product Slug for which whitelabel value is to be received.
		 * @param String $key whitelabel key to be received from the database.
		 * @return String constantified whitelabel key.
		 */
		public static function branding_key_to_constant( $product, $key ) {
			return 'AST_WL_' . strtoupper( str_replace( '-', '_', $product ) . '_' . str_replace( '-', '_', $key ) );
		}

		/**
		 * Show white label tab.
		 *
		 * @since 1.0
		 * @return bool true | false
		 */
		public static function show_branding() {
			$show_branding = true;

			if ( true === (bool) self::get_whitelabel_string( 'astra-agency', 'hide_branding', false ) ) {
				$show_branding = false;
			}

			if ( defined( 'WP_ASTRA_WHITE_LABEL' ) && WP_ASTRA_WHITE_LABEL ) {
				$show_branding = false;
			}

			return apply_filters( 'astra_pro_show_branding', $show_branding );
		}

		/**
		 * Get white label setting.
		 *
		 * @since 1.0
		 * @since 1.6.14 depracated method in favour of self::get_whitelabel_string().
		 *
		 * @param array $option option name.
		 * @param array $sub_option sub option name.
		 * @return array()
		 */
		public static function get_white_label( $option = '', $sub_option = '' ) {
			// Officially depracate function in the version 1.6.15.
			// _deprecated_function( __METHOD__, '1.6.15', 'Astra_Ext_White_Label_Markup::get_whitelabel_string()' );.
			return self::get_whitelabel_string( $option, $sub_option );
		}

		/**
		 * White labels the plugins page.
		 *
		 * @param array $plugins Plugins Array.
		 * @return array
		 */
		public function plugins_page( $plugins ) {
			$key = plugin_basename( ASTRA_EXT_DIR . 'astra-addon.php' );

			if ( isset( $plugins[ $key ] ) && false !== self::astra_pro_whitelabel_name() ) {
				$plugins[ $key ]['Name']        = self::astra_pro_whitelabel_name();
				$plugins[ $key ]['Description'] = self::astra_pro_whitelabel_description();
			}

			$author     = self::astra_pro_whitelabel_author();
			$author_uri = self::astra_pro_whitelabel_author_url();

			if ( ! empty( $author ) ) {
				$plugins[ $key ]['Author']     = $author;
				$plugins[ $key ]['AuthorName'] = $author;
			}

			if ( ! empty( $author_uri ) ) {
				$plugins[ $key ]['AuthorURI'] = $author_uri;
				$plugins[ $key ]['PluginURI'] = $author_uri;
			}

			return $plugins;
		}

		/**
		 * White labels the theme on the themes page.
		 *
		 * @param array $themes Themes Array.
		 * @return array
		 */
		public function themes_page( $themes ) {

			$astra_key = 'astra';

			if ( isset( $themes[ $astra_key ] ) ) {

				if ( false !== self::get_whitelabel_string( 'astra', 'name', false ) ) {

					$themes[ $astra_key ]['name'] = self::get_whitelabel_string( 'astra', 'name', false );

					foreach ( $themes as $key => $theme ) {
						if ( isset( $theme['parent'] ) && 'Astra' == $theme['parent'] ) {
							$themes[ $key ]['parent'] = self::get_whitelabel_string( 'astra', 'name', false );
						}
					}
				}

				if ( false !== self::get_whitelabel_string( 'astra', 'description', false ) ) {
					$themes[ $astra_key ]['description'] = self::get_whitelabel_string( 'astra', 'description', false );
				}

				if ( false !== self::get_whitelabel_string( 'astra-agency', 'author', false ) ) {
					$author_url                           = ( '' === self::get_whitelabel_string( 'astra-agency', 'author_url', '' ) ) ? '#' : self::get_whitelabel_string( 'astra-agency', 'author_url', '' );
					$themes[ $astra_key ]['author']       = self::get_whitelabel_string( 'astra-agency', 'author', false );
					$themes[ $astra_key ]['authorAndUri'] = '<a href="' . esc_url( $author_url ) . '">' . self::get_whitelabel_string( 'astra-agency', 'author', false ) . '</a>';
				}

				if ( false !== self::get_whitelabel_string( 'astra', 'screenshot', false ) ) {
					$themes[ $astra_key ]['screenshot'] = array( self::get_whitelabel_string( 'astra', 'screenshot', false ) );
				}

				// Change link and theme name from the heme popup for the update notification.
				if ( isset( $themes[ $astra_key ]['update'] ) ) {
					// Replace Theme name with whitelabel theme name.
					$themes[ $astra_key ]['update'] = str_replace( 'Astra', self::get_whitelabel_string( 'astra', 'name' ), $themes[ $astra_key ]['update'] );

					// Replace Theme URL with Agency URL.
					$themes[ $astra_key ]['update'] = str_replace(
						'https://wordpress.org/themes/astra/?TB_iframe=true&#038;width=1024&#038;height=800',
						add_query_arg(
							array(
								'TB_iframe' => true,
								'hight'     => '800',
								'width'     => '1024',
							),
							self::get_whitelabel_string( 'astra-agency', 'author_url', 'https://wordpress.org/themes/astra/?TB_iframe=true&#038;width=1024&#038;height=800' )
						),
						$themes[ $astra_key ]['update']
					);
				}
			}

			return $themes;
		}

		/**
		 * White labels the theme on the network admin themes page.
		 *
		 * @param array $themes Themes Array.
		 * @return array
		 */
		public function network_themes_page( $themes ) {

			$astra_key = 'astra';

			if ( isset( $themes[ $astra_key ] ) && is_network_admin() ) {
				$network_theme_data = array();

				if ( false !== self::get_whitelabel_string( 'astra', 'name', false ) ) {

					$network_theme_data['Name'] = self::get_whitelabel_string( 'astra', 'name', false );

					foreach ( $themes as $theme_key => $theme ) {
						if ( isset( $theme['parent'] ) && 'Astra' == $theme['parent'] ) {
							$themes[ $theme_key ]['parent'] = self::get_whitelabel_string( 'astra', 'name', false );
						}
					}
				}

				if ( false !== self::get_whitelabel_string( 'astra', 'description', false ) ) {
					$network_theme_data['Description'] = self::get_whitelabel_string( 'astra', 'description', false );
				}

				if ( false !== self::get_whitelabel_string( 'astra-agency', 'author', false ) ) {
					$author_url                      = ( '' === self::get_whitelabel_string( 'astra-agency', 'author_url', '' ) ) ? '#' : self::get_whitelabel_string( 'astra-agency', 'author_url', '' );
					$network_theme_data['Author']    = self::get_whitelabel_string( 'astra-agency', 'author', false );
					$network_theme_data['AuthorURI'] = $author_url;
					$network_theme_data['ThemeURI']  = $author_url;
				}

				if ( count( $network_theme_data ) > 0 ) {
					$reflection_object = new ReflectionObject( $themes[ $astra_key ] );
					$headers           = $reflection_object->getProperty( 'headers' );
					$headers->setAccessible( true );

					$headers_sanitized = $reflection_object->getProperty( 'headers_sanitized' );
					$headers_sanitized->setAccessible( true );

					// Set white labeled theme data.
					$headers->setValue( $themes[ $astra_key ], $network_theme_data );
					$headers_sanitized->setValue( $themes[ $astra_key ], $network_theme_data );

					// Reset back to private.
					$headers->setAccessible( false );
					$headers_sanitized->setAccessible( false );
				}
			}

			return $themes;
		}

		/**
		 * White labels the theme on the dashboard 'At a Glance' metabox
		 *
		 * @param mixed $content Content.
		 * @return array
		 */
		public function admin_dashboard_page( $content ) {
			if ( is_admin() && 'Astra' == wp_get_theme() && false !== self::get_whitelabel_string( 'astra', 'name', false ) ) {
				return sprintf( $content, get_bloginfo( 'version', 'display' ), '<a href="themes.php">' . self::get_whitelabel_string( 'astra', 'name', false ) . '</a>' );
			}

			return $content;
		}

		/**
		 * White labels the theme using the gettext filter
		 * to cover areas that we can't access like the Customizer.
		 *
		 * @param string $text  Translated text.
		 * @param string $original         Text to translate.
		 * @param string $domain       Text domain. Unique identifier for retrieving translated strings.
		 * @return string
		 */
		public function theme_gettext( $text, $original, $domain ) {
			if ( 'Astra' == $original ) {
				$text = self::get_whitelabel_string( 'astra', 'name', false );
			}

			return $text;
		}

		/**
		 * White labels the plugin using the gettext filter
		 * to cover areas that we can't access.
		 *
		 * @param string $text  Translated text.
		 * @param string $original   Text to translate.
		 * @param string $domain       Text domain. Unique identifier for retrieving translated strings.
		 * @return string
		 */
		public function plugin_gettext( $text, $original, $domain ) {
			if ( 'Astra Pro' == $original ) {
				$text = self::astra_pro_whitelabel_name();
			}

			return $text;
		}

		/**
		 * White labels the builder theme using the `customize_render_section` hook
		 * to cover areas that we can't access like the Customizer.
		 *
		 * @param object $instance  Astra Object.
		 * @return string           Only return if theme branding has been filled up.
		 */
		public function theme_customizer( $instance ) {

			if ( 'Astra' == $instance->title ) {

				if ( false !== self::get_whitelabel_string( 'astra', 'name', false ) ) {
					$instance->title = self::get_whitelabel_string( 'astra', 'name', false );
					return $instance->title;
				}
			}
		}

		/**
		 * Allow to remove the theme switch in the customizer as the theme name cannot be edited
		 *
		 * @since 1.6.12
		 * @param  object $wp_customize customizer object.
		 */
		public static function remove_themes_section( $wp_customize ) {
			$wp_customize->remove_panel( 'themes' );
		}

		/**
		 * Filter to update Theme Author Link
		 *
		 * @param  array $args Theme Author Detail Array.
		 * @return array
		 */
		public function theme_author_callback( $args ) {
			if ( false !== self::get_whitelabel_string( 'astra', 'name', false ) ) {
				$args['theme_name'] = self::get_whitelabel_string( 'astra', 'name', false );
			}

			if ( false !== self::astra_pro_whitelabel_author_url() ) {
				$args['theme_author_url'] = self::astra_pro_whitelabel_author_url();
			}

			return $args;
		}

		/**
		 * Menu Page Title
		 *
		 * @param string $title Page Title.
		 * @return string
		 */
		public function menu_page_title( $title ) {
			if ( false !== self::get_whitelabel_string( 'astra', 'name', false ) ) {
				$title = self::get_whitelabel_string( 'astra', 'name', false );
			}

			return $title;
		}

		/**
		 * Astra Pro plugin Title
		 *
		 * @param string $title Page Title.
		 * @return string
		 */
		public function addon_page_name( $title ) {
			if ( false !== self::get_whitelabel_string( 'astra-pro', 'name', false ) ) {
				$title = self::get_whitelabel_string( 'astra-pro', 'name', false );
			}

			return $title;
		}

		/**
		 * Astra Pro Welcome Page tagline
		 *
		 * @param string $title Page Title.
		 * @return string
		 */
		public function addon_addon_list_tagline( $title ) {

			if ( false !== self::astra_pro_whitelabel_name() ) {
				/* translators: %s: white label pro name */
				$title = sprintf( __( 'Available %s Modules:', 'astra-addon' ), self::astra_pro_whitelabel_name() );
			} else {
				$title = __( 'Available Astra Pro Modules:', 'astra-addon' );
			}

			return $title;
		}

		/**
		 * Setting Page
		 */
		public function settings_page() {
			require_once ASTRA_EXT_DIR . 'includes/view-white-label.php';
		}

		/**
		 * Save Settings
		 */
		public function settings_save() {

			if ( isset( $_POST['ast-white-label-nonce'] ) && wp_verify_nonce( $_POST['ast-white-label-nonce'], 'white-label' ) ) {
				$url             = $_SERVER['HTTP_REFERER'];
				$stored_settings = self::get_white_labels();
				$input_settings  = array();
				$new_settings    = array();

				if ( isset( $_POST['ast_white_label'] ) ) {

					$input_settings = $_POST['ast_white_label'];

					// Loop through the input and sanitize each of the values.
					foreach ( $input_settings as $key => $val ) {

						if ( is_array( $val ) ) {
							foreach ( $val as $k => $v ) {
								$new_settings[ $key ][ $k ] = ( isset( $val[ $k ] ) ) ? sanitize_text_field( stripslashes( $v ) ) : '';
							}
						} else {
							$new_settings[ $key ] = ( isset( $input_settings[ $key ] ) ) ? sanitize_text_field( stripslashes( $val ) ) : '';
						}
					}
				}

				$new_settings = wp_parse_args( $new_settings, $stored_settings );

				if ( ! isset( $new_settings['astra-agency']['hide_branding'] ) ) {
					$new_settings['astra-agency']['hide_branding'] = false;
				} else {
					$url = str_replace( 'white-label', 'general', $url );
				}

				Astra_Admin_Helper::update_admin_settings_option( '_astra_ext_white_label', $new_settings, true );

				// Change the theme page slug only if the value if added by user.
				$theme_whitelabelled_name = self::get_whitelabel_string( 'astra', 'name', false );
				if ( false !== $theme_whitelabelled_name && ! empty( $theme_whitelabelled_name ) ) {
					$url = remove_query_arg( 'page', $url );
					$url = add_query_arg( 'page', $this->astra_whitelabelled_slug( $theme_whitelabelled_name ), $url );
				}

				$query = array(
					'message' => 'saved',
				);

				$redirect_to = add_query_arg( $query, $url );

				// Flush rewrite rules on publish action of custom layout.
				flush_rewrite_rules();

				wp_safe_redirect( $redirect_to );
				exit;
			}
		}

		/**
		 * Licence Url
		 *
		 * @param string $purchase_url Actions.
		 * @return string
		 */
		public function addon_licence_url( $purchase_url ) {
			if ( false !== self::get_whitelabel_string( 'astra-agency', 'licence', false ) ) {
				$purchase_url = self::get_whitelabel_string( 'astra-agency', 'licence', false );
			}

			return $purchase_url;
		}

		/**
		 * Remove Sidebar from Astra Welcome Page for white label
		 *
		 * @since 1.2.2
		 */
		public function white_label_hide_settings() {
			remove_action( 'astra_welcome_page_right_sidebar_content', 'Astra_Admin_Settings::astra_welcome_page_starter_sites_section', 10 );
			remove_action( 'astra_welcome_page_right_sidebar_content', 'Astra_Admin_Settings::astra_welcome_page_knowledge_base_scetion', 11 );
			remove_action( 'astra_welcome_page_right_sidebar_content', 'Astra_Admin_Settings::astra_welcome_page_community_scetion', 12 );
			remove_action( 'astra_welcome_page_right_sidebar_content', 'Astra_Admin_Settings::astra_welcome_page_five_star_scetion', 13 );
			remove_action( 'astra_welcome_page_right_sidebar_content', 'Astra_Admin_Settings::astra_welcome_page_cloudways_scetion', 14 );

			// Remove Beta Updates if white label is enabled.
			$theme_ext_class = Astra_Theme_Extension::get_instance();
			remove_action( 'astra_welcome_page_right_sidebar_content', array( $theme_ext_class, 'astra_beta_updates_form' ), 50 );
		}

		/**
		 * Add class to welcome wrapper
		 *
		 * @since 1.2.1
		 * @param array $classes astra welcome page classes.
		 * @return array $classes updated astra welcome page classes.
		 */
		public function welcome_wrapper_class( $classes ) {
			$classes[] = 'ast-hide-white-label';

			return $classes;
		}

		/**
		 * Astra Theme Url
		 *
		 * @param string $url Author Url if given.
		 * @return string
		 */
		public function agency_author_link( $url ) {
			if ( false !== self::astra_pro_whitelabel_author_url() ) {
				$url = self::astra_pro_whitelabel_author_url();
			}

			return $url;
		}

		/**
		 * Astra Welcome Page Icon
		 *
		 * @since 1.2.1
		 * @param string $icon Theme Welcome icon.
		 * @return string $icon Updated Theme Welcome icon.
		 */
		public function astra_welcome_page_icon( $icon ) {
			if ( false !== self::get_whitelabel_string( 'astra', 'name', false ) ) {
				$icon = false;
			}

			return $icon;
		}

		/**
		 * Astra Welcome Page Site Title
		 *
		 * @since 1.2.1
		 */
		public function welcome_page_header_site_title() {
			if ( false !== self::get_whitelabel_string( 'astra', 'name', false ) ) {
				echo '<span>' . esc_html( self::get_whitelabel_string( 'astra', 'name', false ) ) . '</span>';
			}
		}

		/**
		 * Modify Astra Addon List
		 *
		 * @since 1.2.1
		 * @param array $addons Astra addon list.
		 * @return array $addons Updated Astra addon list.
		 */
		public function astra_addon_list( $addons = array() ) {

			foreach ( $addons as $addon_slug => $value ) {
				// Remove each addon link to the respective documentation if pro is white labled.
				if ( false !== self::astra_pro_whitelabel_name() ) {
					$addons[ $addon_slug ]['title_url'] = '';
				}
			}

			return $addons;
		}

		/**
		 * Get Astra Pro whitelabelled name.
		 *
		 * @since 1.6.10
		 * @param String $name Original Product name from Graupi.
		 *
		 * @return String Astra Pro's whitelabelled name.
		 */
		public function astra_pro_whitelabel_name( $name = false ) {
			return self::get_whitelabel_string( 'astra-pro', 'name', $name );
		}

		/**
		 * Get Astra Pro whitelabelled description.
		 *
		 * @since 1.6.10
		 * @param String $description Original Product descriptionn from Graupi.
		 *
		 * @return String Astra Pro's whitelabelled description.
		 */
		public function astra_pro_whitelabel_description( $description = false ) {
			return self::get_whitelabel_string( 'astra-pro', 'description', $description );
		}

		/**
		 * Get Astra Pro whitelabelled author.
		 *
		 * @since 1.6.10
		 * @param String $author Original Product author from Graupi.
		 *
		 * @return String Astra Pro's whitelabelled author.
		 */
		public function astra_pro_whitelabel_author( $author = false ) {
			return self::get_whitelabel_string( 'astra-agency', 'author', $author );
		}

		/**
		 * Get Astra Pro whitelabelled author URL.
		 *
		 * @since 1.6.10
		 * @param String $author_url Original Product author URL from Graupi.
		 *
		 * @return String Astra Pro's whitelabelled author URL.
		 */
		public function astra_pro_whitelabel_author_url( $author_url = false ) {
			return self::get_whitelabel_string( 'astra-agency', 'author_url', $author_url );
		}

		/**
		 * Update Plugin icon to be whitelabelled.
		 *
		 * @since 1.6.14
		 * @return Array Default plugin using Theme screenshot image for Astra Pro.
		 */
		public function astra_pro_branded_icons() {
			return array(
				'default' => self::get_whitelabel_string( 'astra', 'screenshot' ),
			);
		}

		/**
		 * Remove White Label Actions.
		 *
		 * @param array $columns Custom layout actions.
		 * @return array $columns Custom layout actions.
		 */
		public function remove_white_label_action( $columns ) {
			unset( $columns['advanced_hook_action'] );
			return $columns;
		}

		/**
		 * Remove custom layouts description.
		 *
		 * @param array $hooks Custom layout data.
		 * @return array $hooks Custom layout data.
		 */
		public function remove_description_custom_layouts( $hooks = array() ) {

			if ( $hooks ) {
				foreach ( $hooks as $key => $hook_group ) {
					if ( array_key_exists( 'hooks', $hook_group ) ) {
						foreach ( $hook_group['hooks'] as $hook_group_key => $hook ) {
							if ( array_key_exists( 'description', $hook ) ) {
								unset( $hooks[ $key ]['hooks'][ $hook_group_key ]['description'] );
							}
						}
					}
				}
			}
			return $hooks;
		}

		/**
		 * Rewrite custom layouts slug.
		 *
		 * @param array $slug Custom layout slug.
		 * @return array $slug Custom layout slug.
		 */
		public function change_custom_hook_url_slug( $slug ) {
			$theme_whitelabelled_name = self::get_whitelabel_string( 'astra', 'name', false );

			// Get white label theme name.
			$theme_name = strtolower( self::astra_pro_whitelabel_name() );
			$theme_name = str_replace( ' ', '-', $theme_name );

			if ( false !== $theme_whitelabelled_name ) {
				$slug = str_replace( ' ', '-', $theme_whitelabelled_name ) . '-advanced-hook';
			}

			return $slug;
		}

		/**
		 * Get whitelabelled slug.
		 * User entered display name of the plugin is converted to slug.
		 *
		 * @since 1.6.14
		 * @param String $name Default slug.
		 * @return String slugified product name.
		 */
		public function astra_whitelabelled_slug( $name ) {
			return sanitize_key( rawurlencode( self::get_whitelabel_string( 'astra', 'name', $name ) ) );
		}

		/**
		 * Update strings on the update-core.php page.
		 *
		 * @since 1.6.14
		 * @return void
		 */
		public function updates_core_page() {
			global $pagenow;

			if ( 'update-core.php' == $pagenow ) {
				$default_screenshot = sprintf( '%s/astra/screenshot.jpg', get_theme_root_uri() );
				$branded_screenshot = self::get_whitelabel_string( 'astra', 'screenshot', false );

				$default_name = 'Astra';
				$branded_name = self::get_whitelabel_string( 'astra', 'name', false );

				if ( false !== $branded_screenshot ) {
					wp_add_inline_script(
						'updates',
						"
						var _ast_default_ss = '$default_screenshot', _ast_branded_ss = '$branded_screenshot';

						document.querySelectorAll( '#update-themes-table .plugin-title .updates-table-screenshot' ).forEach(function(theme) {
							if( _ast_default_ss === theme.src ) {
								theme.src = _ast_branded_ss;
							}
						});"
					);
				}

				if ( false !== $branded_name ) {
					wp_add_inline_script(
						'updates',
						"
						var _ast_default_name = '$default_name', _ast_branded_name = '" . esc_js( $branded_name ) . "';

						document.querySelectorAll( '#update-themes-table .plugin-title strong' )
						.forEach(function(plugin) {
							if( _ast_default_name === plugin.innerText ) {
								plugin.innerText = _ast_branded_name;
							}
						});"
					);
				}
			}
		}

		/**
		 * Return White Label status to BSF Analytics.
		 * Return true if the White Label is enabled from Astra Addon to the BSF Analytics library.
		 *
		 * @since 2.4.1
		 * @param array $bsf_analytics_wl_arr BSF Analytics White Label products statuses array.
		 * @return array product name with white label status.
		 */
		public function astra_bsf_analytics_white_label( $bsf_analytics_wl_arr ) {
			if ( ! isset( $bsf_analytics_wl_arr['astra_addon'] ) ) {
				$bsf_analytics_wl_arr['astra_addon'] = true;
			}
			return $bsf_analytics_wl_arr;
		}

	}
}

/**
 *  Kicking this off by calling 'get_instance()' method
 */
Astra_Ext_White_Label_Markup::get_instance();
