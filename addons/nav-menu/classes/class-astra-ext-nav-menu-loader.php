<?php
/**
 * Navigation Menu Loader.
 *
 * @package Astra Addon
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Astra_Ext_Nav_Menu_Loader' ) ) {

	/**
	 * Astra Nav Menu loader.
	 *
	 * @since 1.6.0
	 */
	// @codingStandardsIgnoreStart
	final class Astra_Ext_Nav_Menu_Loader {
 // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedClassFound
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
		 * @var string
		 */
		private static $mega_menu_style = '';

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

			add_filter( 'wp_nav_menu_args', array( $this, 'modify_nav_menu_args' ) );
			add_filter( 'astra_theme_defaults', array( $this, 'theme_defaults' ) );

			add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'load_scripts' ) );

			if ( defined( 'UAGB_VER' ) && version_compare( UAGB_VER, '1.23.0', '>=' ) ) {
				add_action( 'wp_enqueue_scripts', array( $this, 'load_gutenberg_addon_scripts' ) );
			} else {
				add_action( 'wp', array( $this, 'load_gutenberg_addon_scripts' ) );
			}

			add_action( 'astra_addon_get_css_files', array( $this, 'add_styles' ) );
			add_action( 'astra_addon_get_js_files', array( $this, 'add_scripts' ) );
			add_action( 'customize_register', array( $this, 'customize_register' ), 2 );

			add_filter( 'wp_footer', array( $this, 'megamenu_style' ) );
			add_action( 'customize_preview_init', array( $this, 'preview_scripts' ) );

		}

		/**
		 * Load page builder scripts and styles.
		 *
		 * @access public
		 * @return void
		 */
		public function load_scripts() {

			$menu_locations = get_nav_menu_locations();

			foreach ( $menu_locations as $menu_id ) {
				$nav_items = wp_get_nav_menu_items( $menu_id );

				if ( ! empty( $nav_items ) ) {
					foreach ( $nav_items as $nav_item ) {

						if ( isset( $nav_item->megamenu_template ) && '' != $nav_item->megamenu_template ) {

							$page_builder_base_instance = Astra_Addon_Page_Builder_Compatibility::get_instance();
							$page_builder_instance      = $page_builder_base_instance->get_active_page_builder( $nav_item->megamenu_template );

							if ( is_callable( array( $page_builder_instance, 'enqueue_scripts' ) ) ) {
								$page_builder_instance->enqueue_scripts( $nav_item->megamenu_template );
							}
						}
					}
				}
			}
		}

		/**
		 * Load UAG scripts and styles.
		 *
		 * @access public
		 * @return void
		 *
		 * @since 2.6.0
		 */
		public function load_gutenberg_addon_scripts() {

			$menu_locations = get_nav_menu_locations();

			foreach ( $menu_locations as $menu_id ) {
				$nav_items = wp_get_nav_menu_items( $menu_id );

				if ( ! empty( $nav_items ) ) {
					foreach ( $nav_items as $nav_item ) {

						if ( isset( $nav_item->megamenu_template ) && '' != $nav_item->megamenu_template ) {

							if ( class_exists( 'Astra_Addon_Gutenberg_Compatibility' ) ) {

								$astra_gutenberg_instance = new Astra_Addon_Gutenberg_Compatibility();

								if ( is_callable( array( $astra_gutenberg_instance, 'enqueue_blocks_assets' ) ) ) {
									$astra_gutenberg_instance->enqueue_blocks_assets( $nav_item->megamenu_template );
								}
							}
						}
					}
				}
			}
		}

		/**
		 * Include admin scripts on navigation menu screen.
		 *
		 * @access public
		 * @return void
		 */
		public function admin_scripts() {

			if ( current_user_can( 'edit_theme_options' ) ) {
				global $pagenow;
				$rtl = '';
				if ( is_rtl() ) {
					$rtl = '-rtl';
				}
				if ( 'nav-menus.php' == $pagenow || 'widgets.php' == $pagenow ) {

					wp_enqueue_media();
					wp_enqueue_style( 'wp-color-picker' );

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
					 * @since 2.6.3
					 */
					global $wp_version;

					if ( version_compare( $wp_version, '5.4.99', '>=' ) ) {
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

					if ( SCRIPT_DEBUG ) {
						wp_enqueue_style( 'astra-mm-opts-style', ASTRA_ADDON_EXT_NAV_MENU_URL . 'assets/css/unminified/megamenu-options' . $rtl . '.css', array(), ASTRA_EXT_VER );
						wp_enqueue_script( 'astra-megamenu-opts', ASTRA_ADDON_EXT_NAV_MENU_URL . 'assets/js/unminified/megamenu-options.js', array( 'jquery', 'astra-color-alpha' ), ASTRA_EXT_VER, true );
					} else {
						wp_enqueue_style( 'astra-mm-opts-style', ASTRA_ADDON_EXT_NAV_MENU_URL . 'assets/css/minified/megamenu-options' . $rtl . '.min.css', array(), ASTRA_EXT_VER );
						wp_enqueue_script( 'astra-megamenu-opts', ASTRA_ADDON_EXT_NAV_MENU_URL . 'assets/js/minified/megamenu-options.min.js', array( 'jquery', 'astra-color-alpha' ), ASTRA_EXT_VER, true );
					}

					$has_wp_block_suport = post_type_exists( 'wp_block' );

					if ( $has_wp_block_suport ) {
						$select2_placeholder = __( 'Search Pages/ Posts / Reusable Blocks', 'astra-addon' );
					} else {
						$select2_placeholder = __( 'Search Pages/ Posts', 'astra-addon' );
					}

					wp_localize_script(
						'astra-megamenu-opts',
						'astMegamenuVars',
						array(
							'select2_placeholder' => $select2_placeholder,
							'saving_text'         => __( 'Saving ..', 'astra-addon' ),
							'saved_text'          => __( 'Saved', 'astra-addon' ),
						)
					);
				}
			}
		}

		/**
		 * Customizer Preview
		 */
		public function preview_scripts() {

			if ( SCRIPT_DEBUG ) {
				wp_enqueue_script( 'astra-ext-nav-menu-customize-preview-js', ASTRA_ADDON_EXT_NAV_MENU_URL . 'assets/js/unminified/customizer-preview.js', array( 'customize-preview', 'astra-customizer-preview-js' ), ASTRA_EXT_VER, true );
			} else {
				wp_enqueue_script( 'astra-ext-nav-menu-customize-preview-js', ASTRA_ADDON_EXT_NAV_MENU_URL . 'assets/js/minified/customizer-preview.min.js', array( 'customize-preview', 'astra-customizer-preview-js' ), ASTRA_EXT_VER, true );
			}
		}

		/**
		 * Function to modify navigation menu parameters.
		 *
		 * @param array $args navigation menu arguments.
		 * @return array modified arguments.
		 */
		public function modify_nav_menu_args( $args ) {
			if ( 'primary' == $args['theme_location'] || 'secondary_menu' == $args['theme_location'] || 'above_header_menu' == $args['theme_location'] || 'below_header_menu' == $args['theme_location'] || 'mobile_menu' == $args['theme_location'] ) {
				$args['walker'] = new Astra_Custom_Nav_Walker();
			}
			return $args;
		}

		/**
		 * Add Scripts Callback
		 */
		public function add_scripts() {

			/* Define Variables */
			$uri  = ASTRA_ADDON_EXT_NAV_MENU_URL . 'assets/js/';
			$path = ASTRA_ADDON_EXT_NAV_MENU_DIR . 'assets/js/';

			/* Directory and Extension */
			$file_prefix = '.min';
			$dir_name    = 'minified';

			if ( SCRIPT_DEBUG ) {
				$file_prefix = '';
				$dir_name    = 'unminified';
			}

			$js_uri = $uri . $dir_name . '/';
			$js_dir = $path . $dir_name . '/';

			if ( defined( 'ASTRA_THEME_HTTP2' ) && ASTRA_THEME_HTTP2 ) {
				$gen_path = $js_uri;
			} else {
				$gen_path = $js_dir;
			}

			/*** End Path Logic */
			Astra_Minify::add_dependent_js( 'jquery' );
			Astra_Minify::add_js( $gen_path . 'mega-menu-frontend' . $file_prefix . '.js' );
		}

		/**
		 * Add Styles
		 *
		 * @since 1.6.0
		 * @return void
		 */
		public function add_styles() {

			/*** Start Path Logic */

			/* Define Variables */
			$uri  = ASTRA_ADDON_EXT_NAV_MENU_URL . 'assets/css/';
			$path = ASTRA_ADDON_EXT_NAV_MENU_DIR . 'assets/css/';
			$rtl  = '';

			if ( is_rtl() ) {
				$rtl = '-rtl';
			}

			/* Directory and Extension */
			$file_prefix = $rtl . '.min';
			$dir_name    = 'minified';

			if ( SCRIPT_DEBUG ) {
				$file_prefix = $rtl;
				$dir_name    = 'unminified';
			}

			$css_uri = $uri . $dir_name . '/';
			$css_dir = $path . $dir_name . '/';

			if ( defined( 'ASTRA_THEME_HTTP2' ) && ASTRA_THEME_HTTP2 ) {
				$gen_path = $css_uri;
			} else {
				$gen_path = $css_dir;
			}

			Astra_Minify::add_css( $gen_path . 'mega-menu' . $file_prefix . '.css' );
		}

		/**
		 * Append CSS style to class variable.
		 *
		 * @since 1.6.0
		 * @param string $style Inline style string.
		 * @return void
		 */
		public static function add_css( $style ) {
			self::$mega_menu_style .= $style;
		}

		/**
		 * Print inline CSS to footer.
		 *
		 * @since 1.6.0
		 * @return void
		 */
		public function megamenu_style() {

			if ( '' != self::$mega_menu_style ) {
				echo "<style type='text/css' class='astra-megamenu-inline-style'>";
				echo self::$mega_menu_style; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				echo '</style>';
			}
		}

		/**
		 * Load customizer configuration file.
		 *
		 * @since 1.6.0
		 * @return void
		 */
		public function customize_register() {

			if ( astra_addon_existing_header_footer_configs() ) {
				// Primary Header.
				require_once ASTRA_ADDON_EXT_NAV_MENU_DIR . 'classes/sections/class-astra-nav-menu-primary-header-layout.php';
				require_once ASTRA_ADDON_EXT_NAV_MENU_DIR . 'classes/sections/class-astra-nav-menu-primary-header-typography.php';
				require_once ASTRA_ADDON_EXT_NAV_MENU_DIR . 'classes/sections/class-astra-existing-nav-menu-primary-header-colors.php';
				// Above Header.
				require_once ASTRA_ADDON_EXT_NAV_MENU_DIR . 'classes/sections/class-astra-nav-menu-above-header-layout.php';
				require_once ASTRA_ADDON_EXT_NAV_MENU_DIR . 'classes/sections/class-astra-nav-menu-above-header-typography.php';
				require_once ASTRA_ADDON_EXT_NAV_MENU_DIR . 'classes/sections/class-astra-existing-nav-menu-above-header-colors.php';
				// Below Header.
				require_once ASTRA_ADDON_EXT_NAV_MENU_DIR . 'classes/sections/class-astra-nav-menu-below-header-layout.php';
				require_once ASTRA_ADDON_EXT_NAV_MENU_DIR . 'classes/sections/class-astra-nav-menu-below-header-typography.php';
				require_once ASTRA_ADDON_EXT_NAV_MENU_DIR . 'classes/sections/class-astra-existing-nav-menu-below-header-colors.php';
			}
			// Primary Header.
			require_once ASTRA_ADDON_EXT_NAV_MENU_DIR . 'classes/sections/class-astra-nav-menu-primary-header-colors.php';

			// Above Header.
			require_once ASTRA_ADDON_EXT_NAV_MENU_DIR . 'classes/sections/class-astra-nav-menu-above-header-colors.php';

			// Below Header.
			require_once ASTRA_ADDON_EXT_NAV_MENU_DIR . 'classes/sections/class-astra-nav-menu-below-header-colors.php';
		}


		/**
		 * Set Options Default Values
		 *
		 * @param  array $defaults  Astra options default value array.
		 * @return array
		 */
		public function theme_defaults( $defaults ) {

			$component_limit = astra_addon_builder_helper()->component_limit;
			for ( $index = 1; $index <= $component_limit; $index++ ) {

				$_prefix = 'menu' . $index;

				/**
				 * Menu + Submenu Colors
				 */
				$defaults[ 'header-' . $_prefix . '-submenu-bg-color-responsive' ] = array(
					'desktop' => '',
					'tablet'  => '',
					'mobile'  => '',
				);

				$defaults[ 'header-' . $_prefix . '-submenu-color-responsive' ] = array(
					'desktop' => '',
					'tablet'  => '',
					'mobile'  => '',
				);

				$defaults[ 'header-' . $_prefix . '-submenu-h-bg-color-responsive' ] = array(
					'desktop' => '',
					'tablet'  => '',
					'mobile'  => '',
				);

				$defaults[ 'header-' . $_prefix . '-submenu-h-color-responsive' ] = array(
					'desktop' => '',
					'tablet'  => '',
					'mobile'  => '',
				);

				$defaults[ 'header-' . $_prefix . '-submenu-a-bg-color-responsive' ] = array(
					'desktop' => '',
					'tablet'  => '',
					'mobile'  => '',
				);

				$defaults[ 'header-' . $_prefix . '-submenu-a-color-responsive' ] = array(
					'desktop' => '',
					'tablet'  => '',
					'mobile'  => '',
				);

				/**
				 * Submenu
				 */
				$defaults[ 'header-' . $_prefix . '-submenu-bg-color' ]   = '';
				$defaults[ 'header-' . $_prefix . '-submenu-color' ]      = '';
				$defaults[ 'header-' . $_prefix . '-submenu-h-bg-color' ] = '';
				$defaults[ 'header-' . $_prefix . '-submenu-h-color' ]    = '';
				$defaults[ 'header-' . $_prefix . '-submenu-a-bg-color' ] = '';
				$defaults[ 'header-' . $_prefix . '-submenu-a-color' ]    = '';

				/**
				 * Sub Menu - Typography.
				 */
				$defaults[ 'header-font-size-' . $_prefix . '-sub-menu' ]      = array(
					'desktop'      => '',
					'tablet'       => '',
					'mobile'       => '',
					'desktop-unit' => 'px',
					'tablet-unit'  => 'px',
					'mobile-unit'  => 'px',
				);
				$defaults[ 'header-font-family-' . $_prefix . '-sub-menu' ]    = '';
				$defaults[ 'header-font-weight-' . $_prefix . '-sub-menu' ]    = '';
				$defaults[ 'header-text-transform-' . $_prefix . '-sub-menu' ] = '';
				$defaults[ 'header-line-height-' . $_prefix . '-sub-menu' ]    = '';

				if ( $index < 3 ) {
					/**
					 * Mega Menu Spacing.
					 */
					$defaults[ 'header-' . $_prefix . '-megamenu-heading-space' ]        = astra_addon_builder_helper()->default_responsive_spacing;
					$defaults[ 'header-' . $_prefix . '-header-megamenu-heading-space' ] = astra_addon_builder_helper()->default_responsive_spacing;

					/**
					 * Mega Menu Color.
					 */
					$defaults[ 'header-' . $_prefix . '-header-megamenu-heading-color' ]   = '';
					$defaults[ 'header-' . $_prefix . '-header-megamenu-heading-h-color' ] = '';

					/**
					 * Mega Menu Typography.
					 */
					$defaults[ 'header-' . $_prefix . '-megamenu-heading-font-family' ]    = 'inherit';
					$defaults[ 'header-' . $_prefix . '-megamenu-heading-font-weight' ]    = '700';
					$defaults[ 'header-' . $_prefix . '-megamenu-heading-text-transform' ] = '';
					$defaults[ 'header-' . $_prefix . '-megamenu-heading-font-size' ]      = array(
						'desktop'      => '',
						'tablet'       => '',
						'mobile'       => '',
						'desktop-unit' => 'px',
						'tablet-unit'  => 'px',
						'mobile-unit'  => 'px',
					);

				}
				/**
				 * Menu Spacing.
				 */
				$defaults[ 'header-' . $_prefix . '-spacing' ]         = array(
					'desktop'      => array(
						'top'    => '',
						'right'  => '',
						'bottom' => '',
						'left'   => '',
					),
					'tablet'       => array(
						'top'    => '0',
						'right'  => '20',
						'bottom' => '0',
						'left'   => '20',
					),
					'mobile'       => array(
						'top'    => '',
						'right'  => '',
						'bottom' => '',
						'left'   => '',
					),
					'desktop-unit' => 'px',
					'tablet-unit'  => 'px',
					'mobile-unit'  => 'px',
				);
				$defaults[ 'header-' . $_prefix . '-submenu-spacing' ] = array(
					'desktop'      => array(
						'top'    => '',
						'right'  => '',
						'bottom' => '',
						'left'   => '',
					),
					'tablet'       => array(
						'top'    => '0',
						'right'  => '20',
						'bottom' => '0',
						'left'   => '30',
					),
					'mobile'       => array(
						'top'    => '',
						'right'  => '',
						'bottom' => '',
						'left'   => '',
					),
					'desktop-unit' => 'px',
					'tablet-unit'  => 'px',
					'mobile-unit'  => 'px',
				);

			}

			// Mobile Menu.
			/**
			 * Submenu
			 */
			$defaults['header-mobile-menu-submenu-bg-color']   = '';
			$defaults['header-mobile-menu-submenu-color']      = '';
			$defaults['header-mobile-menu-submenu-h-bg-color'] = '';
			$defaults['header-mobile-menu-submenu-h-color']    = '';
			$defaults['header-mobile-menu-submenu-a-bg-color'] = '';
			$defaults['header-mobile-menu-submenu-a-color']    = '';

			$defaults['header-mobile-menu-submenu-spacing'] = astra_addon_builder_helper()->default_responsive_spacing;

			/**
			 * Sub Menu - Typography.
			 */
			$defaults['header-font-size-mobile-menu-sub-menu']      = array(
				'desktop'      => '',
				'tablet'       => '',
				'mobile'       => '',
				'desktop-unit' => 'px',
				'tablet-unit'  => 'px',
				'mobile-unit'  => 'px',
			);
			$defaults['header-font-family-mobile-menu-sub-menu']    = '';
			$defaults['header-font-weight-mobile-menu-sub-menu']    = '';
			$defaults['header-text-transform-mobile-menu-sub-menu'] = '';
			$defaults['header-line-height-mobile-menu-sub-menu']    = '';

			// Above Header.
			$defaults['above-header-megamenu-heading-color']          = '';
			$defaults['above-header-megamenu-heading-h-color']        = '';
			$defaults['above-header-megamenu-heading-space']          = array(
				'desktop'      => array(
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
				),
				'tablet'       => array(
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
				),
				'mobile'       => array(
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
				),
				'desktop-unit' => 'px',
				'tablet-unit'  => 'px',
				'mobile-unit'  => 'px',
			);
			$defaults['above-header-megamenu-heading-font-family']    = 'inherit';
			$defaults['above-header-megamenu-heading-font-weight']    = '500';
			$defaults['above-header-megamenu-heading-text-transform'] = '';
			$defaults['above-header-megamenu-heading-font-size']      = array(
				'desktop'      => '1.1',
				'tablet'       => '',
				'mobile'       => '',
				'desktop-unit' => 'em',
				'tablet-unit'  => 'px',
				'mobile-unit'  => 'px',
			);

			// Primary Header.
			$defaults['primary-header-megamenu-heading-font-family']    = 'inherit';
			$defaults['primary-header-megamenu-heading-font-weight']    = '700';
			$defaults['primary-header-megamenu-heading-text-transform'] = '';
			$defaults['primary-header-megamenu-heading-font-size']      = array(
				'desktop'      => '1.1',
				'tablet'       => '',
				'mobile'       => '',
				'desktop-unit' => 'em',
				'tablet-unit'  => 'px',
				'mobile-unit'  => 'px',
			);
			$defaults['primary-header-megamenu-heading-color']          = '';
			$defaults['primary-header-megamenu-heading-h-color']        = '';
			$defaults['primary-header-megamenu-heading-space']          = array(
				'desktop'      => array(
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
				),
				'tablet'       => array(
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
				),
				'mobile'       => array(
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
				),
				'desktop-unit' => 'px',
				'tablet-unit'  => 'px',
				'mobile-unit'  => 'px',
			);

			// Above Header.
			$defaults['below-header-megamenu-heading-color']          = '';
			$defaults['below-header-megamenu-heading-h-color']        = '';
			$defaults['below-header-megamenu-heading-space']          = array(
				'desktop'      => array(
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
				),
				'tablet'       => array(
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
				),
				'mobile'       => array(
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
				),
				'desktop-unit' => 'px',
				'tablet-unit'  => 'px',
				'mobile-unit'  => 'px',
			);
			$defaults['below-header-megamenu-heading-font-family']    = 'inherit';
			$defaults['below-header-megamenu-heading-font-weight']    = '500';
			$defaults['below-header-megamenu-heading-text-transform'] = '';
			$defaults['below-header-megamenu-heading-font-size']      = array(
				'desktop'      => '1.1',
				'tablet'       => '',
				'mobile'       => '',
				'desktop-unit' => 'em',
				'tablet-unit'  => 'px',
				'mobile-unit'  => 'px',
			);

			$defaults['sticky-above-header-megamenu-heading-color']     = '';
			$defaults['sticky-above-header-megamenu-heading-h-color']   = '';
			$defaults['sticky-below-header-megamenu-heading-color']     = '';
			$defaults['sticky-below-header-megamenu-heading-h-color']   = '';
			$defaults['sticky-primary-header-megamenu-heading-color']   = '';
			$defaults['sticky-primary-header-megamenu-heading-h-color'] = '';

			return $defaults;
		}
	}
}

Astra_Ext_Nav_Menu_Loader::get_instance();
